<?php include('header.php');?>
<?php include('navbar.php');?>

<?php
	if(isset($_GET['idSerie']))
	{
		try
		{
			$req = $db->prepare("SELECT ID_SERIE, TITRE_SERIE, ANNEE_SERIE, PAYS_SERIE, SUM_SERIE from series WHERE ID_SERIE=:idSerie;");
			$req->bindValue(':idSerie', $_GET['idSerie']);
			
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
			
			
			$req2 = $db->prepare("SELECT URL FROM photo_serie WHERE ID_SERIE=:idSerie;");
			$req2->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req2->execute();
			$res2 = $req2->fetch(PDO::FETCH_ASSOC);
			
			
			$req3 = $db->prepare("SELECT ID_EP, NOM_EP, SAISON_EP FROM episodes WHERE ID_SERIE=:idSerie;");
			$req3->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req3->execute();
			$res3 = $req3->fetch(PDO::FETCH_ASSOC);
			
			
			$req4 = $db->prepare("SELECT NOM_GENRE FROM etre_du_genre WHERE ID_SERIE=:idSerie;");
			$req4->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req4->execute();
			$res4 = $req4->fetch(PDO::FETCH_ASSOC);
			
			
			$req5 = $db->prepare("SELECT ID_IND FROM creer WHERE ID_SERIE=:idSerie;");
			$req5->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req5->execute();
			$res5 = $req5->fetch(PDO::FETCH_ASSOC);
			
			
			$req6 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
			$req6->bindValue(':idInd', $res5['ID_IND']);
			
			$req6->execute();
			$res6 = $req6->fetch(PDO::FETCH_ASSOC);


			$req7 = $db->prepare("SELECT ID_IND FROM produire WHERE ID_SERIE=:idSerie;");
			$req7->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req7->execute();
			$res7 = $req7->fetch(PDO::FETCH_ASSOC);
			
			$req8 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
			$req8->bindValue(':idInd', $res7['ID_IND']);
			
			$req8->execute();
			$res8 = $req8->fetch(PDO::FETCH_ASSOC);
			
			$req9 = $db->prepare("SELECT PSEUDO, ID_SERIE, NOTE_NS, CMT_NS, DATE_NS FROM noter_series WHERE ID_SERIE=:idSerie;");
			$req9->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req9->execute();
			$res9 = $req9->fetch(PDO::FETCH_ASSOC);
			
			$req10 = $db->prepare("SELECT AVG(NOTE_NS) as AVG_NOTE, COUNT(*) as NB_COM FROM noter_series WHERE ID_SERIE=:idSerie;");
			$req10->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req10->execute();
			$res10 = $req10->fetch(PDO::FETCH_ASSOC);

		}
		catch(PDOException $e)
		{
			die( 'Erreur : ' . $e->getMessage());
		}
		
		if(!$res) // s'il n y a pas de resultat pour la série
		{
			echo 'Pas de resultat pour la serie';
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
                        <h4><a href="#">'.htmlspecialchars($res['TITRE_SERIE']).'</a>
                        </h4>';
						
						// Une itération de fetch avant pour gerer affichage de la virgule
						echo '<p>Genre : '.htmlspecialchars($res4['NOM_GENRE']);
						$res4 = $req4->fetch(PDO::FETCH_ASSOC);
						do
						{
							echo ', '.htmlspecialchars($res4['NOM_GENRE']);
						}while( $res4 = $req4->fetch(PDO::FETCH_ASSOC) );
						echo '</p>';
						
						
						if($res6)
						{
							echo '<p>';
							echo 'Créateur : <a href="acteurUni.php?idInd='.htmlspecialchars($res5['ID_IND']).'">'.htmlspecialchars($res6['PREN_IND']).' '.htmlspecialchars($res6['NOM_IND']).'</a>';
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
								echo ', <a href="acteurUni.php?idInd='.htmlspecialchars($res5['ID_IND']).'">'.htmlspecialchars($res6['PREN_IND']).' '.htmlspecialchars($res6['NOM_IND']).'</a>';
							}while( $res5 = $req5->fetch(PDO::FETCH_ASSOC) );
							
							echo '</p>';
						}
						
						if($res8)
						{
							echo '<p>';
							echo 'Producteur : <a href="acteurUni.php?idInd='.htmlspecialchars($res7['ID_IND']).'">'.htmlspecialchars($res8['PREN_IND']).' '.htmlspecialchars($res8['NOM_IND']).'</a>';
							$res7 = $req7->fetch(PDO::FETCH_ASSOC);
							
							do
							{
								try
								{
									$req8 = $db->prepare("SELECT NOM_IND, PREN_IND FROM individus WHERE ID_IND=:idInd;");
									$req8->bindValue(':idInd', $res7['ID_IND']);
										
									$req8->execute();
									$res8 = $req8->fetch(PDO::FETCH_ASSOC);
								}
								catch(PDOException $e)
								{
									die( 'Erreur : ' . $e->getMessage());
								}
								echo ', <a href="acteurUni.php?idInd='.htmlspecialchars($res7['ID_IND']).'">'.htmlspecialchars($res8['PREN_IND']).' '.htmlspecialchars($res8['NOM_IND']).'</a>';
							}while( $res7 = $req7->fetch(PDO::FETCH_ASSOC) );
							
							echo '</p>';	
						}
						echo'

                        <p>'.htmlspecialchars($res['PAYS_SERIE']).', '.htmlspecialchars($res['ANNEE_SERIE']).'</p>


                        <p>'.htmlspecialchars($res['SUM_SERIE']).'</p>';
						
						do
						{
							echo '<p>Saison '.htmlspecialchars($res3['SAISON_EP']).'</p>';
							echo '<p><a href="episode.php?idEp='.htmlspecialchars($res3['ID_EP']).'"> - '.htmlspecialchars($res3['NOM_EP']).'</a></p>';
						}while( $res3 = $req3->fetch(PDO::FETCH_ASSOC) );
						echo'
                    </div>


                    <div class="ratings">';
						if($res10['NB_COM'] != 0)
							echo'<p class="pull-right">'.$res10['NB_COM'].' avis.</p>';
						else
							echo'<p></p>';
						
						$noteRonde = round($res10['AVG_NOTE']);
						
						if( $noteRonde==1 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res10['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==2 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res10['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==3 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star-empty"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res10['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==4 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star-empty"></span>
							<span>'.htmlspecialchars(round($res10['AVG_NOTE'] ,2) ).' étoiles.</span>';
						elseif( $noteRonde==5 )
							echo'<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span> 
							<span class="glyphicon glyphicon-star"></span>
							<span>'.htmlspecialchars(round($res10['AVG_NOTE'] ,2) ).' étoiles.</span>';
						echo'
                    </div>
                </div>


                <div class="well">';
					if(!empty($res9))
					{
						do
						{
							echo'

							<div class="row">
								<div class="colonne-max">';
								if( $res9['NOTE_NS']==1 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res9['NOTE_NS']==2 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res9['NOTE_NS']==3 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star-empty"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res9['NOTE_NS']==4 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star-empty"></span>';
								elseif( $res9['NOTE_NS']==5 )
									echo'<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span> 
									<span class="glyphicon glyphicon-star"></span>';
								echo''.htmlspecialchars($res9['PSEUDO']).' <span class="pull-right">Le '.htmlspecialchars($res9['DATE_NS']).'.</span>

									<p>'.htmlspecialchars($res9['CMT_NS']).'.</p>
								</div>
							</div>
							<hr>';
						} while($res9 = $req9->fetch(PDO::FETCH_ASSOC));
					}

					echo'
	                <form id="critique" name="critique" method="post" action="ajoutCommentaireSerie.php">
	                	<div class="control-group">
	                	 	<bouton class="bouton bouton-succes" onclick="hide(message)">Laissez votre avis.</bouton>
	                	 	<br>
	                        <div class="controls" id="message">
	                            <textarea class="form-control"  name="commentaire" cols="100" maxlength="999" required="" rows="10" style="resize:none" style="display: none;"></textarea>
	                            <hr>
								<input type="hidden" name="idSerie" value="'.$_GET['idSerie'].'">
								<input type="hidden" id="noteHidden" name="note" value="">
								<div class="dropdown">
                        			<bouton aria-expanded="true" aria-haspopup="true" class="bouton bouton-defaut dropdown-toggle" data-toggle="dropdown" type="bouton">Attribuez votre note (sur 5)... <span class="caret"></span></bouton>

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
                      			<bouton class="bouton bouton-principal" type="submit">Envoyer message !</bouton>
	                        </div>
	                    </div>
	                </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/test.js"></script>

</body>
</html>
';
	}
	}
?>
