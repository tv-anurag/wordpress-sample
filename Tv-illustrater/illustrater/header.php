<!doctype html> 
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title( ' | ', true, 'right' ); ?></title>
    <!--<link rel="icon" href="<?php bloginfo('template_directory');?>/assets/images/favicon.png" type="image/png" sizes="16x16">-->
    <?php wp_head(); ?>
  </head>
  <body>
    <header>
      <div class="container">         
      <?php 
          $custom_logo_id = get_theme_mod( 'custom_logo' );
          $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      ?>
      <!-- Desktop Navbar -->
        <nav class="navbar desktopmenu">
          <div class="row">
            <div class="col-lg-4">
              <?php 
                 wp_nav_menu(array(
                   'theme_location' => 'main-menu-left', 
                   'menu_class'      => 'navleft',
                 ));          
              ?>  
             
            </div>
            <div class="col-lg-4 text-center">
              <a class="navbar-brand" href="<?php echo home_url();?>">
                <?php
                  if ( has_custom_logo() ) { ?>
                      <img class="logo" src="<?php echo esc_url( $logo[0] );?>" alt="<?php bloginfo( 'name' ); ?>">
                  <?php }else{ 
                   bloginfo( 'name' ); 
                  }
                ?>
              </a>
            </div>
            <div class="col-lg-4">
              <?php 
                 wp_nav_menu(array(
                   'theme_location' => 'main-menu-right', 
                   'menu_class'      => 'navright',
                 ));          
              ?>               
            </div>
          </div>
        </nav>         
      <!-- #Desktop Navbar -->
      <!-- Mobile Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light mobilemenu">
          <a class="navbar-brand" href="<?php echo home_url();?>">
            <?php
              if ( has_custom_logo() ) { ?>
                  <img class="logo" src="<?php echo esc_url( $logo[0] );?>" alt="<?php bloginfo( 'name' ); ?>">
              <?php }else{ 
               bloginfo( 'name' ); 
              }
            ?>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="modal" data-target="#navbarmenu">
            <span class="navbar-icon"></span>
            <span class="navbar-icon"></span>
            <span class="navbar-icon"></span>
          </button>

          <div class="modal" id="navbarmenu">
            <div class="modal-dialog">
              <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <?php 
                   wp_nav_menu(array(
                     'theme_location' => 'mobile-menu', 
                     'menu_class'      => 'navbar-nav mr-auto',
                   ));          
                ?> 
              </div>
            </div>
          </div>
        </nav> 
      <!-- #Mobile Navbar -->
      </div>
    </header>
    <!-- #header -->