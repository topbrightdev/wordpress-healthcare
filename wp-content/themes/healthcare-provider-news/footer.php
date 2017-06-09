  
  </div> <?php // end .main ?>

  <footer class="footer-wrap" id="footer" style="background-image: url(<?php echo get_theme_mod('footer_background_image'); ?>);">
    <div class="lrp-container">
      <div class="footer">
        <div class="footer__message">
          <?php if ( is_active_sidebar( 'widget_footer_left' ) ) { dynamic_sidebar( 'widget_footer_left' ); } ?>
        </div>
        <div class="footer__form">
          <?php if ( is_active_sidebar( 'widget_footer_right' ) ) { dynamic_sidebar( 'widget_footer_right' ); } ?>
        </div>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>

  <!--[if lt IE 9]>
    <script src="<?php bloginfo('template_directory'); ?>/assets/dist/js/rem.min.js"></script>
  <![endif]-->

  </body>
</html>