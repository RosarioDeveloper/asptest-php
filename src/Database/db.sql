DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL COLLATE utf8mb4_unicode_ci ,
  `last_name` varchar(255) NOT NULL COLLATE utf8mb4_unicode_ci ,
  `email` varchar(255) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci ,
  `age` int NULL DEFAULT NULL,
  `password` varchar(255) NULL COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
