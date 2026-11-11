-- e-RoadCheck schema for MySQL/MariaDB (InnoDB, utf8mb4)
CREATE DATABASE IF NOT EXISTS eroadcheck CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE eroadcheck;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS verification_logs;
DROP TABLE IF EXISTS qr_codes;
DROP TABLE IF EXISTS revenue_records;
DROP TABLE IF EXISTS vehicle_documents;
DROP TABLE IF EXISTS vehicles;
DROP TABLE IF EXISTS driver_licenses;
DROP TABLE IF EXISTS drivers;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150) NOT NULL,
  username VARCHAR(60) NOT NULL UNIQUE,
  email VARCHAR(190) NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','officer') NOT NULL DEFAULT 'officer',
  status ENUM('active','inactive') NOT NULL DEFAULT 'active',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE drivers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150) NOT NULL,
  date_of_birth DATE NULL,
  gender ENUM('male','female','other','unspecified') NOT NULL DEFAULT 'unspecified',
  phone VARCHAR(40) NULL,
  address VARCHAR(255) NULL,
  photo_path VARCHAR(255) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_drivers_name (full_name), INDEX idx_drivers_phone (phone)
) ENGINE=InnoDB;

CREATE TABLE driver_licenses (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  driver_id BIGINT UNSIGNED NOT NULL,
  license_number VARCHAR(80) NOT NULL UNIQUE,
  license_class VARCHAR(80) NOT NULL,
  issue_date DATE NULL,
  expiry_date DATE NULL,
  status ENUM('active','suspended','revoked','pending') NOT NULL DEFAULT 'active',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_license_driver FOREIGN KEY (driver_id) REFERENCES drivers(id) ON UPDATE CASCADE ON DELETE RESTRICT,
  INDEX idx_license_expiry (expiry_date), INDEX idx_license_driver (driver_id)
) ENGINE=InnoDB;

CREATE TABLE vehicles (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  driver_id BIGINT UNSIGNED NOT NULL,
  plate_number VARCHAR(40) NOT NULL UNIQUE,
  make VARCHAR(80) NOT NULL,
  model VARCHAR(80) NOT NULL,
  colour VARCHAR(50) NULL,
  manufacture_year SMALLINT UNSIGNED NULL,
  vin VARCHAR(80) NULL UNIQUE,
  engine_number VARCHAR(80) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_vehicle_driver FOREIGN KEY (driver_id) REFERENCES drivers(id) ON UPDATE CASCADE ON DELETE RESTRICT,
  INDEX idx_vehicle_driver (driver_id), INDEX idx_vehicle_plate (plate_number)
) ENGINE=InnoDB;

CREATE TABLE vehicle_documents (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  vehicle_id BIGINT UNSIGNED NOT NULL,
  document_type ENUM('registration','roadworthiness','permit','insurance','other') NOT NULL,
  reference_number VARCHAR(100) NOT NULL,
  issue_date DATE NULL,
  expiry_date DATE NULL,
  status ENUM('valid','suspended','pending','revoked') NOT NULL DEFAULT 'valid',
  notes VARCHAR(500) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_document_vehicle FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON UPDATE CASCADE ON DELETE RESTRICT,
  INDEX idx_document_vehicle (vehicle_id), INDEX idx_document_expiry (expiry_date)
) ENGINE=InnoDB;

CREATE TABLE revenue_records (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  vehicle_id BIGINT UNSIGNED NOT NULL,
  revenue_type VARCHAR(100) NOT NULL,
  reference_number VARCHAR(100) NULL,
  amount DECIMAL(12,2) NULL,
  payment_date DATE NULL,
  expiry_date DATE NULL,
  payment_status ENUM('paid','unpaid','pending','exempt') NOT NULL DEFAULT 'pending',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_revenue_vehicle FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON UPDATE CASCADE ON DELETE RESTRICT,
  INDEX idx_revenue_vehicle (vehicle_id), INDEX idx_revenue_status (payment_status)
) ENGINE=InnoDB;

CREATE TABLE qr_codes (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  driver_id BIGINT UNSIGNED NOT NULL,
  vehicle_id BIGINT UNSIGNED NOT NULL,
  token CHAR(64) NOT NULL UNIQUE,
  image_path VARCHAR(255) NULL,
  status ENUM('active','revoked') NOT NULL DEFAULT 'active',
  generated_by BIGINT UNSIGNED NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_qr_driver FOREIGN KEY (driver_id) REFERENCES drivers(id) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_qr_vehicle FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_qr_user FOREIGN KEY (generated_by) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET NULL,
  INDEX idx_qr_vehicle (vehicle_id)
) ENGINE=InnoDB;

CREATE TABLE verification_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  qr_id BIGINT UNSIGNED NULL,
  user_id BIGINT UNSIGNED NULL,
  result ENUM('valid','expired','attention_required','invalid','inactive') NOT NULL,
  summary VARCHAR(255) NOT NULL,
  verified_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_log_qr FOREIGN KEY (qr_id) REFERENCES qr_codes(id) ON UPDATE CASCADE ON DELETE SET NULL,
  CONSTRAINT fk_log_user FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET NULL,
  INDEX idx_log_user_date (user_id, verified_at), INDEX idx_log_date (verified_at)
) ENGINE=InnoDB;
