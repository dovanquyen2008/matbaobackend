<?php
function cc_whmcs_bridge_parser_css($css) {
    $input=file_get_contents($css);
    $s='';
    $output='';
    $comments=false;
    for ($i=0; $i < strlen($input); $i++) {
        if ($input[$i]=='/' && $input[$i+1]=='*') {
            $comments=true;
            $output.=$s;
            $s='';
        }
        if ($input[$i]=='*' && $input[$i+1]=='/') {
            $comments=false;
            $output.=$s.'*/';
            $i+=2;
            $s='';
        }
        if (!$comments) {
            if ($input[$i]==',') {
                $output.='#bridge '.$s.',';
                $s='';
            } elseif ($input[$i]=='{') {
                $output.='#bridge '.$s.'{';
                $s='';
            } elseif ($input[$i]=='}') {
                $output.=$s.'}';
                $s='';
            } else {
                $s.=$input[$i];

            }
        } else {
            $s.=$input[$i];

        }
    }
    return $output;
}

function cc_whmcs_bridge_parser_ajax1($buffer, $page_to_include = '') {
    $cache_setting = (int)get_option("cc_whmcs_bridge_sso_cache");
    $url = (isset($_REQUEST['js'])) ? $_REQUEST['js'] : '';

    cc_whmcs_bridge_home($home, $pid);

    // java
    $buffer = str_replace('ARCHIVE="modules', 'ARCHIVE="'.cc_whmcs_bridge_url().'/modules', $buffer);

    // quantumvault fix added
    if (stristr($page_to_include, 'cart') !== false || stristr($page_to_include, 'quantumvault') !== false || stristr($page_to_include, 'protxthreedsecure') !== false) {
        $whmcs = cc_whmcs_bridge_url();

        if (substr($whmcs, -1) != '/') $whmcs .= '/';

        if (strpos($whmcs, 'https://') === 0) $whmcs = str_replace('https://', 'http://', $whmcs);
        $whmcs2 = str_replace('http://', 'https://', $whmcs);
        $whmcs3 = str_replace('http:', '', $whmcs);

        $whmcs_path = parse_url(cc_whmcs_bridge_url(), PHP_URL_PATH);
        if (substr($whmcs_path, -1) != '/')
            $whmcs_path .= '/';

        $loop = array();
        $loop[$whmcs] = $whmcs;
        if (!is_null($whmcs2))
            $loop[$whmcs2] = $whmcs2;
        if (!is_null($whmcs3))
            $loop[$whmcs3] = $whmcs3;
        if ($whmcs_path != '')
            $loop[$whmcs_path] = $whmcs_path;
        $loop[''] = '';

        // FULL URLS

        foreach ($loop as $rep_url) {
            // templates css/js
            $f[] = "/src=\"" . preg_quote($rep_url, '/') . "templates\/([a-zA-Z0-9]*?)\/js\/([a-zA-Z0-9]*?).js/";
            $r[] = "src=\"{$home}js/?ajax=1&js=" . 'templates/$1/js/$2.js' . $pid;

            $f[] = "/href=\"" . preg_quote($rep_url, '/') . "templates\/([a-zA-Z0-9]*?)\/css\/([a-zA-Z0-9]*?).css/";
            $r[] = "href=\"{$home}js/?ajax=1&js=" . 'templates/$1/css/$2.css' . $pid;

            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'value="' . $home . '?ccce=$1' . $pid . '"';

            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php.(.*?)\"/';
            $r[] = 'value="' . $home . '?ccce=$1&$2' . $pid . '"';

            $f[] = '/action\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php.(.*?)\"/';
            $r[] = 'action="' . $home . '?ccce=$1&$2' . $pid . '"';

            $f[] = '/href\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'href="' . $home . '?ccce=$1' . $pid . '"';

            $f[] = '/href\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\?((?:(?!phpinfo|").)*)\"/';
            $r[] = 'href="' . $home . '?ccce=$1&$2' . $pid . '"';

            $f[] = '/href\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'href="' . $home . '?ccce=$1' . $pid . '"';

            //$f[]='/'.preg_quote($rep_url,'/').'([a-zA-Z0-9\_]*?).php/';
            //$r[]=''.$home.'?ccce=$1'.$pid;

            // Payment Gateways
            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . 'modules\/gateways\/([a-zA-Z0-9]*?)\/([a-zA-Z0-9]*?).php.(.*?)\"/';
            $r[] = 'value="' . $home . '?ajax=1&ccce=modules/gateways/$1/$2&$3"';

            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . 'modules\/gateways\/([a-zA-Z0-9]*?)\/([a-zA-Z0-9]*?).php/';
            $r[] = 'value="' . $home . '?ajax=1&ccce=modules/gateways/$1/$2';
        }

    }

    //replaces whmcs jquery so that it doesn't start it twice
    if (in_array(get_option('cc_whmcs_bridge_jquery'), array('checked', 'wp'))) {
        $buffer = preg_replace('/<script.*jquery.js"><\/script>/', '', $buffer);
        $buffer = preg_replace('/<script.*jquery.min.js"><\/script>/', '', $buffer);
        $buffer = preg_replace('/<script.*jqueryui.js"><\/script>/', '', $buffer);
    }

    $whmcs_path = parse_url(cc_whmcs_bridge_url(), PHP_URL_PATH);
    if (substr($whmcs_path, -1) != '/')
        $whmcs_path .= '/';

    // six
    $f[] = "/src=\"" . preg_quote($whmcs_path, '/') . "assets\//";
    $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'assets/$1' . $pid;

    $f[] = "/href=\"" . preg_quote($whmcs_path, '/') . "assets\//";
    $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'assets/$1' . $pid;

    // wbteampro
    $f[] = "/src=\"modules\//";
    $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'modules/$1' . $pid;

    $f[] = "/templates\/orderforms\/([a-zA-Z0-9]*?)\/js\/main.js/";
    $r[] = $home . "?ccce=js&ajax=2&js=" . 'templates/orderforms/$1/js/main.js' . $pid;

    ## BootWHMCS
    $f[] = "/templates\/orderforms\/([a-zA-Z0-9]*?)\/static\/app.js/";
    $r[] = $home . "?ccce=js&ajax=2&js=" . 'templates/orderforms/$1/static/app.js' . $pid;
    ## BootWHMCS

    $f[] = '/href\=\"([a-zA-Z0-9\_]*?).php\?(.*?)\"/';
    $r[] = 'href="' . $home . '?ccce=$1&$2' . $pid . '"';

    $f[] = "/jQuery.post\(\"([a-zA-Z0-9]*?).php/";
    $r[] = "jQuery.post(\"$home?ccce=$1&ajax=1";

    $f[] = "/window.location\='([a-zA-Z0-9\_]*?).php.(.*?)'/";
    $r[] = "window.location='" . $home . "?ccce=$1&$2" . $pid . "'";
    // six
    $f[] = "/window.location\ \=\ '([a-zA-Z0-9\_]*?).php.(.*?)'/";
    $r[] = "window.location='" . $home . "?ccce=$1&$2" . $pid . "'";

    $f[] = "/'([a-zA-Z0-9\_]*?).php'/";
    $r[] = "'" . $home . "?ccce=$1" . $pid . "'";

    $f[] = "/\"([a-zA-Z0-9\_]*?).php\"/";
    $r[] = "\"" . $home . "?ccce=$1" . $pid . "\"";

    $f[] = "/'([a-zA-Z0-9\_]*?).php.(.*?)'/";
    $r[] = "'" . $home . "?ccce=$1&$2" . $pid . "'";

    $f[] = "/\"([a-zA-Z0-9\_]*?).php.(.*?)\"/";
    $r[] = "\"" . $home . "?ccce=$1&$2" . $pid . "\"";
    // six

    $buffer = preg_replace($f, $r, $buffer, -1, $count);

    //verify captcha image
    $buffer = str_replace('"includes/verifyimage.php?', '"' . $home . '?ccce=verifyimage' . $pid . '&', $buffer);

    $bridge_url = cc_whmcs_bridge_url();
    $bridge_url = str_replace('https:', '', $bridge_url);
    $bridge_url = str_replace('http:', '', $bridge_url);

    $buffer = str_replace('url(images', 'url(' . $bridge_url . '/images', $buffer);
    $buffer = str_replace('src="includes', 'src="' . $bridge_url . '/includes', $buffer);
    $buffer = str_replace('src="images', 'src="' . $bridge_url . '/images', $buffer);
    $buffer = str_replace('background="images', 'background="' . $bridge_url . '/images', $buffer);
    $buffer = str_replace('href="templates', 'href="' . $bridge_url . '/templates', $buffer);
    $buffer = str_replace('src="templates', 'src="' . $bridge_url . '/templates', $buffer);


    // six
    if (isset($_REQUEST['js']) && (stristr($_REQUEST['js'], 'assets') !== false && stristr($_REQUEST['js'], '.css') !== false)) {
        $path = pathinfo($_REQUEST['js']);
        $relative_dir = $path['dirname'];
        $buffer = str_replace('url(..', 'url(' . $bridge_url . '/' . $relative_dir . '/..', $buffer);
        $buffer = str_replace('url(' . $bridge_url . '/' . $relative_dir . '///', 'url(//', $buffer);

        $buffer = str_replace('\'../fonts/', "'".$bridge_url . '/assets/fonts/', $buffer);
    }

    // icheck
    if (isset($_REQUEST['js']) && (stristr($_REQUEST['js'], 'icheck') !== false && stristr($_REQUEST['js'], '.css') !== false)) {
        $buffer = str_replace('url(', 'url(' . $bridge_url . '/' . $relative_dir . '/', $buffer);
    }

    if (isset($_REQUEST['js']) && stristr($_REQUEST['js'], '.css') !== false) {
        $tmp_path = pathinfo($_REQUEST['js'], PATHINFO_DIRNAME);
        $buffer = str_replace("url(blue@2x.png)", "url({$bridge_url}/{$tmp_path}/blue@2x.png)", $buffer);
        $buffer = str_replace("url(blue.png)", "url({$bridge_url}/{$tmp_path}/blue.png)", $buffer);
    }
    // virtualizor
    $buffer = str_replace("'src', 'modules/", "'src', '".$bridge_url . "/modules/", $buffer);

    // boleto
    $buffer = str_replace('src=imagens', 'src=' . $bridge_url . '/modules/gateways/boleto/imagens', $buffer);
    $buffer = str_replace('src="imagens', 'src="' . $bridge_url . '/modules/gateways/boleto/imagens', $buffer);
    $buffer = str_replace('SRC="imagens', 'src="' . $bridge_url . '/modules/gateways/boleto/imagens', $buffer);

    if (isset($_REQUEST['js']) && (stristr($_REQUEST['js'], '.css') !== false && stristr($_REQUEST['js'], 'templates') !== false
        || (isset($_REQUEST['give']) && stristr($_REQUEST['give'], '.css') !== false))
    ) {
        $path = pathinfo($_REQUEST['js']);
        $relative_dir = $path['dirname'];
        $buffer = str_replace('url(..', 'url(' . $bridge_url . '/' . $relative_dir . '/..', $buffer);
        $buffer = str_replace('url(\'', 'url(\'' . $bridge_url . '/' . $relative_dir . '/', $buffer);
        $buffer = str_replace('url("', 'url("' . $bridge_url . '/' . $relative_dir . '/', $buffer);
        $buffer = str_replace('url("' . $bridge_url . '/' . $relative_dir . '///fonts', 'url("//fonts', $buffer);
        $buffer = str_replace('url("' . $bridge_url . '/' . $relative_dir . '/https://fonts', 'url("https://fonts', $buffer);
    }

    if (isset($_REQUEST['js']) && stristr($_REQUEST['js'], 'servers/solusvmpro') !== false) {
        $buffer = str_replace('url: "modules', 'url: "'.$home.'?ccce=js&ajax=1&js=modules', $buffer);
    }

    $buffer = str_replace('"cart.php"', '"' . $home . '?ccce=cart' . $pid . '"', $buffer);
    $buffer = str_replace('"cart.php?', '"' . $home . '?ccce=cart' . $pid . '&"', $buffer);
    $buffer = str_replace("'cart.php?", "'" . $home . "?ccce=cart" . $pid . '&', $buffer);

    //jQuery UI
    $buffer = str_replace('href="includes/jscript/css/ui.all.css', 'href="' . cc_whmcs_bridge_url() . '/includes/jscript/css/ui.all.css', $buffer);

    // virtualizor 
    if (isset($_REQUEST['give'])) {
        $buffer = str_replace('href="modules', 'href="'.cc_whmcs_bridge_url().'/modules', $buffer);
    }

    if (strstr($url, '?') !== false) {
        $test = explode('?', $url);
        $test = $test[0];
    } else {
        $test = $url;
    }

    cc_whmcs_log(0, '[C] Checking ' . $test);

    if (is_numeric($cache_setting) && $cache_setting > 0 && (
            substr($test, -4) == '.css' ||
            substr($test, -3) == '.js' ||
            substr($test, -4) == '.png' ||
            substr($test, -4) == '.jpg' ||
            substr($test, -5) == '.jpeg' ||
            substr($test, -4) == '.gif'
        )
    ) {
        $cache_dir = dirname(__FILE__) . '/../cache/';

        if (file_exists($cache_dir) && is_writable($cache_dir)) {
            $extension = pathinfo($test, PATHINFO_EXTENSION);

            $filename = md5($url) . '_parsed_' . strtotime('+' . $cache_setting . ' minutes').'.'.$extension;

            file_put_contents($cache_dir . $filename, $buffer);
            cc_whmcs_log(0, '[1] Parse cache written for ' . $url);
            // log cached file
            cc_update_cache($url, $filename);
        }
    }

    return $buffer;
}

