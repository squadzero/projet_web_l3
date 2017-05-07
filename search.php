
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
				<div class="input-group" id="adv-search">
					<input type="text" class="form-control" placeholder="Tapez des mots clés." />
					<div class="input-group-btn">
						<div class="btn-group" role="group">
							<div class="dropdown dropdown-lg">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
								<div class="dropdown-menu dropdown-menu-right" role="menu">
									<form class="form-horizontal" role="form">
									  <div class="form-group">
										<label for="filter">Filtrer par :</label>
										<select class="form-control">
											<option value="0" selected>Critère 1.</option>
											<option value="1">Critère 2.</option>
											<option value="2">Critère 3.</option>
											<option value="3">Critère 4.</option>
											<option value="4">Critère 5.</option>
										</select>
									  </div>
									<div class="form-group">
										<label for="contain">Nom de la critique : </label>
										<input class="form-control" type="text" />
									</div>
									<div class="form-group">
										<label for="contain">Nom du film : </label>
										<input class="form-control" type="text" />
									</div>
									  <div class="form-group">
										<label for="contain">Auteur : </label>
										<input class="form-control" type="text" />
									  </div>
									  <div class="form-group">
										<label for="contain">Contient les mots : </label>
										<input class="form-control" type="text" />
									  </div>
									  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									</form>
								</div>
							</div>
							<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
						</div>
					</div>
				</div>
			  </div>
			</div>	
				<div class="col-md-12">

			
					<div class="row">';
					do
					{
						$req2 = $db->prepare("SELECT URL FROM photo_serie WHERE ID_SERIE=:idSerie;");
						$req2->bindValue(':idSerie', $res['ID_SERIE']);
						
						$req2->execute();
						$res2 = $req2->fetch(PDO::FETCH_ASSOC);
						
						echo'
						
							<div class="col-sm-4 col-lg-4 col-md-4">
								<div class="thumbnail">
									<a href="item.php?idSerie='.htmlspecialchars($res['ID_SERIE']).'"><img src="'.htmlspecialchars($res2['URL']).'" alt=""></a>
									<div class="caption">
										<h4><a href="item.php?idSerie='.htmlspecialchars($res['ID_SERIE']).'">'.htmlspecialchars($res['TITRE_SERIE']).'</a>
										</h4>
									</div>
									<div class="ratings">
										<p class="pull-right">15 avis.</p>
										<p>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
										</p>
									</div>
								</div>
							</div>
						';
						
					}while( $res = $req->fetch(PDO::FETCH_ASSOC) );
					
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