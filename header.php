<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package jvm
 * @since jvm 2.0
 */
?>
<?php global $user_ID, $user_identity; get_currentuserinfo();?>
<?php global $session;?>
<?php global $wpdb;?>
<?php
session_start();
$_SESSION['captcha']=simple_php_captcha();
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<?php
 /**
 **if(is_singular("produks"))
 {
 echo '<META HTTP-EQUIV="REFRESH" CONTENT="5">' ;
 }
 */
 ?>
<meta charset="<?php bloginfo('charset');?>" />
<meta name="viewport" content="width=device-width" />
<title>
	<?php
  $t9=$wpdb->prefix.'t_slider';
	/*
	*Print the <title> tag based on the what is being viewed.
	*/
	global $page,$paged;
	wp_title('|',true,'right');
	//add the blog name.
	bloginfo('name');
	//add the blog description for the home/front page.
	$site_description=get_bloginfo('description','display');
	if($site_description && (is_home() || is_front_page())) {
		echo "| $site_description";
	}
	//add page number if necessary:
	if($paged >=2 || $page >=2) {
		echo "|".sprintf(__('Page %s','jvm'),max($paged,$page));
	}
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
  <link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9 ]>
	<script src="<?php echo get_template_directory_uri();?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head();?>
</head>
<?php
if(isset($_POST['penawrn'])){ ?>
<script>
function myFunction(){
    //alert("Page is loaded");
  $('#myModal').modal("show");
}
</script>
<body <?php body_class();?> onload="myFunction()">
<?php  }else{ ?>
<body <?php body_class();?>>
<?php  } ?>
<div class="container">
<div class="wrapper navbar-fixed-top">
	<div class="navbar-xs">
   <div class="navbar-primary">
       <nav class="navbar navbar-static-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8">
                <i class="glyphicon glyphicon-list white"></i>
              </button>
              <?php
              /*
              <a class="navbar-brand" href="<?php echo home_url('/');?>" title="<?php echo esc_attr(get_bloginfo('name','display'));?>" rel="home"><?php bloginfo('name');?></a>
              */
              ?>
              <span class="navbar-brand" style="margin-left:50px;"></span>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8">
                  <?php
                  if(is_user_logged_in()){
                    ione_member_menu();
                  }else{
                    ione_unmember_menu();
                  }
                  ?>
          </div><!-- /.navbar-collapse -->
      </nav>
  </div>
</div>
</div>

<a id="menu-toggle" href="#" class="btn btn-primary btn-lg toggle"><i class="glyphicon glyphicon-phone-alt"></i></a>
<div id="sidebar-wrapper">
  <ul class="sidebar-nav">
    <a id="menu-close" href="#" class="btn btn-primary btn-xs pull-right toggle"><i class="glyphicon glyphicon-remove"></i></a>
    <li class="sidebar-brand">
      <a href="#">Contact Us</a>
    </li>
    <?php if(get_option('telp')!=''):?>
    <li>
      <a href="#"><img src="<?php echo get_template_directory_uri().'/img/telp.png';?>" />&nbsp<?php echo get_option('telp');?></a>
    </li>
    <?php endif;?>
    <?php if(get_option('wa')!=''):?>
    <li>
      <a href="#"><img src="<?php echo get_template_directory_uri().'/img/wa.png';?>" />&nbsp<?php echo get_option('wa');?></a>
    </li>
    <?php endif;?>
    <?php if(get_option('line')!=''):?>
    <li>
      <a href="#"><img src="<?php echo get_template_directory_uri().'/img/line.png';?>" />&nbsp<?php echo get_option('line');?></a>
    </li>
    <?php endif;?>
    <?php if(get_option('bb')!=''):?>
    <li>
      <a href="#"><img src="<?php echo get_template_directory_uri().'/img/bb.png';?>" />&nbsp<?php echo get_option('bb');?></a>
    </li>
    <?php endif;?>
    <?php if(get_option('fb')!=''):?>
    <li>
      <a href="https://www.facebook.com/<?php echo get_option('fb');?>"><img src="<?php echo get_template_directory_uri().'/img/fb.png';?>" />&nbsp<?php echo get_option('fb');?></a>
    </li>
    <?php endif;?>
    <?php if(get_option('tw')!=''):?>
    <li>
      <a href="https://twitter.com/<?php echo get_option('tw');?>"><img src="<?php echo get_template_directory_uri().'/img/tw.png';?>" />&nbsp<?php echo get_option('tw');?></a>
    </li>
    <?php endif;?>
    <?php if(get_option('fax')!=''):?>
    <li>
      <a href="#"><img src="<?php echo get_template_directory_uri().'/img/fax.png';?>" />&nbsp<?php echo get_option('fax');?></a>
    </li>
    <?php endif;?>
    <?php if(get_option('ym')!=''):?>
    <li>
      <a href="ymsgr:sendIM?<?php echo get_option('ym');?>"><img src="<?php echo get_template_directory_uri().'/img/ym.png';?>" alt="ym" />&nbsp<?php echo get_option('ym');?></a>
    </li>
  <?php endif;?>
  </ul>
