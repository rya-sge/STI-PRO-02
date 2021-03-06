<!DOCTYPE html>
<?php

// gabarit.php
//Date de création : 24/12/2020
// Fonction : Page comprenant le design html/css de base du site pour les visiteurs
// _______________________________

?>
<!--
Source :
Pour ce gabarit, la mise en page, ainsi que le css (Hormis le menu vertical) est repris du module 151 donné par M.Benzonana Pascal
 -->
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="contenu/scripts/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="contenu/scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="contenu/styles/custom.css" rel="stylesheet">
    <style>

        /*
        Code non terminé du header*/
        #header {
            top: 0px;
            width: auto;
            background-color: black;
            display: block;
            height: 35px;
            margin-left: 300px;
        }

        /* Source : Ce code css est entièrement repris d'un snippet bootstrap :
         http://bootsnipp.com/snippets/featured/responsive-navigation-menu
        Il n'est pas dans un fichier css à part car il ne serait pas pris en compte (bug).
        Probablement un problème d'écrasement avec le code de bootstrap
        */
        .nav-side-menu {
            overflow: auto;
            font-family: verdana;
            font-size: 12px;
            font-weight: 200;
            background-color: #2e353d;
            position: fixed;
            top: 0px;
            width: 300px;
            height: 100%;
            color: #e1ffff;
        }

        .nav-side-menu .brand {
            background-color: #23282e;
            line-height: 50px;
            display: block;
            text-align: center;
            font-size: 14px;
        }

        .nav-side-menu .toggle-btn {
            display: none;
        }

        .nav-side-menu ul,
        .nav-side-menu li {
            list-style: none;
            padding: 0px;
            margin: 0px;
            line-height: 35px;
            cursor: pointer;
        }

        .nav-side-menu ul :not(collapsed) .arrow:before,
        .nav-side-menu li :not(collapsed) .arrow:before {
            font-family: FontAwesome;
            content: "\f078";
            display: inline-block;
            padding-left: 10px;
            padding-right: 10px;
            vertical-align: middle;
            float: right;
        }

        .nav-side-menu ul .active,
        .nav-side-menu li .active {
            border-left: 3px solid #d19b3d;
            background-color: #4f5b69;
        }

        .nav-side-menu ul .sub-menu li.active,
        .nav-side-menu li .sub-menu li.active {
            color: #d19b3d;
        }

        .nav-side-menu ul .sub-menu li.active a,
        .nav-side-menu li .sub-menu li.active a {
            color: #d19b3d;
        }

        .nav-side-menu ul .sub-menu li,
        .nav-side-menu li .sub-menu li {
            background-color: #181c20;
            border: none;
            line-height: 28px;
            border-bottom: 1px solid #23282e;
            margin-left: 0px;
        }

        .nav-side-menu ul .sub-menu li:hover,
        .nav-side-menu li .sub-menu li:hover {
            background-color: #020203;
        }

        .nav-side-menu ul .sub-menu li:before,
        .nav-side-menu li .sub-menu li:before {
            font-family: FontAwesome;
            content: "\f105";
            display: inline-block;
            padding-left: 10px;
            padding-right: 10px;
            vertical-align: middle;
        }

        .nav-side-menu li {
            padding-left: 0px;
            border-left: 3px solid #2e353d;
            border-bottom: 1px solid #23282e;
        }

        .nav-side-menu li a {
            text-decoration: none;
            color: #e1ffff;
        }

        .nav-side-menu li a i {
            padding-left: 10px;
            width: 20px;
            padding-right: 20px;
        }

        .nav-side-menu li:hover {
            border-left: 3px solid #d19b3d;
            background-color: #4f5b69;
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            -ms-transition: all 1s ease;
            transition: all 1s ease;
        }

        @media (max-width: 767px) {

            .nav-side-menu {
                position: relative;
                width: 100%;
                margin-bottom: 10px;
            }

            .nav-side-menu .toggle-btn {
                display: block;
                cursor: pointer;
                position: absolute;
                right: 10px;
                top: 10px;
                z-index: 10 !important;
                padding: 3px;
                background-color: #ffffff;
                color: #000;
                width: 40px;
                text-align: center;
            }

            .brand {
                text-align: left !important;
                font-size: 22px;
                padding-left: 20px;
                line-height: 50px !important;
            }
        }

        @media (min-width: 767px) {
            .nav-side-menu .menu-list .menu-content {
                display: block;
            }
        }

        body {
            margin: 0px;
            padding: 0px;
        }
    </style>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!--<div id="header"></div>-->

<div style="float:right">
    <!--Source : I-151 donné par BENZONANA Pascal -->
    <?php if (!isset($_SESSION['login'])) {
        echo "<a href='index.php?action=vue_login'>Login</a>";
    } else {
        echo "<a href='index.php?action=vue_logout'><button type='button' class='btn btn-primary btn-sm'  >Déconnexion</button></a>";
        echo "<a href='index.php?action=vue_profil'><button type='button' class='btn btn-primary btn-sm'  >Profil</button></a>";
    }
    ?>

</div>
<div class="nav-side-menu">
    <div >
        <img style="margin-top: 15px; margin-bottom: 25px" class="center-block" src="contenu/icon.jpg" width="150px"/>
    </div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a class="alone" href="index.php?action=vue_accueil" id="accueil">
                    <i class="fa fa-home fa-lg"></i>Accueil
                </a>
            </li>
            <li>
                <a class="alone" href="index.php?action=vue_inbox">
                    <i class="fa fa-upload fa-lg"></i>InBox</a>
            </li>
            <?php
            if (testR1() == true) { ?>
                <li data-toggle="collapse" data-target="#administration" class="collapsed">
                    <a href="index.php?action=vue_role_gestion"><i class="fa fa-dashboard  fa-lg"></i>Administration
                        </a>
                </li>
            <?php } ?>
            <li>
                <a class="alone" href="index.php?action=vue_message_add">
                    <i class="fa fa-globe fa-lg"></i>Ecrire un message</a>
            </li>
        </ul>
    </div>
</div>
<div class="contentArea contenu">

    <div class="divPanel notop page-content">

        <div class="row-fluid">
            <!--Partie réservé au contenu (contient les vues)-->
            <div class="span12" id="divMain">
                <?php
                if (@$_SESSION['erreur'] != "") {
                    require "vue/erreur/vue_erreur_visiteur.php";
                    $_SESSION['erreur'] = "";
                }
                ?>
                <?= $contenu ?>
            </div>
            <!--Fin du contenu des vues-->
        </div>

        <div id="footerInnerSeparator"></div>

    </div>
</div>
</body>
</html>
