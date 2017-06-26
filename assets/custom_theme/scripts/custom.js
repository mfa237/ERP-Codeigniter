var $base_url = $("body").data("base_url");



function pembulatan(num){

  var num = parseInt(num);

  var num_str = num.toString();

  var tiga_akhir = num_str.substr(num_str.length - 2);

  if (tiga_akhir !== '00') {

    var pembulatan = 100 - parseInt(tiga_akhir);

    num_str = parseInt(num_str) + parseInt(pembulatan);

  }

  return num_str;

}



function rules() {

  $(".kode").keydown(function(event) {

    if ( event.keyCode != 32 ) {

      // let it happen, don't do anything

    } else {

      event.preventDefault();

    }

  });

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

  $(".decimal").keydown(function(event) {

    // Allow: backspace, delete, tab, escape, enter and .

    if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||

         // Allow: Ctrl+A, Command+A

        (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||

         // Allow: home, end, left, right, down, up

        (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {

             // let it happen, don't do anything

             return;

    }

    // Ensure that it is a number and stop the keypress

    if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {

        event.preventDefault();

    }

  });

  $('.reset').on('click', function() {

    resetValidation();

  });

  $('.select2').select2();

  $('.select2').width('100%');

  $('.money').number( true, 2, '.', ',' );

  $('.money').css('text-align', 'right');

  $('.num2').number( true, 2, '.', ',' );

  $('.num2').css('text-align', 'right');

  $('.datepicker').datepicker({

        locale: {

            format: 'DD/MM/YYYY'

        },

        "opens": "left",

        "drops": "down"

  });

  var dateToday = new Date();

  $('.datepicker-range').daterangepicker({

        minDate : dateToday,

        locale: {

            format: 'DD/MM/YYYY',

        },

        "opens": "left",

        "drops": "down"

  });

    $('.timepicker-default').timepicker({

        autoclose: true,

        minuteStep: 5

    });

    $('.datetimepicker').datetimepicker({

        format: "dd/mm/yyyy hh:ii"

    });

}



// Custom Validation

var MyFormValidation = function () {



    // Validation

    var handleValidationCustom = function() {

        // for more info visit the official plugin documentation:

            // http://docs.jquery.com/Plugins/Validation



            var form = $('#formAdd');

            var error2 = $('.alert-danger', form);

            var success2 = $('.alert-success', form);



            form.validate({

                errorElement: 'span', //default input error message container

                errorClass: 'help-block help-block-error', // default input error message class

                focusInvalid: false, // do not focus the last invalid input

                ignore: "",  // validate all fields including form hidden input



                invalidHandler: function (event, validator) { //display error alert on form submit

                    success2.hide();

                    error2.show();

                    App.scrollTo(error2, -200);

                },



                errorPlacement: function (error, element) { // render error placement for each input type

                    var icon = $(element).parent('.input-icon').children('i');

                    icon.removeClass('fa-check').addClass("fa-warning");

                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});

                },



                highlight: function (element) { // hightlight error inputs

                    $(element)

                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group

                },



                unhighlight: function (element) { // revert the change done by hightlight



                },



                success: function (label, element) {

                    var icon = $(element).parent('.input-icon').children('i');

                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group

                    icon.removeClass("fa-warning").addClass("fa-check");

                },



                submitHandler: function (form) {

                    success2.show();

                    error2.hide();

                }

            });





    }



    return {

        //main function to initiate the module

        init: function () {



            handleValidationCustom();

            resetValidation();



        }



    };

}();



var FormWizard = function () {





    return {

        //main function to initiate the module

        init: function () {

            if (!jQuery().bootstrapWizard) {

                return;

            }



            function format(state) {

                if (!state.id) return state.text; // optgroup

                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;

            }



            $("#country_list").select2({

                placeholder: "Select",

                allowClear: true,

                formatResult: format,

                width: 'auto',

                formatSelection: format,

                escapeMarkup: function (m) {

                    return m;

                }

            });



            var form = $('#formAdd');

            var error = $('.alert-danger', form);

            var success = $('.alert-success', form);



            form.validate({

                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.

                errorElement: 'span', //default input error message container

                errorClass: 'help-block help-block-error', // default input error message class

                focusInvalid: false, // do not focus the last invalid input



                errorPlacement: function (error, element) { // render error placement for each input type

                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container

                        error.insertAfter("#form_gender_error");

                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container

                        error.insertAfter("#form_payment_error");

                    } else {

                        error.insertAfter(element); // for other inputs, just perform default behavior

                    }

                },



                invalidHandler: function (event, validator) { //display error alert on form submit

                    success.hide();

                    error.show();

                    App.scrollTo(error, -200);

                },



                highlight: function (element) { // hightlight error inputs

                    $(element)

                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group

                },



                unhighlight: function (element) { // revert the change done by hightlight

                    $(element)

                        .closest('.form-group').removeClass('has-error'); // set error class to the control group

                },



                success: function (label) {

                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon

                        label

                            .closest('.form-group').removeClass('has-error').addClass('has-success');

                        label.remove(); // remove error label here

                    } else { // display success icon for other inputs

                        label

                            .addClass('valid') // mark the current input as valid and display OK icon

                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group

                    }

                },



                submitHandler: function (form) {

                    success.show();

                    error.hide();

                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax

                }



            });



            var displayConfirm = function() {

                $('#tab4 .form-control-static', form).each(function(){

                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);

                    if (input.is(":radio")) {

                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);

                    }

                    if (input.is(":text") || input.is("textarea")) {

                        $(this).html(input.val());

                    } else if (input.is("select")) {

                        $(this).html(input.find('option:selected').text());

                    } else if (input.is(":radio") && input.is(":checked")) {

                        $(this).html(input.attr("data-title"));

                    } else if ($(this).attr("data-display") == 'payment[]') {

                        var payment = [];

                        $('[name="payment[]"]:checked', form).each(function(){

                            payment.push($(this).attr('data-title'));

                        });

                        $(this).html(payment.join("<br>"));

                    }

                });

            }



            var handleTitle = function(tab, navigation, index) {

                var total = navigation.find('li').length;

                var current = index + 1;

                // set wizard title

                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);

                // set done steps

                jQuery('li', $('#form_wizard_1')).removeClass("done");

                var li_list = navigation.find('li');

                for (var i = 0; i < index; i++) {

                    jQuery(li_list[i]).addClass("done");

                }



                if (current == 1) {

                    $('#form_wizard_1').find('.button-previous').hide();

                } else {

                    $('#form_wizard_1').find('.button-previous').show();

                }



                if (current >= total) {

                    $('#form_wizard_1').find('.button-next').hide();

                    $('#form_wizard_1').find('.button-submit').show();

                    displayConfirm();

                } else {

                    $('#form_wizard_1').find('.button-next').show();

                    $('#form_wizard_1').find('.button-submit').hide();

                }

                App.scrollTo($('.page-title'));

            }



            // default form wizard

            $('#form_wizard_1').bootstrapWizard({

                'nextSelector': '.button-next',

                'previousSelector': '.button-previous',

                onTabClick: function (tab, navigation, index, clickedIndex) {

                    // return false;



                    success.hide();

                    error.hide();

                    if (form.valid() == false) {

                        return false;

                    }



                    handleTitle(tab, navigation, clickedIndex);

                },

                onNext: function (tab, navigation, index) {

                    success.hide();

                    error.hide();



                    if (form.valid() == false) {

                        return false;

                    }



                    checkPosition(index);

                    handleTitle(tab, navigation, index);

                },

                onPrevious: function (tab, navigation, index) {

                    success.hide();

                    error.hide();



                    checkPosition(index);

                    handleTitle(tab, navigation, index);

                },

                onTabShow: function (tab, navigation, index) {

                    var total = navigation.find('li').length;

                    var current = index + 1;

                    var $percent = (current / total) * 100;

                    $('#form_wizard_1').find('.progress-bar').css({

                        width: $percent + '%'

                    });

                }

            });



            $('#form_wizard_1').find('.button-previous').hide();

            $('#form_wizard_1 .button-submit').click(function () {

              checkPosition(4);

            }).hide();



            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.

            $('#country_list', form).change(function () {

                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input

            });

        }



    };



}();



