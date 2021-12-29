<?php
  $titre ='HashMail - page visiteur';

// vue_visiteur.php
// Date de création : 11.10.2021
// Fonction : vue pour l'affichage de la page d'accueil.
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<article>
	<div class="row">
	<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 ">
		<div class="cadre"style="background-color:white"   >
			<p>
			Cette messagerie incroyable vous permettra de communiquer de manière sécurisée avec des personnes méga cool à
                travers le monde.
			</p>
		</div>
		<br />
		<br />
		<div class="btn-group row" >
			<div class="col-lg-offset-9 col-lg-6 col-md-offset-9 col-md-6 ">
			<a href='index.php?action=vue_inscription'><button type='button' class='btn btn-primary btn-lg'  >Créer un compte</button></a><br /><br />
			<a href='index.php?action=vue_login'><button type='button' class='btn btn-primary btn-sm'  >Se connecter</button></a>
		</div>
	</div>
	</div>
</article>
  <?php
    $contenu = ob_get_clean();
    require "gabarit_visiteur.php";
?>
