<?php 
  /* Template Name: Affiliates Page Template */
?>
<?php get_header(); ?>
 <div class="main">
      <section class="banner">          
        <div class="container"> 
          <div class="row">
            <div class="col-md-6 mt-4">
              <div class="bannertext">
                <?php the_content(); ?>
              </div>
            </div>
            <div class="col-md-6">
               <?php the_post_thumbnail(array(472, 500)); ?>
            </div>
          </div>
        </div>
      </section>
      <section class="affiliatesbox">
        <div class="container">
          <div class="row">
            <?php 
            $affiliates = get_field('affiliates_post');
            if( $affiliates ) {
                foreach( $affiliates as $affiliate ) {
            ?>
              <div class="col-md-4">
                <div class="affiliatinner">
                  <h1><?php echo $affiliate['title'];?></h1>
                  <?php echo $affiliate['content'];?>
                  <a href="<?php echo $affiliate['button_links'];?>"><?php echo $affiliate['button_text'];?></a>
                </div>
              </div>
            <?php } } ?>
          </div>
        </div>
      </section>

      <section class="specialsection">
        <div class="container">
           <?php echo do_shortcode('[faqs terms="affiliates"]');?>
      </section>
    </div>
<?php get_footer(); ?>