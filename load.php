<?php 

define( 'ABSPATH', dirname(__FILE__) . '/' );
define( 'cls', '/class' );
define('cfg','config');
define('config','/config.php');
define('inc','/include');
$files['profile']='profile.php';
$files['logout']='logout.php';
define( 'profile', ABSPATH.'/profile.php' );
define( 'logout', ABSPATH.'/logout.php' );
require_once(ABSPATH.cfg.config);
$config=new config();
require_once(ABSPATH.cls.'/validate.php');

$header="

    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='../style/css/bootstrap.css'>
    <meta name='propeller' content='1393df8df1165c9db9b65be1e952118d' />
<title>جمعية السراج</title>
<script type='text/javascript' src='style/js/jquery-1.11.2.min.js'></script>
<script type='text/javascript' src='style/js/bootstrap.min.js'></script>
<link rel='stylesheet' type='text/css' href='style/css/default.css'>
<link rel='stylesheet' type='text/css' href='style/css/zebra_pagination.css'/>
<script type='text/javascript' src='style/js/tiny_mce.js'></script>
<script type='text/javascript' src='style/js/tiny_mce_popup.js'></script>
<script type='text/javascript' src='style/js/tiny_mce_src.js'></script>
<link rel='stylesheet' type='text/css' href='style/css/bootstrap-rtl.css'>
<script type='text/javascript' src='include/MathJax-master/MathJax.js?config=TeX-AMS_HTML-full'></script>

";
$header_ad="
<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='../style/css/bootstrap.css'>
    <meta name='propeller' content='1393df8df1165c9db9b65be1e952118d' />
<title>جمعية السراج</title>
<script type='text/javascript' src='../style/js/jquery-1.11.2.min.js'></script>
<script type='text/javascript' src='../style/js/bootstrap.min.js'></script>
<link rel='stylesheet' type='text/css' href='../style/css/default.css'>
<link rel='stylesheet' type='text/css' href='../style/css/zebra_pagination.css'/>
<script type='text/javascript' src='../style/js/tiny_mce.js'></script>
<script type='text/javascript' src='../style/js/tiny_mce_popup.js'></script>
<script type='text/javascript' src='../style/js/tiny_mce_src.js'></script>
<link rel='stylesheet' type='text/css' href='../style/css/bootstrap-rtl.css'>
<script src='include/ckeditor/ckeditor.js'></script>
<script src='include/ckeditor/samples/js/sample.js'></script>
<script type='text/javascript' src='../include/MathJax-master/MathJax.js?config=TeX-AMS_HTML-full'></script>
";
?>