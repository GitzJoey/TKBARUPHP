<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:40 PM
 */

namespace App\Http\Controllers;

use DB;
use Session;
use Validator;
use App\Model\UserDetail;
use Illuminate\Http\Request;

use App\User;
use App\Model\Role;
use App\Model\Store;
use App\Model\Profile;
use App\Repos\LookupRepo;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::paginate(10);
        return view('user.index', compact('user'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile', compact('user'));
    }

    public function create()
    {
        $rolesDDL = Role::get()->pluck('display_name', 'name');
        $storeDDL = Store::get()->pluck('name', 'id');
        $usertypeDDL = LookupRepo::findByCategory('USERTYPE')->pluck('description', 'code');
        $profiles = Profile::where('user_id', '=', 0)->get();

        return view('user.create', compact('rolesDDL', 'storeDDL', 'usertypeDDL', 'profiles'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
            'store' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.admin.user.create'))->withInput()->withErrors($validator);
        } else {
            DB::transaction(function() use ($data) {
                $usr = new User();
                $usr->name = $data['name'];
                $usr->email = $data['email'];
                $usr->password = bcrypt($data['password']);
                $usr->store_id = $data['store'];

                $usr->api_token = str_random(60);

                $ud = new UserDetail();
                $ud->type = $data['type'];
                $ud->allow_login = boolval($data['allow_login']);

                $usr->save();
                $usr->roles()->attach(Role::whereName($data['roles'])->get());
                if (!empty($data['link_profile'])) {
                    $usr->profile()->save(Profile::whereId($data['link_profile'])->first());
                }
                $usr->userDetail()->save($ud);
            });


            Session::flash('success', 'New User Created');

            return redirect(route('db.admin.user'));
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        $rolesDDL = Role::get()->pluck('display_name', 'name');
        $storeDDL = Store::get()->pluck('name', 'id');
        $usertypeDDL = LookupRepo::findByCategory('USERTYPE')->pluck('description', 'code');
        $profiles = Profile::where('user_id', '=', 0)->orWhere('user_id', '=', $user->id)->get();

        return view('user.edit', compact('user', 'storeDDL', 'rolesDDL', 'usertypeDDL', 'profiles'));
    }

    public function update($id, Request $req)
    {
        $this->validate($req, [
            'name' => 'required|max:255',
            'roles' => 'required',
            'password' => 'required|min:6|confirmed',
            'store' => 'required',
        ]);

        DB::transaction(function() use ($id, $req) {
            $usr = User::find($id);
            $usr->name = $req['name'];
            $usr->email = $req['email'];
            if (!empty($req['password'])) {
                $usr->password = bcrypt($req['password']);
            }
            $usr->store_id = $req['store'];
            $usr->save();

            $role_id = Role::whereName($req['roles'])->first()->id;
            $usr->roles()->sync([$role_id]);

            //unlink last profile
            $lastp = Profile::whereUserId($usr->id)->first();
            if ($lastp) {
                $lastp->user_id = 0;
                $lastp->save();
            }

            if (!empty($req['link_profile'])) {
                $p = Profile::whereId($req['link_profile'])->first();
                $usr->profile()->save($p);
            }

            $usr->userDetail->type = $req['type'];
            $usr->userDetail->allow_login = boolval($req['allow_login']);
            $usr->userDetail->save();
        });

        return redirect(route('db.admin.user'));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->userDetail()->update(['allow_login' => 0]);

        return redirect(route('db.admin.user'));
    }
}
