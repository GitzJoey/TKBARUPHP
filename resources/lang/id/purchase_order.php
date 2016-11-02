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
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'box' => [
            'po_detail' => '',
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