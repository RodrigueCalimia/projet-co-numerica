<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>   
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <?php wp_head(); ?>
    </head>
    <body class="body_login">
        <div class="login d-flex">
            <div class="login_left d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-8">
                            <!-- LOGO NUMERICA  -->
                            <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 200 27" style="enable-background:new 0 0 200 27;" xml:space="preserve">
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
                            <h2 class="text-uppercase font-weight-bold"><?php bloginfo('description'); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login_right d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-4">
                            <?php echo do_shortcode('[ultimatemember form_id="7"]');?>
                        </div>
                    </div>
                </div>
            </div>     
            <footer>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>