        </div>
        <aside class="pd-sidebar col-lg-3 order-2 order-lg-1">
          <?php get_sidebar(); ?>
        </aside>
      </div>
    </main>
    <footer class="pd-footer">
      <p class="pd-copyright">&copy; PD Kranj</p>
      <?php /*
      <?php dynamic_sidebar('footer'); ?>
      <?php wp_nav_menu([
        'menu'          	=> 'footer',
        'theme_location'	=> 'footer',
        'depth'         	=> 2,
        'container'			  => false,
        //'menu_class'    	=> 'navbar-nav',
        'fallback_cb'   	=> '__return_false',
        'walker'         	=> new bootstrap_5_wp_nav_menu_walker()
      ]); ?>
      */ ?>
    </footer>
    <?php wp_footer(); ?>
	</body>
</html>
