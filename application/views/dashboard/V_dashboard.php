            <!-- BEGIN CONTENT -->
            <style media="screen">
              .btn-up-custom,
              .btn-down-custom {
                background-color: white;
                border-bottom-width: 0px;
                border-right-width: 0px;
                border-top-width: 0px;
                border-left-width: 0px;
              }

              button.btn-down-custom,
              button.btn-up-custom {
              background-color: #ffffff;
              border: none;
              height: 40px;
              padding: 5px 15px;
              color: #ffffff;
              font-size: 20px;
              font-weight: 300;
              /*margin-top: 10px;
              margin-right: 10px;*/
              }

              button.btn-down-custom:hover,
              button.btn-up-custom:hover {
              cursor: pointer;
              background-color: #f7f5f5;
              }

              button.btn-down-custom,
              button.btn-up-custom {
              /*background-color: #F9A300;*/
              border: none;
              /*height: 40px;*/
              /*padding: 5px 15px;*/
              color: #ffffff;
              /*font-size: 16px;*/
              /*font-weight: 300;*/
              /*margin-top: 10px;
              margin-right: 10px;*/
              }

              .btn-down-custom {
                margin-top: 35px;
              }

              button:active {
              outline: none;
              border: none;
              }

              button:focus {outline:0;}

            </style>
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
                            <div class="page-toolbar" style="float: right;">
                                <div id="reportrange" class="pull-right tooltips btn btn-fit-height green" data-placement="top" data-original-title="Change dashboard date range">
                                  <i class="icon-calendar"></i>&nbsp;
                                  <span class="thin uppercase hidden-xs"></span>&nbsp;
                                  <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <!-- <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>"> Dashboard </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php if(isset($title_page)) echo $title_page;?></span>
                        </li>
                    </ul> -->
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 white" href="#">
                                <div class="visual">
                                    <i class="fa "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="0" id="target">0</span>
                                    </div>
                                    <div class="desc"> Target </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 white" href="#">
                              <div class="visual" style="height: 120px;margin-bottom: 0px;padding-left: 0px;padding-top: 0px;">
                                <?php if ($inputpengunjung == 1): ?>
                                  <button type="" name="button" class="btn-up-custom" onclick="btnUpguest()">
                                    <i class="fa fa-chevron-up" style="color: #ddd;"></i>
                                  </button>
                                  <button type="" name="button" class="btn-down-custom" onclick="buttonDownguest()">
                                    <i class="fa fa-chevron-down" style="color: #ddd;"></i>
                                  </button>
                                <?php endif; ?>
                              </div>
                              <div class="visual">
                                  <i class="fa "></i>
                              </div>
                              <div class="details">
                                  <div class="number">
                                      <span data-counter="counterup" data-value="0" id="pengunjung_count">0</span>
                                  </div>
                                  <div class="desc"> Jumlah Pengunjung </div>
                              </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 white" href="#">
                                <div class="visual">
                                    <i class="fa "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span id="penjualan_count">0</span>
                                    </div>
                                    <div class="desc">  Jumlah Penjualan </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 white" href="#">
                                <div class="visual">
                                    <i class="fa "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span id="penjualan_avg">0</span></div>
                                    <div class="desc"> Total Penjualan </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-body">
                                    <div id="site_statistics_content">
                                        <!-- <div id="site_statistics" class="chart"> </div> -->
                                        <div id="container" style="height: 400px; width: : 310px"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                  <div class="col-md-4">
                                    <!-- <select id="i_itemid" name="i_itemid" class="js-example-basic-multiple" multiple="multiple"></select> -->
                                    <select id="i_itemid" class="js-example-basic-multiple" onchange="selectBarang()"></select>
                                  </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="site_statistics_content">
                                        <div id="container2" style="height: 400px; width: : 310px"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
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
        <!-- <script src="<?php echo base_url();?>assets/highcharts.js" type="text/javascript"></script> -->
        <!-- <script src="<?php echo base_url();?>assets/theme/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script> -->
        <script src="<?php echo base_url();?>assets/highstock.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/exporting.js" type="text/javascript"></script>

        <script type="text/javascript">
        (function($) {
          $.fn.countTo = function(options) {
              // merge the default plugin settings with the custom options
              options = $.extend({}, $.fn.countTo.defaults, options || {});

              // how many times to update the value, and how much to increment the value on each update
              var loops = Math.ceil(options.speed / options.refreshInterval),
                  increment = (options.to - options.from) / loops;

              return $(this).each(function() {
                  var _this = this,
                      loopCount = 0,
                      value = options.from,
                      interval = setInterval(updateTimer, options.refreshInterval);

                  function updateTimer() {
                      value += increment;
                      loopCount++;
                      $(_this).html(value.toFixed(options.decimals));

                      if (typeof(options.onUpdate) == 'function') {
                          options.onUpdate.call(_this, value);
                      }

                      if (loopCount >= loops) {
                          clearInterval(interval);
                          value = options.to;

                          if (typeof(options.onComplete) == 'function') {
                              options.onComplete.call(_this, value);
                          }
                      }
                  }
              });
          };

          $.fn.countTo.defaults = {
              from: 0,  // the number the element should start at
              to: 100,  // the number the element should end at
              speed: 1000,  // how long it should take to count between the target numbers
              refreshInterval: 100,  // how often the element should be updated
              decimals: 0,  // the number of decimal places to show
              onUpdate: null,  // callback method for every time the element is updated,
              onComplete: null,  // callback method for when the element finishes updating
          };
      })(jQuery);

          $(document).ready(function(){
            $('#container2').highcharts();
            var date   = [];
            var aa_date = '';
            var pembelian = [];
            var penjualan = [];
            var tanggalutc = [];
            var date_parse_to_hc_pembelian;
            var date_parse_to_hc_penjualan;
            var data_hc = '';
            var date_parse_to_hc_pembelian_ = [];
            var date_parse_to_hc_penjualan_ = [];
            var pembelian_ = '';

            // $(".js-example-basic-multiple").select2();

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                var strstart = start.format('YYYY-MM-DD H:m:s');
                var strend = end.format('YYYY-MM-DD H:m:s');
                getDataSummary(strstart, strend);
                get_val_chart(strstart, strend);
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);


            selectList_globalmulti("#i_itemid", "Dashboard/loadDataSelectWhere", "Pilih Barang");

            function get_val_chart(strstart, strend){
              var tanggalstart;
              var tanggalend;
              $.ajax({
                dataType  : "json",
                type      : "POST",
                data      : {
                  strstart  : strstart,
                  strend    : strend
                },
                url       : "<?php echo base_url()?>Dashboard/Aruskas",
                success   : function(data){
                  $.each(data, function(index, value){
                    pembelian = value.pembelian;
                    penjualan = value.penjualan;

                    tanggaljual    = value.tanggaljual;
                    tanggalbeli    = value.tanggalbeli;
                    tanggaljual      = tanggaljual.split("-");
                    tanggalbeli      = tanggalbeli.split("-");
                    tanggaljual      = Date.UTC(tanggaljual[0], tanggaljual[1], tanggaljual[2]);
                    tanggalbeli      = Date.UTC(tanggalbeli[0], tanggalbeli[1], tanggalbeli[2]);
                    // console.log(tanggaljual);
                    aa_date   = value.tanggal;


                    tanggalstart = value.tanggalstart;
                    tanggalend = value.tanggalend;
                    tanggalend = tanggalend.split("-");

                    tanggalstart = tanggalstart.split("-");
                    tanggalstart = Date.UTC(tanggalstart[0], tanggalstart[1], tanggalstart[2]);

                    date       = aa_date.split("-");
                    tanggalutc = Date.UTC(date[0], date[1], date[2]);
                    date_parse_to_hc_pembelian = [Date.UTC(date[0], date[1], date[2]), parseInt(pembelian)];
                    date_parse_to_hc_pembelian_.push(date_parse_to_hc_pembelian);
                    date_parse_to_hc_penjualan = [Date.UTC(date[0], date[1], date[2]), parseInt(penjualan)];
                    date_parse_to_hc_penjualan_.push(date_parse_to_hc_penjualan);
                    // console.log(date_parse_to_hc_penjualan_);
                  });
                  Highcharts_(date_parse_to_hc_pembelian_, date_parse_to_hc_penjualan_, tanggalstart, tanggalend);
                }
              });
          }
          cb(start, end);
          // get_val_chart();

          function Highcharts_(pembelian, penjualan, tanggalstart, tanggalend){
                  Highcharts.chart('container', {
                    chart: {
                        type: 'spline'
                    },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text: 'Grafik Penjualan dan Pembelian'
                    },
                    xAxis: {
                        type: 'datetime',
                        dateTimeLabelFormats: { // don't display the dummy year
                            month: '%e. %b',
                            year: '%b'
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yAxis: {
                        title: {
                            text: ''
                        },
                        min: 0
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                enabled: true
                            }
                        }
                    },
                    series: [{
                        name: 'Pembelian',
                        data: pembelian
                    },{
                        name: 'Penjualan',
                        data: penjualan
                    }]
                    // series:[]
                  });
                }

        });

          function selectBarang(){
            var barang_id = $('#i_itemid').val();
            var paramArr = [];
            paramArr.push({name: 'barang_id', value: barang_id});
            postData2(paramArr, "Dashboard/Grafikbarang");
          }


          function getQtyresult(dataLocal){
              var listbarang = [];
              var listbarang2 = [];

              // var name = [];
              // var datax = [];
              var listbarangnama = [];
              var listtanggal = [];
              for (var i = 0; i < dataLocal.barang.length; i++) {
                // var date      = dataLocal.barang[i].penjualan_date.split("-");
                // listtanggal.push([Date.UTC(date[0], date[1], date[2])]);
                listbarang.push({ "name" : dataLocal.barang[i].barang_nama.toString(), "total_barangqty"  : dataLocal.barang[i].total_barangqty, "tanggal" : dataLocal.barang[i].penjualan_date });
              }

              for (var i = 0; i < dataLocal.barang_nama.length; i++) {
                listbarangnama.push(dataLocal.barang_nama[i].barang_nama.toString());
              }

              var group_to_values = listbarang.reduce(function(obj,item){
                obj[item.name] = obj[item.name] || [];
                var date      = item.tanggal.split("-");
                obj[item.name].push([Date.UTC(date[0], date[1], date[2]), item.total_barangqty]);
                return obj;
            }, {});

              var groups = Object.keys(group_to_values).map(function(key){
                return {name: key, data: group_to_values[key]};
            });


              var chart = $('#container2').highcharts();
              var i = 0;
              var options1 = {
                  chart: {
                      renderTo: 'container2',
                      type    : 'bar'
                  },
                  xAxis: {
                      type: 'datetime',
                      dateTimeLabelFormats: { // don't display the dummy year
                          month: '%e. %b',
                          year: '%b'
                      },
                      title: {
                          text: 'Date'
                      }
                  },
                  yAxis: {
                      title: {
                          text: ''
                      },
                      min: 0
                  },
                  plotOptions: {
                      spline: {
                          marker: {
                              enabled: true
                          }
                      }
                  },
                  series: []
              };

              var drawChart = function (data, name) {
                  // 'series' is an array of objects with keys: 'name' (string) and 'data' (array)
                  var newSeriesData = {
                      name: name,
                      data: data
                  };

                  // Add the new data to the series array
                  options1.series.push(newSeriesData);

                  // If you want to remove old series data, you can do that here too

                  // Render the chart
                  var chart = new Highcharts.Chart(options1);
              };

                $.each(groups, function(index, value){
                  // console.log(value);
                  drawChart(value.data, value.name);
                  i++;
                });
          }



          function getDataSummary(strstart, strend){
            $.ajax({
              dataType  : "json",
              type      : "POST",
              data      : {
                strstart : strstart,
                strend : strend
              },
              url       : "<?php echo base_url()?>Dashboard/getDataSummary",
              success   : function (data) {
                // Intl.NumberFormat().format(item_disc)
                $('#pengunjung_count').countTo({
                   from: 50,
                   to: data.jmlpengunjung.jmlpengunjung,
                   speed: 1000,
                   refreshInterval: 50,
               });

                $('#penjualan_count').countTo({
                   from: 50,
                   to: data.jmlpenjualan.jmlpenjualan,
                   speed: 1000,
                   refreshInterval: 50,
               });

               $('#penjualan_avg').countTo({
                  from: 50,
                  to: data.avgpenjualan.avgpenjualan,
                  speed: 1000,
                  refreshInterval: 50,
              });

              }
            })
          }

          function btnUpguest(){
            var jmlpenjualan = parseInt(document.getElementById('pengunjung_count').innerHTML) + 1;
            document.getElementById('pengunjung_count').innerHTML = jmlpenjualan;
            saveintot_pengunjung();
          }

          function buttonDownguest(){
            var jmlpenjualan = parseInt(document.getElementById('pengunjung_count').innerHTML) - 1;
            if (jmlpenjualan >= 0) {
              document.getElementById('pengunjung_count').innerHTML = jmlpenjualan;
            }
            saveintot_pengunjung();
          }

          function saveintot_pengunjung(){
            var jmlpenjualan = parseInt(document.getElementById('pengunjung_count').innerHTML);
            $.ajax({
              type      : "POST",
              url       : "<?php echo base_url();?>Dashboard/saveintot_pengunjung",
              data      : {jmlpenjualan:jmlpenjualan},
              dataType  : "json",
              success   : function(data){

              }
            });
          }

        </script>

    </body>

</html>
