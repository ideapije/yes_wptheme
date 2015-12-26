<?php 
global $wpdb;
global $current_user;
 $t1= $wpdb->prefix.'detail_buyer';
$t4= $wpdb->prefix .'t_keranjang';
if(is_user_logged_in()){
  if (current_user_can('manage_options')){ 
           echo "admin ga boleh masuk";
  }else{ 
    if(!empty($_SESSION['basket'])){
    $total=0;
    $total_harga=0;
    $basket=$_SESSION['basket'];
    foreach($basket as $key => $val){ //menuliskan tabel
        $prod=get_post($key); 
        $no_urut++;
        $hrg=get_post_meta($key, "hrg", true);
        $subhrg=$hrg*$val;
        $total+=$val; 
        $total_harga +=($val * $hrg);
        $pmprod=$prod->post_title;
    
    $wpdb->insert($t4,array(
      'id'=>$user_ID
      ,'kd_prod'=>$key
      ,'pm_waktu'=>date('Y-m-d h:i:s')
      ,'pm_produk'=>$pmprod
      ,'pm_qty'=>$val
      ,'pm_harga'=>$hrg
      ,'pm_subtot'=>$subhrg
    ),
    array(
      '%s',
      '%s',
      '%s',
      '%s'
      ,'%d'
      ,'%d'
      ,'%d'
    )
    );
    }
    unset($_SESSION['basket']);
  }
    $keranjang=$wpdb->get_results("SELECT * FROM $t4 WHERE id='".$user_ID."'");
    if($keranjang){
          get_currentuserinfo();
          $nohp=$current_user->nohp;
          $almt=$current_user->alamat;
          $emailu=$current_user->user_email;
          if(empty($almt) || empty($emailu) || empty($nohp)){
            include (TEMPLATEPATH.'/isilengkap.php');
           }else{
            foreach( $wpdb->get_results("SELECT * FROM $t1") as $key => $row){
                $idpem=$row->id;
            }
            if($current_user->ID!=$idpem){
                $wpdb->insert(
                  $t1,
                  array(
                    'id'=>$current_user->ID
                    ,'pm_nama'=>$current_user->user_login
                    ,'pm_email'=>$emailu
                    ,'pm_alamat'=>$almt
                    ,'pm_jabatan'=>$current_user->roles[0]
                  ),
                  array(
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                  )
              );
            }?>
            Pastikan Alamat anda sudah sesuai,ingin cek alamat anda?     
            <a href="<?php echo get_site_url().'/masuk';?>">Ya</a>
            <a href="<?php echo get_site_url().'/konfrimpesan';?>">Tidak,Lanjut ke konfrim pesanan</a>
          <?php
        }
    }else{
        echo "anda harus beli produk dulu untuk bisa checkout";
    }
}
//-----------------------------------------ELSE BUKAN MEMBER------------------------------------------------
}else{
//----------------------------------------------------------------------------------------------------------
  if(!empty($_SESSION['basket'])){
      $basket=$_SESSION['basket'];
      include (TEMPLATEPATH.'/formunmember.php');
  }else{
      echo "anda harus beli produk dulu untuk bisa checkout";
  }
}
?>

