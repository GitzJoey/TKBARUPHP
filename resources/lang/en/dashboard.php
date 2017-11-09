<?php 

return [
    'title' => 'Dashboard',
    'page_title' => 'Dashboard',
    'page_title_desc' => '',
    'last_opname' => [
        'title' => 'Last Opname',
        'label' => [
            'never' => 'Never',
            'no_data_found' => 'No data found',
        ],
    ],
    'daily_log' => [
        'button' => 'Daily Log'
    ],
    'last_bank_upload' => [
        'title' => 'Last Bank Upload',
        'label' => [
            'never' => 'Never',
            'no_data_found' => 'No data found',
        ],
    ],
    'last_price_update' => [
        'title' => 'Last Price Update',
        'label' => [
            'never' => 'Never',
            'no_data_found' => 'No data found',
        ],
    ],
    'number_of_created_so' => [
        'title' => 'Number of Created Sales Order',
    ],
    'so_total_amount' => [
        'title' => 'Sales Order Total Amount',
    ],
    'due_purchase_orders' => [
        'title' => 'Due Purchase Orders',
        'options' => [
            'all' => 'All',
            '1day' => '1 day',
            '3days' => '3 days',
            '5days' => '5 days',
        ],
        'table' => [
            'po_code' => 'PO Code',
            'supplier_name' => 'Supplier Name',
            'payment_due_date' => 'Payment Due Date',
        ],
        'button' => [
            'view_all_purchase_orders' => 'View All Purchase Orders',
        ],
    ],
    'due_sales_orders' => [
        'title' => 'Due Sales Orders',
        'options' => [
            'all' => 'All',
            '1day' => '1 day',
            '3days' => '3 days',
            '5days' => '5 days',
        ],
        'table' => [
            'so_code' => 'SO Code',
            'customer_name' => 'Customer Name',
            'payment_due_date' => 'Payment Due Date',
        ],
        'button' => [
            'view_all_sales_orders' => 'View All Sales Orders',
        ],
    ],
    'almost_due_giro' => [
        'title' => 'Almost Due Giro',
        'label' => [
            'serial_number' => 'Serial Number',
        ],
        'link' => [
            'view_all_giro' => 'View All Giro',
        ],
    ],
    'upcoming_events' => [
        'title' => 'Upcoming Events',
    ],
    'passive_customers' => [
        'title' => 'Passive Customers More Than a Month',
        'table' => [
            'header' => [
                'customer' => 'Customer',
            ],
        ],
    ],
    'unreceived_po' => [
        'title' => 'Unreceived Purchase Order',
        'link' => [
            'view_all_inflow' => 'View All Inflow',
        ],
    ],
    'undelivered_so' => [
        'title' => 'Undelivered Sales Order',
        'link' => [
            'view_all_outflow' => 'View All Outflow',
        ],
    ],
];