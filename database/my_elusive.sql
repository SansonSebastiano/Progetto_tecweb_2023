-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 11, 2023 at 09:22 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_elusive`
--

-- --------------------------------------------------------

--
-- Table structure for table `animale`
--

CREATE TABLE `animale` (
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descrizione` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('scoperto','ipotizzato','avvistato') COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_scoperta` date DEFAULT NULL,
  `image_path` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animale`
--

INSERT INTO `animale` (`nome`, `descrizione`, `status`, `data_scoperta`, `image_path`, `alt`) VALUES
('Chupacapra', 'Una creatura che si dice esista in America Latina e che avrebbe un aspetto simile a un cane con pelle scura e affilati artigli.', 'scoperto', '2023-04-20', 'https://firebasestorage.googleapis.com/v0/b/elusive-f3c33.appspot.com/o/images%2Fanimals%2Fchupacapra.png?alt=media&token=3846c92f-1ea8-4cf0-ac01-6ad47311da27', 'Chupacapra'),
('Kraken', 'Una gigantesca creatura marina che si dice esista nel mare e che avrebbe tentacoli e una forza inaudita.', 'ipotizzato', '2023-04-01', 'https://firebasestorage.googleapis.com/v0/b/elusive-f3c33.appspot.com/o/images%2Fanimals%2Fkraken.png?alt=media&token=23d0f79f-b37a-4402-8148-ecf8d3821473', 'Kraken'),
('Sasquatch ', 'Il celebre Bigfoot, creatura simile ad una cacca bipede che si dice esista nelle foreste nordamericane.', 'avvistato', '2023-04-15', 'https://firebasestorage.googleapis.com/v0/b/elusive-f3c33.appspot.com/o/images%2Fanimals%2Fbigfoot.png?alt=media&token=6f543a56-cf56-4538-8351-63e38ddbe882', 'Sasquatch '),
('Yeti ', 'Un grande ominide peloso che si dice esista nelle regioni montuose dell Asia.', 'scoperto', '2023-04-08', 'https://firebasestorage.googleapis.com/v0/b/elusive-f3c33.appspot.com/o/images%2Fanimals%2Fyeti.png?alt=media&token=8a1699e2-cea3-4627-addd-a59c98fa5c32', 'Yeti ');

-- --------------------------------------------------------

--
-- Table structure for table `articolo`
--

