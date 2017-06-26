<div class="modal-header">

</div>
<form id="formLogin" action="<?php echo $action?>">
  <div class="modal-body">
    <div class="form-group">
      <label for="">Username</label>
      <input type="text" name="i_username" value="" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Password</label>
      <input type="password" name="i_password" value="" class="form-control">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" name="button" class="btn btn-primary" onclick="check_login()">Ok</button>
    <button type="button" name="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
  </div>
</form>

<script type="text/javascript">
  function check_login()
  {
    // if ($("#formLogin").valid() == true) {
    $.ajax({
      type : "POST",
      url  : '<?php echo base_url();?>'+$("#formLogin").attr('action'),
      data : $( "#formLogin" ).serialize(),
      dataType : "json",
      success : function(data){

        if (data.status=='200') {
          $('#modal_login').modal('hide');
          $('#item_booking').val(0);
          var item_row = $(this).parent().parent().parent();
          sales_discount_item_current_index = item_row.index();
          sales_total_item = parseInt($(this).attr('data-total'));
          sales_discount_item = parseInt($(this).attr('data-discount-item'));
          sales_discount_item = parseInt($(this).attr('data-discount-item'));
          var datastatusgudang = $(this).attr('data_status_ambil');
          if (datastatusgudang == "gudang") {$('#datastatusgudang').val();}

          $("#input-discount-item").autoNumeric('set', sales_discount_item);
          var persen = sales_discount_item/sales_total_item*100;
          $("#input-discount-item-percent").autoNumeric('set', persen);
          $('#my-modal-disc-item').modal('toggle');

        } else if (data.status=='204') {
          return false;
        }
      }
    })
    // }
    // return false;
  }
</script>
