
<?php include('header.php');?>
<?php include('navbar.php');?>

<?php
	if( isset($_GET['serie']) )
	{
		try
		{
			$req = $db->prepare("SELECT ID_SERIE, TITRE_SERIE, ANNEE_SERIE, PAYS_SERIE, SUM_SERIE from series WHERE TITRE_SERIE=:nomSerie;");
			$req->bindValue(':nomSerie', $_GET['serie']);
			
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
            <div class="col-md-9 col-centered">
                <div class="thumbnail">
                    <img alt="" class="img-responsive" src="'.$res2['URL'].'">

                    <div class="caption-full">
                        <h4><a href="#">'.$res['TITRE_SERIE'].'</a>
                        </h4>


                        <p>'.$res['PAYS_SERIE'].' ,'.$res['ANNEE_SERIE'].'</p>


                        <p>'.$res['SUM_SERIE'].'</p>
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
