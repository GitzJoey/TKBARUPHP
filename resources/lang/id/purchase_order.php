<?php 

return [
    'copy' => [
        'create' => [
            'title' => 'Duplikat Pembelian',
            'page_title' => 'Duplikat Pembelian',
            'page_title_desc' => '',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Detail Pembelian',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'transaction_summary' => 'Rangkuman Transaksi',
                'discount_transaction' => 'Diskon Transaksi',
                'remarks' => 'Keterangan',
                'po_copy_remarks' => 'Keterangan Duplikat',
                'expenses' => 'Biaya',
                'discount_per_item' => 'Diskon Per Item',
            ],
            'field' => [
                'supplier_type' => 'Tipe',
                'supplier_name' => 'Nama',
                'supplier_details' => 'Detil',
                'po_code' => 'Kode',
                'po_copy_code' => 'Duplikat',
                'po_type' => 'Tipe',
                'po_date' => 'Tanggal PO',
                'shipping_date' => 'Tgl Pengiriman',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
                'po_status' => 'Status',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'quantity' => 'Quantity',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                        'discount_percent' => 'Diskon %',
                        'discount_nominal' => 'Diskon Nominal',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                        'sub_total_discount' => 'Sub Total Diskon',
                        'total_discount' => 'Total Diskon',
                        'invoice_discount' => 'Diskon Invoice',
                        'total_transaction' => 'Total Transaksi',
                    ],
                ],
            ],
        ],
        'edit' => [
            'title' => 'Duplikat Pembelian',
            'page_title' => 'Duplikat Pembelian',
            'page_title_desc' => '',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Detail Pembelian',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'transaction_summary' => 'Rangkuman Transaksi',
                'remarks' => 'Keterangan',
                'po_copy_remarks' => 'Duplikat Keterangan',
                'expenses' => 'Biaya',
            ],
            'field' => [
                'supplier_type' => 'Tipe',
                'supplier_name' => 'Nama',
                'supplier_details' => 'Detail',
                'po_code' => 'Kode Pembelian',
                'po_copy_code' => 'Kode Duplikat',
                'po_type' => 'Tipe',
                'po_date' => 'Tgl Pembelian',
                'shipping_date' => 'Tgl Pengiriman',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
                'po_status' => 'Status',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'quantity' => 'Quantity',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => 'Duplikat Pembelian',
            'page_title' => 'Duplikat Pembelian',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Cari Kode Pembelian',
                'title' => 'Duplikat Pembelian',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Tgl Pengiriman',
                ],
            ],
            'po_not_found' => 'Kode Pembelian Tidak Ditemukan',
        ],
        'search' => [
            'po_not_found' => 'Kode Pembelian Tidak Ditemukan',
            'title' => 'Duplikat Pembelian',
            'page_title' => 'Duplikat Pembelian',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Cari Kode Pembelian',
            ],
        ],
    ],
    'revise' => [
        'tab' => [
            'remarks' => 'Keterangan',
            'internal' => 'Internal',
            'private' => 'Privat',
        ],
        'table' => [
            'item' => [
                'header' => [
                    'total_price' => 'Total Harga',
                    'product_name' => 'Produk',
                    'quantity' => 'Quantity',
                    'unit' => 'Satuan',
                    'price_unit' => 'Harga',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => 'Nama',
                    'type' => 'Tipe',
                    'remarks' => 'Keterangan',
                    'amount' => 'Jumlah',
                    'internal_expense' => '',
                ],
            ],
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => 'Persentase',
                    'value' => 'Nilai',
                    'total_discount' => 'Diskon',
                ],
                'body' => [
                    'total_discount_desc' => 'Total Diskon',
                ],
            ],
        ],
        'index' => [
            'title' => 'Revisi Pembelian',
            'page_title' => 'Revisi Pembelian',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Revisi Pembelian',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode Pembelian',
                    'po_date' => 'Tgl Pembelian',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Tgl Kirim',
                    'status' => 'Status',
                ],
            ],
        ],
        'title' => 'Revisi Pembelian',
        'page_title' => 'Revisi Pembelian',
        'page_title_desc' => '',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Detail Pembelian',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'expenses' => 'Biaya',
            'transaction_summary' => 'Rangkuman Transaksi',
            'remarks' => 'Keterangan',
            'total_discount' => 'Diskon',
        ],
        'field' => [
            'supplier_type' => 'Tipe',
            'supplier_name' => 'Nama',
            'supplier_details' => 'Detail',
            'po_code' => 'Kode',
            'po_type' => 'Tipe',
            'po_date' => 'Tanggal PO',
            'po_status' => 'Status',
            'shipping_date' => 'Tgl Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Layanan Angkutan',
        ],
    ],
    'create' => [
        'title' => 'Pembelian',
        'page_title' => 'Pembelian',
        'page_title_desc' => '',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Detail Pembelian',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'transaction_summary' => 'Rangkuman Transaksi',
            'discount_transaction' => 'Diskon Transaksi',
            'remarks' => 'Keterangan',
            'po_copy_remarks' => 'Keterangan Duplikat',
            'expenses' => 'Biaya',
            'discount_per_item' => 'Diskon Per Item',
            'total_discount' => '',
        ],
        'field' => [
            'supplier_type' => 'Tipe',
            'supplier_name' => 'Nama',
            'supplier_details' => 'Detil',
            'po_code' => 'Kode',
            'po_copy_code' => 'Duplikat',
            'po_type' => 'Tipe',
            'po_date' => 'Tanggal PO',
            'shipping_date' => 'Tgl Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Layanan Angkutan',
            'po_status' => 'Status',
        ],
        'tab' => [
            'remarks' => 'Keterangan',
            'internal' => 'Internal',
            'private' => 'Privat',
        ],
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Produk',
                    'quantity' => 'Quantity',
                    'unit' => 'Satuan',
                    'price_unit' => 'Harga',
                    'total_price' => 'Total Harga',
                    'discount_percent' => 'Diskon %',
                    'discount_nominal' => 'Diskon Nominal',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total',
                    'sub_total_discount' => 'Sub Total Diskon',
                    'total_discount' => 'Total Diskon',
                    'invoice_discount' => 'Diskon Invoice',
                    'total_transaction' => 'Total Transaksi',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => 'Nama',
                    'type' => 'Tipe',
                    'remarks' => 'Keterangan',
                    'amount' => 'Jumlah',
                    'internal_expense' => 'Internal',
                ],
            ],
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => 'Persentase',
                    'value' => 'Nilai',
                    'total_discount' => 'Total Diskon',
                ],
                'body' => [
                    'total_discount_desc' => 'Total Diskon',
                ],
            ],
        ],
    ],
    'payment' => [
        'cash' => [
            'title' => 'Pembayaran Tunai',
            'page_title' => 'Pembayaran Tunai',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran Tunai',
            ],
            'field' => [
                'payment_type' => 'Tipe',
                'payment_date' => 'Tgl Pembayaran',
                'payment_amount' => 'Total Bayar',
            ],
        ],
        'giro' => [
            'title' => 'Pembayaran Giro',
            'page_title' => 'Pembayaran Giro',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran Giro',
            ],
            'field' => [
                'payment_type' => 'Tipe',
                'giro' => 'Giro',
                'bank' => 'Bank',
                'serial_number' => 'Nomor Seri',
                'payment_date' => 'Tgl Pembayaran',
                'effective_date' => 'Tgl Efektif',
                'payment_amount' => 'Jumlah',
                'printed_name' => 'Nama Tertera',
                'remarks' => 'Keterangan',
            ],
        ],
        'index' => [
            'title' => 'Pembayaran',
            'page_title' => 'Pembayaran',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Pembayaran',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'supplier' => 'Supplier',
                    'po_date' => 'Tgl Pembayaran',
                    'total' => 'Total',
                    'paid' => 'Pembayaran',
                    'rest' => 'Kurang Bayar',
                ],
            ],
        ],
        'summary' => [
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Detail Pembelian',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'expenses' => 'Biaya',
                'transaction_summary' => 'Rangkuman Transaksi',
                'remarks' => 'Keterangan',
                'payment_history' => 'Catatan Pembayaran',
                'total_discount' => 'Diskon',
            ],
            'field' => [
                'supplier_type' => 'Tipe',
                'supplier_name' => 'Nama',
                'supplier_details' => 'Detail',
                'po_code' => 'Kode',
                'po_type' => 'Tipe',
                'po_date' => 'Tanggal PO',
                'po_status' => 'Status',
                'shipping_date' => 'Tanggal Kirim',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'quantity' => 'Quantity',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                        'paid_amount' => 'Total Pembayaran',
                        'to_be_paid_amount' => 'Kurang Bayar',
                    ],
                ],
                'expense' => [
                    'header' => [
                        'name' => 'Nama',
                        'type' => 'Tipe',
                        'remarks' => 'Keterangan',
                        'amount' => 'Jumlah',
                        'internal_expense' => '',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => 'Pembayaran Tunai',
                        'payment_date' => 'Tgl Pembayaran',
                        'payment_status' => 'Status',
                        'payment_amount' => 'Jumlah',
                        'transfer' => 'Pembayaran Transfer',
                        'effective_date' => 'Tgl Efektif',
                        'account_from' => 'Dari Akun',
                        'account_to' => 'Ke Akun',
                        'giro' => 'Giro',
                        'bank' => 'Bank',
                        'serial_number' => 'Nomor Seri',
                        'printed_name' => 'Nama Tertera',
                    ],
                ],
                'total_discount' => [
                    'header' => [
                        'total_discount_desc' => '',
                        'percentage' => 'Persentase',
                        'value' => 'Nilai',
                        'total_discount' => 'Diskon',
                    ],
                    'body' => [
                        'total_discount_desc' => 'Total Diskon',
                    ],
                ],
            ],
        ],
        'transfer' => [
            'title' => 'Pembayaran Transfer',
            'page_title' => 'Pembayaran Transfer',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran Transfer',
            ],
            'field' => [
                'payment_type' => 'Tipe',
                'bank_from' => 'Dari Bank',
                'bank_to' => 'Ke Bank',
                'payment_date' => 'Tgl Pembayaran',
                'effective_date' => 'Tgl Efektif',
                'payment_amount' => 'Jumlah',
            ],
        ],
        'box' => [
            'total_discount' => '',
        ],
        'table' => [
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => '',
                    'value' => '',
                    'total_discount' => '',
                ],
                'body' => [
                    'total_discount_desc' => '',
                ],
            ],
        ],
    ],
    'partial' => [
        'supplier' => [
            'title' => '',
            'tab' => [
                'supplier' => 'Supplier Data',
                'pic' => 'Penanggungjawab',
                'bank_account' => 'Akun Bank',
                'product' => 'Produk',
                'expenses' => 'Biaya',
                'settings' => 'Setting',
            ],
            'field' => [
                'name' => 'Nama',
                'address' => 'Alamat',
                'city' => 'Kota',
                'phone' => 'Telepon',
                'tax_id' => 'NPWP No',
                'remarks' => 'Keterangan',
                'first_name' => 'Nama Depan',
                'last_name' => 'Nama Belakang',
                'ic_num' => 'KTP No.',
                'phone_number' => 'No Telepon',
                'payment_due_day' => 'Tenggat Pembayaran',
            ],
            'table_phone' => [
                'header' => [
                    'provider' => 'Provider',
                    'number' => 'Nomor',
                    'remarks' => 'Keterangan',
                ],
            ],
            'table_bank' => [
                'header' => [
                    'bank' => 'Bank',
                    'account_number' => 'Nomor Akun',
                    'remarks' => 'Keterangan',
                ],
            ],
            'table_prod' => [
                'header' => [
                    'type' => 'Tipe',
                    'name' => 'Nama',
                    'short_code' => 'Kode Singkat',
                    'description' => 'Keterangan',
                    'remarks' => 'Catatan',
                ],
            ],
            'table_expense' => [
                'header' => [
                    'name' => 'Nama',
                    'type' => 'Tipe',
                    'amount' => 'Jumlah',
                    'remarks' => 'Keterangan',
                ],
            ],
        ],
    ],
];