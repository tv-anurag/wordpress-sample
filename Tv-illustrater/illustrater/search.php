<?php get_header(); ?>
<div class="main">
  <section class="Packssection">
    <div class="container">
		<?php if ( have_posts() ) : ?>
		<h1 class="section-head"><?php _e('Search result for :', 'ni'); the_search_query(); ?></h1>
      <div class="row">          
         <?php while ( have_posts() ) : the_post(); ?>
          <div class="col-md-4">
            <div class="packsbox">
              <div class="packsboximg">
                <a href="<?php the_permalink(); ?>">
                  <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail('large');
                    }else{ 
                  ?>
                    <img class="wp-post-image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/noimage.jpg" alt="<?php echo get_the_title(); ?>">
          				<?php } ?>
                </a>
              </div>
              <a href="<?php the_permalink(); ?>">
                <h1><?php the_title(); ?></h1>
              </a>                
              
              <div class="packsboxtext">               
                <?php the_excerpt(); ?>
              </div>
            </div>
          </div>           
          <?php endwhile; ?>	
      </div>
		  <?php else : ?>
      		<h1 class="section-head"><?php _e('Search result for :', 'ni'); the_search_query(); ?></h1>
      		<div class="row"> 
              <div class="col-md-12 text-center">
                    <h2><?php _e( 'Sorry, No results found.', 'ni' ); ?></h2>
              </div>   
      		</div>		
	    <?php endif; ?>

      <div class="text-center">
        <div class="paginations">
          <?php
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
              'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
              'format' => '?paged=%#%',
              'current' => max( 1, get_query_var('paged') ),
              'total' => $wp_query->max_num_pages
            ) );
          ?>
        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>