</div>
<?php //if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>
<div class="page-header">
        <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
        <div class="description">
          <small>Hari ini :<?php echo date('l');?>,<?php echo date('j F Y');?>
          Jam buka Toko :<?php echo get_option('buka');?></small>
        </div>
</div>






<?php
    $wpdb->get_results("SELECT * FROM $t9 WHERE visible='1'");
    $count=$wpdb->num_rows;
    $slides='';
    $indicators='';
    $counter=0;
    foreach ($wpdb->get_results("SELECT * FROM $t9 WHERE visible='1'") as $kunci => $isi) {
      $title=$isi->id;
      $date=$isi->date;
      $image=$isi->src;
      if($counter==0) {
        $Indicators .='<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'" class="active"></li>';
              $slides .= '<div class="item active">
              <img src="'.$image.'" alt="'.$title.'" />
              <div class="carousel-caption">
                  <h3>'.$title.'</h3>
                  <p>'.$date.'.</p>         
                </div>
                </div>';
      }else{
        $Indicators .='<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'"></li>';
            $slides .= '<div class="item">
            <img src="'.$image.'" alt="'.$title.'" />
            <div class="carousel-caption">
              <h3>'.$title.'</h3>
              <p>'.$date.'.</p>         
            </div>
          </div>';

      }
      $counter++;
    }?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
         <?php echo $Indicators; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <?php echo $slides; ?>  
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>
<hr>







<?php if(is_home()):?>
  <fieldset>
  <legend><a href="<?php echo home_url('/prosesco/4');?>"  class="btn btn-warning btn-sm" name="cetak">
  <span class="glyphicon glyphicon-print"></span>&nbspPrint Katalog
</a></legend>

<?php endif;?>



<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Form penawaran</h4>
      </div>
      <form action="<?php echo home_url('/prosesco/5');?>" method="post">
      <div class="modal-body">

<?php
    $prod=get_post($_POST['kdbb']);
    $jdlp=$prod->post_title;
    ?>
<div class="col-xs-12 text-center">
    <a href="<?php echo home_url('/'.seoUrl($jdlp).'/'.$prod->ID);?>" class="thumbnail">
       <?php
       $srcimg= wp_get_attachment_url(get_post_thumbnail_id($prod->ID));
    ?>
    <img src="<?php echo $srcimg;?>" alt="thumb product">
    </a>
  </div>
<div class="table-responsive">
  <table class="table">
    <tr>
      <?php
              if(is_user_logged_in()){
              $user_aktp=get_user_by('id',$user_ID);
              ?>
              <td>
                  Username
              </td>
              <td>
              <input type="hidden" name="userid" value="<?php echo $user_aktp->ID;?>"/>
              <input type="text" class="form-control" name="nm" value="<?php echo $user_aktp->user_login;?>" required readonly/>
              </td>
              <?php }else{ ?>
              <td>
                  Nama lengkap
              </td>
              <td>
              <input type="text" class="form-control" name="nm" required/>
              </td>
              <?php } ?>
    </tr>
    <tr>
            <td>Email</td>
            <td>
              <input type="email" class="form-control" name="email" value="<?php echo $user_aktp->user_email;?>" required/>
            </td>
          </tr>
          <tr>
            <td>No. Handphone</td>
            <td>
              <input type="text" class="form-control" name="nohp" value="<?php echo get_user_meta($user_ID,'nohp',true);?>" required/>
            </td>
          </tr>
          <tr>
            <td>Alamat pribadi</td>
            <td>
              <textarea name="almt" class="form-control text-left" placeholder="Perum Griya Bantar Indah blok G no.03, Purwokerto,jawa tengah,Indonesia" value="" required>
              <?php echo get_user_meta($user_ID,'alamat',true);?>
              </textarea>
            </td>
          </tr>
          <tr>
            <td>Kode Produk</td>
            <td><input class="form-control" type="text" name="kdprod" value="<?php echo $prod->ID; ?>" readonly/></td>
          </tr> 
          <tr>
            <td>Harga</td>
            <td>
              <input type="text" class="form-control" name="hrg" required/>
            </td>
          </tr>
           <tr>
            <td>Kuantitas</td>
            <td>
              <input type="number" class="form-control" name="qty" required/>
            </td>
          </tr>
          <tr>
            <td>Keterangan Optional</td>
            <td>
              <textarea name="ket" class="form-control text-left" placeholder="merk , warna barang">

              </textarea>
            </td>
          </tr>
    <!--      <tr>
            <td>captha</td>
            <td>
              <div class="media">
          <a class="pull-left" href="#" style="cursor:default;">
          <img src="<?php //echo $_SESSION['captcha']['image_src'];?>" alt="captcha" class="media-object"/>
        </a>
        <div class="media-body">
        <h4 class="media-heading"><input type="text" class="form-control input-sm" name="captcha" required/></h4>
  </div>
</div>
              </td>
          </tr>-->
  </table>
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Post</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
