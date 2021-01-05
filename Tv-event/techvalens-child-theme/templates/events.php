<?php
/* Template Name:Events */
get_header();
?>

    <div class="main"> 
        <section class="onsale">
        <div class="container pad-top-50">
            <div class="row">
                <div class="col-sm-12"> 
                    <h1 class="title"><span>All Events</span></h1>                   
                </div>
            </div>

            
            <div class="row">

                        <?php $args = array(
                            'post_type' => 'post' ,
                            'orderby' => 'date' ,
                            'order' => 'DESC' ,
                            'posts_per_page' => -1,
                            'category'         => '3',
                            'paged' => get_query_var('paged'),
                            'post_parent' => $parent
                             ); 
                        ?>
                       <?php query_posts($args); ?>
                       <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                            <div class="col-sm-6 col-md-3 sr-sale sale ng-scope">
                                <div class="saleimage">
                                    <?php 
                                    $publish_month = get_the_date('M');
                                    $publish_day = get_the_date('d');
                                    ?>
                                    <div class="monthdate"><span class="month text-uppercase ng-binding"><?php echo $publish_month;?></span><span class="date ng-binding"><?php echo $publish_day;?> </span></div>
                                    <a href="<?php the_permalink();?>">
                                        <img src="<?php echo get_the_post_thumbnail_url();?>" lazy-img="<?php echo get_the_post_thumbnail_url();?>" alt="" class="center-block" height="270">
                                    </a>
                                </div>
                                <div class="content">
                                    <h3 class="saletitle"><a href="<?php the_permalink();?>" class="ng-binding"><?php the_title();?></a></h3>
                                    <p class="subtitle ng-binding"><?php the_field('tag_line');?></p>
                                    
                                    <?php 
                                        $parking = get_field('parking');
                                        if($parking =='Yes') {   
                                    ?>
                                        <div class="salebuttons clearfix">
                                            <button class="btn btn-primary parking firstbtn ng-scope"><a href="javascript:void(0)"><span class="ic-parking"></span>Parking</a></button>
                                        </div>
                                    <?php }?>
                                    
                                    <?php 
                                        $package = get_field('package');
                                        if($package =='Yes') {   
                                    ?>
                                        <div class="salebuttons clearfix">
                                            <button class="btn btn-primary parking secondbtn ng-scope"><a href="javascript:void(0)"><span class="ic-package"></span>PACKAGE</a></button>
                                        </div>
                                    <?php }?>

                                    <p class="doorshow ng-binding">Show: <?php the_field('time');?> (ET)</p>
                                    <a href="javascript:void(0)" class="link ng-binding"><?php the_field('location');?></a>
                                </div>
                                <div class="buyprice ng-scope">
                                    <?php if(get_field('price') !=""){?>
                                        <div class="price ng-binding"><?php the_field('price');?></div>
                                        <a href="<?php the_permalink();?>" class="buy ng-scope">On Sale Now</a>
                                    <?php } else { ?>
                                        <span class="free">TBA</span>
                                    <?php }?>
                                </div>
                            </div>

                            <?php endwhile; ?>
                        <?php endif; 
                        wp_reset_query();
                        ?>
            </div>
        </div>
    </section>    
    </div>

<?php get_footer();?>