<!--
// vue_select_role.php
// Date de création : 07/10/2021
// Fonction : vue contenant les balises select pour changer le role d'un utilisateur
// __________________________________________
-->
<select  name="role">
    <option type ="hidden" value="NO_VALUE" selected></option>
    <?php
    foreach (range(1, 2) as $number) {
        ?>  <option value="<?php echo $number?>"><?php echo $number == 1 ?
                "Administrateur" : "Collaborateur";?></option>
    <?php } ?>
</select>
