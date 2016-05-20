<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/04/2016
 * Time: 10:20
 */
$dm = new DevisManager(connexionDb());
$pm = new ProduitManager(connexionDb());
$am = new AchatManager(connexionDb());
$devis = $dm->getDevisById($_GET['id']);
$um = new UserManager(connexionDb());
$user = $um->getUserById($dm->getDevisUser($devis->getId()));
$tabAchat = $am->getAllAchatsFromDevis($devis);
$_SESSION['CurrentDevis'] = $devis;
switch ($devis->getCloture()) {
    case 0 :
        $clot = "Ouvert";
        break;
    case 1 :
        $clot = "Cloturé";
        break;
    case 2 :
        $clot = "En cours d'achat";
        break;
    case 3 :
        $clot = "En cours de livraison";
        break;
    case 4 :
        $clot = "Facturé";
        break;

}
if ($user->getId() != $_SESSION['Utilisateur']->getId() && $_SESSION['Utilisateur']->getDroit()->getId() == 3) {
    header('Location :../Deconnexion');
}
?>
<div class="crumb_navigation"> Navigation: <span class="current">Home</span></div>
<script>
    $(function () {
        $("#tabs").tabs();
    });
    $.datepicker.setDefaults(
        {
            altField: "#datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            firstDay : 1,
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            weekHeader: 'Sem.',
            dateFormat: 'yy-mm-dd'
        }
    );
    $(function(){
        $('#datepicker').datepicker({showAnim: "fadeIn"});
    })

