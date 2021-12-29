<?php
  $titre ='HashMail - Profil utilisateur';

// vue_profil_admin.php
// Date de création : 07/10/2021
// Fonction : vue pour afficher le  profil de l'utilisateur, qui contient ses informations personnelles.
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
	
<?php

?>
<p class="textModif"><?php
	if(isset($_SESSION['modif']))
	{
		echo $_SESSION['modif'];
		echo $_SESSION['modif']="";
	}?>
	</p>
<div id="profil">
	<h1>PROFIL</h1>
	<p>Modification du profil de l'utilisateur <?php echo $infoUser['name'] ?>. </p>
	<table class="table table-bordered" >
		<thead>
			<tr>
				<th colspan=2 style="width:50; text-align:center"  >Infomations de compte</th>
					<!--<form action="index.php?action=vue_profil" method="Post" >-->
				<th style="width:20%">Action</th>
					<!--<input class ="btn btn-primary" type="submit" name="fNProfil" value="modifier"></input>
				</th>-->
				<!--Ce formulaire permet d'aller sur la page d'édition des informations de compte -->		
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Nom d'utilisateur</td>
				<td><?php echo $infoUser['name'];?></td>
			</tr>
			<tr>
			<td>Mot de passe</td>
                <td></td>
			<td><a href="index.php?action=vue_profil_passwd_modif_admin&qIdUser=<?php echo $infoUser['id'] ?>"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></button></a></td>
			</tr>
            <tr>
                <td>Rôle</td>
                <td><?php  echo $infoUser['idRole'] == 1 ? "Administrateur" : "Collaborateur"; ?></td>
                <td></td>
            </tr>
			<tr>
				<td>Etat du compte</td>
				<td><?php echo $infoUser['isValid'] == 1 ? "Actif" : "Inactif" ?></td>
                <td>
                    <form class="form" method="POST" action="index.php?action=vue_valid&qIdUser=<?php echo $infoUser['id'] ?>" enctype="multipart/form-data">
                        <select name="valid">
                            <option value=1>Actif</option>
                            <option value=0>Inactif</option>
                        </select>
                        <button type="submit" class="btn btn-primary" name="addRole">Envoyer</button>
                    </form>
                </td>
			</tr>
		<tbody>
	</table>
</div>
  <?php
    $contenu = ob_get_clean();
    require "vue/gabarit_visiteur.php";
?>
