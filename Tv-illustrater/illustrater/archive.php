<?php get_header(); ?>
<div class="main">
  <section class="illustratsection">
    <div class="container">
      <h1 class="section-head"><?php single_cat_title( '', true ); ?> Illustrations</h1>
      <a href="<?php echo home_url();?>/free-illustrations/" class="catlink"><i class="fa fa-arrow-left"></i>  All Illustrations</a>

     <div class="row">
       <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="col-md-4">
            <div class="catbox">
              <a href="<?php the_permalink();?>"><?php the_post_thumbnail('large'); ?></a>
            </div>
          </div>
        <?php endwhile; else : ?>
          <div class="col-md-12 text-center">
                <h2><?php _e( 'Sorry, No Free illustratsection found.', 'ni' ); ?></h2>
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

  
  <section class="Packssection">
    <div class="container">
      <?php  
        $args = array(
          'post_type' => 'illustrationpacks',
          'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        $i=1;
        $count = $query->found_posts;
        $itemcount= ($count%3);
        $showitem= ($count - $itemcount);

        if ( $query->have_posts() ) {  
      ?>
      <h1 class="section-head"><?php _e( 'More illustrations', 'ni' ); ?></h1>
      <div class="row">          
        <?php while ( $query->have_posts() ) : $query->the_post(); 
          if(($showitem>=$i) || (3>=$i)){
        ?>
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
          <?php } $i++; endwhile; wp_reset_postdata(); ?>
      </div>
      <?php } ?>
    </div>
  </section>
</div>
<?php get_footer();?>