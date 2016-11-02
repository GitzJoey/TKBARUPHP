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
        'index' => [
            'title' => 'Revisi Penjualan',
            'page_title' => 'Revisi Penjualan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Penjualan'
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'so_date' => 'Tanggal Dibuat',
                    'customer' => 'Pelanggan',
                    'shipping_date' => 'Tanggal Pengiriman',
                    'status' => 'Status'
                ]
            ]
        ]
    ]
];