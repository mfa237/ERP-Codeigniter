<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>POINT OF SALES</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/global/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/global/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/global/plugins/css/custom.css?v=<?php echo uniqid(); ?>">
    <script src="<?php echo base_url();?>assets/theme/global/plugins/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/theme/global/scripts/autoNumeric-min.js"></script>
</head>
<body>
<div id="struk">
    <table class="struk" width="100%">
            <tbody>
            </tbody>
    </table>
</div>
<div class="container" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-left">
                        <table class="table" style="font-size: 8pt;">
                            <tbody>
                            <tr>
                                <td>NAMA CABANG :</td>
                                <td class="text-right sales-cabang">Nama Cabang</td>
                            </tr>
                            <tr>
                                <td>CUSTOMER :</td>
                                <td class="text-right sales-customer"><a href="#"><?php echo $customer_name; ?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pull-right">
                        <table class="table" style="font-size: 8pt;">
                            <tbody>
                            <tr>
                                <td>USER :</td>
                                <td class="text-right sales-user"><?php echo $user_name; ?></td>
                            </tr>
                            <tr>
                                <td>SHIFT :</td>
                                <td class="text-right sales-shift">SHIFT 1</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="nav"><a href="#tab-A" data-toggle="tab">RECENTLY ITEMS</a></li>
                        <li class="nav active"><a href="#tab-B" data-toggle="tab" title="ALT+4">ALL ITEMS</a></li>
                        <li class="nav"><a href="#tab-C" data-toggle="tab" title="ALT+5">CUSTOMERS</a></li>
                        <li class="nav"><a href="#tab-D" data-toggle="tab" title="ALT+5">ROTI DISKON</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab-A">
                            <br>
                            <table id="table-recent-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">NAMA ITEM</th>
                                    <th class="text-right">HARGA</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-recent-items">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade in active" id="tab-B">
                            <br>
                            <div class="input-group">
                                <input type="text" id="search" class="form-control input-sm"
                                       placeholder="Cari produk">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i>
                                    </button>
                                    </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">NAMA ITEM</th>
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
                                <input type="text" id="search2" class="form-control input-sm"
                                       placeholder="Cari Customer">
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

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab-D">
                            <br>
                            <div class="input-group">
                                <input type="text" id="search" class="form-control input-sm"
                                       placeholder="Cari produk">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i>
                                    </button>
                                    </span>
                            </div><!-- /input-group -->
                            <br>
                            <table id="table-item" class="table table-hover table-striped my-item" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th width="80%">NAMA ITEM</th>
                                    <th class="text-right">HARGA</th>
                                    <th class="text-center"><i class="fa fa-th"></i></th>
                                </tr>
                                </thead>
                                <tbody class="fbody" id="data-diskon">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
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
                                <th width="20%" class="text-center">QTY</th>
                                <th width="40%">ITEM</th>
                                <th class="text-right">HARGA</th>
                                <th class="text-center" id="sales-column-discount">DISC</th>
                                <th class="text-right">TOTAL</th>
                                <th width="13%" class="text-center"><i class="fa fa-th"></i></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <table class="table">
                        <tbody style="font-size: 10px;">
                        <tr style="font-weight: bold;">
                            <td width="15%" class="text-left text-danger"><span class="diskon_text">DISKON (%)</span></td>
                            <td width="15%" class="text-right text-danger" id="cart-discount-percent"><span class="diskon_text">0</span></td>
                            <td width="15%" class="text-right text-info">TOTAL QTY</td>
                            <td width="15%" class="text-right text-info" id="cart-total-qty"><b>0</b></td>
                            <td width="25%" class="text-right text-success">TOTAL SEBELUM DISKON</td>
                            <td width="15%" class="text-right text-success" id="cart-total"><b>0</b></td>
                        </tr>
                        <tr style="font-weight: bold;">
                            <td width="15%" class="text-left text-danger"><span class="diskon_text">DISKON (Rp)</span></td>
                            <td width="15%" class="text-right text-danger" id="cart-discount"><span class="diskon_text">0</span></td>
                            <td width="15%" class="text-right text-info">TOTAL ITEM</td>
                            <td width="15%" class="text-right text-info" id="cart-total-item"><b>0</b></td>
                            <td width="25%" class="text-right text-success">TOTAL SETELAH DISKON</td>
                            <td width="15%" class="text-right text-success" id="cart-total-after-discount"><b>0</b></td>
                        </tr>
                        </tbody>
                    </table>
                    <!--<button class="btn btn-default" id="btn-new-sales" disabled><i class="fa fa-plus"></i> TRANSAKSI</button>
                    <button class="btn btn-default" data-toggle="modal" data-target=".bs-modal-hold" disabled>HOLD</button>-->
                    <button title="ALT+3" class="btn btn-default" id="btn-sales-opsi" data-toggle="modal" data-target=".bs-modal-sales">OPSI</button>
                    <button title="ALT+2" class="btn btn-warning" id="btn-sales-diskon" data-toggle="modal" data-target=".bs-modal-disc">DISKON</button>
                    <button title="ALT+1" class="btn btn-success" id="btn-sales-bayar" data-toggle="modal" data-target=".bs-modal-pay">BAYAR</button>

                    <div id="my-modal-hold" class="modal fade bs-modal bs-modal-hold" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
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
                    <div id="my-modal-disc-item" class="modal fade bs-modal bs-modal-disc-item" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">DISKON ITEM</h4>
                                </div>
                                <div class="modal-body">
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
                    <div id="my-modal-disc" class="modal fade bs-modal bs-modal-disc" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">DISKON NOTA</h4>
                                </div>
                                <div class="modal-body">
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
                    <div id="my-modal-pay" class="modal fade bs-modal bs-modal-pay" tabindex="-1" role="dialog"
                         aria-labelledby="mySmallModalLabel">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form id="form-submit-sales" onsubmit="return false;" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">PEMBAYARAN</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div style="display: none;" class="box-sales" id="box-sales-fee">
                                            <label for="sales-fee">Biaya Tambahan :</label>
                                            <input type="text" class="form-control" id="sales-fee" value="0" readonly>
                                            <small class="text-danger" id="sales-fee-text"></small>
                                        </div>
                                        <label for="input-total">Total :</label>
                                        <input type="text" class="form-control" id="input-total" value="0" readonly>
                                        <label for="sales_type">Jenis Pembayaran :</label>
                                        <select name="sales_type" id="sales_type" class="form-control">
                                            <option value="cash" selected>Cash</option>
                                            <option value="debit">Debit</option>
                                            <option value="kredit">Kredit</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="kartu_kredit">Kartu Kredit</option>
                                        </select>
                                        <div class="box-sales" id="box-sales-pay">
                                            <label for="input-pay">Bayar :</label>
                                            <input type="text" class="form-control numeric" id="input-pay" name="sales_pay" value="0">
                                        </div>
                                        <div style="display: none;" class="box-sales" id="box-sales-dp">
                                            <label for="sales-dp">DP :</label>
                                            <input type="text" class="form-control numeric" id="sales-dp" name="sales-dp" value="0">
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
                                            <label for="sales-nomor-rekening">Nomor Rekening :</label>
                                            <input type="text" class="form-control" id="sales-nomor-rekening" name="sales-nomor-rekening">
                                        </div>
                                        <div class="box-sales" id="box-input-cashback">
                                            <label for="input-cashback">Kembalian :</label>
                                            <input type="text" class="form-control" id="input-cashback" value="0" readonly>
                                        </div>
                                    </div>
                                    <div id="list-hidden"></div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-ok">OK</button>
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
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">OPSI PENJUALAN</h4>
                                </div>
                                <div class="modal-body">
                                    <label for="sales-outlet">NAMA OUTLET :</label>
                                    <select class="form-control" id="sales-outlet">
                                    </select>
                                    <br>
                                    <label for="sales-shift">SHIFT :</label>
                                    <select class="form-control" id="sales-shift">
                                        <option value="1">SHIFT 1</option>
                                        <option value="2">SHIFT 2</option>
                                    </select>
                                    <br>
                                    <!--                                        <label for="sales-cash">CASH :</label>-->
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
<script type="text/javascript">
    var outlets = [<?php echo json_encode($outlets);?>];
    var customers = [];
    var items = [];
    var recent_items = [];
    var sales_discount_item = 0;
    var sales_discount_item_current_index = 0;
    var sales_total_item = 0;
    var sales_active = 0;
    var sales_pay = 0;
    var sales_cashback = 0;
    var sales_date = "<?php echo date('d-m-Y');?>";
    var sales_time = "<?php echo date('H:i:s');?>";
    var sales_customer = "umum";
    var sales_customer_id = 1;
    var sales_cabang = "<?php echo $outlets['value'];?>";
    var sales_cabang_id = <?php echo $outlets['id'];?>;
    var base_url = "<?php echo base_url();?>";
    var sales_id = 1;


    var sales_shift = 1;
    if (localStorage.getItem("sales_shift") == null){
        sales_shift = 1;
    }else{
        sales_shift = localStorage.getItem("sales_shift");
    }

    
    var sales_discount = 0;
    var sales_cash = 0;
    var sales_username = '<?php echo strtoupper($user_name);?>';
    var sales_fee = <?php echo $setting_sales['sales_charge_kartu_kredit']; ?>;
    var sales_fee_batas = <?php echo $setting_sales['sales_batas_kartu_kredit'] ?>;
