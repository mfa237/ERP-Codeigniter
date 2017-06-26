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
                            <form action="SPP-Belum-Realisasi/Print-Data" id="formData" class="form-horizontal" method="POST">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Nama Cabang
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <select class="form-control" id="m_cabang_id" name="m_cabang_id" aria-required="true" aria-describedby="select-error" onchange="getGudang()">
                                            </select>
                                        </div>
                                    </div>
                                    <label class="control-label col-md-2">Nama Gudang
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <select class="form-control" id="m_gudang_id" name="m_gudang_id" aria-required="true" aria-describedby="select-error">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Periode
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="from_tanggal" id="from_tanggal" value="<?php echo date('m/01/Y')?>">
                                                <span class="input-group-addon"> s/d </span>
                                                <input type="text" class="form-control" name="to_tanggal" id="to_tanggal" value="<?php echo date('m/t/Y')?>"> 
                                            </div>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <div class="col-md-6 text-right">
                                        
                                        <!-- <button type="button" class="btn green-jungle" onclick="searchDataKartuStokMasuk()" style="display: none;">
                                            Lihat Laporan
                                        </button> -->
                                        <button type="button" class="btn green-jungle" onclick="searchDataLaporan()">
                                            Lihat Laporan
                                        </button>
                                        <button type="button" class="btn green-jungle" onclick="cetakDataLaporan()">
                                            <span class="icon-printer"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> No SPP </th>
                                        <th> Tgl SPP </th>
                                        <th> Artikel </th>
                                        <th> Nama Barang </th>
                                        <th> Qty </th>
                                        <th> Satuan </th>
                                        <th> Keterangan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
                // searchDataStok();
                $('#default-table').DataTable();
                $('#m_cabang_id').css('width', '100%');
                $('#m_gudang_id').css('width', '100%');
                $('#m_barang_id').css('width', '100%');
                selectList_cabang();
                selectList_barang();
                $('.date-picker').datepicker();
            });

            function searchDataLaporan() { 
                $('#default-table').DataTable({
                    destroy: true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                      url: '<?php echo base_url();?>Laporan/SPP-Belum-Realisasi/loadData/',
                      data: { id_cabang : document.getElementById("m_cabang_id").value, id_gudang : document.getElementById("m_gudang_id").value, from_tanggal : document.getElementById("from_tanggal").value, to_tanggal : document.getElementById("to_tanggal").value }
                    },
                    "columns": [
                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
                      {"name": "permintaan_pembelian_nomor"},
                      {"name": "permintaan_pembelian_tanggal"},
                      {"name": "barang_kode"},
                      {"name": "barang_nama"},
                      {"name": "permintaan_pembelian_qty"},
                      {"name": "satuan_nama"},
                      {"name": "permintaan_pembelian_alasan"}
                    ],
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "No data available in table",
                        "info": "Showing _START_ to _END_ of _TOTAL_ records",
                        "infoEmpty": "No records found",
                        "infoFiltered": "(filtered1 from _MAX_ total records)",
                        "lengthMenu": "Show _MENU_",
                        "search": "Search:",
                        "zeroRecords": "No matching records found",
                        "paginate": {
                            "previous":"Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                    "pagingType": "bootstrap_extended",

                    "lengthMenu": [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "asc"]
                    ],
                    "iDisplayLength": 10
                });
            }

            function getGudang() {
                $.ajax({
                    type : "GET",
                    url  : '<?php echo base_url();?>Master-Data/Gudang/loadDataSelectCabang/',
                    data : { id : document.getElementById("m_cabang_id").value },
                    dataType : "json",
                    success:function(data){
                        $('#m_gudang_id').select2();
                        $('#m_gudang_id').select2('destroy');
                        $("#m_gudang_id").empty();
                        for(var i=0; i<data.items.length;i++){
                            $("#m_gudang_id").append('<option value="'+data.items[i].id+'">'+data.items[i].text+'</option>');
                        }
                        $('#m_gudang_id').select2();
                    }
                });
            }

            function cetakDataLaporan()
            {
                window.open('<?php echo base_url();?>Laporan/SPP-Belum-Realisasi/Print-Data/'+document.getElementsByName("m_cabang_id")[0].value+'/'+document.getElementsByName("m_gudang_id")[0].value+'/'+document.getElementsByName("from_tanggal")[0].value+'/'+document.getElementsByName("to_tanggal")[0].value);
            }

        </script>