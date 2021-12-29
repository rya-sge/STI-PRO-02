<?php
/**Lister les messages reçus pour l'utilisateur
 * @return false|PDOStatement
 */
    function listMailInbox()
    {
        $db = getBD();
        // Création de la string pour la requête
        $requete = "SELECT message.id, dateReceipt, recipient, sender, body, subject, name  
                    from message
                    INNER JOIN user 
                    ON sender = user.id
                    WHERE
                    recipient  = '" . $_SESSION["idUser"] . "'
                    ORDER BY dateReceipt DESC;
                   ";
        // Exécution de la requete
        return $db->query($requete);
    }

/**
 * Récupérer le contenu d'un message
 * @param $idMessage
 * @return mixed
 *
 */
    function getMessageContent($idMessage)
        {
            $db = getBD();
            // Création de la string pour la requête
            $requete = "SELECT message.id, dateReceipt, recipient, sender, body, subject, name  from message
                        LEFT JOIN user 
                            ON sender = user.id
                        WHERE
                        recipient  = '" . $_SESSION["idUser"] . "'
                        AND message.id = $idMessage;";
            // Exécution de la requete
            return $db->query($requete)->fetch();
        }




/*
 * @brief supprimer un algorithme
 * @param L'id de l'algorithme à supprimer
 */
function delMessage($idMessage)
{
    $db = getBD();
    $requete = 'DELETE 
                FROM message
                WHERE id ="' . $idMessage . '" ;';
    $requete = $db->exec($requete);
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
    $subject = $postArray ["subject"];
    $body = $postArray ["body"];

    $idRecipient= getIdUser($postArray ["recipient"]);

    try{

        $reqSelect = "SELECT * 
                 FROM user
                 WHERE id='" . $idRecipient . "';";
        $res = $db->query($reqSelect);
        $ligne = $res->fetch(); // récupère la valeur du login sélectionné s'il y en a un
        // Vérifier que l'utilisateur existe
        if (empty($ligne['id'])) {
            $_SESSION['modif'] = "L'utilisateur n'existe pas";
            throw new Exception("Erreur : le message n'a pas pu être envoyé");
        }
        $req = $db->prepare('INSERT INTO message (sender, recipient, subject, body, dateReceipt)
                                      VALUES (:sender, :recipient, :subject, :body, :dateReceipt)');
        $req->execute(array(
            'sender' => $_SESSION['idUser'],
            'dateReceipt' => date('Y-m-d H:i:s'),
            'recipient' => $idRecipient,
            'subject' => $subject,
            'body' => $body,
        ));
        $_SESSION['modif'] = "Le message a été envoyé.";
    } catch(Exception $e){
        throw new Exception("Erreur : le message n'a pas pu être envoyé");
    }
}
?>


