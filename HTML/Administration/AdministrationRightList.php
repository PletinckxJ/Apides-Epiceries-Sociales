<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:41
 */

if (!isset($_GET['page']) || $_GET['page'] == "users" || $_GET['page'] == "modifyUser" || $_GET['page'] == "showUser") {
    ?>

    <li class="odd"><a href="index.php?page=users&option=createAccount">Créer un compte</a></li>
    <li class="even"><a href="index.php?page=users">Gérer les utilisateurs</a></li>

    <?php
} else if ($_GET['page'] == 'benef' || $_GET['page'] == "modifyBenef" || $_GET['page'] == "modifyBudget" || $_GET['page'] == "createBudget") {
    ?>
    <li class="odd"><a href="index.php?page=benef&option=create">Créer un bénéficiaire</a></li>
    <li class="even"><a href="index.php?page=benef">Gérer les bénéficiaires</a></li>
    <li class="odd"><a href="index.php?page=benef&option=budget">Gérer les budgets</a></li>
<?php
}
?>