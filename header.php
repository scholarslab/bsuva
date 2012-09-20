<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo bsuva_site_title(); ?></title>
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">

    <!-- JavaScripts -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/javascripts/modernizr.min.js"></script>
    <script>
      Modernizr.load([
        {
          test: Modernizr.mq(),
          nope: '<?php echo get_stylesheet_directory_uri(); ?>/javascripts/respond.min.js'
        }
      ]);
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <!--[if (gte IE 6)&(lte IE 8)]>
    <script src="<?php echo get_template_directory_uri(); ?>/javascripts/selectivizr.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <header role="banner">
        <h1><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/bsuva-logo.png" alt="<?php bloginfo('site_title'); ?>" /></a></h1>
        <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'header', 'depth' => 1 ) ); ?>
        <form role="search" method="get" id="search" action="<?php echo home_url( '/' ); ?>">
            <label class="screen-reader-text" for="s">Search for:</label>
            <input type="search" value="" placeholder="Search BSUVA" name="s" id="s" />
            <input type="submit" id="searchsubmit" value="Search" />
        </form>
    </header>
    <div id="content">
    <div id="masthead">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/type.jpg">
    </div>