function cc_whmcs_bridge_parser_ajax2($buffer) {
    $cache_setting = (int)get_option("cc_whmcs_bridge_sso_cache");
    $url = (isset($_REQUEST['js'])) ? $_REQUEST['js'] : '';

    cc_whmcs_bridge_home($home, $pid);

    $f[] = "/.post\(\"([a-zA-Z0-9]*?).php/";
    $r[] = ".post(\"$home?ccce=$1&ajax=2";

    $f[] = "/.post\('([a-zA-Z0-9]*?).php/";
    $r[] = ".post('$home?ccce=$1&ajax=2";

    $f[] = '/document.location\=\"([a-zA-Z0-9\_]*?).php.(.*?)\"/';
    $r[] = 'document.location="' . $home . '?ccce=$1&$2' . $pid . '"';

    $f[] = '/window.open\(\"([a-zA-Z0-9\_]*?).php.(.*?)\"/';
    $r[] = 'window.open("' . $home . '?ajax=1&ccce=$1&$2' . $pid . '"';

    $buffer = preg_replace($f, $r, $buffer, -1, $count);

    $buffer = str_replace('wbteampro.php?', $home . '?ccce=wbteampro&', $buffer);
    $buffer = str_replace('wbteampro.php', $home . '?ccce=wbteampro', $buffer);

    $buffer = str_replace('"cart.php"', '"' . $home . '?ccce=cart' . $pid . '"', $buffer);
    $buffer = str_replace("'cart.php?", "'" . $home . "?ccce=cart" . $pid . '&', $buffer);

    $buffer = str_replace('url(images', 'url(' . cc_whmcs_bridge_url() . '/images', $buffer);
    $buffer = str_replace('src="includes', 'src="' . cc_whmcs_bridge_url() . '/includes', $buffer);
    $buffer = str_replace('src="images', 'src="' . cc_whmcs_bridge_url() . '/images', $buffer);
    $buffer = str_replace('background="images', 'background="' . cc_whmcs_bridge_url() . '/images', $buffer);
    $buffer = str_replace('href="templates', 'href="' . cc_whmcs_bridge_url() . '/templates', $buffer);
    $buffer = str_replace('src="templates', 'src="' . cc_whmcs_bridge_url() . '/templates', $buffer);

    $buffer = str_replace('ajax=2?', 'ajax=2&', $buffer);


    if (strstr($url, '?') !== false) {
        $test = explode('?', $url);
        $test = $test[0];
    } else {
        $test = $url;
    }

    if (is_numeric($cache_setting) && $cache_setting > 0 && (
            substr($test, -4) == '.css' ||
            substr($test, -3) == '.js' ||
            substr($test, -4) == '.png' ||
            substr($test, -4) == '.jpg' ||
            substr($test, -5) == '.jpeg' ||
            substr($test, -4) == '.gif'
        )
    ) {
        $cache_dir = dirname(__FILE__) . '/../cache/';

        if (file_exists($cache_dir) && is_writable($cache_dir)) {
            $extension = pathinfo($test, PATHINFO_EXTENSION);

            $filename = md5($url) . '_parsed_' . strtotime('+' . $cache_setting . ' minutes').'.'.$extension;
            file_put_contents($cache_dir . $filename, $buffer);
            cc_whmcs_log(0, 'Parse cache written for ' . $url);
            // log cached file
            cc_update_cache($url, $filename);
        }
    }

    return $buffer;

}

