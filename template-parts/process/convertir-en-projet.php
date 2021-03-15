<!-- Page du processus de création d'un devis -->
<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_sites contenant les lieux de formations
    $lesLieuxFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));
    // récupération des données de la table wp_listeformation contenant les formations
    $formations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_listeformation'));
    // récupération des données de la table wp_projets contenant les devis
    $lesDevis = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_devis_test'));
    // récupération des données de la table wp_projets contenant les devis
    $lesProjets = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_projets'));
    // récupération des données de la table wp_projets contenant les devis
    $lesPersonnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_personnes'));
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
        // création du nouveau projet dans la BDD
        $numProjet          =$_POST['num_projet'];
        $libForm            =$_POST['lib_form'];
        $societe            =$_POST['societe'];
        $statutProjet       =$_POST['statut_projet'];
        $datesForm          =$_POST['dates_form'];
        $nbStagiaires       =$_POST['nb_stagiaires'];
        // ajout des données dans la table
        $wpdb->insert('wp_projets', 
            array(
                'NUM_PROJET'        =>$numProjet,
                'LIB_FORM'          =>$libForm,
                'SOCIETE'           =>$societe,
                'STATUT_PROJET'     =>$statutProjet,
                'DATES_FORM'        =>$datesForm,
                'NB_STAGIAIRES'     =>$nbStagiaires
            )
        );
        echo "<>window.location = '".site_url("/projets")."'</>";
    }
