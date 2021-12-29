<?php
  $titre ='HashMail - validation';

// vue_login.php
// Date de création : 07/10/2021
// Fonction : vue pour l'affichage la connexion utilisateur
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Mise à jour du mot de passe</h1>

<article>
 <p>
	Votre mot de passe a été mis à jour.
</p> 
 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'vue/gabarit_visiteur.php';
?>  
      
      
