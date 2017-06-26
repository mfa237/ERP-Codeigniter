
    <!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Cabang/postData/">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">Kode Cabang (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="kode" name="kode" readonly />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Kode Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" id="cabang_kode" name="cabang_kode" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="cabang_nama" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Alamat Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <textarea class="form-control" rows="3" name="cabang_alamat" required></textarea> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Kota Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" id="cabang_kota" name="cabang_kota" required />

                        </select>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-md-4">Telepon Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control telp" name="cabang_telepon" required /> </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Telepon Cabang
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
                <label class="control-label col-md-4">Fax Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control telp" name="cabang_fax" required /> </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Fax Cabang
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
                <label class="control-label col-md-4">Email Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="cabang_email" required /> </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Email Cabang
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
                <label class="control-label col-md-4">Status Cabang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="cabang_status_aktif" aria-required="true"
                        aria-describedby="select-error" required>
                            <option id="aktif" value="y"> Aktif </option>
                            <option id="nonaktif" value="n"> Non Aktif </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <!-- <input type="" name="cabang_display_aktif" id="cabang_display_aktif" value="" /> -->
                <label class="control-label col-md-4">Display Penjualan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" id="cabang_display" name="cabang_display"
                         aria-required="true" aria-describedby="select-error" required></select>
                    </div>
                </div>
            </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="button" class="btn green-jungle" onclick="submitform()">Submit</button>
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
              generateItemOption("cabang_telepon", "default_value2", "detail");
            });
            $('#modalAddOptionFax').on('click', function() {
                // alert("masukfax");
              generateItemOption("cabang_fax", "default_value2Fax", "detailFax");
            });
            $('#modalAddOptionEmail').on('click', function() {
                // alert("masukfax");
              generateItemOption("cabang_email", "default_value2Email", "detailEmail");
            });



        });

        function submitform(){
          var cabangId    = document.getElementById('kode').value;
          var cabangKode  = document.getElementById('cabang_kode').value;
          var url = 'Master-Data/Cabang/checkKode';
          var paramArr = [];
          paramArr.push({name:'cabang_id', value:cabangId},
                        {name:'cabang_kode', value:cabangKode});
          postData2(paramArr, url);
        }

        function getQtyresult(data){
          if (data.status == "200") {
            alert("Kode Cabang Sudah Ada !!");
          } else {
            actionData3();
          }
        }

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
            // $("#cabang_display_aktif").val(1);

            itemOption = parseInt($("#jml_itemOption").val());
            itemOptionFax = parseInt($("#jml_itemOptionFax").val());
            itemOptionEmail = parseInt($("#jml_itemOptionEmail").val());
            $("#default_value").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="cabang_telepon[]" id="cabang_telepon1" required />\
                    </div>\
                </div>\
            ');
            $("#default_valueFax").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="cabang_fax[]" id="cabang_fax1" required />\
                    </div>\
                </div>\
            ');
            $("#default_valueEmail").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="email" class="form-control" name="cabang_email[]" id="cabang_email1" required />\
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
            if(nama == 'cabang_telepon')
            {
                itemOption++;
                $("#jml_itemOption").val(itemOption);
                itemOpt = itemOption;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'cabang_fax')
            {
                itemOptionFax++;
                $("#jml_itemOptionFax").val(itemOptionFax);
                itemOpt = itemOptionFax;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'cabang_email')
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
            var classInput, textInput;
            if(nama == 'cabang_telepon')
            {
                $("#jml_itemOption").val(seq);
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'cabang_fax')
            {
                $("#jml_itemOptionFax").val(seq);
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'cabang_email')
            {
                $("#jml_itemOptionEmail").val(seq);
                textInput = 'email';
            }
            $('#'+idDiv).append('\
                <div id="'+idDetail+seq+'">\
                <div class="form-group">\
                    <div class="col-md-offset-4 col-md-7">\
                        <div class="input-icon right">\
                            <i class="fa"></i>\
                            <input type="'+textInput+'" class="form-control '+classInput+'" name="'+nama+'[]" id="'+nama+''+seq+'" required />\
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
            if(nama == 'cabang_telepon')
            {
                itemOpt = itemOption;
            }
            else if(nama == 'cabang_fax')
            {
                itemOpt = itemOptionFax;
            }
            else if(nama == 'cabang_email')
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

            if(nama == 'cabang_telepon')
            {
                itemOption--;
                // itemOpt = itemOption;
                $("#jml_itemOption").val(itemOption);
            }
            else if(nama == 'cabang_fax')
            {
                itemOptionFax--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionFax").val(itemOptionFax);
            }
            else if(nama == 'cabang_email')
            {
                itemOptionEmail--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionEmail").val(itemOptionEmail);
            }
        }
    </script>
