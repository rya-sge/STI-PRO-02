<?php
$titre = 'HashMail - inbox';

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
                    <th>Date de réception</th>
                    <th>Subject</th>
                    <th>Sender</th>
                    <th>Action</th>
                </tr>
                <?php
                //Affiche la liste des comptes avec leur catégorie
                foreach ($message as $resultat) {
                    ?>
                    <tr>
                        <td width="20%"><?php echo $resultat['id']; ?></td>
                        <td width="33%"><?php echo $resultat['dateReceipt']; ?></td>
                        <td width="33%"><?php echo $resultat['subject']; ?></td>
                        <td width="33%"><?php echo $resultat['name']; ?></td>
                        <td width="33%">
                            <a href="index.php?action=vue_inbox_delete&qIdMessage=<?= $resultat['id']; ?>"
                               onclick="return confirm('Etes-vous sûr de vouloir supprimer cet utilisateur');">
                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal"
                                        data-target="#delete"><span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </a>
                            <a href="index.php?action=vue_message_read&qIdMessage=<?= $resultat['id']; ?>">
                                <button class="btn btn-primary btn-xs" data-title="update" data-toggle="modal"
                                        data-target="#delete"><span class="glyphicon glyphicon-sunglasses"></span>
                                </button>
                            </a>
                            <a href="index.php?action=vue_message_respond&qIdMessage=<?= $resultat['id'];?>&qIdSender=<?= $resultat['name'];?>">
                                <button class="btn btn-primary btn-xs" data-title="answer" data-toggle="modal"
                                        data-target="#delete"><span class="glyphicon-phone-alt"></span>
                                </button>
                            </a>
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


