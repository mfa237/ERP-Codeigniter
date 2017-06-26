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
                                        onclick="openFormPromo()"><i class="icon-plus"></i>&nbsp; Tambah Data
                                        </button>';
                                      }
                                    ?>

                                  </div>
                              </div>
                          </div>
                      </div>
                        <table class="table table-striped table-bordered table-hover
                        table-checkable order-column" id="default-table">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Promo Nama </th>
                                    <th> Promo Tanggal Mulai </th>
                                    <th> Promo Tanggal Akhir </th>
                                    <th> Status Aktif </th>
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
  <div  id="modal_promo"class="modal fade bs-example-modal-lg"
  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

      </div>
    </div>
  </div>
<?php $this->load->view('layout/V_footer');?>

<script type="text/javascript">

// $(document).ready(function(){
//   var totalpotonganitem = 0;
// });

function openFormPromo(id){
  var url = 'Master-Data/Master-Promo/getForm/';
  openFormGlobal(id, url, '#modal_promo');

}

function functionform(id){
  selectList_global('#selectbarang', 'Master-Data/Master-Promo/loadData_selectbarang', 'Pilih Barang', 1);
  if (id) {
    editData(id);
  } else {
    console.log(1);
  }
}


function editData(id){
  var barang_kode;
  var barang_nomor;
  var barang_nama;
  var harga_beli;
  var harga_jual;
  var harga_jual_pajak;
  var itemgetpromo;
  var itemqtygetpromo;
  var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
  $.ajax({
    type : "POST",
    url  : '<?php echo base_url();?>Master-Data/Master-Promo/loadDataWhere/',
    data : "id="+id,
    dataType : "json",
    success:function(data){
        document.getElementById('diskonnominal').readOnly  = false;
        document.getElementById('diskonpersen').readOnly  = false;

        document.getElementById("kode").value       = data.datapromo.promo_id;
        document.getElementById("promo_nama").value = data.datapromo.promo_nama;
        document.getElementById("datarange").value  = data.datapromo.promo_date;
        document.getElementById("totalpotonganitem").value = data.datapromo.promo_harga;

        if (data.datapromo.promo_status_aktif == 'y') {
          document.getElementById('promo_status_aktif').selected = true;
        } else if (data.datapromo.barang_status_aktif == 'n') {
          document.getElementById('promo_status_aktif').selected = true;
        }
        var totalitem = 0;
        var html = [];
        var htmlfoot;
        for (var i = 0; i < data.datapromodetail.length; i++) {
          var no = 1+i;
          totalitem += data.datapromodetail[i].harga_jual_pajak*data.datapromodetail[i].promo_item_qty;
          html += '<tr>';
          html += '<td>'+no+'</td>';
          html += '<td>'+data.datapromodetail[i].barang_nomor+'</td>';
          html += '<td class="item-name">'+data.datapromodetail[i].barang_nama+'</td>';
          html += '<td align="right">'+Intl.NumberFormat().format(data.datapromodetail[i].harga_jual_pajak)+'</td>';
          html += '<td align="right">'+data.datapromodetail[i].promo_item_qty+'</td>';
          html += '<td align="right">'+Intl.NumberFormat().format(data.datapromodetail[i].harga_jual_pajak*data.datapromodetail[i].promo_item_qty)+'</td>';
          html += '<td align="right">';
          html += '<button class="btn red-thunderbird" type="button" data-id="'+data.datapromodetail[i].promo_item_id+'" onclick="deleteData(this);" title="Hapus Data">';
          html += '<i class="icon-close text-center"></i>';
          html += '</button>';
          html += '</td>';
          html += '</tr>';

          var new_data = {
                          'itemgetpromo'    : data.datapromodetail[i].promo_item_id,
                          'itemqtygetpromo' : data.datapromodetail[i].promo_item_qty,
                          'barang_kode'     : data.datapromodetail[i].barang_kode,
                          'barang_nomor'    : data.datapromodetail[i].barang_nomor,
                          'barang_nama'     : data.datapromodetail[i].barang_nama,
                          'harga_beli'      : data.datapromodetail[i].harga_beli,
                          'harga_jual'      : data.datapromodetail[i].harga_jual,
                          'harga_jual_pajak': data.datapromodetail[i].harga_jual_pajak
                        };
          storage_item_detail.push(new_data);
        }

        localStorage.setItem('item_detail', JSON.stringify(storage_item_detail));

        $('#default-table2 tbody').html(html);
        htmlfoot += '<tr><td align="right" colspan="5">TOTAL</td><td align="right">'+Intl.NumberFormat().format(totalitem)+'</td></tr>';
        htmlfoot += '<tr><td align="right" colspan="5">POTONGAN</td><td id="totalpotonganitem" align="right">'+Intl.NumberFormat().format(data.datapromo.promo_harga)+'</td></tr>';
        $('#default-table2 tfoot').html(htmlfoot);
        $('#totalitem').val(totalitem);

        $('.num2').number(true, 2, ".", ",");

      // $('#submitedit').removeClass('hidden');
      // $('#submit').addClass('hidden');

      document.getElementById('diskonnominal').value  = Intl.NumberFormat().format(data.datapromo.promo_harga);
      var persen = parseInt(data.datapromo.promo_harga)/parseInt(totalitem);
      persen = persen*100;
      document.getElementById('diskonpersen').value = persen.toFixed(2)||0;

    }
  });
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
          url: '<?php echo base_url();?>Master-Data/Master-Promo/loadData'
        },
        "columns": [
          {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
          {"name": "promo_datestart"},
          {"name": "promo_dateend"},
          {"name": "promo_nama"},
          {"name": "promo_status_aktif"},
          {"name": "action","orderable": false,"searchable": false, "className": "text-center", "width": "20%"}
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
