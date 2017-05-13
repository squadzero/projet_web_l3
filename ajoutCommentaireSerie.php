<?php
	session_start();
	include('connexionBD.php');
	
	if( isset($_POST['idSerie']) && (trim($_POST['idSerie']) !='') && isset($_POST['commentaire']) && (trim($_POST['commentaire']) != '')/* && isset($_POST['note'])*/)
	{
		try
		{
			$pseudo = $_SESSION['login'];
			$serie = $_POST['idSerie'];
			$com = $_POST['commentaire'];
			$note = 5;
			$date = date('Y-m-d');
		
			$req = $db->prepare("INSERT INTO noter_series VALUES(:pseudo, :serie, :note, :com, :date);");
			$req->bindValue(':pseudo', $pseudo);
			$req->bindValue(':serie', $serie);
			$req->bindValue(':note', $note);
			$req->bindValue(':com', $com);
			$req->bindValue(':date', $date);
			$req->execute();
			
			header('location: item.php?idSerie='.$_POST['idSerie'].'');
		}
		catch(PDOException $e)
		{
			die('Erreur: '.$e->getMessage() );
		}
	}
	else
		header('location: item.php?idSerie'.$_POST['idSerie'].'');
?>