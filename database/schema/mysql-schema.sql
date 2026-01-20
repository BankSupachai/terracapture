/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `accessory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessory` (
  `accessory_id` int(11) NOT NULL AUTO_INCREMENT,
  `accessory_code` varchar(20) DEFAULT NULL,
  `accessory_name` varchar(300) NOT NULL,
  `accessory_price` int(11) NOT NULL,
  `accessory_sale` int(11) NOT NULL DEFAULT '0',
  `accessory_type` varchar(30) DEFAULT NULL,
  `accessory_company` int(11) NOT NULL DEFAULT '0',
  `accessory_procedure` int(11) NOT NULL DEFAULT '0',
  `accessory_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`accessory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `accessory_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessory_case` (
  `accessory_case_id` int(11) NOT NULL AUTO_INCREMENT,
  `accessory_case_asid` int(11) NOT NULL,
  `accessory_case_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `accessory_case_unit` int(11) NOT NULL,
  `accessory_case_status` int(11) NOT NULL DEFAULT '0',
  `accessory_case_datetime` datetime NOT NULL,
  PRIMARY KEY (`accessory_case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `accessory_com`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessory_com` (
  `accessorycom_id` int(11) NOT NULL AUTO_INCREMENT,
  `accessorycom_name` varchar(300) NOT NULL,
  PRIMARY KEY (`accessorycom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `atemp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atemp` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `temp_text` longtext NOT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `autotext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autotext` (
  `auto_id` int(11) NOT NULL AUTO_INCREMENT,
  `auto_text` varchar(2000) NOT NULL,
  `auto_textid` varchar(100) NOT NULL,
  `auto_procedure` int(10) NOT NULL,
  PRIMARY KEY (`auto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `bowel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bowel` (
  `bowel_id` int(11) NOT NULL AUTO_INCREMENT,
  `bowel_name` varchar(200) NOT NULL,
  PRIMARY KEY (`bowel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(300) NOT NULL,
  `value` varchar(300) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `complication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complication` (
  `complication_id` int(11) NOT NULL AUTO_INCREMENT,
  `complication_name` varchar(100) NOT NULL,
  `procedure_code` varchar(10) NOT NULL,
  PRIMARY KEY (`complication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_anesthesia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_anesthesia` (
  `anesthesia_id` int(11) NOT NULL AUTO_INCREMENT,
  `anesthesia_name` varchar(100) NOT NULL,
  `procedure_code` varchar(10) NOT NULL,
  PRIMARY KEY (`anesthesia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_anesthesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_anesthesis` (
  `anesthesis_id` int(11) NOT NULL AUTO_INCREMENT,
  `anesthesis_name` varchar(100) NOT NULL,
  `anesthesis_unit` varchar(20) NOT NULL,
  `procedure_code` varchar(10) NOT NULL,
  PRIMARY KEY (`anesthesis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_discharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_discharge` (
  `discharge_id` int(11) NOT NULL,
  `discharge_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_gender` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(100) NOT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_indication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_indication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_national`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_national` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ct_code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `namethai` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(100) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_prefix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_prefix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_quality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_quality` (
  `quality_id` int(11) NOT NULL,
  `quality_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_rapid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_rapid` (
  `rapid_id` int(11) NOT NULL AUTO_INCREMENT,
  `rapid_name` varchar(100) NOT NULL,
  PRIMARY KEY (`rapid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_righttotreatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_righttotreatment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_route_broncho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_route_broncho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_unitdose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_unitdose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `dd_visualization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dd_visualization` (
  `visualization_id` int(11) NOT NULL,
  `visualization_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `gastric_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastric_content` (
  `gastric_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `gastric_content_name` varchar(100) NOT NULL,
  PRIMARY KEY (`gastric_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `histopathology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histopathology` (
  `histopathology_id` int(11) NOT NULL AUTO_INCREMENT,
  `histopathology_name` varchar(200) NOT NULL,
  `procedure_code` varchar(10) NOT NULL,
  PRIMARY KEY (`histopathology_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `icd9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `icd9` (
  `icd9_id` int(11) NOT NULL AUTO_INCREMENT,
  `icd9_num` int(4) DEFAULT NULL,
  `icd9_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`icd9_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `incision_cysto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incision_cysto` (
  `incision_id` int(20) NOT NULL AUTO_INCREMENT,
  `incision_name` varchar(400) NOT NULL,
  `procedure_code` int(15) NOT NULL,
  PRIMARY KEY (`incision_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `measurements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measurements` (
  `measurements_id` int(11) NOT NULL AUTO_INCREMENT,
  `measurements_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `measurements_properties` text COLLATE utf8_unicode_ci NOT NULL,
  `measurements_results` text COLLATE utf8_unicode_ci NOT NULL,
  `measurements_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`measurements_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `operation_cysto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operation_cysto` (
  `operation_id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_name` varchar(300) NOT NULL,
  `procedure_code` varchar(10) NOT NULL,
  PRIMARY KEY (`operation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `patient_id` int(10) NOT NULL AUTO_INCREMENT,
  `createdate` date DEFAULT NULL,
  `regis_date` varchar(20) DEFAULT NULL,
  `regis_time` varchar(20) DEFAULT NULL,
  `hn` varchar(15) NOT NULL DEFAULT '',
  `an` varchar(30) DEFAULT NULL,
  `citizen` varchar(30) DEFAULT NULL,
  `pic` varchar(30) DEFAULT NULL,
  `prefix` varchar(20) DEFAULT '',
  `firstname` varchar(50) DEFAULT '',
  `middlename` varchar(50) DEFAULT '',
  `lastname` varchar(50) DEFAULT '',
  `dicomname` varchar(200) NOT NULL DEFAULT '',
  `gender` smallint(6) DEFAULT NULL,
  `nationality` smallint(6) DEFAULT NULL,
  `birthdate` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `patient_json` text,
  `vip` int(11) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `prediagnostic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prediagnostic` (
  `prediagnostic_id` int(11) NOT NULL AUTO_INCREMENT,
  `prediagnostic_name` varchar(100) NOT NULL,
  `procedure_code` varchar(10) NOT NULL,
  PRIMARY KEY (`prediagnostic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_case` (
  `case_id` int(11) NOT NULL AUTO_INCREMENT,
  `modality` varchar(15) DEFAULT NULL,
  `studydate` int(11) NOT NULL DEFAULT '0',
  `seriesdate` int(11) NOT NULL DEFAULT '0',
  `studyuid` varchar(70) DEFAULT NULL,
  `seriesuid` varchar(70) DEFAULT NULL,
  `dicomtag` mediumtext,
  `dicomsr` mediumtext,
  `caseuniq` bigint(12) NOT NULL,
  `updatetime` bigint(12) DEFAULT NULL,
  `comcreate` varchar(30) NOT NULL DEFAULT '[]',
  `case_hn` varchar(20) NOT NULL,
  `case_dateregister` datetime NOT NULL,
  `case_procedure` int(3) NOT NULL DEFAULT '0',
  `case_procedurecode` varchar(10) NOT NULL,
  `case_dateappointment` datetime NOT NULL,
  `case_physicians01` int(11) NOT NULL,
  `case_status` int(3) NOT NULL,
  `case_status_queue` int(3) NOT NULL DEFAULT '0',
  `case_json` text,
  `case_photo` text NOT NULL,
  `case_pdfversion` varchar(1000) NOT NULL DEFAULT '[]',
  `case_pacs` varchar(1000) DEFAULT '[]',
  `case_room` int(11) DEFAULT '0',
  `case_roomsort` int(11) NOT NULL DEFAULT '0',
  `ready_status` int(11) NOT NULL DEFAULT '0',
  `ready_comment` varchar(300) DEFAULT NULL,
  `case_vip` tinyint(4) DEFAULT '0',
  `case_semi` tinyint(4) DEFAULT '0',
  `case_booking` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casebilling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casebilling` (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_hn` varchar(20) NOT NULL,
  `billing_date` varchar(10) NOT NULL,
  `billing_timeuse` varchar(10) NOT NULL,
  `billing_doctor` varchar(20) NOT NULL,
  `billing_department` varchar(20) NOT NULL,
  `billing_icd9` varchar(300) NOT NULL,
  `billing_icd10` varchar(300) NOT NULL,
  `billing_status` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`billing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casebooking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casebooking` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_from` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'local',
  `book_user` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `book_branch` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `book_doctor` varchar(150) COLLATE utf8_unicode_ci DEFAULT '',
  `book_doctoremail` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `book_doctorowner` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `book_procedure` int(11) DEFAULT NULL,
  `book_room` int(11) DEFAULT NULL,
  `book_predignosis` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_comment` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_status` int(11) NOT NULL DEFAULT '0',
  `book_date_start` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `book_date_end` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `book_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `book_topic` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `book_appoint` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `book_hospitalcode` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casemedication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casemedication` (
  `medi_id` int(11) NOT NULL AUTO_INCREMENT,
  `caseuniq` bigint(13) NOT NULL,
  `comcreate` varchar(30) NOT NULL,
  `updatetime` bigint(12) NOT NULL DEFAULT '0',
  `medi_casejson` text NOT NULL,
  `medi_other` varchar(200) DEFAULT NULL,
  `medi_otherdose` varchar(100) DEFAULT NULL,
  `medi_otherunit` int(4) DEFAULT '0',
  PRIMARY KEY (`medi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casemonitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casemonitor` (
  `monitor_id` int(11) NOT NULL AUTO_INCREMENT,
  `caseuniq` bigint(13) NOT NULL,
  `updatetime` bigint(13) NOT NULL,
  `comcreate` varchar(30) NOT NULL,
  `monitor_hn` varchar(30) NOT NULL,
  `monitor_patientname` varchar(100) NOT NULL,
  `monitor_doctorname` varchar(100) NOT NULL,
  `monitor_procedure` varchar(50) DEFAULT NULL,
  `monitor_prediagnostic` varchar(100) NOT NULL DEFAULT '',
  `monitor_casestatus` int(2) NOT NULL,
  `monitor_room` int(11) DEFAULT '0',
  `monitor_location` varchar(30) NOT NULL DEFAULT '',
  `monitor_order` int(11) NOT NULL,
  `monitor_date` varchar(20) NOT NULL,
  `monitor_timehis` varchar(10) NOT NULL DEFAULT '0',
  `monitor_timevisit` varchar(10) NOT NULL DEFAULT '0',
  `monitor_timeoperation` varchar(10) NOT NULL DEFAULT '0',
  `monitor_remark` varchar(200) DEFAULT NULL,
  `monitor_status` varchar(20) NOT NULL DEFAULT 'Booking',
  PRIMARY KEY (`monitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casenote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casenote` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `caseuniq` bigint(12) NOT NULL,
  `comcreate` varchar(30) NOT NULL,
  `updatetime` datetime NOT NULL,
  `note_status` int(11) NOT NULL DEFAULT '0',
  `note_casejson` text NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casepacs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casepacs` (
  `pacs_id` int(11) NOT NULL AUTO_INCREMENT,
  `caseuniq` bigint(12) NOT NULL,
  `comcreate` varchar(50) NOT NULL,
  `updatetime` datetime NOT NULL,
  `pacs_casejson` text NOT NULL,
  `pacs_pic` varchar(200) DEFAULT NULL,
  `pacs_picstatus` int(11) NOT NULL DEFAULT '0',
  `pacs_pdf` varchar(200) DEFAULT NULL,
  `pacs_pdfstatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pacs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casetemp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casetemp` (
  `temp_comname` varchar(30) NOT NULL,
  `updatetime` bigint(13) NOT NULL,
  `temp_table` varchar(30) DEFAULT NULL,
  `caseuniq` bigint(13) DEFAULT NULL,
  `comcreate` varchar(30) DEFAULT NULL,
  `temp_json` mediumblob,
  `rand_datetime` varchar(20) NOT NULL DEFAULT '',
  `rand_text` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casetrack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casetrack` (
  `track_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_process` varchar(30) NOT NULL,
  `track_caseuniq` bigint(13) DEFAULT NULL,
  `track_rfid` varchar(30) NOT NULL,
  `track_serial` varchar(30) NOT NULL,
  `track_station` varchar(20) NOT NULL,
  `track_user` int(11) NOT NULL,
  `track_json` varchar(1000) DEFAULT NULL,
  `track_date` varchar(15) NOT NULL,
  `track_time` varchar(20) NOT NULL,
  `track_minute` int(11) NOT NULL DEFAULT '0',
  `track_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casevdo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casevdo` (
  `vdo_id` int(11) NOT NULL AUTO_INCREMENT,
  `vdo_cid` int(11) NOT NULL,
  `caseuniq` bigint(13) NOT NULL,
  `updatetime` bigint(13) NOT NULL,
  `comcreate` varchar(30) DEFAULT NULL,
  `vdo_dir` varchar(300) DEFAULT NULL,
  `vdo_name` varchar(100) NOT NULL,
  `vdo_url` varchar(300) DEFAULT NULL,
  `vdo_status` int(11) NOT NULL DEFAULT '0',
  `vdo_syn` int(11) NOT NULL DEFAULT '1',
  `vdo_group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vdo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_casevdogroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_casevdogroup` (
  `vdogroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `caseuniq` bigint(13) NOT NULL,
  `comcreate` varchar(30) NOT NULL,
  `vdogroup_user` int(11) NOT NULL,
  `vdogroup_name` varchar(200) NOT NULL,
  `vdogroup_description` varchar(2000) NOT NULL,
  `vdogroup_visit` int(11) NOT NULL DEFAULT '0',
  `vdogroup_date` varchar(30) NOT NULL,
  `vdogroup_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vdogroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_citizencard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_citizencard` (
  `ic_id` int(11) NOT NULL AUTO_INCREMENT,
  `ic_th_name` varchar(255) NOT NULL,
  `ic_eng_name` varchar(255) NOT NULL,
  `ic_dob` varchar(30) NOT NULL,
  `ic_gender` int(11) NOT NULL,
  `ic_address` text NOT NULL,
  `ic_cid` varchar(30) NOT NULL,
  `ic_card_issuer` text NOT NULL,
  `ic_issue_date` varchar(30) NOT NULL,
  `ic_expire_date` varchar(30) NOT NULL,
  PRIMARY KEY (`ic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_cloud_esign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cloud_esign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(200) NOT NULL,
  `user_fullname` varchar(200) NOT NULL,
  `hospital_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_data2server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_data2server` (
  `data` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_datamastercheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_datamastercheck` (
  `comname` varchar(30) NOT NULL,
  `tablename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_demoqueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_demoqueue` (
  `queue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `queue_hn` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_fullname` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_status` char(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_datetime` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`queue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `department_user` text NOT NULL,
  `department_procedure` text NOT NULL,
  `department_room` text NOT NULL,
  `department_scope` text NOT NULL,
  `department_json` varchar(1000) NOT NULL DEFAULT '{}',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_diagnostic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_diagnostic` (
  `diagnostic_id` int(2) NOT NULL AUTO_INCREMENT,
  `diagnostic_group` varchar(50) DEFAULT NULL,
  `diagnostic_name` varchar(100) DEFAULT NULL,
  `procedure_code` varchar(10) DEFAULT NULL,
  `icd10` varchar(4) DEFAULT NULL,
  `icd10_index` varchar(10) DEFAULT NULL,
  `icd10_status` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`diagnostic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_doctor_calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_doctor_calendar` (
  `dc_id` int(11) NOT NULL AUTO_INCREMENT,
  `dc_doctor_id` int(11) NOT NULL,
  `dc_date` date NOT NULL,
  `dc_in` int(11) NOT NULL DEFAULT '0',
  `dc_out` int(11) NOT NULL DEFAULT '0',
  `dc_status` varchar(10) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`dc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_endosmart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_endosmart` (
  `CASE_ID` bigint(20) DEFAULT NULL,
  `CASE_REGIS_DATE` datetime DEFAULT NULL,
  `CASE_REGIS_TIME` datetime DEFAULT NULL,
  `REGIS_USER` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `REGIS_MECHINE` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `REGIS_USER_TIME` datetime DEFAULT NULL,
  `HN_ID` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `AN_ID` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `ACCESSION_NO` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `SENDING_COUNT` int(11) DEFAULT NULL,
  `PT_PREFIX` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `PT_NAME` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `PT_MIDDLE` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `PT_SURNAME` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `BIRTHDAY` datetime DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `AGE_M` int(11) DEFAULT NULL,
  `AGE_D` int(11) DEFAULT NULL,
  `SEX` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `NATION` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `REFER_NAME` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `CASE_APPOINT_DATE` datetime DEFAULT NULL,
  `CASE_APPOINT_TIME` datetime DEFAULT NULL,
  `CASE_TYPE` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `SUB_CASE_TYPE` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `ROOM` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `PT_STATUS` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `FINANCE_TYPE` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `PT_TYPE` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `PT_CHARGE` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `EXP_ST` tinyint(4) DEFAULT NULL,
  `ERP_ST` tinyint(4) DEFAULT NULL,
  `OPD_ST` tinyint(4) DEFAULT NULL,
  `WARD_ST` tinyint(4) DEFAULT NULL,
  `REFER_ST` tinyint(4) DEFAULT NULL,
  `DIS_ST` tinyint(4) DEFAULT NULL,
  `NOR_ST` tinyint(4) DEFAULT NULL,
  `PREDIAGNOSIS` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `PREDIAGNOSIS2` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `POSTDIAGNOSIS` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `WARD_NAME` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `OPD_NAME` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `CANCEL_REASON` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `DOCTOR_1` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `DOCTOR_1A` varchar(128) DEFAULT NULL,
  `DOCTOR_2` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `NURSE_1` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `NURSE_2` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `STAFF_1` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `STAFF_2` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `ISM_MODEL` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `ISM_SERIAL` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `CASE_START_DATE` datetime DEFAULT NULL,
  `CASE_FINISH_DATE` datetime DEFAULT NULL,
  `CASE_START_TIME` datetime DEFAULT NULL,
  `CASE_FINISH_TIME` datetime DEFAULT NULL,
  `COST_AMOUNT` int(11) DEFAULT NULL,
  `ANESTHESIA` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `ANESTHESIST` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `INDICATION` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `RAPID_TEST` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `RAPID_RESULT` varchar(10) DEFAULT NULL,
  `PATHOLOGY_TEST` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `DATA_FOLDER` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `CONTACT_PHONE` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `RAPID_STATUS` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `PACS_ST` tinyint(4) DEFAULT NULL,
  `EN_OPT` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `VISIT_DATE_OPT` datetime DEFAULT NULL,
  `LOCATION_OPT` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `DOCTOR_OPT` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `ALLERGY_OPT` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `ANESTHESIOLOGIST` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `idd` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_hisconnect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_hisconnect` (
  `his_id` int(11) NOT NULL AUTO_INCREMENT,
  `his_hn` varchar(30) NOT NULL,
  `his_date` date NOT NULL,
  `his_json` text NOT NULL,
  `his_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`his_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_hisfindtext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_hisfindtext` (
  `hisfindtext_id` int(11) NOT NULL AUTO_INCREMENT,
  `hisfindtext_find` varchar(100) NOT NULL,
  `hisfindtext_return` varchar(100) NOT NULL,
  PRIMARY KEY (`hisfindtext_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_holiday` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_user_id` int(11) NOT NULL,
  `holiday_tittle` varchar(250) NOT NULL,
  `holiday_detail` text,
  `holiday_day_off` date NOT NULL,
  `holiday_date_create` datetime NOT NULL,
  `holiday_status` varchar(25) NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_icd9incase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_icd9incase` (
  `icd9c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icd9c_caseid` int(11) NOT NULL,
  `icd9c_name` char(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icd9c_value` int(11) NOT NULL,
  PRIMARY KEY (`icd9c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_logedit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_logedit` (
  `edit_id` int(11) NOT NULL AUTO_INCREMENT,
  `edit_userid` int(11) NOT NULL,
  `edit_event` varchar(50) NOT NULL,
  `edit_remark` varchar(1000) NOT NULL,
  `edit_json` text NOT NULL,
  `edit_status` int(11) NOT NULL,
  PRIMARY KEY (`edit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_logindata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_logindata` (
  `logindata_id` int(11) NOT NULL AUTO_INCREMENT,
  `logindata_user_id` int(11) NOT NULL,
  `logindata_login_time` datetime NOT NULL,
  `logindata_logout_time` datetime DEFAULT NULL,
  `logindata_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`logindata_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_mainpart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mainpart` (
  `mainpart_id` int(11) NOT NULL AUTO_INCREMENT,
  `mainpart_name` varchar(100) NOT NULL,
  `mainpart_procedure_code` varchar(10) NOT NULL,
  PRIMARY KEY (`mainpart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_mainpartsub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mainpartsub` (
  `mainpartsub_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'aaaa',
  `mainpartsub_name` varchar(100) NOT NULL COMMENT 'bbb',
  `mainpartsub_mp_id` int(11) NOT NULL COMMENT 'ccc',
  `mainpartsub_icd10` varchar(200) NOT NULL DEFAULT '[]',
  `mainpartsub_sort` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`mainpartsub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_mainproblem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mainproblem` (
  `mainproblem_id` int(11) NOT NULL AUTO_INCREMENT,
  `mainproblem_name` varchar(100) NOT NULL,
  `mainproblem_mp_id` int(11) NOT NULL,
  PRIMARY KEY (`mainproblem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_mainsubgl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mainsubgl` (
  `mainsubgl_id` int(11) NOT NULL AUTO_INCREMENT,
  `mainsubgl_name` varchar(100) NOT NULL,
  `mainsubgl_mp_id` int(11) NOT NULL,
  PRIMARY KEY (`mainsubgl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_ordataicd10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_ordataicd10` (
  `code` varchar(10) NOT NULL,
  `codeseq` varchar(5) NOT NULL,
  `descript` varchar(500) NOT NULL,
  `gen_desc` varchar(500) NOT NULL,
  `acc_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_ordataicd9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_ordataicd9` (
  `code` varchar(10) NOT NULL,
  `codeseq` varchar(5) NOT NULL,
  `descript` varchar(500) NOT NULL,
  `gen_desc` varchar(500) NOT NULL,
  `acc_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_procedure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_procedure` (
  `procedure_id` int(11) NOT NULL AUTO_INCREMENT,
  `procedure_code` varchar(10) NOT NULL,
  `procedure_name` varchar(100) NOT NULL,
  `procedure_scope` varchar(100) NOT NULL,
  `procedure_pic` varchar(100) NOT NULL,
  `procedure_color` varchar(50) NOT NULL,
  `procedure_json` text NOT NULL,
  `procedure_findding` varchar(30) DEFAULT NULL,
  `case_recordshow` text NOT NULL,
  `procedure_pdfshow` text NOT NULL,
  `procedure_pdfshownew` text,
  PRIMARY KEY (`procedure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_procedure_pdf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_procedure_pdf` (
  `pdf_id` int(11) NOT NULL AUTO_INCREMENT,
  `pdf_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `pdf_file` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pdf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_procedure_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_procedure_set` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sp_file` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_procedure_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_procedure_sub` (
  `psub_id` int(11) NOT NULL AUTO_INCREMENT,
  `psub_name` varchar(100) NOT NULL,
  `psub_procedure_id` int(11) NOT NULL,
  PRIMARY KEY (`psub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_procedureicd9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_procedureicd9` (
  `proicd9_id` int(2) NOT NULL AUTO_INCREMENT,
  `icd9` int(5) DEFAULT NULL,
  `icd9_billname` varchar(200) DEFAULT NULL,
  `icd9_billprice` int(7) DEFAULT NULL,
  `icd9_group` varchar(100) DEFAULT NULL,
  `proicd9_name` varchar(100) DEFAULT NULL,
  `extra` int(1) DEFAULT NULL,
  `extra_text` varchar(10) DEFAULT NULL,
  `procedure_code` varchar(10) DEFAULT NULL,
  `icd9_json` varchar(1000) DEFAULT NULL,
  `icd9_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`proicd9_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_queue` (
  `q_id` int(15) NOT NULL AUTO_INCREMENT,
  `q_users` int(10) NOT NULL DEFAULT '0',
  `q_department` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `q_qrcode` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `q_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `q_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `q_hn` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `q_tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `q_datetime` date DEFAULT NULL,
  `q_start` datetime DEFAULT NULL,
  `q_call` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `q_json` text COLLATE utf8_unicode_ci,
  `q_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '''''''''''''',
  `q_statustext` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `q_skip` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`q_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_queuecall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_queuecall` (
  `queuecall_number` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'หมายเลขคิว',
  `queuecall_station` int(10) NOT NULL COMMENT 'ตำแหน่งที่เรียก',
  `queuecall_sound` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'เสียงแบบ Array',
  `queuecall_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_queuecallcurrent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_queuecallcurrent` (
  `callcurrent_id` int(11) NOT NULL AUTO_INCREMENT,
  `callcurrent_qtype` varchar(10) NOT NULL,
  `callcurrent_number` varchar(10) NOT NULL,
  `callcurrent_date` varchar(20) NOT NULL,
  `callcurrent_time` varchar(15) NOT NULL,
  `callcurrent_station` varchar(100) NOT NULL,
  `callcurrent_status` varchar(30) NOT NULL,
  PRIMARY KEY (`callcurrent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_queuetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_queuetype` (
  `qtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `qtype_name` varchar(100) NOT NULL,
  `qtype_textpatient` varchar(100) NOT NULL,
  `qtype_prefix` varchar(2) NOT NULL,
  `qtype_code` varchar(10) NOT NULL,
  `qtype_nextstep` varchar(10) NOT NULL,
  `qtype_operation` varchar(20) NOT NULL DEFAULT '',
  `qtype_department` int(11) NOT NULL,
  `qtype_html` varchar(200) NOT NULL,
  `qtype_skip` varchar(200) NOT NULL DEFAULT '',
  `qtype_link` varchar(200) NOT NULL,
  `qtype_statustext` varchar(100) NOT NULL,
  PRIMARY KEY (`qtype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_recorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_recorder` (
  `recorder_id` int(11) NOT NULL AUTO_INCREMENT,
  `recorder_json` text NOT NULL,
  `recorder_date` varchar(20) NOT NULL DEFAULT '',
  `recorder_status` varchar(20) NOT NULL DEFAULT 'start',
  PRIMARY KEY (`recorder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_cid` int(11) NOT NULL,
  `caseuniq` bigint(13) NOT NULL,
  `updatetime` bigint(13) NOT NULL,
  `comcreate` varchar(30) DEFAULT NULL,
  `report_hn` varchar(100) NOT NULL DEFAULT '',
  `report_patientname` varchar(200) NOT NULL DEFAULT '',
  `report_age` int(3) NOT NULL DEFAULT '0',
  `report_gender` varchar(10) DEFAULT NULL,
  `report_citizen` varchar(20) DEFAULT NULL,
  `report_allergic` varchar(200) DEFAULT NULL,
  `report_contact` varchar(20) DEFAULT NULL,
  `report_conginital_disease` varchar(200) DEFAULT NULL,
  `report_right2treatment` varchar(100) DEFAULT NULL,
  `report_appointment_date` date DEFAULT NULL,
  `report_appointment_year` varchar(4) DEFAULT NULL,
  `report_appointment_month` varchar(2) NOT NULL,
  `report_appointment_day` varchar(2) NOT NULL,
  `report_appointment_time` varchar(15) NOT NULL,
  `report_procedure` varchar(100) DEFAULT NULL,
  `report_endoscopist` varchar(150) DEFAULT NULL,
  `report_doctorconsult01` varchar(150) DEFAULT NULL,
  `report_doctorconsult02` varchar(150) DEFAULT NULL,
  `report_doctorconsult03` varchar(150) DEFAULT NULL,
  `report_nurse01` varchar(150) DEFAULT NULL,
  `report_nurse02` varchar(150) DEFAULT NULL,
  `report_nurse03` varchar(150) DEFAULT NULL,
  `report_nurse04` varchar(150) DEFAULT NULL,
  `report_scope` varchar(200) DEFAULT NULL,
  `report_room` varchar(100) DEFAULT NULL,
  `report_ward` varchar(100) DEFAULT NULL,
  `report_opd` varchar(100) DEFAULT NULL,
  `report_refer` varchar(100) DEFAULT NULL,
  `report_briefhistory` varchar(500) DEFAULT NULL,
  `report_prediagnosis` varchar(500) DEFAULT NULL,
  `report_anesthesia` varchar(500) DEFAULT NULL,
  `report_medication` varchar(500) DEFAULT NULL,
  `report_finding` text,
  `report_overallfinding` varchar(500) DEFAULT NULL,
  `report_diagnostic` varchar(600) DEFAULT NULL,
  `report_diagnostic_primary` varchar(200) DEFAULT NULL,
  `report_diagnostic_secondary` varchar(200) DEFAULT NULL,
  `report_diagnostic_other01` varchar(200) DEFAULT NULL,
  `report_diagnostic_other02` varchar(200) DEFAULT NULL,
  `report_diagnostic_other03` varchar(200) DEFAULT NULL,
  `report_diagnostic_freetext` varchar(500) DEFAULT NULL,
  `report_icd10code` varchar(500) DEFAULT NULL,
  `report_procedure_icd9` varchar(2000) DEFAULT NULL,
  `report_procedure_primary` varchar(200) DEFAULT NULL,
  `report_procedure_secondary` varchar(200) DEFAULT NULL,
  `report_procedure_other01` varchar(200) DEFAULT NULL,
  `report_procedure_other02` varchar(200) DEFAULT NULL,
  `report_procedure_other03` varchar(200) DEFAULT NULL,
  `report_icd9code` varchar(500) DEFAULT NULL,
  `report_complication` varchar(500) DEFAULT NULL,
  `report_histopathology` varchar(500) DEFAULT NULL,
  `report_recommendation` varchar(500) DEFAULT NULL,
  `report_comment` varchar(500) DEFAULT NULL,
  `report_type_of_case` varchar(250) DEFAULT '',
  `report_bowel` varchar(30) DEFAULT '',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_department` varchar(30) DEFAULT NULL,
  `room_type` varchar(30) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_storage` int(11) NOT NULL DEFAULT '0',
  `room_color` varchar(10) DEFAULT NULL,
  `room_ready` int(11) NOT NULL,
  `room_doctor` varchar(1000) DEFAULT NULL,
  `room_nurse` varchar(1000) DEFAULT NULL,
  `room_register` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope` (
  `scope_id` int(11) NOT NULL AUTO_INCREMENT,
  `scope_rfid` varchar(30) DEFAULT NULL,
  `scope_name` varchar(200) NOT NULL,
  `scope_band` varchar(200) NOT NULL,
  `scope_model` varchar(200) NOT NULL,
  `scope_serial` varchar(200) NOT NULL,
  `scope_installdate` varchar(200) DEFAULT NULL,
  `scope_top` int(11) DEFAULT NULL,
  `scope_bottom` int(11) DEFAULT NULL,
  `scope_left` int(11) DEFAULT NULL,
  `scope_right` int(11) DEFAULT NULL,
  `scope_comment` varchar(300) DEFAULT NULL,
  `scope_status` varchar(20) DEFAULT '0',
  `scope_autocrop` int(11) DEFAULT NULL,
  `scope_type` varchar(100) DEFAULT NULL,
  `scope_working_channel` varchar(20) DEFAULT NULL,
  `scope_distal_end_diameter` varchar(20) DEFAULT NULL,
  `scope_selling_price` varchar(20) DEFAULT NULL,
  `scope_warranty_year` varchar(20) DEFAULT NULL,
  `scope_contract_warrantee_start` varchar(20) DEFAULT NULL,
  `scope_contract_warrantee_end` varchar(20) DEFAULT NULL,
  `scope_sale_name` varchar(60) DEFAULT NULL,
  `scope_sale_tel` varchar(20) DEFAULT NULL,
  `scope_service_name` varchar(60) DEFAULT NULL,
  `scope_service_tel` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_manage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_manage` (
  `manage_id` int(11) NOT NULL AUTO_INCREMENT,
  `manage_model` varchar(50) NOT NULL,
  `manage_serial` varchar(50) NOT NULL,
  `manage_pm_date` varchar(30) NOT NULL,
  `manage_pm_result` varchar(60) NOT NULL,
  `manage_main_phenomenon_pm` varchar(60) NOT NULL,
  `manage_result_detail_pm` varchar(60) NOT NULL,
  `manage_broken_date` varchar(60) NOT NULL,
  `manage_main_phenomenon_repair` varchar(60) NOT NULL,
  `manage_bringback_date` varchar(60) NOT NULL,
  `manage_repair_price` varchar(60) NOT NULL,
  `manage_return_date` varchar(60) NOT NULL,
  `manage_repair_status` varchar(60) NOT NULL,
  `manage_training_date` varchar(60) NOT NULL,
  `manage_training_topic` varchar(60) NOT NULL,
  `manage_trainee_volumn` varchar(60) NOT NULL,
  `manage_trainer_name` varchar(60) NOT NULL,
  `manage_trainer_tel` varchar(20) NOT NULL,
  PRIMARY KEY (`manage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_pm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_pm` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_scope_serial_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `sp_pm_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_pm_next_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_pm_result` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_result_detail_pm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_ma_users` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_pm_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_pm_temp` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_scope_serial_number` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_pm_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_pm_next_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_pm_result` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_result_detail_pm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_ma_users` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_repair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_repair` (
  `sr_id` int(11) NOT NULL AUTO_INCREMENT,
  `sr_scope_serial_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `sr_broken_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_main_phenomenon_repair` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_repair_analyze` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_bringback_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_repair_price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_return_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_repair_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`sr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_repair_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_repair_temp` (
  `sr_id` int(11) NOT NULL AUTO_INCREMENT,
  `sr_scope_serial_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_broken_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_main_phenomenon_repair` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_repair_analyze` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_bringback_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_repair_price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_return_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sr_repair_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`sr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_temp` (
  `scope_id` int(11) NOT NULL AUTO_INCREMENT,
  `scope_rfid` varchar(30) DEFAULT NULL,
  `scope_name` varchar(200) DEFAULT NULL,
  `scope_band` varchar(200) DEFAULT NULL,
  `scope_model` varchar(200) DEFAULT NULL,
  `scope_serial` varchar(200) DEFAULT NULL,
  `scope_installdate` varchar(200) DEFAULT NULL,
  `scope_top` int(11) DEFAULT NULL,
  `scope_bottom` int(11) DEFAULT NULL,
  `scope_left` int(11) DEFAULT NULL,
  `scope_right` int(11) DEFAULT NULL,
  `scope_comment` varchar(300) DEFAULT NULL,
  `scope_status` int(11) DEFAULT '0',
  `scope_autocrop` int(11) DEFAULT NULL,
  `scope_type` varchar(100) DEFAULT NULL,
  `scope_working_channel` varchar(20) DEFAULT NULL,
  `scope_distal_end_diameter` varchar(20) DEFAULT NULL,
  `scope_selling_price` varchar(20) DEFAULT NULL,
  `scope_warranty_year` varchar(20) DEFAULT NULL,
  `scope_contract_warrantee_start` varchar(20) DEFAULT NULL,
  `scope_contract_warrantee_end` varchar(20) DEFAULT NULL,
  `scope_sale_name` varchar(60) DEFAULT NULL,
  `scope_sale_tel` varchar(20) DEFAULT NULL,
  `scope_service_name` varchar(60) DEFAULT NULL,
  `scope_service_tel` varchar(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`scope_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_training` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_scope_serial_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `st_training_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_next_training_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_training_topic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_training_trainee` text COLLATE utf8_unicode_ci,
  `st_trainer_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_trainer_tel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_scope_training_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_scope_training_temp` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_scope_serial_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_training_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_next_training_date` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_training_topic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_trainer_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `st_trainer_tel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_send2cloud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_send2cloud` (
  `send2cloud_id` int(11) NOT NULL AUTO_INCREMENT,
  `send2cloud_system` varchar(50) NOT NULL,
  `send2cloud_date` varchar(30) NOT NULL,
  `send2cloud_json` varchar(1000) NOT NULL,
  `send2cloud_status` varchar(10) NOT NULL DEFAULT 'false',
  PRIMARY KEY (`send2cloud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_therapeutic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_therapeutic` (
  `therapeutic_id` int(11) NOT NULL AUTO_INCREMENT,
  `therapeutic_name` varchar(200) NOT NULL,
  PRIMARY KEY (`therapeutic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_upload_dicom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_upload_dicom` (
  `ud_id` int(11) NOT NULL AUTO_INCREMENT,
  `ud_fname` varchar(200) NOT NULL,
  `ud_hn` varchar(15) NOT NULL,
  `ud_name` varchar(200) NOT NULL,
  `ud_dob` date NOT NULL,
  `ud_institute` varchar(150) NOT NULL DEFAULT '',
  `ud_status` smallint(6) NOT NULL DEFAULT '0',
  KEY `Primary Key` (`ud_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tb_upload_other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_upload_other` (
  `uo_id` int(11) NOT NULL AUTO_INCREMENT,
  `uo_fname` varchar(200) NOT NULL,
  `uo_hn` varchar(15) NOT NULL,
  `uo_name` varchar(200) NOT NULL,
  `uo_dob` date NOT NULL,
  `uo_gender` smallint(6) NOT NULL,
  `uo_studydate` varchar(100) NOT NULL,
  `uo_status` smallint(6) NOT NULL DEFAULT '0',
  KEY `Primary Key` (`uo_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_code` varchar(20) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL,
  `user_branch` varchar(20) NOT NULL DEFAULT '',
  `practical` varchar(50) DEFAULT NULL,
  `color` varchar(10) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `user_rfid` varchar(30) DEFAULT NULL,
  `user_prefix` varchar(100) DEFAULT NULL,
  `user_firstname` varchar(100) DEFAULT NULL,
  `user_lastname` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_config` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` varchar(50) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `opencase` int(11) NOT NULL,
  `procedure_json` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` VALUES (1,'2020_04_12_042240_add_nurse_dd_room_table',1);
INSERT INTO `migrations` VALUES (2,'2020_04_12_042240_add_scope_table',1);
INSERT INTO `migrations` VALUES (3,'2020_04_12_043008_add_ready_tb_case_table',1);
INSERT INTO `migrations` VALUES (4,'2020_05_25_145835_add_dateopen_roomsort_tb_case',2);
INSERT INTO `migrations` VALUES (5,'2020_06_02_033509_add_vip_patient',3);
INSERT INTO `migrations` VALUES (6,'2020_07_02_222552_tb_icd9incase',4);
INSERT INTO `migrations` VALUES (7,'2020_07_31_030009_add_datemeet_nurse04_tb_case',5);
INSERT INTO `migrations` VALUES (8,'2020_08_18_125055_create_tb_demoqueue',6);
INSERT INTO `migrations` VALUES (10,'2020_08_27_060925_add_procedure_json_tb_procedure',8);
INSERT INTO `migrations` VALUES (11,'2020_08_27_084222_add_icd9_json',9);
INSERT INTO `migrations` VALUES (12,'2020_08_27_172516_add_compay_procedure',10);
INSERT INTO `migrations` VALUES (13,'2020_08_29_121303_add_accessory_sale',11);
