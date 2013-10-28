<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php hoffmann_title() ?></title>
        
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <meta name="title" content="<?php bloginfo('name'); ?>">
        <meta name="description" content="<?php echo get_option('meta_description'); ?>">

        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/img/build/favicon.ico">  

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/assets/img/build/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/assets/img/build/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/assets/img/build/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/assets/img/build/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/assets/img/build/apple-touch-icon.png">

        <script type="text/javascript" src="//use.typekit.net/qhv6jcb.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        <script src="<?php echo get_template_directory_uri() ?>/bower_components/modernizr/modernizr.js"></script>

        <?php wp_head() ?>

        <!--[if lt IE 9]>
            <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/bower_components/selectivizr/selectivizr.js"></script>
            <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/bower_components/respond/respond.min.js"></script>
        <![endif]-->
    </head>
    <body <?php body_class() ?>>
        <!-- test test test -->

        <header class="header">

            <?php if ( is_front_page() ) : ?>

                <div class="container">

                    <div class="upper">
                        <h1 class="logo">
                            <a href="<?php bloginfo('url') ?>"><i class="icon-hoffmann"></i><span>Luc Hoffmann Institute</span></a>
                        </h1>
    
                        <?php $handshake = get_option( 'handshake' ); ?>

                        <?php if ( isset( $handshake ) && !empty( $handshake ) ) : $handshake_items = explode( "\n", $handshake ); ?>
    
                            <div class="handshake">

                                <?php foreach ( $handshake_items as $key => $value ) : ?>

                                    <div class="handshake-item<?php if ( $key == 0 ) echo ' fadeUpAndIn' ?>">
                                        <div class="handshake-item-inner">
                                            <p class="handshake-item-message"><?php echo $value ?></p>
                                        </div>
                                    </div>

                                <?php endforeach ?>

                            </div>

                        <?php endif ?>

                    </div><!-- .upper -->

                </div><!-- .container -->

            <?php endif ?>

            <div class="show-menu">
                <a href="#menu"><i class="icon-menu"></i> <span>Show menu</span></a>
            </div>

            <nav id="menu" class="menu" role="navigation">
                <div class="container">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'depth' => 1,
                        'menu_id' => false,
                        'container' => false,
                        'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="logo"><a href="' . get_bloginfo('url') . '"><i class="icon-hoffmann"></i><span>Luc Hoffmann Institute</span></a></li>%3$s</ul>',
                        'link_before' => '<span>',
                        'link_after' => '</span>'
                    ) ) ?>
                </div>
            </nav>

        </header>

        <section class="main" role="main">