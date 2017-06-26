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
                                        <input type="hidden" id="url" value="Persetujuan/Jadwal-Produksi/postData/">
                                        <input type="hidden" id="url_data" value="Persetujuan/Jadwal-Produksi">
                                        <input type="hidden" name="jadwal_produksi_status" value="0">
                                        <div id="stok" hidden="true">
                                        </div>
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID Jadwal (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="KodeJadwal">
                                            <label class="control-label col-md-4">Kode Jadwal (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="jadwal_produksi_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Periode Produksi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="jadwal_produksi_periode" type="text" value="<?php echo date('d/m/Y');?> - <?php echo date('t/m/Y');?>" class="form-control datepicker-range" data-date-start-date="+0d">
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div>
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
                                                    <!-- <input type="text" class="form-control num" name="jadwal_produksi_shift" required />  -->
                                                    <select class="form-control select2" name="jadwal_produksi_shift" required>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">1 dan 2</option>
                                                    </select></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Jenis Produksi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="jadwal_produksi_jenis" id="jadwal_produksi_jenis"></select> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Kebutuhan Jadwal Produksi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <label class="mt-radio"> Estimasi Penjualan
                                                        <input type="radio" value="1" name="jadwal_produksi_kebutuhan" id="estimasi_penjualan" onchange="getEstimasi(this)" />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Kebutuhan Stok
                                                        <input type="radio" value="2" name="jadwal_produksi_kebutuhan" id="kebutuhan_stok" onchange="getEstimasi(this)" />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Sales Order
                                                        <input type="radio" value="3" name="jadwal_produksi_kebutuhan" id="sales_order" onchange="getEstimasi(this)" />
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Referensi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_estimasi_penjualan_id" name="t_estimasi_penjualan_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddEstimasi" class="btn sbold dark" onclick="addEstimasi()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        Bahan Mentah
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th> No </th>
                                                            <th> Artikel </th>
                                                            <th> Nama Barang </th>
                                                            <th style="width: 30%"> No Seri </th>
                                                            <th> Qty </th>
                                                            <th> Satuan </th>
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        Barang Jadi
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemBarangJadi" id="jml_itemBarangJadi" value="0" />
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table2">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th> No </th>
                                                            <th> Artikel </th>
                                                            <th> Nama Barang </th>
                                                            <th> Total </th>
                                                            <th> Satuan </th>
                                                            <th> Keterangan </th>
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody2">
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
                                                <label class="mt-checkbox"> Setujui Jadwal Produksi
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
                                                <a href="<?php echo base_url();?>Persetujuan/Jadwal-Produksi">
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
                itemBarangJadi = 0;
                hitungBerat = 0;
                hitungQty = 0;
                hitungQtyJP = 0;
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_estimasi_penjualan_id').css('width', '100%');
                selectList_estimasiPenjualan("#t_estimasi_penjualan_id");
                $('#jadwal_produksi_jenis').css('width', '100%');
                selectList_JenisProduksi("#jadwal_produksi_jenis");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                    // hitungStok();
                }
            });

            function addEstimasi() {
                var id = document.getElementsByName('t_estimasi_penjualan_id')[0].value;
                itemBarang = 0;
                itemBarangJadi = 0;
                $("#jml_itemBarang").val(itemBarang);
                $("#jml_itemBarangJadi").val(itemBarangJadi);
                $("#default-table tbody").empty();
                $("#default-table2 tbody").empty();
                if (id.length > 0) {
                    getDetailEstimasi(id);
                }
            }

            function getEstimasi(radioElemen)
            {
                var id = radioElemen.id;
                if(id == 'estimasi_penjualan')
                {
                    $("#t_estimasi_penjualan_id").removeAttr('disabled');
                    selectList_estimasiPenjualan("#t_estimasi_penjualan_id");
                }
                else
                {
                    $("#t_estimasi_penjualan_id").attr('disabled', 'disabled');
                    itemBarang = 0;
                    itemBarangJadi = 0;
                    $("#jml_itemBarang").val(itemBarang);
                    $("#jml_itemBarangJadi").val(itemBarangJadi);
                    $("#default-table tbody").empty();
                    $("#default-table2 tbody").empty();
                    generateItemOption1();
                    generateItemOption2();
                }
            }

            function getBarang(elemen)
            {
                var id = elemen.id;
                var value = elemen.value;
                var seq = parseInt(id.charAt(id.length-1));
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                  data : "id="+value,
                  dataType : "json",
                  success:function(data){
                    for( var i = 0; i < data.val.length; i++)
                    {
                        document.getElementById('kode_barang'+seq).value = data.val[i].barang_kode;
                        document.getElementById('jadwal_produksi_awaldet_satuan'+seq).value = data.val[i].m_satuan_id.val2[i].text;
                    }
                    
                  }
                });
                var noSeri = [];
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Inventory/Stok-Gudang/loadDataWhere/',
                  data : "id="+value,
                  dataType : "json",
                  success:function(data){
                    for( var i = 0; i < data.val.length; i++)
                    {
                        for(var j = 0; j < data.val[i].stok_gudang_no_seri.length; j++)
                        {
                            noSeri.push(data.val[i].stok_gudang_no_seri[j]);
                        }
                    }
                    for(var i=0; i <noSeri.length; i++)
                    {
                        if(noSeri[i] != '')
                        {
                            $("#jadwal_produksi_awaldet_no_seri"+seq).append('<option value="'+noSeri[i]+'">'+noSeri[i]+'</option>');
                        }
                    }
                    $("#jadwal_produksi_awaldet_no_seri"+seq).select2();
                  }
                });
            }

            function getBarangJadi(elemen)
            {
                var id = elemen.id;
                var value = elemen.value;
                var seq = parseInt(id.charAt(id.length-1));
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                  data : "id="+value,
                  dataType : "json",
                  success:function(data){
                    for( var i = 0; i < data.val.length; i++)
                    {
                        document.getElementById('kode_barang_jadi'+seq).value = data.val[i].barang_kode;
                        document.getElementById('jadwal_produksi_akhirdet_satuan'+seq).value = data.val[i].m_satuan_id.val2[i].text;
                    }
                    
                  }
                });
            }

            function removeEstimasi(itemSeq) {
                var parent = document.getElementById("tableTbody2");
                for (var i = 1; i <= itemBarangJadi; i++) {
                  if (i >= itemSeq && i < itemBarangJadi) {
                    document.getElementById("td1"+i).innerHTML = document.getElementById("td1"+(i+1)).innerHTML;
                    document.getElementById("td2"+i).innerHTML = document.getElementById("td2"+(i+1)).innerHTML;
                    document.getElementById("td3"+i).innerHTML = document.getElementById("td3"+(i+1)).innerHTML;
                    document.getElementById("td4"+i).innerHTML = document.getElementById("td4"+(i+1)).innerHTML;
                    document.getElementById("td5"+i).innerHTML = document.getElementById("td5"+(i+1)).innerHTML;
                    document.getElementById("td6"+i).innerHTML = document.getElementById("td6"+(i+1)).innerHTML;
                    // document.getElementById("td7"+i).innerHTML = document.getElementById("td7"+(i+1)).innerHTML;
                    // document.getElementById("td8"+i).innerHTML = document.getElementById("td8"+(i+1)).innerHTML;
                  };
                };
                for (var i = 1; i <= itemBarangJadi; i++) {
                  if (i==itemBarangJadi) {
                    var child = document.getElementById("detailJadi"+i);
                    parent.removeChild(child);
                  };
                };
                itemBarangJadi--;
                $("#jml_itemBarangJadi").val(itemBarangJadi);
            }

            function removeItemOption(itemSeq) {
                var parent = document.getElementById("tableTbody");
                for (var i = 1; i <= itemBarang; i++) {
                  if (i >= itemSeq && i < itemBarang) {
                    var sel = document.getElementById('m_barang_id_'+(i+1));
                    var inp1 = sel.options[sel.selectedIndex].value;
                    var text = sel.options[sel.selectedIndex].text;
                    var inp2 = document.getElementById('jadwal_produksidet_qty'+(i+1)).value;
                    var inp3 = document.getElementById('jadwal_produksidet_satuan'+(i+1)).value;
                    var inp4 = document.getElementById('kode_barang'+(i+1)).value;
                    $('#m_barang_id_'+i).select2('destroy');
                    $('#m_barang_id_'+i).empty();
                    $('#m_barang_id_'+i).append('<option value="'+inp1+'" selected>'+text+'</option>');
                    $('#m_barang_id_'+i).select2();
                    selectList_barang2("#m_barang_id_"+i);
                    document.getElementById('jadwal_produksidet_qty'+i).value = inp2;
                    document.getElementById('jadwal_produksidet_satuan'+i).value = inp3;
                    document.getElementById('kode_barang'+i).value = inp4;
                  };
                };
                for (var i = 1; i <= itemBarang; i++) {
                  if (i==itemBarang) {
                    var child = document.getElementById("detail"+i);
                    parent.removeChild(child);
                  };
                };
                $('#btnAddRow'+(itemBarang-1)).removeClass('hidden');
                $('#removeBtn'+(itemBarang-1)).addClass('hidden');
                itemBarang--;
                $("#jml_itemBarang").val(itemBarang);
            }

            function removeItemOption2(itemSeq) {
                var parent = document.getElementById("tableTbody2");
                for (var i = 1; i <= itemBarangJadi; i++) {
                  if (i >= itemSeq && i < itemBarangJadi) {
                    var sel = document.getElementById('barang_id_'+(i+1));
                    var inp1 = sel.options[sel.selectedIndex].value;
                    var text = sel.options[sel.selectedIndex].text;
                    var inp2 = document.getElementById('jadwal_produksidet_total'+(i+1)).value;
                    var inp3 = document.getElementById('jadwal_produksidet_satuan_jadi'+(i+1)).value;
                    var inp4 = document.getElementById('kode_barang_jadi'+(i+1)).value;
                    var inp5 = document.getElementById('jadwal_produksidet_keterangan'+(i+1)).value;
                    $('#barang_id_'+i).select2('destroy');
                    $('#barang_id_'+i).empty();
                    $('#barang_id_'+i).append('<option value="'+inp1+'" selected>'+text+'</option>');
                    $('#barang_id_'+i).select2();
                    selectList_barang2("#barang_id_"+i);
                    document.getElementById('jadwal_produksidet_total'+i).value = inp2;
                    document.getElementById('jadwal_produksidet_satuan_jadi'+i).value = inp3;
                    document.getElementById('kode_barang_jadi'+i).value = inp4;
                    document.getElementById('jadwal_produksidet_keterangan'+i).value = inp5;
                  };
                };
                for (var i = 1; i <= itemBarangJadi; i++) {
                  if (i==itemBarangJadi) {
                    var child = document.getElementById("detailJadi"+i);
                    parent.removeChild(child);
                  };
                };
                $('#btnAddRowJadi'+(itemBarangJadi-1)).removeClass('hidden');
                $('#removeBtnJadi'+(itemBarangJadi-1)).addClass('hidden');
                itemBarangJadi--;
                $("#jml_itemBarangJadi").val(itemBarangJadi);
            }

            function generateItemOption1()
            {
                itemBarang++;
                var item = parseInt(document.getElementById('jml_itemBarang').value);
                $("#jml_itemBarang").val(item+1);
                $("#default-table tbody").append('<tr id="detail'+itemBarang+'">\
                    <td id="td0'+itemBarang+'">'+(item+1)+'</td>\
                    <td id="td1'+itemBarang+'"><input type="text" name="kode_barang[]" id="kode_barang'+itemBarang+'" class="form-control num" required readonly></td>\
                    <td id="td2'+itemBarang+'" width="30%"><select name="m_barang_id[]" id="m_barang_id_'+itemBarang+'" class="form-control select2" onchange="getBarang(this)"></select></td>\
                    <td id="td3'+itemBarang+'"><select name="jadwal_produksi_awaldet_no_seri[]" id="jadwal_produksi_awaldet_no_seri'+itemBarang+'" class="form-control"></select></td>\
                    <td id="td4'+itemBarang+'"><input type="text" name="jadwal_produksi_awaldet_qty[]" id="jadwal_produksi_awaldet_qty'+itemBarang+'" class="form-control"></td>\
                    <td id="td5'+itemBarang+'"><input type="text" name="jadwal_produksi_awaldet_satuan[]" id="jadwal_produksi_awaldet_satuan'+itemBarang+'" class="form-control" readonly></td>\
                    <td id="td6'+itemBarang+'">\
                        <button type="button" id="btnAddRow'+itemBarang+'" class="btn sbold dark" onclick="generateItemOption1()"><i class="icon-plus"></i></button>\
                        <button type="button" id="removeBtn'+itemBarang+'" class="btn red-thunderbird hidden" onclick="removeItemOption('+itemBarang+')">\
                            <i class="icon-close"></i>\
                        </button>\
                    </td>\
                    </tr>');
                if(itemBarang > 1)
                {
                    $('#btnAddRow'+(itemBarang-1)).addClass('hidden');
                    $('#removeBtn'+(itemBarang-1)).removeClass('hidden');
                }
                // $("#m_barang_id_"+itemBarang).select2();
                $("#m_barang_id_"+itemBarang).css('width', '100%');
                selectList_barang2('#m_barang_id_'+itemBarang);
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
            }

            function generateItemOption2()
            {
                itemBarangJadi++;
                var item = parseInt(document.getElementById('jml_itemBarangJadi').value);
                $("#jml_itemBarangJadi").val(item+1);
                $("#default-table2 tbody").append('<tr id="detailJadi'+itemBarangJadi+'">\
                    <td id="td0'+itemBarangJadi+'">\
                        '+itemBarangJadi+'\
                    </td>\
                    <td id="td1'+itemBarangJadi+'">\
                        <input type="text" name="kode_barang_jadi[]" id="kode_barang_jadi'+itemBarangJadi+'" class="form-control num" required readonly>\
                    </td>\
                    <td id="td2'+itemBarangJadi+'">\
                        <select name="barang_id[]" id="barang_id_'+itemBarangJadi+'" class="form-control select2" onchange="getBarangJadi(this)">\
                    </td>\
                    <td id="td3'+itemBarangJadi+'">\
                    <input type="text" class="form-control decimal" id="jadwal_produksi_akhirdet_total'+itemBarangJadi+'" name="jadwal_produksi_akhirdet_total[]" value="0" required/>\
                    </td>\
                    <td id="td4'+itemBarangJadi+'">\
                       <input type="text" name="jadwal_produksi_akhirdet_satuan[]" id="jadwal_produksi_akhirdet_satuan'+itemBarangJadi+'" class="form-control" readonly>\
                    </td>\
                    <td id="td5'+itemBarangJadi+'">\
                        <textarea class="form-control" rows="3" name="jadwal_produksi_akhirdet_keterangan[]" id="jadwal_produksi_akhirdet_keterangan'+itemBarangJadi+'"></textarea>\
                    </td>\
                    <td id="td6'+itemBarangJadi+'">\
                        <button type="button" id="btnAddRowJadi'+itemBarangJadi+'" class="btn sbold dark" onclick="generateItemOption2()"><i class="icon-plus"></i></button>\
                        <button type="button" id="removeBtnJadi'+itemBarangJadi+'" class="btn red-thunderbird hidden" onclick="removeItemOption2('+itemBarangJadi+')">\
                            <i class="icon-close"></i>\
                    </td>\
                    </tr>');
                if(itemBarangJadi > 1)
                {
                    $('#btnAddRowJadi'+(itemBarangJadi-1)).addClass('hidden');
                    $('#removeBtnJadi'+(itemBarangJadi-1)).removeClass('hidden');
                }
                // $("#m_barang_id_"+itemBarang).select2();
                $("#barang_id_"+itemBarangJadi).css('width', '100%');
                selectList_barang2('#barang_id_'+itemBarangJadi);
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
            }

            function getDetailEstimasi(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Estimasi-Penjualan/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    $("#default-table2 tbody").empty();

                    itemBarangJadi = data.val2.length;
                    $("#jml_itemBarangJadi").val(itemBarangJadi);
                    generateItemOption1();
                    for(var i = 0; i < data.val2.length; i++){
                        if (data.val2[i].estimasi_penjualandet_status == 0) {
                            $("#default-table2 tbody").append('\
                                <tr id="detailJadi'+(i+1)+'">\
                                    <td id="td0'+(i+1)+'">\
                                        '+(i+1)+'\
                                    </td>\
                                    <td id="td1'+(i+1)+'">\
                                        <input type="hidden" name="t_estimasi_penjualandet_id[]" value="'+data.val2[i].estimasi_penjualandet_id+'"/>\
                                        <input type="hidden" name="barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                        '+data.val2[i].barang_kode+'\
                                    </td>\
                                    <td id="td2'+(i+1)+'">\
                                        '+data.val2[i].barang_nama+'\
                                    </td>\
                                    <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control decimal" id="jadwal_produksi_akhirdet_total'+(i+1)+'" name="jadwal_produksi_akhirdet_total[]" value="0" required/>\
                                    </td>\
                                    <td id="td4'+(i+1)+'">\
                                        '+data.val2[i].satuan_nama+'\
                                    </td>\
                                    <td id="td5'+(i+1)+'">\
                                        <textarea class="form-control" rows="3" name="jadwal_produksi_akhirdet_keterangan[]" id="jadwal_produksi_akhirdet_keterangan'+(i+1)+'"></textarea>\
                                    </td>\
                                    <td id="td6'+(i+1)+'">\
                                        <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" onclick="removeEstimasi('+(i+1)+')">\
                                            <i class="icon-close"></i>\
                                        </button>\
                                    </td>\
                                </tr>\
                            ');
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
                  }
                });
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Jadwal-Produksi/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("jadwal_produksi_nomor")[0].value = data.val[i].jadwal_produksi_nomor;
                      document.getElementsByName("jadwal_produksi_periode")[0].value = data.val[i].jadwal_produksi_periode;
                      document.getElementsByName("jadwal_produksi_periode")[0].disabled = true;
                      document.getElementsByName("jadwal_produksi_status")[0].value = data.val[i].jadwal_produksi_status;
                      document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      document.getElementsByName('jadwal_produksi_shift')[0].disabled = true;
                      document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis;
                      document.getElementsByName('jadwal_produksi_jenis')[0].disabled = true;
                      if(data.val[i].jadwal_produksi_kebutuhan == "1")
                      {
                        document.getElementById("estimasi_penjualan").setAttribute("checked", "checked");
                        for(var j=0; j<data.val[i].t_estimasi_penjualan_id.val2.length; j++){
                            $("#t_estimasi_penjualan_id").append('<option value="'+data.val[i].t_estimasi_penjualan_id.val2[j].id+'" selected>'+data.val[i].t_estimasi_penjualan_id.val2[j].text+'</option>');
                        }
                        $("#t_estimasi_penjualan_id").select2();
                      }
                      else if(data.val[i].jadwal_produksi_kebutuhan == "2")
                      {
                        document.getElementById("kebutuhan_stok").setAttribute("checked", "checked");
                      }
                      else if(data.val[i].jadwal_produksi_kebutuhan == "3")
                      {
                        document.getElementById("sales_order").setAttribute("checked", "checked");
                        for(var j=0; j<data.val[i].t_so_customer_id.val2.length; j++){
                            $("#t_estimasi_penjualan_id").append('<option value="'+data.val[i].t_so_customer_id.val2[j].id+'" selected>'+data.val[i].t_so_customer_id.val2[j].text+'</option>');
                        }
                        $("#t_estimasi_penjualan_id").select2();
                      }
                      if(data.val[i].jadwal_produksi_status >= 2)
                      {
                        document.getElementById('persetujuan').checked = true;
                      }
                      else
                      {
                        document.getElementById('persetujuan').checked = false;
                      }
                      document.getElementById("estimasi_penjualan").disabled =true;
                      document.getElementById("kebutuhan_stok").disabled =true;

                      
                      for(var j=0; j<data.val[i].jadwal_produksi_jenis.val2.length; j++){
                        $("#jadwal_produksi_jenis").append('<option value="'+data.val[i].jadwal_produksi_jenis.val2[j].id+'" selected>'+data.val[i].jadwal_produksi_jenis.val2[j].text+'</option>');
                      }
                      $("#jadwal_produksi_jenis").select2();
                      document.getElementsByName('t_estimasi_penjualan_id')[0].disabled = true;

                      // document.getElementById('submit'). disabled = true;
                      document.getElementById('btnAddEstimasi').disabled = true;
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);
                    itemBarangJadi = data.val3.length;
                    $("#jml_itemBarangJadi").val(itemBarangJadi);
                    $("#KodeJadwal").attr('hidden', false);

                    for(var i = 0; i < data.val2.length; i++){
                        var berat = 0, qty = 0;
                        $("#stok").append('<input type="hidden" name="qty_jp[]" value="'+data.val2[i].jadwal_produksi_awaldet_qty+'">');
                        $.ajax({
                            type : "GET",
                            url  : "<?php echo base_url();?>Inventory/Stok-Gudang/loadDataJumlahWhere/", 
                            data : "id="+data.val2[i].jadwal_produksi_awaldet_no_seri,
                            dataType : "json",
                            success  : function(data){
                                // alert('masuk berat');
                                for (var j = 0; j < data.val.length; j++) {
                                    berat = parseFloat(data.val[j].stok_gudang_jumlah);
                                }
                                $("#stok").append('<input type="hidden" name="berat[]" value="'+berat+'">');
                            }
                        });
                        $.ajax({
                            type : "GET",
                            url  : "<?php echo base_url();?>Produksi/Jadwal-Produksi/loadDataQtyAwalWhere/", 
                            data : "id="+data.val2[i].jadwal_produksi_awaldet_no_seri,
                            dataType : "json",
                            success  : function(data){
                                // alert('masuk qty');
                                for (var j = 0; j < data.val.length; j++) {
                                    qty = qty + parseFloat(data.val[j].jadwal_produksi_awaldet_qty);
                                }
                                $("#stok").append('<input type="hidden" name="qty[]" value="'+qty+'" oninput="hitungStok()">');
                            }
                        });
                        
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">'+(i+1)+'</td>\
                                <td id="td1'+(i+1)+'"><input type="text" name="kode_barang[]" id="kode_barang'+(i+1)+'" value="'+data.val2[i].barang_kode+'" class="form-control num" required readonly></td>\
                                <td id="td2'+(i+1)+'" width="30%"><select name="m_barang_id[]" id="m_barang_id_'+(i+1)+'" class="form-control select2" onchange="getBarang(this)" readonly><option>'+data.val2[i].barang_nama+'</option></select></td>\
                                <td id="td3'+(i+1)+'"><select name="jadwal_produksi_awaldet_no_seri[]" id="jadwal_produksi_awaldet_no_seri'+(i+1)+'" class="form-control" readonly><option value="'+data.val2[i].jadwal_produksi_awaldet_no_seri+'" selected>'+data.val2[i].jadwal_produksi_awaldet_no_seri+'</option></select></td>\
                                <td id="td4'+(i+1)+'"><input type="text" name="jadwal_produksi_awaldet_qty[]" id="jadwal_produksi_awaldet_qty'+(i+1)+'" class="form-control" value="'+data.val2[i].jadwal_produksi_awaldet_qty+'" readonly></td>\
                                <td id="td5'+(i+1)+'"><input type="text" name="jadwal_produksi_awaldet_satuan[]" id="jadwal_produksi_awaldet_satuan'+(i+1)+'" class="form-control" value="'+data.val2[i].satuan_nama+'" readonly></td>\
                                <td id="td6'+(i+1)+'">\
                                    <button type="button" id="btnAddRow'+(i+1)+'" class="btn sbold dark" disabled="disabled" onclick="generateItemOption1()"><i class="icon-plus"></i></button>\
                                    <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird hidden" onclick="removeItemOption('+(i+1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');   
                    }
                    var buttonAdd = '';
                    var buttonRemove = '';
                    for(var i = 0; i < data.val3.length; i++){
                        if(i == data.val3.length-1)
                        {
                            buttonAdd = '<button type="button" id="btnAddRowJadi'+(i+1)+'" class="btn sbold dark" disabled="disabled" onclick="generateItemOption2()"><i class="icon-plus"></i></button>';
                            buttonRemove = '<button type="button" id="removeBtnJadi'+(i+1)+'" class="btn red-thunderbird hidden" onclick="removeItemOption2('+(i+1)+')">';
                        }
                        else
                        {
                            buttonAdd = '<button type="button" id="btnAddRowJadi'+(i+1)+'" class="btn sbold dark hidden" onclick="generateItemOption2()"><i class="icon-plus"></i></button>';
                            buttonRemove = '<button type="button" id="removeBtnJadi'+(i+1)+'" class="btn red-thunderbird" disabled="disabled" onclick="removeItemOption2('+(i+1)+')">';
                        }
                        $("#default-table2 tbody").append('\
                            <tr id="detailJadi'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="text" name="kode_barang_jadi[]" id="kode_barang_jadi'+(i+1)+'" value="'+data.val3[i].barang_kode+'" class="form-control num" required readonly>\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <select name="barang_id[]" id="barang_id_'+(i+1)+'" class="form-control select2" onchange="getBarangJadi(this)" readonly>\
                                        <option value="'+data.val3[i].m_barang_id+'">'+data.val3[i].barang_nama+'</option>\
                                    </select>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                <input type="text" class="form-control decimal" id="jadwal_produksi_akhirdet_total'+itemBarangJadi+'" name="jadwal_produksi_akhirdet_total[]" value="'+data.val3[i].jadwal_produksi_akhirdet_total+'" required readonly/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                   <input type="text" name="jadwal_produksi_akhirdet_satuan[]" id="jadwal_produksi_akhirdet_satuan'+itemBarangJadi+'" class="form-control" value="'+data.val3[i].satuan_nama+'" readonly>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <textarea class="form-control" rows="3" name="jadwal_produksi_akhirdet_keterangan[]" id="jadwal_produksi_akhirdet_keterangan'+(i+1)+'" readonly>'+data.val3[i].jadwal_produksi_akhirdet_keterangan+'</textarea>\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    '+buttonAdd+'\
                                    '+buttonRemove+'\
                                        <i class="icon-close"></i>\
                                </td>\
                            </tr>\
                        ');   
                    }
                  }
                });
            }
            function checkPersetujuan() {
                if (document.getElementById("persetujuan").checked == true) {
                    document.getElementsByName("jadwal_produksi_status")[0].value = 2;
                } else {
                    document.getElementsByName("jadwal_produksi_status")[0].value = 1;
                    // alert(document.getElementsByName("jadwal_produksi_status")[0].value);
                }
            }
            function hitungStok()
            {
                // if(berat != null)
                // {
                //     hitungBerat = berat;
                // }
                // if(qty != null)
                // {
                //     hitungQty = qty;
                // }
                // if(qty_jp != null)
                // {
                //     hitungBerat = berat;
                // }
                for(var i = 0; i < document.getElementsByName('berat').length; i++)
                {
                    var berat = document.getElementsByName('berat')[i].value;
                    var qty = document.getElementsByName('qty')[i].value;
                    var qty_jp = document.getElementsByName('qty_jp')[i].value;
                    alert(berat);
                    if(((berat-qty)-qty_jp) < 0)
                    {
                        $(".alert-danger").html('<button class="close" data-close="alert"></button> Jumlah stok kurang');
                        document.getElementById('submit').disabled = true;
                    }
                }
            }
        </script>

    </body>

</html>