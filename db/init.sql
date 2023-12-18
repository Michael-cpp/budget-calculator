CREATE DATABASE IF NOT EXISTS budget_calculator;

USE budget_calculator;

CREATE TABLE IF NOT EXISTS `purchase` (
`id` int NOT NULL AUTO_INCREMENT,
`description` varchar(128) NOT NULL,
`price` int NOT NULL DEFAULT '0',
`buyer` smallint NOT NULL DEFAULT '1',
`owner` smallint NOT NULL DEFAULT '1',
`date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1306 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

