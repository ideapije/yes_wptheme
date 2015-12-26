<?php
/*-----------------------------------------------------------
function my_function(){
	//...content of the function';
}
//function bisa dipanggil dalam tema
//contoh
<div>
<?php my_function();?>
</div>
fungsi lain yang sedikit lebih complex
<div>
	<?php my_second_function('param1','param2');?>
</div>
-------------------------------------------------------------*/
/**
*jvm functions and definitions
*
*@package jvm
*@since jvm 1.0
*/
ob_start();
if(!isset($content_width)){
	$content_width=654; /*pixels*/
}

if(!function_exists('jvm_setup')):
	/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since jvm 1.0
 */
function jvm_setup(){

  date_default_timezone_set("Asia/Jakarta");
  //extras function
  //require(get_template_directory().'/widget/product_rate.php');

  // Create Slider Post Type
//require( get_template_directory() . '/inc/slider/slider_post_type.php' );
// Create Slider
//require( get_template_directory() . '/inc/slider/slider.php' );

  //captha yang sederhana

  require(get_template_directory().'/inc/simple-captcha/simple-php-captcha.php');

  require(get_template_directory().'/inc/extras.php');
  //fpdf function
  
  require(get_template_directory().'/inc/fpdf/WriteHTML.php');

  //jvm pdf
  require(get_template_directory().'/inc/fpdf/quotation.php');

  //email attacment
  require(get_template_directory().'/inc/email.php');
  
  //google captha
  require(get_template_directory().'/inc/recaptchalib.php');
  //nav walker
	require(get_template_directory().'/inc/wp_bootstrap_navwalker.php');
	//custom template tags for this theme
	require(get_template_directory().'/inc/template-tag.php');
	//custom functions that act indendently of the theme templates
	require(get_template_directory().'/inc/tweaks.php');
	/**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on jvm, use a find and replace
     * to change 'jvm' to the name of your theme in all the template files
     */
	load_theme_textdomain('jvm',get_template_directory().'/languages');
	/**
     * Add default posts and comments RSS feed links to head
     */
	add_theme_support('automatic-feed-links');

	/**
	*enable support for the Aside post format
	*/
	add_theme_support('post-format',array('aside'));

	/**
	*This theme uses wp_nav_menu() in one location
	*/
	register_nav_menus(
		array(
			'bukanmember'=>__('Menu bukanmember','jvm'),
      'member'=>__('Menu Member','jvm')
		)
	);
}
endif;
add_action('after_setup_theme','jvm_setup');
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since jvm 1.0
 */
function jvm_page_menu_args($args){
	$args['show_home']=true;
	return $args;
}
add_filter('wp_page_menu_args','jvm_page_menu_args');

/**
 * Adds custom classes to the array of body classes.
 *
 * @since jvm 1.0
 */
function jvm_body_classes($classes){
	//adds a class of group-blog to blogs with more than 1 published author
	if(is_multi_author()) {
		$classes[]='group-blog';
	}
	return $classes;
}
add_filter('body_class','jvm_body_classes');
/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since jvm 1.0
 */
function jvm_enhanced_image_navigation($url,$id)
{
	if(!is_attachment() && ! wp_attachment_is_image($id)) {
		return $url;
	}
	$image=get_post($id);
	if(!empty($image->post_parent) && $image->post_parent!=$id) {
		$url .='#main';
		return $url;
	}
}
add_filter('attachment_link','jvm_enhanced_image_navigation',10,2);

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since jvm 1.0
 */
if ( function_exists('register_sidebar') ) {
    register_sidebar(); 
    register_sidebars(2, array('name'=>'Widget %d',
      'before_widget' => '<ul id="widget-li">',
      'after_widget' => '',
      'before_title' => '<li><h3>',
      'after_title' => '</h3>'
      ));
} 

