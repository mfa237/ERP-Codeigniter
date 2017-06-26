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
                                        <span class="caption-subject font-dark sbold uppercase">Form
                                          <?php if(isset($title_page2)) echo $title_page2;?>
                                        </span>
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
                                        <input type="hidden" id="url" value="Gudang/Penerimaan-Barang/postData/">
                                        <input type="hidden" id="url_data" value="Gudang/Penerimaan-Barang">
                                        <input type="hidden" name="penerimaan_barang_status" value="0">
                                        <div class="form-group" hidden="true">
                                            <label class="control-label col-md-4">ID BPB (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" id="kode" name="kode"
                                                    value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
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
                                                    <div class=" input-group date datepicker datepickerid" data-date-format="dd/mm/yyyy">
                                                        <input name="penerimaan_barang_tanggal" type="text"
                                                        value="<?php echo date('d/m/Y');?>" class="form-control" required>
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
                                                    <div class="input-group date datepicker datepickerid"
                                                     data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                                        <input type="text" class="form-control" name="penerimaan_barang_tanggal_terima" required>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
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
                                        </div> -->
                                        <input type="hidden" value="0" name="penerimaan_barang_jenis" id="penerimaan_barang_jenis1"
                                        onchange="getRef( this)" required />
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nama Pemeriksa
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="penerimaan_barang_pemeriksa" name="penerimaan_barang_pemeriksa"
                                                    aria-required="true" aria-describedby="select-error" required>
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
                                                    <select class="form-control" id="penerimaan_barang_penyetuju" name="penerimaan_barang_penyetuju"
                                                    aria-required="true" aria-describedby="select-error">
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
                                                    <select class="form-control" id="m_gudang_id" name="m_gudang_id" aria-required="true"
                                                    aria-describedby="select-error" required >
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
                                            <label class="control-label col-md-4">Nomor PO
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_order_id" name="t_order_id" aria-required="true"
                                                    aria-describedby="select-error" required>
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
                                                <div id="divfilter" class="col-md-4">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <select onchange="selectloaddata(this);">
                                                          <option value="1"> All </option>
                                                          <option value="2"> Delcom </option>
                                                          <option value="2"> Barang Kurang </option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                </div>
                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                id="default-table" style="overflow: scroll; white-space: inherit;">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Artikel </th>
                                                            <th> Uraian dan Spesifikasi Barang/Jasa </th>
                                                            <th id="qty-po"> Qty Kurang </th>
                                                            <th> Qty Terima </th>
                                                            <th> Satuan </th>
                                                            <th id="delcom-po"> Status </th>
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableTbody">
                                                    </tbody>
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
                                                <a href="<?php echo base_url();?>Gudang/Penerimaan-Barang">
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
                // $('.multiSelect').select2({
                //   multiple: true,
                //   tags:["India", "Japan", "Australia","Singapore"],
                //   tokenSeparators: [","]
                // });
                rules();
                itemBarang = 0;
                isDisabledVar = true;
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true)
                  {
                    checkPO();
                    // actionData2();
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
                    isDisabledVar = false;
                    editData(document.getElementsByName("kode")[0].value);
                }

            });

            function addPO() {
                var id = document.getElementsByName('t_order_id')[0].value;
                if (id.length > 0) {
                    getDetailPO(id);
                }
            }

            function removePO(itemSeq) {
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

            function getDetailPO(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Pembelian/Purchase-Order/loadDataWhere/',
                  data : "id="+id,
                  cache: false,
                  dataType : "json",
                  success:function(data){
                    $("#default-table tbody").empty();

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);

                    for(var i = 0; i < data.val2.length; i++){
                        if (data.val2[i].orderdet_status == 0) {
                            $("#default-table tbody").append('\
                                <tr id="detail'+(i+1)+'">\
                                    <td id="td0'+(i+1)+'">\
                                        '+(i+1)+'\
                                    </td>\
                                    <td id="td1'+(i+1)+'">\
                                        <input type="hidden" name="orderdet_id[]" value="'+data.val2[i].orderdet_id+'"/>\
                                        <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                        '+data.val2[i].barang_nomor+'\
                                    </td>\
                                    <td id="td2'+(i+1)+'">\
                                        '+data.val2[i].barang_uraian+'\
                                    </td>\
                                    <td id="td3'+(i+1)+'">\
                                        <input type="text" class="form-control num2" id="orderdet_qty'+(i+1)+'" name="orderdet_qty_realisasi[]"\
                                        value="'+(data.val2[i].orderdet_qty - data.val2[i].orderdet_qty_realisasi)+'" required readonly />\
                                    </td>\
                                    <td id="td4'+(i+1)+'">\
                                          <input type="text" class="form-control num2" id="penerimaan_barangdet_qty'+(i+1)+'"\
                                        name="penerimaan_barangdet_qty[]" value="0" required />\
                                    </td>\
                                    <td id="td5'+(i+1)+'">\
                                        '+data.val2[i].satuan_nama+'\
                                    </td>\
                                    <td id="td5'+(i+1)+'">\
                                        '+data.val2[i].satuan_nama+'\
                                    </td>\
                                    <td id="td6'+(i+1)+'">\
                                        <button type="button" id="removeBtn'+(i+1)+'" class="btn red-thunderbird" onclick="removePO('+(i+1)+')">\
                                            <i class="icon-close"></i>\
                                        </button>\
                                    </td>\
                                </tr>\
                            ');
                            $("#penerimaan_barang_no_seri"+(i+1)).tagsinput();
                            $("#penerimaan_barang_qty_no_seri"+(i+1)).tagsinput({
                                allowDuplicates: true
                            });
                            $('.num2').number( true, 2, '.', ',' );
                            $('.num2').css('text-align', 'right');
                        }
                    }
                  }
                });
            }

            function getRef(element) {
              var id = element.id;
              // alert(id);
              if(id == 'penerimaan_barang_jenis1')
              {
                $("#t_order_id").select2();
                $("#t_order_id").select2('destroy');
                $("#t_order_id").select2();
                selectList_purchaseOrder("#t_order_id");
              }
              else
              {
                $("#t_order_id").select2();
                $("#t_order_id").select2('destroy');
                $("#t_order_id").select2();
                selectList_workOrder("#t_order_id");
              }
            }

            function qtyTerima(){
                for(var j = 0; j < itemBarang; j++)
                {
                    var qtyTerima = 0;
                    var qty = document.getElementById('penerimaan_barang_qty_no_seri'+(j+1)).value.split(',');
                    for(var i = 0; i < qty.length; i++)
                    {
                        // alert(qty[i]);
                        qtyTerima = qtyTerima + parseFloat(qty[i]);
                    }
                    document.getElementById('penerimaan_barangdet_qty'+(j+1)).value = qtyTerima;
                }
            }

            function editData(id , Paramid) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Gudang/Penerimaan-Barang/loadDataWhere',
                  data : {id:id, Paramid:Paramid},
                  cache: false,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("penerimaan_barang_nomor")[0].value = data.val[i].penerimaan_barang_nomor;
                      document.getElementsByName("penerimaan_barang_tanggal")[0].value = data.val[i].penerimaan_barang_tanggal;
                      document.getElementsByName("penerimaan_barang_tanggal")[0].disabled = true;
                      document.getElementsByName("penerimaan_barang_tanggal_terima")[0].value = data.val[i].penerimaan_barang_tanggal_terima;
                      document.getElementsByName("penerimaan_barang_tanggal_terima")[0].disabled = true;
                      document.getElementsByName("penerimaan_barang_status")[0].value = data.val[i].penerimaan_barang_status;
                      document.getElementsByName("penerimaan_barang_sj")[0].value = data.val[i].penerimaan_barang_sj;
                      document.getElementsByName('penerimaan_barang_sj')[0].disabled = true;
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
                        $("#penerimaan_barang_pemeriksa").append('<option value="'+data.val[i].penerimaan_barang_pemeriksa.val2[j].id+'"\
                        selected>'+data.val[i].penerimaan_barang_pemeriksa.val2[j].text+'</option>');
                      }
                      $("#penerimaan_barang_pemeriksa").select2();
                      document.getElementsByName('penerimaan_barang_pemeriksa')[0].disabled = true;

                      for(var j=0; j<data.val[i].penerimaan_barang_penyetuju.val2.length; j++){
                        $("#penerimaan_barang_penyetuju").append('<option value="'+data.val[i].penerimaan_barang_penyetuju.val2[j].id+'"\
                        selected>'+data.val[i].penerimaan_barang_penyetuju.val2[j].text+'</option>');
                      }
                      $("#penerimaan_barang_penyetuju").select2();
                      document.getElementsByName('penerimaan_barang_penyetuju')[0].disabled = true;

                      document.getElementById('submit'). disabled = true;
                      document.getElementById('btnAddPO').disabled = true;
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);
                    $("#qty-po").addClass("hidden");
                    $("#KodeBPB").attr('hidden', false);

                    var html = [];
                    for(var i = 0; i < data.val2.length; i++){
                        if (data.val2[i].penerimaan_barangdet_verifikasi == 1) {
                            var checked = "checked";
                        } else {
                            var checked = "";
                        }
                        html += '<tr id="detail' + (i+1) + '">';
                        html += '<td id="td0' + (i+1) +'">' + (i+1) +
                                '</td>';
                        html += '<td id="td1' + (i+1) + '"><input type="hidden" name="m_barang_id[]" value="' + data.val2[i].m_barang_id + '"/>'+ data.val2[i].barang_nomor +'</td>';
                        html += '<td id="td2' + (i+1) + '">' + data.val2[i].barang_uraian +'</td>';
                        html += '<td id="td3' + (i+1) + '">' +
                                '<input type="text" class="form-control num2" id="penerimaan_barangdet_qty' + (i+1) + '"'+
                                ' name="penerimaan_barangdet_qty[]" value="' + data.val2[i].penerimaan_barangdet_qty + '" required readonly />'+
                                '</td>';
                        html += '<td id="td4' + (i+1) + '">' + data.val2[i].satuan_nama + '</td>';
                        html += '<td id="td5' + (i+1) + '">';
                        if (data.val2[i].statusdelcom == 1) {html += '<span class="label bg-red-thunderbird"> Delcom </span>';}
                        html += '</td>';
                        html += '<td id="td6' + (i+1) + '">';
                        if (data.val2[i].statusdelcom == 1) {

                        html +=     '<button type="button" id="removedelcomPOBtn' + (i+1) + '" class="btn green-jungle"' +
                                    'onclick="removedelcomPO(' + (i+1) + ', ' + data.val2[i].m_barang_id + ',' + data.val2[i].penerimaan_barangdet_id + ')">' +
                                    '<i class="icon-power"></i>' +
                                    '</button>';

                                  } else {

                        html +=   '<button type="button" id="delcomPOBtn' + (i+1) + '" class="btn red-thunderbird" ' +
                                  'onclick="delcomPO(' + (i+1) + ', ' + data.val2[i].m_barang_id + ', ' + data.val2[i].penerimaan_barangdet_id + ')">' +
                                  '<i class="icon-power"></i>' +
                                  '</button>';
                                  }

                        html += '</td></tr>';

                        $("#default-table tbody").append('');
                        $("#penerimaan_barang_no_seri"+(i+1)).tagsinput();
                        $("#penerimaan_barang_qty_no_seri"+(i+1)).tagsinput();
                        $("#penerimaan_barang_no_seri"+(i+1)).attr('disabled','disabled');
                        $("#penerimaan_barang_qty_no_seri"+(i+1)).attr('disabled','disabled');
                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                        if(isDisabledVar !== true){
                            $("#penerimaan_barang_no_seri"+(i+1)).removeAttr('disabled');
                        }
                    }
                    $("#default-table tbody").append(html);
                    $("#delcom-po").removeClass("hidden");
                    // $("#divfilter").removeClass("hidden");
                  }
                });
            }

            function checkPO() {
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Gudang/Penerimaan-Barang/checkPO/',
                    cache: false,
                    data : { id : document.getElementById('t_order_id').value },
                    dataType : "json",
                    success:function(data){
                        if (data.status == '200') {
                            actionData2();
                        } else if (data.status == '204') {
                            openForm2('Login/formLogin/1', '#modal_login');
                            $(".datepickerid").removeClass('datepicker');
                        }
                    }
                });
            }

            function delcomPO(index , barang_id, penerimaan_barangdet_id){
              var paramArr = [];
              paramArr.push({name:'penerimaan_barangdet_id', value:penerimaan_barangdet_id},
                            {name:'barang_id', value: barang_id});
              var url = "Gudang/Penerimaan-Barang/editstatusPO";
              postData2(paramArr, url);
            }

            function removedelcomPO(index , barang_id, penerimaan_barangdet_id){
              var paramArr = [];
              paramArr.push({name:'penerimaan_barangdet_id', value:penerimaan_barangdet_id},
                            {name:'removedelcomPO', value:1},
                            {name:'barang_id', value: barang_id});
              var url = "Gudang/Penerimaan-Barang/editstatusPO";

              postData2(paramArr, url);
            }

            function getQtyresult(data){
              if(data.status=='200'){
                  window.scrollTo(0, 0);
                  swal({
                      title: "Success!",
                      text: "Berhasil!",
                      type: "success",
                      confirmButtonClass: "btn-raised btn-success",
                      confirmButtonText: "OK",
                  });
              } else if (data.status=='204') {
                  swal({
                      title: "Alert!",
                      text: "Gagal!",
                      type: "error",
                      confirmButtonClass: "btn-raised btn-danger",
                      confirmButtonText: "OK",
                  });
              }
              $("#default-table tbody").html('');
              editData($('#kode').val());
            }

            function selectloaddata(elem){
              var Paramid = $(elem).val();
              var kode = $('#kode').val();
              if (kode) {
                $("#default-table tbody").html('');
                editData($('#kode').val(), Paramid);
              } else {
                alert()
              }
            }

        </script>

    </body>

</html>
