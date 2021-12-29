<?php
define("ROOT_ERREUR", "vue/erreur");
// modele.php
// Fonction : modele avec connexion avec le serveur et la BD
//            exécution des requêtes
// ____________________________________________________________


// -----------------------------------------------------
// Fonctions liées aux utilisateurs

// -----------------------------
// getIdUser($login)
//argument : le login de l'utilisateur
// Fonction : Récupère l'id d'un utilisateur à partir de son login
//Utilisée dans la fonction : ajoutActivite
// Sortie : $idUser['idUser']. Il s'agit de l'id de l'utilisateur
function getIdUser($login)
{
    $db = getBD();
    // Création de la string pour la requête
    $requete = "SELECT id 
                FROM user
                WHERE name='" . $login . "'
                    OR email='" . $login . "'";
    // Exécution de la requete
    $resultats = $db->query($requete);
    $idUser = $resultats->fetch();
    return $idUser['id'];
}


/*
 * @brief  Met à jour le rôle d'un utilisateur spécifié par son nom.
 * @param nom nom utilisateur
 * @param idRole nouveau Rôle
 */
function updateRoleByName($nom, $idRole)
{
    $db = getBD();
    // Création de la string pour la requête
    $requete = $db->prepare("UPDATE user
                                       SET idRole = '" . $idRole . "'
                                       WHERE name = '" . $nom . "'
                                       AND id !='" . $_SESSION['idUser'] ."'
                                       AND id != 1;");
    // Exécution de la requete
    $requete->execute();
    if ($requete->rowCount()) {
        $_SESSION['modif'] = "Le rôle de l'utilisateur a été modifié";
    } else {
        $_SESSION['modif'] = "Erreur : le rôle n'a pas pu être modifié";
    }
}

/*
 * @brief Met à jour le rôle d'un utilisateur spécifié par son ID
 * @param idUtilisateur de l'utilisateur
 * @param idRole nouveau Rôle
 */
function updateRoleById($idUtilisateur, $idRole)
{
    $db = getBD();
    // Création de la string pour la requête
    $requete = $db->prepare("UPDATE user
                                        SET idRole = '" . $idRole . "'
                                       WHERE id = '" . $idUtilisateur . "'");
    // Exécution de la requete
    $requete->execute();
    if ($requete->rowCount()) {
        $_SESSION['modif'] = "Le rôle de l'utilisateur a été modifié";
    } else {
        $_SESSION['modif'] = "Erreur : le rôle n'a pas pu être modifié";
    }
}

// -----------------------------
/*
 * @brief  contient la requête permettant d'avoir toutes les informations de l'utilisateur passé en paramètre
 * @param le login de l'utilisateur
 * @return $resultats. Il s'agit d'jeu de résultats retourné en tant qu'objet PDOStatement
 */
function getUserByLogin($login)
{
    $db = getBD();
    // Création de la string pour la requête
    $requete = "SELECT * 
                FROM user
                WHERE name ='" . $login . "'";
    // Exécution de la requete
    return $db->query($requete);
}


// -----------------------------
// infoUtilisateur()
/*
 * @brief Récupère les infos de l'utilisateur connecté
 * @return $infoUser Les informations de l'utilisateur
 */
function infoUtilisateur()
{
    $db = getBD();
    //Initialisation du tableau qui va contenir les informations de l'utilisateur.
    $infoUser = array(
        'email' => "",
    );
    $reponse = getUserByLogin($_SESSION['login']);
    $donnees = $reponse->fetch();
    //Insère dans le tableau précédemment crée les informations de l'utilisateur
    if (empty($donnees['name'])) {
        throw new Exception("Le nom d'utilisateur n'existe pas");
    }
    $infoUser = array(
        'email' => $donnees['email'],
    );
    return $infoUser;//Retourne le tableau contenant les informations de l'utilisateur
}

// -----------------------------
/*
 * @brief  Contrôle de login
 * @return $infoUser. COntient les informations de base de l'utilisateur (email, id et login)
 * @param les informations passées en POST
 */
function checkLogin($postArray)
{
    $username = $postArray ["fLogin"];
    $passwdPost = $postArray["fPasswd"];
    $resultats = getUserByLogin($username);
    $resultats = $resultats->fetch();
    if ($resultats['isValid'] == 0) {
        throw new Exception("Le compte est inactif");
    }
    if (empty($resultats['name'])) {
        throw new Exception("Les données d'authentification sont incorrectes");
    }
    $hash = $resultats['password'];
    if (password_verify($passwdPost, $hash)) {
        //Initialisation du tableau qui va contenir les informations de l'utilisateur.
        $infoUser = array(
            'email' => $resultats['email'],
            'idUser' => $resultats['id'],
            'login' => $resultats['name'],
            'idRole' => $resultats['idRole'],
        );
    } else {
        throw new Exception("Les données d'authentification sont incorrectes");
    }
    return @$infoUser;//renvoie certaines infos de l'utilisateur
}

// -----------------------------
/*
 * @brief  Ajouter un utilisateur
 * @param les informations passées en POST
 */
function ajoutUser($postArray)
{
    $db = getBD();
    $email = $_POST['fEmail'];
    $login = $postArray ["fLogin"];
    $passwdPost = $postArray["fPasswd"];
    $passwdConf = $postArray['fPasswdConf'];
    //Test des formulaires
    champVide($login, "Login");
    champVide($email, "Email");
    champVide($passwdPost, "Mot de passe");
    champVide($passwdConf, "Confirmer votre mot de passe");
    verifEmail($email);
    longChampValid($email, "Adresse email", 254);
    longChampValid($login, "Nom d'utilisateur/login", 30);

    erreurPasswd($passwdConf, $passwdPost);
    //Source pour le test de la validation d'adresse email : http://php.net/manual/fr/filter.examples.validation.php
    //Hashage mdp
    $passwdHash = password_hash($passwdPost, PASSWORD_DEFAULT);
    $passwd = $passwdHash;
    // test si le login ou l'email existe déjà pour éviter qu'il y ait deux utilisateurs ayant le même login ou la même adresse email
    $reqSelect = "SELECT * 
                 FROM user
                 WHERE name='" . $login . "'
                    OR email='" . $email . "';";
    $res = $db->query($reqSelect);
    $ligne = $res->fetch(); // récupère la valeur du login sélectionné s'il y en a un
    // Test le résultat
    if (empty($ligne['name'])) {
        // ajout de l'utilisateur
        $req = $db->prepare('INSERT INTO user (name, email, password, isValid, idRole )
                    VALUES (:name, :email, :password, :isValid, :idRole)');
        $req->execute(array(
            'name' => $login,
            'email' => $email,
            'password' => $passwd,
            'isValid' => 1,
            'idRole' => 2
        ));
    } else {
        throw new Exception("L'utilisateur ne peut pas être ajouté car il existe déjà.");
    }
}


// -----------------------------
/*
 * @brief  Permet de changer le mot de passe
 * @param les informations passées en POST
 */
function changePasswd($postArray)
{
    $passwdOld = $postArray['fPasswdOld'];
    $NPasswdPost = $postArray['fNPasswdPost'];
    $NPasswdConf = $postArray['fNPasswdConf'];
    $db = getBD();
    //Sélection du mot de passe de l'utilisateur dans la BDD
    $requete = "SELECT password
              FROM user
              WHERE name ='" . $_SESSION['login'] . "';";
    $resultats = $db->query($requete);
    $passwd = $resultats->fetch();

    if (!empty($resultats)) {
       //Vérifie que les mots de passes correspondent
        erreurPasswd($NPasswdConf, $NPasswdPost);
        $hash = $passwd['password'];
        if (password_verify($passwdOld, $hash)) //Vérification du mot de passe
        {
            $passwdHash = password_hash($NPasswdPost, PASSWORD_DEFAULT); //Hachage du mot de passe
            $passwd = $passwdHash;
            //Mise à jour des informations
            $req = $db->prepare("UPDATE user SET password=:password
                WHERE id='" . $_SESSION['idUser'] . "';");
            $req->execute(array(
                'password' => $passwd,
            ));
            $_SESSION['modif'] = "Votre mot de passe a été modifié";
        } else {
            throw new Exception("Les données d'authentification sont incorrectes");
        }
    } else {
        throw new Exception("Les données d'authentification sont incorrectes");
    }
}

// -----------------------------
/*
 * @brief   Permet de changer le login
 * @details Ne fait rien si le nouveau login est identique au précédent
 */
function changeLogin($postArray)
{
    $db = getBD();
    $NLogin = $postArray ["fNLogin"];
    champVide($NLogin, "Nom d'utilisateur/login");
    erreurXss($NLogin);
    longChampValid($NLogin, "Nom d'utilisateur/login", 30);
    if ($NLogin != $_SESSION['login']) {
        // test si le login ou l'email existe déjà pour éviter qu'il y ait deux utilisateurs ayant le même login
        $reqSelect = "SELECT * 
                     FROM user
                     WHERE name='" . $NLogin . "'
                        AND name !='" . $_SESSION['login'] . "';";
        $res = $db->query($reqSelect);
        $ligne = $res->fetch(); // récupère la valeur du login sélectionné s'il y en a un
        // Test le résultat
        if (empty($ligne['name'])) {
            //Mise à jour des informations
            $req = $db->prepare("update user set name=:name
            WHERE id='" . $_SESSION['idUser'] . "';");
            $req->execute(array(
                'name' => $NLogin,
            ));
            $_SESSION['login'] = $NLogin;
            $_SESSION['modif'] = "Votre nom d'utilisateur a été modifié";
        } else {
            throw new Exception("Ce login est déjà utilisé");
        }
    }

}


// -----------------------------
/*
 * @brief  Permet de supprimer un utilisateur
 * @param L'id de l'utilisateur à supprimer
 */
function delUser($idUser)
{
    $db = getBD();
    $requete = 'DELETE FROM user
                WHERE id ="' . $idUser . '";';
    $db->exec($requete);
}

/*
 * @brief  Permet de récupérer les infos d'un utilisateur par son id
 * @param L'id de l'utilisateur à récupérer
 */
function infoUser($idUser)
{
    $db = getBD();

    $request = "SELECT * FROM USER
                WHERE id = $idUser";
    $infoUser = $db->query($request)->fetch();

    return $infoUser;//Retourne le tableau contenant les informations de l'utilisateur
}

// -----------------------------
/*
 * @brief  Permet de changer le mot de passe d'un utilisateur
 * @param les informations passées en POST
 */
function changePasswdAdmin($postArray)
{
    // Pour tester
    //file_put_contents('test.txt', print_r($postArray, true));
    $NPasswdPost = $postArray['fNPasswdPost'];
    $NPasswdConf = $postArray['fNPasswdConf'];
    $db = getBD();

    erreurPasswd($NPasswdConf, $NPasswdPost); //Vérifie que les mots de passes correspondent et soient assez long

    $passwdHash = password_hash($NPasswdPost, PASSWORD_DEFAULT); //Hachage du mot de passe
    $passwd = $passwdHash;
    //Mise à jour des informations
    $req = $db->prepare("UPDATE user SET password=:password
        WHERE id='" . $postArray['qIdUser'] . "';");
    $req->execute(array(
        'password' => $passwd,
    ));
    $_SESSION['modif'] = "Votre mot de passe a été modifié";

}

/*
 * @brief Met à jour l'activité d'un compte utilisateur spécifié par son ID
 * @param idUtilisateur de l'utilisateur
 * @param idValid nouveau status
 */
function updateValidById($idUtilisateur, $isValid)
{
    $db = getBD();
    // Création de la string pour la requête
    $requete = $db->prepare("UPDATE user
                                        SET isValid = '" . $isValid . "'
                                       WHERE id = '" . $idUtilisateur . "'");
    // Exécution de la requete
    $requete->execute();
    if ($requete->rowCount()) {
        $_SESSION['modif'] = "L'activité de l'utilisateur a été modifiée";
    } else {
        $_SESSION['modif'] = "Erreur : l'activité n'a pas pu être modifiée";
    }
}
