<?php get_header(); ?>
        <?php if (have_posts()) : ?>

        <?php if (is_home() || is_archive()): ?>
          <h1>News</h1>
        
        <?php endif; ?>
        <?php if (is_search()): ?>
          <h1>Search results for &#8220;<?php echo @$_GET['s']; ?>&#8221;</h1>
        <?php endif;  ?>
        <?php while (have_posts()) : the_post(); ?>
        <article>
            <header>
                <h1>
                  <?php if (!is_singular()): ?>
                  <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php endif; ?>

                  <?php the_title(); ?>
                  
                  <?php if (!is_singular()): ?>
                  </a>
                  <?php endif; ?>


                  </h1>
                <?php if (is_archive() || is_home()): ?>
                    <p class="byline"><span class="author"><?php the_author(); ?></span> · <span class="date"><?php the_date(); ?></span></p>
                <?php endif; ?>
            </header>
            <div class="entry-content">
            <?php 
                if (is_single() || is_page()) {
                    the_content();
                } else {
                    the_excerpt();
                }?>
            </div>
            <?php if (is_page()) : ?>
<ul class="page-nav">
    <?php wp_list_pages( array('title_li'=>'','depth'=>0,'include'=>get_post_top_ancestor_id()) ); ?>

    <?php wp_list_pages( array('title_li'=>'','depth'=>0,'child_of'=>get_post_top_ancestor_id()) ); ?>
</ul>
          <?php endif; ?>
        </article>
        
        <?php endwhile; ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <nav id="news-pagination" class="pagination">
          <ul>
          <li class="previous">
            <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bsuva' ) ); ?>
          </li>
          <li class="next">
            <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bsuva' ) ); ?>
          </li>
        </ul><!-- #nav-below -->
        </nav>
<?php endif; ?>
    <?php endif; ?>

<?php if (is_home() || is_archive() || is_search()): ?>
<div id="sidebar">
  <?php dynamic_sidebar('news-sidebar-widget-area'); ?>
</div>

<?php endif; ?>

<?php get_footer(); ?>
