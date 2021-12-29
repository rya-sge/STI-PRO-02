<?php
// ------------ Permission ---------------------
//Fonctions  pour vérifier les permissions de l'utilisateur

/*
 * @brief vérifier si l'utilisateur est connecté
 * @details effectue une redirection si l'utilisateur n'est pas connecté
 */
function isConnected()
{
    //L'utilisateur est connecté
	if (empty($_SESSION['login']))
	{
        header("location: index.php?action = vue_accueil");
		exit;
	}
}
//Cette fonction s'occupe de vérifier si l'utilisateur est connecté
//POur le profil



/*
 * @brief vérifie si l'utilisateur a un grande équivalent a 1 (administrateur).
 * @return true si le grade de l'utilisateur est 1, false sinon
 */
function testR1()
{
	 if(isset($_SESSION['idRole']) && $_SESSION['idRole'] == 1)
	 {
		return true;
	 }
	 return false;
}

/*
 * @brief Appel de test1(), effectue une redirection si testR1() == False
 */
function testR1Out()
{
    if(!testR1()){
        header("location: index.php?action = vue_accueil");
        exit;
    }
}




?>
