<?php 

return [
    'inflow' => [
        'index' => [
            'title' => 'Inflow',
            'page_title' => 'Inflow',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Inflow'
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'po_date' => 'Created Date',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status'
                ]
            ],
            'header' => [
                'warehouse' => 'Warehouse',
                'purchase_order' => 'Purchase Order'
            ]
        ],
        'receipt' => [
            'title' => 'Receipt',
            'page_title' => 'Receipt',
            'page_title_desc' => '',
            'box' => [
                'receipt' => 'Receipt',
                'items' => 'Items'
            ],
            'field' => [
                'warehouse' => 'Warehouse',
                'po_code' => 'PO Code',
                'shipping_date' => 'Shipping Date',
                'receipt_date' => 'Receipt Date',
                'vendor_trucking' => 'Vendor Trucking',
                'licence_plate' => 'Licence Plate'
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Product Name',
                        'unit' => 'UoM',
                        'brutto' => 'Brutto',
                        'netto' => 'Netto',
                        'tare' => 'Tare'
                    ]
                ]
            ]
        ]
    ],
    'outflow' => [
        'index' => [
            'title' => 'Outflow',
            'page_title' => 'Outflow',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Outflow'
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Created Date',
                    'customer' => 'Customer',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status'
                ]
            ],
            'header' => [
                'warehouse' => 'Warehouse',
                'sales_order' => 'Sales Order'
            ]
        ],
    ],
    'create' => [
        'title' => 'Warehouse',
        'page_title' => 'Warehouse',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Create Warehouse',
        ],
    ],
    'field' => [
        'name' => 'Name',
        'address' => 'Address',
        'phone_num' => 'Phone Number',
        'status' => 'Status',
        'remarks' => 'Remarks',
    ],
    'edit' => [
        'title' => 'Warehouse',
        'page_title' => 'Warehouse',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Edit Warehouse',
        ],
    ],
    'index' => [
        'title' => 'Warehouse',
        'page_title' => 'Warehouse',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Warehouse Lists',
        ],
        'table' => [
            'header' => [
                'name' => 'Name',
                'address' => 'Address',
                'phone_num' => 'Phone Number',
                'status' => 'Status',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'show' => [
        'title' => 'Warehouse',
        'page_title' => 'Warehouse',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Show Warehouse',
        ],
    ],
];