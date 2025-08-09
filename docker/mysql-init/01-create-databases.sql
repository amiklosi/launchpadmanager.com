-- Create the main database
CREATE DATABASE IF NOT EXISTS `lmyosemite` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create the legacy database
CREATE DATABASE IF NOT EXISTS `launchpadmanager` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the main database
USE `lmyosemite`;

-- Create licenses table
CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `licensekey` varchar(36) NOT NULL,
  `remaining` int(11) NOT NULL DEFAULT 3,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `appgrid_blocked` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `licensekey` (`licensekey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_id` int(11) NOT NULL,
  `machine_id` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `key_id` (`key_id`),
  FOREIGN KEY (`key_id`) REFERENCES `licenses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create appgrid_checks table
CREATE TABLE IF NOT EXISTS `appgrid_checks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `licensekey` varchar(36) NOT NULL,
  `checked_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Use the legacy database
USE `launchpadmanager`;

-- Create legacy licenses table (for upgrade checks)
CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `licensekey` varchar(36) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `licensekey` (`licensekey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some sample data for testing
USE `lmyosemite`;
INSERT INTO `licenses` (`licensekey`, `remaining`) VALUES 
  ('12345678-1234-1234-1234-123456789012', 3),
  ('87654321-4321-4321-4321-210987654321', 1)
ON DUPLICATE KEY UPDATE `licensekey` = VALUES(`licensekey`);

USE `launchpadmanager`;
INSERT INTO `licenses` (`licensekey`) VALUES 
  ('old-license-1234-5678-9012-345678901234'),
  ('old-license-abcd-efgh-ijkl-mnopqrstuvwx')
ON DUPLICATE KEY UPDATE `licensekey` = VALUES(`licensekey`);