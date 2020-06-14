<?php
$username = "root";
$password = "";
$host = "localhost";
$dbname = "zupy";

try {
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
}
catch (PDOException $ex) {
    die("Falha ao conectar ao banco de dados: " . $ex->getMessage());
}

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


header('Content-Type: text/html; charset=utf-8');

session_start();

?>