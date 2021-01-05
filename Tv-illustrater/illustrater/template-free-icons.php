<?php 
  /* 
    Template Name: Free Icons Page Template
  */
  get_header();
?>
  <div class="main">
    <section class="Packssection">
        <div class="container">
        <h1 class="section-head"><?php the_title();?></h1>
        <div class="sectio-info"><?php the_content(); ?></div>
        <?php  
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array(
            'post_type' => 'icons',
            'posts_per_page' => -1,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'iconscat',
                    'field'    => 'slug',
                    'terms'    => 'free',
                ),
            ),
          );
          $query = new WP_Query($args);
          if ( $query->have_posts() ) {  
        ?>
        <div class="row">          
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
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
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php } ?>

        <div class="text-center">
          <div class="paginations">
            <?php
              global $wp_query;
              $big = 999999999; // need an unlikely integer
              echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $query->max_num_pages
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
            'post_type' => 'icons',
            'posts_per_page' => -1, 
            'tax_query' => array(
                array(
                    'taxonomy' => 'iconscat',
                    'field'    => 'slug',
                    'terms'    => 'packs',
                ),
            ),
          );
          $query = new WP_Query($args);
          $i=1;
          $count = $query->found_posts;
          $itemcount= ($count%3);
          $showitem= ($count - $itemcount);

          if ( $query->have_posts() ) {  
        ?>
        <h1 class="section-head"><?php _e( 'More Icons', 'ni' ); ?></h1>
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
            <?php $i++; } endwhile; wp_reset_postdata(); ?>
        </div>
        <?php } ?>
      </div>
    </section>

    <section class="specialsection">
      <div class="container">
        <?php echo do_shortcode('[faqs terms="free-icons"]');?>
      </div>
    </section>
  </div>
<?php get_footer();?>