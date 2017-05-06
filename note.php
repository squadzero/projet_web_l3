
<?php include('header.php');?>
<?php include('navbar.php');?>

  <div class="container">
    <br>


    <div class="col-md-7 col-lg-7 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-2 toppad">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Créer un nouvelle critique.</h3>
        </div>


        <div class="panel-body">
          <div class="row">
            <div align="center" class="col-md-1 col-lg-1">
            </div>


            <div class=" col-md-9 col-lg-9">
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>
                    </td>

                    <td><input class="form-control" name="title" placeholder="Entrez le titre de votre critique..." type="text">
                    </td>
                  </tr>


                  <tr>
                    <td>
                    </td>

                    <td><input class="form-control" name="dep" placeholder="Entrez le nom du film concerné..." type="text">
                    </td>
                  </tr>


                  <tr>
                    <td>
                    </td>

                    <td><input class="form-control" name="appre" placeholder="Entrez votre appréciation générale..." type="text">
                    </td>
                  </tr>

                  <tr>
                    <td>
                    </td>

                    <td>
                      <div class="input-group">
                        <span class="input-group-addon"></span> 

                        <textarea class="form-control" id="comment" placeholder="Entrez votre critique..." rows="5"></textarea>
                      </div>
                    </td>
                  </tr>


                  <tr>
                    <td>
                    </td>

                    <td>
                      <div class="dropdown">
                        <button aria-expanded="true" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">Attribuez votre note (sur 5)... <span class="caret"></span></button>

                        <ul aria-labelledby="dropdownMenu1" class="dropdown-menu">
                          <li>
                            <a data-value="1" href="#">1</a>
                          </li>


                          <li>
                            <a data-value="2" href="#">2</a>
                          </li>


                          <li>
                            <a data-value="3" href="#">3</a>
                          </li>


                          <li>
                            <a data-value="4" href="#">4</a>
                          </li>


                          <li>
                            <a data-value="5" href="#">5</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <a class="btn btn-success" href="#">Publier critique.</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>