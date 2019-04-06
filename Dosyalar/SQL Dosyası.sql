-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Nis 2019, 12:22:59
-- Sunucu sürümü: 10.1.30-MariaDB
-- PHP Sürümü: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `projetakip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(300) NOT NULL,
  `site_aciklama` varchar(300) NOT NULL,
  `site_sahibi` varchar(100) NOT NULL,
  `mail_onayi` int(11) NOT NULL,
  `duyuru_onayi` int(11) NOT NULL,
  `site_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_aciklama`, `site_sahibi`, `mail_onayi`, `duyuru_onayi`, `site_logo`) VALUES
(1, 'Aksoyhlc - İş Takip Scripti', 'Aksoyhlc İş Takip Scripti', 'Aksoyhlc', 0, 0, 'img/42082627Bilgisayar-kısmı.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(5) NOT NULL,
  `kul_isim` varchar(200) NOT NULL,
  `kul_mail` varchar(250) NOT NULL,
  `kul_sifre` varchar(250) NOT NULL,
  `kul_telefon` int(11) NOT NULL,
  `kul_unvan` varchar(250) NOT NULL,
  `kul_yetki` int(11) NOT NULL,
  `kul_logo` varchar(250) DEFAULT NULL,
  `ip_adresi` varchar(300) NOT NULL,
  `session_mail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`, `kul_telefon`, `kul_unvan`, `kul_yetki`, `kul_logo`, `ip_adresi`, `session_mail`) VALUES
(1, 'Aksoyhlc | &Ouml;kkeş Aksoy', 'aksoyhlc@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'Yazılımcı | Admin', 1, 'img/6918785772Adsız-tasarım-(1).png', '::1', '9c7c8d9a1315ab2696fe2c4ccb4854d8');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `proje`
--

CREATE TABLE `proje` (
  `proje_id` int(5) NOT NULL,
  `proje_baslik` varchar(250) NOT NULL,
  `proje_detay` text NOT NULL,
  `proje_teslim_tarihi` varchar(100) NOT NULL,
  `proje_baslama_tarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proje_durum` varchar(100) NOT NULL,
  `proje_aciliyet` varchar(100) NOT NULL,
  `dosya_yolu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `proje`
--

INSERT INTO `proje` (`proje_id`, `proje_baslik`, `proje_detay`, `proje_teslim_tarihi`, `proje_baslama_tarihi`, `proje_durum`, `proje_aciliyet`, `dosya_yolu`) VALUES
(1, 'İş Takip Scripti', '', '2019-04-28', '2019-04-06 02:35:46', 'Yeni Başladı', 'Acil', 'dosyalar/İşTakipScripti947'),
(2, 'Proje-1', '<p>Proje-1</p>\r\n', '2019-04-28', '2019-04-06 13:19:39', 'Yeni Başladı', 'Acil', 'dosyalar/Proje-1142'),
(3, 'Proje-2', '<p>Proje-2</p>\r\n', '2019-04-28', '2019-04-06 13:20:01', 'Devam Ediyor', 'Acelesi Yok', 'dosyalar/Proje-2370Adsız-tasarım-(1).png'),
(4, 'Proje-3', '<p>Proje-3</p>\r\n\r\n<p><em><strong>Aksoyhlc.net</strong></em></p>\r\n', '2019-04-18', '2019-04-06 13:20:33', 'Bitti', 'Normal', 'dosyalar/Proje-3834Adsız-tasarım-(1).png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `sip_id` int(5) NOT NULL,
  `musteri_isim` varchar(250) NOT NULL,
  `musteri_mail` varchar(250) NOT NULL,
  `musteri_telefon` int(20) NOT NULL,
  `sip_baslik` varchar(300) NOT NULL,
  `sip_teslim_tarihi` varchar(100) NOT NULL,
  `sip_aciliyet` varchar(100) NOT NULL,
  `sip_durum` varchar(100) NOT NULL,
  `sip_detay` mediumtext NOT NULL,
  `sip_ucret` int(100) NOT NULL,
  `sip_baslama_tarih` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dosya_yolu` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`sip_id`, `musteri_isim`, `musteri_mail`, `musteri_telefon`, `sip_baslik`, `sip_teslim_tarihi`, `sip_aciliyet`, `sip_durum`, `sip_detay`, `sip_ucret`, `sip_baslama_tarih`, `dosya_yolu`) VALUES
(2, '&Ouml;kkeş Aksoy', '27aksoy27@gmail.com', 0, 'Sipariş-1', '2019-04-21', 'Acil', 'Yeni Başladı', '<p>Sipariş-1</p>\r\n', 0, '2019-04-06 13:21:11', 'dosyalar/1405Sipariş-1'),
(3, 'TEST', 'admin@aksoyhlc.net', 111111, 'Sipariş-2', '2019-04-21', 'Acelesi Yok', 'Devam Ediyor', '<p>Sipariş-2</p>\r\n', 11, '2019-04-06 13:22:01', 'dosyalar/5668Sipariş-2'),
(4, 'Ali Veli', 'admin@aksoyhlc.net', 222222, 'Sipariş-3', '2019-04-28', 'Acelesi Yok', 'Bitti', '<p>Sipariş-3</p>\r\n', 0, '2019-04-06 13:22:44', 'dosyalar/5957Sipariş-3');

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
  MODIFY `proje_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `sip_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
