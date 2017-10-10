<?php 

return [
    'confirmation' => [
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
                ],
            ],
        ],
    ],
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
            'expenses' => 'Default Expenses',
            'settings' => 'Settings',
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
                'account_name' => 'Account Name',
                'account_number' => 'Account Number',
                'remarks' => 'Remarks',
            ],
        ],
        'table_expense' => [
            'header' => [
                'name' => 'Name',
                'type' => 'Type',
                'amount' => 'Amount',
                'internal_expense' => 'Internal',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'field' => [
        'name' => 'Name',
        'address' => 'Address',
        'city' => 'City',
        'phone' => 'Phone',
        'tax_id' => 'TaxOutput ID',
        'status' => 'Status',
        'remarks' => 'Remarks',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'ic_num' => 'IC Number',
        'phone_number' => 'Phone Number',
        'price_level' => 'Price Level',
        'payment_due_day' => 'Payment Due Day',
        'person_in_charge' => 'Person In Charge',
        'mileage' => 'Mileage',
        'distance' => 'Distance',
        'duration' => 'Duration',
        'latitude' => 'Latitude',
        'longitude' => 'Longitude',
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
            'expenses' => 'Expenses',
            'settings' => 'Settings',
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Number',
                'remarks' => 'Remarks',
            ],
        ],
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
                'tax_id' => 'TaxOutput ID',
                'status' => 'Status',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'payment' => [
        'cash' => [
            'title' => 'Cash Payment',
            'page_title' => 'Cash Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Payment',
                'customer' => 'Customer',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transactions',
                'remarks' => 'Remarks',
                'payment_history' => 'Payment History',
            ],
            'field' => [
                'payment_type' => 'Type',
                'payment_date' => 'Date',
                'payment_amount' => 'Amount',
                'customer_type' => 'Type',
                'customer_name' => 'Name',
                'customer_details' => 'Details',
                'shipping_date' => 'Shipping Date',
                'warehouse' => 'Warehouse',
                'vendor_trucking' => 'Vendor Trucking',
            ],
            'so_code' => 'Sales Code',
            'so_type' => 'Type',
            'so_date' => 'Sales Date',
            'so_status' => 'Status',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Product',
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
                        'payment_date' => 'Date',
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
        'index' => [
            'title' => 'Customer Payment',
            'page_title' => 'Customer Payment',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Sales Order Lists',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Date',
                    'total' => 'Total',
                    'paid' => 'Paid Amount',
                    'rest' => 'Rest Amount',
                ],
            ],
        ],
        'transfer' => [
            'title' => 'Transfer Payment',
            'page_title' => 'Transfer Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Transfer Payment',
            ],
            'field' => [
                'payment_type' => 'Type',
                'bank_from' => 'Bank From',
                'bank_to' => 'Bank To',
                'payment_date' => 'Payment Date',
                'effective_date' => 'Effective Date',
                'payment_amount' => 'Payment Amount',
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
            'expenses' => 'Expenses',
            'settings' => 'Settings',
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
                'account_name' => 'Account Name',
                'account_number' => 'Account Number',
                'remarks' => 'Remarks',
            ],
        ],
        'table_expense' => [
            'header' => [
                'name' => 'Name',
                'type' => 'Type',
                'amount' => 'Amount',
                'internal_expense' => 'Internal Expense',
                'remarks' => 'Remarks',
            ],
        ],
    ],
];