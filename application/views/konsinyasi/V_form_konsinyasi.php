<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Konsinyasi/postData/">
            <input type="hidden" id="url_data" value="Master-Data/Konsinyasi">
            <input type="hidden" id="stock_gudang_jumlah" name="stock_gudang_jumlah" >
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">Kode Konsinyasi (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Category 1
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_jenis_barang_id" name="m_jenis_barang_id"
                        aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Category 2
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_category_2_id" name="m_category_2_id"
                        aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Barang Konsinyasi
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_barang_id" name="m_barang_id"
                        aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-4">Status Konsinyasi
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="konsinyasi_status_aktif" aria-required="true" aria-describedby="select-error" required>
                            <option id="aktif" value="y"> Aktif </option>
                            <option id="nonaktif" value="n"> Non Aktif </option>
                        </select>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="button" class="btn green-jungle" id="submit">Submit</button>
                    <button type="button" class="btn default reset" onclick="reset()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
    <script type="text/javascript">
        $(document).ready(function(){
        });
        $("#m_jenis_barang_id").change(function(){
            var m_jenis_barang_id = document.getElementById("m_jenis_barang_id").value;
            select2List('#m_category_2_id', 'Master-Data/Master-Kategori/loadDataSelectWhere', 'Pilih Category 2', m_jenis_barang_id);
        });

        $("#m_category_2_id").change(function(){
            var m_category_2_id = document.getElementById("m_category_2_id").value;
            select2Listkonsinyasi('#m_barang_id', 'Master-Data/Konsinyasi/loadDataSelectBarang', 'Pilih Barang Konsinyasi', m_category_2_id);

        });


    function FormatResult_(data) {
        markup = '<div>'+data.text+'</div>';
        return markup;
    }

    function FormatSelection_(data) {
        return data.text;
    }

      function select2Listkonsinyasi(idElemen = null, url_data = null, label = null, parameter = null) {
        // alert();
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
          templateResult: FormatResult_,
          templateSelection: FormatSelection_,
        });
      }

      $('#m_barang_id').on("change", function(e) {
        var barang_id = $(this).val();
        var url = "C_barang/checkGudang";
        $.ajax({
          type: "POST",
          url: $base_url+url,
          data: {barang_id:barang_id}, // serializes the form's elements.
          dataType:"json",
          success: function(data)
          {
            console.log(data.stock_gudang_jumlah);
            $('#stock_gudang_jumlah').val(data.stock_gudang_jumlah);
          }
        });
      });


      $('#submit').on('click', function(){
        var stock_gudang_jumlah = $('#stock_gudang_jumlah').val();
        if (stock_gudang_jumlah <= 0) {
          actionData2();
        } else {
          alert("Stok Masih Ada !!");
        }
      })
    </script>
