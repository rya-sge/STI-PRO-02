<?php
// ------------ Administration ---------------------
//Contrôleur de la partie administration
//Date de création :  13.10.2021


/*
 * @brief gère le rôle des utilisateurs
 */
function roleGestion()
{
    $resultats = listUser();
    require "vue/administration/vue_user_gestion.php";
}

/**
 * Mise à jour du rôle d'un utilisateur
 */
function updUserRole(){
    if (isset($_POST['qIdUser']) && isset($_POST['role'])) {
        try {
            if($_POST['qIdUser'] == $_SESSION['idUser']){
                throw new Exception("Vous ne pouvez pas changer votre propre rôle");
            }
            verifCSRF();
            updateRoleById(checkInt($_POST['qIdUser']), $_POST['role']);
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
        }
    }
    @header("location: index.php?action=vue_role_gestion");
    exit();
}

/**
 * Suppression d'un utilisateur
 */
function deleteUserForAdmin(){
    if (isset($_POST['qIdUser'])) {
        try {
            verifCSRF();
            delUser(checkInt($_POST['qIdUser']));//suppression de l'utilisateur
            $_SESSION['modif'] = "L'utilisateur a été supprimé";
        } catch (Exception $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);
            $_SESSION['erreur'] = $e->getMessage();
        }
    }else{
        $_SESSION['modif'] = "Error : user has not been deleted";
    }
    @header("location: index.php?action=vue_role_gestion");
}

/**
 * Mise à jour du statut de validité d'un utilisateur
 */
function updUserValid(){
    if (isset($_POST['qIdUser']) && isset($_POST['valid'])) {
        try {
            verifCSRF();
            updateValidById(checkInt($_POST['qIdUser']), $_POST['valid']);
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
        }
    }
    @header("location: index.php?action=vue_profil_admin&qIdUser=" . $_POST['qIdUser']);
}

/*
 * @brief mettre à jour/changer un mot de passe
 */
function modifPasswdAdmin()
{
    if (isset($_POST['fNPasswdPost'])) {
        try {
            verifCSRF();
            changePasswdAdmin($_POST);
            $_SESSION['erreur2'] = false;
            @header("location: index.php?action=vue_profil_admin&qIdUser=" . $_POST['qIdUser']);
            exit;
        } catch (Exception $e) {
            $_SESSION['erreur'] = $e->getMessage();
            $_SESSION['erreur2'] = true;
            require ROOT_PROFIL . "vue_profil_passwd_modif_admin.php";
        }

    } else {
        require ROOT_PROFIL . "vue_profil_passwd_modif_admin.php";
    }
}
