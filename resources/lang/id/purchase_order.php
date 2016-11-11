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
                'title' => 'Daftar Pembelian'
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal Dibuat',
                    'supplier' => 'Supplier',
                    'total' => 'Total',
                    'paid' => 'Bayar',
                    'rest' => 'Kurang'
                ]
            ]
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
                'payment_amount' => 'Jumlah Pembayaran'
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
                'payment' => 'Pembayaran'
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'header' => [
                            'quantity' => 'Jumlah'
                        ],
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga Satuan',
                        'total_price' => 'Total Harga'
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Jumlah Total',
                        'paid_amount' => 'Total',
                        'to_be_paid_amount' => 'Kurang'
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => 'Tipe Pembayaran',
                        'payment_date' => 'Tanggal Pembayaran',
                        'payment_amount' => 'Jumlah Pembayaran',
                        'payment_status' => 'Status Pembayaran'
                    ]
                ]
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
                'effective_date' => 'Tanggal Efektif'
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
                'payment' => 'Pembayaran'
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'header' => [
                            'quantity' => 'Jumlah'
                        ],
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga Satuan',
                        'total_price' => 'Total Harga'
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Jumlah Total',
                        'paid_amount' => 'Total',
                        'to_be_paid_amount' => 'Kurang'
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => 'Tipe Pembayaran',
                        'payment_date' => 'Tanggal Pembayaran',
                        'payment_amount' => 'Jumlah Pembayaran',
                        'payment_status' => 'Status Pembayaran'
                    ]
                ]
            ],
        ]
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
                'title' => 'Daftar Pembelian'
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal Dibuat',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Tanggal Pengiriman',
                    'status' => 'Status'
                ]
            ]
        ]
    ],
];