// header menu (should you choose to use one)
function ione_unmember_menu() {
        // display the WordPress Custom Menu if available
      wp_nav_menu( array(
            'theme_location' => 'bukanmember',
            'depth' => 3,
            'container' => false,
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'wp_page_menu',
            //Process nav menu using our custom nav walker
            'walker' => new wp_bootstrap_navwalker())
        );
} /* end header menu */
// header menu (should you choose to use one)
function ione_member_menu() {
        // display the WordPress Custom Menu if available
      wp_nav_menu( array(
            'theme_location' => 'member',
            'depth' => 3,
            'container' => false,
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'wp_page_menu',
            //Process nav menu using our custom nav walker
            'walker' => new wp_bootstrap_navwalker())
        );
} /* end header menu */
//---------------------------------------------------theme support Thumbnail------------------------------------------

add_theme_support( 'post-thumbnails' ); 

//--------------------------------------------------------------------------favicon-------------------------------------------------------
// add a favicon to your 
function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

//---------------------------------------------------------------------style css----------------------------------------------------------------

function register_style() {
    wp_register_style('bootstrap', get_template_directory().'/css/bootstrap.min.css');
    
    wp_register_style('main', get_template_directory_uri(). '/style.css');
}
function add_style() {
    register_style();
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('main');
    if (is_single()) {
        wp_enqueue_style('lightbox');
    }
}

add_action('wp_print_styles', 'add_style', 12);


//-------------------------------------------------------remove version --------------------------------------------------------------------------
function remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );

//-------------------------------------------------------disable admin bar------------------------------------------------------------------------
show_admin_bar(false);


//-----------------------------------------------------------bekground----------------------------------------------------------------------------

add_theme_support( 'custom-background', apply_filters( 'jvm_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
) ) );


///------------------------------------------------------------------------------------------------menu admin-------------------------------------------------------

add_action('admin_menu', 'register_bank_support');

function register_bank_support() {
  add_submenu_page( 'themes.php', 'Panel Pengaturan', 'Panel Pengaturan', 'manage_options', 'sub-tema-set', 'bank_support_callback' ); 
}

function bank_support_callback()
{
    include TEMPLATEPATH .'/admin/head.php';
    include TEMPLATEPATH .'/admin/setting-adm.php';
}




