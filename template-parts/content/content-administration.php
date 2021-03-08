<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_sites contenant les sites
    $lesSites = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));
    // récupération des données de la table wp_pesonnes contenant les sites
    $lesPersonnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_personnes'));
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
?>

<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card border-secondary text-center card-margin" >
                    <div class="card-header text-dark">Les Sites Numerica</div>
                    <div class="card-text text-start">
                        <?php foreach ($lesSites as $leSite):
                            $idSite = $leSite->ID_SITE ;
                            $nomSite = $leSite->NOM_SITE ;
                            $adresseSite = $leSite->ADRESSE_SITE ;
                            $codePostalSite = $leSite->CODE_POSTAL_SITE;
                            $villeSite = $leSite->VILLE_SITE;
                            ?> 
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-auto"><?php echo  $nomSite;?></div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="button" onclick="openListeSites()">Gérer</button>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card border-secondary text-center card-margin" >
                    <div class="card-header text-dark">Les Utilisateurs</div>
                    <div class="card-text text-start">
                        <?php foreach ($lesPersonnes as $laPersonne):
                            $nomPersonne = $laPersonne->NOM_PERSONNE;
                            $prenomPersonne = $laPersonne->PRENOM_PERSONNE;
                            $typePersonne = $laPersonne->TYPE_PERSONNE;
                            ?> 
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-auto"><?php echo  $prenomPersonne;?> <?php echo  $nomPersonne;?> - <?php echo  $typePersonne;?></div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="button" onclick="openListeUtilisateurs()">Gérer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-auto justify-content-center">
            <div class="col-5">
                <div class="card border-secondary text-center card-margin" >
                    <div class="card-header text-dark">Coûts de fonctionnement</div>
                    <div class="card-text text-start">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">Coût adminsitratif formation</div>
                                <div class="col-sm-auto"><?php echo  $coutAdminFormation;?>€</div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">Coût comptabilité</div>
                                <div class="col-sm-auto"><?php echo  $coutCompta;?>€</div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">Coût service informatique</div>
                                <div class="col-sm-auto"><?php echo  $coutServiceInformatique;?>€</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary" type="button" onclick="CoutsFonctionnement()">Gérer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Affichage de la liste des sites Numerica
    function openListeSites() {
        window.location = '../les-sites-numerica';
    }
    // Affichage de la liste des utilisateurs
    function openListeUtilisateurs() {
        window.location = '../utilisateurs';
    }
    // Affichage des paramètres
    function CoutsFonctionnement() {
        window.location = '../couts-de-fonctionnement';
    }
</script>