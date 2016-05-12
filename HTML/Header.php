<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:33
 */

if (!isConnect()) {
    header("Location :../Deconnexion");
}
?>

<div id="main_container">
    <div id="header">
        <div id="logo"><a href="#"><img src="../Style/images/logo_apides_site1.png" alt="" border="0" width="350"
                                        height="140"/></a></div>
        <!-- end of oferte_content-->
    </div>
    <div id="main_content">
        <div id="menu_tab">
            <div class="left_menu_corner"></div>
                <div id="menu">
                <ul class="menu" style="<?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) echo "margin-left:155px"; ?>">
                    <li><a href="../Accueil" class="nav1"> Accueil</a></li>
                    <li class="divider"></li>
                    <li><a href="../Produits" class="nav5">Produits</a></li>
                    <li class="divider"></li>
                    <?php if ($_SESSION['Utilisateur']->getDroit()->getId() != 3) { ?>
                        <li><a href="../Administration" class="nav2">Administration</a></li>
                        <li class="divider"></li>
                    <?php } ?>
                    <li><a href="../Compte" class="nav4">Mon compte</a></li>
                    <li class="divider"></li>
                    <li><a href="../Contact" class="nav6">Contacter l'admin</a></li>
                    <li class="divider"></li>
                    <li><a href="../Deconnexion" class="nav3">Déconnexion</a></li>
                </ul>
                </div>
                <div class="right_menu_corner"></div>
                </div>