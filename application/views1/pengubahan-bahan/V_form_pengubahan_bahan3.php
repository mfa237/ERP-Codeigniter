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
                                        <input type="hidden" id="url" value="Persetujuan/Pengubahan-Bahan/postData/">
                                        <input type="hidden" id="url_data" value="Persetujuan/Pengubahan-Bahan">
                                        <input type="hidden" name="pengubahan_bahan_status" value="3">
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID Pengubahan Bahan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Pengubahan Bahan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="pengubahan_bahan_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="KodePengubahan">
                                            <label class="control-label col-md-4">Kode Pengubahan Bahan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="pengubahan_bahan_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Jenis Pengubahan Bahan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <label class="mt-radio"> Perolehan Produksi
                                                        <input type="radio" value="1" name="pengubahan_bahan_jenis" id="pengubahan_bahan_jenis1" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Penyesuaian
                                                        <input type="radio" value="2" name="pengubahan_bahan_jenis" id="pengubahan_bahan_jenis2" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Perolehan Produksi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="t_perolehan_produksi_id" id="t_perolehan_produksi_id" onchange="getPerolehan()" required /> </select></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Hasil Rumus
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="hasil_rumus" id="hasil_rumus" value="0" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Bahan Awal
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="m_barang_id" id="m_barang_id" required /> </select></div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddBahanAwal" class="btn sbold dark" onclick="addBahanAwal()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemAwal" id="jml_itemAwal" value="0" />
                                                <table class="table table-striped table-bordered table-hover" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th valign="center"> No </th>
                                                            <th style="text-align: center;"> Artikel </th>
                                                            <th style="text-align: center;"> Deskripsi </th>
                                                            <th style="text-align: center;"> Qty </th>
                                                            <th style="text-align: center;"> Satuan </th>
                                                            <th style="text-align: center;"> Gudang </th>
                                                            <th valign="center"> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Bahan Hasil
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="m_barang_id2" id="m_barang_id2" required /> </select></div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddBahanHasil" class="btn sbold dark" onclick="addBahanHasil()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemHasil" id="jml_itemHasil" value="0" />
                                                <table class="table table-striped table-bordered table-hover" id="default-table2">
                                                    <thead>
                                                        <tr>
                                                            <th valign="center"> No </th>
                                                            <th style="text-align: center;"> Artikel </th>
                                                            <th style="text-align: center;"> Deskripsi </th>
                                                            <th style="text-align: center;"> Qty </th>
                                                            <th style="text-align: center;"> Satuan </th>
                                                            <th style="text-align: center;"> Gudang </th>
                                                            <th valign="center"> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbodyHasil">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Keterangan
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <textarea class="form-control" name="pengubahan_bahan_keterangan" id="pengubahan_bahan_keterangan"></textarea> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Persetujuan
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <label class="mt-checkbox"> Persetujuan Pengubahan Bahan
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
                                                <a href="<?php echo base_url();?>Persetujuan/Pengubahan-Bahan">
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
                itemAwal = 0;
                itemHasil = 0;
                gudangAwal = [];
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_perhitungan_kebutuhan_id').css('width', '100%');
                $('#t_jadwal_produksi_id').css('width', '100%');
                // $('#m_barang_id').css('width', '100%');
                // $('#m_barang_id2').css('width', '100%');
                selectList_perhitunganKebutuhan("#t_perhitungan_kebutuhan_id");
                // selectList_barang2("#m_barang_id");
                // selectList_barang2("#m_barang_id2");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Pengubahan-Bahan/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){

                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("pengubahan_bahan_nomor")[0].value = data.val[i].pengubahan_bahan_nomor;
                      document.getElementsByName("pengubahan_bahan_keterangan")[0].value = data.val[i].pengubahan_bahan_keterangan;
                      document.getElementsByName("hasil_rumus")[0].value = data.val[i].pengubahan_bahan_konversi;
                      // document.getElementsByName("perolehan_produksi_afalan")[0].value = data.val[i].perolehan_produksi_afalan;
                      document.getElementsByName("t_perolehan_produksi_id")[0].disabled = true;
                      // document.getElementsByName("jadwal_produksi_status")[0].value = data.val[i].jadwal_produksi_status;
                      // document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      document.getElementsByName('m_barang_id')[0].disabled = true;
                      // document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis;
                      // document.getElementsByName('t_jadwal_produksi_id')[0].disabled = true;
                      document.getElementsByName('m_barang_id2')[0].disabled = true;

                      // for(var j=0; j<data.val[i].t_estimasi_penjualan_id.val2.length; j++){
                      //   $("#t_estimasi_penjualan_id").append('<option value="'+data.val[i].t_estimasi_penjualan_id.val2[j].id+'" selected>'+data.val[i].t_estimasi_penjualan_id.val2[j].text+'</option>');
                      // }
                      // $("#t_estimasi_penjualan_id").select2();
                      // document.getElementsByName('t_estimasi_penjualan_id')[0].disabled = true;
                      if(data.val[i].pengubahan_bahan_jenis == 1)
                      {
                        $('#pengubahan_bahan_jenis1').attr('checked', 'checked');
                      }
                      else
                      {
                        $('#pengubahan_bahan_jenis2').attr('checked', 'checked');
                      }
                      if(data.val[i].pengubahan_bahan_status > 3)
                      {
                        document.getElementById('submit').disabled = true;
                        // document.getElementById('Verifikasi').checked = true;
                        // document.getElementById('Verifikasi').disabled = true;
                      }
                      else
                      {
                        document.getElementById('submit'). disabled = false;
                      }
                      document.getElementById('btnAddBahanAwal').disabled = true;
                      document.getElementById('btnAddBahanHasil').disabled = true;
                    }

                    // itemAwal = data.val2.length;
                    $("#KodePengubahan").attr('hidden', false);

                    itemAwal = data.val2.length;
                    for(var i = 0; i < data.val2.length; i++){
                        // TAMBAH NO SERI DI INPUT NAME NO_SERI!!!
                        $("#default-table tbody").append('\
                            <tr id="detail_awal'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="barang_id_awal[]" value="'+data.val2[i].barang_id+'"/>\
                                    <input type="hidden" name="t_perolehan_produksi_awaldet_id[]" value="'+data.val2[i].t_perolehan_produksi_awaldet_id+'"/>\
                                    <input type="hidden" name="no_seri[]" value="'+data.val2[i].pengubahan_bahanawal_no_seri+'"/>\
                                    '+data.val2[i].pengubahan_bahanawal_no_seri+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="deskripsi_awal'+(i+1)+'" name="deskripsi_awal[]" value="'+data.val2[i].barang_uraian+'" required readonly/>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="pengubahan_bahanawalhasil_qty'+(i+1)+'" name="pengubahan_bahanawal_qty[]" value="'+data.val2[i].pengubahan_bahanawal_qty+'" required readonly/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="hidden" class="form-control" name="pengubahan_bahanawal_gudang[]" id="pengubahan_bahanawal_gudang'+(i+1)+'" value="'+data.val2[i].pengubahan_bahanawal_gudang_id+'">\
                                    '+data.val2[i].pengubahan_bahanawal_gudang_nama+'\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" onclick="removeDetailAwal('+(i+1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');
                    }
                    $("#jml_itemAwal").val(itemAwal);

                    itemHasil = data.val2.length;
                    for(var i = 0; i < data.val3.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr id="detail_hasil'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="barang_id_hasil[]" value="'+data.val3[i].barang_id+'"/>\
                                    '+data.val3[i].barang_kode+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="deskripsi_hasil'+(i+1)+'" name="deskripsi_hasil[]" value="'+data.val3[i].pengubahan_bahanakhir_deskripsi+'" required readonly/>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="pengubahan_bahanakhirhasil_qty'+(i+1)+'" name="pengubahan_bahanakhir_qty[]" value="'+data.val3[i].pengubahan_bahanakhir_qty+'" required readonly/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    '+data.val3[i].satuan_nama+'\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="hidden" class="form-control" name="pengubahan_bahanakhir_gudang[]" id="pengubahan_bahanakhir_gudang'+(i+1)+'" value="'+data.val3[i].pengubahan_bahanakhir_gudang_id+'">\
                                    '+data.val3[i].pengubahan_bahanakhir_gudang_nama+'\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" onclick="removeDetailHasil('+(i+1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');
                    }
                    $("#jml_itemHasil").val(itemHasil);
                  }
                });
            }
            function checkPersetujuan() {
                if (document.getElementById("persetujuan").checked == true) {
                    document.getElementsByName("pengubahan_bahan_status")[0].value = 4;
                } else {
                    document.getElementsByName("pengubahan_bahan_status")[0].value = 3;
                }
            }
        </script>

    </body>

</html>