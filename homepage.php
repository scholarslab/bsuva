<?php
/**
 * Template Name: Home Page
 *
 * A custom page template for the home page.
 */
get_header(); ?>

<div id="home-intro">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; endif; ?>
</div>

<div id="home-primary">
    <?php dynamic_sidebar( 'primary-home-widget-area' ); ?>
</div>

<div id="home-secondary">

    <?php if ($sibPage = get_page_by_title('Studies in Bibliography')): ?>
    <div id="journal-blurb">
        <div class="kicker">
        Our Journal
        </div>
        <h2><a href="<?php echo get_permalink($sibPage->ID); ?>">Studies in Bibliography</a></h2>
        <?php dynamic_sidebar( 'secondary-home-widget-area' ); ?>
        
    </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
