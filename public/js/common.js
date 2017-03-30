alertify.set('notifier', 'position', 'top-right');
$('.submitform').click(function () {
    var currentForm = $(this.form);
    $(this).hide();
    if ($(this).hasClass("ld2")) {
        //
        $("#loadingaction2").insertAfter($(this));
        $("#loadingaction2").show();
    }
    else if ($(this).hasClass("btn-pm")) {
        //
        $("#loadingaction3").insertAfter($(this));
        $("#loadingaction3").css('display', 'inline-block');
    }
    else {
        $("#loadingaction").insertAfter($(this));
        $("#loadingaction").show();
    }
    if (currentForm.valid()) {
        currentForm.submit();
        //currentForm.children().find('input[type=text]').val('');
        //currentForm.children().find('textarea').val('');
    }
});

var OnActionFailure = function (ajaxContext) {
    $('.submitform').show();
    $('#loadingaction').hide();
    $("#loadingaction2").hide();
    $("#loadingaction3").hide();
    $('#loadingaction_new').hide();
    alertify.warning("Có lỗi xảy ra, vui lòng thử lại!", "warning", 15, null);
    window.location.href = "/";
}
var OnActionFailureHome = function (ajaxContext) {
    $('.submitform').show();
    $('#loadingaction').hide();
    $("#loadingaction2").hide();
    $("#loadingaction3").hide();
    window.location.href = "/";
}


var OnActionSuccess = function (data) {

    $('.submitform_new').show();
    $('#loadingaction_new').hide();
    $('.submitform').show();
    $('#loadingaction').hide();
    $("#loadingaction2").hide();
    $("#loadingaction3").hide();
    $(".btn-search-mobile").show();
    if (data.Type != 1) {
        if (data.Type == 3) { //== 3 chỉ giành riêng cho chọn tên miền cho dịch vụ (hosting, email, ssl)
            var tenMienChuaDangKy = $("#TenMien1").val();//+ $("#TopLevelDomain").val();
            $("#tenmienchuadangky").html(tenMienChuaDangKy);
            $("#TenMienChuaDangKy").val(tenMienChuaDangKy);
            $("#box-container-warning").fadeIn();
            $("#DanhSachTenMienChoDichVu").html("");
            $("#TenMienBaoVay").html("");
            $()
            $.get("/TenMien/DanhSachTenMienChoDichVu", function (htmldata) {
                $('#DanhSachTenMienChoDichVu').html(htmldata);
            });


            // Hiển thị thông tin tên miền cho dịch vụ
            //$.get("/TenMien/TenMienAvailableChoDichVu", function (htmldata) {
            //    $('#TenMienChoDichVu').html(htmldata);
            //    $.get("/TenMien/_ListTenMienBaoVay", function (htmldata) {
            //        $('#TenMienBaoVay').html(htmldata);
            //        $(".ten-mien-de-xuat .list-ten-mien-de-xuat .matbao-label-2").find("span").text("TÊN MIỀN BẠN CÓ THỂ MUA THÊM");
            //    });
            //});

            // Đỗ danh sách tên miền bao vây vào popup chọn tên miền cho dịch vụ
            //$.get("/TenMien/_ListTenMienBaoVay", function (htmldata) {
            //    $('#TenMienBaoVay').html(htmldata);
            //});
        }
        else {
            if (data.ControlId != null) {
                $('#' + data.ControlId).focus();
            }
            alertify.notify(data.Message, "error", 15, null);
            return false;
        }
    }
    else {
        if (data.ReturnUrl != null && data.ReturnUrl != "") {
            if (data.Message != null && data.Message != "") {
                alertify.success(data.Message, "success", 15, null);
            }
            window.location.href = data.ReturnUrl;
        }
        else {
            alertify.notify(data.Message, "error", 15, null);
        }
    }
}

