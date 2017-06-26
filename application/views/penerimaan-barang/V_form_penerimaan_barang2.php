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

                                        <input type="hidden" id="url" value="Pembelian/Penerimaan-Barang/postData/">

                                        <input type="hidden" id="url_data" value="Pembelian/Penerimaan-Barang">

                                        <input type="hidden" name="penerimaan_barang_status" value="0">

                                        <div class="form-group" hidden="true">

                                            <label class="control-label col-md-4">ID BPB (Auto)

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>

                                            </div>

                                        </div>

                                        <div class="form-group" hidden="true" id="KodeBPB">

                                            <label class="control-label col-md-4">Kode BPB (Auto)

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <input type="text" class="form-control" name="penerimaan_barang_nomor" readonly /> </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Tanggal BPB

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <div class=" input-group date datepicker" data-date-format="dd/mm/yyyy">

                                                        <input name="penerimaan_barang_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" required>

                                                        <span class="input-group-addon" style="">

                                                            <span class="icon-calendar"></span>

                                                        </span>

                                                    </div> 

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Tanggal Terima BPB

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <div class="input-group date datepicker" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">

                                                        <input type="text" class="form-control" name="penerimaan_barang_tanggal_terima" required>

                                                        <span class="input-group-addon" style="">

                                                            <span class="icon-calendar"></span>

                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Jenis BPB

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <label class="mt-radio"> Bukti Penerimaan Barang

                                                        <input type="radio" value="0" name="penerimaan_barang_jenis" id="penerimaan_barang_jenis1" onchange="getRef(this)" required />

                                                        <span></span>

                                                    </label>

                                                    <label class="mt-radio"> Bukti Penerimaan Barang Jadi

                                                        <input type="radio" value="1" name="penerimaan_barang_jenis" id="penerimaan_barang_jenis2" onchange="getRef(this)" required />

                                                        <span></span>

                                                    </label>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Nama Pemeriksa

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <select class="form-control" id="penerimaan_barang_pemeriksa" name="penerimaan_barang_pemeriksa" aria-required="true" aria-describedby="select-error" required>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Nama Penyetuju

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <select class="form-control" id="penerimaan_barang_penyetuju" name="penerimaan_barang_penyetuju" aria-required="true" aria-describedby="select-error" required>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Gudang Masuk

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <select class="form-control" id="m_gudang_id" name="m_gudang_id" aria-required="true" aria-describedby="select-error" required >

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Nomor SJ

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-8">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <input type="text" class="form-control" name="penerimaan_barang_sj" required /> </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-md-4">Nomor PO/WO

                                                <span class="required"> * </span>

                                            </label>

                                            <div class="col-md-7">

                                                <div class="input-icon right">

                                                    <i class="fa"></i>

                                                    <select class="form-control" id="t_order_id" name="t_order_id" aria-required="true" aria-describedby="select-error" required>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-md-1">

                                                <button type="button" id="btnAddPO" class="btn sbold dark" onclick="addPO()"><i class="icon-plus"></i></button>

                                            </div>

                                        </div>

                                        <hr>

                                        <div class="form-group" id="tblInsert">

                                            <div class="col-md-12">

                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />

                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" style="display: block; overflow: auto;" id="default-table">

                                                    <thead>

                                                        <tr>

                                                            <th> No </th>

                                                            <th> Artikel </th>

                                                            <th> Uraian dan Spesifikasi Barang/Jasa </th>

                                                            <th> Qty Terima </th>

                                                            <th> Satuan </th>

                                                            <th> Verifikasi </th>

                                                            <th> Harga Satuan </th>

                                                            <th> Potongan </th>

                                                            <th> Total </th>

                                                            <th> Keterangan </th>

                                                        </tr>

                                                    </thead>

                                                    <tbody id="tableTbody">

                                                    </tbody>

                                                    <tfoot>

                                                        <tr>

                                                            <th colspan="8" class="text-right"> Sub Total </th>

                                                            <th colspan="2">

                                                                <input type="text" class="form-control money" id="penerimaan_barang_subtotal" name="penerimaan_barang_subtotal" value="0" required readonly />

                                                            </th>

                                                        </tr>

                                                        <tr>

                                                            <th colspan="8" class="text-right"> PPN % </th>

                                                            <th colspan="2">

                                                                <div class="input-group">

                                                                    <input type="text" class="form-control decimal" id="penerimaan_barang_ppn" name="penerimaan_barang_ppn" value="0" onchange="sumTotal()" required />

                                                                    <span class="input-group-addon" style="">

                                                                        % 

                                                                    </span>

                                                                </div>

                                                            </th>

                                                        </tr>

                                                        <tr>

                                                            <th colspan="8" class="text-right"> Total </th>

                                                            <th colspan="2">

                                                                <input type="text" class="form-control money" id="penerimaan_barang_total" name="penerimaan_barang_total" value="0" required readonly />

                                                            </th>

                                                        </tr>

                                                    </tfoot>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <label class="control-label col-md-4">Catatan

                                        </label>

                                        <div class="col-md-8">

                                            <div class="input-icon right">

                                                <i class="fa"></i>

                                                <textarea class="form-control" rows="3" name="penerimaan_barang_catatan"></textarea> </div>

                                        </div>

                                    </div>

                                    <div class="form-actions">

                                        <div class="row">

                                            <div class="col-md-offset-4 col-md-8 text-right">

                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>

                                                <a href="<?php echo base_url();?>Pembelian/Penerimaan-Barang">

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
                console.log("sam");
                rules();

                itemBarang = 0;

                $("#formAdd").submit(function(event){

                  if ($("#formAdd").valid() == true) {

                    actionData2();

                  }

                  return false;

                });

                $('#penerimaan_barang_penyetuju').css('width', '100%');

                $('#penerimaan_barang_pemeriksa').css('width', '100%');

                $('#t_order_id').css('width', '100%');

                $('#m_gudang_id').css('width', '100%');

                selectList_karyawan("#penerimaan_barang_penyetuju");

                selectList_karyawan("#penerimaan_barang_pemeriksa");

                selectList_purchaseOrder("#t_order_id");

                selectList_gudangCabang("#m_gudang_id");

                if (document.getElementsByName("kode")[0].value != null) {

                    editData(document.getElementsByName("kode")[0].value);

                }

            });



            function editData(id) {

                $.ajax({

                  type : "GET",

                  url  : '<?php echo base_url();?>Pembelian/Penerimaan-Barang/loadDataWhere/',

                  data : "id="+id,

                  dataType : "json",

                  success:function(data){

                    for(var i=0; i<data.val.length;i++){

                      document.getElementsByName("kode")[0].value = data.val[i].kode;

                      document.getElementsByName("penerimaan_barang_nomor")[0].value = data.val[i].penerimaan_barang_nomor;

                      document.getElementsByName("penerimaan_barang_tanggal")[0].value = data.val[i].penerimaan_barang_tanggal;

                      document.getElementsByName("penerimaan_barang_tanggal")[0].disabled = true;

                      document.getElementsByName("penerimaan_barang_tanggal_terima")[0].value = data.val[i].penerimaan_barang_tanggal_terima;

                      document.getElementsByName("penerimaan_barang_tanggal_terima")[0].disabled = true;

                      document.getElementsByName("penerimaan_barang_sj")[0].value = data.val[i].penerimaan_barang_sj;

                      document.getElementsByName('penerimaan_barang_sj')[0].disabled = true;

                      document.getElementsByName("penerimaan_barang_status")[0].value = data.val[i].penerimaan_barang_status;

                      document.getElementsByName("penerimaan_barang_catatan")[0].value = data.val[i].penerimaan_barang_catatan;

                      document.getElementsByName('penerimaan_barang_catatan')[0].disabled = true;

                      

                      if (data.val[i].penerimaan_barang_jenis == 0) {

                        document.getElementById('penerimaan_barang_jenis1').checked = true;

                      } else if (data.val[i].penerimaan_barang_jenis == 1) {

                        document.getElementById('penerimaan_barang_jenis2').checked = true;

                      }



                      $("#m_gudang_id").select2('destroy');

                      for(var j=0; j<data.val[i].m_gudang_id.val2.length; j++){

                        $("#m_gudang_id").append('<option value="'+data.val[i].m_gudang_id.val2[j].id+'" selected>'+data.val[i].m_gudang_id.val2[j].text+'</option>');

                      }

                      $("#m_gudang_id").select2();

                      document.getElementsByName('m_gudang_id')[0].disabled = true;



                      for(var j=0; j<data.val[i].t_order_id.val2.length; j++){

                        $("#t_order_id").append('<option value="'+data.val[i].t_order_id.val2[j].id+'" selected>'+data.val[i].t_order_id.val2[j].text+'</option>');

                      }

                      $("#t_order_id").select2();

                      document.getElementsByName('t_order_id')[0].disabled = true;



                      for(var j=0; j<data.val[i].penerimaan_barang_pemeriksa.val2.length; j++){

                        $("#penerimaan_barang_pemeriksa").append('<option value="'+data.val[i].penerimaan_barang_pemeriksa.val2[j].id+'" selected>'+data.val[i].penerimaan_barang_pemeriksa.val2[j].text+'</option>');

                      }

                      $("#penerimaan_barang_pemeriksa").select2();

                      document.getElementsByName('penerimaan_barang_pemeriksa')[0].disabled = true;



                      for(var j=0; j<data.val[i].penerimaan_barang_penyetuju.val2.length; j++){

                        $("#penerimaan_barang_penyetuju").append('<option value="'+data.val[i].penerimaan_barang_penyetuju.val2[j].id+'" selected>'+data.val[i].penerimaan_barang_penyetuju.val2[j].text+'</option>');

                      }

                      $("#penerimaan_barang_penyetuju").select2();

                      document.getElementsByName('penerimaan_barang_penyetuju')[0].disabled = true;



                      document.getElementsByName("penerimaan_barang_subtotal")[0].value = data.val[i].penerimaan_barang_subtotal;

                      document.getElementsByName("penerimaan_barang_ppn")[0].value = data.val[i].penerimaan_barang_ppn;

                      document.getElementsByName("penerimaan_barang_total")[0].value = data.val[i].penerimaan_barang_total;



                      if (data.val[i].penerimaan_barang_status > 2) {

                        document.getElementById('submit'). disabled = true;

                      }

                      document.getElementById('btnAddPO').disabled = true;

                    }



                    itemBarang = data.val2.length;

                    $("#jml_itemBarang").val(itemBarang);

                    $("#KodeBPB").attr('hidden', false);



                    for(var i = 0; i < data.val2.length; i++){

                        if (data.val2[i].penerimaan_barangdet_verifikasi == 1) {

                            var checked = "checked";

                            var disabled = "disabled";

                        } else {

                            var checked = "";

                            var disabled = "";

                        }

                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    <input type="hidden" name="penerimaan_barangdet_id[]" value="'+data.val2[i].penerimaan_barangdet_id+'"/>\
                                    '+data.val2[i].barang_nomor+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                        <input type="text" class="form-control num2" id="penerimaan_barangdet_qty'+(i+1)+'" name="penerimaan_barangdet_qty[]" value="'+data.val2[i].penerimaan_barangdet_qty+'" required readonly />\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                    <input type="checkbox" value="1" id="penerimaan_barangdet_verifikasi'+(i+1)+'" name="penerimaan_barangdet_verifikasi[]" '+checked+' '+disabled+' />\
                                </td>\
                                <td id="td6'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="penerimaan_barangdet_harga_satuan'+(i+1)+'" name="penerimaan_barangdet_harga_satuan[]" value="'+data.val2[i].penerimaan_barangdet_harga_satuan+'" onchange="sumSubTotal()" required/>\
                                </td>\
                                <td id="td7'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="penerimaan_barangdet_potongan'+(i+1)+'" name="penerimaan_barangdet_potongan[]" value="'+data.val2[i].penerimaan_barangdet_potongan+'" onchange="sumSubTotal()" required/>\
                                </td>\
                                <td id="td8'+(i+1)+'">\
                                    <input type="text" class="form-control money" id="penerimaan_barangdet_total'+(i+1)+'" name="penerimaan_barangdet_total[]" value="'+data.val2[i].penerimaan_barangdet_total+'" readonly required/>\
                                </td>\
                                <td id="td9'+(i+1)+'">\
                                    <textarea style="width:200px;" class="form-control" rows="3" name="penerimaan_barangdet_keterangan[]">'+data.val2[i].penerimaan_barangdet_keterangan+'</textarea>\
                                </td>\
                            </tr>');

                        $('.num2').number( true, 2, '.', ',' );

                        $('.num2').css('text-align', 'right');

                        $('.num2').css('width', '150px');

                    }

                    $('.money').number( true, 2, '.', ',' );

                    $('.money').css('text-align', 'right');

                    $('.money').css('width', '150px');

                  }

                });

                

            }



            function sumSubTotal() {

                subTotal = 0;

                for (var i = 1; i <= itemBarang; i++) {

                    qty = document.getElementById('penerimaan_barangdet_qty'+i).value;

                    hrg = parseFloat(document.getElementById('penerimaan_barangdet_harga_satuan'+i).value.replace(/\,/g, ""));

                    pot = parseFloat(document.getElementById('penerimaan_barangdet_potongan'+i).value.replace(/\,/g, ""));

                    document.getElementById('penerimaan_barangdet_total'+i).value = qty * hrg - pot;

                    subTotal += qty * hrg - pot;

                }

                document.getElementById('penerimaan_barang_subtotal').value = subTotal;

                $('.money').number( true, 2, '.', ',' );

                $('.money').css('text-align', 'right');

                sumTotal();

            }



            function sumTotal() {

                subTotal = parseFloat(document.getElementById('penerimaan_barang_subtotal').value.replace(/\,/g, ""));

                ppn = parseFloat(document.getElementById('penerimaan_barang_ppn').value.replace(/\,/g, ""));

                document.getElementById('penerimaan_barang_total').value = subTotal + (subTotal * ppn / 100);

                $('.money').number( true, 2, '.', ',' );

                $('.money').css('text-align', 'right');

            }

        </script>



    </body>



</html>