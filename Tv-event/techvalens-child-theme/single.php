<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Techvalens-Theme
 */

get_header();
?>

<div class="main">
    <section ng-controller="event" class="ng-scope">
		<div class="container">
			<div class="row">

			<div class="col-sm-12">
				<div class="event pagehead clearfix">
				<h1 class="page-title event-details ng-binding">Celtic Woman</h1><a class="backtoevent btn btn-primary btn-back-event" href="<?php echo site_url();?>/events/">Back to events list</a>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-4 col-md-push-8">
				<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="socialbox event">

					<p class="event-p event-time-onsale ng-scope">On sale now</p>
					<?php 
					$single_time = get_post_meta( get_the_ID(), 'time' ); 
					$single_location = get_post_meta( get_the_ID(), 'location' ); 
					$single_price = get_post_meta( get_the_ID(), 'price' ); 
					?>
					<p class="tic-con-black ng-binding"><b>Show Time</b> : <?php echo $single_time[0];?> (ET)</p>
					<a href="/venue/merrill-auditorium" class="event-tickets-loc ng-binding"><?php echo $single_location[0];?></a>
					</div>
					<div class="comb-ticket-pack">

					<div class="ds-ticked-box ng-scope" ng-repeat="ticket in EventDetails.tickets">
					<a href="https://boxoffice.porttix.com/celtic-woman-merrill-auditorium-portland-maine/" target="_blank">
					<div class="ticket-box sidebartktbox">
						<img class="ds-img-left" src="<?php echo site_url();?>/wp-content/uploads/2020/12/red_top.png">
						<div class="mask-left"></div>

						<div class="ticket-packs">
							<div class="ticket-name text-uppercase ng-binding">Reserved Seating</div>
							<div class="ticket-content">
							</div>
						</div>
						<div class="mask-right">
							<div class="ticket-price ng-binding"><?php echo $single_price[0];?></div>
							<div class="ticket-buy">BUY</div>
						</div>
					</div>
					</a>
					</div>
					
					</div>
					<div class="evntseatbox ng-scope">
					<h3 class="phonetitle">Seating Chart</h3>
					<div class="row">
						<div class="col-xs-12 col-md-12 col-sm-12">
						<img style="width: 100%;object-fit: cover;padding-bottom: 5px;" src="<?php echo site_url();?>/wp-content/uploads/2020/12/seating.jpg">
						</div>
					</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					
				</div>
				</div>
			</div>
			<div class="col-md-8 col-md-pull-4">
				<div class="box singlepageimg">
				<div class="monthdate">
					<span class="month text-uppercase ng-binding">Mar</span><span class="date ng-binding">25  </span>
				</div>
				<img src="<?php echo get_the_post_thumbnail_url();?>" lazy-img="<?php echo get_the_post_thumbnail_url();?>" alt="" class="center-block event-center-img img-responsive">
				<div class="txt-desc ng-binding">
					<p><?php the_content();?></p>
				</div>
				</div>
				<div class="box info ng-scope" ng-if="EventDetails.termsAndRules" style="">
				<h3 class="event-terms-title">Terms</h3>
				<div class="txt-desc ng-binding">
					<p><?php the_field('event_text','option');?></p>

					<?php 
					$event_img = get_field('event_image', 'option');
					if( $event_img !=""){?>
						<img src="<?php echo $event_img;?>">
					<?php }?>
				</div>
				</div>
			</div>
			</div>
		</div>
	</section>
</div>


<?php
get_footer();
