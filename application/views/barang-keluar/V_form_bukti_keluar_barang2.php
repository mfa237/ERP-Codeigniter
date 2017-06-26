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
                                        <input type="hidden" id="url" value="Gudang/Bukti-Keluar-Barang/postData/">
                                        <input type="hidden" id="url_data" value="Gudang/Bukti-Keluar-Barang">
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
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Diserahkan Oleh
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="m_karyawan_id_penyerah" name="m_karyawan_id_penyerah" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
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
                                                            <th> Qty Permintaan </th>
                                                            <th> Qty Terkirim </th>
                                                            <th> Qty Kirim </th>
                                                            <th> Qty Tersedia </th>
                                                            <th> Satuan </th>
                                                            <th> Keterangan </th>
                                                            <th> Status </th>
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
                                                <a href="<?php echo base_url();?>Gudang/Bukti-Keluar-Barang">
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
                  url  : '<?php echo base_url();?>Gudang/Bukti-Keluar-Barang/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("keluar_barang_nomor")[0].value = data.val[i].keluar_barang_nomor;
                      document.getElementsByName("keluar_barang_tanggal")[0].value = data.val[i].keluar_barang_tanggal;
                      document.getElementsByName("keluar_barang_status")[0].value = data.val[i].keluar_barang_status;
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

                      if (data.val[i].keluar_barang_penyerah.val2.length > 0) {
                        for(var j=0; j<data.val[i].keluar_barang_penyerah.val2.length; j++){
                            $("#m_karyawan_id_penyerah").append('<option value="'+data.val[i].keluar_barang_penyerah.val2[j].id+'" selected>'+data.val[i].keluar_barang_penyerah.val2[j].text+'</option>');
                        }
                        $("#m_karyawan_id_penyerah").select2();
                        document.getElementsByName('m_karyawan_id_penyerah')[0].disabled = true;
                      } else {
                        selectList_karyawan(m_karyawan_id_penyerah);
                      }

                      document.getElementById('keluar_barang_jenis1').disabled = true;
                      document.getElementById('keluar_barang_jenis2').disabled = true;
                      document.getElementById('keluar_barang_jenis3').disabled = true;
                      document.getElementsByName('m_departemen_id')[0].disabled = true;
                      document.getElementsByName('m_gudang_id_permintaan')[0].disabled = true;
                      document.getElementsByName('m_gudang_id_tujuan')[0].disabled = true;
                      if (data.val[i].keluar_barang_status >= 4) {
                        document.getElementById('submit'). disabled = true;
                      } else if (data.val[i].keluar_barang_status == 1) {
                        searchData();
                      }
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);

                    for(var i = 0; i < data.val2.length; i++){
                        var readonly_inp = '';
                        if (data.val2[i].keluar_barangdet_status_real == 1) {
                            var readonly_inp = 'readonly';
                        }
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    <input type="hidden" name="keluar_barangdet_id[]" value="'+data.val2[i].keluar_barangdet_id+'"/>\
                                    <input type="hidden" id="keluar_barangdet_status'+(i+1)+'" name="keluar_barangdet_status[]" value="'+data.val2[i].keluar_barangdet_status_real+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_nama+' ('+data.val2[i].barang_nomor+', '+data.val2[i].jenis_barang_nama+')\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" id="keluar_barangdet_qty'+(i+1)+'" name="keluar_barangdet_qty[]" value="'+data.val2[i].keluar_barangdet_qty+'" required readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" id="keluar_barangdet_qty_realisasi'+(i+1)+'" name="keluar_barangdet_qty_realisasi[]" value="'+data.val2[i].keluar_barangdet_qty_realisasi+'" required readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" id="keluar_barangdet_qty_kirim'+(i+1)+'" name="keluar_barangdet_qty_kirim[]" value="0" onchange="checkQty('+(i+1)+')" required '+readonly_inp+' />\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" id="stok_gudang_jumlah'+(i+1)+'" name="stok_gudang_jumlah[]" value="'+data.val2[i].stok_gudang_jumlah+'" required readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="2" name="keluar_barangdet_keterangan[]" required readonly>'+data.val2[i].keluar_barangdet_keterangan+'</textarea>\
                                </td>\
                                <td>\
                                    '+data.val2[i].keluar_barangdet_status+'\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, '.', ',' );
                    }
                    $("#KodeBKB").attr("hidden", false);
                  }
                });
            }

            function changeStatus() {
                check = 0;
                for (var i = 0; i < itemBarang; i++) {
                    if(document.getElementById('keluar_barangdet_status'+(i+1)).value == 1){
                        check++;   
                    }
                }
                if (check == itemBarang) {
                    document.getElementsByName("keluar_barang_status")[0].value = 4;
                }
            }

            function checkQty(idx) {
                qty1 = document.getElementById("keluar_barangdet_qty"+idx);
                qty2 = document.getElementById("keluar_barangdet_qty_realisasi"+idx);
                qty3 = document.getElementById("keluar_barangdet_qty_kirim"+idx);
                qty4 = document.getElementById("stok_gudang_jumlah"+idx);
                if (parseInt(qty3.value) > (parseInt(qty1.value) - parseInt(qty2.value))) {
                    swal({
                        title: "Alert!",
                        text: "Jumlah kirim melebihi jumlah permintaan!",
                        type: "error",
                        confirmButtonClass: "btn-raised btn-danger",
                        confirmButtonText: "OK",
                    });
                    qty3.value = 0;
                } else if (parseInt(qty3.value) > parseInt(qty4.value)) {
                    swal({
                        title: "Alert!",
                        text: "Jumlah kirim melebihi jumlah persediaan!",
                        type: "error",
                        confirmButtonClass: "btn-raised btn-danger",
                        confirmButtonText: "OK",
                    });
                    qty3.value = 0;
                }

                if (parseInt(qty3.value) == (parseInt(qty1.value) - parseInt(qty2.value))) {
                    document.getElementById("keluar_barangdet_status"+idx).value = 1;
                } else {
                    document.getElementById("keluar_barangdet_status"+idx).value = 0;
                }

                changeStatus();
            }

        </script>

    </body>

</html>