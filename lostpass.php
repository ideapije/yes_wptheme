<form method="post" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>" style="padding:10px;" role="form">
                <div class="username">
                    <label for="user_login" class="hide"><?php _e('Username or Email'); ?>: </label>
                    <div class="col-lg-12">
                        <div class="input-group col-lg-6">
                            <input type="text" class="form-control" name="user_login" value="" size="20" id="user_login" tabindex="1001"/>
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" value="<?php _e('Reset my password'); ?>" class="btn btn-primary" tabindex="1002">Reset</button>
                            </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div>
                <div class="login_fields">
                    <?php do_action('login_form', 'resetpass'); ?>
                    <?php 
                    $reset = $_GET['reset']; if($reset == true)
                    { 
                        $msg="
                        <div class='alert alert-warning col-xs-12 col-md-6'>
                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        Kami akan kirimkan pesan ke email anda
                        </div>"; 
                    }
                    ?>
                    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?reset=true" />
                    <input type="hidden" name="user-cookie" value="1" />
                </div>
</form>
<?php echo $msg;?>