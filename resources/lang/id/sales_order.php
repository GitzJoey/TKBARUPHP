<?php 

return [
    'payment' => [
        'giro' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'payment_history' => '',
            ],
            'field' => [
                'payment_type' => '',
                'bank' => '',
                'serial_number' => '',
                'payment_date' => '',
                'effective_date' => '',
                'payment_amount' => '',
                'printed_name' => '',
                'remarks' => '',
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
            ],
            'so_code' => '',
            'so_type' => '',
            'so_date' => '',
            'so_status' => '',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
                        'quantity' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                        'paid_amount' => '',
                        'to_be_paid_amount' => '',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => '',
                        'payment_date' => '',
                        'payment_amount' => '',
                        'payment_status' => '',
                    ],
                ],
            ],
        ],
        'cash' => [
            'title' => 'Pembayaran Tunai',
            'page_title' => 'Pembayaran Tunai',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran',
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail Penjualan',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Keterangan',
                'payment_history' => 'Catatan Pembayaran',
            ],
            'field' => [
                'payment_type' => 'Tipe',
                'payment_date' => 'Tanggal',
                'payment_amount' => 'Jumlah',
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'shipping_date' => 'Tanggal Kirim',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
            ],
            'so_code' => 'Kode',
            'so_type' => 'Tipe',
            'so_date' => 'Tanggal',
            'so_status' => 'Status',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'quantity' => 'Jumlah',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                        'paid_amount' => 'Total Bayar',
                        'to_be_paid_amount' => 'Kurang Bayar',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => 'Pembayaran Tunai',
                        'payment_date' => 'Tanggal',
                        'payment_status' => 'Status',
                        'payment_amount' => 'Jumlah',
                        'transfer' => 'Pembayaran Transfer',
                        'effective_date' => 'Tanggal Efektif',
                        'account_from' => 'Dari Akun',
                        'account_to' => 'Ke Akun',
                        'giro' => 'Pembayaran Giro',
                        'bank' => 'Bank',
                        'serial_number' => 'Nomor Seri',
                        'printed_name' => 'Nama Tertera',
                        'payment_type' => 'Tipe Pembayaran',
                    ],
                ],
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
                    'customer' => 'Pelanggan',
                    'so_date' => 'Tanggal',
                    'total' => 'Total',
                    'paid' => 'Pembayaran',
                    'rest' => 'Sisa Pembayaran',
                    'po_date' => '',
                    'supplier' => '',
                ],
            ],
        ],
        'transfer' => [
            'title' => 'Pembayaran Transfer',
            'page_title' => 'Pembayaran Transfer',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran Transfer',
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Keterangan',
                'payment_history' => 'Catatan Pembayaran',
            ],
            'field' => [
                'payment_type' => 'Tipe',
                'bank_from' => 'Dari Bank',
                'bank_to' => 'Ke Bank',
                'payment_date' => 'Tgl Bayar',
                'effective_date' => 'Tgl Efektif',
                'payment_amount' => 'Jumlah',
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'shipping_date' => 'Pengiriman',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
            ],
            'so_code' => 'Kode',
            'so_type' => 'Tipe',
            'so_date' => 'Tanggal',
            'so_status' => 'Status',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                        'quantity' => 'Jumlah',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                        'paid_amount' => '',
                        'to_be_paid_amount' => '',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => '',
                        'payment_date' => '',
                        'payment_amount' => '',
                        'payment_status' => '',
                    ],
                ],
            ],
        ],
    ],
    'copy' => [
        'create' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'so_copy_remarks' => '',
                'transaction_summary' => '',
            ],
            'field' => [
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'so_code' => '',
                'so_copy_code' => '',
                'so_type' => '',
                'so_date' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
                'so_status' => '',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'quantity' => '',
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                    ],
                ],
            ],
        ],
        'edit' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'so_copy_remarks' => '',
                'transaction_summary' => '',
            ],
            'field' => [
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'so_code' => '',
                'so_copy_code' => '',
                'so_type' => '',
                'so_date' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
                'so_status' => '',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'quantity' => '',
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'search' => '',
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'code' => '',
                    'so_date' => '',
                    'customer' => '',
                    'shipping_date' => '',
                ],
            ],
            'po_not_found' => '',
        ],
        'search' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'so_not_found' => '',
            'header' => [
                'search' => '',
            ],
        ],
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'header' => [
            'title' => '',
        ],
        'table' => [
            'header' => [
                'copy_code' => '',
                'remarks' => '',
            ],
        ],
    ],
    'create' => [
        'box' => [
            'transaction_summary' => 'Transaksi',
            'customer' => 'Pelanggan',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'expenses' => 'Biaya',
            'remarks' => 'Keterangan',
            'sales_order_detail' => 'Detail Penjualan',
        ],
        'title' => 'Penjualan',
        'page_title' => 'Penjualan',
        'page_title_desc' => '',
        'field' => [
            'customer_type' => 'Tipe',
            'customer_name' => 'Nama',
            'customer_details' => 'Detail',
            'shipping_date' => 'Tgl Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Layanan Angkutan',
        ],
        'so_code' => 'Kode',
        'so_type' => 'Tipe',
        'so_date' => 'Tanggal SO',
        'so_status' => 'Status',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Nama Produk',
                    'quantity' => 'Jumlah',
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
        'tab' => [
            'sales' => 'Penjualan',
        ],
    ],
    'edit' => [
        'box' => [
            'transaction_summary' => '',
        ],
    ],
    'field' => [
        'so_code' => '',
    ],
    'revise' => [
        'index' => [
            'title' => 'Revisi Penjualan',
            'page_title' => 'Revisi Penjualan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Revisi Penjualan',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'so_date' => 'Tgl Penjualan',
                    'customer' => 'Pelanggan',
                    'shipping_date' => 'Tgl Kirim',
                    'status' => 'Status',
                ],
            ],
        ],
        'title' => 'Revisi Penjualan',
        'page_title' => 'Revisi Penjualan',
        'page_title_desc' => '',
        'box' => [
            'customer' => 'Pelanggan',
            'sales_order_detail' => 'Detail',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'expenses' => 'Biaya',
            'remarks' => 'Keterangan',
        ],
        'field' => [
            'customer_type' => 'Tipe',
            'customer_name' => 'Nama',
            'customer_details' => 'Detail',
            'shipping_date' => 'Tanggal Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Layanan Angkutan',
        ],
        'so_code' => 'Kode',
        'so_type' => 'Tipe',
        'so_date' => 'Tgl Penjualan',
        'so_status' => 'Status',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Nama Produk',
                    'quantity' => 'Jumlah',
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
                ],
            ],
        ],
    ],
];