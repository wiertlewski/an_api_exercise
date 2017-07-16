<?php

$pdo = new \Pdo('mysql:host=127.0.0.1;charset=utf8', 'root', 'password', [
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
