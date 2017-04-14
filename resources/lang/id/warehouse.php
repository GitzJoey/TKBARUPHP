<?php 

return [
    'inflow' => [
        'index' => [
            'title' => 'Pemasukan Barang',
            'page_title' => 'Pemasukan Barang',
            'page_title_desc' => '',
            'header' => [
                'warehouse' => 'Gudang',
                'purchase_order' => 'Daftar Pembelian',
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
            'title' => 'Nota Terima',
            'page_title' => 'Nota Terima',
            'page_title_desc' => '',
            'box' => [
                'receipt' => 'Nota Terima',
                'items' => 'Barang-Barang',
            ],
            'field' => [
                'warehouse' => 'Gudang',
                'po_code' => 'Kode Pembelian',
                'shipping_date' => 'Tgl Pengiriman',
                'receipt_date' => 'Tgl Terima',
                'vendor_trucking' => 'Layanan Angkutan',
                'license_plate' => 'Plat Nomor',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'unit' => 'Satuan',
                        'brutto' => 'Bruto',
                        'netto' => 'Netto',
                        'tare' => 'Tare',
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
                'name' => 'Nama',
                'position' => 'Posisi',
                'capacity' => 'Kapasitas',
                'capacity_unit' => 'Satuan',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'field' => [
        'name' => 'Nama',
        'address' => 'Alamat',
        'phone_num' => 'Telepon',
        'status' => 'Status',
        'remarks' => 'Keterangan',
        'section' => 'Lot',
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
                'name' => 'Nama',
                'position' => 'Posisi',
                'capacity' => 'Kapasitas',
                'capacity_unit' => 'Satuan',
                'remarks' => 'Keterangan',
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
                'name' => 'Nama',
                'position' => 'Posisi',
                'capacity' => 'Kapasitas',
                'remarks' => 'Keterangan',
            ],
        ],
    ],
    'outflow' => [
        'deliver' => [
            'title' => 'Nota Pengiriman',
            'page_title' => 'Nota Pengiriman',
            'page_title_desc' => '',
            'box' => [
                'deliver' => 'Nota Pengiriman',
                'items' => 'Barang-Barang',
            ],
            'field' => [
                'warehouse' => 'Gudang',
                'so_code' => 'Kode Penjualan',
                'shipping_date' => 'Tgl Kirim',
                'deliver_date' => 'Tgl Terima',
                'vendor_trucking' => 'Layanan Angkutan',
                'license_plate' => 'Plat Nomor',
            ],
            'table' => [
                'item' => [
                    'header' => [
                        'product_name' => 'Nama Produk',
                        'unit' => 'Satuan',
                        'brutto' => 'Bruto',
                    ],
                ],
            ],
        ],
        'index' => [
            'title' => 'Pengeluaran Gudang',
            'page_title' => 'Pengeluaran Gudang',
            'page_title_desc' => '',
            'header' => [
                'warehouse' => 'Gudang',
                'sales_order' => 'Penjualan',
                'title' => 'Pengeluaran Gudang',
            ],
            'table' => [
                'header' => [
                    'code' => 'Kode Penjualan',
                    'so_date' => 'Tgl Penjualan',
                    'customer' => 'Pelanggan',
                    'shipping_date' => 'Tgl Kirim',
                    'status' => 'Status',
                ],
            ],
        ],
    ],
    'stockopname' => [
        'adjust' => [
            'title' => 'Stock Opname',
            'page_title' => 'Stock Opname',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Stock Opname',
            ],
            'field' => [
                'warehouse' => 'Gudang',
                'product' => 'Produk',
                'opname_date' => 'Tanggal Opname',
                'is_match' => 'Sama',
                'current_quantity' => 'Jumlah Terakhir',
                'adjusted_quantity' => 'Jumlah Penyesuaian',
                'reason' => 'Alasan',
            ],
        ],
        'index' => [
            'title' => 'Stock Opname',
            'page_title' => 'Stock Opname',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Stock Opname',
            ],
            'table' => [
                'header' => [
                    'warehouse' => 'Gudang',
                    'product' => 'Produk',
                    'opname_date' => 'Tanggal Opname',
                    'current_quantity' => 'Jumlah Terakhir',
                ],
            ],
        ],
    ],
    'transfer_stock' => [
        'create' => [
            'title' => 'Pindah Stok',
            'page_title' => 'Pindah Stok',
            'page_title_desc' => '',
            'header' => [
                'title' => [
                    'warehouse' => 'Gudang',
                    'stocks' => 'Stok',
                ],
            ],
            'table' => [
                'header' => [
                    'select' => 'Pilih',
                    'product' => 'Produk',
                    'current_qty' => 'Total Jumlah',
                    'detail' => 'Detil',
                ],
            ],
        ],
        'field' => [
            'source_warehouse' => 'Gudang Sumber',
            'destination_warehouse' => 'Gudang Tujuan',
        ],
        'index' => [
            'title' => 'Pindah Stok',
            'page_title' => 'Pindah Stok',
            'page_title_desc' => '',
            'header' => [
                'title' => 'Daftar Pindah Stok',
            ],
            'table' => [
                'header' => [
                    'transfer_date' => 'Tanggal',
                    'product' => 'Produk',
                    'from' => 'Dari',
                    'to' => 'Ke',
                    'quantity' => 'Jumlah',
                ],
            ],
        ],
    ],
];