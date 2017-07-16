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
    CREATE TABLE users (
        id int(10) unsigned NOT NULL AUTO_INCREMENT,
        email varchar(255) NOT NULL DEFAULT '',
        forename varchar(255) NOT NULL DEFAULT '',
        surname varchar(255) NOT NULL DEFAULT '',
        created int(10) unsigned NOT NULL,
        updated int(10) unsigned NOT NULL,
      PRIMARY KEY (id),
      UNIQUE KEY email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$query->execute();
