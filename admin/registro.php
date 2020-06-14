<?php
require("config/conexaoADM.php");
 
if (!empty($_POST)) {
    if (empty($_POST['username'])) {
    }
    if (empty($_POST['password'])) {
        die("Por favor insira uma senha.");
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Endereço de email invalido");
    }

//############################################################################\\

    $query = "
        SELECT
            1
        FROM users
        WHERE
            username = :username
    ";

    $query_params = array(
        ':username' => $_POST['username']
    );
    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {

        die("Falha ao executar a consulta: " . $ex->getMessage());
    }
    $row = $stmt->fetch();
	
    if ($row) {
        die("este nome de usuário já está em uso");
    }

//############################################################################\\

    $query = "
        SELECT
            1
        FROM users
        WHERE
            email = :email
    ";

    $query_params = array(
        ':email' => $_POST['email']
    );
    try { 
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        die("Falha ao executar a consulta: " . $ex->getMessage());
    }
    $row = $stmt->fetch();

    if($row) {
        die("Este endereço de e-mail já está registrado");
    }
//############################################################################\\

    $query = "
        INSERT INTO users (
            username,
            password,
            salt,
            email
        ) VALUES (
            :username,
            :password,
            :salt,
            :email
        )	
    ";

    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
    $password = hash('sha256', $_POST['password'] . $salt);
    for($round = 0; $round < 65536; $round++) { 
        $password = hash('sha256', $password . $salt);
    }

    $query_params = array(
        ':username' => $_POST['username'],
        ':password' => $password,
        ':salt' => $salt,
        ':email' => $_POST['email']
    );

    try { 
        // Execute the query to create the user
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }
    echo "
        <script type='text/javascript'>
        alert('Conta Criada Com Sucesso!');
        window.location.href='login.php';
        </script>";

    die("Redirecting to login.php");
}

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Elsa, a multipurpose Template from Andreas Lautenschlager">
    <meta name="author" content="Andreas Lautenschlager - www.lautenschlager.de">

    <title>Editar Conta</title>

    <!-- normalize core CSS -->
    <link href="css/normalize.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="../../../../wamp64/www/wamp/Projetos/zupy-Login/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../wamp64/www/wamp/Projetos/zupy-Login/bootstrap/css/carousel.css" rel="stylesheet">
    <link href="../../../../wamp64/www/wamp/Projetos/zupy-Login/bootstrap/fonts/glyphicons-halflings-regular.eot" rel="stylesheet">

    <!-- Load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../../../wamp64/www/wamp/Projetos/zupy-Login/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <script src="../../../../wamp64/www/wamp/Projetos/zupy-Login/bootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- Google Fonts - Change if needed -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400italic,400,700,300,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Menu shrinking -->
    <script type="text/javascript" src="../../../../wamp64/www/wamp/Projetos/zupy-Login/js/menu.js"></script>

    <!-- Main styles of this template -->
    <link href="css/style.min.css?v=1.0.0" rel="stylesheet">

    <!-- Custom CSS. Input here your changes -->
    <link href="css/custom.css" rel="stylesheet">

</head>

<body>


    <!-- Navigation -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <nav class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php">Tela de login</a></li>
                </ul>
            </nav>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </div>


    <!-- CONTAKT US-->
    <section class="page-section">
        <div class="container">
            <div class="row ">

                <div class="col-md-8">
					<br>
					<br>
                    <h2 class="title-section"><span class="title-regular">Registrar Conta</span></h2>
                    <hr class="title-underline " />
					<form action="registro.php" method="post">

					<p>Nome</p>
                    <div class="form-group">
                        <input type="text" class="form-control" id="usr" placeholder="Nome" name="username">
                    </div>

					<p>Email</p>
					<div class="form-group">
                        <input type="text" class="form-control" id="usr" placeholder="Email" name="email">
                    </div>

					<p>Senha</p>
                    <div class="form-group">
                        <input type="password" class="form-control" id="email" placeholder="Senha" name="password" value="password">
                    </div>

                    <button type="submit" value="Registrar" class="btn btn-default">Criar <i class="far fa-address-card"></i></button>
					</form>
                </div>
            </div>
        </div>
    </section>


    <!-- Loads Bootstrap Main JS -->
    <script src="../../../../wamp64/www/wamp/Projetos/zupy-Login/bootstrap/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../wamp64/www/wamp/Projetos/zupy-Login/bootstrap/js/ie10-viewport-bug-workaround.js"></script>


</body>

</html>