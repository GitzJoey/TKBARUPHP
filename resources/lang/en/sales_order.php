<?php 

return [
    'create' => [
        'title' => 'Sales Order',
        'page_title' => 'Sales Order',
        'page_title_desc' => '',
        'tab' => [
            'sales' => 'Sales',
        ],
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transactions',
            'remarks' => 'Remarks',
            'customer' => '',
        ],
        'field' => [
            'customer_type' => 'Customer Type',
            'customer_name' => 'Name',
            'customer_details' => 'Details',
            'shipping_date' => 'Shipping Date',
            'warehouse' => 'Warehouse',
            'vendor_trucking' => 'Vendor Trucking',
        ],
        'so_code' => 'Code',
        'so_type' => 'Sales Type',
        'so_date' => 'Date',
        'so_status' => 'Status',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Product Name',
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