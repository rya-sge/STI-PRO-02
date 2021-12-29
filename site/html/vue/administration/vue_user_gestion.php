<?php
$titre = 'HashMail - Liste des utilisateurs';

// vue_user_gestion.php
// Date de création : 07/10/2021
// Fonction : vue pour gérer les rôles des utilisateurs sur le site
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Gestion des utilisateurs</h2>
<p class="textModif"><?php
    if (isset($_SESSION['modif'])) {
        echo $_SESSION['modif'];
        echo $_SESSION['modif'] = "";
    } ?>
</p>

<article>
    <div class="row">
        <div class="col-lg-8"> <!--Source : https://www.w3schools.com/bootstrap/bootstrap_tables.asp  -->
            <table class="table table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Nom d'utilisateur</th>
                    <th>Action</th>
                    <th>User</th>
                </tr>
                <?php
                //Affiche la liste des comptes avec leur catégorie
                foreach ($resultats as $resultat) {
                    ?>
                    <tr>
                        <td width="20%"><?php echo $resultat['id']; ?></td>
                        <td width="33%"><?php echo $resultat['name']; ?></td>
                        <td width="33%">
                            <a href="index.php?action=vue_user_delete&qIdUser=<?= $resultat['id']; ?>"
                               onclick="return confirm('Etes-vous sûr de vouloir supprimer cet utilisateur');">
                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal"
                                        data-target="#delete"><span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </a>
                            <a href="index.php?action=vue_profil_admin&qIdUser=<?= $resultat['id']; ?>">
                                <button class="btn btn-primary btn-xs" data-title="update" data-toggle="modal"
                                        data-target="#delete"><span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </a>
                        </td>
                        <td width="20%">
                            <?php $dest = "index.php?action=vue_role&qIdUser=".$resultat['id']; ?>
                            <form class='form' method='POST' action="<?php echo $dest ?>"
                                  enctype="multipart/form-data">
                                <?php require 'vue_select_role.php'; ?>
                                <button type="submit" class="btn btn-primary" name="addRole">Envoyer</button>
                            </form>
                        </td>
                    </tr>
                <?php }
                ?>
            </table>
        </div>
</article>
<hr/>
<?php
$contenu = ob_get_clean();
require 'vue/gabarit.php';
?>


