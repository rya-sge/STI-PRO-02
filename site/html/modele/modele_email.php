<?php
/**Lister les messages reçus pour l'utilisateur
 * @return false|PDOStatement
 */
function listMailInbox()
{
    $db = getBD();
    // Création de la string pour la requête
    $requete = $db->prepare("SELECT message.id, dateReceipt, recipient, sender, body, subject, name  
                    from message
                    INNER JOIN user 
                    ON sender = user.id
                    WHERE
                    recipient  = :idUser
                    ORDER BY dateReceipt DESC;
                   ");
    $requete->bindValue(':idUser', $_SESSION["idUser"], PDO::PARAM_INT);
    $requete->execute();
    // Exécution de la requete
    return $requete->fetchAll();
}

/**
 * Récupérer le contenu d'un message
 * @param $idMessage
 * @return mixed
 *
 * @throws Exception
 */
function getMessageContent($idMessage)
{
    $db = getBD();
    $isPresent = selectMessageUserFromId($idMessage);
    if (empty($isPresent['id'])) {
        throw new Exception("Erreur : vous ne pouvez pas récupérer ce message");
    }
    // Création de la string pour la requête
    $requete = "SELECT message.id, dateReceipt, recipient, sender, body, subject, name  from message
                        LEFT JOIN user 
                            ON sender = user.id
                        WHERE
                        recipient  = :idUser
                        AND message.id = :idMessage;";
    // Exécution de la requete
    $requete = $db->prepare($requete);
    $requete->bindValue(':idMessage', $idMessage, PDO::PARAM_INT);
    $requete->bindValue(':idUser', $_SESSION["idUser"], PDO::PARAM_INT);
    $requete->execute();
    return $requete->fetch();
}

function selectMessageUserFromId($idMessage){
    $db = getBD();

    // Création de la string pour la requête
    $requete = $db->prepare("SELECT id from message where id = :idMessage");

    // Exécution de la requete
    $requete->bindValue(':idMessage', $idMessage, PDO::PARAM_INT);
    $requete->execute();
    return $requete->fetch();
}


/**
 * @brief supprimer un message
 * @param $idMessage à supprimer
 * @throws Exception
 */
function delMessage($idMessage)
{
    $db = getBD();
    $isPresent = selectMessageUserFromId($idMessage);
    if (empty($isPresent['id'])) {
        throw new Exception("Erreur : vous ne pouvez pas supprimer ce message");
    }
    $requete = 'DELETE 
                FROM message
                WHERE id = :idMessage;';
    $requete = $db->prepare($requete);
    $requete->bindValue(':idMessage', $idMessage, PDO::PARAM_INT);
    $requete = $requete->execute();
    if ($requete) {
        $_SESSION['modif'] = "Le message a été supprimé";
    } else {
        $_SESSION['modif'] = "Erreur : Le message n'a pas pu être  supprimé";
    }
}

/*
* @brief Ajouter un boiteMail
* @param Donnée POST du formulaire
* @details
* Source utilisée pour le traitement des checkbox : https://makitweb.com/get-checked-checkboxes-value-with-php/
*/
function addMessageBdd($postArray)
{
    $db = getBD();
    //Récupération des données passées en post
    $subject = erreurText($postArray ["subject"]);
    $body = erreurText($postArray ["body"]);

    $idRecipient = getIdUser(erreurText($postArray ["recipient"]));

    try {
        $reqSelect = $db->prepare("SELECT * 
                 FROM user
                 WHERE id = :idRecipient;");
        $reqSelect->bindValue(':idRecipient', $idRecipient, PDO::PARAM_INT);
        $reqSelect->execute();
        $ligne = $reqSelect->fetch(); // récupère la valeur du login sélectionné s'il y en a un
        // Vérifier que l'utilisateur existe
        if (empty($ligne['id'])) {
            $_SESSION['modif'] = "L'utilisateur n'existe pas";
            throw new Exception("Erreur : le message n'a pas pu être envoyé");
        }
        $req = $db->prepare('INSERT INTO message (sender, recipient, subject, body, dateReceipt)
                                      VALUES (:sender, :recipient, :subject, :body, :dateReceipt)');
        $req->bindValue(':sender', $_SESSION['idUser'], PDO::PARAM_INT);
        $req->bindValue(':recipient', $idRecipient, PDO::PARAM_INT);
        $req->bindValue(':subject', $subject);
        $req->bindValue(':body', $body);
        $req->bindValue(':dateReceipt', date('Y-m-d H:i:s'));

        $req->execute();
        $_SESSION['modif'] = "Le message a été envoyé.";
    } catch (Exception $e) {
        throw new Exception("Erreur : le message n'a pas pu être envoyé");
    }
}

?>


