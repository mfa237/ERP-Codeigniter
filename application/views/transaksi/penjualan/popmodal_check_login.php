<div class="modal-header">

</div>
<form id="formLogin" action="<?php echo $action?>">
  <div class="modal-body">
    <div class="form-group">
      <label for="">Username</label>
      <input type="text" name="i_username" id="i_username" value="" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Password</label>
      <input type="password" name="i_password" id="i_password" value="" class="form-control">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" name="button" class="btn btn-primary btn-ok">Ok</button>
    <button type="button" name="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
  </div>
</form>

<script type="text/javascript">
// function check_login()// {	// $.ajax({
		// type : "POST",
		// url  : '<?php echo base_url();?>'+$("#formLogin").attr('action'),
		// data : $( "#formLogin" ).serialize(),
		// dataType : "json",
		// success : function(data)		// {			// if (data.status=='200') 			// {				// $('#modal_login').modal('hide');								// $('#type_karyawan').val(data.type_karyawan);								// $('#item_booking').val(1);								// var item_row = $(this).parent().parent().parent();								// sales_discount_item_current_index_booking = item_row.index();								// sales_total_item = parseInt($(this).attr('data-total'));								// sales_discount_item = parseInt($(this).attr('data-discount-item'));								// var datastatusgudang = $(this).attr('data_status_ambil');								// if (datastatusgudang) { $('#datastatusambil').val(1); }								// $("#input-discount-item").autoNumeric('set', sales_discount_item);								// var persen = sales_discount_item/sales_total_item*100;								// $("#input-discount-item-percent").autoNumeric('set', persen);								// $('#my-modal-disc-item').modal('toggle');							// } 			// else if (data.status=='204') 			// {				// return false;
			// }
		// }
	// })// }
</script>
