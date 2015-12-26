<?php
if(is_user_logged_in()):?>
<?php
        global $current_user;
        get_currentuserinfo();
       // echo get_avatar( $current_user->ID, 64 );
 ?>
<div class="col-xs-12" style="padding:15px;">
<ul class="list-group">
  <li class="list-group-item">
        <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#review-user">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <div id="review-user" class="collapse out" style="padding:5px;">
        <form action="<?php echo home_url('/prosesco/7');?>" method="post" role="form">

            <ul class="media-list">
                <li class="media">
                <a class="pull-left" href="#" style="cursor:default;">
                    <?php echo get_avatar($current_user->ID,125); ?>
                </a>
                <div class="media-body">
                <h4 class="media-heading">Ulasan produk <?php the_title();?></h4>
                <textarea class="form-control" name="komen"></textarea>
                <input id="input-21e" name="bintang" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" >
                <input type="hidden" name="iduser" value="<?php echo $current_user->ID;?>" />
                <input type="hidden" name="idproduk" value="<?php echo $post->ID;?>" />
                <button class="btn btn-primary" type="submit">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
                </div>
                </li>
            </ul>
        </form>
        </div>
    </li>
    <li class="list-group-item">
<table class="table">
  <?php
    $t6=$wpdb->prefix.'t_ratings';
    $wpdb->get_results("SELECT * FROM $t6 WHERE kd_prod='".$post->ID."'");
    $rowCount=$wpdb->num_rows;
    if($rowCount!=0){
        $hasil=$wpdb->get_results("SELECT * FROM $t6 WHERE kd_prod='".$post->ID."'");
        foreach($hasil as $key => $value) { ?>
            <ul class="media-list">
                <li class="media">
                <a class="pull-left" href="#">
                    <?php echo get_avatar($value->id,125); ?>
                </a>
                <div class="media-body">
                <h4 class="media-heading">
<?php
$sikomen=get_user_by('id',$value->id);
    echo $sikomen->user_login;
?>
                </h4>
                <?php echo $value->komment;?>
                <input id="input-21e" value="<?php echo $value->total_value;?>" name="bintang" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" >
                </div>
                </li>
            </ul>   
        <?php }
    }else{
        echo "belum ada ulasan <strong>".$post->post_title."</strong>";
    }
  ?>
</table>
</li>
</ul>
</div>
<?php else: ?>

<?php //yang ga login ga bisa tambah ulasan langsung disingle produk---------------------------------------------------------------?>
<table class="table">
  <?php
    $t6=$wpdb->prefix.'t_ratings';
    $wpdb->get_results("SELECT * FROM $t6 WHERE kd_prod='".$post->ID."'");
    $rowCount=$wpdb->num_rows;
    if($rowCount!=0){
        $hasil=$wpdb->get_results("SELECT * FROM $t6 WHERE kd_prod='".$post->ID."'");
        foreach($hasil as $key => $value) { ?>
            <ul class="media-list">
                <li class="media">
                <a class="pull-left" href="#">
                    <?php echo get_avatar($value->id,125); ?>
                </a>
                <div class="media-body">
                <h4 class="media-heading">
<?php
$sikomen=get_user_by('id',$value->id);
    echo $sikomen->user_login;
?>
                </h4>
                <?php echo $value->komment;?>
                <input id="input-21e" value="<?php echo $value->total_value;?>" name="bintang" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" >
                </div>
                </li>
            </ul>   
        <?php }
    }else{
        echo "belum ada ulasan tentang produk <strong>".$post->post_title."</strong>";
    }
  ?>
</table>
<?php endif;
?>