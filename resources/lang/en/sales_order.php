<?php 

return [
    'payment' => [
        'giro' => [
            'title' => 'Giro Payment',
            'page_title' => 'Giro Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Create Giro Payment',
            ],
            'field' => [
                'payment_type' => 'Payment Type',
                'bank' => 'Bank',
                'serial_number' => 'Serial Number',
                'payment_date' => 'Payment Date',
                'effective_date' => 'Effective Date',
                'payment_amount' => 'Payment Amount',
                'printed_name' => 'Printed Name',
                'remarks' => 'Remarks',
            ],
        ],
        'cash' => [
            'title' => 'Cash Payment',
            'page_title' => 'Cash Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Create Cash Payment',
            ],
            'field' => [
                'payment_type' => 'Payment Type',
                'payment_date' => 'Payment Date',
                'payment_amount' => 'Payment Amount',
            ],
        ],
        'index' => [
            'title' => 'Sales Order Payment',
            'page_title' => 'Sales Order Payment',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Sales Order List',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Created Date',
                    'customer' => 'Customer',
                    'total' => 'Total Amount',
                    'paid' => 'Paid Amount',
                    'rest' => 'Rest Amount',
                ],
            ],
        ],
        'summary' => [
            'box' => [
                'customer' => 'Customer',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transaction',
                'remarks' => 'Remarks',
                'payment_history' => 'Payment History',
                'payment' => 'Payment',
            ],
            'field' => [
                'customer_type' => 'Type',
                'customer_name' => 'Name',
                'customer_details' => 'Details',
                'so_code' => 'Code',
                'so_type' => 'Type',
                'so_date' => 'Date',
                'so_status' => 'Status',
                'shipping_date' => 'Shipping Date',
                'warehouse' => 'Warehouse',
                'vendor_trucking' => 'Vendor Trucking',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Product',
                        'quantity' => '',
                        'unit' => 'Unit',
                        'price_unit' => 'Price',
                        'total_price' => 'Total Price',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total Amount',
                        'paid_amount' => 'Paid Amount',
                        'to_be_paid_amount' => 'Rest Amount',
                    ],
                ],
                'total_discount' => [
                    'header' => [
                        'total_discount_desc' => '',
                        'percentage' => 'Percentage',
                        'value' => 'Value',
                        'total_discount' => 'Discount',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => 'Cash',
                        'payment_date' => 'Payment Date',
                        'payment_status' => 'Status',
                        'payment_amount' => 'Payment Amount',
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
            'title' => 'Transfer Payment',
            'page_title' => 'Transfer Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Create Transfer Payment',
            ],
            'field' => [
                'payment_type' => 'Payment Type',
                'bank_from' => 'Bank From',
                'bank_to' => 'Bank To',
                'payment_date' => 'Payment Date',
                'effective_date' => 'Effective Date',
                'payment_amount' => 'Payment Amount',
            ],
        ],
        'broughtforward' => [
            'title' => 'Forward Invoice',
            'page_title' => 'Forward Invoice',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Forward Invoice',
            ],
            'invoice' => [
                'next' => 'Merge Invoice',
                'so_code' => 'Sales Code',
                'name' => 'Name',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'copy' => [
        'create' => [
            'title' => 'Create Sales Copy',
            'page_title' => 'Create Sales Copy',
            'page_title_desc' => 'Create a new copy of sales order',
            'box' => [
                'customer' => 'Customer',
                'sales_order_detail' => 'Sales Order Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transactions',
                'remarks' => 'Remarks',
                'so_copy_remarks' => 'Sales Copy Remarks',
            ],
            'field' => [
                'customer_type' => 'Type',
                'customer_name' => 'Name',
                'customer_details' => 'Details',
                'so_code' => 'Ssles Code',
                'so_copy_code' => 'Sales Copy Code',
                'so_type' => 'Type',
                'so_date' => 'Date',
                'shipping_date' => 'Shipping Date',
                'warehouse' => 'Warehouse',
                'vendor_trucking' => 'Vendor Trucking',
                'so_status' => 'Status',
            ],
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
                        'total' => 'Total Amount',
                    ],
                ],
            ],
        ],
        'edit' => [
            'title' => 'Edit Ssles Copy',
            'page_title' => 'Edit Sales Copy',
            'page_title_desc' => 'Edit a copy of sales order',
            'box' => [
                'customer' => 'Customer',
                'sales_order_detail' => 'Sales Order Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transactions',
                'remarks' => 'Remarks',
                'so_copy_remarks' => 'Sales Copy Remarks',
            ],
            'field' => [
                'customer_type' => 'Type',
                'customer_name' => 'Name',
                'customer_details' => 'Details',
                'so_code' => 'Sales Code',
                'so_copy_code' => 'Sales Copy Code',
                'so_type' => 'Type',
                'so_date' => 'Date',
                'shipping_date' => 'Shipping Date',
                'warehouse' => 'Warehouse',
                'vendor_trucking' => 'Vendor Trucking',
            ],
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
                        'total' => 'Total Amount',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => 'Sales Order Copy',
            'page_title' => 'Sales Order Copy',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Search',
                'title' => 'List of Sales Order Copy',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Date',
                    'customer' => 'Customer',
                    'shipping_date' => 'Shipping Date',
                ],
            ],
        ],
        'search' => [
            'so_not_found' => 'Sales order not found.',
            'title' => 'Sales Order Copy',
            'page_title' => 'Sales Order Copy',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Search',
            ],
        ],
    ],
    'create' => [
        'box' => [
            'transaction_summary' => 'Transaction Summary',
            'last_sale' => 'Last Sale',
            'open_sales' => 'Open Sales',
            'latest_prices' => 'Latest Prices',
            'customer' => 'Customer',
            'sales_order_detail' => 'Sales Order Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transactions',
            'expenses' => 'Expenses',
            'remarks' => 'Remarks',
            'total_discount' => 'Discount',
        ],
        'title' => 'Create Sales Copy',
        'page_title' => 'Create Ssles Copy',
        'page_title_desc' => 'Create a new copy of sales order',
        'field' => [
            'customer_type' => 'Type',
            'customer_name' => 'Name',
            'customer_details' => 'Details',
            'shipping_date' => 'Shipping Date',
            'warehouse' => 'Warehouse',
            'vendor_trucking' => 'Vendor Trucking',
        ],
        'so_code' => 'Ssles Code',
        'so_copy_code' => 'Sales Copy Code',
        'so_type' => 'Type',
        'so_date' => 'Date',
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
                    'total' => 'Total Amount',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => 'Name',
                    'type' => 'Type',
                    'internal_expense' => '',
                    'remarks' => 'Remarks',
                    'amount' => 'Amount',
                ],
            ],
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => 'Percentage',
                    'value' => 'Value',
                    'total_discount' => 'Discount',
                ],
            ],
            'open_sales' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Sales Date',
                    'status' => 'Status',
                    'amount' => 'Amount',
                ],
            ],
            'latest_prices' => [
                'header' => [
                    'product_name' => 'Product Name',
                    'market_price' => 'Market Price',
                    'latest_price' => 'Latest Price',
                ],
            ],
        ],
        'tab' => [
            'sales' => 'Sales',
            'remarks' => 'Remarks',
            'internal' => 'Internal',
            'private' => 'Private',
        ],
    ],
    'edit' => [
        'box' => [
            'transaction_summary' => 'Transaction Summary',
        ],
    ],
    'revise' => [
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
        'title' => 'Revise Sales Order',
        'page_title' => 'Revise Sales Order',
        'page_title_desc' => '',
        'box' => [
            'customer' => 'Customer',
            'sales_order_detail' => 'Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transactions',
            'expenses' => 'Expenses',
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
                    'quantity' => 'Quantity',
                    'unit' => 'Unit',
                    'price_unit' => 'Price',
                    'total_price' => 'Total Price',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total Amount',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => 'Name',
                    'type' => 'Type',
                    'amount' => 'Amount',
                    'remarks' => 'Remarks',
                ],
            ],
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => 'Percentage',
                    'value' => 'Value',
                    'total_discount' => 'Discount',
                ],
            ],
        ],
        'tab' => [
            'remarks' => 'Remarks',
            'internal' => 'Internal',
            'private' => 'Private',
        ],
    ],
    'partial' => [
        'customer' => [
            'title' => '',
            'tab' => [
                'customer' => 'Customer Data',
                'pic' => 'Person In Charge',
                'bank_account' => 'Bank Account',
                'sales_orders' => 'Sales Orders',
                'settings' => 'Settings',
            ],
            'field' => [
                'name' => 'Name',
                'address' => 'Address',
                'city' => 'City',
                'phone' => 'Phone',
                'tax_id' => 'TaxOutput ID',
                'remarks' => 'Remarks',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'ic_num' => 'IC Number',
                'phone_number' => 'Phone Number',
                'price_level' => 'Price Level',
                'payment_due_day' => 'Payment Due Day',
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
                    'account_number' => 'Account',
                    'remarks' => 'Remarks',
                ],
            ],
            'table_sales_orders' => [
                'header' => [
                    'code' => 'Code',
                    'so_date' => 'Sales Date',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status',
                ],
            ],
        ],
    ],
];