?>
<?php get_header()?>
<div class="main">
    <h1 id="title_projet">
        <?php //the_title() ?>
        Liste des Projets
    </h1>
    <form class="row" method="POST" enctype="multipart/form-data">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-projet" role="tabpanel" aria-labelledby="nav-projet-tab">    
                <div class="convert_en_project" id="convert_en_project"> 
                    <div class="col-md-6">
                        <!-- Zone du choix du devis à convertir en projet -->
                        <div class="input-group mb-3">
                            <span class="input-group-text">Devis n°</span>
                            <select class="form-select" aria-label="Default select example" onchange="change_valeur();" id="liste_devis" name="liste_devis" required>
                                <option selected></option>
                                <!-- récupération des n° de devis -->
                                <?php 
                                    $selectForm = "";
                                    $tabIdDevis1        = "var tabIdDevis2 = Array()\n";
                                    $tabNumForm1        = "var tabNumForm2 = Array()\n";
                                    $tabNomForm1        = "var tabNomForm2 = Array()\n";
                                    $tabSociete1        = "var tabSociete2 = Array()\n";
                                    $tabStatutDevis1    = "var tabStatutDevis2 = Array()\n";
                                    $tabDatesForm1      = "var tabDatesForm2 = Array()\n";
                                    $tabNbStagiaire1    = "var tabNbStagiaire2 = Array()\n";
                                    foreach ($lesDevis as $leDevis):
                                    $idDevis        = $leDevis->ID_DEVIS;
                                    $numDevis        = $leDevis->NUM_FORM;
                                    $nomForm        =  $leDevis->NOM_FORM ;
                                    $societe        = $leDevis->SOCIETE;
                                    $statutDevis    =  $leDevis->STATUT_DEVIS;
                                    $datesForm      = $leDevis->DATES_FORM;
                                    $nbStagiaire    =  $leDevis->NB_STAGIAIRES;
                                    $numDevisExist  = "non";
                                        foreach ($lesProjets as $leProjet):
                                            $numProjet = $leProjet->NUM_PROJET;
                                            if($numDevis == $numProjet){
                                                $numDevisExist = "oui";
                                            }
                                        endforeach;   
                                        if($numDevisExist == "non" && $statutDevis == "Validé"){
                                            $selectForm         = $selectForm . "<option value=".$idDevis.">".$numDevis."</option>";
                                            $tabIdDevis1        = $tabIdDevis1."tabIdDevis2[".$idDevis."]='".$idDevis."'\n";
                                            $tabNumForm1        = $tabNumForm1."tabNumForm2[".$idDevis."]='".$numDevis."'\n";
                                            $tabNomForm1        = $tabNomForm1."tabNomForm2[".$idDevis."]='".$nomForm."'\n";
                                            $tabSociete1        = $tabSociete1."tabSociete2[".$idDevis."]='".$societe."'\n";
                                            $tabStatutDevis1    = $tabStatutDevis1."tabStatutDevis2[".$idDevis."]='".$statutDevis."'\n";
                                            $tabDatesForm1      = $tabDatesForm1."tabDatesForm2[".$idDevis."]='".$datesForm."'\n";
                                            $tabNbStagiaire1    = $tabNbStagiaire1."tabNbStagiaire2[".$idDevis."]='".$nbStagiaire."'\n";
                                            $tabIdDevis2[$idDevis]      =$idDevis;
                                            $tabNumForm2[$idDevis]      =$numDevis;
                                            $tabNomForm2[$idDevis]      =$nomForm;
                                            $tabSociete2[$idDevis]      =$societe;
                                            $tabStatutDevis2[$idDevis]  =$statutDevis;
                                            $tabDatesForm2[$idDevis]    =$datesForm;
                                            $tabNbStagiaire2[$idDevis]  =$nbStagiaire;
                                        }  
                                    endforeach;
                                    print $selectForm
                                ?>
                            </select>
                            <span class="input-group-text" id="link_convert_project">
                                <button type="button" onclick="AffProcessProject()" class="btn btn-primary">Convertir en projet</button>    
                                <!--
                                <a href="<?php //echo site_url(); ?>/creer-un-projet">
                                    <i class="bi bi-arrow-bar-right">Convertir en projet</i>
                                </a>
                                -->
                            </span>
                        </div>
                    </div>
                    <!-- input de récupération des données du devis sélectionné mais caché -->
                    <div class="d-none">
                        <input type="text" name="num_devis" class="form-control" id="num_devis">
                        <input type="text" name="nom_devis" class="form-control" id="nom_devis">
                        <input type="text" name="societe" class="form-control" id="societe">
                        <input type="text" name="statut_devis" class="form-control" id="statut_devis">
                        <input type="text" name="dates_form" class="form-control" id="dates_form">
                        <input type="text" name="nb_stagiaire" class="form-control" id="nb_stagiaire">
                    </div>
                    <!-- Zone d'affichage de l'alerte de choix d'un devis à convertir -->
                    <div class="alert alert-danger d-none" id="alert_convert" role="alert">
                        Veuillez sélectionner un devis !
                    </div>
                    <!-- tableau de récap des projets -->
                    <div class="table">
                        <table class="table table-striped table-hover">
                            <!-- dénomination des titres du tableau -->
                            <thead>
                                <tr>
                                    <th>N° Projet</th>
                                    <th>Libellé</th>
                                    <th>Société</th>
                                    <th>Statut</th>
                                    <th>Dates de formation</th>
                                    <th>Nb stagiaires</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- alimentation des lignes du tableau -->   
                            <tbody>
                                <?php foreach ($lesDevis as $leDevis):
                                    $statutDevis = $leDevis->STATUT_DEVIS;
                                if($statutDevis == "En projet" ||  $statutDevis == "En cours"){
                                ?>
                                    <tr>
                                        <td><?php echo  $leDevis->NUM_FORM ;?></td>
                                        <td><?php echo  $leDevis->NOM_FORM ;?></td>
                                        <td><?php echo  $leDevis->SOCIETE;?></td>
                                        <td> <?php echo  $leDevis->STATUT_DEVIS;?></td>
                                        <td><?php echo  $leDevis->DATES_FORM;?></td>
                                        <td><?php echo  $leDevis->NB_STAGIAIRES;?></td>
                                        <td>
                                            <span title="Visulaiser le projet" >
                                                <a href="#" >
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            </span>
                                            <span title="Modifier le projet" >
                                                <a href="#" >
                                                    <i class="bi bi-pencil-square" ></i>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                <?php } endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div> 
                <div class="d-none" id="process_project">
                    <nav>
                        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-formateur-tab" data-bs-toggle="tab" data-bs-target="#nav-formateur" type="button" role="tab" aria-controls="nav-formateur" aria-selected="false">Formateur</button>
                            <button class="nav-link" id="nav-stagiaires-tab" data-bs-toggle="tab" data-bs-target="#nav-stagiaires" type="button" role="tab" aria-controls="nav-stagiaires" aria-selected="false">Stagiaires</button>
                            <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="false">Documents</button>
                            <button class="nav-link" id="nav-documents-signes-tab" data-bs-toggle="tab" data-bs-target="#nav-documents-signes" type="button" role="tab" aria-controls="nav-documents-signes" aria-selected="false">Documents Signés</button>
                            <button class="nav-link" id="nav-facture-tab" data-bs-toggle="tab" data-bs-target="#nav-facture" type="button" role="tab" aria-controls="nav-facture" aria-selected="false">Facture</button>
                        </div>
                    </nav>
                    <!-- Tableau du rappel du projet en cours de création -->
                    <div class="table">
                        <table class="table table-striped table-hover">
                            <!-- dénomination des titres du tableau -->
                            <thead>
                                <tr>
                                    <th>N° Projet</th>
                                    <th>Libellé</th>
                                    <th>Société</th>
                                    <!-- <th>Statut</th> -->
                                    <th>Dates de formation</th>
                                    <th>Nb stagiaires</th>
                                </tr>
                            </thead>
                            <!-- alimentation des lignes du tableau -->   
                            <tbody id="table_devis_converti">
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <!-- Contenu de l'onglet Formateur -->
                        <div class="tab-pane fade show active" id="nav-formateur" role="tabpanel" aria-labelledby="nav-formateur-tab">
                            <!-- Ajouter un formateur-->
                            <h3>Ajout de formateur(s)</h3>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Formateur</span>
                                <select class="form-select" aria-label="Default select example" id="nom_formateur" name="nom_formateur">
                                    <option selected></option>
                                    <?php 
                                        $selectForm = "";
                                        $tabIdFormateur1 = "var tabIdFormateur2 = Array()\n";
                                        $tabNomFormateur1 = "var tabNomFormateur2 = Array()\n";
                                        $tabPrenomFormateur1 = "var tabPrenomFormateur2 = Array()\n";
                                        $tabEmailFormateur1 = "var tabEmailFormateur2 = Array()\n";  
                                        $tabTelFormateur1 = "var tabTelFormateur2 = Array()\n";                  
                                        foreach ($lesPersonnes as $laPersonne):
                                            $idPersonne     = $laPersonne->ID_PERSONNE;
                                            $nomPersonne    = $laPersonne->NOM_PERSONNE;
                                            $typePersonne   = $laPersonne->TYPE_PERSONNE;
                                            $prenomPersonne = $laPersonne->PRENOM_PERSONNE;
                                            $emailPersonne  = $laPersonne->EMAIL_PERSONNE;
                                            $telPersonne    = $laPersonne->TEL_PERSONNE;
                                            if($typePersonne == "Formateur"){
                                                $selectForm = $selectForm . "<option value=".$idPersonne.">".$nomPersonne." ".$prenomPersonne."</option>";
                                                $tabIdFormateur1        = $tabIdFormateur1."tabIdFormateur2[".$idPersonne."]='".$idPersonne."'\n";
                                                $tabNomFormateur1       = $tabNomFormateur1."tabNomFormateur2[".$idPersonne."]='".$nomPersonne."'\n";
                                                $tabPrenomFormateur1    = $tabPrenomFormateur1."tabPrenomFormateur2[".$idPersonne."]='".$prenomPersonne."'\n";
                                                $tabEmailFormateur1     = $tabEmailFormateur1."tabEmailFormateur2[".$idPersonne."]='".$emailPersonne."'\n";
                                                $tabTelFormateur1       = $tabTelFormateur1."tabTelFormateur2[".$idPersonne."]='".$telPersonne."'\n";
                                                $tabIdFormateur2[$idPersonne]       = $idPersonne;
                                                $tabNomFormateur2[$idPersonne]      = $nomPersonne;
                                                $tabPrenomFormateur2[$idPersonne]   = $prenomPersonne;
                                                $tabEmailFormateur2[$idPersonne]    = $emailPersonne;
                                                $tabTelFormateur2[$idPersonne]      = $telPersonne;
                                            }
                                        endforeach;
                                        print $selectForm;
                                    ?>
                                </select>
                                <span class="input-group-text">
                                    <button class="btn btn-primary" type="button" onclick="AddFormateur()" name="ajout-formateur" id="ajout-formateur">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <!-- Zone d'affichage de l'alerte de choix d'un formateur-->
                            <div class="alert alert-danger d-none" id="alert_add_formateur" role="alert">
                                Veuillez sélectionner un formateur !
                            </div>
                            <!-- FIN de Ajouter un formateur-->
                            <div class="table">
                                <table class="table table-striped table-hover" id="table_formateur">
                                    <!-- dénomination des titres du tableau -->
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- alimentation des lignes du tableau -->   
                                    <tbody id="listeFormateurs">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Contenu de l'onglet Stagiaires -->            
                        <div class="tab-pane fade" id="nav-stagiaires" role="tabpanel" aria-labelledby="nav-stagiaires-tab">
                            <!-- Ajouter un stagiaire-->
                            <h3>Ajout de stagiaire(s)</h3>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Stagiaires</span>
                                <select class="form-select" aria-label="Default select example" id="nom_stagiaire" name="nom_stagiaire">
                                    <option selected></option>
                                        <?php 
                                            $selectForm = "";
                                            $tabIdStagiaire1 = "var tabIdStagiaire2 = Array()\n";
                                            $tabNomStagiaire1 = "var tabNomStagiaire2 = Array()\n";
                                            $tabPrenomStagiaire1 = "var tabPrenomStagiaire2 = Array()\n";
                                            $tabEmailStagiaire1 = "var tabEmailStagiaire2 = Array()\n";  
                                            $tabTelStagiaire1 = "var tabTelStagiaire2 = Array()\n";                  
                                            foreach ($lesPersonnes as $laPersonne):
                                                $idPersonne     = $laPersonne->ID_PERSONNE;
                                                $nomPersonne    = $laPersonne->NOM_PERSONNE;
                                                $typePersonne   = $laPersonne->TYPE_PERSONNE;
                                                $prenomPersonne = $laPersonne->PRENOM_PERSONNE;
                                                $emailPersonne  = $laPersonne->EMAIL_PERSONNE;
                                                $telPersonne    = $laPersonne->TEL_PERSONNE;
                                                if($typePersonne == "Stagiaire"){
                                                    $selectForm = $selectForm . "<option value=".$idPersonne.">".$nomPersonne." ".$prenomPersonne."</option>";
                                                    $tabIdStagiaire1        = $tabIdStagiaire1."tabIdStagiaire2[".$idPersonne."]='".$idPersonne."'\n";
                                                    $tabNomStagiaire1       = $tabNomStagiaire1."tabNomStagiaire2[".$idPersonne."]='".$nomPersonne."'\n";
                                                    $tabPrenomStagiaire1    = $tabPrenomStagiaire1."tabPrenomStagiaire2[".$idPersonne."]='".$prenomPersonne."'\n";
                                                    $tabEmailStagiaire1     = $tabEmailStagiaire1."tabEmailStagiaire2[".$idPersonne."]='".$emailPersonne."'\n";
                                                    $tabTelStagiaire1       = $tabTelStagiaire1."tabTelStagiaire2[".$idPersonne."]='".$telPersonne."'\n";
                                                    $tabIdStagiaire2[$idPersonne]       = $idPersonne;
                                                    $tabNomStagiaire2[$idPersonne]      = $nomPersonne;
                                                    $tabPrenomStagiaire2[$idPersonne]   = $prenomPersonne;
                                                    $tabEmailStagiaire2[$idPersonne]    = $emailPersonne;
                                                    $tabTelStagiaire2[$idPersonne]      = $telPersonne;
                                                }
                                            endforeach;
                                            print $selectForm;
                                        ?>
                                </select>
                                <span class="input-group-text">
                                    <button class="btn btn-primary" type="button" onclick="AddStagiaire()" name="ajout-stagiaire" id="ajout-stagiaire">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <!-- Zone d'affichage de l'alerte de choix d'un stagiaire-->
                            <div class="alert alert-danger d-none" id="alert_add_stagiaire" role="alert">
                                Veuillez sélectionner un stagiaire !
                            </div>
                            <!-- FIN de Ajouter un stagiaire-->
                            <div class="table">
                                <table class="table table-striped table-hover" id="table_stagiaire">
                                    <!-- dénomination des titres du tableau -->
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- alimentation des lignes du tableau -->   
                                    <tbody id="listeStagiaires">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Contenu de l'onglet Documents -->            
                        <div class="tab-pane fade" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
                            <!-- Ajouter des documents-->
                            <h3>Édition des documents</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Éditer l'ensemble des documents</label>
                            </div>
                            <h3>Édition des documents individuels</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Le nombre de stagiaires aura cette valeur
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Lettre de commande
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Convocation à une formation
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Feuille d'émargement
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Informations stagiaires et réglement intérieur
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Validation des acquis en formation
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Évaluation de la formation
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Attestation de formation
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Fiche suivi de projet
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Fiche suivi technique de projet
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Programme de formation
                                </label>
                            </div>
                            <div class="d-grid gap-2 d-md-flex">
                                <button class="btn btn-primary" type="button">éditer</button>
                            </div>
                        </div>
                        <!-- Contenu de l'onglet Documents Signés -->            
                        <div class="tab-pane fade" id="nav-documents-signes" role="tabpanel" aria-labelledby="nav-documents-signes-tab">
                            <h3>Déposer les documents</h3>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="convention_formation">Convention de formation</label>
                                <input type="file" class="form-control" id="convention_formation">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="lettre_commande">Lettre de commande</label>
                                <input type="file" class="form-control" id="lettre_commande">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="convocation_formation">Convocation à une formation</label>
                                <input type="file" class="form-control" id="convocation_formation">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="feuille_emargement">Feuille d'émargement</label>
                                <input type="file" class="form-control" id="feuille_emargement">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="infos_reglement">Informations stagiaires et réglement intérieur</label>
                                <input type="file" class="form-control" id="infos_reglement">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="valid_acquis">Validation des acquis en formation</label>
                                <input type="file" class="form-control" id="valid_acquis">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="eval_formation">Évaluation de la formation</label>
                                <input type="file" class="form-control" id="eval_formation">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="attestation_formation">Attestation de formation</label>
                                <input type="file" class="form-control" id="attestation_formation">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="fiche_suivi_projet">Fiche suivi de projet</label>
                                <input type="file" class="form-control" id="fiche_suivi_projet">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="fiche_suivi_technique">Fiche suivi technique de projet</label>
                                <input type="file" class="form-control" id="fiche_suivi_technique">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary documents-signes" for="program_formation">Programme de formation</label>
                                <input type="file" class="form-control" id="program_formation">
                            </div>
                        </div>
                        <!-- Contenu de l'onglet Facture -->            
                        <div class="tab-pane fade" id="nav-facture" role="tabpanel" aria-labelledby="nav-facture-tab">
                            <h3>Déposer la facture</h3>
                            <div class="input-group mb-3">
                                <label class="input-group-text btn-secondary" for="inputGroupFile01">Facture</label>
                                <input type="file" class="form-control" id="inputGroupFile01">
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </form>
</div>

