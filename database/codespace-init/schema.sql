
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
DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `classId` int(10) NOT NULL AUTO_INCREMENT,
  `className` varchar(20) NOT NULL,
  `thumbnail` text DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`classId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `contactId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`contactId`)
) ENGINE=InnoDB AUTO_INCREMENT=371 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `couponenrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `couponenrolls` (
  `ceId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cpId` bigint(20) NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `usedFor` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = COURSE, 2 = TEST, 3 = TEST SERIES',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ceId`),
  KEY `CouponEnrollCouponRel1` (`cpId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `cpId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cpName` varchar(255) NOT NULL,
  `cpCode` varchar(255) NOT NULL,
  `cpDiscount` smallint(5) NOT NULL,
  `cpLimit` smallint(5) NOT NULL DEFAULT 1,
  `cpFor` smallint(5) NOT NULL DEFAULT 1 COMMENT '1 = All\r\n2 = Course\r\n3 = Test\r\n4 = Test Series',
  `cpUsed` int(10) NOT NULL DEFAULT 0,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` bigint(20) unsigned NOT NULL,
  `cpStatus` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cpId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `courseenrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courseenrolls` (
  `enrollId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseId` bigint(20) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`enrollId`),
  KEY `courseId` (`courseId`),
  KEY `userId` (`userId`),
  CONSTRAINT `courseenroll` FOREIGN KEY (`courseId`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studentenroll` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `courseId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseTitle` text NOT NULL,
  `courseURI` varchar(255) DEFAULT NULL,
  `courseSubject` int(10) NOT NULL,
  `courseClass` int(10) NOT NULL,
  `courseCode` varchar(20) NOT NULL,
  `courseInstructor1` bigint(20) unsigned NOT NULL,
  `courseInstructor2` bigint(20) unsigned DEFAULT NULL,
  `coursePrice` int(10) DEFAULT NULL,
  `courseValidity` smallint(5) DEFAULT NULL,
  `courseStartDate` datetime NOT NULL DEFAULT current_timestamp(),
  `courseEndDate` datetime DEFAULT NULL,
  `courseAviablity` tinyint(1) NOT NULL DEFAULT 0,
  `courseDescription` text NOT NULL,
  `courseThumbnail` text NOT NULL,
  `courseStatus` varchar(10) NOT NULL DEFAULT 'Pending',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `students` int(10) unsigned DEFAULT 0,
  `courseMetaKey` text DEFAULT NULL,
  `courseMetaDesc` text DEFAULT NULL,
  PRIMARY KEY (`courseId`),
  KEY `courseSubject` (`courseSubject`),
  KEY `courseClass` (`courseClass`),
  KEY `courseInstructor1` (`courseInstructor1`),
  KEY `courseInstructor2` (`courseInstructor2`),
  CONSTRAINT `classes` FOREIGN KEY (`courseClass`) REFERENCES `classes` (`classId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `instructor1` FOREIGN KEY (`courseInstructor1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `instructor2` FOREIGN KEY (`courseInstructor2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `subject` FOREIGN KEY (`courseSubject`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `doubtanswers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doubtanswers` (
  `daId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doubtId` bigint(20) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `daContent` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`daId`),
  KEY `darel1` (`doubtId`),
  KEY `darel2` (`userId`),
  CONSTRAINT `darel1` FOREIGN KEY (`doubtId`) REFERENCES `doubts` (`doubtId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `darel2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `doubtreplys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doubtreplys` (
  `drId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doubtId` bigint(20) unsigned NOT NULL,
  `daId` bigint(20) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `drContent` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`drId`),
  KEY `drrel1` (`daId`),
  KEY `drrel2` (`doubtId`),
  KEY `darel3` (`userId`),
  CONSTRAINT `darel3` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drrel1` FOREIGN KEY (`daId`) REFERENCES `doubtanswers` (`daId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drrel2` FOREIGN KEY (`doubtId`) REFERENCES `doubts` (`doubtId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `doubts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doubts` (
  `doubtId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) unsigned NOT NULL,
  `subjectId` int(10) NOT NULL,
  `classId` int(10) NOT NULL,
  `doubtContent` text DEFAULT NULL,
  `doubtImage` text DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL,
  `answers` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`doubtId`),
  KEY `dbrel1` (`userId`),
  KEY `dbrel2` (`subjectId`),
  KEY `dbrel3` (`classId`),
  CONSTRAINT `dbrel1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dbrel2` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dbrel3` FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `exam_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_answers` (
  `eaId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resultId` bigint(20) NOT NULL,
  `testId` int(10) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `examSectionId` int(10) NOT NULL,
  `questionId` int(10) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL DEFAULT '0',
  `remarks` varchar(20) NOT NULL,
  `marks` decimal(10,2) NOT NULL,
  `neg_marks` decimal(10,2) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`eaId`)
) ENGINE=InnoDB AUTO_INCREMENT=43756 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `instructions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructions` (
  `inId` int(10) NOT NULL AUTO_INCREMENT,
  `inTitle` text NOT NULL,
  `inDescription` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`inId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `lecturequestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lecturequestions` (
  `lqId` bigint(20) NOT NULL AUTO_INCREMENT,
  `lId` int(10) NOT NULL,
  `qId` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`lqId`),
  KEY `lectuyrequestrions` (`qId`),
  CONSTRAINT `lectuyrequestrions` FOREIGN KEY (`qId`) REFERENCES `questionbanks` (`qwId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `lectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lectures` (
  `lectureId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseId` bigint(20) unsigned NOT NULL,
  `weekId` bigint(20) unsigned NOT NULL,
  `lectureTitle` text NOT NULL,
  `lectureType` tinyint(4) NOT NULL DEFAULT 0,
  `lectureVideo` varchar(20) DEFAULT NULL,
  `lectureContent` text DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`lectureId`),
  KEY `courseId` (`courseId`),
  KEY `weekId` (`weekId`),
  CONSTRAINT `courses` FOREIGN KEY (`courseId`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `week` FOREIGN KEY (`weekId`) REFERENCES `weeks` (`weekId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `paragraphs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paragraphs` (
  `prgId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qbId` int(10) unsigned NOT NULL,
  `pqbId` int(10) unsigned NOT NULL,
  `qtId` int(10) unsigned NOT NULL,
  `pqtId` int(10) unsigned NOT NULL,
  `qlId` int(10) unsigned NOT NULL,
  `prgContent` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`prgId`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `purchasecourses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchasecourses` (
  `pcId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseId` bigint(20) unsigned NOT NULL,
  `userId` bigint(255) unsigned NOT NULL,
  `couponCode` varchar(50) DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `paymentId` varchar(255) DEFAULT NULL,
  `paymentStatus` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = PENDING, 1= SUCCESS',
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pcId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `purchasetests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchasetests` (
  `pcId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `testId` int(10) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `couponCode` varchar(50) DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `paymentId` varchar(255) DEFAULT NULL,
  `paymentStatus` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = PENDING, 1= SUCCESS	',
  `paymentType` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Individual, 1 = With Test Series',
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pcId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `purchasetestseries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchasetestseries` (
  `pcId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tcId` int(10) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `couponCode` varchar(50) DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `paymentId` varchar(255) DEFAULT NULL,
  `paymentStatus` tinyint(4) NOT NULL DEFAULT 0,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`pcId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `qbanks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qbanks` (
  `qbId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentQbId` int(10) unsigned DEFAULT NULL,
  `qbName` varchar(255) NOT NULL,
  `qbCreatedBy` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qbStatus` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`qbId`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `qlessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlessions` (
  `qlId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qbId` int(10) unsigned NOT NULL,
  `parentQbId` int(10) unsigned NOT NULL,
  `qtId` int(10) unsigned NOT NULL,
  `parentQtId` int(10) unsigned NOT NULL,
  `qlName` varchar(255) NOT NULL,
  `qlCreatedBy` bigint(20) unsigned NOT NULL,
  `qlStatus` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`qlId`)
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `qparas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qparas` (
  `qpId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `qbId` int(10) unsigned DEFAULT NULL,
  `pqbId` int(10) unsigned DEFAULT NULL,
  `qtId` int(10) unsigned DEFAULT NULL,
  `pqtId` int(10) unsigned DEFAULT NULL,
  `qlId` int(10) unsigned DEFAULT NULL,
  `qpPara` text NOT NULL,
  `qpCreattedBy` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`qpId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `qtopics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qtopics` (
  `qtId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentQtId` int(10) unsigned DEFAULT NULL,
  `qbId` int(10) unsigned NOT NULL,
  `parentQbId` int(10) unsigned DEFAULT NULL,
  `qtName` varchar(255) NOT NULL,
  `qtCreatedBy` bigint(20) unsigned NOT NULL,
  `qtStatus` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`qtId`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `questionbanks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionbanks` (
  `qwId` int(10) NOT NULL AUTO_INCREMENT,
  `qbId` int(10) unsigned NOT NULL,
  `pqbId` int(10) unsigned NOT NULL,
  `qtId` int(10) unsigned NOT NULL,
  `pqtId` int(10) unsigned NOT NULL,
  `qlId` int(10) unsigned NOT NULL,
  `paragraphId` bigint(20) DEFAULT 0,
  `qwType` varchar(30) NOT NULL DEFAULT 'radio',
  `qwTitle` text NOT NULL,
  `totalOptions` int(10) DEFAULT NULL,
  `qwOptions` text DEFAULT NULL,
  `qwCorrectAnswer` text NOT NULL,
  `qwMinRange` decimal(10,4) DEFAULT NULL,
  `qwMaxRange` decimal(10,4) DEFAULT NULL,
  `qwLevel` enum('easy','midium','hard') NOT NULL,
  `qwHint` text DEFAULT NULL,
  `qwStatus` tinyint(4) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `qwCreatedBy` bigint(20) NOT NULL DEFAULT 21,
  PRIMARY KEY (`qwId`)
) ENGINE=InnoDB AUTO_INCREMENT=10265 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `questionreports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionreports` (
  `rpId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `testId` int(10) unsigned NOT NULL,
  `questionId` int(10) NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `rpContent` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rpId`),
  KEY `reportTest` (`testId`),
  KEY `reportQuestionRel` (`questionId`),
  KEY `reportUserRel` (`userId`),
  CONSTRAINT `reportQuestionRel` FOREIGN KEY (`questionId`) REFERENCES `questionbanks` (`qwId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reportTest` FOREIGN KEY (`testId`) REFERENCES `tests` (`tId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reportUserRel` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `qnId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `qbId` int(10) unsigned NOT NULL,
  `pqbId` int(10) unsigned NOT NULL,
  `qtId` int(10) unsigned DEFAULT NULL,
  `pqtId` int(10) unsigned DEFAULT NULL,
  `qlId` int(10) unsigned NOT NULL,
  `paragraphId` bigint(20) unsigned DEFAULT 0,
  `qnTitle` text NOT NULL,
  `qnTotalOptions` smallint(5) unsigned DEFAULT NULL,
  `qnOptions` text DEFAULT NULL,
  `qnCorrectAnswer` varchar(50) NOT NULL,
  `qnHint` text DEFAULT NULL,
  `qnType` varchar(30) NOT NULL,
  `qnLavel` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qnCreatedBy` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`qnId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `questiontags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questiontags` (
  `qtId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qtName` text NOT NULL,
  `qtTotalQuestions` int(10) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`qtId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `resultId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `examId` int(10) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `correct_ans` int(10) NOT NULL DEFAULT 0,
  `wrong_ans` int(10) NOT NULL DEFAULT 0,
  `correct_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `wrong_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `final_marks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `time_taken` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `attempts` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`resultId`),
  KEY `examId` (`examId`),
  KEY `userId` (`userId`),
  CONSTRAINT `results_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `results_ibfk_2` FOREIGN KEY (`examId`) REFERENCES `tests` (`tId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1454 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `subjectanalysis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjectanalysis` (
  `saId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resultId` bigint(20) unsigned NOT NULL,
  `tsecId` int(10) unsigned NOT NULL,
  `total_marks` decimal(10,0) NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `right_marks` decimal(10,2) NOT NULL,
  `wrong_marks` decimal(10,2) NOT NULL,
  `your_marks` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`saId`),
  KEY `resultSubjectAnaRel` (`resultId`),
  KEY `userResultAnalRel` (`userId`),
  KEY `secAnalRel` (`tsecId`),
  CONSTRAINT `resultSubjectAnaRel` FOREIGN KEY (`resultId`) REFERENCES `results` (`resultId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `secAnalRel` FOREIGN KEY (`tsecId`) REFERENCES `testsections` (`tsecId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userResultAnalRel` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1929 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `subjectId` int(10) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(50) NOT NULL,
  `thumbnail` text NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`subjectId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `subjecttopics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjecttopics` (
  `stId` int(10) NOT NULL AUTO_INCREMENT,
  `subjectId` int(10) NOT NULL,
  `stName` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`stId`),
  KEY `subjectId` (`subjectId`),
  CONSTRAINT `subjectTopicresstopic` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `testcatogeries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testcatogeries` (
  `tcId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tcName` varchar(100) NOT NULL,
  `tcKeywords` text DEFAULT NULL,
  `tcMetaDesc` text DEFAULT NULL,
  `tcDescription` text DEFAULT NULL,
  `tcStatus` tinyint(2) DEFAULT 1,
  `noOfTests` int(10) NOT NULL DEFAULT 0,
  `tcType` tinyint(4) DEFAULT 0,
  `tcPrice` int(10) DEFAULT NULL,
  `tcValidity` smallint(5) DEFAULT NULL,
  `tcClass` int(10) DEFAULT NULL,
  `tcStartDate` datetime DEFAULT NULL,
  `tcEndDate` datetime DEFAULT NULL,
  `tcImage` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) unsigned NOT NULL DEFAULT 21,
  `isPopular` tinyint(4) NOT NULL DEFAULT 0,
  `enrolls` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`tcId`),
  KEY `tcClass` (`tcClass`),
  CONSTRAINT `tccls` FOREIGN KEY (`tcClass`) REFERENCES `classes` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `testenrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testenrolls` (
  `tenId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `testId` int(10) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `enrollType` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Individual, 1 = With TestSeries',
  `expires_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tenId`),
  KEY `testId` (`testId`),
  KEY `userId` (`userId`),
  CONSTRAINT `testen` FOREIGN KEY (`testId`) REFERENCES `tests` (`tId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usertest` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1608 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `testquestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testquestions` (
  `tqId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `testId` int(10) unsigned NOT NULL,
  `tsecId` int(10) unsigned NOT NULL,
  `questionId` int(10) unsigned NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tqId`),
  KEY `tsecIdRel` (`tsecId`),
  CONSTRAINT `tsecIdRel` FOREIGN KEY (`tsecId`) REFERENCES `testsections` (`tsecId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4086 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests` (
  `tId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tName` varchar(100) NOT NULL,
  `tURI` varchar(255) DEFAULT NULL,
  `tClass` int(10) NOT NULL,
  `tSubject` int(10) NOT NULL,
  `ipId` int(10) NOT NULL,
  `duration` int(11) NOT NULL,
  `is_paid` tinyint(4) NOT NULL,
  `tPrice` int(10) DEFAULT NULL,
  `tValidity` smallint(5) DEFAULT NULL,
  `total_marks` decimal(10,2) DEFAULT NULL,
  `publish_result_immediately` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `total_questions` int(10) DEFAULT 0,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `tImage` text NOT NULL,
  `attempts` smallint(5) NOT NULL DEFAULT 10,
  `created_by` int(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `students` int(10) unsigned DEFAULT NULL,
  `tMetaKey` text DEFAULT NULL,
  `tMetaDesc` text DEFAULT NULL,
  `tStatus` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`tId`),
  KEY `tClass` (`tClass`),
  KEY `tSubject` (`tSubject`),
  KEY `ipId` (`ipId`),
  CONSTRAINT `tclass` FOREIGN KEY (`tClass`) REFERENCES `classes` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tins` FOREIGN KEY (`ipId`) REFERENCES `instructions` (`inId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tsub` FOREIGN KEY (`tSubject`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `testsections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testsections` (
  `tsecId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `testId` int(10) unsigned NOT NULL,
  `tsecName` varchar(100) NOT NULL,
  `tsMarks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tsNegMarks` decimal(10,2) NOT NULL DEFAULT 0.00,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tsecId`),
  KEY `testId` (`testId`),
  CONSTRAINT `testsec` FOREIGN KEY (`testId`) REFERENCES `tests` (`tId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `testseriestests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testseriestests` (
  `tstId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tcId` int(10) NOT NULL,
  `tId` int(10) unsigned NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tstId`),
  KEY `tstests` (`tId`),
  CONSTRAINT `tstests` FOREIGN KEY (`tId`) REFERENCES `tests` (`tId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tsenrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tsenrolls` (
  `tseId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tsId` int(10) unsigned NOT NULL,
  `uId` bigint(20) unsigned NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`tseId`),
  KEY `tsEnrollTS` (`tsId`),
  KEY `tsEnrolluser` (`uId`),
  CONSTRAINT `tsEnrollTS` FOREIGN KEY (`tsId`) REFERENCES `testcatogeries` (`tcId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tsEnrolluser` FOREIGN KEY (`uId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=429 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_status` varchar(10) NOT NULL DEFAULT 'false',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `userClass` varchar(20) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(255) NOT NULL DEFAULT 'imgs/profile.png',
  `userStatus` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1757 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `weeks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weeks` (
  `weekId` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courseId` bigint(20) unsigned NOT NULL,
  `weekName` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`weekId`),
  KEY `courseId` (`courseId`),
  CONSTRAINT `course` FOREIGN KEY (`courseId`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

