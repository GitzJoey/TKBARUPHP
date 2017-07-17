<?php

return [
    'index' => [
        'title' => 'Harga Hari Ini',
        'page_title' => 'Harga Hari Ini',
        'page_title_desc' => '',
        'table' => [
            'header' => [
                'stock_name' => 'Nama Stok',
                'input_date' => 'Berlaku Sejak'
            ],
        ],
        'price_history' => [
            'chart' => [
                'subtitle' => 'Harga di 10 hari terakhir',
                'price' => 'Harga (IDR)',
                'market_price' => 'Harga Pasar'
            ]
        ]
    ],
    'category' => [
        'title' => 'Harga Kategori Produk',
        'page_title' => 'Harga Kategori Produk',
        'page_title_desc' => 'Perbaharui Harga Kategori Produk',
        'header' => [
            'title' => 'Perbaharui Harga :product_type'
        ],
        'field' => [
            'input_date' => 'Tanggal Input',
            'market_price' => 'Harga Pasar',
            'price' => 'Harga',
            'affected_stocks' => 'Stok Terupdate'
        ]
    ],
    'stock' => [
        'title' => 'Harga Stok',
        'page_title' => 'Harga Stok',
        'page_title_desc' => 'Perbaharui Harga Stok',
        'header' => [
            'title' => 'Perbaharui Harga :stock_name'
        ],
        'field' => [
            'input_date' => 'Tanggal Input',
            'market_price' => 'Harga Pasar',
            'price' => 'Harga'
        ]
    ],
];