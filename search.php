<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package jvm
 * @since jvm 1.0
 */
 
get_header(); ?>
 <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
 
            <?php if ( have_posts() ) : ?>
 
                <header class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'jvm' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->
 
                <?php jvm_content_nav( 'nav-above' ); ?>
 
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
 
                    <?php get_template_part( 'content', 'search' ); ?>
 
                <?php endwhile; ?>
 
                <?php jvm_content_nav( 'nav-below' ); ?>
 
            <?php else : ?>
 
                <?php get_template_part( 'no-results', 'search' ); ?>
 
            <?php endif; ?>
 
</div>
<div class="col-xs-6 col-md-4">
    <?php get_sidebar(); ?>
 </div>
</div>
<?php get_footer(); ?>