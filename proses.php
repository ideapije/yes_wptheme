<?php
/*
	Template name:prosesco
 */
session_start();
date_default_timezone_set("asia/jakarta");
$_SESSION['captcha']=simple_php_captcha();
global $wpdb;
global $session;
global $current_user, $wp_roles;
   $t1= $wpdb->prefix .'detail_buyer';
    $t2= $wpdb->prefix .'t_produk';
    $t7=$wpdb->prefix.'t_invoice';
    $t4=$wpdb->prefix.'t_keranjang';
    $t9=$wpdb->prefix.'t_slider';
	$sw=basename($_SERVER['REQUEST_URI']);
switch($sw){
		case '1':	
				//
if(!empty($_POST['email']) || !empty($_POST['nama']) || !empty($_POST['nohp']) || !empty($_POST['pinbb']) || !empty($_POST['alamat']) || !empty($_POST['prov']) || !empty($_POST['kota']) || !empty($_POST['kdpos']) || !empty($_POST['kec'])){
		$privatekey = "6Les6PQSAAAAAKlcWYY7yt2xszZwNsZthAfj2O2K";
        $resp = recaptcha_check_answer ($privatekey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recptch_field"],
		$_POST["recptch_field"]);
        if (!$resp->is_valid):
				$args=array('role'=>'subscriber','orderby'=>'ID');
				$wp_user_query = new WP_user_Query($args);
				$arruser=array();
				$authors=$wp_user_query->get_results(); 
				foreach($authors as $key => $val) {
					$arruser[]=$val->ID;
				}
				foreach( $wpdb->get_results("SELECT * FROM $t1 ORDER BY id DESC LIMIT 1") as $key => $row){
					$idpem=$row->id+1;
				}
				if(in_array($idpem, $arruser)){
					$idnew=$idpem+1;
					$wpdb->insert( 
					$t1,
						array( 
						'id' =>$idnew, 
						'pm_email' =>$_POST['email'],
						'pm_nama' =>$_POST['nama'],
						'pm_nohp' =>$_POST['nohp'],
						'pm_pinbb' =>$_POST['pinbb'],
						'pm_alamat' =>$_POST['alamat'],
						'prov' =>$_POST['prov'],
						'kota' =>$_POST['kota'],
						'pm_kdpos' =>$_POST['kdpos'],
						'pm_kecamatan' =>$_POST['kec'],
						'pm_jabatan'=>'0'
						), 
						array( 
							'%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'
						) 
						);
					$_SESSION['buyer']=$idnew;
					//var_dump($_SESSION['buyer']);
					wp_redirect(get_site_url().'/konfrimpesan' ); exit;
				}else{
				$wpdb->insert( 
				$t1,
				array( 
					'id' =>'', 
					'pm_email' =>$_POST['email'],
					'pm_nama' =>$_POST['nama'],
					'pm_nohp' =>$_POST['nohp'],
					'pm_pinbb' =>$_POST['pinbb'],
					'pm_alamat' =>$_POST['alamat'],
					'prov' =>$_POST['prov'],
					'kota' =>$_POST['kota'],
					'pm_kdpos' =>$_POST['kdpos'],
					'pm_kecamatan' =>$_POST['kec'],
					'pm_jabatan'=>'0'
						), 
						array( 
							'%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'
						) 
						);
					$_SESSION['buyer']=$idpem;
					wp_redirect(get_site_url().'/konfrimpesan' ); exit;
				}
		
		else:
				wp_redirect(home_url('/cot/#failed'));
		endif;
}else{
		echo "lagi ngaspal !!!";
}
break;
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
case '2':
		if(!empty($_POST['pm_nama']) || !empty($_POST['pm_alamat']) || !empty($_POST['pm_email']) || !empty($_POST['pm_produk'])){
			if(isset($_SESSION['buy'])){
				$_SESSION['buy']=$_SESSION['buy']+1;
			}else{
				$_SESSION['buy']=1;
			}
				if(is_user_logged_in()){
						$countp=count($_POST['pm_produk']); 
				$i=0;
				while ($i < $countp){
						$wpdb->insert(
						$t2,
						array(
							'id'=>$user_ID,
							'pm_produk'=>$_POST['pm_produk'][$i],
							'pm_harga'=>$_POST['pm_harga'][$i],
							'pm_qty'=>$_POST['pm_qty'][$i],
							'pm_sub'=>$_POST['pm_sub'][$i],
							'pm_bp'=>$_POST['pm_bp'][$i],
					'sess_belanja'=>$_SESSION['buy']
					),
				array(
						'%d',
						'%s',
						'%d',
						'%d',
						'%d',
						'%d'

					)
				);
			++$i;	
		}
		$results = $wpdb->get_results("SELECT * FROM $t2 WHERE id='".$user_ID."' and sess_belanja='".$_SESSION['buy']."'");
		$barang = array();
		$qtybrg=array();
		$hrgbrg=array();
		$total_hrg=0;
		$amountbrg=0;
		foreach( $results as $key => $row){    
	   		$prod=substr($row->pm_produk, 0, -3); 
       		$barang[]=$prod;
       		$amountbrg+=$row->pm_qty;
       		$qtybrg[]=$row->pm_qty;
       		$hrgbrg[]=$row->pm_harga;
       		$subhrg=$row->pm_qty*$row->pm_harga;
       		$total_hrg+=($row->pm_qty*$row->pm_harga); 
       		
		}
		$pesanan=implode('|', $barang);
		$pmqty=implode('|',$qtybrg);
		$pmhrg=implode('|',$hrgbrg);
		$wpdb->insert(
					$t7,
					array(
						'id'=>$_POST['idinv'],
						'date'=>date('Y-m-d h:i:s'),
						'pay_method'=>$_POST['bank'],
						'ship_method'=>'',
						'pay_stat'=>'Unpaid',
						'note_pay'=>$_POST['bank'],
						'cust_name'=>$_POST['pm_nama'],
						'cust_address'=>$_POST['pm_alamat'],
						'cust_telp'=>$_POST['pm_nohp'],
						'bill_name'=>$_POST['bill_name'],
						'bill_address'=>$_POST['bill_add'],
						'bill_telp'=>$_POST['bill_hptelp'],
						'ship_name'=>$_POST['ship_name'],
						'ship_address'=>$_POST['ship_add'],
						'ship_telp'=>$_POST['ship_hptelp'],
						'produk'=>$pesanan,
						'qty'=>$pmqty,
						'price'=>$pmhrg,
						'amount'=>$amountbrg,
						'subtotal'=>$subhrg,
						'ship_cost'=>'',
						'total_cost'=>$total_hrg
					)
					
					);
				
				
				$wpdb->delete($t4,array('id'=>$user_ID),array('%s'));
				wp_redirect(get_site_url()); exit;		
//------------------------ELSE BUKAN MEMBER----------------------------------------------------------------------------------
				}else{
				$countp=count($_POST['pm_produk']); 
				$i=0;
				while ( $i < $countp) {
						$wpdb->insert(
						$t2,
						array(
							'id'=>$_SESSION['buyer'],
							'pm_produk'=>$_POST['pm_produk'][$i],
							'pm_harga'=>$_POST['pm_harga'][$i],
							'pm_qty'=>$_POST['pm_qty'][$i],
							'pm_sub'=>$_POST['pm_sub'][$i],
							'pm_bp'=>$_POST['pm_bp'][$i],
					'sess_belanja'=>$_SESSION['buy']
					),
				array(
						'%d',
						'%s',
						'%d',
						'%d',
						'%d',
						'%d'

					)
				);
			++$i;	
		}
		$results = $wpdb->get_results("SELECT * FROM $t2 WHERE id='".$_SESSION['buyer']."' and sess_belanja='".$_SESSION['buy']."'");
		$barang = array();
		$qtybrg=array();
		$hrgbrg=array();
		$total_hrg=0;
		$amountbrg=0;
		foreach( $results as $key => $row){    
	   		$prod=substr($row->pm_produk,0,-3); 
       		$barang[] =$prod;
       		$amountbrg+=$row->pm_qty;
       		$qtybrg[]=$row->pm_qty;
       		$hrgbrg[]=$row->pm_harga;
       		$subhrg=$row->pm_qty*$row->pm_harga;
       		$total_hrg+=($row->pm_qty*$row->pm_harga); 
		}
		$pesanan=implode('|',$barang);
		$pmqty=implode('|',$qtybrg);
		$pmhrg=implode('|',$hrgbrg);
		$wpdb->insert(
					$t7,
					array(
						'id'=>$_POST['idinv'],
						'date'=>date('Y-m-d h:i:s'),
						'pay_method'=>$_POST['bank'],
						'ship_method'=>'',
						'pay_stat'=>'Unpaid',
						'note_pay'=>$_POST['bank'],
						'cust_name'=>$_POST['pm_nama'],
						'cust_address'=>$_POST['pm_alamat'],
						'cust_telp'=>$_POST['pm_nohp'],
						'bill_name'=>$_POST['bill_name'],
						'bill_address'=>$_POST['bill_add'],
						'bill_telp'=>$_POST['bill_hptelp'],
						'ship_name'=>$_POST['ship_name'],
						'ship_address'=>$_POST['ship_add'],
						'ship_telp'=>$_POST['ship_hptelp'],
						'produk'=>$pesanan,
						'qty'=>$pmqty,
						'price'=>$pmhrg,
						'amount'=>$amountbrg,
						'subtotal'=>$subhrg,
						'ship_cost'=>'',
						'total_cost'=>$total_hrg
					)
					
					);
			$from=get_option('admin_email');
			
			unset($_SESSION['basket']);
			unset($_SESSION['buyer']);
			wp_redirect(get_site_url()); exit;
		}

	}else{
			//unset($_SESSION['buyer']);
			wp_redirect(get_site_url().'/error'); exit;
		}	
	break;
	case '3':
		if(!empty($_POST['log']) && !empty($_POST['pwd'])){
			$cek=get_user_by('login',$_POST['log']);
			if($cek && wp_check_password($_POST['pwd'], $cek->data->user_pass, $cek->ID) ){
				wp_set_current_user( $cek->ID, $cek->user_login );
    			wp_set_auth_cookie( $cek->ID);
    			do_action( 'wp_login', $cek->user_login );
    			if(!is_null($_POST['penawaran'])){
					wp_redirect(home_url());
				}else{
					wp_redirect(site_url().'/konfrimpesan');exit();
				}
    		}else{
				wp_redirect(site_url().'/wrong');exit();
			}
		}else{
			wp_redirect(site_url().'/wrong');exit();
		}
		break;
	case '4':
	class Wew extends PDF_HTML
	{
		
		function detail($idd){
			
			$this->SetXY(45,20);
			$this->SetLeftMargin(45);
			$this->SetFont('Arial','',10);
			$postt = get_post($id); 
			$title = $postt->post_title;
			$hrg=get_post_meta($idd, "hrg", true);
			$hrgp=get_post_meta($idd, "hrgp", true);
			$jml=get_post_meta($idd, "jml_stock", true);
			$brt=get_post_meta($idd, "brt", true);
			$stock=get_post_meta($idd, "stock", true);
			$this->Cell(100,5,$title,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$hrg,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$hrgp,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$jml,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$brt,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$stock,'LBTR',0,'L');$this->Ln();
			
		}
		function content($idcont){

			$this->SetXY(50,70);
			$this->SetLeftMargin(5);
			$this->SetFont('Arial','',10);
			$postc = get_post($idcont);
			$isi=$postc->post_content;
			$this->WriteHTML($isi);
		}
		function garis($grs){
			$this->SetFont('Arial','B',14);
			$this->SetXY(5,62);
			$this->SetLeftMargin(0);
			$permlink=get_permalink($grs);
			$postct = get_post($grs);
			$this->Line(6, 68, 210-6, 68);
			$this->WriteHTML("Detail Produk <a href='".$permlink."'>".$postct->post_title."</a>");			
		}
		function gambar($img){
			$this->SetXY(5,20);
			$url = wp_get_attachment_url( get_post_thumbnail_id($img) );
			$this->Cell( 40, 40, $this->Image($url, $this->GetX(),$this->GetY(),'PNG', 33.78),'LBTR', 0, 'C', false );
			$this->Ln();
		}


	}
		$toko=get_bloginfo('name');
		$judul="Katalog ".$toko;
		$pdf= new Wew();
		$pdf->SetAutoPageBreak(false);
		$pdf->AddPage('P','A4');
		$pdf->SetFont('Arial','',24);
		$pdf->SetLeftMargin(5);
		$pdf->Cell(0,20,$judul,'0',1,'C');
		$loop = new WP_Query(array('post_type' => 'produks', 'orderby'=> 'ASC')); 
		 while ( $loop->have_posts() ) : $loop->the_post();
		 	$pdf->AddPage('P','A4');
		 	$pdf->gambar($post->ID);
			$pdf->detail($post->ID);
			$pdf->garis($post->ID);
			$pdf->content($post->ID);
		  endwhile; 
		$pdf->Output();
		break;
	case '5':

	if(!empty($_POST['nm']) || !empty($_POST['email']) || !empty($_POST['nohp']) || !empty($_POST['almt']) || !empty($_POST['ket']) || !empty($_POST['kdprod']) || !empty($_POST['hrg']) || !empty($_POST['qty'])):
		$t5=$wpdb->prefix.'t_penawaran';
		$dateq=date('m/d');
		//$cpth=$_SESSION['captcha']['code'];
		//if($_POST['captcha']==$cpth){
			if(get_user_by('login',$_POST['nm'])){
                if(is_user_logged_in()){
				
					$var_id=$_POST['userid'];
					$query="SELECT * FROM $t5 WHERE SUBSTRING(id,15,255)='".$var_id."' AND kd_prod='".$_POST['kdprod']."'";
                  	$cekpenwrn=$wpdb->get_results($query);
                  if($cekpenwrn){
                  		$brg=get_post($_POST['kdprod']);
    					echo "<div class='alert alert-warning' role='alert'>anda sebelumnya sudah membuat penawaran produk <strong>".$brg->post_title."</strong></div>";
                  }else{
                      $wewid="THC/QUO/".$dateq."-".$_POST['userid'];
                          $wpdb->insert(
                              $t5,
                              array(
                                  'id'=>$wewid,
                                  'nama'=>$_POST['nm'],
                                  'email'=>$_POST['email'],
                                  'nohp'=>$_POST['nohp'],
                                  'alamatpr'=>$_POST['almt'],
                                  'tgl'=>date('Y-n-j-h:i:s'),
                                  'ketopt' =>$_POST['ket'],
                                  'kd_prod' =>$_POST['kdprod'],
                                  'harga' =>$_POST['hrg'],
                                  'qty' =>$_POST['qty'],
                                  'status'=>'0'), 
                                  array( '%s','%s','%s','%s','%s','%s','%s','%d','%d','%s') 
                          );
                      echo "
                      <div class='alert alert-success' role='alert'>Terima Kasih anda telah membuat penawaran produk <strong>".$prod->post_title."</strong>
                      kami akan segera konfirmasi melalui email</div>";
                    }
                }else{
                    include(TEMPLATEPATH.'/form-login.php');
                }
            }else{
                  $args=array('role'=>'subscriber','orderby'=>'ID');
                  $wp_user_query = new WP_user_Query($args);
                  $authors=$wp_user_query->get_results();
                  $arr=array();
                  foreach($authors as $key => $val) {
                    $arr[]=$val->ID;
                  }
                  foreach ($wpdb->get_results("SELECT * FROM $t5 ORDER BY id DESC LIMIT 1") as $key => $value) {
                    $idd=intval($value->id)+1;
                  }
                  if(in_array($idd, $arr)){
                      $wpdb->insert( 
                        $t5,
                      array( 
                          'id'=>"THC/QUO/".$dateq."-".intval($idd)+1, 
                          'nama' =>$_POST['nm'],
                          'email' =>$_POST['email'],
                          'nohp' =>$_POST['nohp'],
                          'alamatpr' =>$_POST['almt'],
                          'tgl'=>date('Y-n-j-h:i:s'),
                          'ketopt' =>$_POST['ket'],
                          'kd_prod' =>$_POST['kdprod'],
                          'harga' =>$_POST['hrg'],
                          'qty' =>$_POST['qty'],
                          'status'=>'0'), 
                          array( '%s','%s','%s','%s','%s','%s','%s','%d','%d','%s') 
                      );
                      echo "<div class='alert alert-success' role='alert'>Terima Kasih anda telah membuat penawaran produk <strong>".$prod->post_title."</strong>
                      kami akan segera konfirmasi melalui email</div>";

                  }else{

                      $wpdb->insert( 
                        $t5,
                          array( 
                            'id' =>"THC/QUO/".$dateq."-".$idd, 
                            'nama' =>$_POST['nm'],
                            'email' =>$_POST['email'],
                            'nohp' =>$_POST['nohp'],
                            'alamatpr' =>$_POST['almt'],
                            'tgl'=>date('Y-n-j-h:i:s'),
                            'ketopt'=>$_POST['ket'],
                            'kd_prod'=>$_POST['kdprod'],
                            'harga'=>$_POST['hrg'],
                            'qty' =>$_POST['qty'],
                            'status'=>'0'), 
                            array( '%s','%s','%s','%s','%s','%s','%s','%d','%d','%s') 
                        );
                      echo "<div class='alert alert-success' role='alert'>Terima Kasih anda telah membuat penawaran produk <strong>".$prod->post_title."</strong>
                      kami akan segera konfirmasi melalui email</div>";
                    }
            }
		/*}else{
              echo "<div class='alert alert-warning' role='alert'>
              Maaf kode Captha yang anda masukkan salah !,cobalah untuk lebih teliti
                </div>";
		}
		*/
	else:
		wp_redirect(home_url('/wrong'));
endif;
break;
case '6':
	if(current_user_can('manage_options')):
		if(!empty($_POST['idpenwrn'])){	
			$t5=$wpdb->prefix.'t_penawaran';
			$wpdb->query("UPDATE $t5 SET status='1' WHERE id='".$_POST['idpenwrn']."'");
    		$admin_email=get_option('admin_email');
foreach($wpdb->get_results("SELECT * FROM $t5 WHERE id='".$_POST['idpenwrn']."'") as $key => $vv){
	$emailto=$vv->email;
}

$pdf = new PDF_Quotation();

// generate a simple PDF (for more info, see http://fpdf.org/en/tutorial/)
$pdf->AddPage();
$pdf->addlogo("");
$pdf->addjvm("");
$pdf->fact_dev( "QUOTATION " , " ");
$pdf->temporaire( "CV. Java Multi Mandiri" );
$pdf->descr("");
$pdf->addHeadAlamat(": Jl. Raya Baturaden Timur KM 7 No. 17 Rempoah, Baturaden - Jawa Tengah - 53100");
$pdf->addHeadTelp(": 0281-5755222 / 0281-6572222, Email : info@jvm.co.id, Website : http://www.jvm.co.id");
$pdf->addTabelDate(date("F d, Y"));
$pdf->addTabelAttn("Ari Sebastian"); //nama
$pdf->addTabelQuNo($data['id']); // no. quot
$pdf->addTabelCc("-"); // cc
$pdf->addTabelTo("PT. Rafa Bhakti Mulya"); //penerima
$pdf->addTabelTelp("02183786432"); // telp
$pdf->addTabelAddress("Rasuna Office Park III Jl. HR Rasuna Said - Kuningan Suite ZO-12 (komp. Apartemen rasuna) Jakarta Selatan"); //alamat
$pdf->addTabelFaks("02183703107"); // faks
$pdf->addEmail("ptrafabhakti@yahoo.com"); // email
$pdf->AddWeAre("");
$pdf->Ln();
$pdf->Ln();

//
$pdf->addExVAT("");
$pdf->addPriceStok("");
$pdf->addTerm("DP 50% with order balances 50% before delivery (Full Amount)");
$pdf->addDeliv("1 Day After Payment"); // bisa ganti
$pdf->addwarranty("");
$pdf->addwarrantyy("1st Month (Replacement)");
$pdf->addwarrantyyy("12nd Month (Repair / Service Hardware & Software)");
$pdf->addBank("");
$pdf->addBCA("");
$pdf->addMDR("");
$pdf->addBNI("");
$pdf->addThk("");
$pdf->addttd("");
$pdf->addstamp("");
$pdf->addCv("");
$pdf->addFootTelp("Eka Setiawati Irawan", "0281-5755222/087837160608/Pin BB 29433756");
// email stuff (change data below)
$to =$emailto; 
$from = $admin_email; 
$subject =get_bloginfo('name')."_quotation"; 
$message = "<p>Terima Kasih atas penawaran anda</p>";
// a random hash will be necessary to send mixed content
$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;
// attachment name
$filename = get_bloginfo('name')."_quotation.pdf";
// encode data (puts attachment in proper format)
$pdfdoc =$pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));
// main header (multipart mandatory)
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol; 
$headers .= "Content-Transfer-Encoding: 7bit".$eol;
$headers .= "This is a MIME encoded message.".$eol.$eol;
// message
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$headers .= $message.$eol.$eol;
// attachment
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment.$eol.$eol;
$headers .= "--".$separator."--";
// send message
mail($to, $subject, "", $headers);
    		wp_redirect(admin_url('/themes.php?page=sub-tema-set'));
		}else{
			wp_logout();	
			wp_redirect(home_url());
		}
	else:
		wp_redirect(home_url('/masuk'));
	endif;
	break;
