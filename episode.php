
<?php include('header.php');?>
<?php include('navbar.php');?>

<?php
	if( isset($_GET['idEp']) )
	{
		try
		{
			$req = $db->prepare("SELECT ID_EP, NOM_EP, DUREE_EP, DATE_EP, SUM_EP, SAISON_EP, ID_SERIE from episodes WHERE ID_EP=:idEp;");
			$req->bindValue(':idEp', $_GET['idEp']);
			
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
			

			$req2 = $db->prepare("SELECT URL FROM photo_serie WHERE ID_SERIE=:idSerie;");
			$req2->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req2->execute();
			$res2 = $req2->fetch(PDO::FETCH_ASSOC);
			
			// $mois = array( 01 => 'janvier', 02 => 'février', 03 => 'mars', 04 => 'avril', 05 => 'mai', 06 => 'juin', 07 => 'juillet', 08 => 'aout', 09 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre');
			
			$dateFormatSQL = $res['DATE_EP'];
			$date = date("d-m-Y", strtotime($dateFormatSQL));
			
			// Pour les acteurs relatif a l'episode
			$req3 = $db->prepare("SELECT ID_IND FROM jouer WHERE ID_SERIE=:idSerie AND ID_EP=:idEp;");
			$req3->bindValue(':idSerie', $res['ID_SERIE']);
			$req3->bindValue(':idEp', $_GET['idEp']);
			
			$req3->execute();
			$res3 = $req3->fetch(PDO::FETCH_ASSOC);
			
			$req4 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
			$req4->bindValue(':idInd', $res3['ID_IND']);
			
			$req4->execute();
			$res4 = $req4->fetch(PDO::FETCH_ASSOC);
			
			// realisateur
			$req5 = $db->prepare("SELECT ID_IND FROM realiser WHERE ID_SERIE=:idSerie AND ID_EP=:idEp;");
			$req5->bindValue(':idSerie', $res['ID_SERIE']);
			$req5->bindValue(':idEp', $_GET['idEp']);
			
			$req5->execute();
			$res5 = $req5->fetch(PDO::FETCH_ASSOC);
			
			$req6 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
			$req6->bindValue(':idInd', $res5['ID_IND']);
			
			$req6->execute();
			$res6 = $req6->fetch(PDO::FETCH_ASSOC);
			
		}
		catch(PDOException $e)
		{
			die( 'Erreur : ' . $e->getMessage());
		}
		
		if(!$res) // s'il n y a pas de resultat pour la série
		{
			echo 'Pas de resultat pour l\'episode';
		}
		else
		{
			echo'

    <!-- Page Content -->
	
    <div class="container">
        <div class="row row-centered">
            <div class="col-md-9 col-centered">
                <div class="thumbnail">
                    <img alt="" class="img-responsive" src="'.htmlspecialchars($res2['URL']).'">

                    <div class="caption-full">
                        <h4><a href="#">'.htmlspecialchars($res['NOM_EP']).'</a>
                        </h4>


                        <p>'.htmlspecialchars($res['DUREE_EP']).' minutes, diffusé le '.htmlspecialchars($date).'</p>


                        <p>'.htmlspecialchars($res['SUM_EP']).'</p>';
						
						if($res3)
						{
							echo '<p>';
							echo 'Acteur : <a href="acteurUni.php?idInd='.htmlspecialchars($res3['ID_IND']).'">'.htmlspecialchars($res4['PREN_IND']).' '.htmlspecialchars($res4['NOM_IND']).'</a>';
							$res3 = $req3->fetch(PDO::FETCH_ASSOC);
							
							do
							{
								$req4 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
								$req4->bindValue(':idInd', $res3['ID_IND']);
								
								$req4->execute();
								$res4 = $req4->fetch(PDO::FETCH_ASSOC);

								echo ', <a href="acteurUni.php?idInd='.htmlspecialchars($res3['ID_IND']).'">'.htmlspecialchars($res4['PREN_IND']).' '.htmlspecialchars($res4['NOM_IND']).'</a>';
							}while( $res3 = $req3->fetch(PDO::FETCH_ASSOC) );
				
							echo '</p>';
						}
						
						if($res5)
						{
							echo '<p>';
							echo 'Réalisateur : <a href="acteurUni.php?idInd='.htmlspecialchars($res5['ID_IND']).'">'.htmlspecialchars($res6['PREN_IND']).' '.htmlspecialchars($res6['NOM_IND']).'</a>';
							$res5 = $req5->fetch(PDO::FETCH_ASSOC);
							
							do
							{
								$req6 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
								$req6->bindValue(':idInd', $res5['ID_IND']);
								
								$req6->execute();
								$res6 = $req6->fetch(PDO::FETCH_ASSOC);

								echo ', <a href="acteur.php">'.htmlspecialchars($res6['PREN_IND']).' '.htmlspecialchars($res6['NOM_IND']).'</a>';
							}while( $res5 = $req5->fetch(PDO::FETCH_ASSOC) );
				
							echo '</p>';
						}
						echo '
                    </div>


                    <div class="ratings">
                        <p class="pull-right">3 avis.</p>


                        <p><span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span> 4 étoiles.</p>
                    </div>
                </div>


                <div class="well">
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
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>
';
	}
	}
?>
