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
                    'total' => 'Total',
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
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'box' => [
            'supplier' => '',
            'purchase_order_detail' => '',
            'shipping' => '',
            'transactions' => '',
            'remarks' => '',
        ],
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
                ],
            ],
        ],
    ],
];