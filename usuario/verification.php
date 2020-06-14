<?php
session_start();
if(!isset($_SESSION)) {
	if(!$_SESSION['user']) {
	    header('index.php');
	    exit;
	}
}

?>