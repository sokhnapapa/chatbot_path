-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2018 at 11:34 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.1.14-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hivselftestingbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `bot_flows`
--

CREATE TABLE `bot_flows` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bot_flows`
--

INSERT INTO `bot_flows` (`id`, `name`, `body`) VALUES
(1, 'New Users', 'Users asked for their age and gender.'),
(2, 'View FAQs', 'Users interested in viewing Frequently Asked Questions.'),
(3, 'Flow 3', 'Flow 3 description'),
(4, 'Flow 4', 'Flow 4 description'),
(5, 'Flow 5', 'Flow 5 description'),
(6, 'Flow 6', 'Flow 6 description'),
(7, 'Flow 7', 'Flow 7 description'),
(8, 'Flow 8', 'Flow 8 description'),
(9, 'Flow 9', 'Flow 9 description'),
(10, 'Flow 10', 'Flow 10 description'),
(11, 'Flow 11', 'Flow 11 description'),
(12, 'Flow 12', 'Flow 12 description'),
(13, 'Flow 13', 'Flow 13 description'),
(14, 'Flow 14', 'Flow 14 description'),
(15, 'Flow 15', 'Flow 15 description');

-- --------------------------------------------------------

--
-- Table structure for table `eiligibity questions`
--
CREATE TABLE `eligibility_test_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eligibityquestions`
--
INSERT INTO `eligibility_test_questions`(`id`, `question`) VALUES
(1, 'Have you tested for HIV in the last 12 months?'),
(2, 'Have you had TB Disease or presumptive TB (2 weeks’ history of Cough,night sweats, weight loss, fever)?'),
(3, 'Have you had symptoms of Sexually Transmitted Infection (blisters, sores, unusual urethral or vaginal discharge)?'),
(4, 'Are you newly diagnosed with Hepatitis B or C ?'),
(5, 'Have you experienced sexual violence (SGBV)?'),
(6, 'Have you done a reactive HIV self-test result ?'),
(7, 'Have you been identified through an index client ?'),
(8, 'Have you been exposed to blood or body fluids from a known HIV positive or unknown HIV status source ?'),
(9, 'Have you had signs and symptoms of HIV disease and have not had an HIV test in the last 1 month ?'),
(10,'Have you had unprotected sex with partner(s) of unknown HIV status?'),
(11,'Have you had unprotected sex with an HIV positive partner?'),
(12,'Have you shared injecting needles or piercing objects with anyone else?');


--
-- Table structure for `eligibility_test_question_answers`
--
CREATE TABLE `eligibility_test_question_answers`(
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,,
  `answer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actions` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `body`, `image`, `actions`) VALUES
(1, 'What is HIV self-testing?', 'HIV self-testing is the process in which a person collects his or her own specimen (oral fluid or\nblood) and then performs an HIV test and interprets the result, often in a private setting, either\nalone or with someone he or she trusts.\nHIVST does not provide a definitive HIV-positive diagnosis. All reactive (positive) self-test results\nneed to be confirmed by a trained tester using a validated national testing algorithm. Non-reactive\n(negative) self-test results are considered negative. However, in accordance with existing WHO\nHIVST guidance individuals who may have been exposed to HIV in the past 6 weeks and those at\nhigh on-going risk (such as key populations) are advised to retest. HIV self-testing is a process\nwhereby a person collects his or her own sample and conducts an HIV test.', 'faq-1-1.jpg', '1'),
(2, 'Is HIV self-testing the right option for me?', 'An HIV test is the only way of knowing your HIV status. This is important in making informed\nchoices about your health and lifestyle. HIV self-testing allows you to test yourself privately and at\nyour own convenience. HIV self-tests are not suitable for those who are taking anti-retrovirals\n(ARVs). If you think you have been exposed to HIV or are at risk of infection, HIV self-testing offers\nan opportunity for you to determine your status.', 'faq-2-1.jpg', '1'),
(3, 'Which HIV self-test kits are available?', 'At present, there are two types of HIV self-test kits available, which detect the HIV virus using\neither a blood or oral fluid (saliva) sample.', 'faq-3-1.jpg', '1'),
(4, 'How reliable are HIV self-test kits?', 'When used according to the manufacturer\'s instructions provided, both the blood and oral HIV\nself-tests are accurate.', 'faq-4-1.jpg', '1'),
(5, 'Where can I get an HIV self-test kit?', 'Approved HIV self-test kits are available in the public & private health facilities as well as in select pharmacies.', 'faq-5-1.jpg', '1'),
(6, 'How do I conduct an HIV self-test?','Follow instructions as provided by the manufacturer and the service provider.', 'faq-6-1.jpg', '1'),
(7, 'What should I do if my test result is reactive (positive)?', 'If you interpret a HIV reactive (positive) result, it is important that you go for a confirmatory HIV test at a facility/community offering HIV Testing Services by a qualified health provider to know your status.', 'faq-7-1.jpg', '1'),
(8, 'What should I do if I test HIV negative?', 'Remember that it can take up to 3 months after exposure to HIV for detect a HIV infection.  Therefore, if you were exposed to HIV less than 3 months ago, you need to test again after 4 weeks to be sure that your status is truly negative. However, if you have not been exposed to HIV over the past 3 months and you conducted the test as instructed, then it is highly likely a negative result means you do not have HIV.   If you continue to be at risk of HIV infection, you should continue to re-test every 3 months. You should also talk to a health provider about other HIV prevention options.', 'faq-8-1.jpg', '1'),
(9, 'If HIV cannot be transmitted through saliva, why use oral fluids (saliva) to test for HIV?', 'HIV cannot be transmitted through saliva, urine or sweat.   HIV can be transmitted through contact with blood, vaginal and rectal fluids and breast milk from an infected person.  \r\n\r\nHIV self-tests detect if your body has been previously exposed to HIV. If it has, your body will have produced antibodies specific to HIV to defend itself against the virus.  These antibodies can be detected from oral fluids (as well as in blood). The HIV self-test does not detect the actual virus. ', 'faq-9-1.jpg', '1'),
(10, 'Can my partner and I test as a couple? If so, what will happen if one of us tests HIV positive?', 'You and your partner can test together in your privacy.   Each of you should use separate test kits and conduct the test as indicated in the instructions provided. If any of you interpret a reactive (positive) result, you must visit a HIV Testing service provider at the facility/community for a HIV test.', 'faq-10-1.jpg', '1'),
(11, 'I’m HIV positive, Can I use the HIV Self-Testing kit to test my child?', 'You should never use the HIV self-test kit on babies.  For children, it is recommended to take them to the health facility for HIV testing.', 'faq-11-1.jpg', '1'),
(12, 'What should I do if someone wants to force me to take a test?', 'The HIV prevention and control Act 2006 prohibits compulsory testing and therefore HIV testing without your consent is illegal! You have the right to refuse to take a HIV test or stop the procedure at any time if you feel not ready to know your status.', 'faq-12-1.jpg', '1'),
(13, 'Where can I get more information on HIV prevention, care and treatment? ', 'You can visit the nearest health/community facility or call the helpline for more information.', 'faq-13-1.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `faq_actions`
--

CREATE TABLE `faq_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_swa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_actions`
--

INSERT INTO `faq_actions` (`id`, `title`, `body`, `type`, `payload`) VALUES
(1, 'Return to main Menu ', 'view frequently asked questions', 'button', 'go_to_main_menu'),
(2, 'view faqs2', 'view frequently asked questions2', 'button', 'view_faqs2'),
(3, 'view faqs3','view frequently asked questions3', 'button', 'view_faqs3');

-- --------------------------------------------------------

--
-- Table structure for table `fb_users`
--

CREATE TABLE `fb_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `followed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tested` tinyint(1) DEFAULT '0',
  `first_timer` tinyint(1) DEFAULT '0',
  `bought_from` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kit_used` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `results` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Table structure for table `flow_runs`
--

CREATE TABLE `flow_runs` (
  `id` int(10) UNSIGNED NOT NULL,
  `psid` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flow_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `psid` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` int(11) DEFAULT NULL,
  `lon` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_02_14_101725_create_fb_users_table', 2),
