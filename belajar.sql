# Host: 127.0.0.1  (Version 5.5.5-10.4.28-MariaDB)
# Date: 2023-10-12 19:16:24
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "addclass"
#

DROP TABLE IF EXISTS `addclass`;
CREATE TABLE `addclass` (
  `idaddclass` varchar(10) NOT NULL DEFAULT '',
  `idclass` varchar(10) NOT NULL DEFAULT '',
  `nis` int(11) DEFAULT NULL,
  PRIMARY KEY (`idaddclass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "addclass"
#

INSERT INTO `addclass` VALUES ('A-003','C-002',1234567890);

#
# Structure for table "class"
#

DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `idclass` varchar(5) NOT NULL DEFAULT '',
  `nameclass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idclass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "class"
#

INSERT INTO `class` VALUES ('C-002','Kelas 2 SD');

#
# Structure for table "exp"
#

DROP TABLE IF EXISTS `exp`;
CREATE TABLE `exp` (
  `nis` int(11) NOT NULL AUTO_INCREMENT,
  `exp` int(11) DEFAULT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=1712500486 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "exp"
#

INSERT INTO `exp` VALUES (987654321,100),(1234567890,1680),(1712500485,1000);

#
# Structure for table "level"
#

DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `idlevel` varchar(5) NOT NULL DEFAULT '',
  `namelevel` varchar(255) DEFAULT NULL,
  `idclass` varchar(5) DEFAULT NULL,
  `unlockexp` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlevel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "level"
#

INSERT INTO `level` VALUES ('L-001','An-Nas','C-002',0),('L-002','Al-Fatihah','C-002',250);

#
# Structure for table "option"
#

DROP TABLE IF EXISTS `option`;
CREATE TABLE `option` (
  `idoption` varchar(11) NOT NULL DEFAULT '',
  `idquestion` varchar(5) DEFAULT NULL,
  `option` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idoption`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "option"
#

INSERT INTO `option` VALUES ('O0001','Q-001','بِّ النَّاسِ'),('O0002','Q-001','قُلْ اَ'),('O0003','Q-001','عُوْذُ بِرَ'),('O0004','Q-002','النَّا'),('O0005','Q-002','مَلِكِ'),('O0006','Q-002','سِۙ'),('O0007','Q-003','اِلٰهِ'),('O0008','Q-003','سِۙ'),('O0009','Q-003','النَّا'),('O0010','Q-004','  ۙ الۡخَـنَّاسِ'),('O0011','Q-004',' الۡوَسۡوَاسِ'),('O0012','Q-004','مِنۡ شَرِّ'),('O0013','Q-005','وۡرِ النَّاسِۙ'),('O0014','Q-005','الَّذِىۡ يُوَسۡوِ'),('O0015','Q-005','سُ فِىۡ صُدُ'),('O0016','Q-006','وَالنَّاسِ'),('O0017','Q-006','الۡجِنَّةِ'),('O0018','Q-006','مِنَ ا'),('O0019','Q-007','حْمٰنِ '),('O0020','Q-007','الرَّحِيْمِ'),('O0021','Q-007',' اللّٰهِ الرَّ'),('O0022','Q-007','بِسْمِ'),('O0023','Q-008',' لِلّٰهِ رَ'),('O0024','Q-008','الْعٰلَمِيْنَ'),('O0025','Q-008',' رَبِّ '),('O0026','Q-008','اَلْحَمْدُ'),('O0027','Q-009','الرَّ'),('O0028','Q-009','حْمٰنِ'),('O0029','Q-009','الرَّ'),('O0030','Q-009','حِيْمِ'),('O0031','Q-010','مٰلِكِ'),('O0032','Q-010','الدِّ'),('O0033','Q-010','يَوْمِ'),('O0034','Q-010','يْنِ'),('O0035','Q-011','نَسْتَعِيْ'),('O0036','Q-011','نَعْبُدُ وَاِ'),('O0037','Q-011','يَّاكَ '),('O0038','Q-011','اِيَّاكَ '),('O0039','Q-012','لْمُسْتَـقِيْمَ'),('O0040','Q-012','اطَ ا'),('O0041','Q-012','الصِّرَ'),('O0042','Q-012','اِھْدِنَا'),('O0043','Q-013','صِرَاطَ الَّذِيۡنَ '),('O0044','Q-013','اَنۡعَمۡتَ عَلَيۡهِمۡ'),('O0045','Q-013',' غَيۡرِ الۡمَغۡضُوۡبِ '),('O0046','Q-013','عَلَيۡهِمۡ وَلَا الضَّآلِّيۡ');

#
# Structure for table "question"
#

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `idquestion` varchar(5) NOT NULL DEFAULT '',
  `answer` varchar(255) DEFAULT NULL,
  `idlevel` varchar(5) DEFAULT NULL,
  `multioption` varchar(5) DEFAULT NULL,
  `option` varchar(2) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `score` int(255) DEFAULT NULL,
  PRIMARY KEY (`idquestion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "question"
#

INSERT INTO `question` VALUES ('Q-001','قُلْ اَعُوْذُ بِرَبِّ النَّاسِ','L-001','true','3','Susunlah Surat An-Nas Ayat 1',10),('Q-002','مَلِكِالنَّاسِۙ','L-001','true','3','Susunlah Surat An-Nas Ayat 2',10),('Q-003','اِلٰهِالنَّاسِۙ','L-001','true','3','Susunlah Surat An-Nas Ayat 3',10),('Q-004','مِنۡ شَرِّ الۡوَسۡوَاسِ  ۙ الۡخَـنَّاسِ','L-001','true','3','Susunlah Surat An-Nas Ayat 4',10),('Q-005','الَّذِىۡ يُوَسۡوِسُ فِىۡ صُدُوۡرِ النَّاسِۙ','L-001','true','3','Susunlah Surat An-Nas Ayat 5',10),('Q-006','مِنَ االۡجِنَّةِوَالنَّاسِ','L-001','true','3','Susunlah Surat An-Nas Ayat 6',10),('Q-007',' اللّٰهِ الرَّبِسْمِالرَّحِيْمِحْمٰنِ ','L-002','true','4','Susunlah Surat Al-Fatihah Ayat 1',50),('Q-008','الْعٰلَمِيْنَاَلْحَمْدُ رَبِّ  لِلّٰهِ رَ','L-002','true','4','Susunlah Surat Al-Fatihah Ayat 2',50),('Q-009','الرَّحْمٰنِالرَّحِيْمِ','L-002','true','4','Susunlah Surat Al-Fatihah Ayat 3',50),('Q-010','مٰلِكِيَوْمِالدِّيْنِ','L-002','true','4','Susunlah Surat Al-Fatihah Ayat 4',50),('Q-011','اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْ','L-002','true','4','Susunlah Surat Al-Fatihah Ayat 5',50),('Q-012','اِھْدِنَاالصِّرَاطَ الْمُسْتَـقِيْمَ','L-002','true','4','Susunlah Surat Al-Fatihah Ayat 6',50),('Q-013','صِرَاطَ الَّذِيۡنَ اَنۡعَمۡتَ عَلَيۡهِمۡ غَيۡرِ الۡمَغۡضُوۡبِ عَلَيۡهِمۡ وَلَا الضَّآلِّيۡ','L-002','true','4','Susunlah Surat Al-Fatihah Ayat 7',50);

#
# Structure for table "reward"
#

DROP TABLE IF EXISTS `reward`;
CREATE TABLE `reward` (
  `idreward` int(11) NOT NULL AUTO_INCREMENT,
  `juara1` varchar(255) DEFAULT NULL,
  `juara2` varchar(255) DEFAULT NULL,
  `juara3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idreward`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "reward"
#

INSERT INTO `reward` VALUES (1,'HADIAH 1','HADIAH 2','HADIAH 3');

#
# Structure for table "temp_option"
#

DROP TABLE IF EXISTS `temp_option`;
CREATE TABLE `temp_option` (
  `idtempoption` varchar(255) NOT NULL DEFAULT '',
  `idoption` varchar(5) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL,
  `periksa` int(1) DEFAULT NULL,
  `idquestion` varchar(5) DEFAULT NULL,
  `option` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtempoption`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "temp_option"
#


#
# Structure for table "temp_quiz"
#

DROP TABLE IF EXISTS `temp_quiz`;
CREATE TABLE `temp_quiz` (
  `idtemp` varchar(255) NOT NULL DEFAULT '0',
  `idquestion` varchar(5) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `answer_temp` varchar(255) DEFAULT NULL,
  `periksa` int(1) DEFAULT NULL,
  `multioption` varchar(5) DEFAULT NULL,
  `score` int(2) DEFAULT NULL,
  PRIMARY KEY (`idtemp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "temp_quiz"
#

INSERT INTO `temp_quiz` VALUES ('1234567890-1','Q-007',1234567890,' اللّٰهِ الرَّبِسْمِالرَّحِيْمِحْمٰنِ ','حْمٰنِ الرَّحِيْمِ اللّٰهِ الرَّبِسْمِ',0,'true',50),('1234567890-2','Q-008',1234567890,'الْعٰلَمِيْنَاَلْحَمْدُ رَبِّ  لِلّٰهِ رَ',' لِلّٰهِ رَالْعٰلَمِيْنَ رَبِّ اَلْحَمْدُ',0,'true',50),('1234567890-3','Q-009',1234567890,'الرَّحْمٰنِالرَّحِيْمِ','الرَّحْمٰنِالرَّحِيْمِ',1,'true',50),('1234567890-4','Q-010',1234567890,'مٰلِكِيَوْمِالدِّيْنِ','مٰلِكِالدِّيَوْمِيْنِ',0,'true',50),('1234567890-5','Q-011',1234567890,'اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْ','نَسْتَعِيْنَعْبُدُ وَاِيَّاكَ اِيَّاكَ ',0,'true',50),('1234567890-6','Q-012',1234567890,'اِھْدِنَاالصِّرَاطَ الْمُسْتَـقِيْمَ','لْمُسْتَـقِيْمَاطَ االصِّرَاِھْدِنَا',0,'true',50),('1234567890-7','Q-013',1234567890,'صِرَاطَ الَّذِيۡنَ اَنۡعَمۡتَ عَلَيۡهِمۡ غَيۡرِ الۡمَغۡضُوۡبِ عَلَيۡهِمۡ وَلَا الضَّآلِّيۡ','صِرَاطَ الَّذِيۡنَ اَنۡعَمۡتَ عَلَيۡهِمۡ غَيۡرِ الۡمَغۡضُوۡبِ عَلَيۡهِمۡ وَلَا الضَّآلِّيۡ',1,'true',50);

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `nis` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(255) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (26338,'Ridho Prayogika',1,'06d1b3c7dac7931785784c0b3b83c8e99d97206f'),(987654321,'Siswa 2',0,'bd5e5eb049f3907175f54f5a571ba6b9fdea36ab'),(1234567890,'Siswa 1',0,'01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),(1712500485,'wendy halim',1,'88d08d6bef86cb947e5e2b94c10c78c2a314a644');
