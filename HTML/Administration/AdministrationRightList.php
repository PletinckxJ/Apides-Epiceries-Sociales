<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:41
 */

if (!isset($_GET['page']) || $_GET['page'] == "users") {
    ?>

    <li class="odd"><a href="index.php?page=users&option=createAccount">Cr�er un compte</a></li>
    <li class="even"><a href="index.php?page=users">G�rer les utilisateurs</a></li>

    <?php
} else if ($_GET['page'] == 'benef') {
    ?>
    <li class="odd"><a href="index.php?page=benef&option=create">Cr�er un b�n�ficiaire</a></li>
    <li class="even"><a href="index.php?page=benef">G�rer les b�n�ficiaires</a></li>
    <li class="odd"><a href="index.php?page=benef&option=budget">G�rer les budgets</a></li>
<?php
}
?>