case '7':

	if(is_user_logged_in()){
		if(!empty($_POST['bintang']) || !empty($_POST['komen']) || !empty($_POST['iduser']) || !empty($_POST['idproduk'])){
			$t6=$wpdb->prefix.'t_ratings';
			$wpdb->insert(
				$t6,
				array(
					'id'=>$_POST['iduser'],
					'kd_prod'=>$_POST['idproduk'],
					'total_value'=>$_POST['bintang'],
					'komment'=>$_POST['komen'],
					'date'=>date('Y-n-j-h:i:s')
				),
				array(
					'%d','%s','%s','%s','%s'
				)
			);
			wp_redirect(home_url('/produks/'.get_the_title($_POST['idproduk'])));
		}
	}else{
		wp_redirect(home_url());
	}
	break;
	case '8':
	/*if ( $_FILES ) { 
			$files = $_FILES["kv_multiple_attachments"];  
			foreach ($files['name'] as $key => $value) {
				if ($files['name'][$key]) { 
					$file = array( 
						'name' => $files['name'][$key],
	 					'type' => $files['type'][$key], 
						'tmp_name' => $files['tmp_name'][$key], 
						'error' => $files['error'][$key],
 						'size' => $files['size'][$key]
					); 
					$_FILES = array ("kv_multiple_attachments" => $file); 
					foreach ($_FILES as $file => $array) {				
						$newupload = kv_handle_attachment($file,$pid);
						$urlpp=wp_get_attachment_url($newupload);
						if(!empty($_POST['tandacover'])):
							update_user_meta($_POST['idyangupload'],'cover',$urlpp);
						else:
							update_user_meta($_POST['idyangupload'],'pp',$urlpp);
						endif;
						//add_user_meta( $_POST['idyangupload'], $meta_key,'id_att_user',$newupload); 
						wp_redirect(home_url('/masuk'));
					}
				} 
			} 
		}*/
		if('POST' == $_SERVER['REQUEST_METHOD']  ){
		if(!empty($_FILES['coveruser'])){
    			$errors= array();
    			$file_name=$_FILES['coveruser']['name'];
    			$file_size=$_FILES['coveruser']['size'];
    			$file_tmp=$_FILES['coveruser']['tmp_name'];
    			$file_type=$_FILES['coveruser']['type'];   
    			$file_ext=strtolower(end(explode('.',$_FILES['coveruser']['name'])));
    			$extensions=array("jpeg","jpg","png"); 		
    			if(in_array($file_ext,$extensions )=== false){
     				wp_redirect(home_url('/masuk?error1'));exit;
    			}
    			if($file_size > 2097152){
    				wp_redirect(home_url('/masuk?error2'));exit;
    			}				
    			if(empty($errors)==true){
					$target_path=get_template_directory()."/file/";
					$temp=explode(".",$_FILES["coveruser"]["name"]);
					if(!empty($_POST['tandacover'])):
						$temp=$user_login.'-cover.' .end($temp);
						$target_path=$target_path.basename($temp);
						if(move_uploaded_file($_FILES['coveruser']['tmp_name'],$target_path)){
							$srcimg=get_template_directory_uri().'/file/'.$temp;
							update_user_meta($_POST['idyangupload'],'cover',$srcimg);
							wp_redirect(home_url('/masuk'));exit;
						}else{
							wp_redirect(home_url('/masuk?error3'));exit;
						}
					else:
						$newimgpp=$user_login.'-pp.' .end($temp);
						$target_path=$target_path.basename($newimgpp);
						if(move_uploaded_file($_FILES['coveruser']['tmp_name'],$target_path)){
							$srcimg=get_template_directory_uri().'/file/'.$newimgpp;
							update_user_meta($_POST['idyangupload'],'pp',$srcimg);								
							wp_redirect(home_url('/masuk'));exit;
						}else{
							wp_redirect(home_url('/masuk?error3'));exit;
						}
					endif;
						
				}
		
		}else{
			wp_logout();
			wp_redirect(home_url());exit;
		}
	}
		break;

	case '9':
	if(is_user_logged_in() || !empty($_POST['front_end_upload'])){
    				$target_path=get_template_directory()."/slide/";
    				$sldname=$_FILES["slidd"]["name"];
					$target_path=$target_path.basename($sldname);
					//var_dump(move_uploaded_file($_FILES['slidd']['tmp_name'],$target_path));
					if(move_uploaded_file($_FILES['slidd']['tmp_name'],$target_path)){
						$srcimg=get_template_directory_uri().'/slide/'.$_FILES["slidd"]["name"];
						$wpdb->insert(
							$t9,
							array(
								'id'=>'',
								'src'=>$srcimg,
								'date'=>date('Y-m-d h:i:s'),
								'visible'=>'1'
								),
							array(
								'%d','%s','%s','%s'
								)
							);
						wp_redirect(home_url('/wp-admin/themes.php?page=sub-tema-set'));exit;
					}else{
						wp_redirect(home_url('/wp-admin/themes.php?erroratu'));exit;
					}
	}else{
		//wp_logout();
		wp_redirect(site_url());exit();
	}
	break;
	case '10':
	if(is_user_logged_in()){
			if(!empty($_POST['kd']) || !empty($_POST['vs'])){
				if($_POST['vs']=='0'){
				$wpdb->update(
				$t9,
				array(
					'visible'=>'0'
					),
				array(
					'id'=>$_POST['kd']
					),
				array(
					'%s'
					),
				array(
					'%d'
					)
				);
				wp_redirect(home_url('/wp-admin/themes.php?page=sub-tema-set'));exit;
			}else{
				$wpdb->update(
				$t9,
				array(
					'visible'=>'1'
					),
				array(
					'id'=>$_POST['kd']
					),
				array(
					'%s'
					),
				array(
					'%d'
					)
				);
				wp_redirect(home_url('/wp-admin/themes.php?page=sub-tema-set'));exit;
			}
		}else{
				wp_logout();
				wp_redirect(home_url());
			}
	}else{
			wp_redirect(home_url());
	}
	break;
	case '11':
		if(is_user_logged_in()){
			if(!empty($_POST['kd'])){
				$wpdb->delete(
					$t9,
					array('id'=>$_POST['kd']),
					array('%d')
				);
				wp_redirect(home_url('/wp-admin/themes.php?page=sub-tema-set'));exit;
			}else{
				wp_logout();
				wp_redirect(home_url());
			}
		}else{
			wp_redirect(home_url());	
		}
		break;
	default:
	wp_redirect(site_url());exit();
	break;
}
?>