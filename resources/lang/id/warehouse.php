<?php 

return [
    'inflow' => [
        'index' => [
            'title' => 'Barang Masuk',
            'page_title' => 'Barang Masuk',
            'page_title_desc' => '',
            'header' => [
                'warehouse' => 'Gudang',
                'purchase_order' => 'Pembelian',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode',
                    'po_date' => 'Tanggal Pembuatan',
                    'supplier' => 'Supplier',
                    'shipping_date' => 'Tanggal Pengiriman',
                    'status' => 'Status',
                ],
            ],
        ],
        'receipt' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'receipt' => '',
                'items' => '',
            ],
            'field' => [
                'warehouse' => '',
                'po_code' => '',
                'shipping_date' => '',
                'receipt_date' => '',
                'vendor_trucking' => '',
                'license_plate' => '',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'unit' => '',
                        'brutto' => '',
                        'netto' => '',
                        'tare' => '',
                    ],
                ],
            ],
        ],
    ],
    'create' => [
        'title' => 'Gudang',
        'page_title' => 'Gudang',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Tambah Gudang',
        ],
        'table' => [
            'header' => [
                'name' => '',
                'position' => '',
                'capacity' => '',
                'capacity_unit' => '',
                'remarks' => '',
            ],
        ],
    ],
    'field' => [
        'name' => 'Nama',
        'address' => 'Alamat',
        'phone_num' => 'Telepon',
        'status' => 'Status',
        'remarks' => 'Keterangan',
        'section' => '',
    ],
    'edit' => [
        'title' => 'Gudang',
        'page_title' => 'Gudang',
        'page_title_desc' => '',
        'header' => [
            'title' => 'Ubah Gudang',
        ],
        'table' => [
            'header' => [
                'name' => '',
                'position' => '',
                'capacity' => '',
                'capacity_unit' => '',
                'remarks' => '',
            ],
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
        'table' => [
            'header' => [
                'name' => '',
                'position' => '',
                'capacity' => '',
                'remarks' => '',
            ],
        ],
    ],
    'outflow' => [
        'deliver' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'box' => [
                'deliver' => '',
                'items' => '',
            ],
            'field' => [
                'warehouse' => '',
                'so_code' => '',
                'shipping_date' => '',
                'deliver_date' => '',
                'vendor_trucking' => '',
                'license_plate' => '',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => '',
                        'unit' => '',
                        'brutto' => '',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => '',
            'page_title' => '',
            'page_title_desc' => '',
            'header' => [
                'warehouse' => '',
                'sales_order' => '',
                'title' => '',
            ],
            'table' => [
                'header' => [
                    'code' => '',
                    'so_date' => '',
                    'customer' => '',
                    'shipping_date' => '',
                    'status' => '',
                ],
            ],
        ],
    ],
];