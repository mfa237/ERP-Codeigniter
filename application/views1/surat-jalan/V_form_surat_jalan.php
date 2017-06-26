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
                                        <input type="hidden" id="url" value="Gudang/Surat-Jalan/postData/">
                                        <input type="hidden" id="url_data" value="Gudang/Surat-Jalan">
                                        <input type="hidden" name="surat_jalan_status" value="1">
                                        <div class="form-group" id="kode" hidden="true">
                                            <label class="control-label col-md-4">ID Surat Jalan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="sj_nomor" hidden="true">
                                            <label class="control-label col-md-4">Kode Surat Jalan (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="surat_jalan_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Surat Jalan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="surat_jalan_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Kirim Surat Jalan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                              <div class="input-group date datepicker" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                                  <input type="text" class="form-control" name="surat_jalan_tanggal_kirim" id="surat_jalan_tanggal_kirim" required>
                                                  <span class="input-group-addon" style="">
                                                      <span class="icon-calendar"></span>
                                                  </span>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Jenis Surat Jalan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="mt-radio-inline">
                                                    <i class="fa"></i>
                                                    <label class="mt-radio"> Retur
                                                        <input type="radio" value="0" name="surat_jalan_jenis" id="surat_jalan_jenis1" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Work Order
                                                        <input type="radio" value="1" name="surat_jalan_jenis" id="surat_jalan_jenis2" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Sales Order
                                                        <input type="radio" value="3" name="surat_jalan_jenis" id="surat_jalan_jenis3" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">No Referensi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="t_order_id" name="t_order_id" aria-required="true" aria-describedby="select-error" onchange="getDetail()" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Partner
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="m_partner_id" name="m_partner_id" aria-required="true" aria-describedby="select-error" required disabled="true">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Ekspedisi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="surat_jalan_ekspedisi" required /> </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblDetail">
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Kode Barang </th>
                                                            <th> Nama Barang </th>
                                                            <th> Qty </th>
                                                            <th> Satuan </th>
                                                            <th> Keterangan </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyDetail">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Gudang/Surat-Jalan">
                                                <button type="button" class="btn default">Kembali</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="stok" hidden="true">
                                      
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
                $(".datepicker").datepicker();
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    $('#m_partner_id').removeAttr("disabled");
                    actionData2();
                  }
                  return false;
                });
                $('#t_order_id').css('width', '100%');
                $('#m_partner_id').css('width', '100%');
                // selectList_workOrder("#t_order_id");
                // selectList_supplier("#m_partner_id");
                if (document.getElementsByName("kode")[0].value != null) {
                    document.getElementById('submit').disabled = true;
                    $("#sj_nomor").attr("hidden", false);
                    editData(document.getElementsByName("kode")[0].value 
                        <?php 
                            if(isset($edit))
                            {
                                echo ', '.$edit;
                            } 
                        ?>
                    );
                }
            });

            function getRef(element) {
              var id = element.id;
              // alert(id);
              if(id == 'surat_jalan_jenis1')
              {
                $("#t_order_id").select2();
                $("#t_order_id").select2('destroy');
                $("#t_order_id").select2();
                selectList_notaDebet("#t_order_id");
              }
              else if(id == 'surat_jalan_jenis2')
              {
                $("#t_order_id").select2();
                $("#t_order_id").select2('destroy');
                $("#t_order_id").select2();
                selectList_workOrder("#t_order_id");
              }
              else if(id == 'surat_jalan_jenis3')
              {
                $("#t_order_id").select2();
                $("#t_order_id").select2('destroy');
                $("#t_order_id").select2();
                selectList_SOCustomer("#t_order_id");
              }
                // $('#order_referensi_id').select2();
                // $('#order_referensi_id').select2('destroy');
                // $('#order_referensi_id').empty();
                // $.ajax({
                //   type : "GET",
                //   url  : '<?php echo base_url();?>Pembelian/Penawaran-Harga/loadDataSelect3/',
                //   data : { id : document.getElementById('m_supplier_id').value },
                //   dataType : "json",
                //   success:function(data){
                //     for(var i=0; i<data.items.length;i++){
                //         $("#order_referensi_id").append('<option value="'+data.items[i].id+'">'+data.items[i].text+'</option>');
                //     }
                //     $('#order_referensi_id').select2();
                //   }
                // });
            }

            // function addPenawaran() {
            //     var id = document.getElementsByName('order_referensi_id')[0].value;
            //     if (id.length > 0) {
            //         getDetailPenawaran(id);
            //     }
            // }

            function getDetail() {
              var id = document.getElementById("t_order_id").value;
                var jenis = document.getElementById('surat_jalan_jenis1').checked;
                var jenis2 = document.getElementById('surat_jalan_jenis2').checked;
                var jenis3 = document.getElementById('surat_jalan_jenis3').checked;
                
                if(jenis == true)
                {
                  $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Pembelian/Nota-Debet/loadDataWhere/',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                      $("#default-table tbody").empty();
                      $('.money').number( true, 2, '.', ',' );
                      document.getElementById("m_partner_id").disabled = false;
                      for(var i=0; i<data.val.length;i++){
                          $("#m_partner_id").append('<option value="'+data.val[i].partner_id+'" selected>'+data.val[i].partner_nama+'</option>');
                      }
                      document.getElementById("m_partner_id").disabled = true;
                      for(var i = 0; i < data.val2.length; i++){
                          $("#default-table tbody").append('\
                              <tr id="detail'+(i+1)+'">\
                                  <td id="td0'+(i+1)+'">\
                                      '+(i+1)+'\
                                  </td>\
                                  <td id="td1'+(i+1)+'">\
                                      <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                      '+data.val2[i].barang_kode+'\
                                  </td>\
                                  <td id="td2'+(i+1)+'">\
                                      '+data.val2[i].barang_nama+'\
                                  </td>\
                                  <td id="td3'+(i+1)+'">\
                                      <input type="text" class="form-control num2" id="orderdet_qty'+(i+1)+'" name="orderdet_qty[]" value="'+data.val2[i].nota_debetdet_qty+'" required readonly/>\
                                  </td>\
                                  <td id="td4'+(i+1)+'">\
                                      '+data.val2[i].satuan_nama+'\
                                  </td>\
                                  <td id="td5'+(i+1)+'">\
                                    '+data.val2[i].nota_debetdet_keterangan+'\
                                  </td>\
                              </tr>\
                          ');
                          $('.num2').number( true, 2, '.', ',' );
                          $('.num2').css('text-align', 'right');
                      }
                    }
                  });
                  $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Gudang/Surat-Jalan/checkStokNotaDebet',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                      // alert(data.val[0].stok);
                      var pass = true;
                      for(var i=0; i<data.val.length;i++){
                        $("#stok").append('<input type="text" name="stok_barang[] id="stok_barang'+(i+1)+'" value="'+data.val[i].stok+'">');
                        var qty = document.getElementById('orderdet_qty'+(i+1)).value;
                        if(data.val[i].stok-qty < 0)
                        {
                          pass = false;
                        }
                        
                      }
                      if(!pass)
                      {
                        $("#submit").attr("disabled", "disabled");
                        swal({
                            title: "Alert!",
                            text: "Data stok gudang kurang!",
                            type: "error",
                            confirmButtonClass: "btn-raised btn-danger",
                            confirmButtonText: "OK",
                        });
                      }
                      if(pass)
                      {
                        $("#submit").removeAttr("disabled");
                      }
                    }
                  });
                }
                else if(jenis2 == true)
                {
                  $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Pembelian/Work-Order/loadDataWhere/',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                      $("#default-table tbody").empty();
                      $('.money').number( true, 2, '.', ',' );
                      document.getElementById("m_partner_id").disabled = false;
                      for(var i=0; i<data.val.length;i++){
                        for(var j=0; j<data.val[i].m_supplier_id.val2.length; j++){
                          $("#m_partner_id").append('<option value="'+data.val[i].m_supplier_id.val2[j].id+'" selected>'+data.val[i].m_supplier_id.val2[j].text+'</option>');
                        }
                      }
                      document.getElementById("m_partner_id").disabled = true;
                      for(var i = 0; i < data.val2.length; i++){
                          $("#default-table tbody").append('\
                              <tr id="detail'+(i+1)+'">\
                                  <td id="td0'+(i+1)+'">\
                                      '+(i+1)+'\
                                  </td>\
                                  <td id="td1'+(i+1)+'">\
                                      <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                      '+data.val2[i].barang_kode+'\
                                  </td>\
                                  <td id="td2'+(i+1)+'">\
                                      '+data.val2[i].barang_nama+'\
                                  </td>\
                                  <td id="td3'+(i+1)+'">\
                                      <input type="text" class="form-control num2" id="orderdet_qty'+(i+1)+'" name="orderdet_qty[]" value="'+data.val2[i].orderdet_qty+'" required readonly/>\
                                  </td>\
                                  <td id="td4'+(i+1)+'">\
                                      '+data.val2[i].satuan_nama+'\
                                  </td>\
                                  <td id="td5'+(i+1)+'">\
                                    Barang WO\
                                  </td>\
                              </tr>\
                          ');
                          $('.num2').number( true, 2, '.', ',' );
                          $('.num2').css('text-align', 'right');
                      }
                    }
                  });
                  $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Gudang/Surat-Jalan/checkStokWO',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                      var pass = true;
                      // alert(data.val[1].stok);
                      for(var i=0; i<data.val.length;i++){
                        $("#stok").append('<input type="text" name="stok_barang[] id="stok_barang'+(i+1)+'" value="'+data.val[i].stok+'">');
                        var qty = document.getElementById('orderdet_qty'+(i+1)).value;
                        // alert(qty);
                        if(data.val[i].stok-qty < 0)
                        {
                          // alert(data.val[i].stok-qty);
                          pass = false;
                        }
                      }
                      if(!pass)
                      {
                        $("#submit").attr("disabled", "disabled");
                         swal({
                            title: "Alert!",
                            text: "Data stok gudang kurang!",
                            type: "error",
                            confirmButtonClass: "btn-raised btn-danger",
                            confirmButtonText: "OK",
                        });
                      }
                      if(pass)
                      {
                        $("#submit").removeAttr("disabled");
                      }
                    }
                  });
                }
                else if(jenis3 == true)
                {
                  $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere/',
                    data : "id="+id,
                    dataType : "json",
                    success:function(data){
                        for(var i=0; i<data.val.length;i++){
                            getDetailPOCustomer(data.val[i].t_po_customer_id.val2[0].id);
                        }
                        $("#default-table tbody").empty();
                    }
                  });
                }
            }

            function getDetailPOCustomer(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for (var i = 0; i < data.val.length; i++) {
                        if(document.getElementsByName('kode')[0].value.length <= 0)
                        {
                            document.getElementsByName('surat_jalan_ekspedisi')[0].value = data.val[i].po_customer_ekspedisi;
                        }
                        
                        $.ajax({
                          type : "GET",
                          url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                          data : "id="+data.val[i].m_partner_id.val2[0].id,
                          dataType : "json",
                          success:function(data){
                            for(var j=0; j<data.val.length;j++){
                                document.getElementById("m_partner_id").disabled = false;
                                $("#m_partner_id").append('<option value="'+data.val[j].kode+'" selected>'+data.val[j].partner_nama+'</option>');
                                document.getElementById("m_partner_id").disabled = true;
                            }
                          }
                        });
                    }
                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table tbody").append('\
                            <tr id="detail'+(i+1)+'">\
                                <td id="td0'+(i+1)+'">\
                                    '+(i+1)+'\
                                </td>\
                                <td id="td1'+(i+1)+'">\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td id="td2'+(i+1)+'">\
                                    '+data.val2[i].barang_nama+'\
                                </td>\
                                <td id="td3'+(i+1)+'">\
                                    <input type="text" class="form-control num2" id="orderdet_qty'+(i+1)+'" name="orderdet_qty[]" value="'+data.val2[i].po_customerdet_qty+'" required readonly/>\
                                </td>\
                                <td id="td4'+(i+1)+'">\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td id="td5'+(i+1)+'">\
                                  '+data.val2[i].po_customerdet_keterangan+'\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                    }

                  }
                });
            }

            function editData(id, edit = null) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Gudang/Surat-Jalan/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("surat_jalan_nomor")[0].value = data.val[i].surat_jalan_nomor;
                      document.getElementsByName("surat_jalan_tanggal")[0].value = data.val[i].surat_jalan_tanggal;
                      document.getElementsByName("surat_jalan_tanggal_kirim")[0].value = data.val[i].surat_jalan_tanggal_kirim;
                      document.getElementsByName("surat_jalan_status")[0].value = data.val[i].surat_jalan_status;
                      document.getElementsByName("surat_jalan_ekspedisi")[0].value = data.val[i].surat_jalan_ekspedisi;
                      // document.getElementsByName("surat_jalan_jenis")[0].value = data.val[i].order_type;;
                      if (data.val[i].surat_jalan_jenis == 0) {
                        document.getElementById('surat_jalan_jenis1').checked = true;
                      } else if (data.val[i].surat_jalan_jenis == 1) {
                        document.getElementById('surat_jalan_jenis2').checked = true;
                      } else if (data.val[i].surat_jalan_jenis == 3) {
                        document.getElementById('surat_jalan_jenis3').checked = true;
                      }
                      for(var j=0; j<data.val[i].t_order_id.val2.length; j++){
                        $("#t_order_id").append('<option value="'+data.val[i].t_order_id.val2[j].id+'" selected>'+data.val[i].t_order_id.val2[j].text+'</option>');
                      }
                      $("#t_order_id").select2();
                      document.getElementById("m_partner_id").disabled = false;
                      for(var j=0; j<data.val[i].m_partner_id.val2.length; j++){
                        $("#m_partner_id").append('<option value="'+data.val[i].m_partner_id.val2[j].id+'" selected>'+data.val[i].m_partner_id.val2[j].text+'</option>');
                      }
                      document.getElementById("m_partner_id").disabled = true;

                      document.getElementsByName("surat_jalan_tanggal_kirim")[0].disabled = true;
                      document.getElementsByName("surat_jalan_ekspedisi")[0].disabled = true;
                      document.getElementById('surat_jalan_jenis1').disabled = true;
                      document.getElementById('surat_jalan_jenis2').disabled = true;
                      document.getElementById('t_order_id').disabled = true;
                    }
                    getDetail();
                  }
                });
                
            }
        </script>

    </body>

</html>