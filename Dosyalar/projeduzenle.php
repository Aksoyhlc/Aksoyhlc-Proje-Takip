<?php 
include 'header.php' ;

if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
}

if (isset($_POST['proje_id'])) {
	$projesor=$db->prepare("SELECT * FROM proje where proje_id=:id");
	$projesor->execute(array(
		'id' => guvenlik($_POST['proje_id'])
	));
	$projecek=$projesor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:projeler");
} 
?>
<?php
$projenindetaymetni=$projecek['proje_detay'];
$dosyayolu=$projecek['dosya_yolu']
?>
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
					<h5 class="m-0 font-weight-bold text-primary">Proje Düzenleme İşlemi   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if ($_GET['islem']=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif ($_GET['islem']=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Proje Başlık</label>
									<input required type="text" class="form-control" name="proje_baslik" value="<?php echo $projecek['proje_baslik'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Başlama Tarihi</label>
									<input required type="date" class="form-control" name="proje_baslama_tarihi" value="<?php echo $projecek['proje_baslama_tarihi'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Bitirme Tarihi</label>
									<input required type="date" class="form-control" name="proje_teslim_tarihi" value="<?php echo $projecek['proje_teslim_tarihi'] ?>">
								</div>
							</div>

							<div class="form-row">
								<?php $aciliyet=$projecek['proje_aciliyet']; ?>
								<div required class="form-group col-md-6">
									<label>Aciliyet</label>
									<select id="inputState" required="" name="proje_aciliyet" class="form-control">
										<?php foreach (aciliyet() as $key => $value): ?>
											<option <?php if($aciliyet == $key){echo("selected");}?> value="<?php echo $key ?>"><?php echo $value ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<?php $durum=$projecek['proje_durum']; ?>
								<div required class="form-group col-md-6">
									<label>Proje Durumu</label>
									<select required="" name="proje_durum" class="form-control">
										<?php foreach (durum() as $key => $value): ?>
											<option <?php if($durum == $key){echo("selected");}?> value="<?php echo $key ?>"><?php echo $value ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Proje Tamamlanma Yüzdesi</label>
									<input type="number" min="0" max="100" value="<?php echo $projecek['yuzde'] ?>" class="form-control" required name="yuzde" placeholder="Proje Tamamlanma Yüzdesi">
								</div>
							</div>
							<div class="form-row justify-content-center">	
								<div class="col-md-6">
									<div class="file-loading">
										<input type="file" class="form-control" id="projedosya" name="proje_dosya" >
									</div>
								</div>
							</div>					
							<div class="form-row">
								<div class="form-group col-md-12">
									<textarea class="ckeditor" name="proje_detay" id="editor"><?php echo $projenindetaymetni; ?></textarea>
								</div>
							</div>
							<input type="hidden" class="form-control" name="proje_id" value="<?php echo $_POST['proje_id'] ?>">
							<button style="width: fit-content;" type="submit" name="projeguncelle" class="btn btn-success">Kaydet</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>

<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#projedosya").fileinput({
				'theme': 'explorer-fas',
				'showUpload': false,
				'showCaption': true,
				'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
			initialPreview: [
			'<img src="dosyalar/<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
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
			$("#projedosya").fileinput({
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
