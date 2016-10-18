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
            'remarks' => 'Remarks',
        ],
        'field' => [
            'supplier_type' => 'Name',
            'supplier_name' => 'Name',
            'supplier_details' => 'Details',
            'shipping_date' => 'Date',
            'warehouse' => 'Warehouse',
            'vendor_trucking' => 'Vendor Trucking',
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