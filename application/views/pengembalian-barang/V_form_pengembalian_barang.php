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
                                        <input type="hidden" id="url" value="Produksi/Pengembalian-Barang/postData/">
                                        <input type="hidden" id="url_data" value="Produksi/Pengembalian-Barang">
                                        <input type="hidden" name="pengembalian_barang_status" value="0">
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID Pengembalian Baramg (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="KodePJ">
                                            <label class="control-label col-md-4">Kode Pengembalian Barang (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="pengembalian_barang_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Pengembalian Barang
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="pengembalian_barang_created_date" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Dari 
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="pengembalian_barang_awal" name="pengembalian_barang_awal" aria-required="true" aria-describedby="select-error" required >
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Ke 
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="pengembalian_barang_tujuan" name="pengembalian_barang_tujuan" aria-required="true" aria-describedby="select-error" required >
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Barang
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="m_barang_id" name="m_barang_id" aria-required="true" aria-describedby="select-error">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddBarang" class="btn sbold dark" onclick="addBarang()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table2">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Artikel </th>
                                                            <th> Jenis Barang </th>
                                                            <th> Qty </th>
                                                            <th> Satuan </th>
                                                            <th> Alasan Pengembalian </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Produksi/Pengembalian-Barang">
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
                $('#pengembalian_barang_awal').css('width', '100%');
                $('#pengembalian_barang_tujuan').css('width', '100%');
                $('#m_barang_id').css('width', '100%');
                selectList_gudangCabang("#pengembalian_barang_awal");
                selectList_gudangCabang("#pengembalian_barang_tujuan");
                selectList_barang();
                // selectList_gudangCabangPermintaan();
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function addBarang() {
                var id = document.getElementsByName('m_barang_id')[0].value;
                if (id.length > 0) {
                    getDetailBarang(id);
                }
                $("#m_barang_id").select2('destroy');
                $("#m_barang_id").empty();
                selectList_barang();
            }

            function getDetailBarang(id) {
                itemBarang++;
                $("#jml_itemBarang").val(itemBarang);
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+itemBarang+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="barang_id[]" value="'+data.val[i].kode+'"/>\
                                    '+data.val[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val[i].m_jenis_barang_id.val2[i].text+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" name="pengembalian_barangdet_qty[]" value="0" required/>\
                                </td>\
                                <td>\
                                    '+data.val[i].m_satuan_id.val2[i].text+'\
                                </td>\
                                <td>\
                                    <textarea name="pengembalian_barangdet_keterangan[]" class="form-control" required></textarea>\
                                </td>\
                            </tr>\
                        ');
                    }
                  }
                });
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Pengembalian-Barang/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("pengembalian_barang_nomor")[0].value = data.val[i].pengembalian_barang_nomor;
                      document.getElementsByName("pengembalian_barang_created_date")[0].value = data.val[i].pengembalian_barang_created_date;
                      // document.getElementsByName("pengembalian_barang_tanggal_dibutuhkan")[0].value = data.val[i].pengembalian_barang_tanggal_dibutuhkan;
                      // document.getElementsByName("pengembalian_barang_tanggal_dibutuhkan")[0].disabled = true;
                      document.getElementsByName("pengembalian_barang_status")[0].value = data.val[i].pengembalian_barang_status;
                      
                      $("#pengembalian_barang_awal").select2('destroy');
                      for(var j=0; j<data.val[i].pengembalian_barang_awal.val2.length; j++){
                        $("#pengembalian_barang_awal").append('<option value="'+data.val[i].pengembalian_barang_awal.val2[j].id+'" selected>'+data.val[i].pengembalian_barang_awal.val2[j].text+'</option>');
                      }
                      $("#pengembalian_barang_awal").select2();

                      $("#pengembalian_barang_tujuan").select2('destroy');
                      for(var j=0; j<data.val[i].pengembalian_barang_tujuan.val2.length; j++){
                        $("#pengembalian_barang_tujuan").append('<option value="'+data.val[i].pengembalian_barang_tujuan.val2[j].id+'" selected>'+data.val[i].pengembalian_barang_tujuan.val2[j].text+'</option>');
                      }
                      $("#pengembalian_barang_tujuan").select2();

                      document.getElementById('submit'). disabled = true;
                      document.getElementsByName('pengembalian_barang_awal')[0].disabled = true;
                      document.getElementsByName('pengembalian_barang_tujuan')[0].disabled = true;
                      document.getElementById('btnAddBarang').disabled = true;
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);
                    $("#KodePJ").attr('hidden', false);

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    <input type="hidden" name="pengembalian_barangdet_id[]" value="'+data.val2[i].pengembalian_barangdet_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_nama+' ('+data.val2[i].jenis_barang_nama+')\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" name="pengembalian_barangdet_qty[]" value="'+data.val2[i].pengembalian_barangdet_qty+'" required readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <textarea name="pengembalian_barangdet_keterangan[]" required readonly>'+data.val2[i].pengembalian_barangdet_keterangan+'</textarea>\
                                </td>\
                            </tr>\
                        ');
                    }
                  }
                });
            }
        </script>

    </body>

</html>