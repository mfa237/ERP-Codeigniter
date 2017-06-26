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

                            <div class="portlet light portlet-fit portlet-datatable bordered" id="form_wizard_1">

                                <div class="portlet-title">

                                    <div class="caption">

                                        <i class=" icon-doc font-dark"></i> &nbsp;&nbsp;

                                        <span class="caption-subject font-dark sbold uppercase">Form <?php if(isset($title_page2)) echo $title_page2;?></span>

                                    </div>

                                </div>

                                <div class="portlet-body">

                                    <form action="#" id="formAdd" class="form-horizontal" method="post">

                                        <div class="form-wizard">

                                            <div class="form-body">

                                                <ul class="nav nav-pills nav-justified steps">

                                                    <li>

                                                        <a href="#tab1" data-toggle="tab" class="step">

                                                            <span class="number"> 1 </span>

                                                            <span class="desc">

                                                                <i class="fa fa-check"></i> Persiapan Penawaran </span>

                                                        </a>

                                                    </li>

                                                    <li>

                                                        <a href="#tab2" data-toggle="tab" class="step">

                                                            <span class="number"> 2 </span>

                                                            <span class="desc">

                                                                <i class="fa fa-check"></i> Pemilihan Supplier </span>

                                                        </a>

                                                    </li>

                                                    <li>

                                                        <a href="#tab3" data-toggle="tab" class="step active">

                                                            <span class="number"> 3 </span>

                                                            <span class="desc">

                                                                <i class="fa fa-check"></i> Pengisian Harga </span>

                                                        </a>

                                                    </li>

                                                    <li>

                                                        <a href="#tab4" data-toggle="tab" class="step">

                                                            <span class="number"> 4 </span>

                                                            <span class="desc">

                                                                <i class="fa fa-check"></i> Penentuan Pemenang </span>

                                                        </a>

                                                    </li>

                                                </ul>

                                                <div id="bar" class="progress progress-striped" role="progressbar">

                                                    <div class="progress-bar progress-bar-success"> </div>

                                                </div>

                                                <div class="tab-content">

                                                    <div class="alert alert-danger display-none">

                                                        <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>

                                                    <div class="alert alert-success display-none">

                                                        <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>

                                                    <input type="hidden" id="url" value="Pembelian/Penawaran-Harga/postData/">

                                                    <input type="hidden" id="url_data" value="Pembelian/Penawaran-Harga">

                                                    <input type="hidden" id="idspp" name="" value="<?php echo $id?>">

                                                    <input type="hidden" name="penawaran_status" value="0">

                                                    <div class="tab-pane active" id="tab1">

                                                        <div class="form-group" hidden="true">

                                                            <label class="control-label col-md-4">ID Penawaran Harga (Auto)

                                                                <span class="required"> * </span>

                                                            </label>

                                                            <div class="col-md-8">

                                                                <div class="input-icon right">

                                                                    <i class="fa"></i>

                                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly />

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="form-group" hidden="true" id="KodePenawaran">

                                                            <label class="control-label col-md-4">Kode Penawaran Harga (Auto)

                                                                <span class="required"> * </span>

                                                            </label>

                                                            <div class="col-md-8">

                                                                <div class="input-icon right">

                                                                    <i class="fa"></i>

                                                                    <input type="text" class="form-control" name="penawaran_nomor" readonly /> </div>

                                                            </div>

                                                        </div>

                                                        <input type="hidden" name="penawaran_jenis" value="1">

                                                        <!-- <div class="form-group">

                                                            <label class="control-label col-md-4">Jenis Penawaran Harga

                                                                <span class="required"> * </span>

                                                            </label>

                                                            <div class="col-md-8">

                                                                <div class="mt-radio-inline">

                                                                    <i class="fa"></i>

                                                                    <label class="mt-radio"> Pembelian

                                                                        <input type="radio" value="1" name="penawaran_jenis" id="penawaran_jenis1" onchange="ubahSPP(this)" required />

                                                                        <span></span>

                                                                    </label>

                                                                    <label class="mt-radio"> Jasa Maklon

                                                                        <input type="radio" value="2" name="penawaran_jenis" id="penawaran_jenis2" onchange="ubahSPP(this)" />

                                                                        <span></span>

                                                                    </label>

                                                                </div>

                                                            </div>

                                                        </div> -->

                                                        <div class="form-group">

                                                            <label class="control-label col-md-4">Tanggal Penawaran Harga

                                                                <span class="required"> * </span>

                                                            </label>

                                                            <div class="col-md-8">

                                                                <div class="input-icon right">

                                                                    <i class="fa"></i>

                                                                    <div class=" input-group">

                                                                        <input name="penawaran_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>

                                                                        <span class="input-group-addon" style="">

                                                                            <span class="icon-calendar"></span>

                                                                        </span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="form-group">

                                                            <label class="control-label col-md-4">Nomor SPP

                                                                <span class="required"> * </span>

                                                            </label>

                                                            <div class="col-md-8">

                                                                <div class="input-icon right">

                                                                    <i class="fa"></i>

                                                                    <input type="hidden" name="jml_spp" value="0">

                                                                    <select class="form-control" id="t_permintaan_pembelian_id" name="t_permintaan_pembelian_id"
                                                                    aria-required="true" aria-describedby="select-error" style="width: 100%" multiple="multiple" onchange="addSPP()">

                                                                    </select>

                                                                </div>



                                                            </div>

                                                        </div>

                                                        <div id="spp" hidden="true">

                                                        </div>

                                                        <hr>

                                                        <div class="form-group" id="tblInsert">

                                                            <div class="col-md-12">

                                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />

                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">

                                                                    <thead>

                                                                        <tr>

                                                                            <th> No </th>

                                                                            <th> Artikel </th>

                                                                            <th> Uraian dan Spesifikasi Barang/Jasa </th>

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

                                                    </div>

                                                    <div class="tab-pane" id="tab2">

                                                        <div class="form-group">

                                                            <label class="control-label col-md-4">Supplier

                                                                <span class="required"> * </span>

                                                            </label>

                                                            <div class="col-md-7">

                                                                <div class="input-icon right">

                                                                    <i class="fa"></i>

                                                                    <select class="form-control" id="m_partner_id" name="m_partner_id" aria-required="true" aria-describedby="select-error" style="width: 100%">

                                                                    </select>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-1">

                                                                <button type="button" id="btnAddSupplier" class="btn sbold dark" onclick="addSupplier()"><i class="icon-plus"></i></button>

                                                            </div>

                                                        </div>

                                                        <hr>

                                                        <div class="form-group" id="tblInsert2">

                                                            <div class="col-md-12">

                                                                <input type="hidden" name="statusSupplier" id="statusSupplier" value="0" />

                                                                <input type="hidden" name="jml_itemSupplier" id="jml_itemSupplier" value="0" />

                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table2">

                                                                    <thead>

                                                                        <tr>

                                                                            <th> No </th>

                                                                            <th> Nama Supplier </th>

                                                                            <th> Nama yang Dihubungi </th>

                                                                            <th> Alamat </th>

                                                                            <th> No Telp/Fax </th>

                                                                            <th> Action </th>

                                                                        </tr>

                                                                    </thead>

                                                                    <tbody id="tableTbody2">

                                                                    </tbody>

                                                                </table>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="tab3">

                                                        <div class="form-group">

                                                            <input type="hidden" name="statusHarga" id="statusHarga" value="0" />

                                                            <div class="col-md-12" id="tblInsert3" style="overflow: scroll;">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="tab4">

                                                        <div class="form-group">

                                                            <input type="hidden" name="statusPemenang" id="statusPemenang" value="0" />

                                                            <div class="col-md-12" id="tblInsert4" style="overflow: scroll;">

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-actions">

                                                <div class="row">

                                                    <div class="col-md-offset-4 col-md-8 text-right">

                                                        <a href="javascript:;">

                                                            <button type="button" class="btn default button-previous">

                                                            Kembali

                                                            </button>

                                                        </a>

                                                        <a href="<?php echo base_url();?>Pembelian/Penawaran-Harga">

                                                            <button type="button" class="btn default">Kembali ke List Penawaran</button>

                                                        </a>

                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut" disabled>

                                                        Lanjut

                                                        </button>

                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut2" disabled>

                                                        Lanjut

                                                        </button>

                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut3">

                                                        Lanjut

                                                        </button>

                                                        <a href="javascript:;">

                                                            <button type="button" id="submit" class="btn green-jungle button-submit">

                                                            Simpan

                                                            </button>

                                                        </a>

                                                        <a href="javascript:;">

                                                            <button type="button" id="submit2" class="btn green-jungle hidden" onclick="otorisasi()">Simpan</button>

                                                        </a>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>

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

                stepPosition = 1;

                itemBarang = parseInt($("#jml_itemBarang").val());

                itemSupplier = parseInt($("#jml_itemSupplier").val());

                last_num = 0;

                last_num2 = 0;

                FormWizard.init();

                selectList_permintaanPembelian('#t_permintaan_pembelian_id', 'Pembelian/Surat-Permintaan-Pembelian/loadDataSelect/1');

                // selectList_permintaanPembelian('#t_permintaan_pembelian_id');

                selectList_supplier("#m_partner_id");

                checkItem();

                if (document.getElementsByName("kode")[0].value != null) {

                    editData(document.getElementsByName("kode")[0].value);

                }

            });



            function ubahSPP(element)

            {

                var id = element.id;

                if(id == 'penawaran_jenis1')

                {

                    selectList_permintaanPembelian('#t_permintaan_pembelian_id', 'Pembelian/Surat-Permintaan-Pembelian/loadDataSelect/1');

                }

                else

                {

                    selectList_permintaanPembelian('#t_permintaan_pembelian_id', 'Pembelian/Surat-Permintaan-Pembelian/loadDataSelect2/1');

                }

            }

            function checkItem() {

                setTimeout(function(){

                    if (stepPosition == 1) {

                        $("#lanjut").removeClass("hidden");

                        $("#lanjut2").addClass("hidden");

                        $("#lanjut3").addClass("hidden");

                        if (itemBarang > 0) {

                            document.getElementById('lanjut').disabled = false;

                        } else {

                            // alert();

                            document.getElementById('lanjut').disabled = true;

                        }

                    } else if (stepPosition == 2) {

                        $("#lanjut").addClass("hidden");

                        $("#lanjut2").removeClass("hidden");

                        $("#lanjut3").addClass("hidden");

                        if (itemSupplier > 0) {

                            document.getElementById('lanjut2').disabled = false;

                        } else {

                            document.getElementById('lanjut2').disabled = true;

                        }

                    } else if (stepPosition == 3) {

                        $("#lanjut").addClass("hidden");

                        $("#lanjut2").addClass("hidden");

                        $("#lanjut3").removeClass("hidden");

                    } else if (stepPosition == 4) {

                    }

                }, 1000);

            }



            function checkPosition(index) {

                var idspp = $('#idspp').val();

                stepPosition = index+1;

                console.log(stepPosition);

                console.log(index);

                if (stepPosition == 1) {

                    $("#lanjut").removeClass("hidden");

                    $("#lanjut2").addClass("hidden");

                    $("#lanjut3").addClass("hidden");

                } else if (stepPosition == 2) {

                    $("#lanjut").addClass("hidden");

                    $("#lanjut2").removeClass("hidden");

                    $("#lanjut3").addClass("hidden");

                } else if (stepPosition == 3) {

                    $("#lanjut").addClass("hidden");

                    $("#lanjut2").addClass("hidden");

                    $("#lanjut3").removeClass("hidden");

                } else {

                  if (idspp) {

                    $("#submit").addClass("hidden");

                    $("#submit2").removeClass("hidden");

                  } else {

                    $("#submit2").addClass("hidden");

                    $("#submit").removeClass("hidden");

                  }

                }



                if (index == 1) {

                    $.ajax({

                      type : "POST",

                      url  : $base_url+''+$("#url").val(),

                      data : $( "#formAdd" ).serialize()+"&step="+index,

                      dataType : "json",

                      success:function(data){

                        if(data.status=='200'){

                            document.getElementsByName("kode")[0].value = data.id;

                            document.getElementsByName("penawaran_nomor")[0].value = data.data.penawaran_nomor;

                            // document.getElementById("btnAddSPP").disabled = true;

                            for (var i = 1; i <= itemBarang; i++) {

                                document.getElementById("removeBtn"+i).disabled = true;

                            }

                        } else if (data.status=='204') {

                        }

                      }

                    });

                    checkItem();

                } else if (index == 2) {

                    $.ajax({

                      type : "POST",

                      url  : $base_url+''+$("#url").val(),

                      data : $( "#formAdd" ).serialize()+"&step="+index,

                      dataType : "json",

                      success:function(data){

                        if(data.status=='200'){

                            document.getElementById("btnAddSupplier").disabled = true;

                            for (var i = 1; i <= itemSupplier; i++) {

                                document.getElementById("penawaran_supplier_kontak"+i).readOnly = true;

                                document.getElementById("removeBtn2"+i).disabled = true;

                            }

                            document.getElementById("statusSupplier").value = 1;

                        } else if (data.status=='204') {

                        }

                      }

                    });

                    checkItem();

                    setTimeout(function(){

                        if (document.getElementById("statusHarga").value == 0) {

                            getDetailHarga(document.getElementsByName("kode")[0].value);

                        }

                    }, 400);

                } else if (index == 3) {

                    $.ajax({

                      type : "POST",

                      url  : $base_url+''+$("#url").val(),

                      data : $( "#formAdd" ).serialize()+"&step="+index,

                      dataType : "json",

                      success:function(data){

                        if(data.status=='200'){

                            document.getElementById("statusHarga").value = 1;

                            for (var i = 1; i <= itemBarang; i++) {

                                for (var j = 1; j <= itemSupplier; j++) {

                                    document.getElementById("penawaran_supplier_tanggal_kirim"+j).disabled = true;

                                    document.getElementById("penawaran_supplier_diskon"+j).readOnly = true;

                                }

                            }

                        } else if (data.status=='204') {

                        }

                      }

                    });

                    setTimeout(function(){

                        if (document.getElementById("statusPemenang").value == 0) {

                            getDetailPemenang(document.getElementsByName("kode")[0].value);

                        }

                    }, 400);

                } else if (index == 4) {

                    $.ajax({

                      type : "POST",

                      url  : $base_url+''+$("#url").val(),

                      data : $( "#formAdd" ).serialize()+"&step="+index,

                      dataType : "json",

                      success:function(data){

                        if(data.status=='200'){

                          alert_success_save();

                          window.location.href = $base_url+''+$("#url_data").val();

                        } else if (data.status=='204') {

                          alert_fail_save();

                        }

                      }

                    });

                }

            }



            function addSPP() {

                var id = $("#t_permintaan_pembelian_id").select2("val");



                // alert(id);

                last_num = 0;

                itemBarang = 0;

                $("#spp").empty();

                $("#default-table tbody").empty();

                for (var i= 0; i< id.length; i++) {

                    getDetailSpp(id[i]);

                    $("#spp").append('<input type="hidden" id="jml_'+id[i]+'">');

                    $("#spp").append('<input type="hidden" name="id[]" value="'+id[i]+'">');

                }



                $("#lanjut").removeAttr('disabled');

                // document.getElementById("#lanjut").disabled = false;

                // $("#t_permintaan_pembelian_id").select2('destroy');

                // $("#t_permintaan_pembelian_id").empty();

                // selectList_permintaanPembelian('#t_permintaan_pembelian_id');

                $("#jml_select").val(id.length);

                // setTimeout(function(){

                //   checkItem();

                // }, 800);

            }



            function removeSPP(itemSeq, idSPP) {

                var parent = document.getElementById("tableTbody");

                var jmlItem = document.getElementById("jml_"+idSPP).value;

                jmlItem--;

                document.getElementById("jml_"+idSPP).value = jmlItem;

                for (var i = 1; i <= itemBarang; i++) {

                  if (i >= itemSeq && i < itemBarang) {

                    document.getElementById("td1"+i).innerHTML = document.getElementById("td1"+(i+1)).innerHTML;

                    document.getElementById("td2"+i).innerHTML = document.getElementById("td2"+(i+1)).innerHTML;

                    document.getElementById("td3"+i).innerHTML = document.getElementById("td3"+(i+1)).innerHTML;

                    document.getElementById("td4"+i).innerHTML = document.getElementById("td4"+(i+1)).innerHTML;

                    document.getElementById("td5"+i).innerHTML = document.getElementById("td5"+(i+1)).innerHTML;

                  };

                };

                for (var i = 1; i <= itemBarang; i++) {

                  if (i==itemBarang) {

                    var child = document.getElementById("detail"+i);

                    parent.removeChild(child);

                  };

                };

                last_num--;

                itemBarang--;

                if(jmlItem <= 0)

                {

                    $("#t_permintaan_pembelian_id > option[value="+idSPP+"]").removeAttr("selected");

                    $("#t_permintaan_pembelian_id").trigger("change");

                }

                checkItem();

            }



            function removeSPPSelect()

            {

                $("#jml_itemBarang").val(itemBarang);

                var id = $("#t_permintaan_pembelian_id").select2("val");

                // $("#t_permintaan_pembelian_id").select2('val', 0);



                    // alert(id[j]);

                var inputs = document.querySelectorAll("input[name='t_permintaan_pembelian_id[]']");

                for (var i = 0; i < document.getElementsByName("t_permintaan_pembelian_id"); i++) {

                    for(var j = 0; j < id.length; j++)

                    {

                        // alert(inputs[i].value);

                        if(inputs[i].value == id[j])

                        {



                            id.splice(j, 1);

                        }

                    }



                }



                //

            }



            function getDetailSpp(id) {

              // alert(id);

                $.ajax({

                  type : "POST",

                  url  : '<?php echo base_url();?>Gudang/Surat-Permintaan-Pembelian/loadDataWhere/',

                  data : { id : id },

                  dataType : "json",

                  success:function(data){

                        if($("#jml_select").val() > $("#t_permintaan_pembelian_id").select2("val"))

                        {

                            itemBarang -= data.val2.length;

                        }

                        else

                        {

                            itemBarang += data.val2.length;

                        }



                    $("#jml_"+id).val(data.val2.length);

                    $("#jml_itemBarang").val(itemBarang);

                    // alert(itemBarang);

                    for(var i = 0; i < data.val2.length; i++){

                        if (data.val2[i].permintaan_pembeliandet_status == 0) {

                            last_num++;

                            $("#default-table tbody").append('\
                                <tr id="detail'+last_num+'">\
                                    <td id="td0'+last_num+'">\
                                        '+last_num+'\
                                    </td>\
                                    <td id="td1'+last_num+'">\
                                        <input type="hidden" name="t_permintaan_pembelian[]" value="'+id+'"/>\
                                        <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                        <input type="hidden" name="penawaran_barang_id[]" value="'+data.val2[i].permintaan_pembeliandet_id+'"/>\
                                        '+data.val2[i].barang_nomor+'\
                                    </td>\
                                    <td id="td2'+last_num+'">\
                                        '+data.val2[i].barang_nama+' ('+data.val2[i].barang_nomor+' , '+data.val2[i].jenis_barang_nama+')\
                                    </td>\
                                    <td id="td3'+last_num+'">\
                                        <input type="text" class="form-control num2" name="penawaran_barang_qty[]" value="'+data.val2[i].permintaan_pembeliandet_qty+'" required readonly/>\
                                    </td>\
                                    <td id="td4'+last_num+'">\
                                        '+data.val2[i].satuan_nama+'\
                                    </td>\
                                    <td id="td5'+last_num+'">\
                                        <button type="button" id="removeBtn'+last_num+'" class="btn red-thunderbird" onclick="removeSPP('+(last_num-1)+', '+id+'), removeSPPSelect()">\
                                            <i class="icon-close"></i>\
                                        </button>\
                                    </td>\
                                </tr>\
                            ');

                            $('.num2').number( true, 2, '.', ',' );

                        }

                    }

                  }

                });

            }



            function addSupplier() {

                var id = document.getElementsByName('m_partner_id')[0].value;

                if (id.length > 0) {

                    getDetailSupplier(id);

                }

                $("#m_partner_id").select2('destroy');

                $("#m_partner_id").empty();

                selectList_supplier("#m_partner_id");

                setTimeout(function(){

                  checkItem();

                }, 800);

            }



            function removeSupplier(itemSeq) {

                var parent = document.getElementById("tableTbody2");

                for (var i = 1; i <= itemSupplier; i++) {

                  if (i >= itemSeq && i < itemSupplier) {

                    document.getElementById("td21"+i).innerHTML = document.getElementById("td21"+(i+1)).innerHTML;

                    document.getElementById("td22"+i).innerHTML = document.getElementById("td22"+(i+1)).innerHTML;

                    document.getElementById("td23"+i).innerHTML = document.getElementById("td23"+(i+1)).innerHTML;

                    document.getElementById("td24"+i).innerHTML = document.getElementById("td24"+(i+1)).innerHTML;

                    document.getElementById("td25"+i).innerHTML = document.getElementById("td25"+(i+1)).innerHTML;

                  };

                };

                for (var i = 1; i <= itemSupplier; i++) {

                  if (i==itemSupplier) {

                    var child = document.getElementById("detail2"+i);

                    parent.removeChild(child);

                  };

                };

                last_num2--;

                itemSupplier--;

                $("#jml_itemSupplier").val(itemSupplier);

                checkItem();

            }



            function getDetailSupplier(id) {

                $.ajax({

                  type : "GET",

                  url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',

                  data : { id : id },

                  dataType : "json",

                  success:function(data){



                    itemSupplier += data.val.length;

                    $("#jml_itemSupplier").val(itemSupplier);



                    for(var i = 0; i < data.val.length; i++){

                        last_num2++;

                        $("#default-table2 tbody").append('\
                            <tr id="detail2'+last_num2+'">\
                                <td id="td20'+last_num2+'">\
                                    '+last_num2+'\
                                </td>\
                                <td id="td21'+last_num2+'">\
                                    <input type="hidden" name="m_partner_id[]" value="'+data.val[i].kode+'"/>\
                                    '+data.val[i].partner_nama+'\
                                </td>\
                                <td id="td22'+last_num2+'">\
                                    <input type="text" class="form-control" id="penawaran_supplier_kontak'+last_num2+'" name="penawaran_supplier_kontak[]" value="'+data.val[i].partner_nama+'\" required/>\
                                </td>\
                                <td id="td23'+last_num2+'">\
                                    '+data.val[i].partner_alamat+'\
                                </td>\
                                <td id="td24'+last_num2+'">\
                                    '+data.val[i].partner_telepon2+'\
                                </td>\
                                <td id="td25'+last_num2+'">\
                                    <button type="button" id="removeBtn2'+last_num2+'" class="btn red-thunderbird" onclick="removeSupplier('+i+')">\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');

                    }

                  }

                });

            }



            function getDetailHarga(id) {

                $.ajax({

                  type : "GET",

                  url  : '<?php echo base_url();?>Pembelian/Penawaran-Harga/loadDataHarga/',

                  data : { id : id },

                  dataType : "html",

                  success:function(data){

                    $("#tblInsert3").empty();

                    $("#tblInsert3").append(data);

                  }

                });

            }



            function getDetailPemenang(id) {

                $.ajax({

                  type : "GET",

                  url  : '<?php echo base_url();?>Pembelian/Penawaran-Harga/loadDataPemenang/',

                  data : { id : id },

                  dataType : "html",

                  success:function(data){

                    $("#tblInsert4").empty();

                    $("#tblInsert4").append(data);

                  }

                });

            }



            function checkPemenang(idx) {

                if (document.getElementById('penawaran_supplier_pemenang2'+idx).checked == true) {

                    document.getElementById('penawaran_supplier_pemenang'+idx).value = 1;

                } else {

                    document.getElementById('penawaran_supplier_pemenang'+idx).value = 0;

                }

            }



            function editData(id) {

                $( "#formAdd" ).validate().destroy();

                $.ajax({

                  type : "POST",

                  url  : '<?php echo base_url();?>Pembelian/Penawaran-Harga/loadDataWhere/',

                  data : "id="+id,

                  dataType : "json",

                  success:function(data){

                    for(var i=0; i<data.val.length;i++){

                      if (data.val[i].penawaran_status > 3) {

                        document.getElementById('submit').disabled = true;

                        document.getElementById('submit2').disabled = true;

                      }

                      if (data.step3 > 0) {

                        getDetailHarga2(data.val[i].kode);

                      }

                      if (data.step4 > 0) {

                        getDetailPemenang2(data.val[i].kode);

                      }

                      document.getElementsByName("kode")[0].value = data.val[i].kode;

                      document.getElementsByName("penawaran_nomor")[0].value = data.val[i].penawaran_nomor;

                      document.getElementsByName("penawaran_tanggal")[0].value = data.val[i].penawaran_tanggal;

                      document.getElementsByName("penawaran_status")[0].value = data.val[i].penawaran_status;

                      // if (data.val[i].penawaran_jenis == 1) {

                      //   document.getElementById('penawaran_jenis1').checked = true;

                      // } else if (data.val[i].penawaran_jenis == 2) {

                      //   document.getElementById('penawaran_jenis2').checked = true;

                      // }

                      $("#t_permintaan_pembelian_id").select2("destroy");

                      for(var j=0; j<data.val[i].permintaan_pembelian_id.val1.length; j++){

                        $("#t_permintaan_pembelian_id").append('<option value="'+data.val[i].permintaan_pembelian_id.val1[j].id+'" selected>'+data.val[i].permintaan_pembelian_id.val1[j].text+'</option>');

                      }

                      $("#t_permintaan_pembelian_id").select2();

                      $("#t_permintaan_pembelian_id").attr("disabled", "disabled");

                      // document.getElementById('penawaran_jenis1').disabled = true;

                      // document.getElementById('penawaran_jenis2').disabled = true;

                      // document.getElementById('btnAddSPP').disabled = true;

                      checkItem();

                    }



                    itemBarang = data.step1.length;

                    $("#jml_itemBarang").val(itemBarang);



                    for(var i = 0; i < data.step1.length; i++){

                        last_num++;

                        $("#default-table tbody").append('\
                            <tr id="detail'+last_num+'">\
                                <td id="td0'+last_num+'">\
                                    '+last_num+'\
                                </td>\
                                <td id="td1'+last_num+'">\
                                    <input type="hidden" name="t_permintaan_pembelian[]" value="'+data.step1[i].t_permintaan_pembelian+'"/>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.step1[i].m_barang_id+'"/>\
                                    <input type="hidden" name="penawaran_barang_id[]" value="'+data.step1[i].penawaran_barang_id+'"/>\
                                    '+data.step1[i].barang_nomor+'\
                                </td>\
                                <td id="td2'+last_num+'" style="">\
                                  <p style="max-width: 400px;white-space:normal !important;word-wrap: break-word;">'+data.step1[i].barang_uraian+'</p>\
                                </td>\
                                <td id="td3'+last_num+'">\
                                    <input type="text" class="form-control num2" name="penawaran_barang_qty[]" value="'+data.step1[i].penawaran_barang_qty+'" required readonly/>\
                                </td>\
                                <td id="td4'+last_num+'">\
                                    '+data.step1[i].satuan_nama+'\
                                </td>\
                                <td id="td5'+last_num+'">\
                                    <button type="button" id="removeBtn'+last_num+'" class="btn red-thunderbird" onclick="removeSPP('+i+')" disabled>\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');

                        $('.num2').number( true, 2, '.', ',' );

                    }



                    itemSupplier = data.step2.length;

                    $("#jml_itemSupplier").val(itemSupplier);

                    if (itemSupplier > 0) {

                        $("#statusSupplier").val(1);

                    }



                    for(var i = 0; i < data.step2.length; i++){

                        last_num2++;

                        $("#default-table2 tbody").append('\
                            <tr id="detail2'+last_num2+'">\
                                <td id="td20'+last_num2+'">\
                                    '+last_num2+'\
                                </td>\
                                <td id="td21'+last_num2+'">\
                                    <input type="hidden" name="m_partner_id[]" value="'+data.step2[i].m_partner_id+'"/>\
                                    '+data.step2[i].partner_nama+'\
                                </td>\
                                <td id="td22'+last_num2+'">\
                                    <input type="text" class="form-control" id="penawaran_supplier_kontak'+last_num2+'" name="penawaran_supplier_kontak[]" value="'+data.step2[i].penawaran_supplier_kontak+'\" readonly required/>\
                                </td>\
                                <td id="td23'+last_num2+'">\
                                    '+data.step2[i].partner_alamat+'\
                                </td>\
                                <td id="td24'+last_num2+'">\
                                    '+data.step2[i].partner_telepon+'\
                                </td>\
                                <td id="td25'+last_num2+'">\
                                    <button type="button" id="removeBtn2'+last_num2+'" class="btn red-thunderbird" onclick="removeSupplier('+i+')" disabled>\
                                        <i class="icon-close"></i>\
                                    </button>\
                                </td>\
                            </tr>\
                        ');

                    }



                    $("#statusHarga").val(data.step3);

                    $("#statusPemenang").val(data.step4);

                    $("#KodePenawaran").attr('hidden', false);

                  }

                });

            }



            function getDetailHarga2(id) {

                $.ajax({

                  type : "GET",

                  url  : '<?php echo base_url();?>Pembelian/Penawaran-Harga/loadDataHarga2',

                  data : { id : id },

                  dataType : "html",

                  success:function(data){

                    $("#tblInsert3").empty();

                    $("#tblInsert3").append(data);

                  }

                });

            }



            function getDetailPemenang2(id) {

                $.ajax({

                  type : "GET",

                  url  : '<?php echo base_url();?>Pembelian/Penawaran-Harga/loadDataPemenang2/',

                  data : { id : id },

                  dataType : "html",

                  success:function(data){

                    $("#tblInsert4").empty();

                    $("#tblInsert4").append(data);

                  }

                });

            }



          function otorisasi(id = null) {

                $.ajax({

                    type : 'GET',

                    url  : $base_url+'Login/formLogin/2',

                    data : { id : id },

                    dataType : "html",

                    success:function(data){

                        $("#modal_login .modal-content").html();

                        $("#modal_login .modal-content").html(data);

                        $("#modal_login").modal({backdrop: "static"});

                        MyFormValidation.init();

                        $("#formLogin").submit(function(event) {

                            if ($("#formLogin").valid() == true) {

                                $.ajax({

                                  type : "POST",

                                  url  : '<?php echo base_url();?>Login/checkLogin/2',

                                  data : $( "#formLogin" ).serialize(),

                                  dataType : "json",

                                  success:function(data){

                                    if(data.status=='200'){

                                        $('#modal_login').modal('hide');

                                        window.scrollTo(0, 0);

                                        swal({

                                            title: "Success!",

                                            text: "Otorisasi Berhasil!",

                                            type: "success",

                                            confirmButtonClass: "btn-raised btn-success",

                                            confirmButtonText: "OK",

                                        });

                                        $.ajax({

                                          type : "POST",

                                          url  : $base_url+''+$("#url").val(),

                                          data : $( "#formAdd" ).serialize()+"&step=4",

                                          dataType : "json",

                                          success:function(data){

                                            if(data.status=='200'){

                                              alert_success_save();

                                              window.location.href = $base_url+''+$("#url_data").val();

                                            } else if (data.status=='204') {

                                              alert_fail_save();

                                            }

                                          }

                                        });

                                    } else if (data.status=='204') {

                                        swal({

                                            title: "Alert!",

                                            text: "Otorisasi Gagal!",

                                            type: "error",

                                            confirmButtonClass: "btn-raised btn-danger",

                                            confirmButtonText: "OK",

                                        });

                                    }

                                  }

                                });

                            }

                            return false;

                        });

                    }

                });

          }



        </script>



    </body>



</html>

