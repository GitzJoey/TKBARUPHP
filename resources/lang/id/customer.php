<?php 

return [
    'confirmation' => [
        'approval' => [
            'title' => 'Persetujuan Penjualan',
            'page_title' => 'Persetujuan Penjualan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Penjualan',
            ],
            'table' => [
                'header' => [
                    'so_code' => 'Kode Penjualan',
                    'shipping_date' => 'Tgl Pengiriman',
                    'deliver_date' => 'Tgl Terima',
                    'confirm_receive_date' => 'Tgl Konfirmasi',
                    'status' => 'Status',
                    'items' => [
                        'product_name' => 'Produk',
                        'brutto' => 'Bruto',
                        'netto' => 'Netto',
                        'tare' => 'Tare',
                        'remarks' => 'Keterangan',
                    ],
                ],
            ],
        ],
        'confirm' => [
            'title' => 'Konfirmasi Penjualan',
            'page_title' => 'Konfirmasi Penjualan',
            'page_title_desc' => '',
            'box' => [
                'sales_order' => 'Penjualan',
                'items' => 'Items',
            ],
            'field' => [
                'so_code' => 'Kode Penjualan',
                'deliver_date' => 'Tgl Terima',
                'license_plate' => 'Plat Nomor',
                'confirm_receive_date' => 'Tgl Konfirmasi',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'unit' => 'Unit',
                        'brutto' => 'Bruto',
                        'netto' => 'Netto',
                        'tare' => 'Tare',
                        'remarks' => 'Keterangan',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => 'Konfirmasi',
            'page_title' => 'Konfirmasi',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Penjualan',
            ],
            'table' => [
                'header' => [
                    'so_code' => 'Kode Penjualan',
                    'deliver_date' => 'Tgl Kirim',
                    'deliverer' => 'Pengirim',
                    'items' => 'Item',
                ],
            ],
        ],
    ],
    'create' => [
        'title' => 'Pelanggan',
        'page_title' => 'Pelanggan',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Pelanggan',
        ],
        'tab' => [
            'customer' => 'Data Pelanggan',
            'pic' => 'Penanggungjawab',
            'bank_account' => 'Akun Bank',
            'expenses' => 'Biaya',
            'settings' => 'Setting',
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Nomor Telp',
                'remarks' => 'Keterangan',
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_name' => 'Nama Akun',
                'account_number' => 'Nomor Akun',
                'remarks' => 'Keterangan',
            ],
        ],
        'table_expense' => [
            'header' => [
                'name' => 'Nama',
                'type' => 'Tipe',
                'amount' => 'Jumlah',
                'internal_expense' => 'Internal',
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
        'ic_num' => 'KTP',
        'phone_number' => 'Telepon',
        'price_level' => 'Tingkatan Harga',
        'payment_due_day' => 'Tenggat Pembayaran',
        'person_in_charge' => 'Penanggungjawab',
        'mileage' => 'Jarak Tempuh',
        'distance' => 'Jarak Tempuh',
        'duration' => 'Lama Tempuh',
        'latitude' => 'Latitude',
        'longitude' => 'Longitude',
    ],
    'edit' => [
        'title' => 'Pelanggan',
        'page_title' => 'Pelanggan',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Ubah Pelanggan',
        ],
        'tab' => [
            'customer' => 'Data Pelanggan',
            'pic' => 'Penanggungjawab',
            'bank_account' => 'Akun Bank',
            'expenses' => 'Biaya',
            'settings' => 'Setting',
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Nomor Telp',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'index' => [
        'title' => 'Pelanggan',
        'page_title' => 'Pelanggan',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Daftar Pelanggan',
        ],
        'table' => [
            'header' => [
                'name' => 'Nama',
                'address' => 'Alamat',
                'tax_id' => 'TaxOutput ID',
                'status' => 'Status',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'payment' => [
        'cash' => [
            'title' => 'Pembayaran Tunai',
            'page_title' => 'Pembayaran Tunai',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran Tunai',
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Keterangan',
                'payment_history' => 'Catatan Pembayaran',
            ],
            'field' => [
                'payment_type' => 'Pembayaran',
                'payment_date' => 'Tgl Pembayaran',
                'payment_amount' => 'Jumlah',
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'shipping_date' => 'Tgl Pengiriman',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Penyedia Truck',
            ],
            'so_code' => 'Kode Penjualan',
            'so_type' => 'Tipe',
            'so_date' => 'Tgl Penjualan',
            'so_status' => 'Status',
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Produk',
                        'quantity' => 'Jumlah',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                        'paid_amount' => 'Pembayaran',
                        'to_be_paid_amount' => 'Kurang Bayar',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => 'Pembayaran Tunai',
                        'payment_date' => 'Tgl Pembayaran',
                        'payment_status' => 'Status',
                        'payment_amount' => 'Jumlah',
                        'transfer' => 'Pembayaran Transfer',
                        'effective_date' => 'Tgl Efektif',
                        'account_from' => 'Dari Akun',
                        'account_to' => 'Ke Akun',
                        'giro' => 'Giro',
                        'bank' => 'Bank',
                        'serial_number' => 'Nomor Serial',
                        'printed_name' => 'Nama Tertera',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => 'Pembayaran Pelanggan',
            'page_title' => 'Pembayaran Pelanggan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Penjualan',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode Penjualan',
                    'so_date' => 'Tgl Penjualan',
                    'total' => 'Total',
                    'paid' => 'Terbayar',
                    'rest' => 'Sisa Pembayaran',
                ],
            ],
        ],
        'transfer' => [
            'title' => 'Pembayaran Transfer',
            'page_title' => 'Pembayaran Transfer',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Pembayaran Transfer',
            ],
            'field' => [
                'payment_type' => 'Tipe',
                'bank_from' => 'Dari Bank',
                'bank_to' => 'Ke Bank',
                'payment_date' => 'Tgl Transfer',
                'effective_date' => 'Tgl Efektif',
                'payment_amount' => 'Jumlah',
            ],
        ],
    ],
    'show' => [
        'title' => 'Pelanggan',
        'page_title' => 'Pelanggan',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tampilkan Pelanggan',
        ],
        'tab' => [
            'customer' => 'Data Pelanggan',
            'pic' => 'Penanggungjawab',
            'bank_account' => 'Akun Bank',
            'expenses' => 'Biaya',
            'settings' => 'Setting',
        ],
        'table_phone' => [
            'header' => [
                'provider' => 'Provider',
                'number' => 'Nomor Telp',
                'remarks' => 'Keterangan',
            ],
        ],
        'table_bank' => [
            'header' => [
                'bank' => 'Bank',
                'account_name' => 'Nama Akun',
                'account_number' => 'Nomor Akun',
                'remarks' => 'Keterangan',
            ],
        ],
        'table_expense' => [
            'header' => [
                'name' => 'Nama',
                'type' => 'tipe',
                'amount' => 'Jumlah',
                'internal_expense' => 'Internal',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
];