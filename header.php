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
                    <h1><?php bloginfo('name'); ?></h1>
                    <h2><?php bloginfo('description'); ?></h2>
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
                                <a class="menu_user__link" href="#">Compte</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>    
                            <a class="menu_user__link" href="#">Quiter</a>
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
                        <a class="nav-link" href="#sites">Sites</a>
                    </nav>
                </div>
            </header>
    