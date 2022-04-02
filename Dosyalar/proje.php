<?php 
include 'header.php' ;
if (isset($_POST['proje_bak'])) {
	if (is_numeric($_POST['proje_id'])) {

		$projesor=$db->prepare("SELECT * FROM proje where proje_id=:id");
		$projesor->execute(array(
			'id' => guvenlik($_POST['proje_id'])
		));
		$projecek=$projesor->fetch(PDO::FETCH_ASSOC);
	} else {
		header("location:projeler?durum=hata");
	}

} else {
	header("location:projeler.php");
} 
?>

<?php
$projenindetaymetni=$projecek['proje_detay'];
$dosyayolu=$projecek['dosya_yolu'];
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
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $projecek['proje_baslik'] ?></h5>
				</div>
				<div class="card-body">
					<form action="islemler/islem.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Proje Başlık</label>
								<input disabled type="text" class="form-control" name="proje_baslik" value="<?php echo $projecek['proje_baslik'] ?>">
							</div>
							<div class="form-group col-md-6">
									<label>Başlama Tarihi</label>
									<input disabled="" type="date" class="form-control" name="proje_baslama_tarihi" value="<?php echo $projecek['proje_baslama_tarihi'] ?>">
								</div>
							<div class="form-group col-md-6">
								<label>Bitirme Tarihi</label>
								<input disabled type="date" class="form-control" name="proje_teslim_tarihi" value="<?php echo $projecek['proje_teslim_tarihi'] ?>">
							</div>
						</div>

						<div class="form-row">
							<?php $aciliyet=$projecek['proje_aciliyet']; ?>
							<div disabled class="form-group col-md-6">
								<label>Aciliyet</label>
								<input disabled type="text" class="form-control" value="<?php echo aciliyet()[$aciliyet] ?>">
							</div>
							<?php $durum=$projecek['proje_durum']; ?>
							<div disabled class="form-group col-md-6">
								<label>Proje Durumu</label>
								<input disabled type="text" class="form-control" value="<?php echo durum()[$durum] ?>">
							</div>
						</div>	
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Proje Tamamlanma Yüzdesi</label>
								<input type="number" min="0" max="100" value="<?php echo $projecek['yuzde'] ?>" class="form-control" disabled name="yuzde" placeholder="Proje Tamamlanma Yüzdesi">
							</div>
						</div>							
						<div class="form-row">
							<div class="form-group col-md-12">
								<textarea disabled class="ckeditor" id="editor"><?php echo $projenindetaymetni; ?></textarea>
							</div>
						</div>
						<?php if (strlen($dosyayolu)>10) { ?>
							<div class="form-row mt-2">
								<div class="col-md-6">
									<div class="file-loading">
										<input class="form-control" id="projedosyalari" name="proje_dosya" type="file">
									</div>
								</div>
							</div>	
						<?php } ?>		
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor');
</script>

<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#projedosyalari").fileinput({
				'theme': 'explorer-fas',
				showBrowse: false,
				showUpload: false,
				showCaption: false,
				showClose: false,
				showCaption: false,
				//	'initialPreviewAsData': true,
				
				initialPreview: [
				'<img src="dosyalar/<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
				],
				initialPreviewConfig: [
				{downloadUrl: url1,
					showRemove: false},
					],
				});
		});
	</script>
<?php } ?>