var FormWizard2 = function () {





    return {

        //main function to initiate the module

        init: function () {

            if (!jQuery().bootstrapWizard) {

                return;

            }



            function format(state) {

                if (!state.id) return state.text; // optgroup

                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;

            }



            $("#country_list").select2({

                placeholder: "Select",

                allowClear: true,

                formatResult: format,

                width: 'auto',

                formatSelection: format,

                escapeMarkup: function (m) {

                    return m;

                }

            });



            var form = $('#formAdd');

            var error = $('.alert-danger', form);

            var success = $('.alert-success', form);



            form.validate({

                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.

                errorElement: 'span', //default input error message container

                errorClass: 'help-block help-block-error', // default input error message class

                focusInvalid: false, // do not focus the last invalid input



                errorPlacement: function (error, element) { // render error placement for each input type

                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container

                        error.insertAfter("#form_gender_error");

                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container

                        error.insertAfter("#form_payment_error");

                    } else {

                        error.insertAfter(element); // for other inputs, just perform default behavior

                    }

                },



                invalidHandler: function (event, validator) { //display error alert on form submit

                    success.hide();

                    error.show();

                    App.scrollTo(error, -200);

                },



                highlight: function (element) { // hightlight error inputs

                    $(element)

                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group

                },



                unhighlight: function (element) { // revert the change done by hightlight

                    $(element)

                        .closest('.form-group').removeClass('has-error'); // set error class to the control group

                },



                success: function (label) {

                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon

                        label

                            .closest('.form-group').removeClass('has-error').addClass('has-success');

                        label.remove(); // remove error label here

                    } else { // display success icon for other inputs

                        label

                            .addClass('valid') // mark the current input as valid and display OK icon

                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group

                    }

                },



                submitHandler: function (form) {

                    success.show();

                    error.hide();

                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax

                }



            });



            var displayConfirm = function() {

                $('#tab4 .form-control-static', form).each(function(){

                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);

                    if (input.is(":radio")) {

                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);

                    }

                    if (input.is(":text") || input.is("textarea")) {

                        $(this).html(input.val());

                    } else if (input.is("select")) {

                        $(this).html(input.find('option:selected').text());

                    } else if (input.is(":radio") && input.is(":checked")) {

                        $(this).html(input.attr("data-title"));

                    } else if ($(this).attr("data-display") == 'payment[]') {

                        var payment = [];

                        $('[name="payment[]"]:checked', form).each(function(){

                            payment.push($(this).attr('data-title'));

                        });

                        $(this).html(payment.join("<br>"));

                    }

                });

            }



            var handleTitle = function(tab, navigation, index) {

                var total = navigation.find('li').length;

                var current = index + 1;

                // set wizard title

                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);

                // set done steps

                jQuery('li', $('#form_wizard_1')).removeClass("done");

                var li_list = navigation.find('li');

                for (var i = 0; i < index; i++) {

                    jQuery(li_list[i]).addClass("done");

                }



                if (current == 1) {

                    $('#form_wizard_1').find('.button-previous').hide();

                } else {

                    $('#form_wizard_1').find('.button-previous').show();

                }



                if (current >= total) {

                    $('#form_wizard_1').find('.button-next').hide();

                    $('#form_wizard_1').find('.button-submit').show();

                    displayConfirm();

                } else {

                    $('#form_wizard_1').find('.button-next').show();

                    $('#form_wizard_1').find('.button-submit').hide();

                }

                App.scrollTo($('.page-title'));

            }



            // default form wizard

            $('#form_wizard_1').bootstrapWizard({

                'nextSelector': '.button-next',

                'previousSelector': '.button-previous',

                onTabClick: function (tab, navigation, index, clickedIndex) {

                    // return false;



                    success.hide();

                    error.hide();

                    if (form.valid() == false) {

                        return false;

                    }



                    handleTitle(tab, navigation, clickedIndex);

                },

                onNext: function (tab, navigation, index) {

                    success.hide();

                    error.hide();



                    if (form.valid() == false) {

                        return false;

                    }



                    checkPosition(index);

                    handleTitle(tab, navigation, index);

                },

                onPrevious: function (tab, navigation, index) {

                    success.hide();

                    error.hide();



                    checkPosition(index);

                    handleTitle(tab, navigation, index);

                },

                onTabShow: function (tab, navigation, index) {

                    var total = navigation.find('li').length;

                    var current = index + 1;

                    var $percent = (current / total) * 100;

                    $('#form_wizard_1').find('.progress-bar').css({

                        width: $percent + '%'

                    });

                }

            });



            $('#form_wizard_1').find('.button-previous').hide();

            $('#form_wizard_1 .button-submit').click(function () {

              checkPosition(4);

            }).hide();



            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.

            $('#country_list', form).change(function () {

                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input

            });

        }



    };



}();



