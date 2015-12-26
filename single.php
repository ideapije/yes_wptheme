<?php
/**
 * The Template for displaying all single posts.
 *
 * @package jvm
 * @since jvm 1.0
 */
 ?>

<?php get_header(); ?>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
<?php while(have_posts()):the_post();?>
	<?php get_template_part('content','single');?>
	<?php jvm_content_nav('nav-below');?>
	<?php
	//if comments are open or we have at least one comment,load up the comment template
	if(comments_open() || '0' !=get_comments_number()) {
		comments_template('',true);
	}
	?>
	<?php endwhile; //end of the loop.?>
   <?php if(is_singular("produks")):?>
  <div class="row">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#desc" role="tab" data-toggle="tab">Description</a></li>
  <li><a href="#rev" role="tab" data-toggle="tab">Review</a></li>
  <li><a href="#oth" role="tab" data-toggle="tab">other</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content" style="padding:5px;">
  <div class="tab-pane active" id="desc">
  <?php the_content(); ?>
  </div>
  <div class="tab-pane" id="rev">
  <?php include(TEMPLATEPATH.'/reviewprod.php');?>
  </div>
  <div class="tab-pane" id="oth">
  ....
  </div>
</div>
</div>
<?php endif;?>
</div>
<div class="col-xs-6 col-md-4">
    <?php get_sidebar(); ?>
 </div>
</div>

<?php get_footer(); ?>