//------------------------------------------------ Custom Post types for Feature project on home page --------------------------------------------------------------------------------
     add_action('init', 'buat_produk');
       function buat_produk() {
         $feature_args = array(
            'labels' => array(
             'name' => __( 'produk' ),
             'singular_name' => __( 'produk' ),
             'add_new' => __( 'Tambah' ),
             'add_new_item' => __( 'tambah item baru produk' ),
             'edit_item' => __( 'Edit produk' ),
             'new_item' => __( 'item baru produk' ),
             'view_item' => __( 'lihat produk' ),
             'search_items' => __( 'cari produk' ),
             'not_found' => __( 'produk tidak ditemukan' ),
             'not_found_in_trash' => __( 'produk tidak ditemukan di tong sampah' )
           ),
         'public' => true,
         'show_ui' => true,
         'capability_type' => 'post',
         'hierarchical' => false,
         'rewrite' => true,
         'menu_position' => 20,
         'supports' => array('title', 'editor', 'thumbnail')
       );
    register_post_type('produks',$feature_args);
  }
  add_filter("manage_feature_edit_columns", "feature_edit_columns");

  function feature_edit_columns($feature_columns){
     $feature_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Title",
     );
    return $feature_columns;
  }
  
  
  //Add Meta Boxes
  //http://wp.tutsplus.com/tutorials/plugins/how-to-create-custom-wordpress-writemeta-boxes/

  
  //tambahan metabox-----------------------------------------------------------------------------------------------------------------------------
  add_action( 'add_meta_boxes', 'detailprod_box_add' );
  function detailprod_box_add()
  {
    add_meta_box( 'detailproduk-box-id', 'Detail Produk', 'detailproduk_isi', 'produks', 'normal', 'high' );
  }
  function detailproduk_isi($post)
  {
    
    $hrg=get_post_meta($post->ID,'hrg',true);
    $hrgp=get_post_meta($post->ID,'hrgp',true);
    $stock=get_post_meta($post->ID,'stock',true);
    $jml_stock=get_post_meta($post->ID,'jml_stock',true);
    $brt=get_post_meta($post->ID,'brt',true);
    wp_nonce_field('detailprod_box_nonce','detailprod_nonce');?>
    <p>
    <label for="hrg">Harga</label>
    <input type="number" name="hrg" id="hrg" value="<?php echo $hrg; ?>" style="width:350px" /><br/>
    <label for="hrgp">Harga Promo(jika ada)</label>
    <input type="number" name="hrgp" id="hrgp" value="<?php echo $hrgp; ?>" style="width:350px" /><br/>
    <label for="stock">Stock produk</label>
    <select name="stock" id="stock" style="width:250px">
      <?php
      if ($stock!='') {
        ?>
        <option value="<?php echo $stock;?>" selected><?php echo $stock;?></option>
        <?php
      }
      ?>
            <option value="Stok Tersedia">Stok Tersedia</option>
            <option value="Stok Terbatas">Stok Terbatas</option>
            <option value="Stok Habis">Stok Habis</option>
    </select><br/>
    <label for="jml_stock">jumlah Stock</label>
    <input type="text" name="jml_stock" id="jml_stock" value="<?php echo $jml_stock; ?>" style="width:350px" /><br/>
    <label for="brt">Berat Produk(Kg)</label>
    <input type="text" name="brt" id="brt" value="<?php echo $brt; ?>" style="width:350px" /><br/>
  </p>
    <?php
  }
  add_action('save_post','detailproduk_save');
  function detailproduk_save($post_id)
  {
      if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
      if(!isset($_POST['detailprod_nonce']) || !wp_verify_nonce($_POST['detailprod_nonce'],'detailprod_box_nonce')) return;
      if(!current_user_can('edit_post')) return;
      if(isset($_POST['hrg']))
        update_post_meta($post_id,'hrg',wp_kses($_POST['hrg'],$allowed));
      if(isset($_POST['hrgp']))
        update_post_meta($post_id,'hrgp',wp_kses($_POST['hrgp'],$allowed));
      if(isset($_POST['kdprod']))
        update_post_meta($post_id,'kdprod',wp_kses($_POST['kdprod'],$allowed));
      if(isset($_POST['stock']))
        update_post_meta($post_id,'stock',wp_kses($_POST['stock'],$allowed));
      if(isset($_POST['jml_stock']))
        update_post_meta($post_id,'jml_stock',wp_kses($_POST['jml_stock'],$allowed));
      if(isset($_POST['brt']))
        update_post_meta($post_id,'brt',wp_kses($_POST['brt'],$allowed));
  }
  //end tambahan-------------------------------------------------------------------------------------------------------------------------

//buat session----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}




