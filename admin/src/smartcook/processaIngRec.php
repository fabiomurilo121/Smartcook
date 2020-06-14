<?php
require '../../config/conexaoUSR.php';
$pdo = Banco::conectar();

$ingred = $_POST['ingredi'];
$id = $_GET['id'];

try {
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO ingredientrecipes (ingredientId, recipeId) VALUES ($ingred,$id)";
    // use exec() because no results are returned
    $pdo->exec($sql);
    //echo "New record created successfully";
    header("Location: addIngrediente.php?id={$id}");
} catch(PDOException $e) {
    echo "SELECIONE UM INGREDIENTE";
    echo "<br>";
}

$pdo = null;
?>
