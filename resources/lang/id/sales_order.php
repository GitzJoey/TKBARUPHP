<?php 

return [
    'payment' => [
        'giro' => [
            'title' => 'Pembayaran Giro',
            'page_title' => 'Pembayaran Giro',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Tambah Pembayaran Giro',
            ],
            'field' => [
                'payment_type' => 'Tipe Pembayaran',
                'bank' => 'Bank',
                'serial_number' => 'Nomor Seri',
                'payment_date' => 'Tanggal Pembayaran',
                'effective_date' => 'Tanggal Efektif',
                'payment_amount' => 'Jumlah',
                'printed_name' => 'Nama Tertera',
                'remarks' => 'Keterangan',
            ],
        ],
        'cash' => [
            'title' => 'Pembayaran Tunai',
            'page_title' => 'Pembayaran Tunai',
            'page_title_desc' => '',
            'box' => [
                'payment' => 'Tambah Pembayaran Tunai',
            ],
            'field' => [
                'payment_type' => 'Tipe Pembayaran',
                'payment_date' => 'Tanggal Pembayaran',
                'payment_amount' => 'Jumlah',
            ],
        ],
        'index' => [
            'title' => 'Pembayaran',
            'page_title' => 'Pembayaran',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Pembayaran',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'customer' => 'Pelanggan',
                    'so_date' => 'Tanggal',
                    'total' => 'Total',
                    'paid' => 'Pembayaran',
                    'rest' => 'Sisa Pembayaran',
                ],
            ],
        ],
        'summary' => [
            'box' => [
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Keterangan',
                'payment_history' => 'Catatan Pembayaran',
                'payment' => '',
            ],
            'field' => [
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'so_code' => 'Kode',
                'so_type' => 'Tipe',
                'so_date' => 'Tanggal',
                'so_status' => 'Status',
                'shipping_date' => 'Pengiriman',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                        'quantity' => 'Jumlah',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                        'paid_amount' => 'Total Yang Sudah Dibayar',
                        'to_be_paid_amount' => 'Total Yang Harus Dibayar',
                    ],
                ],
                'total_discount' => [
                    'header' => [
                        'total_discount_desc' => '',
                        'percentage' => 'Persentase',
                        'value' => 'Nilai',
                        'total_discount' => 'Diskon',
                    ],
                ],
                'payments' => [
                    'header' => [
                        'cash' => 'Tunai',
                        'payment_date' => 'Tanggal Bayar',
                        'payment_status' => 'Status',
                        'payment_amount' => 'Jumlah',
                        'transfer' => 'Transfer',
                        'effective_date' => 'Tgl Efektif',
                        'account_from' => 'Dari Akun',
                        'account_to' => 'Ke Akun',
                        'giro' => 'Giro',
                        'bank' => 'Bank',
                        'serial_number' => 'Nomor Seri',
                        'printed_name' => 'Nama Tertera',
                    ],
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
                'payment_date' => 'Tgl Bayar',
                'effective_date' => 'Tgl Efektif',
                'payment_amount' => 'Jumlah',
            ],
        ],
        'broughtforward' => [
            'title' => 'Pengalihan Tagihan',
            'page_title' => 'Pengalihan Tagihan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Pengalihan Tagihan',
            ],
            'invoice' => [
                'next' => 'Gabung Nota',
                'so_code' => 'Kode Penjualan',
                'name' => 'Nama',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'copy' => [
        'create' => [
            'title' => 'Duplikat Penjualan',
            'page_title' => 'Duplikat Penjualan',
            'page_title_desc' => '',
            'box' => [
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail Penjualan',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Keterangan',
                'so_copy_remarks' => 'Keterangan Duplikat',
            ],
            'field' => [
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail',
                'so_code' => 'Kode',
                'so_copy_code' => 'Kode Duplikat',
                'so_type' => 'Tipe',
                'so_date' => 'Tanggal',
                'shipping_date' => 'Tgl Kirim',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
                'so_status' => 'Status',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'quantity' => 'Jumlah',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                    ],
                ],
            ],
        ],
        'edit' => [
            'title' => 'Ubah Duplikat',
            'page_title' => 'Ubah Duplikat',
            'page_title_desc' => '',
            'box' => [
                'customer' => 'Pelanggan',
                'sales_order_detail' => 'Detail Penjualan',
                'shipping' => 'Pengiriman',
                'transactions' => 'Transaksi',
                'remarks' => 'Keterangan',
                'so_copy_remarks' => 'Keterangan Duplikat',
            ],
            'field' => [
                'customer_type' => 'Tipe',
                'customer_name' => 'Nama',
                'customer_details' => 'Detail Penjualan',
                'so_code' => 'Kode',
                'so_copy_code' => 'Kode Duplikat',
                'so_type' => 'Tipe',
                'so_date' => 'Tanggal',
                'shipping_date' => 'Tgl Kirim',
                'warehouse' => 'Gudang',
                'vendor_trucking' => 'Layanan Angkutan',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'quantity' => 'Jumlah',
                        'unit' => 'Satuan',
                        'price_unit' => 'Harga',
                        'total_price' => 'Total Harga',
                    ],
                ],
                'total' => [
                    'body' => [
                        'total' => 'Total',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => 'Duplikat Penjualan',
            'page_title' => 'Duplikat Penjualan',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Cari Penjualan',
                'title' => 'Penjualan',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'so_date' => 'Tanggal Penjualan',
                    'customer' => 'Pelanggan',
                    'shipping_date' => 'Tanggal Kirim',
                ],
            ],
        ],
        'search' => [
            'so_not_found' => 'Kode Penjualan Tidak Ditemukan',
            'title' => 'Duplikat Penjualan',
            'page_title' => 'Duplikat Penjualan',
            'page_title_desc' => '',
            'header' => [
                'search' => 'Cari Penjualan',
            ],
        ],
    ],
    'create' => [
        'box' => [
            'transaction_summary' => 'Transaksi',
            'last_sale' => 'Penjualan Terakhir',
            'open_sales' => 'Penjualan Terbuka',
            'latest_prices' => 'Harga Terbaru',
            'customer' => 'Pelanggan',
            'sales_order_detail' => 'Detail Penjualan',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'expenses' => 'Biaya',
            'remarks' => 'Keterangan',
            'total_discount' => 'Diskon',
        ],
        'title' => 'Penjualan',
        'page_title' => 'Penjualan',
        'page_title_desc' => '',
        'field' => [
            'customer_type' => 'Tipe',
            'customer_name' => 'Nama',
            'customer_details' => 'Detail',
            'shipping_date' => 'Tgl Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Layanan Angkutan',
        ],
        'so_code' => 'Kode',
        'so_type' => 'Tipe',
        'so_date' => 'Tanggal SO',
        'so_status' => 'Status',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Nama Produk',
                    'quantity' => 'Jumlah',
                    'unit' => 'Satuan',
                    'price_unit' => 'Harga',
                    'total_price' => 'Total Harga',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => 'Nama',
                    'type' => 'Tipe',
                    'remarks' => 'Keterangan',
                    'amount' => 'Jumlah',
                    'internal_expense' => 'Internal',
                ],
            ],
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => 'Persentase',
                    'value' => 'Nilai',
                    'total_discount' => 'Diskon',
                ],
            ],
            'open_sales' => [
                'header' => [
                    'code' => 'Kode',
                    'so_date' => 'Tgl Penjualan',
                    'status' => 'Status',
                    'amount' => 'Total',
                ],
            ],
            'latest_prices' => [
                'header' => [
                    'product_name' => 'Nama Produk',
                    'market_price' => 'Harga Pasar',
                    'latest_price' => 'Harga Terbaru',
                ],
            ],
        ],
        'tab' => [
            'sales' => 'Penjualan',
            'remarks' => 'Keterangan',
            'internal' => 'Internal',
            'private' => 'Private',
        ],
        'so_copy_code' => '',
    ],
    'edit' => [
        'box' => [
            'transaction_summary' => 'Ringkasan Transaksi',
        ],
    ],
    'revise' => [
        'index' => [
            'title' => 'Revisi Penjualan',
            'page_title' => 'Revisi Penjualan',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Revisi Penjualan',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'so_date' => 'Tgl Penjualan',
                    'customer' => 'Pelanggan',
                    'shipping_date' => 'Tgl Kirim',
                    'status' => 'Status',
                ],
            ],
        ],
        'title' => 'Revisi Penjualan',
        'page_title' => 'Revisi Penjualan',
        'page_title_desc' => '',
        'box' => [
            'customer' => 'Pelanggan',
            'sales_order_detail' => 'Detail',
            'shipping' => 'Pengiriman',
            'transactions' => 'Transaksi',
            'expenses' => 'Biaya',
            'remarks' => 'Keterangan',
        ],
        'field' => [
            'customer_type' => 'Tipe',
            'customer_name' => 'Nama',
            'customer_details' => 'Detail',
            'shipping_date' => 'Tanggal Pengiriman',
            'warehouse' => 'Gudang',
            'vendor_trucking' => 'Layanan Angkutan',
        ],
        'so_code' => 'Kode',
        'so_type' => 'Tipe',
        'so_date' => 'Tgl Penjualan',
        'so_status' => 'Status',
        'table' => [
            'item' => [
                'header' => [
                    'product_name' => 'Nama Produk',
                    'quantity' => 'Jumlah',
                    'unit' => 'Satuan',
                    'price_unit' => 'Harga',
                    'total_price' => 'Total Harga',
                ],
            ],
            'total' => [
                'body' => [
                    'total' => 'Total',
                ],
            ],
            'expense' => [
                'header' => [
                    'name' => 'Nama',
                    'type' => 'Tipe',
                    'remarks' => 'Keterangan',
                    'amount' => 'Jumlah',
                ],
            ],
            'total_discount' => [
                'header' => [
                    'total_discount_desc' => '',
                    'percentage' => 'Persentase',
                    'value' => 'Nilai',
                    'total_discount' => 'Diskon',
                ],
            ],
        ],
        'tab' => [
            'remarks' => 'Keterangan',
            'internal' => 'Internal',
            'private' => 'Privat',
        ],
    ],
    'partial' => [
        'customer' => [
            'title' => '',
            'tab' => [
                'customer' => 'Data Pelanggan',
                'pic' => 'Penanggungjawab',
                'bank_account' => 'Akun Bank',
                'sales_orders' => 'Penjualan',
                'settings' => 'Setting',
            ],
            'field' => [
                'name' => 'Nama',
                'address' => 'Alamat',
                'city' => 'Kota',
                'phone' => 'Telepon',
                'tax_id' => 'NPWP No',
                'remarks' => 'Keterangan',
                'first_name' => 'Nama Depan',
                'last_name' => 'Nama Belakang',
                'ic_num' => 'KTP No.',
                'phone_number' => 'No Telepon',
                'price_level' => 'Tingkat Harga',
                'payment_due_day' => 'Tenggat Pembayaran',
            ],
            'table_phone' => [
                'header' => [
                    'provider' => 'Provider',
                    'number' => 'Nomor',
                    'remarks' => 'Keterangan',
                ],
            ],
            'table_bank' => [
                'header' => [
                    'bank' => 'Bank',
                    'account_number' => 'Nomor Akun',
                    'remarks' => 'Keterangan',
                ],
            ],
            'table_sales_orders' => [
                'header' => [
                    'code' => 'Kode',
                    'so_date' => 'Tgl Penjualan',
                    'shipping_date' => 'Tgl Kirim',
                    'status' => 'Status',
                ],
            ],
        ],
    ],
];