//------------------------------------------------------------------------------------------------------------------------
function myactivationfunction($oldname, $oldtheme=false){
  global $wpdb;
          /*
        master
        $t= get_page_by_title( '' );
        if(!$t){
          $_arr= array(
            'post_type'    => 'page',
            'post_title'    => '',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_author'   => 1
        );
        // Insert the post into the database
        $_id =  wp_insert_post($_arr);
        update_post_meta($_id, '_wp_page_template', '.php');
        }*/ 
        $baskett=get_page_by_title('keranjangs');
        if(!$baskett) {
          $basketarr=array(
            'post_type'=>'page',
            'post_title'=>'keranjangs',
            'post_content'=>'',
            'post_status'=>'publish',
            'post_author'=>1
          );
          $baskett_id=wp_insert_post($basketarr);
          update_post_meta($baskett_id,'_wp_page_template','krnjng.php');
        }
        $keranjangmemt=get_page_by_title('keranjangmem');
        if(!$keranjangmemt) {
          $keranjangmemarr=array(
            'post_type'=>'page',
            'post_title'=>'keranjangmem',
            'post_content'=>'',
            'post_status'=>'publish',
            'post_author'=>1
          );
          $keranjangmem_id=wp_insert_post($keranjangmemarr);
          update_post_meta($keranjangmem_id,'_wp_page_template','keranjangmem.php');
        }
        $konfrimpsnt=get_page_by_title('konfrimpesan');
        if(!$konfrimpsnt) {
          $konfrimpsn_arr=array(
            'post_type'=>'page',
            'post_title'=>'konfrimpesan',
            'post_content'=>'',
            'post_status'=>'publish',
            'post_author'=>1
          );
          $konfrimpsn_id=wp_insert_post($konfrimpsn_arr);
          update_post_meta($konfrimpsn_id,'_wp_page_template','konfrimpesan_page.php');
        }
        $cott=get_page_by_title('cot');
        if(!$cott) {
          $cott_arr=array(
            'post_type'=>'page',
            'post_title'=>'cot',
            'post_content'=>'',
            'post_status'=>'publish',
            'post_author'=>1
          );
          $cot_id=wp_insert_post($cott_arr);
          update_post_meta($cot_id,'_wp_page_template','cot_page.php');
        }
      $prosst=get_page_by_title('prosesco');
      if(!$prosst) {
        $pross_arr=array(
          'post_type'=>'page',
          'post_title'=>'prosesco',
          'post_content'=>'',
          'post_status'=>'publish',
          'post_author'=>1
        );
        $pross_id=wp_insert_post($pross_arr);
        update_post_meta($pross_id,'_wp_page_template','proses.php');
      }
      $signupt=get_page_by_title('daftaranggota');
      if(!$signupt) {
        $signup_arr=array(
          'post_type'=>'page',
          'post_title'=>'daftaranggota',
          'post_content'=>'',
          'post_status'=>'publish',
          'post_author'=>1
        );
        $signup_id=wp_insert_post($signup_arr);
        update_post_meta($signup_id,'_wp_page_template','sign_up.php');
      }
    $anggotat=get_page_by_title('anggota');
      if(!$anggotat) {
        $anggota_arr=array(
          'post_type'=>'page',
          'post_title'=>'anggota',
          'post_content'=>'',
          'post_status'=>'publish',
          'post_author'=>1
        );
        $anggota_id=wp_insert_post($anggota_arr);
        update_post_meta($anggota_id,'_wp_page_template','anggota.php');
      }
     $masukt=get_page_by_title('masuk');
      if(!$masukt) {
        $masuk_arr=array(
          'post_type'=>'page',
          'post_title'=>'masuk',
          'post_content'=>'',
          'post_status'=>'publish',
          'post_author'=>1
        );
        $masuk_id=wp_insert_post($masuk_arr);
        update_post_meta($masuk_id,'_wp_page_template','login.php');
      }
    $t1= $wpdb->prefix .'detail_buyer';
    $t2= $wpdb->prefix .'t_produk';
    $t3= $wpdb->prefix .'t_pesanan';
    $t4=$wpdb->prefix.'t_keranjang';
    $t5=$wpdb->prefix.'t_penawaran';
    $t6=$wpdb->prefix.'t_ratings';
    $t7=$wpdb->prefix.'t_invoice';
    $t8=$wpdb->prefix.'t_quotation';
    $t9=$wpdb->prefix.'t_slider';
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $sql="CREATE TABLE IF NOT EXISTS `$t1` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `pm_email` varchar(255) NOT NULL,
          `pm_nama` varchar(50) NOT NULL,
          `pm_nohp` varchar(15) NOT NULL,
          `pm_pinbb` varchar(9) NOT NULL,
          `pm_alamat` varchar(255) NOT NULL,
          `prov` varchar(100) NOT NULL,
          `kota` varchar(100) NOT NULL,
          `pm_kdpos` varchar(7) NOT NULL,
          `pm_kecamatan` varchar(100) NOT NULL,
          `pm_jabatan` varchar(1) DEFAULT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

  $wpdb->query($sql);
  $sql2="CREATE TABLE IF NOT EXISTS `$t2` (
  `id` int(11) NOT NULL,
  `pm_produk` varchar(255) DEFAULT NULL,
  `pm_harga` int(11) DEFAULT NULL,
  `pm_qty` int(11) DEFAULT NULL,
  `pm_sub` int(11) DEFAULT NULL,
  `pm_bp` int(11) DEFAULT NULL,
  `sess_belanja` varchar(225) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

  $wpdb->query($sql2);

  $sql3="CREATE TABLE IF NOT EXISTS `$t3` (
  `id_pesanan` varchar(50) NOT NULL,
  `tgl_pesanan` varchar(50) NOT NULL,
  `nama_pemesan` varchar(50) DEFAULT NULL,
  `alamat` text,
  `email` varchar(20) DEFAULT NULL,
  `pesanan` text,
  `metodpay` varchar(20) DEFAULT NULL,
  `ttl_hrg` int(10) DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `ttlbayar` int(10) DEFAULT NULL
  ) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

  $wpdb->query($sql3);

  $sql4="CREATE TABLE IF NOT EXISTS `$t4`(
        `id` varchar(255) NOT NULL,
        `kd_prod` varchar(225) NOT NULL,
        `pm_waktu` varchar(30) NOT NULL,
        `pm_produk` varchar(225) NOT NULL,
        `pm_qty` int(15) NOT NULL,
        `pm_harga` int(25) NOT NULL,
        `pm_subtot` int(25) NOT NULL)
    ENGINE=MyISAM DEFAULT CHARSET=latin1;";
    
    $wpdb->query($sql4);
    $sql5="CREATE TABLE IF NOT EXISTS `$t5`(
          `id` varchar(255) NOT NULL,
          `nama` varchar(255) NOT NULL,
          `email` varchar(50) NOT NULL,
          `nohp` varchar(12) NOT NULL,
          `alamatpr` varchar(255) NOT NULL,
          `tgl` varchar(30) NOT NULL, 
          `ketopt` varchar(255) NOT NULL,
          `kd_prod` varchar(255) NOT NULL,
          `harga` int(20) NOT NULL,
          `qty` int(20) NOT NULL,
          `status` varchar(1) NOT NULL
          )ENGINE=MyISAM DEFAULT CHARSET=latin1;";
    $wpdb->query($sql5);

    $sql6="CREATE TABLE IF NOT EXISTS `$t6`(
    `id` int(10) NOT NULL,
    `kd_prod` varchar(255) NOT NULL,
    `total_value` varchar(30) NOT NULL,
    `komment` varchar(225) NOT NULL,
    `date` varchar(30) NOT NULL,
    PRIMARY KEY (`id`)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;";
    $wpdb->query($sql6);

    $sql7="CREATE TABLE IF NOT EXISTS `$t7` (
          `id` varchar(200) NOT NULL,
          `date` date NOT NULL,
          `pay_method` varchar(200) NOT NULL,
          `ship_method` varchar(200) NOT NULL,
          `pay_stat` varchar(20) NOT NULL,
          `note_pay` varchar(20) NOT NULL,
          `cust_name` varchar(200) NOT NULL,
          `cust_address` text NOT NULL,
          `cust_telp` varchar(20) NOT NULL,
          `bill_name` varchar(200) NOT NULL,
          `bill_address` text NOT NULL,
          `bill_telp` varchar(20) NOT NULL,
          `ship_name` varchar(200) NOT NULL,
          `ship_address` text NOT NULL,
          `ship_telp` varchar(20) NOT NULL,
          `produk` text NOT NULL,
          `qty` varchar(20) NOT NULL,
          `price` varchar(20) NOT NULL,
          `amount` varchar(20) NOT NULL,
          `subtotal` varchar(20) NOT NULL,
          `ship_cost` varchar(20) NOT NULL,
          `total_cost` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
  $wpdb->query($sql7);

  $sql8="CREATE TABLE IF NOT EXISTS `$t8`(
    `id` varchar(200) NOT NULL,
    `tgl` varchar(30) NOT NULL,
    `to` varchar(200) NOT NULL,
    `address` text NOT NULL,
    `attn` varchar(200) NOT NULL,
    `cc` varchar(200) DEFAULT NULL,
    `telp_bb` varchar(50) NOT NULL,
    `fax` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `model` varchar(20) NOT NULL,
    `produk` text NOT NULL,
    `qty` varchar(20) NOT NULL,
    `disc` varchar(20) NOT NULL,
    `price` varchar(200) NOT NULL,
    `amount` varchar(200) NOT NULL,
    `total` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
  $wpdb->query($sql8);

  $sql9="CREATE TABLE IF NOT EXISTS `$t9`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `src` varchar(255) NOT NULL,
    `date` varchar(30) NOT NULL,
    `visible` varchar(1),
    PRIMARY KEY (`id`)
    )ENGINE=MyISAM DEFAULT CHARSET=latin1;";
    $wpdb->query($sql9);

}
add_action("after_switch_theme", "myactivationfunction", 10 ,  2);  

