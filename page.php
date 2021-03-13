<?php //get_header()?>

<?php
    /*******************************************************\
                Gestion d'affichage des pages
    \*******************************************************/
    $pageTitle = get_the_title();
    $slugPage = basename(get_permalink());
    if($pageTitle == 'Tableau de bord'){
        get_template_part( 'template-parts/content/content', 'dashboard');
    }
    /*******************************************************\
                            FORMATIONS
    \*******************************************************/
    if($slugPage == 'creer-une-formation'){
        get_template_part( 'template-parts/forms/create', 'formation');
    }
    if($slugPage == "modifier-une-formation"){
        get_template_part( 'template-parts/forms/update', 'formation');
    }
    /*******************************************************\
                        SITES NUMERICA
    \*******************************************************/
    if($slugPage == 'creer-un-site'){
        get_template_part( 'template-parts/forms/create', 'site');
    }
    if($slugPage == "modifier-un-site"){
        get_template_part( 'template-parts/forms/update', 'site');
    }
    /*******************************************************\
                            UTILISATEURS
    \*******************************************************/
    if($slugPage == 'creer-un-utilisateur'){
        get_template_part( 'template-parts/forms/create', 'utilisateur');
    }
    if($slugPage == "modifier-un-utilisateur"){
        get_template_part( 'template-parts/forms/update', 'utilisateur');
    }
    /*******************************************************\
                            ENTREPRISES
    \*******************************************************/
    if($slugPage == 'creer-une-entreprise-opco'){
        get_template_part( 'template-parts/forms/create', 'entreprise-opco');
    }
    if($slugPage == "modifier-une-entreprise-opco"){
        get_template_part( 'template-parts/forms/update', 'entreprise-opco');
    }
    /*******************************************************\
                    COÛTS DE FONCTIONNEMENT
    \*******************************************************/
    if($slugPage == 'modifier-les-couts-de-fonctionnement'){
        get_template_part( 'template-parts/forms/update', 'couts-fonctionnement');
    }
    /*******************************************************\
                            DEVIS
    \*******************************************************/
    if($pageTitle == 'Devis'){
        get_template_part( 'template-parts/listes/liste', 'devis');
    }
    if($pageTitle == 'Créer un devis'){
        get_template_part( 'template-parts/process/process', 'devis');
    }
    /*******************************************************\
                        ADMINISTRATION
    \*******************************************************/
    if($pageTitle == 'Administration'){
        get_template_part( 'template-parts/content/content', 'administration');
    }
    /*******************************************************\
                            PROJETS
    \*******************************************************/
    if($pageTitle == 'Projets'){
        get_template_part( 'template-parts/process/convertir', 'en-projet');
    }
    if($pageTitle == 'Créer un projet'){
        get_template_part( 'template-parts/process/process', 'projet');
    }
    /*******************************************************\
                        ULTIMATE MEMBER
    \*******************************************************/
    if($pageTitle == 'Compte'){
        get_template_part( 'template-parts/content/content', 'account');
    }
    if($pageTitle == 'Utilisateur·rice'){
        get_template_part( 'template-parts/content/content', 'user');
    }
    if($pageTitle == 'Réinitialisation du mot de passe'){
        get_template_part( 'template-parts/content/content', 'password-reset');
    }
?>

<?php //get_footer(); ?>