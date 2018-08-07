<?php

$dbh = connectDatabase();

/**
 *  authorization
 */
if (!isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['HTTP_AUTHORIZATION'])) {
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
} elseif (!isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['REMOTE_USER'])) {
    $_SERVER['PHP_AUTH_USER'] = $_SERVER['REMOTE_USER'];
} elseif (!isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['REDIRECT_REMOTE_USER'])) {
    $_SERVER['PHP_AUTH_USER'] = $_SERVER['REDIRECT_REMOTE_USER'];
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    Header("WWW-Authenticate: Basic realm=\"Pure-FTPd WebUi Admin Page\"");
    Header("HTTP/1.0 401 Unauthorized");
    exit();
} else {
    $sql = 'SELECT pass, language FROM userlist WHERE user = ?';
    
    $sth = $dbh->prepare($sql);
    $sth->execute([$_SERVER['PHP_AUTH_USER']]);
    $user = $sth->fetchAll();
    
    if (!isset($user[0]['pass'])) {
        header("WWW-Authenticate: Basic realm=\"Pure-FTPd WebUi Admin Page\"");
        header("HTTP/1.0 401 Unauthorized");
        exit;
    }
    
    if (!password_verify($_SERVER['PHP_AUTH_PW'], $user[0]['pass'])) {
        header("WWW-Authenticate: Basic realm=\"Pure-FTPd WebUi Admin Page\"");
        header("HTTP/1.0 401 Unauthorized");
        exit;
    }
}


/**
 *  settings
 */
$sql = 'SELECT * FROM settings';

$sth = $dbh->prepare($sql);
$sth->execute();
$settings = [];
foreach ($sth->fetchAll() as $setting) {
    $settings[$setting['name']] = $setting['value'];
}

$settings['interface_language'] = $user[0]['language'];

/**
 *  interface language
 */
if (!isset($settings['interface_language'])) {
    $settings['interface_language'] = 'en';
}

if (!is_file('lang/'. $settings['interface_language'] .'.php')) {
    $settings['interface_language'] = 'en';
}

include_once('lang/'. $settings['interface_language'] .'.php');


if (APP_ENV === 'prod') {
    ini_set('display_errors', 0);
    error_reporting(0);
} else {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$loader = new Twig_Loader_Filesystem(__DIR__ .'/views');
$options = [];
if (APP_ENV === 'prod') {
    $options['cache'] = __DIR__ .'/var/cache';
}
$twig = new Twig_Environment($loader, $options);


//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='ftp_dir'");
// $array = mysqli_fetch_array ($result);
// $ftp_dir = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='upload_speed'");
// $array = mysqli_fetch_array ($result);
// $upload_speed = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='download_speed'");
// $array = mysqli_fetch_array ($result);
// $download_speed = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='quota_size'");
// $array = mysqli_fetch_array ($result);
// $quota_size = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='quota_files'");
// $array = mysqli_fetch_array ($result);
// $quota_files = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='permitted_ip'");
// $array = mysqli_fetch_array ($result);
// $permitted_ip = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='pureftpd_conf_path'");
// $array = mysqli_fetch_array ($result);
// $pureftpd_conf_path = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='pureftpd_init_script_path'");
// $array = mysqli_fetch_array ($result);
// $pureftpd_init_script_path = $array["value"];
//
// $result = mysqli_query ($link, "SELECT * FROM settings WHERE name='pureftpwho_path'");
// $array = mysqli_fetch_array ($result);
// $pureftpwho_path = $array["value"];
