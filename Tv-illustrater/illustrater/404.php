 <?php get_header(); ?>
  <div class="main">
    <section class="illustratsection">
      <div class="container">
        <h1 class="section-head"><?php _e( 'Page Not Found', 'ni' ); ?></h1>
        
        <div class="pagecontent pnfound">
          <h1>404</h1>
          <p><?php _e( 'Oops, page not found!', 'ni' ); ?></p>
     
          <div class="page-contents">
            <span><?php _e( 'You can search what are interested in:', 'ni' ); ?></span>
            <p class="text-center mt-4">
              <?php echo get_search_form(); ?>
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php get_footer(); ?>