<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Techvalens-Theme
 */

?>



    <footer class="footer" >
		<div class="actionline">
			<div class="container wid-100">
			<span class="text"><?php the_field('download_app_text','option');?></span>
			</div>
		</div>
		<div class="container content">
			<div class="row">
				<div class="footerlogo">
		     		<a class="navbar-brand" href="<?php echo site_url();?>" alt="Footer Logo"><img src="<?php the_field('footer_logo','option');?>" style="height:50px;"></a>
				</div>
					<div class="footerlinks clearfix">
				      <ul class="pagelinks">
					    <?php 
							wp_nav_menu( array( 
							'theme_location' => 'footer-menu',
							'container' => 'ul', 
							) );
						?>
				      </ul>
		            <div class="social">
						<?php
						if( have_rows('social_icons','option') ):
							while( have_rows('social_icons','option') ) : the_row();
								$social_image = get_sub_field('social_image','option');
								$social_url = get_sub_field('social_url','option'); ?>
								<a href="<?php echo $social_url;?>" target="_blank">
									<img src="<?php echo $social_image;?>" width="24" alt="">
								</a>
						<?php	
						endwhile;
						endif;
						?>
		            </div>
				</div>
			</div>				
		</div>
	
		<div class="copyrights ng-binding">
			<?php the_field('copyright_text','option');?>
		</div>
	</footer>
<?php wp_footer(); ?>

</body>
</html>
