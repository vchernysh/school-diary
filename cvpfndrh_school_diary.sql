/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.23-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cvpfndrh_school_diary
-- ------------------------------------------------------
-- Server version	10.6.23-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `______my_events`
--

DROP TABLE IF EXISTS `______my_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `______my_events` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `time` int(100) NOT NULL,
  `event` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='For me and my wife';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `______my_events`
--

LOCK TABLES `______my_events` WRITE;
/*!40000 ALTER TABLE `______my_events` DISABLE KEYS */;
INSERT INTO `______my_events` VALUES (1,850082400,'09 Грудня 1996 — День народження Вікусі Черниш'),(2,818028000,'04 Грудня 1995 — День народження Віталі Черниш'),(3,1536958800,'15 Вересня 2018 — Річниця сім\'ї Вікусі і Віталі Черниш'),(4,1529528400,'21 Червня 2018 — Річниця подання заяви в ЗАГС Вікусі і Віталі Черниш'),(5,1500843600,'24 Липня 2017 — День знайомства Вікусі і Віталі Черниш - Воєнна кафедра'),(6,1504299600,'02 Вересня 2017 — День, коли Віталя запропонував Вікусі бути його дівчиною - Стугна'),(7,1517090400,'28 Січня 2018 — День, коли Віталя освідчився Вікусі у коханні - Ресторан Файна Фамілія на Контрактовій Площі'),(8,1503781200,'27 Серпня 2017 — День, коли Вікуся і Віталя вперше по справжньому поцілувалися - Море (Чорноморськ)'),(9,1505422800,'15 Вересня 2017 — День, коли Вікуся і Віталя вперше почірікались - Общага'),(10,1536872400,'14 Вересня 2018 — День, коли Вікуся і Віталя розписалися в ЗАГСі'),(11,1535230800,'26 Серпня 2018 — День, коли Вікуся, Віталя, Ліля і Богдан вперше познайомились усі разом і зробили фотографію у парку Олександрія на Китайському мостіку'),(12,1564347600,'29 Липня 2019 — День, коли Вікуся і Віталя купили собі собаку Елічку - Одеса'),(13,1556658000,'01 Травня 2019 — День, коли Вікуся і Віталя купили собі машину Ford Mondeo 2011 року - Івано-Франківськ'),(14,1556917200,'04 Травня 2019 — День, коли Вікуся і Віталя переоформили на себе машинку Ford Mondeo 2011 року - Біла Церква'),(15,-11674800,'19 Серпня 1969 — День народження мами Віталі - Черниш Світлани Петрівни'),(16,-43124400,'20 Серпня 1968 — День народження папи Віталі - Черниша Віталія Івановича'),(17,665701200,'5 Лютого 1991 — День народження брата Віталі - Владислава Віталійовича Черниш'),(18,1559768400,'06 Червня 2019 — День народження нашої собачки Елічки'),(19,1380315600,'28 Вересня 2013 — Річниця весілля у Влада і Каті'),(20,820533600,'02 Січня 1996 — День народження Колясіка Лаврехи'),(21,830552400,'27 Квітня 1996 — День народження Ярика Товпишко'),(22,842216400,'09 Вересня 1996 — День народження Сашки Швеця'),(23,814399200,'23 Жовтня 1995 — День народження Деніса Шавуля'),(24,782863200,'23 Жовтня 1994 — День народження Андрея Тучіна'),(25,1481407200,'11 Грудня 2016 — День народження Анютки Черниш - дочка Влада Черниш'),(26,1536354000,'08 Вересня 2018 — Річниця весілля Лілі і Богдана'),(27,640468800,'19 Квітня 1990 — День народження Каті Черниш - дружина Влада Черниша'),(28,1028667600,'07 Серпня 2002 — День народження Ані Лаврехи - сестри Колясіка Лаврехи'),(29,259189200,'20 Березня 1978 — День народження мами Вікусі - Дударевої Оксани Вікторівни'),(30,181083600,'28 Вересня 1975 — День народження папи Вікусі - Дударева Олексія Олексійовича'),(31,655506000,'10 Жовтня 1990 — День народження Богдана - брата Вікусі'),(32,829256400,'12 Квітня 1996 — День народження Лілі Колодій'),(33,828997200,'09 Квітня 1996 — День народження Богдана Колодій'),(34,642024000,'07 Травня 1990 — День народження Жені - брата Вікусі'),(35,1327528800,'26 Січня 2012 — День народження Алінки - сестрички Вікусі'),(36,855352800,'08 Лютого 1997 — День народження Марінки Тиндик'),(37,753141600,'13 Листопада 1993 — День народження Андрія Березанського - хлопець Марінки'),(38,843598800,'25 Вересня 1996 — День народження Саши Філіпченко - Общага'),(39,-100580400,'25 Жовтня 1966 — День народження Лєни - тьотя Віки - сестра мами Віки'),(40,-578631600,'01 Вересня 1951 — День народження бабушки Наташи - бабушка Віки'),(41,-904186800,'08 Травня 1941 — День народження бабушки Люби - бабушка Віки'),(47,784591200,'12 Листопада 1994 — Річниця сім\'ї батьків Вікусі'),(43,1027458000,'24 Липня 2002 — День народження Олі - сестра Віки'),(44,49237200,'25 Липня 1971 — День народження тьоті Юлі - тьотя Віки - сестра папи Віки'),(45,-9601200,'12 Вересня 1969 — День народження дяді Олега - чоловік тьоті Юлі - тьотя Віки'),(46,-89694000,'28 Лютого 1967 — День народження дяді Юри - чоловік тьоті Лєни - тьотя Віки - сестра мами Віки'),(48,-917838000,'01 Грудня 1940 — День народження бабушки Ліди - бабушка Віталі'),(49,-880336800,'08 Лютого 1942 — День народження бабушки Саши - бабушка Віталі'),(50,-216356400,'23 Лютого 1963 — День народження дяді Саши - брат папи Віталі'),(51,644702400,'07 Червня 1990 — День народження Артьома - двоюрідний брат Віталі'),(52,-878608800,'28 Лютого 1942 — День народження дедушки Петі - дед Віталі - папа мами Віталі'),(53,-1176951600,'15 Вересня 1932 — День народження дедушки Вані - дед Віталі - папа папи Віталі'),(54,888184800,'23 Лютого 1998 — День народження Влада Пінькаса - двоюрідний брат Віталі'),(55,135118800,'14 Квітня 1974 — День народження Славіка Пінькаса - дядя Віталі - рідний брат мами Віталі'),(56,1504904400,'09 Вересня 2017 — Річниця сім\'ї Артема і Роксолани'),(57,1567717200,'06 Вересня 2019 — Річниця сім\'ї Ігоря і Марини - Ігор (Крим) брат Вікусі'),(42,641246400,'28 Квітня 1990 — Річниця сім\'ї батьків Віталі'),(58,777762000,'25 Серпня 1994 — День народження Ігоря - (Крим) брат Вікусі'),(59,669416400,'20 Березня 1991 — День народження Юлі Голоти (Калинівка)'),(60,537742800,'16 Січня 1987 — День народження Юри Голоти (Калинівка)'),(61,1614376800,'27 Лютого 2021 — Христини Юриного Артема з Калинівки'),(62,1597698000,'18 Серпня 2020 — День народження Артема Голоти - племінник з Калинівки'),(63,839710800,'11 Серпня 1996 — День народження Ані Мішиної - подруга Віки з університету'),(64,785023200,'17 Листопада 1994 — День народження Андрія Сторожук (оперативний з Вікусіної роботи (Армія))'),(65,860274000,'6 Квітня 1997 — День народження Кіріла Монакова'),(66,906584400,'24 Вересня 1998 — День народження Юлі Чубара (з Вікиної роботи (Армія))'),(67,923864400,'12 Квітня 1999 — День народження Паши Чубара — чоловік Юлі Чубара (з Вікиної роботи (Армія))'),(68,1668168000,'11 Листопада 2022 — День народження нашого синочка Максімки');
/*!40000 ALTER TABLE `______my_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `______my_future_cron_tabs`
--

DROP TABLE IF EXISTS `______my_future_cron_tabs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `______my_future_cron_tabs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(100) unsigned NOT NULL,
  `type_of_record` set('future','today') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `event_time` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `time` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=805 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table of future events for my wife';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `______my_future_cron_tabs`
--

