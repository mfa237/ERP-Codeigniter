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
                                    <form action="<?php echo base_url() ?>Laporan/konsinyasi" id="formDataLHKB" class="form-horizontal" method="GET">
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
                                        <label class="control-label col-md-2">Jenis Barang
                                        </label>
                                        <div class="col-md-4">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <div class="input-group input-large">
                                                    <input type="hidden" id="m_jenis_barang_id_get" value="<?php echo $this->input->get("m_jenis_barang_id") ?>">
                                                    <input type="hidden" id="m_jenis_barang_name_get" value="<?php echo @$jenis_barang_nama ?>">
                                                    <select class="form-control" aria-required="true" name="konsinyasi" id="konsinyasi">
                                                        <option value="all" <?php echo $this->input->get("konsinyasi") == "all" ? "selected" : "" ?> >Semua Barang </option>
                                                        <option value="true" <?php echo $this->input->get("konsinyasi") == "true" ? "selected" : "" ?> >Barang Konsinyasi </option>
                                                        <option value="false" <?php echo $this->input->get("konsinyasi") == "false" ? "selected" : "" ?> >Barang Non-Konsinyasi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Category 1
                                        </label>
                                        <div class="col-md-4">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <div class="input-group input-large">
                                                    <input type="hidden" id="m_jenis_barang_id_get" value="<?php echo $this->input->get("m_jenis_barang_id") ?>">
                                                    <input type="hidden" id="m_jenis_barang_name_get" value="<?php echo @$jenis_barang_nama ?>">
                                                    <select class="form-control" id="m_jenis_barang_id" name="m_jenis_barang_id" aria-required="true" aria-describedby="select-error">
                                                    </select>
                                                </div>

                                            </div>

                                            <!-- /input-group -->

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Category 2
                                        </label>

                                        <div class="col-md-4">

                                            <div class="input-icon right">

                                                <i class="fa"></i>

                                                <div class="input-group input-large">
                                                    <input type="hidden" id="m_category_2_id_get" value="<?php echo $this->input->get("m_category_2_id") ?>">
                                                    <input type="hidden" id="m_category_2_name_get" value="<?php echo @$category_2_nama ?>">
                                                    <select class="form-control" id="m_category_2_id" name="m_category_2_id" aria-required="true" aria-describedby="select-error">
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
                                <?php if (isset($search_by) &&  $search_by =="m_category_2_id" ): ?>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="data-by-kategori">

                                        <thead>

                                            <tr>
                                                <th> No </th>
                                                <th> Kategori </th>
                                                <th> Qty</th>
                                                <th> Satuan </th>
                                                <th> Hpp </th>
                                                <th> Harga jual</th>
                                                <th> Harga jual + ppn</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            <?php if (isset($penjualan["m_category_2_id"]) && is_array($penjualan["m_category_2_id"]) && !empty($penjualan["m_category_2_id"])): 
                                                    $no = 1;
                                                    $summary_qty = 0;
                                                    $summary_hpp = 0;
                                                    $summary_harga_jual = 0;
                                                    $summary_harga_jual_pajak = 0;
                                            ?>
                                                <?php foreach ($penjualan["m_category_2_id"] as $key => $value): 
                                                        $summary_qty += $value["qty"];
                                                        $summary_hpp += $value["barang_total_harga_beli"];
                                                        $summary_harga_jual += $value["barang_total_harga_jual"];
                                                        $summary_harga_jual_pajak += $value["barang_grand_total"];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; $no++ ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url()."Laporan/konsinyasi?daterange=".$this->input->get("daterange")."&from_tanggal=".$this->input->get("from_tanggal")."&to_tanggal=".$this->input->get("to_tanggal")."&m_jenis_barang_id=".$this->input->get("m_jenis_barang_id")."&m_category_2_id=".$value["category_2_id"]."&konsinyasi=".$this->input->get("konsinyasi") ?>">
                                                                <span class="title"><?php echo $value["category_2_nama"] ?></span>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $value["qty"] ?></td>
                                                        <td><?php echo $value["satuan_nama"] ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_total_harga_beli"])) ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_total_harga_jual"])) ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_grand_total"])) ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                        <tfoot>
                                            <td colspan="2">Total</td>
                                            <td align="right"><?php echo $summary_qty ?></td>
                                            <td> </td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_hpp)) ?></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_harga_jual)) ?></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_harga_jual_pajak)) ?></td>
                                        </tfoot>

                                    </table>
                                <?php endif ?>

                                <?php if (isset($search_by) &&  $search_by =="m_jenis_barang_id" ): ?>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="data-by-kategori">

                                        <thead>

                                            <tr>
                                                <th> No </th>
                                                <th> Kategori </th>
                                                <th> Qty</th>
                                                <th> Hpp </th>
                                                <th> Harga jual</th>
                                                <th> Harga jual + ppn</th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            <?php if (isset($penjualan["m_jenis_barang_id"]) && is_array($penjualan["m_jenis_barang_id"]) && !empty($penjualan["m_jenis_barang_id"])): 
                                                $no = 1;
                                                $summary_qty = 0;
                                                $summary_hpp = 0;
                                                $summary_harga_jual = 0;
                                                $summary_harga_jual_pajak = 0;
                                            ?>
                                                <?php foreach ($penjualan["m_jenis_barang_id"] as $key => $value): 
                                                        $summary_qty += $value["qty"];
                                                        $summary_hpp += $value["barang_total_harga_beli"];
                                                        $summary_harga_jual += $value["barang_total_harga_jual"];
                                                        $summary_harga_jual_pajak += $value["barang_grand_total"];
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $no; $no++?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url()."Laporan/konsinyasi?daterange=".$this->input->get("daterange")."&from_tanggal=".$this->input->get("from_tanggal")."&to_tanggal=".$this->input->get("to_tanggal")."&m_jenis_barang_id=".$value["m_jenis_barang_id"]."&konsinyasi=".$this->input->get("konsinyasi") ?>">
                                                                <span class="title">
                                                                    <?php echo $value["jenis_barang_nama"] ?>
                                                                </span>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $value["qty"] ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_total_harga_beli"])) ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_total_harga_jual"])) ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_grand_total"])) ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                        <tfoot>
                                            <td colspan="2">Total</td>
                                            <td align="right"><?php echo $summary_qty ?></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_hpp)) ?></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_harga_jual)) ?></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_harga_jual_pajak)) ?></td>
                                        </tfoot>

                                    </table>
                                <?php endif ?>
                                <?php if (isset($search_by) && $search_by =="barang_id"): ?>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="data-by-product">
                                        <thead>
                                            <tr>
                                                <th> No </th>
                                                <th> Kode Artikel </th>
                                                <th> Nama Barang</th>
                                                <th> Qty </th>
                                                <th> Satuan</th>
                                                <th> Hpp </th>
                                                <th> Harga Jual </th>
                                                <th> Harga Jual + PPN </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if (isset($penjualan["barang_id"]) && is_array($penjualan["barang_id"]) && !empty($penjualan["barang_id"])): 
                                                $no = 1;
                                                $summary_qty = 0;
                                                $summary_hpp = 0;
                                                $summary_harga_jual = 0;
                                                $summary_harga_jual_pajak = 0;
                                            ?>
                                                <?php foreach ($penjualan["barang_id"] as $key => $value): 
                                                    $summary_qty += $value["qty"];
                                                    $summary_hpp += $value["barang_total_harga_beli"];
                                                    $summary_harga_jual += $value["barang_total_harga_jual"];
                                                    $summary_harga_jual_pajak += $value["barang_grand_total"];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; $no++; ?></td>
                                                        <td><?php echo $value["barang_nomor"] ?></td>
                                                        <td><?php echo $value["barang_nama"] ?></td>
                                                        <td align="right"><?php echo $value["qty"] ?></td>
                                                        <td align="right"><?php echo $value["satuan_nama"] ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_total_harga_beli"])) ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_total_harga_jual"])) ?></td>
                                                        <td align="right"><?php echo str_replace(",", ".", number_format($value["barang_grand_total"])) ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                        <tfoot>
                                            <td colspan="3">Total</td>
                                            <td align="right"><?php echo $summary_qty ?></td>
                                            <td></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_hpp)) ?></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_harga_jual)) ?></td>
                                            <td align="right"><?php echo str_replace(",", ".", number_format($summary_harga_jual_pajak)) ?></td>
                                        </tfoot>
                                    </table>
                                <?php endif ?>

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

    $("#m_jenis_barang_id").change(function(){
        console.log("search..");
        var m_jenis_barang_id = document.getElementById("m_jenis_barang_id").value;
        // select2List('#m_jenis_barang_id', 'Master-Data/Jenis-Barang/loadDataSelect', 'Pilih Category 1', m_jenis_barang_id);

        select2List('#m_category_2_id', 'Master-Data/Master-Kategori/loadDataSelectWhere', 'Pilih Category 2', m_jenis_barang_id);
    
        // $('#m_category_2_id').select2('destroy');

        // $('#m_category_2_id').select2();

    });

    function setDefaultCategory1 () {
        console.log("set default..");
        var m_jenis_barang_id = document.getElementById("m_jenis_barang_id_get").value;
        var m_category_2_id = $("#m_category_2_id_get").val();

        if (m_jenis_barang_id.length != "") {
            console.log("change m_jenis_barang_id");
            $("#m_jenis_barang_id").append('<option value="'+m_jenis_barang_id+'" selected>'+$("#m_jenis_barang_name_get").val()+'</option>');
            $('#m_jenis_barang_id').select2();
            selectList_jenisBarang();
            $("#m_jenis_barang_id").trigger('change');
        };
        if (m_category_2_id.length != ""){
            console.log("change m_category_2_id");
            $("#m_category_2_id").append('<option value="'+m_category_2_id+'" selected>'+$("#m_category_2_name_get").val()+'</option>');
            $("#m_category_2_id").select2();
        };
    }

    $(document).ready(function(){
        // $(".select2").select2();

        // searchDataStok();
        $("#data-by-product").dataTable();

        $("#data-by-kategori").dataTable();


        $('#m_cabang_id').css('width', '100%');

        $('#m_gudang_id').css('width', '100%');

        $('#m_barang_id').css('width', '100%');

        // selectList_cabang();

        // selectList_barang();

        selectList_jenisBarang();

        // $("#m_jenis_barang_id").val(m_jenis_barang_id_get).trigger('change');
        // $("#m_jenis_barang_id").val(5).trigger('change');
        setDefaultCategory1();
        // $('.date-picker').datepicker();
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