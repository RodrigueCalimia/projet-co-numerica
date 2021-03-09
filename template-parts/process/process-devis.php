<!-- Page du processus de création d'un devis -->
<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_devis contenant les devis
    $lesDevis = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_devis'));
    // récupération des données de la table wp_type_personne contenant les types des personnes
    $lesTypesPersonnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_type_personne'));
    // récupération des données de la table wp_sites contenant les lieux de formations
    $lesLieuxFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));
    // détermination du n° de devis
    if($lesDevis){
        foreach ($lesDevis as $leDevis){
            $sufixeNumDevis = $leDevis->ID_DEVIS;
            $sufixeNumDevis += 1;
        }
    } else {
        $sufixeNumDevis = 1;
    }
    $numDevis = "NUMFORM".str_pad($sufixeNumDevis, 4, 0, STR_PAD_LEFT);
    // récupération des données de la table wp_entreprises_opco contenant les entreprises et les OPCO
    $lesEntreprisesOpco = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_entreprises_opco'));
    // récupération des données de la table wp_personnes contenant les personnes
    $lesPersonnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_personnes'));
    $tabPersonneidEntOpco1  = "var tabPersonneidEntOpco2 = Array()\n";
    $tabPersonneType1       = "var tabPersonneType2 = Array()\n";
    $tabPersonneNom1        = "var tabPersonneNom2 = Array()\n";
    $tabPersonnePrenom1     = "var tabPersonnePrenom2 = Array()\n";
    $cptTable = 0;
    foreach ($lesPersonnes as $laPersonne){
        // stockage des données dans une varaible
        $tabPersonneidEntOpco1  = $tabPersonneidEntOpco1."tabPersonneidEntOpco2[".$cptTable."]='".$laPersonne->ID_ENT_OPCO."'\n";
        $tabPersonneType1       = $tabPersonneType1."tabPersonneType2[".$cptTable."]='".$laPersonne->TYPE_PERSONNE."'\n";
        $tabPersonneNom1        = $tabPersonneNom1."tabPersonneNom2[".$cptTable."]='".$laPersonne->NOM_PERSONNE."'\n";
        $tabPersonnePrenom1     = $tabPersonnePrenom1."tabPersonnePrenom2[".$cptTable."]='".$laPersonne->PRENOM_PERSONNE."'\n";
        $cptTable += 1;
        //$idEntOpcoPersonne  = $laPersonne->ID_ENT_OPCO;
    }
    // récupération des données de la table wp_formations contenant les formations
    $lesFormations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_formations'));
    // récupération des données de la table wp_cout_admin_formation contenant le coût administratif formation
    $lesCoutAdminFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_admin_formation'));
    // récupération des données de la dernière ligne du tableau
    foreach ($lesCoutAdminFormation as $leCoutAdminFormation){
        $coutAdminFormation = $leCoutAdminFormation->COUT_ADMIN_FORMATION;
    }
    // récupération des données de la table wp_cout_comptabilite contenant le coût comptabilité
    $lesCoutCompta = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_comptabilite'));
    // récupération des données de la dernière ligne du tableau
    foreach ($lesCoutCompta as $leCoutCompta){
        $coutCompta = $leCoutCompta->COUT_COMPTA;
    }
    // récupération des données de la table wp_cout_service_informatique contenant le coût service informatique
    $lesCoutServiceInformatique = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_service_informatique'));
    // récupération des données de la dernière ligne du tableau
    foreach ($lesCoutServiceInformatique as $leCoutServiceInformatique){
        $coutServiceInformatique    = $leCoutServiceInformatique->COUT_SERVICE_INFORMATIQUE;
    }
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();

    /*******************************************************\
                    GESTION DU FORMULAIRE
    \*******************************************************/
    if ($_POST) {
        /********************************************************************\
            Ajout des dates de formation dans la table wp_dates_formation
        \********************************************************************/
        // récupération des dates de la formation
        $nbJour = $dureeFormationJours + 0.5;
        for($i = 1; $i <= $nbJour; $i++){
            $wpdb->insert('wp_dates_formation', 
                array(
                    'NUM_FORM'          =>$numFormation,
                    'NUM_JOUR'          =>$i,
                    'DATE_FORMATION'    =>$_POST['date-formation-jour'.$i]
                )
            );
        }

        /****************************************************************************\
            Ajout de la nouvelle entreprise dans la table wp_entreprises_opco
        \****************************************************************************/
        $typeEntOpcoPage    =$_POST['typeEntrepriseOPCO'];
        $nomCommercial      =$_POST['nom_commercial'];
        $adresse            =$_POST['adresse-entreprise-opco'];
        $codePostal         =$_POST['code_postal-entreprise-opco'];
        $ville              =$_POST['ville-entreprise-opco'];
        $siret              =$_POST['siret-entreprise-opco'];
        $naf                =$_POST['naf-entreprise-opco']; 
        if($nomCommercial){
            $wpdb->insert('wp_entreprises_opco', 
                array(
                    'TYPE_ENT_OPCO'     =>$typeEntOpcoPage,
                    'NOM_ENT_OPCO'      =>$nomCommercial,
                    'ADRESSE_ENT_OPCO'  =>$adresse,
                    'CP_ENT_OPCO'       =>$codePostal,
                    'VILLE_ENT_OPCO'    =>$ville,
                    'SIRET_ENT_OPCO'    =>$siret,
                    'NAF_ENT_OPCO'      =>$naf,
                )
            );
        }

        /****************************************************************************\
            Ajout du nouvel interlocuteur dans la table wp_personnes
        \****************************************************************************/
        $nomPersonne    =$_POST['nom_personne'];
        $prenomPersonne =$_POST['prenom_personne'];
        $emailPersonne  =$_POST['email_personne'];
        $telPersonne    =$_POST['tel_personne'];
        $kabisPersonne  =$_POST['kabis_personne'];
        $typePersonne   =$_POST['type_personne'];
        // ajout des données dans la table
        $wpdb->insert('wp_personnes', 
            array(
                'NOM_PERSONNE'                      =>$nomPersonne,
                'PRENOM_PERSONNE'                   =>$prenomPersonne,
                'EMAIL_PERSONNE'                    =>$emailPersonne,
                'TEL_PERSONNE'                      =>$telPersonne,
                'TYPE_PERSONNE'                     =>$typePersonne,
                'KABIS_PERSONNE'                    =>$kabisPersonne,
                'ID_FORMATEUR'                      =>0,
                'ID_STAGIAIRE'                      =>0,
                'ID_ENT_OPCO'                       =>0,
                'CV_PERSONNE'                       =>$fichier,
                'ROLE_ADMIN_WP'                     =>false,
                'ROLE_ADMIN_SOLUTION'               =>false,
                'ROLE_ADMROLE_GESTIONNAIREIN_WP'    =>false,
                'ROLE_ADMROLE_ASSISTANTEIN_WP'      =>false,
                'ROLE_FINANCE'                      =>false,
                'ROLE_FORMATEUR'                    =>false,
                'ROLE_CLIENT'                       =>false,
                'ROLE_SUBROGATEUR'                  =>false,
            )
        );

        /*******************************************************\
            Récupération des données de l'onglet CLIENT
        \*******************************************************/
        $numFormation   =$_POST['numFormation'];
        $dateFormation  =$_POST['dateFormation'];
        $entreprise     =$_POST['listeEntreprise'];
        $interlocuteur  =$_POST['listeInterlocuteur'];
        $respFormation  =$_POST['listeRespFormation'];
        // récupération des valeurs des champs du formulaire d'ajout d'un interlocuteur
        $typePersonne   =$_POST['type_personne'];
        $nomPersonne    =$_POST['nom_personne'];
        $prenomPersonne =$_POST['prenom_personne'];
        $emailPersonne  =$_POST['email_personne'];
        $telPersonne    =$_POST['tel_personne'];
        // récupération des valeurs des champs du formulaire d'ajout d'un responsable formation
        $typeRespFormation      =$_POST['typeRespFormation'];
        $nomRespFormation       =$_POST['nomRespFormation'];
        $prenomRespFormation    =$_POST['prenomRespFormation'];
        $emailRespFormation     =$_POST['emailRespFormation'];
        $telRespFormation       =$_POST['telRespFormation'];

        /*******************************************************\
            Récupération des données de l'onglet PEDAGOGIE
        \*******************************************************/
        // récupération du lieu de la formation
        $lieuFormation      =$_POST['listeSite'];
        // récupération des valeurs des champs du formulaire de création d'un site
        $nomSite        =$_POST['nom_site'];
        $adresseSite    =$_POST['adresse_site'];
        $cpSite         =$_POST['code_postal_site'];
        $villeSite      =$_POST['ville_site'];
        // récupération de la durée de la formation
        $dureeFormationJours    = $_POST['duree_formation_jour'];
        $dureeFormationHeures   = $_POST['duree_formation_heure'];
        // récupération des horaires de la formation
        $horaireMatinDebut  = $_POST['flexTimeDefault01'];
        $horaireMatinFin    = $_POST['flexTimeDefault02'];
        $horaireApremDebut  = $_POST['flexTimeDefault03'];
        $horaireApremFin    = $_POST['flexTimeDefault04'];

        /*******************************************************\
            Récupération des données de l'onglet SESSION
        \*******************************************************/
        // récupération du type de session
        $typeSession  = $_POST['flexTimeDefault01'];
        // récupération de la date non définie
        $datesNonDefinies  = $_POST['datesNonDefinies'];
        // récupération du prérequis
        $prerequis  = $_POST['prerequis'];
        // récupération du nombre de participants
        $nbParticipants  = $_POST['nb_participants'];

        /*******************************************************\
            Récupération des données de l'onglet CHIFFRAGE
        \*******************************************************/
        // récupération des données Prix de vente journalier de la formation
        $montantPrixVenteJourForm       = $_POST['montant-prix-vente-jour-form'];
        $qtePrixVenteJourForm           = $_POST['qte-prix-vente-jour-form'];
        $totalPrixVenteJourForm         = $_POST['total-prix-vente-jour-form'];
        // récupération des données Prix de vente des supports de cours
        $montantPrixVenteSuppCours      = $_POST['montant-prix-vente-supports-cours'];
        $qtePrixVenteSuppCours          = $_POST['qte-prix-vente-supports-cours'];
        $totalPrixVenteSuppCours        = $_POST['total-prix-vente-supports-cours'];
        // récupération des données Prix de vente des plateaux repas
        $montantPrixVenteRepas          = $_POST['montant-prix-vente-repas'];
        $qtePrixVenteRepas              = $_POST['qte-prix-vente-repas'];
        $totalPrixVenteRepas            = $_POST['total-prix-vente-repas'];
        // récupération des données Prix de vente des certifications
        $montantPrixVenteCertifs        = $_POST['montant-prix-vente-certifs'];
        $qtePrixVenteCertifs            = $_POST['qte-prix-vente-certifs'];
        $totalPrixVenteCertifs          = $_POST['total-prix-vente-certifs'];
        // récupération des données Prix de vente des autres
        $textePrixVenteAutres           = $_POST['texte-prix-vente-autres'];
        $montantPrixVenteAutres         = $_POST['montant-prix-vente-autres'];
        $qtePrixVenteAutres             = $_POST['qte-prix-vente-autres'];
        $totalPrixVenteAutres           = $_POST['total-prix-vente-autres'];
        // récupération des données Total des ventes
        $totalVentes                    = $_POST['total-total-ventes'];
        // récupération des données Coût d'achat journalier de la prestation du formateur
        $montantCoutAchatJourPresta     = $_POST['montant-cout-achat-jour-presta'];
        $qteCoutAchatJourPresta         = $_POST['qte-cout-achat-jour-presta'];
        $totalCoutAchatJourPresta       = $_POST['total-cout-achat-jour-presta'];
        // récupération des données Coût d'achat des supports de cours
        $montantCoutAchatSuppCours      = $_POST['montant-cout-achat-supports-cours'];
        $qteCoutAchatSuppCours          = $_POST['qte-cout-achat-supports-cours'];
        $totalCoutAchatSuppCours        = $_POST['total-cout-achat-supports-cours'];
        // récupération des données Coût d'achat des plateaux repas
        $montantCoutAchatRepas          = $_POST['montant-cout-achat-repas'];
        $qteCoutAchatRepas              = $_POST['qte-cout-achat-repas'];
        $totalCoutAchatRepas            = $_POST['total-cout-achat-repas'];
        // récupération des données Coût d'achat des certifications
        $montantCoutAchatCertifs        = $_POST['montant-cout-achat-certifs'];
        $qteCoutAchatCertifs            = $_POST['qte-cout-achat-certifs'];
        $totalCoutAchatCertifs          = $_POST['total-cout-achat-certifs'];
        // récupération des données Coût d'achat journalier de la location de salle
        $montantCoutAchatLocation       = $_POST['montant-cout-achat-location'];
        $qteCoutAchatLocation           = $_POST['qte-cout-achat-location'];
        $totalCoutAchatLocation         = $_POST['total-cout-achat-location'];
        // récupération des données Coût d'achat d'affaires
        $montantCoutAchatAffaires       = $_POST['montant-cout-achat-affaire'];
        $qteCoutAchatAffaires           = $_POST['qte-cout-achat-affaire'];
        $totalCoutAchatAffaires         = $_POST['total-cout-achat-affaire'];
        // récupération des données Coût d'achat des autres
        $texteCoutAchatAutres           = $_POST['texte-cout-achat-autres'];
        $montantCoutAchatAutres         = $_POST['montant-cout-achat-autres'];
        $qteCoutAchatAutres             = $_POST['qte-cout-achat-autres'];
        $totalCoutAchatAutres           = $_POST['total-cout-achat-autres'];
        // récupération des données Total des achats
        $totalCout                      = $_POST['total-total-couts'];
        // récupération des données Coût administratif formation
        $coutAdminFormDuree             = $_POST['cout-admin-form-duree'];
        $coutAdminFormHoraire           = $_POST['cout-admin-form-horaire'];
        $coutAdminFormMontant           = $_POST['cout-admin-form-montant'];
        // récupération des données Coût comptabilité
        $coutComptaDuree                = $_POST['cout-Compta-duree'];
        $coutComptaHoraire              = $_POST['cout-Compta-horaire'];
        $coutComptaMontant              = $_POST['cout-Compta-montant'];
        // récupération des données Coût service informatique
        $coutServiceInformatiqueDuree   = $_POST['cout-service-informatique-duree'];
        $coutServiceInformatiqueHoraire = $_POST['cout-service-informatique-horaire'];
        $coutServiceInformatiqueMontant = $_POST['cout-service-informatique-montant'];
        // récupération des données Coût de fonctionnement autres
        $texteCoutFonctAutres           = $_POST['texte-cout-fonctionnement-autres'];
        $coutFonctAutresDuree           = $_POST['cout-autres-duree'];
        $coutFonctAutresHoraire         = $_POST['cout-autres-horaire'];
        $coutFonctAutresMontant         = $_POST['cout-autres-montant'];
        // récupération des données Total des coûts de fonctionnement
        $totalCoutFonctionnement        = $_POST['cout-fonctionnement-total'];
        // récupération des données de la synthèse
        $syntheseVentes                 = $_POST['row-total-ventes'];
        $syntheseAchats                 = $_POST['row-total-achats-fonctionnement'];
        $syntheseMarge                  = $_POST['row-total-marge'];
        $synthesemargePourcentage       = $_POST['row-total-marge-pourcentage'];
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

    <form class="row" method="POST" enctype="multipart/form-data">
        <div class="tab-content" id="nav-tabContent">
            <!-- Contenu de l'onglet Client -->
            <div class="tab-pane fade show active" id="nav-client" role="tabpanel" aria-labelledby="nav-client-tab">
                <!-- Numéro du devis -->
                <div class="col-md-6">
                    <label for="numFormation" class="form-time-label">Numéro</label>
                    <input type="text" name="numFormation" class="form-control"  id="numFormation" readonly="true" value="<?php echo $numDevis ?>" >
                </div>
                <!-- Choix de la date -->
                <div class="col-md-6">
                    <label for="dateFormation" class="form-label">Date</label>
                    <input type="date" name="dateFormation" class="form-control" id="dateFormation" required value="" >
                </div>
                <!-- Choix de l'entreprise -->
                <div class="col-md-6">
                    <label for="listeEntreprise" class="form-label"> Entreprise </label>
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" onchange="SelectEntreprise();" id="listeEntreprise">
                            <option></option>
                            <?php foreach ($lesEntreprisesOpco as $lEntrepriseOpco):
                                // stockage des données dans une varaible
                                $idEntrepriseOpco    = $lEntrepriseOpco->ID_ENT_OPCO;
                                $nomEntrepriseOpco    = $lEntrepriseOpco->NOM_ENT_OPCO;?>
                                <option value="<?php echo  $idEntrepriseOpco;?>"><?php echo  $nomEntrepriseOpco;?></option>
                            <?php endforeach;?>
                        </select>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addEntreprise" data-bs-whatever="@getbootstrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </button>
                    </div>
                    <!-- <button class="btn btn-secondary" type="button" onclick="addEntreprise()">Ajouter une entreprise</button> -->
                </div>
                <!-- Choix de l'interlocuteur -->
                <div class="col-md-6">
                    <label for="listeInterlocuteur" class="form-label">Interlocuteur</label>
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" id="listeInterlocuteur">
                        </select>      
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addInterlocuteur" data-bs-whatever="@getbootstrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </button>
                    </div>              
                    <!-- <button class="btn btn-secondary" type="button" onclick="addInterlocuteur()">Ajouter un interlocuteur</button> -->
                </div>
                <!-- Choix du responsable formation -->
                <div class="col-md-6">
                    <label for="listeRespFormation" class="form-label">Responsable Formation</label>
                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" id="listeRespFormation">
                            <option></option>
                            <?php foreach ($lesPersonnes as $laPersonne):
                                // stockage des données dans une varaible
                                $nomPersonne    = $laPersonne->NOM_PERSONNE;
                                $prenomPersonne = $laPersonne->PRENOM_PERSONNE;
                                $typePersonne   = $laPersonne->TYPE_PERSONNE;
                                // ajout à la liste que les responsables formation
                                if ($typePersonne == "Responsable formation"):
                                ?> 
                                <option><?php echo  ($prenomPersonne .' '.$nomPersonne);?></option>
                            <?php endif; endforeach;?>
                        </select>      
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addRespFormation" data-bs-whatever="@getbootstrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </button>
                    </div>               
                    <!-- <button class="btn btn-secondary" type="button" onclick="addResponsable()">Ajouter un responsable</button> -->
                </div>
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
                            
                            foreach ($lesFormations as $laFormation): 
                                $selectForm = $selectForm . "<option value=".$laFormation->ID_FORMATION.">".$laFormation->NOM_FORMATION."</option>";
                                $tabObjForm1 = $tabObjForm1."tabObjForm2[".$laFormation->ID_FORMATION."]='".$laFormation->OBJ_FORMATION."'\n";
                                $tabObjProForm1 = $tabObjProForm1."tabObjProForm2[".$laFormation->ID_FORMATION."]='".$laFormation->OBJ_PRO_FORMATION."'\n";
                                $tabParcourPedaPrevi1 = $tabParcourPedaPrevi1."tabParcourPedaPrevi2[".$laFormation->ID_FORMATION."]='".$laFormation->PARCOUR_PEDA_PREVI."'\n";
                                $tabObjForm2[$laFormation->ID_FORMATION]=$laFormation->OBJ_FORMATION;
                                $tabObjProForm2[$laFormation->ID_FORMATION]=$laFormation->OBJ_PRO_FORMATION;
                                $tabParcourPedaPrevi2[$laFormation->ID_FORMATION]=$laFormation->PARCOUR_PEDA_PREVI;
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
                            <div class="input-group mb-3">
                                <span class="col form-control lieu-formation"><h6>Lieu de la formation</h6></span>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addSite" data-bs-whatever="@getbootstrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </button>
                            </div>
                            <div id="id-boite-check" class="boite-check">
                                <?php foreach ($lesLieuxFormation as $leLieuFormation):?> 
                                    <div class="form-check" id="liste-site-numerica">
                                        <label class="form-check-label" for="listeSiteNumerica">  
                                            <?php echo  $leLieuFormation->NOM_SITE ;?>
                                        </label>
                                        <input class="form-check-input" type="radio" name="listeSite" id="listeSiteNumerica" value="<?php echo  $leLieuFormation->NOM_SITE ;?>">
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <div class="boite-check">
                                <div class="form-check">
                                    <label class="form-check-label" for="siteClient">Site client</label>
                                    <input class="form-check-input" type="radio" name="listeSite" id="siteClient" value="Site client">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="siteAutre">Autre site</label>
                                    <input class="form-check-input" type="radio" name="listeSite" id="siteAutre" value="Autre site<">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="aDistance">À distance</label>
                                    <input class="form-check-input" type="radio" name="listeSite" id="aDistance" value="À distance">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <h6>Horaires de la formation</h6>
                                <label class="form-time-label" for="flexTimeDefault01">Matin du</label>
                                <input class="form-time-input" type="time" value="09:00" id="flexTimeDefault01" name="flexTimeDefault01">
                                <label class="form-time-label" for="flexTimeDefault02">à</label>
                                <input class="form-time-input" type="time" value="12:30" id="flexTimeDefault02" name="flexTimeDefault02">
                                <label class="form-time-label" for="flexTimeDefault03">Après-midi du</label>
                                <input class="form-time-input" type="time" value="13:30" id="flexTimeDefault03" name="flexTimeDefault03">
                                <label class="form-time-label" for="flexTimeDefault04">à</label>
                                <input class="form-time-input" type="time" value="17:00" id="flexTimeDefault04" name="flexTimeDefault04">
                            </div>
                            <!-- Zone du choix du type de session -->
                            <div>
                                <label for="type-session" class="form-label">Type de Session</label>
                                <select class="form-select" id="type-session" name="type-session">
                                    <option value="interEntreprise">Inter-Entreprise</option>
                                    <option value="intraEntreprise">Intra-Entreprise</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <h6>Prérequis</h6>
                            <textarea class="form-control" value="" id="prerequis" name="prerequis" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h6>Durée de la formation</h6>
                            <div class="input-group mb-3">
                                <input type="number" name="duree_formation_jour" class="form-control" id="duree-formation-jour" required onchange="DureeFormationJour();" value=0 min="0" step="0.5">
                                <span class="input-group-text input-group-text-session" id="basic-addon1">jours</span>
                            </div>
                            <div class="input-group mb-3">
                                <input type="number" name="duree-formation-heure" class="form-control" id="duree-formation-heure" required onchange="DureeFormationHeure();TotalCoutAchatJourPresta();TotalAchat()" value=0 min="0" step="3.5">
                                <span class="input-group-text input-group-text-session" id="basic-addon2">heures</span>
                            </div>
                        </div>
                        <div class="col">
                            <h6>Dates de la formation</h6>
                            <div class="liste">
                                <div class="model">
                                    <div class="dates_formation" id="liste-dates-formation"></div>
                                </div>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="datesNonDefinies">Dates non définies</label>
                                <input class="form-check-input" type="checkbox" value="" name="datesNonDefinies">
                            </div>
                        </div>
                        <div class="col">
                            <h6>Nombre de participants</h6>
                            <input type="number" name="nb_participants" class="form-control" id="nb_participants" required onchange="CopyNbParticipants();TotalCoutAchatCertifs();TotalCoutAchatLocation();TotalAchat()" value=0 min="0">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contenu de l'onglet Chiffrage -->
            <div class="tab-pane fade" id="nav-chiffrage" role="tabpanel" aria-labelledby="nav-chiffrage-tab">
                <!-- Zone des prix de ventes -->
                <div class="container">
                    <!-- 
                    SECTION PRIX DES VENTES    
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
                                <input type="number" name="total-prix-vente-jour-form" class="form-control" id="total-prix-vente-jour-form" value=0 min="0" readonly="true" >
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
                                <input type="number" name="montant-prix-vente-supports-cours" class="form-control" id="montant-prix-vente-supports-cours" value=0 min="0" onchange="TotalPrixVenteSupportsCours();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-supports-cours" class="form-control" id="qte-prix-vente-supports-cours" value=0 min="0" onchange="TotalPrixVenteSupportsCours();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-supports-cours" class="form-control" id="total-prix-vente-supports-cours" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-prix-vente-repas" class="form-control" id="montant-prix-vente-repas" value=0 min="0" onchange="TotalPrixVenteRepas();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-repas" class="form-control" id="qte-prix-vente-repas" value=0 min="0" onchange="TotalPrixVenteRepas();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-repas" class="form-control" id="total-prix-vente-repas" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-prix-vente-certifs" class="form-control" id="montant-prix-vente-certifs" value=0 min="0" onchange="TotalPrixVenteCertifs();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-certifs" class="form-control" id="qte-prix-vente-certifs" value=0 min="0" readonly="true" onchange="TotalPrixVenteCertifs();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-certifs" class="form-control" id="total-prix-vente-certifs" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-prix-vente-autres" class="form-control" id="montant-prix-vente-autres" value=0 min="0" onchange="TotalPrixVenteAutres();TotalChiffrage()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-prix-vente-autres" class="form-control" id="qte-prix-vente-autres" value=0 omin="0" onchange="TotalPrixVenteAutres();TotalChiffrage()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-prix-vente-autres" class="form-control" id="total-prix-vente-autres" readonly="true" value=0 min="0" >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Total des ventes -->
                    <div class="row justify-content-md-end">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Total des ventes</span>
                                <input type="number" name="total-total-ventes" class="form-control chiffrage-total" id="total-total-ventes" readonly="true" value="0" min="0" >
                                <label class="input-group-text" for="total-total-ventes">€</label>
                            </div>
                        </div>
                    </div>

                    <!-- 
                    SECTION COÛT DES ACHATS    
                    Titres de la 1ère ligne des coûts d'achat
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
                            <input type="number" name="qte-cout-achat-jour-presta" class="form-control" id="qte-cout-achat-jour-presta" value=0 min="0" readonly="true" onchange="TotalCoutAchatJourPresta();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-jour-presta" class="form-control" id="total-cout-achat-jour-presta" value=0 rmin="0" readonly="true" >
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
                                <input type="number" name="montant-cout-achat-supports-cours" class="form-control" id="montant-cout-achat-supports-cours" value=0 min="0" onchange="TotalCoutAchatSupportsCours();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-supports-cours" class="form-control" id="qte-cout-achat-supports-cours" value=0 min="0" onchange="TotalCoutAchatSupportsCours();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-supports-cours" class="form-control" id="total-cout-achat-supports-cours" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-cout-achat-repas" class="form-control" id="montant-cout-achat-repas" value=0 min="0" onchange="TotalCoutAchatRepas();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-repas" class="form-control" id="qte-cout-achat-repas" value=0 min="0" onchange="TotalCoutAchatRepas();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-repas" class="form-control" id="total-cout-achat-repas" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-cout-achat-certifs" class="form-control" id="montant-cout-achat-certifs" value=0 min="0" onchange="TotalCoutAchatCertifs();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-certifs" class="form-control" id="qte-cout-achat-certifs" value=0 min="0" readonly="true"  onchange="TotalCoutAchatCertifs();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-certifs" class="form-control" id="total-cout-achat-certifs" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-cout-achat-location" class="form-control" id="montant-cout-achat-location" value=0 min="0" onchange="TotalCoutAchatLocation();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-location" class="form-control" id="qte-cout-achat-location" value=0 min="0" readonly="true"  onchange="TotalCoutAchatLocation();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-location" class="form-control" id="total-cout-achat-location" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-cout-achat-affaire" class="form-control" id="montant-cout-achat-affaire" value=0 min="0" onchange="TotalCoutAchatAffaire();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <select class="form-select" id="qte-cout-achat-affaire" onchange="TotalCoutAchatAffaire();TotalAchat()">
                                    <option value="0Pourcent">0</option>
                                    <option value="5Pourcent">5</option>
                                    <option value="10Pourcent">10</option>
                                    <option value="15Pourcent">15</option>
                                    <option value="20Pourcent">20</option>
                                    <option value="25Pourcent">25</option>
                                    <option value="30Pourcent">30</option>
                                </select>
                                <label class="input-group-text" for="type-session">%</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-affaire" class="form-control" id="total-cout-achat-affaire" readonly="true" value=0 min="0" >
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
                                <input type="number" name="montant-cout-achat-autres" class="form-control" id="montant-cout-achat-autres" value=0 min="0" onchange="TotalCoutAchatAutres();TotalAchat()">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="number" name="qte-cout-achat-autres" class="form-control" id="qte-cout-achat-autres" value=0 min="0" onchange="TotalCoutAchatAutres();TotalAchat()">
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="total-cout-achat-autres" class="form-control" id="total-cout-achat-autres" readonly="true" value=0 min="0" >
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                    </div>
                    <!-- Total des coûts d'achat -->
                    <div class="row justify-content-md-end">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Total des achats</span>
                                <input type="number" name="total-total-couts" class="form-control" id="total-total-couts" readonly="true" value="0" min="0" >
                                <label class="input-group-text" for="total-total-couts">€</label>
                            </div>
                        </div>
                    </div>

                    <!-- 
                    SECTION COÛT DE FONCTIONNEMENT    
                    Titres de la 1ère ligne des coûts de fonctionnement
                    -->
                    <div class="row justify-content-md-center">
                        <!-- dénomination des titres -->
                        <div class="col"></div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Durée</span>
                        </div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Coût Horaire</span>
                        </div>
                        <div class="col-lg-2">
                            <span class="titre-col-chiffrage">Montant</span>
                        </div>
                    </div>
                    <!-- 
                        Contenu des lignes des coûts 
                    -->
                    <!-- Coût adminsitratif formation -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-admin-form" class="form-label">Coût administratif formation</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <select class="form-select" id="cout-admin-form-duree" onchange="TotalCoutAdminDuree();TotalFonctionnement()">
                                    <option value="1">0</option>
                                    <option value="2">15</option>
                                    <option value="3">30</option>
                                    <option value="4">45</option>
                                    <option value="5">60</option>
                                    <option value="6">75</option>
                                    <option value="7">90</option>
                                    <option value="8">105</option>
                                    <option value="9">120</option>
                                </select>
                                <label class="input-group-text" for="cout-admin-form-duree">mn</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="cout-admin-form-horaire" class="form-control" id="cout-admin-form-horaire" value="<?php echo $coutAdminFormation ?>" min="0" readonly="true">
                                <label class="input-group-text" for="cout-admin-form-horaire">€</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="cout-admin-form-montant" class="form-control" id="cout-admin-form-montant" readonly="true" value="0" min="0" >
                                <label class="input-group-text" for="cout-admin-form-montant">€</label>
                            </div>
                        </div>
                    </div>
                    <!-- Coût comptabilité -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-compta" class="form-label">Coût comptabilité</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <select class="form-select" id="cout-compta-duree" onchange="TotalCoutComptaDuree();TotalFonctionnement()">
                                    <option value="1">0</option>
                                    <option value="2">15</option>
                                    <option value="3">30</option>
                                    <option value="4">45</option>
                                    <option value="5">60</option>
                                    <option value="6">75</option>
                                    <option value="7">90</option>
                                    <option value="8">105</option>
                                    <option value="9">120</option>
                                </select>
                                <label class="input-group-text" for="cout-compta-duree">mn</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                            <input type="number" name="cout-compta-horaire" class="form-control" id="cout-compta-horaire" value="<?php echo $coutCompta ?>" min="0" readonly="true">
                                <label class="input-group-text" for="cout-compta-horaire">€</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="cout-compta-montant" class="form-control" id="cout-compta-montant" readonly="true" value="0" min="0" >
                                <label class="input-group-text" for="cout-compta-motnant">€</label>
                            </div>
                        </div>
                    </div>
                    <!-- Coût service informatique -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <label for="cout-service-informatique" class="form-label">Coût service informatique</label>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <select class="form-select" id="cout-service-informatique-duree" onchange="TotalCoutServiceInformatiqueDuree();TotalFonctionnement()">
                                    <option value="1">0</option>
                                    <option value="2">15</option>
                                    <option value="3">30</option>
                                    <option value="4">45</option>
                                    <option value="5">60</option>
                                    <option value="6">75</option>
                                    <option value="7">90</option>
                                    <option value="8">105</option>
                                    <option value="9">120</option>
                                </select>
                                <label class="input-group-text" for="cout-service-informatique-duree">mn</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                            <input type="number" name="cout-service-informatique-horaire" class="form-control" id="cout-service-informatique-horaire" value="<?php echo $coutServiceInformatique ?>" min="0" readonly="true">
                                <label class="input-group-text" for="cout-service-informatique-horaire">€</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="cout-service-informatique-montant" class="form-control" id="cout-service-informatique-montant" readonly="true" value="0" min="0" >
                                <label class="input-group-text" for="cout-service-informatique-montant">€</label>
                            </div>
                        </div>
                    </div>
                    <!-- Coût autres -->
                    <div class="row justify-content-md-center">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Autres</span>
                                <input type="text" name="texte-cout-fonctionnement-autres" class="form-control" id="texte-cout-fonctionnement-autres" >
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <select class="form-select" id="cout-autres-duree" onchange="TotalCoutAutresDuree();TotalFonctionnement()">
                                    <option value="1">0</option>
                                    <option value="2">15</option>
                                    <option value="3">30</option>
                                    <option value="4">45</option>
                                    <option value="5">60</option>
                                    <option value="6">75</option>
                                    <option value="7">90</option>
                                    <option value="8">105</option>
                                    <option value="9">120</option>
                                </select>
                                <label class="input-group-text" for="cout-autres-duree">mn</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                            <input type="number" name="cout-autres-horaire" class="form-control" id="cout-autres-horaire" value="0" min="0" step="0.01" onchange="TotalCoutAutresDuree();TotalFonctionnement()">
                                <label class="input-group-text" for="cout-autres-horaire">€</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group mb-3">
                                <input type="number" name="cout-autres-montant" class="form-control" id="cout-autres-montant" readonly="true" value="0" min="0" >
                                <label class="input-group-text" for="cout-autres-montant">€</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total des coûts de fonctionnement -->
                    <div class="row justify-content-md-end">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Total des coûts de fonctionnement</span>
                                <input type="number" name="cout-fonctionnement-total" class="form-control" id="cout-fonctionnement-total" readonly="true" value="0" min="0" >
                                <label class="input-group-text" for="cout-fonctionnement-total">€</label>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION SYNTHÈSE -->
                    <div class="col d-flex justify-content-end">
                        <div class="card text-center col-6">
                            <div class="card-header bg-secondary"><h3>Synthèse</h3></div>    
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Ventes</span>
                                    <input type="number" name="row-total-ventes" class="form-control" id="row-total-ventes" readonly="true" value="0" min="0" >
                                    <label class="input-group-text" for="row-total-ventes">€</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Achats + Fonctionnement</span>
                                    <input type="number" name="row-total-achats-fonctionnement" class="form-control" id="row-total-achats-fonctionnement" readonly="true" value="0" min="0" >
                                    <label class="input-group-text" for="row-total-ventes">€</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Marge</span>
                                    <input type="number" name="row-total-marge" class="form-control" id="row-total-marge" readonly="true" value="0" min="0" >
                                    <label class="input-group-text" for="row-total-marge">€</label>
                                    <input type="number" name="row-total-marge-pourcentage" class="form-control" id="row-total-marge-pourcentage" readonly="true" value="0" min="0" >
                                    <label class="input-group-text" for="row-total-marge-pourcentage">%</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton d'édition du devis -->          
                    <div class="col btn-justify-content-end">
                        <!--<input class="btn btn-primary" type="submit" value="Éditer le devis" name="edit-devis"></input>-->  
                        <input class="btn btn-primary" type="button" value="Éditer le devis" name="edit-devis" onclick="EditDevis()"></input>
                    </div>
                </div>
            </div>
        </div>
        <!-- ZONE DES MODAL POUR LES FORMULAIRES -->
        <!-- Modal pour l'ajout d'une entreprise dans la liste des Entreprises -->
        <div class="modal fade" id="addEntreprise" tabindex="-1" aria-labelledby="addEntrepriseLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="typeEntrepriseOPCO" class="form-label">Type</label>
                                <select class="form-select" aria-label="Default select example" id="typeEntrepriseOPCO" name="typeEntrepriseOPCO" value="">
                                    <option selected>Entreprise</option>
                                    <option>OPCO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nom_commercial" class="form-label">Nom commercial</label>
                                <input type="text" name="nom_commercial" class="form-control" id="nom_commercial" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="adresse-entreprise-opco" class="form-label">Adresse</label>
                            <input type="text" name="adresse-entreprise-opco" class="form-control" id="adresse-entreprise-opco" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="code_postal-entreprise-opco" class="form-label">Code postal</label>
                                <input type="number" name="code_postal-entreprise-opco" class="form-control" id="code_postal-entreprise-opco" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ville-entreprise-opco" class="form-label">Ville</label>
                                <input type="text" name="ville-entreprise-opco" class="form-control" id="ville-entreprise-opco" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="siret-entreprise-opco" class="form-label">Siret</label>
                                <input type="text" name="siret-entreprise-opco" class="form-control" id="siret-entreprise-opco" required>
                            </div>
                            <div class="col-md-6">
                                <label for="naf-entreprise-opco" class="form-label">NAF</label>
                                <input type="text" name="naf-entreprise-opco" class="form-control" id="naf-entreprise-opco" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="BtnAddEntreprise()" name="create-entreprise">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal pour l'ajout d'un interlocuteur dans la liste des interlocuteurs -->
        <div class="modal fade" id="addInterlocuteur" tabindex="-1" aria-labelledby="addInterlocuteurLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="type_personne" class="form-label">Type</label>
                                <select class="form-select" aria-label="Default select example" id="type_personne" value="">
                                    <option selected>Interlocuteur administratif</option>
                                    <option>Interlocuteur OPCO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nom_personne" class="form-label">Nom</label>
                                <input type="text" name="nom_personne" class="form-control" id="nom_personne" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom_personne" class="form-label">Prénom</label>
                                <input type="text" name="prenom_personne" class="form-control" id="prenom_personne" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="email_personne" class="form-label">Email</label>
                                <input type="text" name="email_personne" class="form-control" id="email_personne" value="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tel_personne" class="form-label">Téléphone</label>
                                <input type="text" name="tel_personne" class="form-control" id="tel_personne" value="" required>
                            </div>
                        </div>
                        <!-- Masqué car pas besoin pour un interlocuteur
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kabis_personne" class="form-label">Kabis</label>
                                <input type="text" name="kabis_personne" class="form-control" id="kabis_personne" value="" required>
                            </div>
                            Masqué car pas besoin pour un interlocuteur
                            <div class="input-group mb-3 col-md-6">
                                <label class="input-group-text" for="cv_personne">CV</label>
                                <input type="file" class="form-control" id="cv_personne">
                            </div>
                        </div> 
                        -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="BtnAddInterlocuteur();" name="create-interlocuteur">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal pour l'ajout d'un responsable formation dans la liste des responsables formations -->
        <div class="modal fade" id="addRespFormation" tabindex="-1" aria-labelledby="addRespFormationLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="typeRespFormation" class="form-label">Type</label>
                                <input type="text" name="typeRespFormation" class="form-control" id="typeRespFormation" readonly="true" value="Responsable formation">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nomRespFormation" class="form-label">Nom</label>
                                <input type="text" name="nomRespFormation" class="form-control" id="nomRespFormation" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenomRespFormation" class="form-label">Prénom</label>
                                <input type="text" name="prenomRespFormation" class="form-control" id="prenomRespFormation" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="emailRespFormation" class="form-label">Email</label>
                                <input type="text" name="emailRespFormation" class="form-control" id="emailRespFormation" value="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telRespFormation" class="form-label">Téléphone</label>
                                <input type="text" name="telRespFormation" class="form-control" id="telRespFormation" value="" required>
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            Masqué car pas besoin pour un interlocuteur
                            <div class="col-md-6">
                                <label for="kabisRespFormation" class="form-label">Kabis</label>
                                <input type="text" name="kabisRespFormation" class="form-control" id="kabisRespFormation" value="" required>
                            </div>
                            Masqué car pas besoin pour un interlocuteur
                            <div class="input-group mb-3 col-md-6">
                                <label class="input-group-text" for="cvRespFormation">CV</label>
                                <input type="file" class="form-control" id="cvRespFormation">
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="BtnAddRespFormation();" name="create-resp-formation">Ajouter</button>
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
        Gestion de la liste des interlocuteurs en fonction 
        du choix de l'entreprise
    \*******************************************************/
    // déclaration des tableaux contenant les données de la personne
    <?php print($tabPersonneidEntOpco1);?>
    <?php print($tabPersonneType1);?>
    <?php print($tabPersonneNom1);?>
    <?php print($tabPersonnePrenom1);?>
    function SelectEntreprise(){
        // récupération du contenu du select Interlocuteur
        var selectInterlocuteur = document.getElementById("listeInterlocuteur");
        // récupération du contenu du select Entreprise
        var selectEntreprise = document.getElementById("listeEntreprise");
        // récupération da la valeur du select = ID_ENT_OPCO
        var idSelectEntreprise = selectEntreprise.value;
        // boucle sur le contenu de la table contenant les données de la personne
        for(i = 0; i < tabPersonneidEntOpco2.length; i++){
            // si l'id de la table Entreprise est égale à celle de la table personne
            // et que le type personne est égale à Interlocuteur alors
            // ajout de la personne dans la liste option du select Interlocuetur
            if(idSelectEntreprise == tabPersonneidEntOpco2[i] && (tabPersonneType2[i] == "Interlocuteur administratif" || tabPersonneType2[i] == "Interlocuteur OPCO")){
                var el = document.createElement("option");
                el.textContent = tabPersonnePrenom2[i]+" "+tabPersonneNom2[i];
                el.value = tabPersonneidEntOpco2[i];
                selectInterlocuteur.appendChild(el);
            }
        }
    }

    /*******************************************************\
        Gestion de l'ajout d'une entreprise dans la liste
        du choix de l'entreprise
    \*******************************************************/
    function BtnAddEntreprise(){
        // récupération du contenu du select
        var selectEntreprise = document.getElementById("listeEntreprise");
        // récupération du contenu
        var nomEntreprise = document.getElementById("nom_commercial").value;
        // ajout dans liste
        var el = document.createElement("option");
        el.textContent = nomEntreprise;
        el.value = nomEntreprise;
        selectEntreprise.appendChild(el);
    }

    /*******************************************************\
        Gestion de l'ajout d'un interlocuteur dans la liste
        du choix des interlocuteurs
    \*******************************************************/
    function BtnAddInterlocuteur(){
        // récupération du contenu du select
        var selectInterlocuteur = document.getElementById("listeInterlocuteur");
        // récupération du contenu
        var nomInterlocuteur = document.getElementById("nom_personne").value;
        var prenomInterlocuteur = document.getElementById("prenom_personne").value;
        // ajout dans liste
        var el = document.createElement("option");
        el.textContent = nomInterlocuteur+' '+prenomInterlocuteur;
        el.value = nomInterlocuteur+' '+prenomInterlocuteur;
        selectInterlocuteur.appendChild(el);
    }

    /*******************************************************\
        Gestion de l'ajout d'un responsable formation
        dans la liste du choix des responsables formations
    \*******************************************************/
    function BtnAddRespFormation(){
        // récupération du contenu du select
        var selectRespFormation = document.getElementById("listeRespFormation");
        // récupération du contenu
        var nomRespFormation = document.getElementById("nomRespFormation").value;
        var prenomRespFormation = document.getElementById("prenomRespFormation").value;
        // ajout dans liste
        var el = document.createElement("option");
        el.textContent = nomRespFormation+' '+prenomRespFormation;
        el.value = nomRespFormation+' '+prenomRespFormation;
        selectRespFormation.appendChild(el);
    }
    
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
        Gestion de la durée de la formation en jour : 
        - Calcul du nombre d'heure
        - Mise à jour de la zone "Dates de la formation"
    \*******************************************************/
    function DureeFormationJour(){
        // récupération du nombre de jour de formation déclaré
        var dureeFormationJour = parseFloat(document.getElementById("duree-formation-jour").value);
        // Mise à jour de la zone "Dates de la formation"
        var listeDatesFormation = ''; document.querySelector("#liste-dates-formation").innerHTML;
        //console.log(listeDatesFormation);
        // vérification si la durée de la formation en jour est un entier
        if (!Number.isInteger(+dureeFormationJour)) {
            // ajout des champs dates de formation
            nbJour = 0;
            for(i = 0; i <= dureeFormationJour; i++){
                nbJour ++;
                listeDatesFormation = listeDatesFormation + '<label for="labelDatesFormation' + nbJour + '" class="form-label">Jour ' + nbJour + '</label>';
                listeDatesFormation = listeDatesFormation + '<input type="date" class="form-control" required name="date-formation-jour' + nbJour + '">';
                document.querySelector("#liste-dates-formation").innerHTML = listeDatesFormation;
            }
        }
        // Supression des champs dates de formation
        if (dureeFormationJour == 0){
            document.querySelector("#liste-dates-formation").innerHTML = "";
        }
    }

    /*******************************************************\
        Gestion de la durée de la formation en heure : 
        - Recopie de la durée de la formation en heure dans 
        le champ "quantité du coût d'achat journalier de la 
        prestation du formateur"
    \*******************************************************/
    function DureeFormationHeure(){
        dureeFormationHeure = document.querySelector("#duree-formation-heure").value;
        document.querySelector("#qte-cout-achat-jour-presta").value = dureeFormationHeure;
    }

    /*******************************************************\
        Recopie du nombre de participants dans la phase
        Chiffrage dans les champs quantité du :
        - Coût d'achat des certifications
        - Coût d'achat journalier de la location de salle
    \*******************************************************/
    function CopyNbParticipants(){
        nbParticipants = document.querySelector("#nb_participants").value;
        document.querySelector("#qte-cout-achat-certifs").value = nbParticipants;
        document.querySelector("#qte-cout-achat-location").value = nbParticipants;
        document.querySelector("#qte-prix-vente-certifs").value = nbParticipants;
    }

    /*******************************************************\
        Gestion de la recopie des données de la formation
        en fonction de la formation sélectionnée
    \*******************************************************/
    // déclaration des tableaux contenant les données de la formation
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
    // calcul du Prix de vente journalier de la formation
    function TotalPrixVenteJourForm(){
        // récupération de la valeur du champ "montant"
        selectMontantVenteJour = document.getElementById("montant-prix-vente-jour-form");
        valeurMontantVenteJour = parseFloat(selectMontantVenteJour.value);
        // récupération de la valeur du champ "quantité"
        selectQteVenteJour = document.getElementById("qte-prix-vente-jour-form");
        valeurQteVenteJour = parseFloat(selectQteVenteJour.value);
        //calcul du total
        totalJourFormateur = valeurMontantVenteJour * valeurQteVenteJour;
        document.getElementById('total-prix-vente-jour-form').value = totalJourFormateur.toFixed(2);
    }
    // calcul du Prix de vente des supports de cours
    function TotalPrixVenteSupportsCours(){
        // récupération de la valeur du champ "montant"
        selectMontantVenteSupportsCours = document.getElementById("montant-prix-vente-supports-cours");
        valeurMontantVenteSupportsCours = parseFloat(selectMontantVenteSupportsCours.value);
        // récupération de la valeur du champ "quantité"
        selectQteVenteSupportsCours = document.getElementById("qte-prix-vente-supports-cours");
        valeurQteVenteSupportsCours = parseFloat(selectQteVenteSupportsCours.value);
        //calcul du total
        totalVenteSupportsCours = valeurMontantVenteSupportsCours * valeurQteVenteSupportsCours;
        document.getElementById('total-prix-vente-supports-cours').value = totalVenteSupportsCours.toFixed(2);
    }
    // calcul du Prix de vente des plateaux repas
    function TotalPrixVenteRepas(){
        // récupération de la valeur du champ "montant"
        selectMontantVenteRepas = document.getElementById("montant-prix-vente-repas");
        valeurMontantVenteRepas = parseFloat(selectMontantVenteRepas.value);
        // récupération de la valeur du champ "quantité"
        selectQteVenteRepas = document.getElementById("qte-prix-vente-repas");
        valeurQteVenteRepas = parseFloat(selectQteVenteRepas.value);
        //calcul du total
        totalVenteRepas = valeurMontantVenteRepas * valeurQteVenteRepas;
        document.getElementById('total-prix-vente-repas').value = totalVenteRepas.toFixed(2);
    }
    // calcul du prix de vente des certifications
    function TotalPrixVenteCertifs(){
        // récupération de la valeur du champ "montant" du Prix de vente des certifications"
        selectMontantVenteCertifs = document.getElementById("montant-prix-vente-certifs");
        valeurMontantVenteCertifs = selectMontantVenteCertifs.value;
        // récupération de la valeur du champ "quantité"
        selectQteVenteCertifs = document.getElementById("qte-prix-vente-certifs");
        valeurQteVenteCertifs = selectQteVenteCertifs.value;
        //calcul du total
        totalVenteCertif = valeurMontantVenteCertifs * valeurQteVenteCertifs;
        document.getElementById('total-prix-vente-certifs').value = totalVenteCertif.toFixed(2);
    }
    // calcul du prix de vente autres
    function TotalPrixVenteAutres(){
        // récupération de la valeur du champ "montant"
        selectMontantVenteAutres = document.getElementById("montant-prix-vente-autres");
        valeurMontantVenteAutres = selectMontantVenteAutres.value;
        // récupération de la valeur du champ "quantité"
        selectQteVenteAutres = document.getElementById("qte-prix-vente-autres");
        valeurQteVenteAutres = selectQteVenteAutres.value;
        //calcul du total
        totalVenteAutres = valeurMontantVenteAutres * valeurQteVenteAutres;
        document.getElementById('total-prix-vente-autres').value = totalVenteAutres.toFixed(2);
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
        totalVente = valeurTotalVenteJour + valeurTotalVenteSupportsCours + valeurTotalVenteRepas + valeurTotalVenteCertifs + valeurTotalVenteautres;
        document.getElementById('total-total-ventes').value = totalVente.toFixed(2);

        //recopie du total des ventes dans la synthèse
        document.getElementById('row-total-ventes').value = totalVente.toFixed(2);

        // calcul de la marge
        totalVentes = parseFloat(document.getElementById('total-total-ventes').value);
        marge = totalVentes - totalAchatsFonctionnement;
        document.getElementById('row-total-marge').value = marge.toFixed(2);
        totalMarge = parseFloat(document.getElementById('row-total-marge').value);
        margePourcentage = (totalMarge / totalVentes) * 100;
        document.getElementById('row-total-marge-pourcentage').value = margePourcentage.toFixed(2);
    }

    // calcul du Coût d'achat journalier de la prestation du formateur
    function TotalCoutAchatJourPresta(){
        // récupération de la valeur du champ "montant"
        selectMontantAchatJour = document.getElementById("montant-cout-achat-jour-presta");
        valeurMontantAchatJour = parseFloat(selectMontantAchatJour.value);
        // récupération de la valeur du champ "quantité"
        selectQteAchatJour = document.getElementById("qte-cout-achat-jour-presta");
        valeurQteAchatJour = parseFloat(selectQteAchatJour.value);
        //calcul du total
        totalJourPresta = valeurMontantAchatJour * valeurQteAchatJour;
        document.getElementById('total-cout-achat-jour-presta').value = totalJourPresta.toFixed(2);
    }
    // calcul du Coût d'achat des supports de cours
    function TotalCoutAchatSupportsCours(){
        // récupération de la valeur du champ "montant"
        selectMontantAchatSupportsCours = document.getElementById("montant-cout-achat-supports-cours");
        valeurMontantAchatSupportsCours = parseFloat(selectMontantAchatSupportsCours.value);
        // récupération de la valeur du champ "quantité"
        selectQteAchatSupportsCours = document.getElementById("qte-cout-achat-supports-cours");
        valeurQteAchatSupportsCours = parseFloat(selectQteAchatSupportsCours.value);
        //calcul du total
        totalAchatSupportsCours = valeurMontantAchatSupportsCours * valeurQteAchatSupportsCours;
        document.getElementById('total-cout-achat-supports-cours').value = totalAchatSupportsCours.toFixed(2);
    }
    // calcul du Coût d'achat des plateaux repas
    function TotalCoutAchatRepas(){
        // récupération de la valeur du champ "montant"
        selectMontantAchatRepas = document.getElementById("montant-cout-achat-repas");
        valeurMontantAchatRepas = parseFloat(selectMontantAchatRepas.value);
        // récupération de la valeur du champ "quantité"
        selectQteAchatRepas = document.getElementById("qte-cout-achat-repas");
        valeurQteAchatRepas = parseFloat(selectQteAchatRepas.value);
        //calcul du total
        totalAchatRepas = valeurMontantAchatRepas * valeurQteAchatRepas;
        document.getElementById('total-cout-achat-repas').value = totalAchatRepas.toFixed(2);
    }
    // calcul du Coût d'achat des certifications
    function TotalCoutAchatCertifs(){
        // récupération de la valeur du champ "montant"
        selectMontantAchatCertifs = document.getElementById("montant-cout-achat-certifs");
        valeurMontantAchatCertifs = selectMontantAchatCertifs.value;
        // récupération de la valeur du champ "quantité"
        selectQteAchatCertifs = document.getElementById("qte-cout-achat-certifs");
        valeurQteAchatCertifs = selectQteAchatCertifs.value;
        //calcul du total
        totalAchatCertifs = valeurMontantAchatCertifs * valeurQteAchatCertifs;
        document.getElementById('total-cout-achat-certifs').value = totalAchatCertifs.toFixed(2);
    }
    // calcul du Coût d'achat journalier de la location de salle
    function TotalCoutAchatLocation(){
        // récupération de la valeur du champ "montant"
        selectMontantAchatLoca = document.getElementById("montant-cout-achat-location");
        valeurMontantAchatLoca = selectMontantAchatLoca.value;
        // récupération de la valeur du champ "quantité"
        selectQteAchatLoca = document.getElementById("qte-cout-achat-location");
        valeurQteAchatLoca = selectQteAchatLoca.value;
        //calcul du total
        totalAchatLoca = valeurMontantAchatLoca * valeurQteAchatLoca;
        document.getElementById('total-cout-achat-location').value = totalAchatLoca.toFixed(2);
    }
    // calcul du Coût apport d'affaires
    function TotalCoutAchatAffaire(){
        // récupération de la valeur du champ "montant"
        selectMontantAchatAffaires = document.getElementById("montant-cout-achat-affaire");
        valeurMontantAchatAffaires = selectMontantAchatAffaires.value;
        // récupération de la valeur du champ "quantité"
        selectQteAchatAffaires = document.getElementById("qte-cout-achat-affaire");
        valeurQteAchatAffaires = selectQteAchatAffaires.options[selectQteAchatAffaires.selectedIndex].text;
        //calcul du total
        totalAchatAffaires = valeurMontantAchatAffaires * (valeurQteAchatAffaires / 100);
        document.getElementById('total-cout-achat-affaire').value = totalAchatAffaires.toFixed(2);
    }
    // calcul du prix de vente autres
    function TotalCoutAchatAutres(){
        // récupération de la valeur du champ "montant"
        selectMontantAchatAutres = document.getElementById("montant-cout-achat-autres");
        valeurMontantAchatAutres = selectMontantAchatAutres.value;
        // récupération de la valeur du champ "quantité"
        selectQteAchatAutres = document.getElementById("qte-cout-achat-autres");
        valeurQteAchatAutres = selectQteAchatAutres.value;
        //calcul du total
        totalAchatAutres = valeurMontantAchatAutres * valeurQteAchatAutres;
        document.getElementById('total-cout-achat-autres').value = totalAchatAutres.toFixed(2);
    }
    // calcul du total des achats
    function TotalAchat(){
        // récupération de la valeur du total Coût d'achat journalier de la prestation du formateur
        selectTotalAchatJour = document.getElementById("total-cout-achat-jour-presta");
        valeurTotalAchatJour = parseFloat(selectTotalAchatJour.value);
        // récupération de la valeur du total Coût d'achat des supports de cours
        selectTotalAchatSupportsCours = document.getElementById("total-cout-achat-supports-cours");
        valeurTotalAchatSupportsCours = parseFloat(selectTotalAchatSupportsCours.value);
        // récupération de la valeur du total Coût d'achat des plateaux repas
        selectTotalAchatRepas = document.getElementById("total-cout-achat-repas");
        valeurTotalAchatRepas = parseFloat(selectTotalAchatRepas.value);
        // récupération de la valeur du total Coût d'achat des certifications
        selectTotalAchatCertifs = document.getElementById("total-cout-achat-certifs");
        valeurTotalAchatCertifs = parseFloat(selectTotalAchatCertifs.value);
        // récupération de la valeur du total du Coût d'achat journalier de la location de salle
        selectTotalAchatLocation = document.getElementById("total-cout-achat-location");
        valeurTotalAchatLocation = parseFloat(selectTotalAchatLocation.value);
        // récupération de la valeur du total du Coût apport d'affaires
        selectTotalAchatAffaire = document.getElementById("total-cout-achat-affaire");
        valeurTotalAchatAffaire = parseFloat(selectTotalAchatAffaire.value);
        // récupération de la valeur de tous les champs total du Prix de vente autres
        selectTotalAchatautres = document.getElementById("total-cout-achat-autres");
        valeurTotalAchatautres = parseFloat(selectTotalAchatautres.value);

        // calcul du total de toutes les quantité du Prix de vente journalier de la formation
        totalAchat = valeurTotalAchatJour + valeurTotalAchatSupportsCours + valeurTotalAchatRepas + valeurTotalAchatCertifs + valeurTotalAchatLocation + valeurTotalAchatAffaire + valeurTotalAchatautres;
        document.getElementById('total-total-couts').value = totalAchat.toFixed(2);

        // calcul du total des achats + fonctionnement
        totalCoutFonctionnement = parseFloat(document.getElementById('cout-fonctionnement-total').value);
        totalAchatsFonctionnement = totalAchat + totalCoutFonctionnement;
        document.getElementById('row-total-achats-fonctionnement').value = totalAchatsFonctionnement.toFixed(2);

        // calcul de la marge
        totalVentes = parseFloat(document.getElementById('total-total-ventes').value);
        marge = totalVentes - totalAchatsFonctionnement;
        document.getElementById('row-total-marge').value = marge.toFixed(2);
        totalMarge = parseFloat(document.getElementById('row-total-marge').value);
        margePourcentage = (totalMarge / totalVentes) * 100;
        document.getElementById('row-total-marge-pourcentage').value = margePourcentage.toFixed(2);
    }

    // calcul du Coût administratif formation
    function TotalCoutAdminDuree(){
        // récupération de la valeur du champ "durée"
        selectAdminDuree = document.getElementById("cout-admin-form-duree");
        valeurAdminDuree = selectAdminDuree.options[selectAdminDuree.selectedIndex].text;
        // récupération de la valeur du champ "Coût Horaire"
        selectAdminCoutHoraire = document.getElementById("cout-admin-form-horaire");
        valeurAdminCoutHoraire = selectAdminCoutHoraire.value;
        //calcul du total
        totalCoutAdmin = (valeurAdminDuree / 60) * valeurAdminCoutHoraire;
        document.getElementById('cout-admin-form-montant').value = totalCoutAdmin.toFixed(2);
    }
    // calcul du Coût comptabilité
    function TotalCoutComptaDuree(){
        // récupération de la valeur du champ "durée"
        selectComptaDuree = document.getElementById("cout-compta-duree");
        valeurComptaDuree = selectComptaDuree.options[selectComptaDuree.selectedIndex].text;
        // récupération de la valeur du champ "Coût Horaire"
        selectComptaCoutHoraire = document.getElementById("cout-compta-horaire");
        valeurComptaCoutHoraire = selectComptaCoutHoraire.value;
        //calcul du total
        totalCoutCompta = (valeurComptaDuree / 60) * valeurComptaCoutHoraire;
        document.getElementById('cout-compta-montant').value = totalCoutCompta.toFixed(2);
    }
    // calcul du Coût service informatique
    function TotalCoutServiceInformatiqueDuree(){
        // récupération de la valeur du champ "durée"
        selectServiceInformatiqueDuree = document.getElementById("cout-service-informatique-duree");
        valeurServiceInformatiqueDuree = selectServiceInformatiqueDuree.options[selectServiceInformatiqueDuree.selectedIndex].text;
        // récupération de la valeur du champ "Coût Horaire"
        selectServiceInformatiqueCoutHoraire = document.getElementById("cout-service-informatique-horaire");
        valeurServiceInformatiqueCoutHoraire = selectServiceInformatiqueCoutHoraire.value;
        //calcul du total
        totalCoutServiceInformatique = (valeurServiceInformatiqueDuree / 60) * valeurServiceInformatiqueCoutHoraire;
        document.getElementById('cout-service-informatique-montant').value = totalCoutServiceInformatique.toFixed(2);
    }
    // calcul du Coût autres
    function TotalCoutAutresDuree(){
        // récupération de la valeur du champ "durée"
        selectAutresDuree = document.getElementById("cout-autres-duree");
        valeurAutresDuree = selectAutresDuree.options[selectAutresDuree.selectedIndex].text;
        // récupération de la valeur du champ "Coût Horaire"
        selectAutresCoutHoraire = document.getElementById("cout-autres-horaire");
        valeurAutresCoutHoraire = selectAutresCoutHoraire.value;
        //calcul du total
        totalCoutAutres = (valeurAutresDuree / 60) * valeurAutresCoutHoraire;
        document.getElementById('cout-autres-montant').value = totalCoutAutres.toFixed(2);
    }
    // calcul du total des des coûts de fonctionnement
    function TotalFonctionnement(){
        // récupération de la valeur du total Coût administratif formation
        selectTotalAdmin = document.getElementById("cout-admin-form-montant");
        valeurTotalAdmin = parseFloat(selectTotalAdmin.value);
        // récupération de la valeur du total Coût comptabilité
        selectTotalCompta = document.getElementById("cout-compta-montant");
        valeurTotalCompta = parseFloat(selectTotalCompta.value);
        // récupération de la valeur du total Coût service informatique
        selectTotalServiceInformatique = document.getElementById("cout-service-informatique-montant");
        valeurTotalServiceInformatique = parseFloat(selectTotalServiceInformatique.value);
        // récupération de la valeur du total des autres coûts
        selectTotalAutres = document.getElementById("cout-autres-montant");
        valeurTotalAutres = parseFloat(selectTotalAutres.value);

        //calcul du total de tous les montants des coûts de fonctionnement
        totalCoutFonctionnement = valeurTotalAdmin + valeurTotalCompta + valeurTotalServiceInformatique + valeurTotalAutres;
        document.getElementById('cout-fonctionnement-total').value = totalCoutFonctionnement.toFixed(2);

        //calcul du total des achats + fonctionnement
        totalAchat = parseFloat(document.getElementById('total-total-couts').value);
        totalAchatsFonctionnement = totalAchat + totalCoutFonctionnement;
        document.getElementById('row-total-achats-fonctionnement').value = totalAchatsFonctionnement.toFixed(2);

        // calcul de la marge
        totalVentes = parseFloat(document.getElementById('total-total-ventes').value);
        marge = totalVentes - totalAchatsFonctionnement;
        document.getElementById('row-total-marge').value = marge.toFixed(2);
        totalMarge = parseFloat(document.getElementById('row-total-marge').value);
        margePourcentage = (totalMarge / totalVentes) * 100;
        document.getElementById('row-total-marge-pourcentage').value = margePourcentage.toFixed(2);
    }

    function EditDevis(){
        window.location = "../offre-commerciale";
    }
</script>