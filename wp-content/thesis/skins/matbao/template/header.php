<?php

/**

 * Created by PhpStorm.

 * User: vancuong

 * Date: 16/11/2016

 * Time: 0:51

 * Template header.

 */
require_once 'whmcs.class.php';
$whmcs = new WHMCS('http://account.stormeyes.com/includes/api.php', 'admin', '12345678','');

//DomainWhois
//$result= $whmcs->domainWhois('quyenabasdf.com');
//print_r($result);exit;

//Authentication
//$result=$whmcs->authenticate('quyendv@matbao.com', '12345678');
//$result=$whmcs->getProducts();
//$json= json_encode($result);
//print_r($json);exit;
//$array= json_decode(json_encode($result),true);
//print_r($array);exit;
//
//test Reseller club api
//https://test.httpapi.com/api/domains/available.json?auth-userid=688471&api-key=5Yr1rv2t9udXBK4e77Aq4IWg7XpBdPfO&domain-name=quyensdf1&domain-name=domain2&tlds=com&tlds=net
// echo "Quyen";
//$reseller_apikey="5Yr1rv2t9udXBK4e77Aq4IWg7XpBdPfO";
//$resellerid="688471";
//$domain_name="quyen9098sdf.com";
//$rmls_reseller_apiurl = 'https://httpapi.com';
//  $ch = curl_init();
//  curl_setopt($ch, CURLOPT_URL, $reseller_apiurl .'/api/domains/available.json?auth-userid=' .$resellerid. '&api-key=' . $reseller_apikey .'&domain-name='.$domain_name.'&tlds=com');
//  curl_setopt($ch, CURLOPT_VERBOSE, 1);
//  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//  $httpResponse = curl_exec($ch);
//  $json = json_decode($httpResponse, true);
// 
//  print_r($httpResponse);exit;
//  return $json;
?>
  <style>
                @media screen and (min-width:480px) {
                    .mb-sub-menu {
                        max-height: 225px;
                        overflow-y: auto;
                    }
                }
            </style>
            <section class="visible-sm-block visible-md-block visible-lg-block">
                <a target="_blank" href="/khuyen-mai/khuyen-mai-ten-mien.html">
                    <img style="width:100%;" src='/public/images/KhuyenMai/TopT32017.png' alt="matbao network" />
                </a>

            </section>



            <section class="bg-primary mb-header visible-sm-block visible-md-block visible-lg-block">
                <div class="container">
                    <div style="position:relative">
                        <div class="pull-left">
                            <a href="">
                                <img src='/public/images/logo-cut.png' alt="matbao network" />
                            </a>
                        </div>

                        <div class="pull-right">
                            <ul>
                                <li style="float: left;" id="lilogin">
                                    <a id="matbao-login" rel="nofollow" href="javascript:;">
                                        <img src="/public/images/account.png" alt="matbao network" />
                                        Sign into my account
                                    </a>
                                    <div class="sub-top-menu">
                                        <div class="col-md-12 col-sm-12 login">

                                            <div class="col-md-12 col-sm-12 register-right">
                                                <div class="col-md-12 col-sm-12 label">
                                                    <span>Sign into my account</span>
                                                </div>
                                                <form ID="pFormLogin" action="/Home/DangNhapMobileAction" data-ajax="true" data-ajax-failure="OnActionFailure" data-ajax-method="POST" data-ajax-success="OnActionSuccess" id="form2" method="post" role="form">                                            <div class="col-md-12 col-sm-12 control">
                                                        <input class="form-control" id="TenDangNhapMobile" name="TenDangNhapMobile" placeholder="ID/ User name" type="text" value="" />
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 control">
                                                        <input class="form-control" id="MatKhauMobile" name="MatKhauMobile" placeholder="Password" type="password" />
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <input type="button" onclick="javascript: window.location.href = 'https://id.matbao.net/ForgotPassword.aspx'" class="btn home-button home-forgot pull-left" value="Forgotten my password" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <input type="button" class="btn home-button pull-right btn-login submitform" value="Sign in" />
                                                                <img id="loadingaction" src="/public/images/loading2.gif" style="background-color: rgb(209, 209, 209);float: right;padding: 0 7px;height: 50px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>                                    </div>
                                        </div>
                                    </div>
                                </li>
                                <li style="float: right;">
                                    <a rel="nofollow" href="">
                                        <img src="/public/images/cart.png" alt="matbao network" />
                                        My cart
                                        <span class="badge" id="SoLuongGioHang" style="background-color: #ff4343"></span>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-primary mb-menu">
                <div class="container">
                    <div id="header-row" class="row">
                        <nav class="navbar navbar-default fix-menu-mobile">
                            <div class="navbar-header">
                                <a class="visible-xs-block" href="/" id="logo-mobile"><img src="/public/images/logo-matbao-mobile.png" alt="" style="display:inline-block;margin-top:14px;"></a>
                                <div class="pull-left visible-xs-block" style="line-height:50px">
                                    <button type="button" class="navbar-toggle collapsed left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" id="menu-mb-main" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div id="wrap-login-id" class="pull-right visible-xs-block" style="line-height:50px">
                                    <a href="javascript:;" id="mb-a-login-info" style="position: absolute;right: 37px;"><img src="/public/images/account-white.png" style="padding: 0 10px;" alt="" /></a>
                                    <a href="" style="position:absolute; right:15px;"><span class="badge" id="SLGioHangMobile" style="position: absolute; right: 10px; background-color: #363636;top:8px; right:-7px;"></span><img src="/public/images/cart-white.png" alt="" /></a>
                                    <div id="mb-div-login-info" class="mb-sub-menu" style="display:none;">
                                        <div>
                                            <div class="container account">
                                                <div class="form-login">
                                                    <div class="label-login row">
                                                        <span class="label">Sign into my account</span>
                                                    </div>
                                                    <form ID="pFormLogin" action="/Home/DangNhapAction" data-ajax="true" data-ajax-failure="OnActionFailure" data-ajax-method="POST" data-ajax-success="OnActionSuccess" id="form3" method="post" role="form">                                                <div class="form-input">
                                                            <input class="matbao-textbox" id="TenDangNhap" name="TenDangNhap" placeholder="ID hoặc tên người dùng" type="text" value="" />
                                                            <input class="matbao-textbox" id="MatKhau" name="MatKhau" placeholder="Mật khẩu" type="password" />
                                                        </div>
                                                        <div class="row form-button">
                                                            <div class="col-xs-6 pull-left">
                                                                <span onclick="javascript: window.location.href = 'https://id.matbao.net/ForgotPassword.aspx'">Forgotten my password</span>
                                                            </div>
                                                            <div class="col-xs-6 pull-right">
                                                                <input type="button" class="input-group-addon btn-login submitform" value="Sign in" />
                                                            </div>
                                                        </div>
                                                    </form>                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse navbar-collapse menu-padding" id="bs-example-navbar-collapse-1">
                                <div id="header-row-nav">
                                    <ul class="nav navbar-nav full-width">
                                        <li>
                                            <a href="javascript:;">DOMAINS</a>
                                            <div class="sub-top-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="panel panel-default">
                                                            <div class="wrap-menu">
                                                                <div class="panel-heading">
                                                                    <h3 class="home-title-partner home-title-menu title-white">DOMAINS</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="col-md-3 col-sm-3 block-one title-white ">
                                                                        <div class="row">
                                                                            <span class="title-white">
                                                                                A domain name is not only an address of your company, but also your online trademark. Owning a domain name can also help direct your customers to you instead of your rival. Therefore, Mat Bao Corp will help you find your most appropriate domain name.
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3 menu-color ">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Register or Transfer</strong></p>
                                                                        <ul>
                                                                            <li><a href="/dang-ky-ten-mien"><span>Register a new domain name</span></a></li>
                                                                            <li><a href="/chuyen-doi-nha-cung-cap"><span>Domain transfer</span></a></li>
                                                                            <li><a href="/bang-gia-ten-mien"><span>Domain price list</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3 title-white">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Tools</strong></p>
                                                                        <ul>
                                                                            <li><a href="/ten-mien/dang-ky-ten-mien-moi.html"><span>New domain search</span></a></li>
                                                                            <li><a href="/ten-mien/dang-ky-ten-mien.html?m=true"><span>Bulk domain search</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class=" col-md-3 col-sm-3 title-white">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Value Added Services</strong></p>
                                                                        <ul>
                                                                            <li><a href="/bao-mat-thong-tin-chu-the"><span>Domain holder’s information security </span></a></li>
                                                                            <li><a href="/dns-mien-phi.html"><span>Free DNS</span></a></li>
                                                                            <li><a href="/dns-pro.html"><span>DNS Pro</span></a></li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:;">CLOUD HOSTING</a>
                                            <div class="sub-top-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="panel panel-default">
                                                            <div class="wrap-menu">
                                                                <div class="panel-heading">
                                                                    <h3 class="home-title-partner home-title-menu title-white">HIGH QUALITY HOSTING</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="col-md-4 col-sm-4 block-one title-white">
                                                                        <div class="row">
                                                                            <span>
                                                                                Hosting allows your websites to operate on the internet environment. Mat Bao Cloud Hosting will meet most of your requirements for your web page with efficiency up to 99.9% and safe storing.

                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3  menu-color">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Cloud Hosting</strong></p>
                                                                        <ul>
                                                                            <li><a href="./cloud-hosting-linux.html"><span>Cloud Linux Hosting</span></a></li>
                                                                            <li><a href="/hosting/cloud-wordpress-hosting.html"><span>Cloud Wordpress Hosting</span></a></li>
                                                                            <li><a href="/hosting/cloud-hosting-windows.html"><span>Cloud Windows Hosting</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Cloud Server</strong></p>
                                                                        <ul>
                                                                            <li><a href="/cloud-server-linux.html"><span>Cloud Server Linux</span></a></li>
                                                                            <li><a href="/cloud-server.html"><span>Cloud Server Windows</span></a></li>
                                                                            <li><a href="/may-chu/dich-vu-quan-tri-may-chu.html"><span>Managed Server</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:;">CHILI WEB</a>
                                            <div class="sub-top-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="panel panel-default">
                                                            <div class="wrap-menu">
                                                                <div class="panel-heading">
                                                                    <h3 class="home-title-partner home-title-menu title-white">CHILI Web</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="col-md-4 col-sm-4 block-one title-white">
                                                                        <div class="row">
                                                                            <span>
                                                                                Think web, say CHILI. CHILI websites meet over 90% demand on E-commerce and Company Websites (introduce company portfolios), operated on the Cloud Computing Platform excellent in all aspects.

                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-2  menu-color">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>General Info</strong></p>
                                                                        <ul>
                                                                            <li><a href="https://www.chili.us/article/about-chili-12" target="_blank"><span>About CHILI</span></a></li>
                                                                            <li><a href="https://www.chili.us/compare-features" target="_blank"><span>Compare Features</span></a></li>
                                                                            <li><a href="https://www.chili.us/web-features" target="_blank"><span>Salient Features</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-2">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Templates</strong></p>
                                                                        <ul>
                                                                            <li><a href="https://www.chili.us" target="_blank"><span>CHILI Free</span></a></li>
                                                                            <li><a href="https://www.chili.us/web-business" target="_blank"><span>CHILI Comp</span></a></li>
                                                                            <li><a href="https://www.chili.us/web-online-store" target="_blank"><span>CHILI Shop</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="./email.html">EMAIL PRO</a></li>
                                        <li>
                                            <a href="javascript:;">CLOUD SERVER</a>
                                            <div class="sub-top-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="panel panel-default">
                                                            <div class="wrap-menu">
                                                                <div class="panel-heading">
                                                                    <h3 class="home-title-partner home-title-menu title-white">CLOUD SERVER</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="col-md-4 col-sm-4 block-one title-white">
                                                                        <div class="row">
                                                                            <span>
                                                                                Virtual Private Servers (VPS) are operated on the Cloud Computing infrastructure with the premium hardware configuration, always prior to serve you the best.
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3  menu-color">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Cloud Server</strong></p>
                                                                        <ul>
                                                                            <li><a href="/cloud-server-linux.html"><span>Cloud Server Linux</span></a></li>
                                                                            <li><a href="/cloud-server.html"><span>Cloud Server Windows</span></a></li>
                                                                            <li><a href="/may-chu/dich-vu-quan-tri-may-chu.html"><span>Managed Server</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:;">SSL</a>
                                            <div class="sub-top-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="panel panel-default">
                                                            <div class="wrap-menu">
                                                                <div class="panel-heading">
                                                                    <h3 class="home-title-partner home-title-menu title-white">SSL CERTIFICATES</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="col-md-4 col-sm-4 block-one title-white">
                                                                        <div class="row">
                                                                            <span>
                                                                                The websites secured by Secure Sockets Layer Certificates (SSL) will display the prefix https://. This makes your customers trust you and your business, for you are protected by reliable and branded certificate providers. Mat Bao believe that our SSL from those leading brands will meet your requirements and your customers’ expectation.
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6  menu-color">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Website security</strong></p>
                                                                        <ul>
                                                                            <li><a href="./geotrust-ssl.html"><span>GeoTrust SSL</span></a></li>
                                                                            <li><a href="/bao-mat-website/comodo-ssl.html"><span>Comodo SSL</span></a></li>
                                                                            <li><a href="/bao-mat-website/symantec-ssl.html"><span>Symantec SSL</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="javascript:;">PARTNERS</a>
                                            <div class="sub-top-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="panel panel-default">
                                                            <div class="wrap-menu">
                                                                <div class="panel-heading">
                                                                    <h3 class="home-title-partner home-title-menu title-white">PARTNERS</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="col-md-4 col-sm-4 block-one title-white">
                                                                        <div class="row">
                                                                            <span>
                                                                                You are provided the best platform for managing your business with the latest features.
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3  menu-color">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong>Resellers</strong></p>
                                                                        <ul>
                                                                            <li><a href="/doi-tac/dai-ly.html"><span>Reseller Policy</span></a></li>
                                                                            <li><a href="/doi-tac/dich-vu-tra-truoc.html"><span>Prepaid Services</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li> <a href="/ho-tro.html">SUPPORT</a></li>
                                        <li> <a href="/khuyen-mai/thong-tin-khuyen-mai-tong-hop.html">PROMOTION</a></li>
                                        <i class="icon-khuyen-mai-hot hidden-xs"></i>
                                        <li class="visible-xs-block">
                                            <a href="javascript:;">TIN TỨC</a>
                                            <div class="sub-top-menu">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="panel panel-default">
                                                            <div class="wrap-menu">
                                                                <div class="panel-heading">
                                                                    <h3 class="home-title-partner home-title-menu title-white"></h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="col-md-4 col-sm-4 block-one title-white">
                                                                        <div class="row">
                                                                            <span>


                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3  menu-color">
                                                                        <p class="matbao-text-roboto sub-title-menu title-white"><strong></strong></p>
                                                                        <ul>
                                                                            <li><a href="/tin-cong-nghe.html"><span>Tin c&#244;ng nghệ</span></a></li>
                                                                            <li><a href="/tin-cong-ty.html"><span>Tin c&#244;ng ty</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="visible-xs-block"> <a href="/lien-he.html">CONTACT</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </section>


            <div class="wrap-gio-hang-scroll hidden-xs" style="display:none;">


                <div class="gio-hang-scroll hidden-xs">
                    <a rel="nofollow" href="">
                        <img src="/public/images/icon-cart-only.png" alt="gio hang" />
                        <span class="badge" id="SoLuongGioHangScroll" style="background-color: #ff4343"></span>
                    </a>
                </div>
            </div>
    