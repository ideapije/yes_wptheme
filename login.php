<?php
/*
 * Template Name:masuk
 */
?>
      <?php get_header(); ?>
<?php if(!$user_ID){ ?>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-8">
<div class="container col-md-6">
  <?php if(isset($_GET['failed'])):?>
    <div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert">×</a>Username dan Password salah !</div>
  <?php endif;?>
 <form class="form-horizontal" method="post" action="<?php bloginfo('url') ?>/wp-login.php" style="padding:10px;">
     <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" class="form-control" placeholder="username or email" required/>                                        
                                    </div>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                        <input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" class="form-control" placeholder="password" required/>
                                    </div>
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="rememberme" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <button type="submit" id="btn-login" class="btn btn-success">masuk</button>
                                    </div>
                                    <div class="col-sm-12 controls">
                                      Belum punya akun? <a href="<?php echo site_url().'/daftar'?>">Daftar disini</a><br/>
                                      <a href="<?php echo site_url().'/daftar/1';?>">lupa password</a>
                                    </div>
                                </div>
    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
    <input type="hidden" name="user-cookie" value="1" />
</form>
</div>
</div>
        <div class="col-xs-6 col-md-4">
          <?php get_sidebar(); ?>
        </div>
</div>
<?php $login=(isset($_GET['login']) ) ? $_GET['login']:0;?>
<?php
if ( $login === "failed" ) {  
    echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';  
} elseif ( $login === "empty" ) {  
    echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';  
} elseif ( $login === "false" ) {  
    echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';  
}  
?>

<?php }else{ // is logged in ?>
    <?php if(current_user_can('manage_options')) { 
              echo "user admin";
    }else{ 
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------?>
              


<?php include('/dashboard-user.php');?>

    
<?php
//------------------------------------------------------------------------------------------------------------------------------------------------------------------
  } ?>
<?php }?>

    <?php get_footer(); ?>