-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 02 Nis 2022, 04:31:18
-- Sunucu sürümü: 10.2.41-MariaDB-cll-lve
-- PHP Sürümü: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `aksoyhlcxyz_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(300) DEFAULT NULL,
  `site_aciklama` varchar(300) DEFAULT NULL,
  `site_sahibi` varchar(100) DEFAULT NULL,
  `mail_onayi` int(11) DEFAULT NULL,
  `duyuru_onayi` int(11) DEFAULT NULL,
  `site_logo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_aciklama`, `site_sahibi`, `mail_onayi`, `duyuru_onayi`, `site_logo`) VALUES
(1, 'Aksoyhlc - İş Takip Scripti', 'Aksoyhlc İş Takip Scripti', 'Aksoyhlc', 0, 0, '300378AksoyhlcLogo.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(5) NOT NULL,
  `kul_isim` varchar(200) DEFAULT NULL,
  `kul_mail` varchar(250) DEFAULT NULL,
  `kul_sifre` varchar(250) DEFAULT NULL,
  `kul_telefon` varchar(50) DEFAULT NULL,
  `kul_unvan` varchar(250) DEFAULT NULL,
  `kul_yetki` int(11) DEFAULT NULL,
  `kul_logo` varchar(250) DEFAULT NULL,
  `ip_adresi` varchar(300) DEFAULT NULL,
  `session_mail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`, `kul_telefon`, `kul_unvan`, `kul_yetki`, `kul_logo`, `ip_adresi`, `session_mail`) VALUES
(1, 'Aksoyhlc | &Ouml;kkeş Aksoy', 'aksoyhlc@gmail.com', '202cb962ac59075b964b07152d234b70', '0', 'Yazılımcı | Admin', 1, '8499668799AksoyhlcLogo.png', NULL, '71f8bf01378f00d594dd5080ad9b45ec');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `proje`
--

CREATE TABLE `proje` (
  `proje_id` int(5) NOT NULL,
  `proje_baslik` varchar(250) DEFAULT NULL,
  `proje_detay` text DEFAULT NULL,
  `proje_teslim_tarihi` varchar(100) DEFAULT NULL,
  `proje_baslama_tarihi` date DEFAULT NULL,
  `proje_durum` int(1) NOT NULL DEFAULT 0,
  `proje_aciliyet` int(1) NOT NULL DEFAULT 0,
  `dosya_yolu` varchar(500) DEFAULT NULL,
  `yuzde` int(11) NOT NULL DEFAULT 0,
  `eklenme_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `proje`
--

