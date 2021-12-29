<?php
  $titre ='HashMail - passwd modif';

// vue_profil_passwd_modif.php
// Date de création : 07/10/2021
// Fonction : vue pour modifier son mot de passe
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Profil</h1>
<h3 style="text-align:center">
Modifier votre mot de passe
</h3>
<article> 
  <form class='form' method='POST' action="index.php?action=vue_profil_passwd_modif">
	<div class="form-group">
		<label>Ancien Mot de passe</label><input class="form-control" type="password" name="fPasswdOld" required></input>
		<label>Nouveau mot de passe </label><input class="form-control" type="password" name="fNPasswdPost"required> </input>
		<label>Confirmer votre nouveau mot de passe</label><input class="form-control" type="password" name="fNPasswdConf"required> </input>
		</br>
		<button type="submit" class="btn btn-primary" name="fModifPasswd">Enregistrer les modifications</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'vue/gabarit_visiteur.php';
?>  
      
      
