<?php
$titre ='HashMail - passwd modif';

// vue_profil_passwd_modif_admin.php
// Date de création : 10/10/2021
// Fonction : vue pour modifier un mot de passe
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<?$_SESSION['error']="";?>
<h1 style="text-align:center">Profil</h1>
<h3 style="text-align:center">
    Modifier le mot de passe
</h3>
<article>
    <form class='form' method='POST' action="index.php?action=vue_profil_passwd_modif_admin">
        <div class="form-group">
            <label>Nouveau mot de passe </label><input class="form-control" type="password" name="fNPasswdPost"required> </input>
            <label>Confirmer le nouveau mot de passe</label><input class="form-control" type="password" name="fNPasswdConf"required> </input>
            </br>
            <input name="token" value="<?php echo $_SESSION["token"] ?>" type="hidden" />
            <input type="hidden" name="qIdUser" value="<?php echo $_GET['qIdUser']?>">
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


