//console.log("%c Website: TANGSUB.INFO %c", 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#ff0011;-webkit-text-fill-color:#ff0011;-webkit-text-stroke: 1px #ff0011;', "font-size:12px;color:#999999;");
//console.log("%c Coder: Nguyễn Hợp %c", 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#ff0011;-webkit-text-fill-color:#ff0011;-webkit-text-stroke: 1px #ff0011;', "font-size:12px;color:#999999;");
//console.log("%c Contact: https://www.facebook.com/rin1906/ %c", 'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:#ff0011;-webkit-text-fill-color:#ff0011;-webkit-text-stroke: 1px #ff0011;', "font-size:12px;color:#999999;");
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $("form[submit-ajax=rin1906]").submit(function (e) {
        e.preventDefault();
        let _this = this;
        let url = $(_this).attr("action");
        let method = $(_this).attr("method");
        let href = $(_this).attr("href");
        let data = $(_this).serialize();
        let button = $(_this).find("button[type=submit]");
        if (button.attr("order")) {
            Swal.fire({
                title: "Xác nhận thanh toán!",
                text: button.attr("order"),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tôi đồng ý",
                cancelButtonText: "Đóng",
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm(url, method, href, data, button);
                }
            });
        } else {
            submitForm(url, method, href, data, button);
        }
    });
});

function submitForm(url, method, href, data, button) {
    let textButton = button.html().trim();
    let setting = {
        type: method,
        url,
        data,
        dataType: "json",
        beforeSend: function () {
            button
                .prop("disabled", !0)
                .html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...');
        },
        complete: function () {
            button.prop("disabled", !1).html(textButton);
        },
        success: function (response) {
            if (button.attr("callback")) {
                window[`${button.attr("callback")}`](response);
            }
            if (!button.attr("callback")) {
                swal(
                    response.message,
                    response.status === true ? "success" : "error"
                );
            }
            if (response.status === true && !button.attr("href") && !button.attr("callback")) {
                setTimeout(() => {
                    if (!href) {
                        window.location.reload();
                        return;
                    }
                    window.location.href = href;
                }, 2000);
            }
        },
        error: function (error) {
            console.log(error);
        },
    };
    $.ajax(setting);
}


function swal(text,type){
  return Swal.fire({title:"Thông báo",text,type,confirmButtonColor:"#e31448"});
}
function noti(title,icon){
    toastr.options={closeButton:true,progressBar:true,showMethod:'slideDown',timeOut:1500}
    return toastr[icon](title);
}
$(document).ready(function() {
toastr.options={
    newestOnTop: true,
    preventDuplicates: true,
    closeButton:true,
    progressBar:true,
    showMethod:'slideDown',
    maxOpened: 5,
    timeOut: 1300}
});
function wait(t, e, n) {
    return e ? $(t).prop("disabled", !1).html(n) : $(t).prop("disabled", !0).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>        Loading...')
}
function coppy(id){
 var copyText = document.getElementById(id);
 copyText.select();
 copyText.setSelectionRange(0, 99999);
 document.execCommand("copy");
 swal("Sao chép thành công","success");
}
function random_text(length) {
  var result           = '';
  var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;
  for ( var i = 0; i < length; i++ ) {
     result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}



//Top Up
$(document).ready(function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() > 600) {
        $('#top-up').fadeIn();
      } else {
        $('#top-up').fadeOut();
      }
    });
    // scroll body to 0px on click
    $('#top-up').click(function() {
      $('body,html').animate({
        scrollTop: 0
      }, 400);
      return false;
    });
});
