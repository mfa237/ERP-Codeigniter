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
                                                        <a href="#tab1" data-toggle="tab" class="step active">
                                                            <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Permintaan </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab2" data-toggle="tab" class="step">
                                                            <span class="number"> 2 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Cek Kebijakan </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab3" data-toggle="tab" class="step">
                                                            <span class="number"> 3 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Persetujuan </span>
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
                                                    <input type="hidden" id="url" value="Persetujuan/Klaim-Retur-Penjualan/postData/">
                                                    <input type="hidden" id="url_data" value="Persetujuan/Klaim-Retur-Penjualan">
                                                    <input type="hidden" name="retur_penjualan_status" value="0">
                                                    <div class="tab-pane active" id="tab1">
                                                        <div class="form-group" hidden="true">
                                                            <label class="control-label col-md-4">ID Klaim/Retur (Auto)
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="kode" value="<?php if(isset($id)) echo $id;?>" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" hidden="true" id="Kode">
                                                            <label class="control-label col-md-4">Kode Klaim/Retur (Auto)
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="retur_penjualan_nomor" readonly /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Tanggal Klaim/Retur Harga
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="datepicker input-group">
                                                                        <input name="retur_penjualan_tanggal" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" readonly>
                                                                        <span class="input-group-addon" style="">
                                                                            <span class="icon-calendar"></span>
                                                                        </span>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Pengembalian Barang
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="mt-radio-inline">
                                                                    <i class="fa"></i>
                                                                    <label class="mt-radio"> Ya
                                                                        <input type="radio" value="1" name="retur_penjualan_status_pengembalianbarang" id="retur_penjualan_status_pengembalianbarang1" required />
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio"> Tidak
                                                                        <input type="radio" value="2" name="retur_penjualan_status_pengembalianbarang" id="retur_penjualan_status_pengembalianbarang2" checked />
                                                                        <span></span>
                                                                    </label>
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
                                                                    <select class="form-control" id="t_sj_retur_id" name="t_sj_retur_id" aria-required="true" aria-describedby="select-error" onchange="copySJ()" required>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group" id="tblInsert">
                                                            <div class="col-md-12 table-scroll">
                                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> No </th>
                                                                            <th> Kode Barang </th>
                                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                                            <th> Batch No </th>
                                                                            <th> Qty </th>
                                                                            <th> Satuan </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tableTbody">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Pembayaran
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" name="retur_penjualan_aksi_bayar" /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Alasan/Maksud
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" name="retur_penjualan_alasan"></textarea> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab2">
                                                        <input type="hidden" name="statusStep2" value="0">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Tanggal Klaim/Retur Harga
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="datepicker input-group">
                                                                        <input name="retur_penjualan_tanggal2" id="retur_penjualan_tanggal2" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" disabled>
                                                                        <span class="input-group-addon" style="">
                                                                            <span class="icon-calendar"></span>
                                                                        </span>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Pengembalian Barang
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="mt-radio-inline">
                                                                    <i class="fa"></i>
                                                                    <label class="mt-radio"> Ya
                                                                        <input type="radio" value="1" name="retur_penjualan_status_pengembalianbarang2" id="retur_penjualan_status_pengembalianbarang12" required disabled />
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio"> Tidak
                                                                        <input type="radio" value="2" name="retur_penjualan_status_pengembalianbarang2" id="retur_penjualan_status_pengembalianbarang22" disabled />
                                                                        <span></span>
                                                                    </label>
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
                                                                    <select class="form-control" id="t_sj_retur_id2" name="t_sj_retur_id2" aria-required="true" aria-describedby="select-error" required disabled>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group" id="tblInsert">
                                                            <div class="col-md-12 table-scroll">
                                                                <input type="hidden" name="jml_itemBarang" id="jml_itemBarang" value="0" />
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> No </th>
                                                                            <th> Kode Barang </th>
                                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                                            <th> Batch No </th>
                                                                            <th> Qty </th>
                                                                            <th> Satuan </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tableTbody">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Pembayaran
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" id="retur_penjualan_aksi_bayar2" name="retur_penjualan_aksi_bayar" disabled /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Alasan/Maksud
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" id="retur_penjualan_alasan2" name="retur_penjualan_alasan" disabled></textarea> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Status 
                                                            </label>
                                                            <div class="col-md-8" id="statusstep2">
                                                                -
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <input type="hidden" name="statusStep3" value="0">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Tanggal Klaim/Retur Harga
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <div class="datepicker input-group">
                                                                        <input name="retur_penjualan_tanggal2" id="retur_penjualan_tanggal3" type="text" value="<?php echo date('d/m/Y');?>" class="form-control" disabled>
                                                                        <span class="input-group-addon" style="">
                                                                            <span class="icon-calendar"></span>
                                                                        </span>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Pengembalian Barang
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="mt-radio-inline">
                                                                    <i class="fa"></i>
                                                                    <label class="mt-radio"> Ya
                                                                        <input type="radio" value="1" name="retur_penjualan_status_pengembalianbarang3" id="retur_penjualan_status_pengembalianbarang13" required disabled />
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio"> Tidak
                                                                        <input type="radio" value="2" name="retur_penjualan_status_pengembalianbarang3" id="retur_penjualan_status_pengembalianbarang23" disabled />
                                                                        <span></span>
                                                                    </label>
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
                                                                    <select class="form-control" id="t_sj_retur_id3" name="t_sj_retur_id3" aria-required="true" aria-describedby="select-error" required disabled>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group" id="tblInsert">
                                                            <div class="col-md-12 table-scroll">
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> No </th>
                                                                            <th> Kode Barang </th>
                                                                            <th> Uraian dan Spesifikasi Barang </th>
                                                                            <th> Batch No </th>
                                                                            <th> Qty </th>
                                                                            <th> Satuan </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tableTbody">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Pembayaran
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <input type="text" class="form-control" id="retur_penjualan_aksi_bayar3" disabled /> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Alasan/Maksud
                                                            </label>
                                                            <div class="col-md-8">
                                                                <div class="input-icon right">
                                                                    <i class="fa"></i>
                                                                    <textarea class="form-control" rows="3" id="retur_penjualan_alasan3" disabled></textarea> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Status 
                                                            </label>
                                                            <div class="col-md-8" id="statusstep3">
                                                                -
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
                                                        <a href="<?php echo base_url();?>Persetujuan/Klaim-Retur-Penjualan">
                                                            <button type="button" class="btn default">Kembali ke List Klaim/Retur</button>
                                                        </a>
                                                        <button type="button" class="btn green-jungle hidden" id="simpandraft" onclick="simpanDraft()" disabled>
                                                        Simpan Draft
                                                        </button>
                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut" onclick="checkItem()" disabled>
                                                        Lanjut
                                                        </button>
                                                        <button type="button" class="btn red-thunderbird hidden" id="simpantidaksetuju" onclick="simpanTidakSetuju()" disabled>
                                                        Tidak Setuju
                                                        </button>
                                                        <button type="button" class="btn blue-ebonyclay button-next hidden" id="lanjut2" onclick="checkItem()" disabled>
                                                        Lanjut
                                                        </button>
                                                        <button type="button" class="btn red-thunderbird hidden" id="simpantidaksetuju2" onclick="simpanTidakSetuju()" disabled>
                                                        Tidak Setuju
                                                        </button>
                                                        <a href="javascript:;">
                                                            <button type="button" class="btn green-jungle button-submit" id="simpan">
                                                            Simpan
                                                            </button>
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
                last_num = 0;
                last_num2 = 0;
                FormWizard3.init();
                $('#t_sj_retur_id').css('width', '100%');
                selectList_suratJalanRetur("#t_sj_retur_id");
                checkItem();
                if (document.getElementsByName("kode")[0].value.length > 0) {
                    editData(document.getElementsByName("kode")[0].value);
                }
            });

            function copySJ() {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Penjualan/Surat-Jalan-Retur/loadDataWhere/',
                  data : "id="+document.getElementsByName("t_sj_retur_id")[0].value,
                  dataType : "json",
                  success:function(data){
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
                                    '+data.val2[i].barang_nama+'\
                                </td>\
                                <td>\
                                    <input type="text" id="retur_penjualandet_batch_no'+itemBarang+'" name="retur_penjualandet_batch_no[]" class="form-control" value="" required/>\
                                </td>\
                                <td>\
                                    <input type="text" id="retur_penjualandet_qty'+itemBarang+'" name="retur_penjualandet_qty[]" class="form-control num2" value="'+data.val2[i].sj_returdet_qty_retur+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                            </tr>\
                        ');

                        $('.num2').number( true, 2, '.', ',' );
                        $('.money').number( true, 2, '.', ',' );
                        checkItem();
                    }
                  }
                });
            }

            function checkItem() {
                setTimeout(function(){
                    if (stepPosition == 1) {
                        $("#simpandraft").removeClass("hidden");
                        $("#lanjut").removeClass("hidden");
                        $("#simpantidaksetuju").addClass("hidden");
                        $("#lanjut2").addClass("hidden");
                        $("#lanjut3").addClass("hidden");
                        if (itemBarang > 0) {
                            if (document.getElementsByName('retur_penjualan_status')[0].value <= 1) {
                                document.getElementById('simpandraft').disabled = false;
                            }
                            document.getElementById('lanjut').disabled = false;
                        } else {
                            document.getElementById('simpandraft').disabled = true;
                            document.getElementById('lanjut').disabled = true;
                        }   
                    } else if (stepPosition == 2) {
                        $("#simpandraft").addClass("hidden");
                        $("#lanjut").addClass("hidden");
                        $("#simpantidaksetuju").removeClass("hidden");
                        $("#lanjut2").removeClass("hidden");
                        $("#simpantidaksetuju2").addClass("hidden");
                        $("#lanjut3").addClass("hidden");
                        if (document.getElementsByName("statusStep2")[0].value == 0) {
                            document.getElementById('simpantidaksetuju').disabled = true;
                            document.getElementById('lanjut2').disabled = true;
                        } else {
                            if (document.getElementsByName('retur_penjualan_status')[0].value <= 2) {
                                document.getElementById('simpantidaksetuju').disabled = false;
                                document.getElementById('lanjut2').disabled = false; 
                            } else if (document.getElementsByName('retur_penjualan_status')[0].value > 2) {
                                document.getElementById('lanjut2').disabled = false; 
                            }
                        }
                    } else if (stepPosition == 3) {
                        $("#simpandraft").addClass("hidden");
                        $("#lanjut").addClass("hidden");
                        $("#simpantidaksetuju").addClass("hidden");
                        $("#lanjut2").addClass("hidden");
                        $("#simpantidaksetuju2").removeClass("hidden");
                        $("#lanjut3").addClass("hidden");
                        if (document.getElementsByName('retur_penjualan_status')[0].value != 5 && document.getElementsByName('retur_penjualan_status')[0].value != 4) {
                            document.getElementById('simpantidaksetuju2').disabled = false;
                        } else {
                            document.getElementById('simpantidaksetuju2').disabled = true;
                            document.getElementById('simpan').disabled = true;
                        }
                    }
                }, 1000);
            }

            function checkPosition(index) {
                stepPosition = index+1;
                if (stepPosition == 1) {
                    $("#simpandraft").removeClass("hidden");
                    $("#lanjut").removeClass("hidden");
                    $("#simpantidaksetuju").addClass("hidden");
                    $("#lanjut2").addClass("hidden");
                    $("#simpantidaksetuju2").addClass("hidden");
                    $("#lanjut3").addClass("hidden");
                } else if (stepPosition == 2) {
                    $("#simpandraft").addClass("hidden");
                    $("#lanjut").addClass("hidden");
                    $("#simpantidaksetuju").removeClass("hidden");
                    $("#lanjut2").removeClass("hidden");
                    $("#simpantidaksetuju2").addClass("hidden");
                    $("#lanjut3").addClass("hidden");
                } else if (stepPosition == 3) {
                    $("#simpandraft").addClass("hidden");
                    $("#lanjut").addClass("hidden");
                    $("#simpantidaksetuju").addClass("hidden");
                    $("#lanjut2").addClass("hidden");
                    $("#simpantidaksetuju2").removeClass("hidden");
                    $("#lanjut3").addClass("hidden");
                }

                if (index == 1) {
                    if (document.getElementsByName('retur_penjualan_status')[0].value <= 1) {
                        document.getElementsByName('retur_penjualan_status')[0].value = 2;
                        $.ajax({
                          type : "POST",
                          url  : $base_url+''+$("#url").val(),
                          data : $( "#formAdd" ).serialize()+"&step="+index,
                          dataType : "json",
                          success:function(data){
                            if(data.status=='200'){
                                document.getElementsByName("kode")[0].value = data.id;
                                document.getElementsByName("retur_penjualan_nomor")[0].value = data.nomor;
                                $("#Kode").attr('hidden', false);
                                document.getElementsByName("t_sj_retur_id")[0].disabled = true;
                                document.getElementsByName("retur_penjualan_aksi_bayar")[0].readOnly = true;
                                document.getElementsByName("retur_penjualan_alasan")[0].readOnly = true;
                                for (var i = 1; i <= itemBarang; i++) {
                                    document.getElementById("retur_penjualandet_batch_no"+i).readOnly = true;
                                }
                                getDetailKebijakan(document.getElementsByName("kode")[0].value);
                            } else if (data.status=='204') {
                            }
                          }
                        });
                        checkItem();   
                    }
                } else if (index == 2) {
                    if (document.getElementsByName('retur_penjualan_status')[0].value <= 2) {
                        document.getElementsByName('retur_penjualan_status')[0].value = 3;
                        $.ajax({
                          type : "POST",
                          url  : $base_url+''+$("#url").val(),
                          data : $( "#formAdd" ).serialize()+"&step="+index,
                          dataType : "json",
                          success:function(data){
                            if(data.status=='200'){
                                document.getElementById("statusstep2").innerHTML = '<span class="label bg-green-jungle bg-font-green-jungle"> Diterima </span>';
                                document.getElementById('simpantidaksetuju').disabled = true;
                                document.getElementsByName("statusStep3").value = 1;
                                document.getElementById('simpan').disabled = true;
                                document.getElementById("statusstep3").innerHTML = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Menunggu Persetujuan </span>';
                            } else if (data.status=='204') {
                            }
                          }
                        });
                        checkItem();
                    }
                } else if (index == 3) {
                    document.getElementsByName('retur_penjualan_status')[0].value = 4;
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
                checkItem();
            }

            function simpanDraft() {
                document.getElementsByName('retur_penjualan_status')[0].value = 1;
                $.ajax({
                  type : "POST",
                  url  : $base_url+''+$("#url").val(),
                  data : $( "#formAdd" ).serialize()+"&step=1",
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

            function simpanTidakSetuju() {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Data Klain/Retur tidak akan dilanjutkan!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-raised btn-warning",
                    cancelButtonText: "Cancel!",
                    confirmButtonClass: "btn-raised btn-danger",
                    confirmButtonText: "Yes!",
                    closeOnConfirm: false
                }, function() {
                    document.getElementsByName('retur_penjualan_status')[0].value = 5;
                    $.ajax({
                      type : "POST",
                      url  : $base_url+''+$("#url").val(),
                      data : $( "#formAdd" ).serialize()+"&step=2",
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
                });
            }

            function getDetailKebijakan(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Klaim-Retur-Penjualan/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        document.getElementById("retur_penjualan_tanggal2").value = data.val[i].retur_penjualan_tanggal;
                        document.getElementById("t_sj_retur_id2").disabled = false;
                        for(var j=0; j<data.val[i].t_sj_retur_id.val2.length; j++){
                            $("#t_sj_retur_id2").append('<option value="'+data.val[i].t_sj_retur_id.val2[j].id+'" selected>'+data.val[i].t_sj_retur_id.val2[j].text+'</option>');
                        }
                        document.getElementById("t_sj_retur_id2").disabled = true;
                        if (data.val[i].retur_penjualan_status_pengembalianbarang == 1) {
                            document.getElementById("retur_penjualan_status_pengembalianbarang12").checked = true;
                        } else {
                            document.getElementById("retur_penjualan_status_pengembalianbarang22").checked = true;
                        }
                        document.getElementById("retur_penjualan_aksi_bayar2").value = data.val[i].retur_penjualan_aksi_bayar;
                        document.getElementById("retur_penjualan_alasan2").value = data.val[i].retur_penjualan_alasan;
                    }

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" value="'+data.val2[i].retur_penjualandet_batch_no+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].retur_penjualandet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, '.', ',' );
                        $('.money').number( true, 2, '.', ',' );
                    }
                    document.getElementById("statusstep2").innerHTML = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Menunggu Pengecekan </span>';
                  }
                });
            }

            function getDetailPersetujuan(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Klaim-Retur-Penjualan/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        document.getElementById("retur_penjualan_tanggal3").value = data.val[i].retur_penjualan_tanggal;
                        document.getElementById("t_sj_retur_id3").disabled = false;
                        for(var j=0; j<data.val[i].t_sj_retur_id.val2.length; j++){
                            $("#t_sj_retur_id3").append('<option value="'+data.val[i].t_sj_retur_id.val2[j].id+'" selected>'+data.val[i].t_sj_retur_id.val2[j].text+'</option>');
                        }
                        document.getElementById("t_sj_retur_id3").disabled = true;
                        if (data.val[i].retur_penjualan_status_pengembalianbarang == 1) {
                            document.getElementById("retur_penjualan_status_pengembalianbarang13").checked = true;
                        } else {
                            document.getElementById("retur_penjualan_status_pengembalianbarang23").checked = true;
                        }
                        document.getElementById("retur_penjualan_aksi_bayar3").value = data.val[i].retur_penjualan_aksi_bayar;
                        document.getElementById("retur_penjualan_alasan3").value = data.val[i].retur_penjualan_alasan;
                    }

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table3 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" value="'+data.val2[i].retur_penjualandet_batch_no+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].retur_penjualandet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                            </tr>\
                        ');
                        $('.num2').number( true, 2, '.', ',' );
                        $('.money').number( true, 2, '.', ',' );
                    }
                    document.getElementById("statusstep3").innerHTML = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Menunggu Otorisasi </span>';
                  }
                });
            }

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Marketing/Klaim-Retur-Penjualan/loadDataWhere/',
                  data : { id : id },
                  dataType : "json",
                  success:function(data){
                    for(var i = 0; i < data.val.length; i++){
                        if (data.val[i].retur_penjualan_status <= 2) {
                            document.getElementsByName("statusStep2")[0].value = 1;
                            document.getElementById("statusstep2").innerHTML = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Menunggu Pengecekan </span>';
                        } else if (data.val[i].retur_penjualan_status == 3 || data.val[i].retur_penjualan_status == 4) {
                            document.getElementsByName("statusStep2")[0].value = 1;
                            document.getElementById("statusstep2").innerHTML = '<span class="label bg-green-jungle bg-font-green-jungle"> Disetujui </span>';
                        } else if (data.val[i].retur_penjualan_status == 5) {
                            document.getElementsByName("statusStep2")[0].value = 1;
                            document.getElementById("statusstep2").innerHTML = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Tidak Disetujui </span>';
                        }
                        $("#Kode").attr('hidden', false);
                        document.getElementsByName("retur_penjualan_nomor")[0].value = data.val[i].retur_penjualan_nomor;
                        document.getElementsByName("retur_penjualan_tanggal")[0].value = data.val[i].retur_penjualan_tanggal;
                        document.getElementsByName("retur_penjualan_status")[0].value = data.val[i].retur_penjualan_status;
                        document.getElementById("t_sj_retur_id").disabled = false;
                        $("#t_sj_retur_id").select2('destroy');
                        for(var j=0; j<data.val[i].t_sj_retur_id.val2.length; j++){
                            $("#t_sj_retur_id").append('<option value="'+data.val[i].t_sj_retur_id.val2[j].id+'" selected>'+data.val[i].t_sj_retur_id.val2[j].text+'</option>');
                        }
                        document.getElementById("t_sj_retur_id").disabled = true;
                        $("#t_sj_retur_id").select2();
                        if (data.val[i].retur_penjualan_status_pengembalianbarang == 1) {
                            document.getElementById("retur_penjualan_status_pengembalianbarang1").checked = true;
                        } else {
                            document.getElementById("retur_penjualan_status_pengembalianbarang2").checked = true;
                        }
                        document.getElementsByName("retur_penjualan_aksi_bayar")[0].value = data.val[i].retur_penjualan_aksi_bayar;
                        document.getElementsByName("retur_penjualan_alasan")[0].value = data.val[i].retur_penjualan_alasan;
                        document.getElementsByName("retur_penjualan_aksi_bayar")[0].readOnly = true;
                        document.getElementsByName("retur_penjualan_alasan")[0].readOnly = true;

                        // STEP 2
                        document.getElementById("retur_penjualan_tanggal2").value = data.val[i].retur_penjualan_tanggal;
                        document.getElementById("t_sj_retur_id2").disabled = false;
                        for(var j=0; j<data.val[i].t_sj_retur_id.val2.length; j++){
                            $("#t_sj_retur_id2").append('<option value="'+data.val[i].t_sj_retur_id.val2[j].id+'" selected>'+data.val[i].t_sj_retur_id.val2[j].text+'</option>');
                        }
                        document.getElementById("t_sj_retur_id2").disabled = true;
                        if (data.val[i].retur_penjualan_status_pengembalianbarang == 1) {
                            document.getElementById("retur_penjualan_status_pengembalianbarang12").checked = true;
                        } else {
                            document.getElementById("retur_penjualan_status_pengembalianbarang22").checked = true;
                        }
                        document.getElementById("retur_penjualan_aksi_bayar2").value = data.val[i].retur_penjualan_aksi_bayar;
                        document.getElementById("retur_penjualan_alasan2").value = data.val[i].retur_penjualan_alasan;

                        // STEP 3
                        document.getElementById("retur_penjualan_tanggal3").value = data.val[i].retur_penjualan_tanggal;
                        document.getElementById("t_sj_retur_id3").disabled = false;
                        for(var j=0; j<data.val[i].t_sj_retur_id.val2.length; j++){
                            $("#t_sj_retur_id3").append('<option value="'+data.val[i].t_sj_retur_id.val2[j].id+'" selected>'+data.val[i].t_sj_retur_id.val2[j].text+'</option>');
                        }
                        document.getElementById("t_sj_retur_id3").disabled = true;
                        if (data.val[i].retur_penjualan_status_pengembalianbarang == 1) {
                            document.getElementById("retur_penjualan_status_pengembalianbarang13").checked = true;
                        } else {
                            document.getElementById("retur_penjualan_status_pengembalianbarang23").checked = true;
                        }
                        document.getElementById("retur_penjualan_aksi_bayar3").value = data.val[i].retur_penjualan_aksi_bayar;
                        document.getElementById("retur_penjualan_alasan3").value = data.val[i].retur_penjualan_alasan;
                    }

                    for(var i = 0; i < data.val2.length; i++){
                        itemBarang++;
                        $("#default-table tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" value="'+data.val2[i].retur_penjualandet_batch_no+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].retur_penjualandet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                            </tr>\
                        ');

                        // STEP 2
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" value="'+data.val2[i].retur_penjualandet_batch_no+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].retur_penjualandet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                            </tr>\
                        ');

                        // STEP 3
                        $("#default-table3 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_kode+'\
                                </td>\
                                <td>\
                                    '+data.val2[i].barang_uraian+'\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" value="'+data.val2[i].retur_penjualandet_batch_no+'" readonly/>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control num2" value="'+data.val2[i].retur_penjualandet_qty+'" readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                            </tr>\
                        ');

                        $('.num2').number( true, 2, '.', ',' );
                        $('.money').number( true, 2, '.', ',' );
                    }
                    checkItem();
                  }
                });
            }
        </script>

    </body>

</html>