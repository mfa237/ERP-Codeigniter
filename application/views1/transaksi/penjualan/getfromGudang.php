<script type="text/javascript">
  $(document).ready(function(){
    var storage_getGudangDet = JSON.parse(localStorage.getItem('storage_getGudangDet_'));
      var data_disc = storage_getGudangDet[0].data_disc;
      var data_has_promo = storage_getGudangDet[0].data_has_promo;
      var data_id = storage_getGudangDet[0].data_id;
      var data_name = storage_getGudangDet[0].data_name;
      var data_price = storage_getGudangDet[0].data_price;
      var data_promo_gratis = storage_getGudangDet[0].data_promo_gratis;
      var data_promo_harga = storage_getGudangDet[0].data_promo_harga;
      var data_promo_item = storage_getGudangDet[0].data_promo_item;
      var data_promo_qty = storage_getGudangDet[0].data_promo_qty;
      var data_promo_type = storage_getGudangDet[0].data_promo_type;
      var data_qty = storage_getGudangDet[0].data_qty;
      var data_status_aktif = storage_getGudangDet[0].data_status_aktif;
      var data_stok_display = storage_getGudangDet[0].data_stok_display;
      var data_stok_gudang = storage_getGudangDet[0].data_stok_gudang;
      $('#buttonGetfromGudang').append('<button id="btn_GetfromGudang" type="button"\
                                          class="btn btn-primary" data-disc="" data-qty="1"\
                                          data-price="'+data_price+'"\
                                          data-name="'+data_name+'"\
                                          data-id="'+data_id+'" data-has-promo=""\
                                          data-promo-harga="" data-promo-type=""\
                                          data-status-aktif="" data-stok-display="'+data_stok_display+'" data-stok-gudang="'+data_stok_gudang+'"\
                                          data-promo-item-name="'+data_promo_item+'"\
                                          data-promo-gratis="" data-promo-qty="'+data_promo_qty+'" data-status-ambil="gudang">\
                                          Submit\
                                        </button>\
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>\
                                        ');
      $('#title').append(data_name);
  });
</script>
<!-- <div class="modal-header">

</div> -->
<div class="modal-body">
  <form class="" action="index.html" method="post">
    <center>
      <span class="modal-title" id="title"></span>
      <h2>STOK PADA DISPLAY HABIS</h2>
      <span style="color: red;">Ambil dari gudang</span>
      <br>
      <br>
      <div class="" id="buttonGetfromGudang">

      </div>
    </center>
  </form>
</div>
<script type="text/javascript">
  $("#btn_GetfromGudang").on('click', function(){
    // var status = $('#status').val();
      $.fn.addCart($(this));
    $('#getfromGudang_popmodal').modal('hide');
  });
</script>
