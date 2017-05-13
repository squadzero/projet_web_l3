<?php
	echo'<meta charset="utf-8" />';
	session_start();
	include('connexionBD.php');
	
	if( isset($_POST['idEp']) && (trim($_POST['idEp']) !='') && isset($_POST['commentaire']) && (trim($_POST['commentaire']) != '') && isset($_POST['note']) )
	{
		try
		{
			$pseudo = $_SESSION['login'];
			$episode = $_POST['idEp'];
			$com = $_POST['commentaire'];
			$note = $_POST['note'];
			$date = date('Y-m-d');
			
			
			$req2 = $db->prepare("SELECT SAISON_EP, ID_SERIE FROM episodes WHERE ID_EP=:idEp;");
			$req2->bindValue(':idEp', $episode);
			$req2->execute();
			$res2 = $req2->fetch(PDO::FETCH_ASSOC);
				
			$req3 = $db->prepare("SELECT PSEUDO, ID_EP, SAISON_EP, ID_SERIE FROM noter_episodes WHERE PSEUDO=:pseudo AND ID_EP=:idEp AND SAISON_EP=:saison AND ID_SERIE=:serie;");
			$req3->bindValue(':pseudo',$pseudo);
			$req3->bindValue(':idEp', $episode);
			$req3->bindValue('saison', $res2['SAISON_EP']);
			$req3->bindValue('serie', $res2['ID_SERIE']);
			$req3->execute();
			$res3 = $req3->fetch(PDO::FETCH_ASSOC);
		
			if(!$res3) //si l'utilisateur n'a pas encore commenté
			{				
				$req = $db->prepare("INSERT INTO noter_episodes VALUES(:pseudo, :episode, :saison, :idSerie,  :note, :com, :date);");
				$req->bindValue(':pseudo', $pseudo);
				$req->bindValue(':episode', $episode);
				$req->bindValue(':saison', $res2['SAISON_EP']);
				$req->bindValue(':idSerie', $res2['ID_SERIE']);
				$req->bindValue(':note', $note);
				$req->bindValue(':com', $com);
				$req->bindValue(':date', $date);
				$req->execute();
				
				header('location: episode.php?idEp='.$_POST['idEp'].'');
			}
			else 
				echo 'Vous avez déjà commenté cet épisode';
		}
		catch(PDOException $e)
		{
			die('Erreur: '.$e->getMessage() );
		}
	}
	else
		header('location: episode.php?idEp='.$_POST['idEp'].'');
?>