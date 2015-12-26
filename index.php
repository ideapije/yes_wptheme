<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package jvm
 * @since jvm 1.0
 */
?>
<?php get_header(); ?>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
<?php if(have_posts()):?>
<?php /*start the loop*/?>
<?php while(have_posts()): the_post();?>
    <?php
    /*include the post-format-specific template for the content.
    *if you want to overload this in a child theme then include file
    *called content___.php (where __is the post format name) and that will be used instead
    */
    get_template_part('content',get_post_format());

    ?>
<?php endwhile;?>
<?php jvm_content_nav( 'nav-below' ); ?>
<?php if(is_home()){?>
 </fieldset>
 <?php }?>
<?php else : ?>
     <?php get_template_part( 'no-results', 'index' ); ?>
<?php endif;?>
  </div>
  <div class="col-xs-6 col-md-4">
    <?php get_sidebar(); ?>
 </div>
</div>


<?php get_footer(); ?>