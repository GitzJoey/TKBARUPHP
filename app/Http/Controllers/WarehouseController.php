<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/21/2016
 * Time: 4:35 PM
 */
namespace App\Http\Controllers;

use App\Model\PurchaseOrder;
use App\Model\Receipt;
use Auth;
use Illuminate\Http\Request;

use App\Model\Lookup;
use App\Model\Warehouse;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $warehouse = Warehouse::paginate(10);
        return view('warehouse.index', compact('warehouse'));
    }

    public function show($id)
    {
        $warehouse = Warehouse::find($id);
        return view('warehouse.show')->with('warehouse', $warehouse);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('warehouse.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $this->validate($data,[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_num' => 'required|string|max:255',
            'status' => 'required',
        ]);

        Warehouse::create([
            'store_id'      => Auth::user()->store->id,
            'name'          => $data['name'],
            'address'       => $data['address'],
            'phone_num'     => $data['phone_num'],
            'status'        => $data['status'],
            'remarks'       => $data['remarks']
        ]);

        return redirect(route('db.master.warehouse'));
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('warehouse.edit', compact('warehouse', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        Warehouse::find($id)->update($req->all());
        return redirect(route('db.master.warehouse'));
    }

    public function delete($id)
    {
        Warehouse::find($id)->delete();
        return redirect(route('db.master.warehouse'));
    }

    public function inflow(){
        $warehouseDDL = Warehouse::all([ 'id', 'name' ]);
        $allPOs = PurchaseOrder::with('supplier')->where('status', '=', 'POSTATUS.WA')->get();

        return view('warehouse.inflow', compact('warehouseDDL', 'allPOs'));
    }

    public function receipt($id){
        $po = PurchaseOrder::with('items.product.productUnits.unit')->find($id);

        return view('warehouse.receipt', compact('po'));
    }

    public function saveReceipt(Request $request){
        for($i = 0; $i < sizeof($request->input('item_id')); $i++){
            $params = [
                'receipt_date' => date('Y-m-d', strtotime($request->input('receipt_date'))),
                'brutto' => $request->input("brutto.$i"),
                'netto' => $request->input("netto.$i"),
                'tare' => $request->input("tare.$i"),
                'licence_plate' => $request->input('licence_plate'),
                'item_id' => $request->input("item_id.$i"),
                'selected_unit_id' => $request->input("selected_unit_id.$i"),
                'store_id' => Auth::user()->store_id
            ];

            $receipt = Receipt::create($params);
        }

        return redirect(route('db.warehouse.inflow.index'));
    }
}