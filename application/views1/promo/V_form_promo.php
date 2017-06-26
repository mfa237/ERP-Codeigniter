<!-- BEGIN FORM-->
<style media="screen">
/*.modal-backdrop, .modal-backdrop.fade.in {
  background-color: #333!important;
  z-index: 1;
}*/

.modal-open .daterangepicker {
  z-index: 10055!important;
}
.item-list tr,
.item-list tr > th,
.item-list tr > td {
  width: 100%;
  /*padding: 10px;*/
  border: 1px solid #ddd;
  border-color: #ddd;
  margin: 10px;
}

.col-md-10 {
    /*width: 83.33333%;*/
    padding-left: 0;
}
input.right{
  text-align: right;
}

.item-name{
  max-width: 150px;
  word-wrap: break-word;
  white-space:normal !important;
}

</style>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 <h4 class="modal-title" id="gridSystemModalLabel">Form Master Promo</h4>
</div>
<div class="modal-body">
  <form action="#" id="formAdd" name="formAddbarang" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below.
            </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful!
            </div>
            <input type="hidden" id="url" value="<?php echo $action?>">
            <input type="hidden" id="url_data" value="Master-Data/Barang">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">ID Promo (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="kode" name="kode" readonly/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Promo
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="promo_nama" name="promo_nama" required />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Tanggal Berlaku Promo
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                      <input type="text" class="form-control" id="datarange" name="daterange" value=""/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Status Promo
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                  <div class="input-icon right">
                    <i class="fa"></i>
                    <select class="form-control select2" id="promo_status_aktif" name="promo_status_aktif" aria-required="true" aria-describedby="select-error" required>
                      <option id="aktif" value="y"> Aktif </option>
                      <option id="nonaktif" value="n"> Non Aktif </option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Pilih Barang & Jumlah
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                  <div class="input-icon right">
                    <div class="col-md-6" style="padding-left: 0px; padding-right: 3px;">
                      <select class="" id="selectbarang" name="selectbarang"></select>
                    </div>
                    <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;">
                      <input type="text" id="selectqty" name="selectqty" class="form-control num right" name="" value="">
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn sbold dark" name="button" onclick="addBarang()">
                        <i class="icon-plus"></i>
                      </button>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Total Harga Barang/Jasa
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                  <div class="input-icon right">
                    <i class="fa"></i>
                    <input type="text" class="form-control right" style="font-size: 14px;" id="totalitemcurr" name="totalitemcurr" value="0" readonly="true">
                    <input type="" class="hidden" id="totalitem" name="totalitem" value="0" readonly="true">
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Diskon/Potongan Dari Total
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                  <div class="input-icon right">
                    <i class="fa"></i>
                    <div class="col-md-6" style="padding-left: 0px;padding-right: 2px;">
                      <input type="text" id="diskonnominal" class="form-control num2" name="promo_harga" value="" onkeyup="keyDiskonnominal()">
                    </div>
                    <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
                      <div class="input-group">
                        <input type="text" id="diskonpersen" class="form-control num right" name="" value="" onkeyup="keyDiskonpersen()">
                        <span class="input-group-addon" id="basic-addon2"> % </span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group" id="tblInsert">
                  <div class="col-md-12">
                    <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table2">
                      <thead>
                        <tr>
                          <th> No </th>
                          <th class="item-name"> Artikel </th>
                          <th> Uraian dan Spesifikasi Barang/Jasa </th>
                          <th> Harga Jual </th>
                          <th> Qty</th>
                          <th> Total Harga Jual </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="totalpotonganitem" name="totalpotonganitem" value="0">
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="button" class="btn green-jungle" id="submit" onclick="btnsubmit()">Submit</button>
                    <button type="button" class="btn default" onclick="btnclose()">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
    <!-- END FORM -->
    <script type="text/javascript">
    $(function() {
      // alert(totalpotonganitem);
        $('input[name="daterange"]').daterangepicker();
    });

    $(document).ready(function(){
        localStorage.clear();
        var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
        if (!storage_item_detail) {
          storage_item_detail = [];
          localStorage.setItem('item_detail', JSON.stringify(storage_item_detail));
        }
        // var defaulttable2 = $('#default-table2 tbody');
        // console.log(defaulttable2);

        var totalitem = document.getElementById('totalitem').value;
        var diskonnominal = document.getElementById('diskonnominal').value;
        var diskonpersen = document.getElementById('diskonpersen').value;

        if (totalitem == 0) {
          document.getElementById('diskonnominal').readOnly  = true;
          document.getElementById('diskonpersen').readOnly  = true;
        } else {
          document.getElementById('diskonnominal').readOnly  = false;
          document.getElementById('diskonpersen').readOnly  = false;
        }
    });

    function btnclose(){
      localStorage.clear();
      localStorage.removeItem('storage_item_detail');
      $('#modal_promo').modal('hide');
    }

    var totalitem = 0;
    function addBarang(){
      var no = 1;
      var itemid = document.getElementById('selectbarang').value;
      var url    = "<?php echo base_url()?>Master-Data/Master-Promo/getBarang";
      var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
      var barang_kode;
      var barang_nomor;
      var barang_nama;
      var harga_beli;
      var harga_jual;
      var harga_jual_pajak;
      var itemgetpromo;
      var itemqtygetpromo;

      $.ajax({
              type: "POST",
              url: url,
              data: {itemid:itemid}, // serializes the form's elements.
              dataType: "JSON",
              cache: false,
              success: function(data)
              {
                var new_data = {
                                'itemgetpromo'    : itemid,
                                'itemqtygetpromo' : document.getElementById('selectqty').value,
                                'barang_kode'     : data.itemdetail.barang_kode,
                                'barang_nomor'    : data.itemdetail.barang_nomor,
                                'barang_nama'     : data.itemdetail.barang_nama,
                                'harga_beli'      : data.itemdetail.harga_beli,
                                'harga_jual'      : data.itemdetail.harga_jual,
                                'harga_jual_pajak': data.itemdetail.harga_jual_pajak
                              };
                    storage_item_detail.push(new_data);
                    localStorage.setItem('item_detail', JSON.stringify(storage_item_detail));
                    if (storage_item_detail) {
                      document.getElementById('diskonpersen').readOnly  = false;
                      document.getElementById('diskonnominal').readOnly  = false;
                    }

                    additemintolist();
              }
            });
    }

    // var totalitem = 0;
    function additemintolist() {
      document.getElementById('totalitem').value  = totalitem;
      document.getElementById('totalitemcurr').value  = Intl.NumberFormat().format(totalitem);
      var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
      var html = [];
      var htmlfoot = [];
      var no = 1;

      $.each(storage_item_detail, function(index, value){
        totalitem += value.harga_jual_pajak*value.itemqtygetpromo;
        html += '<tr>';
        html += '<td>'+no+'</td>';
        html += '<td>'+value.barang_nomor+'</td>';
        html += '<td class="item-name">'+value.barang_nama+'</td>';
        html += '<td align="right">'+Intl.NumberFormat().format(value.harga_jual_pajak)+'</td>';
        html += '<td align="right">'+value.itemqtygetpromo+'</td>';
        html += '<td align="right">'+Intl.NumberFormat().format(value.harga_jual_pajak*value.itemqtygetpromo)+'</td>';
        html += '<td align="right">';
        html += '<button class="btn red-thunderbird" type="button" onclick="deleteData(this);" data-id="'+value.itemgetpromo+'" title="Hapus Data">';
        html += '<i class="icon-close text-center"></i>';
        html += '</button>';
        html += '</td>';
        html += '</tr>';
        no++;
      });
      var totalpotonganitem = document.getElementById('totalpotonganitem').value||0;
      $('#default-table2 tbody').html(html);
      htmlfoot += '<tr><td align="right" colspan="5">TOTAL</td><td align="right">'+Intl.NumberFormat().format(totalitem)+'</td></tr>';
      htmlfoot += '<tr><td align="right" colspan="5">TOTAL POTONGAN</td><td id="totalpotonganitem" align="right">'+Intl.NumberFormat().format(totalpotonganitem)+'</td></tr>';
      $('#default-table2 tfoot').html(htmlfoot);


      if (totalitem > 0) {
        document.getElementById('totalitem').value  = totalitem;
        document.getElementById('totalitemcurr').value  = Intl.NumberFormat().format(totalitem);
        document.getElementById('diskonnominal').readOnly  = false;
        document.getElementById('diskonpersen').readOnly  = false;
      }

    }

    function keyDiskonnominal(){
      var totalitem = $('#totalitem').val();
      var Diskonnominal = document.getElementById('diskonnominal').value||0;
      var Diskonnominalstr = Diskonnominal.toString()
      var Diskonnominalnocurr = Diskonnominalstr.replace(/\,/g,'');
      var persen = parseInt(Diskonnominalnocurr)/parseInt(totalitem);
      persen = persen*100;

      document.getElementById('diskonpersen').value = persen.toFixed(2)||0;
      // document.getElementById('totalpotonganitem').innerHtml = Diskonnominal;
    }

    function keyDiskonpersen(){
      var totalitem = $('#totalitem').val();
      var Diskonpersen = document.getElementById('diskonpersen').value||0;
      var Diskonpersenstr = Diskonpersen.toString()
      var Diskonpersennocurr = Diskonpersenstr.replace(/\,/g,'');
      var nominal = parseInt(Diskonpersennocurr)*parseInt(totalitem);
      nominal = nominal/100||0;

      document.getElementById('diskonnominal').value = nominal.toFixed(2)||0;
      // document.getElementById('totalpotonganitem').innerHtml = nominal;
    }

    function btnsubmit(){
      var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
      var barang_kode = [];
      var barang_nomor = [];
      var barang_nama = [];
      var harga_beli = [];
      var harga_jual = [];
      var harga_jual_pajak = [];
      var itemgetpromo = [];
      var itemqtygetpromo = [];

      var paramArr = $("#formAdd").serializeArray();
      $.each(storage_item_detail, function(index, value){
            paramArr.push({name:'itemgetpromo[]', value:value.itemgetpromo },
                          {name:'itemqtygetpromo[]', value:value.itemqtygetpromo });
      });

      var url    = "<?php echo base_url()?>Master-Data/Master-Promo/postData";

      $.ajax({
             type: "POST",
             url: url,
             data: paramArr, // serializes the form's elements.
             dataType:"JSON",
             success: function(data)
             {
                 if (data.status == '200') {
                   $('#modal_promo').modal('hide');
                   window.scrollTo(0, 0);
                   swal({
                       title: "Success!",
                       text: "Penyimpanan Berhasil!",
                       type: "success",
                       confirmButtonClass: "btn-raised btn-success",
                       confirmButtonText: "OK",
                   });
                 } else if (data.status=='204') {
                   swal({
                       title: "Alert!",
                       text: "Penyimpanan Gagal!",
                       type: "error",
                       confirmButtonClass: "btn-raised btn-danger",
                       confirmButtonText: "OK",
                   });
                 }
                 searchData();
             }
          });
    }

    function deleteData(elem){
      var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
      var kode = $('#kode').val();
      var row = $(elem).parent().parent();
      var itemgetpromo = $(elem).attr("data-id");
      var rowoindex = $(elem).parent().parent().index();

        $.each(storage_item_detail, function (index, value) {
							if (value.itemgetpromo == itemgetpromo) {
									storage_item_detail.splice(index, 1);
									return false;
							}
					});
					localStorage.setItem('item_detail', JSON.stringify(storage_item_detail));
          if (storage_item_detail) {
            document.getElementById('diskonpersen').readOnly  = true;
            document.getElementById('diskonnominal').readOnly  = true;
          }
          row.remove();
    }

    </script>
