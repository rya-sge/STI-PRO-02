<?php
  $titre ='HashMail - email update';

// vue_profil_email_upd.php
// Date de création : 24/12/2020
// Fonction : vue pour modifier son adresse email
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Profil</h1>
<h3 style="text-align:center">
Motidifer votre adresse email
</h3>
<article> 
  <form class='form' method='POST' action="index.php?action=vue_profil_email_upd">
	<div class="form-group">
		<label>Adresse email</label>
		<input class="form-control" name="fNEmail" type="text" value="<?php echo $infoUser['email'];?>" required></input>
		</br>
		<button type="submit" class="btn btn-primary" name="fBMEmail">Enregistrer les modifications</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'vue/gabarit_visiteur.php';
?>  
      
      