(4, '2018_02_14_122858_create_faqs_table', 3),
(5, '2018_02_15_072827_create_locations_table', 4),
(6, '2018_02_15_092126_create_pharmacies_table', 4),
(7, '2018_02_16_183631_add_action_column_to_faqs_table', 5),
(8, '2018_02_17_071103_create_faq_actions_table', 5),
(9, '2018_02_17_102753_create_flow_runs_table', 6),
(10, '2018_02_17_103847_create_bot_flows_table', 6),
(11, '2018_02_17_112608_create_questions_table', 7),
(12, '2018_02_17_183700_add_columns_to_fb_users_table', 8),
(13, '2018_02_18_102649_create_rapidpro_servers_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacies`
--

CREATE TABLE `pharmacies` (
  `id` int(10) UNSIGNED NOT NULL,
  `facility_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_county` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacies`
--

INSERT INTO `pharmacies` (`id`, `facility_name`, `village`, `sub_county`, `district`,`contact_name`, `phone_number`, `lat`, `lon`) VALUES
(1, 'Makindye Health Center III', 'Makindye', 'Makindye Division','Kampala','Samuel Angweo', '0777212472', '0.2863815', '32.5803188'),
(2, 'Makerere University Hospital', 'Makerere', 'Central Division','Kampala','Sister Elizabeth', '0757714147', '0.3281950', '32.5705492'),
(3, 'Kojja Health Center IV', 'Ntenjeru', 'Ntenjeru Division','Mukono','Kigoonya Ronald', '0787950141', '0.2863815', '32.5803188'),
(4, 'Mpunge Health Center III', 'Mpunge', 'Mpunge Division','Mukono','Madrine Dachiru', '0777212472', '0.1222929', '32.7216089'),
(5, 'Katoogo Health Center III', 'Katoogo', 'Nam','Mukono','Nambeera Betty', '07782478453', '0.4470401', '32.8180042'),
(6, 'Kyengera Health Center III', 'Kyengera', 'Nsangi','Wakiso','Namboozi Betty', '0772347114', '0.2971465', '32.4995112'),
(7, 'Maganjo Health Center II', 'Maganjo', 'Nabweru','Wakiso','Grace Nakayi', '0772915576', '0.3906180', '32.5479322'),
(8, 'Kiganda Maternity Home', 'Kawempe', 'Kawempe','Kampala','Namubiru Elizabeth', '0777518016', '0.3906180', '32.5479322'),
(9, 'Kalen Clinic', 'Mubaraka', 'Makindye Division','Kampala','Namaliru Phiona', '0700144881', '0.3906180', '32.5479322'),
(10, 'Tinka Access Clinic', 'Ggaba', 'Makindye Division','Kampala','Nemigisha Anitarace', '0702866617', '0.3906180', '32.5479322'),
(11, 'Consult Clinic Kisasi', 'Kisasi', 'Central Division','Kampala','Kintu M', '0702833441', '0.3906180', '32.5479322'),
(12, 'Kawoya Foundation Clinic', 'Kasabla', 'Mukono Central','Mukono','Kalule Hamisi', '0753672263', '0.3906180', '32.5479322'),
(13, 'St Francis Medical Center', 'Mukono Municipal', 'Mukono Municipal','Mukono','Bussulwa Tonny', '0775595046', '0.3906180', '32.5479322'),
(14, 'St John Health Center', 'Gulu', 'Mukono Municipal','Mukono','Namaganda Halima', '0706306267', '0.3906180', '32.5479322'),
(15, 'Hilgrem Medical Center', 'Wantoni', 'Mukono Municipal','Mukono','Namutebi Lydia', '0706400389', '0.3906180', '32.5479322'),
(16, 'Peoples Medical Center', 'Gayaza', 'Kasangati Town Concil','Wakiso','Christine', '0759589862', '0.3906180', '32.5479322'),
(17, 'Doctors Medical Center', 'Banda', 'Banda Kyambogo','Wakiso','Bwambale Edgar', '0788636109', '0.3906180', '32.5479322'),
(18, 'Herm Medical Center', 'Maganjo', 'Nabweru','Wakiso','Nagawa Joanita', '0753995101', '0.3906180', '32.5479322'),
(19, 'Victorious Medical Center', 'Maganjo', 'Nabweru','Wakiso','Patience Tukundane', '0786286984', '0.3906180', '32.5479322'),
(20, 'Mpereza Clinic', 'Kasenyi', 'Katabi','Wakiso','NAVA HADIJJA', '0753791753', '0.3906180', '32.5479322'),
(21, 'Medical Link', 'Nkumba', 'Katabi','Wakiso','Dr Denis Waswa', '0774392428', '0.3906180', '32.5479322'),
(22, 'Entebbe Central Clinic', 'Lunyo East', 'Nabweru','Wakiso','Kwesiga Alfred', '0776327998', '0.3906180', '32.5479322'),
(23, 'Hefra Pharmacy', 'Bugolobi', 'Nakawa Division','Kampala','Micheal Kaija', '0759219716', '0.3906180', '32.5479322'),
(24, 'Lisa Pharmacy', 'Kabalagala', 'Kabalagala','Kampala','Joseph Kanakulya', '0787625454', '0.3906180', '32.5479322'),
(25, 'Guardian Health Pharmacy', 'Kansanga', 'Kansanga','Kampala','JNamugumya D', '0778139724', '0.3906180', '32.5479322'),
(26, 'Revigen Pharmacy', 'Makerere', 'Makerere Western Gate','Kampala','Ainembabazi Ruth', '0779653063', '0.3906180', '32.5479322'),
(27, 'Goreals Pharmaceuticals LTD', 'Kasubi Kawaala', 'Central Division','Kampala','Outa Sixtus', '0759754196', '0.3906180', '32.5479322'),
(28, 'Cedars Pharmacy', 'Nankulabye', 'Central Division','Kampala','Joan Kyagulanyi', '0703932908', '0.3906180', '32.5479322'),
(29, 'Luwadde Pharmacy', 'UCU', 'Mukono Central','Mukono','Nakafero Joyce', '0703863693', '0.3906180', '32.5479322'),
(30, 'Al Noor Pharmaceuticals', 'Wantoni', 'Mukono Central','Mukono','Aperuno Christine', '0772185922', '0.3906180', '32.5479322'),
(31, 'Jaspharm Pharmacy', 'Kireka', 'Bweyogere','Wakiso','James Jobi', '0702713262', '0.3906180', '32.5479322'),
(32, 'General Topcare Pharmacy', 'Nsangi', 'Nsangi','Waksio','Mujumbi Jamir', '0753897714', '0.3906180', '32.5479322'),
(33, 'Healthplus Pharm LTD', 'Kyengera', 'Kyengera','Wakiso','Asiimwe Vanita', '0783509840', '0.3906180', '32.5479322'),
(34, 'VERSE PHARMACY', 'Lweza', 'Kajjansi Town Council','Wakiso','Kalibala Isaac', '0758070189', '0.3906180', '32.5479322'),
(35, 'JOSANA PHARMACY', 'NABINGO', 'KYENGERA Town Concil','Wakiso','SSENTAMU SARAH', '0753688714', '0.3906180', '32.5479322'),
(36, 'Saint Pharmacy', 'Kitoro', 'Entebbe Division B','Wakiso','Maria Alihona', '0772891376', '0.3906180', '32.5479322'),
(37, 'Kasangati Health Center IV', 'Kasangati', 'Kasangati Town Concil','Wakiso','Sr Kaujo A', '0701898094', '0.2863815', '32.5803188');


-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Table structure for table `linkages and referals`
--



-- --------------------------------------------------------

--
-- dumping data into table `linkages and referrals`
--

INSERT INTO `referrals_and_linkagaes` (`id`, `facility_name`, `level`, `district`) VALUES
(1,  'TASO Kanyanya', 'AIDS Clinic', 'Kampala'),
(2,  'TASO Mulago', 'AIDS Clinic', 'Kampala'),
(3,  'Mulago CDC', 'AIDS Clinic', 'Kampala'),
(4,  'Mujhu Resea Co', 'AIDS Clinic', 'Kampala'),
(5,  'Mulago ISS', 'NRH', 'Kampala'),
(6,  'Mulago TB-HIV', 'AIDS Clinic', 'Kampala'),
(7,  'Mulago TB-HIV', 'AIDS Clinic', 'Kampala'),
(8,  'Post Natal Clinic', 'AIDS Clinic', 'Kampala'),
(9,  'Kampala Dispen', 'Health Center II', 'Kampala'),
(10, 'PIDC Ward', 'AIDS Clinic', 'Kampala'),
(11, 'TASO Entebbe', 'AIDS Clinic', 'Wakiso'),
(12, 'Medical Res Coun', 'AIDS Clinic', 'Wakiso'),
(13, 'Entebbe Grade B', 'AIDS Clinic', 'Wakiso'),
(14, 'Kisubi Hospital', 'AIDS Clinic', 'Wakiso'),
(15, 'Katabi Hospital', 'AIDS Clinic', 'Wakiso'),
(16, 'Saidina Abubaker', 'AIDS Clinic', 'Wakiso'),
(17, 'Buwambo Health Center', 'Health Center IV', 'Wakiso'),
(18, 'Namayumba Health Center', 'Health Center IV', 'Wakiso'),
(19, 'Ndejje Health Center', 'Health Center IV', 'Wakiso'),
(20, 'Waksio Health Center', 'Health Center IV', 'Wakiso'),
(21, 'Mildmay Hospital', 'AIDS Clinic', 'Kampala'),
(22, 'Wagagai Clinic', 'Clinic', 'Wakiso'),
(23, 'Nagalama', 'Hospital', 'Mukono'),
(24, 'Kojja Health Center', 'Health Center IV', 'Mukono'),
(25, 'Mukono COU HC', 'Health Center IV', 'Mukono'),
(26, 'Mukono Health Center', 'Health Center IV', 'Mukono'),
(27, 'Kyetume Center', 'Health Center III', 'Mukono'),
(28, 'Royal VanZan Ten', 'Clinic', 'Mukono'),
(29, 'Family Hope Cent', 'AIDS Clinic', 'Mukono'),
(30, 'Kyambogo University', 'Health Center IV', 'Kampala'),
(31, 'Kyadondo Medical Center', 'Clinic', 'Kampala'),
(32, 'Kawempe Health Center', 'AIDS Clinic', 'Kampala'),
(33, 'Kisenyi Health Center', 'Health Center IV', 'Kampala'),
(34, 'Murchsion Bay', 'Hospital', 'Kampala'),
(35, 'Gen Mil Mbuya', 'Hospital', 'Kampala'),
(36, 'Nsambya General Clinic', 'Clinic', 'Kampala'),
(37, 'Nsambya Privat Wing', 'Hospital', 'Kampala'),
(38, 'Nsambya Police Hospital', 'Hospital', 'Kampala'),
(39, 'Makerere University', 'Hospital', 'Kampala'),
(40, 'Mengo Hospital', 'Hospital', 'Kampala'),
(41, 'Namungoona Hospital', 'Hospital', 'Kampala'),
(42, 'Wagagai Clinic', 'Clinic', 'Wakiso'),
(43, 'Kabubu', 'Health Center II', 'Wakiso'),
(44, 'Namugongo Child', 'Clinic', 'Wakiso'),
(45, 'Touch Namuwon', 'Clinic', 'Wakiso'),
(46, 'Roofing Facility', 'Clinic', 'Wakiso'),
(47, 'Kakiri 1st Div Military', 'Hospital', 'Wakiso'),
(48, 'MasaJja Nursing', 'Clinic', 'Wakiso'),
(49, 'Tropical Clinic', 'Clinic', 'Wakiso'),
(50, 'Kibuli Hospital', 'Hospital', 'Kampala');



--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `psid` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Table structure for table `rapidpro_servers`
--

CREATE TABLE `rapidpro_servers` (
  `id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Host` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bot_flows`
--
ALTER TABLE `bot_flows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_actions`
--
ALTER TABLE `faq_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb_users`
--
ALTER TABLE `fb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flow_runs`
--
ALTER TABLE `flow_runs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pharmacies`
--
ALTER TABLE `pharmacies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rapidpro_servers`
--
ALTER TABLE `rapidpro_servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bot_flows`
--
ALTER TABLE `bot_flows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq_actions`
--
ALTER TABLE `faq_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fb_users`
--
ALTER TABLE `fb_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `flow_runs`
--
ALTER TABLE `flow_runs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pharmacies`
--
ALTER TABLE `pharmacies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rapidpro_servers`
--
ALTER TABLE `rapidpro_servers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;