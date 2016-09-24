<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:47 PM
 */

namespace App\Http\Controllers;

use Session;
use Validator;
use Illuminate\Http\Request;

use App\Role;
use App\Permission;

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
            $role = new Role;
            $role->name = $data['name'];
            $role->display_name = $data['display_name'];
            $role->description = $data['description'];
            $role->save();

            foreach($data['permission'] as $pl) {
                $role->permissionList()->attach($pl);
            }

            Session::flash('success', 'New User Created');

            return redirect(route('db.admin.roles'));
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $selected = $role->permissionList->pluck('id')->toArray();
        $permission = Permission::get()->pluck('display_name', 'id');

        return view('roles.edit', compact('role', 'permission', 'selected'));
    }

    public function update($id, Request $req)
    {
        $this->validate($req, [
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required',
        ]);

        $role = Role::whereId($id);
        $pl = Permission::whereIn('id', $req['permission'])->get();

        $role->permissionList()->sync($pl);

        $role->update([
            'name' => $req['name'],
            'display_name' => $req['display_name'],
            'description' => $req['description'],
        ]);

        return redirect(route('db.admin.roles'));
    }

    public function delete($id)
    {
        $role = Role::find($id);

        $role->permissionList()->attach([]);

        $role->delete();

        return redirect(route('db.admin.roles'));
    }
}