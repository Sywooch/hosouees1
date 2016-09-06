-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-09-2016 a las 00:38:21
-- Versión del servidor: 5.7.13-0ubuntu0.16.04.2
-- Versión de PHP: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hosouees`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `IdAsistencia` int(11) NOT NULL,
  `IdProyecto` int(11) NOT NULL,
  `IdPersona` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `HoraEntrada` time NOT NULL,
  `HoraSalida` time NOT NULL,
  `CantidadHoras` float NOT NULL,
  `Comentarios` varchar(250) DEFAULT NULL,
  `IdUsuarioRegistro` int(11) NOT NULL,
  `EstadoRegistro` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`IdAsistencia`, `IdProyecto`, `IdPersona`, `Fecha`, `HoraEntrada`, `HoraSalida`, `CantidadHoras`, `Comentarios`, `IdUsuarioRegistro`, `EstadoRegistro`) VALUES
(1, 15, 2, '2016-08-20', '08:30:00', '12:00:00', 4, 'acasc', 3, '1'),
(2, 16, 2, '2016-08-22', '07:30:00', '11:30:00', 4, 'Asistencia en la mañana....', 3, '1'),
(3, 16, 2, '2016-08-19', '07:30:00', '05:30:00', 10, '....', 3, '1'),
(4, 16, 1, '2016-08-18', '08:00:00', '12:00:00', 4, 'comentarios de asistencaia Juana Lopez', 3, '1'),
(5, 15, 7, '2016-09-05', '08:00:00', '12:00:00', 4, 'Asistencia normal', 3, '1'),
(6, 16, 7, '2016-09-05', '07:00:00', '12:00:00', 5, 'sdadasdada', 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '1', 1471995726),
('Coordinador', '5', 1471995304),
('Estudiante', '2', 1470881064),
('Estudiante', '4', 1471920745),
('Estudiante', '6', 1472925615),
('Estudiante', '8', 1473117010),
('Supervisor', '3', 1471568351);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('AccederGII', 2, 'Permiso para acceder al menu GII', NULL, NULL, 1471811890, 1471811890),
('Administrador', 1, 'Administrador', NULL, NULL, 1470816328, 1472788291),
('Administrador de proyecto', 1, 'Administrador de proyecto en la institucion', NULL, NULL, 1471397869, 1471397869),
('AdministrarCatalogos', 2, 'Permiso para administrar catalogos', NULL, NULL, 1471811663, 1471811663),
('AdministrarRBAC', 2, 'Administración de Roles y permisos', NULL, NULL, 1471811823, 1471811823),
('ConfigurarParametros', 2, 'Acceso a configuracion de parametros', NULL, NULL, 1472007569, 1472007569),
('ConsultaAsesor', 2, 'Consulta de proyectos  del asesor', NULL, NULL, 1471915157, 1471915157),
('ConsultaEstudiante', 2, 'Consulta de proyectos de horas sociales del estudiante', NULL, NULL, 1471915106, 1471915106),
('ConsultaProyectosAbiertos', 2, 'Consulta de los proyectos de horas sociales abiertos', NULL, NULL, 1471915217, 1471915217),
('Coordinador', 1, 'Coordinador de proyectos de horas sociales', NULL, NULL, 1470880648, 1472924582),
('Estudiante', 1, 'Estudiante de la UEES', NULL, NULL, 1470880684, 1471915230),
('GenerarReporte', 2, 'Generacion de Reporte de Horas sociales realizadas', NULL, NULL, 1472788278, 1472788278),
('MantoAsignaciones', 2, 'Asignacion de permisos', NULL, NULL, 1471410730, 1471410730),
('MantoCarreras', 2, 'Acceso al mantenimiento de carreras', NULL, NULL, 1471477751, 1471477751),
('MantoFacultades', 2, 'Permite acceder al mantenimiento de facultades en el sistema', NULL, NULL, 1470953345, 1471477675),
('MantoFormularios', 2, 'Acceso al mantenimiento de formularios', NULL, NULL, 1472423748, 1472423748),
('MantoInstituciones', 2, 'Acceso al mantenimiento de instituciones', NULL, NULL, 1471477770, 1471477786),
('MantoPermisos', 2, 'Mantenimiento de Permisos', NULL, NULL, 1471410710, 1471410710),
('MantoPersonas', 2, 'Acceso al mantenimiento de personas', NULL, NULL, 1471536227, 1471536227),
('MantoProyectos', 2, 'Registrar proyectos de horas sociales disponibles', NULL, NULL, 1470880828, 1471477692),
('MantoReglas', 2, 'Mantenimiento de Rules RBAC', NULL, NULL, 1471410763, 1471410763),
('MantoRoles', 2, 'Mantenimiento de roles', NULL, NULL, 1471410686, 1471410686),
('MantoUniversidades', 2, 'Registrar universidades', NULL, NULL, 1471477722, 1471477722),
('MantoUsuarios', 2, 'Mantenimiento de Usuarios', NULL, NULL, 1471410651, 1471410651),
('Supervisor', 1, 'Supervisor de proyectos de horas sociales', NULL, NULL, 1470880665, 1473134289),
('VerTodosProyectos', 2, 'Puede dar gestión a todos los proyectos de horas sociales', NULL, NULL, 1471709698, 1471709698);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administrador', 'AccederGII'),
('Administrador', 'AdministrarCatalogos'),
('Coordinador', 'AdministrarCatalogos'),
('Administrador', 'AdministrarRBAC'),
('Coordinador', 'AdministrarRBAC'),
('Administrador', 'ConfigurarParametros'),
('Coordinador', 'ConsultaAsesor'),
('Supervisor', 'ConsultaAsesor'),
('Estudiante', 'ConsultaEstudiante'),
('Estudiante', 'ConsultaProyectosAbiertos'),
('Supervisor', 'ConsultaProyectosAbiertos'),
('Administrador', 'GenerarReporte'),
('Coordinador', 'GenerarReporte'),
('Administrador', 'MantoAsignaciones'),
('Coordinador', 'MantoAsignaciones'),
('Administrador', 'MantoCarreras'),
('Administrador', 'MantoFacultades'),
('Coordinador', 'MantoFacultades'),
('Administrador', 'MantoFormularios'),
('Coordinador', 'MantoFormularios'),
('Administrador', 'MantoInstituciones'),
('Administrador', 'MantoPermisos'),
('Administrador', 'MantoPersonas'),
('Coordinador', 'MantoPersonas'),
('Administrador', 'MantoProyectos'),
('Coordinador', 'MantoProyectos'),
('Administrador', 'MantoReglas'),
('Administrador', 'MantoRoles'),
('Administrador', 'MantoUniversidades'),
('Administrador', 'MantoUsuarios'),
('Coordinador', 'MantoUsuarios'),
('Administrador', 'VerTodosProyectos'),
('Coordinador', 'VerTodosProyectos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `IdCarrera` int(11) NOT NULL COMMENT 'Codigo identificador de la carrera',
  `Nombre` varchar(100) NOT NULL COMMENT 'nombre de la carrera',
  `NombreCorto` varchar(100) DEFAULT NULL COMMENT 'nombre corto de la carrera',
  `IdFacultad` int(11) DEFAULT NULL COMMENT 'Codigo identificador de la facultad',
  `CantidadHorasSociales` int(11) DEFAULT NULL,
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`IdCarrera`, `Nombre`, `NombreCorto`, `IdFacultad`, `CantidadHorasSociales`, `EstadoRegistro`) VALUES
(2, 'Ingeniería en Sistemas Informáticos', 'ISI', 4, 500, '1'),
(3, 'Técnico en Ingeniería de Sistemas', 'TIS', 4, 250, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicacion`
--

