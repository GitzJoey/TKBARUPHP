<?php

namespace App\Http\Controllers;

use App\Services\StockService;

use Illuminate\Http\Request;

class StockController extends Controller
{
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
        $this->middleware('auth', [
            'except' => [
                'getCurrentStocks'
            ]
        ]);
    }

    public function getCurrentStocks()
    {
        return $this->stockService->getCurrentStocks();
    }
}
