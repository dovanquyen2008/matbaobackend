<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'whmcs.class.php';
$whmcs = new WHMCS('http://account.stormeyes.com/includes/api.php', 'admin', '12345678', '');
$result = $whmcs->domainWhois('quyenasdfsdf.org');
$array = json_decode(json_encode($result), True);
?>

<script>
    function getCheckedDomain() {
        var domain = $('#whoisdomaintext').val();
        var whoisData = JSON.parse('<?php
print_r(json_encode($array));
?>');
        console.log(whoisData);
        if(whoisData.status==="available")
            $("#text-ket-qua-whois").text("Congratulation! This domain is available. Buy it now");
        else 
            $("#text-ket-qua-whois").text("");
    }
</script>
<div class="main">
    <style type="text/css">
        .control-thugon {
            cursor: pointer;
        }

        .description {
            display: none;
            position: absolute;
            border: 1px solid #f1d031;
            background-color: #ffffa3;
            color: #555;
            width: 400px;
            height: 130px;
            z-index: 9999;
            padding: 5px;
        }
    </style>

    <div class="check-domain check-domain-v2">
        <section class="bg-primary " style="background:#e9e6e5;    box-shadow: 0 2px 8px #a7a7a7;z-index: 1;position: relative;">
            <div class="container matbao-control" style="padding-top:10px; padding-bottom:20px;">
                <div class="col-md-12">
                    <div class="row">
                        <form id="pFormChonTenMienChoDichVu" action="https://www.matbao.net/TenMien/SetDomaintoSession?Length=7" data-ajax="true" data-ajax-failure="OnActionFailure" data-ajax-method="POST" data-ajax-success="WhoisDomain" method="post" role="form">                        <input type="hidden" value="" id="IsMulti" name="IsMulti">
                            <div class="row">
                                <div class="col-md-9 col-sm-8">
                                    <div class="input-group input-group-lg" style="z-index:1">
                                        <input style="min-height: 58px; font-size: 20px; width: 100%; padding-left: 15px;color:#333;" value="" id="whoisdomaintext" type="text" name="tenMien" class="matbao-textbox" placeholder="Hãy gõ tên miền bạn muốn vào đây">
                                        <div class="input-group-btn ">
                                            <input type="button" onclick="getCheckedDomain()"  class="btn matbao-button whoissubmit_new" value="Search again" style="display: inline-block;">
                                            <img id="loadingaction_new" src="./Kiểm tra tên miền_files/loading2EN.gif" style="background-color: rgb(209, 209, 209); padding: 4px 20px; display: none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <button type="button" onclick="GetListDomainToBuy()" class="btn matbao-button btnTiepTucMua pull-right">Countinue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-primary panel-2">
            <div class="container">
                <div class="col-md-12">
                    <section id="whosisresult">
                        <script>
//                            $("#ActionCheckDomain").show();
//                            $("#list-domainpartial").show();
                        </script>
                        <div class=" result-domain">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row matbao-label-2">
                                        <div class="row">

                                            <div class="col-md-12 col-sm-12"><p class="text-ket-qua-whois" id="text-ket-qua-whois"></p></div>
                                        </div>
                                    </div>
                                </div>
                                <section id="DivForAppendWhois">
                                    <div style=" margin-top: 20px;" class="col-md-12 col-sm-12 col-xs-12 result-whois whoIsTenMienPartial com" id="comquyen11212">
                                        <section class="wrap-detail-result-whois">
                                            <input type="hidden" id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky">
                                            <div class="domain-row row">
                                                <div class="whois domain-name">
                                                    <strong class="clearfix">
                                                        <span class="matbao-domain-whois">quyen11212</span><span class="matbao-domain-name">.com</span>
                                                    </strong>
                                                </div>
                                                <div class="domain-button">
                                                    <div class="visible-md-block visible-sm-block visible-lg-block visible-xs-block button-mua-domain">
                                                        <button data-madichvu=".com" data-tenmien="quyen11212.com" data-idchitietdonhang="" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green "> Chọn</button>
                                                        <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                            <img src="./Kiểm tra tên miền_files/loading2.gif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="domain-price">
                                                    <p>299.000 VNĐ/NĂM</p>
                                                    <p><span class="pricenew">99.000</span> <span class="unit-price-whois pricenewUnit">VNĐ/NĂM</span></p>
                                                    <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; font-size: 12px; display: block;">299.000 <span>VNĐ/NĂM cho gia hạn</span></span></p>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="height: 31px; border-color:#b7b7b7; border-width:1px 1px 0 1px; border-style:solid;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 3px;"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body scrollbox3" id="whoisgoted" style="border-color: #b7b7b7; border-width: 0px 1px 1px 1px; border-style: solid;">
                                                        <img src="./Kiểm tra tên miền_files/loading.gif" width="35" id="ddlimg_ddl00_51514">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            // Trí khóa 23/6/2016
                                            //function ChonDoMainnayMobile(domain) {
                                            //    if ($(domain).hasClass('orange')) {
                                            //        $(domain).removeClass('orange');
                                            //        $(domain).addClass('green');
                                            //    }
                                            //    else {
                                            //        if ($(domain).hasClass('green')) {
                                            //            $(domain).removeClass('green');
                                            //            $(domain).addClass('orange');
                                            //        }
                                            //    }
                                            //}

                                            //function ChonDomainNay(domain) {
                                            //    if ($(domain).hasClass('orange')) {
                                            //        $(domain).removeClass('orange');
                                            //        $(domain).addClass('green');
                                            //        $(domain).html('Chọn');
                                            //    }
                                            //    else {
                                            //        if ($(domain).hasClass('green')) {
                                            //            $(domain).removeClass('green');
                                            //            $(domain).addClass('orange');
                                            //            $(domain).html('Đã chọn');
                                            //        }
                                            //    }
                                            //}


                                            $(document).ready(function () {
                                                $('.mbtooltip').qtip({
                                                    content: function () {
                                                        var element = $(this);
                                                        return element.attr('data-original-title');
                                                    },
                                                    position: {
                                                        at: 'bottom center',
                                                        my: 'top center',
                                                        viewport: $(window)
                                                    }
                                                });
                                            });
                                            // Chức năng khi click chọn mua tên miền sẽ insert vào giỏ hàng.

//                                            $("#ActionCheckDomain").show();
                                            //$("#TenMienBaoVay").show();
//                                            $("#list-domainpartial").show();
                                        </script></div>
                                    <div class="comBoTenMienWhois" id="comBoTenMien_quyen11212_com" data-thongtin="quyen11212" data-tenmien=".com">

                                        <div class="col-md-12 col-sm-12 col-xs-12 result-whois " id="combo" style="margin-top:0;padding-bottom:45px;padding-top:0">
                                            <div class="clearfix dotted-spaced">&nbsp;</div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-combo">
                                                    <strong><span class="fa fa-exclamation-circle" style="font-size:23px;margin-right:5px;"></span> Wow! Đăng ký bộ tứ tiết kiệm đến 78%</strong>
                                                </div>
                                            </div>
                                            <div class="domain-row row" style="margin-top:15px;">
                                                <div class="whois domain-name " id="groupComboDomainItem_quyen11212" style="line-height:inherit;padding-left:30px;">
                                                    <div class="clearfix">
                                                        <div data-tenmienfull="quyen11212.com" data-idchitietdonhang="" id="comboItem_quyen11212_com" class="matbao-domain-whois wrapword comboDomainItem">
                                                            quyen11212.com
                                                            <span style="display:none" class="comboDomainItemInfo" data-madichvu=".com" data-tenmien="quyen11212.com"></span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix">
                                                        <div data-tenmienfull="quyen11212.net" data-idchitietdonhang="" id="comboItem_quyen11212_net" class="matbao-domain-whois wrapword comboDomainItem">
                                                            quyen11212.net
                                                            <span style="display:none" class="comboDomainItemInfo" data-madichvu=".net" data-tenmien="quyen11212.net"></span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix">
                                                        <div data-tenmienfull="quyen11212.top" data-idchitietdonhang="" id="comboItem_quyen11212_top" class="matbao-domain-whois wrapword comboDomainItem">
                                                            quyen11212.top
                                                            <span style="display:none" class="comboDomainItemInfo" data-madichvu=".top" data-tenmien="quyen11212.top"></span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix">
                                                        <div data-tenmienfull="quyen11212.xyz" data-idchitietdonhang="" id="comboItem_quyen11212_xyz" class="matbao-domain-whois wrapword comboDomainItem">
                                                            quyen11212.xyz
                                                            <span style="display:none" class="comboDomainItemInfo" data-madichvu=".xyz" data-tenmien="quyen11212.xyz"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="domain-button">
                                                    <div class="button-mua-domain">
                                                        <button data-thongtin="quyen11212" data-guidcb="40201f88-647f-4bd2-9871-6c1e2f9da5b8" data-macouponcb="XPCU1QO" data-machiendichcb="367" onclick="javascript: MuaComboDomainNay(this);" class="btn matbao-button whois-domain green muaComboDomain"> Select</button>
                                                        <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                            <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="domain-price domain-price-combo">
                                                    <p style="margin-top: 8px;">1.158.000 VND/YEAR</p>
                                                    <p><span class="pricenew">256.000</span> <span class="pricenewUnit">VND/YEAR</span></p>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function MuaComboDomainNay(domain) {
                                                if ($(domain).hasClass('orange')) {
                                                    XoaTenMienCB(domain, 'false'); // Xoa Tên miền này
                                                } else {
                                                    if ($(domain).hasClass('green')) {
                                                        MuaTenMienCB(domain, 'false'); // Mua tên miền này
                                                    }
                                                }

                                            }

                                            function MuaTenMienCB(domain, isMobile) {
                                                ShowLoading(domain, isMobile);
                                                var maCouponCB = $(domain).attr("data-maCouponCB"),
                                                        maChienDichCB = $(domain).attr("data-maChienDichCB"),
                                                        GuidCB = $(domain).attr("data-guidCB");
                                                var stringDM = "";
                                                $('#groupComboDomainItem_' + $(domain).data('thongtin') + ' .comboDomainItem').each(function () {
                                                    stringDM += ($(this).data('tenmienfull') + ";")
                                                });
                                                var lstDomain = stringDM.split(';').filter(function (item) {
                                                    return item !== ''
                                                });
                                                //lstDomain.forEach(function (element, index, array) {
                                                //    var tenMien = element;
                                                //    $.ajax({
                                                //        type: "POST",
                                                //        url: "/TenMien/ChonMuaTenMien?domain=" + tenMien + "&isCombo=true&maCouponCB=" + maCouponCB + "&maChienDichCB=" + maChienDichCB + "&GuidCB=" + GuidCB,
                                                //        success: function (data) {
                                                //            HideLoading(domain, isMobile);
                                                //            if (data.Type == 1) {
                                                //                if (index == array.length - 1) {
                                                //                    DoiTtrangThaiTenMien(domain, isMobile); //Đổi trạng thái khi mua thành công tên miền
                                                //                    alertify.success(data.Message);
                                                //                }

                                                //                //Cập nhật nút mua tên miền giống với tên miền trong combo
                                                //                DoiTrangThaiTenMienThuocCombo(element, isMobile, true);

                                                //                CapNhatSoLuongGioHang(data.ServiceTotal);
                                                //                // gán id chi tiết đơn hàng.
                                                //                $("#comboItem_" + tenMien.replace('.', '_')).attr('data-idChiTietDonHang', data.idChiTietDonHang);
                                                //                //location.href = data.ReturnUrl;
                                                //            }
                                                //            else {
                                                //                alertify.error(data.Message);
                                                //                if (data.ReturnUrl != null && data.ReturnUrl != "") {
                                                //                    setTimeout(function () {
                                                //                        location.href = data.ReturnUrl;
                                                //                    }, 2000);
                                                //                }
                                                //            }
                                                //        },
                                                //        error: function (data) {
                                                //            if (index == array.length - 1) {
                                                //                HideLoading(domain, isMobile);
                                                //            }

                                                //            if (data.Type == 0)
                                                //                alertify.error(data.Message);
                                                //        }
                                                //    });
                                                //});

                                                $.ajax({
                                                    type: "POST",
                                                    url: "/TenMien/ChonMuaTenMienCombo?ListStrDomain=" + stringDM + "&maCouponCB=" + maCouponCB + "&maChienDichCB=" + maChienDichCB + "&GuidCB=" + GuidCB,
                                                    success: function (data) {
                                                        HideLoading(domain, isMobile);
                                                        if (data.Type == 1) {

                                                            DoiTtrangThaiTenMien(domain, isMobile); //Đổi trạng thái khi mua thành công tên miền
                                                            alertify.success(data.Message);
                                                            //Cập nhật nút mua tên miền giống với tên miền trong combo

                                                            lstDomain.forEach(function (element, index, array) {
                                                                DoiTrangThaiTenMienThuocCombo(element, isMobile, true);
                                                                //$("#comboItem_" + element.replace('.', '_')).attr('data-idChiTietDonHang', data.idChiTietDonHang);
                                                            });
                                                            CapNhatSoLuongGioHang(data.ServiceTotal);
                                                            // gán id chi tiết đơn hàng.

                                                            //location.href = data.ReturnUrl;
                                                        } else {
                                                            alertify.error(data.Message);
                                                            if (data.ReturnUrl != null && data.ReturnUrl != "") {
                                                                setTimeout(function () {
                                                                    location.href = data.ReturnUrl;
                                                                }, 2000);
                                                            }
                                                        }
                                                    },
                                                    error: function (data) {
                                                        if (index == array.length - 1) {
                                                            HideLoading(domain, isMobile);
                                                        }

                                                        if (data.Type == 0)
                                                            alertify.error(data.Message);
                                                    }
                                                });
                                            }

                                            function XoaTenMienCB(domain, isMobile) {
                                                var idChiTietDonHang = $(domain).attr("data-idChiTietDonHang");
                                                var GuidCB = $(domain).attr("data-guidcb");
                                                ShowLoading(domain, isMobile);
                                                $(domain).parent().find('.mb-loadingaction-dangxuly').show();
                                                var stringDM = "";
                                                $('#groupComboDomainItem_' + $(domain).data('thongtin') + ' .comboDomainItem').each(function () {
                                                    stringDM += ($(this).data('tenmienfull') + ";")
                                                });
                                                var lstDomain = stringDM.split(';').filter(function (item) {
                                                    return item !== ''
                                                });
                                                $.ajax({
                                                    type: "POST",
                                                    url: "/TenMien/XoaTenMien?idChiTietDonHang=" + idChiTietDonHang + "&GuidCB=" + GuidCB,
                                                    success: function (data) {
                                                        HideLoading(domain, isMobile);
                                                        DoiTtrangThaiTenMien(domain, isMobile); //Đổi trạng thái khi xóa thành công tên miền
                                                        if (data.Type == 1 && data.Message != '') {
                                                            alertify.warning(data.Message);
                                                            CapNhatSoLuongGioHang(data.ServiceTotal);
                                                            $(domain).attr('data-idChiTietDonHang', '');
                                                            //location.href = data.ReturnUrl;

                                                            //Cập nhật nút mua tên miền giống với tên miền trong combo
                                                            lstDomain.forEach(function (element, index, array) {
                                                                DoiTrangThaiTenMienThuocCombo(element, isMobile, false);
                                                            });
                                                        } else if (data.Type == 3) {
                                                            alertify.error(data.Message);
                                                            window.location.href = data.ReturnUrl;
                                                        } else
                                                            alertify.error(data.Message);
                                                    },
                                                    error: function (data) {
                                                        HideLoading(domain, isMobile);
                                                        if (data.Type == 0)
                                                            alertify.error(data.Message);
                                                    }


                                                });
                                            }

                                            function ShowLoading(domain, isMobile) {
                                                $(domain).hide();
                                                if (isMobile == 'true') {
                                                    $(domain).parent().find('.mb-loadingaction-mobile').show();
                                                } else {
                                                    $(domain).parent().find('.mb-loadingaction-dangxuly').show();
                                                }
                                            }

                                            function HideLoading(domain, isMobile) {
                                                $(domain).show();
                                                if (isMobile == 'true') {
                                                    $(domain).parent().find('.mb-loadingaction-mobile').hide();
                                                } else {
                                                    $(domain).parent().find('.mb-loadingaction-dangxuly').hide();
                                                }
                                            }

                                            function DoiTrangThaiTenMienThuocCombo(TenMien, isMobile, isMuaTenMien) {
                                                var madichvu = "." + TenMien.split('.')[TenMien.split('.').length - 1];
                                                var element = $('[data-tenmien="' + TenMien + '"][data-madichvu="' + madichvu + '"]:not(.comboDomainItemInfo)');
                                                if (isMuaTenMien && element.hasClass('green'))
                                                    DoiTtrangThaiTenMien(element, isMobile);
                                                if (!isMuaTenMien && element.hasClass('orange'))
                                                    DoiTtrangThaiTenMien(element, isMobile);
                                            }
                                            ;
                                        </script></div>
                                </section>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function () {
                                $('#dropdown-listtypedomain').change(function () {
                                    var value = $(this).val();
                                    $.get("/TenMien/_ListDomainPartial", {idGroup: value}, function (htmldata) {
                                        $('#list-domainpartial').html(htmldata);
                                    });
                                });
                            });
                        </script>
                    </section>


                </div>
                <div class="col-md-12 panelDomainKhac" style=" ">

                    <section class="result-domain result-domain-khac">
                        <div id="appEndWhoisTenMienKhac" class="result-domain row"></div>
                        <div class="row" id="TenMienBaoVayVN">                    <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.vn</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu="quyen11212" data-tenmien="quyen11212.vn" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>830.000 VND/YEAR</p>
                                        <p><span class="pricenew">750.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; font-size: 12px;  display: block;">470.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.com.vn</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu="quyen11212" data-tenmien="quyen11212.com.vn" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>700.000 VND/YEAR</p>
                                        <p><span class="pricenew">630.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; font-size: 12px;  display: block;">350.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.net.vn</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu="quyen11212" data-tenmien="quyen11212.net.vn" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>700.000 VND/YEAR</p>
                                        <p><span class="pricenew">630.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; font-size: 12px;  display: block;">350.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row" id="TenMienBaoVay">


                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.xyz</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".xyz" data-tenmien="quyen11212.xyz" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>280.000 VND/YEAR</p>
                                        <p><span class="pricenew">19.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">280.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.top</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".top" data-tenmien="quyen11212.top" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>280.000 VND/YEAR</p>
                                        <p><span class="pricenew">39.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">280.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.com</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".com" data-tenmien="quyen11212.com" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>299.000 VND/YEAR</p>
                                        <p><span class="pricenew">99.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">299.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.net</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".net" data-tenmien="quyen11212.net" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>299.000 VND/YEAR</p>
                                        <p><span class="pricenew">99.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">299.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.info</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".info" data-tenmien="quyen11212.info" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>300.000 VND/YEAR</p>
                                        <p><span class="pricenew">199.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">300.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.biz</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".biz" data-tenmien="quyen11212.biz" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p></p>
                                        <p style="margin-top:8px;"><span class="pricenew">290.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">290.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.org</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".org" data-tenmien="quyen11212.org" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p>280.000 VND/YEAR</p>
                                        <p><span class="pricenew">199.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">280.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.company</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".company" data-tenmien="quyen11212.company" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p></p>
                                        <p style="margin-top:8px;"><span class="pricenew">505.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">505.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.co</span></strong>
                                        <div class="clearfix"></div>
                                        <p class="tim-hieu-them" id="quyen11212.co_co_show">Tìm hiểu thêm</p>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".co" data-tenmien="quyen11212.co" onclick="javascript: MuaDomainNay(this);
                                                    " class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p></p>
                                        <p style="margin-top:8px;"><span class="pricenew">820.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">820.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                    <div class="content-tim-hieu-them col-xs-12 col-sm-12 col-md-12" style="display:none;margin-top:10px;">
                                        <p onclick="$(this).parent( & #39; .content - tim - hieu - them & #39; ).hide()" class="close">x</p>
                                        Đăng  ký tối đa 5 năm
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 result-whois itemWhoisPopup wrap-detail-result-whois biz" id="Price-bizonminhthien">
                                <input id="TenMienChuaDangKy" class="ten-mien-chua-dang-ky" type="hidden">
                                <div class="domain-row row tenMienInfo">
                                    <div class="whois domain-name">
                                        <strong><span class="matbao-domain-whois wrapword">quyen11212</span><span class="matbao-domain-name">.shop</span></strong>
                                    </div>

                                    <div class="domain-button">
                                        <div class="button-mua-domain">
                                            <button data-idchitietdonhang="" data-madichvu=".shop" data-tenmien="quyen11212.shop" onclick="javascript: MuaDomainNay(this);" class="btn matbao-button whois-domain green tenMienDongNghia"> Select</button>
                                            <div class="mb-loadingaction-dangxuly" style="display:none;">
                                                <img src="./Kiểm tra tên miền_files/loading2EN.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="domain-price">
                                        <p></p>
                                        <p style="margin-top:8px;"><span class="pricenew">960.000</span> <span class="unit-price-whois pricenewUnit">VND/YEAR</span></p>
                                        <p style="margin-top:3px;"><span class="gia-gia-han" style=" color: #333; display: block;">960.000 <span>VND/YEAR for renewal</span></span></p>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </section>
                    <div class="result-domain" id="ActionCheckDomain" style="">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 footer">
                                <div class="row">
                                    <div class="row">
                                        <form id="pFormChonTenMienChoDichVu" action="https://www.matbao.net/TenMien/XoaLichSuWhois?Length=7" data-ajax="true" data-ajax-failure="OnActionFailure" data-ajax-method="POST" data-ajax-success="WhoisDomain" method="post" role="form"></form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script type="text/template" id="template_tenMien_Filter">

        <div class="col-md-12 col-sm-12 col-xs-12 result-whois tenMienInfo {{TenMienNoDot}} " id="{{TenMienNoDot}}">

        <div class="domain-row row ">

        <div class="whois domain-name no-price">
        <strong>
        <span class="matbao-domain-whois wrapword">{{ThongTin}}</span><span class="matbao-domain-name">{{TenMien}}</span>
        </strong>
        </div>
        <div class="domain-button">

        <div class=" visible-md-block visible-sm-block visible-lg-block button-mua-domain">
        <img id="loadingaction" src="/Content/images/loading.gif" style="background-color:#d1d1d1; display:block;" width="100%" />
        </div>
        <div class=" visible-xs-block pull-right checkdomain">

        <i class="matbao-checkwhois-search"></i>
        </div>
        </div>
        <div class="domain-price">
        <div class="col-md-8 col-sm-8 col-xs-12">&nbsp;</div>
        <div class="col-md-4 col-sm-4 col-xs-9 price">
        &nbsp;
        </div>
        </div>
        </div>
        </div>
    </script>

    <div class="modal fade edit-user-modal lading-page" id="CanTuVanModal" tabindex="-1" role="dialog" aria-labelledby="CanTuVanModal" aria-hidden="true">
        <div class="modal-dialog modal-sm popup popuptuvankhuyenmai">

            <div class="modal-content">
                <form id="FormCanTuVan" action="https://www.matbao.net/KhuyenMai/EmailDenMatBao?Length=0" data-ajax="true" data-ajax-failure="OnActionFailure" data-ajax-method="POST" data-ajax-success="CanTuVanSuccess" method="post" role="form"><input name="__RequestVerificationToken" type="hidden" value="EZgyXhmDPRvMsRHwfUHxYW7H2XBj3OqWiF_9JLlDxZwsH4QUG2TmodG2wK7sV67evCHYczhsRnHEM8Xb9bpRFZ53bZ78Sk7pike2QlmOLAY1">                <button type="button" class="close" data-dismiss="modal">×</button>
                    <p class="textcenter">
                        Vui lòng điền thông tin của bạn
                        <br>
                        Chúng tôi sẽ liên hệ lại tư vấn miễn phí
                    </p>
                    <div class="col-md-12">
                        <input type="text" placeholder="Họ và tên: " id="Name" name="Name">
                    </div>
                    <div class="col-md-12">
                        <input type="text" placeholder="Số điện thoại: " id="Phone" name="Phone">
                    </div>
                    <div class="col-md-12">
                        <input type="text" placeholder="Email: " id="Email" name="Email">
                    </div>
                    <div class="col-md-12">
                        <p>Chọn văn phòng tư vấn</p>
                        <div class="col-md-6">
                            <label>
                                <input id="VanPhong" name="VanPhong" type="radio" value="Miền Nam"> <span>Miền Nam</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label>
                                <input id="VanPhong" name="VanPhong" type="radio" value="Miền Bắc"> <span>Miền Bắc</span>
                            </label>
                        </div>
                    </div>
                    <input id="NoiDungTuVan" name="NoiDungTuVan" type="hidden" value="">                <div class="input-group-btn textcenter">
                        <input class="btn btn-default submitform button" value="Gửi" type="button">
                        <img id="loadingaction" src="./Kiểm tra tên miền_files/loading2EN.gif" style="display:none; background-color:#d1d1d1; padding:4px 10px">
                    </div>
                </form>        </div>
        </div>
    </div>


</div>