<?php
	session_start();
	include('connexionBD.php');
	
	if( isset($_POST['idEp']) && (trim($_POST['idEp']) !='') && isset($_POST['commentaire']) && (trim($_POST['commentaire']) != '')/* && isset($_POST['note'])*/)
	{
		try
		{
			$pseudo = $_SESSION['login'];
			$serie = $_POST['idEp'];
			$com = $_POST['commentaire'];
			$note = 5;
			$date = date('Y-m-d');
		
			$req = $db->prepare("INSERT INTO noter_episodes VALUES(:pseudo, :epidode, :saison, :idSerie,  :note, :com, :date);");
			$req->bindValue(':pseudo', $pseudo);
			$req->bindValue(':serie', $episode);
			$req->bindValue(':note', $note);
			$req->bindValue(':com', $com);
			$req->bindValue(':date', $date);
			$req->execute();
			
			header('location: episode.php?idEp'.$_POST['idEp'].'');
		}
		catch(PDOException $e)
		{
			die('Erreur: '.$e->getMessage() );
		}
	}
	else
		header('location: episode.php?idEp'.$_POST['idEp'].'');
?>