<?php
require("../../config/conexaoADM.php");

if (empty($_SESSION['user'])) {
    header("Location: ../login.php");

    die("Redirecting to login.php");
}

if (!empty($_POST)) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Endereço de email invalido");
    }

    if ($_POST['email'] != $_SESSION['user']['email']) {
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
        if ($row) {
            die("Este endereço de e-mail já está em uso");
        }
    }

    if (!empty($_POST['password'])) {
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $_POST['password'] . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $password = hash('sha256', $password . $salt);
        }
    }
    else {
        $password = null;
        $salt = null;
    }

    $query_params = array(
        ':email' => $_POST['email'],
        ':user_id' => $_SESSION['user']['id'],
    );

    if ($password !== null) {
        $query_params[':password'] = $password;
        $query_params[':salt'] = $salt;
    }

    $query = "
        UPDATE users
        SET
            email = :email
    ";

    if ($password !== null) {
        $query .= "
            , password = :password
            , salt = :salt
        ";
    }

    $query .= "
        WHERE
            id = :user_id
    ";

    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        die("Falha ao executar a consulta: " . $ex->getMessage());
    }

    $_SESSION['user']['email'] = $_POST['email'];

    try {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex) {
        die("Falha ao executar a consulta: " . $ex->getMessage());
    }
    echo "
        <script type='text/javascript'>
        alert('Conta Modificada Com Sucesso!');
        window.location.href='perfil.php';
        </script>";

    die("Redirecionando para Perfil");
    header("Location: index");

}
?>

<!doctype html>
<html lang="pt-0">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Perfil</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="../../assets/dashboard-assets/css/style-starter.css">

    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
<div class="se-pre-con"></div>
<section>
    <!-- sidebar menu start -->
    <div class="sidebar-menu sticky-sidebar-menu">

        <!-- logo start -->
        <div class="logo">
            <h1><a href="../../login.php">SmartCook</a></h1>
        </div>

        <div class="logo-icon text-center">
            <a href="../../login.php" title="logo"><img src="../../assets/dashboard-assets/images/logo.png" alt="logo-icon"> </a>
        </div>
        <!-- //logo end -->

        <div class="sidebar-menu-inner">

            <!-- sidebar nav start -->
            <ul class="nav nav-pills nav-stacked custom-nav">

                <li class="menu-list">
                    <a href="#"><i class="fa fa-plus-square"></i>
                        <span>Adicionar<i class="lnr lnr-chevron-right"></i></span></a>
                    <ul class="sub-menu-list">
                        <li><a href="admin.php">Adicionar Admin</a> </li>
                        <li><a href="usuario.php">Adicionar Usuário</a> </li>
                        <li><a href="receitas.php">Adicionar Receitas</a></li>
                        <li><a href="ingredientes.php">Adicionar Ingredientes</a></li>
                        <li><a href="associacao.php">Ingredientes-Receita</a></li>
                    </ul>
                </li>

                <li class="menu-list">
                    <a href="#"><i class="fa fa-database "></i>
                        <span>Listar<i class="lnr lnr-chevron-right"></i></span></a>
                    <ul class="sub-menu-list">
                        <li><a href="listaUsuario.php">Lista de Usuários</a> </li>
                        <li><a href="listaReceitas.php">Lista de receitas</a> </li>
                        <li><a href="listaIngrediente.php">Lista de Ingredientes</a> </li>
                    </ul>
                </li>

            </ul>
            <!-- //sidebar nav end -->
            <!-- toggle button start -->
            <a class="toggle-btn">
                <i class="fa fa-angle-double-left menu-collapsed__left"><span>Minimizar Barra</span></i>
                <i class="fa fa-angle-double-right menu-collapsed__right"></i>
            </a>
            <!-- //toggle button end -->
        </div>
    </div>

    <!-- header-starts -->
    <div class="header sticky-header">

        <!-- notification menu start -->
        <div class="menu-right">
            <div class="navbar user-panel-top">

                <div class="user-dropdown-details d-flex">
                    <div class="profile_details">
                        <ul>
                            <li class="dropdown profile_details_drop">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3" aria-haspopup="true"
                                   aria-expanded="false">
                                    <div class="profile_img">
                                        <img src="../../assets/dashboard-assets/images/profileimg.jpg" class="rounded-circle" alt="" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu drp-mnu" aria-labelledby="dropdownMenu3">
                                    <li class="user-info">
                                        <h5 class="user-name"><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                    </li>
                                    <!-- <li> <a href="#"><i class="lnr lnr-users"></i>1k Followers</a> </li> -->
                                    <li> <a href="perfil.php"><i class="lnr lnr-cog"></i>Configurações</a> </li>
                                    <!-- <li> <a href="#"><i class="lnr lnr-heart"></i>100 Likes</a> </li> -->
                                    <li class="logout"> <a href="../../logout.php"><i class="fa fa-power-off"></i> Sair</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--notification menu end -->
    </div>
    <!-- //header-ends -->


    <!-- main content start -->
    <div class="main-content">

        <!-- content -->
        <div class="container-fluid content-top-gap">

            <!-- breadcrumbs -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb my-breadcrumb">
                    <li class="breadcrumb-item"><a>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pefil</li>
                </ol>
            </nav>
            <!-- //breadcrumbs -->
            <!-- forms -->
            <section class="forms">

                <!-- forms 2 -->
                <div class="card card_border py-2 mb-4">
                    <div class="cards__heading">
                        <h3>Seu Perfil <span></span></h3>
                    </div>
                    <div class="card-body">
                        <form action="perfil.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4" class="input__label">Email</label>
                                    <input type="email" class="form-control input-style"
                                           placeholder="Seu Nome" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4" class="input__label">Password</label>
                                    <input type="text" name="password" class="form-control input-style" placeholder="Sua Nova Senha">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-style mt-4">Atualizar</button>
                        </form>
                    </div>
                </div>
                <!-- //forms 2 -->

            </section>
            <!-- //forms -->