function mydeactivationfunction($newname, $newtheme) {
  global $wpdb;
  //global $switched;
  $t4=$wpdb->prefix.'t_keranjang';
  $t5=$wpdb->prefix.'t_penawaran';
  $t6=$wpdb->prefix.'t_ratings';
  $t7=$wpdb->prefix.'t_invoice';
  $t8=$wpdb->prefix.'t_quotation';
  $t9=$wpdb->prefix.'t_slider';
  $sql = "DROP TABLE ".$wpdb->prefix."detail_buyer";
  $sql2 = "DROP TABLE ".$wpdb->prefix."t_produk";
  $sql3= "DROP TABLE ".$wpdb->prefix."t_pesanan";
  $sql4="DROP TABLE ".$t4;
  $sql5="DROP TABLE ".$t5;
  $sql6="DROP TABLE ".$t6;
  $sql7="DROP TABLE ".$t7;
  $sql8="DROP TABLE ".$t8;
  $sql9="DROP TABLE ".$t9;
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  $wpdb->query($sql);
  $wpdb->query($sql2);
  $wpdb->query($sql3);
  $wpdb->query($sql4);
  $wpdb->query($sql5);
  $wpdb->query($sql6);
  $wpdb->query($sql7);
  $wpdb->query($sql8);
  $wpdb->query($sql9);
  delete_option('wa');
  delete_option('ym');
  delete_option('line');
  delete_option('telp');
  delete_option('fax');
  delete_option('bb');
  delete_option('fb');
  delete_option('tw');
  $defaultPage3 = get_page_by_title( 'keranjangs' );
  $defaultPage4 = get_page_by_title( 'konfrimpesan' );
  $defaultPage5 = get_page_by_title( 'cot' );
  $defaultPage7 = get_page_by_title( 'prosesco' );
  $defaultPage8 = get_page_by_title( 'daftaranggota' );
  $defaultPage9 = get_page_by_title( 'anggota' );
  $defaultPage10 = get_page_by_title( 'masuk' );
  $defaultPage11 = get_page_by_title( 'keranjangmem' );
  wp_delete_post($defaultPage2->ID,true );
  wp_delete_post($defaultPage3->ID,true );
  wp_delete_post($defaultPage4->ID,true );
  wp_delete_post($defaultPage5->ID,true );
  wp_delete_post($defaultPage7->ID,true );
  wp_delete_post($defaultPage8->ID,true );
  wp_delete_post($defaultPage9->ID,true );
  wp_delete_post($defaultPage10->ID,true );
  wp_delete_post($defaultPage11->ID,true );
  //restore_current_blog();
}
add_action("switch_theme", "mydeactivationfunction", 10 , 2);