CREATE TABLE `comunicacion` (
  `IdComunicacion` int(11) NOT NULL,
  `IdPersonaRemitente` int(11) NOT NULL COMMENT 'ID de la taba de personas, del emisor del mensaje',
  `IdPersonaReceptor` int(11) DEFAULT NULL,
  `Sujeto` varchar(150) NOT NULL COMMENT 'Sujeto del mensaje',
  `Comentarios` varchar(500) NOT NULL COMMENT 'Cuerpo del mensaje',
  `FechaHora` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'FEcha y hora del registro en la BD',
  `NombreAdjunto1` varchar(150) DEFAULT NULL,
  `RutaAdjunto1` varchar(150) DEFAULT NULL COMMENT 'Ruta en el sistema de archivos del archivo adjunto 1',
  `NombreAdjunto2` varchar(150) DEFAULT NULL,
  `RutaAdjunto2` varchar(150) DEFAULT NULL,
  `IdProyecto` int(11) NOT NULL,
  `IdUsuarioRegistro` int(11) NOT NULL,
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Para establecer los datos de comunicacion entre los asesores y participantes de los proyectos';

--
-- Volcado de datos para la tabla `comunicacion`
--

INSERT INTO `comunicacion` (`IdComunicacion`, `IdPersonaRemitente`, `IdPersonaReceptor`, `Sujeto`, `Comentarios`, `FechaHora`, `NombreAdjunto1`, `RutaAdjunto1`, `NombreAdjunto2`, `RutaAdjunto2`, `IdProyecto`, `IdUsuarioRegistro`, `EstadoRegistro`) VALUES
(10, 4, NULL, 'asda', 'sdadsadasdsadasd', '2016-08-22 01:54:59', 'logo.png', 's175H9KWgdHf_3HCZDXz4ZnFrpICc552.png', NULL, NULL, 15, 3, '1'),
(11, 4, NULL, 'Sujeto', 'COmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOmentarios comeCOme', '2016-08-22 02:27:06', 'manual de imagen corporativa.pdf', 'si039sORrz6D-G5npUynZYwLdxN3YjVh.pdf', 'minerva-logo-vector2.png', 'JxcuKR4X06gFtZ-RCRYPc0iovcShKbGr.png', 15, 3, '1'),
(12, 4, NULL, 'erte', 'retrertrt', '2016-08-22 04:04:19', 'direccion kenny.txt', '9RWsi0TF0ywYruWFCBh4VApyU9RdB7nB.txt', NULL, NULL, 15, 3, '1'),
(13, 4, NULL, 'dfsdfsdfsdfsdf', 'sdfsdfsdfs', '2016-08-22 04:19:59', 'Sin título 1.pdf', '34s7YGcmy5leeQfNSLcRwaLb4Ka0gyIb.pdf', 'logo-no-text.png', 'yvm7LTo6iRlH3KyibTEQe9Z80ElI_s0M.png', 15, 3, '1'),
(14, 4, NULL, 'Solicitud de evidencias de trabajo realizado', 'Por favor necesito adjunten evidencia del trabajo realizado en la semana del 15v  1l 22 de ...', '2016-08-23 03:18:47', NULL, NULL, NULL, NULL, 16, 3, '1'),
(15, 1, NULL, 'Evidencia del trabjo realizado', 'asdasdasdasdasdasdas', '2016-08-23 03:21:54', 'eng-flag.png', 'rDM0sJTKAYeaGfb5Z4wzuLol3nWsMWGZ.png', 'Sin título 1.pdf', 'qorWuF3cXM0Y9y1rJl-9kZ4dkr4q6_Kq.pdf', 16, 4, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `IdConfiguracion` int(11) NOT NULL,
  `CantidadHorasSociales` int(11) NOT NULL COMMENT 'Cantidad de horas sociales requeridas por cada alumno',
  `PesoMaximoAdjuntos` varchar(15) NOT NULL COMMENT 'Peso maximo de los archivos a cargar',
  `TextoBienvenida` text,
  `TextoBienvenidaNoElegible` text,
  `EstadoRegistro` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`IdConfiguracion`, `CantidadHorasSociales`, `PesoMaximoAdjuntos`, `TextoBienvenida`, `TextoBienvenidaNoElegible`, `EstadoRegistro`) VALUES
(1, 500, '2MB', '<div class="well text text-info">\r\n<h2><span style="color: #000080;">SERVICIO SOCIAL ESTUDIANTIL</span></h2>\r\n<div align="justify">\r\n<p>1-&iquest;QU&Eacute; ES EL SERVICIO SOCIAL? <br /> 2-OBJETIVOS <br /> 3-VALORES UNIVERSITARIOS <br /> 4-REALIZACI&Oacute;N DEL SERVICIO SOCIAL <br /> <br /> <strong> 1-&iquest;QU&Eacute; ES EL SERVICIO SOCIAL? </strong><br /> &ldquo;Se entiende por servicio social universitario, la realizaci&oacute;n obligatoria de actividades temporales que ejecuten los estudiantes de carreras t&eacute;cnicas y profesionales, tendientes a la aplicaci&oacute;n de los conocimientos que hayan obtenido y que impliquen el ejercicio de la pr&aacute;ctica profesional en beneficio o inter&eacute;s de la sociedad&rdquo; <br /> <br /> <strong>2-OBJETIVOS </strong></p>\r\n<ul>\r\n<li>Desarrollar en el prestador una conciencia de solidaridad y compromiso con la sociedad a la que pertenece.</li>\r\n<li>Convertir la prestaci&oacute;n en un acto de reciprocidad con la sociedad.</li>\r\n<li>Contribuir con la formaci&oacute;n acad&eacute;mica y capacitaci&oacute;n profesional del prestador de Servicio Social.</li>\r\n</ul>\r\n<p align="justify"><strong>3-VALORES UNIVERSITARIOS </strong></p>\r\n<p align="justify">Honestidad, solidaridad, puntualidad, voluntad, humildad, disponibilidad, cooperaci&oacute;n, sensibilidad, responsabilidad y compromiso social <br /> <br /> <strong>4-REALIZACI&Oacute;N DEL SERVICIO SOCIAL </strong></p>\r\n<p>El estudiante podr&aacute; optar entre las siguientes alternativas:</p>\r\n<p>Internamente: en programas o proyectos de desarrollo, investigaci&oacute;n, docencia, unidades de producci&oacute;n o apoyo administrativo.</p>\r\n<p>Externamente: en dependencias federales, estatales o municipales; uniones de producci&oacute;n; as&iacute; como aquellas instituciones donde se cumpla con los principios que definen el Servicio Social.</p>\r\n</div>\r\n</div>', '<h1><strong>Por el momento no puede ingresar al sistema con su usuario ya que usted aun no es elegible para postularse para proyectos de horas sociales.</strong></h1>\r\n<h1>&nbsp;</h1>\r\n<h1><strong>Nota</strong>: Para los estudiantes que ingresaron por equivalencias se les informa que pueden&nbsp;realizar el servicio social a partir del s&eacute;ptimo ciclo o con 35 materias aprobadas.</h1>', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosProyecto`
--

CREATE TABLE `estadosProyecto` (
  `IdEstadoProyecto` int(11) NOT NULL,
  `EstadoProyecto` varchar(45) DEFAULT NULL,
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Catalogo de estados de los proyectos';

--
-- Volcado de datos para la tabla `estadosProyecto`
--

INSERT INTO `estadosProyecto` (`IdEstadoProyecto`, `EstadoProyecto`, `EstadoRegistro`) VALUES
(1, 'Abierto', '1'),
(2, 'En proceso', '1'),
(3, 'Suspendido', '1'),
(4, 'Cancelado', '1'),
(5, 'Finalizado', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `IdFacultad` int(11) NOT NULL COMMENT 'Codigo identificador de la facultad',
  `Nombre` varchar(100) NOT NULL COMMENT 'Nombre de la facultad',
  `Descripcion` varchar(100) DEFAULT NULL COMMENT 'Descripcion de la facultad',
  `NombreCorto` varchar(10) NOT NULL COMMENT 'Nombre corto o acronimo de la facultad',
  `IdUniversidad` int(11) DEFAULT NULL COMMENT 'Codigo identificador de la institucion',
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`IdFacultad`, `Nombre`, `Descripcion`, `NombreCorto`, `IdUniversidad`, `EstadoRegistro`) VALUES
(4, 'Facultad de Ingeniería y Arquitectura', '', 'FIYA', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `IdFormulario` int(11) NOT NULL,
  `NombreFormulario` varchar(150) NOT NULL,
  `Reglamentos` varchar(500) DEFAULT NULL,
  `DescripcionFormulario` varchar(500) NOT NULL,
  `ArchivoAdjunto` varchar(150) DEFAULT NULL,
  `NombreAdjunto` varchar(150) DEFAULT NULL,
  `EstadoRegistro` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `formularios`
--

INSERT INTO `formularios` (`IdFormulario`, `NombreFormulario`, `Reglamentos`, `DescripcionFormulario`, `ArchivoAdjunto`, `NombreAdjunto`, `EstadoRegistro`) VALUES
(4, 'g', 'g', 'g', 'M0Vd0bLi7ek-Dp8M8bg5MQjwYO7RFVWY.png', 'Captura de pantalla de 2016-08-22 21-16-30.png', '1'),
(5, 'nombre del formulario', 'reglamentos', 'deSCRIPCION DEL FOR', '1iD0Us7lGNH1KN3_d2EsYOnW5__YiiJ2.png', 'logo.png', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `IdPersona` int(11) NOT NULL COMMENT 'Codigo Identificador de la persona o estudiante',
  `IdProyecto` int(11) NOT NULL COMMENT 'Codigo de identificacion del proyecto',
  `HorasRealizadas` int(11) NOT NULL DEFAULT '0' COMMENT 'Detalle de horas realizadas',
  `HorasRestantes` int(11) DEFAULT '0' COMMENT 'Detalle de horas faltantes',
  `ProyectoCompleto` char(1) DEFAULT '0' COMMENT '1-> Indica que el estudiante realizao too el proyecto, por lo tabnto obtiene todas las horas que este otorga',
  `ProyectosRealizados` varchar(150) DEFAULT NULL COMMENT 'Nombre de los proyectos realizados',
  `PersonaActiva` char(1) NOT NULL DEFAULT '0' COMMENT '1-> Indica que la asignacion de la paersona al grupo de trabajo es activo (utiliza un cupo), 0-> Inactiva',
  `IdUsuarioRegistro` int(11) DEFAULT NULL,
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`IdPersona`, `IdProyecto`, `HorasRealizadas`, `HorasRestantes`, `ProyectoCompleto`, `ProyectosRealizados`, `PersonaActiva`, `IdUsuarioRegistro`, `EstadoRegistro`) VALUES
(1, 15, 299, 200, '0', 'dasdasdasdasd', '1', 3, '1'),
(1, 16, 201, 100, '0', NULL, '1', 3, '1'),
(2, 15, 300, 250, '0', NULL, '1', 3, '1'),
(2, 16, 0, 0, '0', NULL, '1', NULL, '1'),
(7, 15, 300, 200, '0', NULL, '1', 3, '1'),
(7, 16, 200, 0, '0', NULL, '1', 3, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `IdInstitucion` int(11) NOT NULL COMMENT 'Codigo identificador de la institucion',
  `Nombre` varchar(50) NOT NULL COMMENT 'Nombre institucion',
  `Siglas` varchar(15) DEFAULT NULL COMMENT 'Siglas de la institucion',
  `SitioWeb` varchar(45) DEFAULT NULL COMMENT 'Sitio web de la institucion',
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`IdInstitucion`, `Nombre`, `Siglas`, `SitioWeb`, `EstadoRegistro`) VALUES
(1, 'Ministerio de Educacion', 'MINED', 'mined.com', '1'),
(2, 'Ministerio de Salud', 'MINSAL', 'minsal.gob.sv', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL COMMENT 'Codigo de identificacion del menu',
  `Titulo` varchar(50) NOT NULL COMMENT 'Titulo del menu',
  `Descripcion` varchar(100) DEFAULT NULL COMMENT 'Descripcion del menu',
  `IdPadre` varchar(11) NOT NULL COMMENT 'Codigo identificador del padre',
  `Url` varchar(250) NOT NULL COMMENT 'Url del menu',
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1470595889),
('m140506_102106_rbac_init', 1470814793),
('m140608_173539_create_user_table', 1470595909),
('m140611_133903_init_rbac', 1470595911),
('m140808_073114_create_auth_item_group_table', 1470595913),
('m140809_072112_insert_superadmin_to_user', 1470595914),
('m140809_073114_insert_common_permisison_to_auth_item', 1470595914),
('m141023_141535_create_user_visit_log', 1470595915),
('m141116_115804_add_bind_to_ip_and_registration_ip_to_user', 1470595916),
('m141121_194858_split_browser_and_os_column', 1470595917),
('m141201_220516_add_email_and_email_confirmed_to_user', 1470595919),
('m141207_001649_create_basic_user_permissions', 1470595920),
('m150703_191015_init', 1470815060);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro`
--

CREATE TABLE `parametro` (
  `IdParametro` int(11) NOT NULL COMMENT 'Codigo identificador del parametro',
  `Valor` varchar(1000) DEFAULT NULL COMMENT 'Valor del parametro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `IdPerfil` int(11) NOT NULL COMMENT 'Codigo de identificacion del perfil',
  `Descripcion` varchar(45) DEFAULT NULL COMMENT 'Descripcion del perfil',
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfildetalle`
--

CREATE TABLE `perfildetalle` (
  `IdPerfil` int(11) NOT NULL COMMENT 'Codigo de identificacion del perfil',
  `IdMenu` int(11) NOT NULL COMMENT 'Codigo identificador del menu',
  `Seleccionar` bit(1) DEFAULT NULL COMMENT 'Seleccion del perfil',
  `Insertar` bit(1) DEFAULT NULL COMMENT 'Opcion del perfil insertar',
  `Actualizar` bit(1) DEFAULT NULL COMMENT 'Opcion del perfil actualizar',
  `Eliminar` bit(1) DEFAULT NULL COMMENT 'Opcion del perfil eliminar',
  `Imprimir` bit(1) DEFAULT NULL COMMENT 'Opcion del perfil imprimir',
  `Activo` bit(1) DEFAULT NULL COMMENT 'Estado del perfil',
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `IdPersona` int(11) NOT NULL COMMENT 'Codigo de identificacion de la persona o estudiante',
  `Nombres` varchar(100) NOT NULL COMMENT 'Nombre de la persona o estudiante',
  `Apellidos` varchar(100) NOT NULL COMMENT 'apellidos de la persona o estudiante',
  `CarnetEstudiante` varchar(100) DEFAULT NULL COMMENT 'Carnet del estudiante',
  `CarnetEmpleado` varchar(100) DEFAULT NULL COMMENT 'Carnet del empleado',
  `Email` varchar(50) DEFAULT NULL,
  `DUI` varchar(10) DEFAULT NULL COMMENT 'DUI de la persona o estudiante',
  `NIT` varchar(17) DEFAULT NULL COMMENT 'NIT de la persona o estudiante',
  `Direccion` varchar(500) DEFAULT NULL COMMENT 'Direccion de la persona u estudiante',
  `Telefono` varchar(8) DEFAULT NULL COMMENT 'Telefono de la persona u estudiante',
  `Sexo` char(1) NOT NULL COMMENT 'Sexo de la persona o estudiante',
  `Cargo` varchar(25) DEFAULT NULL COMMENT 'Codigo identificador del cargo',
  `UserId` int(11) DEFAULT NULL,
  `TipoPersona` char(2) DEFAULT NULL COMMENT 'ES-> Estudiante, EM->Empleado, Ex->Externo',
  `IdCarrera` int(11) DEFAULT NULL,
  `Elegible` char(1) NOT NULL DEFAULT '1' COMMENT '1->Indica que el estudiante es elegible para realizar horas sociales',
  `ArchivoAdjunto` varchar(150) DEFAULT NULL,
  `NombreAdjunto` varchar(150) DEFAULT NULL,
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`IdPersona`, `Nombres`, `Apellidos`, `CarnetEstudiante`, `CarnetEmpleado`, `Email`, `DUI`, `NIT`, `Direccion`, `Telefono`, `Sexo`, `Cargo`, `UserId`, `TipoPersona`, `IdCarrera`, `Elegible`, `ArchivoAdjunto`, `NombreAdjunto`, `EstadoRegistro`) VALUES
(1, 'Juana', 'Lopez', 'LP201005', '', NULL, '09888888', '123123123', 'Mejicanos', '22766666', 'F', '', 4, 'ES', 2, '1', 'Tf8-EoznKqFiYqMq-AfzFkM-0IcW4F8z.png', 'avatar2.png', '1'),
(2, 'Jose Alberto', 'Castaneda Alarcon', 'CA201010', '', NULL, '03743217-3', '', '', '', 'M', '', 2, 'ES', 2, '1', 'odFsDq_u6eFIH9AIa7v-3LxGnI5MK6qj.jpg', 'descarga (2).jpg', '1'),
(3, 'ADmin', 'Admin', NULL, 'AS1010', NULL, '', '', 'Direccionasdasdasdasdasdasdasdasdas', '22334455', 'M', '', 1, 'EM', NULL, '0', 'hAHKsO7mN3SK7nfkKySr78AO2eokAQ-b.jpg', 'descarga (1).jpg', '1'),
(4, 'Julio Alberto', 'Flores Ayala', NULL, 'FA230000', NULL, '89789789', '98789789', 'direccion', '77889922', 'M', 'Asesor de proyectos ', 3, 'EM', NULL, '0', 'XWtxI26xEk9CJPRDJ1l-A-Yg8IvgHkfL.jpg', 'Cover-30-Cosas-que-toda-persona-con-deficit-de-atencion-520x272.jpg', '1'),
(5, 'Napoleón', 'Gochez', NULL, 'GC998877', NULL, '231231', '2313', 'asdad', '123123', 'M', 'Coordinador de proyectos', 5, 'EM', NULL, '1', '0u7LHkyKnBECzqZV1lkDdVgn_fBBKXfH.png', 'avatar.png', '1'),
(6, 'Juan ', 'Perez', 'CA21312', NULL, NULL, '123', '123', 'direccion', '22789876', 'M', NULL, 7, 'ES', 2, '0', 'Mmg9WeI0V6ou0jyJUBDRudFF6fEePZNv.jpg', 'Cover-30-Cosas-que-toda-persona-con-deficit-de-atencion-520x272.jpg', '1'),
(7, 'Jose Raul', 'Fernandez Martinez', '0305123', NULL, NULL, '123123123', '123123123', 'Direccion del estudiante', '22550011', 'M', NULL, 8, 'ES', 3, '1', '8cEENVkeAqpTkYVQGNJ-u3GjeoZTXuGp.jpg', 'descarga.jpg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `IdProyecto` int(11) NOT NULL COMMENT 'Codigo de identificacion del proyecto',
  `NombreProyecto` varchar(150) NOT NULL COMMENT 'Nombre del Proyecto',
  `HorasSolicitadas` int(11) DEFAULT NULL COMMENT 'Horas a realizar',
  `HorasSocialesXhora` float DEFAULT NULL COMMENT 'Cantidad de horas que le suma al estudiante por cada hora que asistio al servicio social',
  `Ubicacion` varchar(150) NOT NULL COMMENT 'Ubicacion del proyecto',
  `FechaIni` date DEFAULT NULL COMMENT 'Fecha de inicio del proyecto',
  `FechaFin` date DEFAULT NULL COMMENT 'Fecha de finalizacion del proyecto',
  `IdInstitucion` int(11) NOT NULL,
  `IdEstadoProyecto` int(11) NOT NULL,
  `IdPersonaAsesor` int(11) DEFAULT NULL COMMENT 'ID de la tabla personas, del asesor del proyecto',
  `NumeroPersonas` int(11) DEFAULT NULL COMMENT 'Numero de personas requeridas simultaneamente para realizar el proyecto',
  `ArchivoAdjunto` varchar(150) DEFAULT NULL,
  `NombreAdjunto` varchar(150) DEFAULT NULL,
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`IdProyecto`, `NombreProyecto`, `HorasSolicitadas`, `HorasSocialesXhora`, `Ubicacion`, `FechaIni`, `FechaFin`, `IdInstitucion`, `IdEstadoProyecto`, `IdPersonaAsesor`, `NumeroPersonas`, `ArchivoAdjunto`, `NombreAdjunto`, `EstadoRegistro`) VALUES
(15, 'proy1', 500, 3, 'ubi1', '2016-08-01', '2016-08-31', 1, 1, 4, 4, '4UCsFiNIvEdrNO9HVewdy4FIpVPqQYaV.jpg', 'descarga.jpg', '1'),
(16, 'Mantenimiento preventivo de Desktops', 500, 2, 'Centro de gobierno', '2016-08-19', '2016-10-27', 2, 5, 4, 10, '87jXQwAg3ZWqWORkz05Wq3ZgfIfsPs9y.jpg', 'descarga (1).jpg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE `universidad` (
  `IdUniversidad` int(11) NOT NULL COMMENT 'Codigo Identificador de la universidad',
  `Nombre` varchar(100) NOT NULL COMMENT 'Nombre de la universidad',
  `NombreCorto` varchar(10) NOT NULL COMMENT 'Nombre corto de la universidad',
  `Mision` varchar(1000) DEFAULT NULL COMMENT 'Mision de la universidad',
  `Vision` varchar(1000) DEFAULT NULL COMMENT 'Vision de la universidad',
  `CorreoElectronico` varchar(45) DEFAULT NULL COMMENT 'Correo electronico de la universidad',
  `Telefono` varchar(10) DEFAULT NULL COMMENT 'Telefono de la universidad',
  `Direccion` varchar(500) DEFAULT NULL COMMENT 'Direccion de la universidad',
  `Url` varchar(250) DEFAULT NULL COMMENT 'URL de la universidad',
  `Logo` varchar(250) DEFAULT NULL COMMENT 'Logo de la universidad',
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `universidad`
--

INSERT INTO `universidad` (`IdUniversidad`, `Nombre`, `NombreCorto`, `Mision`, `Vision`, `CorreoElectronico`, `Telefono`, `Direccion`, `Url`, `Logo`, `EstadoRegistro`) VALUES
(1, 'Universidad Evangelica de El Salvador', 'UEES', 'mision', 'vision', 'uees@uees.com', '22009988', 'direccion', 'uees.com', 'logo', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL DEFAULT '123123',
  `administrator` int(11) DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `creator_ip` varchar(40) DEFAULT NULL,
  `confirm_token` varchar(255) DEFAULT NULL,
  `recovery_token` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `login`, `username`, `password_hash`, `auth_key`, `administrator`, `creator`, `creator_ip`, `confirm_token`, `recovery_token`, `blocked_at`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 'jcastanedaalarcon@gmail.com', 'jcastaneda', '$2y$13$sJqJRrr0WWEswcOljT/9G.YUeUo6tymMtIrT6wy70b3NVCV0f2tYu', '123123', 1, -2, 'Local', NULL, NULL, NULL, 1470815537, 1470815537, 1471995740),
(2, 'mail@mail.com', 'CA201010', '$2y$13$/Hdd.A2e/dn0VsFq0lNtmOMI01HZOwPOwgxgsv0lkk9jp.w.kbQvO', '123123', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1470881021, 1470881021, 1472010002),
(3, 'jose_canibal@hotmail.com', 'jflores', '$2y$13$DiWfT18Pn0EH3hWIcC/Pi.ZpvObjVRC/9I321ZXBKfayza6iEO32q', '123123', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1471568308, 1471568308, 1472009650),
(4, 'asdasd@gmail.com', 'LP201005', '$2y$13$CWAJrGCh.dsX9r7crFakCeu5XXbtElWTM5cK6Ol8g4qbZYvJ0/.ha', '123123', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1471920692, 1471920692, -1),
(5, 'smokecastaneda@gmail.com', 'ngochez', '$2y$13$2oQsyvvNzd6T0..cil.c9e2Pxj.DA1mHdqwJIHinrIXy5lVxa8KX2', '123123', 1, 1, '127.0.0.1', NULL, NULL, NULL, 1471993769, 1471993769, 1472924521),
(8, 'raul_123@123.com', '0305123', '$2y$13$cOSS5dipNwHXAmPO5Rc1FuOF/Wnp7IVCzNnZdPZjbm0JTRrUuMUJm', '123123', 0, 1, '127.0.0.1', NULL, NULL, NULL, 1473116565, 1473116565, -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL COMMENT 'Codigo de identificacion del usuario',
  `InicioSesion` varchar(50) NOT NULL COMMENT 'Inicio de sesion a la aplicacion',
  `Nombres` varchar(100) DEFAULT NULL COMMENT 'Nombre del usuario',
  `Apellidos` varchar(100) DEFAULT NULL COMMENT 'Apellidos del usuario',
  `Activos` char(1) DEFAULT '1' COMMENT 'Identificador del estado activo',
  `Clave` varchar(100) NOT NULL COMMENT 'clave o password de ingreso',
  `IdPerfil` int(11) NOT NULL,
  `EstadoRegistro` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`IdAsistencia`),
  ADD KEY `fk_asistencia_proyecto` (`IdProyecto`),
  ADD KEY `fk_asistencia_persona_estudiante` (`IdPersona`),
  ADD KEY `fk_asistencia_usuario_registro` (`IdUsuarioRegistro`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`IdCarrera`),
  ADD KEY `IdFacultad_idx` (`IdFacultad`);

--
-- Indices de la tabla `comunicacion`
--
ALTER TABLE `comunicacion`
  ADD PRIMARY KEY (`IdComunicacion`),
  ADD KEY `fk_comunicacion_proyecto1_idx` (`IdProyecto`),
  ADD KEY `fk_comunicacion_usuario` (`IdUsuarioRegistro`),
  ADD KEY `fk_comunicacion_idpersonaremitente` (`IdPersonaRemitente`),
  ADD KEY `fk_comunicacion_idpersonareceptor` (`IdPersonaReceptor`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`IdConfiguracion`);

--
-- Indices de la tabla `estadosProyecto`
--
ALTER TABLE `estadosProyecto`
  ADD PRIMARY KEY (`IdEstadoProyecto`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`IdFacultad`),
  ADD KEY `IdInstitucion_idx` (`IdUniversidad`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`IdFormulario`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`IdPersona`,`IdProyecto`),
  ADD KEY `fk_horas_proyecto1_idx` (`IdProyecto`),
  ADD KEY `fk_horas_usuario_registro` (`IdUsuarioRegistro`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`IdInstitucion`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IdMenu`,`IdPadre`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`IdParametro`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`IdPerfil`);

--
-- Indices de la tabla `perfildetalle`
--
ALTER TABLE `perfildetalle`
  ADD PRIMARY KEY (`IdPerfil`,`IdMenu`),
  ADD KEY `IdMenu_idx` (`IdMenu`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`IdPersona`),
  ADD KEY `fk_persona_usuario` (`UserId`),
  ADD KEY `fk_persona_carrera` (`IdCarrera`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`IdProyecto`),
  ADD KEY `fk_proyecto_institucion1_idx` (`IdInstitucion`),
  ADD KEY `fk_proyecto_estadosProyecto1_idx` (`IdEstadoProyecto`),
  ADD KEY `fk_proyecto_personaasesor` (`IdPersonaAsesor`);

--
-- Indices de la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD PRIMARY KEY (`IdUniversidad`);

--
-- Indices de la tabla `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_login` (`login`),
  ADD UNIQUE KEY `user_unique_username` (`username`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `fk_usuario_perfil1_idx` (`IdPerfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `IdAsistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `IdCarrera` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador de la carrera', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `comunicacion`
--
ALTER TABLE `comunicacion`
  MODIFY `IdComunicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `IdConfiguracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estadosProyecto`
--
ALTER TABLE `estadosProyecto`
  MODIFY `IdEstadoProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `IdFacultad` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador de la facultad', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `IdFormulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `IdInstitucion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador de la institucion', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo de identificacion del menu';
--
-- AUTO_INCREMENT de la tabla `parametro`
--
ALTER TABLE `parametro`
  MODIFY `IdParametro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo identificador del parametro';
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `IdPerfil` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo de identificacion del perfil';
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `IdPersona` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo de identificacion de la persona o estudiante', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `IdProyecto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo de identificacion del proyecto', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `universidad`
--
ALTER TABLE `universidad`
  MODIFY `IdUniversidad` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo Identificador de la universidad', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo de identificacion del usuario';
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`IdProyecto`) REFERENCES `proyecto` (`IdProyecto`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`IdPersona`) REFERENCES `persona` (`IdPersona`),
  ADD CONSTRAINT `asistencia_ibfk_3` FOREIGN KEY (`IdUsuarioRegistro`) REFERENCES `user_accounts` (`id`);

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `IdFacultad` FOREIGN KEY (`IdFacultad`) REFERENCES `facultad` (`IdFacultad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comunicacion`
--
ALTER TABLE `comunicacion`
  ADD CONSTRAINT `comunicacion_ibfk_1` FOREIGN KEY (`IdUsuarioRegistro`) REFERENCES `user_accounts` (`id`),
  ADD CONSTRAINT `comunicacion_ibfk_2` FOREIGN KEY (`IdPersonaRemitente`) REFERENCES `persona` (`IdPersona`),
  ADD CONSTRAINT `comunicacion_ibfk_3` FOREIGN KEY (`IdPersonaReceptor`) REFERENCES `persona` (`IdPersona`),
  ADD CONSTRAINT `fk_comunicacion_proyecto1` FOREIGN KEY (`IdProyecto`) REFERENCES `proyecto` (`IdProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD CONSTRAINT `IdInstitucion` FOREIGN KEY (`IdUniversidad`) REFERENCES `universidad` (`IdUniversidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `horas`
--
ALTER TABLE `horas`
  ADD CONSTRAINT `IdPersona` FOREIGN KEY (`IdPersona`) REFERENCES `persona` (`IdPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_horas_proyecto1` FOREIGN KEY (`IdProyecto`) REFERENCES `proyecto` (`IdProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `horas_ibfk_1` FOREIGN KEY (`IdUsuarioRegistro`) REFERENCES `user_accounts` (`id`);

--
-- Filtros para la tabla `perfildetalle`
--
ALTER TABLE `perfildetalle`
  ADD CONSTRAINT `IdMenu` FOREIGN KEY (`IdMenu`) REFERENCES `menu` (`IdMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perfildetalle_perfil1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`IdCarrera`) REFERENCES `carrera` (`IdCarrera`);

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_proyecto_estadosProyecto1` FOREIGN KEY (`IdEstadoProyecto`) REFERENCES `estadosProyecto` (`IdEstadoProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyecto_institucion1` FOREIGN KEY (`IdInstitucion`) REFERENCES `institucion` (`IdInstitucion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`IdPersonaAsesor`) REFERENCES `persona` (`IdPersona`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
