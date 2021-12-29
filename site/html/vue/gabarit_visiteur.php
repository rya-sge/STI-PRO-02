<!--
// gabarit_visiteur.php
// Date de création : 24/12/2020
// Fonction : gabarit pour les visiteurs
// _______________________________
 -->
<!--
Source :
Pour ce gabarit, la mise en page, ainsi que la parti du css est repris du module 151 donné par M.Benzonana Pascal
 -->
<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 		
		<link href="contenu/scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
		<link href="contenu/styles/custom.css" rel="stylesheet" type="text/css">
		<script type="text/javascript"></script>
	</head>
	<body  style="background-color:#E1E6FA"; >
	<!--#7FC6BC #E1E6FA -->
<!--http://www.code-couleur.com/-->
<div style="background-color:#F5F9F8" id="divBoxed" class="container">
<!--#4BB5C1  #EFF0FF/#C4D7ED #F5F9F8
http://www.code-couleur.com/
-->
    <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

    <div class="divPanel notop nobottom">
            <div class="row-fluid">
                <div class="span12">
                    <div id="divLogo" class="pull-left">
					<a href='index.php'id="divSiteTitle" ><button type='button' class='btn btn-primary btn-sm'  >
					<?php 
					if (isset($_SESSION['idUser']))
					{
						echo "Retourner au site";
					}
					else
					{
						echo "Accueil";
					}?>
					</button></a>
                    </div>
					<div class="pull-right">
					<!--I-151 donné par BENZONANA Pascal -->
					<?php if(!isset($_SESSION['login']))
					{
						echo "<a href='index.php?action=vue_login'>
					<button type='button' class='btn btn-primary btn-sm'>Se connecter</button></a>
					<a href='index.php?action=vue_inscription'>
					<button type='button' class='btn btn-primary btn-sm'>Créer un compte</button></a>";		
													
					}
					else
					{
						echo "<a href='index.php?action=vue_logout'><button type='button' class='btn btn-primary  btn-sm'  >Déconnexion</button></a>";
						echo "<a href='index.php?action=vue_profil'><button type='button' class='btn btn-primary btn-sm'  >Profil</button></a>";						
					}
						?>     		
					</div>
					<!--I-151 donné par BENZONANA Pascal-->
                </div>
            </div>
 <!--important pour l'alignement -->
 <!--
            <div class="row-fluid">
           <div class="span12">

                <div id="headerSeparator"></div>
                
                <div id="headerSeparator2"></div>

            </div>
        </div>
		-->
    </div>

    <div class="contentArea" >
	
        <div class="divPanel" ><!--divpanel gère le padding-->
            
           <div class="row-fluid">
            <!--Edit Main Content Area here-->
              <div> <!-- class="span12" id="divMain"-->
				<?php
				if(@$_SESSION['erreur']!="")
				{
					require "vue/erreur/vue_erreur_visiteur.php";
					$_SESSION['erreur']="";					
				}?>
				
                <?=$contenu ?>
				
         	    </div>
            <!--End Main Content-->
            </div>

            <div id="footerInnerSeparator"></div>
			
       </div>
	   
    </div>
    <div id="footerOuterSeparator"></div>
</div>
<br /><br /><br />
<script src="contenu/scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>