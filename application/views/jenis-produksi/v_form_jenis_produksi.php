<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Jenis-Produksi/postData/">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">Kode Jenis Produksi (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Jenis Produksi
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="jenis_produksi_nama" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Status Jenis Produksi
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="jenis_produksi_status_aktif" aria-required="true" aria-describedby="select-error" required>
                            <option id="aktif" value="y"> Aktif </option>
                            <option id="nonaktif" value="n"> Non Aktif </option>
                        </select>
                </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="control-label col-md-4">Rumus
                </label>
                <div class="col-md-8">
                </div>
            </div>
            <input type="hidden" name="jml_itemOption" id="jml_itemOption" value="1" />
            <div id="detail-rumus">
            </div>
            <div class="form-group" id="button_tambahRumus">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOption" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Parameter
                        </button>
                    </div>
                </div>
            </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="submit" class="btn green-jungle">Submit</button>
                    <button type="button" class="btn default reset" onclick="reset()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
    <script type="text/javascript">
        $(document).ready(function(){
            itemOption = parseInt($("#jml_itemOption").val());
            generateItemOption(itemOption);
            $('#modalAddOption').on('click', function() {
                itemOption++;
                generateItemOption(itemOption);
            });
        });

        function generateItemOption(idx, idDet = null) {
            if(idDet != null)
            {
                $("#detail-rumus").append('\
                    <input type="hidden" name="jenis_produksidet_id[]" id="jenis_produksidet_id'+idx+'" value="'+idDet+'">\
                ');
            }
            $("#detail-rumus").append('\
                <div class="form-group">\
                    <label class="control-label col-md-4"> Type \
                        <span class="required"> * </span>\
                    </label>\
                    <div class="col-md-8">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <label class="mt-radio"> Custom\
                                <input type="radio" value="0" name="jenis_produksi_type'+idx+'" id="custom'+idx+'" onclick="changeType('+idx+', 0)" />\
                                <span></span>\
                            </label>\
                            <label class="mt-radio"> Pilihan\
                                <input type="radio" value="1" name="jenis_produksi_type'+idx+'" id="pilihan'+idx+'" onclick="changeType('+idx+', 1)" checked />\
                                <span></span>\
                            </label>\
                        </div>\
                    </div>\
                </div>\
                <div class="form-group">\
                    <label class="control-label col-md-4"> Parameter \
                        <span class="required"> * </span>\
                    </label>\
                    <div class="col-md-8" id="parameter'+idx+'">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <select class="form-control select2" name="jenis_produksidet_parameter[]" id="jenis_produksidet_parameter'+idx+'" aria-required="true" aria-describedby="select-error" required>\
                                <option value="perolehan_produksi_akhirdet_berat"> Berat (Kg) </option>\
                                <option value="perolehan_produksi_akhirdet_panjang"> Panjang (m) </option>\
                                <option value="perolehan_produksi_akhirdet_tebal"> Tebal (m) </option>\
                                <option value="perolehan_produksi_akhirdet_micro"> Micro Meter (mm) </option>\
                                <option value="perolehan_produksi_akhirdet_qty"> Qty </option>\
                                <option value="perolehan_produksi_akhirdet_ns"> NS </option>\
                                <option value="perolehan_produksi_akhirdet_qty_rusak"> Qty Rusak </option>\
                                <option value="perolehan_produksi_akhirdet_konversi"> Konversi </option>\
                            </select>\
                        </div>\
                    </div>\
                </div>\
                <div class="form-group">\
                    <label class="control-label col-md-4"> Operator \
                        <span class="required"> * </span>\
                    </label>\
                    <div class="col-md-8">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <select class="form-control select2" name="jenis_produksidet_operator[]" id="jenis_produksidet_operator'+idx+'" aria-required="true" aria-describedby="select-error" required>\
                                <option value="1"> + </option>\
                                <option value="2"> - </option>\
                                <option value="3"> * </option>\
                                <option value="4"> / </option>\
                                <option value="5"> = </option>\
                            </select>\
                        </div>\
                    </div>\
                </div>\
            ');
            $('#jenis_produksidet_parameter'+idx).select2();
            $('#jenis_produksidet_operator'+idx).select2();
        }

        function changeType(idx,type) {
            if (type == 1) {
                $("#parameter"+idx).empty();
                $("#parameter"+idx).append('\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <select class="form-control select2" name="jenis_produksidet_parameter[]" id="jenis_produksidet_parameter'+idx+'" aria-required="true" aria-describedby="select-error" required>\
                            <option value="perolehan_produksi_akhirdet_berat"> Berat (Kg) </option>\
                            <option value="perolehan_produksi_akhirdet_panjang"> Panjang (m) </option>\
                            <option value="perolehan_produksi_akhirdet_tebal"> Tebal (m) </option>\
                            <option value="perolehan_produksi_akhirdet_micro"> Micro Meter (mm) </option>\
                            <option value="perolehan_produksi_akhirdet_qty"> Qty </option>\
                            <option value="perolehan_produksi_akhirdet_ns"> NS </option>\
                            <option value="perolehan_produksi_akhirdet_qty_rusak"> Qty Rusak </option>\
                            <option value="perolehan_produksi_akhirdet_konversi"> Konversi </option>\
                        </select>\
                    </div>\
                ');
                $('#jenis_produksidet_parameter'+idx).select2();
            } else {
                $("#parameter"+idx).empty();
                $("#parameter"+idx).append('\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control num" name="jenis_produksidet_parameter[]" id="jenis_produksidet_parameter'+idx+'" required />\
                    </div>\
                ');
            }
              $(".num").keydown(function(event) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl+A, Command+A
                    (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
                     // Allow: home, end, left, right, down, up
                    (event.keyCode >= 35 && event.keyCode <= 40)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
              });
        }

    </script>