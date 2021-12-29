<?php

// ------------ Users --------------------- 
// -----------------------------
//Controleur de la partie utilisateurs
//Date de création :  13.10.2021


/*
 * @brief gère la connexion au site web
 */
function login()
{
    // Récupération des variables POST
    if (isset($_POST['fLogin'])) {
        if (isset($_POST['fLogin'])) {
            try {
                $infoUser = checkLogin($_POST);//vérification du login
                if ($infoUser) {
                    //Initialise les variables de session nécessaires pour  être identifié sur le site avec son compte
                    $_SESSION["isConnected"] = true;
                    $_SESSION["idUser"] = $infoUser['idUser'];
                    $_SESSION['login'] = $infoUser['login'];
                    $_SESSION['email'] = $infoUser['email'];
                    $_SESSION['idRole'] = $infoUser['idRole'];
                    $_SESSION['error'] = "";
                    @header("location: index.php?action=vue_accueil");
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['erreur'] = $e->getMessage();
                @header("location: index.php?action=vue_login");
                exit();
            }
        }
    } else {
        if (isset($_SESSION['login'])) {
            require "vue/vue_accueil.php"; //affiche la vue accueil si l'utilisateur est connecté
        } else //Si l'utilisateur n'est pas connecté
        {
            require ROOT_PROFIL . "vue_login.php";
        }
    }
}

// -----------------------------
/*
 * @brief gère la dé-connexion du site web
 * @details Supprime les variables de session de l'utilisateur
 */
function logout()
{
    if (isset($_SESSION['idUser'])) {
        session_destroy();
        @header("location: index.php?action=vue_logout");
    } else {
        require ROOT_PROFIL . "vue_logout.php";
    }
}

// -----------------------------
/*
 * @brief gère l'ajout d'un utilisateur au site web
 */
function addUser()
{
    if (isset($_POST['fLogin'])) {
        try {
            ajoutUser($_POST);
            require ROOT_PROFIL . "vue_validation_utilisateur.php";
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
            require ROOT_PROFIL . "vue_inscription.php";
        }
    } else {
        require ROOT_PROFIL . "vue_inscription.php";
    }
}


/*
 * @brief Initialiser un nouveau mot de passe
 */
function updatePasswd()
{
    if (isset($_POST['fUpdPasswd'])) {
        $email = $_GET['qLog'];
        updPasswd($_POST, $email);
    }
}

// -----------------------------
/*
 * @brief afficher le profil de l'utilisateur ou modifier
 */
function profil()
{
    if (isset($_SESSION['idUser'])) {
        $infoUser = infoUtilisateur();//Récuper les données de l'utilisateur via le modèle
        //Variable post existe si l'utilisateur a cliqué sur le bouton modifer de son profil
        if (isset($_POST['fNProfil'])) {
            require ROOT_PROFIL . "vue_profil_upd.php"; //Affichge de la vue permettant de modifier son profil
        } else {//Affiche le profil avec les données de l'utilisateur
            require ROOT_PROFIL . "vue_profil.php";
        }
    } else {
        require "vue/vue_visiteur.php";
    }
}

// -----------------------------
/*
 * @brief mettre à jour/changer son adresse email
 */
function updateEmail()
{
    $infoUser = infoUtilisateur();
    if (isset($_SESSION['idUser']) AND isset($_POST['fBMEmail'])) {
        try {
            changeEmail();
            @header("location: index.php?action=vue_profil");
            exit();
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
            require ROOT_PROFIL . "vue_profil_email_upd.php";
        }
    } else {
        require ROOT_PROFIL . "vue_profil_email_upd.php";
    }
}

// -----------------------------
/*
 * @brief Pour mettre à jour/changer son login
 */
function updateLogin()
{
    $infoUser = infoUtilisateur();
    if (isset($_SESSION['idUser']) AND isset($_POST['fBMLogin'])) {
        try {
            changeLogin($_POST);
            @header("location: index.php?action=vue_profil");
            exit();
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
            require ROOT_PROFIL . "vue_profil_login_upd.php";
        }
    } else {
        require ROOT_PROFIL . "vue_profil_login_upd.php";
    }
}

// -----------------------------
/*
 * @brief mettre à jour/changer son mot de passe
 */
function modifPasswd()
{
    $infoUser = infoUtilisateur();
    if (isset($_POST['fNPasswdPost'])) {
        try {
            changePasswd($_POST);
            $_SESSION['erreur2'] = false;
            @header("location: index.php?action=vue_profil");
            exit;
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
            $_SESSION['erreur2'] = true;
            require ROOT_PROFIL . "vue_profil_passwd_modif.php";
        }

    } else {
        require ROOT_PROFIL . "vue_profil_passwd_modif.php";
    }
}

// -----------------------------
/*
 * @brief gère la suppression d'un compte utilisateur à la demande de son propriétaire(via son profiL)
 */
function deleteUser()
{
    //Variable post existe si l'utilisateur a cliqué sur le bouton suppriner de son profil
    if (isset($_SESSION['idUser']) AND isset($_POST['delUser'])) {
        try {
            delUser($_SESSION['idUser']);//suppression de l'utilisateur
            session_destroy();//Destruction des variables de sessions
            //redirection ves la page de confirmation de modification
            require ROOT_PROFIL . "vue_validation_utilisateur_del.php";
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
            $_SESSION['erreur'] = $e->getMessage();
        }
    } else {
        require ROOT_PROFIL . "vue_profil_del.php";
    }
}

// -----------------------------
/*
 * @brief Récupérer les infos d'un compte
 */
function userProfile()
{
    if (isset($_GET['qIdUser'])) {
        $infoUser = infoUser($_GET['qIdUser']);//Récuper les données d'un utilisateur via le modèle

        //Affiche le profil avec les données de l'utilisateur
        require ROOT_PROFIL . "vue_profil_admin.php";
    } else {
        require "vue/vue_visiteur.php";
    }
}

