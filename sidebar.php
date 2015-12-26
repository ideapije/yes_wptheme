 <?php
/**
* The Sidebar containing the main widget areas.
*
* @package jvm
* @since jvm 1.0
*/
?>
<?php
$t4=$wpdb->prefix.'t_keranjang';
?>
<?php
if(!empty($_SESSION['basket'])) {
  $basket=$_SESSION['basket'];
  $total=0;
  foreach ($basket as $key => $val) { 
        $total+=$val; //jumlah barang
  }
}
?>
<div class="table-responsive">
  <table class="table">
      <?php if(!is_404()):?>
      <tr>
      <td>
  <ul class="nav nav-pills nav-stacked">
  <li class="active">
    <a href="#krnjngs" data-toggle="collapse">
      <span class="badge pull-right"><?php echo $total;?>
        <?php
        if(is_user_logged_in()) {
          $sum=0;
          foreach ($wpdb->get_results("SELECT * FROM $t4 WHERE id='".$user_ID."'") as $key => $value) {
            $sum+=$value->pm_qty;
          }
          echo $sum;
        }?>
      </span>
      Keranjang
    </a>
  </li>
</ul>
<br/>
<div id="krnjngs" class="collapse out">
  
    <?php
  if(!is_user_logged_in()){  
//==============================================================================================================================================
    include (TEMPLATEPATH . '/media-keranjang.php');
  }else{ ?>
  <div style="width:370px;height:350px;overflow-y:hidden;margin-top:-25px;">
  <?php
  include(TEMPLATEPATH . '/keranjang-mem.php'); ?>
  </div>
  <?php
  }
  ?>
</div>
</td>
    </tr>
<?php endif;?>
      
    
  <tr>
      <td id="Widget-middle"> 
        <?php if ( !function_exists('dynamic_sidebar') ||!dynamic_sidebar('Widget 2') ) : ?>
        <ul class="list-group" style="list-style-type:none;">
      <?php 
      global $wpdb;
        $t6=$wpdb->prefix.'t_ratings';
        $prhasil=$wpdb->get_results("SELECT *,SUM(total_value) AS 'oye' FROM $t6 GROUP BY kd_prod ORDER BY oye DESC");
        if($prhasil){ ?>
        <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Product Rating </h3>
        </div>
        <div class="panel-body">
        <ul class="list-group">
          <?php 
          foreach ($prhasil as $key => $value) {
          $produkrate=get_post($value->id);
          ?>
                <li class="list-group-item"><a href="<?php echo home_url('/produks/'.seoUrl($produkrate->post_title));?>" ><?php  echo $produkrate->post_title; ?></a></li>
          <?php  
          }
         ?>
        </ul>
      </div></div>
       <?php }else{ ?>
               <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Produk Rating</h3>
        </div>
        <div class="panel-body">
          <div class="alert alert-warning" role="alert">Belum ada ulasan produk</div>
          </div></div>
       <?php } ?>
      </ul>
        <?php endif; ?>
      </td>
    </tr> 
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget 1') ) : ?> 
      <tr>
        <td>
          <?php get_search_form();?>
        </td> 
      </tr>
      <?php endif; ?>
  </table>

</div>