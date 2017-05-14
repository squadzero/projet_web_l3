

<?php include('header.php');?>
<?php include('navbar.php');?>

    <div class="container">

        <div class="row">
            <div class="colonne-large-12">
                <h1 class="page-header">Contact.</h1>


                <ol class="breadcrumb">
                    <li>
                        <a href="index.php">Accueil.</a>
                    </li>


                    <li class="active">Contact.</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="colonne-max">
                <h3>Envoyez nous un message !</h3>
                <br>


                <form id="contactForm" name="sentMessage" novalidate="">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nom complet :</label> <input class="form-control" data-validation-required-message="Entrez votre nom." id="name" required="" type="text">

                            <p class="help-block">
                            </p>
                        </div>
                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Numéro de téléphone :</label> <input class="form-control" data-validation-required-message="Entrez votre numéro de téléphone." id="phone" required="" type="tel">
                        </div>
                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Adresse mail :</label> <input class="form-control" data-validation-required-message="Entrez votre adresse mail." id="email" required="" type="email">
                        </div>
                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message :</label> 

                            <textarea class="form-control" cols="100" data-validation-required-message="Entrez votre message." id="message-oui" maxlength="999" required="" rows="10" style="resize:none"></textarea>
                        </div>
                    </div>


                    <div id="success">
                    </div>
                    <!-- For success/fail messages -->
                    <button class="bouton bouton-principal" type="submit">Envoyer message !</button>
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