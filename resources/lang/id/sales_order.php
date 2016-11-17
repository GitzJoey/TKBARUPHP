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
            'remarks' => 'Catatan',
            'customer' => 'Pelanggan',
            'purchase_order_detail' => '',
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
                    'header' => [
                        'quantity' => 'Jumlah',
                    ],
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
                    'header' => [
                        'quantity' => 'Jumlah',
                    ],
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
                    'customer' => '',
                    'so_date' => '',
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
                        'header' => [
                            'quantity' => 'Jumlah',
                        ],
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
                        'bank' => '',
                        'serial_number' => '',
                        'printed_name' => '',
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
                        'header' => [
                            'quantity' => 'Jumlah',
                        ],
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
                        'header' => [
                            'quantity' => '',
                        ],
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
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
];