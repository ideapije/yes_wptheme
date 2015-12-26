<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the id=main div and all content after
*
* @package jvm
* @since jvm 1.0
*/
?>

</div>
</div>
<div class="footer">
      <div class="container">
        <p class="text-muted text-center">
          <?php echo comicpress_copyright(); ?>&nbsp<?php bloginfo('name');?>
        </p>
      </div>
</div>
<div class="lightbox-target" id="full">
  <div class="lightbox-isi">
    <div class="img-lightbox-target">
<?php the_post_thumbnail('full');?>
  <a class="lightbox-close" href="#"></a>
  </div>
  </div>
</div>
<script src="<?php echo get_template_directory_uri().'/js/star-rating.js';?>"></script>
<script src="<?php echo get_template_directory_uri().'/js/star-rating.min.js';?>"></script>
<script src="<?php echo get_template_directory_uri().'/js/jquery-1.9.1.js';?>"></script>
<script src="<?php echo get_template_directory_uri().'/js/jquery.min.js';?>"></script>
<script src="<?php echo get_template_directory_uri().'/js/jquery-ui.js';?>"></script>
<script src="<?php echo get_template_directory_uri().'/js/bootstrap.min.js';?>"></script>
<script>
  $("#menu-close").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
  });
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
  });
</script>
<?php wp_footer();?>
</body>
</html>
<?php ob_flush();?>