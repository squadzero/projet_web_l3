<?php
	// Ligne a changer pour se connecter a marseille
	define('DB_HOST','db681360813.db.1and1.com'); 
	define('DB_NAME','db681360813'); 
	define('DB_USER','dbo681360813'); 
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
		die('<p> Connexion échouée. Erreur['.$e->getCode().'] : '.$e->getMessage().'</p>');
	}
?>
