<?php 
  /* Template Name: Home Page Template */
?>
<?php get_header(); ?>
 <div class="main">
      <section class="banner">          
        <div class="container"> 
          <div class="row">
            <div class="col-md-6">
              <div class="bannertext">
                <?php the_content(); ?>                
                <div class="Subscribebox">                  
                  <?php echo get_field('subscribe_form'); ?>                  
                </div>
              </div>
            </div>
            <div class="col-md-6 mt-5 pt-2">
              <?php the_post_thumbnail(array(600, 500)); ?>
            </div>
          </div>
        </div>
      </section>
      <section class="illustratsection">
        <div class="container">
          <h1 class="section-head"><?php the_field('free_illustrations_title');?></h1>		  
          <?php echo get_field('free_illustrations_category');?>
          <div class="viewall">
            <a href="<?php echo home_url();?>/free-illustrations/"><?php _e( 'View All Categories', 'ni' ); ?></a>
          </div>
        </div>
      </section>
      
      <section class="Packssection">
        <div class="container">
          <?php  
            $args = array(
              'post_type' =>  array('illustrationpacks','illustrationsystems'),
              'posts_per_page' => 6,
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {  
          ?>
          <h1 class="section-head"><?php the_field('illustration_packs_title');?></h1>
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

      <section class="specialsection">
        <div class="container">
           <?php 
            $specials = get_field('special_post');
            if( $specials ) {?>
              <h1 class="section-head"><?php the_field('what_makes_title');?></h1>
              <?php echo "<div class='specialboxes'>";
                foreach( $specials as $special ) {
            ?>
            <div class="row">
              <div class="col-md-6 specialtext">
                <div class="specialillustrat">
                  <h1><?php echo $special['title'];?></h1>
                  <?php echo $special['content'];?>
                </div>
              </div>
              <?php $specialimage = $special['image'];
                if($specialimage){
              ?>
              <div class="col-md-6 specialillustratimg">
                <img src="<?php echo $specialimage;?>" alt="<?php echo $special['title'];?>">
              </div>
            </div>
            <?php } } ?>
          </div>
        <?php } ?>
        </div>
      </section>
    </div>
<?php get_footer(); ?>
