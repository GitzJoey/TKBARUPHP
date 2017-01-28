<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WarehouseTransferStockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        return view('warehouse.transferstock.index');
    }
}
