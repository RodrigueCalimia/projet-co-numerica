<?php 
/* 
    Page contenant la liste de toutes les formations
    issues de la base de données WordPress et se trouvant
    dans la table wp_listeformation
*/
?>
<?php   
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_listeformation contenant les formations
    $lesFormations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_formations'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
?>

<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <section>
        <div class="header-section">
            <div class="search">    
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addFormation" data-bs-whatever="@getbootstrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="table">
            <table class="table table-striped table-hover">
                <!-- dénomination des titres du tableau -->
                <thead>
                    <tr>
                        <th>Libellé de la formation</th>
                        <th>Objectifs de la formation</th>
                        <th>Objectifs professionnels de la formation</th>
                        <th>Parcours pédagogique prévisionnel</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
                <tbody>
                    <?php foreach ($lesFormations as $laFormation):
                        $idFormation = $laFormation->ID_FORMATION;
                        $nomFormation = $laFormation->NOM_FORMATION;
                        $objFormation = $laFormation->OBJ_FORMATION;
                        $objProFormation = $laFormation->OBJ_PRO_FORMATION;
                        $parcourPdedaPrevi = $laFormation->PARCOUR_PEDA_PREVI;?>    
                        <tr>
                            <td><?php echo  $nomFormation;?></td>
                            <td><?php echo  $objFormation;?></td>
                            <td><?php echo  $objProFormation;?></td>
                            <td><?php echo  $parcourPdedaPrevi;?></td>
                            <td class="table-td-action">
                                <span title="Modifier le site" >
                                    <!-- envoie de paramètres du formulaire dans l'url afin de les récupérer pour remplir le formulaire de modification -->
                                    <a href="update-formation.php?titreContenu=<?php the_title()?>&amp;idFormation=<?php echo  $idFormation;?>&amp;nomFormation=<?php echo  $nomFormation;?>&amp;objFormation=<?php echo  $objFormation;?>&amp;objProFormation=<?php echo  $objProFormation;?>&amp;parcourPdedaPrevi=<?php echo  $parcourPdedaPrevi;?>">
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

<div class="modal fade" id="addFormation" tabindex="-1" aria-labelledby="addFormationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="modalLabel">Ajout d'une formation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <?php get_template_part( 'template-parts/forms/create', 'formation');?>
        </div>
        <div class="modal-footer">    
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
        </div>
    </div>
</div>