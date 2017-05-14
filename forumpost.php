<?php include('header.php');?>
<?php include('navbar.php');?> 

<?php
	
	if( isset($_SESSION['login']) && (trim($_SESSION['login'])!='') )
	{
		try
		{
			$req = $db->prepare("SELECT ID_MSG, PSEUDO, ID_SERIE, TITRE_MSG, TXT_MSG, DATE_MSG FROM messages;");
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
			
		}
		catch(PDOException $e)
		{
			die( 'Erreur : ' . $e->getMessage());
		}
		
		echo'
			  <div class="container">
				<div class="row">';
				do
				{
					echo'
				  <section class="row clearfix">
					<section class="col-md-12 column">
					  <nav class="navbar navbar-default" role="navigation">
						<div class="container-fluid">
						  <div class="row clearfix">
							<div class="col-md-12 column">
							  <div class="panel panel-default">
								<div class="panel-heading">
								  <section class="panel-title">
									<time class="pull-right"><i class="fa fa-calendar"></i> '.htmlspecialchars($res['DATE_MSG']).'</time>';
									try
									{
										$req2 = $db->prepare("SELECT TITRE_SERIE FROM series WHERE ID_SERIE=:idSerie;");
										$req2->bindValue(':idSerie', $res['ID_SERIE']);
										$req2->execute();
										$res2 = $req2->fetch(PDO::FETCH_ASSOC); 
									}
									catch(PDOException $e)
									{
										die( 'Erreur : ' . $e->getMessage());
									}
									echo'
									<a href="item.php?idSerie='.htmlspecialchars($res['ID_SERIE']).'" class="pull-left">'.htmlspecialchars($res2['TITRE_SERIE']).'</a>
								  </section>
								</div>


								<section class="row panel-body">
								  <section class="col-md-9">
									<h2>'.htmlspecialchars($res['TITRE_MSG']).'</h2>

									<hr>
									<p>Par '.htmlspecialchars($res['PSEUDO']).'</p>
									<p>'.htmlspecialchars($res['TXT_MSG']).'</p>
								  </section>
								</section>';
								
								try
								{
									$req3 = $db->prepare("SELECT PSEUDO, TXT_RPS, DATE_RPS FROM reponses WHERE ID_MSG=:idMsg;");
									$req3->bindValue(':idMsg', $res['ID_MSG']);
									$req3->execute();
									$res3 = $req3->fetch(PDO::FETCH_ASSOC);
								}
								catch(PDOException $e)
								{
									die( 'Erreur : ' . $e->getMessage());
								}
								
								do
								{
									echo'
									<section class="row panel-body">
									  <section class="col-md-8 forumReponse">
										<p>'.htmlspecialchars($res3['PSEUDO']).', Le '.htmlspecialchars($res3['DATE_RPS']).'</p>
										<p>'.htmlspecialchars($res3['TXT_RPS']).'</p>
									  </section>
									</section>';
								}while($res3 = $req3->fetch(PDO::FETCH_ASSOC));
								echo'
								<div class="panel-footer">
								  <div class="row">
									

									<section class="col-md-9">
									  <form id="critique" name="critique" method="post" action="ajoutCommentaireSerie.php">
										<div class="control-group">
											<button class="btn btn-success" onclick="hide(message)">Laissez votre avis.</button>
											<br>
											<div class="controls" id="message">
												<textarea class="form-control"  name="commentaire" cols="100" maxlength="999" required="" rows="10" style="resize:none" style="display: none;"></textarea>
												<hr>
												<button class="btn btn-primary" type="submit">Envoyer message !</button>
											</div>
										</div>
									  </form>
									</section>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </nav>
					</section>
				</section>';
				}while($res = $req->fetch(PDO::FETCH_ASSOC));
				echo'
				</div>
			  </div>

			<script src="js/jquery.js"></script>
			<script src="js/scripts.js"></script>

		</body>
		</html>
		';
	}
	echo 'Vous devez être connecté pour acceder à cette page';
?>