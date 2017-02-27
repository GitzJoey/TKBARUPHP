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
        $employeelist = Employee::paginate(10);
        return view('employee.index', compact('employeelist'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        return view('employee.show')->with('employee', $employee);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

        return view('employee.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'ic_number' => 'required|string|max:255',
        ]);

        $imageName = '';

        if (!empty($data->image_path)) {
            $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;

            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        if ($validator->fails()) {
            return redirect(route('db.employee.employee.create'))->withInput()->withErrors($validator);
        } else {
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
            return redirect(route('db.employee.employee'));
        }
    }

    public function edit($id)
    {
        $employee = Employee::find($id);

        return View('employee.edit', compact('employee'));
    }

    public function update($id, Request $data)
    {
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

        return redirect(route('db.employee.employee'));
    }


    public function delete($id)
    {
        Employee::find($id)->delete();
        return redirect(route('db.employee.employee'));
    }
}