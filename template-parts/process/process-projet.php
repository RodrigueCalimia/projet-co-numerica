<!-- Page du processus de création d'un devis -->
<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_sites contenant les lieux de formations
    $lesLieuxFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));
    // récupération des données de la table wp_listeformation contenant les formations
    $formations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_listeformation'));
    // récupération des données de la table wp_projets contenant les devis
    $lesDevis = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_devis'));
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
        echo "<>window.location = '".site_url("/les-projets")."'</>";
    }
?>

<?php get_header()?>
<div class="main">
    <h1><?php get_the_title() ?></h1>
    <!-- nav tabs -->
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
                    <th>Statut</th>
                    <th>Dates de formation</th>
                    <th>Nb stagiaires</th>
                </tr>
            </thead>
            <!-- alimentation des lignes du tableau -->   
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <form class="row" method="POST">
        <div class="tab-content" id="nav-tabContent">
            <!-- Contenu de l'onglet Formateur -->
            <div class="tab-pane fade show active" id="nav-formateur" role="tabpanel" aria-labelledby="nav-formateur-tab">
                <!-- Ajouter un formateur-->
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
                
            </div>
            <!-- Contenu de l'onglet Documents Signés -->            
            <div class="tab-pane fade" id="nav-documents-signes" role="tabpanel" aria-labelledby="nav-documents-signes-tab">
                
            </div>
            <!-- Contenu de l'onglet Facture -->            
            <div class="tab-pane fade" id="nav-facture" role="tabpanel" aria-labelledby="nav-facture-tab">
                
            </div>
        </div>
    </form>
</div>

<script>
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
        }
    }
</script>

<?php get_footer(); ?>