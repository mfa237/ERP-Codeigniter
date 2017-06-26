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
    height: 150px;
  }
  .table-detail tr > td {
    top: 0;
    width: 25%;
    font-variant: small-caps;
  }
  .col-detail
  {
    padding: 0px;
    margin-left: 25px;
  }

  .top {
      display: inline-block;
      vertical-align:top;
      width: 100%;
  }
  .bot {
      /*display: inline-block;*/
      padding-right: 10px;
      font-family: monospace;
      font-size: 30px;
      text-align: right;
      vertical-align:bottom;
      width: 100%;
  }
  .bot:before{
      content: '';
      display: inline-block;
      height: 100px;
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
                                                echo '<a href="'.base_url().'Penjualan/form_penjualan">
                                                          <button id="modalAdd-btn" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Data
                                                          </button>
                                                      </a>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-toolbar">
                          <form id="formkasirparam">
                            <div class="row">
                              <label for="">Masukkan Tanggal</label>
                              <div class="form-group">
                                <div class="col-md-4">
                                  <div class="input-icon right">
                                    <input type="text" class="form-control" id="daterange" name="daterange" value="" onchange="searchData()"/>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <?php echo $pilihkasir ?>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="table-toolbar">
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table-striped table-detail" style="width: 100%;">
                                <tr>
                                  <td>
                                    <div class="top"><b>Jumlah Hari</b></div>
                                    <div class="bot" id="jmlhari">1</div>
                                  </td>
                                  <td>
                                    <div class="top"><b>Total Penjualan</b></div>
                                    <div class="bot" id="totaljual">0</div>
                                  </td>
                                  <td>
                                    <div class="top"><b>Total Pemasukkan</b></div>
                                    <div class="bot" id="totalmasuk">0</div>
                                  </td>
                                  <td>
                                    <div class="top"><b>Jumlah Item</b></div>
                                    <div class="bot" id="jmlitem">0</div>
                                  </td>
                                </tr>
                                <tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Nama Cabang</th>
                                    <th> Kode Penjualan </th>
                                    <th> Tanggal Penjualan </th>
                                    <th> Total Penjualan </th>
                                    <th> Pembayaran </th>
                                    <th> Status </th>
                                    <th> Kasir </th>
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
<div class="modal fade" id="modal_login">
  <div class="modal-dialog">
    <div class="modal-content">

    </div>
  </div>
</div>
<?php $this->load->view('layout/V_footer');?>

<script type="text/javascript">
  $(function() {
      $('input[name="daterange"]').daterangepicker({
          timePicker: true,
          timePickerIncrement: 30,
          locale: {
              format: 'DD/MM/YYYY H:m:s'
          }
      }, function (start, end, label) {
        // alert("New date range selected: '" + start.format('YYYY-MM-DD') + "' to '" + end.format('YYYY-MM-DD') + "'");
          // searchData();
          // searchDatasummary(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
          var kasir;
          if ($('#i_kasir').val()) {
            kasir = $('#i_kasir').val();
          }
          var strstart = start.format('YYYY-MM-DD');
          var strend = end.format('YYYY-MM-DD');
          getJumlahhari(strstart, strend);
          searchDatasummary(start.format('YYYY-MM-DD H:m:s'), end.format('YYYY-MM-DD H:m:s'), kasir);
      });
  });


  $(document).ready(function(){
      searchData();
      selectList_global('#i_kasir', 'Penjualan/PilihKasir', 'Pilih Kasir ...');
      selectList_global('#i_cabang', 'Penjualan/Pilihcabang', 'Pilih Cabang ...');
      getData('#formkasirparam', 'Penjualan/Point-of-Sale/getsummarydata');
  });


function getJumlahhari(strstart, strend){
  // var jumlah = (strend.getTime() - strstart.getTime()) / (1000 * 60 * 60 * 24);
  var jumlah = moment(strend).diff(moment(strstart), 'days');
  document.getElementById('jmlhari').innerHTML = jumlah+1;
}


function searchDatasummary(date1, date2, user_id){
  $.ajax({
    url: '<?php echo base_url();?>Penjualan/Point-of-Sale/getsummarydata/',
    type: 'POST',
    dataType : 'JSON',
    data: {date1:date1, date2:date2, user_id:user_id},
    success: function (data) {
      getQtyresult(data);
    }
  });
}

function searchDatasummarykasir(date1, date2, user_id){
  var user_id = $('#i_kasir').val();
  $.ajax({
    url: '<?php echo base_url();?>Penjualan/Point-of-Sale/getsummarydata/',
    type: 'POST',
    dataType : 'JSON',
    data: {date1:date1, date2:date2, user_id:user_id},
    success: function (data) {
      getQtyresult(data);
    }
  });
}

function getQtyresult(data){
  $('#totalmasuk').html(Intl.NumberFormat().format(data.grandtotal));
  $('#totaljual').html(data.jmlpenjualan);
  $('#jmlitem').html(data.totalitem);
}




function print_struk(id){
  window.open('<?php echo base_url()?>Penjualan/print/'+id);
}


function searchData() {
  var daterange = $('#daterange').val();
  var kasir = $('#i_kasir').val();
  var table = $('#default-table').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy": true,
        "bJQueryUI": true,
        ajax: {
          url: '<?php echo base_url();?>Penjualan/Point-of-Sale/loadData/',
          data: {
            "daterange" :daterange,
            "kasir"     :kasir,
           }
        },
        "columns": [
          {"name": "no","orderable": false, "searchable": false,  "className": "text-center", "width": "5%"},
          {"name": "cabang_nama",  "width": "15%"},
          {"name": "penjualan_code", "className": "text-center"},
          {"name": "penjualan_date",  "className": "text-center"},
          {"name": "penjualan_total", "className": "text-right"},
          {"name": "penjualan_payment", "className": "text-right"},
          {"name": "penjualan_status", "className": "text-right"},
          {"name": "user_username", "className": "text-right"},
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
            [1, "asc"]
        ],
        "iDisplayLength": 10
    });

    table.ajax.reload( function ( json ) {
      // $('#daterange').val( json.lastInput );
  } );

}

