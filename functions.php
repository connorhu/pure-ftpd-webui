<?php

function notConfigured()
{
    header('HTTP/1.0 500 Internal Server Error');
    echo 'Configure the application.';
    exit;
}

function connectDatabase()
{
    $connectionParameters = parse_url(DATABASE_URL);
    
    $dsn = sprintf('%s:dbname=%s;host=%s', $connectionParameters['scheme'], substr($connectionParameters['path'], 1), $connectionParameters['host']);
    $password = isset($connectionParameters['pass']) ? $connectionParameters['pass'] : '';
    
    try {
        $dbh = new PDO($dsn, $connectionParameters['user'], $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
    
    return $dbh;
}
