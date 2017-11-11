<?php
/**
 * Created by PhpStorm.
 * User: heroes-4
 * Date: 1/4/2017
 * Time: 2:07 PM
 */

namespace  App\Http\Controllers;

use App\Model\Employee;

use App\Repos\LookupRepo;

use Config;
use Validator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employeelist = Employee::paginate(Config::get('const.PAGINATION'));
        return view('employee.index', compact('employeelist'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        return view('employee.show')->with('employee', $employee);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        return view('employee.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'ic_number' => 'required|string|max:255',
        ])->validate();

        $imageName = '';

        if (!empty($data->image_path)) {
            $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;

            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        Employee::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'start_date' => date('Y-m-d', strtotime($data->input('start_date'))),
            'freelance' => !empty($data['freelance']) ? true:false,
            'base_salary'=> floatval(str_replace(',', '', $data['base_salary'])),
            'ic_number' => $data['ic_number'],
            'status' => $data['status'],
            'image_path' => $imageName
        ]);

        return response()->json();
    }
    
    public function edit($id)
    {
        $employee = Employee::find($id);
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        return View('employee.edit', compact('employee', 'statusDDL'));
    }

    public function update($id, Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'ic_number' => 'required|string|max:255',
        ])->validate();

        $employee = Employee::find($id);

        $imageName = '';

        if (!empty($data->image_path)) {
            $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;
            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        $employee->name = $data['name'];
        $employee->address = $data['address'];
        $employee->start_date = date('Y-m-d', strtotime($data->input('start_date')));
        $employee->freelance = !empty($data['freelance']) ? true:false;
        $employee->base_salary = floatval(str_replace(',', '', $data['base_salary']));
        $employee->status = $data['status'];
        $employee->ic_number = $data['ic_number'];
        $employee->image_path = $imageName;
        $employee->save();
        
        return response()->json();
    }


    public function delete($id)
    {
        Employee::find($id)->delete();
        return redirect(route('db.employee.employee'));
    }
}
