<?php
		include('connexionBD.php');
		if( isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['mdp2']) && ( isset($_POST['homme']) || isset($_POST['femme']))
			&& (trim($_POST['login'])!='') && (trim($_POST['mdp'])!=''))
		{
			try
			{
				$req = $db->prepare('SELECT PSEUDO FROM utilisateurs WHERE PSEUDO=:pseudo;');
				$req->bindValue(':pseudo', $_POST['login']);
				$req->execute();
				$res = $req->fetch(PDO::FETCH_ASSOC);
				
				if(!$res) //s'il n'y a pas d'utilisateur deja avec ce pseudo
				{				
					print_r($_POST);
					$date = date("Y-m-d");
					$sexe;
					if( isset($_POST['homme']))
						$sexe = 'M';
					else if (isset($_POST['femme']))
						$sexe = 'F';
					echo $sexe;
					$req2 = $db->prepare('INSERT INTO utilisateurs VALUES(:pseudo, :pwd, :date_insc, :sexe);');
					$req2->bindValue(':pseudo', $_POST['login']);
					$req2->bindValue(':pwd', sha1($_POST['mdp']));
					$req2->bindValue(':date_insc', $date);
					$req2->bindValue(':sexe', $sexe);

					$req2->execute();
					header("location: connexion.php");
				}
				else 
					echo 'Un autre utilisateur porte deja ce pseudo, veuillez en choisir un autre.';
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