INSERT INTO `proje` (`proje_id`, `proje_baslik`, `proje_detay`, `proje_teslim_tarihi`, `proje_baslama_tarihi`, `proje_durum`, `proje_aciliyet`, `dosya_yolu`, `yuzde`, `eklenme_tarihi`) VALUES
(25, 'Proje-1', 'Fffffggggg', '2022-05-02', '2022-04-02', 0, 2, '122716indir.jpeg', 0, '2022-04-02 00:22:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `sip_id` int(5) NOT NULL,
  `musteri_isim` varchar(250) DEFAULT NULL,
  `musteri_mail` varchar(250) DEFAULT NULL,
  `musteri_telefon` varchar(50) DEFAULT NULL,
  `sip_baslik` varchar(300) DEFAULT NULL,
  `sip_teslim_tarihi` varchar(100) DEFAULT NULL,
  `sip_aciliyet` int(1) NOT NULL DEFAULT 0,
  `sip_durum` int(1) NOT NULL DEFAULT 0,
  `sip_detay` mediumtext DEFAULT NULL,
  `sip_ucret` varchar(100) DEFAULT NULL,
  `sip_baslama_tarih` date DEFAULT NULL,
  `dosya_yolu` varchar(500) DEFAULT NULL,
  `yuzde` int(11) NOT NULL DEFAULT 0,
  `eklenme_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`sip_id`, `musteri_isim`, `musteri_mail`, `musteri_telefon`, `sip_baslik`, `sip_teslim_tarihi`, `sip_aciliyet`, `sip_durum`, `sip_detay`, `sip_ucret`, `sip_baslama_tarih`, `dosya_yolu`, `yuzde`, `eklenme_tarihi`) VALUES
(2, '&Ouml;kkeş Aksoy', '27aksoy27@gmail.com', '0000', 'Sipariş-1', '2019-04-21', 0, 0, '<p>Sipariş-1g</p>\r\n', '150', '2019-04-06', 'dosyalar/72380192161Bilgisayar-kısmı.png', 0, '2022-03-16 18:14:50'),
(3, 'Hasan H&uuml;seyin', 'aksoyhlc@gmail.com', '111111', 'Sipariş-2', '2019-04-21', 0, 0, '<p>Sipariş-2</p>\r\n', '11', '2019-04-06', 'dosyalar/221341123405580192161Bilgisayar-kısmı.png', 0, '2022-03-16 18:14:50'),
(4, 'Ali Veli', 'admin@aksoyhlc.net', '222222', 'Sipariş-3', '2019-04-28', 0, 0, '<p>Sipariş-3</p>\r\n', '0', '2019-04-06', 'dosyalar/35380192161Bilgisayar-kısmı.png', 10, '2022-03-16 18:14:50'),
(9, '&Ouml;kkeş Aksoy', '27aksoy27@gmail.com', '0000', 'Sipariş-4', '2019-04-21', 0, 0, '<p>Sipariş-4g</p>\r\n', '150', '2019-04-06', 'dosyalar/72380192161Bilgisayar-kısmı.png', 0, '2022-03-16 18:14:50'),
(10, 'Hasan H&uuml;seyin', 'aksoyhlc@gmail.com', '111111', 'Sipariş-5', '2019-04-21', 0, 0, '<h1><strong>Neden Kullanırız?</strong></h1>\r\n\r\n<p>Yinelenen bir sayfa i&ccedil;eriğinin okuyucunun dikkatini dağıttığı bilinen bir ger&ccedil;ektir. Lorem Ipsum kullanmanın amacı, s&uuml;rekli &#39;buraya metin gelecek, buraya metin gelecek&#39; yazmaya kıyasla daha dengeli bir harf dağılımı sağlayarak okunurluğu artırmasıdır. Şu anda bir&ccedil;ok masa&uuml;st&uuml; yayıncılık paketi ve web sayfa d&uuml;zenleyicisi, varsayılan mıgır metinler olarak Lorem Ipsum kullanmaktadır. Ayrıca arama motorlarında &#39;lorem ipsum&#39; anahtar s&ouml;zc&uuml;kleri ile arama yapıldığında hen&uuml;z tasarım aşamasında olan &ccedil;ok sayıda site listelenir. Yıllar i&ccedil;inde, bazen kazara, bazen bilin&ccedil;li olarak (&ouml;rneğin mizah katılarak), &ccedil;eşitli s&uuml;r&uuml;mleri geliştirilmiştir.</p>\r\n\r\n<p><img alt=\"\" src=\"https://www.w3schools.com/w3images/lights.jpg\" style=\"height:400px; width:600px\" /></p>\r\n', '11', '2019-04-06', '221341123405580192161Bilgisayar-kısmı.png', 25, '2022-03-16 18:14:50'),
(12, 'ali', '', '', 'abc-1', '2022-02-12', 0, 0, '', '500', '2022-01-30', NULL, 10, '2022-03-30 02:58:54'),
(15, 'ali', '', '', 'abc-3', '2022-02-12', 2, 2, 'Eeeeeee', '500', '2022-01-30', '240indir.jpeg', 10, '2022-03-30 03:01:47');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kul_id`),
  ADD UNIQUE KEY `kul_mail` (`kul_mail`);

--
-- Tablo için indeksler `proje`
--
ALTER TABLE `proje`
  ADD PRIMARY KEY (`proje_id`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`sip_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kul_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `proje`
--
ALTER TABLE `proje`
  MODIFY `proje_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `sip_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
