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
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow br-1">
        <div class="card-body">
          <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>İsim Soyisim</label>
                <input type="text" class="form-control" required name="musteri_isim" placeholder="Müşteri İsim Soyisim">
              </div>
              <div class="form-group col-md-4">
                <label>E-Posta</label>
                <input type="email" class="form-control" required name="musteri_mail" placeholder="Müşteri E-Mail">
              </div>
              <div class="form-group col-md-4">
                <label>Telefon Numarası</label>
                <input type="number" class="form-control" name="musteri_telefon" placeholder="Müşteri Telefon Numarası">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Sipariş Başlığı</label>
                <input type="text" class="form-control" required name="sip_baslik" placeholder="İş-Sipariş Başlığı">
              </div>
              <div class="form-group col-md-6">
                <label>Sipariş Tamamlanma Yüzdesi</label>
                <input type="number" min="0" max="100" value="0" class="form-control" required name="yuzde" placeholder="Sipariş Tamamlanma Yüzdesi">
              </div>
            </div>
            <div class="form-row">
              
              <div class="form-group col-md-6">
                <label>Ücret (TL)</label>
                <input type="number" class="form-control" required name="sip_ucret" placeholder="Siparişinizin Ücretini Girin">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Başlangıç Tarihi</label>
                <input type="date" class="form-control" required name="sip_baslama_tarih" placeholder="Başlangıç Tarihi">
              </div>
              <div class="form-group col-md-6">
                <label>Teslim Tarihi</label>
                <input type="date" class="form-control" required name="sip_teslim_tarihi" placeholder="Teslim Tarihi">
              </div>

              <div class="form-group col-md-6">
                <label>Aciliyet</label>
                <select required name="sip_aciliyet" class="form-control">
                  <?php foreach (aciliyet() as $key => $value): ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                  <?php endforeach ?>
                </select>
              </div> 
              <div class="form-group col-md-6">
                <label>Sipariş Durumu</label>
                <select required name="sip_durum" class="form-control">
                  <?php foreach (durum() as $key => $value): ?>
                    <option value="<?php echo $key ?>"><?php echo $value ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            
            <div class="form-row d-flex justify-content-center mb-3">
              <div class="col-md-6">
                <div class="file-loading">
                  <input class="form-control" id="sip_dosya" name="sip_dosya" type="file">
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <textarea class="ckeditor" name="sip_detay" id="editor"></textarea>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" name="siparisekle" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Kaydet</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>

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
    $("#sip_dosya").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
      allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
    });
  });
</script>
