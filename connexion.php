
<?php include('header.php');?>
<?php include('navbar.php');?>

    <!-- /.row -->
    <!-- Contact Form -->
    <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->

    <div class="container">
        <div class="row">
            <div class="colonne-max">
                <h3>Entrez votre e-mail et votre mot de passe pour vous connecter.</h3>


                <form action="test_connexion.php" id="contactForm" name="contactForm" method="post">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Login :</label> <input class="form-control" data-validation-required-message="Veuillez rentrer votre e-mail." name="mail" required="" type="text">
                        </div>
                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mot de passe :</label> <input class="form-control" data-validation-required-message="Veuillez entrer votre mot de passe pour vous connecter." name="mdp" required="" type="password">
                        </div>
                    </div>
                    <button class="bouton bouton-principal" type="submit">Connexion.</button>
                </form>
            </div>
        </div>
        <!-- /.row -->

        <hr>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>