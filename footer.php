    </div>
    <footer role="contentinfo">
    <?php
    $sidebars = array('primary-footer-widget-area', 'secondary-footer-widget-area');
    foreach ($sidebars as $sidebar) :
        if (is_active_sidebar($sidebar)) :
    ?>
    <div id="<?php echo $sidebar; ?>">
    <?php dynamic_sidebar( $sidebar ); ?>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    </footer>
    <?php wp_footer(); ?>
    
</body>
</html>