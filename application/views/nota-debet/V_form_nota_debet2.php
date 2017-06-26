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
                                        <input type="hidden" id="url" value="Persetujuan/Nota-Debet/postData">
                                        <input type="hidden" id="url_data" value="Persetujuan/Nota-Debet">
                                        <input type="hidden" name="nota_debet_status" value="0">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">ID Nota Debet (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Kode Nota Debet (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="nota_debet_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Nota Debet
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="nota_debet_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Retur
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input name="t_penerimaan_barang_id" type="hidden"> 
                                                    <input name="t_order_id" type="hidden"> 
                                                    <select class="form-control" id="t_retur_pembelian_id" name="t_retur_pembelian_id" aria-required="true" aria-describedby="select-error">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddRetur" class="btn sbold dark" onclick="addRetur()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Retur
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="retur_pembelian_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Gudang Retur
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input name="m_gudang_id" type="hidden"> 
                                                    <input name="gudang_nama" type="text" class="form-control" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Supplier
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input name="m_partner_id" type="hidden"> 
                                                    <input name="partner_nama" type="text" class="form-control" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Alamat Supplier
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="partner_alamat" readonly></textarea> </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Telp/Fax Supplier
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <textarea class="form-control" rows="3" name="partner_telepon" readonly></textarea> </div>
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
                                                            <th> Jenis Barang </th>
                                                            <th> Qty </th>
                                                            <th> Satuan </th>
                                                            <th> Harga Satuan </th>
                                                            <th> Potongan </th>
                                                            <th> Total </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Sub Total </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="nota_debet_subtotal" name="nota_debet_subtotal" value="0" required readonly />
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> PPN % </th>
                                                            <th>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control decimal" id="nota_debet_ppn" name="nota_debet_ppn" value="0" onchange="sumTotal()" required />
                                                                    <span class="input-group-addon" style="">
                                                                        % 
                                                                    </span>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Total </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="nota_debet_total" name="nota_debet_total" value="0" required readonly />
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Metode Pembayaran 
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <select class="form-control select2" name="nota_debet_metode_pembayaran" aria-required="true" aria-describedby="select-error" disabled>
                                                    <option id="saldo" value="0"> Saldo </option>
                                                    <option id="transfer" value="1"> Transfer </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Catatan
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <textarea class="form-control" rows="3" name="nota_debet_catatan" readonly></textarea> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Persetujuan 
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <label class="mt-checkbox"> Setujui Nota Debet
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
                                                <a href="<?php echo base_url();?>Persetujuan/Nota-Debet">
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
                itemBarang = parseInt($("#jml_itemBarang").val());
                $('.datepicker').datepicker();
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_retur_pembelian_id').css('width', '100%');
                selectList_returPembelian('#t_retur_pembelian_id');
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function getDetailSupplier(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                      document.getElementsByName('partner_alamat')[0].value = data.val[i].partner_alamat;
                      document.getElementsByName('partner_telepon')[0].value = data.val[i].partner_telepon2;
                    }
                  }
                });
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Pembelian/Nota-Debet/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("nota_debet_nomor")[0].value = data.val[i].nota_debet_nomor;
                      document.getElementsByName("nota_debet_tanggal")[0].value = data.val[i].nota_debet_tanggal;
                      document.getElementsByName("retur_pembelian_tanggal")[0].value = data.val[i].retur_pembelian_tanggal;
                      document.getElementsByName("nota_debet_status")[0].value = data.val[i].nota_debet_status;
                      
                      $("#t_retur_pembelian_id").select2('destroy');
                      $("#t_retur_pembelian_id").append('<option value="'+data.val[i].retur_pembelian_id+'" selected>'+data.val[i].retur_pembelian_nomor+'</option>');
                      $("#t_retur_pembelian_id").select2();
                      document.getElementById("t_retur_pembelian_id").disabled = true;
                      
                      document.getElementsByName("m_gudang_id")[0].value = data.val[i].gudang_id;
                      document.getElementsByName("gudang_nama")[0].value = data.val[i].gudang_nama;
                      document.getElementsByName("m_partner_id")[0].value = data.val[i].partner_id;
                      document.getElementsByName("partner_nama")[0].value = data.val[i].partner_nama;
                      document.getElementsByName("nota_debet_subtotal")[0].value = data.val[i].nota_debet_subtotal;
                      document.getElementsByName("nota_debet_ppn")[0].value = data.val[i].nota_debet_ppn;
                      document.getElementsByName("nota_debet_ppn")[0].readOnly = true;
                      document.getElementsByName("nota_debet_total")[0].value = data.val[i].nota_debet_total;
                      document.getElementsByName("nota_debet_catatan")[0].value = data.val[i].nota_debet_catatan;
                      if (data.val[i].nota_debet_metode_pembayaran == 0) {
                        document.getElementById('saldo').selected = true;
                      } else if (data.val[i].nota_debet_metode_pembayaran == 1) {
                        document.getElementById('transfer').selected = true;
                      }
                      getDetailSupplier(data.val[i].partner_id);

                      if (data.val[i].nota_debet_status > 2) {
                        document.getElementById('submit'). disabled = true;
                        document.getElementById('persetujuan').checked = true;
                        document.getElementById('persetujuan').disabled = true;
                      }
                      document.getElementById('btnAddRetur').disabled = true;
                    }

                    $("#default-table tbody").empty();
                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td1'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    <input type="hidden" name="nota_debetdet_id[]" value=""/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    '+data.val2[i].jenis_barang_nama+'\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    <input type="text" class="form-control" id="nota_debetdet_qty'+(i+1)+'" name="nota_debetdet_qty[]" value="'+data.val2[i].nota_debetdet_qty+'" required readonly/>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="nota_debetdet_harga_satuan'+(i+1)+'" name="nota_debetdet_harga_satuan[]" value="'+data.val2[i].nota_debetdet_harga_satuan+'" onchange="sumSubTotal()" readonly required/>\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="nota_debetdet_potongan'+(i+1)+'" name="nota_debetdet_potongan[]" value="'+data.val2[i].nota_debetdet_potongan+'" onchange="sumSubTotal()" readonly required/>\
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="nota_debetdet_total'+(i+1)+'" name="nota_debetdet_total[]" value="'+data.val2[i].nota_debetdet_total+'" readonly required/>\
                                </td>\
                            </tr>\
                        ');
                    }
                    $('.money').number( true, 2, '.', ',' );
                  }
                });
            }

            function checkPersetujuan() {
                if (document.getElementById("persetujuan").checked == true) {
                    document.getElementsByName("nota_debet_status")[0].value = 3;
                } else {
                    document.getElementsByName("nota_debet_status")[0].value = 2;
                }
            }
        </script>

    </body>

</html>