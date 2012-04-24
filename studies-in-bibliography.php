<?php
/**
 * Template Name: Studies in Bibliography
 *
 * A custom page template for listing the Studies in Bibliography page.
 */

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
    <?php the_content(); ?>

    <ol id="studies-in-bibliography">        
        <?php echo bsuva_studies_in_bib_listing();?>
    </ol>
    </div>
</article>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
