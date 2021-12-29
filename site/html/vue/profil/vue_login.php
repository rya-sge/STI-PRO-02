<?php
  $titre ='HashMail - Login';

// vue_login.php
// Date de création : 07/10/2021
// Fonction : vue pour l'affichage la connexion utilisateur
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Se connecter</h1>

<article>
  
  <form class='form' method='POST' action="index.php?action=vue_login">
	<div class="form-group">
		<label>Nom d'utilisateur</label>
        <input class="form-control" type="text" placeholder="Entrez votre nom d'utilisateur" name="fLogin" required />
		</br>
		<label>Mot de passe</label>
		<input class="form-control"  type="password" placeholder="Entrez votre mot de passe" name="fPasswd" required/>
		</br>
		<button type="submit" class="btn btn-primary" name="fConnexion">Se connecter</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
		
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'vue/gabarit_visiteur.php';
?>  
      
      
