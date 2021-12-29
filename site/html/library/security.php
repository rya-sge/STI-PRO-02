<?php
/**
 * verify the CSRF token
 * @throws Exception
 * SOurce : https://gist.github.com/subhendugiri/69db7e8e276bfd348385b24aa4f2d7a5
 */
function verifCSRF(){
    $isValid = false;
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            $isValid = true;
        }
    }
    if(!$isValid){
        throw new Exception("Le formulaire ne peut pas être validé");
    }
}

?>