<?php 
if(isset($_GET['passnotmatch'])): ?>
  <div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert">×</a>
    The passwords you entered do not match.  Your password was not updated.
  </div>
<?php endif; ?>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#pass">
          Ubah password
        </a>
      </h4>
    </div>
    <div id="pass" class="panel-collapse collapse out">
      <div class="panel-body">
        <form class="form-inline" action="<?php echo get_site_url().'/anggota/2';?>" method="post" role="form">
        <div class="form-group">
          <label class="sr-only" for="pass1">Password</label>
          <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Password">
        </div>
        <div class="form-group">
          <label class="sr-only" for="pass2">Re-type Password</label>
          <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Re-type Password">
        </div>
        <span id="pass-strength-result"></span>
         <button type="submit" class="btn btn-default">Update</button>
        </form>
        
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Ubah info Akun
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <form method="post" action="<?php echo get_site_url().'/anggota/4'; ?>">
          <div class="form-group">
              <label >Username</label>
              <input type="text" class="form-control" name="user_login" value="<?php the_author_meta( 'user_login', $current_user->ID ); ?>" readonly>
          </div>
          <div class="form-group">
              <label >user nicename</label>
              <input type="text" class="form-control" name="user_nicename" value="<?php the_author_meta( 'user_nicename', $current_user->ID ); ?>">
          </div>
          <div class="form-group">
              <label >user email</label>
              <input type="text" class="form-control" name="user_email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>">
          </div>
          <div class="form-group">
              <label >No. Handphone</label>
              <input type="text" class="form-control" name="nohp" value="<?php the_author_meta( 'nohp', $current_user->ID ); ?>">
          </div>
          <div class="form-group">
              <label >Website</label>
              <input type="text" class="form-control" name="user_url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" pattern="https?://.+">
          </div>
          <div class="form-group">
              <label >user status</label>
              <input type="text" class="form-control" name="user_status" value="<?php the_author_meta( 'user_status', $current_user->ID ); ?>" readonly>
          </div>
          <div class="form-group">
              <label >display_name</label>
              <input type="text" class="form-control" name="display_name" value="<?php the_author_meta( 'display_name', $current_user->ID ); ?>">
          </div>
         <button type="submit" class="btn btn-default">Update</button>     
        </form>
      </div>
    </div>
  </div>
 

 <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#ava">
          ubah Avatar
        </a>
      </h4>
    </div>
    <div id="ava" class="panel-collapse collapse out">
      <div class="panel-body">
      <form action="<?php echo home_url('/prosesco/8');?>" method="post" enctype="multipart/form-data" name="front_end_upload" >
        <label>Upload Photo Profile
        <input type="file" name="coveruser">
        </label>
        <input type="hidden" name="idyangupload" value="<?php echo $userdata->ID;?>">
        <input type="submit" name="Upload" >
        </form>
      </div>
    </div>
  </div>


</div>