LOCK TABLES `______my_future_cron_tabs` WRITE;
/*!40000 ALTER TABLE `______my_future_cron_tabs` DISABLE KEYS */;
/*!40000 ALTER TABLE `______my_future_cron_tabs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `__cron_tabs_birthdays`
--

DROP TABLE IF EXISTS `__cron_tabs_birthdays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `__cron_tabs_birthdays` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(250) unsigned NOT NULL,
  `type_of_record` set('future','today') NOT NULL,
  `birthday` int(15) NOT NULL,
  `time` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=548 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table for notification users of future user''s birthday';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `__cron_tabs_birthdays`
--

LOCK TABLES `__cron_tabs_birthdays` WRITE;
/*!40000 ALTER TABLE `__cron_tabs_birthdays` DISABLE KEYS */;
/*!40000 ALTER TABLE `__cron_tabs_birthdays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `__cron_tabs_next_payment`
--

DROP TABLE IF EXISTS `__cron_tabs_next_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `__cron_tabs_next_payment` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(250) NOT NULL,
  `type_of_record` set('future_payment','today') NOT NULL DEFAULT 'future_payment',
  `time` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of next payment cron tabs';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `__cron_tabs_next_payment`
--

LOCK TABLES `__cron_tabs_next_payment` WRITE;
/*!40000 ALTER TABLE `__cron_tabs_next_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `__cron_tabs_next_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `__system_settings`
--

DROP TABLE IF EXISTS `__system_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `__system_settings` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `stop` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of settings of School Diary System';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `__system_settings`
--

LOCK TABLES `__system_settings` WRITE;
/*!40000 ALTER TABLE `__system_settings` DISABLE KEYS */;
INSERT INTO `__system_settings` VALUES (1,0);
/*!40000 ALTER TABLE `__system_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_blocked_ip`
--

DROP TABLE IF EXISTS `_blocked_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `_blocked_ip` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  `time` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of blocked IP';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_blocked_ip`
--

LOCK TABLES `_blocked_ip` WRITE;
/*!40000 ALTER TABLE `_blocked_ip` DISABLE KEYS */;
/*!40000 ALTER TABLE `_blocked_ip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `_params_translations`
--

DROP TABLE IF EXISTS `_params_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `_params_translations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `english_name` varchar(150) NOT NULL,
  `cyrillic_name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_params_translations`
--

LOCK TABLES `_params_translations` WRITE;
/*!40000 ALTER TABLE `_params_translations` DISABLE KEYS */;
INSERT INTO `_params_translations` VALUES (1,'admin','Адміністратор'),(2,'teacher','Учитель'),(3,'student','Учень'),(4,'parent','Батьки'),(5,'director','Директор'),(6,'closed','Закрито'),(7,'pending','В очікуванні'),(8,'mother','Мати'),(9,'father','Батько'),(10,'sister','Сестра'),(11,'brother','Брат'),(12,'grandmother','Бабуся'),(13,'grandfather','Дідуля'),(14,'error','Помилка'),(15,'idea','Ідеї та побажання'),(16,'complaint','Скарга'),(17,'other','Інші запитання'),(18,'support','Технічна підтримка'),(19,'opened','Відкрито'),(20,'user','Користувач'),(21,'Monday','Понеділок'),(22,'Tuesday','Вівторок'),(23,'Wednesday','Середа'),(24,'Thursday','Четвер'),(25,'Friday','П\'ятниця'),(26,'Saturday','Субота'),(27,'Sunday','Неділя'),(28,'no','Ні'),(29,'yes','Так'),(30,'single','За кожного учня окремо'),(31,'all','За всю школу');
/*!40000 ALTER TABLE `_params_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_liqpay`
--

DROP TABLE IF EXISTS `a_liqpay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `a_liqpay` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` bigint(250) NOT NULL COMMENT 'ID платежа в системе LiqPay',
  `order_id` int(250) unsigned NOT NULL COMMENT 'Order_id платежа',
  `currency` varchar(50) NOT NULL COMMENT 'Валюта платежа',
  `status` set('success','error','sandbox','failure','reversed','wait_accept','wait_secure') NOT NULL,
  `amount` int(250) NOT NULL COMMENT 'Сумма платежа',
  `receiver_commission` float NOT NULL COMMENT 'Комиссия с получателя в валюте платежа',
  `amount_with_receiver_commission` float NOT NULL COMMENT 'Сумма платежа учитывая комиссию с получателя',
  `action` set('pay','hold','paysplit','subscribe','paydonate','auth','regular') NOT NULL,
  `paytype` set('card','liqpay','privat24','masterpass','moment_part','cash','invoice','qr') NOT NULL COMMENT 'Способ оплаты. Возможные значения card - оплата картой, liqpay - через кабинет liqpay, privat24 - через кабинет приват24, masterpass - через кабинет masterpass, moment_part - рассрочка, cash - наличными, invoice - счет на e-mail, qr - сканирование qr-кода.',
  `liqpay_order_id` varchar(250) NOT NULL,
  `sender_first_name` varchar(250) DEFAULT NULL,
  `sender_last_name` varchar(250) DEFAULT NULL,
  `sender_phone` varchar(50) DEFAULT NULL,
  `sender_card_mask2` varchar(250) DEFAULT NULL COMMENT 'Карта отправителя',
  `sender_card_bank` varchar(250) DEFAULT NULL COMMENT 'Банк отправителя',
  `sender_card_type` varchar(250) DEFAULT NULL COMMENT 'Тип карты отправителя MasterCard/Visa',
  `sender_card_country` varchar(250) DEFAULT NULL COMMENT 'Страна карты отправителя. Цифровой ISO 3166-1 код',
  `ip` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_date` varchar(200) NOT NULL COMMENT 'Дата создания платежа',
  `end_date` varchar(200) NOT NULL COMMENT 'Дата завершения/изменения платежа',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table of LiqPay Transactions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_liqpay`
--

LOCK TABLES `a_liqpay` WRITE;
/*!40000 ALTER TABLE `a_liqpay` DISABLE KEYS */;
INSERT INTO `a_liqpay` VALUES (1,1073085111,205,'UAH','sandbox',550,15.13,534.87,'pay','card','PEPBRBEN1563374875226113','Vitaliy','Chernysh','380939496142','414949*01','pb','visa','804','83.142.233.94','Черниш Віталій Віталійович - Оплата за учня в електронному журналі School Diary. Термін - до 01 Червня 2020','1563374875232','1563374875242');
/*!40000 ALTER TABLE `a_liqpay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_orders`
--

DROP TABLE IF EXISTS `a_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `a_orders` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `payer_id` int(250) unsigned NOT NULL,
  `student_id` int(250) unsigned NOT NULL,
  `status` set('new','success','error','failure','reversed','sandbox','wait_accept','wait_secure') NOT NULL DEFAULT 'new',
  `currency` varchar(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `date` int(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table of orders';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_orders`
--

LOCK TABLES `a_orders` WRITE;
/*!40000 ALTER TABLE `a_orders` DISABLE KEYS */;
INSERT INTO `a_orders` VALUES (205,57,5,'sandbox','UAH',550,1563374865);
/*!40000 ALTER TABLE `a_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_payments`
--

DROP TABLE IF EXISTS `a_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `a_payments` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(250) NOT NULL,
  `payment_id` bigint(250) NOT NULL,
  `payer_id` int(250) unsigned NOT NULL,
  `student_id` int(250) unsigned NOT NULL,
  `amount` int(200) unsigned NOT NULL,
  `currency` varchar(200) NOT NULL,
  `date_from` varchar(150) NOT NULL,
  `date_to` varchar(150) NOT NULL,
  `unix_date_from` bigint(150) NOT NULL,
  `unix_date_to` bigint(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table of payments';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_payments`
--

LOCK TABLES `a_payments` WRITE;
/*!40000 ALTER TABLE `a_payments` DISABLE KEYS */;
INSERT INTO `a_payments` VALUES (1,205,1073085111,57,5,550,'UAH','17 Липня 2019','01 Червня 2020',1563374875,1590958800),(2,205,1073085111,2,5,550,'UAH','17 Липня 2019','01 Червня 2021',1563374875,1890958800);
/*!40000 ALTER TABLE `a_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `a_payments_for_all_school`
--

DROP TABLE IF EXISTS `a_payments_for_all_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `a_payments_for_all_school` (
  `id` bigint(250) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(250) NOT NULL,
  `amount` int(200) unsigned NOT NULL,
  `currency` varchar(200) NOT NULL,
  `date_from` varchar(150) NOT NULL,
  `date_to` varchar(150) NOT NULL,
  `unix_date_from` bigint(150) NOT NULL,
  `unix_date_to` bigint(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table of payments for all school';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_payments_for_all_school`
--

LOCK TABLES `a_payments_for_all_school` WRITE;
/*!40000 ALTER TABLE `a_payments_for_all_school` DISABLE KEYS */;
INSERT INTO `a_payments_for_all_school` VALUES (38,2,440000,'UAH','17 Липня 2019','01 Червня 2020',1563374947,1890958800);
/*!40000 ALTER TABLE `a_payments_for_all_school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `user_id` int(250) unsigned NOT NULL,
  `school_id` int(250) unsigned NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of admins';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,1);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls_schedule`
--

DROP TABLE IF EXISTS `calls_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `calls_schedule` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(100) unsigned NOT NULL,
  `lesson_number` int(10) unsigned NOT NULL,
  `start` varchar(150) NOT NULL,
  `end` varchar(150) NOT NULL,
  `break` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of Calls Schedule';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls_schedule`
--

LOCK TABLES `calls_schedule` WRITE;
/*!40000 ALTER TABLE `calls_schedule` DISABLE KEYS */;
INSERT INTO `calls_schedule` VALUES (1,2,1,'09:00','09:45','15 хвилин'),(2,2,2,'10:00','10:50','10 хвилин'),(3,3,1,'08:30','09:15','10 хвилин'),(4,2,3,'11:00','11:40','5 хвилин'),(5,2,4,'11:45','12:40','20 хвилин'),(6,2,5,'13:00','13:45','15 хвилин'),(7,2,6,'14:00','15:00','10 хвилин'),(8,2,7,'15:10','16:00','');
/*!40000 ALTER TABLE `calls_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `change_password`
--

DROP TABLE IF EXISTS `change_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `change_password` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `status` set('pending','changed','rejected') NOT NULL DEFAULT 'pending',
  `date_change` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table to change user''s password';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `change_password`
--

LOCK TABLES `change_password` WRITE;
/*!40000 ALTER TABLE `change_password` DISABLE KEYS */;
INSERT INTO `change_password` VALUES (1,'vitalyachernysh@gmail.com','2peaZoTZ6F4xhQUDUve8GhcTJoe1U9LUuDWc9qjCuJwfO4YChC','changed','14 Жовтня 2018 | 00:45:54'),(2,'vitalyachernysh@gmail.com','YLddMQd2Bz1FGgl1KKxJPKwSagX27e4x7EFGvtNjcGBoUlwPrc','changed','14 Жовтня 2018 | 00:49:34'),(3,'vitalyachernysh@gmail.com','IhA5pvc8s1fTFxOeaV6YJfbNCpRZLciZLJhov0N8udW8JKsfPs','changed','14 Жовтня 2018 | 00:50:42'),(4,'vitalyachernysh@gmail.com','1blgrQyAYfGebqDm2vzrA4fHcROd89ZxBzPxBBffWJ1D0guARP','changed','14 Жовтня 2018 | 10:16:47'),(5,'vitalyachernysh@gmail.com','bLLTJP5lCRNbeNn6DBCXvfFweQpUd2O1nOOLVwcLhQjyfNX52w','changed','14 Жовтня 2018 | 10:27:29'),(6,'vitalyachernysh@gmail.com','LbxaQn93GWsGVkGmqVdV1RNYLuEP4Zyx1aRPq9yXkcG4BtuSb9','changed','16 Жовтня 2018 | 17:40:46'),(7,'vitalyachernysh@gmail.com','aF5gNwsgmuor9DHe9DBswgVBVMBaZWD0Q3jvJwFBc47wFocdmu','changed','20 Жовтня 2018 | 15:46:33'),(8,'vitalyachernysh@gmail.com','trj2s3CjVd7jmHBlA2jrpe4hosGAXXilg8XzbGXqBAeQym5fBs','changed','23 Листопада 2018 | 16:26:09'),(9,'vitalyachernysh@gmail.com','ZesslyeKTa6iXsXMK7eZJmPPXPFUNwE2yPbXy8Xox3rlFiFd9S','changed','28 Листопада 2018 | 13:53:26'),(10,'vitalyachernysh@gmail.com','s97NHhCJ2YWQ5ZbaeAS5TRDVCNmxn6ZS4YnteajOlLdNUx8I1I','changed','29 Грудня 2018 | 01:15:02'),(11,'29vitaliy@mail.ru','zFFojgwOpmbZglhIXq26saQYZ6IUEDjPEdhjFChZvybsk14cnL','pending','17 Лютого 2019 | 19:56:21'),(12,'vitalyachernysh@gmail.com','df2AHIs8aiHwRsP4t8NiChgRsEWzPemzb7Ma7uI2uZ6zgDd8on','changed','17 Лютого 2019 | 19:57:50'),(13,'vitalyachernysh@gmail.com','ctQ8wm36f3wTSu5kQnRqrLr2YyEP2zWc08GLH44vyJVnaDQwU5','changed','17 Лютого 2019 | 20:03:00'),(14,'vitalyachernysh@gmail.com','2AIULba0NBmSSuaPn8kpq1wJA0sF9OPCYiixyZc2kxVEwOrZWO','rejected','24 Березня 2019 | 12:28:03'),(15,'vitalyachernysh@gmail.com','dRiZgZ3ppykJzg16bSom186AytelaKMpk3JqrMJN24iczo2sAk','changed','24 Березня 2019 | 12:30:41'),(16,'vitalyachernysh@gmail.com','kV6TS9m94OiK30Y0DfnO5Ke2Gh1iPO8AzErLOrVT1Dh5EM5RC4','rejected','24 Березня 2019 | 14:30:53'),(17,'vitalyachernysh@gmail.com','b88evWsH4Eq2ZXTcqRUEDkezPjXDeumZf8Cjy34lIyjsCGhjoI','changed','24 Березня 2019 | 14:32:24'),(18,'vitalyachernysh@gmail.com','CAOzlpSSyeIRSHfwAUrXDcTVIE0NqxSDyQ0QkS98iVDyhZDDzI','rejected','11 Квітня 2019 | 12:08:25'),(19,'vitalyachernysh@gmail.com','vHMRPdAvOggNYps72YmLtJ6ydbRgQ8WyWzb6dnOOBuOHOFvd1p','changed','11 Квітня 2019 | 12:12:33'),(20,'vitalyachernysh@gmail.com','AT6tbzKpWNUqXbO9wMxjRLp3dwqvVKSjhDVdZfwCS0HzqhqwnD','changed','09 Липня 2019 | 11:18:40'),(21,'vitalyachernysh@gmail.com','VrtETUbF0p0hCQsy9eHrgp9lSJsZnFPVd9FaJurBhnLTuyoycL','changed','03 Березня 2020 | 16:59:56'),(22,'vitalyachernysh@gmail.com','Z9xxrMpLIj8NYxnkM4Ffdwf4ts0kTQcn0jGzAv3pzQ5irAgV09','changed','03 Березня 2020 | 17:03:12'),(23,'vitalyachernysh@gmail.com','MjLTaoFFQaQrFOPJl0L4uO981biw2VgpZ8NnTqFQSQ2nAgx1tX','changed','23 Квітня 2020 | 16:15:51'),(24,'vitalyachernysh@gmail.com','ySmgJw0N4Qu8JbIM2r1ZUKuH9cTg1WTQIolbIVoLVVRbkI5UbJ','changed','08 Вересня 2020 | 16:16:39'),(25,'vitalyachernysh@gmail.com','cq6lktfHCykCfrHbmxNOIaJOcFlb9nJWtIejeYIyhvzdcKw5gB','changed','01 Вересня 2023 | 19:50:59');
/*!40000 ALTER TABLE `change_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `region_id` int(250) unsigned NOT NULL,
  `name` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=524 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of cities';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,9,'Біла Церква'),(2,9,'Васильків'),(3,9,'Київ'),(8,9,'Бабинці'),(9,9,'Баришівка'),(10,9,'Березань'),(11,9,'Богуслав'),(12,9,'Бориспіль'),(13,9,'Борова'),(14,9,'Бородянка'),(15,9,'Боярка'),(16,9,'Бровари'),(17,9,'Буча'),(18,9,'Велика Димерка'),(19,9,'Вишгород'),(20,9,'Вишневе'),(21,9,'Володарка'),(22,9,'Ворзель'),(23,9,'Глеваха'),(24,9,'Гостомель'),(25,9,'Гребінки'),(26,9,'Димер'),(27,9,'Дослідницьке'),(28,9,'Згурівка'),(29,9,'Іванків'),(30,9,'Ірпінь'),(31,9,'Кагарлик'),(32,9,'Калинівка (Броварський район)'),(33,9,'Калинівка (Васильківський район)'),(34,9,'Калита'),(35,9,'Клавдієво-Тарасове'),(36,9,'Кодра'),(37,9,'Кожанка'),(38,9,'Козин'),(39,9,'Коцюбинське'),(40,9,'Красятичі'),(41,9,'Макарів'),(42,9,'Миронівка'),(43,9,'Немішаєве'),(44,9,'Обухів'),(45,9,'Переяслав-Хмельницький'),(46,9,'Пісківка'),(47,9,'Ржищів'),(48,9,'Рокитне'),(49,9,'Сквира'),(50,9,'Славутич'),(51,9,'Ставище'),(52,9,'Тараща'),(53,9,'Терезине'),(54,9,'Тетіїв'),(55,9,'Узин'),(56,9,'Українка'),(57,9,'Фастів'),(58,9,'Чабани'),(59,9,'Яготин'),(60,5,'Андрушівка'),(61,5,'Баранівка'),(62,5,'Бердичів'),(63,5,'Житомир'),(64,5,'Коростень'),(65,5,'Коростишів'),(66,5,'Малин'),(67,5,'Новоград-Волинський'),(68,5,'Овруч'),(69,5,'Олевськ'),(70,5,'Радомишль'),(71,5,'Чуднів'),(72,14,'Ананьїв'),(73,14,'Арциз'),(74,14,'Балта'),(75,14,'Березівка'),(76,14,'Білгород-Дністровський'),(77,14,'Біляївка'),(78,14,'Болград'),(79,14,'Вилкове'),(80,14,'Ізмаїл'),(81,14,'Кілія'),(82,14,'Кодима'),(83,14,'Одеса'),(84,14,'Подільськ'),(85,14,'Рені'),(86,14,'Роздільна'),(87,14,'Татарбунари'),(88,14,'Теплодар'),(89,14,'Чорноморськ'),(90,14,'Южне'),(91,1,'Вінниця'),(92,1,'Жмеринка'),(93,1,'Козятин'),(94,1,'Ладижин'),(95,1,'Могилів-Подільський'),(96,1,'Хмільник'),(97,2,'Берестечко'),(98,2,'Володимир-Волинський'),(99,2,'Горохів'),(100,2,'Камінь-Каширський'),(101,2,'Ківерці'),(102,2,'Ковель'),(103,2,'Луцьк'),(104,2,'Любомль'),(105,2,'Нововолинськ'),(106,2,'Рожище'),(107,2,'Устилуг'),(108,3,'Апостолове'),(109,3,'Верхівцеве'),(110,3,'Верхньодніпровськ'),(111,3,'Вільногірськ'),(112,3,'Дніпро'),(113,3,'Жовті Води'),(114,3,'Зеленодольськ'),(115,3,'Кам\'янське (Дніпродзержинськ)'),(116,3,'Кривий Ріг'),(117,3,'Марганець'),(118,3,'Нікополь'),(119,3,'Новомосковськ'),(120,3,'П\'ятихатки'),(121,3,'Павлоград'),(122,3,'Перещепине'),(123,3,'Першотравенськ'),(124,3,'Підгородне'),(125,3,'Покров'),(126,3,'Синельникове'),(127,3,'Тернівка'),(128,4,'Авдіївка'),(129,4,'Амвросіївка'),(130,4,'Бахмут'),(131,4,'Білицьке'),(132,4,'Білозерське'),(133,4,'Бунге'),(134,4,'Волноваха'),(135,4,'Вуглегірськ'),(136,4,'Вугледар'),(137,4,'Гірник'),(138,4,'Горлівка'),(139,4,'Дебальцеве'),(140,4,'Добропілля'),(141,4,'Докучаєвськ'),(142,4,'Донецьк'),(143,4,'Дружківка'),(144,4,'Єнакієве'),(145,4,'Жданівка'),(146,4,'Залізне'),(147,4,'Зугрес'),(148,4,'Іловайськ'),(149,4,'Кальміуське'),(150,4,'Костянтинівка'),(151,4,'Краматорськ'),(152,4,'Красногорівка'),(153,4,'Курахове'),(154,4,'Лиман'),(155,4,'Макіївка'),(156,4,'Мар\'їнка'),(157,4,'Маріуполь'),(158,4,'Миколаївка'),(159,4,'Мирноград'),(160,4,'Моспине'),(161,4,'Новоазовськ'),(162,4,'Новогродівка'),(163,4,'Покровськ'),(164,4,'Родинське'),(165,4,'Світлодарськ'),(166,4,'Святогірськ'),(167,4,'Селидове'),(168,4,'Сіверськ'),(169,4,'Слов\'янськ'),(170,4,'Сніжне'),(171,4,'Соледар'),(172,4,'Торецьк'),(173,4,'Українськ'),(174,4,'Харцизьк'),(175,4,'Хрестівка'),(176,4,'Часів Яр'),(177,4,'Чистякове'),(178,4,'Шахтарськ'),(179,4,'Ясинувата'),(180,6,'Батьово'),(181,6,'Берегове'),(182,6,'Буштино'),(183,6,'Великий Березний'),(184,6,'Великий Бичків'),(185,6,'Вилок'),(186,6,'Виноградів'),(187,6,'Вишково'),(188,6,'Воловець'),(189,6,'Дубове'),(190,6,'Жденієво'),(191,6,'Іршава'),(192,6,'Кобилецька Поляна'),(193,6,'Кольчино'),(194,6,'Королево'),(195,6,'Міжгір\'я'),(196,6,'Мукачеве'),(197,6,'Перечин'),(198,6,'Рахів'),(199,6,'Свалява'),(200,6,'Середнє'),(201,6,'Солотвино'),(202,6,'Тересва'),(203,6,'Тячів'),(204,6,'Ужгород'),(205,6,'Усть-Чорна'),(206,6,'Хуст'),(207,6,'Чинадійово'),(208,6,'Чоп'),(209,6,'Ясіня'),(210,7,'Бердянськ'),(211,7,'Василівка'),(212,7,'Вільнянськ'),(213,7,'Гуляйполе'),(214,7,'Дніпрорудне'),(215,7,'Енергодар'),(216,7,'Запоріжжя'),(217,7,'Кам\'янка-Дніпровська'),(218,7,'Мелітополь'),(219,7,'Молочанськ'),(220,7,'Оріхів'),(221,7,'Пологи'),(222,7,'Приморськ'),(223,7,'Токмак'),(224,8,'Болехів'),(225,8,'Бурштин'),(226,8,'Галич'),(227,8,'Городенка'),(228,8,'Долина'),(229,8,'Івано-Франківськ'),(230,8,'Калуш'),(231,8,'Коломия'),(232,8,'Косів'),(233,8,'Надвірна'),(234,8,'Рогатин'),(235,8,'Снятин'),(236,8,'Тисмениця'),(237,8,'Тлумач'),(238,8,'Яремче'),(239,10,'Благовіщенське'),(240,10,'Бобринець'),(241,10,'Гайворон'),(242,10,'Долинська'),(243,10,'Знам\'янка'),(244,10,'Кропивницький (Кіровоград)'),(245,10,'Мала Виска'),(246,10,'Новомиргород'),(247,10,'Новоукраїнка'),(248,10,'Олександрія'),(249,10,'Помічна'),(250,10,'Світловодськ'),(251,11,'Алмазна'),(252,11,'Алчевськ'),(253,11,'Антрацит'),(254,11,'Боково-Хрустальне'),(255,11,'Брянка'),(256,11,'Вознесенівка'),(257,11,'Гірське'),(258,11,'Голубівка'),(259,11,'Довжанськ'),(260,11,'Зимогір\'я'),(261,11,'Золоте'),(262,11,'Зоринськ'),(263,11,'Ірміно'),(264,11,'Кадіївка'),(265,11,'Кипуче'),(266,11,'Кремінна'),(267,11,'Лисичанськ'),(268,11,'Луганськ'),(269,11,'Лутугине'),(270,11,'Міусинськ'),(271,11,'Молодогвардійськ'),(272,11,'Новодружеськ'),(273,11,'Олександрівськ'),(274,11,'Первомайськ'),(275,11,'Перевальськ'),(276,11,'Петрово-Красносілля'),(277,11,'Попасна'),(278,11,'Привілля'),(279,11,'Ровеньки'),(280,11,'Рубіжне'),(281,11,'Сватове'),(282,11,'Сєвєродонецьк'),(283,11,'Сорокине'),(284,11,'Старобільськ'),(285,11,'Суходільськ'),(286,11,'Хрустальний'),(287,11,'Щастя'),(288,12,'Белз'),(289,12,'Бібрка'),(290,12,'Борислав'),(291,12,'Броди'),(292,12,'Буськ'),(293,12,'Великі Мости'),(294,12,'Винники'),(295,12,'Глиняни'),(296,12,'Городок'),(297,12,'Добромиль'),(298,12,'Дрогобич'),(299,12,'Дубляни'),(300,12,'Жидачів'),(301,12,'Жовква'),(302,12,'Золочів'),(303,12,'Кам\'янка-Бузька'),(304,12,'Комарно'),(305,12,'Львів'),(306,12,'Миколаїв'),(307,12,'Моршин'),(308,12,'Мостиська'),(309,12,'Новий Калинів'),(310,12,'Новий Розділ'),(311,12,'Новояворівськ'),(312,12,'Перемишляни'),(313,12,'Пустомити'),(314,12,'Рава-Руська'),(315,12,'Радехів'),(316,12,'Рудки'),(317,12,'Самбір'),(318,12,'Сколе'),(319,12,'Сокаль'),(320,12,'Соснівка'),(321,12,'Старий Самбір'),(322,12,'Стебник'),(323,12,'Стрий'),(324,12,'Судова Вишня'),(325,12,'Трускавець'),(326,12,'Турка'),(327,12,'Угнів'),(328,12,'Хирів'),(329,12,'Ходорів'),(330,12,'Червоноград'),(331,12,'Яворів'),(332,13,'Баштанка'),(333,13,'Вознесенськ'),(334,13,'Миколаїв'),(335,13,'Нова Одеса'),(336,13,'Новий Буг'),(337,13,'Очаків'),(338,13,'Первомайськ'),(339,13,'Снігурівка'),(340,13,'Южноукраїнськ'),(341,15,'Гадяч'),(342,15,'Глобине'),(343,15,'Горішні Плавні'),(344,15,'Гребінка'),(345,15,'Заводське'),(346,15,'Зіньків'),(347,15,'Карлівка'),(348,15,'Кобеляки'),(349,15,'Кременчук'),(350,15,'Лохвиця'),(351,15,'Лубни'),(352,15,'Миргород'),(353,15,'Пирятин'),(354,15,'Полтава'),(355,15,'Решетилівка'),(358,16,'Березне'),(357,15,'Хорол'),(359,16,'Вараш'),(360,16,'Дубно'),(361,16,'Дубровиця'),(362,16,'Здолбунів'),(363,16,'Корець'),(364,16,'Костопіль'),(365,16,'Острог'),(366,16,'Радивилів'),(367,16,'Рівне'),(368,16,'Сарни'),(369,17,'Білопілля'),(370,17,'Буринь'),(371,17,'Ворожба'),(372,17,'Глухів'),(373,17,'Дружба'),(374,17,'Конотоп'),(375,17,'Кролевець'),(376,17,'Лебедин'),(377,17,'Охтирка'),(378,17,'Путивль'),(379,17,'Ромни'),(380,17,'Середина-Буда'),(381,17,'Суми'),(382,17,'Тростянець'),(383,17,'Шостка'),(384,18,'Бережани'),(385,18,'Борщів'),(386,18,'Бучач'),(387,18,'Заліщики'),(388,18,'Збараж'),(389,18,'Зборів'),(390,18,'Копичинці'),(391,18,'Кременець'),(392,18,'Ланівці'),(393,18,'Монастириська'),(394,18,'Підгайці'),(395,18,'Почаїв'),(396,18,'Скалат'),(397,18,'Теребовля'),(398,18,'Тернопіль'),(399,18,'Хоростків'),(400,18,'Чортків'),(401,18,'Шумськ'),(402,19,'Балаклія'),(403,19,'Барвінкове'),(404,19,'Богодухів'),(405,19,'Валки'),(406,19,'Вовчанськ'),(407,19,'Дергачі'),(408,19,'Зміїв'),(409,19,'Ізюм'),(410,19,'Красноград'),(411,19,'Куп\'янськ'),(412,19,'Лозова'),(413,19,'Люботин'),(414,19,'Мерефа'),(415,19,'Первомайський'),(416,19,'Південне'),(417,19,'Харків'),(418,19,'Чугуїв'),(419,20,'Берислав'),(421,20,'Генічеськ'),(422,20,'Гола Пристань'),(423,20,'Каховка'),(424,20,'Нова Каховка'),(425,20,'Олешки'),(426,20,'Скадовськ'),(427,20,'Таврійськ'),(428,20,'Херсон'),(429,21,'Волочиськ'),(430,21,'Городок'),(431,21,'Деражня'),(432,21,'Дунаївці'),(433,21,'Ізяслав'),(434,21,'Кам\'янець-Подільський'),(435,21,'Красилів'),(436,21,'Нетішин'),(437,21,'Полонне'),(438,21,'Славута'),(439,21,'Старокостянтинів'),(440,21,'Хмельницький'),(441,21,'Шепетівка'),(442,22,'Ватутіне'),(443,22,'Городище'),(444,22,'Жашків'),(445,22,'Звенигородка'),(446,22,'Золотоноша'),(447,22,'Кам\'янка'),(448,22,'Канів'),(449,22,'Корсунь-Шевченківський'),(450,22,'Монастирище'),(451,22,'Сміла'),(452,22,'Тальне'),(453,22,'Умань'),(454,22,'Христинівка'),(455,22,'Черкаси'),(456,22,'Чигирин'),(457,22,'Шпола'),(458,23,'Вашківці'),(459,23,'Вижниця'),(460,23,'Герца'),(461,23,'Заставна'),(462,23,'Кіцмань'),(463,23,'Новодністровськ'),(464,23,'Новоселиця'),(465,23,'Сокиряни'),(466,23,'Сторожинець'),(467,23,'Хотин'),(468,23,'Чернівці'),(469,24,'Батурин'),(470,24,'Бахмач'),(471,24,'Березна'),(472,24,'Бобровиця'),(473,24,'Борзна'),(474,24,'Варва'),(476,24,'Гончарівське'),(477,24,'Городня'),(478,24,'Десна'),(479,24,'Дігтярі'),(480,24,'Дмитрівка'),(482,24,'Добрянка'),(483,24,'Дружба'),(484,24,'Замглай'),(485,24,'Ічня'),(486,24,'Козелець'),(487,24,'Короп'),(488,24,'Корюківка'),(489,24,'Куликівка'),(490,24,'Ладан'),(491,24,'Линовиця'),(492,24,'Лосинівка'),(493,24,'Любеч'),(494,24,'Макошине'),(495,24,'Мала Дівиця'),(496,24,'Мена'),(497,24,'Михайло-Коцюбинське'),(498,24,'Ніжин'),(499,24,'Новгород-Сіверський'),(500,24,'Носівка'),(501,24,'Олишівка'),(502,24,'Остер'),(503,24,'Парафіївка'),(504,24,'Понорниця'),(505,24,'Прилуки'),(506,24,'Радуль'),(507,24,'Ріпки'),(508,24,'Седнів'),(509,24,'Семенівка'),(510,24,'Сновськ'),(511,24,'Сосниця'),(512,24,'Срібне'),(513,24,'Талалаївка'),(514,24,'Холми'),(515,24,'Чернігів');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_lessons_schedule`
--

DROP TABLE IF EXISTS `class_lessons_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_lessons_schedule` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(200) unsigned NOT NULL,
  `day` set('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `lesson_number` int(100) unsigned NOT NULL,
  `subject_id` int(100) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=293 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of lessons';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_lessons_schedule`
--

LOCK TABLES `class_lessons_schedule` WRITE;
/*!40000 ALTER TABLE `class_lessons_schedule` DISABLE KEYS */;
INSERT INTO `class_lessons_schedule` VALUES (188,17,'Monday',1,4),(190,17,'Monday',3,7),(126,4,'Monday',6,9),(197,17,'Friday',1,5),(199,17,'Monday',1,13),(246,19,'Monday',1,4),(202,19,'Tuesday',3,9),(204,19,'Monday',1,9),(208,19,'Monday',5,1),(209,19,'Monday',6,12),(210,19,'Monday',7,12),(211,19,'Tuesday',1,13),(242,17,'Wednesday',4,9),(213,19,'Tuesday',4,7),(214,19,'Tuesday',5,7),(215,19,'Tuesday',6,8),(216,19,'Tuesday',7,6),(217,19,'Wednesday',1,8),(218,19,'Wednesday',2,4),(221,19,'Wednesday',3,4),(222,19,'Wednesday',4,9),(223,19,'Wednesday',5,12),(227,19,'Thursday',3,1),(228,19,'Thursday',4,1),(230,19,'Thursday',6,4),(232,19,'Friday',1,8),(233,19,'Friday',2,11),(234,19,'Friday',3,12),(243,17,'Wednesday',1,4),(236,19,'Friday',5,6),(237,19,'Friday',6,7),(238,19,'Friday',6,8),(239,19,'Friday',7,13),(244,17,'Wednesday',2,7),(245,17,'Wednesday',3,13),(290,17,'Monday',2,2),(248,17,'Monday',4,5),(249,17,'Monday',5,15),(250,17,'Monday',6,9),(251,17,'Monday',7,12),(292,17,'Tuesday',1,4),(253,17,'Tuesday',4,4),(254,17,'Tuesday',5,13),(255,17,'Tuesday',6,11),(256,17,'Tuesday',7,1),(257,17,'Wednesday',5,5),(258,17,'Wednesday',6,12),(259,17,'Wednesday',7,8),(260,17,'Thursday',1,7),(261,17,'Thursday',2,13),(262,17,'Thursday',3,4),(263,17,'Thursday',4,5),(264,17,'Thursday',5,2),(265,17,'Thursday',6,8),(266,17,'Friday',2,12),(267,17,'Friday',3,7),(268,17,'Friday',4,4),(269,17,'Friday',5,15),(270,17,'Friday',6,13),(271,17,'Friday',7,2),(291,17,'Monday',2,15);
/*!40000 ALTER TABLE `class_lessons_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_subjects`
--

DROP TABLE IF EXISTS `class_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_subjects` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(100) unsigned NOT NULL,
  `subject_id` int(100) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of class subjects';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_subjects`
--

LOCK TABLES `class_subjects` WRITE;
/*!40000 ALTER TABLE `class_subjects` DISABLE KEYS */;
INSERT INTO `class_subjects` VALUES (122,17,5),(113,17,2),(131,4,7),(10,19,1),(11,19,6),(120,17,1),(92,4,8),(97,4,1),(127,17,13),(89,4,2),(96,4,9),(100,4,11),(101,4,12),(118,17,4),(185,4,15),(126,17,11),(128,4,4),(125,17,9),(107,17,12),(130,4,6),(147,17,8),(124,17,7),(133,17,15),(129,4,5),(132,4,13),(149,19,2),(148,19,15),(144,19,4),(146,19,5),(138,19,7),(139,19,8),(140,19,9),(141,19,11),(142,19,12),(143,19,13);
/*!40000 ALTER TABLE `class_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_teachers_access`
--

DROP TABLE IF EXISTS `class_teachers_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_teachers_access` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(100) unsigned NOT NULL,
  `teacher_id` int(100) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of teachers which can set marks for classes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_teachers_access`
--

LOCK TABLES `class_teachers_access` WRITE;
/*!40000 ALTER TABLE `class_teachers_access` DISABLE KEYS */;
INSERT INTO `class_teachers_access` VALUES (42,19,84),(5,4,7),(36,17,7),(38,17,84),(46,4,2),(29,4,84),(43,19,6),(39,17,6),(40,17,23);
/*!40000 ALTER TABLE `class_teachers_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_teachers_subjects_access`
--

DROP TABLE IF EXISTS `class_teachers_subjects_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_teachers_subjects_access` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(100) unsigned NOT NULL,
  `teacher_id` int(100) unsigned NOT NULL,
  `subject_id` int(100) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of teachers class, who can set marks on fixed subjects';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_teachers_subjects_access`
--

LOCK TABLES `class_teachers_subjects_access` WRITE;
/*!40000 ALTER TABLE `class_teachers_subjects_access` DISABLE KEYS */;
INSERT INTO `class_teachers_subjects_access` VALUES (82,4,7,5),(152,4,84,8),(80,4,7,2),(151,4,84,7),(135,17,23,13),(134,17,23,12),(146,17,84,12),(133,17,23,11),(103,17,7,2),(149,19,6,5),(141,19,84,8),(132,17,23,9),(131,17,23,8),(130,17,23,7),(102,17,7,1),(118,17,6,5),(129,17,23,6),(128,17,23,5),(127,17,23,4),(126,17,23,15),(125,17,23,2),(124,17,23,1),(145,17,84,8),(144,17,84,7),(140,19,84,7),(153,4,2,15);
/*!40000 ALTER TABLE `class_teachers_subjects_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(200) unsigned NOT NULL,
  `name` varchar(300) NOT NULL,
  `class_teacher_id` int(100) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_teacher_id` (`class_teacher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of classes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (4,2,'11-Г',6),(31,3,'8-А',3),(17,2,'7-А',2),(19,2,'9-А',23),(32,2,'5-І',4);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `symbol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of currencies';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'UAH','Ukraine','₴'),(2,'USD','United States of America','$'),(3,'EUR','Europe','€'),(4,'RUB','Russia','₽'),(5,'PLN','Poland','zł'),(6,'GBP','Great Britain (England)','£');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `directors`
--

DROP TABLE IF EXISTS `directors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `directors` (
  `user_id` int(250) unsigned NOT NULL,
  `school_id` int(250) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `school_id` (`school_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of directors';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directors`
--

LOCK TABLES `directors` WRITE;
/*!40000 ALTER TABLE `directors` DISABLE KEYS */;
INSERT INTO `directors` VALUES (1,1),(2,2),(3,3),(127,6),(4,11),(141,12);
/*!40000 ALTER TABLE `directors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_about_school`
--

DROP TABLE IF EXISTS `info_about_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_about_school` (
  `school_id` int(10) unsigned NOT NULL,
  `info` longtext DEFAULT NULL,
  UNIQUE KEY `school_id` (`school_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of Information about school';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_about_school`
--

LOCK TABLES `info_about_school` WRITE;
/*!40000 ALTER TABLE `info_about_school` DISABLE KEYS */;
INSERT INTO `info_about_school` VALUES (1,NULL),(2,'<p style=\"text-align:center\"><span style=\"font-size:20px\"><span style=\"color:rgb(0, 128, 0)\">Загальноосвітня </span><span style=\"color:#B22222\">спеціалізована</span><span style=\"color:rgb(0, 128, 0)\"> </span><span style=\"color:#FFA07A\">середня</span><span style=\"color:rgb(0, 128, 0)\"> </span><span style=\"color:#0000CD\">школа</span><span style=\"color:rgb(0, 128, 0)\"> І-ІІІ </span><span style=\"color:#DDA0DD\">ступенів</span><span style=\"color:rgb(0, 128, 0)\"> №123&nbsp;з </span><span style=\"color:#696969\">поглибленим вивченням слов&#39;янських</span><span style=\"color:rgb(0, 128, 0)\"> мов</span></span></p>\r\n\r\n<ul>\r\n	<li>Тут якийсь текст, якийсь опис про школу, скільки учителів, скільки персоналу, скільки учнів і т.д. і&nbsp;<br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<p>У нашій школі функціонує басейн, тенісний корт, спортзал для покращення фізичної форми учнів.</p>\r\n\r\n<p>Збори відбуваються кожного місяця, в п&#39;ятницю, о 18<u><sup>00</sup></u>.</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><strong>Докладніше про школу</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\">Директор школи Янчук Ірина Мечиславівна, спеціаліст вищої категорії, вчитель-методист, відмінник освіти України. Нагороджена грамотами управління освіти Житомирської облдержадміністрації (2005, 2006 р.), грамотою виконкому Житомирської міської ради (2006 р.), Почесною грамотою МОН України (2008 р.), знаком &laquo;Відмінник освіти України&raquo; (2010).</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Кадрове забезпечення: педагогічний колектив школи складають 85 вчителів, з них вищої категорії 48 вчитель, І категорії &ndash; 11 вчителів, ІІ категорії &ndash; 7 вчителів, спеціалістів - 19. Мають звання &ldquo;вчитель-методист&rdquo; 12 учителів, звання &ldquo;старший учитель&rdquo; &ndash; 20. У 2017-2018 навчальному році в школі навчаються 1080 учнів. Учні 10-11 класів навчаються за такими профілями: української філології, математичний. Введені факультативи з української, російської мов, математики, фізики, історії, історії рідного краю, фінансової грамотності, логіки. Функціонують правовий клуб, євроклуб.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">В школі діє освітньо-цільова програма &laquo;Моя держава &ndash; Україна, а рідний край &ndash; маленька батьківщина&raquo;, програми &laquo;Обдаровані діти&raquo;, &laquo;Якісне харчування &ndash; запорука здоров&#39;я дітей&raquo; та &laquo;Повноцінне та економне освітлення в школі&raquo;, впроваджено проекти: &laquo;Здоров&#39;язбережувальні технології в системі роботи школи&raquo;, &laquo;Моя школа: історія і сьогодення&raquo;.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Школа реалізовує потенціал освітнього простору регіону: налагоджена співпраця з <u>ЖДУ ім. І.Франка</u>, <u>ЖВІНАУ ім. С.Корольова</u>, агроекологічною академією, Європейським університетом, ТСОУ, Товариством Червоного Хреста, Житомирським лісгоспом, МЦНТТУ, обласною та дитячою міською бібліотеками, міським архівом, використовує Інтернет-ресурси.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Педпрацівники беруть участь у конкурсі &laquo;Вчитель року&raquo;, у виставці &laquo;Сучасна освіта Житомирщини&raquo;, &laquo;Сучасні навчальні заклади&raquo;, є активними учасниками міжнародних, всеукраїнських, міських конфереренцій, семінарів, вебінарів тощо. Школа має досягнення в здійсненні навчально-виховного процесу, в проведенні методичної роботи. Педагоги в роботі активно використовують інноваційні педагогічні технології, в тому числі інформаційно-комунікаційні. Фаховий рівень та методичний досвід презентують перед вчителями міста та області під час семінарів, беручи участь в роботі журі під час проведення міських та обласних учнівських олімпіад, конкурсів. В педагогічній пресі та в окремих посібниках опубліковано ряд матеріалів учителів. У 2017 р. шкільну бібліотеку було нагороджено Дипломом І ступеня за участь у міському етапі Всеукраїнського конкурсу шкільних бібліотек, а в 2018 р. &ndash; Дипломом ІІ ступеня за участь у ХХІ обласній виставці &laquo;Сучасна освіта Житомирщини &ndash; 2018&raquo;. У цій же виставці високу оцінку отримали матеріали з досвіду роботи адміністрації школи, а також учителів Савицької Т.Б., Куніцької І.А, Григорусь О.А. Школа занесена до щорічних каталогів Міжнародної виставки &laquo;Сучасні навчальні заклади&raquo;. Щороку відзначається високий рівень організації відпочинку дітей в пришкільному таборі, а 2017 р. школу нагороджено Дипломом ІІ ступеня в номінації &laquo;Кращий мовний загін для учнів середніх шкіл&raquo;.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Учні школи залучаються до наукової, дослідницької, експериментальної, інноваційної діяльності, беруть участь у конкурсах-захистах науково-дослідницьких робіт МАН, в конкурсах &laquo;Соняшник&raquo;, &laquo;Кенгуру&raquo;, &laquo;Левеня&raquo;, &laquo;Бобер&raquo;, &laquo;Колосок&raquo;, в конкурсі учнівської молоді на краще програму для ПК тощо. Школярі виявляють високу результативність в інтелектуальних випробуваннях, творчих конкурсах., в екологічному фестивалі &laquo;Голос Землі&raquo;, в заочному конкурсі юних фотоаматорів &laquo;Моя Україна&raquo;. Результати участі учнів у Всеукраїнських учнівських оліспіадах з базових дисциплін: у 2016 р. &ndash; 8 переможців міського етапу та 1 - обласного, у 2017 р. &ndash;13 переможців міського етапу та 2 - обласного,, у 2018 р. - 10 переможців міського етапу та 2 &ndash; обласного. У 2017 р. 2 учениці школи посіли І місця в міському і одна в обласному конкурсі МАН. В міському етапі Міжнародного конкурсу з української мови ім. Петра Яцика перемогу здобули у 2016 р. 1 учениця, у 2017 р. &ndash; 2 учениці , у 2018 р. &ndash; 2 учениці. У міжнародному мовно-літературному конкурсі учнівської та студентської молоді стали переможцями у 2016 р. 1 учениця, у 2017 р. &ndash; 2 учениці , у 2018 р. &ndash; 1 учениця. У 2016, 2017 р.р. учень школи здобув перемогу в міському конкурсі декламаторів. Маємо переможця ІІІ Всеукраїнського конкурсу есе &laquo;Я &ndash; європеєць&raquo; (2016 р.), переможця міського конкурсут ворчих робіт з англійської мови &laquo;Україна в моєму серці&raquo; (2017 р.) . У 2017 р. учениця школи перемогла в обласному конкурсі &laquo;Парки &ndash; легені міст і сіл&raquo;. У 2018 р. 3 учениці школи перемогли в обласному етапі всеукраїнських заочних конкурсів та акцій. За участь у міському конкурсі з технічної творчості &laquo;Юний конструктор&raquo; учениця 4-А класу нагороджена Дипломом І ступеня. Щороку учні школи стають переможцями міського етапу конкурсу на кращого користувача ПК, а в в 2018 р. восьмикласниця зайняла І місце в обласному етапі.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Забезпечили перемоги учнів учителі: Себало О. В., Кузьмін С.В., Пацева Г.П., Казмірчук Т.О., Зведенюк С.Г.,Мошковська Т.А., Джігірей І.В, Горностай-Лейченко Т.І., Нестеренко Н.А., Бондар А.П., Криволап М.П. Срікова О.В., Майківець О.В., Кондратюк Н.М., Доценко О.В, Беспалко І.В., Климчук О.В., Савицька Т.Б.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Щорічно команда учнів школи здобуває перемоги у грі-випробування &laquo;Джура&raquo;, на першості міста з туристичного багатоборства. Досвід проведення в школі військово-спортивної гри &laquo;Патріот&raquo;, Дня ЦЗ презентовано на обласному рівні. Високими є результати ЗНО учнів.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Школа здійснює міжнародні зв&#39;язки: 2008 р. &ndash; участь Янчук І.М. в роботі семінару &laquo;Міжкультурна освіта в школі&raquo; (м. Варшава); укладено договір про співпрацю з 15-им загальноосвітнім ліцеєм м. Лодзь, щороку відбуваються взаємообміни учнівськими делегаціями. У школі проведено Міжнародний семінар педагогів-новаторів за участю Ш. Амонашвілі (2008 р.). Десятикласники беруть участь в програмі обміну учнів &laquo;Flex&raquo;.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">У 2017 р. за результатами участі в ІХ Міжнародній виставці &laquo;Інноватика в сучасній освіті&raquo; школа отримала Диплом за активну інноваційну діяльність у підвищенні якості навчально-виховного процесу та золоту медаль в номінації &laquo;Інклюзивна освіта: рівні права &ndash; рівні можливості&raquo;</span></p>\r\n'),(3,NULL),(6,NULL),(11,NULL),(12,NULL);
/*!40000 ALTER TABLE `info_about_school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `marks` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(250) unsigned NOT NULL,
  `student_id` int(250) unsigned NOT NULL,
  `subject_id` int(250) unsigned NOT NULL,
  `under_title` set('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14') NOT NULL DEFAULT '0' COMMENT '0 - Без теми, 1 - Контрольна робота, 2 - Самостійна робота, 3 - Тематична, 4 - І семестр, 5 - ІІ семестр, 6 - Річна, 7 - Лабораторна, 8 - Семінар, 9 - Зошит, 10 - Усний переказ, 11 - Контрольний переказ, 12 - Контрольний диктант, 13 - Диктант, 14 - Читання вголос',
  `mark` set('1','2','3','4','5','6','7','8','9','10','11','12','н','хв') NOT NULL DEFAULT '',
  `date` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=633 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of marks of students';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marks`
--

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES (346,17,64,15,'7','10',1526504400),(178,17,5,15,'0','10',1518472800),(177,17,59,15,'1','10',1518472800),(161,17,65,15,'0','10',818028000),(160,17,59,15,'0','8',818028000),(552,17,59,15,'3','5',1549749600),(301,17,63,15,'0','3',1520028000),(300,17,61,15,'0','3',1520028000),(299,17,76,15,'0','3',1520028000),(345,17,72,15,'7','4',1526504400),(344,17,80,15,'7','5',1526504400),(298,17,5,15,'0','11',1520028000),(297,17,5,15,'1','12',1520028000),(631,4,86,15,'0','6',1562101200),(175,17,60,15,'1','9',1518472800),(294,17,59,15,'0','11',1520028000),(159,17,64,15,'0','н',818028000),(29,17,5,5,'0','10',1518472800),(162,17,5,15,'0','12',818028000),(158,17,70,15,'0','н',818028000),(157,17,78,15,'0','хв',818028000),(156,17,68,15,'0','н',818028000),(153,17,60,15,'0','9',818028000),(152,17,71,15,'0','8',818028000),(151,17,73,15,'0','7',818028000),(150,17,77,15,'0','5',818028000),(149,17,72,15,'0','5',818028000),(148,17,80,15,'0','8',818028000),(551,17,78,15,'3','9',1549749600),(549,17,60,15,'0','6',1549749600),(548,17,60,15,'0','4',1549749600),(547,17,71,15,'3','3',1549749600),(546,17,73,15,'3','4',1549749600),(545,17,77,15,'0','н',1549749600),(544,17,77,15,'10','2',1549749600),(543,17,72,15,'10','12',1549749600),(291,17,60,15,'0','7',1520028000),(290,17,60,15,'1','8',1520028000),(289,17,71,15,'1','н',1520028000),(288,17,73,15,'1','хв',1520028000),(287,17,77,15,'1','12',1520028000),(286,17,72,15,'0','н',1520028000),(285,17,72,15,'1','11',1520028000),(284,17,80,15,'1','6',1520028000),(347,17,63,15,'2','9',1526504400),(542,17,72,15,'3','12',1549749600),(541,17,80,15,'10','8',1549749600),(556,4,86,12,'4','12',1551391200),(501,17,63,15,'1','9',1550786400),(500,17,61,15,'1','10',1550786400),(499,17,76,15,'1','10',1550786400),(498,17,5,15,'1','11',1550786400),(497,17,75,15,'1','8',1550786400),(630,17,5,15,'3','12',1560200400),(495,17,74,15,'1','11',1550786400),(494,17,62,15,'1','6',1550786400),(493,17,69,15,'1','12',1550786400),(492,17,65,15,'1','8',1550786400),(491,17,59,15,'1','11',1550786400),(490,17,64,15,'1','11',1550786400),(489,17,70,15,'1','10',1550786400),(488,17,78,15,'1','10',1550786400),(487,17,68,15,'1','9',1550786400),(484,17,60,15,'1','7',1550786400),(483,17,71,15,'1','8',1550786400),(482,17,73,15,'1','4',1550786400),(481,17,77,15,'1','11',1550786400),(480,17,72,15,'1','н',1550786400),(479,17,80,15,'1','8',1550786400),(514,17,77,4,'0','7',1551045600),(513,17,72,4,'0','10',1551045600),(512,17,72,4,'0','12',1551045600),(511,17,80,4,'0','5',1551045600),(515,17,69,2,'0','н',1551132000),(517,19,122,1,'0','11',1551218400),(518,19,108,1,'0','8',1551218400),(519,19,112,1,'0','2',1551218400),(520,19,112,1,'0','1',1551218400),(521,17,72,1,'0','н',1551304800),(531,4,90,12,'0','хв',1551391200),(530,4,89,12,'0','6',1551391200),(529,4,86,12,'0','н',1551391200),(533,4,104,2,'0','10',1551132000),(534,4,85,2,'0','н',1551132000),(535,4,90,9,'1','12',1551304800),(537,17,80,2,'0','11',1551304800),(538,17,5,2,'0','11',1551304800),(539,17,76,2,'0','12',1551304800),(553,17,74,15,'3','9',1549749600),(554,17,63,15,'3','12',1549749600),(557,17,80,15,'0','5',1526504400),(558,17,72,15,'2','11',1526504400),(559,17,72,15,'0','н',1550786400),(560,4,100,2,'0','8',1551477600),(561,4,101,2,'0','12',1551477600),(562,4,102,2,'0','10',1551477600),(563,4,103,2,'0','хв',1551477600),(564,4,85,2,'0','н',1551477600),(565,19,105,5,'0','7',1551823200),(566,19,109,5,'0','10',1551823200),(567,19,112,5,'0','12',1551823200),(568,19,120,5,'0','н',1551823200),(569,17,71,15,'8','1',1551823200),(570,17,5,4,'0','11',1551391200),(571,17,5,4,'0','10',1551391200),(574,19,116,1,'2','5',1551736800),(576,19,108,15,'0','10',1552514400),(577,19,109,15,'0','6',1552514400),(578,19,119,15,'0','11',1552514400),(579,19,76,15,'0','9',1552514400),(580,17,59,2,'4','12',1551996000),(581,17,59,2,'0','8',1551996000),(582,17,80,2,'4','4',1551996000),(583,17,72,2,'4','9',1551996000),(584,17,73,2,'4','10',1551996000),(586,19,107,1,'0','8',1553724000),(588,17,5,15,'4','12',1554152400),(589,17,5,15,'5','6',1554152400),(595,17,5,2,'5','11',1554238800),(592,19,117,15,'6','12',1554152400),(593,19,115,15,'1','4',1554152400),(596,17,5,2,'0','12',1554238800),(629,17,74,15,'3','8',1560200400),(617,17,72,15,'1','9',1555621200),(616,17,72,15,'2','11',1555534800),(605,17,72,9,'1','2',1554066000),(602,17,72,4,'4','12',1554238800),(603,17,5,4,'3','12',1554238800),(604,17,5,4,'4','11',1554238800),(606,17,75,9,'1','5',1554066000),(607,17,5,9,'1','12',1554066000),(608,17,61,9,'1','7',1554066000),(609,17,72,8,'1','2',1554152400),(610,17,5,8,'1','12',1554152400),(611,17,72,11,'0','11',1553292000),(612,17,72,11,'8','н',1553292000),(613,17,5,11,'0','9',1553292000),(614,17,5,11,'8','10',1553292000),(615,17,5,11,'0','9',1554411600),(628,17,65,5,'0','3',1557954000),(627,4,86,4,'0','8',1556658000),(626,4,86,4,'0','5',1556658000),(632,4,87,15,'0','12',1704405600);
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parents`
--

DROP TABLE IF EXISTS `parents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `parents` (
  `user_id` int(250) unsigned NOT NULL,
  `student_id` int(250) unsigned NOT NULL,
  `type` set('mother','father','sister','brother','grandmother','grandfather') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of parents';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parents`
--

LOCK TABLES `parents` WRITE;
/*!40000 ALTER TABLE `parents` DISABLE KEYS */;
INSERT INTO `parents` VALUES (57,5,'brother'),(38,5,'father'),(130,129,'mother');
/*!40000 ALTER TABLE `parents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(255) unsigned NOT NULL,
  `type_message` set('error','idea','complaint','other') NOT NULL,
  `message` text NOT NULL,
  `status` set('opened','closed') NOT NULL DEFAULT 'opened',
  `date` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of questions from users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `regions` (
  `id` int(250) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Table of regions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,'Вінницька область'),(2,'Волинська область'),(3,'Дніпропетровська область'),(4,'Донецька область'),(5,'Житомирська область'),(6,'Закарпатська область'),(7,'Запорізька область'),(8,'Івано-Франківська область'),(9,'Київська область'),(10,'Кіровоградська область'),(11,'Луганська область'),(12,'Львівська область'),(13,'Миколаївська область'),(14,'Одеська область'),(15,'Полтавська область'),(16,'Рівненська область'),(17,'Сумська область'),(18,'Тернопільська область'),(19,'Харківська область'),(20,'Херсонська область'),(21,'Хмельницька область'),(22,'Черкаська область'),(23,'Чернівецька область'),(24,'Чернігівська область'),(25,'Автономна Республіка Крим');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_staff`
--

DROP TABLE IF EXISTS `school_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(10) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `position` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `birthday` int(11) DEFAULT NULL,
  `image` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of personal of school';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_staff`
--

LOCK TABLES `school_staff` WRITE;
/*!40000 ALTER TABLE `school_staff` DISABLE KEYS */;
INSERT INTO `school_staff` VALUES (13,2,'Ващаєв Сергій Сергійович','Декан Факультету ІСіТ',294526800,'/uploads/school-staff/c51ce410c124a10e0db5e4b97fc2af39.jpg'),(14,2,'Y Данильченко Тетяна Валеріївна','Зам. декана ФІСіТ',-186462000,'/uploads/school-staff/aab3238922bcc25a6f606eb525ffdc56.jpg');
/*!40000 ALTER TABLE `school_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `schools` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `city_id` int(250) unsigned NOT NULL,
  `price` int(100) DEFAULT NULL,
  `is_test` set('no','yes') NOT NULL DEFAULT 'no',
  `payment_for_school` set('single','all') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'single',
  `price_for_all_school` int(255) unsigned DEFAULT NULL,
  `school_currency_ID` int(200) unsigned NOT NULL DEFAULT 1,
  `max_students` int(255) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of schools';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,'Школа № 7 (Тест)',2,20000,'no','single',NULL,1,NULL),(2,'Загальноосвітня середня школа І-ІІІ ступенів № 7',1,NULL,'no','all',300500,1,1200),(3,'Школа № 5',1,NULL,'no','all',340000,1,840),(6,'Школа № 2',1,200,'no','single',NULL,1,NULL),(11,'Школа №5',15,250,'no','single',NULL,1,NULL),(12,'Музична школа №32',229,NULL,'no','all',540000,1,1150);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `user_id` int(250) unsigned NOT NULL,
  `class_id` int(100) unsigned NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of students';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (5,17),(59,17),(60,17),(61,17),(62,17),(63,17),(64,17),(65,17),(68,17),(69,17),(70,17),(71,17),(72,17),(73,17),(74,17),(75,17),(76,19),(77,17),(78,17),(80,17),(85,4),(86,4),(87,4),(88,4),(89,4),(90,4),(142,4),(93,4),(94,4),(95,4),(96,4),(97,4),(98,4),(99,4),(100,4),(101,4),(102,4),(103,4),(104,4),(105,19),(107,19),(108,19),(109,19),(110,19),(111,19),(112,19),(113,19),(114,19),(115,19),(116,19),(117,19),(118,19),(119,19),(120,19),(121,19),(122,19),(123,19),(128,17),(129,19);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(100) unsigned NOT NULL,
  `subject_name` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of subjects school';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,2,'Українська література'),(2,2,'Українська мова'),(15,2,'Математика'),(4,2,'Біологія'),(5,2,'Фізика'),(6,2,'Хімія'),(7,2,'Історія України'),(8,2,'Всесвітня Історія'),(9,2,'Англійська мова'),(10,3,'Основи здоров\'я'),(11,2,'Зарубіжна література'),(12,2,'Фізичне виховання'),(13,2,'Медицина');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `support` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(255) unsigned DEFAULT NULL,
  `type_answer` set('support','user') NOT NULL,
  `message` text NOT NULL,
  `date` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of asnwers support';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `user_id` int(250) unsigned NOT NULL,
  `school_id` int(250) unsigned NOT NULL,
  `subject` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of teachers';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (7,2,'Українська мова та література'),(6,2,'Фізика'),(2,2,'Математика'),(23,2,'Початкові класи'),(3,3,'Етика'),(84,2,'Історія України та Всесвітня Історія'),(138,2,'Хімія'),(127,6,'Фізика'),(4,11,'Психологія'),(141,12,'Музика');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telegram`
--

DROP TABLE IF EXISTS `telegram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `telegram` (
  `user_id` int(250) unsigned NOT NULL,
  `telegram_chat_id` varchar(100) NOT NULL,
  `status` set('pending','closed') NOT NULL DEFAULT 'closed',
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `telegram_chat_id` (`telegram_chat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Table of telegram info about user';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telegram`
--

LOCK TABLES `telegram` WRITE;
/*!40000 ALTER TABLE `telegram` DISABLE KEYS */;
INSERT INTO `telegram` VALUES (72,'607049689','closed'),(6,'-------607049689','closed'),(45,'406919180','closed'),(3,'6070496892222','closed'),(87,'607049689000','closed'),(5,'383208161','closed'),(1,'395397316','closed');
/*!40000 ALTER TABLE `telegram` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `username` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `name` varchar(300) NOT NULL,
  `fio` varchar(300) NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `birthday` int(15) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `real_password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `image` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `type` set('admin','teacher','student','parent','director') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `send_mail` tinyint(1) NOT NULL DEFAULT 1,
  `auth_key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'vitalyachernysh@gmail.com','admin','Черниш Віталій Віталійович','Черниш В. В.','+380939496142',818035200,'$2y$13$LA9wK.rDNxPLCR1a.CC9DOIbUJXdatd0.5iLJ7Cyxxi2/ZVWBXR1S','2Gethersomebodyhiphop','/uploads/users/c4ca4238a0b923820dcc509a6f75849b.jpg','admin',1,'dCmVWL81cIalIGvVch9rp7EhQJRy2ZEJ'),(2,'29vitaliy@mail.ru','test','Тестенко Тест Батьківна','Тестенко Т. Б.','+380980166657',-22129200,'$2y$13$3t16MWIhJlgyZub6lJGBIuJRWwztR9Aif5VSYOW4gDgMKnf4uzsCe','2Gethersomebody','/uploads/users/2.png','director',0,'UHPeYsOnDgzQ6g22QGvmXMz9L8ucbLGK'),(3,'director@gmail.com1','director','Шуліпа Наталія Борисівна','Шуліпа Н. Б.','+380959938278',1277240400,'$2y$13$h5PuMCN9EsUZ8widdofTauzfMIxLVll/MaJuI476dKBepnA5m6zhm','12345','/uploads/users/eccbc87e4b5ce2fe28308fd9f2a7baf3.jpg','director',1,'Z6ouwZXH_IcMdNNv0lr8tT2wn1XnZy22'),(4,'viktoria@gmail.com1','vika','Черниш Вікторія Олексіївна','Черниш В. О.','+380630970004',850082400,'$2y$13$noE8NUgKFdMTdSomc5BfAuFyWjUjiWqnFW4uE2nRe9quVSJGeogTK','12345','/uploads/users/4.jpg','director',1,'cpLSGjf3infwVFcWRzOmGqswenHaKzhF'),(5,'vitalya@gmail.com1','vitalya123','Черниш Віталій Віталійович','Черниш В. В.','+380930000000',861742800,'$2y$13$ORgry7LdQ2mXH21JSe/XSe5G.7c6KrYHVq3jh9MRw.aFGI1uY5AAm','Ghjuth67','/uploads/users/e4da3b7fbbce2345d7772b0674a318d5.png','student',1,'r_PNgO3N4fwxiLhlnGtZNleiQJqPUIHJ'),(6,'teacher@gmail.com1','teacher','Гунько Лілія Вячеславівна','Гунько Л. В. sdsd','+3809394949494',1535490000,'$2y$13$/XqfLp4YvfcciAGU1wtCduX4VPptSHHC6VUZ9fYuivsx.rzOAMu2q','12345','/images/_no_user.png','teacher',1,'RsEwYqmBzCkTFm0hg8fhfuYkVlIQlT0b'),(7,'father@gmail.com1','father','Батько Батькович','Батько Б.','+380930000002',-16945200,'$2y$13$xqykldfaW271/0sGxfQJouGxB3WaAtMcyXExws7lUuF1pyaO.7qCi','','/images/_no_user.png','teacher',1,'90k0LGjiAPWoeAA5B7Y55WzUyqvmHwby'),(23,'sveta.chernysh@gmail.com1','sveta_chernysh','Черниш Світлана Петрівна','Черниш С. П.','',-11674800,'$2y$13$tVXyGArw/OEpHyY/gndJ4.OkYZ6e/BBZNhv6NDxv/560upd8STKTK','','/uploads/users/37693cfc748049e45d87b8c7d8b9aacd.jpg','teacher',1,NULL),(36,'filipchenko@gmail.com1','filipchenko','Філіпченко Олександр Олександрович','Філіпченко О. О.','+380959275923',843512400,'$2y$13$dGyVUlJ9h9Cw6tA20oNhye4Co67qV/6dacQOMT3sL9juNiQwie8D2','','/uploads/users/19ca14e7ea6328a42e0eb13d585e4c22.jpg','student',1,'FtjOXVQfU06J53aaFbv87E4n9gTr3gWK'),(38,'new_father@gmail.com1','new_father','Черниш Віталій Іванович','Черниш В. І.','+380962247949',-43124400,'$2y$13$16bfaK3PY3Of0w8dPnDKrOiepjBtiNs20543cP0/L/JarEqbWJR86','12345','/uploads/users/a5771bce93e200c36f7cd9dfd0e5deaa.jpg','parent',1,'45p1HThbSdiS_Js0U6Zz1DSnUJydmvDr'),(45,'vladchernysh@gmail.com1','vladchernysh','Черниш Владислав Віталійович','Черниш В. В.','+380984858984',665701200,'$2y$13$1iEfVUi4jEbk4gcFw6CkR.O0CnGlhnbznSMtoykVGyEg8uaax8EbG','','/images/_no_user.png','teacher',1,'dU-VeUo0KGO29X_YSOqt9G3s3Sx-Mh-N'),(51,'dsaiod@das.dsa','dsaioddasdsa','Кирило','Кирило','12991284',NULL,'$2y$13$uVZDWI2v.tjEmX9txXVSg.vTJotKaWQdS5B1oFPASox.4J/9L.oLe','12345','/images/_no_user.png','student',1,NULL),(52,'dsjkd@dsk.das','dsjkddskdas','Сестра Кирилка','Сестра К.','231321',1277326800,'$2y$13$f60WHxB/vW5zoa9lXdTqv.PBQErUx/3vL6U5P2TwLALipW7rGF8oy','12345','/images/_no_user.png','parent',1,NULL),(57,'liqpay@school-diary.io','vlad_chernysh','Черниш Владислав Віталійович','Черниш В. В.','+380996739275',NULL,'$2y$13$Q7Wsr10avZfynrmQORAukuWcRf56HiSjxPXzbzwwG3tgw00wW0MVa','12345','/images/_no_user.png','parent',1,NULL),(59,'voznenko@gmail.com1','voznenkogmailcom','Возненко Марина Русланівна','Возненко М. Р.','+246324535679',771541200,'$2y$13$2LgEu8yL.j3i7QuMQMVKVOWc5AvTci7FVV3mUyX5ryR8jre4UsIu2','12345','/images/_no_user.png','student',1,NULL),(60,'lavrekha@gmail.com1','lavrekhagmailcom','Лавреха Микола Олександрович','Лавреха М. О.','',1213390800,'$2y$13$pV6w.mOPvsdNaSbiGsHL9.QC.D7VvM3gyLhOPgc0GBwpKIKHpwMmW','12345','/images/_no_user.png','student',1,NULL),(61,'shavul@gmail.com1','shavulgmailcom','Шавуль Денис Олександрович','Шавуль Д. О.','',1208638800,'$2y$13$ON9s8V0gD.MDsEqTiHUt8.jTZ79HcR0CnW7PbI2ilpJ2a06jQZmRm','12345','/images/_no_user.png','student',1,NULL),(62,'creative@gmail.com1','creative','Товпишко Ярослав Володимирович','Товпишко Я. В.','+380934090356',-22820400,'$2y$13$yXgJqvsd30qwcoAlRrGhKe0mqP.CkBpvJ5Iqaj2iE4NQZK.ehInMm','12345','/images/_no_user.png','student',1,NULL),(63,'shveps@gmail.com1','shvepsgmailcom','Швець Олександр Вікторович','Швець О. В.','+380911111021',842216400,'$2y$13$GI8TOQKboXQCyfch6wOvPuxQqu.UaGAyfxvm5Hgh3wp5N3UxjJ7kO','12345','/images/_no_user.png','student',1,NULL),(64,'teo@gmail.com1','teogmailcom','Олексин Теодор Теодорович','Олексин Т. Т.','',1208552400,'$2y$13$Dhbgde/ebIm8vBVRHqnOceX64W6SY/K4kZSMXF9Ncso6zO.T7seIK','12345','/images/_no_user.png','student',1,NULL),(65,'test_for_liqpay@gmail.com1','testforliqpaygmailcom1','LiqPay Тестове Ім\'я','LiqPay Т. І.','',804718800,'$2y$13$g9f4HWMPbD1EvBeR1e6bAOYGo6PPDuxPgJSV7EWk781ToFKxAkJnm','12345','/images/_no_user.png','student',1,NULL),(68,'kosmas@gmail.com1','kosmasgmailcom1','Масловський Костянтин Ярославович','Масловський К. Я.','',837550800,'$2y$13$k7W7HvAkg0XY1CQwUe.VzuyouGh.N/gj2wRepe3b.YtmT4F3Ib6.m','12345','/images/_no_user.png','student',1,NULL),(69,'stepanets@gmail.com1','stepanetsgmailcom1','Степанець Олена Миколаївна','Степанець О. М.','',NULL,'$2y$13$.iyVQax/yZm4tTp0u9tfSuKCsGA4pvyByciQG6Cc9Pqgpp3ABFpJ6','12345','/images/_no_user.png','student',1,NULL),(70,'odintsov@gmail.com1','odintsovgmailcom1','Одінцов Руслан Степанович','Одінцов Р. С.','',1494968400,'$2y$13$R.ES7WPNG17sIragB/eax.1WJ83wVHasKx.cY.qflOHeO6QsnTgK.','12345','/images/_no_user.png','student',1,NULL),(71,'kryvohizha@gmail.com1','kryvohizhagmailcom1','Кривохижа Юрій Олегович','Кривохижа Ю. О.','',NULL,'$2y$13$o/m0snYNHfqchwpXdOvo.uleMEFdsjpjPnvJAh7yrI9H5DD3OixyS','12345','/images/_no_user.png','student',1,NULL),(72,'kislashko@gmail.com1','test123','Кислашко Олег Ярославович','Кислашко О. Я.','',1143493200,'$2y$13$HWTngV0jR.25fiDX9fnZNOagyTroaX/wt8z8b2umcElPMFAjs9.0.','12345','/images/_no_user.png','student',1,NULL),(73,'kostenko@gmail.com1','kostenkogmailcom1','Костенко Денис Валерійович','Костенко Д. В.','',1526331600,'$2y$13$Zb.bHfd9YMxtJUQ34S5dCuK9Vo7wckaqJPgxvd7e4X6kVI.jF.gP6','12345','/images/_no_user.png','student',1,NULL),(74,'tuchin@gmail.com1','tuchingmailcom1','Тучін Андрій Ігорович','Тучін А. І.','',NULL,'$2y$13$HaXSAo182codijUSMQknKeyaQK/cQSVDS6eUS3QSAAdTXQk90XyxO','12345','/images/_no_user.png','student',1,NULL),(75,'tsimbal@gmail.com','tsimbalgmailcom','Цимбал Богдан Вікторович','Цимбал Б. В.','',NULL,'$2y$13$FiKm5NSFLJEfC0uwlUTnHOruusse3wIzaf64oC0buUqfukhsGCUra','12345','/images/_no_user.png','student',1,NULL),(76,'chornous@gmail.com1','chornousgmailcom1','Чорноус Лілія Олександрівна','Чорноус Л. О.','',NULL,'$2y$13$ixexzZMh4OTuxqVEt8nEfuAKaN/VcwZzXk87pUbjyqoKdNaojSMiW','12345','/uploads/users/fbd7939d674997cdb4692d34de8633c4.jpg','student',1,NULL),(77,'kolodii@gmail.com1','kolodiigmailcom1','Колодій Богдан Віталійович','Колодій Б. В. 1','',828997200,'$2y$13$HcQ/JYMCg2yCW2pHkeq5Z..i5EwgJha0DzGyH1F87g9nA5EkBxFjK','12345','/images/_no_user.png','student',1,NULL),(78,'nenko@gmail.com1','nenkogmailcom1','Ненько Павло Віталійович','Ненько П. В.','',1271538000,'$2y$13$VdcW3b/e3tt4ISGlf3R4puONlDfjcn7jluCi/celhX.QZm9lzCveC','12345','/images/_no_user.png','student',1,NULL),(80,'ivanchenko@gmail.com1','ivanchenkogmailcom1','Іванченко Геннадій Кернес','Іванченко Г. К.','',NULL,'$2y$13$BfIr2bPBgB6VFvI3T/hZkOnGCgG2e795elGQrINnfIUTrv99V2Rw.','12345','/images/_no_user.png','student',1,NULL),(84,'new_t@gmail.com1','new_tgmailcom1','Нестеренко Людмила Дмитрівна','Нестеренко Л. Д.','',NULL,'$2y$13$ADMmFGQFTEEvhtIvthH8JORdtKB5S241GPz4ZrJCLWkg3lplw40D.','12345','/uploads/users/68d30a9594728bc39aa24be94b319d21.jpg','teacher',1,NULL),(85,'poroh@gmail.com1','porohgmailcom1','Порошенко Петро Олексійович','Порошенко П. О.','',-362718000,'$2y$13$EYAo0r2wVIGihH7uY0A51.NqzctRmyKhF8BsxZK1.Hcr7CowTQpn6','12345','/images/_no_user.png','student',1,NULL),(86,'borovetz@gmail.com1','borovetzgmailcom1','Боровець Роман Геннадійович','Боровець Р. Г.','',NULL,'$2y$13$7OWA0zwGCvMRQsqUd2ocJOlwRQS.gda/Mh8yFm6QeWE/GLYhW6hAK','12345','/images/_no_user.png','student',1,NULL),(87,'vovk@gmail.com1','vovkgmailcom1','Вовк Євгеній Михайлович','Вовк Є. М.','',NULL,'$2y$13$gB5bb4piHQOSL.9HtAInSe41RrXBmC//9pHdSkehh5STof8EUN6am','12345','/images/_no_user.png','student',1,NULL),(88,'bodko@gmail.com1','bodkogmailcom1','Бодько Ігор Миколайович','Бодько І. М. s','',NULL,'$2y$13$z13BAJv1ID4bcup6RXfdD.Duyq/TMnWJF1UWRSVE6nRUwj1Qv0Hfy','12345','/images/_no_user.png','student',1,NULL),(89,'gumenyuk@gmail.com1','gumenyukgmailcom1','Гуменюк Михайло Віталійович','Гуменюк М. В.','',NULL,'$2y$13$Qzwif3eruFfZpNZPLvZyiuYhRoZ3yPnxfGWOcs.Y/DLBFl186JOzG','12345','/images/_no_user.png','student',1,NULL),(90,'devyatlitckii@gmail.com1','devyatlitckiigmailcom1','Девятлицький Артем Вікторович','Девятлицький А. В.','',NULL,'$2y$13$qriUZrWocU5fXhXvSTwZ6OTQpcHOr/e30j/bYaXJTgQxVRwc4Skfm','12345','/images/_no_user.png','student',1,NULL),(93,'kotyash@gmail.com1','kotyashgmailcom1','Котяш Назар Василькович','Котяш Н. В.','',NULL,'$2y$13$UTfz9xgJCcbLXHoR.kVRRej.Av9OQ27wpjI.HwxzQ3uB6Sa3H/Ytm','12345','/images/_no_user.png','student',1,NULL),(94,'kotsyuk@gmail.com1','kotsyukgmailcom1','Коцюк Вадим Петрович','Коцюк В. П.','',NULL,'$2y$13$VZMC8Bo5FW4z1WPbtn.XS.ueMtQiJds1IK.rW.xhmsvVBebNNm10q','12345','/images/_no_user.png','student',1,NULL),(95,'kushnir@gmail.com1','kushnirgmailcom1','Кушнір Анна Владиславівна','Кушнір А. В.','',NULL,'$2y$13$uL9wT11gNPa5fWmKhBcd5.ORarbOpH18CXp6LLjZqZfc5wzxMPGfW','12345','/images/_no_user.png','student',1,NULL),(96,'maksimuk@gmail.com1','maksimukgmailcom1','Максимюк Наталія Вадимівна','Максимюк Н. В.','',NULL,'$2y$13$4.9LHUNFPYGqSweLN1ZBg.AerQquNGsDBJ6srXZYLptGWlSOyydby','12345','/images/_no_user.png','student',1,NULL),(97,'maslyuk@gmail.com1','maslyukgmailcom1','Маслюк Владислав Віталійович','Маслюк В. В.','',NULL,'$2y$13$rUteyXpQlZ7jzKbqEY9Ni.xDK3uGGyVb06TDsW8/A7QJfGpDEHNua','12345','/images/_no_user.png','student',1,NULL),(98,'motornyuk@gmail.com1','motornyukgmailcom1','Моторнюк Уляна Станіславівна','Моторнюк У. С.','',NULL,'$2y$13$5ImzvSghycNm24o.uERaa.D7UMzARY93sFLV.JPTr2Hw9VztkbuJm','12345','/images/_no_user.png','student',1,NULL),(99,'motuzko@gmail.com1','motuzkogmailcom1','Мотузко Оксана Вікторівна','Мотузко О. В.','',NULL,'$2y$13$CufgCNvR/AKaSbRrdT09i.ybgPsUMsW330QyJL/NNMcyjsKL7cJj.','12345','/images/_no_user.png','student',1,NULL),(100,'nesteruk@gmail.com1','nesterukgmailcom1','Нестерук Лілія Олексіївна','Нестерук Л. О.','',NULL,'$2y$13$AdF40rju37.92NDDytsqd.RYHanDON3Ylocnl3DY..A8tVj4AkNiu','12345','/images/_no_user.png','student',1,NULL),(101,'nikolaichuk@gmail.com1','nikolaichukgmailcom1','Ніколайчук Сергій Володимирович','Ніколайчук С. В.','',NULL,'$2y$13$aUC1Yvnfeah8D4/3GYJTjelMQ4Iz9CDkCzIQjANqU7eLKubpaK6ji','12345','/images/_no_user.png','student',1,NULL),(102,'oblovatska@gmail.com1','oblovatskagmailcom1','Обловацька Марина Степанівна','Обловацька М. С.','',NULL,'$2y$13$3l4SGxVf1HV69j8lu1QcbuukDCvD02t9CA6hjBOWQ8GWGujBkQMPu','12345','/images/_no_user.png','student',1,NULL),(103,'osnovin@gmail.com1','osnovingmailcom1','Основін Владислав Веніамінович','Основін В. В.','',NULL,'$2y$13$zWoEkV2kxADnQ2oZ64WS6eMaXIAkWrc8MGW1sDYX6Z3i7hf4QB3hq','12345','/images/_no_user.png','student',1,NULL),(104,'dud@gmail.com1','dud','Дудь Юрій Юрійович','Дудь Ю. Ю.','',NULL,'$2y$13$SzlZmPG517vAXj3NR42EGOoCyZZ7Nw2O2aLc71PLSRx0kipYhdC9.','12345','/images/_no_user.png','student',1,NULL),(105,'beloschuk@gmail.com1','beloschukgmailcom1','Белощук Тетяня Миколаївна','Белощук Т. М.','',1208379600,'$2y$13$l6pMfB.rShWKpzJdmvM.qeCaunmFTLWDTCo.4zumwsL5ZBwxg3beW','12345','/images/_no_user.png','student',1,NULL),(107,'garbar@gmail.com1','garbargmailcom1','Гарбар Максим Максимович','Гарбар М. М.','',1208552400,'$2y$13$FntV7T7AqbNjya5s13b/5O33MGO/zhrTcXaituiI2vCIETYjHL416','12345','/images/_no_user.png','student',1,NULL),(108,'demyanyuk@gmail.com1','demyanyukgmailcom1','Демянюк Софія Василівна','Демянюк С. В.','',1208638800,'$2y$13$WLH0WQDauPLSx96Vqmfqv.xuijVgktRYfa9o1lvGozILy1Sa.JtxG','12345','/images/_no_user.png','student',1,NULL),(109,'kisil@gmail.com1','kisilgmailcom1','Кисіль Ілона Пріколівна','Кисіль І. П.','',NULL,'$2y$13$WfZuJoNnBktdRoGO4pUt3Oyrccysx3P29Nk13Yr/Ys809m6rr4oBO','12345','/images/_no_user.png','student',1,NULL),(110,'kushniruk@gmail.com1','kushnirukgmailcom1','Кушнірук Дмитро Дмитрович','Кушнір Д. Д.','',1208725200,'$2y$13$29txSw0/jNGwZihngl9smuwtH.Jv9zXk5l50GbkSaA4yr/X8ss2gq','12345','/images/_no_user.png','student',1,NULL),(111,'lashchuk@gmail.com1','lashchukgmailcom1','Лащук Олена Павлівна','Лащук О. П.','',NULL,'$2y$13$udOPAZecl4vOFsiRMWkCz.nkgOSyYXPCylVRkEFf2OMEgqzg01ZAa','12345','/images/_no_user.png','student',1,NULL),(112,'lashchuk1@gmail.com1','lashchuk1gmailcom1','Лащук Павло Павлович','Лащук П. П.','',NULL,'$2y$13$pKjd0GzR67rfayH2X.OMQ.eXpEUNBlrLJjVDqzu40uM069dNR104S','12345','/images/_no_user.png','student',1,NULL),(113,'marchenko@gmail.com1','marchenkogmailcom1','Марченко Юрій Миколайович','Марченко Ю. М.','',NULL,'$2y$13$j4rOyk/m0jA9uN/EjKxUT.j3oCp7kj5pgAWGIobpMvhintO2I3GW6','12345','/images/_no_user.png','student',1,NULL),(114,'ostapchuk@gmail.com1','ostapchukgmailcom1','Остапчук Катерина Олександрівна','Остапчук К. О.','',NULL,'$2y$13$elyytQ6GkaYW8kZNrWafM..cKisFjzEYoxOxdAjI08NonaXKQaFkK','12345','/images/_no_user.png','student',1,NULL),(115,'pantyushko@gmail.com1','pantyushkogmailcom1','Пантюшко Вікторія Олексіївна','Пантюшко В. О.','',1208552400,'$2y$13$EWxp8aAr7F3SxVGbfVxXR.FhNLE.zI7Q8yaIVfAwJK30eT.36QR26','12345','/images/_no_user.png','student',1,NULL),(116,'petrushin@gmail.com1','petrushingmailcom1','Петрушин Євгеній Онєгін','Петрушин Є. О.','',NULL,'$2y$13$m9d8PvaNuHM86nI.ERPBpuR.KCG7mzzALoHFXRl/KScZLWijlS5r6','12345','/images/_no_user.png','student',1,NULL),(117,'pilipaka@gmail.com1','pilipakagmailcom1','Пилипака Олена Віталіївна','Пилипака О. В.','',NULL,'$2y$13$vh5lZVrKs1jkM3uyafAKCOp86YPp7w/nHe3pTLmOJN65xnBEweFcW','12345','/images/_no_user.png','student',1,NULL),(118,'romanyuk@gmail.com1','romanyukgmailcom1','Романюк Олександр Олегович','Команюк О. О.','',NULL,'$2y$13$hP5zLuNQwVbN/GZAsbTUGOMREao/2U1u875zkVozFm5sU/d.4wpbi','12345','/images/_no_user.png','student',1,NULL),(119,'stepanyuk@gmail.com1','stepanyukgmailcom1','Степанюк Сергій Вікторович','Степанюк С. В.','',1129237200,'$2y$13$2VdsnI3pR4Eh4rsXlBXyO.itXCTv1gSTRyNnoHYvBFr8uEFfJ3lCK','12345','/images/_no_user.png','student',1,NULL),(120,'stroinska@gmail.com1','stroinskagmailcom1','Строїнська Дар\'я Олексіївна','Строїнська Д. О.','',NULL,'$2y$13$xOkPp4OBRwN394h.s96C0eTdE0kgs/ZM0fD9PpmLJ9.7IuppcFXGO','12345','/images/_no_user.png','student',1,NULL),(121,'shapka@gmail.com','shapkagmailcom','Шапка Олександра Миколаївна','Шапка О. М.','',NULL,'$2y$13$NE5n841tRKJL8vEF6Gsej.9SdjRmBYmlcJfr6.Tj5cyZhAoj.t8wm','12345','/images/_no_user.png','student',1,NULL),(122,'bukin@gmail.com1','bukingmailcom1','Букін Роман Геннадійович','Букін Р. Г. Б.','',1208466000,'$2y$13$pSG8qaUyTjL40x.RbYrrnO5jfsne.vvuPM107n9RtTcxVYQzy9v3.','12345','/images/_no_user.png','student',1,NULL),(123,'malyovenko@gmail.com1','malyovenkogmailcom1','Мальовенко Оксана Петрівна','Мальовенко О. П.','',NULL,'$2y$13$Nr6cN6tc2w436I5xUg4IK.ssNvlYXhUkGXWc9LFIQscgLYBanF4na','12345','/images/_no_user.png','student',1,NULL),(127,'price_uah_dir@gmail.com1','price_uah_dirgmailcom1','Тестовий Новий супер директор','Тестовий Н. С. Д.','',NULL,'$2y$13$LMyc1goJ0kM0QRDZRa..oOoZbD/Lmgm3P8zd9t8sC0FL5P5zdXIqW','12345','/images/_no_user.png','director',1,NULL),(128,'Fff@gmail.com1','Fffgmailcom1','Тищенко Федір Геннадійович','Тищенко Ф. Г.','',954536400,'$2y$13$12BxU/Kc7dg6mK2X8AEmZuGO4SXDNFUmMwcpEeCJjRHKMiXMSt7Wa','12345','/images/_no_user.png','student',1,NULL),(129,'verbitska@gmail.com1','verbitskagmailcom1','Вербицька Оксана Миколаївна','Вербицька О. М.','+380979273952',537310800,'$2y$13$BzQeZ.MH6Z5ZOYdxu5XOZeLd3LMBmx6ykt/Ys8IN7iP4HL6t6rayq','12345','/images/_no_user.png','student',1,NULL),(130,'mother_verb@gmail.com1','mother_verbgmailcom1','Вербицька Світлана Іванівна','Вербицька С. І.','',NULL,'$2y$13$P8.HmxfSN1QBLCsw3MxIbOn/tzil1IOSbCya/dHftXYeOeuNh1ICO','12345','/images/_no_user.png','parent',1,NULL),(131,'sveta.chernysh@gmail.com123','sveta_chernysh123','Черниш Світлана Петрівнаааа','Черниш С. П.','',-11674800,'$2y$13$tVXyGArw/OEpHyY/gndJ4.OkYZ6e/BBZNhv6NDxv/560upd8STKTK','','/uploads/users/37693cfc748049e45d87b8c7d8b9aacd.jpg','teacher',1,NULL),(132,'123new@ggmail.com123','123newggmailcom123','Ломоносова Олександра Михайлівна','Ломоносова О. М.','',-48481200,'$2y$13$ZWDJhruHDnmCqDT7o7dnNeQ7o37mZNpDLxK9.9c3RnWzIm5R29rP2','12345','/images/_no_user.png','teacher',1,'8bUp2xXVq3iPc-G-DsRgZumvPtN5SGY_'),(136,'student@gmail.com111','studentgmailcom111','Філіпченко Олександр Олександрович','Колодій Б. В. 1','+380959275923',796082400,'$2y$13$4/CNUHLKcjB/XwxtkuH74OAgYHVQPvddsFcoQPuEcP/cO0iKrwscy','12345','/images/_no_user.png','student',1,NULL),(138,'fiveVteacher@gmail.com1','fiveVteachergmailcom1','Вчитель 5 класу','В. 5. К.','',NULL,'$2y$13$MuMOL7NOn1JHQ2LeoadAKulLT7/c8WmiOJcAlUNz2p9Mg5ZTy0Z0y','12345','/images/_no_user.png','teacher',1,NULL),(141,'music_dir@gmail.com1','music_dirgmailcom1','Данилюк Іван Петрович','Данилюк І. П.','+380939933993',-443761200,'$2y$13$iNt93SN1fHMRds0A8ByCMunWHkv63O0v5m0HGHADvypTsgADWYO8i','12345','/images/_no_user.png','director',1,NULL),(142,'new_stud_123@gmail.com1','new_stud_123gmailcom1','Педрило Філіп Бідросович','П. Ф. Б.','',1088542800,'$2y$13$iB1oSkUsSa.xzJ.hZIMwPegfy4BgnZA/wStItNweDuBILsay9Fh8q','12345','/images/_no_user.png','student',1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-28 10:35:13
