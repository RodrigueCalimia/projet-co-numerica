<?php
    // Initialisation des fonctions personnalisées du thème.
    add_action('theme_setup', 'theme_setup');

    // File d'attente des styles et des scripts
    add_action('wp_enqueue_scripts', 'add_theme_style');

    // Register menu locations
    add_action( 'init', 'register_my_menu', 0 );
    