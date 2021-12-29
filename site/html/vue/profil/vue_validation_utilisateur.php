<?php
$titre ='HashMail - confirmation du compte';

// vue_validation_utilisateur.php
// Date de création : 07/10/2021
// Fonction : vue qui indique à l'utilisateur qu'il doit encore valider son compte via un lien
// _______________________________

// Tampon de flux stocké en mémoire
ob_start();
?>
<?$_SESSION['error']="";?>
    <article>
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 ">
                <div class="cadre"   >
                    <p>
                        Votre compte a été créee. Vous  pouvez dès à présent vous connecter au site.
                    </p>
                </div>
                <br />
                <br />
                <div class="btn-group row" >
                    <div class="col-lg-offset-9 col-lg-6 col-md-offset-9 col-md-6 ">
                        <a href='index.php?action=vue_accueil'><button type='button' class='btn btn-primary btn-lg'
                            >Retourner à la page d'accueil</button></a><br /><br />
                    </div>
                </div>
            </div>
    </article>
<?php
$contenu = ob_get_clean();
require "vue/gabarit_visiteur.php";
?>
