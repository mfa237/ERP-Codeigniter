<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Partner/postData/">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">Kode Partner (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Status Partner
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="mt-radio-inline">
                        <i class="fa"></i>
                        <label class="mt-radio"> Vendor
                            <input type="radio" value="1" name="partner_status" id="supplier" />
                            <span></span>
                        </label>
                        <label class="mt-radio"> Member
                            <input type="radio" value="2" name="partner_status" id="customer" />
                            <span></span>
                        </label>
                        <label class="mt-radio"> Vendor dan Member
                            <input type="radio" value="3" name="partner_status" id="supplier_customer" />
                            <span></span>
                        </label> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Partner
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="partner_nama" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Cetak Partner
                </label>
                <input type="hidden" name="jml_itemOptionNama" id="jml_itemOptionNama" value="1" />
                <div id="default_valueNama">
                </div>
            </div>
            <div id="default_value2Nama">
            </div>
            <div class="form-group hidden" id="button_tambahOptionNama">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOptionNama" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Nama Cetak
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Alamat Partner
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <textarea class="form-control" rows="3" name="partner_alamat" required></textarea> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Alamat Cetak Partner
                </label>
                <input type="hidden" name="jml_itemOptionAlamat" id="jml_itemOptionAlamat" value="1" />
                <div id="default_valueAlamat">
                </div>
            </div>
            <div id="default_value2Alamat">
            </div>
            <div class="form-group hidden" id="button_tambahOptionAlamat">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOptionAlamat" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Alamat Cetak
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Kota Partner
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" id="partner_kota" name="partner_kota" required />
                            
                        </select></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Telepon Partner
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
                <label class="control-label col-md-4">Telepon Cetak Partner
                </label>
                <input type="hidden" name="jml_itemOptionTelpCetak" id="jml_itemOptionTelpCetak" value="1" />
                <div id="default_valueTelpCetak">
                </div>
            </div>
            <div id="default_value2TelpCetak">
            </div>
            <div class="form-group hidden" id="button_tambahOptionTelpCetak">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOptionTelpCetak" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Telepon Cetak
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Fax Partner
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
            <div class="form-group">
                <label class="control-label col-md-4">Fax Cetak Partner
                </label>
                <input type="hidden" name="jml_itemOptionFaxCetak" id="jml_itemOptionFaxCetak" value="1" />
                <div id="default_valueFaxCetak">
                </div>
            </div>
            <div id="default_value2FaxCetak">
            </div>
            <div class="form-group hidden" id="button_tambahOptionFaxCetak">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOptionFaxCetak" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Fax Cetak
                        </button>
                    </div>
                </div>
            </div>
           <!--  <div class="form-group">
                <label class="control-label col-md-4">Telepon Partner
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control telp" name="partner_telepon" required /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Telepon Cetak Partner
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control telp" name="partner_telepon_cetak" required /> </div>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-md-4">Email Partner
                    <!-- <span class="required"> * </span> -->
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
                <label class="control-label col-md-4">Email Cetak Partner
                </label>
                <input type="hidden" name="jml_itemOptionEmailCetak" id="jml_itemOptionEmailCetak" value="1" />
                <div id="default_valueEmailCetak">
                </div>
            </div>
            <div id="default_value2EmailCetak">
            </div>
            <div class="form-group hidden" id="button_tambahOptionEmailCetak">
                <div class="col-md-offset-6 col-md-6 text-right">
                    <div class="btn-group">
                        <button type="button" id="modalAddOptionEmailCetak" class="btn sbold dark"><i class="icon-plus"></i>&nbsp; Tambah Email Cetak
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Limit Kredit
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control money" name="partner_limit_kredit" value="0" /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nomor NPWP Partner
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control num" name="partner_nomor_npwp" /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">File NPWP Partner
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <div id="namafile"></div>
                        <i class="fa"></i>
                        <input type="hidden" class="form-control" name="partner_file_npwp_lama" />
                        <input type="file" class="form-control" name="partner_file_npwp" /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Status Partner
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="partner_status_aktif" aria-required="true" aria-describedby="select-error" required>
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
                    <button type="button" class="btn default reset" onclick="reset()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
    <script type="text/javascript">
        $(document).ready(function(){
            defaultValue();
            itemOptionNama = parseInt($("#jml_itemOptionNama").val());
            itemOptionAlamat = parseInt($("#jml_itemOptionAlamat").val());
            itemOption = parseInt($("#jml_itemOption").val());
            itemOptionTelpCetak = parseInt($("#jml_itemOptionTelpCetak").val());
            itemOptionEmail = parseInt($("#jml_itemOptionEmail").val());
            itemOptionEmailCetak = parseInt($("#jml_itemOptionEmailCetak").val());
            itemOptionFax = parseInt($("#jml_itemOptionFax").val());
            itemOptionFaxCetak = parseInt($("#jml_itemOptionFaxCetak").val());
            $('#modalAddOptionNama').on('click', function() {
              generateItemOption("partner_nama_cetak", "default_value2Nama", "detailNamaCetak");
            });
            $('#modalAddOptionAlamat').on('click', function() {
              generateItemOption("partner_alamat_cetak", "default_value2Alamat", "detailAlamatCetak");
            });
            $('#modalAddOption').on('click', function() {
                // alert("masuk");
              generateItemOption("partner_telepon", "default_value2", "detail");
            });
            $('#modalAddOptionTelpCetak').on('click', function() {
                // alert("masukfax");
              generateItemOption("partner_telepon_cetak", "default_value2TelpCetak", "detailTelpCetak");
            });
            $('#modalAddOptionEmail').on('click', function() {
                // alert("masukfax");
              generateItemOption("partner_email", "default_value2Email", "detailEmail");
            });
            $('#modalAddOptionEmailCetak').on('click', function() {
                // alert("masukfax");
              generateItemOption("partner_email_cetak", "default_value2EmailCetak", "detailEmailCetak");
            });
            $('#modalAddOptionFax').on('click', function() {
                // alert("masukfax");
              generateItemOption("partner_fax", "default_value2Fax", "detailFax");
            });
            $('#modalAddOptionFaxCetak').on('click', function() {
                // alert("masukfax");
              generateItemOption("partner_fax_cetak", "default_value2FaxCetak", "detailFax");
            });
        });

        function defaultValue() {
            $("#default_valueNama").empty();
            $("#default_valueAlamat").empty();
            $("#default_value2Nama").empty();
            $("#default_value2Alamat").empty();
            $("#default_value").empty();
            $("#default_value2").empty();
            $("#default_valueTelpCetak").empty();
            $("#default_value2TelpCetak").empty();
            $("#default_valueFax").empty();
            $("#default_value2Fax").empty();
            $("#default_valueEmail").empty();
            $("#default_value2Email").empty();
            $("#default_valueEmailCetak").empty();
            $("#default_value2EmailCetak").empty();
            $("#jml_itemOption").val(1);
            $("#jml_itemOption").val(1);
            $("#jml_itemOptionTelpCetak").val(1);
            $("#jml_itemOptionEmail").val(1);
            $("#jml_itemOptionEmailCetak").val(1);
            $("#jml_itemOptionFax").val(1);
            $("#jml_itemOptionFaxCetak").val(1);
            itemOptionNama = parseInt($("#jml_itemOptionNama").val());
            itemOptionAlamat = parseInt($("#jml_itemOptionAlamat").val());
            itemOption = parseInt($("#jml_itemOption").val());
            itemOptionTelpCetak = parseInt($("#jml_itemOptionTelpCetak").val());
            itemOptionEmail = parseInt($("#jml_itemOptionEmail").val());
            itemOptionEmailCetak = parseInt($("#jml_itemOptionEmailCetak").val());
            itemOptionFax = parseInt($("#jml_itemOptionFax").val());
            itemOptionFaxCetak = parseInt($("#jml_itemOptionFaxCetak").val());
            $("#default_valueNama").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control" name="partner_nama_cetak[]" id="partner_nama_cetak1" required /> </div>\
                </div>\
            ');
            $("#default_valueAlamat").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <textarea class="form-control" rows="3" name="partner_alamat_cetak[]" id="partner_alamat_cetak1" required></textarea> </div>\
                </div>\
            ');
            $("#default_value").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="partner_telepon[]" id="partner_telepon1" required />\
                    </div>\
                </div>\
            ');
            $("#default_valueTelpCetak").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="partner_telepon_cetak[]" id="partner_telepon_cetak1" />\
                    </div>\
                </div>\
            ');
            $("#default_valueEmail").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="email" class="form-control" name="partner_email[]" id="partner_email1" />\
                    </div>\
                </div>\
            ');
            $("#default_valueEmailCetak").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="email" class="form-control" name="partner_email_cetak[]" id="partner_email_cetak1" />\
                    </div>\
                </div>\
            ');
            $("#default_valueFax").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="partner_fax[]" id="partner_fax1" />\
                    </div>\
                </div>\
            ');
            $("#default_valueFaxCetak").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control telp" name="partner_fax_cetak[]" id="partner_fax_cetak1" />\
                    </div>\
                </div>\
            ');
            $("#button_tambahOptionNama").removeClass("hidden");
            $("#button_tambahOptionAlamat").removeClass("hidden");
            $("#button_tambahOption").removeClass("hidden");
            $("#button_tambahOptionTelpCetak").removeClass("hidden");
            $("#button_tambahOptionEmail").removeClass("hidden");
            $("#button_tambahOptionEmailCetak").removeClass("hidden");
            $("#button_tambahOptionFax").removeClass("hidden");
            $("#button_tambahOptionFaxCetak").removeClass("hidden");
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
            if(nama == 'partner_telepon')
            {
                itemOption++;
                $("#jml_itemOption").val(itemOption);
                itemOpt = itemOption;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'partner_telepon_cetak')
            {
                itemOptionTelpCetak++;
                $("#jml_itemOptionTelpCetak").val(itemOptionTelpCetak);
                itemOpt = itemOptionTelpCetak;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'partner_email')
            {
                itemOptionEmail++;
                $("#jml_itemOptionEmail").val(itemOptionEmail);
                itemOpt = itemOptionEmail;
                textInput = 'email';
            }
            else if(nama == 'partner_email_cetak')
            {
                itemOptionEmailCetak++;
                $("#jml_itemOptionEmailCetak").val(itemOptionEmailCetak);
                itemOpt = itemOptionEmailCetak;
                textInput = 'email';
            }
            else if(nama == 'partner_fax')
            {
                itemOptionFax++;
                $("#jml_itemOptionFax").val(itemOptionFax);
                itemOpt = itemOptionFax;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'partner_fax_cetak')
            {
                itemOptionFaxCetak++;
                $("#jml_itemOptionFaxCetak").val(itemOptionFaxCetak);
                itemOpt = itemOptionFaxCetak;
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'partner_nama_cetak')
            {
                itemOptionNama++;
                $("#jml_itemOptionNama").val(itemOptionNama);
                itemOpt = itemOptionNama;
                classInput = '';
                textInput = 'text';
            }
            else if(nama == 'partner_alamat_cetak')
            {
                itemOptionAlamat++;
                $("#jml_itemOptionAlamat").val(itemOptionAlamat);
                itemOpt = itemOptionAlamat;
                classInput = '';
                textInput = 'text';
            }

            if (nama != 'partner_alamat_cetak') {
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
            } else {
                $('#'+idDiv).append('\
                    <div id="'+idDetail+itemOpt+'">\
                    <div class="form-group">\
                        <div class="col-md-offset-4 col-md-7">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <textarea class="form-control" rows="3" name="'+nama+'[]" id="'+nama+''+itemOpt+'" required></textarea>\
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
            }
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
            if(nama == 'partner_telepon')
            {
                $("#jml_itemOption").val(seq);
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'partner_telepon_cetak')
            {
                $("#jml_itemOptionTelpCetak").val(seq);
                classInput = 'telp';
                textInput = 'text';
            }
            else if(nama == 'partner_email')
            {
                $("#jml_itemOptionEmail").val(seq);
                textInput = 'email';
            }
            else if(nama == 'partner_email_cetak')
            {
                $("#jml_itemOptionEmailCetak").val(seq);
                textInput = 'email';
            }
            else if(nama == 'partner_fax')
            {
                $("#jml_itemOptionFax").val(seq);
            }
            else if(nama == 'partner_fax_cetak')
            {
                $("#jml_itemOptionFaxCetak").val(seq);
            }
            else if(nama == 'partner_nama_cetak')
            {
                $("#jml_itemOptionNama").val(seq);
            }
            else if(nama == 'partner_alamat_cetak')
            {
                $("#jml_itemOptionAlamat").val(seq);
            }
            if (nama != 'partner_alamat_cetak') {
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
            } else {
                $('#'+idDiv).append('\
                    <div id="'+idDetail+seq+'">\
                    <div class="form-group">\
                        <div class="col-md-offset-4 col-md-7">\
                            <div class="input-icon right">\
                                <i class="fa"></i>\
                                <textarea class="form-control" rows="3" name="'+nama+'[]" id="'+nama+''+seq+'" required></textarea>\
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
            }
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
            if(nama == 'partner_telepon')
            {
                itemOpt = itemOption;
            }
            else if(nama == 'partner_telepon_cetak')
            {
                itemOpt = itemOptionTelpCetak;
            }
            else if(nama == 'partner_email')
            {
                itemOpt = itemOptionEmail;
            }
            else if(nama == 'partner_email_cetak')
            {
                itemOpt = itemOptionEmailCetak;
            }
            else if(nama == 'partner_fax')
            {
                itemOpt = itemOptionFax;
            }
            else if(nama == 'partner_fax_cetak')
            {
                itemOpt = itemOptionFaxCetak;
            }
            else if(nama == 'partner_nama_cetak')
            {
                itemOpt = itemOptionNama;
            }
            else if(nama == 'partner_alamat_cetak')
            {
                itemOpt = itemOptionAlamat;
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
            
            if(nama == 'partner_telepon')
            {
                itemOption--;
                // itemOpt = itemOption;
                $("#jml_itemOption").val(itemOption);
            }
            else if(nama == 'partner_telepon_cetak')
            {
                itemOptionTelpCetak--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionTelpCetak").val(itemOptionTelpCetak);
            }
            else if(nama == 'partner_email')
            {
                itemOptionEmail--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionEmail").val(itemOptionEmail);
            }
            else if(nama == 'partner_email_cetak')
            {
                itemOptionEmailCetak--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionEmailCetak").val(itemOptionEmailCetak);
            }
            else if(nama == 'partner_fax')
            {
                itemOptionFax--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionFax").val(itemOptionFax);
            }
            else if(nama == 'partner_fax_cetak')
            {
                itemOptionFaxCetak--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionFaxCetak").val(itemOptionFaxCetak);
            }
            else if(nama == 'partner_nama_cetak')
            {
                itemOptionNama--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionNama").val(itemOptionNama);
            }
            else if(nama == 'partner_alamat_cetak')
            {
                itemOptionAlamat--;
                // itemOpt = itemOptionFax;
                $("#jml_itemOptionAlamat").val(itemOptionAlamat);
            }
        }
    </script>