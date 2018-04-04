-- Schema cineboard_db
-- CREATE SCHEMA IF NOT EXISTS `cineboard_db` DEFAULT CHARACTER SET utf8 ;
-- USE `cineboard_db` ;


-- Table `user`
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `deleted_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name_unique`(`name`))
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;


-- Table `category`
DROP TABLE IF EXISTS `category` ;

CREATE TABLE IF NOT EXISTS `category` (
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `deleted_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;
CREATE INDEX ix_name ON category (name) ;


-- Table `library`
DROP TABLE IF EXISTS `library` ;

CREATE TABLE IF NOT EXISTS `library` (
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) unsigned NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `director` VARCHAR(50) DEFAULT NULL,
  `rating` INT(10) unsigned NULL,
  `viewed` TINYINT(1) NULL,
  `url` VARCHAR(300) DEFAULT NULL,
  `tags` TEXT NULL,
  `notes` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_id_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;
CREATE INDEX ix_title ON library (title) ;
CREATE INDEX ix_director ON library (director) ;


-- Table `library_category`
DROP TABLE IF EXISTS `library_category` ;

CREATE TABLE IF NOT EXISTS `library_category` (
  `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
  `library_id` INT(11) unsigned NOT NULL,
  `category_id` INT(11) unsigned NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `deleted_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_library_category_1_idx` (`library_id` ASC),
  INDEX `fk_library_category_2_idx` (`category_id` ASC),
  CONSTRAINT `fk_library_category_1`
    FOREIGN KEY (`library_id`)
    REFERENCES `library` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_library_category_2`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;
