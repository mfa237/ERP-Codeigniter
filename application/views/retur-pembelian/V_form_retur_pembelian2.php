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
                                        <input type="hidden" id="url" value="Pembelian/Retur-Pembelian/postData/">
                                        <input type="hidden" id="url_data" value="Pembelian/Retur-Pembelian">
                                        <input type="hidden" name="retur_pembelian_status" value="0">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">ID Retur Pembelian (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Kode Retur Pembelian (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="retur_pembelian_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Retur Pembelian
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
                                            <label class="control-label col-md-4">Nomor BPB
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_penerimaan_barang_id" name="t_penerimaan_barang_id" aria-required="true" aria-describedby="select-error">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddBPB" class="btn sbold dark"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal BPB
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="penerimaan_barang_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Gudang BPB
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="m_gudang_id" name="m_gudang_id" aria-required="true" aria-describedby="select-error" disabled >
                                                    </select>
                                                </div>
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
                                                            <th> Kode Barang </th>
                                                            <th> Jenis Barang </th>
                                                            <th> Qty </th>
                                                            <th> Qty Retur </th>
                                                            <th> Satuan </th>
                                                            <th> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Persetujuan 
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <label class="mt-checkbox"> Setujui Retur
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
                                                <a href="<?php echo base_url();?>Pembelian/Retur-Pembelian">
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
                $('#t_penerimaan_barang_id').css('width', '100%');
                $('#m_gudang_id').css('width', '100%');
                selectList_penerimaanBarang('#t_penerimaan_barang_id');
                $("#m_gudang_id").select2();
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Pembelian/Retur-Pembelian/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("retur_pembelian_nomor")[0].value = data.val[i].retur_pembelian_nomor;
                      document.getElementsByName("retur_pembelian_tanggal")[0].value = data.val[i].retur_pembelian_tanggal;
                      document.getElementsByName("penerimaan_barang_tanggal")[0].value = data.val[i].penerimaan_barang_tanggal;
                      document.getElementsByName("retur_pembelian_status")[0].value = data.val[i].retur_pembelian_status;
                      
                      $("#t_penerimaan_barang_id").select2('destroy');
                      for(var j=0; j<data.val[i].penerimaan_barang_nomor.val2.length; j++){
                        $("#t_penerimaan_barang_id").append('<option value="'+data.val[i].penerimaan_barang_nomor.val2[j].id+'" selected>'+data.val[i].penerimaan_barang_nomor.val2[j].text+'</option>');
                      }
                      $("#t_penerimaan_barang_id").select2();
                      document.getElementById("t_penerimaan_barang_id").disabled = true;
                      
                      $("#m_gudang_id").select2('destroy');
                      for(var j=0; j<data.val[i].m_gudang_id.val2.length; j++){
                        $("#m_gudang_id").append('<option value="'+data.val[i].m_gudang_id.val2[j].id+'" selected>'+data.val[i].m_gudang_id.val2[j].text+'</option>');
                      }
                      $("#m_gudang_id").select2();

                      if (data.val[i].retur_pembelian_status > 2) {
                        document.getElementById('submit').disabled = true;
                        document.getElementById('persetujuan').checked = true;
                        document.getElementById('persetujuan').disabled = true;
                      }
                      document.getElementById('btnAddBPB').disabled = true;
                    }

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
                                    <input type="hidden" name="retur_pembeliandet_id[]" value="'+data.val2[i].retur_pembeliandet_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    '+data.val2[i].jenis_barang_nama+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num2" id="retur_pembeliandet_qty_terima'+(i+1)+'" name="retur_pembeliandet_qty_terima[]" value="'+data.val2[i].retur_pembeliandet_qty_terima+'" required readonly/>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num2" id="retur_pembeliandet_qty'+(i+1)+'" name="retur_pembeliandet_qty[]" value="'+data.val2[i].retur_pembeliandet_qty+'" onchange="checkQty('+(i+1)+')" readonly required/>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <textarea class="form-control" rows="3" name="retur_pembeliandet_keterangan[]" readonly>'+data.val2[i].retur_pembeliandet_keterangan+'</textarea>\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, '.', ',' );
                    }
                  }
                });
            }

            function checkPersetujuan() {
                if (document.getElementById("persetujuan").checked == true) {
                    document.getElementsByName("retur_pembelian_status")[0].value = 3;
                } else {
                    document.getElementsByName("retur_pembelian_status")[0].value = 2;
                }
            }
        </script>

    </body>

</html>