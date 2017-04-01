<?php
use WHMCS\Application;
use WHMCS\Config\Setting;
use WHMCS\Exception\ProgramExit;
use WHMCS\Product\Product;
use WHMCS\Session;
use WHMCS\User\Client;
require("../init.php");
require("../includes/domainfunctions.php");
define("CLIENTAREA",true); 
print_r(json_encode($_SESSION['cart']));exit;
//$smartyObj = $GLOBALS['smartyObj'];
//
//// get all assigned template vars
//$all_tpl_vars = $smarty->getTemplateVars();
//
//// take a look at them
//print_r($all_tpl_vars);exit;
////$email = $this->_tpl_vars['clientsdetails']['email'];
//
//
//
//print_r($smartyObj);exit;