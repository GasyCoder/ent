-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 11 Octobre 2017 à 13:07
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fste_ent`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences_fste`
--

CREATE TABLE `absences_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `admin_read_stut` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `guardian_read_stut` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `student_read_stut` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `absences_fste`
--

INSERT INTO `absences_fste` (`id`, `date`, `note`, `user_id`, `admin_read_stut`, `guardian_read_stut`, `student_read_stut`, `created_at`, `updated_at`) VALUES
(1, '10/03/2017', 'AAZAAAAA', 4, 0, 1, 1, '2017-10-01 15:17:17', '2017-10-01 15:18:03'),
(2, '10/17/2017', 'aaaazaa', 2, 0, 1, 1, '2017-10-05 10:02:14', '2017-10-05 11:52:37'),
(3, '10/10/2017', 'TEST DATA BASE', 2, 0, 1, 1, '2017-10-09 12:27:43', '2017-10-11 04:47:53'),
(4, '10/14/2017', 'Vous &ecirc;tes absent', 9, 0, 1, 0, '2017-10-11 04:48:27', '2017-10-11 04:48:36'),
(5, '10/24/2017', 'hhh', 9, 0, 1, 0, '2017-10-11 04:49:04', '2017-10-11 04:58:31');

-- --------------------------------------------------------

--
-- Structure de la table `articles_fste`
--

CREATE TABLE `articles_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count_comment` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cahier_de_texte_fste`
--

