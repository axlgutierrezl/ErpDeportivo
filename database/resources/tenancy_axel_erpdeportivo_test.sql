INSERT INTO `tenants` (`id`, `name`, `domain`, `database`, `created_at`, `updated_at`) VALUES
(1, 'axel', 'axel.erpdeportivo.test', 'tenancy_axel_erpdeportivo_test', '2023-06-30 22:03:52', '2023-06-30 22:03:52');

CREATE DATABASE tenancy_axel_erpdeportivo_test;

--
-- Base de datos: `tenancy_axel_erpdeportivo_test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint NOT NULL DEFAULT '0',
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`id`, `descripcion`, `ubicacion`, `is_default`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'PRINCIPAL', 'Tienda', 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(2, 'MERMAS', 'Tienda', 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` int UNSIGNED NOT NULL,
  `nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint NOT NULL DEFAULT '0',
  `estado_caja` enum('ABIERTA','CERRADA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CERRADA',
  `estado` enum('ACTIVA','ANULADA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVA',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id`, `nombre`, `is_default`, `estado_caja`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Principal', 1, 'CERRADA', 'ACTIVA', '2023-06-30 22:03:56', '2023-06-30 22:03:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_pagos`
--

CREATE TABLE `cuenta_pagos` (
  `id` int UNSIGNED NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_pago_real` datetime NOT NULL,
  `metodo_pago` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tiene_tarjeta` tinyint(1) NOT NULL,
  `tipo_tarjeta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_operacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pago` decimal(18,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int UNSIGNED NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social_abreviada` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruta_logo` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion_fiscal` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubigeo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_mailer` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_host` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_port` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_username` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_encryption` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soap_envio` enum('Sunat','Ose') COLLATE utf8mb4_unicode_ci NOT NULL,
  `soap_tipo` enum('Demo','Produccion') COLLATE utf8mb4_unicode_ci NOT NULL,
  `soap_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificado_pfx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_facturacions`
--

