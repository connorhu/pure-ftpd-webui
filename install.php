<?php
require 'functions.php';
require 'config.php';
require 'vendor/autoload.php';

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

$templateName = 'install_step1.twig';
$variables = ['version' => $version];

if (isset($_GET['step']) && $_GET['step'] == 1) {
    $templateName = 'install_step2.twig';
    $variables = [];
} elseif (isset($_GET['step']) && $_GET['step'] == 2) {
    $dbh = connectDatabase();
    
    $sql = 'SELECT count(id) cnt FROM userlist';
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $users = $sth->fetchAll();
    
    if (count($users) === 0) {
        notConfigured('load scheme.sql');
        exit;
    }
    
    if ($users[0]['cnt'] > 0) {
        header('Location: /');
    }
    
    var_dump($_POST);
    
    $queryParameters = [
        $_POST['webui_admin'],
        password_hash($_POST['webui_admin_passwd'], PASSWORD_BCRYPT),
    ];
    
    $sql = 'INSERT INTO userlist (user, pass, language) VALUES (?, ?, "en")';
    $sth = $dbh->prepare($sql);
    $sth->execute($queryParameters);
    
    $templateName = 'install_step3.twig';
    $variables = [];
}

$template = $twig->load($templateName);
echo $template->render($variables);
