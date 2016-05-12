<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14-04-16
 * Time: 10:38
 */
if (isset($_POST['action'])) {
    require_once("../Library/Function/Database.lib.php");
    require_once("../Library/Function/Session.lib.php");
    require_once("../Library/Function/Config.lib.php");
    require_once("../Manager/ProduitManager.manager.php");
    require_once("../Manager/FournisseurManager.manager.php");
    require_once("../Manager/MarqueManager.manager.php");
    require_once("../Manager/SectionManager.manager.php");
    require_once("../Manager/TVAManager.manager.php");
    require_once("../Entity/Produit.class.php");
    require_once("../Entity/Marque.class.php");
    require_once("../Entity/Section.class.php");
    require_once("../Entity/TVA.class.php");
    require_once("../Entity/Fournisseur.class.php");
    header('Content-Type: text/html; charset=windows-1252');

}
$fm = new FournisseurManager(connexionDb());
$tabFourni = $fm->getAllFournisseur();
$mm = new MarqueManager(connexionDb());
$tabMarque = $mm->getAllMarque();
$tm = new TVAManager(connexionDb());
$tabTVA = $tm->getAllTVA();
$sm = new SectionManager(connexionDb());
$tabSection = $sm->getAllSection();
?>
<div class="pageCrea">
<script>
    function test() {
        console.log($("input#scanner").val())
    }
    $(document).click(function(event) {
        var x = window.scrollX, y = window.scrollY;
        if (event.target.nodeName != "INPUT" && event.target.nodeName != "LABEL" && event.target.nodeName != "STRONG" && event.target.nodeName != "SELECT" && event.target.nodeName != "BUTTON" && event.target.id != "radio") {
            console.log(event.target.nodeName);
            $("input#scanner").focus();
        }
        window.scrollTo(x, y);
    });
    function getprod() {
        var val = $("input#code").val();
        var cache;
        if (val != "" && val != null) {
            $.ajax({
                url: "../Library/Function/getProduit.php",
                type :  "POST",
                data: {
                    valeur: val
                },
                success: function (data) {
                    if (data != "" && data != null) {
                        $.ajax({
                            url: "../Form/modifyProduit.form.php",
                            type: "POST",
                            data: {
                                id: data
                            },
                            success: function (output) {
                                test = output;
                                $("div#formcontent").html(output);
                                $("div.center_title_bar").html("Modification d'un produit existant");
                            }
                        });
                    }
                }
            });

        } else {
            $.ajax({
                url: "../Form/createProduit.form.php",
                type: "POST",
                data: {
                    action: "cherche"
                },
                success: function (output) {
                    $("div.pageCrea").html(output);
                    $("div.center_title_bar").html("Création d'un produit");
                }
            });
        }
    }

</script>

<input type="text" id="scanner" name="scanner"style="width:500px;position:absolute;margin-top:-10000px" autofocus oninput="setTimeout(test,1000);">
<div id="formcontent">
<form enctype='multipart/form-data' action="index.php?page=produit&option=create" id="form" method="post" class="formCreation">
    <label class="contact" for="code"><strong>Code produit* :</strong></label>
    <input type="text" class="contact_input" id="code" name="code" onchange="getprod();" required>
    <label class="contact" for="name"><strong>Nom* :</strong></label>
    <input type="text" class="contact_input" id="name" name="name" required>
    <label class="contact" for="image" ><strong>Image: </strong></label>
    <input name="image" size="30" type="file" onchange="readURL(this);" accept="image/x-png, image/gif, image/jpeg" />
    <img id="show" style="display:none;padding-left : 10em;" src="#" alt="your image" /> <br>
    <label class="contact" for="fournisseur"><strong>Fournisseur* :</strong></label>
    <?php /**
    <select name='fournisseur' id='fournisseur' class="contact_input">
        <?php

        foreach($tabFourni as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getLibelle() ."</option>";
        }
        ?>
    </select>
 * */
     ?>
    <input type="text" class="contact_input" name="fournisseur" id="fournisseur" required>
    <label class="contact" for="section"><strong>Section* :</strong></label>

    <select name='section' id='section' class="contact_input">
        <?php

        foreach($tabSection as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getLibelle() ."</option>";
        }
        ?>
    </select>
    <label class="contact" for="marque"><strong>Marque* :</strong></label>
    <input type="text" class="contact_input" name="marque" id="marque" required>

    <label class="contact" for="tva"><strong>TVA* :</strong></label>

    <select name='tva' id='tva' class="contact_input">
        <?php

        foreach($tabTVA as $elem) {
            echo "<option value='". $elem->getId() ."'>". $elem->getTexteTVA() ."</option>";
        }
        ?>
    </select>

    <label class="contact" for="ean"><strong>EAN :</strong></label>
    <input type="text" class="contact_input" id="ean" name="ean">
    <label class="contact" for="dlv"><strong>DLV :</strong></label>
    <input type="text" class="contact_input" id="dlv" name="dlv" >
    <label class="contact" for="prix"><strong>Prix HTVA (€)*:</strong></label>
    <input type="number" step="any" class="contact_input" id="prix" name="prix"  required>
    <label class="contact" for="poids"><strong>Quantité  :</strong></label>
    <input type="text" step="any" class="contact_input" id="poids" name="poids" >
    <label class="contact" for="groupement"><strong>Groupement* :</strong></label>
    <input type="number" class="contact_input" id="groupement" name="groupement" required>
    <div id="radio" style="display:inline-block;margin-left:-18em;">
        <label class="contact" for="promo"><strong>En promotion* :</strong></label>
        <input class=contact_input" type="radio" name="promo" value="0" checked> Non
        <input class=contact_input" type="radio" name="promo" value="1"> Oui
    </div><br>
    <label class="contact" for="textepromo"><strong>Texte promo :</strong></label>
    <input type="text" class="contact_input" id="textepromo" name="textepromo" >
    <br>
    <div id="radio" style="display:inline-block;margin-left:-18em;" >
        <label class="contact" for="actif"><strong>Actif* :</strong></label>
        <input type="radio" name="actif" value="0" > Non
        <input type="radio" name="actif" value="1" checked> Oui
    </div>
    <div class="form_row" >
        <button type="submit"  name="createProduit" id="btnCompte">Créer le produit</button>
    </div>
</form>
</div>
<script>
    $(function() {
        $("#fournisseur").autocomplete({
            source: '../Library/Function/fournisseurList.php',
            max: 10
        });
        $("#marque").autocomplete({
            source: '../Library/Function/marqueList.php',
            max: 10
        });
    })


</script>
</div>