CREATE TABLE `cahier_de_texte_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `the_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `the_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salle` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `parcours` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `magistrale` int(2) DEFAULT NULL,
  `tp` int(2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `read` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cahier_de_texte_fste`
--

INSERT INTO `cahier_de_texte_fste` (`id`, `the_time`, `the_date`, `salle`, `teacher_id`, `class_id`, `parcours`, `subject_id`, `magistrale`, `tp`, `note`, `read`, `created_at`, `updated_at`) VALUES
(4, '2h', '06/10/2017', '1', 2, 5, 'SVE', 3, 1, 2, 'vvvvv', 1, '2017-10-06 14:25:52', '2017-10-07 05:20:46'),
(5, '2h', '01/10/2017', '1', 2, 5, 'SVE', 0, 1, 2, 'cccccccccc', 1, '2017-10-06 14:36:22', '2017-10-10 06:01:11');

-- --------------------------------------------------------

--
-- Structure de la table `categories_fste`
--

CREATE TABLE `categories_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classes_fste`
--

CREATE TABLE `classes_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `classes_fste`
--

INSERT INTO `classes_fste` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(4, 'L1', 'Licence1', '2017-09-30 17:44:10', '2017-09-30 17:44:10'),
(5, 'L2', 'Licence2', '2017-10-01 14:40:47', '2017-10-01 14:40:47'),
(6, 'L3', 'Licence3', '2017-10-01 14:40:53', '2017-10-01 14:40:53'),
(7, 'M1', 'Master1', '2017-10-01 14:41:05', '2017-10-01 14:41:05'),
(8, 'M2', 'Master2', '2017-10-01 14:41:11', '2017-10-01 14:41:11');

-- --------------------------------------------------------

--
-- Structure de la table `comments_fste`
--

CREATE TABLE `comments_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `control_fste`
--

CREATE TABLE `control_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_plus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paginate` int(11) NOT NULL DEFAULT '2',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `news` text COLLATE utf8_unicode_ci NOT NULL,
  `closing_msg` text COLLATE utf8_unicode_ci NOT NULL,
  `close_site` tinyint(1) NOT NULL DEFAULT '0',
  `library_apv` tinyint(1) NOT NULL DEFAULT '0',
  `marquee_rtl` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `slide` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `installed` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `payment_tax` int(11) NOT NULL DEFAULT '0',
  `payment_unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `control_fste`
--

INSERT INTO `control_fste` (`id`, `school_name`, `email`, `phone`, `address`, `facebook`, `twitter`, `youtube`, `google_plus`, `paginate`, `description`, `keywords`, `news`, `closing_msg`, `close_site`, `library_apv`, `marquee_rtl`, `slide`, `installed`, `payment_tax`, `payment_unit`, `created_at`, `updated_at`) VALUES
(1, 'Facult&eacute; des Sciences', 'fste@univ-mahajanga.edu.mg', '(+261)0 32 05 582 18', 'Ambondrona Universit&eacute; de Mahajanga', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.youtube.com', 'http://www.google.com', 10, 'Facult&eacute; des Sciences, de Technologies et de l&#039;Environnement : La culture de l&#039;excellence.', ' School Management System, laravel, php, MySQL, Bootstrap,Universit&eacute; de mahajanga', 'Facult&eacute; des Sciences, de Technologies et de l&#039;Environnement : La culture de l&#039;excellence.', 'Ce site est en cours de maintenance...', 0, 1, 0, 1, 1, 0, 'Ar', '0000-00-00 00:00:00', '2017-10-01 06:36:52');

-- --------------------------------------------------------

--
-- Structure de la table `data_hours_fste`
--

CREATE TABLE `data_hours_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `data_hours_fste`
--

INSERT INTO `data_hours_fste` (`id`, `hour`, `created_at`, `updated_at`) VALUES
(1, '7h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '7h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '8h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '8h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '9h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '9h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '10h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '10h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '11h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '11h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '12h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '12h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '13h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '13h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '14h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '14h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '15h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '15h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '16h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '16h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '17h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '17h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, '18h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '18h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `data_users_fste`
--

CREATE TABLE `data_users_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `element_c` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0',
  `credit_ec` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_ec` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unite_e` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_t` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matricule_t` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `semestre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `data_users_fste`
--

INSERT INTO `data_users_fste` (`id`, `element_c`, `is_teacher`, `credit_ec`, `code_ec`, `unite_e`, `credit_t`, `matricule_t`, `semestre`, `created_at`, `updated_at`) VALUES
(3, 'Bilogie Vegetale', 0, '3', 'BioV001', 'Biologie', '6', '201700', 'S1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Biologie Animale', 0, '3', 'BioA001', '', '', '201800', 'S2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Geologie T', 0, '4', 'BioA002', 'Geologie', '4', '201801', 'S3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Statistique', 0, '5', 'BioA003', 'Math', '5', '201801', 'S4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Lettre Fran', 0, '6', 'BioA004', 'Langues', '6', '201801', 'S5', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Sant', 0, '7', 'BioA005', 'Biologie', '6', '201801', 'S1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Statistique Physique', 0, '5', 'BioA003', 'Physique', '5', '201801', 'S4', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `days_fste`
--

CREATE TABLE `days_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `days_fste`
--

INSERT INTO `days_fste` (`id`, `name`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'lundi', 'الاثنين', 'Monday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'mardi', 'الثلاثاء', 'Tuesday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'mercredi', 'الأربعاء', 'Wednesday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'jeudi', 'الخميس', 'Thursday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'vendredi', 'الجمعة', 'Friday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'samedi', 'السبت', 'Saturday', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'dimanche', 'الأحد', 'Sunday', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `emploi_fste`
--

CREATE TABLE `emploi_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `salle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `the_day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `the_hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parcours` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_end` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `emploi_fste`
--

INSERT INTO `emploi_fste` (`id`, `class_id`, `subject_id`, `teacher_id`, `salle`, `the_day`, `the_hour`, `end_hour`, `parcours`, `date_start`, `date_end`, `created_at`, `updated_at`) VALUES
(2, 4, 4, 2, '1', '1', '1', '7', ',SVE,STE,BSE', '01/10/2017', '10/10/2017', '2017-10-11 03:23:09', '2017-10-11 03:23:09'),
(3, 4, 4, 2, '1', '1', '8', '12', ',SVE,STE,BSE', '18/10/2017', '30/10/2017', '2017-10-11 03:24:11', '2017-10-11 03:24:11'),
(4, 4, 10, 4, '2', '1', '15', '20', ',SVE,STE,BSE', '18/10/2017', '30/10/2017', '2017-10-11 03:26:06', '2017-10-11 03:26:06');

-- --------------------------------------------------------

--
-- Structure de la table `emploi_hours_fste`
--

CREATE TABLE `emploi_hours_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `emploi_hours_fste`
--

INSERT INTO `emploi_hours_fste` (`id`, `hour`, `created_at`, `updated_at`) VALUES
(1, '7h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '7h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '8h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '8h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '9h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '9h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '10h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '10h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '11h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '11h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '12h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '12h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '13h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '13h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '14h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '14h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '15h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '15h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '16h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '16h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, '17h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, '17h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, '18h00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '18h30', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `exams_fste`
--

CREATE TABLE `exams_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `exam_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exam_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lessons_comments_fste`
--

CREATE TABLE `lessons_comments_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `read` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `lessons_comments_fste`
--

INSERT INTO `lessons_comments_fste` (`id`, `content`, `user_id`, `lesson_id`, `read`, `created_at`, `updated_at`) VALUES
(9, 'ok ok ok', 9, 4, 1, '2017-09-30 17:51:44', '2017-09-30 17:55:15'),
(10, 'Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\n\r\nComment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\n\r\nComment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\n', 9, 4, 1, '2017-09-30 17:58:06', '2017-09-30 18:00:51'),
(11, '\r\nComment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q', 9, 4, 1, '2017-09-30 18:01:30', '2017-10-01 03:05:20'),
(12, '\r\nComment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q', 9, 4, 1, '2017-09-30 18:01:36', '2017-10-01 03:05:20'),
(13, '\r\nComment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q', 9, 4, 1, '2017-09-30 18:01:42', '2017-10-01 03:05:20'),
(14, 'Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q ', 9, 4, 1, '2017-10-01 03:03:29', '2017-10-01 03:05:20'),
(15, 'TUTO Php object??? merci', 9, 1, 1, '2017-10-06 09:50:44', '2017-10-06 09:52:13'),
(16, 'Oui tuto php  io, araho tsara ny cours!', 2, 1, 1, '2017-10-06 10:04:13', '2017-10-06 10:04:14'),
(17, '', 2, 1, 1, '2017-10-06 10:52:52', '2017-10-06 10:52:54'),
(18, 'it-nn,k', 9, 1, 1, '2017-10-06 11:23:39', '2017-10-06 11:24:09'),
(19, 'Merci bcp profeseur', 20, 2, 1, '2017-10-07 05:07:42', '2017-10-07 05:08:04'),
(20, 'cjsmxj mfdlkgmdm c!: !:;b!gghh&nbsp; cvff', 2, 2, 1, '2017-10-07 05:08:25', '2017-10-07 05:08:27');

-- --------------------------------------------------------

--
-- Structure de la table `lessons_fste`
--

CREATE TABLE `lessons_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `jointe` text COLLATE utf8_unicode_ci NOT NULL,
  `mention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `library_categories_fste`
--

CREATE TABLE `library_categories_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `library_categories_fste`
--

INSERT INTO `library_categories_fste` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'TEST', '2017-10-03 15:48:19', '2017-10-03 15:48:19');

-- --------------------------------------------------------

--
-- Structure de la table `library_fste`
--

CREATE TABLE `library_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `library_fste`
--

INSERT INTO `library_fste` (`id`, `user_id`, `file_name`, `category_id`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'TESTE', 1, '2017-10-03/1507058335_fiche_de_presence.docx', '2017-10-03 15:48:55', '2017-10-03 15:48:55');

-- --------------------------------------------------------

--
-- Structure de la table `messages_fste`
--

CREATE TABLE `messages_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `read` int(1) UNSIGNED NOT NULL,
  `sender_statu` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `receiver_statu` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `file_path` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `messages_fste`
--

INSERT INTO `messages_fste` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `read`, `sender_statu`, `receiver_statu`, `file_path`, `created_at`, `updated_at`) VALUES
(14, 1, 3, 'TEST', 'Bonsoir FSTE', 1, 0, 0, '', '2017-09-30 14:32:43', '2017-09-30 14:33:50'),
(15, 3, 2, 'MESSAGES TEST', 'Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\n', 1, 0, 0, '', '2017-09-30 17:41:22', '2017-09-30 17:55:02'),
(16, 9, 2, 'MESSAGES TEST', 'Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ? Je pense nous devons utiliser le check box multiple. Exemple : Sur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou q ', 1, 0, 1, '', '2017-10-01 03:04:13', '2017-10-07 05:15:30'),
(17, 1, 2, 'MESSAGES TEST', 'Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\n', 1, 0, 1, '1506846259_about-us-img.png,1506846259_about-us-img1.png,1506846259_about-us-img2.png,1506846259_about-us-img3.png,1506846259_about-us-img4.png', '2017-10-01 04:54:19', '2017-10-07 05:15:24'),
(18, 2, 1, 'MESSAGES TEST', 'Comment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\nComment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\nComment peut FAIRE SI QUE L&rsquo;EMPLOI DU TEMPS EST TRONC COMMUN ?\r\nJe pense nous devons utiliser le check box multiple. Exemple :\r\nSur l&rsquo;Admin peut s&eacute;lectionner un ou deux ou trois ou quatre parcours.\r\nSi qu&rsquo;il s&eacute;lectionne 3 parcours donc tous les 3 peuvent voir et consulter.\r\n', 1, 0, 0, '', '2017-10-01 04:56:01', '2017-10-03 19:28:21'),
(19, 3, 1, 'TEST', 'Bonjour Mr, maaaaaa', 1, 0, 0, '', '2017-10-05 05:15:51', '2017-10-07 16:29:57'),
(20, 2, 3, 'Demande de materiel', 'Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses \r\nSalut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses \r\nSalut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses ', 1, 0, 0, '1507365822_20-128.png,1507365822_30-128.png,1507365822_39-128.png,1507365822_126.jpg', '2017-10-07 05:13:41', '2017-10-07 05:14:18'),
(21, 2, 3, 'Demande de materiel', 'Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses ', 1, 0, 0, '', '2017-10-07 05:14:05', '2017-10-07 05:14:18'),
(22, 3, 2, 'OJJK', 'Salut &agrave; tous, pour mon tchat et mon livre d&#039;or, j&#039;ai besoin de 2 champs : 1 de type date que j&#039;appelle &quot;date&quot; et l&#039;autre de type time que j&#039;appelle &quot;heure&quot;.\r\n\r\nLe probl&egrave;me, c&#039;est que dans ma BDD, toutes mes dates s&#039;enregistrent exactement comme cela : 0000-00-00 donc lorsque je veut les afficher elle s&#039;affiche de m&ecirc;me. Pareil pour les date.\r\n\r\nQuel est le probl&egrave;me d&#039;apr&egrave;s vous ?\r\n\r\nMerci d&#039;avance pour vos r&eacute;ponses ', 1, 0, 0, '', '2017-10-07 05:14:57', '2017-10-07 05:15:13'),
(23, 4, 9, 'Informations', 'Bonjour, n&#039;oublie pas votre date de soutenance....\r\nVoir votre fichier jointe.', 0, 0, 0, '1507709538_126.jpg,1507709538_173.jpg', '2017-10-11 04:42:17', '2017-10-11 04:42:17'),
(24, 4, 9, 'Informations', 'DDDFDDDFCDCDCDCDCDCDCDCDCDCDCH', 0, 0, 0, '', '2017-10-11 08:43:57', '2017-10-11 08:43:57');

-- --------------------------------------------------------

--
-- Structure de la table `pages_fste`
--

CREATE TABLE `pages_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pages_fste`
--

INSERT INTO `pages_fste` (`id`, `name`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Historique', 'historique', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', '2017-10-01 03:35:10', '2017-10-01 03:35:10'),
(2, 'Projets', 'projets', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', '2017-10-01 03:35:26', '2017-10-01 03:35:26'),
(3, 'Archives', 'archives', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', '2017-10-02 18:00:43', '2017-10-04 04:17:42'),
(4, 'R&egrave;glements int&eacute;rieur', 'rglements-intrieur', '&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n\r\n&lt;/body&gt;\r\n&lt;/html&gt;', '2017-10-07 15:35:17', '2017-10-07 15:35:17');

-- --------------------------------------------------------

--
-- Structure de la table `password_reminders_fste`
--

CREATE TABLE `password_reminders_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `password_reminders_fste`
--

INSERT INTO `password_reminders_fste` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'zoo@yahoo.fr', 'a9136f7413a63531fc798f0f16c6ca98676c69ea', '2017-10-01 14:55:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `payments_fste`
--

CREATE TABLE `payments_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trance` int(10) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_index` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `payments_fste`
--

INSERT INTO `payments_fste` (`id`, `title`, `trance`, `student_id`, `payment_amount`, `payment_status`, `payment_date`, `payment_index`, `created_at`, `updated_at`) VALUES
(2, 'Droit', 0, 9, 50000, 1, '10/10/2017', '1506852849', '2017-10-01 06:44:09', '2017-10-01 06:44:09'),
(3, 'Ecolage', 0, 9, 300000, 1, '23/10/2017', '1506854279', '2017-10-01 07:07:59', '2017-10-01 07:07:59'),
(4, 'Ecolage', 2, 9, 500000, 1, '25/10/2017', '1506862179', '2017-10-01 09:19:39', '2017-10-01 09:19:39'),
(5, 'Ecolage', 1, 10, 19998, 0, '25/10/2017', '1506879979', '2017-10-01 14:16:19', '2017-10-01 14:16:19');

-- --------------------------------------------------------

--
-- Structure de la table `pedagogiquesxxx`
--

CREATE TABLE `pedagogiquesxxx` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_start` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_end` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hour_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `parcours` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `times` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `magistrale` int(2) DEFAULT NULL,
  `tp` int(2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `read` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pedagogiquesxxx`
--

INSERT INTO `pedagogiquesxxx` (`id`, `date_start`, `date_end`, `hour_start`, `hour_end`, `teacher_id`, `parcours`, `class_id`, `subject_id`, `times`, `magistrale`, `tp`, `note`, `read`, `created_at`, `updated_at`) VALUES
(1, '03-10-2017', '01-10-2017', '7h', '18h', 2, 'STE', 4, 1, '3', 2, 1, 'ccccccccccccccccccccccccccccccccccccccccccccccccccccccccc', 0, '2017-10-06 16:57:09', '2017-10-06 16:57:09'),
(2, '01-10-2017', '02-10-2017', '7h', '18h', 2, 'SVE', 4, 1, '1', 1, 2, 'WWWWWWWWWWWWW', 0, '2017-10-07 03:18:26', '2017-10-07 03:18:26');

-- --------------------------------------------------------

--
-- Structure de la table `pedagogiques_fste`
--

CREATE TABLE `pedagogiques_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_start` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_end` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour_start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour_end` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcours` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `times` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `magistrale` int(2) DEFAULT NULL,
  `tp` int(2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `grade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `read` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pedagogiques_fste`
--

INSERT INTO `pedagogiques_fste` (`id`, `date_start`, `date_end`, `hour_start`, `hour_end`, `parcours`, `class_id`, `teacher_id`, `subject_id`, `times`, `magistrale`, `tp`, `note`, `grade`, `read`, `created_at`, `updated_at`) VALUES
(1, '2017/10/02', '2017/10/10', '7h00', '11h00', 'SVE,STE,BSE', 5, 4, 1, '10', 1, 2, 'AASASAAAAAAAAAAA', 'Mitre de conference', 0, '2017-10-11 06:10:48', '2017-10-11 06:10:48'),
(2, '2017/10/04', '2017/10/18', '7h30', '17h00', 'SVE,STE,BSE,Physique', 4, 4, 1, '7', 1, 2, 'SSSSSSSSSSSSSSSSSSSSSSSSSSS', 'Professeur', 0, '2017-10-11 06:12:40', '2017-10-11 06:12:40');

-- --------------------------------------------------------

--
-- Structure de la table `reports_fste`
--

CREATE TABLE `reports_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `to_parent` tinyint(1) NOT NULL DEFAULT '0',
  `report` text COLLATE utf8_unicode_ci,
  `student_id` int(10) UNSIGNED NOT NULL,
  `admin_read_stut` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `guardian_read_stut` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `reports_fste`
--

INSERT INTO `reports_fste` (`id`, `author_id`, `to_parent`, `report`, `student_id`, `admin_read_stut`, `guardian_read_stut`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 'NON NON NON', 9, 0, 1, '2017-10-02 18:03:34', '2017-10-02 18:07:58'),
(2, 2, 0, 'ASAZAAA', 9, 0, 1, '2017-10-05 10:04:13', '2017-10-05 10:27:59'),
(3, 2, 0, 'azaazaaax', 9, 0, 1, '2017-10-05 10:29:28', '2017-10-05 10:29:33');

-- --------------------------------------------------------

--
-- Structure de la table `slide_fste`
--

CREATE TABLE `slide_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `img_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `slide_fste`
--

INSERT INTO `slide_fste` (`id`, `img_1`, `url_1`, `img_2`, `url_2`, `img_3`, `url_3`, `created_at`, `updated_at`) VALUES
(1, 'images/s3.jpg', '', 'images/s1.jpg', '', 'images/s2.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `subjects_fste`
--

CREATE TABLE `subjects_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `semestre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `times` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `parcours` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `subjects_fste`
--

INSERT INTO `subjects_fste` (`id`, `semestre`, `name`, `times`, `class_id`, `teacher_id`, `parcours`, `note`, `created_at`, `updated_at`) VALUES
(1, 'S1', 'Statistique Physique', '10', 4, 4, 'SVE,STE,BSE,Physique,Chimie', 'Salut tus......', '2017-10-11 05:59:13', '2017-10-11 05:59:13'),
(2, 'S1', 'Biologie Animale', '7', 5, 4, 'STE,BSE,Physique', 'aaaaaaaa', '2017-10-11 06:00:00', '2017-10-11 06:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `teachers_marks_fste`
--

CREATE TABLE `teachers_marks_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `mark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_read_stut` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `guardian_read_stut` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transport_fste`
--

CREATE TABLE `transport_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `day_id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `time_start` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_return` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `transport_fste`
--

INSERT INTO `transport_fste` (`id`, `day_id`, `class_id`, `time_start`, `time_return`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '7h', '12h', '2017-10-07 15:34:11', '2017-10-07 15:34:11');

-- --------------------------------------------------------

--
-- Structure de la table `users_data_fste`
--

CREATE TABLE `users_data_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_student` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `birth_localite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users_data_fste`
--

INSERT INTO `users_data_fste` (`id`, `fullname`, `is_student`, `email`, `phone`, `address`, `birthday`, `class`, `registration_num`, `mention`, `parcour`, `admission`, `gender`, `created_at`, `updated_at`, `birth_localite`, `region`) VALUES
(39, 'BEZARA Gasy', 0, 'email@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2017', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mahajanga', 'BOENY'),
(40, 'FLORENT Jean', 0, 'email1@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2018', 'SVTE', 'SVE', 'Exclus', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antsohihy', 'SOFIA'),
(41, 'BEZARA Roussel Jullio', 0, 'email2@mail.com', '324567891', 'Majunga', '11-11-1111', 'L2', '2019', 'SVTE', 'SVE', 'Transfert', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Maintirano', 'BETSIBOKA'),
(42, 'NJARA ELIA', 0, 'email4@mail.com', '324567891', 'Majunga', '11-11-1111', 'M2', '2021', 'SVTE', 'SVE', 'Admis', 'femme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Analalava', 'SOFIA'),
(43, 'RAZAKA ERIKA', 0, 'email5@mail.com', '324567891', 'Majunga', '11-11-1111', 'M2', '2022', 'SVTE', 'SVE', 'Admis', 'femme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antsohihy', 'SOFIA'),
(44, 'TOMBO HAINA', 0, 'email6@mail.com', '324567891', 'Majunga', '11-11-1111', 'L3', '2023', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sambava', 'SAVA'),
(46, 'JORO AINA', 0, 'email8@mail.com', '324567891', 'Majunga', '11-11-1111', 'L2', '2025', 'SVTE', 'SVE', 'Admis', 'femme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mandritsara', 'SOFIA'),
(47, 'FETRA RANO', 0, 'email9@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2026', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(48, 'Andry Jocel', 0, 'emailz.@.com', '324567891', 'Majunga', '11-11-1111', 'M2', '2027', 'BSE', 'BSE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(49, 'Andry Jocel', 0, 'emailr.@.com', '324567892', 'Majunga', '11-11-1112', 'L3', '2028', 'SVTE', 'BSE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(50, 'Andry Jocel', 0, 'emaila.@.com', '324567893', 'Majunga', '11-11-1113', 'L1', '2029', 'SMS', 'Chimie', 'R', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(51, 'Andry Jocel', 0, 'emaily.@.com', '324567894', 'Majunga', '11-11-1114', 'L2', '2030', 'BSE', 'BSE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(52, 'FETRA RANO', 0, 'email5@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2031', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(53, 'FETRA RANO', 0, 'email5@mail.com', '324567892', 'Majunga', '11-11-1112', 'L2', '2032', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(54, 'FETRA RANO', 0, 'email5@mail.com', '324567893', 'Majunga', '11-11-1113', 'M2', '2033', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(55, 'FETRA RANO', 0, 'email5@mail.com', '324567894', 'Majunga', '11-11-1114', 'M1', '2034', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(56, 'FETRA RANO', 0, 'email5@mail.com', '324567895', 'Majunga', '11-11-1115', 'L1', '2035', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(57, 'FETRA RANO', 0, 'email5@mail.com', '324567896', 'Majunga', '11-11-1116', 'L2', '2036', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(58, 'BEZARA Gasy', 0, 'email@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2017', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mahajanga', 'BOENY'),
(59, 'FLORENT Jean', 0, 'email1@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2018', 'SVTE', 'SVE', 'Exclus', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antsohihy', 'SOFIA'),
(60, 'BEZARA Roussel Jullio', 0, 'email2@mail.com', '324567891', 'Majunga', '11-11-1111', 'L2', '2019', 'SVTE', 'SVE', 'Transfert', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Maintirano', 'BETSIBOKA'),
(61, 'NJARA ELIA', 0, 'email4@mail.com', '324567891', 'Majunga', '11-11-1111', 'M2', '2021', 'SVTE', 'SVE', 'Admis', 'femme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Analalava', 'SOFIA'),
(62, 'RAZAKA ERIKA', 0, 'email5@mail.com', '324567891', 'Majunga', '11-11-1111', 'M2', '2022', 'SVTE', 'SVE', 'Admis', 'femme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antsohihy', 'SOFIA'),
(63, 'TOMBO HAINA', 0, 'email6@mail.com', '324567891', 'Majunga', '11-11-1111', 'L3', '2023', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sambava', 'SAVA'),
(64, 'AINA SOA', 0, 'email7@mail.com', '324567891', 'Majunga', '11-11-1111', 'L3', '2024', 'SVTE', 'SVE', 'Admis', 'femme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antalaha', 'SAVA'),
(65, 'JORO AINA', 0, 'email8@mail.com', '324567891', 'Majunga', '11-11-1111', 'L2', '2025', 'SVTE', 'SVE', 'Admis', 'femme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mandritsara', 'SOFIA'),
(66, 'FETRA RANO', 0, 'email9@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2026', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(67, 'Andry Jocel', 0, 'emailz.@.com', '324567891', 'Majunga', '11-11-1111', 'M2', '2027', 'BSE', 'BSE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(68, 'Andry Jocel', 0, 'emailr.@.com', '324567892', 'Majunga', '11-11-1112', 'L3', '2028', 'SVTE', 'BSE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(69, 'Andry Jocel', 0, 'emaila.@.com', '324567893', 'Majunga', '11-11-1113', 'L1', '2029', 'SMS', 'Chimie', 'R', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(70, 'Andry Jocel', 0, 'emaily.@.com', '324567894', 'Majunga', '11-11-1114', 'L2', '2030', 'BSE', 'BSE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mazava', 'SOFIA'),
(71, 'FETRA RANO', 0, 'email5@mail.com', '324567891', 'Majunga', '11-11-1111', 'L1', '2031', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(72, 'FETRA RANO', 0, 'email5@mail.com', '324567892', 'Majunga', '11-11-1112', 'L2', '2032', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(73, 'FETRA RANO', 0, 'email5@mail.com', '324567893', 'Majunga', '11-11-1113', 'M2', '2033', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(74, 'FETRA RANO', 0, 'email5@mail.com', '324567894', 'Majunga', '11-11-1114', 'M1', '2034', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(75, 'FETRA RANO', 0, 'email5@mail.com', '324567895', 'Majunga', '11-11-1115', 'L1', '2035', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA'),
(76, 'FETRA RANO', 0, 'email5@mail.com', '324567896', 'Majunga', '11-11-1116', 'L2', '2036', 'SVTE', 'SVE', 'Admis', 'homme', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tananarivo', 'ANALAMANGA');

-- --------------------------------------------------------

--
-- Structure de la table `users_emploi_fste`
--

CREATE TABLE `users_emploi_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_student` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users_fste`
--

CREATE TABLE `users_fste` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_student` tinyint(1) NOT NULL DEFAULT '0',
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `is_manager` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_localite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parcour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matricule` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat_civil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `element_c` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_ec` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_ec` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unite_e` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_t` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `matricule_t` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users_fste`
--

INSERT INTO `users_fste` (`id`, `fullname`, `username`, `password`, `remember_token`, `is_admin`, `is_student`, `is_teacher`, `is_parent`, `is_manager`, `image`, `email`, `phone`, `gender`, `address`, `birthday`, `birth_localite`, `region`, `class_id`, `guardian_id`, `registration_num`, `mention`, `parcour`, `admission`, `grade`, `matricule`, `position`, `etat_civil`, `element_c`, `credit_ec`, `code_ec`, `unite_e`, `credit_t`, `matricule_t`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$3Ab07fvULaMEwXodzZv9UOTRyCWXCMUvT8Gd9xeyKDsoMtqykpFXm', 'WTXuxUuxayuemWmlgBdn7OZSINKBAQfNqhncE6FraVEntgmWhGNnYA3nG0KB', 1, 0, 0, 0, 0, NULL, 'admin@email.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 12:52:52', '2017-10-06 05:10:49'),
(2, 'Florent Bezara', 'florent', '$2y$10$6elaJ6fq3D7mXzN5y1DF3eJiFBnAva.KIZxZ6eHmDtMNEosrG9wXe', 'DCmvsN5idLo14d5ZMV72ac0eyPLewA5eoiaw3OJ39b6OG6KFULZPbtsxP42X', 0, 0, 1, 0, 0, '1506791776_bezara.png', 'florent@gmail.com', '0324751082', '1', 'Mahajanga be', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Professeur', '123456', 'permanente', 'Mari&eacute;', NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 13:46:16', '2017-10-08 17:12:33'),
(3, 'FSTE', 'fste', '$2y$10$/ZxWORzd3VQrUy7BiV385.ECEwvf80pPD97lU7x425VJ2oQvB7g4i', 'rbXU8Wd72Ol1DsbKMW89chzcbEjQwiSX9MuG0t2y4tIcRwALour87a2591s5', 1, 0, 0, 0, 1, '1506794462_favicon.gif', 'fste@email.com', '032012345', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 14:31:02', '2017-10-01 14:42:06'),
(4, 'James', 'james', '$2y$10$nPUMjmNpX3bdslPHBbhSAOqBKnzlt5Dt0S7xirQx2EJy9PO9Yd8D6', 'lgKjgyzOd8PORRZRLJvFMvY4HQwrghTWe6U9Hz5lhp0vacXsGHvVUrJS1ZhA', 0, 0, 1, 0, 0, '1506882598_scren.png', 'james@mail.com', '03201234', '1', 'Mahajanga Tana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Maitre de conférence', '201722', 'permanente', 'C&eacute;libataire', NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 14:35:59', '2017-10-07 11:01:08'),
(5, 'Kotofara', 'koto', '$2y$10$0QmgACTiCazwkbe4nn11YePpimM1rWzcwFjoUX1jvq4rXjufke9Ee', NULL, 0, 0, 1, 0, 0, '1506794834_testi_img1.png', 'koto@mail.mg', '034567892', '2', 'Tananarivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Docteur', '667755', 'permanente', 'Fianc&eacute;', NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 14:37:13', '2017-09-30 14:37:13'),
(6, 'Faralio', 'fara', '$2y$10$5gCQlDa17WjJyC6FOnX9u.XRdAM52bhRFQ4l3TsTPy0h8efvfCpOW', NULL, 0, 0, 1, 0, 0, NULL, 'fara@yahoo.fr', '0324459522', '2', 'Ambositra ambany', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Docteur', '678923', 'missionnaire', 'Mari&eacute;', NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 14:38:12', '2017-09-30 14:38:12'),
(7, 'Fanja Miora', 'fanja', '$2y$10$GtpgaIDCwtvzy0MBvHtVXexixZkIM5tmgy2IDXZWMn7uxddOnVT4W', NULL, 0, 0, 1, 0, 0, '1506794985_blog-img2.png', 'fanja@mail.com', '03456789', '1', 'Ambositra ambany', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Docteur', '091234', 'permanente', 'Mari&eacute;', NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 14:39:44', '2017-09-30 14:39:44'),
(8, 'Tojoniaina', 'tojo', '$2y$10$dnVHKZZXJbeKO0.an9WZ2uBKdAfStmRWKO7omic14PRDJVDYEnXe6', NULL, 0, 0, 1, 0, 0, '1506795085_member_3.png', 'tojo@yahoo.fr', '032456799', '1', 'Ambaja ambony', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Mitre de conference', '097654', 'vacataire', 'C&eacute;libataire', NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 14:41:24', '2017-09-30 14:41:24'),
(9, 'BEZARA Gasy', 'Gasy Be', '$2y$10$39tK01gBHduFs4h6g0qGBeDHPswlYo5b4SDrpQOwt7TcusRXNIUJ6', '5Alo3D8GWnWcdGAFUI9mkgschRTfGp0nZTuqh0O2vHM4fTquweYBnFaUgEzB', 0, 1, 0, 0, 0, '1506806314_member_1.png', 'email@mail.com', '0330567812', '1', 'Majunga', '11-11-1111', 'Antsohihy', 'SOFIA', '4', NULL, '2017', 'SVTE', 'SVE', 'Admis', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-09-30 17:48:34', '2017-10-11 07:43:35'),
(10, 'Aina', 'aina', '$2y$10$hVUI9Q6UgAsoELWO0tU/x.4TSX6PoSkBbCU5oGGEHORAh3LwQFbjq', 'eRXfWa9Ks1KflWHMtiJOnl1WGQLs2ZmaucMo3hpYCC00lQYlgcIuOx0JbOQZ', 0, 1, 0, 0, 0, '1506867916_member_2.png', 'aina@yahoo.fr', '03245678', '1', 'Antsohihy Avaratra', '12/07/1991', NULL, NULL, '4', NULL, '56484', 'SVTE', 'BSE', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-01 10:55:15', '2017-10-01 11:01:29'),
(11, 'zoo', 'zoo', '$2y$10$6PU8Qhpwh/iVW0UJLKf/1ep2m5rvQMVpU8YTSl..h5Dn7j1GZlgrO', 'dd7nTdjVVXocqpjqRsMfzfEMFHYu0RWl0cjkS7KpfmhDdHeeqaekvYsmesnK', 0, 1, 0, 0, 0, '1506867996_blog_post_img2.png', 'zoo@yahoo.fr', '0324567890', '1', 'SOFIA ', '12/08/1998', NULL, NULL, '4', NULL, '75633', 'SVTE', 'Physique', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-01 10:56:35', '2017-10-01 11:16:20'),
(12, 'TOMBO HAINA', 'haina', '$2y$10$hQ9MDYZFbBkl3rvlY.Li3.yq2Q0dlVU7H6XBMEDOPv5WOQ16RrWOm', 'oH6DpmlWvFaKtA5crTA5gx8eTF2sYbOmu4lpISyNg8HJqVQdQiZ0NDiEZqdm', 0, 1, 0, 0, 0, '1506947721_iba_logo.png', 'email6@mail.com', '324567891', '', 'Majunga', '11-11-1111', NULL, NULL, '6', NULL, '', 'SVTE', 'SVE', 'Admis', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-02 09:05:21', '2017-10-04 10:07:58'),
(14, 'AINA SOA', 'soa', '$2y$10$R6BGFKnxqHB0ylsuzN0Dw.AVtZHGslLfRaz2VKQWAtboaBji15oPm', '6lFJ5gbJgEZGk7tb9EBqXRvluXUKLbXwC7Hug938mlF5lV97KnsraPRahz7I', 0, 1, 0, 0, 0, '1507126454_recent_img1.png', 'email7@mail.com', '324567891', '1', 'Majunga', '11-11-1111', NULL, NULL, '6', NULL, '2024', 'SVTE', 'SVE', 'Admis', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 10:44:13', '2017-10-04 10:49:44'),
(15, 'JORO AINA', 'Kape', '$2y$10$P1pRKk2UVWwXfgeOGy2o1e0GR0ul5/axWcWNVE8z3zoWF/mXGi4QK', 'ytUcpVrpuQVkJT18brKfY9e8K56K6mxF79SMxldn14D0O3EAALCjSyJgF9Ui', 0, 1, 0, 0, 0, NULL, 'email8@mail.com', '324567891', '', 'Majunga', '11-11-1111', NULL, NULL, '5', NULL, '', 'SVTE', 'SVE', 'Admis', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 10:53:24', '2017-10-04 10:53:52'),
(16, 'FETRA RANO', 'Rano', '$2y$10$Relrg.77prkYJtcpFujoROxXzuBhrKJ1f3Tp2sgiiMFj3WrO7UcKe', NULL, 0, 1, 0, 0, 0, NULL, 'email9@mail.com', '324567891', '1', 'Majunga', '11-11-1111', NULL, NULL, '4', NULL, '2026', 'SVTE', 'SVE', 'Admis', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-04 11:04:21', '2017-10-04 11:04:21'),
(17, 'NOMENJANAHARY Andry', 'andry', '$2y$10$xO16B4jCUVIc.pwuchPkjeoAsXvMWa8gosw2UuFPHs7lcI.3Qp6yW', NULL, 0, 1, 0, 0, 0, NULL, 'andry@gmail.com', '032456792', '1', 'Mahajanga', '23/09/1991', 'Antsohihy', NULL, '8', NULL, 'S120945', 'SVTE', 'SVE', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-05 15:35:16', '2017-10-05 15:35:16'),
(18, 'RANDRIAMANANA Eric', 'fenohasina', '$2y$10$eBNV3UX6GA8af0JEGwAkr.CcGbX5MQqfBz0ftSgrESNstIxyzAM36', NULL, 0, 1, 0, 0, 0, '1507231091_3-128.png', 'feno@email.com', '032456781', '', 'Mahajanga Be', '12/12/1996', 'Analamanga', '', '', NULL, 'S11673', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-05 15:48:10', '2017-10-05 15:48:10'),
(19, 'Tefy', 'tafi_001', '$2y$10$/UVN5GYex0W7XSq95Ga98OmMttjIr/szxlTKkN4vMvb4TR.IRONea', NULL, 0, 1, 0, 0, 0, NULL, 'tefy@gmail.com', '032456782', '', 'Mahajanga Be', '12/09/1991', 'Analamanga', 'BOENY', '', NULL, '', '', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-05 16:19:06', '2017-10-05 16:19:06'),
(20, 'RAZAKA ERIKA', 'erika_1', '$2y$10$lQCd8jV5r2TRgIVpeISQrumLHOhaAdMp3KDzpgMz9.i1l/a12lM4i', NULL, 0, 1, 0, 0, 0, '1507365022_bezara.png', 'email5@mail.com', '324567891', 'femme', 'Majunga', '11-11-1111', '11-11-1111', 'SOFIA', '8', NULL, '2022', 'SVTE', 'SVE', 'Admis', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-07 05:00:22', '2017-10-07 05:00:22'),
(21, 'Franco', 'franco', '$2y$10$DZk.6LrAkoGfCovhXiWuEeqfvnezygPpLqABSCO1dENbe1pW1qTQe', NULL, 0, 0, 1, 0, 0, NULL, 'franc@yahoo.fr', '0324567812', '1', 'Majunga', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Professeur', '234566', 'permanente', 'Mari&eacute;', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-08 19:34:14', '2017-10-08 19:34:14'),
(22, '', '', '', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Bilogie Vegetale', '3', 'BioV001', '', '', '201700', '2017-10-09 18:28:37', '2017-10-09 18:28:37');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `absences_fste`
--
ALTER TABLE `absences_fste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absences_user_id_foreign` (`user_id`);

--
-- Index pour la table `articles_fste`
--
ALTER TABLE `articles_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cahier_de_texte_fste`
--
ALTER TABLE `cahier_de_texte_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories_fste`
--
ALTER TABLE `categories_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classes_fste`
--
ALTER TABLE `classes_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments_fste`
--
ALTER TABLE `comments_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `control_fste`
--
ALTER TABLE `control_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `data_hours_fste`
--
ALTER TABLE `data_hours_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `data_users_fste`
--
ALTER TABLE `data_users_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `days_fste`
--
ALTER TABLE `days_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emploi_fste`
--
ALTER TABLE `emploi_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emploi_hours_fste`
--
ALTER TABLE `emploi_hours_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exams_fste`
--
ALTER TABLE `exams_fste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_teacher_id_foreign` (`teacher_id`),
  ADD KEY `exams_class_id_foreign` (`class_id`),
  ADD KEY `exams_subject_id_foreign` (`subject_id`);

--
-- Index pour la table `lessons_comments_fste`
--
ALTER TABLE `lessons_comments_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lessons_fste`
--
ALTER TABLE `lessons_fste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_teacher_id_foreign` (`teacher_id`),
  ADD KEY `lessons_class_id_foreign` (`class_id`),
  ADD KEY `lessons_subject_id_foreign` (`subject_id`);

--
-- Index pour la table `library_categories_fste`
--
ALTER TABLE `library_categories_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `library_fste`
--
ALTER TABLE `library_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages_fste`
--
ALTER TABLE `messages_fste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_index` (`sender_id`),
  ADD KEY `messages_receiver_id_index` (`receiver_id`),
  ADD KEY `messages_sender_id_read_index` (`sender_id`,`read`);

--
-- Index pour la table `pages_fste`
--
ALTER TABLE `pages_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reminders_fste`
--
ALTER TABLE `password_reminders_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payments_fste`
--
ALTER TABLE `payments_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pedagogiquesxxx`
--
ALTER TABLE `pedagogiquesxxx`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pedagogiques_fste`
--
ALTER TABLE `pedagogiques_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reports_fste`
--
ALTER TABLE `reports_fste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_author_id_foreign` (`author_id`),
  ADD KEY `reports_student_id_foreign` (`student_id`);

--
-- Index pour la table `slide_fste`
--
ALTER TABLE `slide_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subjects_fste`
--
ALTER TABLE `subjects_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `teachers_marks_fste`
--
ALTER TABLE `teachers_marks_fste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_marks_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teachers_marks_class_id_foreign` (`class_id`),
  ADD KEY `teachers_marks_subject_id_foreign` (`subject_id`),
  ADD KEY `teachers_marks_student_id_foreign` (`student_id`);

--
-- Index pour la table `transport_fste`
--
ALTER TABLE `transport_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_data_fste`
--
ALTER TABLE `users_data_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_emploi_fste`
--
ALTER TABLE `users_emploi_fste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_fste`
--
ALTER TABLE `users_fste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `absences_fste`
--
ALTER TABLE `absences_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `articles_fste`
--
ALTER TABLE `articles_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cahier_de_texte_fste`
--
ALTER TABLE `cahier_de_texte_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `categories_fste`
--
ALTER TABLE `categories_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `classes_fste`
--
ALTER TABLE `classes_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `comments_fste`
--
ALTER TABLE `comments_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `control_fste`
--
ALTER TABLE `control_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `data_hours_fste`
--
ALTER TABLE `data_hours_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `data_users_fste`
--
ALTER TABLE `data_users_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `days_fste`
--
ALTER TABLE `days_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `emploi_fste`
--
ALTER TABLE `emploi_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `emploi_hours_fste`
--
ALTER TABLE `emploi_hours_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `exams_fste`
--
ALTER TABLE `exams_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lessons_comments_fste`
--
ALTER TABLE `lessons_comments_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `lessons_fste`
--
ALTER TABLE `lessons_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `library_categories_fste`
--
ALTER TABLE `library_categories_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `library_fste`
--
ALTER TABLE `library_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `messages_fste`
--
ALTER TABLE `messages_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `pages_fste`
--
ALTER TABLE `pages_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `password_reminders_fste`
--
ALTER TABLE `password_reminders_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `payments_fste`
--
ALTER TABLE `payments_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `pedagogiquesxxx`
--
ALTER TABLE `pedagogiquesxxx`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `pedagogiques_fste`
--
ALTER TABLE `pedagogiques_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `reports_fste`
--
ALTER TABLE `reports_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `slide_fste`
--
ALTER TABLE `slide_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `subjects_fste`
--
ALTER TABLE `subjects_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `teachers_marks_fste`
--
ALTER TABLE `teachers_marks_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `transport_fste`
--
ALTER TABLE `transport_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users_data_fste`
--
ALTER TABLE `users_data_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT pour la table `users_emploi_fste`
--
ALTER TABLE `users_emploi_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users_fste`
--
ALTER TABLE `users_fste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `absences_fste`
--
ALTER TABLE `absences_fste`
  ADD CONSTRAINT `absences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users_fste` (`id`);

--
-- Contraintes pour la table `exams_fste`
--
ALTER TABLE `exams_fste`
  ADD CONSTRAINT `exams_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes_fste` (`id`),
  ADD CONSTRAINT `exams_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects_fste` (`id`),
  ADD CONSTRAINT `exams_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users_fste` (`id`);

--
-- Contraintes pour la table `lessons_fste`
--
ALTER TABLE `lessons_fste`
  ADD CONSTRAINT `lessons_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes_fste` (`id`),
  ADD CONSTRAINT `lessons_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects_fste` (`id`),
  ADD CONSTRAINT `lessons_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users_fste` (`id`);

--
-- Contraintes pour la table `reports_fste`
--
ALTER TABLE `reports_fste`
  ADD CONSTRAINT `reports_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users_fste` (`id`),
  ADD CONSTRAINT `reports_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users_fste` (`id`);

--
-- Contraintes pour la table `teachers_marks_fste`
--
ALTER TABLE `teachers_marks_fste`
  ADD CONSTRAINT `teachers_marks_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes_fste` (`id`),
  ADD CONSTRAINT `teachers_marks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users_fste` (`id`),
  ADD CONSTRAINT `teachers_marks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects_fste` (`id`),
  ADD CONSTRAINT `teachers_marks_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users_fste` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
