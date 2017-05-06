<?php

	include('connexionBD.php');

	function estConnecte()
	{
		if( session_status() == PHP_SESSION_ACTIVE)
		{
			if( isset($_SESSION['login']) && trim($_SESSION['login']) != '')
				return true;
		}
	}
	
	function ajouteCritique()
	{
	
	}
	
	
	
?>
