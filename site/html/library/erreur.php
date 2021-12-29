<?php

// ------------ Erreur ---------------------
//Fonctions  de traitement des erreurs



/*
 * @brief Vérification du mode de passe proposé par l'utilisateur
 * @param passwdConf confirmation du mot de passe
 * @param passwdPost mot de passe entré par l'utilisateur
 * @throw exception si le mot de passe n'est pas valide
 * @details : cette fonction n'effectue aucune requête dans la BDD.
 */
function erreurPasswd($passwdConf, $passwdPost)
{
    if ($passwdConf != $passwdPost) {
        throw new Exception("Les mots de passes ne correspondent pas");
    }
}

function verifEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("L'adresse email n'est pas valide");
    }
}

/*
 * @brief Vérifier qu'un champ n'est pas vide
 * @param champ à vérifier
 * @param nomChamp nom champ à afficher en cas d'erreur
 * @throw exception si le champ est vide
 */
function champVide($champ, $nomChamp)
{
    if ($champ == "") {
        throw new Exception("Le champ " . $nomChamp . " doit être rempli");
    }
}

/*
 * @brief Vérification de la longueur d'un champ
 * @param champ à vérifier
 * @param nomChamp nom champ à afficher en cas d'erreur
 * @throw exception si le champ n'a pas la longueur requise
 */
function longChampValid($champ, $nomChamp, $length)
{
    $lengChamp = strlen($champ);
    if ($lengChamp > $length) {
        throw new Exception("Le champ " . $nomChamp . " est trop long. Il faut le raccourcir");

    }
}

?>
