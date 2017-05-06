<?php
	
	session_start();
	// on detruit la session 
	session_destroy();
	// on redirige l'utilisateur
	header('location: index.php');

?>