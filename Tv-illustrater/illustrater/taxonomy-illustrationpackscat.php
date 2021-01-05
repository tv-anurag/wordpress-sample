<?php get_header(); ?>  
<div class="main">
  <section class="Packssection">
    <div class="container">
      <h1 class="section-head"><?php single_cat_title( '', true ); ?> <?php _e( 'Illustrations Packs', 'ni' ); ?></h1> 

      <div class="row">          
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="col-md-4">
              <div class="packsbox">
                <div class="packsboximg">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large'); ?>
                  </a>
                </div>
                <a href="<?php the_permalink(); ?>">
                  <h1><?php the_title(); ?></h1>
                </a>
                <?php 
                  echo "<span class='price'>$".get_field('product_price')."</span>";
                ?>                               
                <div class="packsboxtext">               
                  <?php the_excerpt(); ?>
                </div>
              </div>
            </div>  
        <?php endwhile; else : ?>
          <div class="col-md-12 text-center">
                <h2><?php _e( 'Sorry, No Illustratsection Packs found.', 'ni' ); ?></h2>
          </div>
        <?php endif; wp_reset_postdata();  ?>    
      </div>

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
<?php get_footer();?>