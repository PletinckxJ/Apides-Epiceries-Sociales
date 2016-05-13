<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12/05/2016
 * Time: 11:44
 */
include("../Library/Function/Require.lib.php");
include("../HTML/Head.php");
include("../HTML/Header.php");
if (isConnect()) {


?>
    <link href="../Style/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">
    <link href="../Style/business.css" rel="stylesheet">
<!-- Image Background Page Header -->
<!-- Note: The background image is set within the business-casual.css file. -->
<header class="business-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="tagline">Centrale d'achats Apides</h1>
            </div>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="container">

    <hr>

    <div class="row">
        <div class="col-sm-8">
            <h2>Ce que vous offre le site :</h2>
            <p>Ce site vous permet de facilement réaliser vos commandes de produits, tout en générant des factures de suivi avant et après achats par Apides.</p>
            <p>Un moyen facile et simple pour le quotidien. N'hésitez pas à utiliser le formulaire de contact pour toute question ou idée.</p>
            <p>
                <a class="btn btn-default btn-lg" href="../Produits">Commencer mes achats &raquo;</a>
            </p>
        </div>
        <div class="col-sm-4">
            <h2>Prendre contact</h2>
            <address>
                <strong>Apides</strong>
                <br> Clos de l’Aciérie 1,
                <br>1490 Court-Saint-Etienne
                <br>
            </address>
            <address>
                <abbr title="Phone">P:</abbr> 010/61.17.84
                <br>
                <abbr title="Email">E:</abbr> <a href="mailto:centrale_achat@apides.be">centrale_achat@apides.be</a>
            </address>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <div class="row" style="padding-bottom: 50px;">
        <div class="col-sm-4">
            <img class="img-circle img-responsive img-center" src="../Style/images/caddie.jpg" alt="Acheter vos produits">
            <h2>Achetez facilement</h2>
            <p>Grâce au magasin, choississez et commandez vos produits facilement puis lancer votre devis afin que nos bénévoles se chargent de vous.</p>
        </div>
        <div class="col-sm-4">
            <img class="img-circle img-responsive img-center" src="../Style/images/facture.jpg" alt="Réaliser vos factures">
            <h2>Devis simples</h2>
            <p>Vos devis sont autogénérés au format pdf, imprimable à tout moment et permettant de garder un suivi de votre commande au fil du temps.</p>
        </div>
        <div class="col-sm-4">
            <img class="img-circle img-responsive img-center" src="../Style/images/livraison.jpg" alt="">
            <h2>Faites vous livrer</h2>
            <p>Une fois vos produits achetés, nous clôturerons votre commande et vous livrerons dans les plus brefs délais.</p>
        </div>
    </div>
<?php
} else {
    header("Location :../Deconnexion");
}

include "../HTML/Footer.php";
?>