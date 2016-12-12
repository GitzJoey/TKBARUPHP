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
    'viewer' => [
        'title' => 'View Report',
        'page_title' => 'View Report',
        'page_title_desc' => ''
    ],
    'template' => [
        'customer' => [
            'report_name' => 'Customer Report',
            'parameter' => [
                'name' => 'Name',
                'profile_name' => 'Profile Name',
                'bank_account' => 'Bank Account',
            ],
            'header' => [
                'store' => 'Store',
                'sign_code' => 'Sign Code',
                'name' => 'Name',
                'address' => 'Address',
                'city' => 'City',
                'phone_number' => 'Phone Number',
                'fax_num' => 'Fax Number',
                'tax_id' => 'Tax ID',
                'payment_due_day' => 'Payment Due Day',
                'price_level' => 'Price Level',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'supplier' => [
            'report_name' => 'Supplier Report',
            'parameter' => [
                'name' => 'Name',
                'profile_name' => 'Profile Name',
                'bank_account' => 'Bank Account',
            ],
            'header' => [
                'store' => 'Store',
                'sign_code' => 'Sign Code',
                'name' => 'Name',
                'address' => 'Address',
                'city' => 'City',
                'phone_number' => 'Phone Number',
                'fax_num' => 'Fax Number',
                'tax_id' => 'Tax ID',
                'payment_due_day' => 'Payment Due Day',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'product' => [
            'report_name' => 'Product Report',
            'parameter' => [
                'name' => 'Name',
                'short_code' => 'Short Code',
            ],
            'header' => [
                'store' => 'Store',
                'product_type' => 'Product Type',
                'name' => 'Name',
                'short_code' => 'Short Code',
                'description' => 'Description',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'bank' => [
            'report_name' => 'Bank Report',
            'parameter' => [
                'name' => 'Name',
                'short_name' => 'Short Name',
                'branch' => 'Branch',
                'branch_code' => 'Branch Code'
            ],
            'header' => [
                'name' => 'Name',
                'short_name' => 'Short Name',
                'branch' => 'Branch',
                'branch_code' => 'Branch Code',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'product_type' => [
            'report_name' => 'Product Type Report',
            'parameter' => [
                'name' => 'Name',
                'short_code' => 'Short Code'
            ],
            'header' => [
                'store' => 'Store',
                'name' => 'Name',
                'short_code' => 'Short Code',
                'description' => 'Description',
                'status' => 'Status',
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'warehouse' => [
            'report_name' => 'Warehouse Report',
            'parameter' => [
                'name' => 'Name'
            ],
            'header' => [
                'store' => 'Store',
                'name' => 'Name',
                'address' => 'Address',
                'phone_number' => 'Phone Number',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'truck' => [
            'report_name' => 'Truck Report',
            'parameter' => [
                'plate_number' => 'Plate Number'
            ],
            'header' => [
                'store' => 'Store',
                'truck_type' => 'Truck Type',
                'plate_number' => 'Plate Number',
                'inspection_date' => 'Inspection Date',
                'driver' => 'Driver',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'truck_maintenance' => [
            'report_name' => 'Truck Maintenance Report',
            'parameter' => [
                'plate_number' => 'Plate Number'
            ],
            'header' => [
                'store' => 'Store',
                'plate_number' => 'Plate Number',
                'maintenance_type' => 'Maintenance Type',
                'cost' => 'Cost',
                'odometer' => 'Odometer',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ],
        'vendor_trucking' => [
            'report_name' => 'Vendor Trucking Report',
            'parameter' => [
                'name' => 'Name'
            ],
            'header' => [
                'store' => 'Store',
                'name' => 'Name',
                'address' => 'Address',
                'tax_id' => 'Tax Id',
                'status' => 'Status',
                'remarks' => 'Remarks'
            ],
            'footer' => 'Printed by :user on :date'
        ]
    ]
];