var FormWizard3 = function () {





    return {

        //main function to initiate the module

        init: function () {

            if (!jQuery().bootstrapWizard) {

                return;

            }



            function format(state) {

                if (!state.id) return state.text; // optgroup

                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;

            }



            $("#country_list").select2({

                placeholder: "Select",

                allowClear: true,

                formatResult: format,

                width: 'auto',

                formatSelection: format,

                escapeMarkup: function (m) {

                    return m;

                }

            });



            var form = $('#formAdd');

            var error = $('.alert-danger', form);

            var success = $('.alert-success', form);



            form.validate({

                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.

                errorElement: 'span', //default input error message container

                errorClass: 'help-block help-block-error', // default input error message class

                focusInvalid: false, // do not focus the last invalid input



                errorPlacement: function (error, element) { // render error placement for each input type

                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container

                        error.insertAfter("#form_gender_error");

                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container

                        error.insertAfter("#form_payment_error");

                    } else {

                        error.insertAfter(element); // for other inputs, just perform default behavior

                    }

                },



                invalidHandler: function (event, validator) { //display error alert on form submit

                    success.hide();

                    error.show();

                    App.scrollTo(error, -200);

                },



                highlight: function (element) { // hightlight error inputs

                    $(element)

                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group

                },



                unhighlight: function (element) { // revert the change done by hightlight

                    $(element)

                        .closest('.form-group').removeClass('has-error'); // set error class to the control group

                },



                success: function (label) {

                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon

                        label

                            .closest('.form-group').removeClass('has-error').addClass('has-success');

                        label.remove(); // remove error label here

                    } else { // display success icon for other inputs

                        label

                            .addClass('valid') // mark the current input as valid and display OK icon

                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group

                    }

                },



                submitHandler: function (form) {

                    success.show();

                    error.hide();

                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax

                }



            });



            var displayConfirm = function() {

                $('#tab4 .form-control-static', form).each(function(){

                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);

                    if (input.is(":radio")) {

                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);

                    }

                    if (input.is(":text") || input.is("textarea")) {

                        $(this).html(input.val());

                    } else if (input.is("select")) {

                        $(this).html(input.find('option:selected').text());

                    } else if (input.is(":radio") && input.is(":checked")) {

                        $(this).html(input.attr("data-title"));

                    } else if ($(this).attr("data-display") == 'payment[]') {

                        var payment = [];

                        $('[name="payment[]"]:checked', form).each(function(){

                            payment.push($(this).attr('data-title'));

                        });

                        $(this).html(payment.join("<br>"));

                    }

                });

            }



            var handleTitle = function(tab, navigation, index) {

                var total = navigation.find('li').length;

                var current = index + 1;

                // set wizard title

                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);

                // set done steps

                jQuery('li', $('#form_wizard_1')).removeClass("done");

                var li_list = navigation.find('li');

                for (var i = 0; i < index; i++) {

                    jQuery(li_list[i]).addClass("done");

                }



                if (current == 1) {

                    $('#form_wizard_1').find('.button-previous').hide();

                } else {

                    $('#form_wizard_1').find('.button-previous').show();

                }



                if (current >= total) {

                    $('#form_wizard_1').find('.button-next').hide();

                    $('#form_wizard_1').find('.button-submit').show();

                    displayConfirm();

                } else {

                    $('#form_wizard_1').find('.button-next').show();

                    $('#form_wizard_1').find('.button-submit').hide();

                }

                App.scrollTo($('.page-title'));

            }



            // default form wizard

            $('#form_wizard_1').bootstrapWizard({

                'nextSelector': '.button-next',

                'previousSelector': '.button-previous',

                onTabClick: function (tab, navigation, index, clickedIndex) {

                    // return false;



                    success.hide();

                    error.hide();

                    if (form.valid() == false) {

                        return false;

                    }



                    handleTitle(tab, navigation, clickedIndex);

                },

                onNext: function (tab, navigation, index) {

                    success.hide();

                    error.hide();



                    if (form.valid() == false) {

                        return false;

                    }



                    checkPosition(index);

                    handleTitle(tab, navigation, index);

                },

                onPrevious: function (tab, navigation, index) {

                    success.hide();

                    error.hide();



                    checkPosition(index);

                    handleTitle(tab, navigation, index);

                },

                onTabShow: function (tab, navigation, index) {

                    var total = navigation.find('li').length;

                    var current = index + 1;

                    var $percent = (current / total) * 100;

                    $('#form_wizard_1').find('.progress-bar').css({

                        width: $percent + '%'

                    });

                }

            });



            $('#form_wizard_1').find('.button-previous').hide();

            $('#form_wizard_1 .button-submit').click(function () {

              checkPosition(3);

            }).hide();



            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.

            $('#country_list', form).change(function () {

                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input

            });

        }



    };



}();



jQuery(document).ready(function() {

    MyFormValidation.init();

});



// Logout

function doLogout() {

    var $base_url = $("body").data("base_url");

    $.ajax({

        url: $base_url+'Login/doLogout',

        type: 'POST',

        dataType: 'json',

        success: function (data) {

          if (data.status=='200') {

            toastr["success"]("Your sessions has been deleted", "Sukses", {

                  "closeButton": true,

                  "debug": false,

                  "newestOnTop": true,

                  "progressBar": true,

                  "positionClass": "toast-top-right",

                  "preventDuplicates": false,

                  "onclick": null,

                  "showDuration": "300",

                  "hideDuration": "200",

                  "timeOut": "5000",

                  "extendedTimeOut": "200",

                  "showEasing": "swing",

                  "hideEasing": "linear",

                  "showMethod": "fadeIn",

                  "hideMethod": "fadeOut"

            });

            setTimeout(function(){

              window.location.href = $base_url+'Login';

            }, 2000);

          }

        }

    });

}



// Reset Validation

function resetValidation() {

    var form = $('#formAdd');

    if (form) {

        var formadd = form.validate();

        formadd.resetForm();

    }

    $(".has-success").removeClass("has-success");

    $(".fa-check").removeClass("fa-check");

    $('.alert-success').hide();

    $(".has-error").removeClass("has-error");

    $(".fa-warning").removeClass("fa-warning");

    $('.alert-danger').hide();

}



