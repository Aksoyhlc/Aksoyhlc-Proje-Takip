
<?php 
include 'header.php';
if (isset($_POST['kul_id'])) {
  $kullanicisor=$db->prepare("SELECT * FROM kullanicilar where kul_id=:id");
  $kullanicisor->execute(array(
    'id' => guvenlik($_POST['kul_id'])
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
} else {
  $kullanicisor=$db->prepare("SELECT * FROM kullanicilar where session_mail=:mail");
  $kullanicisor->execute(array(
    'mail' => $_SESSION['kul_mail']
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
}
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<style type="text/css" media="screen">
  @media only screen and (max-width: 700px) {
    .mobilgizle {
      display: none;
    }
    .mobilgizleexport {
      display: none;
    }
    .mobilgoster {
      display: block;
    }
  }
  @media only screen and (min-width: 700px) {
    .mobilgizleexport {
      display: flex;
    }
    .mobilgizle {
      display: block;
    }
    .mobilgoster {
      display: none;
    }
  }
</style>
<script type="text/javascript">
  var genislik = $(window).width()   
  if (genislik < 768) {
    function yenile(){
      $('#sidebarToggleTop').trigger('click');
    }
    setTimeout("yenile()",1);
  }
</script>
<div class="container">
  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>İsim Soyisim</label>
        <input type="text" required class="form-control" value="<?php echo $kullanicicek['kul_isim'] ?>" name="kul_isim" placeholder="İsim">
      </div>
      <div class="form-group col-md-6">
        <label>E-Posta</label>
        <input type="email" required class="form-control" value="<?php echo $kullanicicek['kul_mail'] ?>" name="kul_mail" placeholder="E-Mail">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Telefon Numarası</label>
        <input type="number" required class="form-control" value="<?php echo $kullanicicek['kul_telefon'] ?>" name="kul_telefon" placeholder="Telefon Numarası">
      </div>
      <div class="form-group col-md-6">
        <label>Ünvanı</label>
        <input type="text" required class="form-control" value="<?php echo $kullanicicek['kul_unvan'] ?>" name="kul_unvan" placeholder="Kullanıcı Ünvanı/Mesleği">
      </div>
    </div>
    <input type="hidden" name="kul_id" value="<?php echo $kullanicicek['kul_id'] ?>">
    <center>
      <div class="form-row col-md-6 justify-content-center mb-3">
        <label>Profil Resmi</label>
        <div class="file-loading">
          <input class="form-control" id="profilresmi" name="kul_logo" type="file">
        </div>
      </div>
    </center>
    <div class="row ml-1">
     <button type="submit" name="profilguncelle" class="btn btn-primary">Kaydet</button> 
   </form>
   <form class="ml-2" action="sifreguncelle.php" method="POST" accept-charset="utf-8">
    <input type="hidden" name="kul_id" value="<?php echo $kullanicicek['kul_id'] ?>">
    <button type="submit" name="xxx" class="btn btn-danger">Şifre Sıfırla</button>
  </form> 
</div>
</div>
<hr>
<?php include 'footer.php' ?>
<script type="text/javascript">
  $("#aktarmagizleme").click(function(){
    $(".dt-buttons").toggle();
  });
</script>
<script type="text/javascript">
  $(".mobilgoster").click(function(){
    $(".gizlemeyiac").toggle();
  });
</script>

<script>
  $(document).ready(function () {
    $("#profilresmi").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showRemove': true,
      'showCaption': true,
      'showPreview':false,
     // 'showPreview':false,
     allowedFileExtensions: ["jpg", "png", "jpeg"],
   });
  });
</script>

<?php if (@$_GET['durum']=="no")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Lütfen Tekrar Deneyin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="eskisifrehata")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Eski Şifreniz Hatalı Lütfen Eski Şifrenizi Doğru Girin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="sifreleruyusmuyor")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Girdiğiniz Şifreler Aynı Değil Lütfen Girdiğiniz Şifreleri Kontrol Edin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="ok")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşlem Başarılı',
      text: 'İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="sifredegisti")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşlem Başarılı',
      text: 'İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
  <?php } ?>