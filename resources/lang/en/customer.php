<?php 

return [
    'create' => [
        'title' => 'Customer',
        'page_title' => 'Customer',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Create Customer',
        ],
        'tab' => [
            'customer' => 'Customer Data',
            'pic' => 'Person In Charge',
            'bank_account' => 'Bank Account',
            'settings' => 'Settings',
            'header' => [
                'bank_lists' => 'Bank Account Lists',
                'bank_inputs' => 'Create New Bank Account',
            ],
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Number',
                'remarks' => 'Remarks',
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_number' => 'Account Number',
                'remarks' => 'Remarks',
            ],
        ],
        'table' => [
            'bank' => [
                'header' => [
                    'bank' => 'Bank',
                    'account_number' => 'Account Number',
                    'remarks' => 'Remarks',
                ],
            ],
        ],
    ],
    'field' => [
        'name' => 'Name',
        'address' => 'Address',
        'city' => 'City',
        'phone' => 'Phone',
        'remarks' => 'Remarks',
        'tax_id' => 'Tax ID',
        'status' => 'Status',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'ic_num' => 'IC Number',
        'phone_number' => 'Phone Number',
        'bank' => 'Bank',
        'bank_account' => 'Bank Account',
        'price_level' => 'Price Level',
        'payment_due_day' => 'Payment Due Day',
    ],
    'index' => [
        'title' => 'Customer',
        'page_title' => 'Customer',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Customer Lists',
        ],
        'table' => [
            'header' => [
                'name' => 'Name',
                'address' => 'Address',
                'tax_id' => 'Tax ID',
                'phone' => 'Phone',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'edit' => [
        'title' => 'Customer',
        'page_title' => 'Customer',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Edit Customer',
        ],
        'tab' => [
            'customer' => 'Customer Data',
            'pic' => 'Person In Charge',
            'bank_account' => 'Bank Account',
            'settings' => 'Settings',
            'header' => [
                'bank_lists' => 'Bank Account Lists',
                'bank_inputs' => 'Create New Bank Account',
            ],
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Number',
                'remarks' => 'Remarks',
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_number' => 'Account Number',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'show' => [
        'title' => 'Customer',
        'page_title' => 'Customer',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Show Customer',
        ],
        'tab' => [
            'customer' => 'Customer Data',
            'pic' => 'Person In Charge',
            'bank_account' => 'Bank Account',
            'settings' => 'Settings',
            'header' => [
                'bank_lists' => 'Bank Account Lists',
            ],
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Number',
                'remarks' => 'Remarks',
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_number' => 'Account Number',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'confirmation' => [
        'index' => [
            'title' => 'Customer Confirmation',
            'page_title' => 'Customer Confirmation',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Sales Order List',
            ],
            'table' => [
                'header' => [
                    'so_code' => 'Code',
                    'deliver_date' => 'Delivery Date',
                    'deliverer' => 'Deliverer',
                    'items' => 'Items',
                    'status' => 'Status',
                ],
            ],
        ],
        'confirm' => [
            'title' => 'Confirm Sales Order',
            'page_title' => 'Confirm Sales Order',
            'page_title_desc' => '',
            'box' => [
                'sales_order' => 'Sales Order',
                'items' => 'Items',
            ],
            'field' => [
                'so_code' => 'Code',
                'deliver_date' => 'Deliver Date',
                'license_plate' => 'License Plate',
                'confirm_receive_date' => 'Receive Date',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Product',
                        'unit' => 'Unit',
                        'brutto' => 'Brutto',
                        'netto' => 'Netto',
                        'tare' => 'Tare',
                        'remarks' => 'Remarks',
                    ],
                ],
            ],
        ],
        'approval' => [
            'title' => 'Approval Sales Order',
            'page_title' => 'Approval Sales Order',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Sales Order List',
            ],
            'table' => [
                'header' => [
                    'so' => 'Sales Order',
                    'items_detail' => 'Items',
                    'items' => [
                        'product_name' => 'Product Name',
                        'brutto' => 'Brutto',
                        'netto' => 'Netto',
                        'tare' => 'Tare',
                        'remarks' => 'Remarks',
                    ],
                ],
            ],
        ],
    ],
];