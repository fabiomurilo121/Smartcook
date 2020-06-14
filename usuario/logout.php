<?php
include('verification.php');

session_destroy();

header("Location: index.php");
?>