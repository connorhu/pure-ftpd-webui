<?php

$version = '0.3.0';

if (!isset($_SERVER['APP_ENV'])) {
    notConfigured();
} else {
    define('APP_ENV', $_SERVER['APP_ENV']);
}

if (!isset($_SERVER['DATABASE_URL'])) {
    notConfigured();
} else {
    define('DATABASE_URL', $_SERVER['DATABASE_URL']);
}

$trust_http_auth = false;
