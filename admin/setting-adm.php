<?php
  global $wpdb;
  global $post;
  $t5=$wpdb->prefix.'t_penawaran';
  $t9=$wpdb->prefix.'t_slider';
?>
<?php
if(isset($_GET['errorbnyk'])) {
  var_dump($errors);
}
if(isset($_GET['erroratu'])) {
  echo "<h1>ngampurane ko ora teyeng upload gambar</h1>";
}
?>
     <h2>Panel Pegaturan Tema JVM</h2>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#slider">
          Slider </a>
      </h4>
    </div>
    <div id="slider" class="panel-collapse collapse in">
      <div class="panel-body col-xs-6">
        <div class="table-responsive">
          <table>
          
            <tr>
              <td>Gambar (1220 X 285) pixel</td>
              <td>
                <form action="<?php echo home_url('/prosesco/9');?>" method="post" enctype="multipart/form-data" name="front_end_upload">
                  <div class="input-group">
                  <input type="file" name="slidd"/>
                  
                  <span class="input-group-btn">
                  <button class="btn btn-primary btn-md" type="submit" name="front_end_upload">upload</button>
                </span>
                </div>
                </form>
              </td>
            </tr>
                </table>
      </div>
          <table class="table"> 
            <tr>
                <th>No</th>
                <th>Src</th>
                <th>date</th>
                <th colspan="2">aksi</th>
            </tr>
              <?php 
              foreach ($wpdb->get_results("SELECT * FROM $t9") as $k => $isi) {
                echo "<tr>";
                echo "<td>".$isi->id."</td>";
                echo "<td>".$isi->src."</td>";
                echo "<td>".$isi->date."</td>"; ?>
                <td>
                <form action="<?php echo home_url('/prosesco/10');?>" method="post">
                <?php
                if($isi->visible=='1'):
                ?>
                <input type="hidden" name="kd" value="<?php echo $isi->id;?>" />
                <input type="hidden" name="vs" value="0" />
                <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-eye-close"></span></button>
              <?php else:?>
                <input type="hidden" name="kd" value="<?php echo $isi->id;?>" />
                <input type="hidden" name="vs" value="1" />
                <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a></button>
              <?php endif;?>
                </form></td>
                <td><form action="<?php echo home_url('/prosesco/11');?>" method="post">
                  <input type="hidden" name="kd" value="<?php echo $isi->id;?>" />
                  <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span></button>
                  </form>
                </td>
              <?php
                echo "</tr>";
              }
              ?>
          </table>
    </div>
  </div><div style="clear:both;"></div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Penawaran<span class="badge pull-right">
        <?php
          $wpdb->get_results("SELECT * FROM $t5 WHERE status='0'");
          echo $wpdb->num_rows;         
        ?>
      </span>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body col-xs-6">
<div class="table-responsive">
  <table class="table">
    <thead>
      <td>id</td>
      <td>Nama</td>
      <td>jabatan</td>
      <td>Email</td>
      <td>Nohape</td>
      <td>Alamat</td>
      <td>Tgl Penawaran</td>
      <td>Kode Produk</td>
      <td>Harga</td>
      <td>kuantitas</td>
      <td>ket. Optional</td>
      <td>status</td>
      <td>Aksi</td>
    </thead>
    <tbody>
      <?php
        foreach ($wpdb->get_results("SELECT * FROM $t5 ") as $key => $value){
            if(get_user_by('login',$value->nama)){
                $jbtn="member";
            }else{
                $jbtn="bukan member";
            }
            echo "<tr>";
            echo "
            <td>".$value->id."</td>
            <td>".$value->nama."</td>
            <td>".$jbtn."</td>
            <td>".$value->email."</td>
            <td>".$value->nohp."</td>
            <td>".$value->alamatpr."</td>
            <td>".$value->tgl."</td>
            <td><a href='".esc_url(home_url( '/'.seoUrl(get_the_title($value->kd_prod))))."' target='blank'>".$value->kd_prod."</a></td>
            <td>".$value->harga."</td>
            <td>".$value->qty."</td>
            <td>".$value->ketopt."</td>
            <td>".$value->status."</td>"; ?>
<td>
  <form role="form" action="<?php echo home_url('/prosesco/6');?>" method="post">
    <?php if($value->status!='0'){ ?>
      <span class="glyphicon glyphicon-ok"></span>
    <?php }else{?>
    <input type="hidden" name="idpenwrn" value="<?php echo $value->id;?>" />
    <input type="hidden" name="emailp" value="<?php echo $value->email;?>" />
    <input type="hidden" name="kdprod" value="<?php echo $value->kd_prod;?>" />
    <input type="submit" name="konfrim" class="btn btn-sm btn-danger" value="konfirmasi" />
    <?php }?>
  </form>
</td>
            <?php echo "</tr>"; 
      }
      ?>
    </tbody>
  </table>
</div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#bank">
          Tentang Toko
        </a>
      </h4>
    </div>
    <div id="bank" class="panel-collapse collapse">
      <div class="panel-body col-md-8">
        <?php include(TEMPLATEPATH.'/bank.php');?>
      </div>
    </div>
  </div>
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#sosial">
         Kontak Sosial
        </a>
      </h4>
    </div>
    <div id="sosial" class="panel-collapse collapse">
      <div class="panel-body col-xs-6">
        <form class="form-horizontal" role="form" method="post" action="options.php">
          <?php wp_nonce_field('update-options') ?>
          <div class="form-group">
              <label class="col-sm-2 control-label">No.telp</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="telp" value="<?php echo get_option('telp'); ?>">
                </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">WhatsApp</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="wa" value="<?php echo get_option('wa'); ?>">
                </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Yahoo messenger</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="ym" value="<?php echo get_option('ym'); ?>">
                </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Line</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="line" value="<?php echo get_option('line'); ?>">
                </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Pin BB</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="bb" value="<?php echo get_option('bb'); ?>">
                </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">No. Fax</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="fax" value="<?php echo get_option('fax'); ?>">
                </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Facebook</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="fb" value="<?php echo get_option('fb'); ?>">
                </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Twitter</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="tw" value="<?php echo get_option('tw'); ?>">
                </div>
          </div>
          <button type="submit" class="btn btn-default">save</button>
          <input type="hidden" name="action" value="update" />
          <input type="hidden" name="page_options" value="telp,ym,line,wa,bb,fax,fb,tw"/>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>