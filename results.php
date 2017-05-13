<?php include('header.php');?>
<link href="css/results	.css" rel="stylesheet" type="text/css">
<?php include('navbar.php');
include('connexionBD2.php');?>


<?php
    if(isset($_POST['search'])) {
        try
        {
            $req = $db->prepare("SELECT ID_SERIE, TITRE_SERIE, ANNEE_SERIE, PAYS_SERIE, SUM_SERIE from series, individus
                WHERE (TITRE_SERIE=:search OR NOM_IND =:search OR ANNEE_SERIE = :search;");
            $req->bindValue(':search', htmlspecialchars($_POST['search']));
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
        }

        catch(PDOException $e)
        {
            die( 'Erreur : ' . $e->getMessage());
        }

        echo'
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Résultats de la recherche
                            <small>Résultats de la recherche "'. htmlspecialchars($_POST['search']).' ".</small>
                        </h1>
                    </div>
                </div>
        ';

        do {
                $req2 = $db->prepare("SELECT URL FROM photo_serie WHERE ID_SERIE=:idSerie;");
                $req2->bindValue(':idSerie', $res['ID_SERIE']);
                        
                $req2->execute();
                $res2 = $req2->fetch(PDO::FETCH_ASSOC);
                        
                echo'
                    <div class="row">
                        <div class="col-md-7">
                            <a href="portfolio-item.html">
                                <img class="img-responsive img-hover" src="http://placehold.it/700x300" alt="">
                            </a>
                        </div>
                        <div class="col-md-5">
                            <h3>Nom série.</h3>
                            <h4>Genre série.</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium veniam exercitationem expedita laborum at voluptate. Labore, voluptates totam at aut nemo deserunt rem magni pariatur quos perspiciatis atque eveniet unde.</p>
                            <a class="btn btn-primary" href="portfolio-item.html">Voir série.</i></a>
                        </div>
                    </div>
                    <hr>
                ';
                        
                    } while ($res = $req->fetch(PDO::FETCH_ASSOC) );
                echo '
            </div>
        <hr>
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>
';
?>
