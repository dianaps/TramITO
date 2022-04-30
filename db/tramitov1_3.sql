-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 06:17 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tramitov1.2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `username`, `password`, `email`) VALUES
(14, 'Elian Salmerón', 'admin18011316', '$2y$10$uEYSv3QFV9wTAEVtp7rAb.2QpzXCds9dr5k034aACGGZPRJTLrINu', 'eliansalmeron@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` varchar(150) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `user_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `info` varchar(255) NOT NULL,
  `tel` decimal(10,0) DEFAULT NULL,
  `department_head` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`user_id`, `department_name`, `info`, `tel`, `department_head`) VALUES
(111, 'Ingeniería  Metal – Mecánica', 'Analiza necesidades presentes o futuras de la institución buscando aportar posibles soluciones de acuerdo a los recursos disponibles y apoya a las áreas académicas y administrativas, en base a sus solicitudes para facilitar sus actividades.', NULL, 'Genaro Elías Méndez Uscanga'),
(112, 'Ingeniería en Sistemas y Computación', 'Analiza necesidades presentes o futuras de la institución buscando aportar posibles soluciones de acuerdo a los recursos disponibles y apoya a las áreas académicas y administrativas, en base a sus solicitudes para facilitar sus actividades.', NULL, 'Ignacio López Martínez'),
(113, 'Desarrollo Académico', 'Lleva a cabo las actividades relacionadas con el Desarrollo Académico de personal docente del instituto tecnológico.', NULL, 'Elda Rosario Ruiz'),
(114, 'División de Estudios de Posgrado', 'Coordina la aplicación de planes y programas de estudio de los posgrados que se imparten en el instituto tecnológico, así como la atención a los alumnos de estos posgrados.', NULL, 'Mario Leoncio Arrioja Rodríguez'),
(115, 'División de Estudios Profesionales', 'Planea, coordina, controla y evalua las carreras que se imparten en el Instituto Tecnológico, así como las actividades para el apoyo a la titulación, desarrollo curricular y atención a los alumnos de conformidad con las normas y lineamientos. ', NULL, 'Delma Vargas López'),
(116, 'Ingeniería Eléctrica e Ingeniería electrónica', 'Analiza necesidades presentes o futuras de la institución buscando aportar posibles soluciones de acuerdo a los recursos disponibles y apoya a las áreas académicas y administrativas, en base a sus solicitudes para facilitar sus actividades.', NULL, 'David Bertani Hernández'),
(117, 'Ingeniería Industrial', 'Analiza necesidades presentes o futuras de la institución buscando aportar posibles soluciones de acuerdo a los recursos disponibles y apoya a las áreas académicas y administrativas, en base a sus solicitudes para facilitar sus actividades.', NULL, 'Jorge Alberto Galán Montero'),
(118, 'Ciencias Básicas', 'Planea, coordina, controla y evalúa las actividades de docencia, investigación y vinculación en las áreas correspondientes a las ciencias básicas que se imparten en el instituto tecnológico, de conformidad con las normas y lineamientos establecidos por la', NULL, 'María de Lourdes Abdala Castillo'),
(119, 'Ingeniería Química y Bioquímica', 'Participa en reuniones de nivel directivo, analiza necesidades presentes o futuras de la institución buscando aportar posibles soluciones de acuerdo a los recursos disponibles y apoya a las áreas académicas y administrativas, en base a sus solicitudes par', NULL, 'Laura Rodríguez Bretón'),
(120, 'C. Económico – Administrativas', 'Planea, coordina, controla y evalúa las actividades de docencia, investigación y vinculación en las áreas correspondientes a Ciencias Económico – Administrativas que se imparten en el Instituto Tecnológico , de conformidad con las normas y lineamientos es', NULL, 'Roberto Rosales Barrales'),
(121, 'Servicios Escolares', 'Recibe, registra, digitaliza, organiza, conserva y mantiene seguros los documentos que integran el expediente escolar de los alumnos, autoriza la inscripción y reinscripción de los alumnos, al trámite a los cambios y bajas de alumnos, integra los expedien', NULL, 'Alma Ivonne Sánchez García'),
(122, 'Gestión Tecnológica y Vinculación', 'Establece, coordina y mantiene la relación con el sector productivo, público y privado para contribuir al cumplimiento de programas de vinculación.', NULL, 'Aurora del Pilar Fuentes García'),
(123, 'Comunicación y Difusión', 'Examina espacios de difusión en medios masivos de comunicación para difundir las actividades que desarrolla el instituto. Tramita ante instituciones públicas o privadas, apoyos para la difusión de eventos y actividades que desarrolla el instituto.', NULL, 'Paulina del Carmen Delgado Becerra'),
(124, 'Actividades Extraescolares', 'Tiene la doble función de coordinar y complementar la labor académica de todos los departamentos didácticos con actividades diversas. Serán en su mayoría actividades formativas, sociales, culturales y, en algunos casos lúdicas, en mayor o menor grado, int', NULL, 'Víctor Manuel Contreras Cuburu'),
(125, 'Planeación, Programación y Presupuestación', 'Organiza la planeación y programación del presupuesto anual, establece las Normas y Lineamientos para su operación, así como vigila la elaboración y el seguimiento del Programa Operativo Anual de la Institución.', NULL, 'Marco Antonio Alamillo Nieto'),
(126, 'Centro de Información', 'Coordina y controla la ejecución de las actividades referentes a los servicios bibliotecarios que se proporcionan a la comunidad universitaria, de conformidad con la normatividad y lineamientos establecidos para tal efecto.\r\n\r\n', NULL, 'Christian de Jesús Laureano Acosta'),
(127, 'Centro de Computo', 'Coordina las acciones que las áreas del departamento realizan para proporcionar soluciones de tecnologías de información, a través de la planeación e integración de las actividades requeridas, con el objetivo de suministrar herramientas tecnológicas que f', NULL, 'Raúl Torres Roa'),
(128, 'Mantenimiento de Equipo', 'Dirige el funcionamiento, conservación y reparación de máquinas, maquinaria e instalaciones, equipos y sistemas, para conseguir óptimos resultados en los servicios educativos, administrativos y de seguridad en general.', NULL, 'Juan Carlos Welsh Rodríguez'),
(129, 'Recursos financieros', 'Vigila el correcto ejercicio del Presupuesto, así como los registros contables, en base a la normatividad y procedimientos aplicables, con el objeto de obtener información veraz y oportuna.', NULL, 'Alicia Marisol Tirado Gálvez'),
(130, 'Recursos Humanos', 'Administra los recursos humanos del Instituto de acuerdo a las normas y procedimientos aplicables, otorgando las prestaciones económicas y sociales apropiadas al personal para el desarrollo de sus funciones.', NULL, 'Verónica Ruiz Felipe'),
(131, 'Recursos Materiales y Servicios', 'Realiza estudios para la detección de necesidades de recursos materiales del Instituto Tecnológico, propone objetivos, metas y acciones para la administración de los recursos materiales requeridos para la integración del programa operativo anual del Insti', NULL, 'Oscar Elioza de la Rosa');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `semester` tinyint(2) NOT NULL,
  `career` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`user_id`, `name`, `last_name`, `semester`, `career`) VALUES
