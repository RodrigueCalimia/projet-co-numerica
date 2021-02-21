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
        echo "<>window.location = '".site_url("/les-projets")."'</>";
    }
?>

<div class="main">
    <h1><?php get_the_title() ?></h1>
    <!-- nav tabs -->
    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-projet-tab" data-bs-toggle="tab" data-bs-target="#nav-projet" type="button" role="tab" aria-controls="nav-projet" aria-selected="true">Projet</button>
            <button class="nav-link" id="nav-formateur-tab" data-bs-toggle="tab" data-bs-target="#nav-formateur" type="button" role="tab" aria-controls="nav-formateur" aria-selected="false">Formateur</button>
            <button class="nav-link" id="nav-stagiaires-tab" data-bs-toggle="tab" data-bs-target="#nav-stagiaires" type="button" role="tab" aria-controls="nav-stagiaires" aria-selected="false">Stagiaires</button>
            <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="false">Documents</button>
            <button class="nav-link" id="nav-documents-signes-tab" data-bs-toggle="tab" data-bs-target="#nav-documents-signes" type="button" role="tab" aria-controls="nav-documents-signes" aria-selected="false">Documents Signés</button>
            <button class="nav-link" id="nav-facture-tab" data-bs-toggle="tab" data-bs-target="#nav-facture" type="button" role="tab" aria-controls="nav-facture" aria-selected="false">Facture</button>
        </div>
    </nav>

    <form class="row" method="POST">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-projet" role="tabpanel" aria-labelledby="nav-projet-tab">
                <div class="col-md-6">
                    <!-- Zone du choix du lieu de formation -->
                    <label for="listeFormation" class="form-label">Libellé de la formation</label>
                    <!-- récupération des lieux de formation -->
                    <select class="form-select" aria-label="Default select example" onchange="change_valeur();" id="listeFormation">
                        <option selected></option>
                        <?php foreach ($formations as $formation):?> 
                            <option value="<?php echo $formation->ID_FORMATION;?>"><?php echo  $formation->NOM_FORMATION ;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-pedagogie" role="tabpanel" aria-labelledby="nav-pedagogie-tab">
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
            <div class="tab-pane fade" id="nav-session" role="tabpanel" aria-labelledby="nav-session-tab">            
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h6>Lieu de la formation</h6>
                            <?php foreach ($lesLieuxFormation as $leLieuFormation):?> 
                                <div class="form-check">
                                    <label class="form-check-label" for="flexCheckDefault">  
                                        <?php echo  $leLieuFormation->NOM_SITE ;?>
                                    </label>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                </div> 
                            <?php endforeach;?>
                            <button class="btn btn-secondary" type="button" onclick="addSite()">Ajouter un site</button>
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
                            <input type="number" name="durre_formation" class="form-control" id="durre_formation" required onchange="" value=0>
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
                    <nav>
                        <div class="nav justify-content-center" id="nav-tab" role="tablist">
                            <button class="nav-link" id="nav-pedagogie-tab" data-bs-toggle="tab" data-bs-target="#nav-pedagogie" type="button" role="tab" aria-controls="nav-predagogie" aria-selected="false">Précédant</button>
                            <button class="nav-link" id="nav-chiffrage-tab" data-bs-toggle="tab" data-bs-target="#nav-chiffrage" type="button" role="tab" aria-controls="nav-chiffrage" aria-selected="false">Suivant</button>
                        </div>
                    </nav>
                    <button class="btn btn-primary" type="button" onclick="navPedagodie()">Précédant</button>
                    <button class="btn btn-primary" type="button" onclick="navChiffrage()">Suivant</button>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-chiffrage" role="tabpanel" aria-labelledby="nav-chiffrage-tab">
                Chiffrage
                
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Éditer le devis"></input>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function change_valeur() {
        select = document.getElementById("listeFormation");
        choice = select.selectedIndex;
        valeur = select.options[choice].value;
        document.getElementById('validationServer02').value = valeur;
    }
    function addSite() {
        window.location = '../ajouter-un-site';
    }
    function navPedagodie() {
        let elmPeda = document.getElementById('nav-pedagogie-tab');
        elmPeda.className = 'nav-link active';
        elmPeda.setAttribute("aria-selected", true);
        let elmSession = document.getElementById('nav-session-tab');
        elmSession.className = 'nav-link';
        elmSession.setAttribute("aria-selected", false);
    }
    function navChiffrage() {
        window.location = '../ajouter-un-site';
    }
</script>