</script>
<div class="facture">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <link href="../Style/cartTable.css" rel="stylesheet">
    <script src="../js/devis.js"></script>
    <div id="tabs" style="border: none; background-color : #f7f3f3;">
        <ul style="border: none; border-bottom : solid 1px black;  background-color : #f7f3f3; background-image:none;">
            <li><a href="#tabs-1" style="border: none; width:480px;"><?php if ($devis->getCloture() == 0) {
                        if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
                            echo "Modifier le devis";
                        } else {
                            echo "Gérer le devis";
                        }
                    } else {
                        echo "Visualiser le devis";
                    } ?> </a></li>
            <?php if (($devis->getCloture() == 1 or $devis->getCloture() == 4) and file_exists("../Devis/pdf/revision-" . $devis->getId() . ".pdf")) { ?>
                <li><a href="#tabs-2" style="border: none; width:240px;"> Facture initiale</a></li>
                <li><a href="#tabs-3" style="border: none; width:240px;"> Facture révisée</a></li>
            <?php } else { ?>
                <li><a href="#tabs-2" style="border: none; width:480px;">Affichage de la facture actuelle</a></li>
            <?php } ?>
        </ul>
        <div id="tabs-1" style="border: none; width:1000px; background-color : #f7f3f3;">
            <?php if ($devis->getCloture() != 0) { ?>
                <div style="float:right;"><label for="dateLivr"> Date de livraison prévue : </label> <input type="date" id="datepicker"  <?php echo "devis='" . $devis->getId() . "'";
                    if ($_SESSION['Utilisateur']->getDroit()->getId() == 3 or $devis->getCloture() == 1 or $devis->getCloture() == 4) {
                        echo " disabled ";
                    }
                    if ($devis->getDateLivraison() != null) {
                        echo "value='" . date('Y-m-d', strtotime($devis->getDateLivraison())) . "'";
                    } ?>></div>
            <?php } ?>
            <div class="container">

                <table id="cart" class="table table-hover table-condensed"
                       style="<?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3 && $devis->getCloture() == 0) {
                           echo "margin-left:-1em;width:120%";
                       } else {
                           echo "margin-left:-1em;width:100%";
                       } ?>;">

                    <h3 align="center" style="margin-left:-1em;margin-top:2em;"><span class="alert alert-info"> Etat du devis : <?php echo $clot; ?></span>
                    </h3>
                    <caption><h3 align="center">Liste des produits du devis</h3></caption>
                    <thead>
                    <tr>
                        <th style="width:50%">Produit</th>
                        <th style="width:10%">Prix</th>
                        <?php if ($devis->getCloture() == 0) { ?>

                            <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { ?>
                                <th style="width:8%">Quantité</th>
                                <th style="width:15%" class="text-center">Modifications</th>
                            <?php } else { ?>
                                <th style="width:28%" class="text-center">Quantité</th>
                            <?php } ?>
                        <?php } else if ($devis->getCloture() == 3) { ?>
                            <th style="width:8%">Quantité</th>
                            <?php if ($_SESSION['Utilisateur']->getDroit()->getId() != 3) { ?>
                                <th style="width:15%" class="text-center">Rectifications</th>
                            <?php } ?>
                        <?php } else if ($devis->getCloture() == 1 or $devis->getCloture() == 2 or $devis->getCloture() == 4) {
                            echo "<th style='width:23%'  class='text-center'>Quantité</th>";
                        } ?>
                        <th style="width:22%" class="text-center">Sous-total</th>
                        <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId()) { ?>
                            <th style="width:5%"></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $somme = 0;
                    foreach ($tabAchat as $elem) {
                        $prix = round($elem->getProduit()->getPrixHTVA() + ($elem->getProduit()->getPrixHTVA() * $elem->getProduit()->getTVA()->getCoef()), 2);
                        $somme = $somme + ($prix * $elem->getQuantite());
                        ?>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-2 hidden-xs"><img
                                            src="../Style/images/produits/<?php echo $elem->getProduit()->getId(); ?>.png"
                                            alt="..." class="img-responsive"/></div>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin"><?php echo $elem->getProduit()->getProduit(); ?></h4>

                                        <p> <?php echo $elem->getProduit()->getFournisseur()->getLibelle() . " - " . $elem->getProduit()->getMarque()->getLibelle(); ?></p>

                                        <p> Groupage idéal : <?php echo $elem->getProduit()->getGroupement(); ?></p>

                                    </div>
                                </div>
                            </td>
                            <td data-th="Price"
                                id="price_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $prix; ?>€
                            </td>
                            <td data-th="Quantity" class="text-center"
                                id="quantity_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $elem->getQuantite(); ?>
                            </td>

                            <?php if (($devis->getCloture() == 3 && $_SESSION['Utilisateur']->getDroit()->getId() != 3) or ($devis->getCloture() == 0 && $_SESSION['Utilisateur']->getDroit()->getId() == 3)) { ?>
                                <td data-th="Rectification">
                                    <input type="number" min="1"
                                           <?php if ($_SESSION['Utilisateur']->getDroit()->getId() != 3) { ?>max="<?php echo $elem->getQuantite(); ?>"<?php } ?>
                                           class="form-control text-center"
                                           id="<?php echo $elem->getProduit()->getId(); ?>"
                                           name="<?php echo $elem->getProduit()->getId(); ?>"
                                           grade="<?php echo $_SESSION['Utilisateur']->getDroit()->getId(); ?>"
                                           value="<?php echo $elem->getQuantite(); ?>"
                                        >
                                </td>
                            <?php } ?>
                            <td data-th="Subtotal" class="text-center"
                                id="subtotal_<?php echo $elem->getProduit()->getId(); ?>"><?php echo $prix * $elem->getQuantite(); ?>
                                €
                            </td>

                            <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId()) { ?>
                                <td class="actions" data-th="">
                                    <button title="Supprimer le produit" class="btn btn-danger btn-sm"
                                        <?php if (count($tabAchat) != 1) { ?>
                                            onclick="deleteProduit(<?php echo $elem->getProduit()->getId() . "," . $devis->getId(); ?>);">
                                        <?php } else {
                                            echo "id='confirmSuppr' produit='" . $elem->getProduit()->getId() . "' devis='" . $devis->getId() . "'>";
                                        } ?>
                                        <i class="fa fa-trash-o"></i></button>
                                </td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr class="visible-xs">
                        <td class="text-center"><strong>Total </strong></td>
                    </tr>
                    <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId()) { ?>
                        <tr>
                            <td>
                                <label for="prod">Ajouter un produit : </label>

                            </td>
                            <td colspan="<?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { echo "4"; } else { echo "3"; } ?>">
                                <input style="width:480px;margin-top:0.5em;" id="prod">
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" id="addprod" title="Ajouter le produit"
                                        style="margin-top:0.5em;" onclick="addProduit(<?php echo $devis->getId(); ?>);">
                                    <span class="glyphicon glyphicon-plus"></span></button>
                            </td>

                        </tr>
                    <?php } ?>
                    <tr>
                        <td data-th="Note" colspan="<?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { echo "6"; } else { echo "5"; } ?>">
                            <textarea <?php if ($devis->getCloture() != 0 || ($devis->getCloture() == 0 && $_SESSION['Utilisateur']->getDroit()->getId() != 3)) {
                                echo "disabled";
                            } ?> name="note" devis="<?php echo $devis->getId(); ?>" id="note" type="text"
                                 style="width:850px;height:134px;max-width:850px;"
                                 placeholder="Entrez une note pour votre devis "><?php echo $devis->getNote(); ?></textarea>
                    </tr>
                    <tr>
                        <td><a href=<?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
                                echo "../Compte";
                            } else {
                                echo "../Administration/index.php?page=devis";
                            } ?> class="btn btn-warning"><i class="fa fa-angle-left"></i> Retourner dans les devis</a>
                        </td>


                        <?php if ($devis->getCloture() == 0) {
                            if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
                                ?>

                                <td colspan="2" class="hidden-xs"></td>
                            <?php } else { ?>
                                <td></td>
                            <?php } ?>
                            <td class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?>
                                    €</strong></td>
                            <td><a class="btn btn-success btn-block"
                                   href="<?php echo $_GET['id']; ?>" <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
                                    echo "id='confirmClot'> Modifier";
                                } else {
                                    echo "id='confirmAchat' > Confirmer la commande";
                                } ?> <i class="fa fa-angle-right"></i></a></td>

                        <?php } else if ($devis->getCloture() == 1) { ?>

                            <td colspan='2' class="hidden-xs text-center"><strong id="total">Total
                                    : <?php echo $somme; ?> €</strong></td>
                            <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { ?>
                                <td><a class="btn btn-danger btn-block disabled">Devis cloturé</a></td>
                            <?php } else { ?>
                                <td><a class="btn btn-success btn-block"
                                       href="<?php echo $_GET['id']; ?>" id='confirmFinal'> Verrouiller la commande
                                        <i class="fa fa-angle-right"></i></a></td>
                            <?php } ?>
                        <?php } else if ($devis->getCloture() == 4) { ?>
                            <td colspan='2' class="hidden-xs text-center"><strong id="total">Total
                                    : <?php echo $somme; ?> €</strong></td>
                            <td><a class="btn btn-danger btn-block  disabled">Devis cloturé et facturé</a></td>
                        <?php } else if ($devis->getCloture() == 2) { ?>
                            <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { ?>
                                <td colspan="1" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?>
                                        €</strong></td>
                                <td><a class="btn btn-danger btn-block  disabled">En cours d'achat</a></td>
                            <?php } else { ?>
                                <td colspan="1" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?>
                                        €</strong>
                                </td>
                                <td><a class="btn btn-success btn-block" href="<?php echo $_GET['id']; ?>"
                                       id="confirmLivraison">Commencer le livraison <i class="fa fa-angle-right"></i></a></td>
                            <?php }
                        } else if ($devis->getCloture() == 3) { ?>
                            <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) { ?>
                                <td colspan="1" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?>
                                        €</strong></td>
                                <td><a class="btn btn-danger btn-block  disabled">En cours de livraison</a></td>
                            <?php } else { ?>
                                <td colspan="1" class="hidden-xs"></td>
                                <td colspan="2" class="hidden-xs text-center"><strong id="total">Total : <?php echo $somme; ?>
                                        €</strong></td>
                                <td><a class="btn btn-success btn-block" href="<?php echo $_GET['id']; ?>"
                                       id="confirmClot">Clôturer <i class="fa fa-angle-right"></i></a></td>

                            <?php }
                        }
                        ?>


                        <?php if ($devis->getCloture() == 0 && $user->getId() == $_SESSION['Utilisateur']->getId())
                            echo "<td></td>";
                        ?>

                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <?php if (($devis->getCloture() == 1 or $devis->getCloture() == 4) and file_exists("../Devis/pdf/revision-" . $devis->getId() . ".pdf")) { ?>
            <div id="tabs-2" style="border: none; background-color : #f7f3f3;">
                <iframe src='../Devis/pdf/<?php echo $devis->getId(); ?>.pdf#view=FitH&zoom=100' width='100%'
                        style='height:1000px'></iframe>
            </div>
            <div id="tabs-3" style="border: none; background-color : #f7f3f3;">
                <iframe src='../Devis/pdf/revision-<?php echo $devis->getId(); ?>.pdf#view=FitH&zoom=100' width='100%'
                        style='height:1000px'></iframe>
            </div>
        <?php } else { ?>
            <div id="tabs-2" style="border: none; background-color : #f7f3f3;">
                <iframe src='../Devis/pdf/<?php echo $devis->getId(); ?>.pdf#view=FitH&zoom=100' width='100%'
                        style='height:1000px'></iframe>
            </div>
        <?php } ?>
    </div>
</div>
<div id="dialog" title="Confirmation requise">
    <?php if ($_SESSION['Utilisateur']->getDroit()->getId() == 3) {
        echo "Modifier la commande ?";
    } else {
        if ($devis->getCloture() == 3) {
            echo "Clôturer la commande ?";
        } else if ($devis->getCloture() == 0) {
            echo "Voulez-vous verrouiller la commande et débuter l'achat des différents produits présents dedans ?";
        } else if ($devis->getCloture() == 2) {
            echo "Commencer la livraison des produits ?";
        } else if ($devis->getCloture() == 1) {
            echo "Verrouiller le devis suite à sa facturation ? ";
        }
    }
    ?>
</div>
<script>
    $(function () {
        $("#prod").autocomplete({
            source: '../Library/Function/prodList.php',
            max: 10,
        });
    });


</script>
<div id="dialog2" title="Confirmation require">
    La suppression de ce produit étant le dernier de votre devis, supprimera le devis, êtes-vous certain ?
</div>
<script type="text/javascript" src="../js/dialogBox.js"></script>