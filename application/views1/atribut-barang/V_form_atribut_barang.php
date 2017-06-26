<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Atribut-Barang/postData/">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">ID Atribut (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Barang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_barang_id" name="m_barang_id" aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Atribut
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="atribut_nama" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Jenis
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="mt-radio-inline">
                        <i class="fa"></i>
                        <label class="mt-radio"> Text
                            <input type="radio" value="3" name="atribut_jenis" id="text" onclick="check_defaultValue()" checked />
                            <span></span>
                        </label>
                        <label class="mt-radio"> Textarea
                            <input type="radio" value="2" name="atribut_jenis" id="textarea" onclick="check_defaultValue()" />
                            <span></span>
                        </label>
                        <label class="mt-radio"> Option
                            <input type="radio" value="1" name="atribut_jenis" id="option" onclick="check_defaultValue()" />
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Satuan
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <!-- <input type="text" class="form-control" name="atribut_satuan" /> -->
                        <select class="form-control select2" id="atribut_satuan" name="atribut_satuan" />
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Default Value
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
                        <button type="button" id="modalAddOption" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Option
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Status Atribut
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="atribut_status_aktif" aria-required="true" aria-describedby="select-error" required>
                            <option id="aktif" value="y"> Aktif </option>
                            <option id="nonaktif" value="n"> Non Aktif </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="submit" class="btn green-jungle">Submit</button>
                    <button type="button" class="btn default reset" onclick="reset(),check_defaultValue()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM -->
    <script type="text/javascript">
        $(document).ready(function(){
            check_defaultValue();
            itemOption = parseInt($("#jml_itemOption").val());
            $('#modalAddOption').on('click', function() {
              generateItemOption();
            });
        });

        function check_defaultValue() {
            $("#default_value").empty();
            $("#default_value2").empty();
            $("#jml_itemOption").val(1);
            itemOption = parseInt($("#jml_itemOption").val());
            if (document.getElementById('text').checked) {
                $("#default_value").append('\
                    <div class="col-md-8">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control" name="atribut_default_value" required />\
                        </div>\
                    </div>\
                ');
                $("#button_tambahOption").addClass("hidden");
            } else if (document.getElementById('textarea').checked) {
                $("#default_value").append('\
                    <div class="col-md-8">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <textarea name="atribut_default_value" class="form-control" rows="3" required></textarea>\
                        </div>\
                    </div>\
                ');
                $("#button_tambahOption").addClass("hidden");
            } else if (document.getElementById('option').checked) {
                $("#default_value").append('\
                    <label class="control-label col-md-1">Id\
                        <span class="required"> * </span>\
                    </label>\
                    <div class="col-md-2">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control kode" name="atribut_default_value_id'+itemOption+'" required />\
                        </div>\
                    </div>\
                    <label class="control-label col-md-2">Nama\
                        <span class="required"> * </span>\
                    </label>\
                    <div class="col-md-3">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control" name="atribut_default_value_nama'+itemOption+'" required />\
                        </div>\
                    </div>\
                ');
                $("#button_tambahOption").removeClass("hidden");
            }
        }

        function generateItemOption() {
            itemOption++;
            $("#jml_itemOption").val(itemOption);
            $("#default_value2").append('\
                <div id="detail'+itemOption+'">\
                <div class="form-group">\
                    <label class="col-md-offset-4 control-label col-md-1">Id\
                        <span class="required"> * </span>\
                    </label>\
                    <div class="col-md-2">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control kode" name="atribut_default_value_id'+itemOption+'" required />\
                        </div>\
                    </div>\
                    <label class="control-label col-md-2">Nama\
                        <span class="required"> * </span>\
                    </label>\
                    <div class="col-md-2">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control" name="atribut_default_value_nama'+itemOption+'" required />\
                        </div>\
                    </div>\
                    <div class="col-md-1">\
                        <button class="btn red-thunderbird" type="button" title="Remove Option" onclick="removeItemOption('+itemOption+')">\
                            <i class="icon-close"></i>\
                        </button>\
                    </div>\
                </div>\
                </div>\
            ');
        }

        function removeItemOption(itemSeq) {
            var parent = document.getElementById("default_value2");
            for (var i = 1; i <= itemOption; i++) {
              if (i >= itemSeq && i < itemOption) {
                var inp1 = document.getElementsByName("atribut_default_value_id"+(i+1))[0].value;
                var inp2 = document.getElementsByName("atribut_default_value_nama"+(i+1))[0].value;

                document.getElementsByName("atribut_default_value_id"+i)[0].value = inp1;
                document.getElementsByName("atribut_default_value_nama"+i)[0].value = inp2;
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
    </script>