<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 20-04-16
 * Time: 14:59
 */
$sm = new SectionManager(connexionDb());
$listSection = $sm->getAllSection();
$i = 1;
?>

<div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
<div class="left_content">
    <div class="title_box">Catégories</div>
    <ul class="left_menu">
        <li class="odd2"><a href="index.php"> Liste complète</a></li>
        <?php

        foreach($listSection as $elem) {
            if ($i%2 == 0) {
                echo "<li class='odd2'><a href='index.php?section=".$elem->getId()."'>".$elem->getLibelle()."</a></li>";
            } else {
                echo "<li class='even2'><a href='index.php?section=".$elem->getId()."'>".$elem->getLibelle()."</a></li>";
            }
            $i++;
        }

        ?>
    </ul>
    <br>
    <br>
</div>