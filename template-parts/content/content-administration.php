<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_listeformation contenant les formations
    $lesFormations = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_formations'));

    // récupération des données de la table wp_sites contenant les sites
    $lesSites = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_sites'));

    
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

    // récupération des données de la table
    $LesEntreprisesOpco = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_entreprises_opco'));

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
<?php get_header()?>
<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <!-- nav tabs -->
    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-formation-tab" data-bs-toggle="tab" data-bs-target="#nav-formation" type="button" role="tab" aria-controls="nav-formation" aria-selected="true">Formations</button>
            <button class="nav-link" id="nav-sites-numerica-tab" data-bs-toggle="tab" data-bs-target="#nav-sites-numerica" type="button" role="tab" aria-controls="nav-sites-numerica" aria-selected="false">Sites Numerica</button>
            <button class="nav-link" id="nav-utilisateurs-tab" data-bs-toggle="tab" data-bs-target="#nav-utilisateurs" type="button" role="tab" aria-controls="nav-utilisateurs" aria-selected="false">Utilisateurs</button>
            <button class="nav-link" id="nav-entreprises-tab" data-bs-toggle="tab" data-bs-target="#nav-entreprises" type="button" role="tab" aria-controls="nav-entreprises" aria-selected="false">Entreprises</button>
            <button class="nav-link" id="nav-opco-tab" data-bs-toggle="tab" data-bs-target="#nav-opco" type="button" role="tab" aria-controls="nav-opco" aria-selected="false">OPCO</button>
            <button class="nav-link" id="nav-couts-fonctionnement-tab" data-bs-toggle="tab" data-bs-target="#nav-couts-fonctionnement" type="button" role="tab" aria-controls="nav-couts-fonctionnement" aria-selected="false">Coûts de fonctionnement</button>
        </div>
    </nav>

    <div class="container">
    <!-- Contenus des onglets -->
    <div class="tab-content" id="nav-tabContent">
        <!-- Contenu de l'onglet Formation -->
        <div class="tab-pane fade show active" id="nav-formation" role="tabpanel" aria-labelledby="nav-formation-tab">
            <div class="header-section justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="button" onclick="AddFormation();">
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
                                        <a href="<?php echo site_url(); ?>/modifier-une-formation?titreContenu=<?php the_title()?>&amp;idFormation=<?php echo  $idFormation;?>&amp;nomFormation=<?php echo  $nomFormation;?>&amp;objFormation=<?php echo  $objFormation;?>&amp;objProFormation=<?php echo  $objProFormation;?>&amp;parcourPdedaPrevi=<?php echo  $parcourPdedaPrevi;?>">
                                            <i class="bi bi-pencil-square" ></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <?php //get_template_part( 'template-parts/listes/liste', 'formations'); ?>
        </div>
        <!-- Contenu de l'onglet Sites Numerica -->
        <div class="tab-pane fade" id="nav-sites-numerica" role="tabpanel" aria-labelledby="nav-sites-numerica-tab">
            <div class="header-section justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="button" onclick="AddSiteNumerica()">
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
                                        <a href="<?php echo site_url(); ?>/modifier-un-site?titreContenu=<?php the_title()?>&amp;idSite=<?php echo $idSite;?>&amp;nomSite=<?php echo $nomSite;?>&amp;adresseSite=<?php echo $adresseSite;?>&amp;codePostalSite=<?php echo $codePostalSite;?>&amp;villeSite=<?php echo $villeSite;?>">
                                            <i class="bi bi-pencil-square" ></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Contenu de l'onglet Utilisateurs -->
        <div class="tab-pane fade" id="nav-utilisateurs" role="tabpanel" aria-labelledby="nav-utilisateurs-tab">
            <div class="header-section justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="button" onclick="AddUtilisateur()">
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
        </div>
        <!-- Contenu de l'onglet Entreprises -->
        <div class="tab-pane fade" id="nav-entreprises" role="tabpanel" aria-labelledby="nav-entreprises-tab">
            <div class="header-section justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="button" onclick="AddEntreprise()">
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
                                <?php if($typeEntOpco == 'Entreprise'):?>
                                <td><?php echo  $nomEntOpco ;?></td>
                                <td><?php echo  $adresseEntOpco ;?> - <?php echo  $cpEntOpco;?> <?php echo  $villeEntOpco ;?></td>
                                <td><?php echo  $siretEntOpco ;?></td>
                                <td><?php echo  $nafEntOpco ;?></td>
                                <td class="table-td-action">
                                    <span title="Modifier l'entreprise'" >
                                        <!-- envoie de paramètres du formulaire dans l'url afin de les récupérer pour remplir le formulaire de modification -->
                                        <a href="<?php echo site_url(); ?>/modifier-une-entreprise-opco?titreContenu=<?php the_title()?>&amp;idEntOpco=<?php echo  $idEntOpco;?>&amp;nomEntOpco=<?php echo  $nomEntOpco;?>&amp;typeEntOpco=<?php echo  $typeEntOpco;?>&amp;adresseEntOpco=<?php echo  $adresseEntOpco;?>&amp;cpEntOpco=<?php echo  $cpEntOpco;?>&amp;villeEntOpco=<?php echo  $villeEntOpco;?>&amp;siretEntOpco=<?php echo  $siretEntOpco;?>&amp;nafEntOpco=<?php echo  $nafEntOpco;?>">
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
        </div>
        <!-- Contenu de l'onglet OPCO -->
        <div class="tab-pane fade" id="nav-opco" role="tabpanel" aria-labelledby="nav-opco-tab">
            <div class="header-section justify-content-md-end">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="button" onclick="AddEntreprise()">
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
                                <?php if($typeEntOpco == 'OPCO'):?>
                                <td><?php echo  $nomEntOpco ;?></td>
                                <td><?php echo  $adresseEntOpco ;?> - <?php echo  $cpEntOpco;?> <?php echo  $villeEntOpco ;?></td>
                                <td><?php echo  $siretEntOpco ;?></td>
                                <td><?php echo  $nafEntOpco ;?></td>
                                <td class="table-td-action">
                                    <span title="Modifier l'OPCO" >
                                        <!-- envoie de paramètres du formulaire dans l'url afin de les récupérer pour remplir le formulaire de modification -->
                                        <a href="<?php echo site_url(); ?>/modifier-une-entreprise-opco?titreContenu=<?php the_title()?>&amp;idEntOpco=<?php echo  $idEntOpco;?>&amp;nomEntOpco=<?php echo  $nomEntOpco;?>&amp;typeEntOpco=<?php echo  $typeEntOpco;?>&amp;adresseEntOpco=<?php echo  $adresseEntOpco;?>&amp;cpEntOpco=<?php echo  $cpEntOpco;?>&amp;villeEntOpco=<?php echo  $villeEntOpco;?>&amp;siretEntOpco=<?php echo  $siretEntOpco;?>&amp;nafEntOpco=<?php echo  $nafEntOpco;?>">
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
        </div>
        <!-- Contenu de l'onglet Coûts de fonctionnement -->
        <div class="tab-pane fade" id="nav-couts-fonctionnement" role="tabpanel" aria-labelledby="nav-couts-fonctionnement-tab">
            <div class="table">
                <table class="table table-striped table-hover">
                    <!-- dénomination des titres du tableau -->
                    <thead>
                        <tr>
                            <th>Intitulé</th>
                            <th>Coût horaire</th>
                        </tr>
                    </thead>
                    <!-- alimentation des lignes du tableau -->   
                    <tbody>   
                            <tr>
                                <td>Coût adminsitratif formation</td>
                                <td><?php echo  $coutAdminFormation;?> €</td>
                            </tr>
                            <tr>
                                <td>Coût comptabilité</td>
                                <td><?php echo  $coutCompta;?> €</td>
                            </tr>
                            <tr>
                                <td>Coût service informatique</td>
                                <td><?php echo  $coutServiceInformatique;?> €</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary" type="button" onclick="UpdateCoutsFonctionnement()">Modifier</button>
        </div>
    </div>
    </div>
</div>
<?php get_footer(); ?>

<script>
    // accès à la page de création d'une formation
    function AddFormation() {
        window.location = '../creer-une-formation';
    }
    // accès à la page de création d'un site de formation
    function AddSiteNumerica() {
        window.location = '../creer-un-site';
    }
    // accès à la page de création d'un utilisateur
    function AddUtilisateur() {
        window.location = '../creer-un-utilisateur';
    }
    // accès à la page de création d'une entreprise
    function AddEntreprise() {
        window.location = '../creer-une-entreprise';
    }
    // Affichage des paramètres
    function UpdateCoutsFonctionnement() {
        window.location = '../modifier-les-couts-de-fonctionnement';
    }
</script>