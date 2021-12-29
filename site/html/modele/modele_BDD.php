<?php
// ------------------------------------
// getBD()
// Date de création : 13.10.2021
// Fonction : connexion avec le serveur : instancie et renvoie l'objet PDO
// Sortie : $db

function getBD()
{
    // connexion au serveur MySQL et à la BD
    $db = new PDO("sqlite:".__DIR__."/../../databases/database.sqlite");

    // permet d'avoir plus de détails sur les erreurs retournées
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return  $db;
}
