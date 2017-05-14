<?php include('header.php');?>
<link href="css/results.css" rel="stylesheet" type="text/css">
<?php include('navbar.php');?>

<?php
		if( isset($_POST['search']) && (trim($_POST['search'] != '' )) )
		{
			try
			{
				$req = $db->prepare("SELECT ID_SERIE, TITRE_SERIE, ANNEE_SERIE, PAYS_SERIE, SUM_SERIE from series JOIN individus
					WHERE TITRE_SERIE=:search OR NOM_IND =:search OR ANNEE_SERIE =:search;");
				$req->bindValue(':search', htmlspecialchars($_POST['search']));
				$req->execute();
				$res = $req->fetch(PDO::FETCH_ASSOC);

				$req2 = $db->prepare("SELECT ID_SERIE, TITRE_SERIE, ANNEE_SERIE, PAYS_SERIE, SUM_SERIE from series WHERE ID_SERIE=:idSerie;");
				$req2->bindValue(':idSerie', $res['ID_SERIE']);
				$req2->execute();
				$res2 = $req2->fetch(PDO::FETCH_ASSOC);

				$req3 = $db->prepare("SELECT URL FROM photo_serie WHERE ID_SERIE=:idSerie;");
				$req3->bindValue(':idSerie', $res['ID_SERIE']);
				$req3->execute();
				$res3 = $req3->fetch(PDO::FETCH_ASSOC);
			}

			catch(PDOException $e)
			{
				die( 'Erreur : ' . $e->getMessage());
			}

			echo '
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">Résultats de la recherche
								<small>Résultats de la recherche "' . htmlspecialchars($_POST['search']) . '".</small>
							</h1>
						</div>
					</div>
				';

					
						try
						{
							$req4 = $db->prepare("SELECT NOM_GENRE FROM etre_du_genre WHERE ID_SERIE=:idSerie;");
							$req4 -> bindValue(':idSerie', $res['ID_SERIE']);
							$req4 -> execute();
							$res4 = $req4->fetch(PDO::FETCH_ASSOC);
						}
						catch(PDOException $e)
						{
							die( 'Erreur : ' . $e->getMessage());
						}
							echo'
								<div class="row">
									<div class="col-md-7">
										<a href="item.php?idSerie='.htmlspecialchars($res['ID_SERIE']).'"><img src="'.htmlspecialchars($res3['URL']).'" alt=""></a>
									</div>
									<div class="col-md-5">
										<h3>'.htmlspecialchars($res['TITRE_SERIE']).'</h3>
										<h4>'.htmlspecialchars($res4['NOM_GENRE']).'</h4>
										<a class="btn btn-primary" href="item.php?idSerie='.htmlspecialchars($res['ID_SERIE']).'">Voir série.</i></a>
									</div>
								</div>
								<hr>
							';

					echo '
				</div>
			<hr>
		
			<script src="js/jquery.js"></script>
			<script src="js/scripts.js"></script>

			</body>
			</html>
			';
		}
?>
