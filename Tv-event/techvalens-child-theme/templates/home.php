<?php
/* Template Name:Home */
get_header();
?>

    <div class="main">
         <section class="banner">
                <div id="demo" class="carousel slide" data-ride="carousel">

                  <!-- Indicators -->
                  <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                  </ul>

                  <!-- The slideshow -->
                  <div class="carousel-inner">

                    <?php
                        $i = 0; 
						if( have_rows('slider_images') ):
                        while( have_rows('slider_images') ) : the_row();$i++;
                        $image = get_sub_field('image');
                    ?>

                    <div class="carousel-item <?php if( $i ==1 ){ echo "active"; }?>">
                     <a href="javascript:void(0)" class="">
                                <div class="home-banner" >
                                    <div class="combined-shape">
                                        <div class="rectangle">
                                            <div class="new-show">NEW SHOW</div>
                                            <div class="show-img"><img src="<?php echo site_url();?>/wp-content/uploads/2020/12/pink_tunda.png"></div>
                                        </div>
                                        <div class="banner-date">
                                            <div class="bn-month ng-binding">Jul</div>
                                            <div class="bn-date ng-binding">08</div>
                                        </div>
                                        <div class="the-guitar-event-of ng-binding">KIDZ BOP LIVE 2020</div>
                                        <div class="joe-bonamassa ng-binding">Wed Jul 8</div>
                                        <div class="fill"><img src="<?php echo site_url();?>/wp-content/uploads/2020/12/place_icon.png"></div>
                                        <div class="pier-in ng-binding">59 Westbrook Arterial, Westbrook, ME</div>
                                    </div>
                                    <div class="gray-img"><img src="<?php echo site_url();?>/wp-content/uploads/2020/12/gray_tunda_bg.png"></div>
                                    <div class="sky-img"><img src="<?php echo site_url();?>/wp-content/uploads/2020/12/sky_tunda_bg.png"></div>
                                    <div class="path">
                                        <div class="tickets-on-sale" style="line-height: 40px">On sale NOW</div>
                                        <div class="bn-event-time">&nbsp;</div>
                                    </div>

                                </div>

                                <img src="<?php echo $image;?>" lazy-img="<?php echo $image;?>" class="banner-fit">
                            </a>
                    </div>
                    <?php	
						endwhile;
						endif;
					?>

                  </div>

                  <!-- Left and right controls -->
                  <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </a>
                  <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </a>

                </div>
          </section>
          <section class="brandingbox text-center">
            <div class="container">

                <div class="row home_venues home-venue-desk">

                    <?php
						if( have_rows('six_box_section') ):
                        while( have_rows('six_box_section') ) : the_row();$i++;
                        $box_image = get_sub_field('box_image');
                        $box_url = get_sub_field('box_url');
                    ?>    
                    <div class="col-sm-2">
                        <a href="<?php echo $box_url;?>">
                            <img ng-src="<?php echo $box_image;?>" alt="" src="<?php echo $box_image;?>">
                        </a>
                    </div>
                    <?php	
						endwhile;
						endif;
					?>
                </div> 
            </div>
        </section>  
        <section class="onsale">
        <div class="container">
            <div class="row">
                <div class="col-sm-12"> 
                    <h1 class="title"><span><?php the_field('featured_title');?></span>
                        <a href="<?php the_field('button_url');?>"><button type="button" class="btn btn-primary pull-right"><?php the_field('button_text');?></button></a>
                    </h1>                   
                </div>
            </div>

            
            <div class="row">

                        <?php $args = array(
                            'post_type' => 'post' ,
                            'orderby' => 'date' ,
                            'order' => 'DESC' ,
                            'posts_per_page' => 4,
                            'cat'  => '3',
                           
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
        <!-- end of container -->
    </section>    
    <section class="ng-scope">
        <div class="container">
            <div class="storebannersection">
                <a href="<?php the_field('store_url')?>">
                    <img src="<?php the_field('store_image');?>" lazy-img="<?php the_field('store_image');?>" alt="">
                    <h1 class="ng-binding"><?php the_field('store_title');?></h1>
                </a>
            </div>
                
        </div>
        
    </section>
    <section class="upcomingsection">
        <div class="container">
        <div class="row">
            <div class="col-sm-12"> 
                <h1 class="title"><?php the_field('show_title');?></h1>
            </div>
        </div>
        <div class="row">

            <?php $args = array(
                'post_type' => 'post' ,
                'orderby' => 'date' ,
                'order' => 'DESC' ,
                'posts_per_page' => 2,
                'cat'         => '4',
                'paged' => get_query_var('paged'),
                'post_parent' => $parent
                    ); 
            ?>
            <?php query_posts($args); ?>
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>

            <div class="col-md-6 upcomingshow clearfix">
                    <div class="upcomingimage">
                            <div class="monthdate">
                                <?php 
                                    $publish_month = get_the_date('M');
                                    $publish_day = get_the_date('d');
                                ?>
                                <span class="month text-uppercase ng-binding"><?php echo $publish_month;?></span><span class="date ng-binding"><?php echo $publish_day;?> </span>
                            </div>
                            <a href="<?php the_permalink();?>"><img src="<?php echo get_the_post_thumbnail_url();?>" lazy-img="<?php echo get_the_post_thumbnail_url();?>" alt="" class="center-block" height="270"></a>
                        </div>
                        <div class="content">
                            <div class="inner">
                                <h3 class="upcomingtitle"><a class="ng-binding" href="<?php the_permalink();?>"><?php the_title();?> </a></h3>
                                <p class="subtitle ng-binding"><?php the_field('tag_line');?></p>
                                <a href="javascript:void(0)" class="link ng-binding"><?php the_field('location');?></a>
                            </div>
    
                            <div class="buyprice ng-scope">
                                <div class="price ng-binding"><?php the_field('price');?></div>
                                <a href="<?php the_permalink();?>" class="buy ng-scope">On Sale Now</a>
                            </div>
                        </div>
                    </div>
            <?php endwhile; ?>
                <?php endif; 
                wp_reset_query();
            ?>
        </div>
    </section>
    </div>

<?php get_footer();?>