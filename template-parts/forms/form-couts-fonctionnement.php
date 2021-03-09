<?php   
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_listeformation contenant les formations
    $lesCoutAdminFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_admin_formation'));
    foreach ($lesCoutAdminFormation as $leCoutAdminFormation){
        $coutAdminFormation = $leCoutAdminFormation->COUT_ADMIN_FORMATION;
    }
    $lesCoutCompta = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_comptabilite'));
    // stockage des données dans les variables
    foreach ($lesCoutCompta as $leCoutCompta){
        $coutCompta = $leCoutCompta->COUT_COMPTA;
    }
    $lesCoutServiceInformatique = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_service_informatique'));
    // stockage des données dans les variables
    foreach ($lesCoutServiceInformatique as $leCoutServiceInformatique){
        $coutServiceInformatique    = $leCoutServiceInformatique->COUT_SERVICE_INFORMATIQUE;
    }
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
?>

<div class="container">
    <div class="row justify-content-md-start">
        <div class="col-md-5">
            <div class="input-group mb-3">
                <span class="input-group-text" style="width: 230px">Coût adminsitratif formation</span>
                <input type="number" name="coutAdminFormation" class="form-control" id="coutAdminFormation" min="0" value="<?php echo $coutAdminFormation;?>" required>
                <span class="input-group-text">€</span>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-start">
        <div class="col-md-5">
            <div class="input-group mb-3">
                <span class="input-group-text" style="width: 230px">Coût comptabilité</span>
                <input type="number" name="coutComptabilite" class="form-control" id="coutComptabilite" min="0" value="<?php echo $coutCompta;?>" required>
                <span class="input-group-text">€</span>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-start">
        <div class="col-md-5">
            <div class="input-group mb-3">
                <span class="input-group-text" style="width: 230px">Coût service informatique</span>
                <input type="number" name="coutServiceInformatique" class="form-control" id="coutServiceInformatique" min="0" value="<?php echo $coutServiceInformatique;?>" required>
                <span class="input-group-text">€</span>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-start" style="margin-bottom: 20px">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </div>
</div>