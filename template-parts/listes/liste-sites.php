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
    $lesSites = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
?>

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
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addSite" data-bs-whatever="@getbootstrap">
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
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Code postal</th>
                        <th>Ville</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
                <tbody>
                    <?php foreach ($lesSites as $leSite):
                        $idSite = $leSite->ID_SITE ;
                        $nomSite = $leSite->NOM_SITE ;
                        $adresseSite = $leSite->ADRESSE_SITE ;
                        $codePostalSite = $leSite->CODE_POSTAL_SITE;
                        $villeSite = $leSite->VILLE_SITE;?>    
                        <tr>
                            <td><?php echo  $nomSite;?></td>
                            <td><?php echo  $adresseSite;?></td>
                            <td><?php echo  $codePostalSite;?></td>
                            <td><?php echo  $villeSite;?></td>
                            <td class="table-td-action">
                                <span title="Modifier le site" >
                                    <a href="update-site.php?titreContenu=<?php the_title()?>&amp;idSite=<?php echo $idSite;?>&amp;nomSite=<?php echo $nomSite;?>&amp;adresseSite=<?php echo $adresseSite;?>&amp;codePostalSite=<?php echo $codePostalSite;?>&amp;villeSite=<?php echo $villeSite;?>">
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

<div class="modal fade" id="addSite" tabindex="-1" aria-labelledby="addSiteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="modalLabel">Ajout d'un Site Numerica</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <?php get_template_part( 'template-parts/forms/create', 'site');?>
        </div>
        <div class="modal-footer">    
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
        </div>
    </div>
</div>