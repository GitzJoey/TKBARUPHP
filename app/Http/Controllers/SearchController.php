<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 4/8/2017
 * Time: 8:51 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PurchaseOrderService;
use App\Services\SalesOrderService;
use App\Services\PaymentService;
use App\Services\StockService;
use App\Services\SupplierService;
use App\Services\CustomerService;
use App\Services\ProductService;

class SearchController extends Controller
{
    private $purchaseOrderService;
    private $salesOrderService;
    private $paymentService;
    private $stockService;
    private $supplierService;
    private $customerService;
    private $productService;

    public function __construct(
        PurchaseOrderService $purchaseOrderService,
        SalesOrderService $salesOrderService,
        PaymentService $paymentService,
        StockService $stockService,
        SupplierService $supplierService,
        CustomerService $customerService,
        ProductService $productService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->salesOrderService = $salesOrderService;
        $this->paymentService = $paymentService;
        $this->stockService = $stockService;
        $this->supplierService = $supplierService;
        $this->customerService = $customerService;
        $this->productService = $productService;

        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $po = [];
        $so = [];
        $payment = [];
        $stocks = [];
        $supplier = [];
        $customer = [];
        $product = [];

        if (!empty($request->query('q'))) {
            $q = $request->query('q');
            $po = $this->purchaseOrderService->searchPo($q);
            $so = $this->salesOrderService->searchSo($q);
            $payment = $this->paymentService->searchPayment($q);
            $stocks = $this->stockService->searchStock($q);
            $supplier = $this->supplierService->searchSupplier($q);
            $customer = $this->customerService->searchCustomer($q);
            $product = $this->productService->searchProduct($q);
        }

        return view('search.result',
            compact('po', 'so', 'payment', 'stocks', 'supplier', 'customer', 'product'));
    }
}