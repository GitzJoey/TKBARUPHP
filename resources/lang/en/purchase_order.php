<?php 

return [
    'create' => [
        'title' => 'Purchase Order',
        'page_title' => 'Purchase Order',
        'page_title_desc' => '',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Purchase Order Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transactions',
            'expenses' => 'Expenses',
            'transaction_summary' => 'Transaction Summary',
            'discount_transaction' => 'Discount Transaction',
            'remarks' => 'Remarks',
            'total_discount' => 'Discount',
            'discount_per_item' => 'Discount Per Item',
            'po_copy_remarks' => '',
        ],
        'field' => [
            'supplier_type' => 'Type',
            'supplier_name' => 'Name',
            'supplier_details' => 'Details',
            'po_code' => 'PO Code',
            'po_type' => 'Type',
            'po_date' => 'Date',
            'po_status' => 'Status',
            'shipping_date' => 'Shipping Date',
            'warehouse' => 'Warehouse',
            'vendor_trucking' => 'Vendor Trucking',
            'po_copy_code' => '',
        ],
        'tab' => [
            'remarks' => 'Remarks',
            'internal' => 'Internal',
            'private' => 'Private',
        ],
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Product Name',
                    'quantity' => 'Quantity',
                    'unit' => 'Unit',
                    'price_unit' => 'Price',
                    'total_price' => 'Total Price',
                    'discount_percent' => 'Discount %',
                    'discount_nominal' => 'Discount Nominal',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total Amount',
                    'sub_total_discount' => 'Sub Total Discount',
                    'total_discount' => 'Total Discount',
                    'invoice_discount' => 'Invoice Discount',
                    'total_transaction' => 'Total Transaction',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => 'Name',
                    'type' => 'Type',
                    'internal_expense' => 'Internal Expense',
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
                'body' => [
                    'total_discount_desc' => 'Total Discount',
                ],
            ],
        ],
    ],
    'revise' => [
        'index' => [
            'title' => 'Revise Purchase Order',
            'page_title' => 'Revise Purchase Order',
            'page_title_desc' => '',
            'header' => [
                'title' => 'List of Purchase Order',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'po_date' => 'Date',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status',
                ],
            ],
        ],
        'title' => 'Revise Purchase Order',
        'page_title' => 'Revise Purchase Order',
        'page_title_desc' => '',
        'box' => [
            'supplier' => 'Supplier',
            'purchase_order_detail' => 'Purchase Order Detail',
            'shipping' => 'Shipping',
            'transactions' => 'Transactions',
            'expenses' => 'Expenses',
            'transaction_summary' => 'Transaction Summary',
            'remarks' => 'Remarks',
            'total_discount' => 'Discount',
        ],
        'field' => [
            'supplier_type' => 'Type',
            'supplier_name' => 'Name',
            'supplier_details' => 'Details',
            'po_code' => 'PO Code',
            'po_type' => 'Type',
            'po_date' => 'Date',
            'po_status' => 'Status',
            'shipping_date' => 'Shipping Date',
            'warehouse' => 'Warehouse',
            'vendor_trucking' => 'Vendor Trucking',
        ],
        'tab' => [
            'remarks' => 'Remarks',
            'internal' => 'Internal',
            'private' => 'Private',
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
            'expense' => [
                'header' => [
                    'name' => 'Name',
                    'type' => 'Type',
                    'internal_expense' => 'Internal Expense',
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
                'body' => [
                    'total_discount_desc' => 'Total Discount',
                ],
            ],
        ],
    ],
    'payment' => [
        'cash' => [
            'title' => 'Payment PO',
            'page_title' => 'PO Cash Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Cash Payment',
            ],
            'field' => [
                'payment_type' => 'Type',
                'payment_date' => 'Payment Date',
                'payment_amount' => 'Amount',
            ],
        ],
        'giro' => [
            'title' => 'Payment PO',
            'page_title' => 'PO Giro Payment',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Giro Payment',
            ],
            'field' => [
                'payment_type' => 'Type',
                'giro' => 'Giro',
                'bank' => 'Bank',
                'serial_number' => 'Serial Number',
                'payment_date' => 'Payment Date',
                'effective_date' => 'Effective Date',
                'payment_amount' => 'Amount',
                'printed_name' => 'Printed Name',
                'remarks' => 'Remarks',
            ],
        ],
        'index' => [
            'title' => 'Payment PO',
            'page_title' => 'PO Payment',
            'page_title_desc' => '',
            'header' => [
                'title' => 'List of Purchase Order',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'supplier' => 'Supplier',
                    'po_date' => 'PO Date',
                    'total' => 'Total Amount',
                    'paid' => 'Paid Amount',
                    'rest' => 'Rest Amount',
                ],
            ],
        ],
        'summary' => [
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Purchase Order Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transactions',
                'expenses' => 'Expenses',
                'transaction_summary' => 'Transaction Summary',
                'remarks' => 'Remarks',
                'payment_history' => 'Payment Hiatory',
                'total_discount' => 'Discount',
            ],
            'field' => [
                'supplier_type' => 'Type',
                'supplier_name' => 'Name',
                'supplier_details' => 'Details',
                'po_code' => 'PO Code',
                'po_type' => 'Type',
                'po_date' => 'Date',
                'po_status' => 'Status',
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
                        'paid_amount' => 'Paid Amount',
                        'to_be_paid_amount' => 'To Be Paid Amount',
                    ],
                ],
                'expense' => [
                    'header' => [
                        'name' => 'Name',
                        'type' => 'Type',
                        'internal_expense' => 'Internal Expense',
                        'remarks' => 'Remarks',
                        'amount' => 'Amount',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => 'Cash Payment',
                        'payment_date' => 'Payment Date',
                        'payment_status' => 'Payment Status',
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
                'total_discount' => [
                    'header' => [
                        'total_discount_desc' => '',
                        'percentage' => 'Percentage',
                        'value' => 'Value',
                        'total_discount' => 'Discount',
                    ],
                    'body' => [
                        'total_discount_desc' => 'Total Discount',
                    ],
                ],
            ],
        ],
        'transfer' => [
            'title' => 'PO Transfer Payment',
            'page_title' => 'PO Transfer Payment',
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
                'payment_amount' => 'Amount',
            ],
        ],
        'box' => [
            'total_discount' => '',
        ],
        'table' => [
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => '',
                    'value' => '',
                    'total_discount' => '',
                ],
                'body' => [
                    'total_discount_desc' => '',
                ],
            ],
        ],
    ],
    'copy' => [
        'search' => [
            'title' => 'Purchase Order Copy',
            'page_title' => 'Purchase Order Copy',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Search',
            ],
            'po_not_found' => 'Purchase order code not found.',
        ],
        'index' => [
            'title' => 'Purchase Order Copy',
            'page_title' => 'Purchase Order Copy',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Search',
                'title' => 'List of Purchase Order Copy',
            ],
            'po_not_found' => 'Purchase order code not found.',
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'po_date' => 'Date',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Shipping Date',
                ],
            ],
        ],
        'create' => [
            'title' => 'Create PO Copy',
            'page_title' => 'Create PO Copy',
            'page_title_desc' => 'Create a new copy of purchase order',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Purchase Order Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transactions',
                'expenses' => 'Expenses',
                'transaction_summary' => 'Transaction Summary',
                'remarks' => 'Remarks',
                'po_copy_remarks' => 'PO Copy Remarks',
                'discount_transaction' => '',
                'discount_per_item' => '',
            ],
            'field' => [
                'supplier_type' => 'Type',
                'supplier_name' => 'Name',
                'supplier_details' => 'Details',
                'po_code' => 'PO Code',
                'po_copy_code' => 'PO Copy Code',
                'po_type' => 'Type',
                'po_date' => 'Date',
                'po_status' => 'Status',
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
                        'discount_percent' => '',
                        'discount_nominal' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total Amount',
                        'sub_total_discount' => '',
                        'total_discount' => '',
                        'invoice_discount' => '',
                        'total_transaction' => '',
                    ],
                ],
            ],
        ],
        'edit' => [
            'title' => 'Edit PO Copy',
            'page_title' => 'Edit PO Copy',
            'page_title_desc' => 'Edit a copy of purchase order',
            'box' => [
                'supplier' => 'Supplier',
                'purchase_order_detail' => 'Purchase Order Detail',
                'shipping' => 'Shipping',
                'transactions' => 'Transactions',
                'expenses' => 'Expenses',
                'transaction_summary' => 'Transaction Summary',
                'remarks' => 'Remarks',
                'po_copy_remarks' => 'PO Copy Remarks',
            ],
            'field' => [
                'supplier_type' => 'Type',
                'supplier_name' => 'Name',
                'supplier_details' => 'Details',
                'po_code' => 'PO Code',
                'po_copy_code' => 'PO Copy Code',
                'po_type' => 'Type',
                'po_date' => 'Date',
                'po_status' => 'Status',
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
    ],
    'partial' => [
        'supplier' => [
            'title' => 'Supplier Detail',
            'tab' => [
                'supplier' => 'Supplier Date',
                'pic' => 'Person In Charge',
                'bank_account' => 'Bank Account',
                'product' => 'Product',
                'expenses' => 'Expenses',
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
                    'account_number' => 'Account Number',
                    'remarks' => 'Remarks',
                ],
            ],
            'table_prod' => [
                'header' => [
                    'type' => 'Type',
                    'name' => 'Name',
                    'short_code' => 'Short Code',
                    'description' => 'Description',
                    'remarks' => 'Remarks',
                ],
            ],
            'table_expense' => [
                'header' => [
                    'name' => 'Name',
                    'type' => 'Type',
                    'amount' => 'Amount',
                    'remarks' => 'Remarks',
                ],
            ],
        ],
    ],
];