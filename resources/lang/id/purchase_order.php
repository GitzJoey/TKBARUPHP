<?php 

return [
    'create' => [
        'title' => 'Pembelian',
        'page_title' => 'Pembelian',
        'page_title_desc' => 'Buat pembelian baru',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Detil Pembelian',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'remarks' => 'Catatan',
        ],
        'field' => [
            'supplier_type' => 'Tipe',
            'supplier_name' => 'Nama',
            'supplier_details' => 'Detil',
            'shipping_date' => 'Tanggal Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Penyedia Angkutan',
        ],
        'po_code' => 'Kode',
        'po_type' => 'Tipe',
        'po_date' => 'Tanggal',
        'po_status' => 'Status',
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
    'payment' => [
        'index' => [
            'title' => 'Pembayaran Pembelian',
            'page_title' => 'Pembayaran Pembelian',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Pembelian',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal Dibuat',
                    'supplier' => 'Supplier',
                    'total' => 'Total',
                    'paid' => 'Bayar',
                    'rest' => 'Kurang',
                ],
            ],
        ],
        'cash' => [
            'field' => [
                'supplier_type' => 'Tipe',
                'supplier_name' => 'Nama',
                'supplier_details' => 'Detail',
                'shipping_date' => 'Tanggal',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Penyedia Angkutan',
                'payment_type' => 'Tipe Pembayaran',
                'payment_date' => 'Tanggal Pembayaran',
                'payment_amount' => 'Jumlah Pembayaran',
            ],
            'po_code' => 'Kode',
            'po_type' => 'Tipe',
            'po_date' => 'Tanggal',
            'po_status' => 'Status',
            'title' => 'Pembayaran Tunai Pembelian',
            'page_title' => 'Pembayaran Tunai Pembelian',
            'page_title_desc' => 'Buat pembayaran tunai untuk pembelian',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Detail',
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
                'supplier_type' => 'Tipe',
                'supplier_name' => 'Nama',
                'supplier_details' => 'Detail',
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
            'po_code' => 'Kode',
            'po_type' => 'Tipe',
            'po_date' => 'Tanggal',
            'po_status' => 'Status',
            'title' => 'Pembayaran Transfer Pembelian',
            'page_title' => 'Pembayaran Transfer Pembelian',
            'page_title_desc' => 'Buat pembayaran transfer untuk pembelian',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Detail',
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
                'supplier' => '',
                'purchase_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'payment_history' => '',
            ],
            'field' => [
                'payment_type' => '',
                'giro' => '',
                'label' => [
                    'new_giro' => '',
                ],
                'bank' => '',
                'serial_number' => '',
                'payment_date' => '',
                'effective_date' => '',
                'payment_amount' => '',
                'printed_name' => '',
                'remarks' => '',
                'supplier_type' => '',
                'supplier_name' => '',
                'supplier_details' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
            ],
            'po_code' => '',
            'po_type' => '',
            'po_date' => '',
            'po_status' => '',
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
    'revise' => [
        'field' => [
            'supplier_type' => 'Tipe',
            'supplier_name' => 'Nama',
            'supplier_details' => 'Detail',
            'shipping_date' => 'Tanggal',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Penyedia Angkutan',
        ],
        'po_code' => 'Code',
        'po_type' => 'Tipe',
        'po_date' => 'Tanggal',
        'po_status' => 'Status',
        'title' => 'Revisi',
        'page_title' => 'Revisi',
        'page_title_desc' => 'Revisi pembelian',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Detail',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'remarks' => 'Catatan',
        ],
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Product',
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
        'index' => [
            'title' => 'Revisi Pembelian',
            'page_title' => 'Revisi Pembelian',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Pembelian',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal Dibuat',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Tanggal Pengiriman',
                    'status' => 'Status',
                ],
            ],
        ],
    ],
];