<?php if ( !is_user_logged_in() ) : ?>
                    <p class="warning">
                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                    </p><!-- .warning -->
            <?php else : ?>
              <form method="post" action="<?php echo get_site_url().'/anggota/3'; ?>">
                <div class="form-group" >
                    <label for="fn">Nama Depan</label>
                    <input type="text" class="form-control" id="fn" name="fn" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>"/>
                </div>
                <div class="form-group">
                    <label for="ln">Nama Belakang</label>
                    <input type="text" class="form-control" id="ln" name="ln" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>">
                </div>
                <div class="form-group">
                    <label for="nn">Nama Panggilan</label>
                    <input type="text" class="form-control" id="nn" name="nn" value="<?php the_author_meta( 'nick_name', $current_user->ID ); ?>">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea type="text" class="form-control" id="alamat" name="alamat"><?php the_author_meta( 'alamat', $current_user->ID ); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="deskrip">Deskripsi(BIO)</label>
                    <textarea type="text" class="form-control" id="deskrip" name="deskrip"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                </form>
            <?php endif; ?>