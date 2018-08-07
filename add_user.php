<?php

require 'functions.php';
require 'config.php';
require 'vendor/autoload.php';

require 'prologue.php';

$info = '';

if (count($_POST) > 0) {
    if (isset($_POST['User'])) {
        $User = $_POST['User'];
        if ($User == '') {
            unset($User);
        }
    }
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        if ($status == '') {
            unset($status);
        }
    }
    if (isset($_POST['Password'])) {
        $Password = $_POST['Password'];
        if ($Password == '') {
            unset($Password);
        }
    }
    if (isset($_POST['Dir'])) {
        $Dir = $_POST['Dir'];
        if ($Dir == '') {
            unset($Dir);
        }
    }
    if (isset($_POST['Uid'])) {
        $Uid = $_POST['Uid'];
    }
    if (isset($_POST['Gid'])) {
        $Gid = $_POST['Gid'];
    }
    if (isset($_POST['ULBandwidth'])) {
        $ULBandwidth = $_POST['ULBandwidth'];
        if ($ULBandwidth == '') {
            unset($ULBandwidth);
        }
    }
    if (isset($_POST['DLBandwidth'])) {
        $DLBandwidth = $_POST['DLBandwidth'];
        if ($DLBandwidth == '') {
            unset($DLBandwidth);
        }
    }
    if (isset($_POST['ipaccess'])) {
        $ipaccess = $_POST['ipaccess'];
        if ($ipaccess == '') {
            unset($ipaccess);
        }
    }
    if (isset($_POST['quotasize'])) {
        $quotasize = $_POST['quotasize'];
        if ($quotasize == '') {
            unset($quotasize);
        }
    }
    if (isset($_POST['quotafiles'])) {
        $quotafiles = $_POST['quotafiles'];
        if ($quotafiles == '') {
            unset($quotafiles);
        }
    }

    if (!isset($Dir)) {
        $Dir = $settings['ftp_dir'];
    }
    if (!isset($ULBandwidth)) {
        $ULBandwidth = $settings['upload_speed'];
    }
    if (!isset($DLBandwidth)) {
        $DLBandwidth = $settings['download_speed'];
    }
    if (!isset($ipaccess)) {
        $ipaccess = $settings['permitted_ip'];
    }
    if (!isset($quotasize)) {
        $quotasize = $settings['quota_size'];
    }
    if (!isset($quotafiles)) {
        $quotafiles = $settings['quota_files'];
    }

    if (isset($User) && isset($status) && isset($Password) && isset($Uid) && isset($Gid) && isset($Dir) && isset($DLBandwidth) && isset($ULBandwidth) && isset($ipaccess) && isset($quotasize) && isset($quotafiles)) {
        $sql = 'INSERT INTO ftpd (User, status, Password, Uid, Gid, Dir, ULBandwidth, DLBandwidth, ipaccess, QuotaSize, QuotaFiles, comment)
                VALUES (?, ?, md5(?), ?, ?, ?, ?, ?, ?, ?, ?, "")';
    
        $sth = $dbh->prepare($sql);
        $queryParameters = [$User, $status, $Password, $Uid, $Gid, $Dir, $DLBandwidth, $ULBandwidth, $ipaccess, $quotasize, $quotafiles];
        $sth->execute($queryParameters);
        
        header('Location: /edit_users.php');
    }
}


$template = $twig->load('edit_user.twig');
$variables = [
    'user' => $_SERVER['PHP_AUTH_USER'],
    'tab' => 'edit_users',
    'trans' => $translations,
    'version' => $version,
];
echo $template->render($variables);
