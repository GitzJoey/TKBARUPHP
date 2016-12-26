<?php 

return [
    'payment' => [
        'giro' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'payment_history' => '',
            ],
            'field' => [
                'payment_type' => '',
                'bank' => '',
                'serial_number' => '',
                'payment_date' => '',
                'effective_date' => '',
                'payment_amount' => '',
                'printed_name' => '',
                'remarks' => '',
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
            ],
            'so_code' => '',
            'so_type' => '',
            'so_date' => '',
            'so_status' => '',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
                        'quantity' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                        'paid_amount' => '',
                        'to_be_paid_amount' => '',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => '',
                        'payment_date' => '',
                        'payment_amount' => '',
                        'payment_status' => '',
                    ],
                ],
            ],
        ],
        'cash' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'payment_history' => '',
            ],
            'field' => [
                'payment_type' => '',
                'payment_date' => '',
                'payment_amount' => '',
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
            ],
            'so_code' => '',
            'so_type' => '',
            'so_date' => '',
            'so_status' => '',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'quantity' => '',
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                        'paid_amount' => '',
                        'to_be_paid_amount' => '',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => '',
                        'payment_date' => '',
                        'payment_status' => '',
                        'payment_amount' => '',
                        'transfer' => '',
                        'effective_date' => '',
                        'account_from' => '',
                        'account_to' => '',
                        'giro' => '',
                        'bank' => '',
                        'serial_number' => '',
                        'printed_name' => '',
                        'payment_type' => '',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'code' => '',
                    'customer' => '',
                    'so_date' => '',
                    'total' => '',
                    'paid' => '',
                    'rest' => '',
                    'po_date' => '',
                    'supplier' => '',
                ],
            ],
        ],
        'transfer' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'payment_history' => '',
            ],
            'field' => [
                'payment_type' => '',
                'bank_from' => '',
                'bank_to' => '',
                'payment_date' => '',
                'effective_date' => '',
                'payment_amount' => '',
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
            ],
            'so_code' => '',
            'so_type' => '',
            'so_date' => '',
            'so_status' => '',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
                        'quantity' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                        'paid_amount' => '',
                        'to_be_paid_amount' => '',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'payment_type' => '',
                        'payment_date' => '',
                        'payment_amount' => '',
                        'payment_status' => '',
                    ],
                ],
            ],
        ],
    ],
    'copy' => [
        'create' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'so_copy_remarks' => '',
                'transaction_summary' => '',
            ],
            'field' => [
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'so_code' => '',
                'so_copy_code' => '',
                'so_type' => '',
                'so_date' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
                'so_status' => '',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'quantity' => '',
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
        'edit' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'so_copy_remarks' => '',
                'transaction_summary' => '',
            ],
            'field' => [
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'so_code' => '',
                'so_copy_code' => '',
                'so_type' => '',
                'so_date' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
                'so_status' => '',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'quantity' => '',
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
        'index' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'search' => '',
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'code' => '',
                    'so_date' => '',
                    'customer' => '',
                    'shipping_date' => '',
                ],
            ],
            'po_not_found' => '',
        ],
        'search' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'so_not_found' => '',
            'header' => [
                'search' => '',
            ],
        ],
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'header' => [
            'title' => '',
        ],
        'table' => [
            'header' => [
                'copy_code' => '',
                'remarks' => '',
            ],
        ],
    ],
    'create' => [
        'box' => [
            'transaction_summary' => '',
            'customer' => '',
            'purchase_order_detail' => '',
            'shipping' => '',
            'transactions' => '',
            'expenses' => '',
            'remarks' => '',
            'supplier' => '',
            'sales_order_detail' => '',
        ],
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'field' => [
            'customer_type' => '',
            'customer_name' => '',
            'customer_details' => '',
            'shipping_date' => '',
            'warehouse' => '',
            'vendor_trucking' => '',
        ],
        'so_code' => '',
        'so_type' => '',
        'so_date' => '',
        'so_status' => '',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => '',
                    'quantity' => '',
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
            'expense' => [
                'header' => [
                    'name' => '',
                    'type' => '',
                    'remarks' => '',
                    'amount' => '',
                    'internal_expense' => '',
                ],
            ],
        ],
        'tab' => [
            'sales' => '',
        ],
    ],
    'edit' => [
        'box' => [
            'transaction_summary' => '',
        ],
    ],
    'field' => [
        'so_code' => '',
    ],
    'revise' => [
        'index' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'code' => '',
                    'so_date' => '',
                    'customer' => '',
                    'shipping_date' => '',
                    'status' => '',
                ],
            ],
        ],
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'box' => [
            'customer' => '',
            'sales_order_detail' => '',
            'shipping' => '',
            'transactions' => '',
            'expenses' => '',
            'remarks' => '',
        ],
        'field' => [
            'customer_type' => '',
            'customer_name' => '',
            'customer_details' => '',
            'shipping_date' => '',
            'warehouse' => '',
            'vendor_trucking' => '',
        ],
        'so_code' => '',
        'so_type' => '',
        'so_date' => '',
        'so_status' => '',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => '',
                    'quantity' => '',
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
            'expense' => [
                'header' => [
                    'name' => '',
                    'type' => '',
                    'remarks' => '',
                    'amount' => '',
                ],
            ],
        ],
    ],
];