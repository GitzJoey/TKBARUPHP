<html>
    <table>
      <thead>
            <tr>
                <td align="left" valign="center">FK</td>
                <td align="left" valign="center">KD_JENIS_TRANSAKSI</td>
                <td align="left" valign="center">FG_PENGGANTI</td>
                <td align="left" valign="center">NOMOR_FAKTUR</td>
                <td align="left" valign="center">MASA_PAJAK</td>
                <td align="left" valign="center">TAHUN_PAJAK</td>
                <td align="left" valign="center">TANGGAL_FAKTUR</td>
                <td align="left" valign="center">NPWP</td>
                <td align="left" valign="center">NAMA</td>
                <td align="left" valign="center">ALAMAT_LENGKAP</td>
                <td align="left" valign="center">JUMLAH_DPP</td>
                <td align="left" valign="center">JUMLAH_PPN</td>
                <td align="left" valign="center">JUMLAH_PPNBM</td>
                <td align="left" valign="center">ID_KETERANGAN_TAMBAHAN</td>
                <td align="left" valign="center">FG_UANG_MUKA</td>
                <td align="left" valign="center">UANG_MUKA_DPP</td>
                <td align="left" valign="center">UANG_MUKA_PPN</td>
                <td align="left" valign="center">UANG_MUKA_PPNBM</td>
                <td align="left" valign="center">REFERENSI</td>
            </tr>
            <tr>
                <td align="left" valign="center">LT</td>
                <td align="left" valign="center">NPWP</td>
                <td align="left" valign="center">NAMA</td>
                <td align="left" valign="center">JALAN</td>
                <td align="left" valign="center">BLOK</td>
                <td align="left" valign="center">NO</td>
                <td align="left" valign="center">RT</td>
                <td align="left" valign="center">RW</td>
                <td align="left" valign="center">KECAMATAN</td>
                <td align="left" valign="center">KELURAHAN</td>
                <td align="left" valign="center">KABUPATEN</td>
                <td align="left" valign="center">PROPINSI</td>
                <td align="left" valign="center">KODE_POS</td>
                <td align="left" valign="center">NOMOR_TELEPON</td>
            </tr>
            <tr>
                <td align="left" valign="center">OF</td>
                <td align="left" valign="center">KODE_OBJEK</td>
                <td align="left" valign="center">NAMA</td>
                <td align="left" valign="center">HARGA_SATUAN</td>
                <td align="left" valign="center">JUMLAH_BARANG</td>
                <td align="left" valign="center">HARGA_TOTAL</td>
                <td align="left" valign="center">DISKON</td>
                <td align="left" valign="center">DPP</td>
                <td align="left" valign="center">PPN</td>
                <td align="left" valign="center">TARIF_PPNBM</td>
                <td align="left" valign="center">PPNBM</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxes_output as $key => $tax_output)
            <tr>
                <td align="left">FK</td>
                <td align="left" valign="center">{{ explode('.', $tax_output->gst_transaction_type)[1] }}</td>
                <td align="left">-</td>
                <td align="left">{{ $tax_output->invoice_no }}</td>
                <td align="left">{{ $tax_output->month }}</td>
                <td align="left">{{ $tax_output->year }}</td>
                <td align="left">{{ $tax_output->invoice_date }}</td>
                <td align="left">{{ $tax_output->opponent_tax_id_no }}</td>
                <td align="left">{{ $tax_output->opponent_name }}</td>
                <td align="left">{{ $tax_output->opponent_address }}</td>
                <td align="right">{{ $tax_output->tax_base }}</td>
                <td align="right">{{ $tax_output->gst }}</td>
                <td align="right">{{ $tax_output->luxury_tax }}</td>
                <td align="left"></td>
                <td align="left">0</td>
                <td align="left">0</td>
                <td align="left">0</td>
                <td align="left">0</td>
                <td align="left">{{ $tax_output->reference }}</td>
            </tr>
            <tr>
                <td align="left">FAPR</td>
                <td align="left">{{ $tax_output->name }}</td>
                <td align="left">{{ $tax_output->address }}</td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
                <td align="left"></td>
            </tr>
            @foreach ($tax_output->transactions as $key => $transaction)
            <tr>
                <td align="left">OF</td>
                <td align="left">{{ App\Model\Product::where('name', $transaction->name)->first()->short_code }}</td>
                <td align="left">{{ $transaction->name }}</td>
                <td align="right">{{ $transaction->price }}</td>
                <td align="right">{{ $transaction->qty }}</td>
                <td align="right">{{ $transaction->gst }}</td>
                <td align="right">{{ $transaction->discount }}</td>
                <td align="right">{{ $transaction->gst / $transaction->qty }}</td>
                <td align="right">{{ $transaction->gst / $transaction->qty * 0.1 }}</td>
                <td align="right">0</td>
                <td align="right">{{ $transaction->luxury_tax }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</html>
