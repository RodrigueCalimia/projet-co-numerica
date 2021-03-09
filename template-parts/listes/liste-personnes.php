<?php 
/* 
    Page contenant la liste de tous les membres
    issues de la base de données WordPress et se trouvant
    dans la table wp_personnes
*/
?>
<?php   
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_pesonnes contenant les personnes
    $lesPersonnes = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_personnes'));
    // récupération des données de la table wp_roles contenant les rôles des personnes
    $lesRoles = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_roles'));
    $nbRole = count($lesRoles);
    $tblRoles = array();
    $i = 1;
    // récupération des rôles
    foreach ($lesRoles as $leRole){
        $tblRoles[$i]   = $leRole->ROLE ;
        $i +=1 ;
    }
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
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addPersonne" data-bs-whatever="@getbootstrap">
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
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Kabis</th>
                        <th>CV</th>
                        <th>Type</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- alimentation des lignes du tableau -->   
                <tbody>
                    <?php foreach ($lesPersonnes as $laPersonne):
                        // récupération et stockage des données
                        $nom            = $laPersonne->NOM_PERSONNE ;
                        $prenom         = $laPersonne->PRENOM_PERSONNE ;
                        $email          = $laPersonne->EMAIL_PERSONNE ;
                        $telephone      = $laPersonne->TEL_PERSONNE ;
                        $kabis          = $laPersonne->KABIS_PERSONNE ;
                        $cv             = $laPersonne->CV_PERSONNE ;
                        $type           = $laPersonne->TYPE_PERSONNE ;
                        $roleAdminWp    = $laPersonne->ROLE_ADMIN_WP ;
                        $roleAdminSol   = $laPersonne->ROLE_ADMIN_SOLUTION ;
                        $roleGestion    = $laPersonne->ROLE_GESTIONNAIRE ;
                        $roleAssist     = $laPersonne->ROLE_ASSISTANTE ;
                        $roleFinance    = $laPersonne->ROLE_FINANCE ;
                        $roleFormateur  = $laPersonne->ROLE_FORMATEUR;
                        $roleClient     = $laPersonne->ROLE_CLIENT ;
                        $roleSub        = $laPersonne->ROLE_SUBROGATEUR ;
                        ?>    
                        <tr>
                            <td><?php echo  $nom ;?></td>
                            <td><?php echo  $prenom ;?></td>
                            <td><?php echo  $email ;?></td>
                            <td><?php echo  $telephone ;?></td>
                            <td><?php echo  $kabis ;?></td>
                            <td><?php echo  $cv ;?></td>
                            <td><?php echo  $type ;?></td>
                            <td>
                                <?php 
                                    if ($roleAdminWp == 1){
                                        echo "<div class='row'>".$tblRoles[1]."</div>";
                                    }
                                    if ($roleAdminSol == 1){
                                        echo "<div class='row'>".$tblRoles[2]."</div>";
                                    }
                                    if ($roleGestion == 1){
                                        echo "<div class='row'>".$tblRoles[3]."</div>";
                                    }
                                    if ($roleAssist == 1){
                                        echo "<div class='row'>".$tblRoles[4]."</div>";
                                    }
                                    if ($roleFinance == 1){
                                        echo "<div class='row'>".$tblRoles[5]."</div>";
                                    }
                                    if ($roleFormateur == 1){
                                        echo "<div class='row'>".$tblRoles[6]."</div>";
                                    }
                                    if ($roleClient == 1){
                                        echo "<div class='row'>".$tblRoles[7]."</div>";
                                    }
                                    if ($roleSub == 1){
                                        echo "<div class='row'>".$tblRoles[8]."</div>";
                                    }
                                ?>
                            </td>
                            <td class="table-td-action">
                                <span title="Modifier la personne" >
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

<div class="modal fade" id="addPersonne" tabindex="-1" aria-labelledby="addPersonne" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="modalLabel">Ajout d'une personne</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <?php get_template_part( 'template-parts/forms/create', 'personne');?>
        </div>
        <div class="modal-footer">    
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
        </div>
    </div>
</div>