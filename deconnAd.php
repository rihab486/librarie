<?php
	session_start();
	$_SESSION = array();
	session_destroy(); 
	header("Location: acceAdministrateur.php"); //tarja3 win da5alit il email mdp
	?>