var OnActionSuccess2 = function (data) {
    $('.submitform').show();
    $('#loadingaction').hide();
    $("#loadingaction2").hide();
    $("#loadingaction3").hide();
    if (data.Type == 1) {
        alertify.success(data.Message, "success", 15, null);
    }
    else {
        alertify.notify(data.Message, "error", 15, null);
    }
}

$('.inputnumberonly').keypress(function (evt) {
    var numbervalue = $(this).val();
    var charCode = (evt.which) ? evt.which : event.keyCode
    var c = String.fromCharCode(charCode);
    if (charCode == 46) {
        return false;
    }
    if (numbervalue.indexOf(c) > 0 && charCode == 46) {
        return false;
    }
    else if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
});

$("input, textarea").not(".ck-input").keypress(function (evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode == 60 || charCode == 62)
        return false;
    return true;
});

$('#TenDangNhap, #MatKhau').keypress(function (e) {
    if (e.keyCode == 13) {
        $('.btn-login').trigger("click");
    }
});


$(function () {
    $('.slide-partner-payment').jcarouselAutoscroll({
        interval: 2000
    });

    $('.slide-partner-service').jcarouselAutoscroll({
        interval: 3000
    });

    $(".radio-soft").click(function () {
        var currentname = $(this).children("input:radio").attr("name");
        $(".radio-soft").children("input:radio[name=" + currentname + "]").removeAttr('checked');
        $(".radio-soft").children("input:radio[name=" + currentname + "]").parent().css("background", "url('/public/images/uncheck.png') no-repeat");

        if ($(this).children().find('input:radio').attr('checked') != "checked") {
            $(this).find('input:radio').attr('checked', 'checked');
            $(this).css("background", "url('/public/images/check.png') no-repeat");
        } else {
            $(this).children().find('input:radio').removeAttr('checked');
            $(this).css("background", "url('/public/images/uncheck.png') no-repeat");
        }
    });

    $('input:radio').each(function (index) {
        if ($(this).parent().hasClass('radio-soft')) {
            if ($(this).prop('checked')) {
                $(this).parent().css("background", "url('/public/images/check.png') no-repeat");
            } else {
                $(this).parent().css("background", "url('/public/images/uncheck.png') no-repeat");
            }
        }
    });

    $('.boxbanggiatenmien .btn-xem-tiep').click(function () {
        $(this).find('div').find('div').css('height', 'auto');
    });

    $(".radio-soft label").click(function () {
        var radio_input = $(this).prev();
        radio_input.trigger("click");
    });

});

$(".close-warning-btn").click(function () {
    $("#box-container-warning").fadeOut();
});

var mbnwarning = function (status, content, callback) {
    bootbox.alert(content, function () {
        eval(callback);
    });
    if (status == 1) {
        $(".bootbox-body").addClass("bootbox-body-ok");
    }
};

$("#whoisdomaintext").keypress(function (event) {
    if (event.which == 13) {
        event.preventDefault();
        $('.whoissubmit').click();
        //WhoisDomain();
    }
});

$('.whoissubmit').click(function () {
    var currentForm = $(this.form);
    if (currentForm.valid()) {
        currentForm.submit();
    }
});

//$(".mbtooltip").tooltip({
//    container: 'body'
//});

//$(".mbtooltip").qtip();

var updateGiaTuyChinhMayChu = function () {
    var hddTuyChinh = parseInt($("#btn-datmua-tuychoncauhinh").attr('data-tuychinhhdd'));
    var ramTuyChinh = parseInt($("#btn-datmua-tuychoncauhinh").attr('data-tuychinhram'));
    var cpuTuyChinh = parseInt($("#btn-datmua-tuychoncauhinh").attr('data-tuychinhcpucore'));
    $.get("/lay-gia-may-chu-tuy-chinh.html?hddTuyChinh=" + hddTuyChinh + "&ramTuyChinh=" + ramTuyChinh + "&cpuTuyChinh=" + cpuTuyChinh + "", function (data) {
        $("#totalvalue").html(data);
    });
};

