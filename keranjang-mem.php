
<?php
global $wpdb;
$t4=$wpdb->prefix.'t_keranjang';
$tabel=$wpdb->get_results("SELECT * FROM $t4 WHERE id='".$user_ID."'");
if($tabel){ ?>
<div class="table-responsive">
<table class="table table-nonfluid">
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
			$sum=0;
			$no=1;
			foreach ($tabel as $k => $row) {
			$prod=get_post($row->kd_prod);
			echo "<tr>";

			echo "<td>".$no++."
				</td>
				<td>".$row->kd_prod."</td>
				<td>
				".get_the_post_thumbnail($row->kd_prod, array(50,50))."
				</td>";?>
				<td><a href="<?php echo site_url().'/'.seoUrl($prod->post_title);?>"><?php echo $row->pm_produk;?></a></td>
				<?php
				echo "
				<td>".$row->pm_harga."</td>
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
<?php }else{ ?>
<div class="col-xs-12">
		<div class="alert alert-warning" style="margin-top:10px;">
    	<a href="#" class="close" data-dismiss="alert">×</a>
    	tidak ada barang dikeranjang
		</div>
</div>
<?php
} ?>