</script>
<script type="text/javascript">
    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<script type="text/javascript">
    var intTotal = 0;
    var intSubTotal = 0;

    jQuery(function($) {
        $('.numeric').autoNumeric('init',{aPad: false});
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function () {


        $("#btn-sales-bayar").click(function(){
            $("#sales_type").val('cash');
            $("#sales_type").change();
        });

        $("#search").focus();


        $("#sales-dp").keyup(function(){
            var d = $(this).val();
            var duit  = Number(d.replace(/[^0-9\.]+/g,""));
            if (duit >= intTotal){
                duit = intTotal;
            }
            $(this).val(duit);
        });

        /*LOCAL STORAGE*/
        var storage_sales = JSON.parse(localStorage.getItem('sales'));
        var storage_sales_detail = JSON.parse(localStorage.getItem('sales_detail'));

        if (!storage_sales_detail) {
            storage_sales_detail = [];
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
        }

        $.each(outlets, function (index, value) {
            $('#sales-outlet').append($('<option/>', {
                value: value.id,
                text: value.value
            }));
        });

        $('#my-modal-sales').on('click', '.btn-ok', function () {
            sales_cabang_id = $("#sales-outlet").find('option:selected').val();
            sales_cabang = $("#sales-outlet").find('option:selected').text();
            sales_cash = $("#sales-cash").val();
            sales_shift = $("#sales-shift").val();
            localStorage.setItem("sales_shift", sales_shift);
            $.fn.updateSales();
            $('#my-modal-sales').modal('toggle');
        });

        $('#my-modal-disc').on('click', '.btn-ok', function () {
            if( $('#input-discount').val().length == 0 ){
                sales_discount = 0;
            }else{
                sales_discount = parseInt($("#input-discount").autoNumeric('get'));
            }
            if( sales_discount > total_sales_detail ){
                alert('Diskon tidak boleh lebih dari total bayar!');
                sales_discount = 0;
                $("#input-discount").val('0');
                $("#input-discount-percent").val('0')
            }else{
                $.fn.updateSales();
                $('#my-modal-disc').modal('toggle');
            }
        });

        $('#my-modal-disc-item').on('click', '.btn-ok', function () {
            var current_discount_item = 0;
            if( $('#input-discount-item').val().length == 0 ){
                current_discount_item = 0;
            }else{
                current_discount_item = parseInt($("#input-discount-item").autoNumeric('get'));
            }
            if( current_discount_item > sales_total_item ){
                alert('Diskon tidak boleh lebih dari total!');
                current_discount_item = 0;
                $("#input-discount-item").val('0');
                $("#input-discount-item-percent").val('0')
            }else{
                console.log( current_discount_item );
                var item_index = sales_discount_item_current_index;
                var this_name = '';
                var this_id = 0;
                var this_price = 0;
                var this_qty = 0;
                var this_disc = 0;
                var this_total = 0;
                var item_exist = 0;
                var item_exist_index = -1;

                if (storage_sales_detail) {
                    $.each(storage_sales_detail, function (index, value) {
                        if (item_index == index) {
                            this_name = value.item_name;
                            this_id = value.item_id;
                            this_price = value.item_price;
                            this_qty = value.item_qty;
                            this_disc = current_discount_item;
                            this_has_promo = value.item_has_promo;
                            this_promo_type = value.item_promo_type;
                            this_promo_gratis = value.item_promo_gratis;
                            this_promo_item_name = value.item_promo_item_name;
                            this_promo_qty = value.item_promo_qty;
                            this_total = value.item_total * this_qty;
                            item_exist = 1;
                            item_exist_index = index;
                        }
                    });
                }
                var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                    'item_disc': this_disc,
                    'item_total': this_total,
                    'item_has_promo': this_has_promo,
                    'item_promo_type': this_promo_type,
                    'item_promo_gratis': this_promo_gratis,
                    'item_promo_item_name': this_promo_item_name,
                    'item_promo_qty': this_promo_qty
                };
                storage_sales_detail[item_exist_index] = new_data;
                localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
                $.fn.refreshChart();
                $('#my-modal-disc-item').modal('toggle');
            }
        });

        $.fn.getCustomers = function () {
            $.get( base_url+'customers',function(data){
                customers = data;
                var html = '';
                $.each(data, function (index, value) {
                    html += '<tr><td id="item-name">'+value.customer_name+'</td>' +
                        '<td class="text-right">'+value.customer_phone+'</td>' +
                        '<td class="text-center"><button data-name="'+value.customer_name+'" data-id="'+value.customer_id+
                        '" class="btn btn-success btn-xs btn-add-customer">' +
                        '<i class="fa fa-check"></i></button></td></tr>';
                });
                $("#data-customers").html(html);
            });
        };

        $.fn.getItems = function () {
            // $.get( base_url+'items',function(data){
            //     alert(data);
            //     console.log(data);
            // });
            $.get( base_url+'items',function(data){
                items = data;
                var html = '';
                $.each(data, function (index, value) {
                    html += '<tr><td id="item-name">'+value.item_name+' EXP.'+value.inventory_expired+'</td>' +
                        '<td class="text-right">'+Intl.NumberFormat().format(value.inventory_price_sales)+'</td><td class="text-center">' +
                        '<button data-disc="'+value.item_disc+'" data-price="'+value.inventory_price_sales+
                        '" data-qty="1" data-name="'+value.item_name+' EXP.'+value.inventory_expired+
                        '" data-id="'+value.inventory_id+
                        '" data-has-promo="'+value.has_promo+'" data-promo-type="'+value.promo_type+
                        '" data-promo-item-name="'+value.promo_item_name+
                        '" data-promo-gratis="'+value.promo_gratis+'" data-promo-qty="'+value.promo_qty+
                        '" class="btn btn-success btn-xs btn-add-cart">' +
                        '<i class="fa fa-plus"></i></button></td></tr>';
                });
                $("#data-items").html(html);

            }).fail(function(data){
                    alert(data);
                });
        };

        $.fn.getDiskon = function () {
            $.get( base_url+'roti_diskon',function(data){
                items = data;
                var html = '';
                $.each(data, function (index, value) {
                    html += '<tr><td id="item-name">'+value.item_name+' EXP.'+value.expired+'</td>' +
                        '<td class="text-right">'+Intl.NumberFormat().format(value.retur_detail_price)+'</td><td class="text-center">' +
                        '<button data-disc="'+value.item_disc+'" data-price="'+value.retur_detail_price+
                        '" data-qty="1" data-name="'+value.item_name+' EXP.'+value.expired+
                        '" data-id="'+value.retur_detail_id+
                        '" data-has-promo="'+value.has_promo+'" data-promo-type="'+value.promo_type+
                        '" data-promo-item-name="'+value.promo_item_name+
                        '" data-promo-gratis="'+value.promo_gratis+'" data-promo-qty="'+value.promo_qty+
                        '" class="btn btn-success btn-xs btn-add-cart">' +
                        '<i class="fa fa-plus"></i></button></td></tr>';
                });
                $("#data-diskon").html(html);
            });
        };

        $.fn.getRecentItems = function () {
            $.get( base_url+'recent-items',function(data){
                recent_items = data;
                var html = '';
                $.each(data, function (index, value) {
                    html += '<tr><td id="item-name">'+value.item_name+' EXP.'+value.inventory_expired+'</td>' +
                        '<td class="text-right">'+Intl.NumberFormat().format(value.inventory_price_sales)+'</td><td class="text-center">' +
                        '<button data-disc="'+value.item_disc+'" data-price="'+value.inventory_price_sales+
                        '" data-qty="1" data-name="'+value.item_name+' EXP.'+value.inventory_expired+
                        '" data-id="'+value.inventory_id+
                        '" data-has-promo="'+value.has_promo+'" data-promo-type="'+value.promo_type+
                        '" data-promo-item-name="'+value.promo_item_name+
                        '" data-promo-gratis="'+value.promo_gratis+'" data-promo-qty="'+value.promo_qty+
                        '" class="btn btn-success btn-xs btn-add-cart">' +
                        '<i class="fa fa-plus"></i></button></td></tr>';
                });
                $("#data-recent-items").html(html);
            });
        };

        $.fn.updateSales = function () {
            var new_sales = {
                'sales_cabang_id': sales_cabang_id,
                'sales_cabang': sales_cabang,
                'sales_customer': sales_customer,
                'sales_customer_id': sales_customer_id,
                'sales_disc': sales_discount,
                'sales_shift': sales_shift
            };
            storage_sales = new_sales;
            localStorage.setItem('sales', JSON.stringify(storage_sales));
            $.fn.refreshChart();
        };

        $.fn.updateSalesDiscount = function () {
            var new_sales = {
                'sales_cabang_id': sales_cabang_id,
                'sales_cabang': sales_cabang,
                'sales_customer': sales_customer,
                'sales_customer_id': sales_customer_id,
                'sales_disc': sales_discount,
                'sales_shift': sales_shift
            };
            storage_sales = new_sales;
            localStorage.setItem('sales', JSON.stringify(storage_sales));
        };

        $.fn.refreshSales = function () {
            storage_sales = JSON.parse(localStorage.getItem('sales'));
            if (storage_sales) {
                sales_cabang_id = parseInt(storage_sales.sales_cabang_id);
                sales_cabang = storage_sales.sales_cabang;
                sales_customer = storage_sales.sales_customer;
                sales_customer_id = parseInt(storage_sales.sales_customer_id);
                sales_discount = parseInt(storage_sales.sales_disc);
                sales_shift = parseInt(storage_sales.sales_shift);
            }
        };

        $.fn.refreshChart = function () {
            $.fn.refreshSales();
            storage_sales_detail = JSON.parse(localStorage.getItem('sales_detail'));

            var html = '';
            var html_struk = '';
            var input_sales_detail = '';
            intSubTotal = 0;
            total_sales_detail = 0;
            var total_disc_prod = 0;
            var total_item = 0;
            var total_item_qty = 0;
            var has_discount = 0;

            var input_sales = ''
                + '<input type="hidden" name="outlet_id" value="' + sales_cabang_id + '">'
                + '<input type="hidden" name="sales_shift" value="' + sales_shift + '">'
                + '<input type="hidden" name="customer_id" value="' + sales_customer_id + '">'
                + '<input type="hidden" name="sales_discount" value="' + sales_discount + '">';

            html_struk += '<tr class="border-bottom">';
            html_struk += '<td style="text-align: center;" colspan="4">HEADER STRUK</td>';
            html_struk += '</tr>';
            html_struk += '<tr class="border-bottom">';
            html_struk += '<td style="text-align: center;" colspan="2">'+sales_date+' '+sales_time+'</td>';
            html_struk += '<td style="text-align: center;" colspan="2">'+sales_username+'</td>';
            html_struk += '</tr>';
            html_struk += '<tr class="border-bottom">';
            html_struk += '<td>NAMA</td>';
            html_struk += '<td style="text-align: center;">QTY</td>';
            html_struk += '<td style="text-align: right;">HARGA</td>';
            html_struk += '<td style="text-align: right;">SUBTOTAL</td>';
            html_struk += '</tr>';

            $.each(storage_sales_detail, function (index, value) {
                var item_disc = value.item_disc;
                if( item_disc ) has_discount = 1;
            });

            $.each(storage_sales_detail, function (index, value) {
                var item_name = value.item_name;
                var item_id = value.item_id;
                var item_price = value.item_price;
                var item_qty = value.item_qty;
                var item_disc = value.item_disc;
                var item_has_promo = value.item_has_promo;
                var item_promo_type = value.item_promo_type;
                var item_promo_gratis = value.item_promo_gratis;
                var item_promo_item_name = value.item_promo_item_name;
                var item_promo_qty = value.item_promo_qty;
                var item_disc_total = 0;
                if( item_disc > 0 ) item_disc_total += item_disc;
                var item_total = (item_qty * item_price) - item_disc_total;
                var item_total_before_discount = item_qty * item_price;
                total_sales_detail += item_total;
                total_disc_prod += item_disc_total;
                total_item+=1;
                total_item_qty+=item_qty;

                var promo_text = '';
                if( item_has_promo && item_qty >= item_promo_qty ){
                    if( item_promo_type == 'item' ){
                        item_promo_gratis = Math.floor(item_qty/item_promo_qty)* item_promo_gratis;
                        total_item+=1;
                        total_item_qty+=item_promo_gratis;
                        promo_text = '<br/><small style="font-size: 9px;color: red;">(GRATIS) ' + item_promo_item_name + ' x ' + item_promo_gratis + '</small>';
                    }else{
                        //item_promo_gratis = Math.floor(item_qty/item_promo_qty)* item_promo_gratis;
                        promo_text = '<br/><small style="font-size: 9px;color: red;">Cashback Rp ' + Intl.NumberFormat().format(item_disc) + '</small>';
                        //item_disc_total+=item_promo_gratis;
                    }
                }

                var input = '<input type="hidden" name="item_id[]" value="' + item_id + '">'
                    + '<input type="hidden" name="item_qty[]" value="' + item_qty + '">'
                    + '<input type="hidden" name="item_discount[]" value="' + item_disc_total + '">';

                input_sales_detail += input;

                intSubTotal += item_total;
                var itemPrice = Intl.NumberFormat().format(item_price);
                var itemTotal = Intl.NumberFormat().format(item_total);
                var itemDiscTotal = Intl.NumberFormat().format(item_disc_total);

                html += '<tr>';
                html += '<td class="text-center">';
                html += '<div class="input-group input-group-sm">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="" class="btn btn-danger btn-sm btn-decrease-cart" type="button"><i class="fa fa-minus"></i></button>';
                html += '</span>';
                html += '<input type="text"  style="text-align:center;" class="form-control input-sm qty" value="' + item_qty + '">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="" class="btn btn-success btn-sm btn-increase-cart" type="button"><i class="fa fa-plus"></i></button>';
                html += '</span>';
                html += '</div>';
                html += '</td>';
                html += '<td>' + item_name;
                if( item_has_promo ) html += promo_text;
                html += '</td>';
                html += '<td class="text-right">' + itemPrice + '</td>';
                if( has_discount ) html += '<td class="text-center">' + itemDiscTotal + '</td>';
                html += '<td class="text-right">' + itemTotal + '</td>';
                html += '<td style="text-align: right;">' +
                    '<div class="btn-group">' +
                    '<button type="button" title="diskon item" data-discount-item="'+item_disc_total+'" data-total="'+item_total_before_discount+'" class="btn btn-primary btn-sm btn-show-discount-item"><i class="fa fa-usd" aria-hidden="true"></i></button>' +
                    '<button type="button" title="hapus item" class="btn btn-danger btn-sm btn-remove-cart"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
                    '</div>' +
                    '</td>';
                html += '</tr>';

                html_struk += '<tr>';
                if( item_disc > 0 ){
                    html_struk += '<td>' + item_name +' DISC '+itemDiscTotal + '%</td>';
                }else{
                    html_struk += '<td>' + item_name +'</td>';
                }
                html_struk += '<td style="text-align: center;">'+ item_qty  +'</td>';
                html_struk += '<td style="text-align: right;">' + itemPrice + '</td>';
                html_struk += '<td style="text-align: right;">' + itemTotal + '</td>';
                html_struk += '</tr>';
            });

            if( has_discount ) {
                $("#sales-column-discount").removeClass('hide');
            }else{
                $("#sales-column-discount").addClass('hide');
            }

            html += input_sales;

            var total_disc_nota = 0;
            if( sales_discount > 0 ) total_disc_nota += sales_discount;
            intTotal = intSubTotal - (total_disc_nota);
            intTotal = Math.ceil(intTotal/100)*100;

			
			
            var cartTotal = Intl.NumberFormat().format(intTotal);
            var cartSubTotal = Intl.NumberFormat().format(intSubTotal);
            var cartDiscount = Intl.NumberFormat().format(sales_discount);
            var cartDiscountPercent = Intl.NumberFormat().format(total_disc_nota/total_sales_detail*100);
            var cartItemTotal = Intl.NumberFormat().format(total_item);
            var cartItemQty = Intl.NumberFormat().format(total_item_qty);

            html_struk += '<tr class="border-top">';
            html_struk += '<td style="text-align: right;" colspan="2">HARGA JUAL :</td>';
            html_struk += '<td style="text-align: right;" colspan="2">'+ cartTotal +'</td>';
            html_struk += '</tr>';
            html_struk += '<tr class="border-top">';
            html_struk += '<td style="text-align: center;" colspan="4">FOOTER STRUK</td>';
            html_struk += '</tr>';

            $("#list-hidden").html(input_sales + input_sales_detail);
            $(".transaksi tbody").html(html);
            $(".struk tbody").html(html_struk);
            $("#cart-discount").html(cartDiscount);
            $("#cart-discount-percent").html(cartDiscountPercent);
            $("#input-discount").val(sales_discount);
            $("#cart-total").html(cartSubTotal);
            $("#cart-total-after-discount").html(cartTotal);
            $("#cart-total-item").html(cartItemTotal);
            $("#cart-total-qty").html(cartItemQty);
            $("#cart-total-big").html(cartTotal);
            $(".sales-customer").html(sales_customer.toUpperCase());
            $(".sales-id").html(sales_id);
            $(".sales-cabang").html(sales_cabang);
            $(".sales-shift").html(sales_shift);

            $("#my-modal-pay").find("input:text#input-total").val(cartTotal);

            if( sales_discount == 0 ){
                $(".diskon_text").addClass('hide');
                $("#cart-discount").html('');
                $("#cart-discount-percent").html('');
            }else{
                $(".diskon_text").removeClass('hide');
            }

            if (total_item == 0) {
                $("#btn-sales-bayar").attr('disabled', 'disabled');
                $("#btn-sales-diskon").attr('disabled', 'disabled');
                $.fn.refreshSales();
            } else {
                $("#btn-sales-bayar").removeAttr('disabled');
                $("#btn-sales-diskon").removeAttr('disabled');
            }
        };

        $.fn.addCart = function (btn) {
            var this_name = btn.attr('data-name');
            var this_id = parseInt(btn.attr('data-id'));
            var this_price = parseInt(btn.attr('data-price'));
            var this_qty = parseInt(btn.attr('data-qty'));
            var this_disc = parseInt(btn.attr('data-disc'));
            var this_has_promo = parseInt(btn.attr('data-has-promo'));
            var this_promo_type = btn.attr('data-promo-type');
            var this_promo_gratis = parseInt(btn.attr('data-promo-gratis'));
            var this_promo_item_name = btn.attr('data-promo-item-name');
            var this_promo_qty = parseInt(btn.attr('data-promo-qty'));
            var this_total = this_qty * this_price;
            var item_exist = 0;
            var item_exist_index = -1;
            if (storage_sales_detail) {
                $.each(storage_sales_detail, function (index, value) {
                    if (value.item_id == this_id) {
                        item_exist = 1;
                        item_exist_index = index;
                        this_qty = this_qty + value.item_qty;
                    }
                });
            }
            if (item_exist) storage_sales_detail.splice(item_exist_index, 1);

            var discount = this_disc;
            if( this_has_promo && this_qty >= this_promo_qty ){
                if( this_promo_type == 'uang' ){
                    discount = Math.floor(this_qty/this_promo_qty)* this_promo_gratis;
                }
            }

            var new_sales_detail = {
                'item_name': this_name,
                'item_id': this_id,
                'item_price': this_price,
                'item_qty': this_qty,
                'item_disc': discount,
                'item_total': this_total,
                'item_has_promo': this_has_promo,
                'item_promo_type': this_promo_type,
                'item_promo_gratis': this_promo_gratis,
                'item_promo_item_name': this_promo_item_name,
                'item_promo_qty': this_promo_qty
            };
            storage_sales_detail.push(new_sales_detail);
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            $.fn.refreshChart();
        };

        $("body").on("click", ".btn-remove-cart", function (e) {
            var item_row = $(this).parent().parent().parent();
            var item_index = item_row.index();
            item_row.remove();
            storage_sales_detail.splice(item_index, 1);
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            $.fn.refreshChart();
        });

        $("body").on("click", ".btn-show-discount-item", function (e) {
            var item_row = $(this).parent().parent().parent();
            sales_discount_item_current_index = item_row.index();
            sales_total_item = parseInt($(this).attr('data-total'));
            sales_discount_item = parseInt($(this).attr('data-discount-item'));
            $("#input-discount-item").autoNumeric('set', sales_discount_item);
            var persen = sales_discount_item/sales_total_item*100;
            $("#input-discount-item-percent").autoNumeric('set', persen);
            $('#my-modal-disc-item').modal('toggle');
            e.preventDefault();
        });

        $("#input-discount-item").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var persen = this_value/sales_total_item*100;
            $("#input-discount-item-percent").autoNumeric('set', persen);
        });

        $("#input-discount-item-percent").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var nominal = this_value/100*sales_total_item;
            $("#input-discount-item").autoNumeric('set', nominal);
        });

        $("#input-discount").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var persen = this_value/total_sales_detail*100;
            $("#input-discount-percent").autoNumeric('set', persen);
        });

        $("#input-discount-percent").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var nominal = this_value/100*total_sales_detail;
            $("#input-discount").autoNumeric('set', nominal);
        });

        $("#input-pay").keyup(function () {
            sales_pay = $(this).autoNumeric('get');
			
			var total_fee = sales_fee / 100 * intTotal;
			var tot = intTotal + total_fee;
			
            sales_cashback = sales_pay - tot;
            var cashback2 = Intl.NumberFormat().format(sales_cashback);
            $("#my-modal-pay").find("input:text#input-cashback").val(cashback2);
        });

        $("#search").keyup(function () {
            var new_data = [];
            var word = $(this).val();
            word = word.toLowerCase();
            $.each(items, function (index, value) {
                var name = value.item_name.toLowerCase();
                if( name.search(word) > -1){
                    this_data = {
                        'inventory_id' : value.inventory_id,
                        'item_name' : value.item_name,
                        'inventory_expired' : value.inventory_expired,
                        'inventory_price_sales' : value.inventory_price_sales,
                        'item_disc' : value.item_disc,
                        'has_promo' : value.has_promo,
                        'promo_type' : value.promo_type,
                        'promo_item_name' : value.promo_item_name,
                        'promo_gratis' : value.promo_gratis,
                        'promo_qty' : value.promo_qty
                    };
                    new_data.push(this_data);
                }
            });
            var html = '';
            $.each(new_data, function (index, value) {
                html += '<tr><td id="item-name">'+value.item_name+' EXP.'+value.inventory_expired+'</td>' +
                    '<td class="text-right">'+Intl.NumberFormat().format(value.inventory_price_sales)+'</td><td class="text-center">' +
                    '<button data-disc="'+value.item_disc+'" data-price="'+value.inventory_price_sales+
                    '" data-qty="1" data-name="'+value.item_name+' EXP.'+value.inventory_expired+
                    '" data-id="'+value.inventory_id+
                    '" data-has-promo="'+value.has_promo+'" data-promo-type="'+value.promo_type+
                    '" data-promo-item-name="'+value.promo_item_name+
                    '" data-promo-gratis="'+value.promo_gratis+'" data-promo-qty="'+value.promo_qty+
                    '" class="btn btn-success btn-xs btn-add-cart">' +
                    '<i class="fa fa-plus"></i></button></td></tr>';
            });
            $("#data-items").html(html);
        });

        $("#search").keyup(function () {
            var new_data = [];
            var word = $(this).val();
            word = word.toLowerCase();
            $.each(items, function (index, value) {
                var name = value.item_name.toLowerCase();
                if( name.search(word) > -1){
                    this_data = {
                        'inventory_id' : value.inventory_id,
                        'item_name' : value.item_name,
                        'inventory_expired' : value.inventory_expired,
                        'inventory_price_sales' : value.inventory_price_sales,
                        'item_disc' : value.item_disc,
                        'has_promo' : value.has_promo,
                        'promo_type' : value.promo_type,
                        'promo_item_name' : value.promo_item_name,
                        'promo_gratis' : value.promo_gratis,
                        'promo_qty' : value.promo_qty
                    };
                    new_data.push(this_data);
                }
            });
            var html = '';
            $.each(new_data, function (index, value) {
                html += '<tr><td id="item-name">'+value.item_name+' EXP.'+value.inventory_expired+'</td>' +
                    '<td class="text-right">'+Intl.NumberFormat().format(value.inventory_price_sales)+'</td><td class="text-center">' +
                    '<button data-disc="'+value.item_disc+'" data-price="'+value.inventory_price_sales+
                    '" data-qty="1" data-name="'+value.item_name+' EXP.'+value.inventory_expired+
                    '" data-id="'+value.inventory_id+
                    '" data-has-promo="'+value.has_promo+'" data-promo-type="'+value.promo_type+
                    '" data-promo-item-name="'+value.promo_item_name+
                    '" data-promo-gratis="'+value.promo_gratis+'" data-promo-qty="'+value.promo_qty+
                    '" class="btn btn-success btn-xs btn-add-cart">' +
                    '<i class="fa fa-plus"></i></button></td></tr>';
            });
            $("#data-diskon").html(html);
        });

        $("#search2").keyup(function () {
            var new_data = [];
            var word = $(this).val();
            word = word.toLowerCase();
            $.each(customers, function (index, value) {
                var name = value.customer_name.toLowerCase();
                if( name.search(word) > -1){
                    this_data = {
                        'customer_id' : value.customer_id,
                        'customer_name' : value.customer_name,
                        'customer_phone' : value.customer_phone
                    };
                    new_data.push(this_data);
                }
            });
            var html = '';
            $.each(new_data, function (index, value) {
                html += '<tr><td id="item-name">'+value.customer_name+'</td>' +
                    '<td class="text-right">'+value.customer_phone+'</td>' +
                    '<td class="text-center"><button data-name="'+value.customer_name+'" data-id="'+value.customer_id+
                    '" class="btn btn-success btn-xs btn-add-customer">' +
                    '<i class="fa fa-check"></i></button></td></tr>';
            });
            $("#data-customers").html(html);
        });

        $('body').on('click', '.btn-add-cart', function (e) {
            $.fn.addCart($(this));
            e.preventDefault();
        });

        $('body').on('click', '.btn-add-customer', function (e) {
            sales_customer_id = $(this).attr("data-id");
            sales_customer = $(this).attr("data-name");
            $.fn.updateSales();
            e.preventDefault();
        });

        $('#my-modal-hold').on('click', '.list-group-item', function (e) {
            sales_id = $(this).html();
            $(".list-group-item").removeClass("active");
            $(this).addClass("active");
            $.fn.refreshChart();
            e.preventDefault();
        });

        $("#btn-new-sales").click(function () {
            $.fn.newSales();
        });

        $(document).on('keydown', '.qty', function(e){
            if(e.which == 13) {
                var item_qty = 1;
                if( $(this).val().length == 0 || $(this).val() < 1 ){
                    item_qty = 1;
                }else{
                    item_qty = parseInt($(this).val());
                }
                var item_row = $(this).parent().parent().parent();
                var item_index = item_row.index();
                var this_name = '';
                var this_id = 0;
                var this_price = 0;
                var this_qty = 0;
                var this_disc = 0;
                var this_total = 0;
                var item_exist = 0;
                var item_exist_index = -1;

                if (storage_sales_detail) {
                    $.each(storage_sales_detail, function (index, value) {
                        if (item_index == index) {

                            var discount = 0;
                            if( value.item_has_promo && item_qty >= value.item_promo_qty ){
                                if( value.item_promo_type == 'uang' ){
                                    discount = Math.floor(item_qty/value.item_promo_qty)* value.item_promo_gratis;
                                }
                            }

                            this_name = value.item_name;
                            this_id = value.item_id;
                            this_price = value.item_price;
                            this_qty = item_qty;
                            this_disc = discount;
                            this_has_promo = value.item_has_promo;
                            this_promo_type = value.item_promo_type;
                            this_promo_gratis = value.item_promo_gratis;
                            this_promo_item_name = value.item_promo_item_name;
                            this_promo_qty = value.item_promo_qty;
                            this_total = value.item_total * this_qty;
                            item_exist = 1;
                            item_exist_index = index;
                        }
                    });
                }
                var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                    'item_disc': this_disc,
                    'item_total': this_total,
                    'item_has_promo': this_has_promo,
                    'item_promo_type': this_promo_type,
                    'item_promo_gratis': this_promo_gratis,
                    'item_promo_item_name': this_promo_item_name,
                    'item_promo_qty': this_promo_qty
                };
                storage_sales_detail[item_exist_index] = new_data;
                localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
                $.fn.refreshChart();
            }
        });

        $("body").on("click", ".btn-increase-cart", function (event) {
            var item_row = $(this).parent().parent().parent().parent();
            var item_index = item_row.index();
            var this_name = '';
            var this_id = 0;
            var this_price = 0;
            var this_qty = 0;
            var this_disc = 0;
            var this_total = 0;
            var item_exist = 0;
            var item_exist_index = -1;

            if (storage_sales_detail) {
                $.each(storage_sales_detail, function (index, value) {
                    if (item_index == index) {

                        var qty = value.item_qty + 1;
                        var discount = 0;
                        if( value.item_has_promo && qty >= value.item_promo_qty ){
                            if( value.item_promo_type == 'uang' ){
                                discount = Math.floor(qty/value.item_promo_qty)* value.item_promo_gratis;
                            }
                        }

                        this_name = value.item_name;
                        this_id = value.item_id;
                        this_price = value.item_price;
                        this_qty = value.item_qty + 1;
                        this_disc = discount;
                        this_has_promo = value.item_has_promo;
                        this_promo_type = value.item_promo_type;
                        this_promo_gratis = value.item_promo_gratis;
                        this_promo_item_name = value.item_promo_item_name;
                        this_promo_qty = value.item_promo_qty;
                        this_total = value.item_total * this_qty;
                        item_exist = 1;
                        item_exist_index = index;
                    }
                });
            }
            var new_data = {
                'item_name': this_name,
                'item_id': this_id,
                'item_price': this_price,
                'item_qty': this_qty,
                'item_disc': this_disc,
                'item_total': this_total,
                'item_has_promo': this_has_promo,
                'item_promo_type': this_promo_type,
                'item_promo_gratis': this_promo_gratis,
                'item_promo_item_name': this_promo_item_name,
                'item_promo_qty': this_promo_qty
            };
            storage_sales_detail[item_exist_index] = new_data;
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            $.fn.refreshChart();
            event.preventDefault();
        });

        $("body").on("click", ".btn-decrease-cart", function (event) {
            var qty = $(this).parent().parent().find("input:text");
            var value = qty.val();
            value = parseInt(value);
            if (value > 1) {
                var item_row = $(this).parent().parent().parent().parent();
                var item_index = item_row.index();
                var this_name = '';
                var this_id = 0;
                var this_price = 0;
                var this_qty = 0;
                var this_disc = 0;
                var this_total = 0;
                var item_exist = 0;
                var item_exist_index = -1;
                if (storage_sales_detail) {
                    $.each(storage_sales_detail, function (index, value) {
                        if (item_index == index) {

                            var qty = value.item_qty - 1;
                            var discount = 0;
                            if( value.item_has_promo && qty >= value.item_promo_qty ){
                                if( value.item_promo_type == 'uang' ){
                                    discount = Math.floor(qty/value.item_promo_qty)* value.item_promo_gratis;
                                }
                            }

                            this_name = value.item_name;
                            this_id = value.item_id;
                            this_price = value.item_price;
                            this_qty = qty;
                            this_disc = discount;
                            this_has_promo = value.item_has_promo;
                            this_promo_type = value.item_promo_type;
                            this_promo_gratis = value.item_promo_gratis;
                            this_promo_item_name = value.item_promo_item_name;
                            this_promo_qty = value.item_promo_qty;
                            this_total = value.item_total * this_qty;
                            item_exist = 1;
                            item_exist_index = index;
                        }
                    });
                }
                var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                    'item_disc': this_disc,
                    'item_total': this_total,
                    'item_has_promo': this_has_promo,
                    'item_promo_type': this_promo_type,
                    'item_promo_gratis': this_promo_gratis,
                    'item_promo_item_name': this_promo_item_name,
                    'item_promo_qty': this_promo_qty
                };
                storage_sales_detail[item_exist_index] = new_data;
                localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
                $.fn.refreshChart();
                event.preventDefault();
            }
        });

        $.fn.resetSales = function (e) {
            $("#input-pay").val('0');
            storage_sales_detail = [];
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            localStorage.removeItem('sales');
            sales_discount = 0;
            $.fn.getCustomers();
            $.fn.getItems();
            $.fn.getDiskon();
            $.fn.getRecentItems();
            $.fn.refreshChart();
        };

        $("#form-submit-sales").submit(function (e) {
            var status_cashback = false;
            if( $("#sales_type").find('option:selected').val() == 'kredit' ){
                status_cashback = true;
            }

            if( $("#sales_type").find('option:selected').val() == 'kartu_kredit' ){
                if ($("#sales-nama").val() == "" || $("#sales-nomor-kartu").val() == "" || $("#sales-nama-bank").val() == ""){
                    alert("Silakan Lengkapi Nama, Nomor Kartu, dan Nama Bank");
                    return false;
                }
            }

            if (sales_cashback >= 0 || status_cashback) {
                var option = "ajax/";
                var url = base_url + option;
                $.ajax({
                    type: 'post',
                    data: $(this).serialize(),
                    url: url, success: function (result) {
                        var obj = JSON.parse(result);
                        console.log( obj );
                        if( obj.status ){
                            $('#my-modal-pay').modal('toggle');
                            /*window.print();*/
							window.open('<?php echo base_url()?>invo/'+obj.ids, '_blank');
                            $.fn.resetSales();
                        }else {
                            console.log( 'error' );
                        }
                    }
                });
            } else {
                alert("Tidak bisa melakukan proses pembayaran, Nominal pembayaran yang anda masukan kurang dari total pembayaran");
            }

        });

        $.fn.refreshChart();

        window.onbeforeunload = function() {
            localStorage.removeItem('sales_detail');
            localStorage.removeItem('sales');
            return '';
        };

        $('#my-modal-pay').on('shown.bs.modal', function() {
            $("#sales_type").focus();
        });

        $('#my-modal-disc').on('shown.bs.modal', function() {
            $("#input-discount").focus();
        });

        $('#my-modal-disc-item').on('shown.bs.modal', function() {
            $("#input-discount-item").focus();
        });

        $( "#sales_type" ).change(function() {
            var total_sales = total_sales_detail-sales_discount;
            var box = $(".box-sales");
            var dp = $("#box-sales-dp");
            var bayar = $("#box-sales-pay");
            var nama = $("#box-sales-nama");
            var bank = $("#box-sales-nama-bank");
            var nokartu = $("#box-sales-nomor-kartu");
            var rekening = $("#box-sales-nomor-rekening");
            var cashback = $("#box-input-cashback");
            var fee = $("#box-sales-fee");
            $('#input-total').val( Intl.NumberFormat().format(total_sales) );
            box.hide();
            switch ( $(this).val() ){
                case 'cash':
					var total_fee = 0;
                    $.get("<?php echo base_url('get_biayatambahan'); ?>" + "/cash/" + total_sales,function(data, status){
                        sales_fee = data;
                        $("#sales-fee").val("0");
                        if (sales_fee > 0){
                            total_fee = total_sales*sales_fee/100;
                            $('#sales-fee-text').html('Biaya tambahan '+sales_fee+'%');
                            $("#sales-fee").val( Intl.NumberFormat().format(total_fee) );
                            fee.show();
                        }
                        
                        
                        $('#input-total').val( Intl.NumberFormat().format(total_sales+total_fee) );
                        bayar.show();
                        cashback.show();
                    });
                    

                    
                    break;
                case 'kredit':
                    var total_fee = 0;

                    $.get("<?php echo base_url('get_biayatambahan'); ?>" + "/kredit/" + total_sales,function(data, status){
                        sales_fee = data;
                        $("#sales-fee").val("0");
                        if (sales_fee > 0){
                            total_fee = total_sales*sales_fee/100;
                            $('#sales-fee-text').html('Biaya tambahan '+sales_fee+'%');
                            $("#sales-fee").val( Intl.NumberFormat().format(total_fee) );
                            fee.show();
                        }
                        
                        
                        $('#input-total').val( Intl.NumberFormat().format(total_sales+total_fee) );
                        dp.show();
                    });

                    
                    break;
                case 'transfer':
                    var total_fee = 0;

                    $.get("<?php echo base_url('get_biayatambahan'); ?>" + "/transfer/" + total_sales,function(data, status){
                        sales_fee = data;
                        $("#sales-fee").val("0");
                        if (sales_fee > 0){
                            total_fee = total_sales*sales_fee/100;
                            $('#sales-fee-text').html('Biaya tambahan '+sales_fee+'%');
                            $("#sales-fee").val( Intl.NumberFormat().format(total_fee) );
                            fee.show();
                        }
                        
                        
                        $('#input-total').val( Intl.NumberFormat().format(total_sales+total_fee) );
                        nama.show();
                        bank.show();
                        rekening.show();
                    });

                    
                    break;
                case 'kartu_kredit':
                    var total_fee = 0;

                    $.get("<?php echo base_url('get_biayatambahan'); ?>" + "/kartu_kredit/" + total_sales,function(data, status){
                        sales_fee = data;
                        $("#sales-fee").val("0");
                        if (sales_fee > 0){
                            total_fee = total_sales*sales_fee/100;
                            $('#sales-fee-text').html('Biaya tambahan '+sales_fee+'%');
                            $("#sales-fee").val( Intl.NumberFormat().format(total_fee) );
                            fee.show();
                        }
                        
                        
                        $('#input-total').val( Intl.NumberFormat().format(total_sales+total_fee) );
                        nama.show();
                        nokartu.show();
                        bank.show();
                    });

                    
                    break;
            }
        });

        

        /*TRIGGER EVENT BY KEYBOARD*/
        $(document).on('keydown', function ( e ) {
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '1') ) {
                $("#btn-sales-bayar").trigger('click');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '2') ) {
                $("#btn-sales-diskon").trigger('click');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '3') ) {
                $("#btn-sales-opsi").trigger('click');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '4') ) {
                $('.nav-tabs a[href="#tab-B"]').trigger('click');
                $("#search").trigger('focus');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '5') ) {
                $('.nav-tabs a[href="#tab-C"]').trigger('click');
                $("#search2").trigger('focus');
            }
        });

        $.fn.getCustomers();
        $.fn.getItems();
        $.fn.getDiskon();
        $.fn.getRecentItems();

    });
</script>
</body>
</html>