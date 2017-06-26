            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1><?php if(isset($title_page)) echo $title_page;?>
                                <small><?php if(isset($title_page2)) echo $title_page2;?></small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>"> Dashboard </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#"> <?php if(isset($title_page)) echo $title_page;?> </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php if(isset($title_page2)) echo $title_page2;?></span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-doc font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase">Form  <?php if(isset($title_page2)) echo $title_page2;?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <form action="#" id="formAdd" class="form-horizontal" method="post">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                        <input type="hidden" id="url" value="Persetujuan/Purchase-Order/postData/">
                                        <input type="hidden" id="url_data" value="Persetujuan/Purchase-Order">
                                        <input type="hidden" name="order_status" value="0">
                                        <input type="hidden" name="order_type" value="0">
                                        <div class="form-group" hidden="true" id="kode">
                                            <label class="control-label col-md-4">ID Order (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="order_nomor">
                                            <label class="control-label col-md-4">Kode Order (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="order_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Order
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="order_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Kirim
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="order_nama_dikirim" /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Alamat Kirim
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="order_alamat_dikirim"></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Telp/Fax Kirim
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="order_hp_fax"></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Supplier
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="m_supplier_id" name="m_supplier_id" aria-required="true" aria-describedby="select-error" onchange="checkPenawaran()" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Penawaran
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="order_referensi_id" name="order_referensi_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddPenawaran" class="btn sbold dark" onclick="addPenawaran()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Artikel </th>
                                                            <th> Uraian dan Spesifikasi Barang/Jasa </th>
                                                            <th> Qty </th>
                                                            <th> Satuan </th>
                                                            <th> Harga Satuan </th>
                                                            <th> Disc. </th>
                                                            <th> Total1 </th>
                                                            <th> Total2 </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="8" class="text-right"> Sub Total </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="order_subtotal" name="order_subtotal" value="0" required readonly />
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="8" class="text-right"> PPN % </th>
                                                            <th>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control decimal" id="order_ppn" name="order_ppn" value="0" onchange="sumTotal()" required />
                                                                    <span class="input-group-addon" style="">
                                                                        %
                                                                    </span>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="8" class="text-right"> Total </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="order_total" name="order_total" value="0" required readonly />
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Tanggal Kirim
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <div class="input-group date datepicker" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                                    <input type="text" class="form-control" name="order_tanggal_kirim" readonly>
                                                    <span class="input-group-addon" style="">
                                                        <span class="icon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Pembayaran
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <select class="form-control select2" id="order_pembayaran" name="order_pembayaran" aria-required="true" aria-describedby="select-error" onchange="checkPembayaran()" required>
                                                    <option id="tunai" value="0"> Tunai </option>
                                                    <option id="kredit" value="1"> Kredit </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group hidden" id="order_hari">
                                        <label class="control-label col-md-4">Term Of Payment
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <div class="input-group">
                                                    <input type="text" class="form-control num" name="order_top" value="0">
                                                    <span class="input-group-addon" style="">
                                                        Hari
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-4">DP
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="">
                                                        RP
                                                    </span>
                                                    <input type="text" class="form-control money" name="order_dp" value="0" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Persetujuan
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <label class="mt-checkbox"> Setujui PO
                                                    <input type="checkbox" value="1" id="persetujuan" onclick="checkPersetujuan();" />
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Persetujuan/Purchase-Order">
                                                <button type="button" class="btn default">Kembali</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM -->
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->

        <?php $this->load->view('layout/V_footer');?>

        <script type="text/javascript">
            $(document).ready(function(){
                rules();
                itemBarang = 0;
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#m_supplier_id').css('width', '100%');
                $('#order_referensi_id').css('width', '100%');
                selectList_supplier("#m_supplier_id");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function checkPembayaran() {
                if (document.getElementsByName('order_pembayaran')[0].value == 1) {
                    $("#order_hari").removeClass("hidden");
                } else {
                    $("#order_hari").addClass("hidden");
                }
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Pembelian/Purchase-Order/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("order_nomor")[0].value = data.val[i].order_nomor;
                      document.getElementsByName("order_tanggal")[0].value = data.val[i].order_tanggal;
                      document.getElementsByName("order_tanggal_kirim")[0].value = data.val[i].order_tanggal_kirim;
                      document.getElementsByName("order_status")[0].value = data.val[i].order_status;
                      document.getElementsByName("order_type")[0].value = data.val[i].order_type;
                      document.getElementsByName("order_nama_dikirim")[0].value = data.val[i].order_nama_dikirim;
                      document.getElementsByName("order_alamat_dikirim")[0].value = data.val[i].order_alamat_dikirim;
                      document.getElementsByName("order_hp_fax")[0].value = data.val[i].order_hp_fax;
                      document.getElementsByName("order_subtotal")[0].value = data.val[i].order_subtotal;
                      document.getElementsByName("order_ppn")[0].value = data.val[i].order_ppn;
                      document.getElementsByName("order_top")[0].value = data.val[i].order_top;
                      document.getElementsByName("order_total")[0].value = data.val[i].order_total;
                      $("#order_pembayaran").select2('destroy');
                      if (data.val[i].order_pembayaran == 0) {
                        document.getElementById('tunai').selected = true;
                      } else if (data.val[i].order_pembayaran == 1) {
                        document.getElementById('kredit').selected = true;
                      }
                      $('#order_pembayaran').css('width', '100%');
                      $("#order_pembayaran").select2();
                      checkPembayaran();
                      // document.getElementsByName("order_dp")[0].value = data.val[i].order_dp;

                      if (data.val[i].order_status >= 3) {
                        document.getElementById("persetujuan").checked = true;
                        document.getElementById("persetujuan").disabled = true;
                        document.getElementById('submit'). disabled = true;
                      }

                      $("#m_supplier_id").select2('destroy');
                      for(var j=0; j<data.val[i].m_supplier_id.val2.length; j++){
                        $("#m_supplier_id").append('<option value="'+data.val[i].m_supplier_id.val2[j].id+'" selected>'+data.val[i].m_supplier_id.val2[j].text+'</option>');
                      }
                      $("#m_supplier_id").select2();

                      for(var j=0; j<data.val[i].order_referensi_id.val2.length; j++){
                        $("#order_referensi_id").append('<option value="'+data.val[i].order_referensi_id.val2[j].id+'" selected>'+data.val[i].order_referensi_id.val2[j].text+'</option>');
                      }
                      $("#order_referensi_id").select2();
                      $("#order_nomor").attr("hidden", false);
                      document.getElementsByName('order_nama_dikirim')[0].disabled = true;
                      document.getElementsByName("order_tanggal_kirim")[0].disabled = true;
                      document.getElementsByName('order_alamat_dikirim')[0].disabled = true;
                      document.getElementsByName('order_hp_fax')[0].disabled = true;
                      document.getElementsByName('m_supplier_id')[0].disabled = true;
                      document.getElementsByName('order_referensi_id')[0].disabled = true;
                      document.getElementsByName('order_pembayaran')[0].disabled = true;
                      document.getElementsByName('order_top')[0].disabled = true;
                      document.getElementsByName('order_ppn')[0].disabled = true;
                      document.getElementById('btnAddPenawaran').disabled = true;
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);
                    var order_totdisc = 0;
                    for(var i = 0; i < data.val2.length; i++){
                        order_totdisc = data.val2[i].orderdet_total-(data.val2[i].orderdet_disc/100*data.val2[i].orderdet_harga_satuan*data.val2[i].orderdet_qty);
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    '+data.val2[i].barang_nomor+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num2" id="orderdet_qty'+(i+1)+'" name="orderdet_qty[]" value="'+data.val2[i].orderdet_qty+'" required readonly/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="orderdet_harga_satuan'+(i+1)+'" name="orderdet_harga_satuan[]" value="'+data.val2[i].orderdet_harga_satuan+'" required readonly/>\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="orderdet_disc'+data.val2[i].m_barang_id+'" name="orderdet_disc[]" value="'+data.val2[i].orderdet_disc+'" required readonly/>\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="orderdet_total'+(i+1)+'" name="orderdet_total[]" value="'+data.val2[i].orderdet_total+'" required readonly/>\
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="orderdetgrand_total'+(i+1)+'" name="orderdetgrand_total[]" value="'+order_totdisc+'" required readonly/>\
                                </td>\
                            </tr>\
                        ');
                        $('.money').number( true, 2, '.', ',' );
                        $('.money').css('text-align', 'right');
                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                    }
                  }
                });

            }

            function checkPersetujuan() {
                if (document.getElementById("persetujuan").checked == true) {
                    document.getElementsByName("order_status")[0].value = 3;
                } else {
                    document.getElementsByName("order_status")[0].value = 2;
                }
            }
        </script>

    </body>

</html>
