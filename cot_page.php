<?php
/*
  Template name:cot
 */
?>
<?php get_header(); ?>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
<?php include (TEMPLATEPATH . '/cot.php'); ?>
  </div>
  <div class="col-xs-6 col-md-4">
    <?php get_sidebar(); ?>
 </div>
</div>
<?php get_footer(); ?>