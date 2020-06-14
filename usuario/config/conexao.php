<?php

    define('HOST', 'localhost');
    define('USUARIO', 'root');
    define('SENHA', '');
    define('BD', 'smartcook');

    $conexao = mysqli_connect(HOST, USUARIO, SENHA, BD) or die ('erro na conexao');

?>
