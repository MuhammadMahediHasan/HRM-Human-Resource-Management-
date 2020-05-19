function Toster(type, message, heading = ''){
    side = 'toast-top-right'
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": side,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "5000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    switch(type) {
        case 'success':
            toastr.success(message, 'Success..!!');
            break;
        case 'warning':
            toastr.warning(message, 'Warning..!!');
            break;
        case 'error':
           toastr.error(message, 'Error..!!');
            break;
        case 'danger':
           toastr.error(message, 'Error..!!');
            break;
    }
}
class Errors{
    constructor(){
        this.errors = {};
        this.arr_errors = [];
    }
    get(field){
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }
    arr_get(multi = false, key, arr_field){
        if (multi){
            if (this.arr_errors[multi] !== undefined && this.arr_errors[multi][key] !== undefined && this.arr_errors[multi][key][arr_field] !== undefined) {
                return this.arr_errors[multi][key][arr_field][0];
            }
        } else{
            if (this.arr_errors[key] !== undefined && this.arr_errors[key][arr_field] !== undefined) {
                return this.arr_errors[key][arr_field][0];
            }
        }
    }
    record(errors){
        this.errors = errors;
    }
    arr_record(arr_errors, multi = false){
        if (multi){
            this.arr_errors[multi] = arr_errors;
        } else{
            this.arr_errors = arr_errors;
        }
    }
}

function dd(data) {
    console.log(data);
}
//$('.select2').select2();

var height = $(window).height();
$('.main_content_wrapper').css('min-height', height-95);

//===========Menu Active Classes=================
//var path = location.pathname;
var path = document.location;
var target = $('ul.ml-menu li a[href$="' + path + '"]');
target.parent().addClass("active");
target.parent().parent().parent().addClass('active');
var top_menu = $('.header a[href$="' + path + '"]');


function ReportPrintDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;
   document.body.innerHTML = printContents;
   window.print();
   document.body.innerHTML = originalContents;

   window.location.reload();
}