(14, 'Elián', 'Salmerón', 8, 'Ingeniería en Sistemas Computacionales'),
(138, 'Diana Alejandra', 'Pérez Sánchez', 8, 'Ingeniería en Sistemas Computacionales');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `p_p` varchar(255) NOT NULL DEFAULT 'user-default.png',
  `last_seen` date NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `p_p`, `last_seen`, `role`) VALUES
(14, '18011316', '$2y$10$uEYSv3QFV9wTAEVtp7rAb.2QpzXCds9dr5k034aACGGZPRJTLrINu', 'eliansalmeron@gmail.com', 'user-default.png', '2022-04-18', 'student'),
(111, 'GenaroElías', 'Genaro23320', 'genaro.mu@orizaba.tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(112, 'IgnacioLopez', 'IGlo998', 'dsistemasc@orizaba.tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(113, 'EldaRZ', 'EldaRu0109', 'dda_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(114, 'MarioLeoncio', 'mmario3328', 'depi_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(115, 'DelmaVargas', 'VargasD093', 'dep_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(116, 'DavidBertani', 'Bertani937697773', 'jefatura.elect@orizaba.tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(117, 'JorgeGalán', 'JG82BN98', 'jorge.gm@orizaba.tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(118, 'MaríadeLourdesAbdala', 'IKDH9977V', 'cbas_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(119, 'LauraRodríguez', 'BRL9748NHD0', 'departamento_quimica@orizaba.tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(120, 'RobertoRosales', 'RobertoR98Y473', 'cead_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(121, 'AlmaIvonneSánchez', 'Almita88773YG', 'se_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(122, 'AuroraFuentes', 'Fuentes76469', 'vin_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(123, 'PaulinadelCarmenDelgado', 'PauCD08872', 'cyd_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(124, 'VíctorContreras', 'VC8887666000', 'ext_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(125, 'MarcoAlamillo', 'M87A09A71', 'pl_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(126, 'ChristianLaureano', 'Laureano94441', 'ci_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(127, 'RaúlTorresR', 'TorRes0101095', 'cc_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(128, 'JuanCarlosWelsh', 'Welsh421230JC', 'mantenimiento@orizaba.tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(129, 'AliciaTiradoGálvez', 'AM9832TG', 'rf_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(130, 'VerónicaRuizFelipe', 'Ruiz9032222Fe', 'rh_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(131, 'OscarEliozaR', 'EL2929011', 'rm_orizaba@tecnm.mx', 'user-default.png', '0000-00-00', 'department'),
(138, '18011275', '$2y$10$jJlIeMtgYbPmBm.m1imcPO/CSZrhDhYy2XcwOkyjV8L3lMzif9Uwu', 'diannalejandra.ps@gmail.com', 'user-default.png', '2022-04-29', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `xoochbot`
--

CREATE TABLE `xoochbot` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(150) NOT NULL,
  `respuesta` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xoochbot`
--

INSERT INTO `xoochbot` (`id`, `pregunta`, `respuesta`) VALUES
(2, '¿Cómo te llamas?', 'Mi nombre es XOOCHBot.'),
(3, 'Hola.', '¡Hola! Un gusto saludarte.'),
(6, 'Adiós.', 'Espero haberte ayudado, hasta pronto.'),
(7, 'Gracias.', 'Ha sido un placer ayudarte.'),
(8, '¿Cuál es el horario de atención del departamento de Servicios Escolares?', 'De 10:00 a 13:00 horas.'),
(9, '¿Cuál es la plataforma para subir los documentos del servicio social?', 'https://sitec.orizaba.tecnm.mx/servicio/'),
(11, '¿Cuál es el horario del departamento de lenguas extranjeras?', 'Horario de 8:00 a 14:00'),
(12, '¿Cuál es el teléfono de la escuela?', '2727244096'),
(13, '¿Cuál es la dirección de la escuela?', 'Avenida Oriente 9 No. 852, 94320 Orizaba, Veracruz'),
(14, '¿Con quien me comunico para solicitar una constancia?', 'Para solicitar una constancia debes comunicarte con Claudia Cervantes Ávila'),
(15, '¿Cuál es la página oficial de la escuela?', 'http://www.orizaba.tecnm.mx/'),
(16, '¿Cómo puedo obtener los créditos complementarios?', 'Los créditos complentarios se pueden obtener a través de conferencias.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `FKchats606360` (`from_id`),
  ADD KEY `FKchats192021` (`to_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`,`user_1`,`user_2`),
  ADD KEY `FKconversati369146` (`user_1`),
  ADD KEY `FKconversati369147` (`user_2`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `xoochbot`
--
ALTER TABLE `xoochbot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pregunta` (`pregunta`),
  ADD UNIQUE KEY `respuesta` (`respuesta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `xoochbot`
--
ALTER TABLE `xoochbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `FKchats192021` FOREIGN KEY (`to_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FKchats606360` FOREIGN KEY (`from_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `FKconversati369146` FOREIGN KEY (`user_1`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FKconversati369147` FOREIGN KEY (`user_2`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `FKdepartment218012` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FKstudents333083` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
