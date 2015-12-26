<?php
/**
 * @package jvm
 * @since jvm 1.0
 */
?>
<?php global $post;?>
    <div class="col-md-4" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="thumbnail">
            <?php if ( has_post_thumbnail() ){
                the_post_thumbnail();
            }else{?>
            <img src="<?php echo get_template_directory_uri().'/img/dthumb.png'?>" alt="Thumbnail Product"/>
            <?php }  ?>
      <div class="caption">
        <strong><?php the_title(); ?></strong>
        <p>
        Rp
        <?php
        $hrg=number_format(floatval(get_post_meta($post->ID, "hrg", true)));
        $hrgp=number_format(floatval(get_post_meta($post->ID, "hrgp", true)));
        if($hrgp!='' && $hrgp!='0') {
            echo "<strike>".$hrgp."</strike>&nbsp||&nbsp".$hrg;
        }else{
            if($hrg!='' && $hrg!='0'){
                echo $hrg;
            }else{
                echo "0";
            }
        }
        ?>
        <form name="penawrn" method="post">
        <input type="hidden" value="<?php the_ID();?>" name="kdbb" />
        <div class="btn-group">
            <?php
            if($hrg!='' && $hrg!='0'){?>
                <?php if(is_user_logged_in()) { ?>
                    <a href="<?php echo get_site_url().'/keranjangmem/'.$post->ID;?>" class="btn btn-primary btn-sm" role="button">Beli</a>
            <?php  }else{?>
            <a href="<?php echo  get_site_url().'/keranjangs?action=add&id='.$post->ID;?>" class="btn btn-primary btn-sm" role="button">Beli</a>
                <?php }?>
            
            <?php }else{ ?>
            <button class="btn btn-primary btn-sm" role="button" name="penawrn">Tawar</button>
            <?php } ?>
            <a href="<?php the_permalink();the_ID();?>" class="btn btn-success btn-sm" role="button">
                Detail
            </a>
        </div>
        </form>
      </div>
    </div>
  </div>
