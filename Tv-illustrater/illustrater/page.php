<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="main">
    <section class="illustratsection">
      <div class="container">
        <h1 class="section-head"><?php the_title(); ?></h1>
        
        <div class="pagecontent">
          <!-- <?php the_post_thumbnail( 'full' ); ?> -->
          <?php the_content(); ?>
        </div>
      </div>
    </section>   
  </div>  
<?php endwhile; endif; ?>
<?php get_footer(); ?>