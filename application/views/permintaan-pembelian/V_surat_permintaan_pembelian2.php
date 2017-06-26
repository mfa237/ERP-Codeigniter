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
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                                        <thead>
                                            <tr>
                                                <th> No </th>
                                                <th> Cabang </th>
                                                <th> No PPB </th>
                                                <th> Jenis PPB </th>
                                                <th> Tanggal PPB </th>
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
                      url: '<?php echo base_url();?>Pembelian/Surat-Permintaan-Pembelian/loadData/'
                    },
                    "columns": [
                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
                      {"name": "cabang_nama"},
                      {"name": "permintaan_pembelian_nomor"},
                      {"name": "permintaan_pembelian_jenis_nama"},
                      {"name": "permintaan_pembelian_tanggal"},
                      {"name": "permintaan_pembelian_status_nama"},
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

            function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Gudang/Surat-Permintaan-Pembelian/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      document.getElementsByName("permintaan_pembelian_nomor")[0].value = data.val[i].permintaan_pembelian_nomor;
                      document.getElementsByName("permintaan_pembelian_tanggal")[0].value = data.val[i].permintaan_pembelian_tanggal;
                      document.getElementsByName("permintaan_pembelian_tanggal_dibutuhkan")[0].value = data.val[i].permintaan_pembelian_tanggal_dibutuhkan;
                      document.getElementsByName("permintaan_pembelian_tanggal_dibutuhkan")[0].disabled = true;
                      document.getElementsByName("permintaan_pembelian_status")[0].value = data.val[i].permintaan_pembelian_status;
                      document.getElementsByName("permintaan_pembelian_alasan")[0].value = data.val[i].permintaan_pembelian_alasan;
                      document.getElementsByName("permintaan_pembelian_catatan")[0].value = data.val[i].permintaan_pembelian_catatan;
                      if (data.val[i].permintaan_pembelian_jenis == 1) {
                        document.getElementById('permintaan_pembelian_jenis1').checked = true;
                      } else if (data.val[i].permintaan_pembelian_jenis == 2) {
                        document.getElementById('permintaan_pembelian_jenis2').checked = true;
                      }

                      $("#m_gudang_id_permintaan").select2('destroy');
                      for(var j=0; j<data.val[i].m_gudang_id_permintaan.val2.length; j++){
                        $("#m_gudang_id_permintaan").append('<option value="'+data.val[i].m_gudang_id_permintaan.val2[j].id+'" selected>'+data.val[i].m_gudang_id_permintaan.val2[j].text+'</option>');
                      }
                      $("#m_gudang_id_permintaan").select2();

                      document.getElementById('submit'). disabled = true;

                      document.getElementById('permintaan_pembelian_jenis1').disabled = true;
                      document.getElementById('permintaan_pembelian_jenis2').disabled = true;
                      document.getElementsByName('m_gudang_id_permintaan')[0].disabled = true;
                      document.getElementById('btnAddBarang').disabled = true;
                    }

                    itemBarang = data.val2.length;
                    $("#jml_itemBarang").val(itemBarang);

                    for(var i = 0; i < data.val2.length; i++){
                        $("#default-table2 tbody").append('\
                            <tr>\
                                <td>\
                                    '+(i+1)+'\
                                </td>\
                                <td>\
                                    <input type="hidden" name="m_barang_id[]" value="'+data.val2[i].m_barang_id+'"/>\
                                    <input type="hidden" name="permintaan_pembeliandet_id[]" value="'+data.val2[i].permintaan_pembeliandet_id+'"/>\
                                    '+data.val2[i].barang_nomor+'\
                                </td>\
                                <td>\
                                    <textarea class="form-control" rows="2" name="permintaan_pembeliandet_uraian[]" required readonly>'+data.val2[i].permintaan_pembeliandet_uraian+'</textarea>\
                                </td>\
                                <td>\
                                    <input type="text" class="form-control" name="permintaan_pembeliandet_qty[]" value="'+data.val2[i].permintaan_pembeliandet_qty+'" required readonly/>\
                                </td>\
                                <td>\
                                    '+data.val2[i].satuan_nama+'\
                                </td>\
                            </tr>\
                        ');
                    }
                  }
                });
            }
        </script>

    </body>

</html>
