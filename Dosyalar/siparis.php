<?php 
include 'header.php' ;

if (isset($_POST['siparis_bak'])) {
	if (is_numeric($_POST['sip_id'])) {
		$siparissor=$db->prepare("SELECT * FROM siparis where sip_id=:id");
		$siparissor->execute(array(
			'id' => guvenlik($_POST['sip_id'])
		));
		$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);
	} else {
		header("location:siparisler?durum=hata");
	}
} else {
	header("location:siparisler.php");
} 
?>
<?php
$siparisdetaymetni=$sipariscek['sip_detay'];
$dosyayolu=$sipariscek['dosya_yolu'];
?>
<style type="text/css" media="screen">
	.file-details-cell {
		display: none
	}
</style>
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
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $sipariscek['sip_baslik'] ?></h5>
				</div>
				<div class="card-body">
					<form action="islemler/islem.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Proje Başlık</label>
								<input disabled type="text" class="form-control" name="sip_baslik" value="<?php echo $sipariscek['sip_baslik'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Bitirme Tarihi</label>
								<input disabled type="date" class="form-control" name="proje_teslim_tarihi" value="<?php echo $sipariscek['proje_teslim_tarihi'] ?>">
							</div>
						</div>

						<div class="form-row">
							<?php $aciliyet=$sipariscek['sip_aciliyet']; ?>
							<div disabled class="form-group col-md-6">
								<label>Aciliyet</label>
								<input disabled type="text" class="form-control" value="<?php echo $aciliyet ?>">
							</div>
							<?php $durum=$sipariscek['sip_durum']; ?>
							<div disabled class="form-group col-md-6">
								<label>Proje Durumu</label>
								<input disabled type="text" class="form-control" value="<?php echo $durum ?>">
							</div>
						</div>

						<div class="form-row justify-content-center">	
							<div class="form-group col-md-12">
								<label>Görevliler</label>
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>İsim</th>
												<th>E-Mail</th>
												<th>Telefon</th>
												<th>Ünvan</th>
											</tr>
										</thead>
										<tbody>											
											<?php 
											$siparissor=$db->prepare("SELECT kul_id FROM sip_kul_bag where sip_id={$_POST['sip_id']}");
											$siparissor->execute();
											$sayi=0;

											while ($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { 
												$kullanicisor=$db->prepare("SELECT * FROM kullanicilar where kul_id={$sipariscek['kul_id']}");
												$kullanicisor->execute();

												$sayi++;?>
												<tr>
													<?php $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);  ?>
													<td><?php echo $sayi; ?></td>
													<td><?php echo $kullanicicek['kul_isim']; ?></td>
													<td><?php echo $kullanicicek['kul_mail']; ?></td>
													<td><?php echo $kullanicicek['kul_telefon']; ?></td>
													<td><?php echo $kullanicicek['kul_unvan']; ?></td>
												</tr>
											<?php }?>

										</tbody>
									</table>
								</div>
							</div>
						</div>						
						<div class="form-row">
							<div class="form-group col-md-12">
								<textarea disabled class="ckeditor" id="editor">
									<?php echo $siparisdetaymetni; ?>
								</textarea>
							</div>
						</div>
						<?php if (strlen($dosyayolu)>10) { ?>
							<div class="form-row mt-2">
								<div class="col-md-6">
									<div class="file-loading">
										<input class="form-control" id="siparisdosyalari" name="sip_dosya" type="file">
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
	CKEDITOR.replace('editor',{
	});
</script>


<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#siparisdosyalari").fileinput({
				'theme': 'explorer-fas',
				showRemove: false,
				showBrowse: false,
				showUpload: false,
				showCaption: false,
				showClose: false,
				showCaption: false,
				
				//	'initialPreviewAsData': true,
				allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
				initialPreview: [
				'<img src="<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Önizleme Yok" title="Önzileme Yok">',
				],
				initialPreviewConfig: [
				{downloadUrl: url1,
					showRemove: false,
					showBrowse: false,
					showUpload: false,
					width: '120px'
				},
				],
			});
		});
	</script>
	<?php } ?>