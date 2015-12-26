<?php
/**
 * The template for displaying search forms in jvm
 *
 * @package jvm
 * @since jvm 1.0
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
<?php if(is_404()){?>
	<div class="col-lg-6">
<?php }else{?>
	<div class="col-xs-12">
<?php }?>
    <div class="input-group">
      <input type="text" class="form-control" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'jvm' ); ?>">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</form>
<br/>