<?php
if(!is_user_logged_in()) {
$pesan="";
//handler untuk aksi shopping
if(isset($_GET['action'])) {
	if(isset($_GET['id'])) {
		$id=(int)$_GET['id'];
	}else
	{
		$id=0;
	}
	$action=$_GET['action'];
	switch($_GET['action']) {
		case 'add':
			if(!empty($_SESSION['basket'][$id])) {
				$pesan="<div class='alert alert-danger'>Barang Sudah ada dikeranjang </div>";
				wp_redirect(site_url().'/keranjangs');
			}else
			{
				$_SESSION['basket'][$id]=1;
				wp_redirect(site_url().'/keranjangs');
			}
			break;
		case 'update':
			$produk=$_POST['produk'];
			//var_dump($produk);
			foreach ($produk as $key => $val){
				if(!empty($_SESSION['basket'][$key])) {
					$_SESSION['basket'][$key]=$val;
					wp_redirect(site_url().'/keranjangs');
				}//jika barang memang ada,baru diupdate
			}
			break;
		case 'delete':
			if(!empty($_SESSION['basket'][$id])) {
				unset($_SESSION['basket'][$id]);
				wp_redirect(site_url().'/keranjangs');
			}else
			{
				$pesan="Barang Sudah ada dikeranjang";
			}
			break;
		case 'delall':
			if(!empty($_SESSION['basket'])) {
				unset($_SESSION['basket']);
				wp_redirect(site_url().'/keranjangs');
			}
		break;
		default:
			$pesan="Maaf Ada sedikit terjadi kesalahan";
			break;
	}
}
	if(!empty($_SESSION['basket'])) {
		$basket=$_SESSION['basket'];
//--------------------------------------------------------------------------------------------------------?>
<div class="table-responsive col-xs-12">
  <form method="POST" action="?action=update">
  <table class="table">
<thead>
	<tr>
		<th colspan="2">No</th>
		<th>Gambar</th>
		<th>Nama produk</th>
		<th>Harga</th>
		<th>kuantitas</th>
		<th>Sub total</th>
	</tr>
</thead>
<tbody>
      <?php
		$no_urut=0;
		$total=0;
		$total_harga=0;
		foreach ($basket as $key => $val) { //menuliskan tabel
				$prod=get_post($key); 
				$no_urut++;
				$hrg=get_post_meta($key,"hrg",true);
				$subhrg=$hrg*$val;
				$total+=$val; //jumlah barang
				$total_harga +=($val * $hrg); //total harga
	?>
	<tr>
		<td><a class="btn btn-default" href="?action=delete&id=<?php echo $key;?>">
			<span class="glyphicon glyphicon-remove"></span></a>
		</td>
		<td><?php echo $no_urut;?></td>
		<td><?php echo get_the_post_thumbnail( $key, array(50,50)); ?></td>
		<td><?php 
		
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
		</td>
		<td><?php echo $hrg;?></td>
		<td class="col-md-2">
    		<div class="input-group">
      		<input type="text" name="produk[<?php echo $key;?>]" value="<?php echo $val;?>" class="input-mini form-control"/>
      		<span class="input-group-btn">
        	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button>
      		</span>
    		</div><!-- /input-group -->
		</td>
		<td><?php echo $subhrg;?></td>

	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="5">Biaya pengiriman</td>
		<td><?php echo "RP";?></td>
	</tr>
	<tr>
		<td colspan="5">Total harga</td>
		<td><?php echo "RP".$total_harga;?></td>
	</tr>
	<tr>
		<td colspan="6"><a href="<?php echo  get_site_url().'/cot';?>" class="btn btn-default">lanjut kepembayaran</a></td>
	</tr>
</tbody>
  </table>
</form>
</div>
<?php
//----------------------------------------------------------------------------------------------------------
	}else{ ?>
<?php
//----------------------------------------------------------------------------------------------------------
		echo $msg="
		<div class='alert alert-warning'>
    	<a href='#' class='close' data-dismiss='alert'>&times;</a>
    	tidak ada barang dikeranjang
		</div>";
	}
	echo $pesan; 
?>
<?php
//==========================================================================================================
}else{
	wp_redirect(home_url()); exit;
}?>