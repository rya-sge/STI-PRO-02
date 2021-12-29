<?php
  $titre ='HashMail - passwd recup';

// vue_passwd_recup.php
// Date de création : 07/10/2021
// Fonction : vue pour modifier son nom d'utilisateur
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Profil</h1>
<h3 style="text-align:center">
Changer votre notre d'utilisateur
</h3>
<article> 
  <form class='form' method='POST' action="index.php?action=vue_profil_login_upd">
	<div class="form-group">
		<label>Nom d'utilisateur</label>
		<input class="form-control" type="text" name="fNLogin" value="<?php echo $_SESSION['login']; ?>" required></input>
		</br>
		<button type="submit" class="btn btn-primary" name="fBMLogin">Enregistrer les modifications</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'vue/gabarit_visiteur.php';
?>  
      
      
