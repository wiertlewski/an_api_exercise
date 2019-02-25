<?php

$host = isset($argv[1]) ? $argv[1] : false;
$username = isset($argv[2]) ? $argv[2] : false;
$password = isset($argv[3]) ? $argv[3] : false;

if (!$host || !$username || !$password) {
    echo 'Usage:' . PHP_EOL . 'php ' . $argv[0] . ' $host $username $password' . PHP_EOL;
    exit();
}

$pdo = new \Pdo("mysql:host=$host;charset=utf8", $username, $password, [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
]);

$query = $pdo->prepare("
    DROP DATABASE IF EXISTS an_api_exercise;
    CREATE DATABASE an_api_exercise;
    USE an_api_exercise;
    CREATE TABLE sizes (
        id int(10) unsigned NOT NULL AUTO_INCREMENT,
        size int(10) unsigned NOT NULL,
      PRIMARY KEY (id),
      UNIQUE KEY size (size)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    INSERT INTO sizes (id, size) VALUES
        (NULL, '250'),
        (NULL, '500'),
        (NULL, '1000'),
        (NULL, '2000'),
        (NULL, '5000');
");

$query->execute();
