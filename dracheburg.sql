-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 10. Mrz 2014 um 09:27
-- Server Version: 5.6.14
-- PHP-Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `dracheburg`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `id`            INT(6)    NOT NULL AUTO_INCREMENT,
  `datepublished` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username`      CHAR(20) DEFAULT NULL,
  `title`         CHAR(42) DEFAULT NULL,
  `content`       TEXT,
  PRIMARY KEY (`id`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8
  AUTO_INCREMENT =41;

--
-- Daten für Tabelle `guestbook`
--

INSERT INTO `guestbook` (`id`, `datepublished`, `username`, `title`, `content`) VALUES
  (1, '2014-03-09 22:50:28', 'admin', 'Das ist der 1. Beitrag',
   'Mein 1. Beitrag nachdem ich angefangen habe, es in MVC zu schreiben'),
  (2, '2014-03-09 22:54:46', 'admin', 'Das ist der 2. Beitrag', 'Weil ich nichts besseres zu tun habe? :)'),
  (3, '2014-03-09 23:07:40', 'admin', 'Lückenfüller', ':)'),
  (4, '2014-03-09 23:08:08', 'admin', 'Lückenfüller', 'Ig wünsche schöns Wätter!'),
  (5, '2014-03-09 23:08:34', 'admin', 'Testbeitrag', 'Thia, so schnäu geits plötzlech'),
  (6, '2014-03-09 23:08:55', 'admin', 'Neues Guestbook', 'Wow, so much Guestbook'),
  (7, '2014-03-09 23:10:56', 'beni', 'Neues usem letschte Sport', 'Es wird getschuutet!'),
  (8, '2014-03-09 23:11:48', 'beni', 'Goooooaaal', 'Endlich die Thuner gewinnen'),
  (9, '2014-03-09 23:13:39', 'beni', 'Thun besiegt Aarau', 'Mit unglaublichen 4:1 besiegt Thun im Auswärtsspiel Aarau'),
  (10, '2014-03-09 23:15:52', 'robinio', 'Guestboooooook', 'Hei voll khules Guestbook'),
  (11, '2014-03-09 23:26:55', 'robinio', 'test', 'testitest'),
  (14, '2014-03-09 23:31:25', 'robinio', 'slkjflsjfl', 'lkjslkjdlksdjflkj'),
  (15, '2014-03-09 23:31:36', 'robinio', 'lkjsdflkjsadsasddf', 'lkjslfdjlkjsdn23445'),
  (19, '2014-03-09 23:33:40', 'admin', 'weni nume wüst wo ds vogelisi wär', 'blub'),
  (20, '2014-03-09 23:34:04', 'admin', 'huba hop', ':) ig freue mi!'),
  (21, '2014-03-09 23:34:33', 'admin', 'Weisch was? ....', '...ä Fuchs isch khe has'),
  (22, '2014-03-09 23:53:12', 'admin', 'Weisch no meh? ....', '...ä Fuchs isch khes Reh'),
  (23, '2014-03-09 23:56:42', 'admin', 'Dis Mami', 'Chocht viu besser aus aui andere Mamis'),
  (24, '2014-03-09 23:57:08', 'admin', 'Schuldiger hat gestanden', 'Er darf nun sitzen.'),
  (25, '2014-03-09 23:58:04', 'admin', 'Zugestellt', 'Postauto verstellt Einfahrt'),
  (26, '2014-03-09 23:58:33', 'admin', 'Unachtsam', 'Kapitän in Gedanken versunken'),
  (27, '2014-03-10 00:00:59', 'postillion', 'Überall sichtbare Entrüstung', 'Umkleidekabinen bei Ritterturnier überfüllt'),
  (28, '2014-03-10 00:01:44', 'postillion', 'Hatte Pickel im Gesicht', 'Junger Bergsteiger in Notaufnahme eingeliefert'),
  (29, '2014-03-10 00:02:05', 'postillion', 'Holzweg', 'Polizei nach Großdiebstahl im Sägewerk auf falscher Spur'),
  (30, '2014-03-10 00:02:27', 'postillion', 'Gut kombiniert', 'Eric Frenzel weiß, dass Platz 1 Gold bedeutet'),
  (31, '2014-03-10 00:02:48', 'postillion', 'Knirps vergessen', 'Mutter lässt Kind im Regen stehen'),
  (32, '2014-03-10 00:04:01', 'postillion', 'Schlechte Zensur', 'Schüler übermalt Zeugnisnote mit Buntstift'),
  (33, '2014-03-10 00:04:17', 'postillion', 'Bier wird Schal', 'Zauberer braucht ewig für Verwandlungstrick'),
  (35, '2014-03-10 00:05:14', 'postillion', 'Hat die Sau rausgelassen', 'Stallknecht nach wilder Party gefeuert'),
  (36, '2014-03-10 00:12:07', 'postillion', 'Fahrer schäumte', 'Cabrioverdeck öffnete sich ungewollt in Waschanlage'),
  (37, '2014-03-10 00:53:22', 'admin', 'Mein neues Guestbook', 'Ich hoffe, dass ich zukünftig noch weitere, solch spannende Arbeiten machen kann.'),
  (38, '2014-03-10 07:03:39', 'john', 'Schüler nimmt den Mund zu voll',
   'Ein Student erstickt nach einem zu grossen Bissen.'),
  (39, '2014-03-10 07:10:14', 'hadi', 'Mänu isch dr Chef',
   'Mänu het itz meeega lang heeeene viu a däm Guestbook garbeitet. drum sött er itz eigentläch fasch es 6! becho. usserdem denki dass er o aui aforderige erfüut het.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id`         INT(6)     NOT NULL AUTO_INCREMENT,
  `username`   CHAR(20) DEFAULT NULL,
  `password`   CHAR(255) DEFAULT NULL,
  `email`      CHAR(100) DEFAULT NULL,
  `firstname`  TEXT,
  `familyname` TEXT,
  `datejoined` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin`      TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =InnoDB
  DEFAULT CHARSET =utf8
  AUTO_INCREMENT =10;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `firstname`, `familyname`, `datejoined`, `admin`) VALUES
  (1, 'admin', '$2y$10$9VnZC7VuTz6Ch4cx899ua.zd/EX4mkqIbm3wCrF5fPawCuCOl.Eui', 'news.manuelsworld@gmail.com', 'Manuel',
   'Meister', '2014-03-09 22:43:27', 1),
  (2, 'm.ratgeb', '$2y$10$/SDxZE4.U.d4Lki..3GPMOGShca/9CR34jXYiEQqY7QkLJE/BF1Ju', 'm.rathgeb@thunschadau.ch', 'Martin',
   'Ratgeb', '2014-03-09 22:58:57', 0),
  (3, 'beni', '$2y$10$r9sX2Q7rUlVkuCtHLyi..uHqEBFfYN86jSP/DPlYnfxeLo7Uol2Si', 'beni@srf.ch', 'Beni', 'Thurnheer',
   '2014-03-09 23:10:08', 0),
  (4, 'robinio', '$2y$10$JVoIIaNV0KpnCAR1jJS3keiiLlpCqgVGIuxJEBt9dPWRlFfQzQAya', 'robin.glauser@gmail.com', 'Robin',
   'Glauser', '2014-03-09 23:15:09', 0),
  (5, 'postillion', '$2y$10$8uaw0OawdpR4hUBS3ZDJi.18TbeMj9Pu6.mvYRZ3tAn0BfhHGuASG', 'info@der-postillion.com', '', '',
   '2014-03-09 23:59:42', 0),
  (6, 'john', '$2y$10$yjl6FoTrw4BrTLzWC0Fmy.fCnBD3lcIMx6lqOXEXYOYEnxfwxBCXi', 'john.guentensperger@gmail.com', 'John',
   'Guenstensperger', '2014-03-10 07:00:29', 0),
  (7, 'tobias', '$2y$10$elmYVMeec4OsEVvA5ZI4v.Xev6HvKKUYypleqbxsZV/nw6EW5kEDm', 'tobias.man@gmx.ch', 'Tobias', 'Mandel',
   '2014-03-10 07:07:20', 0),
  (8, 'hadi', '$2y$10$H16s29ea2JDc17OWNcjjSOzzDL/TLe859ZvXbzY0O8jW4xCHfRncO', 'seinodernichtsein@hotmail.ch', 'Thomas',
   'Hadorn', '2014-03-10 07:08:38', 0);

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
