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
                                        <input type="hidden" id="url" value="Penjualan/Surat-Jalan-Retur/postData/">
                                        <input type="hidden" id="url_data" value="Penjualan/Surat-Jalan-Retur">
                                        <!-- <input type="hidden" name="surat_jalan_status" value="1"> -->
                                        <div class="form-group" id="kode" hidden="true">
                                            <label class="control-label col-md-4">ID Surat Jalan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="sj_nomor" hidden="true">
                                            <label class="control-label col-md-4">Kode Surat Jalan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="sj_retur_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Surat Jalan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="sj_retur_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Surat Jalan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_surat_jalan_id" name="t_surat_jalan_id" aria-required="true" aria-describedby="select-error" onchange="getDetail()" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="partner_nama" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="pilihBarang">
                                            <label class="control-label col-md-4">Nama Barang
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="m_barang_id" aria-required="true" aria-describedby="select-error">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddBarang" class="btn sbold dark" onclick="addBarang()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblDetail">
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Kode Barang </th>
                                                            <th> Nama Barang </th>
                                                            <th> Qty </th>
                                                            <th> Qty Retur </th>
                                                            <th> Satuan </th>
                                                            <th> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyDetail">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Alasan
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="sj_retur_alasan"></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Catatan
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="sj_retur_catatan"></textarea> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Penjualan/Surat-Jalan-Retur">
                                                <button type="button" class="btn default">Kembali</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="stok" hidden="true">

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
                datadetailfaktur = [];
                datadetail = [];
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_faktur_penjualan_id').css('width', '100%');
                selectList_SJ2("#t_surat_jalan_id");
                if (document.getElementsByName("kode")[0].value.length > 0) {
                    document.getElementById('submit').disabled = true;
                    $("#sj_nomor").attr("hidden", false);
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function cekQty(seq)
            {
                var qtyRetur = document.getElementById('sj_returdet_qty_retur'+seq);
                var qty = document.getElementById('sj_returdet_qty'+seq);
                if (parseFloat(qtyRetur.value.replace(/\,/g, "")) > parseFloat(qty.value.replace(/\,/g, ""))) {
                    swal({
                        title: "Alert!",
                        text: "Jumlah retur melebihi jumlah kirim!",
                        type: "error",
                        confirmButtonClass: "btn-raised btn-danger",
                        confirmButtonText: "OK",
                    });
                    qtyRetur.value = 0;
                    $('.num2').number( true, 2, '.', ',' );
                    $('.num2').css('text-align', 'right');
                }
            }

            function getDetail() {
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Penjualan/Surat-Jalan/loadDataWhere/',
                    data : "id="+document.getElementById('t_surat_jalan_id').value,
                    dataType : "json",
                    success:function(data){
                        // for(var i = 0; i < data.val[0].t_order_id.val2.length; i++)
                        // {
                        //     getDetailSOCustomer(data.val[0].t_order_id.val2[i].id);
                        // }
                        for (var i = 0; i < data.val.length; i++) {
                            document.getElementsByName("partner_nama")[0].value = data.val[i].m_partner_id.val2[0].text;
                        }
                        $("#m_barang_id").select2();
                        $("#m_barang_id").select2('destroy');
                        $("#m_barang_id").empty();
                        for(var i = 0; i < data.val2.length; i++){
                            datadetail.push(data.val2[i]);
                            $("#m_barang_id").append('<option value="'+data.val2[i].po_customerdet_id+'">'+data.val2[i].barang_uraian+'</option>');
                        }
                        $("#m_barang_id").select2();
                    }
                });
            }

            function getDetailSOCustomer(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                        $.ajax({
                          type : "GET",
                          url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                          data : "id="+data.val[i].t_po_customer_id.val2[0].id,
                          dataType : "json",
                          success:function(data){
                            if (document.getElementsByName("kode")[0].value.length == 0) {
                                $("#default-table tbody").empty();
                            }
                            for (var i = 0; i < data.val.length; i++) {
                                document.getElementsByName("partner_nama")[0].value = data.val[i].po_customer_nama_pelanggan;
                            }
                            for(var j = 0; j < data.val2.length; j++)
                            {
                                datadetail.push(data.val2[j]);
                            }
                            if (document.getElementsByName("kode")[0].value.length == 0) {
                                $("#m_barang_id").select2();
                                $("#m_barang_id").select2('destroy');
                                for(var i = 0; i < data.val2.length; i++){
                                    $("#m_barang_id").append('<option value="'+data.val2[i].po_customerdet_id+'">'+data.val2[i].barang_uraian+'</option>');
                                }
                                $("#m_barang_id").select2();
                            } else {
                                for(var j = 0; j < datadetail.length; j++){
                                    if (document.getElementById('keterangandet'+datadetail[j].m_barang_id)) {
                                        document.getElementById('keterangandet'+datadetail[j].m_barang_id).value = datadetail[j].po_customerdet_keterangan;
                                    }
                                }
                            }

                          }
                        });
                    }
                  }
                });
            }

            function addBarang() {
                var id2 = document.getElementById('m_barang_id').value;
                if (id2.length > 0) {
                        for(var i = 0; i < datadetail.length; i++){
                            if (datadetail[i].po_customerdet_id == id2) {
                                itemBarang++;
                                $("#default-table tbody").append('\
                                    <tr>\
                                        <td>\
                                            '+itemBarang+'\
                                        </td>\
                                        <td>\
                                            <input type="hidden" name="t_po_customerdet_id[]" value="'+datadetail[i].po_customerdet_id+'"/>\
                                            <input type="hidden" name="m_barang_id[]" value="'+datadetail[i].m_barang_id+'"/>\
                                            '+datadetail[i].barang_kode+'\
                                        </td>\
                                        <td>\
                                            '+datadetail[i].barang_nama+'\
                                        </td>\
                                        <td>\
                                            <input type="text" id="sj_returdet_qty'+itemBarang+'" name="sj_returdet_qty[]" class="form-control num2" value="'+datadetail[i].surat_jalandet_qty_kirim+'" readonly/>\
                                        </td>\
                                        <td>\
                                            <input type="text" id="sj_returdet_qty_retur'+itemBarang+'" name="sj_returdet_qty_retur[]" class="form-control num2" value="'+datadetail[i].surat_jalandet_qty_kirim+'" onchange="cekQty('+itemBarang+')" required/>\
                                        </td>\
                                        <td>\
                                            '+datadetail[i].satuan_nama+'\
                                        </td>\
                                        <td>\
                                            <textarea class="form-control" rows="3" readonly>'+datadetail[i].po_customerdet_keterangan+'</textarea>\
                                        </td>\
                                    </tr>\
                                ');

                                $('.num2').number( true, 2, '.', ',' );
                                $('.num2').css('text-align', 'right');
                                $('.money').number( true, 2, '.', ',' );
                                $('.money').css('text-align', 'right');
                            }
                        }
                }
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Surat-Jalan-Retur/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("sj_retur_nomor")[0].value = data.val[i].sj_retur_nomor;
                      document.getElementsByName("sj_retur_tanggal")[0].value = data.val[i].sj_retur_tanggal;
                      document.getElementsByName("sj_retur_alasan")[0].value = data.val[i].sj_retur_alasan;
                      document.getElementsByName("sj_retur_alasan")[0].readOnly = true;
                      document.getElementsByName("sj_retur_catatan")[0].value = data.val[i].sj_retur_catatan;
                      document.getElementsByName("sj_retur_catatan")[0].readOnly = true;
                      $("#t_surat_jalan_id").select2();
                      $("#t_surat_jalan_id").select2('destroy');
                      document.getElementById("t_surat_jalan_id").disabled = false;
                      for(var j=0; j<data.val[i].t_surat_jalan_id.val2.length; j++){
                        $("#t_surat_jalan_id").append('<option value="'+data.val[i].t_surat_jalan_id.val2[j].id+'" selected>'+data.val[i].t_surat_jalan_id.val2[j].text+'</option>');
                        getDetail();
                      }
                      $("#t_surat_jalan_id").select2();
                      document.getElementById("t_surat_jalan_id").disabled = true;
                      document.getElementById("btnAddBarang").disabled = true;
                    }

                    for(var i = 0; i < data.val2.length; i++){
                        itemBarang++;
                        $("#default-table tbody").append('\
                            <tr>\
                                <td>\
                                    '+itemBarang+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" id="sj_returdet_qty'+itemBarang+'" name="sj_returdet_qty[]" class="form-control num2" value="'+data.val2[i].sj_returdet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" id="sj_returdet_qty_retur'+itemBarang+'" name="sj_returdet_qty_retur[]" class="form-control num2" value="'+data.val2[i].sj_returdet_qty_retur+'" readonly required/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <textarea id="keterangandet'+data.val2[i].m_barang_id+'" class="form-control" rows="3" readonly>'+data.val2[i].po_customerdet_keterangan+'</textarea>\
                                </td>\
                            </tr>\
                        ');

                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                        $('.money').number( true, 2, '.', ',' );
                        $('.money').css('text-align', 'right');
                    }
                  }
                });
            }
        </script>

    </body>

</html>
