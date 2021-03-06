
<?php include('header.php');?>
<?php include('navbar.php');?>

	
	<?php
	if( isset($_SESSION['login']) && (trim($_SESSION['login'])!='') )
	{
		try
		{
			$req = $db->prepare('SELECT PSEUDO, PWD, SEXE, DATE_INSC FROM utilisateurs WHERE PSEUDO=:pseudo;');
			$req->bindValue(':pseudo', $_SESSION['login']);
			
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			die( 'Erreur : ' . $e->getMessage());
		}
		
		$sexe;
		if( $res['SEXE'] == 'M')
			$sexe = 'Masculin';
		else if ($res['SEXE'] == 'F')
			$sexe = 'Féminim';
		
		$dateFormatSQL = $res['DATE_INSC'];
		$date = date("d-m-Y", strtotime($dateFormatSQL));
		
		echo'
		  <div class="container">
			<br>


			<div class="12 12 colonne-grande colonne-large-6 offset-0 offset-0 col-md-offset-3 colonne-large-offset-3 toppad">
			  <div class="panel panel-info">
				<div class="panel-heading">
				  <h3 class="panel-title">'.htmlspecialchars($_SESSION['login']).'</h3>
				</div>


				<div class="panel-body">
				  <div class="row">
					<div align="center" class="colonne-petite-moy colonne-large-3"><img alt="User Pic" class="img-circle" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100">
					</div>


					<div class=" colonne-max colonne-large-9">
					  <table class="table table-user-information">
						<tbody>
						  <tr>
							<td>Pseudo :</td>

							<td>'.htmlspecialchars($res['PSEUDO']).'</td>
						  </tr>


						  <tr>
							<td>Mot de passe :</td>

							<td>Mot de passe crypté et indisponible</td>
						  </tr>


						  <tr>
							<td>Sexe :</td>

							<td>'.htmlspecialchars($sexe).'</td>
						  </tr>
	
						  <tr>
							<td>Inscritpion :</td>

							<td>'.htmlspecialchars($date).'</td>
						  </tr>

						</tbody>
					  </table>
					  <a class="bouton bouton-succes" href="critiques.php">Modifier mes informations.</a>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
			<script src="js/jquery.js"></script>
			<script src="js/scripts.js"></script>

		</body>
		</html>';
	}
	else
		echo 'Vous devez être connecté pour accéder à cette page';
?>