  <footer>
      <div class="container" id="joinhere">
        <?php if ( is_active_sidebar( 'subscribe-widget-area' ) ) {  dynamic_sidebar( 'subscribe-widget-area' ); } ?>
        <div class="midfooter">
          <div class="row">			  
            <div class="col-md-4 mobilewidget">              
               <?php if ( is_active_sidebar( 'footer-widget-area-3' ) ) {  dynamic_sidebar( 'footer-widget-area-3' ); } ?>
            </div>
            <div class="col-md-2">
              <?php if ( is_active_sidebar( 'footer-widget-area-1' ) ) {  dynamic_sidebar( 'footer-widget-area-1' ); } ?>
            </div>
            <div class="col-md-2">
               <?php if ( is_active_sidebar( 'footer-widget-area-2' ) ) {  dynamic_sidebar( 'footer-widget-area-2' ); } ?>
            </div>            
            <div class="col-md-4 desktopwidget">              
               <?php if ( is_active_sidebar( 'footer-widget-area-3' ) ) {  dynamic_sidebar( 'footer-widget-area-3' ); } ?>
            </div>
            <div class="col-md-2 lasttwo">
               <?php if ( is_active_sidebar( 'footer-widget-area-4' ) ) {  dynamic_sidebar( 'footer-widget-area-4' ); } ?>
            </div>
            <div class="col-md-2 lastone">              
               <?php if ( is_active_sidebar( 'footer-widget-area-5' ) ) {  dynamic_sidebar( 'footer-widget-area-5' ); } ?>
            </div>
          </div>
        </div>
        <div class="btmfooter">
          <?php if ( is_active_sidebar( 'bottom-footer-widget-area' ) ) {  dynamic_sidebar( 'bottom-footer-widget-area' ); } ?>
        </div>
      </div>
    </footer>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


 	<?php wp_footer(); ?>
  </body>
</html>