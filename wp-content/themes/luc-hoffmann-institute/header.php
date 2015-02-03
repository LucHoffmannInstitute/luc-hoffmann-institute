<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="<?php bloginfo('name'); ?>">
    <meta name="description" content="<?php echo get_option('meta_description'); ?>">

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/dist/img/favicon.ico">  

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/assets/dist/img/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/assets/dist/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/assets/dist/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/assets/dist/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/assets/dist/img/apple-touch-icon.png">

    <script type="text/javascript" src="//use.typekit.net/qhv6jcb.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    <script src="<?php echo get_template_directory_uri() ?>/assets/dist/scripts/modernizr.js"></script>

    <?php wp_head() ?>

    <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/bower_components/selectivizr/selectivizr.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/bower_components/respond/respond.min.js"></script>
    <![endif]-->
</head>
<body <?php body_class() ?>>

    <header class="Header" role="banner">
        
        <div class="u-container">

            <div class="Header-inner">
            
                <div class="Header-logo"><a href="<?php bloginfo('url') ?>"><i class="icon-hoffmann"></i><span>Luc Hoffmann Institute</span></a></div>

                <?php get_template_part('templates/handshake') ?>

            </div>

        </div>

    </header>

    <?php get_template_part('templates/menu') ?>

    <section class="Main" role="main">