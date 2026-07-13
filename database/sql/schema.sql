-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2026 a las 08:30:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jhelen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academic_documents`
--

CREATE TABLE `academic_documents` (
  `idacademic_document` int(10) UNSIGNED NOT NULL,
  `document_code` varchar(50) NOT NULL,
  `document_type` varchar(50) NOT NULL,
  `source_table` varchar(80) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `issued_by` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `validation_count` int(11) NOT NULL DEFAULT 0,
  `last_validated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `academic_documents`
--

INSERT INTO `academic_documents` (`idacademic_document`, `document_code`, `document_type`, `source_table`, `source_id`, `idstudent`, `issued_by`, `issue_date`, `status`, `validation_count`, `last_validated_at`, `created_at`, `updated_at`) VALUES
(1, 'CE-2026-0001', 'CONSTANCIA_ESTUDIOS', 'certificates', 1, 1, 15, '2026-07-04', 1, 3, '2026-07-13 10:43:59', '2026-07-07 07:25:24', '2026-07-13 10:43:59'),
(2, 'CN-2026-0001', 'CONSTANCIA_NOTAS', 'grade_certificates', 1, 1, 15, '2026-07-04', 1, 2, '2026-07-13 10:42:41', '2026-07-07 07:40:12', '2026-07-13 10:42:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attendance`
--

CREATE TABLE `attendance` (
  `idattendance` int(11) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `idsection` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('PRESENTE','AUSENTE','TARDANZA') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `attendance`
--

INSERT INTO `attendance` (`idattendance`, `idstudent`, `idsection`, `attendance_date`, `status`, `created_at`) VALUES
(52, 8, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(53, 9, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(54, 10, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(55, 11, 4, '2026-07-13', 'AUSENTE', '2026-07-13 10:32:27'),
(56, 12, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(57, 13, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(58, 14, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(59, 15, 4, '2026-07-13', 'TARDANZA', '2026-07-13 10:32:27'),
(60, 16, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(61, 17, 4, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:27'),
(62, 18, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(63, 19, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(64, 20, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(65, 21, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(66, 22, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(67, 23, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(68, 24, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(69, 25, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(70, 26, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(71, 27, 10, '2026-07-13', 'PRESENTE', '2026-07-13 10:32:56'),
(72, 14, 4, '2026-07-14', 'AUSENTE', '2026-07-13 11:10:06'),
(73, 17, 4, '2026-07-14', 'AUSENTE', '2026-07-13 11:10:06'),
(74, 10, 4, '2026-07-14', 'AUSENTE', '2026-07-13 11:10:06'),
(75, 15, 4, '2026-07-14', 'TARDANZA', '2026-07-13 11:10:06'),
(76, 11, 4, '2026-07-14', 'AUSENTE', '2026-07-13 11:10:06'),
(77, 8, 4, '2026-07-14', 'PRESENTE', '2026-07-13 11:10:06'),
(78, 16, 4, '2026-07-14', 'PRESENTE', '2026-07-13 11:10:06'),
(79, 9, 4, '2026-07-14', 'PRESENTE', '2026-07-13 11:10:06'),
(80, 12, 4, '2026-07-14', 'PRESENTE', '2026-07-13 11:10:06'),
(81, 13, 4, '2026-07-14', 'PRESENTE', '2026-07-13 11:10:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificates`
--

CREATE TABLE `certificates` (
  `idcertificate` int(11) NOT NULL,
  `certificate_code` varchar(30) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `idenrollment` int(11) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `observations` text DEFAULT NULL,
  `issue_date` date NOT NULL,
  `issued_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `certificates`
--

INSERT INTO `certificates` (`idcertificate`, `certificate_code`, `idstudent`, `idenrollment`, `purpose`, `observations`, `issue_date`, `issued_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 'CE-2026-0001', 22, 128, 'Sustento de programas sociales', NULL, '2026-07-13', 15, 1, '2026-07-13 10:41:31', '2026-07-13 10:41:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `idcourse` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `iddegree` int(11) NOT NULL,
  `idsubgrade` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `idsemester` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`idcourse`, `course_name`, `iddegree`, `idsubgrade`, `photo`, `status`, `idsemester`) VALUES
(8, 'Matemática', 1, 1, '1783919330_1782942218_738375.png', 1, 1),
(9, 'Comunicación', 1, 1, '1783919330_1782948932_course_300301.png', 1, 1),
(10, 'Ciencia y Tecnología', 1, 1, '1783919330_1782948913_course_373872.png', 1, 1),
(11, 'Personal Social', 1, 1, '1783919330_1782948913_course_373872.png', 1, 1),
(12, 'Arte y Cultura', 1, 1, '1783919330_1782948932_course_300301.png', 1, 1),
(13, 'Educación Física', 1, 1, '1783919330_1782948913_course_373872.png', 1, 1),
(14, 'Matemática', 1, 3, '1783919428_1782942218_738375.png', 1, 1),
(15, 'Comunicación', 1, 3, '1783919428_1782948932_course_300301.png', 1, 1),
(16, 'Ciencia y Tecnología', 1, 3, '1783919428_1782948913_course_373872.png', 1, 1),
(17, 'Personal Social', 1, 3, '1783919428_1782948913_course_373872.png', 1, 1),
(18, 'Arte y Cultura', 1, 3, '1783919428_1782948932_course_300301.png', 1, 1),
(19, 'Educación Física', 1, 3, '1783919428_1782948913_course_373872.png', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `course_teacher`
--

CREATE TABLE `course_teacher` (
  `idcourse_teacher` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL,
  `idteacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `course_teacher`
--

INSERT INTO `course_teacher` (`idcourse_teacher`, `idcourse`, `idteacher`) VALUES
(8, 8, 7),
(9, 9, 8),
(10, 10, 9),
(11, 11, 10),
(12, 12, 11),
(13, 13, 12),
(14, 14, 7),
(15, 15, 8),
(16, 16, 9),
(17, 17, 10),
(18, 18, 11),
(19, 19, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `degrees`
--

CREATE TABLE `degrees` (
  `iddegree` int(11) NOT NULL,
  `degree_name` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `idsemester` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `degrees`
--

INSERT INTO `degrees` (`iddegree`, `degree_name`, `status`, `idsemester`) VALUES
(1, 'Nivel Primaria', 1, 1),
(2, 'Nivel Secundaria', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollments`
--

CREATE TABLE `enrollments` (
  `idenrollment` int(11) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `idsection` int(11) NOT NULL,
  `enrollment_date` date NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `enrollments`
--

INSERT INTO `enrollments` (`idenrollment`, `idstudent`, `idsection`, `enrollment_date`, `status`) VALUES
(14, 8, 4, '2026-07-13', 1),
(15, 9, 4, '2026-07-13', 1),
(16, 10, 4, '2026-07-13', 1),
(17, 11, 4, '2026-07-13', 1),
(18, 12, 4, '2026-07-13', 1),
(19, 13, 4, '2026-07-13', 1),
(20, 14, 4, '2026-07-13', 1),
(21, 15, 4, '2026-07-13', 1),
(22, 16, 4, '2026-07-13', 1),
(23, 17, 4, '2026-07-13', 1),
(24, 8, 5, '2026-07-13', 1),
(25, 9, 5, '2026-07-13', 1),
(26, 10, 5, '2026-07-13', 1),
(27, 11, 5, '2026-07-13', 1),
(28, 12, 5, '2026-07-13', 1),
(29, 13, 5, '2026-07-13', 1),
(30, 14, 5, '2026-07-13', 1),
(31, 15, 5, '2026-07-13', 1),
(32, 16, 5, '2026-07-13', 1),
(33, 17, 5, '2026-07-13', 1),
(34, 8, 6, '2026-07-13', 1),
(35, 9, 6, '2026-07-13', 1),
(36, 10, 6, '2026-07-13', 1),
(37, 11, 6, '2026-07-13', 1),
(38, 12, 6, '2026-07-13', 1),
(39, 13, 6, '2026-07-13', 1),
(40, 14, 6, '2026-07-13', 1),
(41, 15, 6, '2026-07-13', 1),
(42, 16, 6, '2026-07-13', 1),
(43, 17, 6, '2026-07-13', 1),
(44, 8, 7, '2026-07-13', 1),
(45, 10, 7, '2026-07-13', 1),
(46, 9, 7, '2026-07-13', 1),
(47, 11, 7, '2026-07-13', 1),
(48, 12, 7, '2026-07-13', 1),
(49, 13, 7, '2026-07-13', 1),
(50, 14, 7, '2026-07-13', 1),
(51, 15, 7, '2026-07-13', 1),
(52, 16, 7, '2026-07-13', 1),
(53, 17, 7, '2026-07-13', 1),
(54, 8, 8, '2026-07-13', 1),
(55, 9, 8, '2026-07-13', 1),
(56, 10, 8, '2026-07-13', 1),
(57, 11, 8, '2026-07-13', 1),
(58, 12, 8, '2026-07-13', 1),
(59, 13, 8, '2026-07-13', 1),
(60, 14, 8, '2026-07-13', 1),
(61, 15, 8, '2026-07-13', 1),
(62, 16, 8, '2026-07-13', 1),
(63, 17, 8, '2026-07-13', 1),
(64, 8, 9, '2026-07-13', 1),
(65, 9, 9, '2026-07-13', 1),
(66, 10, 9, '2026-07-13', 1),
(67, 11, 9, '2026-07-13', 1),
(68, 12, 9, '2026-07-13', 1),
(69, 13, 9, '2026-07-13', 1),
(70, 14, 9, '2026-07-13', 1),
(71, 15, 9, '2026-07-13', 1),
(72, 16, 9, '2026-07-13', 1),
(73, 17, 9, '2026-07-13', 1),
(74, 18, 10, '2026-07-13', 1),
(75, 19, 10, '2026-07-13', 1),
(76, 20, 10, '2026-07-13', 1),
(77, 21, 10, '2026-07-13', 1),
(78, 22, 10, '2026-07-13', 1),
(79, 23, 10, '2026-07-13', 1),
(80, 24, 10, '2026-07-13', 1),
(81, 25, 10, '2026-07-13', 1),
(82, 26, 10, '2026-07-13', 1),
(83, 27, 10, '2026-07-13', 1),
(84, 18, 11, '2026-07-13', 1),
(85, 19, 11, '2026-07-13', 1),
(86, 20, 11, '2026-07-13', 1),
(87, 21, 11, '2026-07-13', 1),
(88, 22, 11, '2026-07-13', 1),
(89, 23, 11, '2026-07-13', 1),
(90, 24, 11, '2026-07-13', 1),
(91, 25, 11, '2026-07-13', 1),
(92, 26, 11, '2026-07-13', 1),
(93, 27, 11, '2026-07-13', 1),
(94, 18, 12, '2026-07-13', 1),
(95, 19, 12, '2026-07-13', 1),
(96, 20, 12, '2026-07-13', 1),
(97, 21, 12, '2026-07-13', 1),
(98, 22, 12, '2026-07-13', 1),
(99, 23, 12, '2026-07-13', 1),
(100, 24, 12, '2026-07-13', 1),
(101, 25, 12, '2026-07-13', 1),
(102, 26, 12, '2026-07-13', 1),
(103, 27, 12, '2026-07-13', 1),
(104, 18, 13, '2026-07-13', 1),
(105, 19, 13, '2026-07-13', 1),
(106, 20, 13, '2026-07-13', 1),
(107, 21, 13, '2026-07-13', 1),
(108, 22, 13, '2026-07-13', 1),
(109, 23, 13, '2026-07-13', 1),
(110, 24, 13, '2026-07-13', 1),
(111, 25, 13, '2026-07-13', 1),
(112, 26, 13, '2026-07-13', 1),
(113, 27, 13, '2026-07-13', 1),
(114, 18, 14, '2026-07-13', 1),
(115, 19, 14, '2026-07-13', 1),
(116, 20, 14, '2026-07-13', 1),
(117, 21, 14, '2026-07-13', 1),
(118, 22, 14, '2026-07-13', 1),
(119, 23, 14, '2026-07-13', 1),
(120, 24, 14, '2026-07-13', 1),
(121, 25, 14, '2026-07-13', 1),
(122, 26, 14, '2026-07-13', 1),
(123, 27, 14, '2026-07-13', 1),
(124, 18, 15, '2026-07-13', 1),
(125, 19, 15, '2026-07-13', 1),
(126, 20, 15, '2026-07-13', 1),
(127, 21, 15, '2026-07-13', 1),
(128, 22, 15, '2026-07-13', 1),
(129, 23, 15, '2026-07-13', 1),
(130, 24, 15, '2026-07-13', 1),
(131, 25, 15, '2026-07-13', 1),
(132, 26, 15, '2026-07-13', 1),
(133, 27, 15, '2026-07-13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluation_types`
--

CREATE TABLE `evaluation_types` (
  `idevaluation_type` int(11) NOT NULL,
  `evaluation_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluation_types`
--

INSERT INTO `evaluation_types` (`idevaluation_type`, `evaluation_name`) VALUES
(1, 'PRACTICA'),
(2, 'EXAMEN'),
(3, 'TRABAJO'),
(4, 'FINAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fathers`
--

CREATE TABLE `fathers` (
  `idfather` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `phone` char(9) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fathers`
--

INSERT INTO `fathers` (`idfather`, `iduser`, `dni`, `full_name`, `profession`, `phone`, `address`, `created_at`) VALUES
(5, 59, '45896321', 'Carlos Pérez Díaz', 'Ingeniero Civil', '987654321', 'Jr. Los Pinos 125', '2026-07-13 09:13:11'),
(6, 60, '45896322', 'Manuel Ramírez Castillo', 'Comerciante', '987654322', 'Av. Perú 320', '2026-07-13 09:14:14'),
(7, 61, '45896323', 'Javier Mendoza Torres', 'Contador', '987654323', 'Jr. Amazonas 452', '2026-07-13 09:15:22'),
(8, 62, '45896324', 'Angie Vargas Romero', 'Docente', '987654324', 'Av. Grau 145', '2026-07-13 09:16:57'),
(9, 63, '45896325', 'Pedro Flores Salas', 'Electricista', '987654325', 'Jr. San Martín 210', '2026-07-13 09:18:21'),
(10, 64, '45896326', 'Miguel Castillo Pérez', 'Docente', '987654326', 'Av. Central 98', '2026-07-13 09:25:07'),
(11, 65, '45896327', 'José Salazar Medina', 'Chofer', '987654327', 'Jr. Libertad 321', '2026-07-13 09:26:44'),
(12, 66, '45896328', 'Roberto Herrera León', 'Mecánico', '987654328', 'Av. Unión 455', '2026-07-13 09:27:43'),
(13, 67, '45896329', 'Ricardo Navarro Cruz', 'Administrador', '987654329', 'Jr. Primavera 132', '2026-07-13 09:29:11'),
(14, 68, '45896330', 'Fernando Ramos Vega', 'Policía', '987654330', 'Av. El Sol 560', '2026-07-13 09:30:25'),
(15, 69, '45896331', 'Víctor Paredes López', 'Ingeniero de Sistemas', '987654331', 'Jr. Comercio 87', '2026-07-13 09:35:14'),
(16, 70, '45896332', 'Marco Ortega Díaz', 'Arquitecto', '987654332', 'Av. Miraflores 611', '2026-07-13 09:36:39'),
(17, 71, '45896333', 'Alberto Núñez Salazar', 'Abogado', '987654333', 'Jr. Bolívar 254', '2026-07-13 09:37:47'),
(18, 72, '45896334', 'Héctor Gutiérrez Castro', 'Comerciante', '987654334', 'Av. Los Álamos 412', '2026-07-13 09:38:44'),
(19, 73, '45896335', 'Raúl Moreno Silva', 'Ingeniero Industrial', '987654335', 'Jr. Las Flores 120', '2026-07-13 09:40:32'),
(20, 74, '45896336', 'Óscar Cárdenas Ruiz', 'Médico', '987654336', 'Av. San José 245', '2026-07-13 09:41:45'),
(21, 75, '45896337', 'Julio Delgado Vargas', 'Enfermero', '987654337', 'Jr. Unión 420', '2026-07-13 09:42:55'),
(22, 76, '45896338', 'David Aguilar Soto', 'Técnico Electrónico', '987654338', 'Av. Amazonas 522', '2026-07-13 09:44:08'),
(23, 77, '45896339', 'César Valdez Rojas', 'Empresario', '987654339', 'Jr. Santa Rosa 91', '2026-07-13 09:44:55'),
(24, 78, '45896340', 'Jorge Cabrera Torres', 'Ingeniero Agrónomo', '987654340', 'Av. Progreso 310', '2026-07-13 09:45:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `father_student`
--

CREATE TABLE `father_student` (
  `idfather_student` int(11) NOT NULL,
  `idfather` int(11) NOT NULL,
  `idstudent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `father_student`
--

INSERT INTO `father_student` (`idfather_student`, `idfather`, `idstudent`) VALUES
(4, 5, 8),
(5, 6, 9),
(6, 7, 10),
(7, 8, 11),
(8, 9, 12),
(9, 10, 13),
(10, 11, 14),
(11, 12, 15),
(12, 13, 16),
(13, 14, 17),
(14, 15, 18),
(15, 16, 19),
(16, 17, 20),
(17, 18, 21),
(18, 19, 22),
(19, 20, 23),
(20, 21, 24),
(21, 22, 25),
(22, 23, 26),
(23, 24, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grades`
--

CREATE TABLE `grades` (
  `idgrade` int(11) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `idcourse` int(11) NOT NULL,
  `idevaluation_type` int(11) NOT NULL,
  `grade` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `idsection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grades`
--

INSERT INTO `grades` (`idgrade`, `idstudent`, `idcourse`, `idevaluation_type`, `grade`, `created_at`, `idsection`) VALUES
(38, 8, 8, 1, 12.00, '2026-07-13 05:38:48', 4),
(39, 9, 8, 1, 11.00, '2026-07-13 05:38:48', 4),
(40, 10, 8, 1, 14.00, '2026-07-13 05:38:48', 4),
(41, 11, 8, 1, 12.00, '2026-07-13 05:38:48', 4),
(42, 12, 8, 1, 16.00, '2026-07-13 05:38:48', 4),
(43, 13, 8, 1, 13.00, '2026-07-13 05:38:48', 4),
(44, 14, 8, 1, 12.00, '2026-07-13 05:38:48', 4),
(45, 15, 8, 1, 12.00, '2026-07-13 05:38:48', 4),
(46, 16, 8, 1, 9.00, '2026-07-13 05:38:48', 4),
(47, 17, 8, 1, 12.00, '2026-07-13 05:38:48', 4),
(48, 14, 8, 2, 12.00, '2026-07-13 11:15:13', 4),
(49, 17, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(50, 10, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(51, 15, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(52, 11, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(53, 8, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(54, 16, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(55, 9, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(56, 12, 8, 2, 13.00, '2026-07-13 11:15:13', 4),
(57, 13, 8, 2, 13.00, '2026-07-13 11:15:13', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grade_certificates`
--

CREATE TABLE `grade_certificates` (
  `idgradecertificate` int(11) NOT NULL,
  `certificate_code` varchar(30) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `idenrollment` int(11) DEFAULT NULL,
  `idperiod` int(11) DEFAULT NULL,
  `purpose` varchar(255) NOT NULL,
  `observations` text DEFAULT NULL,
  `issue_date` date NOT NULL,
  `issued_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grade_certificates`
--

INSERT INTO `grade_certificates` (`idgradecertificate`, `certificate_code`, `idstudent`, `idenrollment`, `idperiod`, `purpose`, `observations`, `issue_date`, `issued_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 'CN-2026-0001', 8, 64, 1, 'Trámites diversos', NULL, '2026-07-13', 15, 1, '2026-07-13 10:42:13', '2026-07-13 10:42:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `idmessage` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `sender_deleted` tinyint(1) DEFAULT 0,
  `receiver_deleted` tinyint(1) DEFAULT 0,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`idmessage`, `sender_id`, `receiver_id`, `subject`, `message`, `is_read`, `sender_deleted`, `receiver_deleted`, `sent_at`) VALUES
(4, 15, 29, 'Prueba de formalidad de Mensajes', 'Prueba de formalidad de Mensajes por el dia de hoy', 1, 0, 0, '2026-07-13 05:47:42'),
(5, 59, 15, 'Prueba de formalidad de Mensajes', 'Prueba de formalidad de Mensajes', 0, 0, 0, '2026-07-13 05:59:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_07_000001_create_academic_documents_table', 2),
(5, '2026_07_07_000002_create_transfer_requests_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `idnotification` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('MESSAGE','GRADE','ATTENDANCE','ENROLLMENT','SYSTEM') NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`idnotification`, `iduser`, `title`, `description`, `type`, `is_read`, `created_at`) VALUES
(1, 29, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(2, 59, 'Asistencia de Juan Pérez Gómez', 'La asistencia de Juan Pérez Gómez del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(3, 30, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(4, 60, 'Asistencia de Luis Ramírez Torres', 'La asistencia de Luis Ramírez Torres del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(5, 31, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(6, 61, 'Asistencia de Carlos Mendoza Ruiz', 'La asistencia de Carlos Mendoza Ruiz del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(7, 32, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(8, 62, 'Asistencia de José Vargas Díaz', 'La asistencia de José Vargas Díaz del día 2026-07-13 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(9, 33, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(10, 63, 'Asistencia de Miguel Flores Rojas', 'La asistencia de Miguel Flores Rojas del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(11, 34, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(12, 64, 'Asistencia de Pedro Castillo León', 'La asistencia de Pedro Castillo León del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(13, 35, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(14, 65, 'Asistencia de Andrés Salazar Cruz', 'La asistencia de Andrés Salazar Cruz del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(15, 36, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: TARDANZA', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(16, 66, 'Asistencia de Diego Herrera Soto', 'La asistencia de Diego Herrera Soto del día 2026-07-13 fue registrada como: TARDANZA', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(17, 37, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(18, 67, 'Asistencia de Kevin Navarro Silva', 'La asistencia de Kevin Navarro Silva del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(19, 38, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(20, 68, 'Asistencia de Anthony Ramos Chávez', 'La asistencia de Anthony Ramos Chávez del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:27'),
(21, 39, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(22, 69, 'Asistencia de Cristian Paredes Cueva', 'La asistencia de Cristian Paredes Cueva del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(23, 40, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(24, 70, 'Asistencia de Fernando Ortega Peña', 'La asistencia de Fernando Ortega Peña del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(25, 41, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(26, 71, 'Asistencia de Jorge Núñez Castro', 'La asistencia de Jorge Núñez Castro del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(27, 42, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(28, 72, 'Asistencia de Brayan Gutiérrez Ríos', 'La asistencia de Brayan Gutiérrez Ríos del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(29, 43, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(30, 73, 'Asistencia de Alex Moreno Vega', 'La asistencia de Alex Moreno Vega del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(31, 44, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(32, 74, 'Asistencia de Ricardo Cárdenas López', 'La asistencia de Ricardo Cárdenas López del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(33, 45, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(34, 75, 'Asistencia de Samuel Delgado Ortiz', 'La asistencia de Samuel Delgado Ortiz del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(35, 46, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(36, 76, 'Asistencia de Marco Aguilar Reyes', 'La asistencia de Marco Aguilar Reyes del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(37, 47, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(38, 77, 'Asistencia de Daniel Valdez Campos', 'La asistencia de Daniel Valdez Campos del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(39, 48, 'Registro de asistencia', 'Tu asistencia del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(40, 78, 'Asistencia de Renzo Cabrera Medina', 'La asistencia de Renzo Cabrera Medina del día 2026-07-13 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 10:32:56'),
(41, 29, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(42, 59, 'Nueva nota de Juan Pérez Gómez', 'Se ha registrado una nueva calificación para Juan Pérez Gómez. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(43, 30, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 11', 'GRADE', 0, '2026-07-13 10:38:48'),
(44, 60, 'Nueva nota de Luis Ramírez Torres', 'Se ha registrado una nueva calificación para Luis Ramírez Torres. Calificación: 11', 'GRADE', 0, '2026-07-13 10:38:48'),
(45, 31, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 14', 'GRADE', 0, '2026-07-13 10:38:48'),
(46, 61, 'Nueva nota de Carlos Mendoza Ruiz', 'Se ha registrado una nueva calificación para Carlos Mendoza Ruiz. Calificación: 14', 'GRADE', 0, '2026-07-13 10:38:48'),
(47, 32, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(48, 62, 'Nueva nota de José Vargas Díaz', 'Se ha registrado una nueva calificación para José Vargas Díaz. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(49, 33, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 16', 'GRADE', 0, '2026-07-13 10:38:48'),
(50, 63, 'Nueva nota de Miguel Flores Rojas', 'Se ha registrado una nueva calificación para Miguel Flores Rojas. Calificación: 16', 'GRADE', 0, '2026-07-13 10:38:48'),
(51, 34, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 13', 'GRADE', 0, '2026-07-13 10:38:48'),
(52, 64, 'Nueva nota de Pedro Castillo León', 'Se ha registrado una nueva calificación para Pedro Castillo León. Calificación: 13', 'GRADE', 0, '2026-07-13 10:38:48'),
(53, 35, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(54, 65, 'Nueva nota de Andrés Salazar Cruz', 'Se ha registrado una nueva calificación para Andrés Salazar Cruz. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(55, 36, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(56, 66, 'Nueva nota de Diego Herrera Soto', 'Se ha registrado una nueva calificación para Diego Herrera Soto. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(57, 37, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 09', 'GRADE', 0, '2026-07-13 10:38:48'),
(58, 67, 'Nueva nota de Kevin Navarro Silva', 'Se ha registrado una nueva calificación para Kevin Navarro Silva. Calificación: 09', 'GRADE', 0, '2026-07-13 10:38:48'),
(59, 38, 'Nueva nota registrada', 'Se ha publicado una nueva nota para ti. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(60, 68, 'Nueva nota de Anthony Ramos Chávez', 'Se ha registrado una nueva calificación para Anthony Ramos Chávez. Calificación: 12', 'GRADE', 0, '2026-07-13 10:38:48'),
(61, 35, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(62, 65, 'Asistencia de Andrés Salazar Cruz', 'La asistencia de Andrés Salazar Cruz del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(63, 38, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(64, 68, 'Asistencia de Anthony Ramos Chávez', 'La asistencia de Anthony Ramos Chávez del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(65, 31, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(66, 61, 'Asistencia de Carlos Mendoza Ruiz', 'La asistencia de Carlos Mendoza Ruiz del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(67, 36, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: TARDANZA', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(68, 66, 'Asistencia de Diego Herrera Soto', 'La asistencia de Diego Herrera Soto del día 2026-07-14 fue registrada como: TARDANZA', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(69, 32, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(70, 62, 'Asistencia de José Vargas Díaz', 'La asistencia de José Vargas Díaz del día 2026-07-14 fue registrada como: AUSENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(71, 29, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(72, 59, 'Asistencia de Juan Pérez Gómez', 'La asistencia de Juan Pérez Gómez del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(73, 37, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(74, 67, 'Asistencia de Kevin Navarro Silva', 'La asistencia de Kevin Navarro Silva del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(75, 30, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(76, 60, 'Asistencia de Luis Ramírez Torres', 'La asistencia de Luis Ramírez Torres del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(77, 33, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(78, 63, 'Asistencia de Miguel Flores Rojas', 'La asistencia de Miguel Flores Rojas del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(79, 34, 'Registro de asistencia', 'Tu asistencia del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(80, 64, 'Asistencia de Pedro Castillo León', 'La asistencia de Pedro Castillo León del día 2026-07-14 fue registrada como: PRESENTE', 'ATTENDANCE', 0, '2026-07-13 11:10:06'),
(81, 35, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 12', 'GRADE', 0, '2026-07-13 11:15:13'),
(82, 65, 'Nueva nota de Andrés Salazar Cruz', 'Se ha registrado una nueva calificación para Andrés Salazar Cruz en el curso de Matemática. Calificación: 12', 'GRADE', 0, '2026-07-13 11:15:13'),
(83, 38, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(84, 68, 'Nueva nota de Anthony Ramos Chávez', 'Se ha registrado una nueva calificación para Anthony Ramos Chávez en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(85, 31, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(86, 61, 'Nueva nota de Carlos Mendoza Ruiz', 'Se ha registrado una nueva calificación para Carlos Mendoza Ruiz en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(87, 36, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(88, 66, 'Nueva nota de Diego Herrera Soto', 'Se ha registrado una nueva calificación para Diego Herrera Soto en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(89, 32, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(90, 62, 'Nueva nota de José Vargas Díaz', 'Se ha registrado una nueva calificación para José Vargas Díaz en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(91, 29, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(92, 59, 'Nueva nota de Juan Pérez Gómez', 'Se ha registrado una nueva calificación para Juan Pérez Gómez en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(93, 37, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(94, 67, 'Nueva nota de Kevin Navarro Silva', 'Se ha registrado una nueva calificación para Kevin Navarro Silva en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(95, 30, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(96, 60, 'Nueva nota de Luis Ramírez Torres', 'Se ha registrado una nueva calificación para Luis Ramírez Torres en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(97, 33, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(98, 63, 'Nueva nota de Miguel Flores Rojas', 'Se ha registrado una nueva calificación para Miguel Flores Rojas en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(99, 34, 'Nueva nota registrada - Matemática', 'Se ha publicado una nueva nota para ti en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13'),
(100, 64, 'Nueva nota de Pedro Castillo León', 'Se ha registrado una nueva calificación para Pedro Castillo León en el curso de Matemática. Calificación: 13', 'GRADE', 0, '2026-07-13 11:15:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periods`
--

CREATE TABLE `periods` (
  `idperiod` int(11) NOT NULL,
  `period_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periods`
--

INSERT INTO `periods` (`idperiod`, `period_name`, `start_date`, `end_date`, `status`, `created_at`) VALUES
(1, 'Periodo 2026 - I', '2026-07-01', '2026-12-14', 1, '2026-05-18 00:49:08'),
(2, 'Periodo 2026 - II', '2026-07-03', '2026-12-31', 0, '2026-05-18 00:49:08'),
(9, 'Periodo 2027 - I', '2027-03-15', '2027-07-23', 0, '2026-07-13 09:47:19'),
(10, 'Periodo 2027- Il', '2027-07-30', '2027-12-17', 0, '2026-07-13 09:47:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrole` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrole`, `role_name`) VALUES
(1, 'ADMIN'),
(4, 'FATHER'),
(3, 'STUDENT'),
(2, 'TEACHER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedules`
--

CREATE TABLE `schedules` (
  `idschedule` int(11) NOT NULL,
  `idsection` int(11) NOT NULL,
  `day_week` enum('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sections`
--

CREATE TABLE `sections` (
  `idsection` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `idcourse` int(11) NOT NULL,
  `capacity` int(11) DEFAULT 30,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sections`
--

INSERT INTO `sections` (`idsection`, `section_name`, `idcourse`, `capacity`, `status`) VALUES
(4, 'A', 8, 30, 1),
(5, 'A', 9, 30, 1),
(6, 'A', 10, 30, 1),
(7, 'A', 11, 30, 1),
(8, 'A', 12, 30, 1),
(9, 'A', 13, 30, 1),
(10, 'A', 14, 20, 1),
(11, 'A', 15, 20, 1),
(12, 'A', 16, 20, 1),
(13, 'A', 17, 20, 1),
(14, 'A', 18, 20, 1),
(15, 'A', 19, 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semesters`
--

CREATE TABLE `semesters` (
  `idsemester` bigint(20) UNSIGNED NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `idperiod` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `semesters`
--

INSERT INTO `semesters` (`idsemester`, `semester_name`, `idperiod`, `status`) VALUES
(1, 'Primer Semestre', 1, 1),
(2, 'Segundo Semestre', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cDLl6MRyEdtwF7y5KBGGM42c6X0a79BQlP3TW5Bb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFY3UFlnM0hiSnh3ZkRyTWp5TUxpQ3hZRE9pRGE2ZHlqR3ZpYVVwdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1783924111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `idstudent` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`idstudent`, `iduser`, `dni`, `full_name`, `gender`, `birth_date`, `address`, `created_at`) VALUES
(8, 29, '78124561', 'Juan Pérez Gómez', 'M', '2010-02-12', 'Jr. Los Pinos 125', '2026-07-13 08:43:58'),
(9, 30, '78124562', 'Luis Ramírez Torres', 'M', '2014-01-07', 'Av. Perú 320', '2026-07-13 08:45:30'),
(10, 31, '78124563', 'Carlos Mendoza Ruiz', 'M', '2021-06-23', 'Jr. Amazonas 452', '2026-07-13 08:46:48'),
(11, 32, '78124564', 'José Vargas Díaz', 'M', '2011-02-08', 'Av. Grau 145', '2026-07-13 08:47:39'),
(12, 33, '78124565', 'Miguel Flores Rojas', 'M', '2015-02-09', 'Jr. San Martín 210', '2026-07-13 08:48:21'),
(13, 34, '78124566', 'Pedro Castillo León', 'M', '2012-10-16', 'Av. Central 98', '2026-07-13 08:49:04'),
(14, 35, '78124567', 'Andrés Salazar Cruz', 'M', '2011-06-15', 'Jr. Libertad 321', '2026-07-13 08:50:30'),
(15, 36, '78124568', 'Diego Herrera Soto', 'M', '2006-06-13', 'Av. Unión 455', '2026-07-13 08:51:14'),
(16, 37, '78124569', 'Kevin Navarro Silva', 'M', '2011-08-25', 'Jr. Primavera 132', '2026-07-13 08:52:14'),
(17, 38, '78124570', 'Anthony Ramos Chávez', 'M', '2007-12-31', 'Av. El Sol 560', '2026-07-13 08:52:54'),
(18, 39, '78124571', 'Cristian Paredes Cueva', 'M', '2002-10-17', 'Jr. Comercio 87', '2026-07-13 08:53:45'),
(19, 40, '78124572', 'Fernando Ortega Peña', 'M', '2006-10-27', 'Av. Miraflores 611', '2026-07-13 08:54:26'),
(20, 41, '78124573', 'Jorge Núñez Castro', 'M', '2006-10-17', 'Jr. Bolívar 254', '2026-07-13 08:55:03'),
(21, 42, '78124574', 'Brayan Gutiérrez Ríos', 'M', '2004-10-30', 'Av. Los Álamos 412', '2026-07-13 08:55:50'),
(22, 43, '78124575', 'Alex Moreno Vega', 'M', '2010-10-29', 'Jr. Las Flores 120', '2026-07-13 08:56:46'),
(23, 44, '78124576', 'Ricardo Cárdenas López', 'M', '2007-02-05', 'Av. San José 245', '2026-07-13 08:57:30'),
(24, 45, '78124577', 'Samuel Delgado Ortiz', 'M', '2008-04-15', 'Jr. Unión 420', '2026-07-13 08:58:10'),
(25, 46, '78124578', 'Marco Aguilar Reyes', 'M', '2004-11-17', 'Av. Amazonas 522', '2026-07-13 08:58:49'),
(26, 47, '78124579', 'Daniel Valdez Campos', 'M', '2003-10-28', 'Jr. Santa Rosa 91', '2026-07-13 09:00:08'),
(27, 48, '78124580', 'Renzo Cabrera Medina', 'M', '2004-10-13', 'Av. Progreso 310', '2026-07-13 09:01:17'),
(28, 49, '78124581', 'María Pérez Gómez', 'F', '2001-09-25', 'Jr. Los Pinos 130', '2026-07-13 09:01:57'),
(29, 50, '78124582', 'Ana Ramírez Torres', 'F', '2010-06-15', 'Av. Perú 325', '2026-07-13 09:02:52'),
(30, 51, '78124583', 'Lucía Mendoza Ruiz', 'F', '2008-06-15', 'Jr. Amazonas 458', '2026-07-13 09:03:35'),
(31, 52, '78124584', 'Valeria Vargas Díaz', 'F', '2006-10-25', 'Av. Grau 149', '2026-07-13 09:04:18'),
(32, 53, '78124585', 'Camila Flores Rojas', 'F', '2005-06-21', 'Jr. San Martín 218', '2026-07-13 09:05:02'),
(33, 54, '78124586', 'Daniela Castillo León', 'F', '2002-10-30', 'Av. Central 104', '2026-07-13 09:05:43'),
(34, 55, '78124587', 'Sofía Salazar Cruz', 'F', '2008-10-14', 'Jr. Libertad 329', '2026-07-13 09:06:36'),
(35, 56, '78124588', 'Emily Herrera Soto', 'F', '2013-11-14', 'Av. Unión 463', '2026-07-13 09:07:21'),
(36, 57, '78124589', 'Paula Navarro Silva', 'F', '2006-10-24', 'Jr. Primavera 138', '2026-07-13 09:07:58'),
(37, 58, '78124590', 'Natalia Ramos Chávez', 'F', '2004-06-15', 'Av. El Sol 568', '2026-07-13 09:08:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subgrades`
--

CREATE TABLE `subgrades` (
  `idsubgrade` int(11) NOT NULL,
  `subgrade_name` varchar(50) NOT NULL,
  `iddegree` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subgrades`
--

INSERT INTO `subgrades` (`idsubgrade`, `subgrade_name`, `iddegree`, `status`) VALUES
(1, '1° Grado', 1, 1),
(2, '1° Grado', 2, 1),
(3, '2° Grado', 1, 1),
(4, '3° Grado', 1, 0),
(5, '4° Grado', 1, 0),
(6, '2° Grado', 2, 1),
(7, '3° Grado', 2, 0),
(8, '4° Grado', 2, 0),
(9, '5° Grado', 2, 0),
(10, '5° Grado', 1, 0),
(11, '6° Grado', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teachers`
--

CREATE TABLE `teachers` (
  `idteacher` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `phone` char(9) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `teachers`
--

INSERT INTO `teachers` (`idteacher`, `iduser`, `dni`, `full_name`, `gender`, `phone`, `created_at`) VALUES
(7, 79, '47258101', 'Ricardo Mendoza Salazar', 'M', '912345601', '2026-07-13 09:55:46'),
(8, 80, '47258102', 'Patricia Flores Ramírez', 'F', '912345602', '2026-07-13 09:56:26'),
(9, 81, '47258103', 'Carlos Herrera Díaz', 'M', '912345603', '2026-07-13 09:57:15'),
(10, 82, '47258104', 'Rosa Gutiérrez Vargas', 'F', '912345604', '2026-07-13 09:57:52'),
(11, 83, '47258105', 'María Torres León', 'F', '912345605', '2026-07-13 09:58:38'),
(12, 84, '47258106', 'José Castillo Rojas', 'M', '912345606', '2026-07-13 09:59:56'),
(13, 85, '47258107', 'Andrea Navarro Silva', 'F', '912345607', '2026-07-13 10:00:33'),
(14, 86, '47258108', 'Miguel Paredes Cruz', 'M', '912345608', '2026-07-13 10:01:22'),
(15, 87, '47258109', 'Claudia Cárdenas Peña', 'F', '912345609', '2026-07-13 10:02:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_requests`
--

CREATE TABLE `transfer_requests` (
  `idtransfer_request` int(10) UNSIGNED NOT NULL,
  `request_code` varchar(30) NOT NULL,
  `dni` char(8) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `previous_school` varchar(150) NOT NULL,
  `previous_school_code` varchar(30) DEFAULT NULL,
  `origin_grade` varchar(80) DEFAULT NULL,
  `requested_idsection` int(11) DEFAULT NULL,
  `request_date` date NOT NULL,
  `documents_presented` text NOT NULL,
  `observations` text DEFAULT NULL,
  `status` enum('PENDIENTE','OBSERVADO','APROBADO','RECHAZADO') NOT NULL DEFAULT 'PENDIENTE',
  `decision_notes` text DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `idenrollment` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `transfer_requests`
--

INSERT INTO `transfer_requests` (`idtransfer_request`, `request_code`, `dni`, `full_name`, `gender`, `birth_date`, `address`, `previous_school`, `previous_school_code`, `origin_grade`, `requested_idsection`, `request_date`, `documents_presented`, `observations`, `status`, `decision_notes`, `reviewed_by`, `reviewed_at`, `idstudent`, `idenrollment`, `created_at`, `updated_at`) VALUES
(2, 'TR-2026-0001', '72667379', 'Frans Silva Avellaneda', 'M', '2007-04-07', 'Jr. Julio Muñoz', 'UNTRM', '02532', '2° de primaria', 4, '2026-07-13', 'Ninguno', 'Ninguno', 'PENDIENTE', NULL, NULL, NULL, NULL, NULL, '2026-07-13 10:46:32', '2026-07-13 10:46:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idrole` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login_attempts` int(11) DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `username`, `email`, `password`, `idrole`, `photo`, `status`, `created_at`, `updated_at`, `login_attempts`, `locked_until`) VALUES
(1, 'admin01', 'admin@school.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 1, '1778542880_190711.png', 0, '2026-05-11 22:01:39', '2026-05-19 07:25:14', 0, NULL),
(15, 'FARIES', 'faries@gmail.com', '$2y$12$Hlr.D5ra9QJWjdVh6R55VOat/QjgUeS3AGKzshIt1HpKj4xfVmlr.', 1, '1779905170_824389.jpeg', 1, '2026-05-27 23:04:44', '2026-07-02 10:49:50', 0, NULL),
(29, 'juanperez@gmail.com', 'juanperez@gmail.com', '$2y$12$UWXowTwz43ZC3y1M2wJnneBzLqRtThaRnp9xsapbIoGWdiXfv4une', 3, '1783914238_1783395532_767730.jpg', 1, '2026-07-13 08:43:58', '2026-07-13 08:43:58', 0, NULL),
(30, 'luisramirez@gmail.com', 'luisramirez@gmail.com', '$2y$12$6iSClOFNzJ6NMMSczJNi3.dm67XIEKLjSLghHIi3CtVP1qLZ1jquK', 3, '1783914330_1783395532_767730.jpg', 1, '2026-07-13 08:45:30', '2026-07-13 08:45:30', 0, NULL),
(31, 'carlosmendoza@gmail.com', 'carlosmendoza@gmail.com', '$2y$12$lNPOL2FjrrIPKRFX/PzvKOVJR0Ze6lA.SYn2RRwT.2DbpiKHFIygi', 3, '1783914408_1783395532_767730.jpg', 1, '2026-07-13 08:46:48', '2026-07-13 08:46:48', 0, NULL),
(32, 'josevargas@gmail.com', 'josevargas@gmail.com', '$2y$12$m7HCatsnA2mWar.NybVxAu0D4APvTsYnbZcwOdCLoMo3gj7/biqHm', 3, '1783914459_1783395532_767730.jpg', 1, '2026-07-13 08:47:39', '2026-07-13 08:47:39', 0, NULL),
(33, 'miguelflores@gmail.com', 'miguelflores@gmail.com', '$2y$12$.xshxRqzlqv4tB1u4nTDleXa8Qoe/esj9Oh8MznKdzghehKJO1Tqm', 3, '1783914501_1783395532_767730.jpg', 1, '2026-07-13 08:48:21', '2026-07-13 08:48:21', 0, NULL),
(34, 'pedrocastillo@gmail.com', 'pedrocastillo@gmail.com', '$2y$12$BErWFQPZgG1z0qUEw08bIuCst6SFSOrxVklWd1h2X6gm/.Di5/T8m', 3, '1783914544_1783395532_767730.jpg', 1, '2026-07-13 08:49:04', '2026-07-13 08:49:04', 0, NULL),
(35, 'andressalazar@gmail.com', 'andressalazar@gmail.com', '$2y$12$uHHwoy6CJPZwR7wjrjARU.byQbzLB0tR/IRWa7hBMQY6Mo0BfXa.S', 3, '1783914629_1783395532_767730.jpg', 1, '2026-07-13 08:50:30', '2026-07-13 08:50:30', 0, NULL),
(36, 'diegoherrera@gmail.com', 'diegoherrera@gmail.com', '$2y$12$WWrbRsCZ0TeP4iT8eR/TyOgn5FJ.zhKEAPFG3OhpAsC2o0uuZjIhu', 3, '1783914674_1783395532_767730.jpg', 1, '2026-07-13 08:51:14', '2026-07-13 08:51:14', 0, NULL),
(37, 'kevinnavarro@gmail.com', 'kevinnavarro@gmail.com', '$2y$12$tmiBqFl3o/1bur8lgcjLC.SRzZHg6sBk8/22JEg0WZs51CNB1/xRO', 3, '1783914734_1783395532_767730.jpg', 1, '2026-07-13 08:52:14', '2026-07-13 08:52:14', 0, NULL),
(38, 'anthonyramos@gmail.com', 'anthonyramos@gmail.com', '$2y$12$1563aNOXvintSInTFWhukOAblyjshYTfASc3.idp5nGB1lxc2ZdmW', 3, '1783914774_1783395532_767730.jpg', 1, '2026-07-13 08:52:54', '2026-07-13 08:52:54', 0, NULL),
(39, 'cristianparedes@gmail.com', 'cristianparedes@gmail.com', '$2y$12$9EuhLSmgFT12FLnVdhW.tuOznDVbweZx1MFMwdfJINxdm/kt2XnW2', 3, '1783914824_1783395532_767730.jpg', 1, '2026-07-13 08:53:45', '2026-07-13 08:53:45', 0, NULL),
(40, 'fernandoortega@gmail.com', 'fernandoortega@gmail.com', '$2y$12$4iPp87RU2lYRBHKod6uCku2Hv7TUWijYyu.wYfw6RDMbTZY5uNdG2', 3, '1783914866_1783395532_767730.jpg', 1, '2026-07-13 08:54:26', '2026-07-13 08:54:26', 0, NULL),
(41, 'jorgenunez@gmail.com', 'jorgenunez@gmail.com', '$2y$12$BzgbQYWAkjnJPLbp7aAQbeiQbSTxjx2yBr02bXBGtWBEQj/YhW8fi', 3, '1783914902_1783395532_767730.jpg', 1, '2026-07-13 08:55:03', '2026-07-13 08:55:03', 0, NULL),
(42, 'brayangutierrez@gmail.com', 'brayangutierrez@gmail.com', '$2y$12$zDwy6LUYYyhLq/AjxcFJkeR5cNs9v931NaYil1OEIBDcgidhwk2o2', 3, '1783914950_1783395532_767730.jpg', 1, '2026-07-13 08:55:50', '2026-07-13 08:55:50', 0, NULL),
(43, 'alexmoreno@gmail.com', 'alexmoreno@gmail.com', '$2y$12$.NPR8lWr4zc5QUafIDHO/ubrWayfq5yasAg2SVeGY9N3QO.7au/o6', 3, '1783915006_1783395532_767730.jpg', 1, '2026-07-13 08:56:46', '2026-07-13 08:56:46', 0, NULL),
(44, 'ricardocardenas@gmail.com', 'ricardocardenas@gmail.com', '$2y$12$u1SzxSwwvtbgZ5jBrbWRj.xpPgMuDtXbA3ejjRjvlKaYtHy2/8TEq', 3, '1783915050_1783395532_767730.jpg', 1, '2026-07-13 08:57:30', '2026-07-13 08:57:30', 0, NULL),
(45, 'samueldelgado@gmail.com', 'samueldelgado@gmail.com', '$2y$12$YeWNLlnamg.GcU.mDqkx2OkHARZUVm4EnYc671YBUtXDVfrsYK2HG', 3, '1783915089_1783395532_767730.jpg', 1, '2026-07-13 08:58:10', '2026-07-13 08:58:10', 0, NULL),
(46, 'marcoaguilar@gmail.com', 'marcoaguilar@gmail.com', '$2y$12$LRR0cXNKzxMt59wQCfVunuJCh5wVf.uNlIP6vrh33C1bouCWUoMP2', 3, '1783915129_1783395532_767730.jpg', 1, '2026-07-13 08:58:49', '2026-07-13 08:58:49', 0, NULL),
(47, 'danielvaldez@gmail.com', 'danielvaldez@gmail.com', '$2y$12$ZlYRGeMjDNAl.hJMCipju.v5KJqrmlbRXh1JHt2ax6o8kv90IRtta', 3, '1783915208_1783395532_767730.jpg', 1, '2026-07-13 09:00:08', '2026-07-13 09:00:08', 0, NULL),
(48, 'renzocabrera@gmail.com', 'renzocabrera@gmail.com', '$2y$12$2MBrSCTal/h9CQiOX7//B.UfPElmouzuCt65e2hcmMdXRXxnA1M9m', 3, '1783915277_1783395532_767730.jpg', 1, '2026-07-13 09:01:17', '2026-07-13 09:01:17', 0, NULL),
(49, 'mariaperez@gmail.com', 'mariaperez@gmail.com', '$2y$12$rQ1RhZGtlaEGjcz.vlGdxO5YZESV5wPHB/ww0aMsGqrt48KYhFPCy', 3, '1783915317_241793.jpg', 1, '2026-07-13 09:01:57', '2026-07-13 09:01:57', 0, NULL),
(50, 'anaramirez@gmail.com', 'anaramirez@gmail.com', '$2y$12$KPq88aNGMFv/zWqZ.J677OMuUy4OryDItqBuvnCCucAPRWUifao/G', 3, '1783915371_241793.jpg', 1, '2026-07-13 09:02:52', '2026-07-13 09:02:52', 0, NULL),
(51, 'luciamendoza@gmail.com', 'luciamendoza@gmail.com', '$2y$12$43cDo/b7WalRCIp7f0FjU.snLl5diSklP1urP7YWtrRLbwk9.Acy2', 3, '1783915415_241793.jpg', 1, '2026-07-13 09:03:35', '2026-07-13 09:03:35', 0, NULL),
(52, 'valeriavargas@gmail.com', 'valeriavargas@gmail.com', '$2y$12$gorWUmNuYNKezUihASsSAOtf3J5OQJJ7hcZJ2qM81o86NFVIRf2wq', 3, '1783915457_241793.jpg', 1, '2026-07-13 09:04:18', '2026-07-13 09:04:18', 0, NULL),
(53, 'camilaflores@gmail.com', 'camilaflores@gmail.com', '$2y$12$lMFGNYYnsYVkTix6M5ncn.zIl/XgqYzO6Z5Jlzd5MODEmgEQPBhCO', 3, '1783915502_241793.jpg', 1, '2026-07-13 09:05:02', '2026-07-13 09:05:02', 0, NULL),
(54, 'danielacastillo@gmail.com', 'danielacastillo@gmail.com', '$2y$12$ioBEnBy5JkGnN1F2VuIr9OSS12s/FZr7AoJIGp8NWk1x3HnfGcNwO', 3, '1783915543_241793.jpg', 1, '2026-07-13 09:05:43', '2026-07-13 09:05:43', 0, NULL),
(55, 'sofiasalazar@gmail.com', 'sofiasalazar@gmail.com', '$2y$12$HH8b8akVX4CHwm9EFTwuqeTOkUrGS3wG5UpCB7nMTT5r6mTLJ685e', 3, '1783915596_241793.jpg', 1, '2026-07-13 09:06:36', '2026-07-13 09:06:36', 0, NULL),
(56, 'emilyherrera@gmail.com', 'emilyherrera@gmail.com', '$2y$12$siEctdTdPSxFiVh3LI4m2eHOdDsj4dd8MM/URGBjz2XOetuvaCb16', 3, '1783915640_241793.jpg', 1, '2026-07-13 09:07:21', '2026-07-13 09:07:21', 0, NULL),
(57, 'paulanavarro@gmail.com', 'paulanavarro@gmail.com', '$2y$12$CykHdJUyJtxg9bdLrl7Va.6ZZTzLvbs5B2Ms.K8ykeADfl2akRN92', 3, '1783915678_241793.jpg', 1, '2026-07-13 09:07:58', '2026-07-13 09:07:58', 0, NULL),
(58, 'nataliaramos@gmail.com', 'nataliaramos@gmail.com', '$2y$12$1Ry210SMUSQQ0xwusLPoh.4x/1arkLb4ukKVllYCWZP/lNK1aGJk2', 3, '1783915723_241793.jpg', 1, '2026-07-13 09:08:43', '2026-07-13 09:08:43', 0, NULL),
(59, 'carlosperez@gmail.com', 'carlosperez@gmail.com', '$2y$12$.IQhl94yARB5hq.fGtBui.fYpCHvSUjykDtF/pepIXD/fZXU4.6Nm', 4, '1783915990_1782921613_1779905216_192873.png', 1, '2026-07-13 09:13:11', '2026-07-13 09:13:11', 0, NULL),
(60, 'manuelramirez@gmail.com', 'manuelramirez@gmail.com', '$2y$12$kTRxRpLqkztE/ylREA6ti..BD6mpouN2a5Dyb9o//o4Kc4iRtg9G.', 4, '1783916054_1782921613_1779905216_192873.png', 1, '2026-07-13 09:14:14', '2026-07-13 09:14:14', 0, NULL),
(61, 'javiermendoza@gmail.com', 'javiermendoza@gmail.com', '$2y$12$RTOgR2f1jbHMCU4ws9aRl.UvHW0hx2XZVqbzTStrKRqI7SLy3BFk6', 4, '1783916121_1782921613_1779905216_192873.png', 1, '2026-07-13 09:15:22', '2026-07-13 09:15:22', 0, NULL),
(62, 'angievargas@gmail.com', 'angievargas@gmail.com', '$2y$12$MyTx4pUOmXbIzcqfUehLiewWkp61FOHiZa04.1ioru0wAB3CaL5KW', 4, '1783916216_1782921563_227851.png', 1, '2026-07-13 09:16:57', '2026-07-13 09:16:57', 0, NULL),
(63, 'pedroflores@gmail.com', 'pedroflores@gmail.com', '$2y$12$BXLKc9bkMb99iAB9U6f94e.5Tdh7IKWcN1S1m53BIC/H3NPGeHwtm', 4, '1783916301_1782921613_1779905216_192873.png', 1, '2026-07-13 09:18:21', '2026-07-13 09:18:21', 0, NULL),
(64, 'miguelcastillo@gmail.com', 'miguelcastillo@gmail.com', '$2y$12$Au/3uT02E4fyX14q5Hx8qumJRyWzVQRFv9HFDyYkdGD0Xs6Ody3ru', 4, '1783916706_1782921613_1779905216_192873.png', 1, '2026-07-13 09:25:07', '2026-07-13 09:25:07', 0, NULL),
(65, 'josesalazar@gmail.com', 'josesalazar@gmail.com', '$2y$12$Ckx4obcQr6Imn.Mhd1TtnuSVccJDuuneYjVpY9pa.I.SdGsglAaoq', 4, '1783916804_1782921613_1779905216_192873.png', 1, '2026-07-13 09:26:44', '2026-07-13 09:26:44', 0, NULL),
(66, 'robertoherrera@gmail.com', 'robertoherrera@gmail.com', '$2y$12$4lWJGJKUVQ/i7sliJ2VVve7k1YgWPEBwt.QbSel8kjxqTWkfflI/6', 4, '1783916863_1782921613_1779905216_192873.png', 1, '2026-07-13 09:27:43', '2026-07-13 09:27:43', 0, NULL),
(67, 'ricardonavarro@gmail.com', 'ricardonavarro@gmail.com', '$2y$12$5Kk1QVUZEm.UdQ8OQT4I8.BbEaDCDhSeglJsfbRO.v8CNveCgK02O', 4, '1783916951_1782921613_1779905216_192873.png', 1, '2026-07-13 09:29:11', '2026-07-13 09:29:11', 0, NULL),
(68, 'fernandoramos@gmail.com', 'fernandoramos@gmail.com', '$2y$12$qSGYhMJ7hwMjvnWIYudHPO4KXplc1C46tnrWkyQd2luGJzGy0x0YG', 4, '1783917025_1782921613_1779905216_192873.png', 1, '2026-07-13 09:30:25', '2026-07-13 09:30:25', 0, NULL),
(69, 'victorparedes@gmail.com', 'victorparedes@gmail.com', '$2y$12$cRoAXjKQVue4ehHumo/05OIAFhyx3qYtpJaLQLqC.N5khVptmlTjG', 4, '1783917314_1782921613_1779905216_192873.png', 1, '2026-07-13 09:35:14', '2026-07-13 09:35:14', 0, NULL),
(70, 'marcoortega@gmail.com', 'marcoortega@gmail.com', '$2y$12$k.aGJYj0MbxlFGE6fDnmEeCDCEmNLxZ4/PJ9GNi7RefZBMOXDrjQi', 4, '1783917399_1782921613_1779905216_192873.png', 1, '2026-07-13 09:36:39', '2026-07-13 09:36:39', 0, NULL),
(71, 'albertonunez@gmail.com', 'albertonunez@gmail.com', '$2y$12$tExWpGrU5f.0y3QmWx5rq.vGd4rV.qTtMr9PkJi2pi/2WG39MPxg.', 4, '1783917466_1782921613_1779905216_192873.png', 1, '2026-07-13 09:37:47', '2026-07-13 09:37:47', 0, NULL),
(72, 'hectorgutierrez@gmail.com', 'hectorgutierrez@gmail.com', '$2y$12$9t9wn1XBFTKPMObZIEU2XeeI1TPYFQSYqb5Gh3XE35kQ9ax.pm6Aq', 4, '1783917524_1782921613_1779905216_192873.png', 1, '2026-07-13 09:38:44', '2026-07-13 09:38:44', 0, NULL),
(73, 'raulmoreno@gmail.com', 'raulmoreno@gmail.com', '$2y$12$3SHpbD9V697LSSxoxxckA.REMrMT1BgGMybfRBXcYinCKLO58b946', 4, '1783917632_1782921613_1779905216_192873.png', 1, '2026-07-13 09:40:32', '2026-07-13 09:40:32', 0, NULL),
(74, 'oscarcardenas@gmail.com', 'oscarcardenas@gmail.com', '$2y$12$D4Y775YDEZQ1fCWz6b2uaeAKk5hMxJrT/IIWSespNolZHME0q4C66', 4, '1783917705_1782921613_1779905216_192873.png', 1, '2026-07-13 09:41:45', '2026-07-13 09:41:45', 0, NULL),
(75, 'juliodelgado@gmail.com', 'juliodelgado@gmail.com', '$2y$12$Pylc1bYIY8HqeNs.UE//2.vgSv3DHSwu8hnY0IwBCsBzRewraLn0W', 4, '1783917775_1782921613_1779905216_192873.png', 1, '2026-07-13 09:42:55', '2026-07-13 09:42:55', 0, NULL),
(76, 'davidaguilar@gmail.com', 'davidaguilar@gmail.com', '$2y$12$Pt3dtD78zfkN9eezYqf51ebchhnIPrvJPzn89VVkAEoJMbZ5lfzqy', 4, '1783917848_1782921613_1779905216_192873.png', 1, '2026-07-13 09:44:08', '2026-07-13 09:44:08', 0, NULL),
(77, 'cesarvaldez@gmail.com', 'cesarvaldez@gmail.com', '$2y$12$/2cIOEkMAJNBpI4shKCnKekme9W87GJ6P0ZhN0Uy0KDldt8y3h1tK', 4, '1783917895_1782921613_1779905216_192873.png', 1, '2026-07-13 09:44:55', '2026-07-13 09:44:55', 0, NULL),
(78, 'jorgecabrera@gmail.com', 'jorgecabrera@gmail.com', '$2y$12$t01jqXVhr3i1XC5Sn0olyexAjqR03wulK4Vx9xosDUCYqoKfwcXfO', 4, '1783917948_1782921613_1779905216_192873.png', 1, '2026-07-13 09:45:49', '2026-07-13 09:45:49', 0, NULL),
(79, 'ricardomendoza@gmail.com', 'ricardomendoza@gmail.com', '$2y$12$vkeoR0XRpTNysOByIgOpEubIYyPcoHy9s19yAM1kB/gjzTM4Oj1YS', 2, '1783918546_190711.png', 1, '2026-07-13 09:55:46', '2026-07-13 09:55:46', 0, NULL),
(80, 'patriciaflores@gmail.com', 'patriciaflores@gmail.com', '$2y$12$dko.w1oJvch76tllVum7s.VU2.rcE89auej8/VBUc/.O.t/mpOhi6', 2, '1783918586_34552.png', 1, '2026-07-13 09:56:26', '2026-07-13 09:56:26', 0, NULL),
(81, 'carlosherrera@gmail.com', 'carlosherrera@gmail.com', '$2y$12$zUFhrPjk8ZE8z5w79b.3zOl3uPAyOlQ7yDKkO4dG0PKM2m2K11AtK', 2, '1783918635_190711.png', 1, '2026-07-13 09:57:15', '2026-07-13 09:57:15', 0, NULL),
(82, 'rosagutierrez@gmail.com', 'rosagutierrez@gmail.com', '$2y$12$B/I.Wz0FWbcjelxlHX4doeejg45RTutJq.EcML5emmfy4ouk1w3Z2', 2, '1783918671_34552.png', 1, '2026-07-13 09:57:52', '2026-07-13 09:57:52', 0, NULL),
(83, 'mariatorres@gmail.com', 'mariatorres@gmail.com', '$2y$12$0DEoY4gFXJiY7xUYDLC2zusaBO.CILn7XKNFF8OtqfIdcn8NHJsdS', 2, '1783918718_34552.png', 1, '2026-07-13 09:58:38', '2026-07-13 09:58:38', 0, NULL),
(84, 'josecastillo@gmail.com', 'josecastillo@gmail.com', '$2y$12$KhKRWZPPxqmEkzupTXj.heBS91Rxr/SB1VdM8EpsL3EfpqsRD6vO2', 2, '1783918796_190711.png', 1, '2026-07-13 09:59:56', '2026-07-13 09:59:56', 0, NULL),
(85, 'andreanavarro@gmail.com', 'andreanavarro@gmail.com', '$2y$12$oKUcSG85w5mTd39AOTP5YOzMy274bz5a6.6GvyUROw2ytvMK94uzS', 2, '1783918833_34552.png', 1, '2026-07-13 10:00:33', '2026-07-13 10:00:33', 0, NULL),
(86, 'miguelparedes@gmail.com', 'miguelparedes@gmail.com', '$2y$12$HRbaDjMwMVjnt7PXVVO5c.Fob1NokkRK5PQuGYdo01QjISv0LULWS', 2, '1783918882_190711.png', 1, '2026-07-13 10:01:22', '2026-07-13 10:01:22', 0, NULL),
(87, 'claudiacardenas@gmail.com', 'claudiacardenas@gmail.com', '$2y$12$bAOkKq.RGrrKixPQOjT.BO8impIR6sCyI3pj/oDS5xZBVkQAtkDRK', 2, '1783918922_34552.png', 1, '2026-07-13 10:02:02', '2026-07-13 10:02:02', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academic_documents`
--
ALTER TABLE `academic_documents`
  ADD PRIMARY KEY (`idacademic_document`),
  ADD UNIQUE KEY `academic_documents_document_code_unique` (`document_code`),
  ADD KEY `academic_documents_document_code_index` (`document_code`),
  ADD KEY `academic_documents_document_type_index` (`document_type`),
  ADD KEY `academic_documents_idstudent_index` (`idstudent`),
  ADD KEY `academic_documents_status_index` (`status`);

--
-- Indices de la tabla `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`idattendance`),
  ADD UNIQUE KEY `unique_attendance` (`idstudent`,`idsection`,`attendance_date`),
  ADD KEY `fk_attendance_student` (`idstudent`),
  ADD KEY `fk_attendance_section` (`idsection`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`idcertificate`),
  ADD UNIQUE KEY `certificate_code` (`certificate_code`),
  ADD KEY `idx_certificates_student` (`idstudent`),
  ADD KEY `idx_certificates_issue_date` (`issue_date`),
  ADD KEY `fk_certificates_issuer` (`issued_by`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`idcourse`),
  ADD KEY `fk_course_degree` (`iddegree`),
  ADD KEY `fk_course_subgrade` (`idsubgrade`),
  ADD KEY `fk_course_semester` (`idsemester`);

--
-- Indices de la tabla `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD PRIMARY KEY (`idcourse_teacher`),
  ADD UNIQUE KEY `unique_course_teacher` (`idcourse`,`idteacher`),
  ADD KEY `fk_ct_course` (`idcourse`),
  ADD KEY `fk_ct_teacher` (`idteacher`);

--
-- Indices de la tabla `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`iddegree`),
  ADD KEY `fk_degree_semester` (`idsemester`);

--
-- Indices de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`idenrollment`),
  ADD UNIQUE KEY `unique_enrollment` (`idstudent`,`idsection`),
  ADD KEY `fk_enrollment_student` (`idstudent`),
  ADD KEY `fk_enrollment_section` (`idsection`);

--
-- Indices de la tabla `evaluation_types`
--
ALTER TABLE `evaluation_types`
  ADD PRIMARY KEY (`idevaluation_type`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `fathers`
--
ALTER TABLE `fathers`
  ADD PRIMARY KEY (`idfather`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_father_user` (`iduser`);

--
-- Indices de la tabla `father_student`
--
ALTER TABLE `father_student`
  ADD PRIMARY KEY (`idfather_student`),
  ADD KEY `fk_fs_father` (`idfather`),
  ADD KEY `fk_fs_student` (`idstudent`);

--
-- Indices de la tabla `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`idgrade`),
  ADD KEY `fk_grade_student` (`idstudent`),
  ADD KEY `fk_grade_course` (`idcourse`),
  ADD KEY `fk_grade_eval` (`idevaluation_type`),
  ADD KEY `fk_grade_section` (`idsection`);

--
-- Indices de la tabla `grade_certificates`
--
ALTER TABLE `grade_certificates`
  ADD PRIMARY KEY (`idgradecertificate`),
  ADD UNIQUE KEY `certificate_code` (`certificate_code`),
  ADD KEY `idx_grade_certificates_student` (`idstudent`),
  ADD KEY `idx_grade_certificates_issue_date` (`issue_date`),
  ADD KEY `fk_gcert_period` (`idperiod`),
  ADD KEY `fk_gcert_issuer` (`issued_by`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idmessage`),
  ADD KEY `fk_message_sender` (`sender_id`),
  ADD KEY `fk_message_receiver` (`receiver_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`idnotification`),
  ADD KEY `fk_notification_user` (`iduser`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`idperiod`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrole`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indices de la tabla `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`idschedule`),
  ADD KEY `fk_schedule_section` (`idsection`);

--
-- Indices de la tabla `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`idsection`),
  ADD KEY `fk_section_course` (`idcourse`);

--
-- Indices de la tabla `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`idsemester`),
  ADD KEY `fk_semester_period` (`idperiod`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`idstudent`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_student_user` (`iduser`);

--
-- Indices de la tabla `subgrades`
--
ALTER TABLE `subgrades`
  ADD PRIMARY KEY (`idsubgrade`),
  ADD KEY `fk_subgrade_degree` (`iddegree`);

--
-- Indices de la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`idteacher`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_teacher_user` (`iduser`);

--
-- Indices de la tabla `transfer_requests`
--
ALTER TABLE `transfer_requests`
  ADD PRIMARY KEY (`idtransfer_request`),
  ADD UNIQUE KEY `transfer_requests_request_code_unique` (`request_code`),
  ADD KEY `transfer_requests_dni_index` (`dni`),
  ADD KEY `transfer_requests_status_index` (`status`),
  ADD KEY `transfer_requests_requested_idsection_index` (`requested_idsection`),
  ADD KEY `transfer_requests_idstudent_index` (`idstudent`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_roles` (`idrole`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academic_documents`
--
ALTER TABLE `academic_documents`
  MODIFY `idacademic_document` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `attendance`
--
ALTER TABLE `attendance`
  MODIFY `idattendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `certificates`
--
ALTER TABLE `certificates`
  MODIFY `idcertificate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `idcourse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `course_teacher`
--
ALTER TABLE `course_teacher`
  MODIFY `idcourse_teacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `degrees`
--
ALTER TABLE `degrees`
  MODIFY `iddegree` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `idenrollment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `evaluation_types`
--
ALTER TABLE `evaluation_types`
  MODIFY `idevaluation_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fathers`
--
ALTER TABLE `fathers`
  MODIFY `idfather` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `father_student`
--
ALTER TABLE `father_student`
  MODIFY `idfather_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `grades`
--
ALTER TABLE `grades`
  MODIFY `idgrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `grade_certificates`
--
ALTER TABLE `grade_certificates`
  MODIFY `idgradecertificate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `idnotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `periods`
--
ALTER TABLE `periods`
  MODIFY `idperiod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sections`
--
ALTER TABLE `sections`
  MODIFY `idsection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `semesters`
--
ALTER TABLE `semesters`
  MODIFY `idsemester` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `subgrades`
--
ALTER TABLE `subgrades`
  MODIFY `idsubgrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `teachers`
--
ALTER TABLE `teachers`
  MODIFY `idteacher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `transfer_requests`
--
ALTER TABLE `transfer_requests`
  MODIFY `idtransfer_request` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_section` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`),
  ADD CONSTRAINT `fk_attendance_section_fk` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`),
  ADD CONSTRAINT `fk_attendance_student` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`),
  ADD CONSTRAINT `fk_attendance_student_fk` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`);

--
-- Filtros para la tabla `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `fk_certificates_issuer` FOREIGN KEY (`issued_by`) REFERENCES `users` (`iduser`),
  ADD CONSTRAINT `fk_certificates_student` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`);

--
-- Filtros para la tabla `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_course_degree` FOREIGN KEY (`iddegree`) REFERENCES `degrees` (`iddegree`),
  ADD CONSTRAINT `fk_course_degree_fk` FOREIGN KEY (`iddegree`) REFERENCES `degrees` (`iddegree`),
  ADD CONSTRAINT `fk_course_semester` FOREIGN KEY (`idsemester`) REFERENCES `semesters` (`idsemester`),
  ADD CONSTRAINT `fk_course_semester_fk` FOREIGN KEY (`idsemester`) REFERENCES `semesters` (`idsemester`),
  ADD CONSTRAINT `fk_course_subgrade` FOREIGN KEY (`idsubgrade`) REFERENCES `subgrades` (`idsubgrade`),
  ADD CONSTRAINT `fk_course_subgrade_fk` FOREIGN KEY (`idsubgrade`) REFERENCES `subgrades` (`idsubgrade`);

--
-- Filtros para la tabla `course_teacher`
--
ALTER TABLE `course_teacher`
  ADD CONSTRAINT `fk_ct_course` FOREIGN KEY (`idcourse`) REFERENCES `courses` (`idcourse`),
  ADD CONSTRAINT `fk_ct_course_fk` FOREIGN KEY (`idcourse`) REFERENCES `courses` (`idcourse`),
  ADD CONSTRAINT `fk_ct_teacher` FOREIGN KEY (`idteacher`) REFERENCES `teachers` (`idteacher`),
  ADD CONSTRAINT `fk_ct_teacher_fk` FOREIGN KEY (`idteacher`) REFERENCES `teachers` (`idteacher`);

--
-- Filtros para la tabla `degrees`
--
ALTER TABLE `degrees`
  ADD CONSTRAINT `fk_degree_semester` FOREIGN KEY (`idsemester`) REFERENCES `semesters` (`idsemester`);

--
-- Filtros para la tabla `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `fk_enrollment_section` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`),
  ADD CONSTRAINT `fk_enrollment_section_fk` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`),
  ADD CONSTRAINT `fk_enrollment_student` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`),
  ADD CONSTRAINT `fk_enrollment_student_fk` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`);

--
-- Filtros para la tabla `fathers`
--
ALTER TABLE `fathers`
  ADD CONSTRAINT `fk_father_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`),
  ADD CONSTRAINT `fk_father_user_fk` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`);

--
-- Filtros para la tabla `father_student`
--
ALTER TABLE `father_student`
  ADD CONSTRAINT `fk_fs_father_fk` FOREIGN KEY (`idfather`) REFERENCES `fathers` (`idfather`),
  ADD CONSTRAINT `fk_fs_student_fk` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`);

--
-- Filtros para la tabla `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_grade_course_fk` FOREIGN KEY (`idcourse`) REFERENCES `courses` (`idcourse`),
  ADD CONSTRAINT `fk_grade_eval_fk` FOREIGN KEY (`idevaluation_type`) REFERENCES `evaluation_types` (`idevaluation_type`),
  ADD CONSTRAINT `fk_grade_section` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`),
  ADD CONSTRAINT `fk_grade_section_fk` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`),
  ADD CONSTRAINT `fk_grade_student_fk` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`),
  ADD CONSTRAINT `fk_grades_section` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grade_certificates`
--
ALTER TABLE `grade_certificates`
  ADD CONSTRAINT `fk_gcert_issuer` FOREIGN KEY (`issued_by`) REFERENCES `users` (`iduser`),
  ADD CONSTRAINT `fk_gcert_period` FOREIGN KEY (`idperiod`) REFERENCES `periods` (`idperiod`),
  ADD CONSTRAINT `fk_gcert_student` FOREIGN KEY (`idstudent`) REFERENCES `students` (`idstudent`);

--
-- Filtros para la tabla `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_message_receiver` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`iduser`),
  ADD CONSTRAINT `fk_message_sender` FOREIGN KEY (`sender_id`) REFERENCES `users` (`iduser`);

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notification_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`);

--
-- Filtros para la tabla `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_schedule_section_fk` FOREIGN KEY (`idsection`) REFERENCES `sections` (`idsection`);

--
-- Filtros para la tabla `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `fk_section_course` FOREIGN KEY (`idcourse`) REFERENCES `courses` (`idcourse`),
  ADD CONSTRAINT `fk_section_course_fk` FOREIGN KEY (`idcourse`) REFERENCES `courses` (`idcourse`);

--
-- Filtros para la tabla `semesters`
--
ALTER TABLE `semesters`
  ADD CONSTRAINT `fk_semester_period` FOREIGN KEY (`idperiod`) REFERENCES `periods` (`idperiod`),
  ADD CONSTRAINT `fk_semester_period_fk` FOREIGN KEY (`idperiod`) REFERENCES `periods` (`idperiod`);

--
-- Filtros para la tabla `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_student_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`),
  ADD CONSTRAINT `fk_student_user_fk` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`);

--
-- Filtros para la tabla `subgrades`
--
ALTER TABLE `subgrades`
  ADD CONSTRAINT `fk_subgrade_degree` FOREIGN KEY (`iddegree`) REFERENCES `degrees` (`iddegree`);

--
-- Filtros para la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_teacher_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`),
  ADD CONSTRAINT `fk_teacher_user_fk` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`idrole`) REFERENCES `roles` (`idrole`),
  ADD CONSTRAINT `fk_users_roles_fk` FOREIGN KEY (`idrole`) REFERENCES `roles` (`idrole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
