<?php
include 'config.php';

$pdo = new PDO($DBType . ':dbname='. $DBName .';host=' . $DBHost . '', $DBLogin, $DBPassword);

try {
    $pdo = new PDO($DBType . ':dbname='. $DBName .';host=' . $DBHost . '', $DBLogin, $DBPassword);
} catch (PDOException $e) {
    die($e->getMessage());
}