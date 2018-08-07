<?php
require 'functions.php';
require 'config.php';
require 'vendor/autoload.php';

require 'prologue.php';

$info = '';

$content = @file_get_contents('http://localhost:3000');
if ($content === null) {
    $content = [];
}
if (isset($_GET['update'])) {
    echo $content;
    exit;
} else {
    $content = json_decode($content, true);
}

$template = $twig->load('main.twig');
$variables = [
    'user' => $_SERVER['PHP_AUTH_USER'],
    'tab' => 'main',
    'trans' => $translations,
    'version' => $version,
    'activity' => $content,
];
echo $template->render($variables);
