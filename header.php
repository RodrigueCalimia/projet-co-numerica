<?php
    // connexion à la base de donnée
    global $wpdb;
    // récupération des données de la table wp_cout_admin_formation contenant le coût administratif formation
    $lesCoutAdminFormation = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_admin_formation'));
    // récupération de l'ID
    foreach ($lesCoutAdminFormation as $leCoutAdminFormation){
        $cookie_id_cout_admin  = $leCoutAdminFormation->ID_COUT_ADMIN_FORMATION;
    }
    // récupération des données de la table wp_cout_comptabilite contenant le coût comptabilité
    $lesCoutCompta = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_comptabilite'));
    // récupération des données de la dernière ligne du tableau
    foreach ($lesCoutCompta as $leCoutCompta){
        $cookie_id_cout_compta = $leCoutCompta->ID_COUT_COMPTA;
    }
    // récupération des données de la table wp_cout_service_informatique contenant le coût service informatique
    $lesCoutServiceInformatique = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_cout_service_informatique'));
    // récupération des données de la dernière ligne du tableau
    foreach ($lesCoutServiceInformatique as $leCoutServiceInformatique){
        $cookie_id_cout_service    = $leCoutServiceInformatique->ID_COUT_SERVICE_INFORMATIQUE;
    }
    // si erreur de connexion avec la BDD alors affichage d'une erreur
    $wpdb -> print_error ();
    
    setcookie("cookie_id_cout_admin", $cookie_id_cout_admin, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("cookie_id_cout_compta", $cookie_id_cout_compta, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("cookie_id_cout_service", $cookie_id_cout_service, time() + (86400 * 30), "/"); // 86400 = 1 day

    setcookie("num_formation", $num_formation, time() + (86400 * 30), "/"); // 86400 = 1 day

    session_start();
    $_SESSION['num_formation'] = $numFormation;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
        <?php wp_head(); ?>
    </head>
    <body>
    
        <div class="wrap">
            <header>
                <div class="header up">
                    <div class="up__element">
                    <!-- Affichage du LOGO NUMERICA avec un lien associé à la page d'accueil -->    
                    <a href="<?php echo site_url(); ?>">   
                            <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 129 27" style="enable-background:new 0 0 129 27;" xml:space="preserve">
                                <g>
                                    <path class="st0" d="M11.5,2.8L14.1,2C13.6,2,13,1.9,12.5,1.9C5.6,1.9,0,7.5,0,14.4c0,6.9,5.6,12.5,12.5,12.5S25,21.3,25,14.4
                                        c0-1.4-0.2-2.8-0.7-4.1l-4.9,1.3L18,6.5l3.4-0.9c-1.2-1.2-2.7-2.2-4.4-2.9l1,3.8l-5.2,1.4L11.5,2.8L11.5,2.8z M14.2,13.1l5.2-1.4
                                        l1.4,5.2l-5.1,1.4L14.2,13.1L14.2,13.1z M12.8,7.9L7.7,9.3l1.4,5.2l5.2-1.4L12.8,7.9L12.8,7.9z"/>
                                    <path class="st1" d="M78.5,17.8h5.7v2.1h-8.4V9.4H84v2.1h-5.5v2.1h4.4v2h-4.4V17.8z M53.1,9.4v6.3c0,0.8-0.2,1.3-0.5,1.7
                                        c-0.3,0.4-0.8,0.6-1.5,0.6c-0.6,0-1.1-0.2-1.5-0.6c-0.3-0.4-0.5-0.9-0.5-1.7V9.4h-2.8v6.3c0,1.5,0.4,2.6,1.2,3.4
                                        c0.8,0.7,2,1.1,3.5,1.1c1.6,0,2.7-0.4,3.5-1.1c0.8-0.7,1.2-1.9,1.2-3.4V9.4h0H53.1z M66.4,14.8L65.8,17h0l-0.6-2.2l-1.7-5.4h-3.9
                                        v10.6H62v-4.8L62,11.8h0l2.6,8.1h2.2l2.6-8.1h0l-0.1,3.2v4.8h2.4V9.4h-3.8L66.4,14.8z M40.3,14.7l0.1,2h0l-0.8-1.6l-3.3-5.7h-3.1
                                        v10.6h2.4v-5.3l-0.1-2h0l0.8,1.6l3.3,5.7h3.1V9.4h-2.4V14.7z M125.3,17.6h-3.6l-0.7,2.4h-2.8l3.7-10.6h3.3l3.7,10.6H126L125.3,17.6
                                        z M124.7,15.7l-0.8-2.5l-0.5-1.7h0l-0.4,1.6l-0.8,2.5H124.7z M94.3,15.7l2.8,4.3h-3l-2.3-3.9h-1.6v3.9h-2.7V9.4h5
                                        c1.3,0,2.2,0.3,2.9,0.9c0.7,0.6,1.1,1.4,1.1,2.4c0,1.1-0.3,1.9-1,2.5C95.1,15.3,94.8,15.5,94.3,15.7z M92.1,14.1
                                        c0.5,0,0.9-0.1,1.2-0.3c0.3-0.2,0.4-0.6,0.4-1c0-0.5-0.1-0.8-0.4-1c-0.3-0.2-0.7-0.3-1.2-0.3h-2v2.7H92.1z M112.9,17.5
                                        c-0.4,0.3-0.8,0.4-1.3,0.4c-0.5,0-1-0.1-1.4-0.4c-0.4-0.2-0.6-0.6-0.8-1.1c-0.2-0.5-0.3-1.1-0.3-1.8c0-0.7,0.1-1.3,0.3-1.8
                                        c0.2-0.5,0.5-0.9,0.8-1.1c0.4-0.2,0.8-0.4,1.3-0.4c0.5,0,0.9,0.1,1.3,0.4c0.3,0.2,0.6,0.7,0.7,1.4l2.4-1c-0.2-0.7-0.5-1.2-0.9-1.6
                                        c-0.4-0.4-1-0.8-1.6-0.9c-0.6-0.2-1.3-0.3-2-0.3c-1.1,0-2,0.2-2.8,0.7c-0.8,0.4-1.4,1.1-1.8,1.9c-0.4,0.8-0.6,1.8-0.6,2.9
                                        c0,1.1,0.2,2.1,0.6,2.9c0.4,0.8,1,1.4,1.8,1.9c0.8,0.4,1.7,0.6,2.8,0.6c0.7,0,1.4-0.1,2-0.3c0.6-0.2,1.2-0.6,1.6-1
                                        c0.4-0.5,0.8-1.1,1-1.8l-2.5-0.7C113.5,16.8,113.3,17.2,112.9,17.5z M100.1,19.9h2.8V9.4h-2.8V19.9z"/>
                                </g>
                            </svg>
                            <p><?php bloginfo('description'); ?></p>
                        </a> 
                    </div>
                    <div class="up__element">
                        <?php 
                            // récupération des données de l'utilisateur connecté
                            $current_user = wp_get_current_user();
                            //echo $current_user->user_login; // prints the user's display name
                        ?>
                        <!-- Mise en menu dropDown le prénom et nom de l'utilisateur -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                            </svg>
                            <?php 
                                echo ($current_user->user_firstname .' '. $current_user->user_lastname); // affichage du prénom et nom de l'utilisateur connecté
                            ?>
                        </a>
                        <!-- Ajout des items menu au DropDown -->
                        <!-- Selon bootstrap -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>    
                                <a class="menu_user__link" href="<?php echo site_url('/account', ''); ?>">Compte</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>    
                                <a class="menu_user__link" href="<?php echo wp_logout_url( home_url() ); ?>">Quiter</a>
                            </li>
                        </ul>  
                        <?php
                            /* wp_nav_menu ( array (
                                'theme_location' => 'user-menu',
                                'container' => false, // supprime la div que rajoute WP
                                'menu_class' => 'dropdown-menu',
                                'depth' => 1, // interdit le fait d'afficher un sous-menu
                                'walker' => new WPDocs_Walker_Nav_Menu_User() // appel de la classe Walker
                            ) );*/
                        ?>
                    </div>
                </div>
                <div class="header down">
                    <nav class="header__menu menu" id="mainNav" aria-label="Menu principal">
                        <div class="container-fluid">
                            <?php
                                wp_nav_menu ( array (
                                    'theme_location' => 'header-menu',
                                    'container' => false, // supprime la div que rajoute WP
                                    'menu_class' => 'menu__list',
                                    'depth' => 1, // interdit le fait d'afficher un sous-menu
                                    'walker' => new WPDocs_Walker_Nav_Menu() // appel de la classe Walker
                                ) ); 
                            ?>
                        </div>
                    </nav>
                    <nav class="header__menu menu" id="mainNav" aria-label="Menu principal">
                        <div class="container-fluid">
                            <?php
                                wp_nav_menu ( array (
                                    'theme_location'    => 'admin-menu',
                                    'container'         => false, // supprime la div que rajoute WP
                                    'menu_class'        => 'menu__list',
                                    'depth'             => 1, // interdit le fait d'afficher un sous-menu
                                    'walker'            => new WPDocs_Walker_Nav_Menu() // appel de la classe Walker
                                ) );
                            ?>
                        </div>
                    </nav>
                    <!--
                    <nav class="nav">
                        <a class="nav-link" href="<?php echo home_url($path = 'administration', $scheme = null);?>">
                            <i class="bi bi-sliders bi-nav-icon"></i>
                        </a>
                    </nav>
                    -->
                </div>
            </header>
    