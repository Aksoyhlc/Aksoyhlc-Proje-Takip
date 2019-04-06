<?php 
include 'header.php';
if (yetkikontrol()!="yetkili") {
  header("location:index.php?durum=izinsiz");
  exit;
}
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<!-- Begin Page Content -->
<div class="container">
  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>İsim Soyisim</label>
        <input type="text" class="form-control" required name="musteri_isim" placeholder="Müşteri İsim Soyisim">
      </div>
      <div class="form-group col-md-6">
        <label>E-Posta</label>
        <input type="email" class="form-control" required name="musteri_mail" placeholder="Müşteri E-Mail">
      </div>
      
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Telefon Numarası</label>
        <input type="number" class="form-control" required name="musteri_telefon" placeholder="Müşteri Telefon Numarası">
      </div>
      <div class="form-group col-md-6">
        <label>Sipariş Başlığı</label>
        <input type="text" class="form-control" required name="sip_baslik" placeholder="İş-Sipariş Başlığı">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Sipariş Durumu</label>
        <select required name="sip_durum" class="form-control">
          <option>Yeni Başladı</option>
          <option>Devam Ediyor</option>
          <option>Bitti</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Ücret (TL)</label>
        <input type="number" class="form-control" required name="sip_ucret" placeholder="Siparişinizin Ücretini Girin">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Teslim Tarihi</label>
        <input type="date" class="form-control" required name="sip_teslim_tarihi" placeholder="Teslim Tarihi">
      </div>
      <div class="form-group col-md-6">
        <label>Aciliyet</label>
        <select required required name="sip_aciliyet" class="form-control">
          <option>Acil</option>
          <option>Normal</option>
          <option>Acelesi Yok</option>
        </select>
      </div> 
    </div>
    <div class="form-row mb-3">
     <div class="form-group col-md-6">
      <label>Görevliler</label>
      <select multiple required name="sip_kullanici[]" class="form-control">
       <?php 
       $kullanici=$db->prepare("SELECT * FROM kullanicilar");
       $kullanici->execute();
       while ($kullanicicek=$kullanici->fetch(PDO::FETCH_ASSOC)) {?>
        <option value="<?php echo $kullanicicek['kul_id']; ?>"><?php echo $kullanicicek['kul_isim']; ?></option>

      <?php } ?>
    </select>
  </div>
  <div class="col-md-6">
    <div class="file-loading">
      <input class="form-control" id="proje_dosya" required name="proje_dosya" type="file">
    </div>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-12">
    <textarea class="ckeditor" required name="sip_detay" id="editor"></textarea>
  </div>
</div>
<button type="submit" name="siparisekle" class="btn btn-primary">Kaydet</button>
</form>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor' );
</script>
<!--İşlem sonucu açılan bildirim popupunu otomatik kapatma giriş-->
<script type="text/javascript">
  $('#islemsonucu').modal('show');
  setTimeout(function() {
    $('#islemsonucu').modal('hide');
  }, 3000);
</script>
<!--İşlem sonucu açılan bildirim popupunu otomatik kapatma çıkış-->
<script>
  $(document).ready(function () {
    $("#proje_dosya").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
       allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
    });
  });
</script>