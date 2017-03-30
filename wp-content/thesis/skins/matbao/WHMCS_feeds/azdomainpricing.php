<?php

require("../init.php");
require("../includes/domainfunctions.php");

/*
 * ** USAGE SAMPLES ***

  <style type="text/css">
  table.domainpricing {
  width: 600px;
  background-color: #ccc;
  }
  table.domainpricing th {
  padding: 3px;
  background-color: #efefef;
  font-weight: bold;
  }
  table.domainpricing td {
  padding: 3px;
  background-color: #fff;
  text-align: center;
  }
  </style>
  <script language="javascript" src="feeds/domainpricing.php?currency=1"></script>

 */

$code = '<div class="boxbanggiatenmien"><div class="container"><div class="row row-tenmien"><div class="col-sm-12 col-xs-12  text-center"><div class="title">Domain price list</div><div class="subtitle"><span>Register your trademark domain name for your customers to find you easier on the Internet.</span></div></div><div class="col-sm-12 col-xs-12"><div class="rowheader"><div class="col-sm-3 col-xs-4 title-mobile">INTERNATIONAL DOMAIN</div><div class="col-sm-3 col-xs-4">1st-year Registration fee</div><div class="col-sm-3 col-xs-4">Renewal fee</div><div class="col-sm-3 col-xs-4 hidden-xs">Transfer to Mat Bao</div></div>';



if (!is_numeric($currency)) {
    $currency = array();
} else {
    $currency = getCurrency('', $currency);
}

if (!$currency || !is_array($currency) || !isset($currency['id'])) {
    $currency = getCurrency();
}

$freeamt = formatCurrency(0);
$tldslist = getTLDList();
foreach ($tldslist AS $tld) {
    $tldpricing = getTLDPriceList($tld, true);
    $firstoption = current($tldpricing);
    $transfer = ($firstoption["transfer"] == $freeamt) ? $_LANG['orderfree'] : $firstoption["transfer"];
    $code .= sprintf('<div class="rowbody"><div class="col-sm-3 col-xs-4 wrapword"><strong>%s</strong></div><div class="col-sm-3 col-xs-4"> %s</div><div class="col-sm-3 col-xs-4"><strong> %s</strong> </div><div class="col-sm-3 col-xs-4 hidden-xs"> %s </div></div>',
        htmlspecialchars($tld, ENT_QUOTES, 'UTF-8'), htmlspecialchars($firstoption["register"], ENT_QUOTES, 'UTF-8'), htmlspecialchars($firstoption["renew"], ENT_QUOTES, 'UTF-8'),htmlspecialchars($transfer, ENT_QUOTES, 'UTF-8')
    );
}

$code .= '</div></div><div class="clearfix"></div><div class="row"><div class="col-sm-12 col-xs-12 text-center"><a href="/dang-ky-ten-mien" class="btn-reg-domain-now">Register Now</a></div><div class="col-sm-12 col-xs-12 text-center"><a href="javascript:XemThemBangGiaTenMien();" class="xemthembanggia btn-xem-tiep"><p>More details</p><img src="/public/images/see-more.png" alt="mat bao" /></a><a class="thugonbanggia btn-xem-tiep" href="javascript:ThuGonBangGiaTenMien();" style="display:none" title="Thu gọn"><img alt="mat bao" src="/public/images/more-info-white-revert.png"></a></div></div></div></div>';

echo "document.write('".$code."');";

