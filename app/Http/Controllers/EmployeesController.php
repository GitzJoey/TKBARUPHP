<?php
/**
 * Created by PhpStorm.
 * User: heroes-4
 * Date: 1/4/2017
 * Time: 2:07 PM
 */

namespace  App\Http\Controllers;


use App\Model\Employees;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Validator;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employeeslist = Employees::paginate(10);
        return view('employees.index', compact('employeeslist'));
    }

    public function show($id)
    {
        $employees = Employees::find($id);

        return view('employees.show')->with('employees', $employees);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'ic_number' => 'required|string|max:255',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = '';

        if (!empty($data->image_path)) {
            $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;

            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        if ($validator->fails()) {
            return redirect(route('db.employees.employees.create'))->withInput()->withErrors($validator);
        } else {
            Employees::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'ic_number' => $data['ic_number'],
                'image_path' => $imageName
            ]);
            return redirect(route('db.employees.employees'));
        }
    }

    public function edit($id)
    {
        $employees = Employees::find($id);

        return View('employees.edit', compact('employees'));
    }

    public function update($id, Request $data)
    {
        $employees = Employees::find($id);

        $imageName = '';

        if (!empty($data->image_path)) {
            $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;
            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        $employees->name = $data['name'];
        $employees->email = $data['email'];
        $employees->ic_number = $data['ic_number'];
        $employees->image_path = $imageName;
        $employees->save();

        return redirect(route('db.employees.employees'));
    }


    public function delete($id)
    {
        Employees::find($id)->delete();
        return redirect(route('db.employees.employees'));
    }
}