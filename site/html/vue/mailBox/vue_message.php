<?php
$titre = 'HashMail - message';

// vue_message.php
// Date de création : 07/10/2021
// Fonction : vue pour afficher un message
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
    <table>
        <th>Action</th>
        <tr>
            <th>Date de réception</th>
            <td width="20%"><?php echo $resultat['dateReceipt'];?></td>
        </tr>
        <tr>
            <th>Expéditeur</th>
            <td width="40%"><?php echo $resultat['name']; ?></td>
        </tr>
        <tr>
            <th>Sujet</th>

            <td width="20%"><?php echo $resultat['subject']; ?></td>
            <td width="20%">
                <a href="index.php?action=vue_inbox_delete&qIdMessage=<?= $resultat['id']; ?>"
                   onclick="return confirm('Etes-vous sûr de vouloir supprimer ce message');">
                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal"
                            data-target="#delete"><span class="glyphicon glyphicon-trash"></span>
                    </button>
                </a>
                <a href="index.php?action=vue_message_respond&qIdMessage=<?= $resultat['id'];?>&qIdSender=<?= $resultat['name'];?>">
                    <button class="btn btn-primary btn-xs" data-title="answer" data-toggle="modal"
                            data-target="#delete"><span class="glyphicon-phone-alt"></span>
                    </button>
                </a>
            </td>
        </tr>
    </table>
    <h3>Corps du message</h3>
    <p><?php echo $resultat['body']; ?>
    </p>
</article>
<hr/>
<?php
$contenu = ob_get_clean();
require 'vue/gabarit.php';
?>
