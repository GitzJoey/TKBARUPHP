<?php 

return [
    'create' => [
        'title' => 'Penjualan',
        'page_title' => 'Penjualan',
        'page_title_desc' => 'Buat penjualan baru',
        'tab' => [
            'sales' => 'Penjualan',
        ],
        'box' => [
            'supplier' => 'Supplier',
            'sales_order_detail' => 'Detail',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'transaction_summary' => 'Total Transaksi',
            'remarks' => 'Catatan',
            'customer' => 'Pelanggan',
            'purchase_order_detail' => '',
            'expenses' => '',
        ],
        'field' => [
            'customer_type' => 'Tipe',
            'customer_name' => 'Nama',
            'customer_details' => 'Detail',
            'shipping_date' => 'Tanggal Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Penyedia Angkutan',
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
                    'price_unit' => 'Harga Satuan',
                    'total_price' => 'Total Harga',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Jumlah Total',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => '',
                    'type' => '',
                    'remarks' => '',
                    'amount' => '',
                ],
            ],
        ],
    ],
    'revise' => [
        'title' => 'Revisi Penjualan',
        'page_title' => 'Revisi Penjualan',
        'page_title_desc' => '',
        'box' => [
            'customer' => 'Pelanggan',
            'sales_order_detail' => 'Detail',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'remarks' => 'Catatan',
        ],
        'field' => [
            'customer_type' => 'Tipe Pelanggan',
            'customer_name' => 'Nama',
            'customer_details' => 'Detail',
            'shipping_date' => 'Tanggal Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Penyedia Angkutan',
        ],
        'so_code' => 'Kode',
        'so_type' => 'Tipe Penjualan',
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
                    'total' => 'Jumlah Total',
                ],
            ],
        ],
        'index' => [
            'title' => 'Revisi Penjualan',
            'page_title' => 'Revisi Penjualan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Penjualan',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'so_date' => 'Tanggal Dibuat',
                    'customer' => 'Pelanggan',
                    'shipping_date' => 'Tanggal Pengiriman',
                    'status' => 'Status',
                ],
            ],
        ],
    ],
    'payment' => [
        'index' => [
            'title' => 'Pembayaran Penjualan',
            'page_title' => 'Pembayaran Penjualan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Penjualan',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal Dibuat',
                    'supplier' => 'Pelanggan',
                    'total' => 'Total',
                    'paid' => 'Bayar',
                    'rest' => 'Kurang',
                    'customer' => 'Pelanggan',
                    'so_date' => 'Tanggal',
                ],
            ],
        ],
        'cash' => [
            'field' => [
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'shipping_date' => 'Tanggal',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Penyedia Angkutan',
                'payment_type' => 'Tipe Pembayaran',
                'payment_date' => 'Tanggal Pembayaran',
                'payment_amount' => 'Jumlah Pembayaran',
            ],
            'so_code' => 'Kode',
            'so_type' => 'Tipe',
            'so_date' => 'Tanggal',
            'so_status' => 'Status',
            'title' => 'Pembayaran Tunai Penjualan',
            'page_title' => 'Pembayaran Tunai Penjualan',
            'page_title_desc' => 'Buat pembayaran tunai untuk penjualan',
            'box' => [
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Catatan',
                'payment_history' => 'Catatan Pembayaran',
                'payment' => 'Pembayaran',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'quantity' => '',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga Satuan',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Jumlah Total',
                        'paid_amount' => 'Total',
                        'to_be_paid_amount' => 'Kurang',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => 'Tipe Pembayaran',
                        'payment_date' => 'Tanggal Pembayaran',
                        'payment_amount' => 'Jumlah Pembayaran',
                        'payment_status' => 'Status Pembayaran',
                        'effective_date' => 'Tanggal Efektif',
                        'account_from' => 'Rekening Pengirim',
                        'account_to' => 'Rekening Tujuan',
                        'cash' => 'Tunai',
                        'transfer' => 'Transfer',
                        'giro' => 'Giro',
                        'bank' => 'Bank',
                        'serial_number' => 'Nomor Seri',
                        'printed_name' => 'Nama Tertulis',
                    ],
                ],
            ],
        ],
        'transfer' => [
            'field' => [
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'shipping_date' => 'Tanggal',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Penyedia Angkutan',
                'payment_type' => 'Tipe Pembayaran',
                'payment_date' => 'Tanggal Pembayaran',
                'payment_amount' => 'Jumlah Pembayaran',
                'effective_date' => 'Tanggal Efektif',
                'bank_from' => 'Bank Asal',
                'bank_to' => 'Bank Tujuan',
            ],
            'so_code' => 'Kode',
            'so_type' => 'Tipe',
            'so_date' => 'Tanggal',
            'so_status' => 'Status',
            'title' => 'Pembayaran Transfer Penjualan',
            'page_title' => 'Pembayaran Transfer Penjualan',
            'page_title_desc' => 'Buat pembayaran transfer untuk penjualan',
            'box' => [
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Catatan',
                'payment_history' => 'Catatan Pembayaran',
                'payment' => 'Pembayaran',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'quantity' => 'Jumlah',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga Satuan',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Jumlah Total',
                        'paid_amount' => 'Total',
                        'to_be_paid_amount' => 'Kurang',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => 'Tipe Pembayaran',
                        'payment_date' => 'Tanggal Pembayaran',
                        'payment_amount' => 'Jumlah Pembayaran',
                        'payment_status' => 'Status Pembayaran',
                    ],
                ],
            ],
        ],
        'giro' => [
            'title' => 'Pembayaran Giro Penjualan',
            'page_title' => 'Pembayaran Giro Penjualan',
            'page_title_desc' => 'Buat pembayaran giro untuk penjualan',
            'box' => [
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Catatan',
                'payment_history' => 'Catatan Pembayaran',
                'payment' => 'Pembayaran',
            ],
            'field' => [
                'payment_type' => 'Tipe Pembayaran',
                'bank' => 'Bank',
                'serial_number' => 'Nomor Seri',
                'payment_date' => 'Tanggal Pembayaran',
                'effective_date' => 'Tanggal Efektif',
                'payment_amount' => 'Jumlah Pembayaran',
                'printed_name' => 'Nama Tertulis',
                'remarks' => 'Catatan',
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'shipping_date' => 'Tanggal Pengiriman',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Penyedia Angkutan',
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
                        'price_unit' => 'Harga Satuan',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Jumlah Total',
                        'paid_amount' => 'Total',
                        'to_be_paid_amount' => 'Kurang',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => 'Tipe Pembayaran',
                        'payment_date' => 'Tanggal Pembayaran',
                        'payment_amount' => 'Jumlah Pembayaran',
                        'payment_status' => 'Status Pembayaran',
                    ],
                ],
            ],
        ],
    ],
    'copy' => [
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
    'field' => [
        'so_code' => '',
    ],
];