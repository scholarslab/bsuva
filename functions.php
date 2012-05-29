<?php

// Add theme support for post-thumbnails
add_theme_support( 'post-thumbnails' );

// Adds feeds to theme head.
add_theme_support( 'automatic-feed-links' );

// Register menus.
register_nav_menu( 'header', __( 'Header Menu', 'bsuva' ) );
register_nav_menu( 'journal-blurb', __( 'Journal Blurb Menu', 'bsuva' ) );

// Register widgets.
function bsuva_widgets_init() {
    $beforeTitle = '<h2>';
    $afterTitle = '</h2>';

    register_sidebar( array(
        'name' => __( 'Primary Home Widget Area', 'bsuva' ),
        'id' => 'primary-home-widget-area',
        'description' => __( 'The primary home widget area', 'bsuva' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => $beforeTitle,
        'after_title' => $afterTitle
    ) );

    register_sidebar( array(
        'name' => __( 'Secondary Home Widget Area', 'bsuva' ),
        'id' => 'secondary-home-widget-area',
        'description' => __( 'The secondary home widget area', 'bsuva' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => $beforeTitle,
        'after_title' => $afterTitle
    ) );

    register_sidebar( array(
        'name' => __( 'Primary Footer Widget Area', 'bsuva' ),
        'id' => 'primary-footer-widget-area',
        'description' => __( 'The first footer widget', 'bsuva' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => $beforeTitle,
        'after_title' => $afterTitle
    ) );

    register_sidebar( array(
        'name' => __( 'Secondary Footer Widget Area', 'bsuva' ),
        'id' => 'secondary-footer-widget-area',
        'description' => __( 'The second footer widget', 'bsuva' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => $beforeTitle,
        'after_title' => $afterTitle
      ) );

    register_sidebar( array(
        'name' => __( 'News Sidebar Widget Area', 'bsuva' ),
        'id' => 'news-sidebar-widget-area',
        'description' => __( 'The sidebar for the news archive and individual posts.', 'bsuva' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => $beforeTitle,
        'after_title' => $afterTitle
    ) );

}

add_action( 'widgets_init', 'bsuva_widgets_init' );

/**
 * HTML5 Shiv Markup 
 *
 * Adds markup for the HTM5 shiv, which helps versions of IE 8 and
 * order recognize and style HTML5 elements. By Remy Sharp.
 *
 */
function bsuva_add_html5shiv_markup() {
?>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
}

add_action('wp_head', 'bsuva_add_html5shiv_markup');

/**
 * Customizable syntax for the site title.
 *
 **/
function bsuva_site_title() {
    $siteTitle = get_bloginfo('site_title');
    
    if (is_single() || is_page()) {
        $siteTitle = get_the_title()
                   . ' &middot; '
                   . $siteTitle;
    }

    return $siteTitle;
}

/**
 * Replaces "[...]" on excerpt_more with an ellipsis.
 */
function bsuva_excerpt_more( $more ) {
  global $post;
  return ' &hellip;' . '<a href="'.get_permalink($post->ID).'">Continue reading.</a>';
}

add_filter( 'excerpt_more', 'bsuva_excerpt_more' );

/* Custom Post Types ********************************************/

function bsuva_register_post_types() {
    register_post_type( 'bsuva_sib_issues',
        array(
            'labels' => array(
                'name' => __( 'SiB Issues' ),
                'singular_name' => __( 'SiB Issue' )
            ),
            'public' => true,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
            'menu_position' => 20,
            'hierarchical' => true,
            'has_archive' => true,
            'show_in_nav_menus' => true
        )
    );
}

add_action( 'init', 'bsuva_register_post_types' );

/**
 * Reads the epubs directory and generates links to individual epubs
 *
 * @return string HTML string of links
 */
function bsuva_studies_in_bib_listing()
{
    $html = '';

    $epubDir = WP_CONTENT_DIR . '/epubs';

    $listings = opendir($epubDir);
    $listing_array = array();
    while($listing_array[] = readdir($listings));

    sort($listing_array);
    closedir($listings);

    foreach ($listing_array as $issue) {
        $issueUrl = WP_CONTENT_URL . '/epubs/' . $issue;
        $epubName = trim(preg_replace('/\(.*\)/', '', $issue));
        $epubName = str_replace(' ', '_', $epubName);
        $epubUrl = $issueUrl . '/'.$epubName.'.epub';

         $html .= '<li class="issue">'
                  . '<a href="'.$epubUrl.'">'
                  . trim($issue).'</a>'
                  . '</li>';
    }


     //while (false !== ($issue = readdir($listings))) {
        //if ($issue != "." && $issue != ".." && is_dir($epubDir . '/' . $issue)) {
            //$issueUrl = WP_CONTENT_URL . '/epubs/'.$issue;
            //$epubName = trim(preg_replace('/\(.*\)/', '', $issue));
            //$epubName = str_replace(' ', '_', $epubName);
            //$epubUrl = $issueUrl . '/'.$epubName.'.epub';

            //$html .= '<li class="issue">'
                  //. '<a href="'.$epubUrl.'">'
                  //. trim($issue).'</a>'
                  //. '</li>';
        //}
     //}

    return $html;
}

if(!function_exists('get_post_top_ancestor_id')){
/**
 * Gets the id of the topmost ancestor of the current page. Returns the current
 * page's id if there is no parent.
 * 
 * @uses object $post
 * @return int 
 */
function get_post_top_ancestor_id(){
    global $post;
    
    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    
    return $post->ID;
}
}
