<div class="modal-header">

</div>
<div class="modal-body">
  <form action="#" id="formAdd" name="formAddbarang" class="form-horizontal" method="post">
    <div class="alert alert-danger display-hide">
      <button class="close" data-close="alert"></button> You have some form errors. Please check below.
    </div>
    <div class="alert alert-success display-hide">
      <button class="close" data-close="alert"></button> Your form validation is successful!
    </div>
  <input type="hidden" id="mutasi_id" name="mutasi_id">
  <input type="hidden" id="url" value="Master-Data/Mutasi/postData/">
  <input type="hidden" id="url_data" value="Master-Data/Barang">
    <div class="form-group">
      <label class="control-label col-md-4">Pilih Gudang
        <span class="required"> * </span>
      </label>
      <div class="col-md-8">
        <div class="input-icon right">
          <i class="fa"></i>
          <select class="form-control select2" id="i_gudang" name="i_gudang"  onchange="getBarang()" required></select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4">Nama Barang
        <span class="required"> * </span>
      </label>
      <div class="col-md-8">
        <div class="input-icon right">
          <i class="fa"></i>
          <select class="form-control" id="i_barang" name="i_barang" onchange="getQty()" required></select>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4">Jumlah Stok
        <span class="required"> * </span>
      </label>
      <div class="col-md-8">
        <div class="input-icon right">
          <i class="fa"></i>
          <input type="hidden" id="barangQty" name="barangQty" value="">
          <input type="number" class="form-control" id="jml_barang" name="jml_barang" value="0" onkeyup="checkQty()" required />
        </div>
      </div>
    </div>
    <div class="form-group" style="display: none;">
      <label class="control-label col-md-4">Satuan Barang
        <span class="required"> * </span>
      </label>
      <div class="col-md-8">
        <div class="input-icon right">
          <i class="fa"></i>
          <select class="form-control" id="m_satuan_id" name="m_satuan_id" aria-required="true"
          aria-describedby="select-error" value="0" required>
          </select>
        </div>
      </div>
    </div>
</div>
<div class="modal-footer">
  <div class="col-md-offset-4 col-md-8 text-right">
    <button type="submit" class="btn green-jungle"  onclick="submitForm()">Submit</button>
    <button type="button" class="btn default reset" data-dismiss="modal">Close</button>
  </div>
</div>
    </div>
  </form>
<script type="text/javascript">
  function submitForm()
  {
    actionData();
    $('#modal_mutasi').modal('hide');
  }


  function getBarang()
  {
    var gudangid = $('#i_gudang').val();
    selectList_global('#i_barang', 'C_mutasibarang/getBarang', 'Pilih Barang', gudangid);
  }

  function getQty()
  {
    // var qty = [];
    var barangid = document.getElementById('i_barang').value;
    var gudangid = document.getElementById('i_gudang').value;

    getData('#formAdd', 'C_mutasibarang/getQTY');

  }
  function getQtyresult(data)
  {
    var stok = data.items;
    var stokrequest = $('#jml_barang').val();
    // stokrequest
    document.getElementById('barangQty').value = stok;
    if (stok<stokrequest) {
      alert("Permintaan Melebihi Jumlah Stock");
      document.getElementById('jml_barang').value = 0;
    }
  }

  function checkQty()
  {
    var stok = $('#barangQty').val();
    var stokrequest = $('#jml_barang').val();
    // console.log(stokrequest);
    if (parseInt(stok) < parseInt(stokrequest)){
      alert("Permintaan Melebihi Jumlah Stock"+stok);
      document.getElementById('jml_barang').value = 0;
    }
  }

</script>
