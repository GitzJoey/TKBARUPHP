<?php 

return [
    'create' => [
        'title' => 'Purchase Order',
        'page_title' => 'Purchase Order',
        'page_title_desc' => 'Create new purchase order',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Purchase Order Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transactions',
            'remarks' => 'Remarks'
        ],
        'field' => [
            'supplier_type' => 'Type',
            'supplier_name' => 'Name',
            'supplier_details' => 'Details',
            'shipping_date' => 'Date',
            'warehouse' => 'Warehouse',
            'vendor_trucking' => 'Vendor Trucking'
        ],
        'po_code' => 'Code',
        'po_type' => 'Type',
        'po_date' => 'Date',
        'po_status' => 'Status',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Product Name',
                    'header' => [
                        'quantity' => 'Quantity'
                    ],
                    'unit' => 'UoM',
                    'price_unit' => 'Price',
                    'total_price' => 'Total Price'
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total Amount'
                ]
            ]
        ],
    ],
    'payment' => [
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'box' => [
            'po_detail' => ''
        ],
    ],
    'revise' => [
        'field' => [
            'supplier_type' => 'Type',
            'supplier_name' => 'Name',
            'supplier_details' => 'Details',
            'shipping_date' => 'Date',
            'warehouse' => 'Warehouse',
            'vendor_trucking' => 'Vendor Trucking'
        ],
        'po_code' => 'Code',
        'po_type' => 'Type',
        'po_date' => 'Date',
        'po_status' => 'Status',
        'title' => 'Revise',
        'page_title' => 'Revise',
        'page_title_desc' => 'Revise purchase order',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transaction',
            'remarks' => 'Remarks'
        ],
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Product',
                    'header' => [
                        'quantity' => 'Quantity'
                    ],
                    'unit' => 'UoM',
                    'price_unit' => 'Price',
                    'total_price' => 'Total Price'
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total Amount'
                ],
            ],
        ],
        'index' => [
            'title' => 'Revise Purchase Order',
            'page_title' => 'Revise Purchase Order',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Purchase Order List'
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'po_date' => 'Created Date',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status'
                ]
            ]
        ]
    ]
];