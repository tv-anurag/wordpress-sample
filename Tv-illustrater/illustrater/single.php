<?php get_header(); ?>
  <div class="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
      <section class="singleproduct">          
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="productsinfo">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <?php $use_other_image = get_field('use_other_image');
                  if($use_other_image){ 
                ?>              
                  <img src="<?php echo $use_other_image; ?>" alt="<?php echo get_the_title(); ?>">
                <?php 
                  } else { 
                   the_post_thumbnail('full');
                  }
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="productssidebar">
                <div class="productdownload">                  
                  <?php 
                    $product_price = get_field('product_price');
                    if($product_price == 0){
                      echo "<h1>FREE</h1>";
                    }else{                      
                      echo "<h1>$".$product_price."</h1>";
                    }

                   $product_links = get_field('product_links');
                      if($product_links){ 
                    ?>              
                      <a href="<?php echo $product_links; ?>"><?php _e( 'DOWNLOAD', 'ni' ); ?></a>
                    <?php 
                      }
                    ?>
                  
                </div>
              </div>
              <?php $product_details = get_field('product_details');
                if($product_details){ 
              ?>              
                <div class="productssidebar">
                  <div class="productotherinfo">
                    <?php echo $product_details; ?>
                  </div>
                </div>
              <?php 
                }
              ?>
            </div>
          </div>
        </div>
      </section>

      <section class="Packssection">
        <div class="container">
          <?php  
            $currentblogid=get_the_ID();
            $args = array(
              'post_type' => 'illustrationsystems',
				'orderby'   => 'rand',
              'posts_per_page' => 3,
              'post__not_in' => array($currentblogid),
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {  
          ?>
            <h1 class="section-head"><?php _e( 'More Illustrations', 'ni' ); ?></h1>
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
        </div>
      </section>
    <?php endwhile; endif; ?>
  </div>


<?php get_footer(); ?>
