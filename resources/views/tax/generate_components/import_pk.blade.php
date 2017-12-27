<div style="overflow-x:auto;white-space:nowrap">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-left" style="vertical-align:middle">FK</th>
            <th class="text-left" style="vertical-align:middle">KD_JENIS_TRANSAKSI</th>
            <th class="text-left" style="vertical-align:middle">FG_PENGGANTI</th>
            <th class="text-left" style="vertical-align:middle">NOMOR_FAKTUR</th>
            <th class="text-left" style="vertical-align:middle">MASA_PAJAK</th>
            <th class="text-left" style="vertical-align:middle">TAHUN_PAJAK</th>
            <th class="text-left" style="vertical-align:middle">TANGGAL_FAKTUR</th>
            <th class="text-left" style="vertical-align:middle">NPWP</th>
            <th class="text-left" style="vertical-align:middle">NAMA</th>
            <th class="text-left" style="vertical-align:middle">ALAMAT_LENGKAP</th>
            <th class="text-left" style="vertical-align:middle">JUMLAH_DPP</th>
            <th class="text-left" style="vertical-align:middle">JUMLAH_PPN</th>
            <th class="text-left" style="vertical-align:middle">JUMLAH_PPNBM</th>
            <th class="text-left" style="vertical-align:middle">ID_KETERANGAN_TAMBAHAN</th>
            <th class="text-left" style="vertical-align:middle">FG_UANG_MUKA</th>
            <th class="text-left" style="vertical-align:middle">UANG_MUKA_DPP</th>
            <th class="text-left" style="vertical-align:middle">UANG_MUKA_PPN</th>
            <th class="text-left" style="vertical-align:middle">UANG_MUKA_PPNBM</th>
            <th class="text-left" style="vertical-align:middle">REFERENSI</th>
        </tr>
        <tr>
            <th class="text-left" style="vertical-align:middle">LT</th>
            <th class="text-left" style="vertical-align:middle">NPWP</th>
            <th class="text-left" style="vertical-align:middle">NAMA</th>
            <th class="text-left" style="vertical-align:middle">JALAN</th>
            <th class="text-left" style="vertical-align:middle">BLOK</th>
            <th class="text-left" style="vertical-align:middle">NO</th>
            <th class="text-left" style="vertical-align:middle">RT</th>
            <th class="text-left" style="vertical-align:middle">RW</th>
            <th class="text-left" style="vertical-align:middle">KECAMATAN</th>
            <th class="text-left" style="vertical-align:middle">KELURAHAN</th>
            <th class="text-left" style="vertical-align:middle">KABUPATEN</th>
            <th class="text-left" style="vertical-align:middle">PROPINSI</th>
            <th class="text-left" style="vertical-align:middle">KODE_POS</th>
            <th class="text-left" style="vertical-align:middle">NOMOR_TELEPON</th>
            <th colspan="5"></th>
        </tr>
        <tr>
            <th class="text-left" style="vertical-align:middle">OF</th>
            <th class="text-left" style="vertical-align:middle">KODE_OBJEK</th>
            <th class="text-left" style="vertical-align:middle">NAMA</th>
            <th class="text-left" style="vertical-align:middle">HARGA_SATUAN</th>
            <th class="text-left" style="vertical-align:middle">JUMLAH_BARANG</th>
            <th class="text-left" style="vertical-align:middle">HARGA_TOTAL</th>
            <th class="text-left" style="vertical-align:middle">DISKON</th>
            <th class="text-left" style="vertical-align:middle">DPP</th>
            <th class="text-left" style="vertical-align:middle">PPN</th>
            <th class="text-left" style="vertical-align:middle">TARIF_PPNBM</th>
            <th class="text-left" style="vertical-align:middle">PPNBM</th>
            <th colspan="8"></th>
        </tr>
    </thead>
    <tbody>
        <template v-for="taxOutput in taxesOutput" v-cloak>
            <tr>
                <td class="text-left">FK</td>
                <td class="text-left">@{{ taxOutput.gstTransactionTypeDescription.split(' ')[0] }}</td>
                <td class="text-left">0</td>
                <td class="text-left">@{{ taxOutput.invoiceNo }}</td>
                <td class="text-left">@{{ taxOutput.month }}</td>
                <td class="text-left">@{{ taxOutput.year }}</td>
                <td class="text-left">@{{ taxOutput.invoiceDate }}</td>
                <td class="text-left">@{{ taxOutput.opponentTaxIdNo }}</td>
                <td class="text-left">@{{ taxOutput.opponentName }}</td>
                <td class="text-left">@{{ taxOutput.opponentAddress }}</td>
                <td class="text-right">@{{ numbro(taxOutput.taxBase).format() }}</td>
                <td class="text-right">@{{ numbro(taxOutput.gst).format() }}</td>
                <td class="text-right">@{{ numbro(taxOutput.luxuryTax).format() }}</td>
                <td class="text-left"></td>
                <td class="text-left">0</td>
                <td class="text-left">0</td>
                <td class="text-left">0</td>
                <td class="text-left">0</td>
                <td class="text-left">@{{ taxOutput.reference }}</td>
            </tr>
            <tr>
                <td class="text-left">FAPR</td>
                <td class="text-left">@{{ taxOutput.name }}</td>
                <td class="text-left">@{{ taxOutput.address }}</td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>
                <td colspan="5"></td>
            </tr>
            <tr v-for="transaction in taxOutput.transactions">
                <td class="text-left">OF</td>
                <td class="text-left">@{{ getProductCode(transaction.name) }}</td>
                <td class="text-left">@{{ transaction.name }}</td>
                <td class="text-right">@{{ numbro(transaction.price).format() }}</td>
                <td class="text-right">@{{ numbro(transaction.qty).format() }}</td>
                <td class="text-right">@{{ numbro(transaction.gst).format() }}</td>
                <td class="text-right">@{{ numbro(transaction.discount).format() }}</td>
                <td class="text-right">@{{ numbro(transaction.gst / transaction.qty).format() }}</td>
                <td class="text-right">@{{ numbro(transaction.gst / transaction.qty * 0.1).format() }}</td>
                <td class="text-right">@{{ numbro(0).format() }}</td>
                <td class="text-right">@{{ numbro(transaction.luxuryTax).format() }}</td>
            </tr>
        </template>
        <tr v-if="!taxesOutput.length">
            <td class="text-center" colspan="14">@lang('labels.DATA_NOT_FOUND')</td>
        </tr>
    </tbody>
  </table>
</div>
<div class="row">
  <div class="col-xs-12 text-center">
    <a href="{{ route('db.tax.generate.import_pk.excel', [ 'xlsx' ]) }}" class="btn btn-primary">@lang('buttons.download_excel_button')</a>
  </div>
</div>
