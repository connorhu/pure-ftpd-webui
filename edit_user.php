<?php

require 'functions.php';
require 'config.php';
require 'vendor/autoload.php';

require 'prologue.php';

$info = '';

$id = (int) $_GET['id'];

$sql = 'SELECT * FROM ftpd WHERE id = ?';
$sth = $dbh->prepare($sql);
$sth->execute([$id]);
$result = $sth->fetchAll();
if (count($result) == 0) {
    header('Location: /edit_users.php');
    exit;
}

$template = $twig->load('edit_user.twig');
$variables = [
    'user' => $_SERVER['PHP_AUTH_USER'],
    'tab' => 'edit_users',
    'trans' => $translations,
    'user' => $result[0],
    'version' => $version,
];
echo $template->render($variables);
