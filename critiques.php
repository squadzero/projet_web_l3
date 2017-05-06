
<?php include('header.php');?>
<?php include('navbar.php');?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Mes trajets.</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Voyage 1.</h3>
                        <p>Titre du voyage choisi par l'utilisateur.</p>
                        <p>
                            <a href="item.php" class="btn btn-primary">Voir détails.</a> <a href="modify.php" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span></a>
                            <a href="#" class="btn btn-danger" OnClick="sweetalertMod()"><span class="glyphicon glyphicon-remove"></span></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Voyage 2.</h3>
                        <p>Titre du voyage choisi par l'utilisateur.</p>
                        <p>
                            <a href="item.php" class="btn btn-primary">Voir détails.</a> <a href="modify.php" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span></a>
                            <a href="#" class="btn btn-danger" OnClick="sweetalertMod()"><span class="glyphicon glyphicon-remove"></span></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Voyage 3.</h3>
                        <p>Titre du voyage choisi par l'utilisateur.</p>
                        <p>
                            <a href="item.php" class="btn btn-primary">Voir détails.</a> <a href="modify.php" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span></a>
                            <a href="#" class="btn btn-danger" OnClick="sweetalertMod()"><span class="glyphicon glyphicon-remove"></span></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Voyage 4.</h3>
                        <p>Titre du voyage choisi par l'utilisateur.</p>
                        <p>
                            <a href="item.php" class="btn btn-primary">Voir détails.</a> <a href="modify.php" class="btn btn-warning"><span class="glyphicon glyphicon-cog"></span></a>
                            <a href="#" class="btn btn-danger" OnClick="sweetalertMod()"><span class="glyphicon glyphicon-remove"></span></a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <hr>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

    <!-- Sweetalert JavaScript -->
   <!--  <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function sweetalertMod() {
            swal({
                title: 'Voulez-vous envoyer une demande à un administrateur pour supprimer votre voyage ?' ,
                text: "Nous allons vous demander de justifier cette suppression.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Valider.',
                cancelButtonText: 'Annuler.',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                closeOnConfirm: false,
                closeOnCancel: true
            }).then(function(isConfirm) {
                if (isConfirm === true) {
                    swal({
                        title: 'Entrez votre message : ',
                        html: '<p><input id="input-field">',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Valider.',
                        cancelButtonText: 'Annuler.',
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                        closeOnConfirm: false,
                        allowOutsideClick: false
                    },

                    function() {
                      swal({
                        html:
                          'Vous avez entré : <strong>' +
                          $('#input-field').val() +
                          '</strong>'
                      });
                    })
                }
            })
        }
    </script> -->

</body>

</html>