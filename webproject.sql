-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 13 May 2019, 00:21:29
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `webproject`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `activity`
--

CREATE TABLE `activity` (
  `ID` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Start` date NOT NULL,
  `End` date NOT NULL,
  `Activity_By` varchar(255) NOT NULL,
  `Likes` int(11) NOT NULL,
  `Dislikes` int(11) NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `activity`
--

INSERT INTO `activity` (`ID`, `Type`, `Title`, `Description`, `Start`, `End`, `Activity_By`, `Likes`, `Dislikes`, `Score`) VALUES
(18, 'Spor', 'Kampüs Turlaması', 'Biz deliyiz, o yüzden kampüsü 100 kez turlicaz, hepinizi bekliyoruz.', '2019-05-10', '2019-05-20', '4', 4, 0, 4),
(20, 'Yiyecek', 'Sıcak Köpek Yeme Yarışması', 'Mixte sıcak köpek yeme yarışması var, birinciye dönem sonuna kadar sınırsız sıcak köpek!', '2019-05-20', '2019-05-21', '4', 1, 2, -1),
(21, 'Doğa', 'Tırmanma', 'Mixin arkasındaki tepeye tırmanıyoruz, tırmanana 50 euro!', '2019-05-09', '2019-05-10', '4', 0, 0, 0),
(24, 'Tanışma & Buluşma', 'Ünlülerle Tanışma Partisi', 'Bizzat kendim ünlü olarak katılıcam, tanışmak isteyenleri bekliyorum arkadaşlar!', '2019-06-27', '2019-06-28', '5', 2, 0, 2),
(25, 'Ders', 'Kütüpte ders çalışıyoruz', 'Kütüpte ders çalışıcaz 20 gün boyunca', '2019-04-25', '2019-05-15', '4', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `Activity_Title` varchar(255) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Comment_Text` varchar(255) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `comment`
--

INSERT INTO `comment` (`ID`, `Activity_Title`, `Username`, `Comment_Text`, `User_ID`, `Photo`) VALUES
(1, 'Tırmanma', 'Arınç Alp Eren', 'Alperenin bu yarışmaya katılmasını istiyorum, eminim kazanacaktır.', 4, 'uploads/ben.jpeg'),
(2, 'Tırmanma', 'Alperen Sarınay', 'En tepeye çıkarım ama zemin ıslak zemin, yoksa ohoo...', 17, 'uploads/alperen.jpeg'),
(3, 'Tırmanma', 'Atakan Demircioğlu', 'Mızıkçılık yapmazsak sevinirim yalnız', 16, 'uploads/atakan.jpg'),
(8, 'Sıcak Köpek Yeme Yarışması', 'Arınç Alp Eren', 'Sıcak köpek yemede çok iyiyim he', 4, 'uploads/ben.jpeg'),
(9, 'Sıcak Köpek Yeme Yarışması', 'Emma Stone', 'Yalnız onun doğrusu hotdogdur, söylemek istedim...', 5, 'uploads/Emma_Stone_2014.jpg'),
(10, 'Sıcak Köpek Yeme Yarışması', 'Merthan Karadeniz', 'Emma Hanım, Türkçe öğrendiğiniz için sizi tebrik ediyorum, keşke tüm ünlüler sizin gibi olsa...', 18, 'uploads/merthan.jpg'),
(11, 'Sıcak Köpek Yeme Yarışması', 'Merthan Karadeniz', 'Ayrııca profil fotoğrafınızı çok beğendim, Çarşamba günü size yemekhanede bir tabildot ısmarlamak isterim :)', 18, 'uploads/merthan.jpg'),
(12, 'Ünlülerle Tanışma Partisi', 'Natalie Dormer', 'Bende bu etkinliğe katılıcam çocuklarrr, isteyene imza atabilirim ;)', 6, 'uploads/natalie_dormer.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dislikes`
--

CREATE TABLE `dislikes` (
  `ID` int(11) NOT NULL,
  `Activity_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `dislikes`
--

INSERT INTO `dislikes` (`ID`, `Activity_ID`, `User_ID`) VALUES
(8, 3, 4),
(11, 12, 4),
(12, 9, 4),
(15, 12, 5),
(16, 20, 4),
(17, 20, 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `Activity_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `likes`
--

INSERT INTO `likes` (`ID`, `Activity_ID`, `User_ID`) VALUES
(27, 3, 4),
(28, 6, 4),
(31, 11, 4),
(32, 8, 4),
(34, 9, 5),
(35, 10, 5),
(37, 18, 16),
(38, 18, 4),
(39, 18, 5),
(40, 20, 4),
(41, 24, 4),
(42, 18, 17),
(43, 24, 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`ID`, `Firstname`, `Surname`, `Username`, `Email`, `Birthdate`, `Department`, `Password`, `Photo`, `Admin`) VALUES
(4, 'Arınç Alp', 'Eren', 'arinc111', 'alp@alp.com', '1998-02-22', 'CENG', '12345678', 'uploads/ben.jpeg', 1),
(5, 'Emma', 'Stone', 'emmaXOXO', 'emma@emma.com', '1988-11-06', 'Hollywood', '12345678', 'uploads/Emma_Stone_2014.jpg', 1),
(6, 'Natalie', 'Dormer', 'gotnatalie', 'natalie@natalie.com', '1982-02-11', 'HBO', '12345678', 'uploads/natalie_dormer.jpg', 0),
(14, 'Chris', 'Hemsworth', 's0n0f0din', 'chris@chris.com', '1983-08-11', 'Asgard', '12345678', 'uploads/chris_hemsworth.jpg', 0),
(16, 'Atakan', 'Demircioğlu', 'deliAti', 'at@at.com', '1997-02-26', 'CENG', '12345678', 'uploads/atakan.jpg', 0),
(17, 'Alperen', 'Sarınay', 'phaladis', 'alperen@alperen.com', '1996-08-20', 'CENG', '12345678', 'uploads/alperen.jpeg', 0),
(18, 'Merthan', 'Karadeniz', 'Piâr', 'merthan@merthan.com', '1997-05-10', 'CENG', '12345678', 'uploads/merthan.jpg', 0),
(20, 'Kaan', 'Önder', 'Samuraytur', 'kaan@kaan.com', '1997-03-12', 'CENG', '12345678', 'uploads/kaan.jpg', 0),
(21, 'İlker', 'Seyis', 'SeyisReyis61', 'ilker@ilker.com', '1996-02-11', 'CENG', '12345678', 'uploads/ilker.jpg', 0),
(22, 'Muhammed Cavid', 'Aydın', 'TheDoctor', 'cav@cav.com', '1996-02-12', 'CENG', '12345678', 'uploads/cavid.jpg', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `activity`
--
ALTER TABLE `activity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Tablo için AUTO_INCREMENT değeri `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Tablo için AUTO_INCREMENT değeri `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tablo için AUTO_INCREMENT değeri `likes`
--
ALTER TABLE `likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
