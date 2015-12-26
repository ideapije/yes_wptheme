<?php
/**
 * Template Name:daftaranggota
 */
?>
<?php get_header();?>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
  	<?php
  	$page_viewed = basename($_SERVER['REQUEST_URI']);
  	//var_dump($page_viewed);
  	if($page_viewed=="daftaranggota"){
  		include (TEMPLATEPATH . '/daftarmember.php');
  	}elseif($page_viewed=="1"){
  		include (TEMPLATEPATH . '/lostpass.php');
  	}?>
   </div>
<div class="col-xs-6 col-md-4">
    <?php get_sidebar(); ?>
 </div>
</div>
<?php get_footer(); ?>