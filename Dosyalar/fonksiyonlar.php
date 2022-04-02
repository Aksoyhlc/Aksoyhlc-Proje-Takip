<?php
/*
Aksoyhlc İş-Proje Takip Scripti
Copyright (C) 2019 Ökkeş Aksoy
 */


function aciliyet()
{
	return [
		0 => 'Acil',
		1 => 'Normal',
		2 => 'Acelesi Yok',
	];
}

function durum()
{
	return [
		0 => 'Yeni Başladı',
		1 => 'Devam Ediyor',
		2 => 'Bitti',
	];
}

function turkce_temizle($metin) {
	$turkce=array("ş","Ş","ı","ü","Ü","ö","Ö","ç","Ç","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü");
	$duzgun=array("s","S","i","u","U","o","O","c","C","s","S","i","g","G","I","o","O","C","c","u","U");
	$metin=str_replace($turkce,$duzgun,$metin);
	$metin = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i","-",$metin);
	$yeniisim = mb_strtolower($metin, 'utf8');
	return $yeniisim;
};


function tum_bosluk_sil($veri)
{
	return str_replace(" ", "", $veri); 
};

function yetkikontrol() {
	if (empty($_SESSION['kul_mail'])) {
		$kul_mail="x";
	} else {
		$kul_mail=$_SESSION['kul_mail'];
	}
	
	include 'islemler/baglan.php';
	$yetki=$db->prepare("SELECT kul_yetki FROM kullanicilar where session_mail=:session_mail");
	$yetki->execute(array(
		'session_mail' => $kul_mail
	));
	$yetkicek=$yetki->fetch(PDO::FETCH_ASSOC);

	if ($yetkicek['kul_yetki']==1) {
		$sonuc="yetkili";
		return $sonuc;
	} else {
		$sonuc="yetkisiz";
		return $sonuc;
	}
};

function bos($metin)
{
	return $metin;
}

function oturumkontrol() {
	include 'islemler/baglan.php';
	if (empty($_SESSION['kul_mail']) or empty($_SESSION['kul_id'])) {
		header("location:login.php?durum=girisyapin");
		exit;
	} else {

		$kullanici=$db->prepare("SELECT * FROM kullanicilar where session_mail=:session_mail");
		$kullanici->execute(array(
			'session_mail' => $_SESSION['kul_mail']
		));

		$say=$kullanici->rowcount();
		$kullanicicek=$kullanici->fetch(PDO::FETCH_ASSOC);
		if ($say==0) {
			header("location:login.php?durum=girisyapin");
			exit;
		}
	}	
};


function guvenlik($gelen){
	$giden = addslashes($gelen);
	$giden = htmlspecialchars($giden);
	$giden = htmlentities($giden);
	$giden = strip_tags($giden);
	return $giden;
};

function fnk(){
	echo "<script language=javascript>document.write(unescape('%3C%66%6F%6F%74%65%72%20%63%6C%61%73%73%3D%22%73%74%69%63%6B%79%2D%66%6F%6F%74%65%72%20%62%67%2D%77%68%69%74%65%22%3E%0A%09%3C%64%69%76%20%63%6C%61%73%73%3D%22%63%6F%6E%74%61%69%6E%65%72%20%6D%79%2D%61%75%74%6F%22%3E%0A%09%09%3C%64%69%76%20%63%6C%61%73%73%3D%22%63%6F%70%79%72%69%67%68%74%20%74%65%78%74%2D%63%65%6E%74%65%72%20%6D%79%2D%61%75%74%6F%22%3E%0A%09%09%09%3C%73%70%61%6E%3E%43%6F%70%79%72%69%67%68%74%20%26%63%6F%70%79%3B%20%3C%61%20%68%72%65%66%3D%22%26%23%31%30%34%3B%26%23%31%31%36%3B%26%23%31%31%36%3B%26%23%31%31%32%3B%26%23%31%31%35%3B%26%23%35%38%3B%26%23%34%37%3B%26%23%34%37%3B%26%23%31%31%39%3B%26%23%31%31%39%3B%26%23%31%31%39%3B%26%23%34%36%3B%26%23%39%37%3B%26%23%31%30%37%3B%26%23%31%31%35%3B%26%23%31%31%31%3B%26%23%31%32%31%3B%26%23%31%30%34%3B%26%23%31%30%38%3B%26%23%39%39%3B%26%23%34%36%3B%26%23%31%31%30%3B%26%23%31%30%31%3B%26%23%31%31%36%3B%22%3E%26%23%36%35%3B%26%23%31%30%37%3B%26%23%31%31%35%3B%26%23%31%31%31%3B%26%23%31%32%31%3B%26%23%31%30%34%3B%26%23%31%30%38%3B%26%23%39%39%3B%3C%2F%61%3E%20%26%23%33%30%34%3B%26%23%33%35%31%3B%26%23%34%35%3B%26%23%38%30%3B%26%23%31%31%34%3B%26%23%31%31%31%3B%26%23%31%30%36%3B%26%23%31%30%31%3B%26%23%33%32%3B%26%23%38%34%3B%26%23%39%37%3B%26%23%31%30%37%3B%26%23%31%30%35%3B%26%23%31%31%32%3B%26%23%33%32%3B%26%23%38%33%3B%26%23%39%39%3B%26%23%31%31%34%3B%26%23%31%30%35%3B%26%23%31%31%32%3B%26%23%31%31%36%3B%26%23%31%30%35%3B%3C%2F%73%70%61%6E%3E%0A%09%09%3C%2F%64%69%76%3E%0A%09%3C%2F%64%69%76%3E%0A%3C%2F%66%6F%6F%74%65%72%3E'))</script>
	";
}

function sifreleme($kul_mail) {
	$gizlianahtar = '05a8acd63ecadfc55842804bc537f76e';
	return md5(sha1(md5($_SERVER['REMOTE_ADDR'] . $gizlianahtar . $kul_mail . "Aksoyhlc" . date('d.m.Y H:i:s') . $_SERVER['HTTP_USER_AGENT'])));
};

?>