CREATE TABLE `empresa_facturacions` (
  `id` int UNSIGNED NOT NULL,
  `empresa_id` int UNSIGNED NOT NULL,
  `ruta_certificado_pfx` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_certificado_pfx` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_certificado_pfx` text COLLATE utf8mb4_unicode_ci,
  `sol_user` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sol_password` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ambiente` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruta_certificado_pem` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificado` text COLLATE utf8mb4_unicode_ci,
  `token` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id` int UNSIGNED NOT NULL,
  `documento_id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `producto_id` int UNSIGNED NOT NULL,
  `tipo_documento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_documento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_documento` date NOT NULL,
  `motivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_costo` decimal(18,2) NOT NULL,
  `precio_venta` decimal(18,2) NOT NULL,
  `cantidad_ingreso` decimal(18,2) NOT NULL,
  `cantidad_egreso` decimal(18,2) NOT NULL,
  `saldo` decimal(18,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `procedencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_11_08_161918_create_sessions_table', 1),
(7, '2022_11_09_234805_create_modules_table', 1),
(8, '2022_11_10_000021_create_module_levels_table', 1),
(9, '2022_11_17_222245_create_empresas_table', 1),
(10, '2022_11_17_222646_create_empresa_facturacions_table', 1),
(11, '2022_11_17_222646_create_tipo_documentos_table', 1),
(12, '2022_11_17_230620_create_serializacions_table', 1),
(13, '2022_11_18_203325_create_permission_tables', 1),
(14, '2022_11_19_001451_create_module_users_table', 1),
(15, '2022_11_19_001527_create_module_level_users_table', 1),
(16, '2022_11_19_070059_create_cajas_table', 1),
(17, '2022_11_19_145335_create_almacens_table', 1),
(18, '2022_11_19_145449_create_categorias_table', 1),
(19, '2022_11_19_145517_create_marcas_table', 1),
(20, '2022_11_19_145533_create_productos_table', 1),
(21, '2022_11_19_145549_create_servicios_table', 1),
(22, '2022_11_19_145550_create_tablas_table', 1),
(23, '2022_11_19_145551_create_motivo_traslados_table', 1),
(24, '2022_11_19_145551_create_tabla_detalles_table', 1),
(25, '2022_11_19_145617_create_nota_ingresos_table', 1),
(26, '2022_11_19_145629_create_nota_salidas_table', 1),
(27, '2022_11_19_145643_create_nota_ingreso_detalles_table', 1),
(28, '2022_11_19_145655_create_nota_salida_detalles_table', 1),
(29, '2022_11_20_173223_create_tipo_pagos_table', 1),
(30, '2022_11_29_223241_create_cuenta_pagos_table', 1),
(31, '2022_12_04_235922_create_kardexes_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE `modules` (
  `id` int UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id`, `descripcion`, `orden`, `created_at`, `updated_at`) VALUES
(1, 'Panel de control', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(2, 'Alquiler campo', 2, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(3, 'Cajas', 3, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(4, 'Compras', 4, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(5, 'Ventas', 5, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(6, 'Almacen', 6, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(7, 'Configuración', 7, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(8, 'Seguridad', 8, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(9, 'Tienda', 9, '2023-06-30 22:03:55', '2023-06-30 22:03:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module_levels`
--

CREATE TABLE `module_levels` (
  `id` int UNSIGNED NOT NULL,
  `module_id` int UNSIGNED NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `module_levels`
--

INSERT INTO `module_levels` (`id`, `module_id`, `descripcion`, `orden`, `created_at`, `updated_at`) VALUES
(1, 2, 'Campos', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(2, 3, 'Cajas', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(3, 3, 'Apertura y Cierre', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(4, 3, 'Egresos', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(5, 4, 'Proveedores', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(6, 4, 'Orden de compra', 2, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(7, 4, 'Documento de compra', 3, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(8, 5, 'Clientes', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(9, 5, 'Cotizaciones', 2, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(10, 5, 'Documentos de ventas', 3, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(11, 5, 'Guias de remisión', 4, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(12, 6, 'Almacenes', 1, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(13, 6, 'Categorias', 2, '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
(14, 6, 'Marcas', 3, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(15, 6, 'Productos', 4, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(16, 6, 'Servicios', 5, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(17, 6, 'Nota de ingreso', 6, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(18, 6, 'Nota de salida', 7, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(19, 7, 'Campos', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(20, 7, 'Horario de trabajo', 2, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(21, 7, 'Empresa', 3, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(22, 8, 'Usuarios', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(23, 8, 'Roles', 2, '2023-06-30 22:03:56', '2023-06-30 22:03:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module_level_user`
--

CREATE TABLE `module_level_user` (
  `id` int UNSIGNED NOT NULL,
  `module_level_id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module_user`
--

CREATE TABLE `module_user` (
  `id` int UNSIGNED NOT NULL,
  `module_id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_traslados`
--

CREATE TABLE `motivo_traslados` (
  `id` int UNSIGNED NOT NULL,
  `codigo` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('INGRESO','EGRESO') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `motivo_traslados`
--

INSERT INTO `motivo_traslados` (`id`, `codigo`, `nombre`, `tipo`) VALUES
(1, '02', 'Compra nacional', 'INGRESO'),
(2, '03', 'Consignación recibida', 'INGRESO'),
(3, '05', 'Devolución recibida', 'INGRESO'),
(4, '16', 'Inventario inicial', 'INGRESO'),
(5, '18', 'Entrada de importación', 'INGRESO'),
(6, '19', 'Ingreso de producción', 'INGRESO'),
(7, '20', 'Entrada por devolución de producción', 'INGRESO'),
(8, '21', 'Entrada por transferencia entre almacenes', 'INGRESO'),
(9, '22', 'Entrada por identificación erronea', 'INGRESO'),
(10, '24', 'Entrada por devolución del cliente', 'INGRESO'),
(11, '26', 'Entrada para servicio de producción', 'INGRESO'),
(12, '29', 'Entrada de bienes en prestamo', 'INGRESO'),
(13, '31', 'Entrada de bienes en custodia', 'INGRESO'),
(14, '50', 'Ingreso temporal', 'INGRESO'),
(15, '52', 'Ingreso por transformación', 'INGRESO'),
(16, '54', 'Ingreso de producción', 'INGRESO'),
(17, '55', 'Entrada de importación', 'INGRESO'),
(18, '57', 'Entrada por conversión de medida', 'INGRESO'),
(19, '91', 'Ingreso por transformación', 'INGRESO'),
(20, '93', 'Ingreso temporal', 'INGRESO'),
(21, '96', 'Entrada por conversión de medida', 'INGRESO'),
(22, '99', 'Otros', 'INGRESO'),
(23, '01', 'Venta nacional', 'EGRESO'),
(24, '04', 'Consignación entregada', 'EGRESO'),
(25, '06', 'Devolución entregada', 'EGRESO'),
(26, '07', 'Bonificación', 'EGRESO'),
(27, '08', 'Premio', 'EGRESO'),
(28, '09', 'Donación', 'EGRESO'),
(29, '10', 'Salida a producción', 'EGRESO'),
(30, '11', 'Salida por transferencia entre almacenes', 'EGRESO'),
(31, '12', 'Retiro', 'EGRESO'),
(32, '13', 'Mermas', 'EGRESO'),
(33, '14', 'Desmedros', 'EGRESO'),
(34, '15', 'Destrucción', 'EGRESO'),
(35, '17', 'Exportación', 'EGRESO'),
(36, '23', 'Salida por identificación erronea', 'EGRESO'),
(37, '25', 'Salida por devolución al proveedor', 'EGRESO'),
(38, '27', 'Salida por servicio de producción', 'EGRESO'),
(39, '28', 'Ajuste por diferencia de inventario', 'EGRESO'),
(40, '30', 'Salida de bienes en prestamo', 'EGRESO'),
(41, '32', 'Salida de bienes en custodia', 'EGRESO'),
(42, '33', 'Muestras médicas', 'EGRESO'),
(43, '34', 'Publicidad', 'EGRESO'),
(44, '35', 'Gastos de representación', 'EGRESO'),
(45, '36', 'Retiro para entrega a trabajadores', 'EGRESO'),
(46, '37', 'Retiro por convenio colectivo', 'EGRESO'),
(47, '38', 'Retiro por sustitución de bien siniestrado', 'EGRESO'),
(48, '51', 'Salida temporal', 'EGRESO'),
(49, '53', 'Salida para servicios terceros', 'EGRESO'),
(50, '56', 'Salida por conversión de medida', 'EGRESO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_ingresos`
--

CREATE TABLE `nota_ingresos` (
  `id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `motivo_traslado_id` int UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `origen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destino` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moneda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_cambio` decimal(18,2) NOT NULL DEFAULT '0.00',
  `dolar` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `total_soles` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `total_dolares` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `total_mas_igv_soles` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `total_mas_igv_dolares` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_ingreso_detalles`
--

CREATE TABLE `nota_ingreso_detalles` (
  `id` int UNSIGNED NOT NULL,
  `nota_ingreso_id` int UNSIGNED NOT NULL,
  `producto_id` int UNSIGNED NOT NULL,
  `cantidad` decimal(18,2) NOT NULL,
  `costo` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `costo_soles` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `costo_dolares` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `costo_mas_igv_soles` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `costo_mas_igv_dolares` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `valor_ingreso` decimal(18,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_salidas`
--

CREATE TABLE `nota_salidas` (
  `id` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `origen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destino` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_salida_detalles`
--

CREATE TABLE `nota_salida_detalles` (
  `id` int UNSIGNED NOT NULL,
  `nota_salida_id` int UNSIGNED NOT NULL,
  `producto_id` int UNSIGNED NOT NULL,
  `cantidad` decimal(18,2) NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int UNSIGNED NOT NULL,
  `almacen_id` int UNSIGNED NOT NULL,
  `categoria_id` int UNSIGNED NOT NULL,
  `marca_id` int UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_barra` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_venta` decimal(18,2) NOT NULL,
  `precio_compra` decimal(18,2) NOT NULL,
  `stock` decimal(18,2) NOT NULL,
  `tiene_igv` tinyint(1) NOT NULL,
  `stock_minimo` decimal(18,2) NOT NULL,
  `unidad_medida` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serializacions`
--

CREATE TABLE `serializacions` (
  `id` int UNSIGNED NOT NULL,
  `empresa_id` int UNSIGNED NOT NULL,
  `tipo_documento_id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serie` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_numeros` int NOT NULL,
  `destino` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `por_defecto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_fin` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(18,2) NOT NULL,
  `estado_alquiler` enum('CAMPO NOCHE','CAMPO DIA','ACADEMIA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablas`
--

CREATE TABLE `tablas` (
  `id` int UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tablas`
--

INSERT INTO `tablas` (`id`, `descripcion`, `sigla`, `editable`, `created_at`, `updated_at`) VALUES
(1, 'TIPOS DE MONEDA', 'TIPOS DE MONEDA', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(2, 'BANCOS', 'BANCOS', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(3, 'TIPOS DE DOCUMENTO', 'TIPOS DE DOCUMENTO', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(4, 'TIPOS DE SEXO', 'SEXO', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(5, 'TIPOS DE ESTADO CIVIL', 'ESTADO CIVIL', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(6, 'ZONAS', 'ZONAS', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(7, 'AREAS', 'AREAS', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(8, 'CARGOS', 'CARGOS', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(9, 'PROFESIONES', 'PROFESIONES', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(10, 'PRESENTACIONES', 'PRESENTACIONES', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(11, 'TIPOS DE PERSONAS', 'PERSONAS', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(12, 'GRUPOS SANGUINEOS', 'GRUPOS SANGUINEOS', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(13, 'UNIDAD MEDIDA', 'UNIDAD MEDIDA', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(14, 'MODO DE COMPRA', 'MODO DE COMPRA', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(15, 'TIPOS DE DOCUMENTOS TRIBUTARIOS', 'TIPO DOCUMENTO TRIBUTARIO', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(16, 'TIPOS DE DOCUMENTOS DE COMPRA', 'TIPO DOCUMENTO COMPRA', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(17, 'TIPO DE CLIENTE', 'TIPO DE CLIENTE', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(18, 'CONDICION DE REPARTO', 'CONDICION DE REPARTO', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(19, 'TIPOS DE PAGO (CAJA CHICA)', 'TIPO DE PAGO CAJA CHICA', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(20, 'HERRAMIENTAS DE PLANTA', 'HERRAMIENTAS DE PLANTA', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(21, 'TIPOS DE VENTA', 'TIPO DE VENTA', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(22, 'TIPOS DE TIENDA', 'TIPO DE TIENDA', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(23, 'TIPOS DE NEGOCIO', 'TIPO DE NEGOCIO', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(24, 'RESPONSABLE DE PAGO', 'RESPONSABLE DE PAGO', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(25, 'LINEA COMERCIAL', 'LINEA COMERCIAL', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(26, 'PLAN FATURACION ELECTRONICA', 'PFE', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(27, 'AMBIENTE DE PRODUCCION FATURACION ELECTRONICA', 'APFE', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(28, 'ORÍGENES', 'OR', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(29, 'DESTINOS', 'DE', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(30, 'FORMAS DE PAGO', 'FP', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(31, 'TURNOS', 'TURNO', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(32, 'CUENTAS', 'CUENTAS', 0, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(33, 'TIPOS NOTA DE CREDITO', 'CODMOTIVO', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(34, 'MOTIVOS DE TRASLADO', 'MTRASLADO', 1, '2023-06-30 22:03:56', '2023-06-30 22:03:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_detalles`
--

CREATE TABLE `tabla_detalles` (
  `id` int UNSIGNED NOT NULL,
  `tabla_id` int UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simbolo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parametro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tabla_detalles`
--

INSERT INTO `tabla_detalles` (`id`, `tabla_id`, `descripcion`, `nombre`, `simbolo`, `parametro`, `operacion`, `tipo`, `editable`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'SOLES', NULL, 'S/.', 'PEN', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(2, 1, 'DOLARES', NULL, '$', 'USD', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(3, 2, 'BANCO DE LA NACION', NULL, 'BN', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(4, 2, 'INTERCONTINENTAL', NULL, 'INTERCONTINENTAL', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(5, 2, 'MI BANCO', NULL, 'MI BANCO', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(6, 3, 'DOCUMENTO NACIONAL DE IDENTIDAD', NULL, 'DNI', '1', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(7, 3, 'CARNET DE EXTRANJERIA', NULL, 'CARNET EXT.', '4', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(8, 3, 'REGISTRO UNICO DE CONTRIBUYENTES', NULL, 'RUC', '6', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(9, 3, 'PASAPORTE', NULL, 'PASAPORTE', '7', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(10, 3, 'PARTIDA DE NACIMIENTO', NULL, 'P. NAC.', '0', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(11, 4, 'HOMBRE', NULL, 'H', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(12, 4, 'MUJER', NULL, 'M', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(13, 5, 'SOLTERO', NULL, 'S', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(14, 5, 'CASADO', NULL, 'C', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(15, 5, 'DIVORCIADO', NULL, 'D', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(16, 5, 'VIUDO', NULL, 'V', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(17, 6, 'NORTE', NULL, 'NORTE', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(18, 6, 'NOROESTE', NULL, 'NOROESTE', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(19, 6, 'CENTRO', NULL, 'CENTRO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(20, 6, 'SUR', NULL, 'SUR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(21, 6, 'SURESTE', NULL, 'SURESTE', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(22, 7, 'GERENCIA GENERAL', NULL, 'GERENCIA GENERAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(23, 7, 'CONTABILIDAD', NULL, 'CONTABILIDAD', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(24, 7, 'ALMACÉN', NULL, 'ALMACÉN', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(25, 7, 'FÁBRICA', NULL, 'FÁBRICA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(26, 7, 'COMERCIAL', NULL, 'COMERCIAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(27, 8, 'GERENTE GENERAL', NULL, 'GERENTE GENERAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(28, 8, 'ASISTENTE DE CONTABILIDAD', NULL, 'ASISTENTE DE CONTABILIDAD', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(29, 8, 'ASISTENTE DE ALMACÉN', NULL, 'ASISTENTE DE ALMACÉN', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(30, 8, 'OPERARIO DE FÁBRICA', NULL, 'OPERARIO DE FÁBRICA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(31, 9, 'INGENIERO(A) INDUSTRIAL', NULL, 'ING. INDUSTRIAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(32, 9, 'INGENIERO(A) DE SISTEMAS', NULL, 'ING. SISTEMAS', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(33, 9, 'INGENIERO(A) AGROINDUSTRIAL', NULL, 'ING. AGROINDUSTRIAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(34, 9, 'CONTADOR PÚBLICO', NULL, 'CONTADOR PÚBLICO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(35, 9, 'ADMINISTRADOR', NULL, 'ADMINISTRADOR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(36, 9, 'TÉCNICO DE MAQUINARIA', NULL, 'TÉCNICO DE MAQUINARIA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(37, 10, 'PAQUETE', NULL, 'PAQ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(38, 10, 'UNIDAD', NULL, 'UND', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(39, 10, 'GALON', NULL, 'G', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(40, 11, 'PERSONA NATURAL', NULL, 'PERSONA NATURAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(41, 11, 'PERSONA JURIDICA', NULL, 'PERSONA JURIDICA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(42, 12, 'O NEGATIVO', NULL, 'O-', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(43, 12, 'O POSITIVO', NULL, 'O+', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(44, 12, 'A NEGATIVO', NULL, 'A-', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(45, 12, 'A POSITIVO', NULL, 'A+', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(46, 12, 'B NEGATIVO', NULL, 'B-', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(47, 12, 'B POSITIVO', NULL, 'B+', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(48, 13, 'BOBINAS', NULL, '4A', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(49, 13, 'BALDE', NULL, 'BJ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(50, 13, 'BARRILES', NULL, 'BLL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(51, 13, 'BOLSA', NULL, 'BG', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(52, 13, 'BOTELLAS', NULL, 'BO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(53, 13, 'CAJA', NULL, 'BX', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(54, 13, 'CARTONES', NULL, 'CT', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(55, 13, 'CENTIMETRO CUADRADO', NULL, 'CMK', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(56, 13, 'CENTIMETRO CUBICO', NULL, 'CMQ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(57, 13, 'CENTIMETRO LINEAL', NULL, 'CMT', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(58, 13, 'CIENTO DE UNIDADES', NULL, 'CEN', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(59, 13, 'CILINDRO', NULL, 'CY', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(60, 13, 'CONOS', NULL, 'CJ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(61, 13, 'DOCENA', NULL, 'DZN', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(62, 13, 'DOCENA POR 10**6', NULL, 'DZP', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(63, 13, 'FARDO', NULL, 'BE', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(64, 13, 'GALON INGLES (4,545956L)', NULL, 'GLI', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(65, 13, 'GRAMO', NULL, 'GRM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(66, 13, 'GRUESA', NULL, 'GRO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(67, 13, 'HECTOLITRO', NULL, 'HLT', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(68, 13, 'HOJA', NULL, 'LEF', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(69, 13, 'JUEGO', NULL, 'SET', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(70, 13, 'KILOGRAMO', NULL, 'KGM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(71, 13, 'KILOMETRO', NULL, 'KTM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(72, 13, 'KILOVATIO HORA', NULL, 'KWH', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(73, 13, 'KIT', NULL, 'KIT', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(74, 13, 'LATAS', NULL, 'CA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(75, 13, 'LIBRAS', NULL, 'LBR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(76, 13, 'LITRO', NULL, 'LTR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(77, 13, 'MEGAWATT HORA', NULL, 'MWH', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(78, 13, 'MEGAWATT HORA', NULL, 'MWH', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(79, 13, 'METRO', NULL, 'MTR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(80, 13, 'METRO CUADRADO', NULL, 'MTK', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(81, 13, 'METRO CUBICO', NULL, 'MTQ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(82, 13, 'MILIGRAMOS', NULL, 'MGM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(83, 13, 'MILILITRO', NULL, 'MLT', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(84, 13, 'MILIMETRO', NULL, 'MMT', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(85, 13, 'MILIMETRO CUADRADO', NULL, 'MMK', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(86, 13, 'MILIMETRO CUBICO', NULL, 'MMQ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(87, 13, 'MILLARES', NULL, 'MIL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(88, 13, 'MILLON DE UNIDADES', NULL, 'UM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(89, 13, 'ONZAS', NULL, 'ONZ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(90, 13, 'PALETAS', NULL, 'PF', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(91, 13, 'PAQUETE', NULL, 'PK', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(92, 13, 'PAR', NULL, 'PR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(93, 13, 'PIES', NULL, 'FOT', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(94, 13, 'PIES CUADRADOS', NULL, 'FTK', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(95, 13, 'PIES CUBICOS', NULL, 'FTQ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(96, 13, 'PIEZAS', NULL, 'C62', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(97, 13, 'PLIEGO', NULL, 'ST', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(98, 13, 'PULGADAS', NULL, 'INH', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(99, 13, 'RESMA', NULL, 'RM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(100, 13, 'TAMBOR', NULL, 'DR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(101, 13, 'TONELADA CORTA', NULL, 'STN', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(102, 13, 'TONELADA LARGA', NULL, 'LTN', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(103, 13, 'TONELADAS', NULL, 'TNE', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(104, 13, 'TUBOS', NULL, 'TU', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(105, 13, 'UNIDAD (BIENES)', NULL, 'NIU', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(106, 13, 'UNIDAD (SERVICIOS)', NULL, 'ZZ', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(107, 13, 'US GALON (3,7843 L)', NULL, 'GLL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(108, 13, 'YARDA', NULL, 'YRD', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(109, 13, 'YARDA CUADRADA', NULL, 'YDK', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(110, 14, 'CONTADO 30 DÍAS', NULL, 'CONTADO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(111, 14, 'CONTRATO DE CRÉDITO', NULL, 'CREDITO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(112, 15, 'FACTURA', NULL, 'FAC', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(113, 15, 'BOLETA', NULL, 'BOL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(114, 15, 'RECIBO', NULL, 'REC', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(115, 15, 'NOTA DE CRÉDITO', NULL, 'NC', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(116, 15, 'NOTA DE DÉBITO', NULL, 'ND', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(117, 15, 'GUÍA DE REMISIÓN', NULL, 'GR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(118, 16, 'FACTURA', NULL, 'FAC', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(119, 16, 'BOLETA', NULL, 'BOL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(120, 16, 'RECIBO', NULL, 'REC', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(121, 17, 'NORMAL', NULL, 'NORMAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(122, 17, 'DISTRIBUIDOR', NULL, 'DISTRIBUIDOR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(123, 18, 'OFICINA', NULL, 'OFICINA', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(124, 18, 'DOMICILIO', NULL, 'DOMICILIO', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(125, 19, 'EFECTIVO', NULL, 'EFEC.', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(126, 19, 'DEPOSITO', NULL, 'DEP.', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(127, 21, 'FACTURA ELECTRÓNICA', 'FACTURA ELECTRÓNICA', '01', 'F', '0101', 'VENTA', 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(128, 21, 'BOLETA ELECTRÓNICA', 'BOLETA ELECTRÓNICA', '03', 'B', '0101', 'VENTA', 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(129, 21, 'NOTA DE VENTA', 'NOTA DE VENTA', '04', 'N', '0101', 'VENTA', 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(130, 21, 'NOTA DE CRÉDITO', NULL, '07', 'FF', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(131, 21, 'NOTA DE DÉBITO', NULL, '08', 'FF', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(132, 21, 'GUIA DE REMISIÓN REMITENTE ELECTRÓNICA', 'GUIA DE REMISIÓN', '09', 'T', NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(133, 22, 'FISICA', NULL, 'FISICA', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(134, 22, 'VIRTUAL', NULL, 'VIRTUAL', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(135, 23, 'MARKET', NULL, 'MARKET', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(136, 23, 'CASA ORGANICA', NULL, 'CASA ORGANICA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(137, 23, 'BIOTIENDA', NULL, 'BIOTIENDA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(138, 23, 'TIENDA NATURISTA', NULL, 'T. NATURAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(139, 24, 'CANCELA SOCIO', NULL, 'CANCELA SOCIO', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(140, 24, 'CANCELA ECOVALLE', NULL, 'CANCELA ECOVALLE', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(141, 25, 'BELLEZA', NULL, 'BELLEZA', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(142, 25, 'CONTROL DE PESO', NULL, 'CONTROL DE PESO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(143, 25, 'ENERGIZANTES', NULL, 'ENERGIZANTES', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(144, 25, 'NUTRICIÓN', NULL, 'NUTRICIÓN', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(145, 25, 'SISTEMA CIRCULATORIO', NULL, 'SIST. CIRCULATORIO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(146, 25, 'SISTEMA DIGESTIVO', NULL, 'SIST. DIGESTIVO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(147, 25, 'SISTEMA ESTRUCTURAL', NULL, 'SIST. ESTRUCTURAL', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(148, 25, 'SISTEMA GLANDULAR', NULL, 'SIST. GLANDULAR', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(149, 25, 'SISTEMA INMUNOLÓGICO', NULL, 'SIST. INMUNOLÓGICO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(150, 25, 'SISTEMA NERVIOSO', NULL, 'SIST. NERVIOSO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(151, 25, 'SISTEMA RESPIRATORIO', NULL, 'SIST. RESPIRATORIO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(152, 25, 'SISTEMA URINARIO', NULL, 'SIST. URINARIO', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(153, 26, 'free', NULL, 'free', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(154, 26, 'premium', NULL, 'premium', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(155, 27, 'beta', NULL, 'beta', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(156, 27, 'produccion', NULL, 'produccion', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(157, 28, 'IMPORT EXCEL', NULL, 'OE', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(158, 28, 'PROVEEDOR', NULL, 'OP', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(159, 29, 'CLIENTE', NULL, 'OP', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(160, 30, 'CONTADO', NULL, 'Contado', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(161, 30, 'CRÉDITO', NULL, 'Credito', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(162, 31, 'MAÑANA', NULL, 'AM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(163, 31, 'TARDE', NULL, 'PM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(164, 31, 'NOCHE', NULL, 'PM', NULL, NULL, NULL, 0, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(165, 32, 'DEVOLUCION', NULL, 'DEV', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(166, 33, 'Anulación de operación', 'Anulación de operación', '01', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(167, 33, 'Anulación por error en el RUC', 'Anulación por error en el RUC', '02', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(168, 33, 'Correción por error en la descripcion', 'Correción por error en la descripcion', '03', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(169, 33, 'Descuento global', 'Descuento global', '04', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(170, 33, 'Descuento por item', 'Descuento por item', '05', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(171, 33, 'Descuento por item', 'Descuento por item', '06', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(172, 33, 'Devolución por item', 'Devolución por item', '07', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(173, 33, 'Bonificación', 'Bonificacion', '08', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(174, 33, 'Disminución en el valor', 'Disminución en el valor', '09', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:56', '2023-06-30 22:03:56'),
(175, 33, 'Otros conceptos', 'Otros conceptos', '10', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(176, 34, 'VENTA', 'VENTA', '01', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(177, 34, 'VENTA SUJETA A CONFIRMACION DEL COMPRADOR', 'VENTA SUJETA A CONFIRMACION DEL COMPRADOR', '14', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(178, 34, 'COMPRA', 'COMPRA', '02', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(179, 34, 'TRASLADO ENTRE ESTABLECIMIENTOS DE LA MISMA EMPRESA', 'TRASLADO ENTRE ESTABLECIMIENTOS DE LA MISMA EMPRESA', '04', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(180, 34, 'TRASLADO EMISOR ITINERANTE CP', 'TRASLADO EMISOR ITINERANTE CP', '18', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(181, 34, 'IMPORTACION', 'IMPORTACION', '08', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(182, 34, 'EXPORTACION', 'EXPORTACION', '09', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(183, 34, 'TRASLADO A ZONA PRIMARIA', 'TRASLADO A ZONA PRIMARIA', '19', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(184, 34, 'OTROS', 'OTROS', '13', NULL, NULL, NULL, 1, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documentos`
--

CREATE TABLE `tipo_documentos` (
  `id` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint NOT NULL,
  `abreviatura` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documentos`
--

INSERT INTO `tipo_documentos` (`id`, `activo`, `abreviatura`, `descripcion`, `created_at`, `updated_at`) VALUES
('01', 1, 'FT', 'FACTURA ELECTRÓNICA', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('03', 1, 'BV', 'BOLETA DE VENTA ELECTRÓNICA', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('07', 1, 'NC', 'NOTA DE CRÉDITO', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('08', 1, 'ND', 'NOTA DE DÉBITO', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('09', 1, 'GRR', 'GUIA DE REMISIÓN REMITENTE', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('20', 1, 'CRE', 'COMPROBANTE DE RETENCIÓN ELECTRÓNICA', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('50', 1, 'T', 'TICKET', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('51', 1, 'TC', 'TICKET DE COMPRA', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('52', 1, 'NI', 'NOTA DE INGRESO', '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
('53', 1, 'NS', 'NOTA DE SALIDA', '2023-06-30 22:03:55', '2023-06-30 22:03:55'),
('80', 1, 'NV', 'NOTA DE VENTA', '2023-06-30 22:03:54', '2023-06-30 22:03:54'),
('NE76', 1, 'NE', 'NOTA DE ENTRADA', '2023-06-30 22:03:54', '2023-06-30 22:03:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pagos`
--

CREATE TABLE `tipo_pagos` (
  `id` int UNSIGNED NOT NULL,
  `descripcion` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `simbolo` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT '0',
  `estado` enum('ACTIVO','ANULADO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_pagos`
--

INSERT INTO `tipo_pagos` (`id`, `descripcion`, `simbolo`, `editable`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'EFECTIVO', 'EFECTIVO', 0, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(2, 'TRANSFERENCIA', 'TRANSFERENCIA', 0, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(3, 'YAPE/PLIN', 'YAPE/PLIN', 0, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(4, 'POS', 'POS', 0, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57'),
(5, 'MIXTO', 'MIXTO', 0, 'ACTIVO', '2023-06-30 22:03:57', '2023-06-30 22:03:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'axel@gmail.com', NULL, '$2y$10$4F3vHYPg2rXFe/rHOzfJy.FTxK9TDSEZAmQlpFaYUIZlPQ2kL3v/G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuenta_pagos`
--
ALTER TABLE `cuenta_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa_facturacions`
--
ALTER TABLE `empresa_facturacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_facturacions_empresa_id_foreign` (`empresa_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `module_levels`
--
ALTER TABLE `module_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_levels_module_id_foreign` (`module_id`);

--
-- Indices de la tabla `module_level_user`
--
ALTER TABLE `module_level_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_level_user_module_level_id_foreign` (`module_level_id`),
  ADD KEY `module_level_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `module_user`
--
ALTER TABLE `module_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_user_module_id_foreign` (`module_id`),
  ADD KEY `module_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `motivo_traslados`
--
ALTER TABLE `motivo_traslados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_ingresos`
--
ALTER TABLE `nota_ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_ingresos_user_id_foreign` (`user_id`),
  ADD KEY `nota_ingresos_motivo_traslado_id_foreign` (`motivo_traslado_id`);

--
-- Indices de la tabla `nota_ingreso_detalles`
--
ALTER TABLE `nota_ingreso_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_ingreso_detalles_nota_ingreso_id_foreign` (`nota_ingreso_id`),
  ADD KEY `nota_ingreso_detalles_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `nota_salidas`
--
ALTER TABLE `nota_salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_salidas_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `nota_salida_detalles`
--
ALTER TABLE `nota_salida_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_salida_detalles_nota_salida_id_foreign` (`nota_salida_id`),
  ADD KEY `nota_salida_detalles_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_almacen_id_foreign` (`almacen_id`),
  ADD KEY `productos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `productos_marca_id_foreign` (`marca_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `serializacions`
--
ALTER TABLE `serializacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serializacions_empresa_id_foreign` (`empresa_id`),
  ADD KEY `serializacions_tipo_documento_id_foreign` (`tipo_documento_id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tablas`
--
ALTER TABLE `tablas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla_detalles`
--
ALTER TABLE `tabla_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tabla_detalles_tabla_id_foreign` (`tabla_id`);

--
-- Indices de la tabla `tipo_documentos`
--
ALTER TABLE `tipo_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_pagos`
--
ALTER TABLE `tipo_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta_pagos`
--
ALTER TABLE `cuenta_pagos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa_facturacions`
--
ALTER TABLE `empresa_facturacions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `module_levels`
--
ALTER TABLE `module_levels`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `module_level_user`
--
ALTER TABLE `module_level_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `module_user`
--
ALTER TABLE `module_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivo_traslados`
--
ALTER TABLE `motivo_traslados`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `nota_ingresos`
--
ALTER TABLE `nota_ingresos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota_ingreso_detalles`
--
ALTER TABLE `nota_ingreso_detalles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota_salidas`
--
ALTER TABLE `nota_salidas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nota_salida_detalles`
--
ALTER TABLE `nota_salida_detalles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `serializacions`
--
ALTER TABLE `serializacions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tablas`
--
ALTER TABLE `tablas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `tabla_detalles`
--
ALTER TABLE `tabla_detalles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT de la tabla `tipo_pagos`
--
ALTER TABLE `tipo_pagos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa_facturacions`
--
ALTER TABLE `empresa_facturacions`
  ADD CONSTRAINT `empresa_facturacions_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `module_levels`
--
ALTER TABLE `module_levels`
  ADD CONSTRAINT `module_levels_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `module_level_user`
--
ALTER TABLE `module_level_user`
  ADD CONSTRAINT `module_level_user_module_level_id_foreign` FOREIGN KEY (`module_level_id`) REFERENCES `module_levels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `module_level_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `module_user`
--
ALTER TABLE `module_user`
  ADD CONSTRAINT `module_user_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `module_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `nota_ingresos`
--
ALTER TABLE `nota_ingresos`
  ADD CONSTRAINT `nota_ingresos_motivo_traslado_id_foreign` FOREIGN KEY (`motivo_traslado_id`) REFERENCES `motivo_traslados` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nota_ingresos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `nota_ingreso_detalles`
--
ALTER TABLE `nota_ingreso_detalles`
  ADD CONSTRAINT `nota_ingreso_detalles_nota_ingreso_id_foreign` FOREIGN KEY (`nota_ingreso_id`) REFERENCES `nota_ingresos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nota_ingreso_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `nota_salidas`
--
ALTER TABLE `nota_salidas`
  ADD CONSTRAINT `nota_salidas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `nota_salida_detalles`
--
ALTER TABLE `nota_salida_detalles`
  ADD CONSTRAINT `nota_salida_detalles_nota_salida_id_foreign` FOREIGN KEY (`nota_salida_id`) REFERENCES `nota_salidas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nota_salida_detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_almacen_id_foreign` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_marca_id_foreign` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `serializacions`
--
ALTER TABLE `serializacions`
  ADD CONSTRAINT `serializacions_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `serializacions_tipo_documento_id_foreign` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documentos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tabla_detalles`
--
ALTER TABLE `tabla_detalles`
  ADD CONSTRAINT `tabla_detalles_tabla_id_foreign` FOREIGN KEY (`tabla_id`) REFERENCES `tablas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
