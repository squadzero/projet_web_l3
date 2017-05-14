
<?php include('header.php');?>
<?php include('navbar.php');?>

<?php

	try
	{
		$req = $db->prepare("SELECT URL, titre_serie FROM series NATURAL JOIN photo_serie NATURAL JOIN episodes GROUP BY titre_serie, URL ORDER BY DATE_EP DESC limit 5 ");
		$req->execute();
		$res = $req->fetch(PDO::FETCH_ASSOC);
		
		$datePlusUnAn = date('Y-m-d', strtotime('-1 year'));

		$req2 = $db->prepare("SELECT PSEUDO, DATE_INSC FROM utilisateurs WHERE DATE_INSC=:anneePlusUn");
		$req2->bindValue(':anneePlusUn', $datePlusUnAn );
		$req2->execute();
		$res2 = $req2->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		die( 'Erreur : ' . $e->getMessage());
	}
	echo'
    <!-- Page Content -->


    <div class="container">
        <div class="row">
            <div class="colonne-min2">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">'; 
						echo'
						<div class="item active">

							<img class="img-responsive" src="'.$res['URL'].'" alt="">
					        <div class="carousel-caption">
                                <h2>'.$res['titre_serie'].'</h2>
                            </div>
                        </div>';
						$res = $req->fetch(PDO::FETCH_ASSOC);
						do
						{
							echo'
							<div class="item">
								<img class="img-responsive" src="'.$res['URL'].'" alt="">
                                <div class="carousel-caption">
                                    <h2>'.$res['titre_serie'].'</h2>
                                </div>
							</div>';
						}
						while($res = $req->fetch(PDO::FETCH_ASSOC));
					echo'
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
             </div>';
			if($res2)
			{
				echo'
				<div class="colonne-moy">
				</div>


				<div class="colonne-moy">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><i class="fa fa-fw fa-gift"></i>Nos félicitations à ...</h4>
						</div>
						<div class="panel-body">
							<p>'.$res2['PSEUDO'].' qui fête aujourd\'hui ses un an de participation sur notre site.</p>
							<p>Garde l\'esprit aussi critique pour l\'année qui vient !</p>
						</div>
					</div>
				</div>


				<div class="colonne-moy">
				</div>';
			}
			else
			{
				echo'
				<div class="colonne-moy">
				</div>


				<div class="colonne-moy">
					<div class="panel panel-default">
						<div class="panel-body">
							<p>Aucun utilisateur ne fète son annviersaire aujourd\'hui ... peut être demain ...</p>
						</div>
					</div>
				</div>


				<div class="colonne-moy">
				</div>';			
			}
		echo'
        </div>
        <!-- /.row -->
        <!-- Features Section -->

        <hr>
    </div>
    <!-- /.container -->
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>';

?>