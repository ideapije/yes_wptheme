<?php
/*
	Template name:keranjangmem
 */
?>
<?php get_header(); ?>
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
<?php
date_default_timezone_set("asia/jakarta");
global $wpdb;
$t4=$wpdb->prefix.'t_keranjang';
if(is_user_logged_in()){
	if(current_user_can('manage_options')){ 
           echo "admin ga boleh masuk";
  	}else{ 
	if(isset($_POST['del'])) {
		//var_dump($_POST['delidk']);
		$wpdb->delete( $t4, array( 'id' =>$user_ID,'kd_prod'=>$_POST['delidk']) );
	}
	if(isset($_POST['upt'])) {
		$jmls=intval($_POST['qty']);
		$subhs=intval($_POST['upthrg']);
		$ubahs=$jmls*$subhs;
		//var_dump($ubahs);
		//var_dump($_POST['uptidk']);
		$wpdb->update( 
		$t4, 
		array('pm_qty'=>$_POST['qty'],'pm_subtot'=>$ubahs),
		array('id'=>$user_ID,'kd_prod'=>$_POST['uptidk']),
		array('%d','%d'),
		array('%s','%s')
		); 
	}
	if(isset($_POST['delall'])) {
		$wpdb->delete( $t4, array( 'id' =>$user_ID) );
	}
	$idb=basename($_SERVER['REQUEST_URI']);
	$prod=get_post($idb); 
	if($prod->post_type=='produks'){
		$result=$wpdb->get_results("SELECT * FROM $t4 WHERE id='".$user_ID."' AND kd_prod='".$prod->ID."'");
		if($result){
			foreach ($result as $key => $value) {
				$jml=$value->pm_qty+1;
				$subh=$value->pm_harga;
			}
			$ubah=$jml*$subh;
			$wpdb->update(
				$t4,
				array(
				'pm_qty'=>$jml,
				'pm_subtot'=>$ubah
				),
				array(
					'id'=>$user_ID,
					'kd_prod'=>$prod->ID
				),
				array(
					'%d',
					'%d'
				),
				array(
					'%s',
					'%s'
				)
			);
			wp_redirect(get_site_url().'/keranjangmem');exit;
		}else{
			$wpdb->insert($t4,
				array(
					'id'=>$user_ID
					,'kd_prod'=>$prod->ID
					,'pm_waktu'=>date('Y-m-d h:i:s')
					,'pm_produk'=>$prod->post_title
					,'pm_qty'=>1
					,'pm_harga'=>get_post_meta($prod->ID, "hrg", true)
					,'pm_subtot'=>get_post_meta($prod->ID, "hrg", true)
					),
				array(
					'%s'
					,'%s'
					,'%s'
					,'%s'
					,'%d'
					,'%d'
					,'%d'
					)
				);
			wp_redirect(get_site_url().'/keranjangmem');exit;
		}
	
	}//else jika id bukan produk disini-------------------------------
	?>
		<?php
		$tabel=$wpdb->get_results("SELECT * FROM $t4 WHERE id='".$user_ID."'");
		if($tabel) {?>
		<div class="table-responsive">
<table class="table table-nonfluid">
<thead>
	<tr>
		<th colspan="2">kode Barang</th>
		<th>Gambar</th>
		<th>Nama produk</th>
		<th>Harga</th>
		<th>kuantitas</th>
		<th>Sub total</th>
	</tr>
</thead>
<tbody>
		<?php
			$sum=0;
			foreach ($tabel as $k => $row) {
			$prod=get_post($row->kd_prod);
			echo "<tr>";
			echo "<td>
					<form name='del' method='post'>
						<input type='hidden' name='delidk' value='".$row->kd_prod."'>
						<button type='submit' name='del' class='btn btn-default'>
						<span class='glyphicon glyphicon-remove'></span>
						</button>
					</form>
				</td>
				<td>".$row->kd_prod."</td>
				<td>
				".get_the_post_thumbnail($row->kd_prod, array(50,50))."
				</td>
				<td>";?>
					<a href="<?php echo home_url('/'.seoUrl($prod->post_title));?>"><?php echo $row->pm_produk ?></a>
				<?php
		echo "</td><td>".$row->pm_harga."</td>
				<td class='col-md-2'>
				<form name='upt' method='post'>
				<input type='hidden' name='uptidk' value='".$row->kd_prod."'>
				<input type='hidden' name='upthrg' value='".$row->pm_harga."'>
				<div class='input-group'>
      				<input class='form-control' type='text' name='qty' value='".$row->pm_qty."'>
      				<span class='input-group-btn'>
        				<button name='upt' class='btn btn-default' type='submit'>
        					<span class='glyphicon glyphicon-refresh'></span>
        				</button>
      				</span>
    			</div
				</form>
				</td>
				<td>".$row->pm_subtot."</td>
				<td>

				</td>";
			echo "</tr>";
			$sum+=$row->pm_subtot;
		}?>
						<tr>
		<td colspan="5">Biaya pengiriman</td>
		<td><?php echo "RP";?></td>
	</tr>
	<tr>
		<td colspan="5">Total harga</td>
		<td><?php echo "RP".$sum;?></td>
	</tr>
	<tr>
		<td colspan="6"><a href="<?php echo  get_site_url().'/cot';?>" class="btn btn-default">lanjut kepembayaran</a></td>
	</tr>
</tbody>
</table>
</div>
	<?php	}else{
			echo "
			<center><h1>TIDAK ada barang dikeranjang !</h1></center></td>
			";
		}
		
	}
}else{
	wp_redirect(get_site_url()); exit;
}

?>
  </div>
  <div class="col-xs-6 col-md-4">
    <?php get_sidebar(); ?>
 </div>
</div>
<?php get_footer(); ?>