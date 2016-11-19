<?php

return [
    'index' => [
        'title' => 'Today Price',
        'page_title' => 'Today Price',
        'page_title_desc' => '',
        'table' => [
            'header' => [
                'stock_name' => 'Stock Name',
                'input_date' => 'Input Date'
            ],
        ],
    ],
    'category' => [
        'title' => 'Product Category Price',
        'page_title' => 'Product Category Price',
        'page_title_desc' => 'Update Product Category Price',
        'header' => [
            'title' => 'Update :product_type Price'
        ],
        'field' => [
            'input_date' => 'Input Date',
            'market_price' => 'Market Price',
            'price' => 'Price'
        ],
    ],
];