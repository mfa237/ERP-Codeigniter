<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title"></h4>
</div>
  <div class="modal-body">
    <center>
      <label for="">Jumlah Print Bar</label>
      <input type="number" id="print_qtybar" class="form-control" name="" value="">
    </center>
  </div>
  <div class="modal-footer">
    <button id="btn-print" type="button" class="btn btn-primary">Print</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>

<script type="text/javascript">

  $('#btn-print').on('click', function(){
    var barang_id = "<?php echo $barang?>";
    var barang_id = encodeURI(barang_id);
    var print_qty = $('#print_qtybar').val();
    window.open("<?php echo base_url()?>C_barang/printBarcode/"+barang_id+"/"+print_qty);
    $('#modal_print_bar').modal('hide');
  });
</script>
