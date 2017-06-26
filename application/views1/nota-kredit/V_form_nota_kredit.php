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
                                        <input type="hidden" id="url" value="Penjualan/Nota-Kredit/postData/">
                                        <input type="hidden" id="url_data" value="Penjualan/Nota-Kredit">
                                        <div class="form-group" id="kode" hidden="true">
                                            <label class="control-label col-md-4">ID Nota (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="KodeNota" hidden="true">
                                            <label class="control-label col-md-4">Kode Nota (Auto)
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="nota_kredit_nomor" readonly /> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Tanggal Nota
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div class=" input-group">
                                                        <input name="nota_kredit_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                        <span class="input-group-addon" style="">
                                                            <span class="icon-calendar"></span>
                                                        </span>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Jenis Nota
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="mt-radio-inline">
                                                    <i class="fa"></i>
                                                    <label class="mt-radio"> Retur Penjualan
                                                        <input type="radio" value="0" name="nota_kredit_jenis" id="nota_kredit_jenis1" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio"> BPBR
                                                        <input type="radio" value="1" name="nota_kredit_jenis" id="nota_kredit_jenis2" onchange="getRef(this)" required />
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nomor Refrensi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select class="form-control" id="referensi_id" name="referensi_id" aria-required="true" aria-describedby="select-error" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id="btnAddSJRetur" class="btn sbold dark" onclick="addSJRetur()"><i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group" id="tblInsert">
                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                    <thead>
                                                        <tr>
                                                            <th> No </th>
                                                            <th> Artikel </th>
                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                            <th> Qty </th>
                                                            <th> Satuan </th>
                                                            <th> Harga Barang Satuan </th>
                                                            <th> % Disc </th>
                                                            <th> Harga Barang Total </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Harga Jual Netto </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="nota_kredit_netto" name="nota_kredit_netto" value="0" required readonly />
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Potongan Harga </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="nota_kredit_potongan_harga" name="nota_kredit_potongan_harga" value="0" onchange="sumTotal()" required />
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Uang Muka Diterima </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="nota_kredit_uang_muka" name="nota_kredit_uang_muka" value="0" onchange="sumTotal()" required />
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Total Setelah Potongan & Uang Muka </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="nota_kredit_total2" name="nota_kredit_total2" value="0" required readonly />
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> PPN % </th>
                                                            <th>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control decimal" id="nota_kredit_ppn" name="nota_kredit_ppn" value="10" onchange="sumTotal()" required />
                                                                    <span class="input-group-addon" style="">
                                                                        % 
                                                                    </span>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="7" class="text-right"> Total </th>
                                                            <th>
                                                                <input type="text" class="form-control money" id="nota_kredit_total" name="nota_kredit_total" value="0" required readonly />
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Catatan 
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea class="form-control" rows="3" name="nota_kredit_catatan"></textarea> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-8 text-right">
                                                <button type="submit" id="submit" class="btn green-jungle">Simpan</button>
                                                <a href="<?php echo base_url();?>Penjualan/Nota-Kredit">
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
                datadetail = [];
                noref_faktur = 0;
                harga_satuan = [];
                test = [];
                test2 = [];
                $("#formAdd").submit(function(event){
                  if ($("#formAdd").valid() == true) {
                    actionData2();
                  }
                  return false;
                });
                if (document.getElementsByName("kode")[0].value.length > 0) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function getRef(element) {
              var id = element.id;
              if(id == 'nota_kredit_jenis1')
              {
                $("#referensi_id").select2();
                $("#referensi_id").select2('destroy');
                $("#referensi_id").select2();
                selectList_suratJalanRetur("#referensi_id");
              }
              else if(id == 'nota_kredit_jenis2')
              {
                $("#referensi_id").select2();
                $("#referensi_id").select2('destroy');
                $("#referensi_id").select2();
                selectList_penerimaanBarangRetur("#referensi_id");
              }
            }

            function addSJRetur() {
                var id = document.getElementsByName('referensi_id')[0].value;
                if (id.length > 0) {
                    if (document.getElementById('nota_kredit_jenis1').checked == true) {
                        getDetailSJRetur(id);
                    } else if (document.getElementById('nota_kredit_jenis2').checked == true) {
                        getDetailPenerimaanBarangRetur(id);
                    } 
                }
            }

            function getDetailPenerimaanBarangRetur(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Gudang/Penerimaan-Barang-Retur/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){

                        $.ajax({
                          type : "GET",
                          url  : '<?php echo base_url();?>Marketing/Klaim-Retur-Penjualan/loadDataWhere/',
                          data : { id : id },
                          dataType : "json",
                          success:function(data){
                            for(var i = 0; i < data.val.length; i++){
                            }

                            for(var i = 0; i < data.val2.length; i++){
                                itemBarang++;
                                $("#default-table tbody").append('\
                                    <tr>\
                                        <td>\
                                            '+(i+1)+'\
                                        </td>\
                                        <td>\
                                            <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                            '+data.val2[i].barang_kode+'\
                                        </td>\
                                        <td>\
                                            '+data.val2[i].barang_uraian+'\
                                        </td>\
                                        <td>\
                                            <input type="text" id="nota_kreditdet_qty'+itemBarang+'" name="nota_kreditdet_qty[]" class="form-control num2" value="'+data.val2[i].retur_penjualandet_qty+'" readonly required/>\
                                        </td>\
                                        <td>\
                                            '+data.val2[i].satuan_nama+'\
                                        </td>\
                                        <td>\
                                            <input type="text" id="nota_kreditdet_harga_satuan'+itemBarang+'" name="nota_kreditdet_harga_satuan[]" class="form-control money" value="0" onchange="sumSubTotal()" required/>\
                                        </td>\
                                        <td>\
                                            <input type="text" class="form-control num2" id="nota_kreditdet_discount'+itemBarang+'" name="nota_kreditdet_discount[]" value="0" onchange="sumSubTotal()" required/>\
                                        </td>\
                                        <td>\
                                            <input type="text" id="totalhargabrg'+itemBarang+'" class="form-control money" value="0" readonly/>\
                                        </td>\
                                    </tr>\
                                ');
                                $('.num2').number( true, 2, '.', ',' );
                                $('.num2').css('text-align', 'right');
                            }
                            sumSubTotal();
                          }
                        });
                  }
                });
            }

            function getDetailSJRetur(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Surat-Jalan-Retur/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                        noref_faktur = data.val[i].t_faktur_penjualan_id.val2[0].id;
                    }

                    $.ajax({
                      type : "GET",
                      url  : '<?php echo base_url();?>Penjualan/Sales-Order-Customer/loadDataWhere/',
                      data : "id="+noref_faktur,
                      dataType : "json",
                      success:function(data){
                        for(var i=0; i<data.val.length;i++){
                            $.ajax({
                              type : "GET",
                              url  : '<?php echo base_url();?>Marketing/Purchase-Order-Customer/loadDataWhere/',
                              data : "id="+data.val[i].t_po_customer_id.val2[0].id,
                              dataType : "json",
                              success:function(data){
                                datadetail = data.val2;
                              }
                            });
                        }
                      }
                    });

                    setTimeout(function(){
                        for(var i = 0; i < data.val2.length; i++){
                            // test[i] = data.val2[i].t_po_customerdet_id;
                            for(var j = 0; j < datadetail.length; j++){
                                // test2[j] = datadetail[j].po_customerdet_id;
                                if (data.val2[i].t_po_customerdet_id == datadetail[j].po_customerdet_id) {
                                    harga_satuan[i] = datadetail[j].po_customerdet_harga_satuan;
                                }
                            }
                        }

                        for(var i = 0; i < data.val2.length; i++){
                            itemBarang++;
                            $("#default-table tbody").append('\
                                <tr>\
                                    <td>\
                                        '+itemBarang+'\
                                    </td>\
                                    <td>\
                                        <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                        '+data.val2[i].barang_kode+'\
                                    </td>\
                                    <td>\
                                        '+data.val2[i].barang_uraian+'\
                                    </td>\
                                    <td>\
                                        <input type="text" id="nota_kreditdet_qty'+itemBarang+'" name="nota_kreditdet_qty[]" class="form-control num2" value="'+data.val2[i].sj_returdet_qty_retur+'" readonly required/>\
                                    </td>\
                                    <td>\
                                        '+data.val2[i].satuan_nama+'\
                                    </td>\
                                    <td>\
                                        <input type="text" id="nota_kreditdet_harga_satuan'+itemBarang+'" name="nota_kreditdet_harga_satuan[]" class="form-control money" value="'+harga_satuan[i]+'" readonly/>\
                                    </td>\
                                    <td>\
                                        <input type="text" class="form-control num2" id="nota_kreditdet_discount'+itemBarang+'" name="nota_kreditdet_discount[]" value="0" onchange="sumSubTotal()" required/>\
                                    </td>\
                                    <td>\
                                        <input type="text" id="totalhargabrg'+itemBarang+'" class="form-control money" value="'+(data.val2[i].sj_returdet_qty_retur * harga_satuan)+'" readonly/>\
                                    </td>\
                                </tr>\
                            ');
                            $('.num2').number( true, 2, '.', ',' );
                            $('.num2').css('text-align', 'right');
                            $('.money').number( true, 2, '.', ',' );
                            $('.money').css('text-align', 'right');
                        }
                        sumSubTotal();
                    }, 2000);
                  }
                });
            }

            function sumSubTotal() {
                subTotal = 0;
                for (var i = 1; i <= itemBarang; i++) {
                    qty = parseFloat(document.getElementById('nota_kreditdet_qty'+i).value.replace(/\,/g, ""));
                    hrg = parseFloat(document.getElementById('nota_kreditdet_harga_satuan'+i).value.replace(/\,/g, ""));
                    disc = parseFloat(document.getElementById('nota_kreditdet_discount'+i).value.replace(/\,/g, ""));
                    document.getElementById('totalhargabrg'+i).value = qty * hrg - (qty * hrg * disc / 100);
                    subTotal += qty * hrg - (qty * hrg * disc / 100);
                }
                document.getElementById('nota_kredit_netto').value = subTotal;
                $('.money').number( true, 2, '.', ',' );
                $('.money').css('text-align', 'right');
                sumTotal();
            }

            function sumTotal() {
                subTotal = parseFloat(document.getElementById('nota_kredit_netto').value.replace(/\,/g, ""));
                potongan = parseFloat(document.getElementById('nota_kredit_potongan_harga').value.replace(/\,/g, ""));
                dp = parseFloat(document.getElementById('nota_kredit_uang_muka').value.replace(/\,/g, ""));
                document.getElementById('nota_kredit_total2').value = subTotal - potongan - dp;
                ppn = parseFloat(document.getElementById('nota_kredit_ppn').value.replace(/\,/g, ""));
                document.getElementById('nota_kredit_total').value = (subTotal - potongan - dp) + ((subTotal - potongan - dp) * ppn / 100)
                $('.money').number( true, 2, '.', ',' );
                $('.money').css('text-align', 'right');
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Nota-Kredit/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    $("#default-table tbody").empty();
                    for(var i=0; i<data.val.length;i++){
                        document.getElementById('submit').disabled = true;
                        document.getElementById('btnAddSJRetur').disabled = true;
                        $("#KodeNota").attr('hidden', false);
                        document.getElementsByName("kode")[0].value = data.val[i].kode;
                        document.getElementsByName("nota_kredit_nomor")[0].value = data.val[i].nota_kredit_nomor;
                        document.getElementsByName("nota_kredit_tanggal")[0].value = data.val[i].nota_kredit_tanggal;
                        document.getElementsByName("nota_kredit_tanggal")[0].disabled = true;
                        if (data.val[i].nota_kredit_jenis == 0) {
                            document.getElementById('nota_kredit_jenis1').checked = true;
                        }
                        document.getElementById('nota_kredit_jenis1').disabled = true;
                        $("#referensi_id").select2();
                        $("#referensi_id").select2('destroy');
                        for(var j=0; j<data.val[i].referensi_id.val2.length; j++){
                            $("#referensi_id").append('<option value="'+data.val[i].referensi_id.val2[j].id+'" selected>'+data.val[i].referensi_id.val2[j].text+'</option>');
                        }
                        $("#referensi_id").select2();
                        document.getElementById("referensi_id").disabled = true;
                        document.getElementsByName("nota_kredit_potongan_harga")[0].value = data.val[i].nota_kredit_potongan_harga;
                        document.getElementsByName("nota_kredit_potongan_harga")[0].readOnly = true;
                        document.getElementsByName("nota_kredit_uang_muka")[0].value = data.val[i].nota_kredit_uang_muka;
                        document.getElementsByName("nota_kredit_uang_muka")[0].readOnly = true;
                        document.getElementsByName("nota_kredit_ppn")[0].value = data.val[i].nota_kredit_ppn;
                        document.getElementsByName("nota_kredit_ppn")[0].readOnly = true;
                        document.getElementsByName("nota_kredit_catatan")[0].value = data.val[i].nota_kredit_catatan;
                        document.getElementsByName("nota_kredit_catatan")[0].readOnly = true;
                    }

                    for(var i=0; i<data.val2.length;i++){
                        itemBarang++;
                        $("#default-table tbody").append('\
                            <tr>\
                                <td>\
                                    '+itemBarang+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" id="nota_kreditdet_qty'+itemBarang+'" name="nota_kreditdet_qty[]" class="form-control num2" value="'+data.val2[i].nota_kreditdet_qty+'" readonly required/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" id="nota_kreditdet_harga_satuan'+itemBarang+'" name="nota_kreditdet_harga_satuan[]" class="form-control money" value="'+data.val2[i].nota_kreditdet_harga_satuan+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" id="nota_kreditdet_discount'+itemBarang+'" name="nota_kreditdet_discount[]" value="'+data.val2[i].nota_kreditdet_discount+'" readonly required/>\
                                </td>\
                                <td>\
                                    <input type="text" id="totalhargabrg'+itemBarang+'" class="form-control money" value="0" readonly/>\
                                </td>\
                            </tr>\
                        ');

                        $('.num2').number( true, 2, '.', ',' );
                        $('.num2').css('text-align', 'right');
                        $('.money').number( true, 2, '.', ',' );
                        $('.money').css('text-align', 'right');
                    }
                    setTimeout(function(){
                        sumSubTotal();
                    }, 2000);
                  }
                });
            }
        </script>

    </body>

</html>