<?php
$titre = 'HashMail - reponse';

// vue_user_gestion.php
// Date de création : 07/10/2021
// Fonction : vue pour gérer les rôles des utilisateurs sur le site
// __________________________________________

// Tampon de flux stocké en mémoire
ob_start();

?>
<h2>Messages</h2>
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

<hr/>
    </br>
    <div id="profil">
        <fieldset>
            <h2>
                <legend>Ecrire un message</legend>
            </h2>
            <form class='form' method='POST' action="index.php?action=vue_message_add">
                <div class="form-group">
                    <label>Destinataire*</label>
                    <input class="form-control" type="text" placeholder="Entrez le nom du destinataire" name="recipient"
                           value="<?= @$_POST['recipient'] ?>" required/>
                    </br>
                    <label>Sujet</label>
                    <input class="form-control" type="text" placeholder="Entrez le sujets" name="subject"
                           value="<?= @$_POST['subject'] ?>"/>
                    </br>
                    <label>Corps</label>
                    <textarea class="form-control"  rows="3"
                              placeholder="Entrez le texte de l'email" name="body"
                              value="<?= @$_POST['body'] ?>"> </textarea>
                    </br>
                    <!--Source : https://html5-tutorial.net/forms/checkboxes/ -->
                    </br>
                    <button type="submit" class="btn btn-primary" name="addMessage">Envoyer le message</button>
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
