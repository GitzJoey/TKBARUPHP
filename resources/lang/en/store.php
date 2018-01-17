<?php 

return [
    'create' => [
        'title' => 'Store',
        'page_title' => 'Store',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Create Store',
        ],
        'tab' => [
            'store' => 'Store Data',
            'bank_account' => 'Bank Account',
            'currencies' => 'Currencies',
            'settings' => 'Settings',
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_name' => 'Account Name',
                'account_number' => 'Account Number',
                'remarks' => 'Remarks',
            ],
        ],
        'table_currencies' => [
            'header' => [
                'currencies' => 'Currencies',
                'base_currencies' => 'Base Currencies',
                'conversion_value' => 'Conversion Value',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'field' => [
        'name' => 'Name',
        'address' => 'Address',
        'phone' => 'Phone',
        'fax' => 'Fax',
        'tax_id' => 'TaxOutput ID',
        'status' => 'Status',
        'default' => 'Default',
        'frontweb' => 'Front Web',
        'remarks' => 'Remarks',
        'date_format' => 'Date Format',
        'time_format' => 'Time Format',
        'thousand_separator' => 'Thousand Separator',
        'decimal_separator' => 'Decimal Separator',
        'decimal_digit' => 'Decimal Digit',
        'none' => 'None',
        'comma' => 'Comma',
        'dot' => 'Dot',
        'space' => 'Space',
        'blue' => 'Blue',
        'black' => 'Black',
        'red' => 'Red',
        'yellow' => 'Yellow',
        'purple' => 'Purple',
        'green' => 'Green',
        'blue-light' => 'Light Blue',
        'black-light' => 'Light Black',
        'red-light' => 'Light Red',
        'yellow-light' => 'Light Yellow',
        'purple-light' => 'Light Purple',
        'green-light' => 'Light Green',
        'ribbon' => 'Ribbon',
        'latitude' => 'Latitude',
        'longitude' => 'Longitude',
        'dialog' => [
            'map' => [
                'title' => 'Choose Location',
                'address' => 'Address',
                'latitude' => 'Latitude',
                'longitude' => 'Longitude',
            ],
        ],
    ],
    'edit' => [
        'title' => 'Store',
        'page_title' => 'Store',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Edit Store',
        ],
    ],
    'index' => [
        'title' => 'Store',
        'page_title' => 'Store',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Store Lists',
        ],
        'table' => [
            'header' => [
                'name' => 'Name',
                'address' => 'Address',
                'tax_id' => 'TaxOutput ID',
                'default' => 'Default',
                'frontweb' => 'Front Web',
                'status' => 'Status',
                'remarks' => 'Remarks',
            ],
        ],
    ],
    'show' => [
        'title' => 'Store',
        'page_title' => 'Store',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Show Store',
        ],
    ],
];