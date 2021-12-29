<?php
  $titre ='HashMail - supprimer son compte';

// vue_profil_del.php
// Date de création : 07/10/2021
// Fonction : vue pour supprimer son compte
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Supression de compte</h1>
<article>
	<div class="cadre" >
		<p>Une fois votre compte supprimé, vous ne pourrez plus le récupérer.</p>
	
	<div  class="col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
	<form class="form" method="POST" action="index.php?action=vue_profil_del">
	<input style="align-text:center" type="submit" name="delUser" class='btn btn-danger' onclick="return confirm('Etes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible');" value="Supprimer son compte" />
	</form>
	</div>
</article>
<hr/>
<?php 
  $contenu = ob_get_clean();
  require 'vue/gabarit_visiteur.php';
?>  
      
      
