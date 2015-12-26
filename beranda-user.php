<?php
global $wpdb;
$t7=$wpdb->prefix.'t_invoice';
$t8=$wpdb->prefix.'t_penawaran';
?>
<div class="page-header">
  <h3>Daftar Belanja <small><?php echo bloginfo('name');?></small></h3>
</div>
<div class="table-responsive">
  <table class="table">
    <thead>
    	<tr>
    		<td>id</td>
    		<td>produk</td>
    		<td>harga</td>
    		<td>qty</td>
    		<td>subtotal</td>
    		<td>biaya expedisi</td>
    		<td>total</td>
    		<td>status pembayaran</td>
    	</tr>
    </thead>
    <tbody>
    	<?php 
    		foreach ($wpdb->get_results("SELECT * FROM $t7 WHERE SUBSTRING(id,15,255)='".$user_ID."'") as $key => $value) {
    		echo "<tr>";	
    		echo "<td>".$value->id."</td>";
    		echo "<td>";
    			$prod=explode('|',$value->produk);
    			foreach ($prod as $key) {
    				$key=trim($key);
    				echo $key."</br>";
    			}
    		echo "</td>";
    		echo "<td>";
    			$hrg=explode('|',$value->price);
    			foreach($hrg as $harg) {
    				$harg=trim($harg);
    				echo $harg."</br>";
    			}
    		echo "</td>";
    		echo "<td>";
    			$kuant=explode('|',$value->qty);
    			foreach($kuant as $kuanti) {
    				$kuanti=trim($kuanti);
    				echo $kuanti."<br/>";
    			}
    		echo "</td>
    			<td>".$value->subtotal."</td>
    			<td>".$value->ship_cost."</td>
    			<td>".$value->total_cost."</td>
    			<td>".$value->pay_stat."</td>";
    		echo "</tr>";
    		}
	?>
    </tbody>
  </table>
</div>
<div class="page-header">
  <h3>Daftar Penawaran <small><?php echo bloginfo('name');?></small></h3>
</div>
<?php
$wpdb->get_results("SELECT * FROM $t8 WHERE SUBSTRING(id,15,255)='".$user_ID."'");
$itung=$wpdb->num_rows;
if($itung==0):
	echo "<div class='alert alert-warning' role='alert'>anda belum melakukan Penawaran</div>";
else:
?>
<div class="table-responsive">
  <table class="table">
  	<thead>
        <td>id penawaran</td>
        <td>Waktu</td>
        <td>barang</td>
        <td>Harga</td>
        <td>qty</td>
        <td>status</td>
  	</thead>
  	<tbody>
<?php
foreach ($wpdb->get_results("SELECT * FROM $t8 WHERE SUBSTRING(id,15,255)='".$user_ID."'") as $key => $value) {
    $brg=get_post(intval($value->kd_prod));
    if($value->status=="0") {
        $stts="belum dikonfirmasi";
    }else{
        $stts="sudah dikonfirmasi";
    }
    echo "<tr>";
    echo "<td>".$value->id."</td>
        <td>".$value->tgl."</td>
        <td><a href='".home_url('/'.seoUrl($brg->post_title))."' >".$brg->post_title."</a></td>
        <td>".$value->harga."</td>
        <td>".$value->qty."</td>
        <td>".$stts."</td>
        ";
    echo "</tr>";
}
?>
  	</tbody>
  </table>
</div>
<?php endif;?>
