<?php
$titre ='HashMail - Ajouter un administrateur';

// vue_role_add.php
// Date de création : 10/01/2021
// Fonction : vue pour ajouter un  modérateur
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<article>
    </br>
    <div id="profil">
        <fieldset>
            <h2><legend>Ajouter un administrateur</legend></h2>
            <form class='form' method='POST' action="index.php?action=vue_admin_add">
                <div class="form-group">
                    <label>Nom*</label>
                    <input class="form-control" type="text" placeholder="Entrez le nom de l'utilisateur'" name = "nom" value="<?=@$_POST['nom'] ?>" required/>
                    </br>
                    </br>
                    <button type="submit" class="btn btn-primary" name="AjoutModerateur">Ajouter l'utilisateur comme administrateur</button>
                    <button type="reset" class="btn btn-primary">Effacer</button>
                </div>
            </form>
        </fieldset>
        </br>
        <fieldset>
    </div>
</article>
<hr/>
<?php
$contenu = ob_get_clean();
require 'vue/gabarit.php';
?>


