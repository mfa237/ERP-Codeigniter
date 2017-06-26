<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
  <div class="modal-body">
    <center>
      <label for="">Jumlah Print Price Tag</label>
      <input type="number" id="print_qty" class="form-control" name="" value="">
    </center>
  </div>
  <div class="modal-footer">
    <button id="btn-print" type="button" class="btn btn-primary">Print</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>

<script type="text/javascript">
  // $('#formprint').submit(function(){
  //   $.ajax({
  //          type: "POST",
  //          url: url,
  //          data: $("#idForm").serialize(), // serializes the form's elements.
  //          success: function(data)
  //          {
  //
  //          }
  //        });
  // });
  $('#btn-print').on('click', function(){
    var barang_id = "<?php echo $barang;?>";
    // console.log(barang_id);
    var barang_id = encodeURI(barang_id);
    var print_qty = $('#print_qty').val();
    //
    window.open("<?php echo base_url()?>C_barang/printpricetagaction/"+barang_id+"/"+print_qty);
    $('#modal_print').modal('hide');
  });
</script>
