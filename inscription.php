
<?php include('header.php');?>
<?php include('navbar.php');?>

    <!-- Page Content -->


    <div class="container">
        <!-- Page Heading/Breadcrumbs -->


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Inscription.</h1>


                <ol class="breadcrumb">
                    <li>
                        <a href="index.php">Accueil.</a>
                    </li>


                    <li class="active">Inscription.</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <h3>Entrez vos identifiants pour vous inscrire.</h3>
                <br>


                <form action="inscription_script.php" id="contactForm" method="post" name="contactForm">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Identifiant :</label> <input class="form-control" data-validation-required-message="Veuillez entrer votre identifiant." name="login" required="" type="text">

                            <p class="help-block">
                            </p>
                        </div>
                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mot de passe :</label> <input class="form-control" data-validation-required-message="Veuillez entrer votre mot de passe." name="mdp" required="" type="password">
                        </div>
                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Confirmez votre mot de passe :</label> <input class="form-control" data-validation-required-message="Veuillez confirmer votre mot de passe." name="mdp2" required="" type="password">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" >Inscription</button>
                </form>
            </div>
        </div>
		
        <!-- /.row -->

        <hr>
    </div>
    <!-- /.container -->
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>
