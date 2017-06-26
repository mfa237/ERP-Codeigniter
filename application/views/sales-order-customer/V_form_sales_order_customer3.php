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
                                        <input type="hidden" id="url" value="Persetujuan/Sales-Order-Customer/postData/">
                                        <input type="hidden" id="url_data" value="Persetujuan/Sales-Order-Customer">
                                        <input type="hidden" name="so_customer_status" value="0">
                                        <div class="form-group" id="kode" hidden="true">
                                            <label class="control-label col-md-4">ID Sales Order (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="KodeSO" hidden="true">
                                            <label class="control-label col-md-4">Kode Sales Order (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="so_customer_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Sales Order
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="so_customer_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor PO Customer
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_po_customer_id" name="t_po_customer_id" aria-required="true" aria-describedby="select-error" required>
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
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Alamat Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_alamat" readonly></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Alamat Kirim
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_alamat_kirim" readonly></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Telp/Hp Customer
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_telp" readonly></textarea> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Sales
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="karyawan_nama" readonly /> </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Kode Barang </th>
                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                            <th> Qty PO Customer </th>
                                                            <th> Satuan </th>
                                                            <th> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Catatan
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="so_customer_catatan"></textarea> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <!-- <button type="submit" id="submit" class="btn green-jungle" disabled>Simpan</button> -->
                                                <a href="<?php echo base_url();?>Persetujuan/Sales-Order-Customer">
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
                $('#t_po_customer_id').css('width', '100%');
                selectList_POCustomer("#t_po_customer_id");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function addPOCustomer() {
                var id = document.getElementsByName('t_po_customer_id')[0].value;
                if (id.length > 0) {
                    getDetailPOCustomer(id);
                }
            }

            function getDetailPOCustomer(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    $("#default-table tbody").empty();
                    for (var i = 0; i < data.val.length; i++) {
                        document.getElementsByName("partner_nama")[0].value = data.val[i].po_customer_nama_pelanggan;
                        document.getElementsByName("partner_alamat_kirim")[0].value = data.val[i].po_customer_alamat_kirim;
                        document.getElementsByName("karyawan_nama")[0].value = data.val[i].m_karyawan_id.val2[0].text;
                        $.ajax({
                          type : "GET",
                          url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                          data : "id="+data.val[i].m_partner_id.val2[0].id,
                          dataType : "json",
                          success:function(data){
                            for(var j=0; j<data.val.length;j++){
                                document.getElementsByName("partner_alamat")[0].value = data.val[j].partner_alamat;
                                document.getElementsByName("partner_telp")[0].value = data.val[j].partner_telepon2;
                            }
                          }
                        });
                    }
                    for(var i = 0; i < data.val2.length; i++){
                        // STEP 1
                        $("#default-table tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].po_customerdet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="3" readonly>'+data.val2[i].po_customerdet_keterangan+'</textarea>\
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

            function editData(id, edit = null) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                        $("#KodeSO").attr('hidden', false);
                        document.getElementsByName("kode")[0].value = data.val[i].kode;
                        document.getElementsByName("so_customer_nomor")[0].value = data.val[i].so_customer_nomor;
                        document.getElementsByName("so_customer_tanggal")[0].value = data.val[i].so_customer_tanggal;
                        document.getElementsByName("so_customer_tanggal")[0].disabled = true;
                        $("#t_po_customer_id").select2('destroy');
                        for(var j=0; j<data.val[i].t_po_customer_id.val2.length; j++){
                            getDetailPOCustomer(data.val[i].t_po_customer_id.val2[j].id);
                            $("#t_po_customer_id").append('<option value="'+data.val[i].t_po_customer_id.val2[j].id+'" selected>'+data.val[i].t_po_customer_id.val2[j].text+'</option>');
                        }
                        $("#t_po_customer_id").select2();
                        document.getElementById("t_po_customer_id").disabled = true;
                        document.getElementsByName("so_customer_catatan")[0].value = data.val[i].so_customer_catatan;
                        document.getElementsByName("so_customer_catatan")[0].readOnly = true;
                        document.getElementsByName("so_customer_status")[0].value = data.val[i].so_customer_status;
                        if (data.val[i].so_customer_status > 1) {
                            // document.getElementById('submit').disabled = true;
                            // if (data.val[i].so_customer_status != 4) {
                            //     document.getElementById('persetujuan1').checked = true;
                            // } else {
                            //     document.getElementById('persetujuan2').checked = true;
                            // }
                            // document.getElementById('persetujuan1').disabled = true;
                            // document.getElementById('persetujuan2').disabled = true;
                        }
                    }
                  }
                });
                
            }

            function checkPersetujuan(idx) {
                if (idx == 1) {
                    document.getElementsByName("so_customer_status")[0].value = 2;
                } else {
                    document.getElementsByName("so_customer_status")[0].value = 4;
                }
            }
        </script>

    </body>

</html>