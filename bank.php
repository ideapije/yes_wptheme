
<div class="panel-group" id="banksupp">

 <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#banksupp" href="#ttg">
          Informasi Toko
        </a>
      </h4>
    </div>
    <div id="ttg" class="panel-collapse collapse in">
      <div class="panel-body">
        <form class="form-horizontal" role="form" method="post" action="options.php">
          <?php wp_nonce_field('update-options') ?>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">jam Buka Toko</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="buka" value="<?php echo get_option('buka'); ?>" placeholder="09:00 s/d 17:00"/>
            </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">save</button>
            </div>
            </div>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="buka" />
        </form>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#banksupp" href="#bca">
          Support bank BCA
        </a>
      </h4>
    </div>
    <div id="bca" class="panel-collapse collapse in">
      <div class="panel-body">
        <form class="form-horizontal" role="form" method="post" action="options.php">
          <?php wp_nonce_field('update-options') ?>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">No. rekening BCA</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="norekbca" value="<?php echo get_option('norekbca'); ?>">
            </div>
            </div>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">Atas Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namebca" value="<?php echo get_option('namebca'); ?>">
            </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">save</button>
            </div>
            </div>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="norekbca,namebca" />
        </form>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#banksupp" href="#bni">
          Support Bank BNI
        </a>
      </h4>
    </div>
    <div id="bni" class="panel-collapse collapse">
      <div class="panel-body">
         <form class="form-horizontal" role="form" method="post" action="options.php">
          <?php wp_nonce_field('update-options') ?>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">No. rekening BNI</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="norekbni" value="<?php echo get_option('norekbni'); ?>">
            </div>
            </div>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">Atas Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namebni" value="<?php echo get_option('namebni'); ?>">
            </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">save</button>
            </div>
            </div>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="norekbni,namebni" />
        </form>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#banksupp" href="#Mandiri">
          Support bank Mandiri
        </a>
      </h4>
    </div>
    <div id="Mandiri" class="panel-collapse collapse">
      <div class="panel-body">
        <form class="form-horizontal" role="form" method="post" action="options.php">
          <?php wp_nonce_field('update-options') ?>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">No. rekening Mandiri</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="norekmandiri" value="<?php echo get_option('norekmandiri'); ?>">
            </div>
            </div>
            <div class="form-group">
            <label for="" class="col-sm-2 control-label">Atas Nama </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="namemandiri" value="<?php echo get_option('namemandiri'); ?>">
            </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">save</button>
            </div>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="norekmandiri,namemandiri" />
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>