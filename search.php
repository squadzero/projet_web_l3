<?php include('header.php');?>
<?php include('navbar.php');?>

<?php
		try
		{
			$req = $db->prepare("SELECT ID_SERIE, TITRE_SERIE from series;");
			
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
			
			
			$req2 = $db->prepare("SELECT URL FROM photo_serie WHERE ID_SERIE=:idSerie;");
			$req2->bindValue(':idSerie', $res['ID_SERIE']);
			
			$req2->execute();
			$res2 = $req2->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			die( 'Erreur : ' . $e->getMessage());
		}
			echo'

    <!-- Page Content -->
		<div>
		<div class="container">

		<br>
		<div class="row">
			<div class="col-md-12">
				<form action="results.php" id="searchForm" method="post" name="searchForm">
					<div class="input-group" id="adv-search">
						<input type="text" class="form-control" placeholder="Tapez le nom, la date ou le réalisateur..." name ="search"/>
						<div class="input-group-btn">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>	
			<div class="col-md-12">
				<div class="row">';
					do
					{
						try
						{
							$req2 = $db->prepare("SELECT URL FROM photo_serie WHERE ID_SERIE=:idSerie;");
							$req2->bindValue(':idSerie', $res['ID_SERIE']);
							
							$req2->execute();
							$res2 = $req2->fetch(PDO::FETCH_ASSOC);
							
							$req3 = $db->prepare("SELECT AVG(NOTE_NS) as AVG_NOTE, COUNT(*) as NB_COM FROM noter_series WHERE ID_SERIE=:idSerie;");
							$req3->bindValue(':idSerie', $res['ID_SERIE']);
							
							$req3->execute();
							$res3 = $req3->fetch(PDO::FETCH_ASSOC);
						}
						catch(PDOException $e)
						{
							die( 'Erreur : ' . $e->getMessage());
						}
						echo'
						
							<div class="col-md-4">
								<div class="thumbnail">
									<a href="item.php?idSerie='.htmlspecialchars($res['ID_SERIE']).'"><img src="'.htmlspecialchars($res2['URL']).'" alt=""></a>
									<div class="caption">
										<h4><a href="item.php?idSerie='.htmlspecialchars($res['ID_SERIE']).'">'.htmlspecialchars($res['TITRE_SERIE']).'</a>
										</h4>
									</div>
									<div class="ratings">';
										if($res3['NB_COM'] != 0)
											echo'<p class="pull-right">'.$res3['NB_COM'].' avis.</p>';
										else
											echo'<p class="pull-right">Aucun avis.</p>';
											
											$noteRonde = round($res3['AVG_NOTE']);
											
											if($res3['NB_COM'] == 0)
												echo'<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>';
											elseif( $noteRonde==1 )
												echo'<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star-empty"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>';
											elseif( $noteRonde==2 )
												echo'<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>
												<span class="glyphicon glyphicon-star-empty"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>';
											elseif( $noteRonde==3 )
												echo'<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span> 
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star-empty"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>';
											elseif( $noteRonde==4 )
												echo'<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span> 
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span> 
												<span class="glyphicon glyphicon-star-empty"></span>';
											elseif( $noteRonde==5 )
												echo'<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span> 
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span> 
												<span class="glyphicon glyphicon-star"></span>';
										echo'
									</div>
								</div>
							</div>
						';
						
					} while ($res = $req->fetch(PDO::FETCH_ASSOC) );

					echo'

					</div>

				</div>

			</div>

		</div>
		
		<script src="js/jquery.js"></script>
		<script src="js/scripts.js"></script>

</body>

</html>
';
?>