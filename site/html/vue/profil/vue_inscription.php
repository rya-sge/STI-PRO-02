<?php
  $titre ='HashMail - inscription';

// vue_inscription.php
// Date de création : 24/12/2020
// Fonction : vue pour la création d'un compte utilisateur.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<h2 style="text-align:center">Créer un compte</h2>

<article>
  
<article>
  
  <form class='form' method='POST' action="index.php?action=vue_inscription">
	<div class="form-group">
		<label>Nom d'utilisateur*</label>
        <input class="form-control" type="text" placeholder="Entrez votre nom d'utilisateur" name="fLogin" value="<?=@$_POST['fLogin'] ?>" required/>
		</br>
		<label>Email*</label>
        <input class="form-control" type="email" placeholder="Entrez votre adresse email" name="fEmail" value="<?=@$_POST['fEmail'] ?>" required/>
		</br>
		<label>Mot de passe*</label>
		<input class="form-control"  type="password" placeholder="Entrez votre mot de passe" name="fPasswd" required/>
		</br>
		<label>Confirmer mot de passe*</label>
		<input class="form-control"  type="password" placeholder="Entrez votre mot de passe" name="fPasswdConf"  required/>
		</br>
		<button type="submit" class="btn btn-primary" name="fConnexion">Créer le compte</button>
		<button type="reset" class="btn btn-primary">Effacer</button>
    </div>
  </form> 
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'vue/gabarit_visiteur.php';
?>  
      
      
