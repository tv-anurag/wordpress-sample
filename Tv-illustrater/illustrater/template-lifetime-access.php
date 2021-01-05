<?php 
  /* Template Name: Lifetime Access Page Template */
?>
<?php get_header(); ?>

 <div class="main lifetimeaccesspage">
      <section class="banner">          
        <div class="container"> 
          <div class="row">
            <div class="col-md-6 mt-4">
              <div class="bannertext">
                <?php the_content(); ?>
              </div>
            </div>
            <div class="col-md-6">
               <?php the_post_thumbnail(); ?>
            </div>
          </div>
        </div>
      </section>

      <section class="lifetimeworkbox">
        <div class="container">
            <?php 
            $how_it_works = get_field('how_it_works');
            if( $how_it_works ) { ?>
          <h1 class="section-head">How it Works</h1>
          <div class="row">   
            <?php 
                foreach( $how_it_works as $how_it_work ) {
            ?>
              <div class="col-md-4">
                <div class="lifetimework">
                  <img src="<?php echo $how_it_work['image'];?>" alt="<?php echo $how_it_work['title'];?>">
                  <h1><?php echo $how_it_work['title'];?></h1>
                  <?php echo $how_it_work['content'];?>
                </div>
              </div>
            <?php } ?>
          </div>
            <?php } ?>
        </div>
      </section>

       <section class="pricingbox">
        <div class="container">
          <?php 
          $pricing_boxs = get_field('pricing_box');
          if( $pricing_boxs ) { ?>
          <h1 class="section-head">Pricing</h1>  
            <?php 
                foreach( $pricing_boxs as $pricing_box ) {
            ?>
              <div class="pricingboxinner">
                  <h1><span><?php echo $pricing_box['reguler_price'];?></span> <?php echo $pricing_box['sale_price'];?></h1>
                  <?php echo $pricing_box['content'];?>
                  <?php $button_text = $pricing_box['button_text'];
                  if( $button_text ) {
                    echo '<a href="'.$pricing_box['button_link'].'">'.$button_text.'</a>';
                  }
                  ?>
              </div>
            <?php } } ?>
        </div>
      </section>

      <section class="Packssection">
        <div class="container">
          <?php  
            $args = array(
              'post_type' =>  array('illustrationpacks','illustrationsystems','animatedillustration','post','icons'),
              'posts_per_page' => -1,
               'meta_key'       => 'product_price',
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC',
                'meta_query'     => array(
                    array(
                        'key'    => 'product_price',
                        'value'  => 0,
                        'compare'=> '>',
                        'type'   => 'numeric'
                    )
                )
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {  
          ?>
          <h1 class="section-head">Our Products</h1>
          <div class="row">  
            <div class="col-md-4">
                <div class="packsbox">
                  <div class="packsboximg">
                    <a href="<?php echo home_url();?>/free-illustrations/">
                      <img width="640" height="384" src="<?php echo home_url();?>/wp-content/uploads/2020/09/Mobile-App-Design-Image-Preview.png" sizes="(max-width: 640px) 100vw, 640px">                    </a>
                  </div>
                  <a href="<?php echo home_url();?>/free-illustrations/">
                    <h1>Free Illustrations</h1>
                  </a>
                  <span class="price">$0</span>                               
                  <div class="packsboxtext">               
                    <p>A growing library of free illustrations in SVG and PNG.</p>
                  </div>
                </div>
              </div>

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

      <section class="getaccessbox">
        <div class="container">
          <div class="getaccessboxinner">
            <div class="gethead">              
              <img class="gettopleft" src="<?php bloginfo('template_directory');?>/assets/images/rokets.png">
              <img class="getlogo" src="<?php bloginfo('template_directory');?>/assets/images/logo.png">
              <img class="gettopright" src="<?php bloginfo('template_directory');?>/assets/images/clude.png">
            </div>

            <img class="getbtmleft" src="<?php bloginfo('template_directory');?>/assets/images/get-img.png">
            <img  class="getbtmright" src="<?php bloginfo('template_directory');?>/assets/images/Person-Sitting.png">
            <p>Get access to all current and future illustrations for life.</p>
            <?php if( $pricing_boxs ) { 
                foreach( $pricing_boxs as $pricing_box ) {
                 $button_text = $pricing_box['button_text'];
                  if( $button_text ) {
                    echo '<a href="'.$pricing_box['button_link'].'">'.$button_text.' <span>'.$pricing_box['reguler_price'].'</span> '.$pricing_box['sale_price'].'</a>';
                  } 
                }   
              } 
            ?>
          </div>
        </div>
      </section>

      


      <section class="specialsection">
        <div class="container">
           <?php echo do_shortcode('[faqs terms="lifetime-access"]');?>
      </section>
    </div>
<?php get_footer(); ?>