<?php

    /*******************************************\
    * Les fonctions de paramétrages             *
    \*******************************************/
    function crdtheme_setup(){
        // permet de rendre le code valide pour HTML5.
        add_theme_support(
            'html5',
            array(
            'search-form',
            'gallery',
            'caption',
            'style',
            'script',
            )
        );

        /**
         * permet la prise en charge d'un logo personnalisé.
         * @link https://developer.wordpress.org/themes/functionality/custom-logo/
         */
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
    }

    /*******************************************\
    * File d'attente des scripts et des styles. *
    \*******************************************/
    function add_theme_style() {
        // chargement des CSS
        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css');
        wp_enqueue_style('style-base', get_template_directory_uri().'/dist/css/style.css');
        
        // chargement des Js
        wp_enqueue_script('boostrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js');
        wp_enqueue_script('axios', 'https://unpkg.com/axios/dist/axios.min.js');
    }
    
    /********************************************************************************\
    * Enregistre les emplacements du menu de navigation pour un thème.
    * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
    \********************************************************************************/
    function register_my_menu(){
        register_nav_menus( array(
            'user-menu' => __( 'Menu User'),
            'header-menu' => __( 'Menu Header'),
            'admin-menu' => __( 'Menu Admin'),
            'footer-menu'  => __( 'Menu Footer'),
            'devis-menu'  => __( 'Menu Create Devis'),
        ) );
    }

    function process_custom_login_form() {
        // Validate the username or email field before submitting
        if ( isset($_POST['custom_user'])) {
            $custom_user =  trim($_POST['custom_user']);
            echo '<h2 class="hello"> Hello World !!</h2>';
        }
    }

    

