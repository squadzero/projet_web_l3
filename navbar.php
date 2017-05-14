<?php require_once('fonctions.php'); ?>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="bouton"><span class="sr-only">Navigation.</span></button> <a class="navbar-brand" href="index.php">Accueil</a>
      </div>


      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li>
            <a href="contact.php">Contact.</a>
          </li>


          <li>
            <a href="about.php">À propos.</a>
          </li>
        </ul>
		<a class="bouton bouton-principal navbar-bouton" href="search.php" role="bouton">Recherche et accès aux différentes critiques.</a> 
		<?php
		if(!estConnecte())
		{
			echo'
				<a class="bouton bouton-principal navbar-bouton" href="connexion.php" role="bouton">Connexion.</a>
				<a class="bouton bouton-principal navbar-bouton" href="inscription.php" role="bouton">Inscription.</a>
			';
		}
		else
		{
			echo'
				<span id="nomUser">Connecté en tant que '.htmlspecialchars($_SESSION['login']).'</span>
					<ul class="nav navbar-nav navbar-right">
					  <li class="dropdown">
						<p class="bouton bouton-info dropdown-toggle navbar-bouton" data-toggle="dropdown">Profil ! <span class="caret"></span></p>


						<ul class="dropdown-menu">
						  <li>
							<a href="preferences.php">Profil.</a>
						  </li>
						  
                          <li>
							<a href="forumpost.php">Forum.</a>
						  </li>
						  
						  <li>
							<a href="deconnexion.php">Déconnexion.</a>
						  </li>
						</ul>
					  </li>
					</ul>
				';
		}
		?>
      </div>
    </div>
  </nav>
