<?php
if(isset($_POST["daftars"])){
        $privatekey = "6Les6PQSAAAAAKlcWYY7yt2xszZwNsZthAfj2O2K";
        $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
        // What happens when the CAPTCHA was entered incorrectly
        die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
            "(reCAPTCHA said: " . $resp->error . ")"."<a href='".site_url()."/masuk'>back</a>");
        }else{
        // Your code here to handle a successful verification
        $userdata = array(
        'display_name'=>$_POST['nama'],
        'user_login'=>$_POST['log'],
        'user_email'=>$_POST['user_email'],
        'user_pass'=>$_POST['pwd'] 
        );
        $userins=wp_insert_user($userdata);
        //var_dump($userins);
        wp_redirect(get_site_url().'/masuk' ); exit;
    }
}
?>
<div class="container col-xs-6">
<form role="form" name="daftars" method="post" style="padding:10px;">
  
  <div class="form-group">
    <label >Nama Lengkap</label>
    <input type="text" class="form-control" id="nama" name="nama">
  </div>
    <div class="form-group">
    <label >username</label>
    <input type="text" class="form-control" name="log"  required>
  </div>
  <div class="form-group">
    <label >Email</label>
    <input type="email" class="form-control" name="user_email"  required>
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" class="form-control  " name="pwd" required>
  </div>
  <div class="form-group">
    <label >re-type password</label>
    <input type="password" class="form-control  " name="password_retyped">
  </div>
  <div class="form-group in-line">
    <label >Gender</label>
      <div class="radio">
                <label>
                <input type="radio" name="gender"  value="f">
                Perempuan
                </label>
            </div>
            <div class="radio">
                <label>
                <input type="radio" name="gender" value="m">
                Laki-laki
                </label>
            </div>
  </div>
  <div class="form-group">
    <label ></label>
     <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6Les6PQSAAAAAHDbPWzzMiE8pWCAO1R3-tx4TXMx">
  </script>
  <noscript>
  <iframe src="http://www.google.com/recaptcha/api/noscript?k=6Les6PQSAAAAAHDbPWzzMiE8pWCAO1R3-tx4TXMx" height="300" width="500" frameborder="0"></iframe><br>
  <textarea name="recaptcha_challenge_field" rows="3" cols="40">
  </textarea>
  <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
  </noscript>
  </div>
  <div class="form-group">
    <label ><a href="#nohpe" class="" data-toggle="collapse" >
                silahkan klik disini untuk dapat sign in dengan no.hp
            </a>
    </label>
            <div id="nohpe" class="collapse out">
            <div class="container col-sm-6">
                <div class="input-group" style="margin:10px;">
                <input type="text" class="form-control" name="hp" placeholder="nomor handphone">
                <span class="input-group-btn"><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span></a></span>
                </div>
                <div class="input-group" style="margin:10px;">
                <input type="text" class="form-control" name="verhp" placeholder="kode verifikasi">
                <span class="input-group-btn"><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-retweet"></span></a></span>
                </div>
            </div>
            </div>
  </div>
  <button name="daftars" type="submit" class="btn btn-default">Submit</button>
</form>
</div>