function senddata(start, end){
  searchData(start, end);
  // oTable.draw();
}

function hapusPenjualan(penjualan_id){
  var url = "<?php echo base_url()?>C_POS/popmodal_form_login2/"+penjualan_id;
  $('#modal_login').modal('show').find('.modal-content').load(url);
}

function hapusPenjualan_(penjualan_id){
  var paramArray = [];
  paramArray.push({name:'penjualan_id', value:penjualan_id});
  $.ajax({
    url: '<?php echo base_url();?>Penjualan/Point-of-Sale/cancelPenjualan',
    type: 'POST',
    dataType : 'JSON',
    data: paramArray,
    success: function (data) {
      getQtyresult_(data);
    }
  });
}

function getQtyresult_(data){
  if(data.status=='200'){
      window.scrollTo(0, 0);
      swal({
          title: "Success!",
          text: "Berhasil!",
          type: "success",
          confirmButtonClass: "btn-raised btn-success",
          confirmButtonText: "OK",
      });
  } else if (data.status=='204') {
      swal({
          title: "Alert!",
          text: "Gagal!",
          type: "error",
          confirmButtonClass: "btn-raised btn-danger",
          confirmButtonText: "OK",
      });
  }
  var daterange = $('#daterange').val();
  // daterange = daterange.split("-");
  var kasir;
  if ($('#i_kasir').val()) {
    kasir = $('#i_kasir').val();
  }
  $.ajax({
    url: '<?php echo base_url();?>Penjualan/Point-of-Sale/getsummarydata/',
    type: 'POST',
    dataType : 'JSON',
    data: {daterange:daterange, kasir:kasir},
    success: function (data) {
      getQtyresult(data);
      searchData();
    }
  });
}

</script>

</body>

</html>
