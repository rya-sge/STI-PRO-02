<?php

// controleur.php
// Date de création : 13.10.2021
// Fonction : controleur
// _______________________________
require "controleur/controleur_administration.php";


require "modele/modele_BDD.php";
require "modele/modele_user.php";
require "modele/modele_email.php";
require "modele/modele_administration.php";

require "library/permission.php";
require "library/erreur.php";
require "library/security.php";

define("ROOT_ADMINISTRATION", "vue/administration/");
define("ROOT_PROFIL", "vue/profil/");
define("ROOT_MAILBOX", "vue/mailbox");
define("NON_VALIDE", "En attente de validation");
define("VALIDE", "Validé");


// Affichage de la page d'accueil
function accueil()
{
    if (isset($_SESSION['login'])) {
        require "vue/vue_accueil.php";
        exit;
    } else {
        require "vue/vue_visiteur.php";
    }
}

/*
 * Afficher la liste des messages
 */
function mailInbox(){
    $message = listMailInbox();
    require "vue/mailBox/vue_inbox.php";
}

function readMessage(){

    if (isset($_POST['qIdMessage']))
    {
        verifCSRF();
        $resultat = getMessageContent(checkInt($_POST['qIdMessage']));
        require "vue/mailBox/vue_message.php";

    }else{
        exit;
    }

}

function deleteMessage(){


    //Variable post existe si l'utilisateur a cliqué sur le bouton supprimer
    if (isset($_POST['qIdMessage'])) {
        verifCSRF();
        delMessage(checkInt($_POST['qIdMessage']));
        @header("location: index.php?action=vue_inbox");
    } else {
        throw new Exception("Aucun message n'est sélectionné");
    }
}

function addMessage()
{
    //Variable post existe si l'utilisateur a cliqué sur le bouton Ajouter
    if (isset($_POST['addMessage'])) {
            try {
                verifCSRF();
                addMessageBdd($_POST);
                //redirection ves la page de gestion des algorithmes
               
            } catch (Exception $e) {
                $_SESSION['erreur'] = $e->getMessage();
                //@header("location: index.php?action=vue_algorithme_add");
            }
    }
    require "vue/mailBox/vue_message_add.php";
}

function respondMessage(){
    //Variable post existe si l'utilisateur a cliqué sur le bouton répondre
  if (isset($_POST['qNameSender']) && isset($_POST['qIdMessage']))
  {
      verifCSRF();
      $resultat = getMessageContent(checkInt($_POST['qIdMessage']));
      $_POST['recipient'] = $_POST['qNameSender'];
      require "vue/mailBox/vue_message_response.php";


  }
}
// ------------ Autres ---------------------
function erreur($msg)
{
    $_SESSION['erreur'] = $msg;
    if (isset($_SESSION['login'])) {
        require "vue/erreur/vue_erreur.php";
    } else {
        require "vue/erreur/vue_erreur_visiteur.php";
    }
}









