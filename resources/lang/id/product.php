<?php 

return [
    'create' => [
        'title' => 'Produk',
        'page_title' => 'Produk',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Produk',
        ],
        'table' => [
            'product' => [
                'header' => [
                    'unit' => 'Satuan',
                    'is_base' => 'Satuan Dasar',
                    'conversion_value' => 'Nilai Tukar',
                    'remarks' => 'Keterangan',
                ],
            ],
            'category' => [
                'header' => [
                    'code' => 'Kode',
                    'name' => 'Nama',
                    'description' => 'Keterangan',
                ],
            ],
        ],
    ],
    'field' => [
        'type' => 'Tipe',
        'category' => 'Kategori',
        'name' => 'Nama',
        'short_code' => 'Kode',
        'description' => 'Deskripsi',
        'unit' => 'Satuan',
        'barcode' => 'Barcode',
        'minimal_in_stock' => 'Minimal Di Stok',
        'status' => 'Status',
        'remarks' => 'Keterangan',
    ],
    'edit' => [
        'title' => 'Produk',
        'page_title' => 'Produk',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Ubah Produk',
        ],
        'table' => [
            'product' => [
                'header' => [
                    'unit' => 'Satuan',
                    'is_base' => 'Satuan Dasar',
                    'conversion_value' => 'Nilai Tukar',
                    'remarks' => 'Keterangan',
                ],
            ],
            'category' => [
                'header' => [
                    'code' => 'Kode',
                    'name' => 'Nama',
                    'description' => 'Keterangan',
                ],
            ],
        ],
    ],
    'index' => [
        'title' => 'Produk',
        'page_title' => 'Produk',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Daftar Produk',
        ],
        'table' => [
            'header' => [
                'type' => 'Tipe',
                'name' => 'Nama',
                'short_code' => 'Kode',
                'description' => 'Deskripsi',
                'status' => 'Status',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'show' => [
        'title' => 'Produk',
        'page_title' => 'Produk',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tampilan Produk',
        ],
        'table' => [
            'product' => [
                'header' => [
                    'unit' => 'Unit',
                    'is_base' => 'Dasar Unit',
                    'conversion_value' => 'Nilai Tukar',
                    'remarks' => 'Keterangan',
                ],
            ],
            'category' => [
                'header' => [
                    'code' => 'Kode',
                    'name' => 'Nama',
                    'description' => 'Keterangan',
                ],
            ],
        ],
    ],
];