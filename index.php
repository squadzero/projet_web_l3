
<?php include('header.php');?>
<?php include('navbar.php');?>

<?php

	try
	{
		$req = $db->prepare("SELECT URL, titre_serie FROM series NATURAL JOIN photo_serie NATURAL JOIN episodes GROUP BY titre_serie, URL ORDER BY DATE_EP DESC limit 5 ");
		$req->execute();
		$res = $req->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e)
	{
		die( 'Erreur : ' . $e->getMessage());
	}
	echo'
    <!-- Page Content -->


    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
							<span>'.htmlspecialchars($res['titre_serie']).'</span>
							<img class="img-responsive" src="'.htmlspecialchars($res['URL']).'" alt="">
						</div>';
						$res = $req->fetch(PDO::FETCH_ASSOC);
						do
						{
							echo'
							<div class="item">
								<span>'.htmlspecialchars($res['titre_serie']).'</span>
								<img class="img-responsive" src="'.htmlspecialchars($res['URL']).'" alt="">
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
             </div>


            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i>Evénement récent.</h4>
                    </div>


                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, quo ei eirmod partiendo deterruisset. Odio omittam accusata ad sit, in semper disputando duo. Eu sit feugiat gubergren. Alterum pertinax ne est, at mel brute persius accusamus. Ne tollit dolore definitiones quo, vel justo nobis quidam eu. Ut usu case ullum, amet cibo mediocrem sed te.</p>
                        <a class="btn btn-default" href="#">En savoir plus.</a>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i>Notre boulot.</h4>
                    </div>


                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, quo ei eirmod partiendo deterruisset. Odio omittam accusata ad sit, in semper disputando duo. Eu sit feugiat gubergren. Alterum pertinax ne est, at mel brute persius accusamus. Ne tollit dolore definitiones quo, vel justo nobis quidam eu. Ut usu case ullum, amet cibo mediocrem sed te.</p>
                        <a class="btn btn-default" href="#">En savoir plus.</a>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>Qui sommes-nous ?</h4>
                    </div>


                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, quo ei eirmod partiendo deterruisset. Odio omittam accusata ad sit, in semper disputando duo. Eu sit feugiat gubergren. Alterum pertinax ne est, at mel brute persius accusamus. Ne tollit dolore definitiones quo, vel justo nobis quidam eu. Ut usu case ullum, amet cibo mediocrem sed te.</p>
                        <a class="btn btn-default" href="#">En savoir plus.</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Features Section -->


        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Nos applications.</h2>
            </div>


            <div class="col-md-6">
                <p>Nos applications incluent :</p>


                <ul>
                    <li><strong>Lorem ipsum.</strong>
                    </li>


                    <li>Lorem ipsum.</li>


                    <li>Lorem ipsum.</li>


                    <li>Lorem ipsum.</li>


                    <li>Lorem ipsum.</li>


                    <li>Lorem ipsum.</li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <hr>
    </div>
    <!-- /.container -->
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>';

?>