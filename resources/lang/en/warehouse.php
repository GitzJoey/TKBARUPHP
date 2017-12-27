<?php 

return [
    'inflow' => [
        'index' => [
            'title' => 'Inflow',
            'page_title' => 'Inflow',
            'page_title_desc' => '',
            'header' => [
                'warehouse' => 'Warehouse',
                'purchase_order' => 'Purchase Order',
            ],
            'table' => [
                'header' => [
                    'code' => 'Code',
                    'po_date' => 'Created Date',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Shipping Date',
                    'status' => 'Status',
                ],
            ],
        ],
        'receipt' => [
            'title' => 'Receipt',
            'page_title' => 'Receipt',
            'page_title_desc' => '',
            'box' => [
                'receipt' => 'Receipt',
                'items' => 'Items',
                'expense' => 'Expenses',
            ],
            'field' => [
                'warehouse' => 'Warehouse',
                'po_code' => 'PO Code',
                'shipping_date' => 'Shipping Date',
                'receipt_date' => 'Receipt Date',
                'vendor_trucking' => 'Vendor Trucking',
                'license_plate' => 'License Plate',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Product Name',
                        'unit' => 'UoM',
                        'brutto' => 'Brutto',
                        'netto' => 'Netto',
                        'tare' => 'Tare',
                    ],
                ],
                'expense' => [
                    'header' => [
                        'name' => 'Name',
                        'type' => 'Type',
                        'internal_expense' => 'Internal',
                        'remarks' => 'Remarks',
                        'amount' => 'Amount',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                    ],
                ],
            ],
        ],
        'field' => [
            'warehouse' => 'Warehouse',
            'po_code' => 'PO Code',
        ],
    ],
    'outflow' => [
        'index' => [
            'title' => 'Outflow',
            'page_title' => 'Outflow',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Outflow',
                'warehouse' => 'Warehouse',
                'sales_order' => 'Sales Order',
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
        'deliver' => [
            'title' => 'Deliver',
            'page_title' => 'Deliver',
            'page_title_desc' => '',
            'box' => [
                'deliver' => 'Deliver',
                'items' => 'Items',
                'expenses' => 'Expenses',
            ],
            'field' => [
                'warehouse' => 'Warehouse',
                'so_code' => 'SO Code',
                'shipping_date' => 'Shipping Date',
                'deliver_date' => 'Deliver Date',
                'vendor_trucking' => 'Vendor Trucking',
                'license_plate' => 'License Plate',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Product Name',
                        'unit' => 'UoM',
                        'brutto' => 'Brutto',
                    ],
                ],
                'expense' => [
                    'header' => [
                        'name' => 'Name',
                        'type' => 'Type',
                        'internal_expense' => 'Internal',
                        'remarks' => 'Remarks',
                        'amount' => 'Amount',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                    ],
                ],
            ],
        ],
        'field' => [
            'warehouse' => 'Warehouse',
            'so_code' => 'Sales Code',
        ],
    ],
    'create' => [
        'title' => 'Warehouse',
        'page_title' => 'Warehouse',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Create Warehouse',
        ],
        'table' => [
            'header' => [
                'name' => 'Name',
                'position' => 'Position',
                'capacity' => 'Capacity',
                'capacity_unit' => 'Unit',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'field' => [
        'name' => 'Name',
        'address' => 'Address',
        'phone_num' => 'Phone Number',
        'status' => 'Status',
        'remarks' => 'Remarks',
        'section' => 'Sections',
    ],
    'edit' => [
        'title' => 'Warehouse',
        'page_title' => 'Warehouse',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Edit Warehouse',
        ],
        'table' => [
            'header' => [
                'name' => 'Name',
                'position' => 'Position',
                'capacity' => 'Capacity',
                'capacity_unit' => 'Unit',
                'remarks' => 'Remarks',
            ],
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
        'table' => [
            'header' => [
                'name' => 'Name',
                'position' => 'Position',
                'capacity' => 'Capacity',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'stockopname' => [
        'index' => [
            'title' => 'Stock Opname',
            'page_title' => 'Stock Opname',
            'page_title_desc' => '',
            'header' => [
                'title' => 'List of Stocks',
            ],
            'table' => [
                'header' => [
                    'warehouse' => 'Warehouse',
                    'product' => 'Product',
                    'opname_date' => 'Opname Date',
                    'current_quantity' => 'Current Quantity',
                ],
            ],
        ],
        'adjust' => [
            'title' => 'Adjust Stock Quantity',
            'page_title' => 'Adjust Stock Quantity',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Adjust Stock Quantity',
            ],
            'field' => [
                'warehouse' => 'Warehouse',
                'product' => 'Product',
                'opname_date' => 'Opname Date',
                'is_match' => 'Match',
                'current_quantity' => 'Current Quantity',
                'adjusted_quantity' => 'Adjusted Quantity',
                'reason' => 'Reason',
            ],
        ],
    ],
    'transfer_stock' => [
        'create' => [
            'title' => 'Transfer Stocks',
            'page_title' => 'Transfer Stocks',
            'page_title_desc' => '',
            'header' => [
                'title' => [
                    'stock_location' => 'Stock Location',
                    'transferred_to' => 'Transferred To',
                    'stocks' => 'Stocks',
                    'in' => 'In',
                    'stock_transfer' => 'Stock Transfer',
                ],
            ],
            'table' => [
                'header' => [
                    'select' => 'Select',
                    'product' => 'Product',
                    'current_qty' => 'Current Quantity',
                    'detail' => 'Details',
                    'remarks' => 'Remarks',
                    'qty_to_transfer' => 'Qty. to Transfer',
                    'destination' => 'Destination',
                ],
            ],
        ],
        'field' => [
            'product' => 'Product',
            'source_warehouse' => 'Source Warehouse',
            'destination_warehouse' => 'Destination Warehouse',
            'transfer_date' => 'Transfer Date',
            'remarks' => 'Remarks',
            'quantity' => 'Quantity',
            'newstock' => 'New Stock',
            'existingstock' => 'Existing Stock',
        ],
        'index' => [
            'title' => 'Transfer Stocks',
            'page_title' => 'Transfer Stocks',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Transfer Stock Lists',
            ],
            'table' => [
                'header' => [
                    'transfer_date' => 'Transfer Date',
                    'product' => 'Product',
                    'from' => 'From',
                    'to' => 'To',
                    'quantity' => 'Quantity',
                ],
            ],
        ],
        'show' => [
            'title' => 'Transfer Stocks',
            'page_title' => 'Transfer Stocks',
            'page_title_desc' => '',
            'header' => [
                'title' => [
                    'stock_location' => 'Stock Location',
                    'transferred_to' => 'Transferred To',
                    'stocks' => 'Stocks',
                    'stock_transfer' => 'Stock Transfer',
                ],
            ],
            'table' => [
                'header' => [
                    'select' => 'Select',
                    'product' => 'Product',
                    'current_qty' => 'Current Quantity',
                    'detail' => 'Details',
                    'remarks' => 'Remarks',
                    'qty_to_transfer' => 'Qty. to Transfer',
                    'destination' => 'Destination',
                ],
            ],
        ],
    ],
    'stockmerger' => [
        'create' => [
            'title' => 'Create Stock Merger',
            'page_title' => 'Create Stock Merger',
            'page_title_desc' => '',
            'header' => [
                'title' => [
                    'merger' => 'Merger Info',
                    'stock_lists' => 'Stock Lists',
                    'merger_remarks' => 'Remarks',
                ],
            ],
            'table' => [
                'stock' => [
                    'header' => [
                        'po_code' => 'Code',
                        'po_date' => 'Date',
                        'shipping_date' => 'Shipping Date',
                        'current_quantity' => 'Current Quantity',
                        'warehouse' => 'Warehouse',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => 'Stock Merger',
            'page_title' => 'Stock Merger',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Stock Merger Lists',
            ],
            'table' => [
                'header' => [
                    'merge_date' => 'Date',
                    'merge_type' => 'Type',
                    'product' => 'Product',
                    'remarks' => 'Remarks',
                ],
            ],
        ],
        'show' => [
            'title' => 'Show Stock Merger',
            'page_title' => 'Show Stock Merger',
            'page_title_desc' => '',
            'header' => [
                'title' => [
                    'merger' => 'Merger Info',
                    'stock_lists' => 'Stock Lists',
                    'merger_remarks' => 'Remarks',
                ],
            ],
            'table' => [
                'stock' => [
                    'header' => [
                        'po_code' => 'Code',
                        'po_date' => 'Date',
                        'shipping_date' => 'Shipping Date',
                        'current_quantity' => 'Current Quantity',
                        'warehouse' => 'Warehouse',
                    ],
                ],
            ],
        ],
        'field' => [
            'merger_date' => 'Date',
            'merge_type' => 'Type',
            'stock_lists' => 'Stock Lists',
            'remarks' => 'Remarks',
            'destination_warehouse' => 'Destination Warehouse',
        ],
    ],
];