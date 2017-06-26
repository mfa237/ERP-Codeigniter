<style media="screen">
  .mycontent {
    display: block;
  }

  .container
  {
    width: 100%;
  }
</style>
<div class="container" style="margin-top: 10px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                  <div class="">
                    <label for="">Pilih Tanggal</label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" id="tgl_penjualan" name="tgl_penjualan" value="<?php echo date("d/m/Y")?>"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                  </div>
                  <br>
                    <div class="pull-left">
                        <table class="table" style="font-size: 8pt;">
                            <tbody>
                            <tr>
                                <td>CUSTOMER :</td>
                                <td class="text-right sales-customer">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right">
                        <table class="table" style="font-size: 8pt;">
                            <tbody>
                            <tr>
                                <td>USER :</td>
                                <td class="text-right sales-user"><?php echo strtoupper($user->user_username)?></td>
                            </tr>
                            <!-- <tr>
                                <td>SHIFT :</td>
                                <td class="text-right sales-shift">1</td>
                            </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="nav active"><a href="#tab-B" data-toggle="tab" title="ALT+4">ALL ITEMS</a></li>
                        <li class="nav"><a href="#tab-C" data-toggle="tab" title="ALT+5">CUSTOMERS</a></li>
                        <li class="nav"><a href="#tab-D" data-toggle="tab" title="">PROMO</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab-A">
                            <br>
                            <table id="table-recent-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">STATUS</th>
                                    <th width="80%">NAMA ITEM</th>
                                    <th class="text-right">HARGA</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-recent-items">

                            </table>
                        </div>
                        <div class="tab-pane fade in active" id="tab-B">
                            <br>
                            <select class="form-control" id="select_category" name="select_category">
                            </select>
                            <br>
                            <div class="input-group">
                                <input type="text" id="search" class="form-control input-sm" placeholder="Cari produk">
                                <span class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                  <tr>
                                    <th width="10%">STATUS</th>
                                    <th width="50%">NAMA ITEM</th>
                                    <th width="20%">READY ITEM</th>
                                    <th class="text-right">HARGA</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                  </tr>
                                </thead>
                                <tbody class="fbody" id="data-items">
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-C">
                            <br>
                            <div class="input-group">
                                <input type="text" id="search2" class="form-control input-sm" placeholder="Cari Customer">
                                <span class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-customer" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">NAMA CUSTOMER</th>
                                    <th class="text-right">TELP.</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-customers">
                                  <tr>
                                    <td id="item-name"></td>
                                    <td class="text-right"></td>
                                    <td class="text-center">
                                      <button data-name="Umum" data-id="1" class="btn btn-success btn-xs btn-add-customer">
                                        <i class="fa fa-check"></i>
                                      </button>
                                    </td>
                                  </tr>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-D">
                            <br>
                            <div class="input-group">
                                <input type="text" id="search2" class="form-control input-sm" placeholder="Cari Customer">
                                <span class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-promo" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th style="width: 450px;">NAMA PROMO</th>
                                    <th class="text-center" style="width: 100px;"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-promo">
                                  <!-- <tr>
                                    <td id="item-name"></td>
                                    <td class="text-right"></td>
                                    <td class="text-center">
                                      <button data-name="promo" data-id="1" class="btn btn-success btn-xs btn-add-promoitem">
                                        <i class="fa fa-check"></i>
                                      </button>
                                    </td>
                                  </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="col-md-6">
            <div class="panel panel-default" style="margin-bottom: 5px;">
                <div class="panel-body text-success" style="padding-top: 1px; padding-bottom: 1px;font-weight: bold;">
                    <small class="text-left pull-left">TOTAL YANG HARUS DIBAYAR</small>
                    <div id="cart-total-big" class="text-right pull-right" style="font-size: 40pt;">0</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="list-cart">
                        <table class="table table-hover table-striped transaksi" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th width="30%" class="text-center">QTY</th>
                                <th width="30%">ITEM</th>
                                <th class="text-center hide" id="sales-column-booking" width="5%">BOOKING</th>
                                <th class="text-right">HARGA</th>
                                <th class="text-center hide" id="sales-column-discount">DISC</th>
                                <th class="text-right">TOTAL</th>
                                <th width="10%" class="text-center"><i class="fa fa-th"></i></th>
                            </tr>
                            </thead>
                            <tbody><input type="hidden" name="outlet_id" value="1"><input type="hidden" name="sales_shift" value="1">
                              <input type="hidden" name="customer_id" value="1"><input type="hidden" name="sales_discount" value="0">
                              <input type="hidden" name="sales_discount_percent_all" value="0">
                            </tbody>
                        </table>
                    </div>
                    <table class="table">
                        <tbody style="font-size: 10px;">
                        <tr style="font-weight: bold;">
                            <td width="15%" class="text-left text-danger"><span class="diskon_text hide">DISKON (%)</span></td>
                            <td width="15%" class="text-right text-danger" id="cart-discount-percent">
                              <!-- <input type="text" id="cart_discount_percen" name="cart_discount_percen" value=""> -->
                            </td>
                            <td width="15%" class="text-right text-info">TOTAL QTY</td>
                            <td width="15%" class="text-right text-info" id="cart-total-qty">0</td>
                            <td width="25%" class="text-right text-success">TOTAL SEBELUM DISKON</td>
                            <td width="15%" class="text-right text-success" id="cart-total">0</td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td width="15%" class="text-left text-danger"><span class="diskon_text hide">DISKON (Rp)</span></td>
                            <td width="15%" class="text-right text-danger" id="cart-discount"></td>
                            <td width="15%" class="text-right text-info">TOTAL ITEM</td>
                            <td width="15%" class="text-right text-info" id="cart-total-item">0</td>
                            <td width="25%" class="text-right text-success">TOTAL SETELAH DISKON</td>
                            <td width="15%" class="text-right text-success" id="cart-total-after-discount">0</td>
                        </tr>
                        </tbody>
                    </table>
                    <!--<button class="btn btn-default" id="btn-new-sales" disabled><i class="fa fa-plus"></i> TRANSAKSI</button>
                    <button class="btn btn-default" data-toggle="modal" data-target=".bs-modal-hold" disabled>HOLD</button>-->
                    <!-- <button title="ALT+3" class="btn btn-default" id="btn-sales-opsi"
                    data-toggle="modal" data-target=".bs-modal-sales">OPSI</button> -->

                    <!-- <button title="ALT+2" class="btn btn-warning" id="btn-sales-diskon"
                    data-toggle="modal" data-target=".bs-modal-disc" disabled="disabled">DISKON</button> -->

                    <button title="ALT+2" class="btn btn-warning" id="btn-sales-diskon" disabled="disabled" onclick="form_login()">DISKON</button>
                    <button title="ALT+1" class="btn btn-success" id="btn-sales-bayar"
                    data-toggle="modal" data-target=".bs-modal-pay" disabled="disabled">BAYAR</button>
                    <button title="ALT+C" class="btn btn-danger" id="btn-sales-batal">KELUAR</button>

                    <div id="my-modal-hold" class="modal fade bs-modal bs-modal-hold" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">TRANSAKSI AKTIF</h4>
                                </div>
                                <div class="modal-body" id="sales-hold-list">
                                    <label for="sales-list">NO. TRANSAKSI: </label>
                                    <div class="list-group" id="sales-list">
                                        <a href="#" class="list-group-item">1111</a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok" data-dismiss="modal">OK
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="my-modal-disc-item" class="modal fade bs-modal bs-modal-disc-item" tabindex="-1"
                    role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">DISKON ITEM</h4>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="" id="type_karyawan" name="type_karyawan" value=""> -->
                                    <input type="hidden" id="item_booking" name="item_booking" value="0">
                                    <label for="input-discount-item">Diskon(Rp) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount-item" value="">
                                    <label for="input-discount-item-percent">Diskon(%) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount-item-percent" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="my-modal-disc" class="modal fade bs-modal bs-modal-disc" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">DISKON NOTA</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="type_karyawan" name="type_karyawan" value="">
                                    <label for="input-discount">Diskon(Rp) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount" value="">
                                    <label for="input-discount-percent">Diskon(%) :</label>
                                    <input type="text" class="form-control input-lg numeric" id="input-discount-percent" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div id="my-modal-pay" class="modal fade bs-modal bs-modal-pay" tabindex="-1"
                    role="dialog" aria-labelledby="mySmallModalLabel"> -->
                    <div id="my-modal-pay" class="modal fade bs-modal bs-modal-pay" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="form-submit-sales" onsubmit="return false;" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">PEMBAYARAN</h4>
                                    </div>
                                        <div class="col-md-12" id="modal_body_row">
                                          <div class="modal-body">
                                          <div class="row" id="modal_body_col" style="border:none;">
                                            <div class="col-md-6" id="divpengiriman">
                                              <input type="hidden" id="datastatusambil" name="datastatusambil" value="0">
                                              <label for="">Tujuan Pengiriman</label>
                                              <input type="text" id="tujuan_pengiriman" name="tujuan_pengiriman" value="" class="form-control">
                                              <label for="">Jarak Pengiriman</label>
                                              <input type="text" id="input-jarak-currency" name="input_jarak_currency" value=""
                                              class="form-control text-right numeric">
                                              <input type="hidden" id="input-jarak" name="input_jarak" value="" class="">
                                              <label for="">Biaya</label>
                                              <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">Rp.</span>
                                                <input type="text" id="input-biaya-currency" name="input_biaya_currency" value=""
                                                class="form-control text-right numeric" value="0"
                                                aria-describedby="basic-addon1">
                                              </div>
                                              <input type="hidden" id="input-biaya" name="input_biaya" value="" class="">
                                              <div class="input-group">
                                                <input type="text" class="form-control text-right" value="Pengiriman"
                                                style="border: none; background-color: #fff; color: #000;">
                                                <span class="input-group-addon"
                                                style="border: none; background-color: #fff;">
                                                  <input type="checkbox" id="pengiriman" name="pengiriman" value="1"
                                                  style="width:20px;height:20px;">
                                                </span>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div style="display: none;" class="box-sales" id="box-sales-fee">
                                                  <label for="sales-fee">Biaya Tambahan :</label>
                                                  <input type="text" class="form-control" id="sales-fee" value="0" readonly="">
                                                  <small class="text-danger" id="sales-fee-text"></small>
                                              </div>

                                              <label for="input-total">Total : </label>
                                              <input type="text" class="form-control" id="input-total-currency" name="input-total-currency" value="0" readonly="">
                                              <input type="text" class="form-control" id="input-total" name="input-total" value="0" readonly="" style="display:none;">

                                              <div class="divPotongan" style="display: none;">
                                                <label for="input-total">Potongan : </label>
                                                <input type="text" class="form-control" id="input-potongan-currency" name="input-total-currency" value="0" readonly="">
                                                <input type="text" class="form-control" id="input-potongan" name="input-potongan" value="0" readonly="" style="display:none;">

                                                <label for="input-total">Grand Total: </label>
                                                <input type="text" class="form-control" id="input-totalpembayaran-currency" name="input-totalpembayaran-currency" value="0" readonly="">
                                                <input type="text" class="form-control" id="input-totalpembayaran" name="input-totalpembayaran" value="0" readonly="" style="display:none;">
                                              </div>


                                              <label for="sales_type">Jenis Pembayaran :</label>
                                              <select name="sales_type" id="sales_type" class="form-control">
                                                  <option value="1" selected="">Cash</option>
                                                  <option value="2">Kartu Debit</option>
                                                  <option value="3">TOP</option>
                                                  <option value="4">Transfer</option>
                                                  <option value="5">Kartu Kredit</option>
                                              </select>
                                              <div class="box-sales" id="box-sales-pay">
                                                  <label for="input-pay">Bayar :</label>
                                                  <input type="text" class="form-control numeric" id="input-pay-currency" name="sales_pay_currency" value="0">
                                                  <input type="" class="form-control" id="input-pay" name="sales_pay" value="0" style="display:none;">
                                              </div>
                                              <!-- bukan cash -->
                                              <div style="display: none;" class="box-sales" id="box-sales-dp">
                                                  <label for="sales-dp">Term Of Payment :</label>
                                                  <input type="text" class="form-control numeric" id="sales-dp" name="sales-dp" value="0">
                                                  <label for="sales-dp">Tanggal Jatuh Tempo :</label>
                                                  <div class='input-group date' id='datetimepicker1'>
                                                      <input type='text' class="form-control" name="tgl_jatuh_tempo" />
                                                      <span class="input-group-addon">
                                                          <span class="glyphicon glyphicon-calendar"></span>
                                                      </span>
                                                  </div>
                                              </div>
                                              <div style="display: none;" class="box-sales" id="box-sales-nama">
                                                  <label for="sales-nama">Nama* :</label>
                                                  <input type="text" class="form-control" id="sales-nama" name="sales-nama">
                                              </div>
                                              <div style="display: none;" class="box-sales" id="box-sales-nomor-kartu">
                                                  <label for="sales-nomor-kartu">Nomor Kartu* :</label>
                                                  <input type="text" class="form-control" id="sales-nomor-kartu" name="sales-nomor-kartu">
                                              </div>
                                              <div style="display: none;" class="box-sales" id="box-sales-nama-bank">
                                                  <label for="sales-nama-bank">Nama Bank* :</label>
                                                  <input type="text" class="form-control" id="sales-nama-bank" name="sales-nama-bank">
                                              </div>
                                              <div style="display: none;" class="box-sales" id="box-sales-nomor-rekening">
                                                  <label for="sales-nomor-rekening">Nomor Kartu :</label>
                                                  <input type="text" class="form-control" id="sales-nomor-rekening" name="sales-nomor-rekening">
                                              </div>
                                              <div style="display: none;" class="box-sales" id="box-edc">
                                                  <label for="mesin-edc">Mesin EDC :</label>
                                                  <input type="number" class="form-control" id="mesin-edc" name="mesin-edc">
                                              </div>
                                              <!-- END -->
                                              <div class="box-sales" id="box-input-cashback">
                                                  <label for="input-cashback">Kembalian :</label>
                                                  <input type="text" class="form-control" id="input-cashback-currency" value="0" readonly="">
                                                  <input type="" class="form-control" id="input-cashback" name="input-cashback" value="0" readonly=""
                                                  style="display:none;">
                                                  <!-- <input type="checkbox" name="" value="" style="margin-top: 15px;width:20px;height:20px;"> -->
                                              </div>
                                              <div class="input-group">
                                                <span class="input-group-addon"
                                                style="border: none; background-color: #fff;">
                                                <input type="checkbox" name="book_all" value="1" style="width:20px;height:20px;">
                                                </span>
                                                <input type="text" class="form-control" value="Booking All"
                                                style="border: none; background-color: #fff;">
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div id="list-hidden"><input type="hidden" name="outlet_id" value="1">
                                      <input type="hidden" name="sales_shift" value="1">
                                      <input type="hidden" name="customer_id" value="1">
                                      <input type="hidden" name="sales_discount" value="0">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-ok">OK</button>
                                        <div class="col-md-6">
                                          <div id="promo-notification">

                                          </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="my-modal-sales" class="modal fade bs-modal bs-modal-sales" tabindex="-1" role="dialog"
                    aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">OPSI PENJUALAN</h4>
                                </div>
                                <div class="modal-body">
                                    <label for="sales-outlet">NAMA OUTLET :</label>
                                    <select class="form-control" id="sales-outlet">
                                    <option value="1">Surabaya 001</option></select>
                                    <br>
                                    <label for="sales-shift">SHIFT :</label>
                                    <select class="form-control" id="sales-shift">
                                        <option value="1">SHIFT 1</option>
                                        <option value="2">SHIFT 2</option>
                                    </select>
                                    <br>
                                    <input type="hidden" class="form-control input-lg" id="sales-cash" value="0">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-ok">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>

  <div class="modal fade" id="modal_login">
    <div class="modal-dialog">
      <div class="modal-content">

      </div>
    </div>
  </div>

  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
  id="booking_modal">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

      </div>
    </div>
  </div>

  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
  id="getfromGudang_popmodal">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<script type="text/javascript">
  $(document).ready(function(){

    $('#datetimepicker1').datepicker();
    $('#datetimepicker2').datepicker({
      format: "dd/mm/yyyy"
    });

    var htmlkategori = [];
    $.ajax({
      type    : "POST",
      url     : "<?php echo base_url()?>Penjualan/Point-of-Sale/getkategori",
      dataType: "JSON",
      cache   : false,
      success : function (data){
        for (var i = 0; i < data.length; i++) {
          htmlkategori += "<option value="+data[i].kategori_id+">"+data[i].kategori_name+"</option>";
        }
        document.getElementById('select_category').innerHTML = "";
        document.getElementById('select_category').innerHTML = "<option value='allkategori'>All Category</option>"+htmlkategori;
      }
    });

      $('#divpengiriman').find('input:text').attr('readonly', 'readonly');

  });

  function form_login(){
    var url = "<?php echo base_url()?>C_POS/popmodal_form_login";
    $('#modal_login').modal('show').find('.modal-content').load(url);
  }


  $('#pengiriman').on('change', function(){

    if ($(this).is(':checked')) {
      $('#divpengiriman').find('input:text').removeAttr('readonly');
    } else {
      $('#divpengiriman').find('input').val('');
      $('#divpengiriman').find('input:text.numeric').val(0);
      // $('#divpengiriman').find('input:text').empty();
      $('#divpengiriman').find('input:text').attr('readonly', 'readonly');
    }

  });

  $("#my-modal-pay").on("hidden.bs.modal", function () {
    $("#divpengiriman input:text").val("");
    $('#pengiriman').prop('checked', false);
    $('#divpengiriman').find('input:text').attr('readonly', 'readonly');
  });

</script>
