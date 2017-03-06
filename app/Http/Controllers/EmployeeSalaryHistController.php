<?php
/**
 * Created by PhpStorm.
 * User: heroes-4
 * Date: 1/4/2017
 * Time: 2:07 PM
 */

namespace  App\Http\Controllers;

use App\Model\Employee;
use App\Model\EmployeeSalaryHist;

use App\Repos\LookupRepo;
use Carbon\Carbon;

use Validator;
use Illuminate\Http\Request;
use DB;
use Lang;
use Exception;
class EmployeeSalaryHistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employeelist = Employee::paginate(10);
        $employeelist = Employee::select('employees.*','employee_salary_hist.*','employees.id as employee_id','employee_id as id')
            ->leftJoin('employee_salary_hist','employee_id','=','employees.id')
            ->whereRaw('is_last=1 or is_last is null')
            ->paginate(10);

        $salaryTitle = "Salary ".date('M').' '.date('Y');
        $salaryCount = Employee::select('employees.*')
            ->whereRaw("employees.id in (select employee_id from employee_salary_hist 
                                where month(salary_period)=month(now()) 
                                        and year(salary_period)=year(now())
                                        and `type`='EMPSALARYACTION.SALARY')
                                        ")
            ->count();
        return view('employee_salary_hist.index', compact('employeelist','salaryCount'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        $salaryList = EmployeeSalaryHist::where('employee_id',$employee->id)
                ->orderBy('id','desc')
                ->paginate(10);
        return view('employee_salary_hist.show',compact('employee','salaryList'));
    }

    public function create(Request $r)
    {
        $statusDDL = LookupRepo::findByCategory('EMPSALARYACTION')->pluck('description', 'code');
        $employeeList = Employee::pluck('name','id');
        $employee_id = $r->get('employee_id');
        $salaryTitle = Lang::get('employee_salary.create.pay_salary').' '.date('M').' '.date('Y');
        return view('employee_salary_hist.create', compact('statusDDL','employeeList','employee_id','salaryTitle'));
    }

    public function store(Request $data)
    {
        $data['amount'] = floatval(str_replace(',', '', $data['amount']));
        $minusType=['EMPSALARYACTION.SALARY_PAY_UPFRONT','EMPSALARYACTION.SALARY_PAYMENT'];
        if(in_array($data['type'], $minusType)){
            $data['amount'] = $data['amount']*-1;
        }
        $validator = Validator::make($data->all(), [
            'employee_id' => 'required|integer',
            'amount' => 'required|integer',
            'type' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect(route('db.employee.employee_salary.create'))->withInput()->withErrors($validator);
        } else {
            $employee=Employee::find($data['employee_id']);
            $employee->transaction($data['amount'],$data['type'],$data['description'],$is_salary=0);
            return redirect(route('db.employee.employee_salary'));
        }
    }

    public function calculateSalary(){
        $month = date('m');
        $year = date('Y');
        $day = "1";
        $salaryTitle = "Salary ".date('M').' '.date('Y');
        $employeelist = Employee::select('employees.*')
            ->whereRaw("employees.id not in (select employee_id from employee_salary_hist 
                                where month(salary_period)=month(now()) 
                                        and year(salary_period)=year(now())
                                        and `type`='EMPSALARYACTION.SALARY')")
            ->get();
        $monthNow = Carbon::createFromDate($year,$month,$day);
        $monthStart = $monthNow->copy()->subMonth();
        $success = 0;
        try {
            DB::beginTransaction();
            foreach ($employeelist as $employee) {
                $join = Carbon::createFromFormat('Y-m-d H:m:i', $employee->start_date);
                $numberOfDays = $monthStart->diffInDays($monthNow,false);
                $workingDays = $join->diffInDays($monthNow);
                //if the employee works have not reached 1 month
                if($numberOfDays-$workingDays>1){
                    $amount = ($workingDays/$numberOfDays)*$employee->base_salary;
                }else{
                    $amount = $employee->base_salary;
                }
                $hist = $employee->transaction($amount,'EMPSALARYACTION.SALARY','Salary',$is_salary=1);
                if($hist) $success++;
            }   
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }
}