function cc_whmcs_bridge_home(&$home,&$pid,$current=false) {
    global $wordpressPageName,$post;

    if (isset($post) && $current) {
        $pageID = $post->ID;
        $permalink = get_permalink();
        preg_match('/(.*)\?page_id\=(.*)/',$permalink,$matches);
        if (count($matches)==2) {
            $pid='&page_id='.$matches[2];
            $home=$matches[1];
            $url=$permalink;
        } else {
            $pid='';
            $url=$home=$permalink;
        }
    } else {
        $pageID = cc_whmcs_bridge_mainpage();

        if (get_option('permalink_structure')){
            $homePage = get_option('home');

            $wordpressPageName = get_permalink($pageID);

            if (stristr($homePage, 'http://') !== false)
                $homePage2 = str_replace('http://', 'https://', $homePage);
            else
                $homePage2 = str_replace('https://', 'http://', $homePage);

            $wordpressPageName = str_replace(array($homePage, $homePage2),"",$wordpressPageName);

            $pid="";

            $home=$homePage.$wordpressPageName;

            if (substr($home,-1) != '/') $home.='/';
            $url=$home;
        } else {
            $pid='&page_id='.$pageID;
            $home=get_option('home');
            if (substr($home,-1)!='/') $home.='/';
            $url=$home.'?page_id='.$pageID;
        }
    }

    cc_whmcs_log(0, 'Getting home ');

    if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE && function_exists('icl_get_home_url')) {
        cc_whmcs_log(0, 'ICL Detected');

        if ($pid=='') {
            $iclHomeUrl=icl_get_home_url();

            if (substr($iclHomeUrl, -1) == '/') {
                $iclHomeUrl = substr($iclHomeUrl, 0, -1);
            }
            if (substr($wordpressPageName, -1) == '/')
                $wpPg = substr($wordpressPageName, 0, -1);
            else
                $wpPg = $wordpressPageName;

            $home_parts = explode('/', $iclHomeUrl);
            $page_parts = explode('/', $wpPg);

            if ($home_parts[count($home_parts)-1] != $page_parts[1]) {
                $home = $iclHomeUrl . $wordpressPageName;
            }
        }
    }


    if ((isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on")) || get_option('cc_whmcs_bridge_sso_force_ssl')) {
        $url = str_replace('http://','https://',$url);
        $home = str_replace('http://','https://',$home);
    }

    return $url;
}

