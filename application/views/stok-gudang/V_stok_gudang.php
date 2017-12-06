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

                            <a href="#"> Inventory </a>

                            <i class="fa fa-circle"></i>

                        </li>

                        <li>

                            <span class="active"><?php if(isset($title_page)) echo $title_page;?></span>

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

                                        <i class=" icon-list font-dark"></i> &nbsp;&nbsp;

                                        <span class="caption-subject font-dark sbold uppercase">Data <?php if(isset($title_page2)) echo $title_page2;?></span>

                                    </div>

                                </div>

                                <div class="portlet-body">

                                    <ul class="nav nav-tabs">

                                        <li class="active">

                                            <a href="#tab-stok" data-toggle="tab"> Stok Gudang </a>

                                        </li>

                                        <li>

                                            <a href="#tab-kartu-stok" data-toggle="tab"> Kartu Stok </a>

                                        </li>

                                    </ul>

                                    <div class="tab-content">

                                        <div class="tab-pane fade active in" id="tab-stok">

                                          <?php $this->load->view('stok-gudang/V_tab_stok');?>

                                        </div>

                                        <div class="tab-pane fade" id="tab-kartu-stok">

                                          <?php $this->load->view('stok-gudang/V_tab_kartu_stok');?>

                                        </div>

                                    </div>

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

                searchDataStok();

                $('#default-table-kartu-stok').DataTable();

                $('#m_cabang_id').css('width', '100%');

                $('#m_gudang_id').css('width', '100%');

                $('#m_barang_id').css('width', '100%');

                selectList_cabang();

                selectList_barang();

            });



            function searchDataStok() { 

                $('#default-table-stok').DataTable({

                    destroy: true,

                    "processing": true,

                    "serverSide": true,

                    ajax: {

                      url: '<?php echo base_url();?>Inventory/Stok-Gudang/loadDataStok/'

                    },

                    "columns": [

                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},

                      {"name": "cabang_nama"},

                      {"name": "gudang_nama"},

                      {"name": "barang_nomor"},

                      {"name": "barang_nama"},

                      {"name": "jenis_barang_nama"},

                      {"name": "stok_minimum", "className": "text-right"},

                      {"name": "stok_gudang", "className": "text-right"},

                      {"name": "satuan_nama"}

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



            function searchDataKartuStok() { 

                $('#default-table-kartu-stok').DataTable({

                    destroy: true,

                    "processing": true,

                    "serverSide": true,

                    ajax: {

                      url: '<?php echo base_url();?>Inventory/Stok-Gudang/loadDataKartuStok/',

                      data: { id_cabang : document.getElementById("m_cabang_id").value, id_gudang : document.getElementById("m_gudang_id").value, id_barang : document.getElementById("m_barang_id").value }

                    },

                    "columns": [

                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},

                      {"name": "kartu_stok_tanggal","orderable": false},

                      {"name": "kartu_stok_referensi","orderable": false},

                      {"name": "kartu_stok_keterangan","orderable": false},

                      {"name": "kartu_stok_masuk","orderable": false, "className": "text-right"},

                      {"name": "kartu_stok_keluar","orderable": false, "className": "text-right"},

                      {"name": "kartu_stok_saldo","orderable": false, "className": "text-right"}

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



        </script>



    </body>



</html>