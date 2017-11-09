<?php 

return [
    'title' => 'Dashboard',
    'page_title' => 'Dashboard',
    'page_title_desc' => '',
    'last_opname' => [
        'title' => 'Stock Opname Terakhir',
        'label' => [
            'never' => 'Belum Pernah',
            'no_data_found' => 'Tidak ada data ditemukan',
        ],
    ],
    'daily_log' => [
        'button' => 'Catatan Harian'
    ],
    'last_bank_upload' => [
        'title' => 'Upload Bank Terakhir',
        'label' => [
            'never' => 'Belum Pernah',
            'no_data_found' => 'Tidak ada data ditemukan',
        ],
    ],
    'last_price_update' => [
        'title' => 'Perbaharui Harga',
        'label' => [
            'never' => 'Belum Pernah',
            'no_data_found' => 'Tidak ada data ditemukan',
        ],
    ],
    'number_of_created_so' => [
        'title' => 'Jumlah Pembuatan Penjualan',
    ],
    'so_total_amount' => [
        'title' => 'Total Nominal Penjualan',
    ],
    'due_purchase_orders' => [
        'title' => 'Jatuh Tempo Pesanan Pembelian',
        'options' => [
            'all' => 'Semua',
            '1day' => '1 hari',
            '3days' => '3 hari',
            '5days' => '5 hari',
        ],
        'table' => [
            'po_code' => 'Kode Pembelian',
            'supplier_name' => 'Nama Supplier',
            'payment_due_date' => 'Tanggal Jatuh Tempo Pembayaran',
        ],
        'button' => [
            'view_all_purchase_orders' => 'Lihat Semua Pembelian',
        ],
    ],
    'due_sales_orders' => [
        'title' => 'Jatuh Tempo Pesanan Penjualan',
        'options' => [
            'all' => 'Semua',
            '1day' => '1 hari',
            '3days' => '3 hari',
            '5days' => '5 hari',
        ],
        'table' => [
            'so_code' => 'Kode Penjualan',
            'customer_name' => 'Nama Pelanggan',
            'payment_due_date' => 'Tanggal Jatuh Tempo Penjualan',
        ],
        'button' => [
            'view_all_sales_orders' => 'Lihat Semua Penjualan',
        ],
    ],
    'almost_due_giro' => [
        'title' => 'Giro yang Dekat Jatuh Tempo',
        'label' => [
            'serial_number' => 'Nomor Serial',
        ],
        'link' => [
            'view_all_giro' => 'Lihat Semua Giro',
        ],
    ],
    'upcoming_events' => [
        'title' => 'Event Mendatang',
    ],
    'passive_customers' => [
        'title' => 'Pelanggan yang Tidak Aktif',
        'table' => [
            'header' => [
                'customer' => 'Nama Pelanggan',
            ],
        ],
    ],
    'unreceived_po' => [
        'title' => 'Pembelian yang Belum Diterima',
        'link' => [
            'view_all_inflow' => 'Lihat Gudang Masuk',
        ],
    ],
    'undelivered_so' => [
        'title' => 'Penjualan yang Belum Dikirim',
        'link' => [
            'view_all_outflow' => 'Lihat Gudang Keluar',
        ],
    ],
];