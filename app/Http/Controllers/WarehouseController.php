<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/21/2016
 * Time: 4:35 PM
 */

namespace App\Http\Controllers;

use App\Model\Unit;
use App\Model\Stock;
use App\Model\StockIn;
use App\Model\StockOut;
use App\Model\StockOpname;
use App\Model\Warehouse;
use App\Model\WarehouseSection;

use App\Repos\LookupRepo;
use App\Services\WarehouseService;

use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->middleware('auth', ['except' => ['isUnfinishedWarehouseExist', 'getLastStockOpname']]);
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $warehouse = Warehouse::paginate(10);
        return view('warehouse.index', compact('warehouse'));
    }

    public function show($id)
    {
        $warehouse = Warehouse::with('sections.capacityUnit')->find($id);

        return view('warehouse.show')->with('warehouse', $warehouse);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get()->pluck('unit_name', 'id');

        return view('warehouse.create', compact('statusDDL', 'unitDDL'));
    }

    public function store(Request $data)
    {
        $this->validate($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_num' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $warehouse = new Warehouse();

        $warehouse->store_id = Auth::user()->store->id;
        $warehouse->name = $data['name'];
        $warehouse->address = $data['address'];
        $warehouse->phone_num = $data['phone_num'];
        $warehouse->status = $data['status'];
        $warehouse->remarks = $data['remarks'];
        $warehouse->save();

        for ($i = 0; $i < count($data['section_name']); $i++) {
            $ws = new WarehouseSection();

            $ws->store_id = Auth::user()->store->id;
            $ws->name = $data['section_name'][$i];
            $ws->position = $data['section_position'][$i];
            $ws->capacity = $data['section_capacity'][$i];
            $ws->capacity_unit_id = $data['section_capacity_unit'][$i];
            $ws->remarks = empty($data['section_remarks'][$i]) ? '' : $data['section_remarks'][$i];

            $warehouse->sections()->save($ws);
        }

        return redirect(route('db.master.warehouse'));
    }

    public function edit($id)
    {
        $warehouse = Warehouse::with('sections')->find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get(['id', 'name', 'symbol']);

        return view('warehouse.edit', compact('warehouse', 'statusDDL', 'unitDDL'));
    }

    public function update($id, Request $data)
    {
        $warehouse = Warehouse::find($id);

        $warehouse->sections->each(function($s) { $s->delete(); });

        for ($i = 0; $i < count($data['section_name']); $i++) {
            $ws = new WarehouseSection();

            $ws->store_id = Auth::user()->store->id;
            $ws->name = $data['section_name'][$i];
            $ws->position = $data['section_position'][$i];
            $ws->capacity = $data['section_capacity'][$i];
            $ws->capacity_unit_id = $data['section_capacity_unit'][$i];
            $ws->remarks = empty($data['section_remarks'][$i]) ? '' : $data['section_remarks'][$i];

            $warehouse->sections()->save($ws);
        }

        $warehouse->store_id = Auth::user()->store->id;
        $warehouse->name = $data['name'];
        $warehouse->address = $data['address'];
        $warehouse->phone_num = $data['phone_num'];
        $warehouse->status = $data['status'];
        $warehouse->remarks = $data['remarks'];

        $warehouse->save();

        return redirect(route('db.master.warehouse'));
    }

    public function delete($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->sections->each(function($s) { $s->delete(); });
        $warehouse->delete();

        return redirect(route('db.master.warehouse'));
    }

    public function stockopname()
    {
        Log::info('[WarehouseController@stockopname]');
        $stocks = Stock::paginate(10);

        return view('warehouse.stockopname.index', compact('stocks'));
    }


    public function adjust($id)
    {
        Log::info('[WarehouseController@adjust]');
        $stock = Stock::find($id);

        return view('warehouse.stockopname.adjustment', compact('stock'));
    }

    public function saveAdjustment(Request $request, $id)
    {
        Log::info('[WarehouseController@saveAdjustment]');
        $stock = Stock::find($id);

        $stockOpnameParam = [
            'stock_id'          => $stock->id,
            'opname_date'       => date('Y-m-d H:i:s', strtotime($request->input('opname_date'))),
            'is_match'          => $request->has('is_match') ? true : false,
            'previous_quantity' => $stock->current_quantity,
            'adjusted_quantity' => $request->input('adjusted_quantity'),
            'reason'            => $request->input('reason')
        ];

        $stockOpname = StockOpname::create($stockOpnameParam);

        if($stockOpname->adjusted_quantity > $stockOpname->previous_quantity){
            $stockInParam = [
                'store_id' => Auth::user()->store_id,
                'po_id'=> 0,
                'product_id' => $stock->product_id,
                'stock_id' => $stock->id,
                'warehouse_id' => $stock->warehouse_id,
                'stock_opname_id' => $stockOpname->id,
                'quantiy' => $stockOpname->adjusted_quantity - $stockOpname->previous_quantity
            ];

            $stockIn = StockIn::create($stockInParam);
        } else if ($stockOpname->adjusted_quantity < $stockOpname->previous_quantity){
            $stockOutParam = [
                'store_id' => Auth::user()->store_id,
                'so_id'=> 0,
                'product_id' => $stock->product_id,
                'stock_id' => $stock->id,
                'warehouse_id' => $stock->warehouse_id,
                'stock_opname_id' => $stockOpname->id,
                'quantiy' => $stockOpname->previous_quantity - $stockOpname->adjusted_quantity
            ];

            $stockOut = StockOut::create($stockOutParam);
        }

        $stock->current_quantity = $stockOpname->adjusted_quantity;
        $stock->save();

        return redirect(route('db.warehouse.stockopname.index'));
    }

    public function isUnfinishedWarehouseExist()
    {
        return response()->json([
           'return' => $this->warehouseService->isUnfinishedWarehouseExist() ? 'true':'false'
        ]);
    }

    public function getLastStockOpname()
    {
        return StockOpname::orderBy('opname_date', 'desc')->take(1)->get();
    }
}
