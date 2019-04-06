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
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Proje Ekle</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Proje Başlık</label>
            <input type="text" class="form-control" name="proje_baslik" placeholder="Projenin Başlığı">
          </div>
          <div class="form-group col-md-6">
            <label>Bitirme Tarihi</label>
            <input type="date" class="form-control" name="proje_teslim_tarihi" placeholder="Projenin Bitirilmesi Gereken Tarih">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Proje Durumu</label>
            <select name="proje_durum" class="form-control">
              <option>Yeni Başladı</option>
              <option>Devam Ediyor</option>
              <option>Bitti</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label for="inputState">Aciliyet</label>
            <select required name="proje_aciliyet" class="form-control">
              <option>Acil</option>
              <option>Normal</option>
              <option>Acelesi Yok</option>
            </select>
          </div>
        </div>

        <div class="form-row justify-content-center">
         <div class="col-md-6">
          <div class="file-loading">
            <input class="form-control" id="proje_dosya" name="proje_dosya" type="file">
          </div>
        </div>
      </div>
      <div class="form-row mt-2">
        <div class="form-group col-md-12">
          <textarea class="ckeditor" name="proje_detay" id="editor"></textarea>
        </div>
      </div>
      <button type="submit" name="projeekle" class="btn btn-primary">Kaydet</button>
    </form>
  </div>
</div>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
 CKEDITOR.replace('editor',{
 });
</script>
<script>
  $(document).ready(function () {
    var url1='<?php echo $ayarcek['site_logo'] ?>';
    $("#proje_dosya").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
      allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
    });
  });
</script>