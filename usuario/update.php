<?php 

require('config/conexao.php');
require ('verification.php');

if($_POST) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$id = $_GET['id'];

	$sql  = "UPDATE users SET  name = '$name', email = '$email', password = '$senha' WHERE id = {$id}";

    $_SESSION['name'] = $name["name"];
    $_SESSION['email'] = $email["email"];
    $_SESSION['pass'] = $senha["pass"];
	if($conexao->query($sql) === TRUE) {
        header("Location: perfil.php");
	} else {
		echo "Erorr while updating record : ". $conexao->error;
	}

    $conexao->close();

}

?>