CREATE TABLE `articolo` (
  `id` int(11) NOT NULL,
  `autore` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `luogo` varchar(255) DEFAULT NULL,
  `descrizione` varchar(255) NOT NULL,
  `contenuto` varchar(2000) NOT NULL,
  `image_path` varchar(1024) DEFAULT NULL,
  `tag` enum('scoperta','new-entry','avvistamento','comunicazione','none') NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `nome_animale` varchar(100) DEFAULT NULL,
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articolo`
--

INSERT INTO `articolo` (`id`, `autore`, `titolo`, `data`, `luogo`, `descrizione`, `contenuto`, `image_path`, `tag`, `featured`, `nome_animale`, `alt`) VALUES
(1, 1, 'Alla scoperta del Kraken', '2023-05-21 12:04:53', 'Islanda', 'Kraken, il mostro marino della mitologia nordica', 'Nella mitologia nordica, il Kraken era un mostro marino dalle dimensioni gigantesche, in grado di attaccare e distruggere le imbarcazioni per le sue masse enormi. Il Kraken è stato descritto come una creatura dalle tentacoli lunghe e forti, con occhi rossi e un ingente bocca munita di denti affilati.\r\n\r\nMolte sono state le teorie formulate per spiegare origine di questo mostro marino, tra cui ipotesi di una creatura preistorica sopravvissuta alla estinzione dei dinosauri o la descrizione di un calamaro gigante.\r\n\r\nNonostante alcune descrizioni del Kraken siano state esagerate e fantastiche, molte testimonianze parlano di avvistamenti di misteriose creature marine, che potrebbero avere ispirato la figura del Kraken nella mitologia nordica.', 'https://firebasestorage.googleapis.com/v0/b/elusive-f3c33.appspot.com/o/images%2Farticles%2Fartkraken.png?alt=media&token=6fe9f427-b6f8-4e4c-bda5-723ff7a8e372', 'scoperta', 1, 'Kraken', 'testo'),
(2, 3, 'Il misterioso Chupacabra', '2023-05-21 12:06:51', 'Ohio', 'Alla scoperta del leggendario animale nordamericano', 'Il chupacabra, leggendario animale che sarebbe responsabile della morte di decine di animali da fattoria, ha attirato attenzione degli scienziati e dei media di tutto il mondo. Ma cosa si sa realmente di questo creatura?\r\n\r\nSecondo le descrizioni degli avvistamenti, il chupacabra avrebbe una pelle simile a quella di un rettile, con spine che si estendono lungo la schiena, occhi rossi e artigli affilati. Molte sono state le teorie formulate per spiegare la presenza di questo strano animale, tra cui ipotesi di una creatura aliena o di un ibrido tra diversi animali.\r\n\r\nTuttavia, per gli scienziati, il chupacabra non ha una base biologica reale e le prove a sostegno della sua esistenza sono poco affidabili. Inoltre, molti degli avvistamenti del chupacabra sono stati attribuiti a attacchi di cani randagi o coyote.\r\n\r\nNonostante ciò, il chupacabra rimane una figura affascinante della cultura popolare latinoamericana e continua ad essere oggetto di attenzione e mistero per molti appassionati di criptozoologia.\r\n', 'https://firebasestorage.googleapis.com/v0/b/elusive-f3c33.appspot.com/o/images%2Farticles%2Fartchupa.jpg?alt=media&token=e83fda13-7187-4c13-a8f6-264b4aa21d22', 'comunicazione', 1, 'Chupacapra', 'testo'),
(3, 3, 'Il Bigfoot delle foreste Nord Americane', '2023-05-30 14:45:25', 'Nevada', 'Sasquatch: alla ricerca della leggendaria creatura del Nord America', 'claDVJCBNLASDkvqopisdvoqbdsuvoqidwovc', 'https://firebasestorage.googleapis.com/v0/b/elusive-f3c33.appspot.com/o/images%2Farticles%2Fartbigfoot.png?alt=media&token=37beaef7-a48b-4c8c-8067-f0b10dc6bf10', 'new-entry', 0, 'Sasquatch ', 'testo');

-- --------------------------------------------------------

--
-- Table structure for table `commento`
--

CREATE TABLE `commento` (
  `id` int(11) NOT NULL,
  `articolo` int(11) NOT NULL,
  `utente` int(11) NOT NULL,
  `contenuto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commento`
--

INSERT INTO `commento` (`id`, `articolo`, `utente`, `contenuto`, `data`) VALUES
(1, 2, 1, 'Commento di prova 1', '2023-05-21 14:10:41'),
(2, 2, 2, 'Commento di prova 2', '2023-05-21 14:07:14'),
(3, 2, 3, 'Commento di prova 3', '2023-05-21 14:07:31'),
(4, 1, 3, 'Commento di prova 4', '2023-05-21 14:05:14'),
(5, 1, 2, 'Commento di prova 5', '2023-05-21 14:05:19'),
(6, 3, 1, 'Commento di prova 6', '2023-05-21 14:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `risposta`
--

CREATE TABLE `risposta` (
  `figlio` bigint(20) NOT NULL,
  `padre` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `risposta`
--

INSERT INTO `risposta` (`figlio`, `padre`) VALUES
(2, 1),
(3, 1),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruolo` enum('user','writer','admin') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`id`, `nome`, `password`, `ruolo`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'user', 'user', 'user'),
(3, 'writer', 'writer', 'writer');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_animale_voto`
-- (See below for the actual view)
--
CREATE TABLE `view_animale_voto` (
`nome` varchar(100)
,`YES` bigint(21)
,`NO` bigint(21)
,`image_path` varchar(1024)
,`alt` varchar(255)
,`status` enum('scoperto','ipotizzato','avvistato')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_articolo_commento`
-- (See below for the actual view)
--
CREATE TABLE `view_articolo_commento` (
`articolo` int(11)
,`commento` int(11)
,`nome` varchar(255)
,`contenuto` varchar(255)
,`data` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_articolo_commento_risposta`
-- (See below for the actual view)
--
CREATE TABLE `view_articolo_commento_risposta` (
`articolo` int(11)
,`commento` int(11)
,`nome` varchar(255)
,`contenuto` varchar(255)
,`data` timestamp
,`figlio` bigint(20)
,`nome_risposta` varchar(255)
,`contenuto_risposta` varchar(255)
,`data_risposta` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_articolo_utente`
-- (See below for the actual view)
--
CREATE TABLE `view_articolo_utente` (
`id` int(11)
,`nome` varchar(255)
,`titolo` varchar(255)
,`data` timestamp
,`luogo` varchar(255)
,`descrizione` varchar(255)
,`contenuto` varchar(2000)
,`image_path` varchar(1024)
,`tag` enum('scoperta','new-entry','avvistamento','comunicazione','none')
,`featured` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vote_no`
-- (See below for the actual view)
--
CREATE TABLE `vote_no` (
`nome` varchar(100)
,`NO` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vote_yes`
-- (See below for the actual view)
--
CREATE TABLE `vote_yes` (
`nome` varchar(100)
,`YES` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `voto`
--

CREATE TABLE `voto` (
  `utente` int(11) NOT NULL,
  `animale` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voto` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voto`
--

INSERT INTO `voto` (`utente`, `animale`, `voto`) VALUES
(3, 'Sasquatch', 'NO'),
(2, 'Sasquatch', 'NO'),
(1, 'Sasquatch', 'NO'),
(3, 'Chupacapra', 'YES'),
(2, 'Chupacapra', 'NO'),
(2, 'Kraken', 'YES'),
(1, 'Kraken', 'NO'),
(1, 'Yeti', 'YES'),
(2, 'Yeti', 'YES'),
(3, 'Yeti', 'YES'),
(3, 'Kraken', 'NO'),
(1, 'Chupacapra', 'YES');

-- --------------------------------------------------------

--
-- Structure for view `view_animale_voto`
--
DROP TABLE IF EXISTS `view_animale_voto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_animale_voto`  AS SELECT `animale`.`nome` AS `nome`, `vote_yes`.`YES` AS `YES`, `vote_no`.`NO` AS `NO`, `animale`.`image_path` AS `image_path`, `animale`.`alt` AS `alt`, `animale`.`status` AS `status` FROM ((`animale` left join `vote_yes` on((`animale`.`nome` = `vote_yes`.`nome`))) left join `vote_no` on((`animale`.`nome` = `vote_no`.`nome`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_articolo_commento`
--
DROP TABLE IF EXISTS `view_articolo_commento`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_articolo_commento`  AS SELECT `articolo`.`id` AS `articolo`, `commento`.`id` AS `commento`, `utente`.`nome` AS `nome`, `commento`.`contenuto` AS `contenuto`, `commento`.`data` AS `data` FROM ((`articolo` join `commento` on((`articolo`.`id` = `commento`.`articolo`))) join `utente` on((`commento`.`utente` = `utente`.`id`))) WHERE (not(`commento`.`id` in (select `risposta`.`figlio` from `risposta`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_articolo_commento_risposta`
--
DROP TABLE IF EXISTS `view_articolo_commento_risposta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_articolo_commento_risposta`  AS SELECT `view_articolo_commento`.`articolo` AS `articolo`, `view_articolo_commento`.`commento` AS `commento`, `view_articolo_commento`.`nome` AS `nome`, `view_articolo_commento`.`contenuto` AS `contenuto`, `view_articolo_commento`.`data` AS `data`, `risposta`.`figlio` AS `figlio`, `utente`.`nome` AS `nome_risposta`, `commento`.`contenuto` AS `contenuto_risposta`, `commento`.`data` AS `data_risposta` FROM (((`view_articolo_commento` join `risposta` on((`view_articolo_commento`.`commento` = `risposta`.`padre`))) join `commento` on((`risposta`.`figlio` = `commento`.`id`))) join `utente` on((`commento`.`utente` = `utente`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_articolo_utente`
--
DROP TABLE IF EXISTS `view_articolo_utente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_articolo_utente`  AS SELECT `articolo`.`id` AS `id`, `utente`.`nome` AS `nome`, `articolo`.`titolo` AS `titolo`, `articolo`.`data` AS `data`, `articolo`.`luogo` AS `luogo`, `articolo`.`descrizione` AS `descrizione`, `articolo`.`contenuto` AS `contenuto`, `articolo`.`image_path` AS `image_path`, `articolo`.`tag` AS `tag`, `articolo`.`featured` AS `featured` FROM (`articolo` join `utente` on((`articolo`.`autore` = `utente`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vote_no`
--
DROP TABLE IF EXISTS `vote_no`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vote_no`  AS SELECT `animale`.`nome` AS `nome`, count(`voto`.`voto`) AS `NO` FROM (`animale` left join `voto` on((`animale`.`nome` = `voto`.`animale`))) WHERE (`voto`.`voto` = 'NO') GROUP BY `animale`.`nome``nome`  ;

-- --------------------------------------------------------

--
-- Structure for view `vote_yes`
--
DROP TABLE IF EXISTS `vote_yes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vote_yes`  AS SELECT `animale`.`nome` AS `nome`, count(`voto`.`voto`) AS `YES` FROM (`animale` left join `voto` on((`animale`.`nome` = `voto`.`animale`))) WHERE (`voto`.`voto` = 'YES') GROUP BY `animale`.`nome``nome`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animale`
--
ALTER TABLE `animale`
  ADD PRIMARY KEY (`nome`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autore` (`autore`);

--
-- Indexes for table `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articolo` (`articolo`),
  ADD KEY `utente` (`utente`);

--
-- Indexes for table `risposta`
--
ALTER TABLE `risposta`
  ADD PRIMARY KEY (`figlio`,`padre`),
  ADD KEY `padre` (`padre`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`utente`,`animale`),
  ADD KEY `animale` (`animale`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articolo`
--
ALTER TABLE `articolo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commento`
--
ALTER TABLE `commento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
