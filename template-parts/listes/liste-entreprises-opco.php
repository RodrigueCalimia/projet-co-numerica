<?php 
/* 
    Page contenant la liste de toutes les entreprises sous forme de tableau
    issues de la base de données WordPress et se trouvant
    dans la table wp_entreprisesopco
*/
?>
<?php   
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table
    $LesEntreprisesOpco = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_entreprises_opco'));
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
    $titlePage = get_the_title();
    $typeEntOpcoPage='vide';

    if ($titlePage == 'Les Entreprises'):
        $typeEntOpcoPage = 'Entreprise';
    elseif ($titlePage == 'Les OPCO'):
        $typeEntOpcoPage = 'OPCO';
    endif;
    setcookie("TypeEntOpco", $typeEntOpcoPage);
?>

<div class="main">
    <!-- affichage du nom de la page -->
    <h1><?php echo $titlePage ?></h1>
    <section>
        <div class="header-section justify-content-md-end">
            <!-- <div class="search">    
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Recherche" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div> -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addEntrepriseOpco" data-bs-whatever="@getbootstrap">
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
                        <th>Nom commercial</th>
                        <th>Adresse</th>
                        <th>Siret</th>
                        <th>NAF</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
                <tbody>
                    <?php foreach ($LesEntreprisesOpco as $lEntrepriseOpco):
                        $idEntOpco = $lEntrepriseOpco->ID_ENT_OPCO ;
                        $nomEntOpco = $lEntrepriseOpco->NOM_ENT_OPCO ;
                        $typeEntOpco = $lEntrepriseOpco->TYPE_ENT_OPCO ;
                        $adresseEntOpco = $lEntrepriseOpco->ADRESSE_ENT_OPCO ;
                        $cpEntOpco = $lEntrepriseOpco->CP_ENT_OPCO ;
                        $villeEntOpco = $lEntrepriseOpco->VILLE_ENT_OPCO ;
                        $siretEntOpco = $lEntrepriseOpco->SIRET_ENT_OPCO;
                        $nafEntOpco = $lEntrepriseOpco->NAF_ENT_OPCO;
                        ?>    
                        <tr>
                            <?php if(($titlePage == 'Les Entreprises') && ($typeEntOpco == 'Entreprise')):?>
                            <td><?php echo  $nomEntOpco ;?></td>
                            <td><?php echo  $adresseEntOpco ;?> - <?php echo  $cpEntOpco;?> <?php echo  $villeEntOpco ;?></td>
                            <td><?php echo  $siretEntOpco ;?></td>
                            <td><?php echo  $nafEntOpco ;?></td>
                            <td class="table-td-action">
                                <span title="Modifier le site" >
                                    <!-- envoie de paramètres du formulaire dans l'url afin de les récupérer pour remplir le formulaire de modification -->
                                    <a href="update-entreprise-opco.php?titreContenu=<?php the_title()?>&amp;idEntOpco=<?php echo  $idEntOpco;?>&amp;nomEntOpco=<?php echo  $nomEntOpco;?>&amp;typeEntOpco=<?php echo  $typeEntOpco;?>&amp;adresseEntOpco=<?php echo  $adresseEntOpco;?>&amp;cpEntOpco=<?php echo  $cpEntOpco;?>&amp;villeEntOpco=<?php echo  $villeEntOpco;?>&amp;siretEntOpco=<?php echo  $siretEntOpco;?>&amp;nafEntOpco=<?php echo  $nafEntOpco;?>">
                                        <i class="bi bi-pencil-square" ></i>
                                    </a>
                                </span>
                            </td>
                            <?php elseif(($titlePage == 'Les OPCO') && ($typeEntOpco == 'OPCO')):?>
                            <td><?php echo  $nomEntOpco ;?></td>
                            <td><?php echo  $adresseEntOpco ;?> - <?php echo  $cpEntOpco;?> <?php echo  $villeEntOpco ;?></td>
                            <td><?php echo  $siretEntOpco ;?></td>
                            <td><?php echo  $nafEntOpco ;?></td>
                            <td class="table-td-action">
                                <span title="Modifier le site" >
                                    <!-- envoie de paramètres du formulaire dans l'url afin de les récupérer pour remplir le formulaire de modification -->
                                    <a href="update-entreprise-opco.php?titreContenu=<?php the_title()?>&amp;idEntOpco=<?php echo  $idEntOpco;?>&amp;nomEntOpco=<?php echo  $nomEntOpco;?>&amp;typeEntOpco=<?php echo  $typeEntOpco;?>&amp;adresseEntOpco=<?php echo  $adresseEntOpco;?>&amp;cpEntOpco=<?php echo  $cpEntOpco;?>&amp;villeEntOpco=<?php echo  $villeEntOpco;?>&amp;siretEntOpco=<?php echo  $siretEntOpco;?>&amp;nafEntOpco=<?php echo  $nafEntOpco;?>">
                                        <i class="bi bi-pencil-square" ></i>
                                    </a>
                                </span>
                            </td>
                            <?php endif;?>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- affichage de la modal contenant le formulaire d'ajout -->
<div class="modal fade" id="addEntrepriseOpco" tabindex="-1" aria-labelledby="addFormationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="modalLabel">Ajout d'une <?php echo $typeEntOpcoPage ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <?php get_template_part( 'template-parts/forms/create', 'entreprise-opco');?>
        </div>
        <div class="modal-footer">    
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
        </div>
    </div>
</div>