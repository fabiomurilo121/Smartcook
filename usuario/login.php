<?php

include("config/conexao.php");
$submitted_username = '';
session_start();

if(empty($_POST['name']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$name = mysqli_escape_string($conexao, $_POST['name']);
$password = mysqli_escape_string($conexao, $_POST['password']);

$query = "select * from users where name = '{$name}' and password = '{$password}'";

$result = mysqli_query($conexao, $query);

$id = mysqli_fetch_array($result);

$row = mysqli_num_rows($result);

if($row>0) {
    $_SESSION['id'] = $id[0];
    header('location: dashboard.php');
    exit;
} else {
    $_SESSION['nao_autenticado'] = true;
    header('location: index.php');
    print("Falha no Login. <br />");
    exit;
}

?>