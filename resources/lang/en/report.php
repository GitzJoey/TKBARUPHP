<?php 

return [
    'admin' => [
        'title' => 'Report Management',
        'page_title' => 'Admin Data',
        'page_title_desc' => '',
        'header' => [
            'user' => 'User',
            'role' => 'Role',
            'store' => 'Store',
            'unit' => 'Unit',
            'phone_provider' => 'Phone Provider',
            'settings' => 'Settings',
            'purchase_order' => '',
            'sales_order' => '',
        ],
        'field' => [
            'user' => 'User',
            'email' => 'Email',
            'role' => 'Role',
            'profile' => 'Profile',
            'name' => 'Name',
            'permission' => 'Permission',
            'tax_id' => 'Tax ID',
            'symbol' => 'Symbol',
            'short_name' => 'Short Name',
        ],
    ],
    'master' => [
        'title' => 'Report Management',
        'page_title' => 'Master Data',
        'page_title_desc' => '',
        'header' => [
            'customer' => 'Customer',
            'supplier' => 'Supplier',
            'product' => 'Product',
            'product_type' => 'Product Type',
            'bank' => 'Bank',
            'warehouse' => 'Warehouse',
            'truck' => 'Truck',
            'truck_maintenance' => 'Truck Maintenance',
            'vendor_trucking' => 'Vendor Trucking',
        ],
        'field' => [
            'name' => 'Name',
            'profile_name' => 'Profile Name',
            'bank_account' => 'Bank Accounts',
            'short_code' => 'Short Code',
            'short_name' => 'Short Name',
            'branch' => 'Branch',
            'branch_code' => 'Branch Code',
            'plate_number' => 'Plate Number',
        ],
    ],
    'monitoring' => [
        'title' => 'Report Management',
        'page_title' => 'Monitoring',
        'page_title_desc' => '',
    ],
    'tax' => [
        'title' => 'Report Management',
        'page_title' => 'Tax Report',
        'page_title_desc' => '',
    ],
    'transaction' => [
        'title' => 'Report Management',
        'page_title' => 'Transactions',
        'page_title_desc' => '',
        'header' => [
            'purchase_order' => 'Purchase Order',
            'sales_order' => 'Sales Order',
        ],
        'field' => [
            'po_code' => 'PO Code',
            'po_date' => 'PO Date',
            'shipping_date' => 'Shipping Date',
            'receipt_date' => 'Receipt Date',
            'supplier' => 'Supplier',
            'so_code' => 'SO Code',
            'so_date' => 'SO Date',
            'deliver_date' => 'Deliver Date',
            'customer' => 'Customer',
        ],
    ],
    'template' => [
        'warehouse' => [
            'report_name' => 'Warehouse Report',
            'parameter' => [
                'name' => 'Name'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'vendor_trucking' => [
            'report_name' => 'Vendor Trucking Report',
            'parameter' => [
                'name' => 'Name'
            ],
            'footer' => 'Printed by :user on :date'
        ]
    ]
];