</section>
<!-- //forms  -->

</div>
<!-- //content -->

</div>
<!-- main content end-->
</section>
<!--footer section start-->
<footer class="dashboard">
    <p>&copy 2020 . Todos os Direitos Reservados | Desenvolvido pela equipe Smartcook</p>
</footer>
<!--footer section end-->
<!-- move top -->
<button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
    <span class="fa fa-angle-up"></span>
</button>
<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("movetop").style.display = "block";
        } else {
            document.getElementById("movetop").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
<!-- /move top -->


<script src="../../assets/dashboard-assets/js/jquery-3.3.1.min.js"></script>
<script src="../../assets/dashboard-assets/js/jquery-1.10.2.min.js"></script>

<!-- chart js -->
<script src="../../assets/dashboard-assets/js/Chart.min.js"></script>
<script src="../../assets/dashboard-assets/js/utils.js"></script>
<!-- //chart js -->

<!-- Different scripts of charts.  Ex.Barchart, Linechart -->
<script src="../../assets/dashboard-assets/js/bar.js"></script>
<script src="../../assets/dashboard-assets/js/linechart.js"></script>
<!-- //Different scripts of charts.  Ex.Barchart, Linechart -->


<script src="../../assets/dashboard-assets/js/jquery.nicescroll.js"></script>
<script src="../../assets/dashboard-assets/js/scripts.js"></script>

<!-- close script -->
<script>
    var closebtns = document.getElementsByClassName("close-grid");
    var i;

    for (i = 0; i < closebtns.length; i++) {
        closebtns[i].addEventListener("click", function () {
            this.parentElement.style.display = 'none';
        });
    }
</script>
<!-- //close script -->

<!-- disable body scroll when navbar is in active -->
<script>
    $(function () {
        $('.sidebar-menu-collapsed').click(function () {
            $('body').toggleClass('noscroll');
        })
    });
</script>
<!-- disable body scroll when navbar is in active -->

<!-- loading-gif Js -->
<script src="../../assets/dashboard-assets/js/modernizr.js"></script>
<script>
    $(window).load(function () {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
<!--// loading-gif Js -->

<!-- Bootstrap Core JavaScript -->
<script src="../../assets/dashboard-assets/js/bootstrap.min.js"></script>


</body>

</html>