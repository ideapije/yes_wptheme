<?php

// Enqueue Flexslider Files
 
    function wptuts_slider_scripts() {
        wp_enqueue_script( 'jquery' );
 
        wp_enqueue_style( 'flex-style', get_template_directory_uri() . '/inc/slider/css/flexslider.css' );
 
        wp_enqueue_script( 'flex-script', get_template_directory_uri() .  '/inc/slider/js/jquery.flexslider-min.js', array( 'jquery' ), false, true );
    }
    add_action( 'wp_enqueue_scripts', 'wptuts_slider_scripts' );


    // Initialize Slider
 
    function wptuts_slider_initialize() { ?>
        <script type="text/javascript" charset="utf-8">
            jQuery(window).load(function() {
                jQuery('.flexslider').flexslider({
                    animation: "fade",
                    direction: "horizontal",
                    slideshowSpeed: 7000,
                    animationSpeed: 600
                });
            });
        </script>
    <?php }
    add_action( 'wp_head', 'wptuts_slider_initialize' );



    // Create Slider
 
    function wptuts_slider_template() {
 
        // Query Arguments
        $args = array(
            'post_type' => 'slides',
            'posts_per_page' => 5
        );  
 
        // The Query
        $the_query = new WP_Query( $args );
 
        // Check if the Query returns any posts
        if ( $the_query->have_posts() ) {
 
            // Start the Slider ?>
            <div class="flexslider">
                <ul class="slides">
              <?php
                    // The Loop
                    while($the_query->have_posts() ) : $the_query->the_post(); ?>
                        <li>
<div class="col-xs-12"><h1>sdjad</h1></div>
                        <?php // Check if there's a Slide URL given and if so let's a link to it
                        if ( get_post_meta( get_the_id(), 'wptuts_slideurl', true)!=''){ ?>

                            <a href="<?php echo esc_url( get_post_meta( get_the_id(), 'wptuts_slideurl', true) ); ?>">
                        <?php }
 
                        // The Slide's Image
                        echo the_post_thumbnail();
 
                        // Close off the Slide's Link if there is one
                        if ( get_post_meta( get_the_id(), 'wptuts_slideurl', true) != '' ) { ?>
                            </a>
                        <?php } ?>
 
                        </li>
                    <?php endwhile; ?>
 
                </ul><!-- .slides -->
            </div><!-- .flexslider -->
 
        <?php }
 
        // Reset Post Data
        wp_reset_postdata();


        // Slider Shortcode
 
    function wptuts_slider_shortcode() {
        ob_start();
        wptuts_slider_template();
        $slider = ob_get_clean();
        return $slider;
    }
    add_shortcode( 'slider', 'wptuts_slider_shortcode' );
    }
?>