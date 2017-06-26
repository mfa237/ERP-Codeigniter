<div class="control-group" id="fields">
    <div class="controls">
<!-- BEGIN FORM-->
        <form action="#" id="formAdd" class="form-horizontal" method="post">
            <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                <div class="alert alert-success display-hide">
                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                <input type="hidden" id="url" value="Master-Data/Sub-Atribut-Barang/postData/">
                <div class="form-group" hidden="true">
                    <label class="control-label col-md-4">ID Sub Atribut (Auto)
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
                            <select class="form-control" id="m_barang_id" name="m_barang_id" aria-required="true" aria-describedby="select-error" onchange="changeAtribut()">
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
                            <select class="form-control select2" id="m_atribut_id" name="m_atribut_id" aria-required="true" aria-describedby="select-error" required disabled="disabled">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Nama Sub Atribut
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-8">
                        <div class="input-icon right">
                            <i class="fa"></i>
                            <input type="text" class="form-control" name="sub_atribut_nama" required /> </div>
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
                                <input type="radio" value="3" name="sub_atribut_jenis" id="text" onclick="check_defaultValue()" checked />
                                <span></span>
                            </label>
                            <label class="mt-radio"> Textarea
                                <input type="radio" value="2" name="sub_atribut_jenis" id="textarea" onclick="check_defaultValue()" />
                                <span></span>
                            </label>
                            <label class="mt-radio"> Option
                                <input type="radio" value="1" name="sub_atribut_jenis" id="option" onclick="check_defaultValue()" />
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
                            <!-- <input type="text" class="form-control" name="sub_atribut_satuan" />  -->
                            <select class="form-control select2" id="sub_atribut_satuan" name="sub_atribut_satuan" />
                            
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
                            <select class="form-control select2" name="sub_atribut_status_aktif" aria-required="true" aria-describedby="select-error" required>
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
    </div>
</div>
    <!-- END FORM -->

<script>
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
                        <input type="text" class="form-control" name="sub_atribut_default_value" required />\
                    </div>\
                </div>\
            ');
            $("#button_tambahOption").addClass("hidden");
        } else if (document.getElementById('textarea').checked) {
            $("#default_value").append('\
                <div class="col-md-8">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <textarea name="sub_atribut_default_value" class="form-control" rows="3" required></textarea>\
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
                        <input type="text" class="form-control kode" name="sub_atribut_default_value_id'+itemOption+'" required />\
                    </div>\
                </div>\
                <label class="control-label col-md-2">Nama\
                    <span class="required"> * </span>\
                </label>\
                <div class="col-md-3">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control" name="sub_atribut_default_value_nama'+itemOption+'" required />\
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
                        <input type="text" class="form-control kode" name="sub_atribut_default_value_id'+itemOption+'" required />\
                    </div>\
                </div>\
                <label class="control-label col-md-2">Nama\
                    <span class="required"> * </span>\
                </label>\
                <div class="col-md-2">\
                    <div class="input-icon right">\
                        <i class="fa"></i>\
                        <input type="text" class="form-control" name="sub_atribut_default_value_nama'+itemOption+'" required />\
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
            var inp1 = document.getElementsByName("sub_atribut_default_value_id"+(i+1))[0].value;
            var inp2 = document.getElementsByName("sub_atribut_default_value_nama"+(i+1))[0].value;

            document.getElementsByName("sub_atribut_default_value_id"+i)[0].value = inp1;
            document.getElementsByName("sub_atribut_default_value_nama"+i)[0].value = inp2;
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

    function changeAtribut(atribut = null)
    {
        var sel = document.getElementById("m_barang_id");
        var atributSel = document.getElementById("m_atribut_id");
        atributSel.disabled = false;
        $('#m_atribut_id').select2('destroy');
        $('#m_atribut_id').empty();
        var barang = sel.options[sel.selectedIndex].value;
        while (atributSel.options.length) {
            atributSel.remove(0);
        }
        $.ajax({
          type : "GET",
          url  : '<?php echo base_url();?>Master-Data/Sub-Atribut-Barang/loadAtribut/',
          data : "id="+barang,
          dataType : "json",
          success:function(data){
            $('#m_atribut_id').select2();
            for(var i=0; i<data.val.length;i++){
                $('#m_atribut_id').css('width', '100%');
                $('#m_atribut_id').select2('destroy');
                var atr = new Option(data.val[i].atribut_nama, data.val[i].atribut_id);
                if(atribut == data.val[i].atribut_id)
                {
                    atr.setAttribute("selected", "true");
                }
                atributSel.options.add(atr);
                $('#m_atribut_id').select2();
            }
          }
        });
        $('#m_atribut_id').select2();
    }
    // function changeDefaultValue(value)
    // {
    //     if(value == "2")
    //     {
    //         $(".addFormat").html('<div class="entry input-group"><div class="col-md-4"><input class="form-control txt_data" placeholder="Id" name="id_value[]" type="text" value=""></div><div class="col-md-4"><input class="form-control txt_data" placeholder="Text" name="text_value[]" type="text" value=""></div><button type="button" class="btn btn-success btn-add" ><span class="glyphicon glyphicon-plus"></span></button></div>');
    //     }
    //     else if(value == "3")
    //     {
    //         // $(".addFormat").empty();
    //         // var controlForm = $('.addFormat:first');
    //         $(".addFormat > .entry").remove();
    //         $(".addFormat").html('<Textarea id="sub_atribut_default_value" name="sub_atribut_default_value" class="form-control" cols="80" row="5" required> </Textarea>');
    //         // alert(value);
    //     }
    //     else
    //     {
    //         // $(".addFormat").empty();
    //         $(".addFormat > .entry").remove();
    //         $(".addFormat").html('<input type="text" id="sub_atribut_default_value" name="sub_atribut_default_value" class="form-control" required>');
    //     }
    // }

// $(function()
// {
//     $(document).on('click', '.btn-add', function(e)
//     {
//         e.preventDefault();

//         var controlForm = $('.addFormat:first'),
//             currentEntry = $(this).parents('.entry:first'),
//             newEntry = $(currentEntry.clone()).appendTo(controlForm);

//         newEntry.find('input').val('');
//         controlForm.find('.entry:not(:last) .btn-add')
//             .removeClass('btn-add').addClass('btn-remove')
//             .removeClass('btn-success').addClass('btn-danger')
//             .html('<span class="glyphicon glyphicon-minus"></span>');
//     }).on('click', '.btn-remove', function(e)
//     {
//         $(this).parents('.entry:first').remove();

//         e.preventDefault();
//         return false;
//     });
// });
</script>