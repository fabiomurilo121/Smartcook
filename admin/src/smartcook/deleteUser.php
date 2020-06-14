<?php
require '../../config/conexaoUSR.php';

$id = $_GET['id'];

try {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo $stmt->rowCount();
    header("Location: listaUsuario.php");
    Banco::desconectar();
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

