<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Gudang/postData/">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">Kode Gudang (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="gudang_nama" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Alamat Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <textarea class="form-control" rows="3" name="gudang_alamat" required></textarea> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Kota Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <!-- <input type="text" class="form-control" name="gudang_kota" required />  -->
                        <select class="form-control select2" id="gudang_kota" name="gudang_kota" required />
                            
                        </select>
                        </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-md-4">Telepon Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control telp" name="gudang_telepon" required /> </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Telepon Gudang
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
            <!-- <div class="form-group">
                <label class="control-label col-md-4">Fax Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control telp" name="gudang_fax" required /> </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Fax Gudang
                    <span class="required"> * </span>
                </label>
                <input type="hidden" name="jml_itemOptionFax" id="jml_itemOptionFax" value="1" />
                <div id="default_valueFax">
                </div>
            </div>
            <div id="default_value2Fax">
            </div>
            <div class="form-group hidden" id="button_tambahOptionFax">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOptionFax" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Fax
                        </button>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-md-4">Email Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="gudang_email" required /> </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Email Gudang
                    <span class="required"> * </span>
                </label>
                <input type="hidden" name="jml_itemOptionEmail" id="jml_itemOptionEmail" value="1" />
                <div id="default_valueEmail">
                </div>
            </div>
            <div id="default_value2Email">
            </div>
            <div class="form-group hidden" id="button_tambahOptionEmail">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOptionEmail" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Email
                        </button>
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
                <label class="control-label col-md-4">Jenis Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_jenis_gudang_id" name="m_jenis_gudang_id" aria-required="true" aria-describedby="select-error" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Status Gudang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="gudang_status_aktif" aria-required="true" aria-describedby="select-error" required>
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
                    <button type="button" class="btn default reset" onclick="reset()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
    <script type="text/javascript">
        $(document).ready(function(){
            defaultValue();
            itemOption = parseInt($("#jml_itemOption").val());
            itemOptionFax = parseInt($("#jml_itemOptionFax").val());
            itemOptionEmail = parseInt($("#jml_itemOptionEmail").val());
            $('#modalAddOption').on('click', function() {
                // alert("masuk");
              generateItemOption("gudang_telepon", "default_value2", "detail");
            });
            $('#modalAddOptionFax').on('click', function() {
                // alert("masukfax");
              generateItemOption("gudang_fax", "default_value2Fax", "detailFax");
            });
            $('#modalAddOptionEmail').on('click', function() {
                // alert("masukfax");
              generateItemOption("gudang_email", "default_value2Email", "detailEmail");
            });
        });

        function defaultValue() {
            $("#default_value").empty();
            $("#default_value2").empty();
            $("#default_valueFax").empty();
            $("#default_value2Fax").empty();
            $("#default_valueEmail").empty();
            $("#default_value2Email").empty();
            $("#jml_itemOption").val(1);
            $("#jml_itemOptionFax").val(1);
            $("#jml_itemOptionEmail").val(1);
            itemOption = parseInt($("#jml_itemOption").val());
            itemOptionFax = parseInt($("#jml_itemOptionFax").val());
            itemOptionEmail = parseInt($("#jml_itemOptionEmail").val());
            $("#default_value").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="gudang_telepon[]" id="gudang_telepon1" required />\
                    </div>\
                </div>\
            ');
            $("#default_valueFax").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="gudang_fax[]" id="gudang_fax1" required />\
                    </div>\
                </div>\
            ');
            $("#default_valueEmail").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="email" class="form-control" name="gudang_email[]" id="gudang_email1" required />\
                    </div>\
                </div>\
            ');
            $("#button_tambahOption").removeClass("hidden");
            $("#button_tambahOptionFax").removeClass("hidden");
            $("#button_tambahOptionEmail").removeClass("hidden");
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

        function generateItemOption(nama, idDiv, idDetail) {
            var itemOpt, classInput, textInput;
            if(nama == 'gudang_telepon')
            {
                itemOption++;
                $("#jml_itemOption").val(itemOption);
                itemOpt = itemOption;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'gudang_fax')
            {
                itemOptionFax++;
                $("#jml_itemOptionFax").val(itemOptionFax);
                itemOpt = itemOptionFax;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'gudang_email')
            {
                itemOptionEmail++;
                $("#jml_itemOptionEmail").val(itemOptionEmail);
                itemOpt = itemOptionEmail;
                textInput = 'email';
            }
            $('#'+idDiv).append('\
                <div id="'+idDetail+itemOpt+'">\
                <div class="form-group">\
                    <div class="col-md-offset-4 col-md-7">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="'+textInput+'" class="form-control '+classInput+'" name="'+nama+'[]" id="'+nama+''+itemOpt+'" required />\
                        </div>\
                    </div>\
                    <div class="col-md-1">\
                        <button class="btn red-thunderbird" type="button" title="Remove Telepon" onclick=\'removeItemOption('+itemOpt+',"'+nama+'","'+idDiv+'","'+idDetail+'")\'>\
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

        function generateItemOption2(seq, nama, idDiv, idDetail) {
            var classInput;
            if(nama == 'gudang_telepon')
            {
                $("#jml_itemOption").val(seq);
                classInput = 'telp';
            }
            else if(nama == 'gudang_fax')
            {
                $("#jml_itemOptionFax").val(seq);
                classInput = 'telp';
            }
            else if(nama == 'gudang_email')
            {
                $("#jml_itemOptionEmail").val(seq);
            }
            $('#'+idDiv).append('\
                <div id="'+idDetail+seq+'">\
                <div class="form-group">\
                    <div class="col-md-offset-4 col-md-7">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="text" class="form-control '+classInput+'" name="'+nama+'[]" id="'+nama+''+seq+'" required />\
                        </div>\
                    </div>\
                    <div class="col-md-1">\
                        <button class="btn red-thunderbird" type="button" title="Remove Telepon" onclick=\'removeItemOption('+seq+',"'+nama+'","'+idDiv+'","'+idDetail+'")\'>\
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

        function removeItemOption(itemSeq, nama, idDiv, idDetail) {
            // alert("masuk remove");
            if(nama == 'gudang_telepon')
            {
                itemOpt = itemOption;
            }
            else if(nama == 'gudang_fax')
            {
                itemOpt = itemOptionFax;
            }
            else if(nama == 'gudang_email')
            {
                itemOpt = itemOptionEmail;
            }
            var parent = document.getElementById(idDiv);
            // alert(parent.id);
            for (var i = 1; i <= itemOpt; i++) {
              if (i >= itemSeq && i < itemOpt) {
                var inp1 = document.getElementById(nama+(i+1)).value;

                document.getElementById(nama+i).value = inp1;
              };
            };
            for (var i = 1; i <= itemOpt; i++) {
              if (i==itemOpt) {
                var child = document.getElementById(idDetail+''+i);

                parent.removeChild(child);
              };
            };
            
            if(nama == 'gudang_telepon')
            {
                itemOption--;
                // itemOpt = itemOption;
                $("#jml_itemOption").val(itemOption);
            }
            else if(nama == 'gudang_fax')
            {
                itemOptionFax--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionFax").val(itemOptionFax);
            }
            else if(nama == 'gudang_email')
            {
                itemOptionEmail--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionEmail").val(itemOptionEmail);
            }
        }
    </script>