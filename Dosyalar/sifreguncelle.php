<?php 
include 'header.php';
?>
<div class="container">
 <div class="justify-content-center">
  <form action="islemler/islem.php" method="POST" accept-charset="utf-8">
    <center><div class="form-group col-md-6">
      <label>Eski Şifre</label>
      <input style="text-align: center;" type="password" required class="form-control" name="eskisifre" placeholder="Eski Şifresiniz">
    </div>
    <div class="form-group col-md-6">
      <label>Yeni Şifre</label>
      <input style="text-align: center;" type="password" required class="form-control" name="yenisifre_bir" placeholder="Yeni Şifreniz">
    </div>
    <div class="form-group col-md-6">
      <label>Yeni Şifre Kontrol</label>
      <input style="text-align: center;" type="password" required class="form-control" name="yenisifre_iki" placeholder="Yeni Şifrenizi Tekrar Girin">
    </div>
    <input type="hidden" name="kul_id" value="<?php echo guvenlik($_POST['kul_id']) ?>">
    <button type="submit" name="sifreguncelle" class="btn btn-primary">Kaydet</button></center>
  </form>
</div>
</div>
<?php include 'footer.php'; ?>