<?php
/**
 * Created by PhpStorm.
 * User: cvgs
 * Date: 9/15/2016
 * Time: 3:33 PM
 */
namespace App\Http\Controllers;

use App\Model\PhonePrefix;
use App\Model\PhoneProvider;

use App\Repos\LookupRepo;

use DB;
use Validator;
use Illuminate\Http\Request;

class PhoneProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'getPhoneProviderByDigit']);
    }

    public function index()
    {
        $p = PhonePrefix::get()->where('prefix', '=', '0812');

        $phoneProvider = PhoneProvider::paginate(10);
        return view('phone_provider.index')->with('phoneProviderList', $phoneProvider);
    }

    public function show($id)
    {
        $phoneProvider = PhoneProvider::find($id);
        return view('phone_provider.show')->with('phoneProvider', $phoneProvider);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

        return view('phone_provider.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.admin.phone_provider.create'))->withInput()->withErrors($validator);
        } else {
            DB::transaction(function() use ($data) {
                $ph = new PhoneProvider();
                $ph->name = $data['name'];
                $ph->short_name = $data['short_name'];
                $ph->status = $data['status'];
                $ph->remarks = $data['remarks'];

                $ph->save();

                for ($i = 0; $i < count($data['prefixes']); $i++) {
                    $pp = new PhonePrefix();
                    $pp->prefix = $data['prefixes'][$i];

                    $ph->prefixes()->save($pp);
                }
            });

            return redirect(route('db.admin.phone_provider'));
        }
    }

    public function edit($id)
    {
        $phoneProvider = PhoneProvider::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

        return view('phone_provider.edit', compact('phoneProvider', 'statusDDL'));
    }

    public function update($id, Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.admin.phone_provider.edit', $ph->hId()))->withInput()->withErrors($validator);
        } else {
            DB::transaction(function() use ($id, $data) {
                $ph = PhoneProvider::find($id);

                $ph->name = $data['name'];
                $ph->short_name = $data['short_name'];
                $ph->status = $data['status'];
                $ph->remarks = $data['remarks'];
                $ph->save();

                $ph->prefixes->each(function($pr) { $pr->delete(); });

                for ($i = 0; $i < count($data['prefixes']); $i++) {
                    $pp = new PhonePrefix();
                    $pp->prefix = $data['prefixes'][$i];

                    $ph->prefixes()->save($pp);
                }
            });

            return redirect(route('db.admin.phone_provider'));
        }
    }

    public function delete($id)
    {
        $ph = PhoneProvider::find($id);
        $ph->prefixes->each(function($pr) { $pr->delete(); });
        $ph->delete();

        return redirect(route('db.admin.phone_provider'));
    }

    public function getPhoneProviderByDigit($digit)
    {
        $p = PhonePrefix::get();

        return response()->json([
            'digit' => $digit,
            'provider' => count($p) > 0 ? $p:''
        ], 200);
    }
}
