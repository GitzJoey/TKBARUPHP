<?php 

return [
    'invoice' => [
        'output' => [
            'create' => [
                'title' => 'Create New Invoice',
                'page_title' => 'Create New Invoice',
                'page_title_desc' => '',
            ],
            'index' => [
                'title' => 'e-Invoice',
                'page_title' => 'e-Invoice',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'List e-Invoice',
                ],
                'table' => [
                    'header' => [
                        'tin' => 'TaxOutput ID No',
                        'name' => 'Name',
                        'invoice_no' => 'Invoice No',
                        'invoice_date' => 'Invoice Date',
                        'code_type' => 'Code Type',
                        'month' => 'Month',
                        'year' => 'Year',
                        'invoice_status' => 'Invoice Status',
                        'tax_base' => 'TaxOutput Base',
                        'vat' => 'VAT',
                        'luxury_tax' => 'Luxury TaxOutput',
                        'approval_status' => 'Approval Status',
                        'approval_date' => 'Approval Date',
                        'description' => 'Description',
                        'signature' => 'Signature',
                        'reference' => 'Reference',
                    ],
                ],
            ],
            'show' => [
                'title' => '',
                'page_title' => '',
                'page_title_desc' => '',
            ],
            'edit' => [
                'title' => 'Edit Invoice',
                'page_title' => 'Edit Invoice',
                'page_title_desc' => '',
            ],
        ],
    ],
];