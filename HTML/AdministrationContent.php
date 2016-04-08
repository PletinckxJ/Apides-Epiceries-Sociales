<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 08-04-16
 * Time: 11:40
 */

$title = getTitle();
?>

<?php include("../HTML/NavigationAdministration.php"); ?>
<div class="center_content">
    <?php
     echo "<div class='center_title_bar'>".$title."</div>";
    ?>
    <div class="prod_box_big">
        <div class="top_prod_box_big"></div>
        <div class="center_prod_box_big">
            <?php
                include("../Form/createAccount.form.php");
                if (isset($tabRetour['Error'])) {
                     foreach($tabRetour['Error'] as $message) {
                        echo $message;
                    }
                 }
            ?>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>
<div class="right_content">
    <div class="title_box">Options</div>
    <ul class="left_menu">
        <?php include("../HTML/AdministrationRightList.php"); ?>
    </ul>
</div>