//-----------------------------------------------------------------------------font-------------------------------------------------
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {?>
  <style>
    body, td, textarea, input, select {
      font-family: "Lucida Grande";
      font-size: 12px;
    } 
  </style>
<?php
}
//-------------------------------------------------------------------------------------------------------------------------------

function redirect_login_page() {  
    $login_page  = home_url( '/masuk/' );  
    $page_viewed = basename($_SERVER['REQUEST_URI']);  
  
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {  
      //var_dump($_POST['cot']);
      /*if(!empty($_POST['cot'])) {
        wp_redirect($login_page);exit;  
      }else{
        wp_redirect(site_url().'/cot');exit;  
      }*/
    }  
}  
add_action('init','redirect_login_page');

//------------------------------------------------------------------------------------------login failed------------------------------------------------------------------------------

function login_failed() {  
    $login_page  = home_url( '/masuk/' );  
    wp_redirect( $login_page . '?failed' );  
    exit;  
}  
add_action( 'wp_login_failed', 'login_failed' ); 

//------------------------------------------------------------------------------------------admin-page---------------------------------------------------------------------
function redirect_admin_page() {
  if(!current_user_can('manage_options')) {  
    $adm_page  = home_url( '/masuk/' );  
    $p_viewed = basename($_SERVER['REQUEST_URI']);  
  
    if( $p_viewed == "wp-admin" && $_SERVER['REQUEST_METHOD'] == 'GET') {
            wp_redirect($adm_page);  
            exit;           
      }
  }  
}  
add_action('init','redirect_admin_page');  

