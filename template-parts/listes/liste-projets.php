<?php 
/* 
    Page contenant la liste de toutes les formations
    issues de la base de données WordPress et se trouvant
    dans la table wp_projets
*/
?>
<?php   
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_projets contenant les projets
    $lesProjets = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_projets'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
?>

<?php get_header()?>
<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <section>
        <div class="header-section justify-content-md-end">
            <!-- <div class="search">    
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div> -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary" type="button" onclick="addProjet()">Créer</button>
            </div>
        </div>
        <div class="table">
            <table class="table table-striped table-hover">
                <!-- dénomination des titres du tableau -->
                <thead>
                    <tr>
                        <th>N° projet</th>
                        <th>Libellé</th>
                        <th>Société</th>
                        <th>Statut</th>
                        <th>Dates de formation</th>
                        <th>Nb Stagiaires</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
                <tbody>
                    <?php foreach ($lesProjets as $leProjet):?>    
                        <tr>
                            <td><?php echo  $leProjet->NUM_PROJET ;?></td>
                            <td><?php echo  $leProjet->LIB_FORM ;?></td>
                            <td><?php echo  $leProjet->SOCIETE;?></td>
                            <td><?php echo  $leProjet->STATUT_PROJET;?></td>
                            <td><?php echo  $leProjet->DATES_FORM;?></td>
                            <td><?php echo  $leProjet->NB_STAGIAIRES;?></td>
                            <td class="table-td-action">
                                <span title="Visualiser le projet">
                                    <a href="#">
                                        <i class="bi bi-eye" ></i>
                                    </a>
                                </span>
                                <span title="Modifier le projet" >
                                    <a href="#" >
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

<script>
    function addProjet() {
        window.location = '../creer-un-projet';
    }
</script>
<?php get_footer(); ?>