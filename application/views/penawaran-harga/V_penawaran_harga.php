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
                                        <i class=" icon-list font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase">Data <?php if(isset($title_page2)) echo $title_page2;?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <?php
                                                        if($priv_add == 1)
                                                        {
                                                            echo '<a href="'.base_url().'Pembelian/Penawaran-Harga/Form">
                                                                <button id="modalAdd-btn" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Data
                                                                </button>
                                                            </a>';
                                                        }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                        <thead>
                                            <tr>
                                                <th> No </th>
                                                <th> Cabang </th>
                                                <th> No Penawaran </th>
                                                <th> Jenis Penawaran </th>
                                                <th> Tanggal Penawaran </th>
                                                <th> Status </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
                searchData();
            });

            function searchData() {
                $('#default-table').DataTable({
                    destroy: true,
                    "processing": true,
                    "serverSide": true,
                    ajax: {
                      url: '<?php echo base_url();?>Pembelian/Penawaran-Harga/loadData/'
                    },
                    "columns": [
                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
                      {"name": "cabang_nama"},
                      {"name": "penawaran_nomor"},
                      {"name": "penawaran_jenis_nama"},
                      {"name": "penawaran_tanggal"},
                      {"name": "penawaran_status_nama"},
                      {"name": "action","orderable": false,"searchable": false, "className": "text-center", "width": "15%"}
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
                        [2, "desc"]
                    ],
                    "iDisplayLength": 10
                });
            }

            function deleteData(id) {
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
                                          url: '<?php echo base_url();?>Pembelian/Penawaran-Harga/deleteData/',
                                          data : { id : id },
                                          type: 'POST',
                                          dataType: 'json',
                                          success: function (data) {
                                            if (data.status=='200') {
                                              searchData();
                                                swal({
                                                    title: "Success!",
                                                    text: "Data Berhasil Tersimpan!",
                                                    type: "success",
                                                    confirmButtonClass: "btn-raised btn-success",
                                                    confirmButtonText: "OK",
                                                });
                                            } else if (data.status=='204') {
                                                swal({
                                                    title: "Alert!",
                                                    text: "Data Gagal Tersimpan!",
                                                    type: "error",
                                                    confirmButtonClass: "btn-raised btn-danger",
                                                    confirmButtonText: "OK",
                                                });
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
