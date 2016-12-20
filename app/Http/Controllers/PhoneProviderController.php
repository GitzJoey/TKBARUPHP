<?php
/**
 * Created by PhpStorm.
 * User: cvgs
 * Date: 9/15/2016
 * Time: 3:33 PM
 */
namespace App\Http\Controllers;

use App\Model\PhonePrefix;
use DateTime;
use Validator;
use Illuminate\Http\Request;

use App\Model\Lookup;
use App\Model\PhoneProvider;

class PhoneProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
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
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

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

            return redirect(route('db.admin.phone_provider'));
        }
    }

    public function edit($id)
    {
        $phoneProvider = PhoneProvider::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('phone_provider.edit', compact('phoneProvider', 'statusDDL'));
    }

    public function update($id, Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $ph = PhoneProvider::find($id);

        if ($validator->fails()) {
            return redirect(route('db.admin.phone_provider.edit', $ph->hId()))->withInput()->withErrors($validator);
        } else {

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
        return PhoneProvider::where('prefixes.prefix', '=', $digit)->get()->first();
    }
}