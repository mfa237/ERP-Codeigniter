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
                                <div class="portlet-body"><!-- BEGIN FORM-->
                                    <form action="#" id="formAdd" class="form-horizontal" method="post">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                            <input type="hidden" id="url" value="Produksi/Bukti-Keluar-Barang/postData/">
                                            <input type="hidden" id="url_data" value="Produksi/Bukti-Keluar-Barang">
                                            <input type="hidden" name="keluar_barang_status_temp" value="0">
                                            <input type="hidden" name="keluar_barang_status" value="0">
                                            <div class="form-group" hidden="true">
                                                <label class="control-label col-md-4">ID BKB (Auto)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                                </div>
                                            </div>
                                            <div class="form-group" hidden="true" id="KodeBKB">
                                                <label class="control-label col-md-4">Kode BKB (Auto)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" name="keluar_barang_nomor" readonly /> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Tanggal BKB
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <div class=" input-group">
                                                            <input name="keluar_barang_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                            <span class="input-group-addon" style="">
                                                                <span class="icon-calendar"></span>
                                                            </span>
                                                        </div> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Jenis BKB
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="mt-radio-inline">
                                                        <i class="fa"></i>
                                                        <label class="mt-radio"> Bahan Baku
                                                            <input type="radio" value="1" name="keluar_barang_jenis" id="keluar_barang_jenis1" required />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio"> Bahan Penolong
                                                            <input type="radio" value="2" name="keluar_barang_jenis" id="keluar_barang_jenis2" />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio"> Lain Lain
                                                            <input type="radio" value="3" name="keluar_barang_jenis" id="keluar_barang_jenis3" />
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Gudang Permintaan
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <select class="form-control" id="m_gudang_id_permintaan" name="m_gudang_id_permintaan" aria-required="true" aria-describedby="select-error" required >
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Gudang Tujuan
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <select class="form-control" id="m_gudang_id_tujuan" name="m_gudang_id_tujuan" aria-required="true" aria-describedby="select-error" required >
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Tujuan BKB
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <select class="form-control" id="m_departemen_id" name="m_departemen_id" aria-required="true" aria-describedby="select-error" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="penerima">
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
                                                <div class="col-md-12 table-scroll">
                                                    <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table2">
                                                        <thead>
                                                            <tr>
                                                                <th> No </th>
                                                                <th> Artikel </th>
                                                                <th> Uraian dan Spesifikasi Barang/Jasa </th>
                                                                <th> Qty </th>
                                                                <th> Qty Terima </th>
                                                                <th> Satuan </th>
                                                                <th> Keterangan </th>
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
                                                    <a href="<?php echo base_url();?>Produksi/Bukti-Keluar-Barang">
                                                    <button type="button" class="btn default">Kembali</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM -->
                                </div>
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
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                itemBarang = parseInt($("#jml_itemBarang").val());
                $('#m_barang_id').css('width', '100%');
                $('#m_departemen_id').css('width', '100%');
                $('#m_gudang_id_permintaan').css('width', '100%');
                $('#m_gudang_id_tujuan').css('width', '100%');
                selectList_barang();
                selectList_departemen();
                selectList_gudangCabangPermintaan();
                selectList_gudangCabangTujuan();
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Bukti-Keluar-Barang/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("keluar_barang_nomor")[0].value = data.val[i].keluar_barang_nomor;
                      document.getElementsByName("keluar_barang_tanggal")[0].value = data.val[i].keluar_barang_tanggal;
                      document.getElementsByName("keluar_barang_status")[0].value = data.val[i].keluar_barang_status;
                      document.getElementsByName("keluar_barang_status_temp")[0].value = data.val[i].keluar_barang_status;
                      if (data.val[i].keluar_barang_jenis == 1) {
                        document.getElementById('keluar_barang_jenis1').checked = true;
                      } else if (data.val[i].keluar_barang_jenis == 2) {
                        document.getElementById('keluar_barang_jenis2').checked = true;
                      } else if (data.val[i].keluar_barang_jenis == 3) {
                        document.getElementById('keluar_barang_jenis3').checked = true;
                      }
                      $("#m_departemen_id").select2('destroy');
                      for(var j=0; j<data.val[i].m_departemen_id.val2.length; j++){
                        $("#m_departemen_id").append('<option value="'+data.val[i].m_departemen_id.val2[j].id+'" selected>'+data.val[i].m_departemen_id.val2[j].text+'</option>');
                      }
                      $("#m_departemen_id").select2();
                      
                      $("#m_gudang_id_permintaan").select2('destroy');
                      for(var j=0; j<data.val[i].m_gudang_id_permintaan.val2.length; j++){
                        $("#m_gudang_id_permintaan").append('<option value="'+data.val[i].m_gudang_id_permintaan.val2[j].id+'" selected>'+data.val[i].m_gudang_id_permintaan.val2[j].text+'</option>');
                      }
                      $("#m_gudang_id_permintaan").select2();
                      
                      $("#m_gudang_id_tujuan").select2('destroy');
                      for(var j=0; j<data.val[i].m_gudang_id_tujuan.val2.length; j++){
                        $("#m_gudang_id_tujuan").append('<option value="'+data.val[i].m_gudang_id_tujuan.val2[j].id+'" selected>'+data.val[i].m_gudang_id_tujuan.val2[j].text+'</option>');
                      }
                      $("#m_gudang_id_tujuan").select2();

                      if (data.val[i].keluar_barang_status != 4) {
                        document.getElementById('submit'). disabled = true;
                      } 

                      if (data.val[i].keluar_barang_status == 4 || data.val[i].keluar_barang_status == 5) {
                        $("#penerima").append('\
                        <div class="form-group">\
                            <label class="control-label col-md-4">Diterima Oleh\
                                <span class="required"> * </span>\
                            </label>\
                            <div class="col-md-8">\
                                <div class="input-icon right">\
                                    <i class="fa"></i>\
                                    <select class="form-control" id="m_karyawan_id_penerima" name="m_karyawan_id_penerima" aria-required="true" aria-describedby="select-error" onchange="changeStatus()" required>\
                                    </select>\
                                </div>\
                            </div>\
                        </div>\
                        ');

                          if (data.val[i].keluar_barang_penerima.val2.length > 0) {
                            for(var j=0; j<data.val[i].keluar_barang_penerima.val2.length; j++){
                                $("#m_karyawan_id_penerima").append('<option value="'+data.val[i].keluar_barang_penerima.val2[j].id+'" selected>'+data.val[i].keluar_barang_penerima.val2[j].text+'</option>');
                            }
                            $("#m_karyawan_id_penerima").select2();
                            document.getElementsByName('m_karyawan_id_penerima')[0].disabled = true;
                          } else {
                            selectList_karyawan(m_karyawan_id_penerima);
                          }
                      }

                      document.getElementById('keluar_barang_jenis1').disabled = true;
                      document.getElementById('keluar_barang_jenis2').disabled = true;
                      document.getElementById('keluar_barang_jenis3').disabled = true;
                      document.getElementsByName('m_departemen_id')[0].disabled = true;
                      document.getElementsByName('m_gudang_id_permintaan')[0].disabled = true;
                      document.getElementsByName('m_gudang_id_tujuan')[0].disabled = true;
                      document.getElementById('btnAddBarang').disabled = true;
                      $("#KodeBKB").attr('hidden', false);
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    <input type="hidden" name="keluar_barangdet_id[]" value="'+data.val2[i].keluar_barangdet_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_nama+' ('+data.val2[i].barang_nomor+', '+data.val2[i].jenis_barang_nama+')\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" name="keluar_barangdet_qty[]" value="'+data.val2[i].keluar_barangdet_qty+'" required readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" id="keluar_barangdet_qty_realisasi'+(i+1)+'" name="keluar_barangdet_qty_realisasi[]" value="'+data.val2[i].keluar_barangdet_qty_realisasi+'" required readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="2" name="keluar_barangdet_keterangan[]" readonly>'+data.val2[i].keluar_barangdet_keterangan+'</textarea>\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, '.', ',' );
                    }
                  }
                });
            }

            function changeStatus() {
                if(document.getElementById('m_karyawan_id_penerima').value != null){
                    document.getElementsByName("keluar_barang_status")[0].value = 5;
                } else {
                    document.getElementsByName("keluar_barang_status")[0].value = 4;
                }
            }

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
                                        <input type="hidden" name="m_barang_id[]" value="'+data.val[i].kode+'"/>\
                                        <input type="hidden" name="keluar_barangdet_id[]" value=""/>\
                                        '+data.val[i].barang_kode+'\
                                    </td>\
                                    <td>\
                                        '+data.val[i].barang_nama+' ('+data.val[i].barang_nomor+', '+data.val[i].m_jenis_barang_id.val2[0].text+')\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control num2" name="keluar_barangdet_qty[]" value="0" required/>\
                                    </td>\
                                        <td>\
                                            <input type="text" class="form-control num2" name="keluar_barangdet_qty_realisasi[]" value="0" required readonly/>\
                                        </td>\
                                    <td>\
                                        '+data.val[i].m_satuan_id.val2[0].text+'\
                                    </td>\
                                    <td>\
                                        <textarea class="form-control" rows="2" name="keluar_barangdet_keterangan[]" required></textarea>\
                                    </td>\
                                </tr>\
                            ');
                            $('.num2').number( true, 2, '.', ',' );
                        }
                      }
                    });
                }

        </script>

    </body>

</html>