<?php 

return [
    'invoice' => [
        'input' => [
            'create' => [
                'page_title' => 'Create New Tax Invoice',
                'page_title_desc' => '',
                'title' => [
                    'transaction_opponent' => 'Transaction Opponent',
                    'spt_report' => 'SPT Report',
                    'tax_invoice_value' => 'Tax Invoive Value',
                    'invoice_detail' => 'Invoice Detail',
                ],
                'field' => [
                    'invoice_no' => 'Invoice Number',
                    'invoice_date' => 'Tax Document Date',
                    'month' => 'Tax Month',
                    'year' => 'Tax Year',
                    'opponent_tax_id_no' => 'Opponent Tax ID',
                    'opponent_name' => 'Opponent Transaction Name',
                    'is_creditable' => 'Is this Tax Invoice Input creditable?',
                    'detail' => 'Detail',
                    'qty' => 'Unit (kg)',
                    'unit_price' => 'Unit Price',
                    'tax_base' => 'Tax Base',
                    'gst' => 'GST',
                    'luxury_tax' => 'PPNBM'
                ],
                'misc' => [
                    'tax_id_no_placeholder' => 'Find using Tax ID or Supplier Name',
                    'tax_invoice_reporting_period' => 'Tax Invoice Reporting Periode',
                    'yes' => 'Yes',
                    'no' => 'No'
                ]
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
                        'opponent_tax_id_no' => 'Tax ID',
                        'opponent_name' => 'Name',
                        'invoice_no' => 'Invoice Number',
                        'invoice_date' => 'Tax Document Date',
                        'month' => 'Month',
                        'year' => 'Year',
                        'is_creditable' => 'Creditable',
                        'tax_base' => 'Tax Base',
                        'gst' => 'GST',
                        'luxury_tax' => 'PPNBM',
                        'grand_total' => 'Grand Total',
                    ],
                ],
            ],
            'show' => [
                'title' => 'e-Invoice Detail',
                'page_title' => 'e-Invoice Detail',
                'page_title_desc' => '',
            ],
            'edit' => [
                'title' => 'e-Invoice Edit',
                'page_title' => 'e-Invoice Edit',
                'page_title_desc' => '',
            ],
        ],
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
    'generate' => [
        'title' => 'Generate',
        'page_title' => 'Generate',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Generate'
        ],
        'nav_tabs' => [
            'import_pk' => 'Import PK',
            'import_pm' => 'Import PM',
        ],
        'import_pm' => [
            'table' => [
                'header' => [
                    'pm' => 'FM',
                    'transaction_type_code' => 'CD_TRANSACTION_TYPE',
                    'fg_replacement' => 'FG_REPLACEMENT',
                    'invoice_no' => 'INVOICE_NO',
                    'month' => 'MONTH',
                    'year' => 'YEAR',
                    'invoice_date' => 'INVOICE_DATE',
                    'tax_id_no' => 'TAX_ID',
                    'name' => 'NAME',
                    'address' => 'ADDRESS',
                    'total_tax_base' => 'TOTAL_TAX_BASE',
                    'total_gst' => 'TOTAL_GST',
                    'total_luxury_tax' => 'TOTAL_LUXURY_TAX',
                    'is_creditable' => 'IS_CREDITABLE'
                ]
            ]
        ]
    ]
];
