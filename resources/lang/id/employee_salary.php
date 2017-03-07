<?php 

return [
    'create' => [
        'title' => 'Gaji Pegawai',
        'page_title' => 'Gaji Pegawai',
        'page_title_desc' => '',
        'pay_salary' => 'Bayar Gaji',
        'header' => [
            'title' => 'Tambah Transaksi Pegawai',
            'employee_transaction' => 'Transaksi Pegawai',
        ],
        'table_employee' => [
            'header' => [
                'name' => 'Name',
                'ic_number' => 'No KTP',
                'address' => 'Alamat',
                'start_date' => 'Mulai Kerja',
                'freelance' => 'Paruh Waktu',
                'balance' => 'Saldo',
                'last_payment'=>'Pembayaran Terakhir'
            ],
        ],
    ],
    'field' => [
        'created_at' => 'Tanggal Transaksi',
        'employee' => 'Pegawai',
        'amount' => 'Jumlah',
        'balance' => 'Saldo',
        'title' => 'Keperluan',
        'type' => 'Jenis',
        'description' => 'Keterangan',
    ],
    'index' => [
        'title' => 'Gaji Pegawai',
        'page_title' => 'Gaji Pegawai',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Daftar Gaji Pegawai',
        ],
        'table' => [
            'header' => [
                'name' => 'Name',
                'address' => 'Alamat',
                'ic_number' => 'No KTP',
                'start_date' => 'Mulai Kerja',
                'freelance' => 'Paruh Waktu',
                'balance' => 'Saldo',
                'last_payment'=>'Pembayaran Terakhir'
            ],
        ],
    ],
    'show' => [
        'title' => 'Gaji Pegawai',
        'plus' => 'Tambahkan',
        'minus' => 'Kurangi',
        'page_title' => 'Gaji Pegawai',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tampilkan Pegawai',
        ],
    ],
];