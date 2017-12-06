<!-- BEGIN FORM-->

    <form action="#" id="formAdd" name="formAddbarang" class="form-horizontal" method="post">

        <div class="form-body">

            <div class="alert alert-danger display-hide">

                <button class="close" data-close="alert"></button> You have some form errors. Please check below.

            </div>

            <div class="alert alert-success display-hide">

                <button class="close" data-close="alert"></button> Your form validation is successful!

            </div>

            <input type="hidden" id="barang_kode" name="barang_nomor">

            <input type="hidden" id="url" value="Master-Data/Barang/postData/">

            <input type="hidden" id="url_data" value="Master-Data/Barang">

            <div class="form-group" hidden="true">

                <label class="control-label col-md-4">ID Barang (Auto)

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <input type="text" class="form-control" name="kode" readonly/> </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Artikel

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <input type="text" class="form-control kode" readonly/> </div>

                </div>

            </div>

            <!-- <div class="form-group">

                <label class="control-label col-md-4">Nomor Barang

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <input type="text" class="form-control" name="barang_nomor" /> </div>

                </div>

            </div> -->

            <div class="form-group">

                <label class="control-label col-md-4">Nama Barang

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <input type="text" class="form-control" id="barang_nama" name="barang_nama" required /> </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Nama Category 1

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control" id="m_jenis_barang_id" name="m_jenis_barang_id" aria-required="true" aria-describedby="select-error" required>

                        </select>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Nama Category 2

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control" id="m_category_2_id" name="m_category_2_id" aria-required="true" aria-describedby="select-error" required>

                        </select>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Minimum Stok

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <input type="text" class="form-control num2" name="barang_minimum_stok" value="0" required /> </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Satuan Barang

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control" id="m_satuan_id" name="m_satuan_id" aria-required="true" aria-describedby="select-error" required>

                        </select>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Nama Brand

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control" id="m_brand_id" name="m_brand_id" aria-required="true" aria-describedby="select-error" required>

                        </select>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Status Barang

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control select2" name="barang_status_aktif" aria-required="true" aria-describedby="select-error" required>

                            <option id="aktif" value="y"> Aktif </option>

                            <option id="nonaktif" value="n"> Non Aktif </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div class="form-group">

            <label class="control-label col-md-4">Harga Beli

                <span class="required"> * </span>

            </label>

            <div class="col-md-8">

                <div class="input-icon right">

                    <i class="fa"></i>

                    <input type="text" class="form-control num2" name="harga_beli" required /> </div>

            </div>

        </div>

        <div class="form-group">

            <label class="control-label col-md-4">Harga Jual

                <span class="required"> * </span>

            </label>

            <div class="col-md-8">

                <div class="input-icon right">

                    <i class="fa"></i>

                    <input type="text" class="form-control num2" name="harga_jual" id="harga_jual" required /> </div>

            </div>

        </div>

        <div class="form-group">

            <label class="control-label col-md-4">Harga Jual + Pajak

                <span class="required"> * </span>

            </label>

            <div class="col-md-8">

                <div class="input-icon right">

                    <i class="fa"></i>

                    <input type="text" class="form-control num2" name="harga_jual_pajak" id="harga_jual_pajak"/>

                </div>

            </div>

        </div>

        <div class="form-actions">

            <div class="row">

                <div class="col-md-offset-4 col-md-8 text-right">

                    <button type="submit" class="btn green-jungle hidden" id="submitedit">Submit</button>

                    <button type="submit" class="btn green-jungle" id="submit">Submit</button>

                    <button type="button" class="btn default reset" onclick="reset()">Reset</button>

                </div>

            </div>

        </div>

    </form>

    <!-- END FORM -->

    <script type="text/javascript">

        $(document).ready(function(){

        });



        $("#m_jenis_barang_id").change(function(){

            var m_jenis_barang_id = document.getElementById("m_jenis_barang_id").value;

            select2List('#m_category_2_id', 'Master-Data/Master-Kategori/loadDataSelectWhere', 'Pilih Category 2', m_jenis_barang_id);

            // $('#m_category_2_id').select2('destroy');

            // $('#m_category_2_id').select2();

        });



        $("#m_category_2_id").change(function(){

            generate_artikel();

        });



        $("#harga_jual").change(function(){

          harga_jual_pajak();

        });



        $("#harga_jual_pajak").change(function(){

          harga_jual();

        });



        function harga_jual_pajak() {

            subTotal = parseFloat(document.getElementById('harga_jual').value.replace(/\,/g, ""));

            var hargajualpajak = subTotal + (subTotal * 10 / 100);

            hargajualpajak = pembulatan(hargajualpajak);

            document.getElementById('harga_jual_pajak').value = hargajualpajak;

            $('.num2').number( true, 2, '.', ',' );

            $('.num2').css('text-align', 'right');

        }



        function harga_jual() {

            Total = parseFloat(document.getElementById('harga_jual_pajak').value.replace(/\,/g, ""));

            var hargajual = Total/110*100;

            hargajual = hargajual;

            document.getElementById('harga_jual').value = hargajual;

            $('.num2').number( true, 2, '.', ',' );

            $('.num2').css('text-align', 'right');

        }



        function generate_artikel() {

            var cat1 = document.getElementById('m_jenis_barang_id').value;

            var cat2 = document.getElementById('m_category_2_id').value;



            if(cat1 < 10)

            {

                cat1 = "0"+cat1;

            }

            if(cat2 < 10)

            {

                cat2 = "0"+cat2;

            }



            $.ajax({

              type    : 'POST',

              data    : {cat1:cat1, cat2:cat2},

              url     : $base_url+'Master-Data/Barang/getLastId',

              dataType: "JSON",

              success:function(data){

                document.getElementById('barang_kode').value = cat1+cat2+data;

              }

            });

        }



      // submitedit

      $("#submitedit").on('click', function(e) {

        actionData2();

      });



      $("#submit").on('click', function(e) {

        // alert();

      var url = "Master-Barang/CheckNamabarang"; // the script where you handle the form input.

      var barang_nama = $("#barang_nama").val();

      $.ajax({

             type: "POST",

             url: $base_url+url,

             data: {barang_nama:barang_nama}, // serializes the form's elements.

             dataType : "json",

             success: function(data)

             {

                 if(data.status == '200')

                 {

                  //  alert("ok");

                   actionData2();

                 } else if (data.status == '204') {

                   alert("Item Sudah ada, Mohon menggunakan nama lain");

                  // alert("gak");

                 }

             }

           });



      e.preventDefault(); // avoid to execute the actual submit of the form.

      // break;

  });



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


    </script>