<script>
    /*******************************************************\
        Alimentation de champs cachés avec les données
        du devis sélectionné
    \*******************************************************/
    <?php print($tabIdDevis1);?>
    <?php print($tabNumForm1);?>
    <?php print($tabNomForm1);?>
    <?php print($tabSociete1);?>
    <?php print($tabStatutDevis1);?>
    <?php print($tabDatesForm1);?>
    <?php print($tabNbStagiaire1);?>
    function change_valeur() {
        monSelect   = document.getElementById("liste_devis");
        valueSelect = monSelect.value;
        idDevis     = tabIdDevis2[valueSelect];
        numDevis    = tabNumForm2[valueSelect];
        nomForm     = tabNomForm2[valueSelect] ;
        societe     = tabSociete2[valueSelect];
        statutDevis = tabStatutDevis2[valueSelect];
        datesForm   = tabDatesForm2[valueSelect];
        nbStagiaire = tabNbStagiaire2[valueSelect];
        document.getElementById("num_devis").value = numDevis;
        document.getElementById("nom_devis").value = nomForm;
        document.getElementById("societe").value = societe;
        document.getElementById("statut_devis").value = "En projets";
        document.getElementById("dates_form").value = datesForm;
        document.getElementById("nb_stagiaire").value = nbStagiaire;
    }
    /*******************************************************\
            Gestion de l'affichage du process projet
    \*******************************************************/
    function AffProcessProject(){
        monSelect   = document.getElementById("liste_devis");
        valueSelect = monSelect.value;
        idDevis     = tabIdDevis2[valueSelect];
        numDevis    = tabNumForm2[valueSelect];
        nomForm     = tabNomForm2[valueSelect] ;
        societe     = tabSociete2[valueSelect];
        statutDevis = tabStatutDevis2[valueSelect];
        datesForm   = tabDatesForm2[valueSelect];
        nbStagiaire = tabNbStagiaire2[valueSelect];
        if(valueSelect){
            // gestion de l'affichage des données
            document.getElementById('convert_en_project').className = "d-none";
            document.getElementById('process_project').className = "d-block";
            document.getElementById('alert_convert').className = " alert alert-danger d-none";
            // recopie des données du devis dans le tableau
            var tabDevisConverti = document.querySelector("#table_devis_converti").innerHTML;
            if(valueSelect){
                tabDevisConverti = tabDevisConverti + '<tr>';
                tabDevisConverti = tabDevisConverti + '<td>'+numDevis+'</td>';
                tabDevisConverti = tabDevisConverti + '<td>'+nomForm+'</td>';
                tabDevisConverti = tabDevisConverti + '<td>'+societe+'</td>';
                //tabDevisConverti = tabDevisConverti + '<td>'+statutDevis+'</td>';
                tabDevisConverti = tabDevisConverti + '<td>'+datesForm+'</td>';
                tabDevisConverti = tabDevisConverti + '<td>'+nbStagiaire+'</td>';
                tabDevisConverti = tabDevisConverti + '</tr>';
                
                document.querySelector("#table_devis_converti").innerHTML = tabDevisConverti;
                // modification du titre de la page
                document.querySelector("#title_projet").innerHTML = "Réalisation d'un projet";
            }
        } else {
            // affichage d'une alerte si pas de devis sélectionné
            document.getElementById('alert_convert').className = " alert alert-danger d-block";
        }
    }
    
    /*******************************************************\
                Gestion de l'ajout d'un formateur
    \*******************************************************/
    <?php print($tabIdFormateur1);?>
    <?php print($tabNomFormateur1);?>
    <?php print($tabPrenomFormateur1);?>
    <?php print($tabEmailFormateur1);?>
    <?php print($tabTelFormateur1);?>

    function AddFormateur() {
        // récupération des données de la sélection du formateur à ajouter
        monSelect = document.getElementById("nom_formateur");
        valueSelect = monSelect.value;
        var tabFormateur = document.querySelector("#listeFormateurs").innerHTML;
        if(valueSelect){
            tabFormateur = tabFormateur + '<tr><td>'+tabNomFormateur2[valueSelect]+'</td>';
            tabFormateur = tabFormateur + '<td>'+tabPrenomFormateur2[valueSelect]+'</td>';
            tabFormateur = tabFormateur + '<td>'+tabEmailFormateur2[valueSelect]+'</td>';
            tabFormateur = tabFormateur + '<td>'+tabTelFormateur2[valueSelect]+'</td>';
            tabFormateur = tabFormateur + '<td class="table-td-action" id="'+tabIdFormateur2[valueSelect]+'">';
            tabFormateur = tabFormateur + '<span class="bt-supprimer" title="Enlever le formateur de la liste">';
            tabFormateur = tabFormateur + '<a href="#"><i class="bi bi-x"></i></a>';
            tabFormateur = tabFormateur + '</td></span></tr>';
            
            document.querySelector("#listeFormateurs").innerHTML = tabFormateur;
            // masquage de l'alerte si formateur sélectionné
            document.getElementById('alert_add_formateur').className = " alert alert-danger d-none";
        } else {
            // affichage de l'alerte si pas de formateur sélectionné
            document.getElementById('alert_add_formateur').className = " alert alert-danger d-block";
        }
    }

    /*******************************************************\
                Gestion de l'ajout d'un stagiaire
    \*******************************************************/
    <?php print($tabIdStagiaire1);?>
    <?php print($tabNomStagiaire1);?>
    <?php print($tabPrenomStagiaire1);?>
    <?php print($tabEmailStagiaire1);?>
    <?php print($tabTelStagiaire1);?>

    function AddStagiaire() {
        // récupération des données de la sélection du stagiaire à ajouter
        monSelect = document.getElementById("nom_stagiaire");
        valueSelect = monSelect.value;
        var tabStagiaire = document.querySelector("#listeStagiaires").innerHTML;
        if(valueSelect){
            tabStagiaire = tabStagiaire + '<tr><td>'+tabNomStagiaire2[valueSelect]+'</td>';
            tabStagiaire = tabStagiaire + '<td>'+tabPrenomStagiaire2[valueSelect]+'</td>';
            tabStagiaire = tabStagiaire + '<td>'+tabEmailStagiaire2[valueSelect]+'</td>';
            tabStagiaire = tabStagiaire + '<td>'+tabTelStagiaire2[valueSelect]+'</td>';
            tabStagiaire = tabStagiaire + '<td class="table-td-action" id="'+tabIdStagiaire2[valueSelect]+'">';
            tabStagiaire = tabStagiaire + '<span class="bt-supprimer" title="Enlever le stagiaire de la liste">';
            tabStagiaire = tabStagiaire + '<a href="#"><i class="bi bi-x"></i></a>';
            tabStagiaire = tabStagiaire + '</td></span></tr>';
            
            document.querySelector("#listeStagiaires").innerHTML = tabStagiaire;
            // masquage de l'alerte si stagiaire sélectionné
            document.getElementById('alert_add_stagiaire').className = " alert alert-danger d-none";
        } else {
            // affichage d'une alerte si pas de stagiaire sélectionné
            document.getElementById('alert_add_stagiaire').className = " alert alert-danger d-block";
        }
    }
</script>
<?php get_footer(); ?>