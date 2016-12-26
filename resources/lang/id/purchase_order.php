<?php 

return [
    'copy' => [
        'create' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'supplier' => '',
                'purchase_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'transaction_summary' => '',
                'remarks' => '',
                'po_copy_remarks' => '',
                'expenses' => '',
            ],
            'field' => [
                'supplier_type' => '',
                'supplier_name' => '',
                'supplier_details' => '',
                'po_code' => '',
                'po_copy_code' => '',
                'po_type' => '',
                'po_date' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
                'po_status' => '',
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
                'supplier' => '',
                'purchase_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'transaction_summary' => '',
                'remarks' => '',
                'po_copy_remarks' => '',
                'expenses' => '',
            ],
            'field' => [
                'supplier_type' => '',
                'supplier_name' => '',
                'supplier_details' => '',
                'po_code' => '',
                'po_copy_code' => '',
                'po_type' => '',
                'po_date' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
                'po_status' => '',
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
                    'po_date' => '',
                    'supplier' => '',
                    'shipping_date' => '',
                ],
            ],
            'po_not_found' => '',
        ],
        'search' => [
            'po_not_found' => '',
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'search' => '',
            ],
            'so_not_found' => '',
        ],
    ],
    'revise' => [
        'table' => [
            'item' => [
                'header' => [
                    'total_price' => '',
                    'product_name' => '',
                    'quantity' => '',
                    'unit' => '',
                    'price_unit' => '',
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
                    'po_date' => '',
                    'supplier' => '',
                    'shipping_date' => '',
                    'status' => '',
                ],
            ],
        ],
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'box' => [
            'supplier' => '',
            'purchase_order_detail' => '',
            'shipping' => '',
            'transactions' => '',
            'expenses' => '',
            'transaction_summary' => '',
            'remarks' => '',
        ],
        'field' => [
            'supplier_type' => '',
            'supplier_name' => '',
            'supplier_details' => '',
            'po_code' => '',
            'po_type' => '',
            'po_date' => '',
            'po_status' => '',
            'shipping_date' => '',
            'warehouse' => '',
            'vendor_trucking' => '',
        ],
    ],
    'create' => [
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'box' => [
            'supplier' => '',
            'purchase_order_detail' => '',
            'shipping' => '',
            'transactions' => '',
            'expenses' => '',
            'transaction_summary' => '',
            'remarks' => '',
        ],
        'field' => [
            'supplier_type' => '',
            'supplier_name' => '',
            'supplier_details' => '',
            'po_code' => '',
            'po_type' => '',
            'po_date' => '',
            'po_status' => '',
            'shipping_date' => '',
            'warehouse' => '',
            'vendor_trucking' => '',
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
    ],
    'payment' => [
        'cash' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
            ],
            'field' => [
                'payment_type' => '',
                'payment_date' => '',
                'payment_amount' => '',
            ],
        ],
        'giro' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
            ],
            'field' => [
                'payment_type' => '',
                'giro' => '',
                'bank' => '',
                'serial_number' => '',
                'payment_date' => '',
                'effective_date' => '',
                'payment_amount' => '',
                'printed_name' => '',
                'remarks' => '',
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
                    'supplier' => '',
                    'po_date' => '',
                    'total' => '',
                    'paid' => '',
                    'rest' => '',
                ],
            ],
        ],
        'summary' => [
            'box' => [
                'supplier' => '',
                'purchase_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'expenses' => '',
                'transaction_summary' => '',
                'remarks' => '',
                'payment_history' => '',
            ],
            'field' => [
                'supplier_type' => '',
                'supplier_name' => '',
                'supplier_details' => '',
                'po_code' => '',
                'po_type' => '',
                'po_date' => '',
                'po_status' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
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
                        'paid_amount' => '',
                        'to_be_paid_amount' => '',
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
                    ],
                ],
            ],
        ],
        'transfer' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
            ],
            'field' => [
                'payment_type' => '',
                'bank_from' => '',
                'bank_to' => '',
                'payment_date' => '',
                'effective_date' => '',
                'payment_amount' => '',
            ],
        ],
    ],
    'partial' => [
        'supplier' => [
            'title' => '',
            'tab' => [
                'supplier' => '',
                'pic' => '',
                'bank_account' => '',
                'product' => '',
                'expenses' => '',
                'settings' => '',
            ],
            'field' => [
                'name' => '',
                'address' => '',
                'city' => '',
                'phone' => '',
                'tax_id' => '',
                'remarks' => '',
                'first_name' => '',
                'last_name' => '',
                'ic_num' => '',
                'phone_number' => '',
                'payment_due_day' => '',
            ],
            'table_phone' => [
                'header' => [
                    'provider' => '',
                    'number' => '',
                    'remarks' => '',
                ],
            ],
            'table_bank' => [
                'header' => [
                    'bank' => '',
                    'account_number' => '',
                    'remarks' => '',
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
            'table_expense' => [
                'header' => [
                    'name' => '',
                    'type' => '',
                    'amount' => '',
                    'remarks' => '',
                ],
            ],
        ],
    ],
];