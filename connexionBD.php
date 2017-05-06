<?php
	// Ligne a changer pour se connecter a marseille
	define('DB_HOST','localhost'); 
	define('DB_NAME','projetweb'); 
	define('DB_USER','root'); 
	define('DB_PASS','');
	
	global $db;
	
	try
	{
		$db = new PDO('mysql:host=' .DB_HOST.';dbname=' .DB_NAME, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->query('SET NAMES utf8');
	}
	catch(PDOException $e)
	{
		echo 'DATABASE IS BROKEN MADAFAKA';
		die('<p> Connexion échoué. Erreur['.$e->getCode().'] : '.$e->getMessage().'</p>');
	}
?>