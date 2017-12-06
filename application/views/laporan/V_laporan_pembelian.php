            <!-- BEGIN CONTENT -->
<?php 
    // echo "string";
    // var_dump($search_by); 
?>
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

                                        <span class="caption-subject font-dark sbold uppercase">
                                            Data <?php if(isset($title_page2)) echo $title_page2;?>
                                        </span>
                                        <span>
                                            <?php echo $this->input->get("from_tanggal"); ?> -
                                            <?php echo $this->input->get("to_tanggal"); ?>
                                        </span>
                                    </div>

                                </div>

                                <div class="portlet-body">
                                    <!-- <form action="<?php echo base_url() ?>Laporan/penerimaan-barang/print" id="formDataLHKB" class="form-horizontal" method="post"> -->
                                    <form action="<?php echo base_url() ?>Laporan/pembelian" id="pembelian" class="form-horizontal" method="GET">
                                    <div class="form-group">

                                        <label class="control-label col-md-2">Periode

                                            <span class="required"> * </span>

                                        </label>

                                        <div class="col-md-4">

                                            <div class="input-icon right">

                                                <i class="fa"></i>

                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                    <?php 
                                                        $from_tanggal = $this->input->get("from_tanggal");
                                                        $to_tanggal = $this->input->get("to_tanggal");
                                                    ?>

                                                    <input type="text" class="form-control hidden" name="from_tanggal" id="from_tanggal" value="<?php echo $from_tanggal ?>">

                                                    <span class="input-group-addon hidden"> s/d </span>

                                                    <input type="text" class="form-control hidden" name="to_tanggal" id="to_tanggal" value="<?php echo $to_tanggal ?>"> 

                                                    <input type="text" class="form-control" id="daterange" name="daterange" value=""/>

                                                </div>

                                            </div>

                                            <!-- /input-group -->

                                        </div>

                                    </div> <!-- FORM GROUP -->
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Supplier
                                        </label>

                                        <div class="col-md-4">

                                            <div class="input-icon right">

                                                <i class="fa"></i>

                                                <div class="input-group input-large">
                                                    <select class="form-control" id="m_partner_id" name="m_partner_id" aria-required="true" aria-describedby="select-error" style="width: 100%">
                                                    </select>
                                                </div>

                                            </div>

                                            <!-- /input-group -->

                                        </div>

                                        <div class="col-md-6 text-right">

                                            

                                            <!-- <button type="button" class="btn green-jungle" onclick="searchDataKartuStokMasuk()" style="display: none;">

                                                Lihat Laporan

                                            </button> -->

                                            <button type="submit" class="btn green-jungle">

                                                Lihat Laporan

                                            </button>

                                            <button type="button" class="btn green-jungle" onclick="cetak()">

                                                <span class="icon-printer"></span>

                                            </button>

                                        </div>

                                    </div>

                                </form>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table">

                                    <thead>

                                        <tr>

                                            <th> No </th>

                                            <th> Cabang </th>

                                            <th> No PO </th>

                                            <th> No Refrensi </th>

                                            <th> Tanggal PO </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
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
    function select2List(idElemen = null, url_data = null, label = null, parameter = null) {
      $(idElemen).val('').trigger('change');

      $(idElemen).select2({

        placeholder: label,

        multiple: false,

        allowClear: true,

        ajax: {

          url: $base_url+url_data,

          dataType: 'json',

          delay: 100,

          cache: true,

          data: function (params) {

            return {

              q: params.term, // search term

              parameter: parameter,

              page: params.page

            };

          },

          processResults: function (data, params) {

            // parse the results into the format expected by Select2

            // since we are using custom formatting functions we do not need to

            // alter the remote JSON data, except to indicate that infinite

            // scrolling can be used

            params.page = params.page || 1;



            return {

              results: data.items,

              pagination: {

                more: (params.page * 30) < data.total_count

              }

            };

          }

        },

        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work

        minimumInputLength: 1,

        templateResult: FormatResult,

        templateSelection: FormatSelection,

      });

    }

    function searchData() {

        $('#default-table').DataTable({

            destroy: true,

            "processing": true,

            "serverSide": true,

            ajax: {

              url: '<?php echo base_url();?>Laporan/pembelian/loadData/'

            },

            "columns": [

              {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},

              {"name": "cabang_nama"},

              {"name": "order_nomor"},

              {"name": "penawaran_nomor"},

              {"name": "order_tanggal"}

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

    $(document).ready(function(){
        // $(".select2").select2();
        selectList_supplier("#m_partner_id");
        searchData();

        var from_tanggal = '<?php echo $this->input->get("from_tanggal") ?>' ;
        var to_tanggal = '<?php echo $this->input->get("to_tanggal") ?>' ;
        var startDate;
        var endDate;
        console.log(from_tanggal);
        console.log(to_tanggal);
        if (!from_tanggal) {
            startDate = new Date();
        }
        else
        {
            startDate = new Date(from_tanggal);
        }
        if (!to_tanggal) {
            endDate = new Date();
        }
        else
        {
            endDate = new Date(to_tanggal);
        }
        console.log(startDate);
        console.log(endDate);
        $('input[name="daterange"]').daterangepicker({
            "startDate": startDate,
            "endDate": endDate,
            locale: {
                format: 'DD/MM/YYYY'
            }
        }, function (start, end, label) {
          // alert("New date range selected: '" + start.format('YYYY-MM-DD H:mm:ss') + "' to '" + end.format('YYYY-MM-DD H:mm:ss') + "'");
            var strstart = start.format('YYYY-MM-DD');
            var strend = end.format('YYYY-MM-DD');

            $("#from_tanggal").val(strstart);
            $("#to_tanggal").val(strend);
        });
    });

    function cetak()
    {
       $('#formDataLHKB').submit();
    }

</script>