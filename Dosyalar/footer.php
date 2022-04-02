<?php fnk() ?>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>


<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/sweetalert/sweetalert2.all.min.js"></script>

<script>
	$(document).ready(function() {
		$('#editor').summernote({
			placeholder: "Metin Girin",
			height: 300,               
			focus: false,
			codeviewFilter: false,
			codeviewIframeFilter: true,
			toolbar: [
			['geri', ['undo', 'redo']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['fontsize', ['fontsize']],
			['fontname', ['fontname']],
			['color', ['forecolor', 'backcolor']],
			['para', ['ul', 'ol', 'paragraph']],
			['abc', ['link', 'picture', 'video', 'table']],
			['codeview', ['codeview']]
			],
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


<?php if (@$_GET['durum']=="hata")  {?>  
	<script>
		Swal.fire({
			type: 'error',
			title: 'İşlem Başarısız',
			text: 'Yapmamanız Gereken Şeyler Yapıyorsunuz!',
			showConfirmButton: false,
			timer: 3000
		})
	</script>
<?php } ?>

<?php 
if (isset($_GET['durum'])) {?>
	<?php if ($_GET['durum']=="izinsiz")  {?>	
		<script>
			Swal.fire({
				type: 'error',
				title: 'İzniniz Yok',
				text: 'Girme İzniniz olmayan bir alana girmeye çalıştınız',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } ?>
	<?php } ?>
</body>

</html>