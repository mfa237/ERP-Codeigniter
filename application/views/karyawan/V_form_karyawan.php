<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Karyawan/postData/">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">Kode Karyawan (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">NIP Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control kode" name="karyawan_nip" onchange="checkNip()" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="karyawan_nama" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Alamat Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <textarea class="form-control" rows="3" name="karyawan_alamat" required></textarea> </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-md-4">Telepon Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="hidden" name="jml_itemOption" id="jml_itemOption" value="1" />
                        <input type="text" class="form-control telp" name="karyawan_telepon1" required /> 
                        <div id="default_value">
                        </div>
                    </div>
                </div>
            </div>
            <div id="telepon-karyawan">
            </div>
            <div class="form-group hidden" id="button_tambahOption">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOption" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Option
                        </button>
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Telepon Karyawan
                    <span class="required"> * </span>
                </label>
                <input type="hidden" name="jml_itemOption" id="jml_itemOption" value="1" />
                <div id="default_value">
                </div>
            </div>
            <div id="default_value2">
            </div>
            <div class="form-group hidden" id="button_tambahOption">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOption" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Telepon
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Tipe Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_type_karyawan_id" name="m_type_karyawan_id" aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_cabang_id" name="m_cabang_id" aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Departemen
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_departemen_id" name="m_departemen_id" aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Status Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="karyawan_status_aktif" aria-required="true" aria-describedby="select-error" required>
                            <option id="aktif" value="y"> Aktif </option>
                            <option id="nonaktif" value="n"> Non Aktif </option>
                        </select>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="submit" class="btn green-jungle">Submit</button>
                    <button type="button" class="btn default reset" onclick="reset(),defaultValue()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
    <script type="text/javascript">
        $(document).ready(function(){
            defaultValue();
            itemOption = parseInt($("#jml_itemOption").val());
            $('#modalAddOption').on('click', function() {
              generateItemOption();
            });
        });

        function defaultValue() {
            $("#default_value").empty();
            $("#default_value2").empty();
            $("#jml_itemOption").val(1);
            itemOption = parseInt($("#jml_itemOption").val());
            $("#default_value").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="karyawan_telepon[]" id="karyawan_telepon1" required />\
                    </div>\
                </div>\
            ');
            $("#button_tambahOption").removeClass("hidden");
            $(".telp").keydown(function(event) {
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

        function generateItemOption() {
            itemOption++;
            $("#jml_itemOption").val(itemOption);
            $("#default_value2").append('\
                <div id="detail'+itemOption+'">\
                <div class="form-group">\
                    <div class="col-md-offset-4 col-md-7">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control telp" name="karyawan_telepon[]" id="karyawan_telepon'+itemOption+'" required />\
                        </div>\
                    </div>\
                    <div class="col-md-1">\
                        <button class="btn red-thunderbird" type="button" title="Remove Telepon" onclick="removeItemOption('+itemOption+')">\
                            <i class="icon-close"></i>\
                        </button>\
                    </div>\
                </div>\
                </div>\
            ');
            $(".telp").keydown(function(event) {
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

        function generateItemOption2(seq) {
            $("#jml_itemOption").val(seq);
            $("#default_value2").append('\
                <div id="detail'+seq+'">\
                <div class="form-group">\
                    <div class="col-md-offset-4 col-md-7">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control telp" name="karyawan_telepon[]" id="karyawan_telepon'+seq+'" required />\
                        </div>\
                    </div>\
                    <div class="col-md-1">\
                        <button class="btn red-thunderbird" type="button" title="Remove Telepon" onclick="removeItemOption('+seq+')">\
                            <i class="icon-close"></i>\
                        </button>\
                    </div>\
                </div>\
                </div>\
            ');
            $(".telp").keydown(function(event) {
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

        function removeItemOption(itemSeq) {
            var parent = document.getElementById("default_value2");
            for (var i = 1; i <= itemOption; i++) {
              if (i >= itemSeq && i < itemOption) {
                var inp1 = document.getElementById("karyawan_telepon"+(i+1)).value;

                document.getElementById("karyawan_telepon"+i).value = inp1;
              };
            };
            for (var i = 1; i <= itemOption; i++) {
              if (i==itemOption) {
                var child = document.getElementById("detail"+i);
                parent.removeChild(child);
              };
            };
            itemOption--;
            $("#jml_itemOption").val(itemOption);
        }

        function checkNip() {
            $.ajax({
                type : "GET",
                url  : '<?php echo base_url();?>Master-Data/Karyawan/checkNip/',
                data : { nip : document.getElementsByName('karyawan_nip')[0].value },
                dataType : "json",
                success:function(data){
                    if (data.status == '204') {
                        swal({
                            title: "Alert!",
                            text: "NIP Karyawan Sudah ada!",
                            type: "error",
                            confirmButtonClass: "btn-raised btn-danger",
                            confirmButtonText: "OK",
                        });
                        document.getElementsByName('karyawan_nip')[0].value = null;
                    }
                }
            });
        }
    </script>