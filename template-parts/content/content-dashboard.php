<?php 
/* 
    Page contenant la liste de tous les projets
    issues de la base de données WordPress
*/
?>

<?php 
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_projets contenant les projets
    $lesProjets = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_projets'));

    // récupération des données de la table wp_devis contenant les devis
    $lesDevis = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_devis'));

    // récupération des données de la table wp_formations contenant les formations
    $lesFormations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_formations'));

    // récupération des données de la table wp_dates_formation contenant les dates de formation
    $lesDatesFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_dates_formation'));

    // récupération des données de la table wp_formateurs contenant l'association entre le projet et la personne de type formateur
    $lesFormateurs = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_formateurs'));

    // récupération des données de la table wp_stagiaires contenant l'association entre le projet et la personne de type stagiaire
    $lesStagiares = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_stagiaires'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
?>

<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <section>
        <div class="table">
            <table class="table table-striped table-hover">
                <!-- dénomination des titres du tableau -->
                <thead>
                    <tr>
                        <th>N° projet</th>
                        <th>Client</th>
                        <th>Formation</th>
                        <th>Dates de formation</th>
                        <th>Nb Stagiaires</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
    foreach ($lesProjets as $leProjet) {
    }
                <tbody>
                    <?php foreach ($lesProjets as $leProjet):
                        // stockage des données de la table projets
                        $idProjet       = $leProjet->ID_PROJET;
                        $idDevisProjet  = $leProjet->ID_DEVIS;
                        $factureProjet  = $leProjet->FACTURE_PROJET;
                        $statutProjet   = $leProjet->STATUT_PROJET;
                        $idFormateur    = $leProjet->ID_FORMATEUR;
                        $idStagiaire    = $leProjet->ID_STAGIAIRE;
                        $numFormProjet  = $leProjet->NUM_FORM;
                        // stockage des données de la table devis
                        foreach ($lesDevis as $leDevis) {
                            $idDevis        = $leDevis->ID_DEVIS;
                            $numFormDevis   = $leDevis->NUM_FORM;
                            $societe        = $leDevis->SOCIETE;
                            $nbStagiaire    = $leDevis->NB_STAGIAIRES;
                            $statutDevis    = $leDevis->STATUT_DEVIS;
                            $idDateFormDevis= $leDevis->ID_DATES_FORMATION;
                        }
                        // stockage des données de la table formations
                        foreach ($lesFormations as $laFormation) {
                            $idFormation        = $laFormation->ID_FORMATION;
                            $nomFormation       = $laFormation->NOM_FORMATION;
                            $objFormation       = $laFormation->OBJ_FORMATION;
                            $objProFormation    = $laFormation->OBJ_PRO_FORMATION;
                            $parcourPedaPrevi   = $laFormation->PARCOUR_PEDA_PREVI;
                        }
                        // stockage des données de la table dates formations
                        foreach ($lesDatesFormation as $laDateFormation) {
                            $idDateForm         = $laDateFormation->ID_DATES_FORMATION;
                            $idDevisDatesForm   = $laDateFormation->ID_DEVIS;
                        }
                        // stockage des données de la table formateurs
                        foreach ($lesFormateurs as $leFormateur) {
                            $idPersonneForm = $leFormateur->ID_PERSONNE;
                            $idProjetForm   = $leFormateur->ID_Projet;
                        }
                        // stockage des données de la table personnes
                        foreach ($lesStagiares as $leStagiare) {
                            $idPersonneStag = $leStagiare->ID_PERSONNE;
                            $idProjetStag   = $leStagiare->ID_Projet;
                        }
                        ?>    
                        <tr>
                            <td><?php echo  $leProjet->NUM_PROJET ;?></td>
                            <td><?php echo  $leProjet->LIB_FORM ;?></td>
                            <td><?php echo  $leProjet->SOCIETE;?></td>
                            <td><?php echo  $leProjet->STATUT_PROJET;?></td>
                            <td><?php echo  $leProjet->DATES_FORM;?></td>
                            <td><?php echo  $leProjet->NB_STAGIAIRES;?></td>
                            <td>
                                <span title="Visualiser le projet" >
                                    <a href="#" >
                                        <i class="bi bi-eye" ></i>
                                    </a>
                                </span>
                                <span title="Modifier le projet">
                                    <a href="#">
                                        <i class="bi bi-pencil-square" ></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<div class="search">
    <h1>Tableau de bord</h1>
    <div class="tableau">
    <input class="input_search"/>
    <br/>
    <table cellspacing="0">
        <tbody>
            <tr>
                <th>PROJET</th>
                <th>CLIENT</th>
                <th>FORMATION</th>
                <th>DATE</th>
                <th>MONTANT</th>
                <th>STATUT</th>
            </tr>
            <tr>
                <td class="couleur"><?php echo  $page->client_name ;?></td>
                <td class="couleur"><?php echo  $page->client_name ;?></td>
                <td class="couleur"><?php echo $format->formation_name;?></td>
                <td class="couleur">buterffly</td>
                <td class="couleur">buterffly</td>
                <td class="couleur">buterffly</td>
            </tr>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
            <td class="couleur2">buterffly</td>
        </tbody>
        <tbody>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
            <td class="couleur">buterffly</td>
        </tbody>
    </table>
    <div>
</div>