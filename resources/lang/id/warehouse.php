<?php 

return [
    'inflow' => [
        'index' => [
            'title' => 'Barang Masuk',
            'page_title' => 'Barang Masuk',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Barang Masuk'
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal Pembuatan',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Tanggal Pengiriman',
                    'status' => 'Status'
                ]
            ],
            'header' => [
                'warehouse' => 'Gudang',
                'purchase_order' => 'Pembelian'
            ]
        ]
    ],
    'create' => [
        'title' => 'Gudang',
        'page_title' => 'Gudang',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Gudang',
        ],
    ],
    'field' => [
        'name' => 'Nama',
        'address' => 'Alamat',
        'phone_num' => 'Telepon',
        'status' => 'Status',
        'remarks' => 'Keterangan',
    ],
    'edit' => [
        'title' => 'Gudang',
        'page_title' => 'Gudang',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Ubah Gudang',
        ],
    ],
    'index' => [
        'title' => 'Gudang',
        'page_title' => 'Gudang',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Daftar Gudang',
        ],
        'table' => [
            'header' => [
                'name' => 'Nama',
                'address' => 'Alamat',
                'phone_num' => 'Telepon',
                'status' => 'Status',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'show' => [
        'title' => 'Gudang',
        'page_title' => 'Gudang',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tampilan Gudang',
        ],
    ],
];