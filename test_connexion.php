<?php
include('connexionBD.php');

		//si l'utilisateur existe
		if( isset($_POST['mail']) && (trim($_POST['mail'])) 
			&& isset($_POST['mdp']) && (trim($_POST['mdp'])))
		{
			try
			{
				$req = $db->prepare("SELECT PWD FROM utilisateurs
									WHERE PSEUDO=:pseudo");
				$req->bindValue(':pseudo', htmlspecialchars($_POST['mail']));
				$req->execute();
				$res = $req->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e)
			{
				die( 'Erreur : ' . $e->getMessage());
			}
			
			if(!$res) // si il n'y a pas de resultat a la requete
			{
				echo 'Mauvais identifiant';
			}
			else 
			{
				if(sha1($_POST['mdp']) != $res['PWD'])
				{
					echo 'Mauvais mot de passe';
				}
				else
				{
					session_start();
					$_SESSION['login'] = $_POST['mail'];
					// redirection
					header('location: index.php');
				}
			}
		}
		else
		{
			echo 'Veillez a bien completer les champs de saisie';
		}
?>