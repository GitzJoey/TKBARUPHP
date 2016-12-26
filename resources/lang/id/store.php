<?php 

return [
    'create' => [
        'title' => 'Toko',
        'page_title' => 'Toko',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Toko',
        ],
        'tab' => [
            'store' => 'Data Toko',
            'bank_account' => 'Rekening Bank',
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_number' => 'Nomor Rekening',
                'remarks' => 'Catatan',
                'account_name' => '',
            ],
        ],
    ],
    'field' => [
        'name' => 'Nama',
        'address' => 'Alamat',
        'phone' => 'Telepon',
        'fax' => 'Fax',
        'tax_id' => 'NPWP No.',
        'status' => 'Status',
        'default' => 'Utama',
        'frontweb' => 'Web Utama',
        'remarks' => 'Keterangan',
    ],
    'edit' => [
        'title' => 'Toko',
        'page_title' => 'Toko',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Ubah Toko',
        ],
    ],
    'index' => [
        'title' => 'Toko',
        'page_title' => 'Toko',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Daftar Toko',
        ],
        'table' => [
            'header' => [
                'name' => 'Nama',
                'address' => 'Alamat',
                'tax_id' => 'NPWP No.',
                'default' => 'Utama',
                'frontweb' => 'Web Utama',
                'status' => 'Status',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'show' => [
        'title' => 'Toko',
        'page_title' => 'Toko',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tampilan Toko',
        ],
    ],
];