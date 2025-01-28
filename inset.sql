INSERT INTO `almacen` (`idAlmacen`, `Nombre_Materia`, `Cantidad_Existente`, `Cantidad_Minimas`, `imagen_ref`, `Referencias_Almacen_idReferencias_Almacen`) VALUES
(1, 'Harina', '20.00000', '1.00000', 'https://chedrauimx.vtexassets.com/arquivos/ids/38922548-800-auto?v=638670739792330000&width=800&height=auto&aspect=true', 1),
(2, 'MANTECA', '18.12000', '1.00000', 'https://d1zc67o3u1epb0.cloudfront.net/media/catalog/product/m/a/manteca-colon.jpg?width=265&height=390&store=default&image-type=image', 2),
(3, 'HUEVOS CALVARIO', '7.00000', '2.00000', 'https://www.elcalvario.com.mx/image/productos/producto_el_calvario5.png', 3);


INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2023-09-07 16:25:58'),
(2, 2, 'user', '2025-01-15 05:25:40');

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'javierbustamantesanjuan@gmail.com', '$2y$12$yhI7crqbOPpeztesJlSQr.tm5XlYB6GW2IeXE.LhQxey2dPSGMYlK', NULL, NULL, 0, '2025-01-27 14:53:05', '2023-09-07 16:25:57', '2025-01-27 14:53:05'),
(2, 2, 'email_password', NULL, 'Raulvillavicencio1@hotmail.com', '$2y$12$BHHfwxhf51CxU1.XlrMmweQHoIMOiGb5tL/.o8.4ZYj3u7zYHsjvq', NULL, NULL, 0, '2025-01-15 12:56:44', '2025-01-15 05:25:39', '2025-01-15 12:56:44');

