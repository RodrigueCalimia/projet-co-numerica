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
    $lesProjets = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_dashboard'));

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
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
                <tbody>
                    <?php foreach ($lesProjets as $leProjet) :
                            $idProjet       = $leProjet->ID_DASHBOARD;
                            $numForm        = $leProjet->NUM_FORM;
                            $societe        = $leProjet->CLIENT;
                            $nomFormation   = $leProjet->FORMATION;
                            $datesFormation = $leProjet->DATE;
                            $montant        = $leProjet->MONTANT;
                            $statut         = $leProjet->STATUT;
                        ?>    
                        <tr>
                            <td><?php echo  $numForm ;?></td>
                            <td><?php echo  $societe?></td>
                            <td><?php echo  $nomFormation?></td>
                            <td><?php echo  $datesFormation ;?></td>
                            <td><?php echo  $montant ;?>€</td>
                            <td><?php echo  $statut;?></td>
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