ajaxRequestsUpdateGiaAddons = new Array();
var updateGiaAddonTuyChinhMayChu = function () {

    var tuychinhAddonRam = parseInt($("#MuaThemRam").val());
    var tuychinhAddonHdd = parseInt($("#MuaThemDungLuong").val());
    var tuyChinhAddonIP = parseInt($("#MuaThemIP").val());

    if (ajaxRequestsUpdateGiaAddons[ajaxRequestsUpdateGiaAddons.length - 1]) {
        ajaxRequestsUpdateGiaAddons[ajaxRequestsUpdateGiaAddons.length - 1].abort();
    }

    ajaxRequestsUpdateGiaAddons[ajaxRequestsUpdateGiaAddons.length] = $.get("/lay-gia-addon-may-chu-tuy-chinh.html?ramAddonTuyChinh=" + tuychinhAddonRam + "&hddAddonTuyChinh=" + tuychinhAddonHdd + "&ipAddonTuyChinh=" + tuyChinhAddonIP + "", function (data) {
        $("#totalvalue").html(data);
    });
};


ajaxRequestsUpdateGiaBangThong = new Array();
var updateGiaBangThongHosting = function () {

    var tuyChinhBangThongHosting = parseInt($("#MuaThemBangThong").val());

    if (ajaxRequestsUpdateGiaBangThong[ajaxRequestsUpdateGiaBangThong.length - 1]) {
        ajaxRequestsUpdateGiaBangThong[ajaxRequestsUpdateGiaBangThong.length - 1].abort();
    }

    ajaxRequestsUpdateGiaBangThong[ajaxRequestsUpdateGiaBangThong.length] = $.get("/lay-gia-addon-bang-thong-hosting.html?bangThongTuyChinh=" + tuyChinhBangThongHosting, function (data) {
        $("#totalvalue").html(data);
    });
};


$(".gotobottom").click(function () {
    $(window).scrollTop($(window).height());
});

function XemThemTinhNang() {
    $('body,html').animate({ scrollTop: $("#TinhNangChiTiet").position().top }, 'slow');
}

$("#menu-mb-main").click(function () {
    if ($(this).hasClass("collapsed")) {
        $('body,html').animate({ scrollTop: 0 }, 'slow');
    }
})

$(window).on("scroll", function () {
    var offset = $(".gio-hang-scroll").offset();
    $(".wrap-gio-hang-scroll .thanh-doc").height(offset.top - 173)
    if ($(window).scrollTop() > 40) {
        //if (offset.top > 100) {
        $(".wrap-gio-hang-scroll").show();
    } else {
        $(".wrap-gio-hang-scroll").hide();
    }
});

$(window).load(function () {
    var offset = $(".gio-hang-scroll").offset();
    $(".wrap-gio-hang-scroll .thanh-doc").height(offset.top - 173);

    setInterval(KeepSessionAlive, 60000);

});

function KeepSessionAlive() {
    $.post('/Helpers/KeepSessionAlive.ashx', null, function () {
    });
}

$(window).resize(function () {
    changControlHeaderForMobile();
});

$(window).load(function () {
    changControlHeaderForMobile();
});

var changControlHeaderForMobile = function () {
    if ($(window).width() < 767) {
        $("#mb-a-login-info").children("img").attr("src", "/public/images/icon-user-mobile.png");
        $("#SLGioHangMobile").next().attr("src", "/public/images/icon-giohang-mobile.png");
        var widthLogo = $("#logo-mobile").children("img").width();
        var widthHeader = $(".navbar-header").width();
        $("#logo-mobile").attr("style", "position: absolute; left: " + (widthHeader / 2 - widthLogo / 2) + "px");
    }
    else {
        $("#mb-a-login-info").children("img").attr("src", "public/images/account-white.png");
        $("#SLGioHangMobile").next().attr("src", "public/images/cart-white.png");
        $("#logo-mobile").attr("style", "display: block;");
    }
};


