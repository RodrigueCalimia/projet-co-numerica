<?php get_header()?>
<div class="main">
    <!-- affichage du nom de la page -->    
    <h1><?php the_title()?></h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <?php echo do_shortcode('[ultimatemember form_id="8"]');?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>