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
            'currencies' => 'Mata Uang',
            'settings' => 'Pengaturan',
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_name' => 'Nama Rekening',
                'account_number' => 'Nomor Rekening',
                'remarks' => 'Catatan',
            ],
        ],
        'table_currencies' => [
            'header' => [
                'currencies' => 'Mata Uang',
                'base_currencies' => 'Mata Uang Dasar',
                'conversion_value' => 'Nilai Tukar',
                'remarks' => 'Catatan',
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
        'date_format' => 'Format Tanggal',
        'time_format' => 'Format Jam',
        'thousand_separator' => 'Pemisah Ribuan',
        'decimal_separator' => 'Pemisah Desimal',
        'decimal_digit' => 'Desimal Digit',
        'none' => 'Kosong',
        'comma' => 'Koma',
        'dot' => 'Titik',
        'space' => 'Spasi',
        'blue' => 'Biru',
        'black' => 'Hitam',
        'red' => 'Merah',
        'yellow' => 'Kuning',
        'purple' => 'Ungu',
        'green' => 'Hijau',
        'blue-light' => 'Biru Terang',
        'black-light' => 'Hitam Terang',
        'red-light' => 'Merah Terang',
        'yellow-light' => 'Kuning Terang',
        'purple-light' => 'Ungu Terang',
        'green-light' => 'Hijau Terang',
        'ribbon' => 'Pita',
        'latitude' => 'Garis Lintang',
        'longitude' => 'Garis Bujur',
        'dialog' => [
            'map' => [
                'title' => 'Pilih Lokasi',
                'address' => 'Alamat',
                'latitude' => 'Latitude',
                'longitude' => 'Longitude',
            ],
        ],
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