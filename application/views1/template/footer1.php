<script type="text/javascript">
    var outlets = [{"id":"1","value":"Surabaya 001"}];
    var customers = [];
    var items = [];
    var recent_items = [];
    var sales_discount_item = 0;
    var sales_discount_item_current_index = 0;
    var sales_total_item = 0;
    var sales_active = 0;
    var sales_pay = 0;
    var sales_cashback = 0;
    var sales_date = "11-04-2017";
    var sales_time = "12:14:41";
    var sales_customer = "umum";
    var sales_customer_id = 1;
    var sales_cabang = "Surabaya 001";
    var sales_cabang_id = 1;
    var base_url = "<?php echo base_url(); ?>";
    var sales_id = 1;
    var discount_percent = 0;
    var stok_gudang_jumlah = 0;
    var stok_display_jumlah = 0;
    var status             = 0;
    var status_booking     = 0;
    var statusgetfromgudang = 0;
    var diskon_item_total = 0;
    var promo = [];
    var promodetail = [];

    var sales_shift = 1;
    if (localStorage.getItem("sales_shift") == null){
        sales_shift = 1;
    }else{
        sales_shift = localStorage.getItem("sales_shift");
    }


    var sales_discount = 0;
    var sales_cash = 0;
    var sales_username = 'ADMIN';
    var sales_fee = 10;
    var sales_fee_batas = 100000;
    var kategori_id;

    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
        window.print();
        document.body.innerHTML = originalContents;
    }
    var intTotal = 0;
    var intSubTotal = 0;

    jQuery(function($) {
        $('.numeric').autoNumeric('init',{aPad: false});
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function () {

        $('#item-name').val();

        $("#search").focus();

        // /*LOCAL STORAGE*/
        var storage_promo = JSON.parse(localStorage.getItem('promo'));
        var storage_promo_detail = JSON.parse(localStorage.getItem('promo_detail'));

        var storage_sales = JSON.parse(localStorage.getItem('sales'));
        var storage_sales_detail = JSON.parse(localStorage.getItem('sales_detail'));
        var storage_booking_detail = JSON.parse(localStorage.getItem('sales_booking_detail'));
        var storage_getGudangDet = JSON.parse(localStorage.getItem('storage_getGudangDet_'));

        if (!storage_sales_detail) {
            storage_sales_detail = [];
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
        }

        if (!storage_booking_detail) {
            storage_booking_detail = [];
            localStorage.setItem('sales_booking_detail', JSON.stringify(storage_booking_detail));
        }

        if (!storage_promo) {
            storage_promo = [];
            localStorage.setItem('promo', JSON.stringify(storage_promo));
        }

        if (!storage_promo_detail) {
            storage_promo_detail = [];
            localStorage.setItem('promo_detail', JSON.stringify(storage_promo_detail));
        }


        $.each(outlets, function (index, value) {
            $('#sales-outlet').append($('<option/>', {
                value: value.id,
                text: value.value
            }));
        });

        $('#my-modal-disc').on('click', '.btn-ok', function () {
            // var datastatusambil = $('#datastatusambil').val();
            var total_sales_detail_ = total_sales_detail_booking+total_sales_detail;
            if( $('#input-discount').val().length == 0 ){
                sales_discount = 0;
            }else{
                sales_discount = parseInt($("#input-discount").autoNumeric('get'));
            }
            if( sales_discount > total_sales_detail_){
                alert('Diskon tidak boleh lebih dari total bayar!');
                sales_discount = 0;
                $("#input-discount").val('0');
                $("#input-discount-percent").val('0');
            }else{
                $.fn.updateSales();
                $('#my-modal-disc').modal('toggle');
            }
        });

        $('#my-modal-disc-item').on('click', '.btn-ok', function () {
            var item_index = sales_discount_item_current_index;
            var this_name = '';
            var this_id = 0;
            var this_price = 0;
            var this_qty = 0;
            var this_disc = 0;
            var this_disc_percent = 0;
            var this_total = 0;
            var item_exist = 0;
            var item_exist_index = -1;
            var stok_gudang_jumlah = 0;
            var stok_display_jumlah = 0;
            var this_has_promo = 0;
            var this_promo_type = 0;
            var this_promo_gratis = 0;
            var this_promo_item_name  = 0;
            var this_promo_qty  = 0;
            var current_discount_item = 0;
            var data_status_ambil=0;
            // storage_booking_detail
            if( $('#input-discount-item').val().length == 0 ){
                discount_percent = 0;
                current_discount_item = 0;
            } else {
                discount_percent = $('#input-discount-item-percent').val();
                current_discount_item = parseInt($("#input-discount-item").autoNumeric('get'));
            }
            var item_booking_param = $('#item_booking').val();
            //  && current_discount_item > storage_booking_detail
            if (item_booking_param==0) {
              if(current_discount_item > sales_total_item){
                  alert('Diskon tidak boleh lebih dari total!');
                  current_discount_item = 0;
                  $("#input-discount-item").val('0');
                  $("#input-discount-item-percent").val('0');
              }else{

                  if (storage_sales_detail) {
                      $.each(storage_sales_detail, function (index, value) {
                          if (item_index == index) {
                              this_name         = value.item_name;
                              this_id           = value.item_id;
                              this_price        = value.item_price;
                              this_qty          = value.item_qty;
                              this_disc         = current_discount_item;
                              this_disc_percent = discount_percent;
                              this_has_promo    = value.item_has_promo;
                              this_promo_type   = value.item_promo_type;
                              this_promo_gratis = value.item_promo_gratis;
                              this_promo_item_name = value.item_promo_item_name;
                              this_promo_qty    = value.item_promo_qty;
                              this_total        = value.item_total * this_qty;
                              item_exist        = 1;
                              item_exist_index  = index;
                              stok_gudang_jumlah = value.stok_gudang_jumlah;
                              stok_display_jumlah = value.stok_display_jumlah;
                              data_status_ambil = value.data_status_ambil;
                          }
                      });
                      var new_data = {
                          'item_name': this_name,
                          'item_id': this_id,
                          'item_price': this_price,
                          'item_qty': this_qty,
                          'item_disc': this_disc,
                          'item_discount_percent': this_disc_percent,
                          'item_total': this_total,
                          'item_has_promo': this_has_promo,
                          'item_promo_type': this_promo_type,
                          'item_promo_gratis': this_promo_gratis,
                          'item_promo_item_name': this_promo_item_name,
                          'item_promo_qty': this_promo_qty,
                          'stok_gudang_jumlah' : stok_gudang_jumlah,
                          'stok_display_jumlah' : stok_display_jumlah,
                          'data_status_ambil' : data_status_ambil
                      };
                      storage_sales_detail[item_exist_index] = new_data;
                      localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
                    }
                  }
                } else {

                    if (storage_booking_detail) {
                      if(current_discount_item > storage_booking_detail){
                          alert('Diskon tidak boleh lebih dari total!');
                          current_discount_item = 0;
                          $("#input-discount-item").val('0');
                          $("#input-discount-item-percent").val('0');
                      }else{
                        $.each(storage_booking_detail, function (index, value) {
                          if (item_index == index) {
                              this_name         = value.item_name;
                              this_id           = value.item_id;
                              this_price        = value.item_price;
                              this_qty          = value.item_qty;
                              this_disc         = current_discount_item;
                              this_disc_percent = discount_percent;
                              this_has_promo    = value.item_has_promo;
                              this_promo_type   = value.item_promo_type;
                              this_promo_gratis = value.item_promo_gratis;
                              this_promo_item_name = value.item_promo_item_name;
                              this_promo_qty    = value.item_promo_qty;
                              this_total        = value.item_total * this_qty;
                              item_exist        = 1;
                              item_exist_index  = index;
                              stok_gudang_jumlah = value.stok_gudang_jumlah;
                              stok_display_jumlah = value.stok_display_jumlah;
                          }
                        });
                        var new_data_booking = {
                            'item_name': this_name,
                            'item_id': this_id,
                            'item_price': this_price,
                            'item_qty': this_qty,
                            'item_disc': this_disc,
                            'item_discount_percent': this_disc_percent,
                            'item_total': this_total,
                            'item_has_promo': this_has_promo,
                            'item_promo_type': this_promo_type,
                            'item_promo_gratis': this_promo_gratis,
                            'item_promo_item_name': this_promo_item_name,
                            'item_promo_qty': this_promo_qty,
                            'stok_gudang_jumlah' : stok_gudang_jumlah,
                            'stok_display_jumlah' : stok_display_jumlah
                        };
                        diskon_item_total += this_disc;
                        // console.log(diskon_item_total);
                        storage_booking_detail[item_exist_index] = new_data_booking;
                        localStorage.setItem('sales_booking_detail', JSON.stringify(storage_booking_detail));
                        // alert();
                      }
                    }
                  }
                  $.fn.refreshChart();
                  $('#my-modal-disc-item').modal('toggle');
                });

        $.fn.getCustomers = function () {
            $.get( base_url+'C_POS/get_customers',function(data){
                customers = data;
                var html = '';
                $.each(JSON.parse(data), function (index, value) {
                    html += '<tr><td id="item-name">'+value.partner_nama+'</td>' +
                        '<td class="text-right">'+value.partner_telepon+'</td>' +
                        '<td class="text-center"><button data-name="'+value.partner_nama+'" data-id="'+value.partner_id+
                        '" class="btn btn-success btn-xs btn-add-customer">' +
                        '<i class="fa fa-check"></i></button></td></tr>';
                });
                $("#data-customers").html(html);
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

            var storage_sales_detail    = JSON.parse(localStorage.getItem('sales_detail'));
            var storage_booking_detail  = JSON.parse(localStorage.getItem('sales_booking_detail'));

            var html               = '';
            var html_struk         = '';
            var input_sales_detail = '';
            intSubTotal            = 0;
            total_sales_detail     = 0;
            var total_disc_prod    = 0;
            var total_item         = 0;
            var total_item_qty     = 0;
            var has_discount       = 0;

            var input_sales_detail_booking = '';
            total_sales_detail_booking  = 0;
            var total_disc_prod_booking = 0;
            var total_item_booking      = 0;
            var totaldiscitem = 0;
            // var total_item_qty_booking  = 0;
            var has_discount_booking    = 0;

            var input_sales = ''
                + '<input type="hidden" name="outlet_id" value="' + sales_cabang_id + '">'
                + '<input type="hidden" name="sales_shift" value="' + sales_shift + '">'
                + '<input type="hidden" name="customer_id" value="' + sales_customer_id + '">'
                + '<input type="hidden" name="sales_discount" value="' + sales_discount + '">';
                + '<input type="hidden" name="item_book[]" value="' + status + '">'
                ;

            $.each(storage_sales_detail, function (index, value) {
                var item_disc = value.item_disc;
                var stok_gudang_jumlah   = value.stok_gudang_jumlah;
                var stok_gudang_display   = value.stok_gudang_display;
                if( item_disc ) has_discount = 1;
                if( stok_gudang_display == 0 ) statusgetfromgudang = 1;
                if( stok_gudang_jumlah == 0 ) status = 1;
            });

              var i = 1;

            $.each(storage_sales_detail, function (index, value) {

                var item_name             = value.item_name;
                var item_id               = value.item_id;
                var item_price            = value.item_price;
                var item_qty              = value.item_qty;
                var item_disc             = value.item_disc;
                var item_discount_percent = value.item_disc;
                var item_has_promo        = value.item_has_promo;
                var item_promo_type       = value.item_promo_type;
                var item_promo_gratis     = value.item_promo_gratis;
                var item_promo_item_name  = value.item_promo_item_name;
                var item_promo_qty        = value.item_promo_qty;
                var stok_gudang_jumlah    = value.stok_gudang_jumlah;
                var stok_gudang_display   = value.stok_gudang_display;
                var data_status_ambil     = value.data_status_ambil;
                var status_booking        = 0;

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

                if (stok_gudang_jumlah == 0 ) status_booking = 1;
                if (data_status_ambil != "gudang") {
                  var input = '<input type="hidden" name="item_id[]" value="' + item_id + '">'
                              + '<input type="hidden" name="item_price[]" value="' + item_price + '">'
                              + '<input type="hidden" name="item_qty[]" value="' + item_qty + '">'
                              + '<input type="hidden" name="item_discount[]" value="' + item_disc_total + '">'
                              + '<input type="hidden" name="item_discount_percent[]" value="' + item_discount_percent + '">'
                              + '<input type="hidden" name="item_book[]" value="' + status_booking + '">'
                              + '<input type="hidden" name="item_getFromGudang[]" value="0">'
                              ;
                } else {
                  var input = '<input type="hidden" name="item_id[]" value="' + item_id + '">'
                              + '<input type="hidden" name="item_price[]" value="' + item_price + '">'
                              + '<input type="hidden" name="item_qty[]" value="0">'
                              + '<input type="hidden" name="item_discount[]" value="' + item_disc_total + '">'
                              + '<input type="hidden" name="item_discount_percent[]" value="' + item_discount_percent + '">'
                              + '<input type="hidden" name="item_book[]" value="' + status_booking + '">'
                              + '<input type="hidden" name="item_getFromGudang[]" value="' + item_qty + '">'
                              ;
                }

                i++;
                input_sales_detail += input;

                intSubTotal += item_total;
                // var itemPrice = Intl.NumberFormat().format(item_price);
                // var itemTotal = Intl.NumberFormat().format(item_total);
                // var itemDiscTotal = Intl.NumberFormat().format(item_disc_total);
                var itemPrice = item_price.toLocaleString();
                var itemTotal = item_total.toLocaleString();
                var itemDiscTotal = item_disc_total.toLocaleString();

                html += '<tr>';
                html += '<td class="text-center">';
                html += '<div class="input-group input-group-sm">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="'+ item_id +'" class="btn btn-danger btn-sm btn-decrease-cart" type="button"><i class="fa fa-minus"></i></button>';
                html += '</span>';
                html += '<input type="text"  style="text-align:center;" class="form-control input-sm qty" value="' + item_qty + '">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="'+ item_id +'" class="btn btn-success btn-sm btn-increase-cart" type="button"><i class="fa fa-plus"></i></button>';
                html += '</span>';
                html += '</div>';
                html += '</td>';
                html += '<td>' + item_name;
                if( item_has_promo ) html += promo_text;
                html += '</td>';
                if (storage_booking_detail) html += '<td>';
                if (storage_booking_detail) html +='';
                html +='</td>';
                html += '<td class="text-right">' + itemPrice + '</td>';
                if( has_discount ) html += '<td class="text-center">' + itemDiscTotal + '</td>';
                html += '<td class="text-right">' + itemTotal + '</td>';
                html += '<td style="text-align: right;">' +
                        '<div class="btn-group">' +
                        '<button type="button" title="diskon item" data-discount-item="'+item_disc_total+'"\
                        data-total="'+item_total_before_discount+'" class="btn btn-primary btn-sm btn-show-discount-item">\
                        <i class="fa fa-usd" aria-hidden="true" data-status-gudang="'+data_status_ambil+'"></i></button>' +
                        '<button type="button" title="hapus item" data-status-book="'+status_booking+'" data-status-gudang="'+data_status_ambil+'" class="btn btn-danger btn-sm btn-remove-cart">\
                        <i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        '</div>' +
                        '</td>';
                html += '</tr>';
                totaldiscitem = totaldiscitem + item_disc_total;
            });

            $.each(storage_booking_detail, function (index, value) {
                var item_disc_booking             = value.item_disc;
                var stok_gudang_jumlah_booking    = value.stok_gudang_jumlah;
                if( item_disc_booking ) has_discount_booking = 1;
                if( stok_gudang_jumlah_booking == 0 ) status_booking_ = 1;
                // console.log(value);
            });

            $.each(storage_booking_detail, function (index, value) {

                var item_name_booking             = value.item_name;
                var item_id_booking               = value.item_id;
                var item_price_booking            = value.item_price;
                var item_qty_booking              = value.item_qty;
                var item_disc_booking             = value.item_disc;
                var item_discount_percent_booking = value.item_disc;
                var item_has_promo_booking        = value.item_has_promo;
                var item_promo_type_booking       = value.item_promo_type;
                var item_promo_gratis_booking     = value.item_promo_gratis;
                var item_promo_item_name_booking  = value.item_promo_item_name;
                var item_promo_qty_booking        = value.item_promo_qty;
                var stok_gudang_jumlah_booking    = value.stok_gudang_jumlah;
                var data_status_ambil             = '';
                var status_booking_        = 1;

                var item_disc_total_booking = 0;
                if( item_disc_booking > 0 ) item_disc_total_booking += item_disc_booking;
                var item_total_booking = (item_qty_booking * item_price_booking) - item_disc_total_booking;
                var item_total_before_discount_booking = item_qty_booking * item_price_booking;
                total_sales_detail_booking += item_total_booking;
                total_disc_prod_booking += item_disc_total_booking;
                total_item_booking+=1;

                total_item_qty+=item_qty_booking;

                var promo_text = '';
                if( item_has_promo_booking && item_qty >= item_promo_qty_booking ){
                    if( item_promo_type_booking == 'item' ){
                        item_promo_gratis_booking = Math.floor(item_qty_booking/item_promo_qty_booking)* item_promo_gratis_booking;
                        total_item_booking+=1;
                        total_item_qty+=item_promo_gratis_booking;
                        promo_text_booking = '<br/><small style="font-size: 9px;color: red;">(GRATIS) ' + item_promo_item_name_booking + ' x ' + item_promo_gratis_booking + '</small>';
                    }else{
                        //item_promo_gratis = Math.floor(item_qty/item_promo_qty)* item_promo_gratis;
                        promo_text_booking = '<br/><small style="font-size: 9px;color: red;">Cashback Rp ' + Intl.NumberFormat().format(item_disc_booking) + '</small>';
                        //item_disc_total+=item_promo_gratis;
                    }
                }

                // if (stok_gudang_jumlah_booking == 0 ) status_booking_booking = 1;

                var input = '<input type="hidden" name="item_id[]" value="' + item_id_booking + '">'
                            + '<input type="hidden" name="item_price[]" value="' + item_price_booking + '">'
                            + '<input type="hidden" name="item_qty[]" value="' + item_qty_booking + '">'
                            + '<input type="hidden" name="item_discount[]" value="' + item_disc_total_booking + '">'
                            + '<input type="hidden" name="item_discount_percent[]" value="' + item_discount_percent_booking + '">'
                            + '<input type="hidden" name="item_book[]" value="' + status_booking_ + '">'
                            + '<input type="hidden" name="item_getFromGudang[]" value="' + data_status_ambil + '">'
                            ;
                i++;
                input_sales += input;

                intSubTotal += item_total_booking;
                // var itemPrice_booking = Intl.NumberFormat().format(item_price_booking);
                // var itemTotal_booking = Intl.NumberFormat().format(item_total_booking);
                // var itemDiscTotal_booking = Intl.NumberFormat().format(item_disc_total_booking);
                var itemPrice_booking = item_price_booking.toLocaleString();
                var itemTotal_booking = item_total_booking.toLocaleString();
                var itemDiscTotal_booking = item_disc_total_booking.toLocaleString();

                html += '<tr>';
                html += '<td class="text-center">';
                html += '<div class="input-group input-group-sm">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="'+item_id_booking+'" data-status-book="'+status_booking_+'" class="btn btn-danger btn-sm btn-decrease-cart" type="button"><i class="fa fa-minus"></i></button>';
                html += '</span>';
                html += '<input type="text"  style="text-align:center;" class="form-control input-sm qty" value="' + item_qty_booking + '">';
                html += '<span class="input-group-btn">';
                html += '<button data-id="'+item_id_booking+'" data-status-book="'+status_booking_+'" class="btn btn-success btn-sm btn-increase-cart" type="button"><i class="fa fa-plus"></i></button>';
                html += '</span>';
                html += '</div>';
                html += '</td>';
                html += '<td>' + item_name_booking;
                if( item_has_promo_booking ) html += promo_text_booking;
                html += '</td>';
                html +='<td><center><span><i class="fa fa-truck" aria-hidden="true"></i></span></center></td>';
                html += '<td class="text-right">' + itemPrice_booking + '</td>';
                if( has_discount_booking ) html += '<td class="text-center">' + itemDiscTotal_booking + '</td>';
                html += '<td class="text-right">' + itemTotal_booking + '</td>';
                html += '<td style="text-align: right;">' +
                        '<div class="btn-group">' +
                        '<button type="button" title="diskon item" data-discount-item="'+item_disc_total_booking+'"\
                        data-total="'+item_total_before_discount_booking+'" data-status-gudang="'+data_status_ambil+'" class="btn btn-primary btn-sm btn-show-discount-item-booking">\
                        <i class="fa fa-usd" aria-hidden="true"></i></button>' +
                        '<button type="button" title="hapus item" data-id="'+item_id_booking+'" data-status-book="'+status_booking_+'" data-status-gudang="'+data_status_ambil+'" class="btn btn-danger btn-sm btn-remove-cart">\
                        <i class="fa fa-trash" aria-hidden="true"></i></button>' +
                        '</div>' +
                        '</td>';
                html += '</tr>';
                totaldiscitem = totaldiscitem + item_disc_total_booking;
            });
            if( has_discount ) {
                $("#sales-column-discount").removeClass('hide');
            }else{
                $("#sales-column-discount").addClass('hide');
            }

            if( storage_booking_detail ) {
                $("#sales-column-booking").removeClass('hide');
            }else{
                $("#sales-column-booking").addClass('hide');
            }

            html += input_sales;

            var total_disc_nota = 0;
            if( sales_discount > 0 ) total_disc_nota += sales_discount;
            intTotal = intSubTotal - (total_disc_nota);
            // intTotal = Math.ceil(intTotal/100)*100;


            // var cartTotal = Intl.NumberFormat().format(intTotal);
            // var cartSubTotal = parseInt(intSubTotal)+parseInt(totaldiscitem);
            // var cartDiscount = Intl.NumberFormat().format(sales_discount+diskon_item_total);
            // var cartDiscountPercent = Intl.NumberFormat().format(total_disc_nota/total_sales_detail*100);
            // var cartItemTotal = Intl.NumberFormat().format(parseInt(total_item)+parseInt(total_item_booking));
            // var cartItemQty = Intl.NumberFormat().format(total_item_qty);
            var cartTotal = intTotal;
            var cartSubTotal = parseInt(intSubTotal)+parseInt(totaldiscitem);
            var cartDiscount = sales_discount+diskon_item_total;
            var cartDiscountPercent = total_disc_nota/total_sales_detail*100;
            var cartItemTotal = parseInt(total_item)+parseInt(total_item_booking);
            var cartItemQty = total_item_qty;

            $("#list-hidden").html(input_sales + input_sales_detail);
            $(".transaksi tbody").html(html);
            $(".struk tbody").html(html_struk);
            $("#cart-discount").html(cartDiscount.toLocaleString());
            $("#cart-discount-percent").html(cartDiscountPercent.toLocaleString());
            $("#cart_discount_percen").val(cartDiscountPercent.toLocaleString());
            $("#input-discount").val(sales_discount.toLocaleString());
            $("#cart-total").html(cartSubTotal.toLocaleString());
            $("#cart-total-after-discount").html(cartTotal.toLocaleString());
            $("#cart-total-item").html(cartItemTotal.toLocaleString());
            $("#cart-total-qty").html(cartItemQty.toLocaleString());
            $("#cart-total-big").html(cartTotal.toLocaleString());
            $(".sales-customer").html(sales_customer.toUpperCase());
            $(".sales-id").html(sales_id);
            $(".sales-cabang").html(sales_cabang);
            $(".sales-shift").html(sales_shift);

            $("#my-modal-pay").find("input:text#input-total-currency").val(cartTotal.toLocaleString());
            $("#my-modal-pay").find("input:text#input-total").val(intTotal);

            if( sales_discount == 0 ){
                $(".diskon_text").addClass('hide');
                $("#cart-discount").html('');
                $("#cart-discount-percent").html('');
            }else{
                $(".diskon_text").removeClass('hide');
            }

            if (total_item == 0 && total_item_booking == 0) {
                $("#btn-sales-bayar").attr('disabled', 'disabled');
                $("#btn-sales-diskon").attr('disabled', 'disabled');
                $.fn.refreshSales();
            } else {
                $("#btn-sales-bayar").removeAttr('disabled');
                $("#btn-sales-diskon").removeAttr('disabled');
                // $.fn.refreshSales();
            }
            $.fn.checkPromo();
        };

        $.fn.checkPromo = function(){
          var promo = JSON.parse(localStorage.getItem('promo'));
          var promo_detail = JSON.parse(localStorage.getItem('promo_detail'));
          var storage_sales_detail = JSON.parse(localStorage.getItem('sales_detail'));
          var promo_id;
          var promo_id;
          var promo_nama;
          var promo_qty;
          var promo_harga;

          var current = null;
          var cnt = 0;
          var jmldapatpromodet = [];
          Array.prototype.clear = function() {
              this.splice(0, this.length);
          };

          jmldapatpromodet.clear();

          // var promo;
          var promo_item_id;
          var promo_item_qty;
          var checkpromo = [];
            $.each(promo_detail, function(index, value){
              var check = {
                  'promo_id' : value.promo_id,
                  'promo_item_id' : value.promo_item_id,
                  'promo_item_qty' : value.promo_item_qty,
                  'jmlpromodetail': value.jmlpromodetail
              }
              checkpromo.push(check);
            });

            var promoidParam = [];
            $.each(storage_sales_detail, function (index, value) {
              for (var i = 0; i < checkpromo.length; i++) {
                if (value.item_id == checkpromo[i].promo_item_id && value.item_qty == checkpromo[i].promo_item_qty) {
                  promoidParam.push(checkpromo[i].promo_id);
                }
              }
            });

            promoidParam.sort();

            var promoid_ = [];
            var promojml_ = [];

            for (var i = 0; i < promoidParam.length; i++) {
                if (promoidParam[i] != current) {
                    if (cnt > 0) {
                    }
                    current = promoidParam[i];
                    cnt = 1;
                } else {
                    cnt++;
                }

                var newget = {
                  'promoid_' : parseInt(promoidParam[i]),
                  'promojml_' : cnt
                };

                jmldapatpromodet.push(newget);
            }

            $('#promo-notification').empty();
            var html = [];
            var html_ =[];
            var potongan = 0;
            $.each(jmldapatpromodet, function(index, value){
              $.each(promo, function(indexpromo, valuepromo){
                if (valuepromo.promo_id == value.promoid_ && valuepromo.jmlpromodetail == value.promojml_) {
                  html += "<div class='alert alert-info alert-dismissible' style='text-align: left;' role='alert'><strong>"
                          +valuepromo.promo_nama+"</strong>Potongan '"+Intl.NumberFormat().format(valuepromo.promo_harga)+"'";
                  html += "</div>";
                  html_ += "<input type='hidden' id='' name='promo_id[]' value='"+valuepromo.promo_id+"'/>";
                  potongan = potongan + valuepromo.promo_harga;
                }
              });
            });

            $('.divPotongan').append(html_);


            $('#promo-notification').html(html);

              $('.divPotongan').css('display', 'block');
              $('#input-totalpembayaran-currency').val();
              var Total_All = $('#input-total').val();
              var GrandTotal = Total_All-potongan;

              $('#input-totalpembayaran-currency').val(Intl.NumberFormat().format(GrandTotal));
              $('#input-totalpembayaran').val(GrandTotal);

              $('#input-potongan-currency').val(Intl.NumberFormat().format(potongan));
              $('#input-potongan').val(potongan);
        }


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
            var stok_gudang_jumlah = parseInt(btn.attr('data-stok-gudang'));
            var stok_display_jumlah = parseInt(btn.attr('data-stok-display'));
            var data_status_ambil = btn.attr('data-status-ambil');

            if (storage_sales_detail) {
                $.each(storage_sales_detail, function (index, value) {
                    if (value.item_id == this_id) {
                        item_exist = 1;
                        item_exist_index = index;
                        this_qty = this_qty + value.item_qty;
                    }
                });
            }

            if (stok_display_jumlah < this_qty) {
              if (this_qty > stok_gudang_jumlah)
              {
                $.fn.CheckBook(btn);
                return false;
              }
            }

            if (item_exist) storage_sales_detail.splice(item_exist_index, 1);

            var discount = this_disc;
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
                'item_promo_qty': this_promo_qty,
                'stok_gudang_jumlah'   : stok_gudang_jumlah,
                'stok_display_jumlah'   : stok_display_jumlah,
                'data_status_ambil'   : data_status_ambil
            };
            storage_sales_detail.push(new_sales_detail);
            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            $.fn.refreshChart();
        };

        $.fn.addBooking = function (btn) {
            var this_name_book              = btn.attr('data-name');
            var this_id_book                = parseInt(btn.attr('data-id'));
            var this_price_book             = parseInt(btn.attr('data-price'));
            var this_qty_book               = parseInt(btn.attr('data-qty'));
            var this_disc_book              = parseInt(btn.attr('data-disc'));
            var this_has_promo_book         = parseInt(btn.attr('data-has-promo'));
            var this_promo_type_book        = btn.attr('data-promo-type');
            var this_promo_gratis_book      = parseInt(btn.attr('data-promo-gratis'));
            var this_promo_item_name_book   = btn.attr('data-promo-item-name');
            var this_promo_qty_book         = parseInt(btn.attr('data-promo-qty'));
            var this_total_book             = this_qty_book * this_price_book;
            var item_exist_book             = 0;
            var item_exist_index_book       = -1;
            var stok_gudang_jumlah_book     = btn.attr('data-stok-gudang');
            var stok_display_jumlah         = btn.attr('data-stok-display');

            if (storage_booking_detail) {
                $.each(storage_booking_detail, function (index, value) {
                    if (value.item_id == this_id_book) {
                        item_exist_book = 1;
                        item_exist_index_book = index;
                        this_qty_book = this_qty_book + value.item_qty;
                    }
                });
            }

            if (item_exist_book) storage_booking_detail.splice(item_exist_index_book, 1);

            var discount_book = this_disc_book;
            var new_sales_booking_detail = {
                'item_name': this_name_book,
                'item_id': this_id_book,
                'item_price': this_price_book,
                'item_qty': this_qty_book,
                'item_disc': discount_book,
                'item_total': this_total_book,
                'item_has_promo': this_has_promo_book,
                'item_promo_type': this_promo_type_book,
                'item_promo_gratis': this_promo_gratis_book,
                'item_promo_item_name': this_promo_item_name_book,
                'item_promo_qty': this_promo_qty_book,
                'stok_gudang_jumlah'   : stok_gudang_jumlah_book,
                'stok_display_jumlah'   : stok_display_jumlah
            };
            storage_booking_detail.push(new_sales_booking_detail);
            localStorage.setItem('sales_booking_detail', JSON.stringify(storage_booking_detail));
            $.fn.refreshChart();
        };

        $("body").on("click", ".btn-remove-cart", function (e) {
            var item_id = $(this).attr('data-id');
            var status_booking = $(this).attr('data-status-book');
            var item_row = $(this).parent().parent().parent();
            var item_index = item_row.index();

            if (status_booking == 1) {
              $.each(storage_booking_detail, function (index, value) {

                  if (value.item_id == item_id) {
                      storage_booking_detail.splice(index, 1);

                      return false;
                  }

              });

              item_row.remove();
              storage_booking_detail.splice(item_index, 1);
              localStorage.setItem('sales_booking_detail', JSON.stringify(storage_booking_detail));
            } else {
              $.each(storage_sales_detail, function (index, value) {

                  if (value.item_id == item_id) {
                      storage_booking_detail.splice(index, 1);

                      return false;
                  }

              });

              item_row.remove();
              storage_sales_detail.splice(item_index, 1);
              localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));

            }

            $.fn.refreshChart();
        });

        $("body").on("click", ".btn-show-discount-item", function (e) {
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
            e.preventDefault();
        });

        $("body").on("click", ".btn-show-discount-item-booking", function (e) {
            $('#item_booking').val(1);
            var item_row = $(this).parent().parent().parent();
            sales_discount_item_current_index_booking = item_row.index();
            sales_total_item = parseInt($(this).attr('data-total'));
            sales_discount_item = parseInt($(this).attr('data-discount-item'));
            var datastatusgudang = $(this).attr('data_status_ambil');
            if (datastatusgudang) { $('#datastatusambil').val(1); }

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
            var type_karyawan = $('#type_karyawan').val();
            total_sales_detail_ = total_sales_detail_booking+total_sales_detail;

            if (persen>=5) {
              if (type_karyawan!=1) {
                $("#input-discount").val(0);
                persen = '';
              }
            } else {
              var persen = this_value/total_sales_detail_*100;
            }

            $("#input-discount-percent").autoNumeric('set', persen);

        });

        $("#input-discount-percent").keyup(function () {
            var this_value = $(this).autoNumeric('get');
            var type_karyawan = $('#type_karyawan').val();
            var nominal = this_value/100*total_sales_detail;

            if (this_value>=5) {
              if (type_karyawan!=1) {
                $("#input-discount-percent").val(0);
                var nominal = 0;
              } else {
                $("#input-discount-percent").val(this_value);
                var nominal = this_value/100*total_sales_detail;
              }
            }

            $("#input-discount").autoNumeric('set', nominal);

        });

        $("#input-pay-currency").keyup(function () {

            sales_pay = $(this).autoNumeric('get');
            intTotalall = $('#input-total').val();
            intGrandTotalall = $('#input-totalpembayaran').val();

            if (intGrandTotalall) {
              sales_cashback = sales_pay - intGrandTotalall;
            } else {
              sales_cashback = sales_pay - intTotalall;
            }

            var cashback2 = sales_cashback.toLocaleString();

            $("#input-pay").val(sales_pay);
            $("#my-modal-pay").find("input:text#input-cashback-currency").val(cashback2);
            $("#input-cashback").val(sales_cashback);

        });

        $("#input-biaya-currency").keyup(function () {
          var total = $('#input-total').val();
          var biaya_pengiriman = $(this).autoNumeric('get')||0;
          var total_all = parseInt(intTotal) + parseInt(biaya_pengiriman);
          var potongan =  $('#input-potongan').val();
          var GrandTotal = parseInt(total_all)-parseInt(potongan);

          $('#input-totalpembayaran-currency').val(GrandTotal.toLocaleString());
          $('#input-totalpembayaran').val(GrandTotal);

          $('#input-total-currency').val(total_all.toLocaleString());
          $('#input-total').val(total_all);

        });

        // select_category

        $("#select_category").on("change", function(){
          kategori_id = $("#select_category").val();
          if (kategori_id == "allkategori") {
              $.fn.getItems();
          } else {
              $.fn.getItems(kategori_id);
          }
        });

        $.fn.getItems = function (kategori_id = null) {
          items = [];
          var html = '';
          $.ajax({
            type      : "POST",
            data      : {kategori_id:kategori_id},
            url       : base_url+"Penjualan/Point-of-Sale/get_items",
            dataType  : "JSON",
            cache     : false,
            success   : function(data){
              var html = '';
              for (var i = 0; i < data.itemsall.length; i++) {
                var stok_gudang_jumlah = data.itemsall[i].stok_gudang_jumlah;
                if (stok_gudang_jumlah>0) {
                    var icon = '<i class="glyphicon glyphicon-ok-circle" style="font-size: 20px;"></i>';
                  } else {
                    var icon = '<i class="glyphicon glyphicon-remove-circle" style="font-size: 20px;"></i>';
                  }
                html += '<tr>\
                            <td class="text-center">'+icon+'</td>\
                            <td id="item-name">'+data.itemsall[i].barang_nama+'</td>\
                            <td id="item-name" class="text-right">'+stok_display_jumlah+'</td>\
                            <td class="text-right">'+data.itemsall[i].harga_jual_pajak.toLocaleString()+'</td>\
                            <td class="text-center">\
                              <button data-disc="" data-price="'+data.itemsall[i].harga_jual_pajak+'" \
                              data-qty="1" data-name="'+data.itemsall[i].barang_nama+'" \
                              data-id="'+data.itemsall[i].barang_id+'" data-has-promo="'+data.itemsall[i].aktif+'" data-promo-harga="" data-promo-type=""\
                              data-status-aktif="" data-stok-display="'+data.itemsall[i].stok_display_jumlah+'" data-stok-gudang="'+data.itemsall[i].stok_gudang_jumlah+'"\
                              data-promo-item-name="'+data.itemsall[i].promo_nama+'" data-promo-gratis="" data-promo-qty="'+data.itemsall[i].promo_qty+'" \
                              class="btn btn-success btn-xs btn-add-cart">\
                                <i class="fa fa-plus"></i>\
                              </button>\
                            </td>\
                          </tr>\
                          ';
              }
              document.getElementById('data-items').innerHTML = html;
            },error : function(data) {
              alert("Error !!");
            }
          });
        };

        $.fn.getPromo = function(){
          // var storage_promo = JSON.parse(localStorage.getItem('promo'));
          // var storage_promo_detail = JSON.parse(localStorage.getItem('promo_detail'));
          var promo_id;
          var promo_id;
          var promo_nama;
          var promo_qty;
          var promo_harga;
          var jumlahDetailPromo;

          // var promo;
          var promo_item_id;
          var promo_item_qty;

          $.get( base_url+'Penjualan/Point-of-Sale/getPromo',function(data){
            customers = data;
            var html = '';
            var data = jQuery.parseJSON(data);
            $.each(data.promo, function (index, value) {
              var datapromo = {
                'promo_id':value.promo_id,
                'promo_nama':value.promo_nama,
                'promo_qty':value.promo_qty,
                'promo_harga':value.promo_harga,
                'jmlpromodetail':value.jmlpromodetail
              };
              promo.push(datapromo);
              console.log(promo);
              localStorage.setItem('promo', JSON.stringify(promo));

              html += '<tr>\
                        <td id="">'+value.promo_nama+'</td>\
                        <td class="text-right"></td>\
                      </tr>';
            });

            $.each(data.promo_detail, function (index, value) {

              var datapromodetail = {
                'promo_id':value.promo_id,
                'promo_item_id':value.promo_item_id,
                'promo_item_qty':value.promo_item_qty,
              };

              // promodetail
              promodetail.push(datapromodetail);
              localStorage.setItem('promo_detail', JSON.stringify(promodetail));

            });

            $("#data-promo").html(html);
          });
        };

        $("#search").keyup(function (e) {
          // if(e.which == 13) {

            var this_data = null;
            var new_data = [];
            var word = $(this).val();
            // word = word.toLowerCase();
            // word = word.charCodeAt(0).toString();
            var i = 1;
            $.each(items, function (index, value) {
                var name = value.barang_nama;
                barang_kode = value.barang_kode;
                var search = name +" "+barang_kode;
                // console.log(search);

                if(search.search(word) > -1)
                {
                    this_data = {
                        'barang_id' : value.barang_id,
                        'm_jenis_barang_id' : value.m_jenis_barang_id,
                        'category_2_id' : value.category_2_id,
                        'barang_kode' : value.barang_kode,
                        'barang_nomor' : value.barang_nomor,
                        'barang_nama' : value.barang_nama,
                        'm_satuan_id' : value.m_satuan_id,
                        'brand_id' : value.brand_id,
                        'harga_beli' : value.harga_beli,
                        'harga_jual' : value.harga_jual,
                        'harga_jual_pajak' : value.harga_jual_pajak,
                        'stok' : value.stok,
                        'barang_minimum_stok' : value.barang_minimum_stok,
                        'stok_maks' : value.stok_maks,
                        'barang_status_aktif' : value.barang_status_aktif,
                        'barang_create_date' : value.barang_create_date,
                        'barang_create_by' : value.barang_create_by,
                        'barang_update_date' : value.barang_update_date,
                        'barang_update_by' : value.barang_update_by,
                        'barang_revised': value.barang_revised,
                        'stok_gudang_jumlah': value.stok_gudang_jumlah
                    };
                    // console.log(name);
                    // setTimeout(function(){
                    new_data.push(this_data);
                    // console.log(this_data);
                    // }, 100);
                }

            });

            var html = '';
            $.each(new_data, function (index, value) {
              stok_gudang_jumlah = value.stok_gudang_jumlah;
              if (stok_gudang_jumlah>0) {
                var icon = '<i class="glyphicon glyphicon-ok-circle" style="font-size: 20px;"></i>';
              } else {
                var icon = '<i class="glyphicon glyphicon-remove-circle" style="font-size: 20px;"></i>';
              }
              html += '<tr>\
                        <td class="text-center">'+icon+'</td>\
                        <td id="item-name">'+value.barang_nama+'</td>\
                        <td id="item-name" class="text-right">'+stok_display_jumlah+'</td>\
                        <td class="text-right">'+value.harga_jual_pajak.toLocaleString()+'</td><td class="text-center">\
                          <button data-disc="" data-price="'+value.harga_jual_pajak+'" \
                          data-qty="1" data-name="'+value.barang_nama+'"\
                          data-id="'+value.barang_id+'" data-has-promo="'+value.aktif+'" data-promo-harga="'+value.promo_harga+'" data-promo-type=""\
                          data-status-aktif="" data-stok-display="'+value.stok_display_jumlah+'" data-stok-gudang="'+value.stok_gudang_jumlah+'"\
                          data-promo-item-name="'+value.promo_nama+'" data-promo-gratis="" data-promo-qty="'+value.promo_qty+'" \
                          class="btn btn-success btn-xs btn-add-cart">\
                            <i class="fa fa-plus"></i>\
                          </button>\
                        </td>\
                      </tr>\
                      ';
            });
              // console.log(html);
            $("#data-items").html(html);
          // }

        });


        $('body').on('click', '.btn-add-cart', function (e) {
              var stok_gudang   = $(this).attr('data-stok-gudang');
              var stok_display  = $(this).attr('data-stok-display');
              var item_id       = $(this).attr('data-id');

              if (stok_display > 0) {
                $.fn.addCart($(this));
              } else {
                if (stok_gudang == 0) {
                  $.fn.CheckBook($(this));
                } else {
                  getfromGudang($(this));
                }
              }

            e.preventDefault();
        });

        function getfromGudang(elem){
          var data_disc         = elem.attr('data-disc');
          var data_price        = elem.attr('data-price');
          var data_qty          = elem.attr('data-qty');
          var data_name         = elem.attr('data-name');
          var data_id           = elem.attr('data-id');
          var data_has_promo    = elem.attr('data-has-promo');
          var data_promo_harga  = elem.attr('data-promo-harga');
          var data_promo_type   = elem.attr('data-promo-type');
          var data_status_aktif = elem.attr('data-status-aktif');
          var data_stok_display = elem.attr('data-stok-display');
          var data_stok_gudang  = elem.attr('data-stok-gudang');
          var data_promo_item   = elem.attr('data-promo-item-name');
          var data_promo_gratis = elem.attr('data-promo-gratis');
          var data_promo_qty    = elem.attr('data-promo-qty');
          var storage_getfromGudang = [];

          var newData = {
                    'data_disc' : data_disc,
                    'data_price' : data_price,
                    'data_qty' : data_qty,
                    'data_name' : data_name,
                    'data_id' : data_id,
                    'data_has_promo' : data_has_promo,
                    'data_promo_harga' : data_promo_harga,
                    'data_promo_type' : data_promo_type,
                    'data_status_aktif' : data_status_aktif,
                    'data_stok_display' : data_stok_display,
                    'data_stok_gudang' : data_stok_gudang,
                    'data_promo_item' : data_promo_item,
                    'data_promo_gratis' : data_promo_gratis,
                    'data_promo_qty' : data_promo_qty
                  };

                  storage_getfromGudang.push(newData);
                  // var storage_getGudangDet = JSON.parse(localStorage.getItem('storage_getGudangDet_'));
                  localStorage.setItem('storage_getGudangDet_', JSON.stringify(storage_getfromGudang));

          var url = "<?php echo base_url()?>C_POS/getfromGudang";
          $('#getfromGudang_popmodal').modal('show').find('.modal-content').load(url);
              //  $('#getfromGudang_popmodal .modal-content').html();
              //  $('#getfromGudang_popmodal .modal-content').html();
              //  $('#getfromGudang_popmodal').modal('show');
        }

        $.fn.CheckBook = function(elem){
          var CheckBook = 0;
          var stok_gudang = elem.attr('data-stok-gudang');
          var stok_display = elem.attr('data-stok-display');
          var item_id     = elem.attr('data-id');
          var url = "<?php echo base_url()?>C_POS/booking_popmodal/"+stok_display+"/"+stok_gudang+"/"+item_id+"/1";
          if (storage_booking_detail) {

            $.each(storage_booking_detail, function (index, value) {
                if (value.item_id == item_id) CheckBook = 1;
            });

            if (CheckBook != 0) {
              // $.fn.refreshChart();
              $.fn.addBooking(elem);
            } else {
              $('#booking_modal').modal('show').find('.modal-content').load(url);
            }

          } else {

            $('#booking_modal').modal('show').find('.modal-content').load(url);

          }
        }

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
            var this_has_promo = 0;
            var this_promo_type = 0;
            var this_promo_gratis  = 0;
            var this_promo_item_name = '';
            var this_promo_qty = 0;
            var itemid = $(this).attr('data-id');
            var datastatusbook = $(this).attr('data-status-book');
            var data_status_ambil;

            var status_book = $(this).attr('data-status-book');

            if (status_book==1) {
            if (storage_booking_detail) {
                $.each(storage_booking_detail, function (index, value) {
                    if (itemid == value.item_id) {

                        var qty = value.item_qty + 1;
                        var discount = 0;
                        if( value.item_has_promo && qty >= value.item_promo_qty ){
                            if( value.item_promo_type == 'uang' ){
                                discount = Math.floor(qty/value.item_promo_qty)*value.item_promo_gratis;
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
                        data_status_ambil = value.data_status_ambil;
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
                'item_promo_qty': this_promo_qty,
                'data_status_ambil' : data_status_ambil
            };
              storage_booking_detail[item_exist_index] = new_data;
              localStorage.setItem('sales_booking_detail', JSON.stringify(storage_booking_detail));
            } else {
              if (storage_sales_detail) {
                $.each(storage_sales_detail, function (index, value) {
                    if (itemid == value.item_id) {

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
                        data_status_ambil = value.data_status_ambil;
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
                'item_promo_qty': this_promo_qty,
                'data_status_ambil' : data_status_ambil
            };
              storage_sales_detail[item_exist_index] = new_data;
              localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            }
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
                var itemid = $(this).attr('data-id');
                var status_book = $(this).attr('data-status-book');
            // console.log(status_book);

            if (status_book==1) {

              if (storage_booking_detail) {
                    $.each(storage_booking_detail, function (index, value) {
                        if (itemid == value.item_id) {

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
                storage_booking_detail[item_exist_index] = new_data;
                localStorage.setItem('sales_booking_detail', JSON.stringify(storage_booking_detail));
            } else {
              if (storage_sales_detail) {
                    $.each(storage_sales_detail, function (index, value) {
                        if (itemid == value.item_id) {

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
            }




                // console.log(storage_sales_detail);
                $.fn.refreshChart();
                event.preventDefault();
            }
        });

        $.fn.resetSales = function (e) {
            $("#input-pay").val('0');
            storage_sales_detail    = [];
            storage_booking_detail  = [];
            localStorage.setItem('sales_booking_detail', JSON.stringify(storage_booking_detail));
            localStorage.removeItem('sales_booking');

            localStorage.setItem('sales_detail', JSON.stringify(storage_sales_detail));
            localStorage.removeItem('sales');

            sales_discount = 0;
            $.fn.refreshChart();
        };

        $("#form-submit-sales").submit(function (e) {
          var tgl_penjualan = $('#tgl_penjualan').val();
            var status_cashback = false;
            if( $("#sales_type").find('option:selected').val() == 'kredit' )
            {
                status_cashback = true;
            }

            if( $("#sales_type").find('option:selected').val() == 'kartu_kredit' ){
                if ($("#sales-nama").val() == "" || $("#sales-nomor-kartu").val() == "" || $("#sales-nama-bank").val() == "")
                {
                    alert("Silakan Lengkapi Nama, Nomor Kartu, dan Nama Bank");
                    return false;
                }
            } else {
              if ($('#input-pay').val() < $('#input-total').val()) {
                return false;
                alert("Tidak bisa melakukan proses pembayaran, Nominal pembayaran yang anda masukan kurang dari total pembayaran");
              }
            }

            if (sales_cashback >= 0 || sales_cashback ) {

                var option = "Penjualan/Point-of-Sale/simpan_transaksi/";
                var url = base_url + option;
                var paramArr = [];
                var tgl_penjualan = $('#tgl_penjualan').val();

                var paramArr = $('#form-submit-sales').serializeArray();
                paramArr.push({name:'tgl_penjualan', value:tgl_penjualan});

                $.ajax({
                    type: 'post',
                    data: paramArr,
                    url: url,
                    dataType: 'json',
                    cache : false,
                    success: function (result) {
                        // var obj = JSON.parse(result);
                        window.open(base_url+'Penjualan/print/'+result);
                        $('#my-modal-pay').find('input').val(0);
                        $('#my-modal-pay').modal('hide');

                        items = [];

                        $.fn.resetSales();
                        $.fn.getItems();
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

        $("#sales_type").change(function() {
            var total_sales = total_sales_detail+total_sales_detail_booking-sales_discount;
            var box         = $(".box-sales");
            var dp          = $("#box-sales-dp");
            var bayar       = $("#box-sales-pay");
            var nama        = $("#box-sales-nama");
            var bank        = $("#box-sales-nama-bank");
            var nokartu     = $("#box-sales-nomor-kartu");
            var rekening    = $("#box-sales-nomor-rekening");
            var mesin_edc   = $("#box-edc");
            var cashback    = $("#box-input-cashback");
            var fee         = $("#box-sales-fee");

            $('#input-total-currency').val( Intl.NumberFormat().format(total_sales) );
            $('#input-total').val(total_sales);
            box.hide();
            switch ( $(this).val() ){
                case '1':
					           var total_fee = 0;
                     $('#input-total-currency').val( Intl.NumberFormat().format(total_sales) );
                     $('#input-total').val(total_sales);
                        bayar.show();
                        cashback.show();
                    break;

                case '2':
                    $('#input-total-currency').val( Intl.NumberFormat().format(total_sales) );
                    $('#input-total').val(total_sales);
                        nama.show();
                        bank.show();
                        rekening.show();
                        mesin_edc.show();
                    break;

                case '3':
                    $('#input-total-currency').val( Intl.NumberFormat().format(total_sales) );
                    $('#input-total').val(total_sales);
                    dp.show();
                    break;
                case '4':
                    $('#input-total-currency').val( Intl.NumberFormat().format(total_sales) );
                    $('#input-total').val(total_sales);
                        nama.show();
                        nokartu.show();
                        bank.show();
                    break;
                case '5':
                        nama.show();
                        mesin_edc.show();
                    break;
            }
        });

        /*TRIGGER EVENT BY KEYBOARD*/
        $(document).on('keydown', function ( e ) {
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '1') ) {
                $("#btn-sales-bayar").trigger('click');
                console.log(e.metaKey);
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
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '6') ) {
                $('.nav-tabs a[href="#tab-D"]').trigger('click');
                $("#search").trigger('focus');
            }
            if ((e.metaKey || e.altKey) && ( String.fromCharCode(e.which).toLowerCase() === '7') ) {
                $("#btn-sales-batal").trigger('click');
                console.log(e.metaKey);
            }

        });

        $('#btn-sales-batal').click(function(){
          // a = confirm('Apakah anda yakin keluar dari halaman ini ??');
          // if (a == true) {
            window.location.href='../Penjualan/Point-of-Sale';
          // }
        });
        $.fn.getPromo();
        $.fn.getItems();
        $.fn.resetSales();
        $.fn.getCustomers();
    });


</script>

</body></html>
