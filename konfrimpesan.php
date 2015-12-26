<?php 
global $wpdb;
$t1= $wpdb->prefix.'detail_buyer';
$t4= $wpdb->prefix.'t_keranjang';?>
<?php 
$wpdb->get_results("SELECT * FROM $t4");
//var_dump(empty($_SESSION['basket']));
if($wpdb->num_rows==0 && empty($_SESSION['basket'])):
    wp_redirect(home_url('/cot'));exit;
else:
?>
<div class="container">

<form action="<?php echo  get_site_url().'/prosesco/2';?>" method="post">

    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <i class="fa fa-search-plus pull-left icon"></i>
            <?php if(is_user_logged_in()): ?>
                <h2>Invoice for purchase <?php echo "THC/INQ/".date('my')."-".$user_ID;?><input type="hidden" name="idinv" value="<?php echo "THC/INQ/".date('my')."-".$user_ID;?>"/></h2>
            <?php else: ?>
                <h2>Invoice for purchase <?php echo "THC/INQ/".date('my')."-".$_SESSION['buyer'];?><input type="hidden" name="idinv" value="<?php echo "THC/INQ/".date('my')."-".$_SESSION['buyer'];?>"/></h2>
            <?php endif;?>
            </div>
            <hr>
            <div class="row">
        <div class="col-xs-12">
                    <div class="col-xs-6">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table">
                       <tr>
                            <td rowspan="3" width="5%">
                                <div class="radio">
                                <label>
                                <input type="radio" name="bank" value="bca">
                                </label>
                                </div>
                            </td>
                            <td width="25%">
                                <img class="img-responsive" src="<?php echo get_template_directory_uri().'/img/bca.jpg';?>" alt="bca" />
                            </td>
                            <td></td>
                       </tr>
                       <tr>                            
                            <td>No. rekening BCA</td>
                            <td><stong><?php echo get_option('norekbca');?></td>
                       </tr>
                        <tr>                            
                            <td>Atas Nama</td>
                            <td><strong><?php echo get_option('namebca');?></strong></td>
                       </tr>
                        

                        <tr>
                            <td rowspan="3" width="5%">
                                <div class="radio">
                                <label>
                                <input type="radio" name="bank" value="bni">
                                </label>
                                </div>
                            </td>
                            <td width="25%">
                                <img class="img-responsive" src="<?php echo get_template_directory_uri().'/img/bni.jpg';?>" alt="bni" />
                            </td>
                            <td></td>
                       </tr>
                       <tr>                            
                            <td>No. rekening BNI</td>
                            <td><stong><?php echo get_option('norekbni');?></strong></td>
                       </tr>
                        <tr>
                            <td>Atas Nama</td>                            
                            <td><strong><?php echo get_option('namebni');?></strong></td>
                       </tr>


                                              <tr>
                            <td rowspan="3" width="5%">
                                <div class="radio">
                                <label>
                                <input type="radio" name="bank" value="mandiri">
                                </label>
                                </div>
                            </td>
                            <td width="25%">
                                <img class="img-responsive" src="<?php echo get_template_directory_uri().'/img/mandiri.jpg';?>" alt="mandiri" />
                            </td>
                            <td></td>
                       </tr>
                       <tr>                            
                            <td>No. rekening MANDIRI</td>
                            <td> <stong><?php echo get_option('norekmandiri');?></strong></td>
                       </tr>
                        <tr>
                            <td>Atas Nama</td>                            
                            <td><strong><?php echo get_option('namemandiri');?></strong></td>
                       </tr>

                        </table>
                        </div>
                        </div>
                    </div>
                </div>
                                <div class="col-xs-6">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Order Preferences</div>
                        <div class="panel-body">
                            <strong>Gift:</strong> No<br>
                            <strong>Express Delivery:</strong> Yes<br>
                            <strong>Insurance:</strong> No<br>
                            <strong>Coupon:</strong> No<br>
                        </div>
                    </div>
                </div>
        </div>
    </div>
            <div class="row">
                <div class="col-xs-12 col-md-5 col-lg-4 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Detail Pelanggan</div>
                        <div class="panel-body">
                        <?php if(is_user_logged_in()): ?>
                        <div class="table-responsive">
                        <table class="table">
                        <tr>
                        <td>Nama</td><th><?php the_author_meta( 'user_login', $user_ID ); ?><input type="hidden" name="pm_nama" value="<?php the_author_meta( 'user_login', $user_ID ); ?>"/><input type="hidden" name="id_p" value="$user_ID"/></th>
                        </tr>
                        <tr>
                        <td>Alamat</td><th><?php the_author_meta( 'alamat', $user_ID ); ?><input type="hidden" name="pm_alamat" value="<?php the_author_meta( 'alamat', $user_ID ); ?>"/></th>
                        </tr>
                        <tr>
                        <td>Email</td><th><?php the_author_meta( 'user_email', $user_ID ); ?><input type="hidden" name="pm_email" value="<?php the_author_meta( 'user_email', $user_ID ); ?>"/></th>
                        </tr>
                        <tr>
                        <td>Hp</td><th><?php the_author_meta( 'nohp', $user_ID ); ?><input type="hidden" name="pm_nohp" value="<?php the_author_meta( 'nohp', $user_ID ); ?>"/></th>
                        </tr>
                        </table>
                        </div>
                        <?php else:?>
                        <?php 
                            if(!empty($_SESSION['basket'])){
                                $basket=$_SESSION['basket']; ?>
                        <div class="table-responsive">
                        <table class="table">
                        <?php foreach($wpdb->get_results("SELECT * FROM $t1 WHERE id='".$_SESSION['buyer']."'") as $k => $val):?>
                        <tr>
                            <td>Nama</td><th><?php echo $val->pm_nama ?><input type='hidden' name='pm_nama' value='<?php echo $val->pm_nama;?>'/><input type='hidden' name='id_p' value='<?php echo $val->id;?>'/></th>
                        </tr>
                        <tr>
                            <td>Alamat</td><th><?php echo $val->pm_alamat;?><input type='hidden' name='pm_alamat' value='<?php echo $val->pm_alamat;?>'/></th>
                        </tr>
                        <tr>
                            <td>Email</td><th><?php echo $val->pm_email;?><input type='hidden' name='pm_email' value='<?php echo $val->pm_email;?>'/></th>
                        </tr>
                         <tr>
                            <td>Hp</td><th><?php echo $val->pm_nohp;?><input type='hidden' name='pm_nohp' value='<?php echo $val->pm_nohp;?>'/></th>
                        </tr>
                        <?php endforeach; ?>
                        </table>
                        </div>
                            <?php }
                        ?>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
              <div class="col-xs-12 col-md-5 col-lg-4 ">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Detail Penagihan</div>
                        <div class="panel-body">
                    <?php if(is_user_logged_in()): ?>
                        <div class="table-responsive">
                        <table class="table">
                            <tr>
                                    <td>Nama </td>
                                    <td><input type="text" name="bill_name" value="<?php the_author_meta('user_login',$user_ID);?>"></td>
                                </tr>
                            <tr>
                                <td>Alamat</td><td>
                                <textarea name="bill_add" class="form-control">
                                    <?php 
                                    $billadd=get_user_meta($user_ID,'bill_alamat',true);
                                    if(!empty($billadd)){
                                        the_author_meta('bill_alamat',$user_ID);
                                    }else{
                                        the_author_meta( 'alamat', $user_ID );
                                    }
                                    ?>
                                </textarea ></td>
                            </tr>
                            <tr>
                                    <td>Telp/Hp</td>
                                    <td><input type="text" name="bill_hptelp" value="<?php the_author_meta( 'nohp', $user_ID );?>"></td>
                                </tr>
                        </table>
                        </div>
                        <?php else:?>
                        <?php 
                            if(!empty($_SESSION['basket'])){
                                $basket=$_SESSION['basket'];?>
                            <div class="table-responsive">
                            <table class="table">
                                <?php
                                    foreach($wpdb->get_results("SELECT * FROM $t1 WHERE id='".$_SESSION['buyer']."'") as $k => $val): ?>
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" name="bill_name" value="<?php echo $val->pm_nama;?>"></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td><td>
                                <textarea name="bill_add" class="form-control">

                                   <?php  echo $val->pm_alamat; ?>
                                </textarea ></td>
                                </tr>
                                <tr>
                                    <td>Telp/Hp</td>
                                    <td><input type="text" name="bill_hptelp" value="<?php echo $val->pm_nohp;?>"></td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            </div>
                        <?php }
                        ?>
                        <?php endif;?>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-5 col-lg-4 pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Detail Expedisi</div>
                        <div class="panel-body">
                    <?php if(is_user_logged_in()): ?>
                          <div class="table-responsive">
                        <table class="table">
                            <tr>
                                    <td>Nama</td>
                                    <td><input type="text" name="ship_name" value="<?php the_author_meta( 'user_login', $user_ID );?>"></td>
                                </tr>
                            <tr>
                                <td>Alamat</td><td><textarea name="ship_add" class="form-control">
                                <?php 
                                    $shipadd=get_user_meta($user_ID,'ship_alamat',true);
                                    if(!empty($shipadd)){
                                        the_author_meta('ship_alamat',$user_ID);
                                    }else{
                                        the_author_meta( 'alamat', $user_ID );
                                    }
                                    ?>
                            </textarea ></td>
                            </tr>
                            <tr>
                                    <td>Telp/Hp</td>
                                    <td><input type="text" name="ship_hptelp" value="<?php the_author_meta( 'nohp', $user_ID );?>"></td>
                                </tr>
                        </table>
                        </div>
                        <?php else:?>
                        <?php 
                            if(!empty($_SESSION['basket'])){
                                $basket=$_SESSION['basket'];?>
                        <div class="table-responsive">
                        <table class="table">
                            <?php
                                foreach($wpdb->get_results("SELECT * FROM $t1 WHERE id='".$_SESSION['buyer']."'") as $k => $val): ?>
                            <tr>
                                    <td>Nama</td>
                                    <td><input type="text" name="ship_name" value="<?php echo $val->pm_nama;?>"></td>
                                </tr>
                            <tr>

                                <td>Alamat</td><td><textarea name="ship_add" class="form-control">
                                
                                <?php   echo $val->pm_alamat; ?>
                            </textarea ></td>
                            </tr>
                            <tr>
                                    <td>Telp/Hp</td>
                                    <td><input type="text" name="ship_hptelp" value="<?php echo $val->pm_nohp;?>"></td>
                                </tr>
                            <?php   endforeach;?>
                        </table>
                        </div>
                        <?php } ?>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                        <thead>
                            <tr><th>No</th><th>Nama Produk</th>
                                <th>Harga</th><th>kuantitas</th>
                                <th>Sub total</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            if(is_user_logged_in()):
                            $result=$wpdb->get_results("SELECT * FROM $t4 WHERE id='".$user_ID."'"); 
                            $sum=0;
                            $no_urut=0;
                        foreach($result as $key => $val){
                                $no_urut++;
                                $nm=$val->pm_produk;  
                                $jmls=$val->pm_qty;
                                $hrgs=$val->pm_harga; 
                                $subhrgs=$val->pm_subtot;
                                $sum+=$val->pm_subtot;  ?>
                                <tr>
                                <td><?php echo $no_urut;?></td>
                                <td><?php echo $nm;?><input type="hidden" name="pm_produk[]" value="<?php echo $nm.'['.$no_urut.']';?>" /></td>
                                <td><?php echo $hrgs;?><input type="hidden" name="pm_harga[]" value="<?php echo $hrgs.'['.$no_urut.']';?>" /></td>
                                <td><?php echo $jmls;?><input type="hidden" name="pm_qty[]" value="<?php echo $jmls.'['.$no_urut.']';?>" /></td>
                                <td><?php echo $subhrgs;?><input type="hidden" name="pm_sub[]" value="<?php echo $subhrgs.'['.$no_urut.']';?>" /></td>
                                </tr>
                        <?php } ?>
                        <?php else: ?>

                        <?php
                if(!empty($_SESSION['basket'])){
                $basket=$_SESSION['basket']; 
                        $no_urut=0;
                        $total=0;
                        $total_harga=0;
                        foreach ($basket as $key => $val) { //menuliskan tabel
                                $no_urut++;
                                $prod=get_post($key);
                                $hrg=get_post_meta($key,"hrg", true);
                                $subhrg=$hrg*$val;
                                $nm=$prod->post_title;
                                $total+=$val;
                                $total_harga +=($val * $hrg); ?>
                    <tr>
                        <td><?php echo $no_urut;?></td>
                        <td><?php echo $nm;?><input type="hidden" name="pm_produk[]" value="<?php echo $nm.'['.$no_urut.']';?>" /></td>
                        <td><?php echo $hrg;?><input type="hidden" name="pm_harga[]" value="<?php echo $hrg.'['.$no_urut.']';?>" /></td>
                        <td><?php echo $val;?><input type="hidden" name="pm_qty[]" value="<?php echo $val.'['.$no_urut.']';?>" /></td>
                        <td><?php echo $subhrg;?><input type="hidden" name="pm_sub[]" value="<?php echo $subhrg.'['.$no_urut.']';?>" /></td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                        <?php endif;?>
                        <tr>
                            <td colspan="4" align="right">Biaya Pengiriman:</td>
                            <td >
                        <?php if(is_user_logged_in()): ?>

                        <?php else:?>
                        <?php 
                            if(!empty($_SESSION['basket'])){
                                $basket=$_SESSION['basket'];
                            }
                            ?>
                            <?php endif;?>
                                </td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right">Jml Pesanan Akhir:</td>
                                <td >
                            <?php if(is_user_logged_in()): ?>
                            <?php echo "RP".$sum;?><input type="hidden" name="pm_ttl" value="<?php echo $sum;?>" />
                            <?php else:?>
                            <?php 
                            if(!empty($_SESSION['basket'])){
                                $basket=$_SESSION['basket']; ?>
                                <?php echo "RP".$total_harga;?><input type="hidden" name="pm_ttl" value="<?php echo $total_harga;?>" />
                            <?php 
                            }
                            ?>
                            <?php endif;?>
                                </td>
                        </tr>
                        </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
<button type="submit" class="btn btn-success" onclick="myFunction()">Konfirmasi Pesanan</button>
</form>



</div>

<?php endif;?>