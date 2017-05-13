<?php
	echo'<meta charset="utf-8" />';
	session_start();
	include('connexionBD.php');
	
	if( isset($_POST['idSerie']) && (trim($_POST['idSerie']) !='') && isset($_POST['commentaire']) && (trim($_POST['commentaire']) != '') && isset($_POST['note']) )
	{
		try
		{
			$pseudo = $_SESSION['login'];
			$serie = $_POST['idSerie'];
			$com = $_POST['commentaire'];
			$note = $_POST['note'];
			$date = date('Y-m-d');
		
			$req2 = $db->prepare("SELECT PSEUDO, ID_SERIE FROM noter_series WHERE PSEUDO=:pseudo AND ID_SERIE=:idSerie;");
			$req2->bindValue(':pseudo',$pseudo);
			$req2->bindValue(':idSerie', $serie);
			$req2->execute();
			$res2 = $req2->fetch(PDO::FETCH_ASSOC);
			
			if(!$res2) //Si l'utilisateur n'as pas deja commenter la serie
			{
				$req = $db->prepare("INSERT INTO noter_series VALUES(:pseudo, :serie, :note, :com, :date);");
				$req->bindValue(':pseudo', $pseudo);
				$req->bindValue(':serie', $serie);
				$req->bindValue(':note', $note);
				$req->bindValue(':com', $com);
				$req->bindValue(':date', $date);
				$req->execute();
				
				header('location: item.php?idSerie='.$_POST['idSerie'].'');
			}
			echo 'Vous avez déjà commenté cette série';
		}
		catch(PDOException $e)
		{
			die('Erreur: '.$e->getMessage() );
		}
	}
	else
		header('location: item.php?idSerie='.$_POST['idSerie'].'');
?>