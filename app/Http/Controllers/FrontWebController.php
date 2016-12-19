<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/18/2016
 * Time: 11:09 PM
 */

namespace App\Http\Controllers;

use App\Services\StoreService;

class FrontWebController extends Controller
{
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        $store = $this->storeService->getFrontWebStore();

        return view('frontweb.index', compact('store'));
    }
}