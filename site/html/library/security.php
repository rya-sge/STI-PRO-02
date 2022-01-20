<?php

if(!function_exists('hash_equals'))
{
    function hash_equals($str1, $str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}
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

/*
 * Source :
 * https://github.com/rya-sge/PRO-Angular-Php/blob/master/dev/Backend/zone_protected/security.php
 */
function checkInt($val){
    if(! ctype_digit($val) && !is_int($val))
    {
        throw new Exception("L'identifiant n'est pas valide");
    }

    return intval($val);
}

?>
