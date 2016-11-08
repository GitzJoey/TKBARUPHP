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
            'customer' => 'Customer',
            'sales_order_detail' => '',
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
                        'quantity' => 'Quantity',
                    ],
                    'unit' => 'UoM',
                    'price_unit' => 'Price',
                    'total_price' => 'Total Price',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total Amount',
                ],
            ],
        ],
    ],
    'revise' => [
        'title' => 'Revise Sales Order',
        'page_title' => 'Revise Sales Order',
        'page_title_desc' => '',
        'box' => [
            'customer' => 'Customer',
            'sales_order_detail' => 'Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transactions',
            'remarks' => 'Remarks',
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
                        'quantity' => 'Quantity',
                    ],
                    'unit' => 'UoM',
                    'price_unit' => 'Price',
                    'total_price' => 'Total Price',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total Amount',
                ],
            ],
        ],
        'index' => [
            'title' => 'Revise Sales Order',
            'page_title' => 'Revise Sales Order',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Sales Order List',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Created Date',
                    'customer' => 'Customer',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status',
                ],
            ],
        ],
    ],
    'payment' => [
        'index' => [
            'title' => 'Sales Order Payment',
            'page_title' => 'Sales Order Payment',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Sales Order List'
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Created Date',
                    'supplier' => 'Customer',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status'
                ]
            ]
        ]
    ],
];