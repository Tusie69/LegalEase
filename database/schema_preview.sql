-- LegalEase MySQL schema preview (unified model)
-- Goal: avoid redundant parallel booking_* tables

CREATE DATABASE IF NOT EXISTS `legalease` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `legalease`;

SET NAMES utf8mb4;
SET time_zone = '+07:00';

CREATE TABLE `roles` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_roles_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` BIGINT UNSIGNED NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL,
  `password` VARCHAR(255) NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'ACTIVE',
  `phone` VARCHAR(30) NULL,
  `avatar_url` VARCHAR(255) NULL,
  `last_login_at` DATETIME NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_email` (`email`),
  KEY `idx_users_role_status` (`role_id`, `status`),
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `lawyer_profiles` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `bar_association_name` VARCHAR(255) NULL,
  `bar_card_number` VARCHAR(100) NULL,
  `years_of_experience` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `consultation_fee` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `rating` DECIMAL(3,2) NOT NULL DEFAULT 5.00,
  `expertise` TEXT NULL,
  `bio` TEXT NULL,
  `verification_status` VARCHAR(20) NOT NULL DEFAULT 'UNVERIFIED',
  `cancellation_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `no_show_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `violation_count` INT UNSIGNED NOT NULL DEFAULT 0,
  `last_violation_at` DATETIME NULL,
  `is_search_visible` TINYINT(1) NOT NULL DEFAULT 1,
  `locked_at` DATETIME NULL,
  `locked_by_admin_id` BIGINT UNSIGNED NULL,
  `lock_reason` TEXT NULL,
  `verified_at` DATETIME NULL,
  `verified_by_admin_id` BIGINT UNSIGNED NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_lawyer_profiles_user_id` (`user_id`),
  KEY `idx_lawyer_profile_verif` (`verification_status`, `verified_at`),
  KEY `idx_lawyer_profile_search` (`is_search_visible`, `verification_status`),
  KEY `idx_lawyer_profile_risk` (`violation_count`, `no_show_count`),
  CONSTRAINT `fk_lawyer_profiles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_lawyer_profiles_locked_by` FOREIGN KEY (`locked_by_admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_lawyer_profiles_verified_by` FOREIGN KEY (`verified_by_admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `customer_profiles` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `date_of_birth` DATE NULL,
  `gender` VARCHAR(20) NULL,
  `address` TEXT NULL,
  `identity_number` VARCHAR(100) NULL,
  `identity_status` VARCHAR(20) NOT NULL DEFAULT 'UNVERIFIED',
  `identity_verified_at` DATETIME NULL,
  `identity_verified_by_admin_id` BIGINT UNSIGNED NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_customer_profiles_user_id` (`user_id`),
  KEY `idx_cust_profile_identity` (`identity_status`, `identity_verified_at`),
  CONSTRAINT `fk_customer_profiles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_customer_profiles_verified_by` FOREIGN KEY (`identity_verified_by_admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `slots` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lawyer_id` BIGINT UNSIGNED NOT NULL,
  `start_time` DATETIME NOT NULL,
  `end_time` DATETIME NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'OPEN',
  `locked_by_user_id` BIGINT UNSIGNED NULL,
  `locked_at` DATETIME NULL,
  `lock_expires_at` DATETIME NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_slots_lawyer_start` (`lawyer_id`, `start_time`),
  KEY `idx_slots_lawyer_start` (`lawyer_id`, `start_time`),
  KEY `idx_slots_status_start` (`status`, `start_time`),
  KEY `idx_slots_lock_exp_booked` (`lock_expires_at`, `status`),
  CONSTRAINT `fk_slots_lawyer` FOREIGN KEY (`lawyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_slots_locked_by` FOREIGN KEY (`locked_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `appointments` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `booking_code` VARCHAR(50) NOT NULL,
  `lawyer_id` BIGINT UNSIGNED NOT NULL,
  `customer_id` BIGINT UNSIGNED NOT NULL,
  `slot_id` BIGINT UNSIGNED NULL,
  `status` VARCHAR(30) NOT NULL DEFAULT 'PENDING',
  `consultation_topic` VARCHAR(255) NULL,
  `consultation_summary` TEXT NULL,
  `scheduled_start_at` DATETIME NOT NULL,
  `scheduled_end_at` DATETIME NULL,
  `timezone` VARCHAR(50) NOT NULL DEFAULT 'Asia/Ho_Chi_Minh',
  `price_amount` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `deposit_amount` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `final_amount` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `customer_note` TEXT NULL,
  `paid_at` DATETIME NULL,
  `outcome_reported_at` DATETIME NULL,
  `completed_at` DATETIME NULL,
  `cancelled_at` DATETIME NULL,
  `cancelled_by_user_id` BIGINT UNSIGNED NULL,
  `cancellation_reason` TEXT NULL,
  `refund_amount` DECIMAL(12,2) NULL,
  `refund_status` VARCHAR(30) NULL,
  `admin_note` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_appointments_booking_code` (`booking_code`),
  UNIQUE KEY `uq_appointments_slot_id` (`slot_id`),
  KEY `idx_appointments_status_start` (`status`, `scheduled_start_at`),
  KEY `idx_appointments_lawyer_start` (`lawyer_id`, `scheduled_start_at`),
  KEY `idx_appointments_customer_start` (`customer_id`, `scheduled_start_at`),
  KEY `idx_appointments_outcome` (`outcome_reported_at`),
  KEY `idx_appt_status_paid_at` (`status`, `paid_at`),
  CONSTRAINT `fk_appointments_lawyer` FOREIGN KEY (`lawyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_appointments_customer` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_appointments_slot` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_appointments_cancelled_by` FOREIGN KEY (`cancelled_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `payments` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointment_id` BIGINT UNSIGNED NOT NULL,
  `submitted_by_user_id` BIGINT UNSIGNED NULL,
  `reviewed_by_user_id` BIGINT UNSIGNED NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `payment_type` VARCHAR(20) NOT NULL,
  `payment_method` VARCHAR(50) NULL,
  `bank_name` VARCHAR(120) NULL,
  `transfer_reference` VARCHAR(120) NULL,
  `customer_note` TEXT NULL,
  `admin_note` TEXT NULL,
  `status` VARCHAR(30) NOT NULL DEFAULT 'PENDING',
  `transaction_id` VARCHAR(120) NULL,
  `submitted_at` DATETIME NULL,
  `reviewed_at` DATETIME NULL,
  `paid_at` DATETIME NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_payments_transaction_id` (`transaction_id`),
  KEY `idx_payments_appt_type` (`appointment_id`, `payment_type`),
  KEY `idx_payments_status_time` (`status`, `created_at`),
  CONSTRAINT `fk_payments_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ratings` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointment_id` BIGINT UNSIGNED NOT NULL,
  `stars` TINYINT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NULL,
  `review_text` TEXT NULL,
  `is_public` TINYINT(1) NOT NULL DEFAULT 1,
  `reviewed_at` DATETIME NULL,
  `is_reported` TINYINT(1) NOT NULL DEFAULT 0,
  `is_removed` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_ratings_appointment` (`appointment_id`),
  KEY `idx_ratings_removed_created` (`is_removed`, `created_at`),
  CONSTRAINT `fk_ratings_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chk_ratings_stars_range` CHECK (`stars` BETWEEN 1 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `news` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `image_url` VARCHAR(255) NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'PUBLISHED',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `idx_news_status_created` (`status`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `faqs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(255) NOT NULL,
  `answer` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `notifications` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `idx_notifications_user_read` (`user_id`, `is_read`, `created_at`),
  CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (`code`, `name`, `description`, `created_at`, `updated_at`) VALUES
('ADMIN', 'Administrator', 'Platform administrator with full moderation privileges.', NOW(), NOW()),
('LAWYER', 'Lawyer', 'Legal expert account for consultations.', NOW(), NOW()),
('CUSTOMER', 'Customer', 'Client account booking consultations.', NOW(), NOW());