function reset() {

    if (document.getElementById("formadd")) {

        document.getElementById("formadd").reset();

        var formadd = $("#formadd").validate();

        formadd.resetForm();

    }

}



// Select2 AJAX

function FormatResult(data) {

    markup = '<div>'+data.text+'</div>';

    return markup;

}



function FormatSelection(data) {

    return data.text;

}

// End Select2 AJAX



//ALERT FUNCTION

function alert_success_save() {

    swal({

        title: "Success!",

        text: "Data telah tersimpan!",

        type: "success",

        confirmButtonClass: "btn-raised btn-success",

        confirmButtonText: "OK",

    });

}



function alert_fail_save() {

    swal({

        title: "Alert!",

        text: "Data gagal tersimpan!",

        type: "error",

        confirmButtonClass: "btn-raised btn-danger",

        confirmButtonText: "OK",

    });

}



function alert_success_delete() {

    swal({

      title: "Success!",

      text: "Data telah dinonaktifkan!",

      type: "success",

      confirmButtonClass: "btn-raised btn-success",

      confirmButtonText: "OK",

    });

}



function alert_fail_delete() {

    swal({

        title: "Alert!",

        text: "Data gagal dinonaktifkan!",

        type: "error",

        confirmButtonClass: "btn-raised btn-danger",

        confirmButtonText: "OK",

    });

}



function alert_success_nonaktif() {

    swal({

      title: "Success!",

      text: "Data telah dinonaktifkan!",

      type: "success",

      confirmButtonClass: "btn-raised btn-success",

      confirmButtonText: "OK",

    });

}



function alert_fail_nonaktif() {

    swal({

        title: "Alert!",

        text: "Data gagal dinonaktifkan!",

        type: "error",

        confirmButtonClass: "btn-raised btn-danger",

        confirmButtonText: "OK",

    });

}



function alert_success_aktif() {

    swal({

      title: "Success!",

      text: "Data telah diaktifkan!",

      type: "success",

      confirmButtonClass: "btn-raised btn-success",

      confirmButtonText: "OK",

    });

}



function alert_fail_aktif() {

    swal({

        title: "Alert!",

        text: "Data gagal diaktifkan!",

        type: "error",

        confirmButtonClass: "btn-raised btn-danger",

        confirmButtonText: "OK",

    });

}



function alert_success_batal() {

    swal({

      title: "Success!",

      text: "Data telah dibatalkan!",

      type: "success",

      confirmButtonClass: "btn-raised btn-success",

      confirmButtonText: "OK",

    });

}



function alert_fail_batal() {

    swal({

        title: "Alert!",

        text: "Data gagal dibatalkan!",

        type: "error",

        confirmButtonClass: "btn-raised btn-danger",

        confirmButtonText: "OK",

    });

}

//END ALERT FUNCTION



function openForm2(url_data = null, modal_id = null, id_data = null, id_data2 = null) {

    $.ajax({

        type : 'GET',

        url  : $base_url+url_data,

        data : { id : id_data, id2 : id_data2 },

        dataType : "html",

        success:function(data){

            $(modal_id+" .modal-content").html();

            $(modal_id+" .modal-content").html(data);

            // $(modal_id+'').modal('show');

            $(modal_id+'').modal({backdrop: "static"});

            MyFormValidation.init();

            $("#formLogin").submit(function(event) {

                if ($("#formLogin").valid() == true) {

                    $.ajax({

                      type : "POST",

                      url  : $base_url+''+$("#url_login").val(),

                      data : $( "#formLogin" ).serialize(),

                      dataType : "json",

                      success:function(data){

                        if(data.status=='200'){

                            $('#modal_login').modal('hide');

                            window.scrollTo(0, 0);

                            swal({

                                title: "Success!",

                                text: "Otorisasi Berhasil!",

                                type: "success",

                                confirmButtonClass: "btn-raised btn-success",

                                confirmButtonText: "OK",

                            });

                            actionData2();

                        } else if (data.status=='204') {

                            swal({

                                title: "Alert!",

                                text: "Otorisasi Gagal!",

                                type: "error",

                                confirmButtonClass: "btn-raised btn-danger",

                                confirmButtonText: "OK",

                            });

                        }

                      }

                    });

                }

                return false;

            });

        }

    });

}



function openFormUser(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Setting/User-Account/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_karyawan_id').css('width', '100%');

        selectList_karyawan('#m_karyawan_id');

        if (id) {

            setTimeout(function(){

                $('#m_karyawan_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_karyawan_id').select2();

                $('#m_karyawan_id').css('width', '100%');

                selectList_karyawan('#m_karyawan_id');

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormCabang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Cabang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#cabang_kota').css('width', '100%');

        selectList_Kota('#cabang_kota', 'Master-Data/Cabang/loadDataSelectKota');

        var idnull;

        selectList_global('#cabang_display', 'C_cabang/loadDataSelectDisplay', 'Setting Gudang Lebih dulu', idnull);

        if (id) {

            setTimeout(function(){

              $('#cabang_kota').select2('destroy');

              $('#cabang_display').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#cabang_kota').select2();

                $('#cabang_display').select2();



                selectList_Kota('#cabang_kota', 'Master-Data/Cabang/loadDataSelectKota');

                selectList_global('#cabang_display', 'C_cabang/loadDataSelectDisplay', 'Pilih Display', id);

              }, 800);

            }, 200);

              // $('#cabang_display').select2('data', { id:"2", text: "Display"}, console.log(id));

        }

      }

    });

}



function getData(form, url){

  var result = null;

  // var storage1 = JSON.parse(localStorage.getItem('storage1'));

  $.ajax({

    type : 'POST',

    url  : $base_url+url,

    data : $(form).serialize(),

    dataType : "json",

    success:function(data){

      getQtyresult(data);

    }

  });

  // return result;

}



function postData2(array, url){

  var result = null;

  $.ajax({

    type : 'POST',

    url  : $base_url+url,

    data : array,

    dataType : "json",

    success:function(data){

        getQtyresult(data);

    }

  });

}





function openFormGlobal(id = null, url = null, elem) {

    $.ajax({

      type : 'POST',

      url  : $base_url+url,

      data : { id : id },

      dataType : "html",

      success:function(data){

        $(elem).modal({

              keyboard: false,

              backdrop: 'static'

            });

        $(elem+" .modal-content").html();

        $(elem+" .modal-content").html(data);

        $(elem).modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          // console.log(1);

          return false;

        });

        functionform(id);

      }

    });

}



