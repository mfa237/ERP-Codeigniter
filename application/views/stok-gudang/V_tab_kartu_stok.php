<form action="Stok-Gudang/Print-Kartu-Stok" id="formKartuStok" class="form-horizontal" method="post">
    <div class="form-group">
        <label class="control-label col-md-2">Nama Cabang
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <div class="input-icon right">
                <i class="fa"></i>
                <select class="form-control" id="m_cabang_id" name="m_cabang_id" aria-required="true" aria-describedby="select-error" onchange="getGudang()">
                </select>
            </div>
        </div>
        <label class="control-label col-md-2">Nama Gudang
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <div class="input-icon right">
                <i class="fa"></i>
                <select class="form-control" id="m_gudang_id" name="m_gudang_id" aria-required="true" aria-describedby="select-error">
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Nama Barang
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <div class="input-icon right">
                <i class="fa"></i>
                <select class="form-control" id="m_barang_id" name="m_barang_id" aria-required="true" aria-describedby="select-error">
                </select>
            </div>
        </div>
        <div class="col-md-6 text-right">
            
            <button type="button" class="btn green-jungle" onclick="searchDataKartuStok()"><i class="icon-eye text-center"></i></button>
            <button type="button" class="btn green-jungle" onclick="cetak()"><span class="icon-printer"></span></button>
        </div>
    </div>
</form>
<table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table-kartu-stok">
    <thead>
        <tr>
            <th> No </th>
            <th> Tanggal </th>
            <th> No Bukti </th>
            <th> Keterangan </th>
            <th> Masuk </th>
            <th> Keluar </th>
            <th> Sisa </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script type="text/javascript">
    function cetak()
    {
       $('#formKartuStok').submit();
    }
</script>