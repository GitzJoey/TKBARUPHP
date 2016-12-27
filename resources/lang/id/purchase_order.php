<?php 

return [
    'copy' => [
        'create' => [
            'title' => 'Duplikat Pembelian',
            'page_title' => 'Duplikat Pembelian',
            'page_title_desc' => '',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'transaction_summary' => 'Transaksi',
                'remarks' => 'Keterangan',
                'po_copy_remarks' => 'Keterangan Duplikat',
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
        'edit' => [
            'title' => 'Revisi Pembelian',
            'page_title' => 'Revisi Pembelian',
            'page_title_desc' => '',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'transaction_summary' => 'Transaksi',
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
            'title' => 'Revisi Pembelian',
            'page_title' => 'Revisi Pembelian',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Cari',
                'title' => 'Revisi Pembelian',
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
            'title' => 'Cari',
            'page_title' => 'Cari',
            'page_title_desc' => 'Cari',
            'header' => [
                'search' => 'Cari',
            ],
            'so_not_found' => '',
        ],
    ],
    'revise' => [
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
                ],
            ],
        ],
        'index' => [
            'title' => 'Revisi Pembelian',
            'page_title' => 'Revisi Pembelian',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Revisi Pembelian',
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
        'title' => 'Pembelian',
        'page_title' => 'Pembelian',
        'page_title_desc' => '',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Detail',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'expenses' => 'Biaya',
            'transaction_summary' => 'Transaksi',
            'remarks' => 'Keterangan',
        ],
        'field' => [
            'supplier_type' => 'Tipe',
            'supplier_name' => 'Nama',
            'supplier_details' => 'Detail',
            'po_code' => 'Kode Pembelian',
            'po_type' => 'Tipe',
            'po_date' => 'Tgl Pembelian',
            'po_status' => 'Status',
            'shipping_date' => 'tgl Pengiriman',
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
            'purchase_order_detail' => 'Detail',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'expenses' => 'Biaya',
            'transaction_summary' => 'Transaksi',
            'remarks' => 'Keterangan',
        ],
        'field' => [
            'supplier_type' => 'tipe',
            'supplier_name' => 'Nama',
            'supplier_details' => 'Detail',
            'po_code' => 'Kode Pembelian',
            'po_type' => 'Tipe',
            'po_date' => 'Tgl Pembelian',
            'po_status' => 'Status',
            'shipping_date' => 'Tgl Pengiriman',
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
        ],
    ],
    'payment' => [
        'cash' => [
            'title' => 'Pembayaran',
            'page_title' => 'Pembayaran',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran',
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
                'title' => 'Pembayaran',
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
                'purchase_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'expenses' => 'Biaya',
                'transaction_summary' => 'Transaksi',
                'remarks' => 'Keterangan',
                'payment_history' => 'Catatan Pembayaran',
            ],
            'field' => [
                'supplier_type' => 'Tipe',
                'supplier_name' => 'Nama',
                'supplier_details' => 'Detail',
                'po_code' => 'Kode Pembelian',
                'po_type' => 'Tipe',
                'po_date' => 'Tgl Pembelian',
                'po_status' => 'Status',
                'shipping_date' => 'Tgl Kirim',
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