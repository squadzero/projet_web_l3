
<?php include('header.php');?>
<?php include('navbar.php');?>

<?php
	
	if( isset($_GET['idInd']))
	{	
		try
		{
			$req = $db->prepare('SELECT NOM_IND, PREN_IND, CREATEUR, PRODUCTEUR, ACTEUR, REALISATEUR FROM individus WHERE ID_IND=:idInd;');
			$req->bindValue(':idInd', $_GET['idInd']);
			
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
			
			
			$req2 = $db->prepare('SELECT URL FROM photo_individu WHERE ID_IND=:idInd;');
			$req2->bindValue(':idInd', $_GET['idInd']);
			
			$req2->execute();
			$res2 = $req2->fetch(PDO::FETCH_ASSOC);
			
			
			$req3= $db->prepare('SELECT DISTINCT ID_SERIE FROM creer WHERE ID_IND=:idInd;');
			$req3->bindValue(':idInd', $_GET['idInd']);
			
			$req3->execute();
			$res3 = $req3->fetch(PDO::FETCH_ASSOC);
			
			
			$req4= $db->prepare('SELECT DISTINCT ID_SERIE FROM jouer WHERE ID_IND=:idInd;');
			$req4->bindValue(':idInd', $_GET['idInd']);
			
			$req4->execute();
			$res4 = $req4->fetch(PDO::FETCH_ASSOC);
			
			
			$req5= $db->prepare('SELECT DISTINCT ID_SERIE FROM produire WHERE ID_IND=:idInd;');
			$req5->bindValue(':idInd', $_GET['idInd']);
			
			$req5->execute();
			$res5 = $req5->fetch(PDO::FETCH_ASSOC);
			
			
			$req6= $db->prepare('SELECT DISTINCT ID_SERIE FROM realiser WHERE ID_IND=:idInd;');
			$req6->bindValue(':idInd', $_GET['idInd']);
			
			$req6->execute();
			$res6 = $req6->fetch(PDO::FETCH_ASSOC);
			
		}
		catch(PDOException $e)
		{
			die( 'Erreur : ' . $e->getMessage());
		}
		
		$role;
		if( $res['CREATEUR'] == 1 )
			$role = 'Créateur'; 
		else if( $res['PRODUCTEUR'] == 1 )
			$role = 'Producteur';
		else if( $res['ACTEUR'] == 1 )
			$role = 'Acteur';
		else if( $res['REALISATEUR'] == 1)
			$role = 'Réalisateur';
		
		echo'
		<!-- Page Content -->


		<div class="container">
			<div class="row">
				<div class="col-md-12"><br>
				<img id="image_indi" alt="" class="img-responsive" src="'.htmlspecialchars($res2['URL']).'">
				</div>


				<div class="col-md-6">
					<div class="caption-full">
						<h3>'.htmlspecialchars($res['PREN_IND']).' '.htmlspecialchars($res['NOM_IND']).'.<br>
						<small>'.$role.'</small></h3>
					</div>

					<h4>Résumé :</h4>

					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					<br>

					<h4>Ensemble de séries auxquelles cette personne a pu participer :</h4>

					<ul>';
					if($res3)
					{
						try
						{
							$req7 = $db->prepare('SELECT TITRE_SERIE FROM series WHERE ID_SERIE=:idSerie;');
							$req7->bindValue(':idSerie', $res3['ID_SERIE']);
							$req7->execute();
							$res7 = $req7->fetch(PDO::FETCH_ASSOC);
						}
						catch(PDOException $e)
						{
							die( 'Erreur : ' . $e->getMessage());
						}
						echo '<li><a href="item.php?idSerie='.htmlspecialchars($res3['ID_SERIE']).'">'.htmlspecialchars($res7['TITRE_SERIE']).'</a></li>';
					}
					if($res4)
					{
						try
						{
							$req7 = $db->prepare('SELECT TITRE_SERIE FROM series WHERE ID_SERIE=:idSerie;');
							$req7->bindValue(':idSerie', $res4['ID_SERIE']);
							$req7->execute();
							$res7 = $req7->fetch(PDO::FETCH_ASSOC);
						}
						catch(PDOException $e)
						{
							die( 'Erreur : ' . $e->getMessage());
						}
						echo '<li><a href="item.php?idSerie='.htmlspecialchars($res4['ID_SERIE']).'">'.htmlspecialchars($res7['TITRE_SERIE']).'</a></li>';
					}
					if($res5)
					{
						try
						{
							$req7 = $db->prepare('SELECT TITRE_SERIE FROM series WHERE ID_SERIE=:idSerie;');
							$req7->bindValue(':idSerie', $res5['ID_SERIE']);
							$req7->execute();
							$res7 = $req7->fetch(PDO::FETCH_ASSOC);
						}
						catch(PDOException $e)
						{
							die( 'Erreur : ' . $e->getMessage());
						}
						echo '<li><a href="item.php?idSerie='.htmlspecialchars($res5['ID_SERIE']).'">'.htmlspecialchars($res7['TITRE_SERIE']).'</a></li>';
					}
					if($res6)
					{
						try
						{
							$req7 = $db->prepare('SELECT TITRE_SERIE FROM series WHERE ID_SERIE=:idSerie;');
							$req7->bindValue(':idSerie', $res6['ID_SERIE']);
							$req7->execute();
							$res7 = $req7->fetch(PDO::FETCH_ASSOC);
						}
						catch(PDOException $e)
						{
							die( 'Erreur : ' . $e->getMessage());
						}
						echo '<li><a href="item.php?idSerie='.htmlspecialchars($res6['ID_SERIE']).'">'.htmlspecialchars($res7['TITRE_SERIE']).'</a></li>';
					}
					echo'
					</ul>
					<!-- <div class="well">
						<div class="text-right">
							<a class="btn btn-success">Laissez un avis.</a>
						</div>

						<hr>


						<div class="row">
							<div class="col-md-12">
								<span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span> Anonymous <span class="pull-right">Il y a x jours.</span>

								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
						</div>

						<hr>


						<div class="row">
							<div class="col-md-12">
								<span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span> Anonymous <span class="pull-right">Il y a x jours.</span>

								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
						</div>

						<hr>


						<div class="row">
							<div class="col-md-12">
								<span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span> Anonymous <span class="pull-right">Il y a x jours.</span>

								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		<!-- /.container -->
		<script src="js/jquery.js">
		</script> 
		<script src="js/scripts.js">
		</script>
	</body>
	</html>
	';
	}
?>