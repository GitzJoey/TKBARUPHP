<?php 

return [
    'create' => [
        'title' => 'Bank',
        'page_title' => 'Bank',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Bank',
        ],
    ],
    'field' => [
        'name' => 'Nama',
        'short_name' => 'Singkatan',
        'branch' => 'Cabang',
        'branch_code' => 'Kode Cabang',
        'status' => 'Status',
        'remarks' => 'Keterangan',
    ],
    'edit' => [
        'title' => 'Bank',
        'page_title' => 'Bank',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Ubah Bank',
        ],
    ],
    'index' => [
        'title' => 'Bank',
        'page_title' => 'Bank',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Daftar Bank',
        ],
        'table' => [
            'header' => [
                'name' => 'Nama',
                'short_name' => 'Singkatan',
                'branch' => 'Cabang',
                'branch_code' => 'Kode Cabang',
                'status' => 'Status',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'show' => [
        'title' => 'Bank',
        'page_title' => 'Bank',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tampilan Bank',
        ],
    ],
    'upload' => [
        'title' => 'Bank',
        'page_title' => 'Bank',
        'page_title_desc' => '',
        'header' => [
            'title' => [
                'upload' => 'Bank Upload',
                'history' => 'Riwayat Upload',
            ],
        ],
        'field' => [
            'bank' => 'Bank',
            'file' => 'File',
        ],
        'table' => [
            'header' => [
                'bank' => 'Bank',
                'upload_date' => 'Tanggal Upload',
                'file_name' => 'Nama File',
                'status' => 'Status',
            ],
        ],
    ],
    'consolidate' => [
        'index' => [
            'title' => 'Konsolidasi',
            'page_title' => 'Konsolidasi',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Konsolidasi',
            ],
            'table' => [
                'header' => [
                    'date' => 'Tanggal',
                    'remarks' => 'Keterangan',
                    'amount' => 'Jumlah',
                    'db_cr' => 'Debit/Kredit',
                    'balance' => 'Balance',
                ],
            ],
        ],
    ],
];