
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
			
			$req7 = $db->prepare("SELECT PSEUDO, ID_EP, SAISON_EP, ID_SERIE, NOTE_NE, CMT_NE, DATE_NE FROM noter_episodes WHERE ID_EP=:idEp;");
			$req7->bindValue(':idEp', $_GET['idEp']);
			
			$req7->execute();
			$res7 = $req7->fetch(PDO::FETCH_ASSOC);
			
			$req8 = $db->prepare("SELECT AVG(NOTE_NE) as AVG_NOTE FROM noter_episodes WHERE ID_EP=:idEp;");
			$req8->bindValue(':idEp', $_GET['idEp']);
			
			$req8->execute();
			$res8 = $req8->fetch(PDO::FETCH_ASSOC);
			
			$req9 = $db->prepare("SELECT COUNT(*) as NB_COM FROM noter_episodes WHERE ID_EP=:idEp;");
			$req9->bindValue(':idEp', $_GET['idEp']);
			
			$req9->execute();
			$res9 = $req9->fetch(PDO::FETCH_ASSOC);
			
			
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
            <div class="colonne-max col-centered">
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
								try
								{
									$req4 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
									$req4->bindValue(':idInd', $res3['ID_IND']);
									
									$req4->execute();
									$res4 = $req4->fetch(PDO::FETCH_ASSOC);
								}
								catch(PDOException $e)
								{
									die( 'Erreur : ' . $e->getMessage());
								}
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
								try
								{
									$req6 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
									$req6->bindValue(':idInd', $res5['ID_IND']);
									
									$req6->execute();
									$res6 = $req6->fetch(PDO::FETCH_ASSOC);
								}
								catch(PDOException $e)
								{
									die( 'Erreur : ' . $e->getMessage());
								}

								echo ', <a href="acteur.php">'.htmlspecialchars($res6['PREN_IND']).' '.htmlspecialchars($res6['NOM_IND']).'</a>';
							}while( $res5 = $req5->fetch(PDO::FETCH_ASSOC) );
				
							echo '</p>';
						}
						echo '
                    </div>


                    <div class="ratings">';
                        if($res9['NB_COM'] != 0)
							echo'<p class="pull-right">'.$res9['NB_COM'].' avis.</p>';
						else
							echo'<p></p>';
						
                        $noteRonde = round($res8['AVG_NOTE']);
						
						if( $noteRonde==1 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res8['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==2 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res8['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==3 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res8['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==4 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res8['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==5 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span>'.htmlspecialchars(round($res8['AVG_NOTE'] ,2) ).' étoiles.</span>';
						echo'</div>
                </div>


                <div class="well">';
					if(!empty($res7))
					{
						do
						{
							echo'
							<hr>

							<div class="row">
								<div class="colonne-min2">';
								if( $res7['NOTE_NE']==1 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res7['NOTE_NE']==2 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res7['NOTE_NE']==3 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res7['NOTE_NE']==4 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res7['NOTE_NE']==5 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>';
								echo''.htmlspecialchars($res7['PSEUDO']).' <span class="pull-right">Le '.htmlspecialchars($res7['DATE_NE']).'.</span>
									<p>'.htmlspecialchars($res7['CMT_NE']).'.</p>
								</div>
							</div>';
						}while($res7 = $req7->fetch(PDO::FETCH_ASSOC));
					}
					echo'

					 <form id="critique" name="critique" method="post" action="ajoutCommentaireEpi.php">
	                	<div class="control-group">
	                	 	<button class="bouton bouton-succes" onclick="hide(message)">Laissez votre avis.</button>
	                	 	<br>
	                        <div class="controls" id="message">
	                            <textarea class="form-control"  name="commentaire" cols="100" maxlength="999" required="" rows="10" style="resize:none" style="display: none;"></textarea>
	                            <hr>
								<input type="hidden" name="idEp" value="'.$_GET['idEp'].'">	
								<input type="hidden" id="noteHidden" name="note" value="">

								<div class="dropdown">
                        			<button aria-expanded="true" aria-haspopup="true" class="bouton bouton-defaut dropdown-toggle" data-toggle="dropdown" type="bouton">Attribuez votre note (sur 5)... <span class="caret"></span></button>

			                        <ul aria-labelledby="dropdownMenu1" class="dropdown-menu">
			                          	<li>
			                            	<a data-value="1" >1</a>
			                         	 </li>
				                        <li>
			    	                        <a data-value="2" >2</a>
			                            </li>
			                            <li>
			  		                        <a data-value="3" >3</a>
			        	                </li>
			                            <li>
			  		                        <a data-value="4" >4</a>
			                            </li>
				                        <li>
			    	                        <a data-value="5" >5</a>
			        	                </li>
                        			</ul>

                      			</div>
                      			<button class="bouton bouton-principal" type="submit">Envoyer message !</button>
	                        </div>
	                    </div>
	                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/test.js"></script>

</body>
</html>
';
	}
	}
?>
