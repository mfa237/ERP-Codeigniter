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
                                        <input type="hidden" id="url" value="Produksi/Perolehan-Produksi/postData/">
                                        <input type="hidden" id="url_data" value="Produksi/Perolehan-Produksi">
                                        <input type="hidden" name="jadwal_produksi_status" value="0">
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID Perolehan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" hidden="true" id="KodePerolehan">
                                            <label class="control-label col-md-4">Kode Perolehan Produksi (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="perolehan_produksi_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Gudang Tujuan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="m_gudang_id_tujuan" id="m_gudang_id_tujuan" required /> </select></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Jadwal Produksi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="t_jadwal_id" id="t_jadwal_id" required /> </select></div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddJadwal" class="btn sbold dark" onclick="addJadwal()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                <table class="table table-striped table-bordered table-hover" style="display: block; overflow: auto;" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="3" valign="center"> No </th>
                                                            <th colspan="7" style="text-align: center;"> Bahan </th>
                                                            <th rowspan="3" valign="center"> Action </th>
                                                        </tr>
                                                        <tr align="center">
                                                            <th rowspan="2"> No. Coil </th>
                                                            <th colspan="5" style="text-align: center;"> Berat Coil (Kg) </th>
                                                            <th rowspan="2"> Ukuran Coil </th>
                                                        </tr>
                                                        <tr align="center">
                                                            <th> Berat Coil Gross </th>
                                                            <th> Berat Coil Net </th>
                                                            <th> Berat Timbang </th>
                                                            <th> Berat Kulit </th>
                                                            <th> Berat Tong </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group hidden" id="selectBarang">
                                            <label class="control-label col-md-4">Nama Barang
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="select_barang" aria-required="true" aria-describedby="select-error">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddBarang" class="btn sbold dark" onclick="addBarang()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12">
                                                <input type="hidden" name="jml_itemBarangJadi" id="jml_itemBarangJadi" value="0" />
                                                <table class="table table-striped table-bordered table-hover" style="display: block; overflow: auto;" id="default-table2">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="3" valign="center"> No </th>
                                                            <th colspan="10" style="text-align: center;"> Hasil/Barang Jadi </th>
                                                            <th rowspan="3" valign="center"> Action </th>
                                                        </tr>
                                                        <tr align="center">
                                                            <th rowspan="2"> Artikel </th>
                                                            <th rowspan="2"> Berat (Kg) </th>
                                                            <th rowspan="2"> Panjang (m) </th>
                                                            <th rowspan="2"> Tebal (mm) </th>
                                                            <th rowspan="2"> Micro meter (mm) </th>
                                                            <th rowspan="2" width="20%"> Qty </th>
                                                            <th rowspan="2"> NS (Qty) </th>
                                                            <th rowspan="2"> Qty Rusak </th>
                                                            <th rowspan="2"> Konversi </th>
                                                            <th rowspan="2"> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody2">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2">Total</td>
                                                            <td colspan="4"></td> 
                                                            <td><input type="text" class="form-control num" id="perolehan_produksi_total" name="perolehan_produksi_total" value="" required readonly /></td>
                                                            <td colspan="4"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Afalan (Kg)</td>
                                                            <td colspan="5"></td>
                                                            <td><input type="text" class="form-control num" id="perolehan_produksi_afalan" name="perolehan_produksi_afalan" value="" required readonly /></td>
                                                            <td colspan="3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">Rusak</td>
                                                            <td colspan="6"></td>
                                                            <td><input type="text" class="form-control num" id="perolehan_produksi_rusak" name="perolehan_produksi_rusak" value="" required readonly /></td>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Produksi/Perolehan-Produksi">
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
                last_num = 0;
                last_num2 = 0;
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                $('#t_jadwal_id').css('width', '100%');
                $('#m_gudang_id').css('width', '100%');
                selectList_jadwalProduksi2("#t_jadwal_id");
                selectList_gudangCabangTujuan();
                $('#select_barang').css('width', '100%');
                selectList_barang2("#select_barang");
                if (document.getElementsByName("kode")[0].value != null) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function addJadwal() {
                var id = document.getElementsByName('t_jadwal_id')[0].value;
                if (id.length > 0) {
                    getDetailJadwal(id);
                    $("#selectBarang").removeClass("hidden");
                } else {
                    $("#selectBarang").addClass("hidden");
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

            function removeDetailJadi(itemSeq) {
                var parent = document.getElementById("tableTbody2");
                for (var i = 1; i <= itemBarangJadi; i++) {
                  if (i >= itemSeq && i < itemBarangJadi) {
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
                    document.getElementById("td11"+i).innerHTML = document.getElementById("td11"+(i+1)).innerHTML;
                  };
                };
                for (var i = 1; i <= itemBarangJadi; i++) {
                  if (i==itemBarangJadi) {
                    var child = document.getElementById("detailJadi"+i);
                    parent.removeChild(child);
                  };
                };
                itemBarangJadi--;
                last_num2--;
                $("#jml_itemBarangJadi").val(itemBarangJadi);
            }

            function getDetailJadwal(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Produksi/Jadwal-Produksi/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    $("#default-table tbody").empty();
                    $("#default-table2 tbody").empty();
                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);
                    itemBarangJadi = data.val3.length;
                    $("#jml_itemBarangJadi").val(itemBarangJadi);

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="jadwal_produksi_awaldet_id[]" value="'+data.val2[i].jadwal_produksi_awaldet_id+'"/>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    '+data.val2[i].jadwal_produksi_awaldet_no_seri+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahangross'+(i+1)+'" name="perolehan_produksi_awaldet_bahangross[]" value="" required/>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahannet'+(i+1)+'" name="perolehan_produksi_awaldet_bahannet[]" value="" required/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahantimbang'+(i+1)+'" name="perolehan_produksi_awaldet_bahantimbang[]" value="" required/>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahankulit'+(i+1)+'" name="perolehan_produksi_awaldet_bahankulit[]" value="" required/>\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahantong'+(i+1)+'" name="perolehan_produksi_awaldet_bahantong[]" value="" required/>\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" onclick="removeDetail('+(i+1)+')">\
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
                    for(var i = 0; i < data.val3.length; i++){
                        last_num2++;
                        $("#default-table2 tbody").append('\
                            <tr id="detailJadi'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="jadwal_produksi_akhirdet_id[]" value="'+data.val3[i].jadwal_produksi_akhirdet_id+'"/>\
                                    <input type="hidden" name="barang_id[]" value="'+data.val3[i].m_barang_id+'"/>\
                                    '+data.val3[i].barang_kode+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_berat'+(i+1)+'" name="perolehan_produksi_akhirdet_berat[]" value="" required/>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_panjang'+(i+1)+'" name="perolehan_produksi_akhirdet_panjang[]" value="" required/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_tebal'+(i+1)+'" name="perolehan_produksi_akhirdet_tebal[]" value="" required/>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_micro'+(i+1)+'" name="perolehan_produksi_akhirdet_micro[]" value="" required/>\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_qty'+(i+1)+'" name="perolehan_produksi_akhirdet_qty[]" onchange="getTotal()" value="" required/>\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_ns'+(i+1)+'" name="perolehan_produksi_akhirdet_ns[]" onchange="getAfalan()" value="" required/>\
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_qty_rusak'+(i+1)+'" name="perolehan_produksi_akhirdet_qty_rusak[]" onchange="getRusak()" value="" required/>\
                                </td>\
                                <td id="td9'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_konversi'+(i+1)+'" name="perolehan_produksi_akhirdet_konversi[]" value="" required/>\
                                </td>\
                                <td id="td10'+(i+1)+'">\
                                    <textarea class="form-control" name="perolehan_produksi_akhirdet_ket[]" id="perolehan_produksi_akhirdet_ket'+(i+1)+'"></textarea>\
                                </td>\
                                <td id="td11'+(i+1)+'">\
                                    <button type="button" id="removeBtnJadi'+(i+1)+'" class="btn red-thunderbird" onclick="removeDetailJadi('+(i+1)+')">\
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
                });
            }

            function getTotal()
            {
                var subTotal = 0;
                for (var i = 1; i <= itemBarangJadi; i++) {
                    qty = parseInt(document.getElementById('perolehan_produksi_akhirdet_qty'+i).value);
                    if(document.getElementById('perolehan_produksi_akhirdet_qty'+i).value == '')
                    {
                        qty = 0;
                    }
                    subTotal = subTotal+qty;
                    // alert("sub "+subTotal);
                }
                document.getElementById('perolehan_produksi_total').value = subTotal;
            }

            function getAfalan()
            {
                var afalan = 0;
                for (var i = 1; i <= itemBarangJadi; i++) {
                    ns = parseInt(document.getElementById('perolehan_produksi_akhirdet_ns'+i).value);
                    if(document.getElementById('perolehan_produksi_akhirdet_ns'+i).value == '')
                    {
                        ns = 0;
                    }
                    afalan += ns;
                    // alert(afalan);
                }
                document.getElementById('perolehan_produksi_afalan').value = afalan;
            }

            function getRusak()
            {
                var rusak = 0;
                for (var i = 1; i <= itemBarangJadi; i++) {
                    qty_rusak = parseInt(document.getElementById('perolehan_produksi_akhirdet_qty_rusak'+i).value);
                    if(document.getElementById('perolehan_produksi_akhirdet_qty_rusak'+i).value == '')
                    {
                        qty_rusak = 0;
                    }
                    rusak += qty_rusak;
                }
                document.getElementById('perolehan_produksi_rusak').value = rusak;
                // alert(document.getElementById('perolehan_produksi_rusak').value);
            }

            function addBarang() {
                var id = document.getElementById('select_barang').value;
                if (id.length > 0) {
                    getDetailBarang(id);
                }
                $("#select_barang").select2('destroy');
                $("#select_barang").empty();
                selectList_barang2("#select_barang");
            }

            function getDetailBarang(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Barang/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr id="detailJadi'+(last_num2-1)+'">\
                                <td id="td0'+(last_num2-1)+'">\
                                    '+(last_num2+1)+'\
                                </td>\
                                <td id="td1'+(last_num2-1)+'">\
                                    <input type="hidden" name="jadwal_produksi_akhirdet_id[]" value="0"/>\
                                    <input type="hidden" name="barang_id[]" value="'+data.val[i].kode+'"/>\
                                    '+data.val[i].barang_kode+'\
                                </td>\
                                <td id="td2'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_berat'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_berat[]" value="" required/>\
                                </td>\
                                <td id="td3'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_panjang'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_panjang[]" value="" required/>\
                                </td>\
                                <td id="td4'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_tebal'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_tebal[]" value="" required/>\
                                </td>\
                                <td id="td5'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_micro'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_micro[]" value="" required/>\
                                </td>\
                                <td id="td6'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_qty'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_qty[]" onchange="getTotal()" value="" required/>\
                                </td>\
                                <td id="td7'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_ns'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_ns[]" onchange="getAfalan()" value="" required/>\
                                </td>\
                                <td id="td8'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_qty_rusak'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_qty_rusak[]" onchange="getRusak()" value="" required/>\
                                </td>\
                                <td id="td9'+(last_num2-1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_konversi'+(last_num2-1)+'" name="perolehan_produksi_akhirdet_konversi[]" value="" required/>\
                                </td>\
                                <td id="td10'+(last_num2-1)+'">\
                                    <textarea class="form-control" name="perolehan_produksi_akhirdet_ket[]" id="perolehan_produksi_akhirdet_ket'+(last_num2-1)+'"></textarea>\
                                </td>\
                                <td id="td11'+(last_num2-1)+'">\
                                    <button type="button" id="removeBtnJadi'+(last_num2-1)+'" class="btn red-thunderbird" onclick="removeDetailJadi('+(last_num2-1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
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
                  url  : '<?php echo base_url();?>Produksi/Perolehan-Produksi/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("perolehan_produksi_nomor")[0].value = data.val[i].perolehan_produksi_nomor;
                      document.getElementsByName("perolehan_produksi_total")[0].value = data.val[i].perolehan_produksi_total;
                      document.getElementsByName("perolehan_produksi_afalan")[0].value = data.val[i].perolehan_produksi_afalan;
                      document.getElementsByName("perolehan_produksi_rusak")[0].value = data.val[i].perolehan_produksi_rusak;
                      if(data.val[i].perolehan_produksi_status == 2)
                        {
                            read = 'readonly';
                        }
                        else 
                        {
                            read = '';
                        }
                      // document.getElementsByName("jadwal_produksi_periode")[0].disabled = true;
                      // document.getElementsByName("jadwal_produksi_status")[0].value = data.val[i].jadwal_produksi_status;
                      // document.getElementsByName("jadwal_produksi_shift")[0].value = data.val[i].jadwal_produksi_shift;
                      // document.getElementsByName('jadwal_produksi_shift')[0].disabled = true;
                      // document.getElementsByName("jadwal_produksi_jenis")[0].value = data.val[i].jadwal_produksi_jenis;
                      // document.getElementsByName('jadwal_produksi_jenis')[0].disabled = true;
                      $("#m_gudang_id_tujuan").select2('destroy');
                      for(var j=0; j<data.val[i].m_gudang_id_tujuan.val2.length; j++){
                        // alert(data.val[i].m_gudang_id_tujuan.val2[j].text);
                        $("#m_gudang_id_tujuan").append('<option value="'+data.val[i].m_gudang_id_tujuan.val2[j].id+'" selected>'+data.val[i].m_gudang_id_tujuan.val2[j].text+'</option>');
                      }
                      $("#m_gudang_id_tujuan").select2();
                      // $("#t_estimasi_penjualan_id").select2();
                      document.getElementsByName('t_jadwal_id')[0].disabled = true;
                      selectList_gudangCabangTujuan();
                      // document.getElementById('submit'). disabled = true;
                      document.getElementById('btnAddJadwal').disabled = true;
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);
                    itemBarangJadi = data.val3.length;
                    $("#jml_itemBarangJadi").val(itemBarangJadi);
                    $("#KodeJadwal").attr('hidden', false);

                    for(var i = 0; i < data.val2.length; i++){
                        // alert(read);
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="perolehan_produksi_awaldet_id[]" value="'+data.val2[i].perolehan_produksi_awaldet_id+'"/>\
                                    <input type="hidden" name="jadwal_produksi_awaldet_id[]" value="'+data.val2[i].t_jadwal_produksi_awaldet_id+'"/>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].barang_id+'"/>\
                                    '+data.val2[i].jadwal_produksi_awaldet_no_seri+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahangross'+(i+1)+'" name="perolehan_produksi_awaldet_bahangross[]" value="'+data.val2[i].perolehan_produksi_awaldet_bahangross+'" required '+read+'/>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahannet'+(i+1)+'" name="perolehan_produksi_awaldet_bahannet[]" value="'+data.val2[i].perolehan_produksi_awaldet_bahannet+'" required '+read+'/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahantimbang'+(i+1)+'" name="perolehan_produksi_awaldet_bahantimbang[]" value="'+data.val2[i].perolehan_produksi_awaldet_bahantimbang+'" required '+read+'/>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahankulit'+(i+1)+'" name="perolehan_produksi_awaldet_bahankulit[]" value="'+data.val2[i].perolehan_produksi_awaldet_bahankulit+'" required '+read+'/>\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_awaldet_bahantong'+(i+1)+'" name="perolehan_produksi_awaldet_bahantong[]" value="'+data.val2[i].perolehan_produksi_awaldet_bahantong+'" required '+read+'/>\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" disabled="disabled" onclick="removeDetail('+(i+1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        '); 
                    }
                    for(var i = 0; i < data.val3.length; i++){
                        // var read;
                        if(data.val3[i].perolehan_produksi_akhirdet_status == 1)
                        {
                            read = 'readonly';
                        }
                        else 
                        {
                            read = '';
                        }
                        $("#default-table2 tbody").append('\
                            <tr id="detailJadi'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="perolehan_produksi_akhirdet_id[]" value="'+data.val3[i].perolehan_produksi_akhirdet_id+'"/>\
                                    <input type="hidden" name="jadwal_produksi_akhirdet_id[]" value="'+data.val3[i].t_jadwal_produksi_akhirdet_id+'"/>\
                                    <input type="hidden" name="barang_id[]" value="'+data.val3[i].barang_id+'"/>\
                                    '+data.val3[i].barang_kode+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_berat'+(i+1)+'" name="perolehan_produksi_akhirdet_berat[]" value="'+data.val3[i].perolehan_produksi_akhirdet_berat+'" required '+read+'/>\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_panjang'+(i+1)+'" name="perolehan_produksi_akhirdet_panjang[]" value="'+data.val3[i].perolehan_produksi_akhirdet_panjang+'" required '+read+'/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_tebal'+(i+1)+'" name="perolehan_produksi_akhirdet_tebal[]" value="'+data.val3[i].perolehan_produksi_akhirdet_tebal+'" required '+read+'/>\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_micro'+(i+1)+'" name="perolehan_produksi_akhirdet_micro[]" value="'+data.val3[i].perolehan_produksi_akhirdet_micro+'" required '+read+'/>\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_qty'+(i+1)+'" name="perolehan_produksi_akhirdet_qty[]" onchange="getTotal()" value="'+data.val3[i].perolehan_produksi_akhirdet_qty+'" required '+read+'/>\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_ns'+(i+1)+'" name="perolehan_produksi_akhirdet_ns[]" onchange="getAfalan()" value="'+data.val3[i].perolehan_produksi_akhirdet_ns+'" required '+read+'/>\
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_qty_rusak'+(i+1)+'" name="perolehan_produksi_akhirdet_qty_rusak[]" onchange="getRusak()" value="'+data.val3[i].perolehan_produksi_akhirdet_qty_rusak+'" required '+read+'/>\
                                </td>\
                                <td id="td9'+(i+1)+'">\
                                    <input type="text" class="form-control num" id="perolehan_produksi_akhirdet_konversi'+(i+1)+'" name="perolehan_produksi_akhirdet_konversi[]" value="'+data.val3[i].perolehan_produksi_akhirdet_konversi+'" required '+read+'/>\
                                </td>\
                                <td id="td10'+(i+1)+'">\
                                    <textarea class="form-control" name="perolehan_produksi_akhirdet_ket[]" id="perolehan_produksi_akhirdet_ket'+(i+1)+'" '+read+'>'+data.val3[i].perolehan_produksi_akhirdet_keterangan+'</textarea>\
                                </td>\
                                <td id="td11'+(i+1)+'">\
                                    <button type="button" id="removeBtnJadi'+(i+1)+'" class="btn red-thunderbird" disabled="disabled" onclick="removeDetailJadi('+(i+1)+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
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