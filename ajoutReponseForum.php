<?php
	include('connexionBD.php');
	session_start();
	
	if( isset($_POST['reponse']) && (trim($_POST['reponse'])!='') )
	{
		try
		{
			$req = $db->prepare("SELECT MAX(ID_RPS) as MAX_ID FROM reponses");
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
			
			$idMax = $res['MAX_ID'];
			$newId = $idMax+1;
			
			$pseudo = $_SESSION['login'];
			$datePost = date('Y-m-d');
			
			
			$req2 = $db->prepare("INSERT INTO reponses VALUES(:idRep, :pseudo, :idMsg, :txtRep, :dateRep;");
			$req2->bindValue('idRep', $newId);
			$req2->bindValue('pseudo', $pseudo);
			$req2->bindValue('idMsg', $ );
			$req2->bindValue('txtRep', $_POST['message']);
			$req2->bindValue('dateRep', $datePost);
			
			$req->execute();
			header('location: forumpost.php');
		}
		catch(PDOException $e)
		{
			die('Erreur: '.$e->getMessage() );
		}
	}
	else
		header('location: forumpost.php');
		
?> 