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
                                        <input type="hidden" id="url" value="Gudang/Penerimaan-Barang-Retur/postData/">
                                        <input type="hidden" id="url_data" value="Gudang/Penerimaan-Barang-Retur">
                                        <div class="form-group" id="kode" hidden="true">
                                            <label class="control-label col-md-4">ID Penerimaan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="KodeFaktur" hidden="true">
                                            <label class="control-label col-md-4">Kode Penerimaan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="bpbr_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Penerimaan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="bpbr_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Pengecekan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" date input-group datepicker" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                                        <input name="bpbr_pengecekan" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" required>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Klaim/Retur 
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_retur_penjualan_id" name="t_retur_penjualan_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddFKCustomer" class="btn sbold dark" onclick="addFKCustomer()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Artikel </th>
                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                            <th> Qty </th>
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
                                                    <textarea class="form-control" rows="3" name="bpbr_catatan"></textarea> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Gudang/Penerimaan-Barang-Retur">
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
                datadetailfaktur = [];
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_retur_penjualan_id').css('width', '100%');
                selectList_returPenjualan2("#t_retur_penjualan_id");
                if (document.getElementsByName("kode")[0].value.length > 0) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function addFKCustomer() {
                var id = document.getElementsByName('t_retur_penjualan_id')[0].value;
                if (id.length > 0) {
                    getDetailFKCustomer(id);
                }
            }

            function getDetailFKCustomer(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Klaim-Retur-Penjualan/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){

                    $("#default-table tbody").empty();
                    for(var i = 0; i < data.val2.length; i++){
                        itemBarang++;
                        $("#default-table tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="t_retur_penjualandet_id[]" value="'+data.val2[i].retur_penjualandet_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" name="bpbrdet_qty[]" value="'+data.val2[i].retur_penjualandet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" value="'+data.val2[i].retur_penjualandet_batch_no+'" readonly/>\
                                </td>\
                            </tr>\
                        ');
                    }
                  }
                });
            }

            function sumSubTotal() {
                subTotal = 0;
                for (var i = 1; i <= itemBarang; i++) {
                    qty = document.getElementById('qtybrg'+i).value;
                    hrg = parseInt(document.getElementById('hargabrg'+i).value.replace(/\./g, ""));
                    disc = parseInt(document.getElementById('faktur_penjualandet_discount'+i).value.replace(/\./g, ""));
                    document.getElementById('totalhargabrg'+i).value = qty * hrg - (qty * hrg * disc / 100);
                    subTotal += qty * hrg - (qty * hrg * disc / 100);
                }
                document.getElementById('faktur_penjualan_subtotal').value = subTotal;
                $('.money').number( true, 2, '.', ',' );
                sumTotal();
            }

            function sumTotal() {
                subTotal = parseInt(document.getElementById('faktur_penjualan_subtotal').value.replace(/\./g, ""));
                potongan = parseInt(document.getElementById('faktur_penjualan_potongan').value.replace(/\./g, ""));
                dp = parseInt(document.getElementById('faktur_penjualan_uang_muka').value.replace(/\./g, ""));
                document.getElementById('faktur_penjualan_total').value = subTotal - potongan - dp;
                $('.money').number( true, 2, '.', ',' );
            }

            function editData(id, edit = null) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Faktur-Penjualan/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                        document.getElementById('submit').disabled = true;
                        document.getElementById('btnAddFKCustomer').disabled = true;
                        $("#KodeFaktur").attr('hidden', false);
                        document.getElementsByName("kode")[0].value = data.val[i].kode;
                        document.getElementsByName("faktur_penjualan_nomor")[0].value = data.val[i].faktur_penjualan_nomor;
                        document.getElementsByName("faktur_penjualan_tanggal")[0].value = data.val[i].faktur_penjualan_tanggal;
                        document.getElementsByName("faktur_penjualan_tanggal")[0].disabled = true;
                        document.getElementsByName("faktur_penjualan_jatuh_tempo")[0].value = data.val[i].faktur_penjualan_jatuh_tempo;
                        document.getElementsByName("faktur_penjualan_jatuh_tempo")[0].disabled = true;
                        $("#t_so_customer_id").select2('destroy');
                        for(var j=0; j<data.val[i].t_so_customer_id.val2.length; j++){
                            getDetailFKCustomer(data.val[i].t_so_customer_id.val2[j].id);
                            $("#t_so_customer_id").append('<option value="'+data.val[i].t_so_customer_id.val2[j].id+'" selected>'+data.val[i].t_so_customer_id.val2[j].text+'</option>');
                        }
                        $("#t_so_customer_id").select2();
                        document.getElementById("t_so_customer_id").disabled = true;
                        document.getElementsByName("faktur_penjualan_potongan")[0].value = data.val[i].faktur_penjualan_potongan;
                        document.getElementsByName("faktur_penjualan_potongan")[0].readOnly = true;
                        document.getElementsByName("faktur_penjualan_uang_muka")[0].value = data.val[i].faktur_penjualan_uang_muka;
                        document.getElementsByName("faktur_penjualan_uang_muka")[0].readOnly = true;
                        document.getElementsByName("faktur_penjualan_tujuan_transfer")[0].value = data.val[i].faktur_penjualan_tujuan_transfer;
                        document.getElementsByName("faktur_penjualan_tujuan_transfer")[0].readOnly = true;
                    }
                    datadetailfaktur = data.val2;
                  }
                });
            }
        </script>

    </body>

</html>