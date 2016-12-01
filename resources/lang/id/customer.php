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
            'expenses' => 'Biaya Default',
            'header' => [
                'bank_lists' => 'Daftar Akun Bank',
                'bank_inputs' => 'Tambah Akun Bank',
            ],
            'product' => '',
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
        'table_expense' => [
            'header' => [
                'name' => 'Nama',
                'type' => 'Tipe',
                'amount' => 'Nilai',
                'remarks' => 'Catatan',
            ],
        ],
        'table_prod' => [
            'header' => [
                'type' => '',
                'name' => '',
                'short_code' => '',
                'description' => '',
                'remarks' => '',
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
            'expenses' => 'Biaya Default',
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
        'table_expense' => [
            'header' => [
                'name' => 'Nama',
                'type' => 'Tipe',
                'amount' => 'Nilai',
                'remarks' => 'Catatan',
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
    'payment' => [
        'index' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'code' => '',
                    'so_date' => '',
                    'total' => '',
                    'paid' => '',
                    'rest' => '',
                ],
            ],
        ],
        'cash' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
                'customer' => '',
                'sales_order_detail' => '',
                'shipping' => '',
                'transactions' => '',
                'remarks' => '',
                'payment_history' => '',
            ],
            'field' => [
                'payment_type' => '',
                'payment_date' => '',
                'payment_amount' => '',
                'customer_type' => '',
                'customer_name' => '',
                'customer_details' => '',
                'shipping_date' => '',
                'warehouse' => '',
                'vendor_trucking' => '',
            ],
            'so_code' => '',
            'so_type' => '',
            'so_date' => '',
            'so_status' => '',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'quantity' => '',
                        'unit' => '',
                        'price_unit' => '',
                        'total_price' => '',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => '',
                        'paid_amount' => '',
                        'to_be_paid_amount' => '',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => '',
                        'payment_date' => '',
                        'payment_status' => '',
                        'payment_amount' => '',
                        'transfer' => '',
                        'effective_date' => '',
                        'account_from' => '',
                        'account_to' => '',
                        'giro' => '',
                        'bank' => '',
                        'serial_number' => '',
                        'printed_name' => '',
                    ],
                ],
            ],
        ],
        'transfer' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'payment' => '',
            ],
            'field' => [
                'payment_type' => '',
                'bank_from' => '',
                'bank_to' => '',
                'payment_date' => '',
                'effective_date' => '',
                'payment_amount' => '',
            ],
        ],
    ],
];