<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:47 PM
 */

namespace App\Http\Controllers;
use App\Permission;
use App\Role;

class RolesController extends Controller
{
    public function index()
    {
        $rolelist = Role::paginate(10);

        return view('roles.index', compact('rolelist'));
    }

    public function show($id)
    {
        $role = Role::find($id);
        return view('roles.show', compact('role'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.admin.roles.create'))->withInput()->withErrors($validator);
        } else {
            Role::create([
                'name' => $data['name'],
                'display_name' => $data['display_name'],
                'description' => $data['description'],
            ]);

            Session::flash('success', 'New User Created');

            return redirect(route('db.admin.role'));
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();

        return view('roles.edit', compact('role', 'permission'));
    }

    public function update($id, Request $req)
    {
        $this->validate($req, [
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required',
        ]);

        Role::find($id)->update($req->all());
        return redirect(route('db.admin.role'));
    }
}