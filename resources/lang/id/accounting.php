<?php 

return [
    'cash_flow' => [
        'index' => [
            'title' => 'Arus Kas',
            'page_title' => 'Arus Kas',
            'page_title_desc' => '',
        ],
    ],
    'cash' => [
        'index' => [
            'title' => 'Kas',
            'page_title' => 'Kas',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Kas',
            ],
            'table' => [
                'header' => [
                    'type' => 'Tipe',
                    'code' => 'Kode',
                    'name' => 'Nama',
                    'is_default' => 'Utama',
                    'status' => 'Status',
                ],
            ],
        ],
        'create' => [
            'title' => 'Kas',
            'page_title' => 'Kas',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Tambah Kas',
            ],
        ],
        'edit' => [
            'title' => 'Kas',
            'page_title' => 'Kas',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Ubah Kas',
            ],
        ],
        'show' => [
            'title' => 'Kas',
            'page_title' => 'Kas',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Tampilkan Kas',
            ],
        ],
        'field' => [
            'type' => 'Tipe',
            'code' => 'Kode',
            'name' => 'Nama',
            'is_default' => 'Utama',
            'status' => 'Status',
        ],
    ],
    'cost' => [
        'category' => [
            'index' => [
                'title' => 'Kategori Biaya',
                'page_title' => 'Kategori Biaya',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Daftar Kategori Biaya',
                ],
                'table' => [
                    'header' => [
                        'group' => 'Grup',
                        'name' => 'Nama',
                    ],
                ],
            ],
            'create' => [
                'title' => 'Kategori Biaya',
                'page_title' => 'Kategori Biaya',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Tambah Kategori Biaya',
                ],
            ],
            'field' => [
                'group' => 'Grup',
                'name' => 'Nama',
            ],
            'edit' => [
                'title' => 'Kategori Biaya',
                'page_title' => 'Kategori Biaya',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Ubah Kategori Biaya',
                ],
            ],
            'show' => [
                'title' => 'Kategori Biaya',
                'page_title' => 'Kategori Biaya',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Tampilkan Kategori Biaya',
                ],
            ],
        ],
        'index' => [
            'title' => 'Biaya',
            'page_title' => 'Biaya',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Biaya',
            ],
            'table' => [
                'header' => [
                    'date' => 'Tanggal',
                    'source_account' => 'Rekening Sumber',
                    'cost_category' => 'Kategori',
                    'amount' => 'Jumlah',
                    'remarks' => 'Keterangan',
                ],
            ],
        ],
        'create' => [
            'title' => 'Biaya',
            'page_title' => 'Biaya',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Tambah Biaya',
            ],
        ],
        'field' => [
            'date' => 'Tanggal',
            'name' => 'Nama',
            'source_account' => 'Rekening Sumber',
            'category' => 'Kategori',
            'amount' => 'Jumlah',
            'remarks' => 'Keterangan',
        ],
        'edit' => [
            'title' => 'Biaya',
            'page_title' => 'Biaya',
            'page_title_desc' => '',
        ],
    ],
    'revenue' => [
        'category' => [
            'index' => [
                'title' => 'Kategori Pendapatan',
                'page_title' => 'Kategori Pendapatan',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Daftar Kategori Pendapatan',
                ],
                'table' => [
                    'header' => [
                        'group' => 'Grup',
                        'name' => 'Nama',
                    ],
                ],
            ],
            'create' => [
                'title' => 'Kategori Pendapatan',
                'page_title' => 'Kategori Pendapatan',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Tambah Kategori Pendapatan',
                ],
            ],
            'field' => [
                'group' => 'Grup',
                'name' => 'Nama',
            ],
            'edit' => [
                'title' => 'Kategori Pendapatan',
                'page_title' => 'Kategori Pendapatan',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Ubah Kategori Pendapatan',
                ],
            ],
            'show' => [
                'title' => 'Kategori Pendapatan',
                'page_title' => 'Kategori Pendapatan',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Tampilkan Kategori Pendapatan',
                ],
            ],
        ],
        'index' => [
            'title' => 'Pendapatan',
            'page_title' => 'Pendapatan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Pendapatan',
            ],
            'table' => [
                'header' => [
                    'date' => 'Tanggal',
                    'destination_account' => 'Rekening Tujuan',
                    'cost_category' => 'Kategori',
                    'amount' => 'Jumlah',
                    'remarks' => 'Keterangan',
                ],
            ],
        ],
        'edit' => [
            'title' => 'Pendapatan',
            'page_title' => 'Pendapatan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Ubah Pendapatan',
            ],
            'field' => [
                'date' => 'Tanggal',
                'name' => 'Nama',
                'source_account' => 'Rekening Sumber',
                'category' => 'Kategori',
                'amount' => 'Jumlah',
                'remarks' => 'Keterangan',
            ],
        ],
        'field' => [
            'date' => 'Tanggal',
            'name' => 'Nama',
            'source_account' => 'Rekening Sumber',
            'category' => 'Kategori',
            'amount' => 'Jumlah',
            'remarks' => 'Keterangan',
        ],
        'create' => [
            'page_title' => 'Pendapatan',
            'page_title_desc' => 'Pendapatan',
            'header' => [
                'title' => 'Tambah Pendapatan',
            ],
            'field' => [
                'date' => 'Tanggal',
                'name' => 'Nama',
                'source_account' => 'Rekening Sumber',
                'category' => 'Kategori',
                'amount' => 'Jumlah',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'capital' => [
        'deposit' => [
            'title' => 'Tambah Modal',
            'page_title' => 'Tambah Modal',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Tambah Modal',
            ],
            'field' => [
                'date' => 'Tanggal',
                'destination_account' => 'Akun Tujuan',
                'amount' => 'Jumlah',
                'remarks' => 'Keterangan',
            ],
            'index' => [
                'title' => 'Tambah Modal',
                'page_title' => 'Tambah Modal',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Daftar Tambah Modal',
                ],
                'table' => [
                    'header' => [
                        'date' => 'Tanggal',
                        'destination_account' => 'Akun Tujuan',
                        'amount' => 'Jumlah',
                        'remarks' => 'Keterangan',
                    ],
                ],
            ],
        ],
        'withdrawal' => [
            'title' => 'Tarik Modal',
            'page_title' => 'Tarik Modal',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Tarik Modal',
            ],
            'field' => [
                'date' => 'Tanggal',
                'source_account' => 'Akun Sumber',
                'amount' => 'Jumlah',
                'remarks' => 'Keterangan',
            ],
            'index' => [
                'title' => 'Tarik Modal',
                'page_title' => 'Tarik Modal',
                'page_title_desc' => '',
                'header' => [
                    'title' => 'Daftar Tarik Modal',
                ],
                'table' => [
                    'header' => [
                        'date' => 'Tanggal',
                        'source_account' => 'Akun Sumber',
                        'amount' => 'Jumlah',
                        'remarks' => 'Keterangan',
                    ],
                ],
            ],
        ],
    ],
];