<?php
/**
 * @package jvm
 * @since jvm 1.0
 */
?>
<?php global $post;?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if(is_singular("produks")) { ?>

		<div class="media">
  <a class="pull-left" href="#full">
  	<?php
    the_post_thumbnail('large',array('class'=>'media-object'));
    ?>
  </a>
  <div class="media-body">
    <h3 class="media-heading"><?php the_title();?><br/><small><?php jvm_posted_on(); ?></small></h3>
    <table class="table col-xs-6">
  			<tbody>
  				<tr>
            <td>Harga Promo || Harga</td>
            <td>
               Rp
        <?php
        $hrg=number_format(floatval(get_post_meta($post->ID, "hrg", true)));
        $hrgp=number_format(floatval(get_post_meta($post->ID, "hrgp", true)));
        if($hrgp!='' && $hrgp!='0') {
            echo "<strike>".$hrgp."</strike>&nbsp||&nbsp".$hrg;
        }else{
            if($hrg!='' && $hrg!='0'){
                echo "- &nbsp||&nbspRp&nbsp".$hrg;
            }else{
                echo "0";
            }
        }
        ?>
            </td>
          </tr>
  				 <tr>
  					<td>Stock</td>
  					<td><?php echo get_post_meta($post->ID, "stock", true); ?></td>
  				</tr>
  				<tr>
  					<td>jumlah stock</td>
  					<td><?php echo get_post_meta($post->ID, "jml_stock", true); ?></td>
  				</tr>
  				<tr>
  					<td>Berat Barang(Kg)</td>
  					<td><?php echo get_post_meta($post->ID, "brt", true); ?></td>
  				</tr>
          <tr>
            <td colspan="2">
  			 <?php
            if(get_post_meta($post->ID, "hrg", true)!='' && get_post_meta($post->ID, "hrg", true)!='0'){?>
                <?php if(is_user_logged_in()) { ?>
                    <a href="<?php echo get_site_url().'/keranjangmem/'.$post->ID;?>" class="btn btn-primary btn-sm" role="button">Beli</a>
            <?php  }else{?>
            <a href="<?php echo  get_site_url().'/keranjangs?action=add&id='.$post->ID;?>" class="btn btn-primary btn-sm" role="button">Beli</a>
                <?php }?>
            <?php }else{ ?> 

            <a href="#offers" class="btn btn-primary btn-sm" role="button">Penawaran</a>
            <?php } ?>
          </td>
          </tr>
  			</tbody>
  		</table>
  </div>
</div>
	<?php
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
	}else{?>
	<div class="page-header">
  	<h1><?php the_title(); ?></h1>
  	<br/><p><?php jvm_posted_on(); ?></p>
	</div>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'jvm' ), 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <footer class="entry-meta">
	<?php
	$category_list=get_the_category_list( __(',','jvm'));
	$tag_list=get_the_tag_list('',__(',','jvm'));
	if(!jvm_categorized_blog()) {
		if(''!=$tag_list) {
			$meta_text=
			__( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'jvm' );
		}else{
			$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'jvm' );
		}
	}else{
		if(''!=$tag_list) {
		 $meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'jvm' );
			} else {
                    $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'jvm' );
           }

	}
	printf(
		$meta_text,
		$category_list,
		$tag_list,
		get_permalink(),
		the_title_attribute('echo=0')

		);
	?>
	<?php edit_post_link(__('Edit','jvm'),'<span class="edit-link">','</span>');?>
    </footer><!-- .entry-meta -->
<?php 
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
}?>
</article><!-- #post-<?php the_ID(); ?> -->