-- ------
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-09-07 16:37:34', 1),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2023-09-09 18:11:42', 0),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-09-09 18:11:49', 1),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-09-09 19:55:38', 1),
(5, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-09-09 20:27:39', 1),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2023-09-12 16:58:07', 0),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-09-12 16:58:15', 1),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2023-09-22 19:40:29', 0),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-09-22 19:40:34', 1),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2023-09-28 21:53:31', 0),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2023-09-28 21:53:38', 0),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-09-28 21:53:47', 1),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2023-10-26 19:29:35', 0),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2023-10-26 19:29:42', 1),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2024-05-23 19:48:53', 0),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-05-23 19:49:05', 1),
(17, '2806:10ae:10:64f4:d98c:83ec:460a:7954', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-06-24 22:11:02', 1),
(18, '2806:10ae:10:64f4:d98c:83ec:460a:7954', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-06-24 22:22:17', 1),
(19, '189.250.38.72', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-06-25 00:58:41', 1),
(20, '2806:10ae:10:64f4:c00b:dc3f:9059:e825', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-06-25 16:07:46', 1),
(21, '2806:10ae:10:56af:c592:f5e8:569f:ec19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-07-11 17:51:14', 1),
(22, '2806:10ae:10:56af:a923:18f3:f77d:6d4f', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-07-11 18:07:40', 1),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2024-09-05 21:40:52', 0),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-09-05 21:40:59', 1),
(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2024-12-06 12:05:59', 0),
(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-12-06 12:06:21', 1),
(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-12-30 16:41:47', 1),
(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2024-12-30 19:25:13', 1),
(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-02 15:16:47', 1),
(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-03 14:31:49', 1),
(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-03 15:59:47', 1),
(32, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-07 14:01:21', 1),
(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-08 14:50:58', 1),
(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-09 01:55:18', 1),
(35, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-14 11:19:50', 1),
(36, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-14 19:14:16', 1),
(37, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'Raulvillavicencio1@hotmail.com', 2, '2025-01-15 12:56:44', 1),
(38, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-15 12:58:19', 1),
(39, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-17 06:52:16', 1),
(40, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-17 23:57:55', 1),
(41, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-18 07:30:11', 1),
(42, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-18 13:30:28', 1),
(43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-21 22:51:59', 1),
(44, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-22 11:15:39', 1),
(45, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-23 00:52:00', 1),
(46, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-24 13:39:23', 1),
(47, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-24 14:58:08', 1),
(48, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-24 15:21:32', 1),
(49, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'email_password', 'javierbustamantesanjuan@gmail.com', NULL, '2025-01-24 15:22:51', 0),
(50, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-24 15:23:06', 1),
(51, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-24 15:56:46', 1),
(52, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-24 16:03:54', 1),
(53, '189.250.207.184', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Mobile Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-24 16:34:12', 1),
(54, '177.238.19.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'email_password', 'javierbustamantesanjuan@gmail.com', 1, '2025-01-27 14:53:05', 1);



INSERT INTO `corroborar` (`idcorroborar`, `Fecha_edicion`, `Cantidad_cambio_Existente`, `Cantidad_Existente_Sistema`, `Motivo_del_Cambio`, `Almacen_idAlmacen`, `Almacen_Referencias_Almacen_idReferencias_Almacen`) VALUES
(1, '2025-02-01', '20.00000', '-104.95750', 'cambio al inicio', 1, 1);


INSERT INTO `empleados` (`idEmpleados`, `Nombre`, `Apellidos`, `Cargo`, `Numero_Telefonico`, `users_id`) VALUES
(1, 'Empleado1', 'BUSTAMANTE', 'Vendedor', '9513213429', 1),
(2, 'Raul', 'Villavicencio', 'Vendedor', '9513213425', 2);


INSERT INTO `incremento_almacen` (`idIncremento_Almacen`, `Fecha_de_Ingreso`, `Cantidad_Ingresada`, `Almacen_idAlmacen`) VALUES
(1, '2024-12-06', '2.00000', 1),
(2, '2025-01-03', '5.00000', 2),
(3, '2025-01-27', '2.00000', 1);


INSERT INTO `mercancia_sucursal` (`idPedidos`, `Confirmacion_Salida`, `Nota`, `Salida_Mercancia_idSalida_Mercancia`) VALUES
(1, 1, 'me faltaron 100', 11),
(2, 1, 'no me mandaron nada ', 12),
(3, 1, NULL, 4),
(4, 1, '', 13),
(5, 1, '', 14),
(6, 1, '', 24),
(7, 1, '', 25);


INSERT INTO `mermas` (`idSupervision`, `Conteo_Merma`, `productos_idProductos`, `tabla_produccion_fecha_idTabla_Produccion`, `users_id`) VALUES
(1, 10, 1, 11, 1),
(2, 10, 2, 11, 1);

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1725567436, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1725567436, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1725567436, 1);

-- ---
INSERT INTO `pedidos` (`idPedidos`, `Nombre_Cliente`, `Fecha_Pedido`, `Cantidad_requerida`, `Productos_idProductos`) VALUES
(1, 'javier bustamante', '2025-01-21', 200, 1),
(2, 'jose', '2025-01-21', 200, 2),
(3, 'jose', '2025-01-21', 200, 1),
(4, 'javier bustamante', '2025-01-23', 200, 1);


INSERT INTO `produccion_deseada` (`idProduccion_Deseada`, `Fecha_Registro`, `Cantidad_requerida`, `Productos_idProductos`) VALUES
(1, '2024-08-02', 200, 2),
(2, '2024-12-05', 100, 3),
(3, '2025-01-15', 500, 2),
(4, '2025-01-22', 200, 1);


INSERT INTO `produccion_productos` (`idProduccion_Productos`, `Cantidad_Realizada`, `Productos_idProductos`) VALUES
(1, 200, 1),
(2, 200, 2),
(3, 200, 3),
(4, 200, 3),
(5, 200, 3),
(6, 200, 1),
(7, 25, 1),
(8, 300, 3),
(9, 300, 2),
(10, 200, 3),
(11, 340, 2),
(12, 100, 2),
(13, 50, 1),
(14, 100, 3),
(15, 200, 2),
(16, 100, 2),
(17, 200, 1),
(18, 200, 1),
(19, 200, 2),
(20, 200, 1),
(21, 200, 2),
(22, 200, 1),
(23, 200, 3),
(24, 200, 1),
(25, 200, 2),
(26, 250, 1),
(27, 250, 2),
(28, 250, 2),
(29, 250, 2),
(30, 250, 1),
(31, 250, 3),
(32, 100, 1),
(33, 100, 3),
(34, 100, 2),
(35, 100, 2),
(36, 100, 3),
(37, 100, 2),
(38, 100, 3),
(39, 100, 1),
(40, 100, 2),
(41, 100, 3),
(42, 100, 3),
(43, 100, 3),
(44, 100, 3),
(45, 100, 2),
(46, 100, 3),
(47, 100, 3),
(48, 200, 1),
(49, 200, 3),
(50, 100, 3),
(51, 100, 2),
(52, 100, 1),
(53, 200, 1),
(54, 200, 2),
(55, 300, 3),
(56, 300, 1),
(57, 100, 1),
(58, 100, 1),
(59, 200, 1),
(60, 200, 3),
(61, 200, 1),
(62, 200, 2),
(63, 200, 3),
(64, 200, 1),
(65, 200, 2),
(66, 200, 3),
(67, 200, 1),
(68, 200, 2),
(69, 200, 3),
(70, 200, 1);



INSERT INTO `productos` (`idProductos`, `Nombre_Producto`, `Valor_produccion`, `Valor_Venta`) VALUES
(1, 'CONCHAS', '4.00000', '6.00000'),
(2, 'bolillo', '3.00000', '4.00000'),
(3, 'cuernos', '6.00000', '7.00000');




INSERT INTO `productos_has_almacen` (`Productos_idProductos`, `Almacen_idAlmacen`, `Cantidad_uso`) VALUES
(1, 1, 15),
(1, 2, 0.002),
(2, 1, 0.007),
(2, 2, 0.006),
(3, 1, 0.004),
(3, 2, 0.009);



INSERT INTO `provedores` (`idProvedores`, `Nombre_provedor`, `Producto`, `Telefono`, `Telefono_opcional`) VALUES
(1, 'GOPAR', 'PRODUCTOS PARA PANADERIA', '9513213429', NULL),
(2, 'SOLEDAD', 'MATERIAL PARA TIENDAS', '9511655101', NULL),
(3, 'PASTIGEL', 'PRODUCTOS PARA PANADERIA Y REPOSTERIA', '9515167777', NULL),
(4, 'SAMS CLUB APP', 'PRODUCTOS VARIOS', '', NULL),
(5, 'PITICO', 'JAMON HIELO', '9513167283', NULL),
(6, 'LA CENTRAL', 'SALSAS Y QUESOS PARA PIZA', '9513167283', NULL),
(7, 'SEMILLAS SHADAHI', 'NUEZ,ARANDANOS,COCO,CANELA', '', NULL),
(8, 'MAYORDOMO', 'CHOCOLATE', '', NULL),
(9, 'PLASTICOS BOLSAS', '', '9513227492', NULL),
(10, 'DOGO', 'GEL ANTIBACTERIAL', '', NULL);


INSERT INTO `referencias_almacen` (`idReferencias_Almacen`, `Medida`, `Cantidad_medida`, `Tipo_medicion`, `Provedores_idProvedores`) VALUES
(1, 'bultos', '25.00000', 'kg', 1),
(2, 'CAJAS', '20.00000', 'kg', 2),
(3, 'CAJAS HUEVO', '360.00000', 'PZ', 2);


INSERT INTO `salida_mercancia` (`idSalida_Mercancia`, `Cantidad_Salida`, `Productos_idProductos`, `Tabla_Produccion_Fecha_idTabla_Produccion`, `Sucursales_idSucursales`) VALUES
(1, 100, 1, 3, 1),
(2, 100, 1, 3, 1),
(3, 100, 2, 3, 1),
(4, 100, 3, 3, 1),
(5, 100, 2, 3, 1),
(6, 100, 3, 3, 1),
(7, 100, 1, 5, 1),
(8, 100, 3, 5, 1),
(9, 200, 1, 6, 1),
(10, 100, 2, 6, 1),
(11, 200, 2, 7, 1),
(12, 200, 3, 7, 1),
(13, 100, 3, 7, 1),
(14, 200, 1, 7, 1),
(15, 200, 1, 7, 1),
(16, 100, 1, 7, 2),
(17, 100, 1, 8, 1),
(18, 100, 1, 9, 1),
(19, 100, 2, 9, 1),
(20, 150, 3, 9, 1),
(21, 100, 1, 10, 1),
(22, 100, 2, 10, 1),
(23, 100, 3, 10, 1),
(24, 100, 1, 11, 1),
(25, 100, 2, 11, 1);



INSERT INTO `sucursales` (`idSucursales`, `NombreSucursal`, `Direccion_Sucursal`, `Empleados_idEmpleados`) VALUES
(1, 'CIENEGUITA', 'COL CIENEGUITA #1003', 1),
(2, '5 SEÑORES', '5 SEÑORES #######', 2);


INSERT INTO `tabla_produccion_fecha` (`idTabla_Produccion`, `Fecha_de_Produccion`) VALUES
(1, '2025-01-02'),
(2, '2025-01-03'),
(3, '2025-01-06'),
(4, '2025-01-08'),
(5, '2025-01-09'),
(6, '2025-01-13'),
(7, '2025-01-14'),
(8, '2025-01-15'),
(9, '2025-01-17'),
(10, '2025-01-18'),
(11, '2025-01-22'),
(12, '2025-01-24'),
(13, '2025-01-27');



INSERT INTO `tabla_produccion_fecha_has_produccion_productos` (`id`, `Tabla_Produccion_idTabla_Produccion_Fecha`, `Produccion_Productos_idProduccion_Productos`) VALUES
(1, 1, 6),
(2, 1, 7),
(3, 1, 8),
(4, 1, 9),
(5, 1, 10),
(6, 1, 11),
(7, 1, 12),
(8, 1, 13),
(9, 1, 14),
(10, 1, 15),
(11, 1, 16),
(12, 2, 18),
(13, 2, 19),
(14, 3, 21),
(15, 3, 22),
(16, 3, 23),
(17, 5, 29),
(18, 5, 30),
(19, 5, 31),
(20, 5, 32),
(21, 5, 33),
(22, 5, 34),
(23, 5, 35),
(24, 5, 36),
(25, 5, 37),
(26, 5, 38),
(27, 5, 39),
(28, 5, 40),
(29, 5, 41),
(30, 5, 42),
(31, 5, 43),
(32, 5, 44),
(33, 5, 45),
(34, 5, 46),
(35, 5, 47),
(36, 6, 48),
(37, 6, 49),
(38, 6, 50),
(39, 6, 51),
(40, 6, 52),
(41, 7, 54),
(42, 7, 55),
(43, 7, 56),
(44, 7, 57),
(45, 7, 58),
(46, 8, 59),
(47, 8, 60),
(48, 9, 61),
(49, 9, 62),
(50, 9, 63),
(51, 10, 64),
(52, 10, 65),
(53, 10, 66),
(54, 11, 67),
(55, 11, 68),
(56, 11, 69),
(57, 13, 70);

-- --
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Javier', NULL, NULL, 1, NULL, '2023-09-07 16:25:57', '2023-09-07 16:25:58', NULL),
(2, 'Raul', NULL, NULL, 1, NULL, '2025-01-15 05:25:38', '2025-01-15 05:25:40', NULL);
