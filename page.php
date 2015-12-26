<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package jvm
 * @since jvm 1.0
 */
 
get_header(); ?>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
<?php while(have_posts()):the_post();?>
	<?php get_template_part('content','page');?>
	<?php comments_template('',true);?>
<?php endwhile;?>
	</div>
<div class="col-xs-6 col-md-4">
    <?php get_sidebar(); ?>
 </div>
</div>
<?php get_footer(); ?>