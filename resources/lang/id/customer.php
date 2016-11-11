<?php 

return [
    'create' => [
        'title' => 'Pelanggan',
        'page_title' => 'Pelanggan',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Pelanggan',
        ],
        'tab' => [
            'customer' => 'Data Pelanggan',
            'pic' => 'Penanggung Jawab',
            'bank_account' => 'Akun Bank',
            'settings' => 'Pengaturan',
            'header' => [
                'bank_lists' => 'Daftar Akun Bank',
                'bank_inputs' => 'Tambah Akun Bank',
            ],
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Nomor',
                'remarks' => 'Keterangan',
            ],
        ],
        'table' => [
            'bank' => [
                'header' => [
                    'bank' => 'Bank',
                    'account_number' => 'Nomor Akun',
                    'remarks' => 'Keterangan',
                ],
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_number' => 'Nomor Akun',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'field' => [
        'name' => 'Nama',
        'address' => 'Alamat',
        'city' => 'Kota',
        'phone' => 'Telepon',
        'remarks' => 'Keterangan',
        'tax_id' => 'NPWP ID',
        'status' => 'Status',
        'first_name' => 'Nama Depan',
        'last_name' => 'Nama Belakang',
        'ic_num' => 'NPWP',
        'phone_number' => 'Telepon',
        'bank' => 'Bank',
        'bank_account' => 'Akun Bank',
        'price_level' => 'Tingkatan Harga',
        'payment_due_day' => 'Tenggat Pembayaran',
    ],
    'index' => [
        'title' => 'Pelanggan',
        'page_title' => 'Pelanggan',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Pelanggan',
        ],
        'table' => [
            'header' => [
                'name' => 'Nama',
                'address' => 'Alamat',
                'tax_id' => 'NPWP',
                'status' => 'Status',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'edit' => [
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'header' => [
            'title' => '',
        ],
        'tab' => [
            'customer' => '',
            'pic' => '',
            'bank_account' => '',
            'settings' => '',
            'header' => [
                'bank_lists' => '',
                'bank_inputs' => '',
            ],
        ],
        'table_phone' => [
            'header' => [
                'provider' => '',
                'number' => '',
                'remarks' => '',
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => '',
                'account_number' => '',
                'remarks' => '',
            ],
        ],
    ],
    'show' => [
        'title' => '',
        'page_title' => '',
        'page_title_desc' => '',
        'header' => [
            'title' => '',
        ],
        'tab' => [
            'customer' => '',
            'pic' => '',
            'bank_account' => '',
            'settings' => '',
            'header' => [
                'bank_lists' => '',
            ],
        ],
        'table_phone' => [
            'header' => [
                'provider' => '',
                'number' => '',
                'remarks' => '',
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => '',
                'account_number' => '',
                'remarks' => '',
            ],
        ],
    ],
    'confirmation' => [
        'index' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'so_code' => '',
                    'deliver_date' => '',
                    'deliverer' => '',
                    'items' => '',
                    'status' => '',
                ],
            ],
        ],
        'confirm' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'sales_order' => '',
                'items' => '',
            ],
            'field' => [
                'so_code' => '',
                'deliver_date' => '',
                'license_plate' => '',
                'confirm_receive_date' => '',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'unit' => '',
                        'brutto' => '',
                        'netto' => '',
                        'tare' => '',
                        'remarks' => '',
                    ],
                ],
            ],
        ],
        'approval' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'so_code' => '',
                    'shipping_date' => '',
                    'deliver_date' => '',
                    'confirm_receive_date' => '',
                    'status' => '',
                    'items' => [
                        'product_name' => '',
                        'brutto' => '',
                        'netto' => '',
                        'tare' => '',
                        'remarks' => '',
                    ],
                ],
            ],
        ],
    ],
];