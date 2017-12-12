<?php

/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 1:16 PM
 */

use Illuminate\Database\Seeder;

use App\Model\Lookup;

class LookupTableSeeder extends Seeder
{
    public function run()
    {
        $lookup = [
            [
                'code' => 'STATUS.ACTIVE',
                'description' => 'Active',
                'category' => 'STATUS',
            ],
            [
                'code' => 'STATUS.INACTIVE',
                'description' => 'Inactive',
                'category' => 'STATUS',
            ],
            [
                'code' => 'YESNOSELECT.YES',
                'description' => 'Yes',
                'category' => 'YESNOSELECT',
            ],
            [
                'code' => 'YESNOSELECT.NO',
                'description' => 'No',
                'category' => 'YESNOSELECT',
            ],
            [
                'code' => 'CURRENCY.IDR',
                'description' => 'Indonesian Rupiah',
                'category' => 'CURRENCY',
            ],
            [
                'code' => 'CURRENCY.USD',
                'description' => 'US Dollar',
                'category' => 'CURRENCY',
            ],
            [
                'code' => 'LANGUAGE.IN',
                'description' => 'Indonesian',
                'category' => 'LANGUAGE',
            ],
            [
                'code' => 'LANGUANGE.EN',
                'description' => 'English',
                'category' => 'LANGUAGE',
            ],
            [
                'code' => 'TRUCKTYPE.OIL_8T',
                'description' => 'Oil 8T',
                'category' => 'TRUCKTYPE',
            ],
            [
                'code' => 'TRUCKTYPE.CARGO_8T',
                'description' => 'Cargo 8T',
                'category' => 'TRUCKTYPE',
            ],
            [
                'code' => 'TRUCKTYPE.CARGO_25T',
                'description' => 'Cargo 25T',
                'category' => 'TRUCKTYPE',
            ],
            [
                'code' => 'POSTATUS.D',
                'description' => 'Draft',
                'category' => 'POSTATUS',
            ],
            [
                'code' => 'POSTATUS.WA',
                'description' => 'Waiting Arrival',
                'category' => 'POSTATUS',
            ],
            [
                'code' => 'POSTATUS.WP',
                'description' => 'Waiting Payment',
                'category' => 'POSTATUS',
            ],
            [
                'code' => 'POSTATUS.C',
                'description' => 'Closed',
                'category' => 'POSTATUS',
            ],
            [
                'code' => 'POSTATUS.RJT',
                'description' => 'Rejected',
                'category' => 'POSTATUS',
            ],
            [
                'code' => 'POTYPE.S',
                'description' => 'Standard PO',
                'category' => 'POTYPE',
            ],
            [
                'code' => 'CUSTOMERTYPE.R',
                'description' => 'Registered Customer',
                'category' => 'CUSTOMERTYPE',
            ],[
                'code' => 'CUSTOMERTYPE.WI',
                'description' => 'Walk In Customer',
                'category' => 'CUSTOMERTYPE',
            ],
            [
                'code' => 'SUPPLIERTYPE.R',
                'description' => 'Registered Supplier',
                'category' => 'SUPPLIERTYPE',
            ],[
                'code' => 'SUPPLIERTYPE.WI',
                'description' => 'Walk In Supplier',
                'category' => 'SUPPLIERTYPE',
            ],
            [
                'code' => 'SOTYPE.S',
                'description' => 'Standard SO',
                'category' => 'SOTYPE',
            ],
            [
                'code' => 'SOTYPE.SVC',
                'description' => 'Service Sales',
                'category' => 'SOTYPE',
            ],
            [
                'code' => 'SOTYPE.AC',
                'description' => 'Auto Cash SO',
                'category' => 'SOTYPE',
            ],
            [
                'code' => 'SOSTATUS.D',
                'description' => 'Draft',
                'category' => 'SOSTATUS',
            ],
            [
                'code' => 'SOSTATUS.WD',
                'description' => 'Awaiting For Delivery',
                'category' => 'SOSTATUS',
            ],
            [
                'code' => 'SOSTATUS.WCC',
                'description' => 'Awaiting Customer Confirmation',
                'category' => 'SOSTATUS',
            ],
            [
                'code' => 'SOSTATUS.WAPPV',
                'description' => 'Awaiting Approval',
                'category' => 'SOSTATUS',
            ],
            [
                'code' => 'SOSTATUS.WP',
                'description' => 'Awaiting For Payment',
                'category' => 'SOSTATUS',
            ],
            [
                'code' => 'SOSTATUS.C',
                'description' => 'Closed',
                'category' => 'SOSTATUS',
            ],
            [
                'code' => 'SOSTATUS.RJT',
                'description' => 'Rejected',
                'category' => 'SOSTATUS',
            ],
            [
                'code' => 'PAYMENTTYPE.C',
                'description' => 'Cash',
                'category' => 'PAYMENTTYPE',
            ],
            [
                'code' => 'PAYMENTTYPE.T',
                'description' => 'Transfer',
                'category' => 'PAYMENTTYPE',
            ],
            [
                'code' => 'PAYMENTTYPE.G',
                'description' => 'Giro',
                'category' => 'PAYMENTTYPE',
            ],
            [
                'code' => 'CASHPAYMENTSTATUS.C',
                'description' => 'Confirmed',
                'category' => 'CASHPAYMENTSTATUS',
            ],
            [
                'code' => 'TRFPAYMENTSTATUS.UNCONFIRMED',
                'description' => 'Unconfirmed',
                'category' => 'TRFPAYMENTSTATUS',
            ],
            [
                'code' => 'TRFPAYMENTSTATUS.CONFIRMED',
                'description' => 'Confirmed',
                'category' => 'TRFPAYMENTSTATUS',
            ],
            [
                'code' => 'GIROPAYMENTSTATUS.WE',
                'description' => 'Waiting Effective Date',
                'category' => 'GIROPAYMENTSTATUS',
            ],
            [
                'code' => 'PAYMENTTYPE.FR',
                'description' => 'Failed & Returned',
                'category' => 'GIROPAYMENTSTATUS',
            ],
            [
                'code' => 'TRUCKMTCTYPE.R',
                'description' => 'Regular Checkup',
                'category' => 'TRUCKMTCTYPE',
            ],
            [
                'code' => 'TRUCKMTCTYPE.TC',
                'description' => 'Tire Change',
                'category' => 'TRUCKMTCTYPE',
            ],
            [
                'code' => 'TRUCKMTCTYPE.SPC',
                'description' => 'Spare Part Change',
                'category' => 'TRUCKMTCTYPE',
            ],
            [
                'code' => 'TRUCKMTCTYPE.OC',
                'description' => 'Oil Change',
                'category' => 'TRUCKMTCTYPE',
            ],
            [
                'code' => 'USERTYPE.A',
                'description' => 'Admin',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'USERTYPE.O',
                'description' => 'Owner',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'USERTYPE.U',
                'description' => 'User',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'USERTYPE.DR',
                'description' => 'Driver',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'USERTYPE.FD',
                'description' => 'Front Desk',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'USERTYPE.FIN',
                'description' => 'Finance',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'USERTYPE.C',
                'description' => 'Customer',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'USERTYPE.S',
                'description' => 'Supplier',
                'category' => 'USERTYPE',
            ],
            [
                'code' => 'PRICELEVELTYPE.INC',
                'description' => 'Increment Value',
                'category' => 'PRICELEVELTYPE',
            ],
            [
                'code' => 'PRICELEVELTYPE.PCT',
                'description' => 'Percentage Value',
                'category' => 'PRICELEVELTYPE',
            ],
            [
                'code' => 'GIROSTATUS.N',
                'description' => 'New',
                'category' => 'GIROSTATUS',
            ],
            [
                'code' => 'GIROSTATUS.UP',
                'description' => 'Used for Payment',
                'category' => 'GIROSTATUS',
            ],
            [
                'code' => 'GIROSTATUS.R',
                'description' => 'Returned',
                'category' => 'GIROSTATUS',
            ],
            [
                'code' => 'ACCCASH.COH',
                'description' => 'Cash On Hand',
                'category' => 'ACCCASH',
            ],
            [
                'code' => 'ACCCASH.CIB',
                'description' => 'Cash In Bank',
                'category' => 'ACCCASH',
            ],
            [
                'code' => 'EXPENSETYPE.ADD',
                'description' => 'Adding value',
                'category' => 'EXPENSETYPE',
            ],
            [
                'code' => 'EXPENSETYPE.SUB',
                'description' => 'Subtracting value',
                'category' => 'EXPENSETYPE',
            ],
            [
                'code' => 'BANKUPLOAD.BCA',
                'description' => 'Bank BCA',
                'category' => 'BANKUPLOAD',
            ],
            [
                'code' => 'EMPSALARYACTION.SALARY',
                'description' => 'Salary',
                'category' => 'EMPSALARYACTION',
            ],
            [
                'code' => 'EMPSALARYACTION.SALARY_PAYMENT',
                'description' => 'Salary Payment',
                'category' => 'EMPSALARYACTION',
            ],
            [
                'code' => 'EMPSALARYACTION.BONUS',
                'description' => 'Bonus',
                'category' => 'EMPSALARYACTION',
            ],
            [
                'code' => 'EMPSALARYACTION.REIMBURSE',
                'description' => 'Reimburse',
                'category' => 'EMPSALARYACTION',
            ],
            [
                'code' => 'EMPSALARYACTION.SALARY_PAY_UPFRONT',
                'description' => 'Salary Payed Upfront',
                'category' => 'EMPSALARYACTION',
            ],
            [
                'code' => 'GSTTRANSACTIONTYPEOUTPUT.4',
                'description' => '4 - Ekspor',
                'category' => 'GSTTRANSACTIONTYPEOUTPUT',
            ],
            [
                'code' => 'GSTTRANSACTIONTYPEOUTPUT.5',
                'description' => '5 - Penyerahan Dalam Negri Dengan Faktur Pajak',
                'category' => 'GSTTRANSACTIONTYPEOUTPUT',
            ],
            [
                'code' => 'GSTTRANSACTIONTYPEOUTPUT.1',
                'description' => '1 - Impor BKP dan Pemanfaatan JKP/BKP Tidak Berwujud dari Luar Daerah Pabean',
                'category' => 'GSTTRANSACTIONTYPEINPUT',
            ],
            [
                'code' => 'GSTTRANSACTIONTYPEOUTPUT.2',
                'description' => '2 - Perolehan BKP/JKP Dari Dalam Negri',
                'category' => 'GSTTRANSACTIONTYPEINPUT',
            ],
            [
                'code' => 'GSTTRANSACTIONTYPEOUTPUT.3',
                'description' => '3 - Pajak Masukan Yang Tidak Dapat Dikreditkan dan/atau Pajak Masukan dan PPnBM yang atas impor atau perolehannya mendapat fasilitas',
                'category' => 'GSTTRANSACTIONTYPEINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.01',
                'description' => '1 - Kepada Pihak yang Bukan Pemungut PPN',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.02',
                'description' => '2 - Kepada Pemungut Bendaharawan',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.03',
                'description' => '3 - Kepada Pemungut Selain Bendaharawan',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.04',
                'description' => '4 - Dasar Pengenaan Pajak (DPP) Nilai Lain',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.06',
                'description' => '6 - Penyerahan Lainnya',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.07',
                'description' => '7 - Penyerahan yang PPN-nya Tidak Dipungut',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.08',
                'description' => '8 - Penyerahan yang PPN-nya Dibebaskan',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILOUTPUT.09',
                'description' => '9 - Penyerahan Aktiva (Pasal 16D UU PPN)',
                'category' => 'TRANSACTIONDETAILOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.01',
                'description' => '1 - Kepada Pihak yang Bukan Pemungut PPN',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.02',
                'description' => '1 - Kepada Pihak yang Bukan Pemungut PPN',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.03',
                'description' => '2 - Kepada Pemungut Bendaharawan',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.04',
                'description' => '3 - Kepada Pemungut Selain Bendaharawan',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.05',
                'description' => '4 - Dasar Pengenaan Pajak (DPP) Nilai Lain',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.06',
                'description' => '6 - Penyerahan Lainnya',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.07',
                'description' => '7 - Penyerahan yang PPN-nya Tidak Dipungut',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.08',
                'description' => '8 - Penyerahan yang PPN-nya Dibebaskan',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.09',
                'description' => '9 - Penyerahan Aktiva (Pasal 16D UU PPN)',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.10',
                'description' => '10 - Impor Barang Kena Pajak (BKP)',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.11',
                'description' => '11 - Pemanfaatan Barang Kena Pajak (BKP) Tidak Berwujud',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDETAILINPUT.12',
                'description' => '12 - Pemanfaatan Jasa Kena Pajak (JKP)',
                'category' => 'TRANSACTIONDETAILINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCOUTPUT.1',
                'description' => '1 - Faktur Pajak',
                'category' => 'TRANSACTIONDOCOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCOUTPUT.2',
                'description' => '2 - Faktur Pajak Pengganti',
                'category' => 'TRANSACTIONDOCOUTPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.1',
                'description' => '1 - Faktur Pajak',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.2',
                'description' => '2 - PIB dan SSP',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.3',
                'description' => '3 - Surat Setoran Pajak',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.4',
                'description' => '4 - Nota Retur / Nota Pembatalan',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.5',
                'description' => '5 - Dokumen yang Dipersamakan dengan Faktur Pajak',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.6',
                'description' => '6 - Faktur Pajak Batal',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.7',
                'description' => '7 - Faktur Pajak Pengganti ',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'TRANSACTIONDOCINPUT.8',
                'description' => '8 - pemberitahuan impor barang (PIB)',
                'category' => 'TRANSACTIONDOCINPUT',
            ],
            [
                'code' => 'STOCKMERGETYPE.FIFO',
                'description' => 'Stock Merge Type FIFO',
                'category' => 'STOCKMERGETYPE',
            ],
            [
                'code' => 'STOCKMERGETYPE.LIFO',
                'description' => 'Stock Merge Type LIFO',
                'category' => 'STOCKMERGETYPE',
            ],
            [
                'code' => 'STOCKMERGETYPE.AVG',
                'description' => 'Stock Merge Type AVG',
                'category' => 'STOCKMERGETYPE',
            ],

        ];
        foreach ($lookup as $key => $value) {
            if (count(Lookup::whereCode($value['code'])->get()) == 0) {
                Lookup::create($value);
            }
        }
    }
}