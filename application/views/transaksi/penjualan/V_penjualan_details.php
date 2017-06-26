<style media="screen">
  .table-detail tr > td,
  .table-detail th
  {
    border: 1px solid;
    border-color: #ececec;
    background-color: #fff;
    padding: 5px 5px 5px 10px;
    font-size: 18px;
    margin: 0;
  }

  .col-detail
  {
    padding: 0px;
    margin-left: 25px;
  }

</style>

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
                <a href="<?php echo base_url('Penjualan/Point-of-Sale');?>"> <?php if(isset($title_page)) echo $title_page;?> </a>
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
                    <div class="row">
                      <div class="col-md-5 col-detail">
                        <table class="table-striped table-detail" style="width: 100%;">
                          <tr>
                            <td>Nama Cust. </td>
                            <td><?php echo $penjualan->partner_nama ?></td>
                          </tr>
                          <tr>
                            <td>Total Transaksi. </td>
                            <td class="text-right" style="padding-right: 10px;"><?php echo number_format($penjualan->penjualan_grand_total+($penjualan->penjualan_all_discount_nominal+$penjualan->discountbarang)) ?></td>
                          </tr>
                          <tr>
                            <td>Total Disc Item. </td>
                            <td class="text-right" style="padding-right: 10px;"><?php echo number_format($penjualan->discountbarang) ?></td>
                          </tr>
                          <tr>
                            <td>Total Disc Nota. </td>
                            <td class="text-right" style="padding-right: 10px;"><?php echo number_format($penjualan->penjualan_all_discount_nominal) ?></td>
                          </tr>
                          <tr>
                            <td>Grand Total Transaksi. </td>
                            <td class="text-right" style="padding-right: 10px;"><?php echo number_format($penjualan->penjualan_grand_total) ?></td>
                          </tr>
                          <tr>
                            <td>Pembayaran </td>
                            <td class="text-right" style="padding-right: 10px;"><?php echo number_format($penjualan->penjualan_payment) ?></td>
                          </tr>
                          <?php if ($penjualan->booking_status == 2): ?>
                          <tr>
                            <td>Status </td>
                              <td class="text-right" style="padding-right: 10px;">Booking All</td>
                          </tr>
                          <?php endif; ?>
                        </table>
                      </div>
                      <?php if ($penjualan->pengiriman_id): ?>
                        <div class="col-md-6 col-detail">
                          <table class="table-striped table-detail" style="width: 100%;">
                            <tr>
                              <td>Tujuan Pengiriman </td>
                              <td><?php echo $penjualan->pengiriman_tujuan ?></td>
                            </tr>
                            <tr>
                              <td>Jarak Pengiriman </td>
                              <td class="text-right" style="padding-right: 10px;"><?php echo number_format($penjualan->pengiriman_jarak) ?></td>
                            </tr>
                            <tr>
                              <td>Biaya pengiriman </td>
                              <td class="text-right" style="padding-right: 10px;"><?php echo number_format($penjualan->pengiriman_biaya) ?></td>
                            </tr>
                          </table>
                        </div>
                      <?php endif; ?>
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
                                    <th> Nama Barang</th>
                                    <th> Harga </th>
                                    <th> Jumlah </th>
                                    <th> Harga Total</th>
                                    <th> Total Diskon</th>
                                    <th> Harga Grand Total </th>
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
          url: '<?php echo base_url();?>Penjualan/Point-of-Sale/loadDatadetail/<?php echo $penjualan_id?>'
        },
        "columns": [
          {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
          {"name": "barang_nama"},
          {"name": "barang_price"},
          {"name": "barang_qty",  "className": "text-center"},
          {"name": "barang_total", "className": "text-right"},
          {"name": "barang_discount_nominal", "className": "text-right"},
          {"name": "barang_discount_grand_total", "className": "text-right"},
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

        // "lengthMenu": [
        //     [10, 25, 50, 100],
        //     [10, 25, 50, 100] // change per page values here
        // ],
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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

  function bookBtn(id)
  {
    $.post("<?php echo  base_url()?>C_POS/update_book/", {id: id}, function(data, status){
      alert_success_nonaktif();
      var this_button = "#btn_"+id;
      $(this_button).removeClass('blue-ebonyclay');
      $(this_button).addClass('green-jungle');
   });
  }

</script>

</body>

</html>
