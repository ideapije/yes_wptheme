<div class="row">
<div class="col-lg-12" style="margin-top:30px;">
     <ul id="tab" class="nav nav-tabs">
  <li><a href="#signin" data-toggle="tab">Login</a></li>
  <li><a href="#signup" data-toggle="tab">Bukan Member</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade in active panel" id="signin" style="border-radius:0px;padding:10px;">
    <div class="row">
        <div class="col-xs-6">
          <?php include(TEMPLATEPATH.'/form-login.php');?>
        </div>
  </div>
    </div>
    <div class="tab-pane fade panel" id="signup" style="border-radius:0px;padding:10px;">
      <div class="row">
        <div class="col-12 col-lg-12">
                    <form action="<?php echo  get_site_url().'/prosesco/1';?>" method="post">
                      <fieldset><legend><h2>Detail Informasi</h2></legend>
                <div class="form-group col-md-8">
                              <label for="email">Email *</label>
                              <input type="email" class="input-mini form-control " name="email" required>
                </div>
                <div class="form-group col-md-8">
                              <label for="nama">Nama lengkap</label>
                              <input type="text" class="input-mini form-control " name="nama" required>
                </div>
                <div class="form-group col-md-8">
                              <label for="nohp">Nomor Handphone</label>
                              <input type="text" class="input-mini form-control " name="nohp" required>
                </div>
                <div class="form-group col-md-8">
                              <label for="pinbb">Pin BB&nbsp(jika Ada)</label>
                              <input type="text" class="input-mini form-control " name="pinbb" required>
                </div>
                <div class="form-group col-md-8">
                              <label for="alamat">Alamat</label>
                              <textarea name="alamat" cols="40" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group col-md-8">
                              <label for="prov">Provinsi</label>
                              <select name="prov"  class="form-control">
<option value="" selected="selected">Pilih</option>
<option value="NanggroeAcehDarussalam">Nanggroe Aceh Darussalam</option>
<option value="SumateraUtara">Sumatera Utara</option>
<option value="SumateraBarat">Sumatera Barat</option>
<option value="Bengkulu">Bengkulu</option>
<option value="Jambi">Jambi</option>
<option value="Riau">Riau</option>
<option value="SumateraSelatan">Sumatera Selatan</option>
<option value="Lampung">Lampung</option>
<option value="KepulauanBangkaBelitung">Kepulauan Bangka Belitung</option>
<option value="KepulauanRiau">Kepulauan Riau</option>
<option value="Banten">Banten</option>
<option value="DKIJakarta">DKI Jakarta</option>
<option value="JawaBarat">Jawa Barat</option>
<option value="JawaTengah">Jawa Tengah</option>
<option value="JawaTimur">Jawa Timur</option>
<option value="DIYogyakarta">DI Yogyakarta</option>
<option value="Bali">Bali</option>
<option value="NusaTenggaraBarat">Nusa Tenggara Barat</option>
<option value="NusaTenggaraTimur">Nusa Tenggara Timur</option>
<option value="KalimantanBarat">Kalimantan Barat</option>
<option value="KalimantanSelatan">Kalimantan Selatan</option>
<option value="KalimantanTengah">Kalimantan Tengah</option>
<option value="KalimantanTimur">Kalimantan Timur</option>
<option value="Gorontalo">Gorontalo</option>
<option value="SulawesiSelatan">Sulawesi Selatan</option>
<option value="SulawesiTenggara">Sulawesi Tenggara</option>
<option value="SulawesiTengah">Sulawesi Tengah</option>
<option value="SulawesiUtara">Sulawesi Utara</option>
<option value="SulawesiBarat">Sulawesi Barat</option>
<option value="Maluku">Maluku</option>
<option value="MalukuUtara">Maluku Utara</option>
<option value="PapuaBarat">Papua Barat</option>
<option value="Papua">Papua</option>
</select>
                </div>
                <div class="form-group col-md-8">
                    <label for="kota">Kota</label>
                    <select name="kota"  class="form-control">
                        <option value="kota" selected>Kota</option>
                    </select>
                </div>
                <div class="form-group col-md-8">
                              <label for="kec">kecamatan</label>
                              <select name="kec" class="form-control">
                                <option value="kec" selected>Kecamatan</option>
                                </select>
                </div>
                <div class="form-group col-md-8">
                              <label for="kdpos">Kode Pos</label>
                              <input type="text" class="input-mini form-control " name="kdpos" required>
                </div>
                <div class="form-group col-md-8">
                              <label></label>
                               <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6Les6PQSAAAAAHDbPWzzMiE8pWCAO1R3-tx4TXMx">
  </script>
  <noscript>
  <iframe src="http://www.google.com/recaptcha/api/noscript?k=6Les6PQSAAAAAHDbPWzzMiE8pWCAO1R3-tx4TXMx" height="300" width="500" frameborder="0"></iframe><br>
  <textarea name="recaptcha_challenge_field" rows="3" cols="40">
  </textarea>
  <input type="hidden" name="recptch_field" value="manual_challenge">
  </noscript>
                </div>
                <div class="form-group col-md-8">                              
                    <input type="submit" class="btn btn-primary btn-sm" value="Selanjutnya">
                </div>
              </fieldset>
            </form>
        </div>
        </div>
    </div>
  </div>
  </div>
  </div>
  