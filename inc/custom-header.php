<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 
    <?php $header_image = get_header_image();
    if ( ! empty( $header_image ) ) { ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
        </a>
    <?php } // if ( ! empty( $header_image ) ) ?>
 
 *
 * @package jvm
 * @since jvm 1.0
 */
 
/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses jvm_header_style()
 * @uses jvm_admin_header_style()
 * @uses jvm_admin_header_image()
 *
 * @package jvm
 */

?>