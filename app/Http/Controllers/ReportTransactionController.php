<?php

namespace App\Http\Controllers;

use App\Model\PurchaseOrder;
use App\Model\SalesOrder;
use App\Repos\LookupRepo;

use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generatePurchaseOrderReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generatePurchaseOrderReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $poStatusDDL = LookupRepo::findByCategory('POSTATUS')->pluck('description', 'code');

        //Parameters
        $poCode = $request->input('code');
        $poDate = $request->input('po_date');
        $shippingDate = $request->input('shipping_date');
        $receiptDate = $request->input('receipt_date');
        $supplier = $request->input('supplier');

        $purchaseOrders = PurchaseOrder::with('supplier', 'warehouse', 'vendorTrucking', 'items', 'expenses')
            ->when(!empty($poCode), function ($query) use ($poCode) {
                return $query->orWhere('code', 'like', "%$poCode%");
            })
            ->when(!empty($poDate), function ($query) use ($poDate) {
                return $query->orWhere('po_created', '=', $poDate);
            })
            ->when(!empty($shippingDate), function ($query) use ($shippingDate) {
                return $query->orWhere('shipping_date', '=', $shippingDate);
            })
            ->when(!empty($receiptDate), function ($query) use ($receiptDate) {
                return $query->orWhereHas('receipts', function ($q) use ($receiptDate){
                    $q->orWhere('receipt_date', '=', $receiptDate);
                });
            })
            ->when(!empty($supplier), function ($query) use ($supplier) {
                return $query->orWhereHas('supplier', function ($q) use ($supplier){
                    $q->orWhere('name', 'like', "%$supplier%");
                });
            })
            ->get();

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Purchase_Order_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.purchase_order_report',
            compact('poCode', 'poDate', 'shippingDate', 'receiptDate', 'supplier', 'purchaseOrders', 'poStatusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($poCode, $poDate, $shippingDate, $receiptDate, $supplier, $purchaseOrders, $poStatusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($poCode, $poDate, $shippingDate, $receiptDate, $supplier, $purchaseOrders, $poStatusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.purchase_order_report',
                    compact('poCode', 'poDate', 'shippingDate', 'receiptDate', 'supplier', 'purchaseOrders', 'poStatusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateSalesOrderReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateSalesOrderReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $soStatusDDL = LookupRepo::findByCategory('SOSTATUS')->pluck('description', 'code');

        //Parameters
        $soCode = $request->input('code');
        $soDate = $request->input('so_date');
        $shippingDate = $request->input('shipping_date');
        $deliverDate = $request->input('deliver_date');
        $customer = $request->input('customer');

        $salesOrders = SalesOrder::with('customer', 'warehouse', 'vendorTrucking', 'items', 'expenses')
            ->when(!empty($soCode), function ($query) use ($soCode) {
                return $query->orWhere('code', 'like', "%$soCode%");
            })
            ->when(!empty($soDate), function ($query) use ($soDate) {
                return $query->orWhere('so_created', '=', $soDate);
            })
            ->when(!empty($shippingDate), function ($query) use ($shippingDate) {
                return $query->orWhere('shipping_date', '=', $shippingDate);
            })
            ->when(!empty($deliverDate), function ($query) use ($deliverDate) {
                return $query->orWhereHas('delivers', function ($q) use ($deliverDate){
                    $q->orWhere('deliver_date', '=', $deliverDate);
                });
            })
            ->when(!empty($customer), function ($query) use ($customer) {
                return $query->orWhereHas('customer', function ($q) use ($customer){
                    $q->orWhere('name', 'like', "%$customer%");
                });
            })
            ->get();

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Sales_Order_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.sales_order_report',
            compact('soCode', 'soDate', 'shippingDate', 'deliverDate', 'customer', 'salesOrders', 'soStatusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($soCode, $soDate, $shippingDate, $deliverDate, $customer, $salesOrders, $soStatusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($soCode, $soDate, $shippingDate, $deliverDate, $customer, $salesOrders, $soStatusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.sales_order_report',
                    compact('soCode', 'soDate', 'shippingDate', 'deliverDate', 'customer', 'salesOrders', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }
}
