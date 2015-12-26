<?php
if(!empty($_SESSION['basket'])):
	$basket=$_SESSION['basket'];
		$no_urut=0;
		$total=0;
		$total_harga=0;
		foreach ($basket as $key => $val){ //menuliskan tabel
				$prod=get_post($key); 
				$no_urut++;
				$hrg=get_post_meta($key, "hrg", true);
				$subhrg=$hrg*$val;
				$total+=$val; //jumlah barang
				$total_harga +=($val * $hrg); //total harga
?>
<div class="media col-xs">
  <a class="pull-left" href="#">
  	<?php echo get_the_post_thumbnail( $key, array('class'=>'media-object')); ?>
  </a>
  <div class="media-body">
    <h4 class="media-heading">
    	<?php 
    
    if($prod->post_title!='') {?>
    <a href="<?php echo site_url().'/'.seoUrl($prod->post_title);?>">
    <?php
      echo $pmprod=$prod->post_title; ?>
    </a>
    <?php
    }else{
      echo $pmprod="Tak Berjudul";
    }
    ?>
    </h4>
    <div class="table-responsive">
  <table class="table">
    <tr>
    	<th>Qty</th>
    	<td><?php echo $val;?></td>
    </tr>
    <tr>
    	<th>Harga</th>
    	<td><?php echo $hrg;?></td>
    </tr>
    <tr>
    	<th>Subharga</th>
    	<td><?php echo $subhrg;?></td>
    </tr>
    <tr>
    	<th>Biaya Pengiriman</th>
    	<td><?php echo "";?></td>
    </tr>
    <tr>
    	<th>Total</th>
    	<td><?php echo $total_harga;?></td>
    </tr>
  </table>
</div>
  </div>
</div>
<?php }?>
<a href="<?php echo  get_site_url().'/cot';?>" class="btn btn-default btn-sm">lanjut kepembayaran</a>
<?php else:?>
<div class="col-xs-12">
		<div class="alert alert-warning">
    	<a href="#" class="close" data-dismiss="alert">×</a>
    	tidak ada barang dikeranjang
		</div>
</div>
<?php endif;?>