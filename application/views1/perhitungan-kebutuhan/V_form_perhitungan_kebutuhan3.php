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
                                        <input type="hidden" id="url" value="Persetujuan/Perhitungan-Kebutuhan-Bahan/postData/">
                                        <input type="hidden" id="url_data" value="Persetujuan/Perhitungan-Kebutuhan-Bahan">
                                        <input type="hidden" name="status_awal" value="0">
                                        <input type="hidden" name="perhitungan_kebutuhan_status" value="0">
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID Perhitungan Kebutuhan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="KodePerhitungan">
                                            <label class="control-label col-md-4">Kode Perhitungan Kebutuhan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="perhitungan_kebutuhan_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Perhitungan Kebutuhan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="perhitungan_kebutuhan_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Jenis Perhitungan Kebutuhan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <i class="fa"></i>
                                                        <label class="mt-radio"> Produksi 
                                                            <input type="radio" value="1" name="perhitungan_kebutuhan_jenis" id="perhitungan_kebutuhan_jenis1" onchange="getRef(this)" required />
                                                            <span></span>
                                                        </label>
                                                        <label class="mt-radio"> Permintaan Pembelian
                                                            <input type="radio" value="2" name="perhitungan_kebutuhan_jenis" id="perhitungan_kebutuhan_jenis2" onchange="getRef(this)" required />
                                                            <span></span>
                                                        </label>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="produksi" hidden="false">
                                                <label class="control-label col-md-4">Nomor Jadwal Produksi
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <select class="form-control" id="t_jadwal_produksi_id" name="t_jadwal_produksi_id" aria-required="true" aria-describedby="select-error" multiple="multiple" onchange="addJadwal()">
                                                        </select>
                                                    </div>
                                                    <div id="idJadwalProduksi">
                                                        
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-1">
                                                    <!--  -->
                                                </div>
                                            </div>
                                            <div id="permintaanJasa" hidden="true">
                                                <label class="control-label col-md-4">
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <button type="button" id="btnAddBarang" class="btn sbold dark" onclick="addBarang()"><i class="icon-plus"> Tambah Barang Jadi</i></button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <input type="hidden" name="jml_itemOption" id="jml_itemOption" value="1" />
                                        <div id="default-value">
                                        </div>
                                        <div id="default-value2">
                                        </div>
                                        <hr>
                                        <div id="detailJadwal">
                                        </div>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Gudang Produksi
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <select class="form-control" id="m_gudang_id" name="m_gudang_id" aria-required="true" aria-describedby="select-error" >
                                                </select>
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
                                                <label class="mt-checkbox"> Setujui Perhitungan Kebutuhan Bahan
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
                                                <a href="<?php echo base_url();?>Persetujuan/Perhitungan-Kebutuhan-Bahan">
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
                idTabel = 1;
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_jadwal_produksi_id').css('width', '100%');
                selectList_jadwalProduksi("#t_jadwal_produksi_id");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            // function addJadwal() {
            //     var id = $('#t_jadwal_produksi_id').select2('val');
            //     $('#detailJadwal').html('');
            //     $('#idJadwalProduksi').html('');
            //     idTabel = 1;
            //     // if (id.length > 0) {
            //     //     getDetailJadwal(id);
            //     // }
            //     for (var i= 0; i< id.length; i++) {
            //         $("#idJadwalProduksi").append('<input type="hidden" name="id[]" value="'+id[i]+'">');
            //         getDetailJadwal(id[i]);
            //     }
            // }

            // function getRef(elemen)
            // {
            //     if(elemen.id == 'perhitungan_kebutuhan_jenis1')
            //     {
            //         document.getElementById('t_jadwal_produksi_id').disabled = false;
            //         $('#default-table tbody').empty();
            //         $('#default-table2 tbody').empty();
            //         $('#produksi').attr('hidden', false);
            //         $('#permintaanJasa').attr('hidden', true);
            //         $('#default-value').empty();
            //         $('default-value2').empty();
            //         $('#t_jadwal_produksi_id').select2();
            //         selectList_jadwalProduksi('#t_jadwal_produksi_id');
            //         itemOption = 1;
            //         $('#jml_itemOption').val(itemOption);
            //     }
            //     else
            //     {
            //         document.getElementById('t_jadwal_produksi_id').disabled = true;
            //         $('#default-table tbody').empty();
            //         $('#default-table2 tbody').empty();
            //         $('#detailJadwal').empty();
            //         $('#produksi').attr('hidden', true);
            //         $('#permintaanJasa').attr('hidden', false);
            //         $('#t_jadwal_produksi_id').empty();
            //         defaultValue();
            //     }
            // }

            function getDetailJadwal(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Jadwal-Produksi/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    var idJadwal;
                    for(var i=0; i<data.val.length;i++){
                        idJadwal = data.val[i].kode;
                        // alert(idJadwal+' JP');
                      // document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      // document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis;
                      $("#detailJadwal").append('<div class="form-group">\
                            <label class="control-label col-md-4">Shift\
                                <span class="required"> * </span>\
                            </label>\
                            <div class="col-md-8">\
                                <div class="input-icon right">\
                                    <i class="fa"></i>\
                                    <input type="text" class="form-control num" name="jadwal_produksi_shift[]" value="'+data.val[i].jadwal_produksi_shift+'" required readonly /> </div>\
                            </div>\
                        </div>\
                        <div class="form-group">\
                            <label class="control-label col-md-4">Jenis Produksi\
                                <span class="required"> * </span>\
                            </label>\
                            <div class="col-md-8">\
                                <div class="input-icon right">\
                                    <i class="fa"></i>\
                                    <input type="text" class="form-control" name="jadwal_produksi_jenis[]" value="'+data.val[i].jadwal_produksi_jenis.val2[i].text+'" required readonly /> </div>\
                            </div>\
                        </div>');
                    }

                    $("#default-table tbody").empty();

                    itemBarang += data.val3.length;
                    $("#jml_itemBarang").val(itemBarang);

                    for(var i = 0; i < data.val3.length; i++){
                        var idx = idTabel+"_"+(i+1);
                        $("#detailJadwal").append('\
                            <div id="detailJadwal'+(i+1)+'">\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Nama Barang\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="hidden" name="jadwal_produksidet_id[]" value="'+data.val3[i].jadwal_produksi_akhirdet_id+'" required readonly /> \
                                        <input type="hidden" name="jml_bahan[]" id="jml_bahan'+idTabel+'" value="1" required readonly /> \
                                        <input type="text" class="form-control num" name="barang_nama[]" value="'+data.val3[i].barang_nama+'" required readonly /> </div>\
                                </div>\
                                <label class="control-label col-md-3">Satuan Barang\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="satuan_nama[]" value="'+data.val3[i].satuan_nama+'" required readonly /> </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Jumlah Produksi\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="jadwal_produksi_qty[]" value="'+data.val3[i].jadwal_produksi_akhirdet_total+'" id="jadwal_produksi_qty'+idTabel+'" required readonly />\
                                     </div>\
                                </div>\
                                <label class="control-label col-md-3">Berat\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="perhitungan_kebutuhandet_berat[]" value="0" onchange="total('+idTabel+')" id="perhitungan_kebutuhandet_berat'+idTabel+'" required /> </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Total\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="perhitungan_kebutuhandet_total[]" value="0" id="perhitungan_kebutuhandet_total'+idTabel+'" required readonly />\
                                     </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Nama Bahan\
                                </label>\
                                <div class="col-md-8">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <select class="form-control" id="m_barang_id'+idTabel+'_'+(i+1)+'" aria-required="true" aria-describedby="select-error">\
                                        </select>\
                                    </div>\
                                </div>\
                                <div class="col-md-1">\
                                    <button type="button" id="btnAddBahan" class="btn sbold dark" onclick="addBahan(\''+idx+'\','+idJadwal+','+idTabel+')">\
                                    <i class="icon-plus"></i></button>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <div class="col-md-12">\
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table'+idTabel+'_'+(i+1)+'">\
                                        <thead>\
                                            <tr>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> No </th>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> Nama Bahan </th>\
                                                <th class="text-center" colspan="3" style="vertical-align: middle;"> Bahan Coil </th>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> Keterangan </th>\
                                            </tr>\
                                            <tr>\
                                                <th class="text-center" style="vertical-align: middle;"> Ukuran Coil (BMT) </th>\
                                                <th class="text-center" style="vertical-align: middle;"> Lebar Coil (m) </th>\
                                                <th class="text-center" style="vertical-align: middle;"> Slittingan (mm) </th>\
                                            </tr>\
                                        </thead>\
                                        <tbody id="tableTbody'+idTabel+'_'+(i+1)+'">\
                                        </tbody>\
                                    </table>\
                                </div>\
                            </div>\
                            </div>\
                            <hr>\
                        ');
                        // alert('abc');
                        selectList_jadwalProduksiBahanAwal("#m_barang_id"+idTabel+"_"+(i+1), idJadwal);
                        idTabel++;
                        $(".num").keydown(function(event) {
                        // Allow: backspace, delete, tab, escape, enter and .
                        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                             // Allow: Ctrl+A, Command+A
                            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                             // Allow: home, end, left, right, down, up
                            (event.keyCode >= 35 && event.keyCode <= 40)) {
                                 // let it happen, don't do anything
                                 return;
                        }
                        // Ensure that it is a number and stop the keypress
                        if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                            event.preventDefault();
                        }
                        });
                        $(".decimal").keydown(function(event) {
                        // Allow: backspace, delete, tab, escape, enter and .
                        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                             // Allow: Ctrl+A, Command+A
                            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                             // Allow: home, end, left, right, down, up
                            (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {
                                 // let it happen, don't do anything
                                 return;
                        }
                        // Ensure that it is a number and stop the keypress
                        if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                            event.preventDefault();
                        }
                        });
                    }
                  }
                });
            }

            // function total(id)
            // {
            //     var qty = document.getElementById('jadwal_produksi_qty'+id).value;
            //     var berat = document.getElementById('perhitungan_kebutuhandet_berat'+id).value;
            //     var total = qty * berat;
            //     document.getElementById('perhitungan_kebutuhandet_total'+id).value = total;
            // }

            // function addBahan(idx, idJadwal, idTabel) {

            //     var id = document.getElementById('m_barang_id'+idx+'')[0].value;
            //     if (id.length > 0) {

            //         getDetailBahan(id,idx, idTabel);
            //     }
            //     $("#m_barang_id"+idx).select2('destroy');
            //     $("#m_barang_id"+idx).empty();
            //     selectList_jadwalProduksiBahanAwal("#m_barang_id"+idx, idJadwal);
            // }

            function getDetailBahan(id,idx, idTabel) {
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                    data : { id : id },
                    dataType : "json",
                    success:function(data){
                        jmlBahan = document.getElementById('jml_bahan'+idTabel).value;
                        for(var i = 0; i < data.val.length; i++){
                            $("#default-table"+idx+" tbody").append('\
                                <tr id="detail'+idx+'-'+jmlBahan+'">\
                                    <td id="td0'+idx+'-'+jmlBahan+'">\
                                        '+jmlBahan+'\
                                    </td>\
                                    <td id="td1'+idx+'-'+jmlBahan+'">\
                                        <input type="hidden" name="m_barang_id'+idTabel+'[]" value="'+data.val[i].kode+'"/>\
                                        '+data.val[i].barang_nama+'\
                                    </td>\
                                    <td id="td3'+idx+'-'+jmlBahan+'">\
                                        <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_ukuran'+(i+1)+'" name="perhitungan_kebutuhandet_ukuran'+idTabel+'[]" value="0" required/>\
                                    </td>\
                                    <td id="td4'+idx+'-'+jmlBahan+'">\
                                        <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_lebar'+(i+1)+'" name="perhitungan_kebutuhandet_lebar'+idTabel+'[]" value="0" required/>\
                                    </td>\
                                    <td id="td5'+idx+'-'+jmlBahan+'">\
                                        <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_slitingan'+(i+1)+'" name="perhitungan_kebutuhandet_slitingan'+idTabel+'[]" value="0" required/>\
                                    </td>\
                                    <td id="td6'+idx+'-'+jmlBahan+'">\
                                        <textarea class="form-control" rows="3" name="perhitungan_kebutuhandet_keterangan'+idTabel+'[]"></textarea>\
                                    </td>\
                                </tr>\
                            ');
                            jmlBahan++;
                            document.getElementById('jml_bahan'+idTabel).value = jmlBahan;
                            $(".decimal").keydown(function(event) {
                            // Allow: backspace, delete, tab, escape, enter and .
                            if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                 // Allow: Ctrl+A, Command+A
                                (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                                 // Allow: home, end, left, right, down, up
                                (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {
                                     // let it happen, don't do anything
                                     return;
                            }
                            // Ensure that it is a number and stop the keypress
                            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                                event.preventDefault();
                            }
                            });  
                        }
                    }
                });
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Perhitungan-Kebutuhan-Bahan/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("perhitungan_kebutuhan_nomor")[0].value = data.val[i].perhitungan_kebutuhan_nomor;
                      document.getElementsByName("perhitungan_kebutuhan_tanggal")[0].value = data.val[i].perhitungan_kebutuhan_tanggal;
                      document.getElementsByName("perhitungan_kebutuhan_status")[0].value = data.val[i].perhitungan_kebutuhan_status;
                      document.getElementsByName("status_awal")[0].value = data.val[i].perhitungan_kebutuhan_status;
                      // document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      if(data.val[i].perhitungan_kebutuhan_jenis == 1)
                      {
                        document.getElementById("perhitungan_kebutuhan_jenis1").checked = true;
                        $("#produksi").attr("hidden", false);
                        var id = JSON.parse(data.val[i].t_jadwal_produksi_id);
                        // alert(id);
                        for(var j=0; j<id.length; j++){
                          // $("#t_jadwal_produksi_id").append('<option value="'+data.val[i].t_jadwal_produksi_id.val2[j].id+'" selected>'+data.val[i].t_jadwal_produksi_id.val2[j].text+'</option>');
                          getDetailJadwal2(id[j]);
                          // alert(id[j]);
                        }
                        $("#t_jadwal_produksi_id").select2();
                        document.getElementsByName('t_jadwal_produksi_id')[0].disabled = true;
                      }
                      else
                      {
                        document.getElementById("perhitungan_kebutuhan_jenis2").checked = true;
                      }
                      // document.getElementById('submit'). disabled = true;
                      if(data.val[i].m_gudang_id.val2 != '')
                      {
                          $("#m_gudang_id").empty();
                          $("#m_gudang_id").append('<option value="'+data.val[i].m_gudang_id.val2[i].id+'" selected>'+data.val[i].m_gudang_id.val2[i].text+'</option>');
                          $("#m_gudang_id").select2();
                      }
                      if(data.val[i].perhitungan_kebutuhan_status == 3)
                      {
                        document.getElementById('persetujuan').checked = true;
                      }
                      else
                      {
                        document.getElementById('persetujuan').checked = false;
                      }
                    }
                    if(document.getElementById("perhitungan_kebutuhan_jenis2").checked)
                    {
                        itemOption = 1;
                        idBarang = [];
                        document.getElementsByName('jml_itemBarang').value = itemOption;
                        for(var j = 0; j <data.val2.length; j++)
                        {
                            if(j == 0)
                            {
                                idBarang.push(data.val2[j].barang_jadi_id.val2.id);
                                defaultValue();
                                $("#barang_id"+itemOption).empty();
                                $("#barang_id"+itemOption).append('<option value="'+data.val2[j].barang_jadi_id.val2.id+'" selected>'+data.val2[i].barang_jadi_id.val2.text+'</option>');
                                $("#barang_id"+itemOption).select2();
                                jmlBahan = document.getElementById('jml_bahan'+itemOption).value;
                                document.getElementById('satuan_nama'+itemOption).value = data.val2[j].satuan_nama;
                                getDetailPerhitungan2(data.val2[j].perhitungan_kebutuhandet_id, jmlBahan, itemOption);
                                document.getElementById('jadwal_produksi_qty'+itemOption).value = data.val2[j].perhitungan_kebutuhandet_qty;
                                document.getElementById('perhitungan_kebutuhandet_berat'+itemOption).value = data.val2[j].perhitungan_kebutuhandet_berat;
                                document.getElementById('perhitungan_kebutuhandet_total'+itemOption).value = data.val2[j].perhitungan_kebutuhandet_total;
                            }
                            else
                            {
                                if(jQuery.inArray(data.val2[j].barang_jadi_id.val2.id, idBarang) !== -1)
                                {
                                    jmlBahan = document.getElementById('jml_bahan'+itemOption).value;
                                    getDetailPerhitungan2(data.val2[j].perhitungan_kebutuhandet_id, jmlBahan, itemOption);
                                }
                                else
                                {
                                    idBarang.push(data.val2[j].barang_jadi_id.val2.id);
                                    addBarang();
                                    jmlBahan = document.getElementById('jml_bahan'+itemOption).value;
                                    getDetailPerhitungan2(data.val2[j].perhitungan_kebutuhandet_id, jmlBahan, itemOption);
                                    // addBahan2(itemOption, data.val2[j].m_barang_id);
                                    $("#barang_id"+itemOption).empty();
                                    $("#barang_id"+itemOption).append('<option value="'+data.val2[j].barang_jadi_id.val2.id+'" selected>'+data.val2[i].barang_jadi_id.val2.text+'</option>');
                                    $("#barang_id"+itemOption).select2();
                                    document.getElementById('satuan_nama'+itemOption).value = data.val2[j].satuan_nama;
                                    document.getElementById('jadwal_produksi_qty'+itemOption).value = data.val2[j].perhitungan_kebutuhandet_qty ;
                                    document.getElementById('perhitungan_kebutuhandet_berat'+itemOption).value = data.val2[j].perhitungan_kebutuhandet_berat;
                                    document.getElementById('perhitungan_kebutuhandet_total'+itemOption).value = data.val2[j].perhitungan_kebutuhandet_total;
                                //     
                                }
                            }
                            document.getElementById('m_barang_id'+itemOption).disabled = true;
                            jmlBahan++;
                            document.getElementById('jml_bahan' +itemOption).value = jmlBahan;
                        }
                        
                    }
                    
                    $("#KodePerhitungan").attr('hidden', false);
                  
                  }
                });
            }

            function getDetailJadwal2(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Jadwal-Produksi/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    var idJadwal;
                    for(var i=0; i<data.val.length;i++){
                        idJadwal = data.val[i].kode;
                        // alert(idJadwal+' JP');
                      // document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      // document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis;
                      $("#detailJadwal").append('<div class="form-group">\
                            <label class="control-label col-md-4">Shift\
                                <span class="required"> * </span>\
                            </label>\
                            <div class="col-md-8">\
                                <div class="input-icon right">\
                                    <i class="fa"></i>\
                                    <input type="text" class="form-control num" name="jadwal_produksi_shift[]" value="'+data.val[i].jadwal_produksi_shift+'" required readonly /> </div>\
                            </div>\
                        </div>\
                        <div class="form-group">\
                            <label class="control-label col-md-4">Jenis Produksi\
                                <span class="required"> * </span>\
                            </label>\
                            <div class="col-md-8">\
                                <div class="input-icon right">\
                                    <i class="fa"></i>\
                                    <input type="text" class="form-control" name="jadwal_produksi_jenis[]" value="'+data.val[i].jadwal_produksi_jenis.val2[i].text+'" required readonly /> </div>\
                            </div>\
                        </div>');
                    }
                    for(var i = 0; i < data.val3.length; i++){
                        var idx = idTabel+"_"+(i+1);
                        $("#detailJadwal").append('\
                            <div id="detailJadwal'+(i+1)+'">\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Nama Barang\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="hidden" name="jadwal_produksidet_id[]" value="'+data.val3[i].jadwal_produksi_akhirdet_id+'" required readonly /> \
                                        <input type="hidden" name="jml_bahan[]" id="jml_bahan'+idTabel+'" value="1" required readonly /> \
                                        <input type="text" class="form-control num" name="barang_nama[]" value="'+data.val3[i].barang_nama+'" required readonly /> </div>\
                                </div>\
                                <label class="control-label col-md-3">Satuan Barang\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="satuan_nama[]" value="'+data.val3[i].satuan_nama+'" required readonly /> </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Jumlah Produksi\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="jadwal_produksi_qty[]" value="'+data.val3[i].jadwal_produksi_akhirdet_total+'" id="jadwal_produksi_qty'+idTabel+'" required readonly />\
                                     </div>\
                                </div>\
                                <label class="control-label col-md-3">Berat\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="perhitungan_kebutuhandet_berat[]" value="0" id="perhitungan_kebutuhandet_berat'+idTabel+'" required readonly /> </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Total\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="perhitungan_kebutuhandet_total[]" value="0" id="perhitungan_kebutuhandet_total'+idTabel+'" required readonly />\
                                     </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Nama Bahan\
                                </label>\
                                <div class="col-md-8">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <select class="form-control" id="m_barang_id'+idTabel+'_'+(i+1)+'" aria-required="true" aria-describedby="select-error">\
                                        </select>\
                                    </div>\
                                </div>\
                                <div class="col-md-1">\
                                    <button type="button" id="btnAddBahan" class="btn sbold dark" disabled="disabled" onclick="addBahan(\''+idx+'\','+idJadwal+','+idTabel+')">\
                                    <i class="icon-plus"></i></button>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <div class="col-md-12">\
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table'+idTabel+'_'+(i+1)+'">\
                                        <thead>\
                                            <tr>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> No </th>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> Nama Bahan </th>\
                                                <th class="text-center" colspan="3" style="vertical-align: middle;"> Bahan Coil </th>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> Keterangan </th>\
                                            </tr>\
                                            <tr>\
                                                <th class="text-center" style="vertical-align: middle;"> Ukuran Coil (BMT) </th>\
                                                <th class="text-center" style="vertical-align: middle;"> Lebar Coil (m) </th>\
                                                <th class="text-center" style="vertical-align: middle;"> Slittingan (mm) </th>\
                                            </tr>\
                                        </thead>\
                                        <tbody id="tableTbody'+idTabel+'_'+(i+1)+'">\
                                        </tbody>\
                                    </table>\
                                </div>\
                            </div>\
                            </div>\
                            <hr>\
                        ');
                        // alert('abc');
                        selectList_jadwalProduksiBahanAwal("#m_barang_id"+idTabel+"_"+(i+1), idJadwal);
                        getDetailPerhitungan(document.getElementsByName("kode")[0].value, data.val3[i].jadwal_produksi_akhirdet_id, (i+1), idTabel);
                        idTabel++;
                        

                        $(".num").keydown(function(event) {
                        // Allow: backspace, delete, tab, escape, enter and .
                        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                             // Allow: Ctrl+A, Command+A
                            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                             // Allow: home, end, left, right, down, up
                            (event.keyCode >= 35 && event.keyCode <= 40)) {
                                 // let it happen, don't do anything
                                 return;
                        }
                        // Ensure that it is a number and stop the keypress
                        if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                            event.preventDefault();
                        }
                        });
                        $(".decimal").keydown(function(event) {
                        // Allow: backspace, delete, tab, escape, enter and .
                        if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                             // Allow: Ctrl+A, Command+A
                            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                             // Allow: home, end, left, right, down, up
                            (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {
                                 // let it happen, don't do anything
                                 return;
                        }
                        // Ensure that it is a number and stop the keypress
                        if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                            event.preventDefault();
                        }
                        });
                    }
                  }
                });
            }

            function getDetailPerhitungan(id, id_jadwal, idx, idTabel) {
                // alert(id);
                // alert(id_jadwal);
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Perhitungan-Kebutuhan-Bahan/loadDataDetailWhere/',
                  data : { id : id, id_jadwal : id_jadwal },
                  dataType : "json",
                  success:function(data){
                    // alert('masuk');
                    for(var i = 0; i < data.val2.length; i++){
                        document.getElementById('perhitungan_kebutuhandet_berat'+idTabel).value = data.val2[i].perhitungan_kebutuhandet_berat;
                        document.getElementById('perhitungan_kebutuhandet_total'+idTabel).value = data.val2[i].perhitungan_kebutuhandet_total;
                        $("#default-table"+idTabel+'_'+idx+" tbody").append('\
                            <tr id="detail'+idx+'-'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+idx+'-'+(i+1)+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    '+data.val2[i].barang_nama+'\
                                </td>\
                                <td id="td2'+idx+'-'+(i+1)+'">\
                                    <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_ukuran'+(i+1)+'" name="perhitungan_kebutuhandet_ukuran[]" value="'+data.val2[i].perhitungan_kebutuhandet_ukuran+'" readonly required/>\
                                </td>\
                                <td id="td3'+idx+'-'+(i+1)+'">\
                                    <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_lebar'+(i+1)+'" name="perhitungan_kebutuhandet_lebar[]" value="'+data.val2[i].perhitungan_kebutuhandet_lebar+'" readonly required/>\
                                </td>\
                                <td id="td4'+idx+'-'+(i+1)+'">\
                                    <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_slitingan'+(i+1)+'" name="perhitungan_kebutuhandet_slitingan[]" value="'+data.val2[i].perhitungan_kebutuhandet_slitingan+'" readonly required/>\
                                </td>\
                                <td id="td5'+idx+'-'+(i+1)+'">\
                                    <textarea class="form-control" rows="3" name="perhitungan_kebutuhandet_keterangan[]" readonly>'+data.val2[i].perhitungan_kebutuhandet_keterangan+'</textarea>\
                                </td>\
                            </tr>\
                        ');   
                    }
                  }
              });
            }
            function getDetailPerhitungan2(id, idx, idTabel) {
                // alert(id);
                // alert(id_jadwal);
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Perhitungan-Kebutuhan-Bahan/loadDataDetailSatuan/',
                  data : { id : id},
                  dataType : "json",
                  success:function(data){
                    // alert('masuk');
                    for(var i = 0; i < data.val2.length; i++){
                        document.getElementById('perhitungan_kebutuhandet_berat'+idTabel).value = data.val2[i].perhitungan_kebutuhandet_berat;
                        document.getElementById('perhitungan_kebutuhandet_total'+idTabel).value = data.val2[i].perhitungan_kebutuhandet_total;
                        $("#default-table"+idTabel+" tbody").append('\
                            <tr id="detail'+idx+'-'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+idx+'\
                                </td>\
                                <td id="td1'+idx+'-'+(i+1)+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    '+data.val2[i].barang_nama+'\
                                </td>\
                                <td id="td2'+idx+'-'+(i+1)+'">\
                                    <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_ukuran'+(i+1)+'" name="perhitungan_kebutuhandet_ukuran[]" value="'+data.val2[i].perhitungan_kebutuhandet_ukuran+'" readonly required/>\
                                </td>\
                                <td id="td3'+idx+'-'+(i+1)+'">\
                                    <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_lebar'+(i+1)+'" name="perhitungan_kebutuhandet_lebar[]" value="'+data.val2[i].perhitungan_kebutuhandet_lebar+'" readonly required/>\
                                </td>\
                                <td id="td4'+idx+'-'+(i+1)+'">\
                                    <input type="text" class="form-control decimal" id="perhitungan_kebutuhandet_slitingan'+(i+1)+'" name="perhitungan_kebutuhandet_slitingan[]" value="'+data.val2[i].perhitungan_kebutuhandet_slitingan+'" readonly required/>\
                                </td>\
                                <td id="td5'+idx+'-'+(i+1)+'">\
                                    <textarea class="form-control" rows="3" name="perhitungan_kebutuhandet_keterangan[]" readonly>'+data.val2[i].perhitungan_kebutuhandet_keterangan+'</textarea>\
                                </td>\
                            </tr>\
                        ');   
                    }
                  }
              });
            }
            function defaultValue()
            {
                 $("#default_value").empty();
                 itemOption = parseInt($("#jml_itemOption").val());
                 // alert(itemOption);
                 $("#default-value").append('\
                    <div class="form-group">\
                        <label class="control-label col-md-3">Nama Barang\
                            <span class="required"> * </span>\
                        </label>\
                        <div class="col-md-3">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <input type="hidden" name="jml_bahan[]" id="jml_bahan'+itemOption+'" value="1" required readonly /> \
                                <select class="form-control" name="barang_id[]" id="barang_id'+itemOption+'" required onchange="ambilSatuan(this, '+itemOption+')"> </select> </div>\
                        </div>\
                        <label class="control-label col-md-3">Satuan Barang\
                            <span class="required"> * </span>\
                        </label>\
                        <div class="col-md-3">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <input type="text" class="form-control" name="satuan_nama[]" id="satuan_nama'+itemOption+'" value="" required readonly /> </div>\
                        </div>\
                    </div>\
                    <div class="form-group">\
                                <label class="control-label col-md-3">Jumlah Produksi\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="jadwal_produksi_qty[]" value="0" id="jadwal_produksi_qty'+itemOption+'" onchange="total('+itemOption+')" required readonly/>\
                                     </div>\
                                </div>\
                                <label class="control-label col-md-3">Berat\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="perhitungan_kebutuhandet_berat[]" value="0" id="perhitungan_kebutuhandet_berat'+itemOption+'" onchange="total('+itemOption+')" required readonly/> </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Total\
                                    <span class="required"> * </span>\
                                </label>\
                                <div class="col-md-3">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <input type="text" class="form-control num" name="perhitungan_kebutuhandet_total[]" value="0" id="perhitungan_kebutuhandet_total'+itemOption+'" required readonly/>\
                                     </div>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <label class="control-label col-md-3">Nama Bahan\
                                </label>\
                                <div class="col-md-8">\
                                    <div class="input-icon right">\
                                        <i class="fa"></i>\
                                        <select class="form-control" id="m_barang_id'+itemOption+'" aria-required="true" aria-describedby="select-error">\
                                        </select>\
                                    </div>\
                                </div>\
                                <div class="col-md-1">\
                                    <button type="button" id="btnAddBahan" class="btn sbold dark" disabled="disabled" onclick="addBahan2('+itemOption+')">\
                                    <i class="icon-plus"></i></button>\
                                </div>\
                            </div>\
                            <div class="form-group">\
                                <div class="col-md-12">\
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table'+itemOption+'">\
                                        <thead>\
                                            <tr>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> No </th>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> Nama Bahan </th>\
                                                <th class="text-center" colspan="3" style="vertical-align: middle;"> Bahan Coil </th>\
                                                <th class="text-center" rowspan="2" style="vertical-align: middle;"> Keterangan </th>\
                                            </tr>\
                                            <tr>\
                                                <th class="text-center" style="vertical-align: middle;"> Ukuran Coil (BMT) </th>\
                                                <th class="text-center" style="vertical-align: middle;"> Lebar Coil (m) </th>\
                                                <th class="text-center" style="vertical-align: middle;"> Slittingan (mm) </th>\
                                            </tr>\
                                        </thead>\
                                        <tbody id="tableTbody'+itemOption+'">\
                                        </tbody>\
                                    </table>\
                                </div>\
                            </div>\
                            </div>\
                            <hr>\
                ');
            selectList_barang2("#barang_id"+itemOption);
            selectList_barang2("#m_barang_id"+itemOption);

            }
            function addBarang() {
                itemOption++;
                $("#jml_itemOption").val(itemOption);
                $('#default-value2').append('\
                    <div id="barang_'+itemOption+'">\
                    <div class="form-group">\
                            <label class="control-label col-md-3">Nama Barang\
                                <span class="required"> * </span>\
                            </label>\
                            <div class="col-md-3">\
                                <div class="input-icon right">\
                                    <i class="fa"></i>\
                                    <input type="hidden" name="jml_bahan[]" id="jml_bahan'+itemOption+'" value="1" required readonly /> \
                                    <select class="form-control" name="barang_id[]" id="barang_id'+itemOption+'" required onchange="ambilSatuan(this, '+itemOption+')"> </select> </div>\
                            </div>\
                            <label class="control-label col-md-3">Satuan Barang\
                                <span class="required"> * </span>\
                            </label>\
                            <div class="col-md-3">\
                                <div class="input-icon right">\
                                    <i class="fa"></i>\
                                    <input type="text" class="form-control" name="satuan_nama[]" id="satuan_nama'+itemOption+'" value="" required readonly /> </div>\
                            </div>\
                        </div>\
                        <div class="form-group">\
                                    <label class="control-label col-md-3">Jumlah Produksi\
                                        <span class="required"> * </span>\
                                    </label>\
                                    <div class="col-md-3">\
                                        <div class="input-icon right">\
                                            <i class="fa"></i>\
                                            <input type="text" class="form-control num" name="jadwal_produksi_qty[]" value="0" id="jadwal_produksi_qty'+itemOption+'" onchange="total('+itemOption+')" required readonly/>\
                                         </div>\
                                    </div>\
                                    <label class="control-label col-md-3">Berat\
                                        <span class="required"> * </span>\
                                    </label>\
                                    <div class="col-md-3">\
                                        <div class="input-icon right">\
                                            <i class="fa"></i>\
                                            <input type="text" class="form-control num" name="perhitungan_kebutuhandet_berat[]" value="0" id="perhitungan_kebutuhandet_berat'+itemOption+'" onchange="total('+itemOption+')" required readonly/> </div>\
                                    </div>\
                                </div>\
                                <div class="form-group">\
                                    <label class="control-label col-md-3">Total\
                                        <span class="required"> * </span>\
                                    </label>\
                                    <div class="col-md-3">\
                                        <div class="input-icon right">\
                                            <i class="fa"></i>\
                                            <input type="text" class="form-control num" name="perhitungan_kebutuhandet_total[]" value="0" id="perhitungan_kebutuhandet_total'+itemOption+'" required readonly/>\
                                         </div>\
                                    </div>\
                                </div>\
                                <div class="form-group">\
                                    <label class="control-label col-md-3">Nama Bahan\
                                    </label>\
                                    <div class="col-md-8">\
                                        <div class="input-icon right">\
                                            <i class="fa"></i>\
                                            <select class="form-control" id="m_barang_id'+itemOption+'" aria-required="true" aria-describedby="select-error">\
                                            </select>\
                                        </div>\
                                    </div>\
                                    <div class="col-md-1">\
                                        <button type="button" id="btnAddBahan" class="btn sbold dark" disabled="disabled" onclick="addBahan2('+itemOption+')">\
                                        <i class="icon-plus"></i></button>\
                                    </div>\
                                </div>\
                                <div class="form-group">\
                                    <div class="col-md-12">\
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table'+itemOption+'">\
                                            <thead>\
                                                <tr>\
                                                    <th class="text-center" rowspan="2" style="vertical-align: middle;"> No </th>\
                                                    <th class="text-center" rowspan="2" style="vertical-align: middle;"> Nama Bahan </th>\
                                                    <th class="text-center" colspan="3" style="vertical-align: middle;"> Bahan Coil </th>\
                                                    <th class="text-center" rowspan="2" style="vertical-align: middle;"> Keterangan </th>\
                                                </tr>\
                                                <tr>\
                                                    <th class="text-center" style="vertical-align: middle;"> Ukuran Coil (BMT) </th>\
                                                    <th class="text-center" style="vertical-align: middle;"> Lebar Coil (m) </th>\
                                                    <th class="text-center" style="vertical-align: middle;"> Slittingan (mm) </th>\
                                                </tr>\
                                            </thead>\
                                            <tbody id="tableTbody'+itemOption+'">\
                                            </tbody>\
                                        </table>\
                                    </div>\
                                </div>\
                                </div>\
                                <hr>\
                    </div>\
                ');
                selectList_barang2("#barang_id"+itemOption);
                selectList_barang2("#m_barang_id"+itemOption);
            }
            // function ambilSatuan(elemen, itemOption)
            // {
            //     var id = elemen.value;
            //     $.ajax({
            //       type : "GET",
            //       url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
            //       data : "id="+id,
            //       dataType : "json",
            //       success:function(data){
            //         for (var i = 0 ; i < data.val.length; i++) {
            //             // alert(data.val[i].m_satuan_id.val2[i].text);
            //             document.getElementById('satuan_nama'+itemOption).value = data.val[i].m_satuan_id.val2[i].text;
            //         }
            //       }
            //   });
            // }

            // function addBahan2(itemOption) {
            //     var id = document.getElementById('m_barang_id'+itemOption+'')[0].value;
            //     if (id.length > 0) {
            //         getDetailBahan(id, itemOption, itemOption);
            //     }
            // }

            function checkPersetujuan() {
                if (document.getElementById("persetujuan").checked == true) {
                    document.getElementsByName("perhitungan_kebutuhan_status")[0].value = 3;
                } else {
                    var idGudang = document.getElementById('m_gudang_id').value;
                    if(idGudang == '')
                    {
                        document.getElementsByName("perhitungan_kebutuhan_status")[0].value = 1;
                    }
                    else
                    {
                        document.getElementsByName("perhitungan_kebutuhan_status")[0].value = 2;
                    }
                }
            }
        </script>

    </body>

</html>