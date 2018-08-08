<?php

add_action('wp_enqueue_scripts', 'custom_stylesheet_content');

function custom_stylesheet_content() {
 global $post; 
 ?>
 <style type="text/css">
    <?php
        echo ot_get_option( 'custom_css' );        
    ?>
</style>
<?php }   //eof custom_stylesheet_content