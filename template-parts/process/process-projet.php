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

<div class="main">
    <h1><?php get_the_title() ?></h1>
    <!-- nav tabs -->
    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-formateur-tab" data-bs-toggle="tab" data-bs-target="#nav-formateur" type="button" role="tab" aria-controls="nav-formateur" aria-selected="false">Formateur</button>
            <button class="nav-link" id="nav-stagiaires-tab" data-bs-toggle="tab" data-bs-target="#nav-stagiaires" type="button" role="tab" aria-controls="nav-stagiaires" aria-selected="false">Stagiaires</button>
            <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="false">Documents</button>
            <button class="nav-link" id="nav-documents-signes-tab" data-bs-toggle="tab" data-bs-target="#nav-documents-signes" type="button" role="tab" aria-controls="nav-documents-signes" aria-selected="false">Documents Signés</button>
            <button class="nav-link" id="nav-facture-tab" data-bs-toggle="tab" data-bs-target="#nav-facture" type="button" role="tab" aria-controls="nav-facture" aria-selected="false">Facture</button>
        </div>
    </nav>

    <form class="row" method="POST">
        <div class="tab-content" id="nav-tabContent">
            <!-- Contenu de l'onglet Formateur -->
            <div class="tab-pane fade show active" id="nav-formateur" role="tabpanel" aria-labelledby="nav-formateur-tab">
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
                <!-- Ajouter un formateur-->
                <div class="input-group mb-3">
                    <span class="input-group-text">Formateur</span>
                    <select class="form-select" aria-label="Default select example" id="formateur" name="nomFormateur">
                        <option selected></option>
                        <?php 
                            $selectForm = "";
                            $tabNomFormateur1 = "var tabNomFormateur2 = Array()\n";
                            $tabPrenomFormateur1 = "var tabPrenomFormateur2 = Array()\n";
                            $tabEmailFormateur1 = "var tabEmailFormateur2 = Array()\n";  
                            $tabTelFormateur1 = "var tabTelFormateur2 = Array()\n";                  
                            foreach ($lesPersonnes as $laPersonne):
                                $typePersonne = $laPersonne->TYPE_PERSONNE;
                                if($typePersonne=="formateur"){
                                    $selectForm = $selectForm . "<option value=".$laPersonne->ID_PERSONNE.">".$laPersonne->NOM_PERSONNE." ".$laPersonne->PRENOM_PERSONNE."</option>";
                                    $tabNomFormateur1 = $tabNomFormateur1."tabNomFormateur2[".$laPersonne->ID_PERSONNE."]='".$laPersonne->NOM_PERSONNE."'\n";
                                    $tabPrenomFormateur1 = $tabPrenomFormateur1."tabPrenomFormateur2[".$laPersonne->ID_PERSONNE."]='".$laPersonne->PRENOM_PERSONNE."'\n";
                                    $tabEmailFormateur1 = $tabEmailFormateur1."tabEmailFormateur2[".$laPersonne->ID_PERSONNE."]='".$laPersonne->EMAIL_PERSONNE."'\n";
                                    $tabTelFormateur1 = $tabTelFormateur1."tabTelFormateur2[".$laPersonne->ID_PERSONNE."]='".$laPersonne->TEL_PERSONNE."'\n";
                                    $tabNomFormateur2[$laPersonne->ID_PERSONNE]=$laPersonne->NOM_PERSONNE;
                                    $tabPrenomFormateur2[$laPersonne->ID_PERSONNE]=$laPersonne->PRENOM_PERSONNE;
                                    $tabEmailFormateur2[$laPersonne->ID_PERSONNE]=$laPersonne->EMAIL_PERSONNE;
                                    $tabTelFormateur2[$laPersonne->ID_PERSONNE]=$laPersonne->TEL_PERSONNE;
                                }
                            endforeach;
                            print $selectForm
                        ?>
                    </select>
                    <span class="input-group-text"><button class="btn btn-primary" type="button" onclick="addFormateur()" name="ajout-formateur">Ajouter le Formateur</button></span>
                </div>
                <!-- FIN de Ajouter un formateur-->
                <div class="table" id="tabFormateur">
                    <table class="table table-striped table-hover">
                        <!-- dénomination des titres du tableau -->
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                            </tr>
                        </thead>
                        <!-- alimentation des lignes du tableau -->   
                        <tbody>
                            <tr id="lineFormateurs">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Contenu de l'onglet Stagiaires -->            
            <div class="tab-pane fade" id="nav-stagiaires" role="tabpanel" aria-labelledby="nav-stagiaires-tab">
            <!-- Ajouter un stagiaire-->
            <div class="input-group mb-3">
                <span class="input-group-text">Stagiaires</span>
                    <select class="form-select" aria-label="Default select example" id="stagiaire" name="nomStagiaire">
                        <option selected></option>
                            <?php foreach ($lesPersonnes as $laPersonne):
                                 $typePersonne = $laPersonne->TYPE_PERSONNE;
                                    if($typePersonne=="stagiaire"){
                            ?> 
                        <option value="<?php echo  $laPersonne->ID_PERSONNE ;?>"><?php echo  $laPersonne->NOM_PERSONNE ;?> <?php echo  $laPersonne->PRENOM_PERSONNE ;?></option>
                            <?php  }  endforeach;?>
                    </select>
                <span class="input-group-text"><button class="btn btn-primary" type="button" onclick="addStagiaire()" name="ajout-stagiaire">Ajouter le Stagiaire</button></span>
            </div>
                <!-- FIN de Ajouter un stagiaire-->
                <div class="table" id="tabStagiaires">
                    <table class="table table-striped table-hover">
                        <!-- dénomination des titres du tableau -->
                        <thead>
                            <tr id="lineStagiaires">
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                            </tr>
                        </thead>
                        <!-- alimentation des lignes du tableau -->   
                        <tbody>  
                            <tr id="lineStagiaires">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    <?php print($tabNomFormateur1);?>
    <?php print($tabPrenomFormateur1);?>
    <?php print($tabEmailFormateur1);?>
    <?php print($tabTelFormateur1);?>

    function addFormateur() {
     //   var tabFormateur = document.querySelector("#lineFormateurs").innerHTML;
     //   monSelect = document.getElementById("formateur").value;
       console.log('ajoutFormateur');
     //   tabFormateur = tabFormateur + '<td>'+tabNomFormateur2[valueSelect]'</td>' 
       //     <td></td>
       //     <td></td>
        //    <td></td>
         //   <td></td>
    }

    function addStagiaire() {
        var tabStagiaires = document.querySelector("#lineStagiaires").innerHTML;
        console.log(tabStagiaires);
        var nomStagiaire = document.getElementById("stagiaire").value;
        console.log(nomStagiaire);
    }
</script>
