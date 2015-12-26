    <form class="form-horizontal" method="post" action="<?php echo get_site_url().'/prosesco/3';?>">
            <?php 
    $urlast=basename($_SERVER['REQUEST_URI']);
    $args=array(
        'post_type'=>'produks',
        'post_status'=>'publish'
        );
    $inputambhan="";
    $posts_array = get_posts( $args );
    foreach ($posts_array as $key => $value) {
        $idpost=$value->ID;
        if($urlast==$idpost){
            $inputambhan="<input type='hidden' name='penawaran' value='1' />";
        }
    }
    ?>
     <div style="margin-bottom: 25px" class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" class="form-control" placeholder="username or email" required/>                                        
    </div>
    <div style="margin-bottom: 25px" class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
      <input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" class="form-control" placeholder="password" required/>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-2 col-md-3">
            <div class="checkbox">
                <label for="rememberme">
                            <input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /> Remember me
                </label>
            </div>
        </div>
    </div>
    <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
    <input type="hidden" name="user-cookie" value="1" />
    <?php echo $inputambhan;?>
    <div class="form-group">
        <div class="col-xs-offset-2 col-md-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
</form>