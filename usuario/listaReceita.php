<?php
include('verification.php');
include('config/conexao.php');

if (empty($_SESSION['id'])) {
    header("Location: index.php");

    die("Redirecting to index.php");
}

$id =$_SESSION["id"];

$consulta = "SELECT * FROM recipes";
$resultado = $conexao -> query($consulta) or die($conexao -> error);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Lista Receita</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/assets-dashboard/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="assets/css-lucas/main.css">
  </head>
  <body id="home">
  <section class=" w3l-header-4 header-sticky">
      <header class="absolute-top">
          <div class="container">
              <nav class="navbar navbar-expand-lg navbar-light">
                  <h5><a class="navbar-brand" href="dashboard.php"><img src="assets/assets-dashboard/images/logo.png">

                      </a></h5>
                  <button class="navbar-toggler bg-gradient" type="button" data-toggle="collapse"
                          data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                          aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav">
                          <li class="nav-item">
                              <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="addimg.php">Adicionar Produto</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="listaReceita.php">Receitas</a>
                          </li>
                      </ul>
                      <ul class="navbar-nav search-righ">

                          <li class="nav-item"><a href="perfil.php?id=<?php echo $id?>" class="btn search-search"><i class="fa fa-user mr-2" aria-hidden="true"></i>Perfil</a></li>
                          <li class="nav-item">
                              <a class="nav-link" href="logout.php">Sair</a>
                          </li>
                      </ul>
                      <!-- search popup -->
                      <div id="search" class="pop-overlay">
                          <div class="popup">
                              <form action="#" method="GET" class="d-flex">
                                  <input type="search" placeholder="Search.." name="search" required="required" autofocus>
                                  <button type="submit">Search</button>
                                  <a class="close" href="#">&times;</a>
                              </form>
                          </div>
                      </div>
                      <!-- /search popup -->
                  </div>
          </div>

          </nav>
          </div>
      </header>
  </section>

    <script src="assets/assets-dashboard/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
    <!--bootstrap working-->
    <script src="assets/assets-dashboard/js/bootstrap.min.js"></script>
    <!-- //bootstrap working-->
<!-- disable body scroll which navbar is in active -->
<script>
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- disable body scroll which navbar is in active -->


<!-- breadcrumbs -->
    <section class="w3l-inner-banner-main">
        <div class="about-inner inner2">
            <div class="container seen-w3">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="dashboard.php">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a></li>
                    <li class="active">Lista de Receita</li>
                </ul>
            </div>
        </div>
    </section>
<!-- breadcrumbs //-->

  <section class="w3l-teams-15">
      <section class="w3l-specification-6">
          <div class="specification-layout">
              <div class="container">
                  <div class="main-titles-head">
                      <h3 class="header-name">Receitas
                      </h3>
                  </div>
                  <div class="limiter">
                      <div class="container-login100">
                          <div class="wrap-login100">

                              <table>
                                  <tr>
                                      <td class="name">Nome da receita</td>
                                      <td class="serves">Quantidade</td>
                                      <td class="foto">Foto</td>
                                  </tr>
                                  <?php while($dado = $resultado -> fetch_array()){ ?>
                                      <tr>
                                          <td class="name"><?php echo $dado["name"]; ?></td>
                                          <td class="quantidade"><?php echo $dado["serves"]; ?></td>
                                          <td class="link img"><a href="igredients.php?id=<?php echo $dado['id']; ?>"><img src="<?php echo $dado["link"];?>" ></a></td>
                                      </tr>
                                  <?php } ?>
                              </table>
                          </div>
                      </div>
                  </div>


              </div>
          </div>
          </div>
      </section>


</section>
<section class="w3l-footers-20">
    <div class="footers20">
        <div class="container">
            <div class=" row">
                <div class="grids-content col-lg-2 col-md-2 col-sm-6">
                    <h4>Smartcook</h4>
                    <div class="footer-nav">
                        <a href="dashboard.php" class="contact-para3">Home</a>
                        <a href="receita.php" class="contact-para3">Adicionar Produto</a>
                        <a href="listaReceita.php" class="contact-para3">Receitas</a>
                        <a href="perfil.php" class="contact-para3">Perfil</a>
                    </div>

                </div>

                <div class="col-lg-7 col-md-7 col-12 copyright-grid ">
                    <p class="copy-footer-29">© 2020 . Todos os Direitos Reservados | Desenvolvido pela equipe Smartcook</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- move top -->
<button onclick="topFunction()" id="movetop" title="Go to top">
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
</body>

</html>