<?php
session_set_cookie_params(10000); // durée de vie de session  si > destruction automatique
session_start();

// index.php
// Date de création : 08/01/2021
// Fonction : page d'accueil
// _______________________________

require 'controleur/controleur.php';
require 'controleur/controleur_user.php';

try {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'vue_accueil' :
                accueil();
                break;
            case 'vue_login' :
                login();
                break;
            case 'vue_logout':
                isConnected();
                logout();
                break;


            ///inbox
            case 'vue_inbox':
                isConnected();
                mailInbox();
                break;

            case 'vue_message_read':
                isConnected();
                readMessage();
                break;

            case 'vue_message_add':
                isConnected();
                addMessage();
                break;

            case 'vue_message_respond':
                isConnected();
                respondMessage();
                break;

            case 'vue_inbox_delete':
                isConnected();
                deleteMessage();
                break;


            //profil
            case 'vue_role':
                isConnected();
                updUserRole();
                break;
            case 'vue_profil':
                isConnected();
                profil();
                break;
            case 'vue_profil_login_upd':
                isConnected();
                updateLogin();
                break;
            case 'vue_profil_email_upd':
                isConnected();
                updateEmail();
                break;
            case 'vue_profil_passwd_modif':
                isConnected();
                modifPasswd();
                break;

            case 'vue_passwd_upd':
                isConnected();
                updatePasswd();
                break;

            //Admin
            case 'vue_inscription':
                testR1Out();
                addUser();
                break;

            case 'vue_role_gestion':
                isConnected();
                testR1Out();
                roleGestion();
                break;

            case 'vue_user_delete':
                isConnected();
                testR1Out();
                deleteUserForAdmin();
                break;
            case 'vue_profil_admin':
                isConnected();
                testR1Out();
                userProfile();
                break;
            case 'vue_valid':
                isConnected();
                testR1Out();
                updUserValid();
                break;

            case 'vue_profil_passwd_modif_admin':
                isConnected();
                testR1Out();
                modifPasswdAdmin();
                break;

            case 'vue_profil_del':
                isConnected();
                testR1Out();
                deleteUser();
                break;


            default :
                throw new Exception("L'action demandée est inconnue !");
        }
    } else
        accueil();

} catch (Exception $e) {
    erreur($e->getMessage());
}
