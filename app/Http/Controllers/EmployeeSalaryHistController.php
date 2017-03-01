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

class EmployeeSalaryHistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employeelist = Employee::paginate(10);
        $employeelist=Employee::select('employees.*','employee_salary_hist.*')
            ->leftJoin('employee_salary_hist','employee_id','=','employees.id')
            ->whereRaw('is_last=1 or is_last is null')
            ->paginate(10);
            
        return view('employee_salary_hist.index', compact('employeelist'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        $salaryList=EmployeeSalaryHist::where('employee_id',$employee->id)
                ->orderBy('id','desc')
                ->paginate(10);
        return view('employee_salary_hist.show',compact('employee','salaryList'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
        $employeeList=Employee::pluck('name','id');
        return view('employee_salary_hist.create', compact('statusDDL','employeeList'));
    }

    public function store(Request $data)
    {

        $data['amount']=floatval(str_replace(',', '', $data['amount']));
        $validator = Validator::make($data->all(), [
            'employee_id' => 'required|integer',
            'amount' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);
        // dd($data->all());
        // dd($validator->errors());
        if ($validator->fails()) {
            return redirect(route('db.employee.employee_salary.create'))->withInput()->withErrors($validator);
        } else {
            $employee=Employee::find($data['employee_id']);
            $employee->transaction($data['amount']*$data['type'],$data['title'],$data['description'],$is_salary=0);
            // return 'cek';
            return redirect(route('db.employee.employee_salary'));
        }
    }

    public function calculateSalary(){
        $month=date('m');
        $year=date('Y');
        $day="1";
        $salaryTitle="Salary ".date('M').' '.date('Y');
        $employeelist=Employee::select('employees.*')
            ->whereRaw("employees.id not in (select employee_id from employee_salary_hist where title='$salaryTitle')")
            ->get();
        $monthNow=Carbon::createFromDate($year,$month,$day);
        $monthStart=$monthNow->copy()->subMonth();
        $success=0;
        try {
            \DB::beginTransaction();
            foreach ($employeelist as $employee) {
                $join=Carbon::createFromFormat('Y-m-d H:m:i', $employee->start_date);
                $numberOfDays=$monthStart->diffInDays($monthNow,false);
                $workingDays=$join->diffInDays($monthNow);
                //if the employee works have not reached 1 month
                if($numberOfDays-$workingDays>1){
                    $amount=($workingDays/$numberOfDays)*$employee->base_salary;
                }else{
                    $amount=$employee->base_salary;
                }
                $employee->transaction($amount,$salaryTitle,'',$is_salary=1);
                if($hist) $success++;
            }   
            \DB::commit();
            $act=true;
        } catch (\Exception $e) {
            $act=false;
            // dd($e);
            \DB::rollBack();
        }
        return redirect()->back();
    }
}