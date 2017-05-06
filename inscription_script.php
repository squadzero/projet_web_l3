<?php
		include('connexionBD.php');
		if( isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['mdp2']) && /*isset($_POST['sexe'])
			&& */(trim($_POST['login'])!='') && (trim($_POST['mdp'])!=''))
		{
			try
			{
				$date = date("Y-m-d");
				$_POST['sexe'] = 'M'; //A changer apres insertion formulaire radio button
				
				$req = $db->prepare('INSERT INTO utilisateurs VALUES(:pseudo, :pwd, :date_insc, :sexe);');
				$req->bindValue(':pseudo', $_POST['login']);
				$req->bindValue(':pwd', sha1($_POST['mdp']));
				$req->bindValue(':date_insc', $date);
				$req->bindValue(':sexe', $_POST['sexe']);

				$req->execute();
				header("location: inscription.php");
			}
			catch(PDOException $e)
			{
				die('Erreur: '.$e->getMessage() );
			}
		}
		else
		{
			echo 'Veuillez renseigner tous les champs';
		}
?>