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
                                        <input type="hidden" id="url" value="Penjualan/Surat-Jalan/postData/">
                                        <input type="hidden" id="url_data" value="Penjualan/Surat-Jalan">
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
                                                    <label class="mt-radio hidden"> Retur
                                                        <input type="radio" value="0" name="surat_jalan_jenis" id="surat_jalan_jenis1" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio hidden"> Work Order
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
                                            <label class="control-label col-md-4">DP
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="mt-radio-inline">
                                                    <i class="fa"></i>
                                                    <label class="mt-radio"> DP
                                                        <input type="radio" value="0" name="surat_jalan_dp" id="surat_jalan_dp1" required />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Non DP
                                                        <input type="radio" value="1" name="surat_jalan_dp" id="surat_jalan_dp2" required />
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Pilih SO dengan PPN
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <label class="mt-radio"> Ya
                                                        <input type="radio" value="1" name="po_customer_ppn" id="po_customer_ppn1" readonly checked />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> Tidak
                                                        <input type="radio" value="2" name="po_customer_ppn" id="po_customer_ppn2" readonly />
                                                        <span></span>
                                                    </label> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Partner
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="m_partner_id" name="m_partner_id" aria-required="true" aria-describedby="select-error" required >
                                                    </select>
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
                                                    <div id="noRef">
                                                    </div>
                                                    <select class="form-control" id="t_order_id" name="t_order_id" multiple="multiple" onchange="getDetail()" required>
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
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Barang
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" name="barang" id="barang"></select> 
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddBarang" class="btn sbold dark" onclick="addBarang()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblDetail">
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column table-scroll" id="default-table" style="display: block; overflow: auto;">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> No SO </th>
                                                            <th> Kode Barang </th>
                                                            <th> Nama Barang </th>
                                                            <th> Qty </th>
                                                            <th> Qty Kirim </th>
                                                            <th> Satuan </th>
                                                            <th> Konversi </th>
                                                            <th> Konversi Satuan </th>
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
                                                <a href="<?php echo base_url();?>Penjualan/Surat-Jalan">
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
                items = 0;
                itemTable = 0;
                barang = [];
                konversi = 0;
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
                selectList_customer("#m_partner_id");
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
                // selectList_SOCustomerMultiple("#t_order_id");
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

            $('#m_partner_id').on('select2:select', function (evt) {
                var ppn;
                $("#t_order_id").select2();
                $("#t_order_id").select2('destroy');
                $("#t_order_id").empty();
                if(document.getElementById('po_customer_ppn1').checked)
                {
                    ppn = 1;
                }
                else
                {
                    ppn = 2
                }
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere2/',
                    data : {id:$(evt.currentTarget).find("option:selected").val(),ppn:ppn},
                    dataType : "json",
                    success:function(data){
                        if(data.val != null)
                        {
                            $('#t_order_id').append('<option></option>');
                            for(var i = 0; i < data.val.length; i++)
                            {
                                if((document.getElementById('surat_jalan_dp1').checked) && (data.val[i].so_customer_sisa_dp > 0)) {
                                    $('#t_order_id').append('<option value="'+data.val[i].kode+'">'+data.val[i].so_customer_nomor+'</option>');
                                    $('#t_order_id').removeAttr('multiple');
                                }
                                else if((document.getElementById('surat_jalan_dp2').checked) && (data.val[i].so_customer_sisa_dp <= 0)) {
                                    $('#t_order_id').append('<option value="'+data.val[i].kode+'">'+data.val[i].so_customer_nomor+'</option>');
                                    $('#t_order_id').attr('multiple', 'multiple');
                                }
                            }

                            $("#t_order_id").select2({placeholder: 'Pilih Nomor SO Customer'});
                        }
                        
                        
                    }
                });
                
            });

            // function addPenawaran() {
            //     var id = document.getElementsByName('order_referensi_id')[0].value;
            //     if (id.length > 0) {
            //         getDetailPenawaran(id);
            //     }
            // }

            function getDetail() {
                // alert('masuk');
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
                                      <input type="text" class="form-control num2" id="surat_jalandet_qty_kirim'+(i+1)+'" name="surat_jalandet_qty_kirim[]" value="" required />\
                                  </td>\
                                  <td id="td5'+(i+1)+'">\
                                      '+data.val2[i].satuan_nama+'\
                                  </td>\
                                  <td id="td6'+(i+1)+'">\
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
                    // alert('masuk3');   
                    $('#tbodyDetail').empty();
                    $('#noRef').empty();
                    items = 0;
                    barang = [];
                    var id = $('#t_order_id').select2('val');
                    $("#submit").removeAttr("disabled");
                    for(var j = 0; j < id.length; j++)
                    {
                        $("#noRef").append('<input type="hidden" name="id[]" value="'+id[j]+'">');
                        $.ajax({
                            type : "GET",
                            url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere/',
                            data : "id="+id[j],
                            dataType : "json",
                            success:function(data){
                                for(var i=0; i<data.val.length;i++){
                                    getDetailPOCustomer(data.val[i].t_po_customer_id.val2[0].id, data.val[i].so_customer_nomor);
                                }
                                $("#default-table tbody").empty();
                            }
                        });
                    }
                  
                }
            }

            function getDetailPOCustomer(id, text) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for (var i = 0; i < data.val.length; i++) {
                        if(document.getElementsByName('kode')[0].value == null)
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
                        items++;
                        var detbarang = {
                            barang_id : data.val2[i].m_barang_id,
                            barang_kode : data.val2[i].barang_kode,
                            barang_nama : data.val2[i].barang_nama,
                            po_id : data.val2[i].po_customerdet_id,
                            qty : data.val2[i].po_customerdet_qty,
                            satuan : data.val2[i].satuan_nama,
                            status : data.val2[i].po_customerdet_status,
                            keterangan : data.val2[i].po_customerdet_keterangan,
                            konversi : data.val2[i].konversi,
                            satuan_konversi : data.val2[i].satuan_konversi,
                            barang_index : items-1,
                            no_so : text,
                            barang_added : false
                        };
                        barang[items-1] = detbarang;
                        if(document.getElementsByName('kode')[0].value.length > 0)
                        {
                            $.ajax({
                                type : "GET",
                                url  : '<?php echo base_url();?>Penjualan/Surat-Jalan/loadDataQtyKirimWhere/',
                                data : {id: barang[items-1]['po_id'], items: barang[items-1]['barang_index'], sj_id: document.getElementsByName('kode')[0].value},
                                dataType : "json",
                                success:function(data){
                                    if(data.val.length > 0)
                                    {
                                        barang[data.val[0].items]['barang_added'] = true;
                                        addBarang(data.val[0].items);
                                        document.getElementById('surat_jalandet_qty_kirim'+itemTable).value = data.val[0].surat_jalandet_qty_kirim;
                                        hitungKonversi(itemTable);
                                    }
                                }
                            });
                        }
                    }
                    $("#barang").empty();
                    for(var i = 0; i < barang.length; i++)
                    {
                        if((barang[i]['barang_added'] == false) && (barang[i]['status'] == 4))
                        {
                            $("#barang").append('<option value="'+barang[i]['barang_index']+'">'+barang[i]['barang_nama']+'</option>');
                        }
                    }
                    $("#barang").select2();
                  } 
                });
            }

            function addBarang(index = null)
            {
                itemTable++;
                if(index == null)
                {
                    index = document.getElementById("barang").value;
                    barang[index]['barang_added'] = true;
                    $("#barang").empty();
                    for(var i = 0; i < barang.length; i++)
                    {
                        if((barang[i]['barang_added'] == false) && (barang[i]['status'] == 4))
                        {
                            $("#barang").append('<option value="'+barang[i]['barang_index']+'">'+barang[i]['barang_nama']+'</option>');
                        }
                    }
                    $("#barang").select2();
                }
                $("#default-table tbody").append('\
                    <tr id="detail'+itemTable+'">\
                        <td id="td0'+itemTable+'">\
                            '+itemTable+'\
                        </td>\
                        <td id="td1'+itemTable+'">\
                            '+barang[index]['no_so']+'\
                        </td>\
                        <td id="td2'+itemTable+'">\
                            <input type="hidden" name="po_customerdet_id[]" value="'+barang[index]['po_id']+'"/>\
                            <input type="hidden" name="qty_kirim[]" id="qty_kirim'+itemTable+'" value=""/>\
                            <input type="hidden" name="m_barang_id[]" value="'+barang[index]['barang_id']+'"/>\
                            <input type="hidden" name="so_customer_nomor[]" value="'+barang[index]['no_so']+'"/>\
                            '+barang[index]['barang_kode']+'\
                        </td>\
                        <td id="td3'+itemTable+'">\
                            '+barang[index]['barang_nama']+'\
                        </td>\
                        <td id="td4'+itemTable+'">\
                            <input type="text" class="form-control num2" id="orderdet_qty'+itemTable+'" name="orderdet_qty[]" value="'+barang[index]['qty']+'" required readonly/>\
                        </td>\
                        <td id="td5'+itemTable+'">\
                            <input type="text" class="form-control num2" id="surat_jalandet_qty_kirim'+itemTable+'" name="surat_jalandet_qty_kirim[]" onchange="checkQty('+itemTable+'), hitungKonversi('+itemTable+')" required />\
                        </td>\
                        <td id="td6'+itemTable+'">\
                            '+barang[index]['satuan']+'\
                        </td>\
                        <td id="td7'+itemTable+'">\
                            <input type="hidden" class="form-control num2" id="konversi'+itemTable+'" name="konversi[]" value="'+barang[index]['konversi']+'"/>\
                            <input type="text" class="form-control num2" id="konversi_qty'+itemTable+'" name="konversi_qty[]" value="" readonly/>\
                        </td>\
                        <td id="td8'+itemTable+'">\
                            <input type="text" class="form-control" id="konversi_satuan'+itemTable+'" name="konversi_satuan[]" value="'+barang[index]['satuan_konversi']+'" readonly/>\
                        </td>\
                        <td id="td9'+itemTable+'">\
                          '+barang[index]['keterangan']+'\
                        </td>\
                    </tr>\
                ');
                $('.num2').number( true, 2, '.', ',' );
                $('.num2').css('text-align', 'right');
                $('.num2').css('width', '150px');
                $('.money').number( true, 2, '.', ',' );
                $('.money').css('text-align', 'right');
                $('.money').css('width', '150px');
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Surat-Jalan/loadDataQtyKirimWhere/',
                  data : "id="+barang[index]['po_id'],
                  dataType : "json",
                  success:function(data){
                    var total = 0;
                    for (var i = 0; i < data.val.length; i++) {
                        total = total + data.val[i].surat_jalandet_qty_kirim;
                    }
                    document.getElementById('qty_kirim'+itemTable).value = total;
                  } 
                });
            }

            function hitungKonversi(idx) {
                qtyKirim = parseFloat(document.getElementById("surat_jalandet_qty_kirim"+idx).value.replace(/\,/g, ""));
                konversi = parseFloat(document.getElementById("konversi"+idx).value.replace(/\,/g, ""));
                // alert(qtyKirim);
                // alert(konversi);
                document.getElementById("konversi_qty"+idx).value = qtyKirim/1*konversi;
                $('.num2').number( true, 2, '.', ',' );
                $('.num2').css('text-align', 'right');
                $('.num2').css('width', '150px');
            }

            function checkQty(idx) {
                qty1 = document.getElementById("orderdet_qty"+idx);
                qty2 = document.getElementById("surat_jalandet_qty_kirim"+idx);
                qty3 = document.getElementById("qty_kirim"+idx);
                if ((parseFloat(qty2.value.replace(/\,/g, ""))+parseFloat(qty3.value.replace(/\,/g, ""))) > parseFloat(qty1.value.replace(/\,/g, ""))) {
                    swal({
                        title: "Alert!",
                        text: "Jumlah qty kirim melebihi qty yang belum dikirim!",
                        type: "error",
                        confirmButtonClass: "btn-raised btn-danger",
                        confirmButtonText: "OK",
                    });
                    qty2.value = 0;
                }
            }

            function editData(id, edit = null) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Surat-Jalan/loadDataWhere/',
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
                      // document.getElementById("m_partner_id").disabled = false;
                      for(var j=0; j<data.val[i].m_partner_id.val2.length; j++){
                        $("#m_partner_id").append('<option value="'+data.val[i].m_partner_id.val2[j].id+'" selected>'+data.val[i].m_partner_id.val2[j].text+'</option>');
                      }
                      document.getElementById("m_partner_id").disabled = true;
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
                      document.getElementById("barang").disabled = true;

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