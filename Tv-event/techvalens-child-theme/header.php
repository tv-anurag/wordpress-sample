<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Techvalens-Theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
	  <title><?php bloginfo('title'); ?> | <?php bloginfo('description'); ?></title>
	  <link rel="favicon icon" type="image/png" href="<?php the_field('fevicon','option');?>">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
            <a class="navbar-brand" href="<?php echo site_url();?>"><img width="121" src="<?php the_field('logo','option');?>" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample07">

            <?php 
            wp_nav_menu( array( 
              'theme_location' => 'menu-1',
              'container' => 'ul',
              'menu_class'=> 'navbar-nav mr-auto',
              'add_li_class'  => 'nav-item',
              'link_class'   => 'nav-link m-2 menu-item nav-active' 
            ) );
            ?>
            </div>
          </div>
        </nav>
    </header>