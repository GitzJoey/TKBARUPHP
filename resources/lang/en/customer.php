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
            'expenses' => 'Default Expenses',
            'header' => [
                'bank_lists' => 'Bank Account Lists',
                'bank_inputs' => 'Create New Bank Account',
            ],
            'product' => '',
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
        'table_expense' => [
            'header' => [
                'name' => 'Name',
                'type' => 'Type',
                'amount' => 'Amount',
                'remarks' => 'Remarks',
                'internal_expense' => 'Internal Expense'
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
        'table_prod' => [
            'header' => [
                'type' => '',
                'name' => '',
                'short_code' => '',
                'description' => '',
                'remarks' => '',
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
                'status' => 'Status',
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
            'expenses' => 'Default Expenses',
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
        'table_expense' => [
            'header' => [
                'name' => 'Name',
                'type' => 'Type',
                'amount' => 'Amount',
                'remarks' => 'Remarks',
                'internal_expense' => 'Internal Expense'
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
                    'so_code' => 'Sales Code',
                    'shipping_date' => 'Shipping Date',
                    'deliver_date' => 'Deliver Date',
                    'confirm_receive_date' => 'Confirm Receive Date',
                    'status' => 'Status',
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
    'payment' => [
        'index' => [
            'title' => 'Payment',
            'page_title' => 'Payment',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Sales Order Lists',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Sales Date',
                    'total' => 'Total',
                    'paid' => 'Paid',
                    'rest' => 'Rest',
                ],
            ],
        ],
        'cash' => [
            'title' => 'Customer Payment',
            'page_title' => 'Cash Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Cash Payment',
                'customer' => 'Customer',
                'sales_order_detail' => 'Sales Order Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transactions',
                'remarks' => 'Remarks',
                'payment_history' => 'Payment History',
            ],
            'field' => [
                'payment_type' => 'Payment Type',
                'payment_date' => 'Date',
                'payment_amount' => 'Amount',
                'customer_type' => 'Customer Type',
                'customer_name' => 'Name',
                'customer_details' => 'Details',
                'shipping_date' => 'Shipping Date',
                'warehouse' => 'warehouse',
                'vendor_trucking' => 'Vendor Trucking',
            ],
            'so_code' => 'Code',
            'so_type' => 'Sales Type',
            'so_date' => 'SO Date',
            'so_status' => 'Status',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Product Name',
                        'quantity' => 'Quantity',
                        'unit' => 'Unit',
                        'price_unit' => 'Price',
                        'total_price' => 'Total Price',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                        'paid_amount' => 'Paid Amount',
                        'to_be_paid_amount' => 'Rest Amount',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => 'Cash',
                        'payment_date' => 'Payment Date',
                        'payment_status' => 'Status',
                        'payment_amount' => 'Amount',
                        'transfer' => 'Transfer',
                        'effective_date' => 'Effective Date',
                        'account_from' => 'Account From',
                        'account_to' => 'Account To',
                        'giro' => 'Giro',
                        'bank' => 'Bank',
                        'serial_number' => 'Serial Number',
                        'printed_name' => 'Printed Name',
                    ],
                ],
            ],
        ],
        'transfer' => [
            'title' => 'Customer Payment',
            'page_title' => 'Transfer Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Transfer Payment',
            ],
            'field' => [
                'payment_type' => 'Payment Type',
                'bank_from' => 'Bank From',
                'bank_to' => 'Bank To',
                'payment_date' => 'Payment Date',
                'effective_date' => 'Effective Date',
                'payment_amount' => 'Amount',
            ],
        ],
    ],
];