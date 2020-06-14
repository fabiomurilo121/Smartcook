<?php
include('verification.php');
include('config/conexao.php');

if (empty($_SESSION['id'])) {
    header("Location: index.php");
    die("Redirecting to index.php");
}
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$consulta = "SELECT * FROM recipes WHERE id = '$id'";
$resultado = $conexao -> query($consulta) or die($conexao -> error);


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Receita</title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/assets-dashboard/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="assets/css-lucas/main.css">
  </head>
  <body id="home">
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
                    <li class="active">Receita</li>
                </ul>
            </div>
        </div>
    </section>
<!-- breadcrumbs //-->


<section class="w3l-content-with-photo-4">
    <div class="content-with-photo4-block">
        <div class="container">
            <div class="cwp4-two row">

            <div class="col-xl-6 cwp4-image ">
                <img src="assets/assets-dashboard/images/b3.jpg" alt="product" class="img-responsive ">
            </div>
                <div class="cwp4-text col-xl-6">
                    <h4></h4>
                    <p class="para">Mollitia placeat modi explicabo voluptatum  adipisci Quisquam exercit tionem praesentium suscipit.unde Dicta, provident!
                        Rem adipisci Mollitia placeat modi explicabo voluptatum corporis unde? Dicta, provident!
                       
                    </p>
                    <div class="jst-two-coloums mt-4">
                        <div class="icon-text">
                            <h5> <a href="#" >Social media marketing</a>
                            </h5>
                            <p class="para">consectetur adipisicing ducimus aperiam explicabo similique. Nulla nobis neque esse laudantium, cum odit error quidem amet</p>
                       </div>
                        <div class="icon-text mt-lx-3 pt-lx-1">
                            <h5 ><a href="#" >Business Analytics</a>
                            </h5>
                            <p class="para">consectetur adipisicing ducimus aperiam explicabo similique. Nulla nobis neque esse laudantium, cum odit error quidem amet</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

   				<section class="w3l-recent-work-hobbies">
   				    <div class="recent-work ">
   				        <div class="container">
<div class="left-text">
	<h3>We Are Digital Explorers</h3>
	<p class="para">Consectetur Lorem ipsum dolor sit amet adipisicing elit. Recusandae nulla beatae exercitationem iusto dolore animi, voluptatem inventore minima corporis asperiores dicta molestiae dolorum quod numquam iure ipsam nostrum tempore porro Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti possimus culpa nemo asperiores aperiam mollitia, maiores, modi facilis atque consequuntur hic officia unde, fugiat tempora? Vero est aliquid nisi fugit.</p>
</div>
<div class="row about-about">
	<div class="col-lg-4 col-md-6">
		<div class="about-grids">
<h4>Who we are</h4>
<p class="para">Sit amet consectetur adipisicing elit. Rem quibusdam corporis, dolores quos, nobis culpa est praesentium ipsum </p>
<div class="mt-3 about-list">
	<ul>
		<li ><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para"> Rem quibusdam corporis</p>
		
		</li>
		<li><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para">laudantium dolores</p>
		</li>
		<li><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para">laudantium dolores</p>
		</li>
	</ul>
</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 about-line-top">
		<div class="about-grids">
<h4>Our History</h4>
<p class="para">Sit amet consectetur adipisicing elit. Rem quibusdam corporis, dolores quos, nobis culpa est praesentium ipsum </p>
<div class="mt-3 about-list">
	<ul>
		<li ><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para"> Rem quibusdam corporis</p>
		
		</li>
		<li><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para">laudantium dolores</p>
		</li>
		<li><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para">laudantium dolores</p>
		</li>
	</ul>
</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 about-line-top">
		<div class="about-grids">
<h4>Our Mission</h4>
<p class="para">Sit amet consectetur adipisicing elit. Rem quibusdam corporis, dolores quos, nobis culpa est praesentium ipsum </p>
<div class="mt-3 about-list">
	<ul>
		<li ><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para"> Rem quibusdam corporis</p>
		
		</li>
		<li><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para">laudantium dolores</p>
		</li>
		<li><span class="fa fa-chevron-circle-right" aria-hidden="true"></span>
			<p class="para">laudantium dolores</p>
		</li>
	</ul>
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