<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:47 PM
 */

namespace App\Http\Controllers;

use DB;
use Config;
use Session;
use Validator;
use Illuminate\Http\Request;

use App\Model\Role;
use App\Model\Permission;

class RolesController extends Controller
{
    public function index()
    {
        $rolelist = Role::paginate(Config::get('const.PAGINATION'));

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
        ])->validate();

        DB::transaction(function() use ($data) {
            $role = new Role;
            $role->name = $data['name'];
            $role->display_name = $data['display_name'];
            $role->description = $data['description'];
            $role->save();

            foreach ($data['permission'] as $pl) {
                $role->permissions()->attach($pl);
            }
        });

        return response()->json();
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $selected = $role->permissions->pluck('id')->toArray();
        $permission = Permission::get()->pluck('display_name', 'id');

        return view('roles.edit', compact('role', 'permission', 'selected'));
    }

    public function update($id, Request $req)
    {
        $validator = $this->validate($req, [
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required',
        ]);

        DB::transaction(function() use ($req, $id) {
            $role = Role::with('permissions')->where('id', '=', $id)->first();
            $pl = Permission::whereIn('id', $req['permission'])->get();

            $role->permissions()->sync($pl);

            $role->update([
                'name' => $req['name'],
                'display_name' => $req['display_name'],
                'description' => $req['description'],
            ]);
        });

        return response()->json();
    }

    public function delete($id)
    {
        $role = Role::find($id);

        $role->permissions()->attach([]);

        $role->delete();

        return redirect(route('db.admin.roles'));
    }
}
