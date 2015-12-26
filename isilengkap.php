 <form method="post" action="<?php echo get_site_url().'/anggota/3'; ?>">
      <div class='container' style='margin:0 auto;margin-top:30px;'>
    <div class='alert alert-warning col-xs-12 col-md-6'>
    <a href='#' class='close' data-dismiss='alert'>&times;</a>
    isikan data sesuai field berikut
  </div>
  </div>
      <div class="form-group">
            <label>No hp</label>
            <input type="text" class="form-control" name="nohp" placeholder="<?php the_author_meta( 'nohp', $current_user->ID ); ?>">
      </div>
      <div class="form-group">
              <label >user email</label>
              <input type="text" class="form-control" name="user_email" placeholder="<?php the_author_meta( 'user_email', $current_user->ID ); ?>">
      </div>
      <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea type="text" class="form-control" id="alamat" name="alamat">
              <?php the_author_meta( 'alamat', $current_user->ID ); ?>
            </textarea>
      </div>
      <input type="hidden" name="cot" value="1"/>
    <button type="submit" class="btn btn-default">Submit</button>
    </form>