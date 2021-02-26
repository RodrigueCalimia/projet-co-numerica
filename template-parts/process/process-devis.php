<!-- Page du processus de création d'un devis -->
<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_sites contenant les lieux de formations
    $lesLieuxFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));
    // récupération des données de la table wp_listeformation contenant les formations
    $formations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_listeformation'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
    // récupération des champs du formulaire
    if ($_POST) {
        $numFormation   =$_POST['num_formation'];
        $nomFormation   =$_POST['nom_formation'];
        $societe        =$_POST['societe'];
        $datesFormation =$_POST['dates_formation'];
        $nbStagiaires   =$_POST['nb_stagiaires'];
        // ajout des données dans la table
        $wpdb->insert('wp_devis', 
            array(
                'NUM_FORM'      =>$numFormation,
                'NOM_FORM'      =>$nomFormation,
                'SOCIETE'       =>$societe,
                'DATES_FORM'    =>$datesFormation,
                'NB_STAGIAIRES' =>$nbStagiaires
            )
        );
    
        // récupération des valeurs des champs du formulaire de la modal pour création du nouveau site
        $nomSite        =$_POST['nom_site'];
        $adresseSite    =$_POST['adresse_site'];
        $cpSite         =$_POST['code_postal_site'];
        $villeSite      =$_POST['ville_site'];
        // ajout des données dans la table
        $wpdb->insert('wp_sites', 
            array(
                'NOM_SITE'          =>$nomSite,
                'ADRESSE_SITE'      =>$adresseSite,
                'CODE_POSTAL_SITE'  =>$cpSite,
                'VILLE_SITE'        =>$villeSite,
            )
        );
        echo "<script>alert('Le devis ".$numFormation." a bien été éditer !');</script>";
        echo "<>window.location = '" .site_url("/les-devis")."'</>";
    }
?>

