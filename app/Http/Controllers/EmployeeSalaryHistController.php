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

use DB;
use Auth;
use Config;
use Exception;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class EmployeeSalaryHistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employeelist = Employee::select('employees.*', 'employee_salary_hist.*', 'employees.id as employee_id','employee_id as id')
            ->leftJoin('employee_salary_hist','employee_id','=','employees.id')
            ->whereRaw('is_last=1 or is_last is null')
            ->paginate(Config::get('const.PAGINATION'));

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
                ->paginate(Config::get('const.PAGINATION'));
        return view('employee_salary_hist.show',compact('employee','salaryList'));
    }

    public function create(Request $r)
    {
        $employeeList = Employee::get()->pluck('name','hId');
        $statusDDL = LookupRepo::findByCategory('EMPSALARYACTION')->pluck('i18nDescription', 'code');

        $employee_id = null;
        $employee = null;
        $salaryList = [];
        if (!empty($r->get('e'))) {
            $employee_id = Hashids::decode($r->get('e'))[0];
            $employee = Employee::find($employee_id);
            $salaryList = EmployeeSalaryHist::where('employee_id', $employee_id)->orderBy('id','desc')
                ->paginate(Config::get('const.PAGINATION'));
        }

        return view('employee_salary_hist.create', compact('statusDDL','employeeList','employee_id','employee', 'salaryList'));
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
            $this->createRecord($data['employee_id'], $data['amount'], $data['type'], $data['description'], $is_salary=0);

            return redirect(route('db.employee.employee_salary'));
        }
    }

    public function calculateSalary(){
        $month = date('m');
        $year = date('Y');
        $day = "1";

        $employeelist = Employee::select('employees.*')
            ->whereRaw("employees.id not in (select employee_id from employee_salary_hist 
                                where month(salary_period)=month(now()) 
                                        and year(salary_period)=year(now())
                                        and `type`='EMPSALARYACTION.SALARY')")
            ->get();

        $monthNow = Carbon::createFromDate($year, $month, $day);
        $monthStart = $monthNow->copy()->subMonth();
        $success = 0;

        try {
            DB::beginTransaction();
            foreach ($employeelist as $employee) {
                $join = Carbon::createFromFormat('Y-m-d H:m:i', $employee->start_date);
                $numberOfDays = $monthStart->diffInDays($monthNow, false);
                $workingDays = $join->diffInDays($monthNow);

                //if the employee works have not reached 1 month
                if($numberOfDays-$workingDays > 1){
                    $amount = ($workingDays/$numberOfDays) * $employee->base_salary;
                }else{
                    $amount = $employee->base_salary;
                }

                $description = 'Salary for '.date('F', mktime(0, 0, 0, $month, 10)).' '.$year;
                $hist = $this->createRecord($employee->id, $amount, 'EMPSALARYACTION.SALARY', $description, $is_salary = 1);

                if($hist) $success++;
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    private function createRecord($id, $amount, $type, $description, $is_salary=0)
    {
        $lastHist=EmployeeSalaryHist::where('employee_id', $id)->where('is_last',1)->first();

        if ($lastHist==null) {
            $lastBalance=0;
        } else {
            $lastBalance = $lastHist->balance;
            $lastHist->is_last = 0;

            $lastHist->save();
        }

        $hist=EmployeeSalaryHist::create([
            'employee_id' => $id,
            'type' => $type,
            'store_id' => Auth::user()->store->id,
            'salary_period' => date('Y-m-d'),
            'description' => $description,
            'amount' => $amount,
            'balance' => $lastBalance+$amount,
            'is_last' => 1,
            'is_salary' => $is_salary,
        ]);

        return $hist;
    }
}