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
                                        <input type="hidden" id="url" value="Produksi/Ketidaksesuaian-Spesifikasi/postData/">
                                        <input type="hidden" id="url_data" value="Produksi/Ketidaksesuaian-Spesifikasi">
                                        <input type="hidden" name="ketidaksesuaian_spesifikasi_status" value="0">
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID Ketidaksesuaian Spesifikasi (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="KodeKetidaksesuaian">
                                            <label class="control-label col-md-4">Kode Ketidaksesuaian Spesifikasi (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="ketidaksesuaian_spesifikasi_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Ketidaksesuaian Spesifikasi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="ketidaksesuaian_spesifikasi_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Produksi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_perolehan_produksi_id" name="t_perolehan_produksi_id" aria-required="true" aria-describedby="select-error" onchange="addJadwal()" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Shift
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control num" name="jadwal_produksi_shift" required readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Jenis Produksi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="jadwal_produksi_jenis" required readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Mesin
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="ketidaksesuaian_spesifikasi_mesin" required /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Operator
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="ketidaksesuaian_spesifikasi_operator" name="ketidaksesuaian_spesifikasi_operator" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemKomplain" id="jml_itemKomplain" value="0" />
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Nama Barang </th>
                                                            <th> Jam </th>
                                                            <th> Qty </th>
                                                            <th> Problem Komplain </th>
                                                            <th> Tindakan Perbaikan </th>
                                                            <th> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group" id="pilihBarang">
                                            <div class="col-md-12 text-right">
                                                <button type="button" id="btnAdd" class="btn sbold dark" onclick="add()"><i class="icon-plus"></i> Tambah Detail</button>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Produksi/Ketidaksesuaian-Spesifikasi">
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
                itemKomplain = 0;
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_perolehan_produksi_id').css('width', '100%');
                selectList_perolehanProduksi2("#t_perolehan_produksi_id");
                selectList_karyawan("#ketidaksesuaian_spesifikasi_operator");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function addJadwal() {
                var id = document.getElementsByName('t_perolehan_produksi_id')[0].value;
                if (id.length > 0) {
                    getDetailJadwal(id);
                }
            }

            function getDetailJadwal(id) {
                var idJadwalProduksi = '';
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Perolehan-Produksi/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val2.length;i++){
                        idJadwalProduksi = data.val2[i].jadwal_produksi_id;
                      // document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      // document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis;
                      $.ajax({
                          type : "GET",
                          url  : '<?php echo base_url();?>Produksi/Jadwal-Produksi/loadDataWhere/',
                          data : "id="+idJadwalProduksi,
                          dataType : "json",
                          success:function(data){
                            for(var i=0; i<data.val.length;i++){
                                // idJadwalProduksi = data.val2[i].jadwal_produksi_id;
                              document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                              document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis.val2[i].text;

                            }
                          }
                        });
                    }
                    itemKomplain = 1;
                    
                    for(var i=0; i<data.val3.length; i++)
                    {
                        alert(data.val3[i].perolehan_produksi_akhirdet_qty_rusak);
                        if((data.val3[i].perolehan_produksi_akhirdet_qty_rusak != '') && (data.val3[i].perolehan_produksi_akhirdet_qty_rusak > 0))
                        {
                            alert('masuk if');
                            $("#default-table tbody").append('\
                                <tr id="detail'+(i+1)+'">\
                                    <td id="td0'+(i+1)+'">\
                                        '+itemKomplain+'\
                                    </td>\
                                    <td id="td1'+(i+1)+'">\
                                        <input type="hidden" name="m_barang_id[]" value="'+data.val3[i].barang_id+'"/>\
                                        '+data.val3[i].barang_nama+'\
                                    </td>\
                                    <td id="td2'+(i+1)+'">\
                                        <input type="hidden" name="t_perolehan_produksi_akhirdet_id[]" id="t_perolehan_produksi_akhirdet_id'+(i+1)+'" value="'+data.val3[i].perolehan_produksi_akhirdet_id+'"/>\
                                        <input type="text" class="form-control timepicker timepicker-default" name="ketidaksesuaian_spesifikasidet_time[]">\
                                    </td>\
                                    <td id="td3'+(i+1)+'">\
                                        <input type="text" class="form-control num" name="ketidaksesuaian_spesifikasidet_qty[]" value="'+data.val3[i].perolehan_produksi_akhirdet_qty_rusak+'" required/>\
                                    </td>\
                                    <td id="td4'+(i+1)+'">\
                                        <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_komplain[]" required></textarea>\
                                    </td>\
                                    <td id="td5'+(i+1)+'">\
                                        <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_tindakan[]" required></textarea>\
                                    </td>\
                                    <td id="td6'+(i+1)+'">\
                                        <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_keterangan[]" required></textarea>\
                                    </td>\
                                </tr>\
                            ');
                            itemKomplain++;
                        }
                        
                        $('.timepicker-default').timepicker({
                            autoclose: true,
                            minuteStep: 1
                        });
                    }
                    document.getElementById("jml_itemKomplain").value = itemKomplain;
                  }
                });

                
            }

            // function add() {
            //     itemKomplain++;
            //     document.getElementById("jml_itemKomplain").value = itemKomplain;
            //     $("#default-table tbody").append('\
            //         <tr id="detail'+itemKomplain+'">\
            //             <td id="td0'+itemKomplain+'">\
            //                 '+itemKomplain+'\
            //             </td>\
            //             <td id="td1'+itemKomplain+'">\
            //                 <input type="hidden" name="t_ketidaksesuaian_spesifikasi_id[]" value="0"/>\
            //                 <input type="text" class="form-control timepicker timepicker-default" name="ketidaksesuaian_spesifikasidet_time[]">\
            //             </td>\
            //             <td id="td2'+itemKomplain+'">\
            //                 <input type="text" class="form-control num" name="ketidaksesuaian_spesifikasidet_qty[]" value="0" required/>\
            //             </td>\
            //             <td id="td3'+itemKomplain+'">\
            //                 <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_komplain[]" required></textarea>\
            //             </td>\
            //             <td id="td4'+itemKomplain+'">\
            //                 <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_tindakan[]" required></textarea>\
            //             </td>\
            //             <td id="td5'+itemKomplain+'">\
            //                 <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_keterangan[]" required></textarea>\
            //             </td>\
            //         </tr>\
            //     ');   
            //     $('.timepicker-default').timepicker({
            //         autoclose: true,
            //         minuteStep: 1
            //     });
            // }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Ketidaksesuaian-Spesifikasi/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("ketidaksesuaian_spesifikasi_nomor")[0].value = data.val[i].ketidaksesuaian_spesifikasi_nomor;
                      document.getElementsByName("ketidaksesuaian_spesifikasi_tanggal")[0].value = data.val[i].ketidaksesuaian_spesifikasi_tanggal;
                      document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis.val2[i].text;
                      document.getElementsByName("ketidaksesuaian_spesifikasi_mesin")[0].value = data.val[i].ketidaksesuaian_spesifikasi_mesin;
                      document.getElementsByName("ketidaksesuaian_spesifikasi_mesin")[0].disabled = true;

                      $("#t_perolehan_produksi_id").select2('destroy');
                      for(var j=0; j<data.val[i].t_jadwal_produksi_id.val2.length; j++){
                        $("#t_perolehan_produksi_id").append('<option value="'+data.val[i].t_jadwal_produksi_id.val2[j].id+'" selected>'+data.val[i].t_jadwal_produksi_id.val2[j].text+'</option>');
                      }
                      $("#t_perolehan_produksi_id").select2();
                      document.getElementsByName('t_perolehan_produksi_id')[0].disabled = true;

                      $("#ketidaksesuaian_spesifikasi_operator").select2('destroy');
                      for(var j=0; j<data.val[i].ketidaksesuaian_spesifikasi_operator.val2.length; j++){
                        $("#ketidaksesuaian_spesifikasi_operator").append('<option value="'+data.val[i].ketidaksesuaian_spesifikasi_operator.val2[j].id+'" selected>'+data.val[i].ketidaksesuaian_spesifikasi_operator.val2[j].text+'</option>');
                      }
                      $("#ketidaksesuaian_spesifikasi_operator").select2();
                      document.getElementsByName('ketidaksesuaian_spesifikasi_operator')[0].disabled = true;

                      document.getElementById('submit'). disabled = true;
                      // document.getElementById('btnAdd').disabled = true;
                    }

                    $("#KodeKetidaksesuaian").attr('hidden', false);
                    itemKomplain = data.val2.length;
                    $("#jml_itemKomplain").val(itemKomplain);

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].barang_id+'"/>\
                                        '+data.val2[i].barang_nama+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="hidden" name="t_ketidaksesuaian_spesifikasi_id[]" value="'+data.val2[i].ketidaksesuaian_spesifikasidet_id+'"/>\
                                    <input type="text" class="form-control timepicker timepicker-default" name="ketidaksesuaian_spesifikasidet_time[]" value="'+data.val2[i].ketidaksesuaian_spesifikasidet_time+'" readonly>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num" name="ketidaksesuaian_spesifikasidet_qty[]" value="'+data.val2[i].ketidaksesuaian_spesifikasidet_qty+'" readonly required/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_komplain[]" required readonly>'+data.val2[i].ketidaksesuaian_spesifikasidet_komplain+'</textarea>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_tindakan[]" required readonly>'+data.val2[i].ketidaksesuaian_spesifikasidet_tindakan+'</textarea>\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <textarea class="form-control" rows="3" name="ketidaksesuaian_spesifikasidet_keterangan[]" required readonly>'+data.val2[i].ketidaksesuaian_spesifikasidet_keterangan+'</textarea>\
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