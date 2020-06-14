<?php
require("config/conexaoADM.php");
$submitted_username = '';

if (!empty($_POST)) {
    $query = "
        SELECT
            id,
            username,
            password,
            salt,
            email
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
        die("Failed to run query: " . $ex->getMessage());
    }

    $login_ok = false;

    $row = $stmt->fetch();
    if ($row) { 
        $check_password = hash('sha256', $_POST['password'] . $row['salt']);
        for ($round = 0; $round < 65536; $round++) {
            $check_password = hash('sha256', $check_password . $row['salt']);
        }
        if ($check_password === $row['password']) { 
            // If they do, then we flip this to true
            $login_ok = true;
        }
    }

    if ($login_ok) { 
        unset($row['salt']);
        unset($row['password']);
        $_SESSION['user'] = $row;

        header("Location: src/smartcook/admin.php");
        die("Redirecting to: src/smartcook/admin.php");
    }
    else {
        print("Falha no Login. <br />");
        $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
		
    }
}
?>



<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Login</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/login-assets/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/login-assets/css/login.css">
</head>

<body>
	
    <section class="hero is-success is-fullheight">
	
        <div class="hero-body">
		
            <div class="container has-text-centered">
			<img src="assets/login-assets/imagem/cake.png">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Sistema de Login</h3>
                    <div class="box">
                        <form action="login.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="username" name="text" class="input is-large" placeholder="Seu usuário" autofocus="" value="<?php echo $submitted_username; ?>" >
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="password" class="input is-large" type="password" placeholder="Sua senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>