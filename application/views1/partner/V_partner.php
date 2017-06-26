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
                                                      echo '<button id="modalAdd-btn" class="btn sbold dark" data-toggle="modal" onclick="openFormPartner(),reset()"><i class="icon-plus"></i>&nbsp; Tambah Data
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
                                                <th> Status Partner </th>
                                                <th> Nama Partner </th>
                                                <th> Nama Cetak Partner </th>
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
        <div class="modal fade" id="modal_login">
          <div class="modal-dialog">
            <div class="modal-content">

            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
                      url: '<?php echo base_url();?>Master-Data/Partner/loadData/'
                    },
                    "columns": [
                      {"name": "no","orderable": false,"searchable": false,  "className": "text-center", "width": "5%"},
                      {"name": "partner_status"},
                      {"name": "partner_nama"},
                      {"name": "partner_nama_cetak"},
                      {"name": "partner_status_aktif"},
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
            }

              function editData(id) {
                $.ajax({
                  type : "GET",
                  url  : '<?php echo base_url();?>Master-Data/Partner/loadDataWhere/',
                  data : "id="+id,
                  dataType : "json",
                  success:function(data){
                    for(var i=0; i<data.val.length;i++){
                      document.getElementsByName("kode")[0].value = data.val[i].kode;
                      if(data.val[i].partner_status == "1")
                      {
                        document.getElementById('supplier').setAttribute("checked", "checked");
                      }
                      else if(data.val[i].partner_status == "2")
                      {
                        document.getElementById('customer').setAttribute("checked", "checked");
                      }
                      else
                      {
                        document.getElementById('supplier_customer').setAttribute("checked", "checked");
                      }
                      document.getElementsByName("partner_nama")[0].value = data.val[i].partner_nama;
                      for(var j=0; j<data.val[i].partner_kota.val2.length; j++){
                        $("#partner_kota").append('<option value="'+data.val[i].partner_kota.val2[j].id+'" selected>'+data.val[i].partner_kota.val2[j].text+'</option>');
                      }
                      // selectList_Kota('#partner_kota', 'Master-Data/Cabang/loadDataSelectKota');
                      // document.getElementsByName("partner_nama_cetak")[0].value = data.val[i].partner_nama_cetak;
                      // nama cetak
                       document.getElementsByName("jml_itemOptionNama")[0].value = data.val[i].jml_namaCetak;
                      itemOptionNama = parseInt($("#jml_itemOptionNama").val());
                      for (var j = 2; j <= itemOptionNama; j++) {
                          generateItemOption2(j, "partner_nama_cetak", "default_value2Nama", "detailNamaCetak");
                      }
                      for(var j=0; j<data.val[i].partner_nama_cetak.val2.length; j++){
                        document.getElementById("partner_nama_cetak"+(j+1)).value = data.val[i].partner_nama_cetak.val2[j].text
                      }
                      // end nama cetak
                      document.getElementsByName("partner_alamat")[0].value = data.val[i].partner_alamat;
                      // document.getElementsByName("partner_alamat_cetak")[0].value = data.val[i].partner_alamat_cetak;
                      // alamat cetak
                       document.getElementsByName("jml_itemOptionAlamat")[0].value = data.val[i].jml_alamatCetak;
                      itemOptionAlamat = parseInt($("#jml_itemOptionAlamat").val());
                      for (var j = 2; j <= itemOptionNama; j++) {
                          generateItemOption2(j, "partner_alamat_cetak", "default_value2Nama", "detailNamaCetak");
                      }
                      for(var j=0; j<data.val[i].partner_alamat_cetak.val2.length; j++){
                        document.getElementById("partner_alamat_cetak"+(j+1)).value = data.val[i].partner_alamat_cetak.val2[j].text
                      }
                      // end alamat cetak
                      // document.getElementsByName("partner_telepon")[0].value = data.val[i].partner_telepon;
                      // document.getElementsByName("partner_telepon_cetak")[0].value = data.val[i].partner_telepon_cetak;
                      // telepon
                      document.getElementsByName("jml_itemOption")[0].value = data.val[i].jml_telepon;
                      itemOption = parseInt($("#jml_itemOption").val());
                      for (var j = 2; j <= itemOption; j++) {
                          generateItemOption2(j, "partner_telepon", "default_value2", "detail");
                      }
                      for(var j=0; j<data.val[i].partner_telepon.val2.length; j++){
                        document.getElementById("partner_telepon"+(j+1)).value = data.val[i].partner_telepon.val2[j].text
                      }
                      // telepon
                      // telepon cetak
                       document.getElementsByName("jml_itemOptionTelpCetak")[0].value = data.val[i].jml_telpCetak;
                      itemOptionTelpCetak = parseInt($("#jml_itemOptionTelpCetak").val());
                      for (var j = 2; j <= itemOptionTelpCetak; j++) {
                          generateItemOption2(j, "partner_telepon_cetak", "default_value2TelpCetak", "detailTelpCetak");
                      }
                      for(var j=0; j<data.val[i].partner_telepon_cetak.val2.length; j++){
                        document.getElementById("partner_telepon_cetak"+(j+1)).value = data.val[i].partner_telepon_cetak.val2[j].text
                      }
                      // end telepon cetak
                      // email
                       document.getElementsByName("jml_itemOptionEmail")[0].value = data.val[i].jml_email;
                      itemOptionEmail = parseInt($("#jml_itemOptionEmail").val());
                      for (var j = 2; j <= itemOptionEmail; j++) {
                          generateItemOption2(j, "partner_email", "default_value2Email", "detailEmail");
                      }
                      for(var j=0; j<data.val[i].partner_email.val2.length; j++){
                        document.getElementById("partner_email"+(j+1)).value = data.val[i].partner_email.val2[j].text
                      }
                      // end email
                      // email cetak
                       document.getElementsByName("jml_itemOptionEmailCetak")[0].value = data.val[i].jml_emailCetak;
                      itemOptionEmailCetak = parseInt($("#jml_itemOptionEmailCetak").val());
                      for (var j = 2; j <= itemOptionEmailCetak; j++) {
                          generateItemOption2(j, "partner_email_cetak", "default_value2EmailCetak", "detailEmailCetak");
                      }
                      for(var j=0; j<data.val[i].partner_email_cetak.val2.length; j++){
                        document.getElementById("partner_email_cetak"+(j+1)).value = data.val[i].partner_email_cetak.val2[j].text
                      }
                      // end email cetak
                      // fax
                      document.getElementsByName("jml_itemOptionFax")[0].value = data.val[i].jml_fax;
                      itemOption = parseInt($("#jml_itemOptionFax").val());
                      for (var j = 2; j <= itemOption; j++) {
                          generateItemOption2(j, "partner_fax", "default_value2", "detail");
                      }
                      for(var j=0; j<data.val[i].partner_fax.val2.length; j++){
                        document.getElementById("partner_fax"+(j+1)).value = data.val[i].partner_fax.val2[j].text
                      }
                      // end fax
                      // fax_cetak
                      document.getElementsByName("jml_itemOptionFaxCetak")[0].value = data.val[i].jml_fax_cetak;
                      itemOption = parseInt($("#jml_itemOptionFaxCetak").val());
                      for (var j = 2; j <= itemOption; j++) {
                          generateItemOption2(j, "partner_fax_cetak", "default_value2", "detail");
                      }
                      for(var j=0; j<data.val[i].partner_fax_cetak.val2.length; j++){
                        document.getElementById("partner_fax_cetak"+(j+1)).value = data.val[i].partner_fax_cetak.val2[j].text
                      }
                      // end fax_cetak
                      document.getElementsByName("partner_limit_kredit")[0].value = data.val[i].partner_limit_kredit;
                      document.getElementsByName("partner_nomor_npwp")[0].value = data.val[i].partner_nomor_npwp;
                      document.getElementById('namafile').innerHTML = 'Nama File : <a href="<?php echo base_url();?>uploads/file_npwp_partner/'+ data.val[i].partner_file_npwp +'" download>' + data.val[i].partner_file_npwp + '</a>';
                      document.getElementsByName("partner_file_npwp_lama")[0].value = data.val[i].partner_file_npwp;
                      if (data.val[i].partner_status_aktif == 'y') {
                        document.getElementById('aktif').selected = true;
                      } else if (data.val[i].partner_status_aktif == 'n') {
                        document.getElementById('nonaktif').selected = true;
                      }
                      rules();
                    }
                  }
                });

              }

              function deleteData(id) {
                $.ajax({
                  type : 'POST',
                  url  : $base_url+'Master-Data/Partner/getFormLogin/',
                  data : { id : id },
                  dataType : "html",
                  success:function(data){
                    $("#modal_login .modal-content").html();
                    $("#modal_login .modal-content").html(data);
                    $('#modal_login').modal('show');
                    MyFormValidation.init();
                    rules();
                    $("#formLogin").submit(function(event){
                      if ($("#formLogin").valid() == true) {
                      $.ajax({
                        type : "POST",
                        url  : $base_url+''+$("#formLogin").attr('action'),
                        data : $( "#formLogin" ).serialize(),
                        dataType : "json",
                        success : function(data){
                          if (data.status=='200') {
                            $.ajax({
                              url: '<?php echo base_url();?>Master-Data/Partner/deleteData/',
                              data: 'id='+id,
                              type: 'POST',
                              dataType: 'json',
                              success: function (data) {
                                if (data.status=='200') {
                                  alert_success_nonaktif();
                                  searchData();
                                  $('#modal_login').modal('hide');
                                } else if (data.status=='204') {
                                  alert_fail_aktif();
                                }
                              }
                            });
                          } else if (data.status=='204') {
                            // alert_fail_aktif();
                          }
                        }
                      })
                      }
                      return false;
                    });
                  }
                });

              //   swal({
              //     title: "Apakah anda yakin?",
              //     text: "Data akan dinonaktifkan !",
              //     type: "warning",
              //     showCancelButton: true,
              //     cancelButtonClass: "btn-raised btn-warning",
              //     cancelButtonText: "Batal!",
              //     confirmButtonClass: "btn-raised btn-danger",
              //     confirmButtonText: "Ya!",
              //     closeOnConfirm: false
              //   }, function() {
              //     $.ajax({
              //       url: '<?php echo base_url();?>Master-Data/Partner/deleteData/',
              //       data: 'id='+id,
              //       type: 'POST',
              //       dataType: 'json',
              //       success: function (data) {
              //         if (data.status=='200') {
              //           alert_success_nonaktif();
              //           searchData();
              //         } else if (data.status=='204') {
              //           alert_fail_nonaktif();
              //         }
              //       }
              //     });
              //   })
              }

              function aktifData(id) {
                // swal({
                //   title: "Apakah anda yakin?",
                //   text: "Data akan diaktifkan !",
                //   type: "warning",
                //   showCancelButton: true,
                //   cancelButtonClass: "btn-raised btn-warning",
                //   cancelButtonText: "Batal!",
                //   confirmButtonClass: "btn-raised btn-danger",
                //   confirmButtonText: "Ya!",
                //   closeOnConfirm: false
                // }, function() {
                //   $.ajax({
                //     url: '<?php echo base_url();?>Master-Data/Partner/aktifData/',
                //     data: 'id='+id,
                //     type: 'POST',
                //     dataType: 'json',
                //     success: function (data) {
                //       if (data.status=='200') {
                //         alert_success_aktif();
                //         searchData();
                //       } else if (data.status=='204') {
                //         alert_fail_aktif();
                //       }
                //     }
                //   });
                // })
                $.ajax({
                  type : 'POST',
                  url  : $base_url+'Master-Data/Partner/getFormLogin/',
                  data : { id : id },
                  dataType : "html",
                  success:function(data){
                    $("#modal_login .modal-content").html();
                    $("#modal_login .modal-content").html(data);
                    $('#modal_login').modal('show');
                    MyFormValidation.init();
                    rules();
                    $("#formLogin").submit(function(event){
                      if ($("#formLogin").valid() == true) {
                      $.ajax({
                        type : "POST",
                        url  : $base_url+''+$("#formLogin").attr('action'),
                        data : $( "#formLogin" ).serialize(),
                        dataType : "json",
                        success : function(data){
                          if (data.status=='200') {
                            $.ajax({
                              url: '<?php echo base_url();?>Master-Data/Partner/aktifData/',
                              data: 'id='+id,
                              type: 'POST',
                              dataType: 'json',
                              success: function (data) {
                                if (data.status=='200') {
                                  alert_success_nonaktif();
                                  searchData();
                                  $('#modal_login').modal('hide');
                                } else if (data.status=='204') {
                                  alert_fail_aktif();
                                }
                              }
                            });
                          } else if (data.status=='204') {
                            // alert_fail_aktif();
                          }
                        }
                      })
                      }
                      return false;
                    });
                  }
                });
              }

        </script>

    </body>

</html>
