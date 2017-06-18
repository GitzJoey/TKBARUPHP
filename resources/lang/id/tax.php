<?php 

return [
    'invoice' => [
        'output' => [
            'create' => [
                'title' => 'Buat Faktur Baru',
                'page_title' => 'Buat Faktur Baru',
                'page_title_desc' => '',
            ],
            'index' => [
                'title' => 'e-Faktur',
                'page_title' => 'e-Faktur',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Daftar e-Faktur',
                ],
                'table' => [
                    'header' => [
                        'tin' => 'NPWP',
                        'name' => 'Nama',
                        'invoice_no' => 'Nomor Faktur',
                        'invoice_date' => 'Tanggal Faktur',
                        'code_type' => 'Tipe Jenis',
                        'month' => 'Masa',
                        'year' => 'Tahun',
                        'invoice_status' => 'Status Faktur',
                        'tax_base' => 'DPP',
                        'vat' => 'PPN',
                        'luxury_tax' => 'PPnBM',
                        'approval_status' => 'Status Approval',
                        'approval_date' => 'Tanggal Approval',
                        'description' => 'Keterangan',
                        'signature' => 'Penandatanganan',
                        'reference' => 'Referensi',
                    ],
                ],
            ],
            'show' => [
                'title' => '',
                'page_title' => '',
                'page_title_desc' => '',
            ],
            'edit' => [
                'title' => 'Edit Faktur',
                'page_title' => 'Edit Faktur',
                'page_title_desc' => '',
            ],
        ],
    ],
];