// globalselect

function selectList_global(idElemen, url, placeholder, id = null){

    // $('#i_gudang').select2('destroy');

    $(idElemen).css('width', '100%');

    $(idElemen).select2({

      placeholder: placeholder,

      multiple: false,

      allowClear: true,

      ajax: {

        url: $base_url+url,

        dataType: 'json',

        delay: 100,

        cache: false,

        data: function (params) {

          return {

            q: params.term, // search term

            page: params.page,

            id  : id

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

          // console.log(data.items);

        }

      },

      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work

      minimumInputLength: 1,

      templateResult: FormatResult,

      templateSelection: FormatSelection,

    });

  }



  function selectList_globalmulti(idElemen, url, placeholder, id = null){

      $(idElemen).css('width', '100%');

      $(idElemen).select2({

        placeholder : placeholder,

        multiple    : true,

        allowClear  : true,

        ajax: {

          url: $base_url+url,

          dataType: 'json',

          delay: 100,

          cache: false,

          data: function (params) {

            return {

              q   : params.term, // search term

              page: params.page,

              id  : id

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



  function selectList_Kota(idElemen, url) {

    $(idElemen).select2({

      placeholder: 'Pilih Kota',

      multiple: false,

      allowClear: true,

      ajax: {

        url: $base_url+url,

        dataType: 'json',

        delay: 100,

        cache: false,

        data: function (params) {

          return {

            q: params.term, // search term

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



function openFormJenisGudang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Jenis-Gudang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        if (id) {

            setTimeout(function(){

              editData(id);

            }, 200);

        }

      }

    });

}



function openFormTipeKaryawan(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Tipe-Karyawan/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        if (id) {

            setTimeout(function(){

              editData(id);

            }, 200);

        }

      }

    });

}



function openFormDepartemen(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Departemen/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        if (id) {

            setTimeout(function(){

              editData(id);

            }, 200);

        }

      }

    });

}



function openFormMatauang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Mata-Uang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        if (id) {

            setTimeout(function(){

              editData(id);

            }, 200);

        }

      }

    });

}