<div class="main">
    <h1>Création d'un devis</h1>
    <!-- nav tabs -->
    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-client-tab" data-bs-toggle="tab" data-bs-target="#nav-client" type="button" role="tab" aria-controls="nav-client" aria-selected="true">Client</button>
            <button class="nav-link" id="nav-pedagogie-tab" data-bs-toggle="tab" data-bs-target="#nav-pedagogie" type="button" role="tab" aria-controls="nav-pedagogie" aria-selected="false">Pédagogie</button>
            <button class="nav-link" id="nav-session-tab" data-bs-toggle="tab" data-bs-target="#nav-session" type="button" role="tab" aria-controls="nav-session" aria-selected="false">Session</button>
            <button class="nav-link" id="nav-chiffrage-tab" data-bs-toggle="tab" data-bs-target="#nav-chiffrage" type="button" role="tab" aria-controls="nav-chiffrage" aria-selected="false">Chiffrage</button>
        </div>
    </nav>

    <form class="row" method="POST">
        <div class="tab-content" id="nav-tabContent">
            <!-- Contenu de l'onglet Client -->
            <div class="tab-pane fade show active" id="nav-client" role="tabpanel" aria-labelledby="nav-client-tab">
                Fomulaire client
            </div>
            <!-- Contenu de l'onglet Pédagogie -->
            <div class="tab-pane fade" id="nav-pedagogie" role="tabpanel" aria-labelledby="nav-pedagogie-tab">
                <div class="col-md-6">
                    <!-- Zone du choix du lieu de formation -->
                    <label for="listeFormation" class="form-label">Libellé de la formation</label>
                    <!-- récupération des lieux de formation -->
                    <select class="form-select" aria-label="Default select example" onchange="change_valeur();" id="listeFormation">
                        <option selected></option>
                        <?php 
                            $selectForm = "";
                            $tabObjForm1 = "var tabObjForm2 = Array()\n";
                            $tabObjProForm1 = "var tabObjProForm2 = Array()\n";
                            $tabParcourPedaPrevi1 = "var tabParcourPedaPrevi2 = Array()\n";
                            
                            foreach ($formations as $formation): 
                                $selectForm = $selectForm . "<option value=".$formation->ID_FORMATION.">".$formation->NOM_FORMATION."</option>";
                                $tabObjForm1 = $tabObjForm1."tabObjForm2[".$formation->ID_FORMATION."]='".$formation->OBJ_FORMATION."'\n";
                                $tabObjProForm1 = $tabObjProForm1."tabObjProForm2[".$formation->ID_FORMATION."]='".$formation->OBJ_PRO_FORMATION."'\n";
                                $tabParcourPedaPrevi1 = $tabParcourPedaPrevi1."tabParcourPedaPrevi2[".$formation->ID_FORMATION."]='".$formation->PARCOUR_PEDA_PREVI."'\n";
                                $tabObjForm2[$formation->ID_FORMATION]=$formation->OBJ_FORMATION;
                                $tabObjProForm2[$formation->ID_FORMATION]=$formation->OBJ_PRO_FORMATION;
                                $tabParcourPedaPrevi2[$formation->ID_FORMATION]=$formation->PARCOUR_PEDA_PREVI;
                            endforeach;
                            print $selectForm
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="obj_formation" class="form-label">Objectifs de la formation</label>
                    <input type="text" name="obj_formation" class="form-control" id="obj_formation" readonly="true" >
                </div>
                <div class="col-md-6">
                    <label for="validationServer03" class="form-label">Objectifs professionnels de la formation</label>
                    <input type="text" name="obj_pro_formation" class="form-control" id="obj_pro_formation" value="" readonly="true" >
                </div>
                <div class="col-md-6">
                    <label for="validationServer04" class="form-label">Parcours pédagogique prévisionnel</label>
                    <input type="text" name="parc_peda_previ" class="form-control" id="parc_peda_previ" value="" readonly="true" >
                </div>
            </div>
            <!-- Contenu de l'onglet Session -->
            <div class="tab-pane fade" id="nav-session" role="tabpanel" aria-labelledby="nav-session-tab">            
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h6>Lieu de la formation</h6>
                            <div id="id-boite-check">
                            <?php foreach ($lesLieuxFormation as $leLieuFormation):?> 
                                <div class="form-check" id="liste-site-numerica">
                                    <label class="form-check-label" for="flexCheckDefault">  
                                        <?php echo  $leLieuFormation->NOM_SITE ;?>
                                    </label>
                                    <input class="form-check-input" type="checkbox" value="<?php echo  $leLieuFormation->ID_SITE ;?>">
                                </div>
                            <?php endforeach;?>
                            </div>
                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addSite">Ajouter un site</button>
                        </div>
                        <div class="col">
                            <h6>Horaires de la formation</h6>
                            <label class="form-time-label" for="flexTimeDefault">Matin du</label>
                            <input class="form-time-input" type="time" value="09:00" id="flexTimeDefault01">
                            <label class="form-time-label" for="flexTimeDefault">à</label>
                            <input class="form-time-input" type="time" value="12:30" id="flexTimeDefault02">
                            <label class="form-time-label" for="flexTimeDefault">Après-midi du</label>
                            <input class="form-time-input" type="time" value="13:30" id="flexTimeDefault03">
                            <label class="form-time-label" for="flexTimeDefault">à</label>
                            <input class="form-time-input" type="time" value="17:00" id="flexTimeDefault04">
                        </div>
                        <div class="col">
                            <h6>Prérequis</h6>
                            <textarea class="form-control" value="" id="prerequis" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h6>Durée de la formation</h6>
                            <input type="number" name="durre_formation" class="form-control" id="durre_formation" required onchange="DureeFormation();" value=0>
                            jours soit xxx heures
                        </div>
                        <div class="col">
                            <h6>Dates de la formation</h6>
                            <div class="liste">
                                <div class="model">
                                    <div class="dates_formation">
                                        <label for="validationServer02" class="form-label">Jour 1</label>    
                                        <input type="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="flexCheckDefault">Dates non définies</label>
                                <input class="form-check-input" type="checkbox" value="" >
                            </div>
                        </div>
                        <div class="col">
                            <h6>Nombre de participants</h6>
                            <input type="number" name="nb_participants" class="form-control" id="nb_participants" required>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contenu de l'onglet Chiffrage -->
            <div class="tab-pane fade" id="nav-chiffrage" role="tabpanel" aria-labelledby="nav-chiffrage-tab">
                <!-- Zone des prix de ventes -->
                <div class="container">
                    <!-- 
                        Titres de la 1ère ligne des ventes 
                    -->
                    <div class="row justify-content-md-center">
                        <!-- dénomination des titres -->
                        <div class="col"></div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Montant</span>
                        </div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Quantité</span>
                        </div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Total</span>
                        </div>
                    </div>
                    <!-- 
                        Contenu des lignes des ventes 
                    -->
                    <!-- Prix de vente journalier de la formation -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="prix-vente-jour-form" class="form-label">Prix de vente journalier de la formation</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-prix-vente-jour-form" class="form-control" id="montant-prix-vente-jour-form" value=0 min="0" step="0.01" onchange="TotalPrixVenteJourForm();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-jour-form" class="form-control" id="qte-prix-vente-jour-form" value=0 min="0" step="0.5" onchange="TotalPrixVenteJourForm();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-jour-form" class="form-control" id="total-prix-vente-jour-form" value=0 readonly="true" >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Prix de vente des supports de cours -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="prix-vente-support-cours" class="form-label">Prix de vente des supports de cours</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-prix-vente-supports-cours" class="form-control" id="montant-prix-vente-supports-cours" value=0 onchange="TotalPrixVenteSupportsCours();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-supports-cours" class="form-control" id="qte-prix-vente-supports-cours" value=0 onchange="TotalPrixVenteSupportsCours();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-supports-cours" class="form-control" id="total-prix-vente-supports-cours" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Prix de vente des plateaux repas -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="prix-vente-repas" class="form-label">Prix de vente des plateaux repas</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-prix-vente-repas" class="form-control" id="montant-prix-vente-repas" value=0 onchange="TotalPrixVenteRepas();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-repas" class="form-control" id="qte-prix-vente-repas" value=0 onchange="TotalPrixVenteRepas();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-repas" class="form-control" id="total-prix-vente-repas" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Prix de vente des certifications -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="prix-vente-certifs" class="form-label">Prix de vente des certifications</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-prix-vente-certifs" class="form-control" id="montant-prix-vente-certifs" value=0 onchange="TotalPrixVenteCertifs();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-certifs" class="form-control" id="qte-prix-vente-certifs" value=0 onchange="TotalPrixVenteCertifs();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-certifs" class="form-control" id="total-prix-vente-certifs" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Prix de vente autres -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Autres</span>
                                <input type="text" name="texte-prix-vente-autres" class="form-control" id="texte-prix-vente-autres" >
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-prix-vente-autres" class="form-control" id="montant-prix-vente-autres" value=0 onchange="TotalPrixVenteAutres();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-autres" class="form-control" id="qte-prix-vente-autres" value=0 onchange="TotalPrixVenteAutres();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-autres" class="form-control" id="total-prix-vente-autres" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Total des vente -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="total-ventes" class="form-label">Total des ventes</label>
                        </div>
                        <div class="col-lg-2">
                            <!--<div class="input-group mb-3">
                                <input type="number" name="montant-total-ventes" class="form-control" id="montant-total-ventes" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>-->
                        </div>
                        <div class="col-lg-2">
                            <!--<input type="number" name="qte-total-ventes" class="form-control" id="qte-total-ventes" readonly="true" value=0 >-->
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-total-ventes" class="form-control" id="total-total-ventes" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>

                    <!-- 
                        Titres de la 1ère ligne des coûts 
                    -->
                    <div class="row justify-content-md-center">
                        <!-- dénomination des titres -->
                        <div class="col"></div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Montant</span>
                        </div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Quantité</span>
                        </div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Total</span>
                        </div>
                    </div>
                    <!-- 
                        Contenu des lignes des coûts 
                    -->
                    <!-- Coût d'achat journalier de la prestation du formateur -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-achat-jour-presta" class="form-label">Coût d'achat journalier de la prestation du formateur</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-cout-achat-jour-presta" class="form-control" id="montant-cout-achat-jour-presta" value=0 min="0" step="0.01" onchange="TotalCoutAchatJourPresta();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-jour-presta" class="form-control" id="qte-cout-achat-jour-presta" value=0 readonly="true" onchange="TotalCoutAchatJourPresta();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-jour-presta" class="form-control" id="total-cout-achat-jour-presta" value=0 readonly="true" >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Coût d'achat des supports de cours -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-achat-support-cours" class="form-label">Coût d'achat des supports de cours</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-cout-achat-supports-cours" class="form-control" id="montant-cout-achat-supports-cours" value=0 onchange="TotalCoutAchatSupportsCours();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-supports-cours" class="form-control" id="qte-cout-achat-supports-cours" value=0 onchange="TotalCoutAchatSupportsCours();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-supports-cours" class="form-control" id="total-cout-achat-supports-cours" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Coût d'achat des plateaux repas -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-achatrepas" class="form-label">Coût d'achat des plateaux repas</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-cout-achat-repas" class="form-control" id="montant-cout-achat-repas" value=0 onchange="TotalCoutAchatRepas();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-repas" class="form-control" id="qte-cout-achat-repas" value=0 onchange="TotalCoutAchatRepas();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-repas" class="form-control" id="total-cout-achat-repas" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Coût d'achat des certifications -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-achat-certifs" class="form-label">Coût d'achat des certifications</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-cout-achat-certifs" class="form-control" id="montant-cout-achat-certifs" value=0 onchange="TotalCoutAchatCertifs();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-certifs" class="form-control" id="qte-cout-achat-certifs" value=0 onchange="TotalCoutAchatCertifs();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-certifs" class="form-control" id="total-cout-achat-certifs" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Coût d'achat journalier de la location de salle -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-achat-location" class="form-label">Coût d'achat journalier de la location de salle</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-cout-achat-location" class="form-control" id="montant-cout-achat-location" value=0 onchange="TotalCoutAchatLocation();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-location" class="form-control" id="qte-cout-achat-location" value=0 onchange="TotalCoutAchatLocation();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-location" class="form-control" id="total-cout-achat-location" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Coût apport d'affaires -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-achat-affaire" class="form-label">Coût apport d'affaires</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-cout-achat-affaire" class="form-control" id="montant-cout-achat-affaire" value=0 onchange="TotalCoutAchatAffaire();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-affaire" class="form-control" id="qte-cout-achat-affaire" value=0 onchange="TotalCoutAchatAffaire();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-affaire" class="form-control" id="total-cout-achat-affaire" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Coût d'achat autres -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Autres</span>
                                <input type="text" name="texte-cout-achat-autres" class="form-control" id="texte-cout-achat-autres" >
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="montant-cout-achat-autres" class="form-control" id="montant-cout-achat-autres" value=0 onchange="TotalCoutAchatAutres();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-autres" class="form-control" id="qte-cout-achat-autres" value=0 onchange="TotalCoutAchatAutres();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-autres" class="form-control" id="total-cout-achat-autres" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Total des coûts d'achat -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="total-couts" class="form-label">Total des coûts de fonctionnement</label>
                        </div>
                        <div class="col-lg-2">
                            <!--<div class="input-group mb-3">
                                <input type="number" name="montant-total-ventes" class="form-control" id="montant-total-ventes" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>-->
                        </div>
                        <div class="col-lg-2">
                            <!--<input type="number" name="qte-total-ventes" class="form-control" id="qte-total-ventes" readonly="true" value=0 >-->
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-total-couts" class="form-control" id="total-total-couts" readonly="true" value=0 >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Bouton d'édition du devis -->          
                    <div class="col btn-justify-content-end">
                        <input class="btn btn-primary" type="submit" value="Éditer le devis" name="edit-devis"></input>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal pour l'ajout d'un site dans la liste des lieux de la formation -->
        <div class="modal fade" id="addSite" tabindex="-1" aria-labelledby="addSiteLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <?php //get_template_part( 'template-parts/forms/create', 'site');?>
                        <div class="col-md-6">
                            <label for="nom_site" class="form-label">Libellé du site</label>
                            <input type="text" name="nom_site" class="form-control" id="nom_site" required>
                        </div>
                        <div class="col-md-6">
                            <label for="adresse_site" class="form-label">Adresse</label>
                            <input type="text" name="adresse_site" class="form-control" id="adresse_site" required>
                        </div>
                        <div class="col-md-6">
                            <label for="code_postal_site" class="form-label">Code postal</label>
                            <input type="number" name="code_postal_site" class="form-control" id="code_postal_site" min="0"  required>
                        </div>
                        <div class="col-md-6">
                            <label for="ville_site" class="form-label">Ville</label>
                            <input type="text" name="ville_site" class="form-control" id="ville_site" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="BtnAddSite();" name="create-site">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    /*******************************************************\
        Gestion de l'ajout d'un site de formation 
        dans la phase Session
    \*******************************************************/
    function BtnAddSite(){
        var listeSiteNumerica = document.querySelector("#id-boite-check").innerHTML;
        var nomSite = document.getElementById("nom_site").value;
        listeSiteNumerica = listeSiteNumerica + '<div class="form-check" id="liste-site-numerica">';
        listeSiteNumerica = listeSiteNumerica + '<label class="form-check-label" for="flexCheckDefault">';
        listeSiteNumerica = listeSiteNumerica + nomSite;
        listeSiteNumerica = listeSiteNumerica + '</label>';
        listeSiteNumerica = listeSiteNumerica + '<input class="form-check-input" type="checkbox" value="newSite">';
        listeSiteNumerica = listeSiteNumerica + '</div>';
        document.querySelector("#id-boite-check").innerHTML = listeSiteNumerica;
    }

    /*******************************************************\
        Gestion de la recopie des données de la formation
        en fonction de la formation sélectionnée
    \*******************************************************/
    // déclaration des tableau de contenant les données de la formation
    <?php print($tabObjForm1);?>
    <?php print($tabObjProForm1);?>
    <?php print($tabParcourPedaPrevi1);?>
    // fonction de recopie des données de la formation sélectionnée dans les champs
    function change_valeur(){
        monSelect = document.getElementById("listeFormation");
        valueSelect = monSelect.value;
        document.getElementById("obj_formation").value = tabObjForm2[valueSelect];
        document.getElementById("obj_pro_formation").value = tabObjProForm2[valueSelect];
        document.getElementById("parc_peda_previ").value = tabParcourPedaPrevi2[valueSelect];
    }

    /*******************************************************\
        Gestion des calculs de la phase Chiffrage
    \*******************************************************/
    // calcul du prix de vente journalier de la formation
    function TotalPrixVenteJourForm(){
        // récupération de la valeur du champ montant du Prix de vente journalier de la formation
        selectMontantVenteJour = document.getElementById("montant-prix-vente-jour-form");
        valeurMontantVenteJour = parseFloat(selectMontantVenteJour.value);
        // récupération de la valeur du champ quantité du Prix de vente journalier de la formation
        selectQteVenteJour = document.getElementById("qte-prix-vente-jour-form");
        valeurQteVenteJour = parseFloat(selectQteVenteJour.value);
        //calcul du total du Prix de vente journalier de la formation
        totalJourForm = valeurMontantVenteJour * valeurQteVenteJour;
        document.getElementById('total-prix-vente-jour-form').value = totalJourForm.toFixed(2);
    }
    // calcul du prix de vente des supports de cours
    function TotalPrixVenteSupportsCours(){
        // récupération de la valeur du champ montant du Prix de vente des supports de cours
        selectMontantVenteSupportsCours = document.getElementById("montant-prix-vente-supports-cours");
        valeurMontantVenteSupportsCours = parseFloat(selectMontantVenteSupportsCours.value);
        // récupération de la valeur du champ quantité du Prix de vente des supports de cours
        selectQteVenteSupportsCours = document.getElementById("qte-prix-vente-supports-cours");
        valeurQteVenteSupportsCours = parseFloat(selectQteVenteSupportsCours.value);
        //calcul du total du Prix de vente des supports de cours
        totalSupportsCours = valeurMontantVenteSupportsCours * valeurQteVenteSupportsCours;
        document.getElementById('total-prix-vente-supports-cours').value = totalSupportsCours.toFixed(2);
    }
    // calcul du prix de vente des plateaux repas
    function TotalPrixVenteRepas(){
        // récupération de la valeur du champ montant du Prix de vente des plateaux repas
        selectMontantVenteRepas = document.getElementById("montant-prix-vente-repas");
        valeurMontantVenteRepas = parseFloat(selectMontantVenteRepas.value);
        // récupération de la valeur du champ quantité du Prix de vente des plateaux repas
        selectQteVenteRepas = document.getElementById("qte-prix-vente-repas");
        valeurQteVenteRepas = parseFloat(selectQteVenteRepas.value);
        //calcul du total du Prix de vente des plateaux repas
        totalRepas = valeurMontantVenteSupportsCours * valeurQteVenteSupportsCours;
        document.getElementById('total-prix-vente-repas').value = totalRepas.toFixed(2);
    }
    // calcul du prix de vente des certifications
    function TotalPrixVenteCertifs(){
        // récupération de la valeur du champ montant du Prix de vente des certifications
        selectMontantVenteCertifs = document.getElementById("montant-prix-vente-certifs");
        valeurMontantVenteCertifs = selectMontantVenteCertifs.value;
        // récupération de la valeur du champ quantité du Prix de vente des certifications
        selectQteVenteCertifs = document.getElementById("qte-prix-vente-certifs");
        valeurQteVenteCertifs = selectQteVenteCertifs.value;
        //calcul du total du Prix de vente des certifications
        document.getElementById('total-prix-vente-certifs').value = valeurMontantVenteCertifs * valeurQteVenteCertifs;
    }
    // calcul du prix de vente autres
    function TotalPrixVenteAutres(){
        // récupération de la valeur du champ montant du Prix de vente autres
        selectMontantVenteAutres = document.getElementById("montant-prix-vente-autres");
        valeurMontantVenteAutres = selectMontantVenteAutres.value;
        // récupération de la valeur du champ quantité du Prix de vente autres
        selectQteVenteAutres = document.getElementById("qte-prix-vente-autres");
        valeurQteVenteAutres = selectQteVenteAutres.value;
        //calcul du total du Prix de vente autres
        document.getElementById('total-prix-vente-autres').value = valeurMontantVenteAutres * valeurQteVenteAutres;
    }
    // calcul du total des ventes
    function TotalChiffrage(){
        // récupération de la valeur de tous les champs total du Prix de vente journalier de la formation
        selectTotalVenteJour = document.getElementById("total-prix-vente-jour-form");
        valeurTotalVenteJour = parseFloat(selectTotalVenteJour.value);
        // récupération de la valeur de tous les champs total du Prix de vente des supports de cours
        selectTotalVenteSupportsCours = document.getElementById("total-prix-vente-supports-cours");
        valeurTotalVenteSupportsCours = parseFloat(selectTotalVenteSupportsCours.value);
        // récupération de la valeur de tous les champs total du Prix de vente des plateaux repas
        selectTotalVenteRepas = document.getElementById("total-prix-vente-repas");
        valeurTotalVenteRepas = parseFloat(selectTotalVenteRepas.value);
        // récupération de la valeur de tous les champs total du Prix de vente des certifications
        selectTotalVenteCertifs = document.getElementById("total-prix-vente-certifs");
        valeurTotalVenteCertifs = parseFloat(selectTotalVenteCertifs.value);
        // récupération de la valeur de tous les champs total du Prix de vente autres
        selectTotalVenteautres = document.getElementById("total-prix-vente-autres");
        valeurTotalVenteautres = parseFloat(selectTotalVenteautres.value);

        //calcul du total de toutes les quantité du Prix de vente journalier de la formation
        totalVente = valeurTotalVenteJour + valeurTotalVenteSupportsCours + valeurTotalVenteRepas + valeurTotalVenteCertifs + valeurTotalVenteautres
        document.getElementById('total-total-ventes').value = totalVente.toFixed(2);
    }
    function addSite() {
        window.location = '../ajouter-un-site';
    }
</script>