<?php 
include 'header.php' ;
if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
}
if (isset($_POST['sip_id'])) {
	$kayitsor=$db->prepare("SELECT * FROM siparis where sip_id=:id");
	$kayitsor->execute(array(
		'id' => guvenlik($_POST['sip_id'])
	));
	$kayitcek=$kayitsor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:siparisler");
} 

?>
<!--<script src="ckeditor/ckeditor.js"></script>-->
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">Sipariş Düzenleme İşlemi   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if (guvenlik($_GET['islem'])=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif (guvenlik($_GET['islem'])=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST"  enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>İsim Soyisim</label>
									<input type="text" class="form-control" required name="musteri_isim" value="<?php echo $kayitcek['musteri_isim'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>E-Posta</label>
									<input type="email" class="form-control"  name="musteri_mail" value="<?php echo $kayitcek['musteri_mail'] ?>">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Telefon Numarası</label>
									<input type="number" class="form-control" name="musteri_telefon" value="<?php echo $kayitcek['musteri_telefon'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Sipariş Başlığı</label>
									<input type="text" class="form-control" required name="sip_baslik" value="<?php echo $kayitcek['sip_baslik'] ?>">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Ücret (TL)</label>
									<input type="number" class="form-control" name="sip_ucret" value="<?php echo $kayitcek['sip_ucret'] ?>">
								</div>
								<?php $aciliyet=$kayitcek['sip_aciliyet']; ?>
								<div class="form-group col-md-6">
									<label>Aciliyet</label>
									<select id="inputState" name="sip_aciliyet" class="form-control">
										<option <?php if($aciliyet == 'Acil'){echo("selected");}?> value="Acil">Acil</option>
										<option <?php if($aciliyet == 'Normal'){echo("selected");}?> value="Normal">Normal</option>
										<option <?php if($aciliyet == 'Acelesi Yok'){echo("selected");}?> value="Acelesi Yok">Acelesi Yok</option>
									</select>
								</div>
							</div>
							
							<div class="form-row">	
								<div class="form-group col-md-6">
									<label>Teslim Tarihi</label>
									<input required type="date" class="form-control" name="sip_teslim_tarihi" value="<?php echo $kayitcek['sip_teslim_tarihi'] ?>">
								</div>
								<?php $durum=$kayitcek['sip_durum']; ?>
								<div class="form-group col-md-6">
									<label>Sipariş Durumu</label>
									<select id="inputState" name="sip_durum" class="form-control">
										<option <?php if($durum == 'Yeni Başladı'){echo("selected");}?> value="Yeni Başladı">Yeni Başladı</option>
										<option <?php if($durum == 'Devam Ediyor'){echo("selected");}?> value="Devam Ediyor">Devam Ediyor</option>
										<option <?php if($durum == 'Bitti'){echo("selected");}?> value="Bitti">Bitti</option>
									</select>
								</div>
							</div>			
							<div class="form-row">
								<div class="col-md-6">
									<div class="file-loading">
										<input type="file" class="form-control" id="sipdosya" name="sip_dosya" >
									</div>
									<div class="custom-control custom-checkbox small mt-2">
										<input type="checkbox" class="custom-control-input" value="sil" id="dosya_sil" name="dosya_sil">
										<label class="custom-control-label" for="dosya_sil">Dosyaları Sil</label>
									</div>
								</div>

							</div>			
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<textarea class="ckeditor" name="sip_detay" id="editor"><?php echo $kayitcek['sip_detay']?></textarea>
								</div>
							</div>
							<input type="hidden" class="form-control" name="sip_id" value="<?php echo $kayitcek['sip_id'] ?>">
							<button type="submit" name="siparisguncelle" class="btn btn-success">Kaydet</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php' ?>
	<script src="ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'editor' );
	</script>
	<?php 
	if (strlen($kayitcek['dosya_yolu'])>10) {?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['dosya_yolu'] ?>';
				$("#sipdosya").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
			initialPreview: [
			'<img src="<?php echo $kayitcek['dosya_yolu'] ?>" style="height:90px" class="file-preview-image" alt="Dosya" title="Dosya">'
			],
			initialPreviewConfig: [
			{downloadUrl: url1,
				showRemove: false,
			},
			],
		});

			});
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['dosya_yolu'] ?>';
				$("#sipdosya").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
		});

			});
		</script>
	<?php } ?>
