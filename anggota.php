<?php
/*
	Template name:anggota
 */
?>

<?php
global $session;
global $wpdb;
global $current_user, $wp_roles;
if(is_user_logged_in()):
$seg=basename($_SERVER['REQUEST_URI']);
switch ($seg) {
	case '1':
        $privatekey = "6Les6PQSAAAAAKlcWYY7yt2xszZwNsZthAfj2O2K";
        $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
        // What happens when the CAPTCHA was entered incorrectly
        die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
            "(reCAPTCHA said: " . $resp->error . ")"."<a href='".site_url()."/masuk'>back</a>");
        } else {
        // Your code here to handle a successful verification
        $userdata = array(
        'display_name'=>$_POST['nama'],
        'user_login'=>$_POST['log'],
        'user_email'=>$_POST['user_email'],
        'user_pass'=>$_POST['pwd'] 
        );
        $userins=wp_insert_user($userdata);
        //var_dump($userins);
        wp_redirect(get_site_url().'/wp-login.php' ); exit;
    }
		break;
	case '2':
		  if(!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
          
        	if ($_POST['pass1'] == $_POST['pass2'] ){
        		update_user_meta( $current_user->ID, 'user_pass', esc_attr( $_POST['pass1'] ) );
                wp_redirect(get_site_url().'/masuk' ); exit;
        	}else{
                wp_redirect(get_site_url().'/masuk?passnotmatch' ); exit;
    		}
        }
		  break;
	case '3':
	if ( !empty( $_POST['alamat'] ) )
        update_user_meta( $current_user->ID, 'alamat', esc_attr( $_POST['alamat'] ) );
    if ( !empty( $_POST['user_email'] ) )
        wp_update_user(array('user_email'=>esc_attr($_POST['user_email'])));
	if( !empty( $_POST['fn'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['fn'] ) );
    if ( !empty( $_POST['ln'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['ln'] ) );
    if ( !empty( $_POST['nn'] ) )
        update_user_meta($current_user->ID, 'nick_name', esc_attr( $_POST['nn'] ) );
    if ( !empty( $_POST['deskrip'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['deskrip'] ) );
    if ( !empty( $_POST['nohp'] ) )
        update_user_meta( $current_user->ID, 'nohp', esc_attr( $_POST['nohp'] ) );
    if(!empty($_POST['cot'])){
            wp_redirect(get_site_url().'/konfrimpesan' ); exit;
    }else{
            wp_redirect(get_site_url().'/masuk' ); exit;
    }
	break;
    case '4':
        if(is_user_logged_in()){
            $cmd=wp_update_user(
            array(
                    'ID'=>$current_user->ID,
                    'user_nicename'=>esc_attr($_POST['user_nicename']),
                    'user_email'=>esc_attr($_POST['user_email']),
                    'display_name'=>esc_attr($_POST['display_name']),
                    'user_url'=>esc_attr( $_POST['user_url'] )
                )
            );
            if(!empty( $_POST['nohp'] ))
                update_user_meta( $current_user->ID, 'nohp', esc_attr( $_POST['nohp'] ) );
            if(is_wp_error($cmd)) {
                wp_redirect(get_site_url().'/masuk/error' ); exit;
            }else{
                wp_redirect(get_site_url().'/masuk' ); exit;
            }
        }else{
            wp_redirect(get_site_url().'/masuk' ); exit;
        }
        break;
	default:
		echo "<center><div class='alert alert-warning'>(^0^)/ Terjadi kesalahan</div></center>";
		break;
}
else:
    wp_redirect(home_url());
endif;
?>