//----------------------------------------------------------------copyright-----------------------------------------------------------------------------

function comicpress_copyright() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = "© " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}

//-------------------------------------------------------------------------wrong-----------------------------------------------------------------------------------------------------------------

$msgsg="hell";
add_filter('login_errors',create_function('$a', "return $msgsg;"));

//-------------------------------------------------------------------------redirect admin----------------------------------------------------------------------------------------------------------

function admin_login_redirect( $redirect_to, $request, $user )
{
global $user;
if( isset( $user->roles ) && is_array( $user->roles ) ) {
if( in_array( "administrator", $user->roles ) ) {
return $redirect_to;
} else {
  unset($_SESSION['basket']);
  return home_url()."/masuk";
}
}
else
{
return $redirect_to;
}
}
add_filter("login_redirect", "admin_login_redirect", 10, 3);


//----------------------------------------------------mengganti spasi menjadi dash url---------------------------------------------------------

function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}


//----------------------------------------------Archive Custom Post type-----------------------------------------------------------------------------------

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'produks',
    array(
      'labels' => array(
        'name' => __( 'produk' ),
        'singular_name' => __( 'produk' )
      ),
    'public' => true,
    'has_archive' => true,
    )
  );
}



//--------------------------------------------------------------form-upload-------------------------------------------------------------------

function kv_handle_attachment($file_handler,$post_id,$set_thu=false) {
  // check to make sure its a successful upload
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');

  $attach_id = media_handle_upload( $file_handler, $post_id );

         // If you want to set a featured image frmo your uploads. 
  if ($set_thu) set_post_thumbnail($post_id, $attach_id);
  return $attach_id;
}


//---------------------------------------------------------------add user custom field

function modify_contact_methods($profile_fields) {

  // Add new fields
  $profile_fields['pp'] ='url photo profile';
  $profile_fields['cover'] ='url cover profile';
  $profile_fields['nohp']='Nomer Handphone';
  $profile_fields['alamat']='Alamat User/Customer';
  $profile_fields['bill_name']='Atas Nama penagihan';
  $profile_fields['bill_alamat']='Alamat penagihan';
  $profile_fields['bill_hptel']='kontak penagihan';
  $profile_fields['ship_name']='Nama Penerima Expedisi';
  $profile_fields['ship_alamat']='Alamat Penerima Expedisi';
  $profile_fields['ship_hptel']='Kontak Penerima Expedisi';

  return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

//-----------------------------------------------------------------------