function cc_whmcs_bridge_parser($buffer=null,$current=false) {
    global $cc_whmcs_bridge_menu;
    global $cc_whmcs_bridge_to_include,$wp;


    $ref = rand(100,999);

    cc_whmcs_log(0, '['.$ref.'] Parser triggered.');

    cc_whmcs_bridge_home($home,$pid,$current);

    if (!$buffer) {
        cc_whmcs_log(0, '['.$ref.'] Parser fetching buffer.');
        $buffer=cc_whmcs_bridge_output();
        cc_whmcs_log(0, '['.$ref.'] Parser buffer fetch completed.');
    }

    $tmp=explode('://',cc_whmcs_bridge_url(),2);
    $tmp2=explode('/',$tmp[1],2);
    $sub=str_replace($tmp[0].'://'.$tmp2[0],'',cc_whmcs_bridge_url()).'/';
    $secure='&sec=1';

    $whmcs=cc_whmcs_bridge_url();

    if (substr($whmcs,-1) != '/') $whmcs.='/';

    if (strpos($whmcs,'https://')===0) $whmcs=str_replace('https://','http://',$whmcs);
    $whmcs2=str_replace('http://','https://',$whmcs);
    $whmcs3=str_replace('http:', '', $whmcs);

    $html = new iplug_simple_html_dom();
    $html->load($buffer);
    $page_title = $html->find('title', 0);
    if (is_object($page_title) && isset($page_title->plaintext)) {
        $ret['page_title'] = $page_title->plaintext;

        // Store title cache
        $s_url = $wp->query_string;
        $titles = get_option('cc_whmcs_bridge_sso_titles');
        $titles = unserialize($titles);
        if (!is_array($titles)) $titles = array();
        $titles[md5($s_url)] = $page_title->plaintext;
        update_option('cc_whmcs_bridge_sso_titles', serialize($titles)); 
    }

    $whmcs_path = parse_url(cc_whmcs_bridge_url(), PHP_URL_PATH);
    if (substr($whmcs_path, -1) != '/')
        $whmcs_path .= '/';

    $loop = array();
    $loop[cc_whmcs_bridge_url().'/'] = cc_whmcs_bridge_url().'/';
    $loop[$whmcs] = $whmcs;
    if (!is_null($whmcs2))
        $loop[$whmcs2] = $whmcs2;
    if (!is_null($whmcs3))
        $loop[$whmcs3] = $whmcs3;
    if ($whmcs_path != '')
        $loop[$whmcs_path] = $whmcs_path;
    if ($sub != '')
        $loop[$sub] = $sub;

    $loop[''] = '';

    // Get cache
    $replacements = cc_get_cache('all');

    if (count($replacements) > 0) {
        foreach ($replacements as $search => $replace) {
            $found = false;
            foreach ($loop as $lu) {
                if (strstr($buffer, $lu.$search) !== false) {
                    cc_whmcs_log(0, '[' . $ref . '] [Found] Filling in cache for '.$search.' with '.$replace);
                    $buffer = str_replace($lu.$search, plugins_url('whmcs-bridge/cache/'.$replace), $buffer);
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                cc_whmcs_log(0, '[' . $ref . '] [NotFound] Filling in cache for '.$search.' with '.$replace);
                $buffer = str_replace($search, plugins_url('whmcs-bridge/cache/'.$replace), $buffer);
            }
        }
    }
    // Get cache

    $ret['buffer']=$buffer;

    $parse = true;

    if (get_option('cc_whmcs_bridge_permalinks') && function_exists('cc_whmcs_bridge_parser_with_permalinks') && !$pid) {
        cc_whmcs_log(0, '[' . $ref . '] Parser parsing pretty links.');

        $buffer = cc_whmcs_bridge_parser_with_permalinks($buffer, $home, $pid, $whmcs, $sub, $whmcs2, $whmcs3);

        if ($buffer === false) {
            $parse = true;
            cc_whmcs_log(0, '[' . $ref . '] License invalid, pretty parser not triggered, failing back to regular parser.');
        } else {
            $parse = false;
            cc_whmcs_log(0, '[' . $ref . '] Parser parsing pretty links completed.');
        }
    }
    
    if ($parse) {
        cc_whmcs_log(0, '[' . $ref . '] Parser parsing non-pretty links.');

        // FULL URLS

        foreach ($loop as $rep_url) {
            $buffer = str_replace('src="'.$rep_url.'modules/', 'src="'.$home.'?ccce=js&ajax=1&js=modules/', $buffer);
            $buffer = str_replace('href="'.$rep_url.'modules/', 'href="'.$home.'?ccce=js&ajax=1&js=modules/', $buffer);

            $f[]='/selfLink \= "'.preg_quote($rep_url, '/').'([a-zA-Z0-9\_]*?).php\"/';
            $r[]='selfLink = "'.$home.'?ccce=$1/'.$pid.'"';

            // templates css/js
            $f[] = "/src=\"" . preg_quote($rep_url, '/') . "templates\/([a-zA-Z0-9\_]*?)\/js\/([a-zA-Z0-9\.\_]*?).js/";
            $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'templates/$1/js/$2.js' . $pid;

            $f[]="/src=\"".preg_quote($rep_url,'/')."templates\/([a-zA-Z0-9\_]*?)\/js\/([a-zA-Z0-9\_\.]*?).js.(.*?)/";
            $r[]="src=\"{$home}?ccce=js&ajax=1&js=".'templates/$1/js/$2.js&'.$pid;

            $f[] = "/href=\"" . preg_quote($rep_url, '/') . "templates\/([a-zA-Z0-9\_]*?)\/css\/([a-zA-Z0-9\.\_]*?).css/";
            $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'templates/$1/css/$2.css' . $pid;

            $f[]="/href=\"".preg_quote($rep_url,'/')."templates\/([a-zA-Z0-9\_]*?)\/css\/([a-zA-Z0-9\_\.]*?).css.(.*?)/";
            $r[]="href=\"{$home}?ccce=js&ajax=1&js=".'templates/$1/css/$2.css?'.$pid;

            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'value="' . $home . '?ccce=$1' . $pid . '"';

            //echo '/value\=\"'.preg_quote($rep_url,'/').'([a-zA-Z0-9\_]*?).php.(.*?)\"/';
            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php.(.*?)\"/';
            $r[] = 'value="' . $home . '?ccce=$1&$2' . $pid . '"';

            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . 'modules\/gateways\/([a-zA-Z0-9]*?)\/([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'value="' . $home . '?ajax=1&ccce=modules/gateways/$1/$2"';

            $f[] = '/value\=\"' . preg_quote($rep_url, '/') . 'modules\/gateways\/([a-zA-Z0-9]*?)\/([a-zA-Z0-9\_]*?).php.(.*?)\"/';
            $r[] = 'value="' . $home . '?ajax=1&ccce=modules/gateways/$1/$2&$3"';

            $f[] = '/action\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'action="' . $home . '?ccce=$1' . $pid . '"';

            $f[] = '/action\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php.(.*?)\"/';
            $r[] = 'action="' . $home . '?ccce=$1&$2' . $pid . '"';

            $f[] = '/href\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'href="' . $home . '?ccce=$1' . $pid . '"';

            $f[] = '/href\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\?((?:(?!phpinfo|").)*)\"/';
            $r[] = 'href="' . $home . '?ccce=$1&$2' . $pid . '"';

            // Gateways
            $f[]="/action=\"".preg_quote($rep_url,'/')."modules\/([a-zA-Z0-9\_]*?)\/([a-zA-Z0-9\_]*?).php/";
            $r[]="action=\"{$home}js/?ajax=1&js=".'modules/$1/$2.php'.$pid;

            $f[] = '/href\=\"' . preg_quote($rep_url, '/') . '([a-zA-Z0-9\_]*?).php\"/';
            $r[] = 'href="' . $home . '?ccce=$1' . $pid . '"';

            // KB, Downloads, Announcements
            /*if (stristr($buffer, 'href="'.$rep_url.'knowledgebase') !== false
                || stristr($buffer, 'action="'.$rep_url.'knowledgebase') !== false
            ) {
                $buffer = str_replace('href="'.$rep_url.'knowledgebase', 'href="'.$home.'?ccce=knowledgebase/', $buffer);

                $buffer = str_replace('action="'.$rep_url.'knowledgebase', 'action="'.$home.'?ccce=knowledgebase', $buffer);
            }

            if (stristr($buffer, 'href="'.$rep_url.'downloads') !== false) {
                $buffer = str_replace('href="'.$rep_url.'downloads', 'href="'.$home.'?ccce=downloads', $buffer);
            }

            if (stristr($buffer, 'href="'.$rep_url.'announcements') !== false) {
                $buffer = str_replace('href="'.$rep_url.'announcements', 'href="'.$home.'?ccce=announcements', $buffer);
            }
            */
            // Payment Gateways
            $f[]='/value\=\"'.preg_quote($rep_url,'/').'modules\/gateways\/([a-zA-Z0-9]*?)\/([a-zA-Z0-9]*?).php/';
            $r[]= 'value="'.$home.'?ajax=1&ccce=modules/gateways/$1/$2';

            $f[]="/src=\"".preg_quote($rep_url,'/')."templates\/orderforms\/([a-zA-Z0-9\_]*?)\/js\/([a-zA-Z0-9\_\.]*?).js/";
            $r[]="src=\"{$home}?ccce=js&ajax=1&js=".'templates/orderforms/$1/js/$2.js'.$pid;

            $f[]="/src=\"".preg_quote($rep_url,'/')."templates\/orderforms\/([a-zA-Z0-9\_]*?)\/([a-zA-Z0-9\_\.]*?).js/";
            $r[]="src=\"{$home}?ccce=js&ajax=1&js=".'templates/orderforms/$1/$2.js'.$pid;

            $f[]="/href=\"".preg_quote($rep_url,'/')."templates\/orderforms\/([a-zA-Z0-9\_]*?)\/([a-zA-Z0-9\_\.]*?).css/";
            $r[]="href=\"{$home}?ccce=js&ajax=1&js=".'templates/orderforms/$1/$2.css'.$pid;

            $f[]="/href=\"".preg_quote($rep_url,'/')."templates\/orderforms\/([a-zA-Z0-9\_]*?)\/css\/([a-zA-Z0-9\_\.]*?).css/";
            $r[]="href=\"{$home}?ccce=js&ajax=1&js=".'templates/orderforms/$1/css/$2.css'.$pid;

            $buffer = str_replace('src="'.$rep_url.'templates/orderforms', 'src="'.$home.'?ccce=js&ajax=1&js=templates/orderforms', $buffer);
            
        }

        $buffer = str_replace('src="templates/orderforms', 'src="'.$home.'?ccce=js&ajax=1&js=templates/orderforms', $buffer);

        # custom paths
        $custom_paths = explode("\n", str_replace("\r\n", "\n", get_option('cc_whmcs_bridge_custom_rules')));

        if (is_array($custom_paths)) {
            foreach ($custom_paths as $pth) {
                if (trim($pth) == '') continue;

                if (substr($pth, 0, 1) == '*') {
                    $pth = substr($pth, 1);
                    $f[] = "\${$pth}(.*?).js\$";
                    $r[] = $home . "?ccce=js&ajax=1&js=" . $pth . '$1.js' . $pid;

                    $f[] = "\${$pth}(.*?).css\$";
                    $r[] = $home . "?ccce=js&ajax=1&js=" . $pth . '$1.css' . $pid;
                } else {
                    $f[] = "\${$pth}(.*?).js\$";
                    $r[] = $home . "?ccce=js&ajax=2&js=" . $pth . '$1.js' . $pid;

                    $f[] = "\${$pth}(.*?).css\$";
                    $r[] = $home . "?ccce=js&ajax=2&js=" . $pth . '$1.css' . $pid;
                }
            }
        }

        # 2factor
        $f[] = '/img src\=\"\/([a-zA-Z0-9]*?)\/([a-zA-Z0-9]*?).php.(.*?)\"/';
        $r[] = "img src=\"$home" . "?ccce=$2&$3&ajax=2\"";

        # wbteampro
        $f[] = '/img src\=\"([a-zA-Z0-9]*?).php.(.*?)\"/';
        $r[] = "img src=\"$home" . "?ccce=$1&$2&ajax=2\"";

        // SUB FOLDERS
        $f[] = '/href\=\"' . preg_quote($sub, '/') . '([a-zA-Z0-9\_]*?).php.(.*?)\"/';
        $r[] = 'href="' . $home . '?ccce=$1&$2' . $pid . '"';

        // hyperlinks
        $f[] = '/href\=\"([a-zA-Z0-9\_]*?).php\?(.*?)\"/';
        $r[] = 'href="' . $home . '?ccce=$1&$2' . $pid . '"';

        $f[] = '/href\=\"([a-zA-Z0-9\_]*?).php\"/';
        $r[] = 'href="' . $home . '?ccce=$1' . $pid . '"';

        // images
        $f[] = '/img src\=\"([a-zA-Z0-9]*?).php.(.*?)\"/';
        $r[] = "img src=\"$home" . "$1/?$2&ajax=2\"";

        // form posts
        $f[] = '/<form(.*?)method\=\"get\"(.*?)action\=\"([a-zA-Z0-9\_]*?).php\"(.*?)>/';
        if (!$pid) $r[] = '<form$1method="get"$2action="' . $home . '"$4><input type="hidden" name="ccce" value="$3" />';
        else $r[] = '<form$1method="get"$2action="' . $home . '"$4><input type="hidden" name="ccce" value="$3" /><input type="hidden" name="page_id" value="' . cc_whmcs_bridge_mainpage() . '"/>';

        $f[] = '/action\=\"([a-zA-Z0-9\_]*?).php\?(.*?)\"/';
        $r[] = 'action="' . $home . '?ccce=$1&$2' . $pid . '"';

        $f[] = '/action\=\"([a-zA-Z0-9\_]*?).php\"/';
        $r[] = 'action="' . $home . '?ccce=$1' . $pid . '"';

        $f[] = '/<form(.*?)method\=\"get\"(.*?)action\=\"' . preg_quote($sub, '/') . '([a-zA-Z0-9\_]*?).php\"(.*?)>/';
        if (!$pid) $r[] = '<form$1method="get"$2action="' . $home . '"$4><input type="hidden" name="ccce" value="$3" />';
        else $r[] = '<form$1method="get"$2action="' . $home . '"$4><input type="hidden" name="ccce" value="$3" /><input type="hidden" name="page_id" value="' . cc_whmcs_bridge_mainpage() . '"/>';

        $f[] = '/action\=\"' . preg_quote($sub, '/') . '([a-zA-Z0-9\_]*?).php\"/';
        $r[] = 'action="' . $home . '?ccce=$1' . $pid . '"';

        $f[] = '/action\=\"' . preg_quote($sub, '/') . '([a-zA-Z0-9\_]*?).php.(.*?)\"/';
        $r[] = 'action="' . $home . '?ccce=$1&$2' . $pid . '"';

        // url specific fixes
        $f[] = '/"submitticket.php/';
        $r[] = '"' . $home . '?ccce=submitticket&ajax=1' . $pid;

        // fixes the register.php
        $f[] = '/action\=\"(.|\/*?)register.php\"/';
        $r[] = 'action="' . $home . '?ccce=register' . $pid . '"';

        //remove cart heading
        $f[] = '#\<p align\=\"center\" class=\"cartheading\">(?:.*?)\<\/p\>#';
        $r[] = '';

        //remove base tag
        $f[] = "(\<base\s*href\=(?:\"|\')(?:.*?)(?:\"|\')\s*/\>)";
        $r[] = '';

        //remove title tag
        $f[] = "/<title>.*<\/title>/";
        $r[] = '';

        //remove meta tag
        $f[] = "/<meta.*>/";
        $r[] = '';

        // js single quotes
        $f[] = '/window.location\=\'' . '([a-zA-Z0-9\_]*?).php\'/';
        $r[] = 'window.location=\'' . $home . '?ccce=$1' . $pid . '\'';

        $f[] = '/window.location\=\'' . preg_quote($sub, '/') . '([a-zA-Z0-9\_]*?).php.(.*?)\'/';
        $r[] = 'window.location=\'' . $home . '?ccce=$1&$2' . $pid . '\'';

        $f[] = '/window.location\=\'' . '([a-zA-Z0-9\_]*?).php.(.*?)\'/';
        $r[] = 'window.location=\'' . $home . '?ccce=$1&$2' . $pid . '\'';

        $f[] = '/window.location \= \'' . '([a-zA-Z0-9\_]*?).php.(.*?)\'/';
        $r[] = 'window.location = \'' . $home . '?ccce=$1' . $pid . '&$2\'';

        $f[] = "/.post\(\'([a-zA-Z0-9]*?).php/";
        $r[] = ".post('$home?ccce=$1&ajax=1$pid";

        $f[] = "/popupWindow\(\'([a-zA-Z0-9]*?).php\?/";
        $r[] = "popupWindow('$home?ccce=$1&ajax=1$pid&";

        $f[] = '/window.open\(\'([a-zA-Z0-9\_]*?).php.(.*?)\'/';
        $r[] = 'window.open(\'' . $home . '?ajax=1&ccce=$1&$2' . $pid . '\'';

        // quotations using location.href with single quote
        $f[] = '/location.href\=\'' . '([a-zA-Z0-9\_]*?).php\'/';
        $r[] = 'location.href=\'' . $home . '?ccce=$1' . $pid . '\'';

        $f[] = '/location.href\=\'' . '([a-zA-Z0-9\_]*?).php.(.*?)\'/';
        $r[] = 'location.href=\'' . $home . '?ccce=$1&$2' . $pid . '\'';

        // js double quotes
        $f[] = "/.post\(\"announcements.php/";
        $r[] = ".post(\"$home?ccce=announcements&ajax=1$pid";

        $f[] = "/.post\(\"submitticket.php/";
        $r[] = ".post(\"$home?ccce=submitticket&ajax=1$pid";

        $f[] = '/.load\(\"submitticket.php/';
        $r[] = '.load("' . $home . '?ccce=submitticket&ajax=1' . $pid;

        $f[] = "/.post\(\"([a-zA-Z0-9]*?).php/";
        $r[] = ".post(\"$home?ccce=$1&ajax=1$pid";

        // six
        $f[] = "/src=\"" . preg_quote($whmcs_path, '/') . "assets\//";
        $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'assets/$1' . $pid;

        $f[] = "/href=\"" . preg_quote($whmcs_path, '/') . "assets\//";
        $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'assets/$1' . $pid;

        // six modules
        $f[] = "/src=\"" . preg_quote($whmcs_path, '/') . "modules\//";
        $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'modules/$1' . $pid;

        $f[] = "/href=\"" . preg_quote($whmcs_path, '/') . "modules\//";
        $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'modules/$1' . $pid;

        $f[] = "/src=\"modules\//";
        $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'modules/$1' . $pid;

        $f[] = "/href=\"modules\//";
        $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'modules/$1' . $pid;

        // six templates css/js
        $f[] = "/src=\"" . preg_quote($whmcs_path, '/') . "templates\/([a-zA-Z0-9]*?)\/js\/([a-zA-Z0-9\_\.]*?).js/";
        $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'templates/$1/js/$2.js' . $pid;

        $f[] = "/href=\"" . preg_quote($whmcs_path, '/') . "templates\/([a-zA-Z0-9]*?)\/css\/([a-zA-Z0-9\_\.]*?).css/";
        $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'templates/$1/css/$2.css' . $pid;

        // orderforms
        $f[] = "/src=\"templates\/orderforms\/([a-zA-Z0-9_]*?)\/js\/([a-zA-Z0-9\_]*?).js/";
        $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'templates/orderforms/$1/js/$2.js' . $pid;

        $f[] = "/src=\"templates\/orderforms\/([a-zA-Z0-9_]*?)\/([a-zA-Z0-9\_]*?).js/";
        $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'templates/orderforms/$1/$2.js' . $pid;

        $f[] = "/href=\"templates\/orderforms\/([a-zA-Z0-9_]*?)\/([a-zA-Z0-9\_]*?).css/";
        $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'templates/orderforms/$1/$2.css' . $pid;

        // templates css/js
        $f[] = "/src=\"templates\/([a-zA-Z0-9]*?)\/js\/([a-zA-Z0-9]*?).js/";
        $r[] = "src=\"{$home}?ccce=js&ajax=1&js=" . 'templates/$1/js/$2.js' . $pid;

        $f[] = "/href=\"templates\/([a-zA-Z0-9]*?)\/css\/([a-zA-Z0-9]*?).css/";
        $r[] = "href=\"{$home}?ccce=js&ajax=1&js=" . 'templates/$1/css/$2.css' . $pid;

        ## BootWHMCS
        $f[] = "/templates\/orderforms\/([a-zA-Z0-9]*?)\/static\/app.js/";
        $r[] = $home . "?ccce=js&ajax=2&js=" . 'templates/orderforms/$1/static/app.js' . $pid;
        ## BootWHMCS

        // character fixes
        $f[] = "/>>/";
        $r[] = "&gt;&gt;";

        // 'page' is a Wordpress reserved variable
        $f[] = '/href\=\"(.*?)&amp;page\=([0-9]?)"/';
        $r[] = 'href="$1' . '&whmcspage=$2"';

        // six js links
        $f[] = "/'([a-zA-Z0-9\_]*?).php'/";
        $r[] = "'" . $home . "?ccce=$1" . $pid . "'";

        $f[] = "/\"([a-zA-Z0-9\_]*?).php\"/";
        $r[] = "\"" . $home . "?ccce=$1" . $pid . "\"";

        $f[] = "/'([a-zA-Z0-9\_]*?).php.(.*?)'/";
        $r[] = "'" . $home . "?ccce=$1&$2" . $pid . "'";

        $f[] = "/\"([a-zA-Z0-9\_]*?).php.(.*?)\"/";
        $r[] = "\"" . $home . "?ccce=$1&$2" . $pid . "\"";

        // run regex
        $buffer = preg_replace($f, $r, $buffer, -1, $count);

        // tickets
        $buffer = str_replace("window.location='?tid=", "window.location='{$home}?ccce=viewticket&tid=", $buffer);

        cc_whmcs_log(0, '[' . $ref . '] Parser parsing non-pretty links completed.');
    }

    cc_whmcs_log(0, '[' . $ref . '] Parser parsing final fixes.');

    // SolusVM
    $buffer = str_replace("window.open('modules/servers/solusvmpro/", "window.open('{$home}?ccce=js&ajax=1&js=modules/servers/solusvmpro/", $buffer);

    // cvv img etc.
    $buffer = str_replace("<img src='/assets/", "<img src='{$home}/assets/", $buffer);

    // 2factor
    $buffer = str_replace("'clientarea.php'", "'$home?ccce=clientarea'", $buffer);

    // Details update
    $buffer = str_replace('action="?action=details"', 'action="'.$home.'?ccce=clientarea&action=details"', $buffer);

    //patch issue with &
    $buffer = str_replace('&#038;', '&', $buffer);

    // some JS not being closed correctly
    $buffer = str_replace("&,", '&",', $buffer);
    $buffer = str_replace("&>", '&">', $buffer);
    $buffer = str_replace("&/>", '&"/>', $buffer);
    $buffer = str_replace("& />", '&" />', $buffer);

    //name is a reserved Wordpress field name
    if (isset($_REQUEST['ccce']) && ($_REQUEST['ccce'] == 'viewinvoice')) {
        // not in invoice
    } else {
        $buffer = str_replace('name="name"', 'name="whmcsname"', $buffer);
    }

    // Gateway Fees addon fix
    $buffer = str_replace('"./modules/addons/gateway_fees/ajax.php"', '"'.$home.'?ccce=js&ajax=2&js=modules/addons/gateway_fees/ajax.php"', $buffer);

    // Fix auto forward to payment gateway issue
    $buffer = str_replace('$("#submitfrm").', 'jQuery("#submitfrm").', $buffer);
    $buffer = str_replace("\$('#submitfrm').", "jQuery('#submitfrm').", $buffer);
    // end fix auto forward

    $buffer = str_replace('src="/templates', 'src="' . cc_whmcs_bridge_url() . '/templates', $buffer);
    foreach ($loop as $lu) {
        $buffer = str_replace('src="'.$lu.'templates', 'src="' . cc_whmcs_bridge_url() . '/templates', $buffer);
        $buffer = str_replace('href="'.$lu.'templates', 'href="' . cc_whmcs_bridge_url() . '/templates', $buffer);
        $buffer = str_replace('href="'.$lu.'includes', 'href="' . cc_whmcs_bridge_url() . '/includes', $buffer);
        $buffer = str_replace('src="'.$lu.'includes', 'src="' . cc_whmcs_bridge_url() . '/includes', $buffer);
        $buffer = str_replace('src="'.$lu.'modules', 'src="' . cc_whmcs_bridge_url() . '/modules', $buffer);
        $buffer = str_replace('action="'.$lu.'modules', 'action="' . $home . '?ccce=js&ajax=2&js=modules', $buffer);
        // six
        $buffer = str_replace('src="assets', 'src="' . cc_whmcs_bridge_url() . '/assets', $buffer);
    }

    // proxmox
    $buffer = str_replace('src=\"modules', 'src=\"' . cc_whmcs_bridge_url() . '/modules', $buffer);
    $buffer = str_replace('$(".so_graph', '$("div.so_graph', $buffer);

    //import local images
    $buffer = str_replace('src="images', 'src="' . cc_whmcs_bridge_url() . '/images', $buffer);
    $buffer = str_replace('background="images', 'background="' . cc_whmcs_bridge_url() . '/images', $buffer);
    $buffer = str_replace("window.open('images", "window.open('" . cc_whmcs_bridge_url() . '/images', $buffer);

    //verify captcha image
    $buffer = str_replace(cc_whmcs_bridge_url() . '/includes/verifyimage.php', $home . '?ccce=verifyimage' . $pid, $buffer);

    if (isset($_REQUEST['ccce']) &&
        (($_REQUEST['ccce']=='viewinvoice' && strstr($buffer, 'invoice.css'))
            || $_REQUEST['ccce']=='announcementsrss')

    ) {
        while (count(ob_get_status(true)) > 0) ob_end_clean();
        echo '<div id="bridge">'.$buffer.'</div>';
        die();
    }

    //load WHMCS invoicestyle.css style sheet
    if (get_option('cc_whmcs_bridge_invoicestyle') != 'checked') {
        $buffer = preg_replace('/<link.*templates\/[a-zA-Z0-9_-]*\/invoicestyle.css" \/>/', '', $buffer);
    }

    //load WHMCS style.css style sheet
    if (get_option('cc_whmcs_bridge_style') != 'checked') {
        $buffer = preg_replace('/<link.*templates\/[a-zA-Z0-9_-]*\/style.css">/', '', $buffer);
        $buffer = preg_replace('/<link.*templates\/[a-zA-Z0-9_-]*\/style.css" \/>/', '', $buffer);
    } else {
        $matches = array();
        if (preg_match('/<link.*href="(.*templates\/[a-zA-Z0-9_-]*\/style.css)" \/>/', $buffer, $matches)) {
            $css = $matches[1];
            $output = cc_whmcs_bridge_parser_css($css);
            $buffer = preg_replace('/<link.*templates\/[a-zA-Z0-9_-]*\/style.css" \/>/', '<style type="text/css">' . $output . '</style>', $buffer);
        }
    }

    //replaces whmcs jquery so that it doesn't start it twice
    if (in_array(get_option('cc_whmcs_bridge_jquery'), array('checked', 'wp'))) {
        $buffer = preg_replace('/<script.*jquery.js"><\/script>/', '', $buffer);
        $buffer = preg_replace('/<script.*jquery.min.js"><\/script>/', '', $buffer);
        $buffer = preg_replace('/<script.*jqueryui.js"><\/script>/', '', $buffer);
    }

    //jQuery ui
    $buffer = str_replace('href="includes/jscript/css/ui.all.css', 'href="' . cc_whmcs_bridge_url() . '/includes/jscript/css/ui.all.css', $buffer);

    // Fix url issues
    $surl = str_replace(array('http:', 'https:'), '', $whmcs);
    $buffer = str_replace($surl . $home, $home, $buffer);
    $buffer = str_replace($home . 'index/', $home, $buffer);
    $buffer = str_replace($home . '?m=', $home.'index?m=', $buffer);
    $buffer = str_replace($home . 'cart/cart.php', $home . 'cart', $buffer);
    $buffer = str_replace($home . 'serverstatus/serverstatus.php', $home . 'serverstatus', $buffer);
    $buffer = str_replace('"cart.php"', '"' . $home . '?ccce=cart' . $pid . '"', $buffer);
    $buffer = str_replace('"cart.php?', '"' . $home . '?ccce=cart' . $pid . '&', $buffer);

    // DNSManager2
    $buffer = str_replace($home.'modules/addons/DNSManager2', cc_whmcs_bridge_url().'/modules/addons/DNSManager2', $buffer);

    // fix double url problems
    $buffer = str_replace('http:http', 'http', $buffer);
    $buffer = str_replace('https:http', 'http', $buffer);
    $buffer = str_replace('https://http//', 'http://', $buffer);
    $buffer = str_replace($whmcs_path . 'http', 'http', $buffer);
    $buffer = str_replace($whmcs_path . '://', '://', $buffer);
    $buffer = str_replace(cc_whmcs_bridge_url() . 'http', 'http', $buffer);
    $buffer = str_replace('http:http', 'http', $buffer);
    $buffer = str_replace('https:http', 'http', $buffer);

    // DNSManager2 Issues
    $buffer = str_replace('?m=DNSManager2', '?m=DNSManagerII', $buffer);
    $buffer = str_replace('index?m=DNSManagerII', '?m=DNSManagerII', $buffer);

    // TCO tokenize
    $buffer = str_replace('twocheckout.php?2checkout', 'twocheckout.php&2checkout', $buffer);

    $html = new iplug_simple_html_dom();
    $html->load($buffer);

    $sidebar=$html->find('div[id=side_menu]', 0) ? trim($html->find('div[id=side_menu]', 0)->innertext) : null;

    if ($sidebar) {
        $pattern = '/<form(.*?)dologin(.*?)>/';
        if (preg_match($pattern,$sidebar,$matches)) {
            $loginForm=$matches[0];
            $sidebar=preg_replace('/(<form(.*?)dologin(.*?)>)(\s*)(<p class.*>)/','$3$1',$sidebar); //swap around the <form> and <p> tags
            $ret['sidebar'][]=$sidebar;
        }
        $sidebarSearch='<p class="header">';
        $sidebarData=explode($sidebarSearch, $sidebar);

        //Remove end paragraph and text headings
        foreach($sidebarData as $count => $data){
            $title='';
            $text = explode('</p>', $data);
            if (count($text) > 0) {
                $title = $text[0];
                unset($text[0]);
                $data = implode('</p>', $text);
            }

            $sidebarData[$count]=$data;
            $sidebarData['mode'][$count-1]=$title;
        }

        $ret['sidebarNav']=@$sidebarData[1]; //QUICK NAVIGATION
        $ret['sidebarAcInf']=@$sidebarData[2]; //ACCOUNT INFORMATION
        $ret['sidebarAcSta']=@$sidebarData[3]; //ACCOUNT STATISTICS
        $ret['mode']=@$sidebarData['mode'];

        if (stristr($ret['sidebarAcInf'], 'type="password"') !== false) {
            $ret['sidebarAcInf'] = $loginForm.$ret['sidebarAcInf'].'</form>';
        }

    };
    if ($body=$html->find('div[id=content_left]',0)) {
        $title=$body->find('h1',0);
        $ret['title']=$title->innertext;
        $title->outertext='';
        $ret['main']=$body->innertext;
        $ret['main']=str_replace(' class="heading2"',"",$ret['main']);
        $ret['main']=str_replace("<h1>","<h4>",$ret['main']);
        $ret['main']=str_replace("</h1>","</h4>",$ret['main']);
        $ret['main']=str_replace("<h2>","<h4>",$ret['main']);
        $ret['main']=str_replace("</h2>","</h4>",$ret['main']);
        $ret['main']=str_replace("<h3>","<h5>",$ret['main']);
        $ret['main']=str_replace("</h3>","</h5>",$ret['main']);
    } elseif ($body=$html->find('body',0)) {
        $ret['main']=$body->innertext;
    } elseif ($body=$html->find('div',0)) {
        $ret['main']=$body->innertext;
    }
    if ($head=$html->find('head',0)) $ret['head']=$head->innertext;//$buffer;

    //start new change
    if ($topMenu=$html->find('div[id=top_menu] ul',0)){
        //top menu here
        $topMenu=$topMenu->__toString();
        $ret['topNav']=$topMenu;
    }else{
        $ret['topNav']="";
    }
    if ($welcomebox=$html->find('div[id=welcome_box]',0)){
        //top menu here
        $welcomebox=$welcomebox->__toString();
        $welcomebox=str_replace("&nbsp;","",$welcomebox);
        $welcomebox=str_replace("</div>","",$welcomebox);
        $welcomebox=str_replace('<div id="welcome_box">',"",$welcomebox);
        $welcomebox=preg_replace("/<img[^>]+\>/i", " | ", $welcomebox);
        $welcomebox='<div class="search_engine">'.$welcomebox;
        $welcomebox=$welcomebox."</div>";
        $ret['welcomebox']=$welcomebox;
    }
    // contribution northgatewebhosting.co.uk
    if ($carttotal=$html->find('div[id=cart-total]',0)){
        //top menu here
        $carttotal=$carttotal->__toString();
        $carttotal=str_replace('<div id="cart-total">','<div id="cart-total-widget">',$carttotal);
        $ret['carttotal']=$carttotal;
    }
    // contribution northgatewebhosting.co.uk

    //end new change

    foreach ($ret as $key => $val) {
        if (stristr($key, 'sidebar') !== false || stristr($key, 'welcomebox') !== false) {
            if (!is_array($val) && stristr($val, '<form') !== false && stristr($val, '</form') === false) {
                $ret[$key] = $val.'</form>';
            }
        }
    }

    $ret['msg']=$_SESSION;

    cc_whmcs_log(0, '['.$ref.'] Parser completed.');

    return $ret;
}

function cc_whmcs_bridge_parse_url($redir) {
    cc_whmcs_bridge_home($home,$pid,false);
    $whmcs=cc_whmcs_bridge_url();
    if (substr($whmcs,-1) != '/') $whmcs.='/';

    $f[]='/'.preg_quote($whmcs,'/').'viewinvoice\.php\?id\=([0-9]*?)&(.*?)$/';
    if (get_option('cc_whmcs_bridge_permalinks')) $r[]=''.$home.'viewinvoice/?id=$1'.$pid.'';
    else $r[]=''.$home.'?ccce=viewinvoice&id=$1'.$pid.'';

    $f[]='/'.preg_quote($whmcs,'/').'cart\.php\?(.*?)$/';
    if (get_option('cc_whmcs_bridge_permalinks')) $r[]=''.$home.'cart/?$1'.$pid.'';
    else $r[]=''.$home.'?ccce=cart&$1'.$pid.'';

    if (stristr($redir, 'modules/gateways/../../viewinvoice.php?') !== false) {
        $f[]='/'.preg_quote($whmcs,'/').'modules\/gateways\/..\/..\/viewinvoice\.php\?id\=([0-9]*?)&(.*?)$/';
        if (get_option('cc_whmcs_bridge_permalinks')) $r[]=''.$home.'viewinvoice/?id=$1'.$pid.'';
        else $r[]=''.$home.'?ccce=viewinvoice&id=$1'.$pid.'';
    }

    $newRedir=preg_replace($f,$r,$redir);


    return $newRedir;
}