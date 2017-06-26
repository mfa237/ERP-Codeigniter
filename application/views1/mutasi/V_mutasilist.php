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
                <a href="#"> Master Data </a>
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
                      <div class="table-toolbar">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="btn-group">
                                    <?php
                                      if($priv_add == 1)
                                      {
                                        echo '<button id="modalAdd-btn" class="btn sbold dark" data-toggle="modal"
                                        onclick="openFormMutasi()"><i class="icon-plus"></i>&nbsp; Tambah Data
                                        </button>';
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
                                    <th> Tanggal Mutasi </th>
                                    <th> Artikel </th>
                                    <th> Barang Nama </th>
                                    <th> Jumlah Mutasi </th>
                                    <th> Admin </th>
                                    <!-- <th> Action </th> -->
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
  <div  id="modal_mutasi" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

      </div>
    </div>
  </div>
<?php $this->load->view('layout/V_footer');?>

<script type="text/javascript">

function openFormMutasi(id)
{
  var url = 'C_mutasibarang/getForm';
  openFormGlobal(id, url, '#modal_mutasi');
}

function functionform(id)
{
  selectList_global('#i_gudang', 'C_mutasibarang/getGudang', 'Pilih Gudang', 1);
  // selectList_global('#nama_barang', 'C_mutasibarang/getBarang', 'Pilih Barang');
}

$(document).ready(function(){
    searchData();

    $("#btn1").click(function(){
      $("#contoh1").toggle(500);
    });
});

function searchData() {
    $('#default-table').DataTable({
        destroy: true,
        "processing": true,
        "serverSide": true,
        ajax: {
          url: '<?php echo base_url();?>C_mutasibarang/loadData'
        },
        "columns": [
          {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
          {"name": "mutasi_tanggal"},
          {"name": "barang_nomor"},
          {"name": "barang_nama"},
          {"name": "mutasi_qty", "className": "text-center",},
          {"name": "user_username"},
          // {"name": "action","orderable": false,"searchable": false, "className": "text-center", "width": "20%"}
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


</script>

</body>

</html>
