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
                                        <input type="hidden" id="url" value="Produksi/Serah-Terima/postData/">
                                        <input type="hidden" id="url_data" value="Produksi/Serah-Terima">
                                        <input type="hidden" name="serah_terima_status" value="0">
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID Serah Terima (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="KodeST">
                                            <label class="control-label col-md-4">Kode Serah Terima (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="serah_terima_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Pengubahan Bahan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="t_perolehan_produksi_id" id="t_perolehan_produksi_id" onchange="getJadwal()" required /> </select></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Dari Bagian
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="m_gudang_id_produksi" id="m_gudang_id_produksi" readonly required /> </select></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Dari Shift
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <!-- <input type="text" class="form-control" name="serah_terima_darishift" id="serah_terima_darishift" required /> -->
                                                    <select class="form-control select2" name="serah_terima_darishift" id="serah_terima_darishift" required>
                                                        <option value="1" id="darishift1">1</option>
                                                        <option value="2" id="darishift2">2</option>
                                                        <option value="3" id="darishift3">1 dan 2</option>
                                                    </select></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Ke Bagian
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="m_gudang_id_tujuan" id="m_gudang_id_tujuan" readonly required /> </select></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Ke Shift
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <!-- <input type="text" class="form-control" name="serah_terima_keshift" id="serah_terima_keshift" required /> -->
                                                    <select class="form-control select2" name="serah_terima_keshift" id="serah_terima_keshift" aria-required="true" aria-describedby="select-error" required>
                                                        <option value="1" id="keshift1">1</option>
                                                        <option value="2" id="keshift2">2</option>
                                                        <option value="3" id="keshift3">1 dan 2</option>
                                                    </select></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="t_pengubahan_bahan_id" id="t_pengubahan_bahan_id"/>
                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                <table class="table table-striped table-bordered table-hover" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th valign="center"> No </th>
                                                            <th style="text-align: center;"> Kode Barang </th>
                                                            <th style="text-align: center;"> Nama Barang </th>
                                                            <th style="text-align: center;"> Kode Produksi </th>
                                                            <th style="text-align: center;"> Berat (kg) </th>
                                                            <th style="text-align: center;"> Panjang (m) </th>
                                                            <th style="text-align: center;"> Tebal (mm) </th>
                                                            <th style="text-align: center;"> Unit </th>
                                                            <th style="text-align: center;"> Satuan </th>
                                                            <th style="text-align: center;"> Keterangan </th>
                                                            <th valign="center"> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Produksi/Serah-Terima">
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
                $('#t_perolehan_produksi_id').css('width', '100%');
                // $('#t_jadwal_produksi_id').css('width', '100%');
                // $('#m_barang_id').css('width', '100%');
                // $('#m_barang_id2').css('width', '100%');
                selectList_pengubahanBahan("#t_perolehan_produksi_id");
                // selectList_barang2("#m_barang_id");
                // selectList_barang2("#m_barang_id2");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function getJadwal()
            {
                var idPerhitungan = document.getElementById("t_perolehan_produksi_id").value;
                var nomorProduksi = '';
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Pengubahan-Bahan/loadDataWhere/',
                  data : "id="+idPerhitungan,
                  dataType : "json",
                  success:function(data){
                    for(var i =0; i< data.val.length; i++)
                    {
                        idProduksi = data.val[i].kode;
                        document.getElementById('t_pengubahan_bahan_id').value = idProduksi;
                        nomorProduksi = data.val[i].pengubahan_bahan_nomor;
                    }
                    $("#m_gudang_id_tujuan").append('<option value="'+data.val3[0].pengubahan_bahanakhir_gudang_id+'" selected>'+data.val3[0].pengubahan_bahanakhir_gudang_nama+'</option>');
                    // alert(nomorProduksi);
                    for(var i = 0; i < data.val3.length; i++)
                    {
                        
                        // $("#m_gudang_id_tujuan").select2();
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="barang_id[]" value="'+data.val3[i].barang_id+'"/>\
                                    <input type="hidden" name="t_pengubahan_bahan_akhir_id[]" value="'+data.val3[i].pengubahan_bahanakhir_id+'"/>\
                                    '+data.val3[i].barang_kode+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    '+data.val3[i].barang_nama+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    '+nomorProduksi+'\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    '+data.val3[i].perolehan_produksi_akhirdet.val2[0].perolehan_produksi_akhirdet_berat+'\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    '+data.val3[i].perolehan_produksi_akhirdet.val2[0].perolehan_produksi_akhirdet_panjang+'\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    '+data.val3[i].perolehan_produksi_akhirdet.val2[0].perolehan_produksi_akhirdet_tebal+'\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    '+data.val3[i].pengubahan_bahanakhir_qty+' \
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    '+data.val3[i].satuan_nama+'\
                                </td>\
                                <td id="td9'+(i+1)+'">\
                                    <textarea class="form-control" name="serah_terimadet_keterangan[]" id="serah_terimadet_keterangan'+(i+1)+'"></textarea>\
                                </td>\
                                <td id="td10'+(i+1)+'">\
                                    <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" onclick="removeDetail('+(i+1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');
                        
                    }
                    itemBarang = data.val2.length;
                    for(var k = 0; k < data.val2.length; k++){
                        // alert('ulang');
                        $("#m_gudang_id_produksi").append('<option value="'+data.val2[k].pengubahan_bahanawal_gudang_id+'" selected>'+data.val2[k].pengubahan_bahanawal_gudang_nama+'</option>');
                        // $.ajax({
                        //   type : "GET",
                        //   url  : '<?php echo base_url();?>Produksi/Perhitungan-Kebutuhan-Bahan/loadDataWhere2/',
                        //   data : "id="+data.val2[k].jadwal_produksi_id,
                        //   dataType : "json",
                        //   success:function(data2){
                        //     for(var j = 0; j < data2.val.length; j++)
                        //     {
                        //         $("#m_gudang_id_produksi").append('<option value="'+data2.val[j].m_gudang_id.val2[j].id+'" selected>'+data2.val[j].m_gudang_id.val2[j].text+'</option>')
                        //         // $("#m_gudang_id_produksi").select2();
                        //     }
                        //         // $("#m_barang_id2").append('<option value="'+data.val2[i].m_barang_id+'">'+data.val2[i].barang_nama+'</option>')
                             
                        //   }   // $("#m_barang_id2").select2();
                        // });
                        
                    }
                    // for(var i = 0; i < data.val2.length; i++)
                    // {
                    //     $("#m_barang_id").append('<option value="'+data.val2[i].m_barang_id+'">'+data.val2[i].barang_nama+'</option>')
                    //     $("#m_barang_id").select2();
                    // }
                  }
                });
            }

            function addBahanAwal() {
                var id = document.getElementsByName('t_perhitungan_kebutuhan_id')[0].value;
                var barang_id = document.getElementsByName('m_barang_id')[0].value;
                if (id.length > 0) {
                    getDetailBahanAwal(id, barang_id);
                }
            }

            function addBahanHasil() {
                var id = document.getElementsByName('t_jadwal_produksi_id')[0].value;
                var barang_id = document.getElementsByName('m_barang_id2')[0].value;
                if (id.length > 0) {
                    getDetailBahanHasil(id, barang_id);
                }
            }

            function removeDetail(itemSeq) {
                var parent = document.getElementById("tableTbody");
                for (var i = 1; i <= itemBarang; i++) {
                  if (i >= itemSeq && i < itemBarang) {
                    document.getElementById("td1"+i).innerHTML = document.getElementById("td1"+(i+1)).innerHTML;
                    document.getElementById("td2"+i).innerHTML = document.getElementById("td2"+(i+1)).innerHTML;
                    document.getElementById("td3"+i).innerHTML = document.getElementById("td3"+(i+1)).innerHTML;
                    document.getElementById("td4"+i).innerHTML = document.getElementById("td4"+(i+1)).innerHTML;
                    document.getElementById("td5"+i).innerHTML = document.getElementById("td5"+(i+1)).innerHTML;
                    document.getElementById("td6"+i).innerHTML = document.getElementById("td6"+(i+1)).innerHTML;
                    document.getElementById("td7"+i).innerHTML = document.getElementById("td7"+(i+1)).innerHTML;
                    document.getElementById("td8"+i).innerHTML = document.getElementById("td8"+(i+1)).innerHTML;
                    document.getElementById("td9"+i).innerHTML = document.getElementById("td9"+(i+1)).innerHTML;
                    document.getElementById("td10"+i).innerHTML = document.getElementById("td10"+(i+1)).innerHTML;
                  };
                };
                for (var i = 1; i <= itemBarang; i++) {
                  if (i==itemBarang) {
                    var child = document.getElementById("detail"+i);
                    parent.removeChild(child);
                  };
                };
                itemBarang--;
                $("#jml_itemBarang").val(itemBarang);
            }

            // function removeDetailHasil(itemSeq) {
            //     var parent = document.getElementById("tableTbodyHasil");
            //     for (var i = 1; i <= itemHasil; i++) {
            //       if (i >= itemSeq && i < itemHasil) {
            //         document.getElementById("td1"+i).innerHTML = document.getElementById("td1"+(i+1)).innerHTML;
            //         document.getElementById("td2"+i).innerHTML = document.getElementById("td2"+(i+1)).innerHTML;
            //         document.getElementById("td3"+i).innerHTML = document.getElementById("td3"+(i+1)).innerHTML;
            //         document.getElementById("td4"+i).innerHTML = document.getElementById("td4"+(i+1)).innerHTML;
            //         document.getElementById("td5"+i).innerHTML = document.getElementById("td5"+(i+1)).innerHTML;
            //         document.getElementById("td6"+i).innerHTML = document.getElementById("td6"+(i+1)).innerHTML;
            //       };
            //     };
            //     for (var i = 1; i <= itemHasil; i++) {
            //       if (i==itemHasil) {
            //         var child = document.getElementById("detail_hasil"+i);
            //         parent.removeChild(child);
            //       };
            //     };
            //     itemHasil--;
            //     $("#jml_itemHasil").val(itemHasil);
            // }

            // function getDetailBahanAwal(id, barang_id) {
            //     $.ajax({
            //       type : "GET",
            //       url  : '<?php echo base_url();?>Produksi/Perhitungan-Kebutuhan-Bahan/loadDataDetailSatuan/',
            //       data : {id: id, barang_id: barang_id},
            //       dataType : "json",
            //       success:function(data){
            //         // $("#default-table tbody").empty();
            //             // alert("masuk awal");
            //             itemAwal++;
            //             for(var i = 0; i < data.val2.length; i++){
            //                 $("#default-table tbody").append('\
            //                     <tr id="detail_awal'+itemAwal+'">\
            //                         <td id="td0'+itemAwal+'">\
            //                             '+itemAwal+'\
            //                         </td>\
            //                         <td id="td1'+itemAwal+'">\
            //                             <input type="hidden" name="barang_id_awal[]" value="'+data.val2[i].m_barang_id+'"/>\
            //                             '+data.val2[i].barang_kode+'\
            //                         </td>\
            //                         <td id="td2'+itemAwal+'">\
            //                             <input type="text" class="form-control num" id="deskripsi_awal'+itemAwal+'" name="deskripsi_awal[]" value="'+data.val2[i].barang_uraian+'" required/>\
            //                         </td>\
            //                         <td id="td3'+itemAwal+'">\
            //                             <input type="text" class="form-control num" id="pengubahan_bahanawal_qty'+itemAwal+'" name="pengubahan_bahanawal_qty[]" value="" required/>\
            //                         </td>\
            //                         <td id="td4'+itemAwal+'">\
            //                             '+data.val2[i].satuan_nama+'\
            //                         </td>\
            //                         <td id="td5'+itemAwal+'">\
            //                             <input type="hidden" class="form-control" name="pengubahan_bahanawal_gudang[]" id="pengubahan_bahanawal_gudang'+itemAwal+'" value="'+data.val2[i].m_gudang_id.val2[i].id+'">\
            //                             '+data.val2[i].m_gudang_id.val2[i].text+'\
            //                         </td>\
            //                         <td id="td6'+itemAwal+'">\
            //                             <button type="button" id="removeBtn'+itemAwal+'" class="btn red-thunderbird" onclick="removeDetailAwal('+itemAwal+')">\
            //                                 <i class="icon-close"></i>\
            //                             </button>\
            //                         </td>\
            //                     </tr>\
            //                 ');   
            //                 // $(".num").keydown(function(event) {
            //                 // // Allow: backspace, delete, tab, escape, enter and .
            //                 // if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            //                 //      // Allow: Ctrl+A, Command+A
            //                 //     (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
            //                 //      // Allow: home, end, left, right, down, up
            //                 //     (event.keyCode >= 35 && event.keyCode <= 40)) {
            //                 //          // let it happen, don't do anything
            //                 //          return;
            //                 // }
            //                 // // Ensure that it is a number and stop the keypress
            //                 // if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
            //                 //     event.preventDefault();
            //                 // }
            //                 // });
            //                 // $(".decimal").keydown(function(event) {
            //                 // // Allow: backspace, delete, tab, escape, enter and .
            //                 // if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            //                 //      // Allow: Ctrl+A, Command+A
            //                 //     (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
            //                 //      // Allow: home, end, left, right, down, up
            //                 //     (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {
            //                 //          // let it happen, don't do anything
            //                 //          return;
            //                 // }
            //                 // // Ensure that it is a number and stop the keypress
            //                 // if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
            //                 //     event.preventDefault();
            //                 // }
            //                 // });
            //             }
            //         $("#jml_itemAwal").val(itemAwal);
            //       }
            //     });
            // }

            // function getDetailBahanHasil(id, barang_id) {
            //     $.ajax({
            //       type : "GET",
            //       url  : '<?php echo base_url();?>Produksi/Jadwal-Produksi/loadDataDetailSatuan/',
            //       data : {id: id, barang_id: barang_id},
            //       dataType : "json",
            //       success:function(data){
            //         // $("#default-table tbody").empty();
            //             // alert("masuk awal");
            //             itemHasil++;
            //             for(var i = 0; i < data.val2.length; i++){
            //                 $("#default-table2 tbody").append('\
            //                     <tr id="detail_hasil'+itemHasil+'">\
            //                         <td id="td0'+itemHasil+'">\
            //                             '+itemHasil+'\
            //                         </td>\
            //                         <td id="td1'+itemHasil+'">\
            //                             <input type="hidden" name="barang_id_hasil[]" value="'+data.val2[i].m_barang_id+'"/>\
            //                             '+data.val2[i].barang_kode+'\
            //                         </td>\
            //                         <td id="td2'+itemHasil+'">\
            //                             <input type="text" class="form-control num" id="deskripsi_hasil'+itemHasil+'" name="deskripsi_hasil[]" value="'+data.val2[i].barang_uraian+'" required/>\
            //                         </td>\
            //                         <td id="td3'+itemHasil+'">\
            //                             <input type="text" class="form-control num" id="pengubahan_bahanakhirhasil_qty'+itemHasil+'" name="pengubahan_bahanakhir_qty[]" value="" required/>\
            //                         </td>\
            //                         <td id="td4'+itemHasil+'">\
            //                             '+data.val2[i].satuan_nama+'\
            //                         </td>\
            //                         <td id="td5'+itemHasil+'">\
            //                             <input type="hidden" class="form-control" name="pengubahan_bahanakhir_gudang[]" id="pengubahan_bahanakhir_gudang'+itemHasil+'" value="'+data.val2[i].m_gudang_id.val2[i].id+'">\
            //                             '+data.val2[i].m_gudang_id.val2[i].text+'\
            //                         </td>\
            //                         <td id="td6'+itemHasil+'">\
            //                             <button type="button" id="removeBtn'+itemHasil+'" class="btn red-thunderbird" onclick="removeDetailHasil('+itemHasil+')">\
            //                                 <i class="icon-close"></i>\
            //                             </button>\
            //                         </td>\
            //                     </tr>\
            //                 ');   
            //                 // $(".num").keydown(function(event) {
            //                 // // Allow: backspace, delete, tab, escape, enter and .
            //                 // if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            //                 //      // Allow: Ctrl+A, Command+A
            //                 //     (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
            //                 //      // Allow: home, end, left, right, down, up
            //                 //     (event.keyCode >= 35 && event.keyCode <= 40)) {
            //                 //          // let it happen, don't do anything
            //                 //          return;
            //                 // }
            //                 // // Ensure that it is a number and stop the keypress
            //                 // if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
            //                 //     event.preventDefault();
            //                 // }
            //                 // });
            //                 // $(".decimal").keydown(function(event) {
            //                 // // Allow: backspace, delete, tab, escape, enter and .
            //                 // if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            //                 //      // Allow: Ctrl+A, Command+A
            //                 //     (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
            //                 //      // Allow: home, end, left, right, down, up
            //                 //     (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {
            //                 //          // let it happen, don't do anything
            //                 //          return;
            //                 // }
            //                 // // Ensure that it is a number and stop the keypress
            //                 // if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
            //                 //     event.preventDefault();
            //                 // }
            //                 // });
            //             }
            //         $("#jml_itemHasil").val(itemHasil);
            //       }
            //     });
            // }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Serah-Terima/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){

                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("serah_terima_nomor")[0].value = data.val[i].serah_terima_nomor;
                        $('#serah_terima_darishift').val(data.val[i].serah_terima_darishift).change();
                        $('#serah_terima_keshift').val(data.val[i].serah_terima_keshift).change();
                      // document.getElementsByName("serah_terima_darishift")[0].value = data.val[i].serah_terima_darishift;
                      // document.getElementsByName("serah_terima_keshift")[0].value = data.val[i].serah_terima_keshift;

                      for(var j=0; j<data.val[i].serah_terima_daribagian.val2.length; j++){
                        $("#m_gudang_id_produksi").append('<option value="'+data.val[i].serah_terima_daribagian.val2[j].id+'" selected>'+data.val[i].serah_terima_daribagian.val2[j].text+'</option>');
                      }
                      document.getElementsByName("t_perolehan_produksi_id")[0].disabled = true;

                      for(var j=0; j<data.val[i].serah_terima_kebagian.val2.length; j++){
                        $("#m_gudang_id_tujuan").append('<option value="'+data.val[i].serah_terima_kebagian.val2[j].id+'" selected>'+data.val[i].serah_terima_kebagian.val2[j].text+'</option>');
                      }
                      // document.getElementsByName("serah_terima_kebagian")[0].disabled = true;
                      // document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis;
                      // document.getElementsByName('t_jadwal_produksi_id')[0].disabled = true;
                      // document.getElementsByName('m_barang_id2')[0].disabled = true;

                      
                      // $("#t_estimasi_penjualan_id").select2();
                      // document.getElementsByName('t_estimasi_penjualan_id')[0].disabled = true;

                      document.getElementById('submit'). disabled = true;
                      // document.getElementById('btnAddBahanAwal').disabled = true;
                      // document.getElementById('btnAddBahanHasil').disabled = true;
                    }

                    // itemAwal = data.val2.length;
                    $("#KodeST").attr('hidden', false);

                    itemBarang = data.val2.length;
                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="barang_id[]" value="'+data.val2[i].barang_id+'"/>\
                                    <input type="hidden" name="t_perolehan_produksidet_id[]" value="'+data.val2[i].perolehan_produksidet_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    '+data.val2[i].barang_nama+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    '+data.val2[i].pengubahan_bahan_nomor+'\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    '+data.val2[i].perolehan_produksi_akhirdet.val2[i].perolehan_produksi_akhirdet_berat+'\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    '+data.val2[i].perolehan_produksi_akhirdet.val2[i].perolehan_produksi_akhirdet_panjang+'\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    '+data.val2[i].perolehan_produksi_akhirdet.val2[i].perolehan_produksi_akhirdet_tebal+'\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    '+data.val2[i].perolehan_produksi_akhirdet.val2[i].perolehan_produksi_akhirdet_qty+' \
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td id="td9'+(i+1)+'">\
                                    <textarea class="form-control" name="serah_terimadet_keterangan[]" id="serah_terimadet_keterangan'+(i+1)+'" readonly>'+data.val2[i].serah_terimadet_keterangan+'</textarea>\
                                </td>\
                                <td id="td10'+(i+1)+'">\
                                    <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" onclick="removeDetail('+(i+1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');
                    }
                    $("#jml_itemBarang").val(itemBarang);

                    
                  }
                });
                
            }
        </script>

    </body>

</html>