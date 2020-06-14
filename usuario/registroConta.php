 <?php

include("config/conexao.php");
$submitted_username = '';
session_start();

if(empty($_POST['name']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$email = mysqli_escape_string($conexao, $_POST['email']);
$name = mysqli_escape_string($conexao, $_POST['name']);
$password = mysqli_escape_string($conexao, $_POST['password']);

$queryConfere = "select * from users where email = '{$email}'";
$query = "";

$result = mysqli_query($conexao, $queryConfere);

$row = mysqli_num_rows($result);

if($row>0) {
    echo "
        <script type='text/javascript'>
        alert('Email Já Registrado');
        window.location.href='createacc.php';
        </script>";

    die("Redirecting to createacc.php");
    header('location: createacc.php');
    exit;
} else {
    $query = "
        INSERT INTO users (
            name,
            email,
            password
        ) VALUES (
            '$name',
            '$email',
            '$password'
        )	
    ";

}

try {
    // Execute the query to create the user
    mysqli_query($conexao, $query);
    echo "
        <script type='text/javascript'>
        alert('Conta Criada Com Sucesso!');
        window.location.href='index.php';
        </script>";

    die("Redirecting to index.php");

} catch(PDOException $ex) {
    die("Failed to run query: " . $ex->getMessage());
}

?>


