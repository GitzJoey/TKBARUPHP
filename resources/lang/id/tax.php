<?php

return [
    'invoice' => [
        'input' => [
            'create' => [
                'page_title' => 'Buat Faktur Pajak Baru',
                'page_title_desc' => '',
                'title' => [
                    'transaction_opponent' => 'Lawan Transaksi',
                    'spt_report' => 'Pelaporan SPT',
                    'tax_invoice_value' => 'Nilai Faktur Pajak',
                    'invoice_detail' => 'Uraian Faktur',
                ],
                'field' => [
                    'invoice_no' => 'Nomor Faktur',
                    'invoice_date' => 'Tanggal Dokumen Pajak',
                    'month' => 'Masa Pajak',
                    'year' => 'Tahun Pajak',
                    'opponent_tax_id_no' => 'NPWP Lawan Transaksi',
                    'opponent_name' => 'Nama Lawan Transaksi',
                    'is_creditable' => 'Apakah Faktur Masukan Pajak ini dapat dikreditkan?',
                    'detail' => 'Uraian',
                    'qty' => 'Satuan (kg)',
                    'unit_price' => 'Harga Satuan',
                    'tax_base' => 'Jumlah DPP',
                    'gst' => 'Jumlah PPN',
                    'luxury_tax' => 'Jumlah PPNBM'
                ],
                'misc' => [
                    'tax_id_no_placeholder' => 'Cari dengan NPWP atau Nama Supplier',
                    'tax_invoice_reporting_period' => 'Masa Pelaporan Faktur Pajak',
                    'yes' => 'Ya',
                    'no' => 'Tidak'
                ]
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
                        'opponent_tax_id_no' => 'NPWP',
                        'opponent_name' => 'Nama',
                        'invoice_no' => 'No Faktur',
                        'invoice_date' => 'Tanggal Dokumen Pajak',
                        'month' => 'Masa',
                        'year' => 'Tahun',
                        'is_creditable' => 'Dapat Dikredit',
                        'tax_base' => 'DPP',
                        'gst' => 'PPN',
                        'luxury_tax' => 'PPNBM',
                        'grand_total' => 'Total',
                    ],
                ],
            ],
            'show' => [
                'title' => 'Detail e-Faktur',
                'page_title' => 'Detail e-Faktur',
                'page_title_desc' => '',
            ],
            'edit' => [
                'title' => 'Edit e-Faktur',
                'page_title' => 'Edit e-Faktur',
                'page_title_desc' => '',
            ],
        ],
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
    'generate' => [
        'title' => 'Generate',
        'page_title' => 'Generate',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Generate'
        ],
        'nav_tabs' => [
            'import_pk' => 'Impor PK',
            'import_pm' => 'Impor PM',
        ],
        'import_pm' => [
            'table' => [
                'header' => [
                    'pm' => 'FM',
                    'transaction_type_code' => 'KD_JENIS_TRANSAKSI',
                    'fg_replacement' => 'FG_PENGGANTI',
                    'invoice_no' => 'NOMOR_FAKTUR',
                    'month' => 'MASA_PAJAK',
                    'year' => 'TAHUN_PAJAK',
                    'invoice_date' => 'TANGGAL_FAKTUR',
                    'tax_id_no' => 'NPWP',
                    'name' => 'NAMA',
                    'address' => 'ALAMAT',
                    'total_tax_base' => 'JUMLAH_DPP',
                    'total_gst' => 'JUMLAH_PPN',
                    'total_luxury_tax' => 'JUMLAH_PPNBM',
                    'is_creditable' => 'IS_CREDITABLE'
                ]
            ]
        ]
    ]
];