function openFormKaryawan(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Karyawan/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_cabang_id').css('width', '100%');

        $('#m_type_karyawan_id').css('width', '100%');

        $('#m_departemen_id').css('width', '100%');

        selectList_cabang();

        selectList_typeKaryawan();

        selectList_departemen();

        if (id) {

            setTimeout(function(){

              $('#m_cabang_id').select2('destroy');

              $('#m_type_karyawan_id').select2('destroy');

              $('#m_departemen_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_cabang_id').select2();

                $('#m_type_karyawan_id').select2();

                $('#m_departemen_id').select2();

                selectList_cabang();

                selectList_typeKaryawan();

                selectList_departemen();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormPartner(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Partner/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionDataFile();

          }

          return false;

        });

        $('#partner_kota').css('width', '100%');

        selectList_Kota('#partner_kota', 'Master-Data/Cabang/loadDataSelectKota');

        if (id) {

            setTimeout(function(){

                // $('#partner_kota').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#partner_kota').select2();

                selectList_Kota('#partner_kota', 'Master-Data/Cabang/loadDataSelectKota');

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormGudang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Gudang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#gudang_kota').css('width', '100%');

        $('#m_cabang_id').css('width', '100%');

        $('#m_jenis_gudang_id').css('width', '100%');

        selectList_Kota('#gudang_kota', 'Master-Data/Gudang/loadDataSelectKota');

        selectList_cabang();

        selectList_jenisGudang();

        if (id) {

            setTimeout(function(){

              $('#gudang_kota').select2('destroy');

              $('#m_cabang_id').select2('destroy');

              $('#m_jenis_gudang_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#gudang_kota').select2();

                $('#m_cabang_id').select2();

                $('#m_jenis_gudang_id').select2();

                selectList_Kota('#gudang_kota', 'Master-Data/Gudang/loadDataSelectKota');

                selectList_cabang();

                selectList_jenisGudang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormJenisBarang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Jenis-Barang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_jenis_gudang_id').css('width', '100%');

        selectList_jenisGudang();

        if (id) {

            setTimeout(function(){



              // $('#m_jenis_gudang_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_jenis_gudang_id').select2();

                selectList_jenisGudang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormCategory2(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Master-Kategori/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_jenis_barang_id').css('width', '100%');

        selectList_jenisBarang();

        if (id) {

            setTimeout(function(){

                $('#m_jenis_barang_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_jenis_barang_id').select2();

                selectList_jenisBarang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormKonsinyasi(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Konsinyasi/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            var m_barang_id = document.getElementById("m_barang_id").value;

            $.ajax({

                url: $base_url+'Master-Data/Konsinyasi/cekStok/',

                data: 'id='+m_barang_id,

                type: 'POST',

                success: function (data) {

                    if (data > 0) {

                      // alert("TERHAPUS");

                      swal({

                        title: "Warning",

                        text: "Data Tidak Bisa ditambah Karena Stok Masih Belum Kosong !",

                        type: "warning",

                        confirmButtonClass: "btn-raised btn-danger",

                        confirmButtonText: "OK"

                        })

                    } else {

                      // alert(data);

                      actionData();

                    }

                }

            });

          }

          return false;

        });

        $('#m_jenis_barang_id').css('width', '100%');

        $('#m_category_2_id').css('width', '100%');

        $('#m_barang_id').css('width', '100%');

        selectList_jenisBarang();

        if (id) {

            setTimeout(function(){

                $('#m_jenis_barang_id').select2('destroy');

                // $('#m_category_2_id').select2('destroy');

                // $('#m_barang_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_jenis_barang_id').select2();

                selectList_jenisBarang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormBrand(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Master-Brand/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_jenis_gudang_id').css('width', '100%');

        selectList_jenisGudang();

        if (id) {

            setTimeout(function(){

              // $('#m_jenis_gudang_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_jenis_gudang_id').select2();

                selectList_jenisGudang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormBarang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Barang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_jenis_barang_id').css('width', '100%');

        $('#m_satuan_id').css('width', '100%');

        $('#konversi_akhir_satuan').css('width', '100%');

        $('#m_brand_id').css('width', '100%');

        $('#m_category_2_id').css('width', '100%');

        $('#m_category_2_id').select2();

        selectList_jenisBarang();

        selectList_Satuan('#m_satuan_id');

        selectList_Satuan('#konversi_akhir_satuan');

        select2List('#m_brand_id', 'Master-Data/Master-Brand/loadDataSelectWhere', 'Pilih Brand');

        if (id) {

            setTimeout(function(){

              $('#m_jenis_barang_id').select2('destroy');

              $('#m_category_2_id').select2('destroy');

              $('#m_brand_id').select2('destroy');

              $('#m_satuan_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_jenis_barang_id').select2();

                $('#m_category_2_id').select2();

                $('#m_brand_id').select2();

                $('#m_satuan_id').select2();

                $('#konversi_akhir_satuan').select2();

                selectList_jenisBarang();

                // selectList_Satuan('#m_category_2_id');

                selectList_Satuan('#m_satuan_id');

                selectList_Satuan('#konversi_akhir_satuan');

                selectList_global('#m_brand_id', 'Master-Barang/Getbrand', 'Pilih Brand', id);

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormSatuan(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Satuan/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        if (id) {

            setTimeout(function(){

              editData(id);

            }, 200);

        }

      }

    });

}



function openFormValueBarang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Value-Barang/getFormValue/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_jenis_barang_id').css('width', '100%');

        selectList_jenisBarang();

        if (id) {

            setTimeout(function(){

              $('#m_jenis_barang_id').select2('destroy');

              selectList_jenisBarang();

              editDataValue(id);

            }, 200);

        }

      }

    });

}



function openFormAtributBarang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Atribut-Barang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_barang_id').css('width', '100%');

        $('#atribut_satuan').css('width', '100%');

        selectList_barang();

        selectList_Satuan('#atribut_satuan');

        if (id) {

            setTimeout(function(){

              $('#m_barang_id').select2('destroy');

              $('#atribut_satuan').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_barang_id').select2();

                $('#atribut_satuan').select2();

                selectList_barang();

                selectList_Satuan('#atribut_satuan');

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormSubAtributBarang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Sub-Atribut-Barang/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_barang_id').css('width', '100%');

        $('#m_atribut_id').css('width', '100%');

        $('#sub_atribut_satuan').css('width', '100%');

        selectList_barang();

        selectList_Satuan('#sub_atribut_satuan');

        if (id) {

            setTimeout(function(){

              $('#m_barang_id').select2('destroy');

              $('#m_atribut_id').select2('destroy');

              $('#sub_atribut_satuan').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_barang_id').select2();

                $('#m_atribut_id').select2();

                $('#sub_atribut_satuan').select2();

                selectList_barang();

                selectList_Satuan('#sub_atribut_satuan');

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormJenisProduksi(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Jenis-Produksi/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        if (id) {

            setTimeout(function(){

              editData(id);

            }, 200);

        }

      }

    });

}



function openFormBank(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Bank/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_cabang_id').css('width', '100%');

        selectList_cabang();

        if (id) {

            $('#m_cabang_id').select2('destroy');

            setTimeout(function(){

              editData(id);

              setTimeout(function(){

                $('#m_cabang_id').select2();

                selectList_cabang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormKas(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Kas/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_cabang_id').css('width', '100%');

        selectList_cabang();

        if (id) {

            $('#m_cabang_id').select2('destroy');

            setTimeout(function(){

              editData(id);

              setTimeout(function(){

                $('#m_cabang_id').select2();

                selectList_cabang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormHeader(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Header/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        if (id) {

            setTimeout(function(){

              editData(id);

            }, 200);

        }

      }

    });

}



function openFormCoa(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/COA/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#coa_header').css('width', '100%');

        selectList_masterCOA('#coa_header', 1);

        $('#coa_subheader').css('width', '100%');

        selectList_masterCOA('#coa_subheader', 2);

        if (id) {

            $('#coa_header').select2('destroy');

            $('#coa_subheader').select2('destroy');

            setTimeout(function(){

              editData(id);

              setTimeout(function(){

                $('#coa_header').select2();

                selectList_masterCOA('#coa_header', 1);

                $('#coa_subheader').select2();

                selectList_masterCOA('#coa_subheader', 2);

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormPilihBarang(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Bukti-Keluar-Barang/getForm', //database

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            tambahBarang();

          }

          return false;

        });

        $('#m_barang_id').css('width', '100%');

        selectList_barang();    //del

        if (id) {

            setTimeout(function(){

              $('#m_barang_id').select2('destroy'); //del

              editData(id);

              setTimeout(function(){

                $('#m_barang_id').select2(); //del

                selectList_barang();    //del

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormSPP(type, id = null) {

    if (type == 1) {

      var link_url = $base_url+'Gudang/Surat-Permintaan-Pembelian/getForm';

    } else if (type == 2) {

      var link_url = $base_url+'Pembelian/Surat-Permintaan-Pembelian/getForm';

    }



    $.ajax({

      type : 'GET',

      url  : link_url,

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

            // tambahBarangSPP();

          }

          return false;

        });

        $('#m_barang_id').css('width', '100%');

        // $('#m_gudang_id_permintaan').css('width', '100%');

        selectList_barang();

        selectList_gudangCabangPermintaan();

        if (id) {

            setTimeout(function(){

              $('#m_barang_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_barang_id').select2();

                selectList_barang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormPilihBarangPO(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/Purchase-Order/getForm',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            tambahBarangPO();

          }

          return false;

        });

        $('#m_barang_id').css('width', '100%');

        selectList_barang();

        if (id) {

            setTimeout(function(){

              $('#m_barang_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_barang_id').select2();

                selectList_barang();

              }, 800);

            }, 200);

        }

      }

    });

}



function openFormPenawaran(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Pembelian/Penawaran-Harga/getForm',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

            // tambahBarangSPP();

          }

          return false;

        });

        $('#m_partner_id').css('width', '100%');

        // $('#t_spp_id').css('width', '100%');

        selectList_supplier("#m_partner_id");

        // selectList_spp("#t_spp_id");

        if (id) {

            setTimeout(function(){

              $('#m_partner_id').select2('destroy');

              // $('#t_spp_id').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_partner_id').select2();

                // $('#t_spp_id').select2('destroy');

                selectList_supplier("#m_partner_id");

                // selectList_spp("#t_spp_id");

              }, 800);

            }, 200);

        }

      }

    });

}



function checkStatusBkb(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Gudang/Bukti-Keluar-Barang/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusSPP(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Pembelian/Surat-Permintaan-Pembelian/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusPJ(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Gudang/Permintaan-Jasa/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusPO(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Persetujuan/Purchase-Order/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusBPB(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Pembelian/Penerimaan-Barang/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusRetur(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Pembelian/Retur-Pembelian/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusNotaDebet(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Persetujuan/Nota-Debet/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusEstimasiPenjualan(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Persetujuan/Estimasi-Penjualan/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusPKB(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Gudang/Perhitungan-Kebutuhan-Bahan/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusPB(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Persetujuan/Pengubahan-Bahan/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusST(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Gudang/Serah-Terima/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



function checkStatusPengembalian(id) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Gudang/Pengembalian-Barang/checkStatus',

      data : { id : id },

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

        }

      }

    });

}



// ACTION FORM

function actionData(){

    $.ajax({

      type : "POST",

      url  : $base_url+''+$("#url").val(),

      data : $( "#formAdd" ).serialize(),

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

          $('#modaladd').modal('hide');

          window.scrollTo(0, 0);

          alert_success_save();

          resetValidation();

          reset();

          searchData();

        } else if (data.status=='204') {

          alert_fail_save();

        }

      }

    });

}



function actionDataFile(){

    var formData = new FormData($( "#formAdd" )[0]);

    $.each($("input[type='file']")[0].files, function(i, file) {

        formData.append('file', file);

    });



    $.ajax({

      type : "POST",

      url  : $base_url+''+$("#url").val(),

      data : formData,

      dataType : "json",

      processData: false,

      contentType: false,

      success:function(data){

        if(data.status=='200'){

          $('#modaladd').modal('hide');

          window.scrollTo(0, 0);

          alert_success_save();

          resetValidation();

          reset();

          searchData();

        } else if (data.status=='204') {

          alert_fail_save();

        }

      }

    });

}



function actionData2(){

    $.ajax({

      type : "POST",

      url  : $base_url+''+$("#url").val(),

      data : $( "#formAdd" ).serialize(),

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

          alert_success_save();

          window.location.href = $base_url+''+$("#url_data").val();

        } else if (data.status=='204') {

          alert_fail_save();

        }

      }

    });

}



function actionData3(){

    $.ajax({

      type : "POST",

      url  : $base_url+''+$("#url").val(),

      data : $( "#formAdd" ).serialize(),

      dataType : "json",

      success:function(data){

        if(data.status=='200'){

          alert_success_save();

          searchData();

          // window.location.href = $base_url+''+$("#url_data").val();

        } else if (data.status=='204') {

          alert_fail_save();

        }

      }

    });

}

// END ACTION FORM



// SELECT2 AJAX

function selectList_cabang() {

  $('#m_cabang_id').select2({

    placeholder: 'Pilih',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Cabang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_cabang2(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Cabang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Cabang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_typeKaryawan() {

  $('#m_type_karyawan_id').select2({

    placeholder: 'Pilih Tipe Karyawan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Tipe-Karyawan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_karyawan(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Karyawan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Karyawan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_departemen() {

  $('#m_departemen_id').select2({

    placeholder: 'Pilih Departemen',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Departemen/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_mata_uang(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Mata Uang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Mata-Uang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_jenisGudang() {

  $('#m_jenis_gudang_id').select2({

    placeholder: 'Pilih Jenis Gudang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Jenis-Gudang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_jenisBarang() {

  $('#m_jenis_barang_id').select2({

    placeholder: 'Pilih Category 1',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Jenis-Barang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_gudangCabang(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Gudang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Gudang/loadDataSelectCabang2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_gudangCabangPermintaan() {

  $("#m_gudang_id_permintaan").select2({

    placeholder: 'Pilih Gudang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Gudang/loadDataSelectCabang2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_gudangCabangTujuan() {

  $("#m_gudang_id_tujuan").select2({

    placeholder: 'Pilih Gudang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Gudang/loadDataSelectCabang2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_barang() {

  $('#m_barang_id').select2({

    placeholder: 'Pilih Barang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Barang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_barang2(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Barang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Barang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_barangKode(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Barang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Barang/loadDataSelectKode',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_barangUraian(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Barang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Barang/loadDataSelectUraian',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_atributBarang() {

  $('#m_barang_id').select2({

    placeholder: 'Pilih Barang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Atribut-Barang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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





function selectList_Satuan(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Satuan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Satuan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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

      cache: false,

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





function selectList_JenisProduksi(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Jenis Produksi',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Jenis-Produksi/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_supplier(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Supplier',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Partner/loadDataSelect1',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_customer(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Customer',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Partner/loadDataSelect2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_permintaanPembelian(idElemen, url) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor SPP',

    multiple: true,

    allowClear: true,

    ajax: {

      url: $base_url+url,

      dataType: 'json',

      delay: 100,

      cache: true,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_penawaran(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Penawaran',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Pembelian/Penawaran-Harga/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_purchaseOrder(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor PO',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Pembelian/Purchase-Order/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_purchaseOrderPembayaran(idElemen, idSupplier) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor PO',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Pembelian/Purchase-Order/loadDataPembayaran',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

          idsup: idSupplier,

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



function selectList_workOrder(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor WO',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Pembelian/Work-Order/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_PJ(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Permintaan Jasa',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Gudang/Permintaan-Jasa/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_penerimaanBarang(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor BPB',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Gudang/Penerimaan-Barang/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_penerimaanBarangPembayaran(idElemen, idSupplier) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor BPB',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Gudang/Penerimaan-Barang/loadDataPembayaran',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

          idsup: idSupplier,

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



function selectList_returPembelian(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Retur',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Pembelian/Retur-Pembelian/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_notaDebet(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Nota Debet',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Pembelian/Nota-Debet/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_estimasiPenjualan(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Estimasi Penjualan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Penjualan/Estimasi-Penjualan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_jadwalProduksi(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Jadwal Produksi',

    multiple: true,

    allowClear: true,

    ajax: {

      url: $base_url+'Produksi/Jadwal-Produksi/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: true,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_jadwalProduksi2(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Jadwal Produksi',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Produksi/Jadwal-Produksi/loadDataSelect2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_jadwalProduksiBahanAwal(idElemen, id) {

  $(idElemen).select2({

    placeholder: 'Pilih Nama Bahan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Produksi/Jadwal-Produksi/loadDataSelectBahanAwal',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

          id: id,

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



function selectList_perhitunganKebutuhan(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Perhitungan Kebutuhan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Produksi/Perhitungan-Kebutuhan-Bahan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_perolehanProduksi(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Perolehan Produksi',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Produksi/Perolehan-Produksi/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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

function selectList_perolehanProduksi2(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Perolehan Produksi',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Produksi/Perolehan-Produksi/loadDataSelect2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_pengubahanBahan(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Pengubahan Bahan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Produksi/Pengubahan-Bahan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_POCustomer(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor PO Customer',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Persetujuan/Purchase-Order-Customer/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_SOCustomer(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor SO Customer',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Persetujuan/Sales-Order-Customer/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_SOCustomerMultiple(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor SO Customer',

    multiple: true,

    allowClear: true,

    ajax: {

      url: $base_url+'Persetujuan/Sales-Order-Customer/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: true,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_SOCustomer2(idElemen, idCust) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor SO Customer',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Persetujuan/Sales-Order-Customer/loadDataSelect2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          idCust: $(this).data(idCust),

          q: params.term, // search term

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



function selectList_SJ(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor SJ',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Penjualan/Surat-Jalan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_SJ2(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor SJ',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Penjualan/Surat-Jalan/loadDataSelect2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_fakturPenjualan(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Faktur',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Penjualan/Faktur-Penjualan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_fakturPenjualanPembayaran(idElemen, idCustomer) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Faktur',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Penjualan/Faktur-Penjualan/loadDataPembayaran',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

          idcus: idCustomer,

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



function selectList_suratJalanRetur(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Klaim/Retur',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Penjualan/Surat-Jalan-Retur/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_returPenjualan(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Klain/Retur',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Persetujuan/Klaim-Retur-Penjualan/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_returPenjualan2(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Klaim/Retur',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Persetujuan/Klaim-Retur-Penjualan/loadDataSelect2',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_penerimaanBarangRetur(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor BPBR',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Gudang/Penerimaan-Barang-Retur/loadDataSelect',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_masterCOA(idElemen,type) {

  $(idElemen).select2({

    placeholder: 'Pilih Kode COA',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/COA/loadDataSelect/'+type,

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_masterBank(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nama Bank',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Bank/loadDataSelect/',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_masterKas(idElemen) {

  $(idElemen).select2({

    placeholder: 'Pilih Nama Kas',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/Kas/loadDataSelect/',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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



function selectList_paymentRequest(idElemen, typeBukti = null, idSupplier = null) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Payment',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Accounting/Payment-Request/loadDataSelect/',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

          type: typeBukti,

          idsup: idSupplier,

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



function selectList_paymentRequestPiutang(idElemen, typeBukti = null, idCustomer = null) {

  $(idElemen).select2({

    placeholder: 'Pilih Nomor Pelunasan',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Accounting/Pelunasan-Piutang/loadDataSelect/',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

          type: typeBukti,

          idcus: idCustomer,

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

// function selectList_Bcabang() {

  // $('#m_cabang_id').select2({

    // placeholder: 'Pilih Cabang',

    // multiple: false,

    // allowClear: true,

    // ajax: {

      // url: $base_url+'Master-Data/EDC/loadDataSelectCabang',

      // dataType: 'json',

      // delay: 100,

      // cache: false,

      // data: function (params) {

        // return {

          // q: params.term, // search term

          // page: params.page

        // };

      // },

      // processResults: function (data, params) {

        // // parse the results into the format expected by Select2

        // // since we are using custom formatting functions we do not need to

        // // alter the remote JSON data, except to indicate that infinite

        // // scrolling can be used

        // params.page = params.page || 1;



        // return {

          // results: data.items,

          // pagination: {

            // more: (params.page * 30) < data.total_count

          // }

        // };

      // }

    // },

    // escapeMarkup: function (markup) { return markup; }, // let our custom formatter work

    // minimumInputLength: 1,

    // templateResult: FormatResult,

    // templateSelection: FormatSelection,

  // });

// }

function selectList_Bcabang() 
{

  $('#m_cabang_id').select2({

    placeholder: 'Pilih Cabang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/EDC/loadDataSelectCabang',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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

function selectList_Bbank() 
{

  $('#i_bank').select2({

    placeholder: 'Pilih Bank',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/EDC/loadDataSelectBank',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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

function openFormEdc(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/EDC/getForm/',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_cabang_id').css('width', '100%');
        $('#i_bank').css('width', '100%');

        selectList_Bcabang();
		selectList_Bbank();

        if (id) {

            setTimeout(function(){

                $('#m_cabang_id').select2('destroy');
                $('#i_bank').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_cabang_id').select2();
                $('#i_bank').select2();

                selectList_Bcabang();
				selectList_Bbank();

              }, 800);

            }, 200);

        }

      }

    });

}

function selectList_Bcabang() 
{

  $('#m_cabang_id').select2({

    placeholder: 'Pilih Cabang',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/EDC/loadDataSelectCabang',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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

function selectList_Bbank() 
{

  $('#i_bank').select2({

    placeholder: 'Pilih Bank',

    multiple: false,

    allowClear: true,

    ajax: {

      url: $base_url+'Master-Data/EDC/loadDataSelectBank',

      dataType: 'json',

      delay: 100,

      cache: false,

      data: function (params) {

        return {

          q: params.term, // search term

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

function openFormEdc(id = null) {

    $.ajax({

      type : 'GET',

      url  : $base_url+'Master-Data/EDC/getForm',

      data : { id : id },

      dataType : "html",

      success:function(data){

        $("#modaladd .modal-body").html();

        $("#modaladd .modal-body").html(data);

        $('#modaladd').modal('show');

        MyFormValidation.init();

        rules();

        $("#formAdd").submit(function(event){

          if ($("#formAdd").valid() == true) {

            actionData();

          }

          return false;

        });

        $('#m_cabang_id').css('width', '100%');
        $('#i_bank').css('width', '100%');

        selectList_Bcabang();
		selectList_Bbank();

        if (id) {

            setTimeout(function(){

                $('#m_cabang_id').select2('destroy');
                $('#i_bank').select2('destroy');

              editData(id);

              setTimeout(function(){

                $('#m_cabang_id').select2();
                $('#i_bank').select2();

                selectList_Bcabang();
				selectList_Bbank();

              }, 800);

            }, 200);

        }

      }

    });

}

// END SELECT 2 AJAX

/***

Usage

***/

//Custom.doSomeStuff();

