-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gallery
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gallery
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gallery` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `gallery` ;

-- -----------------------------------------------------
-- Table `gallery`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gallery`.`users` (
  `intUserID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `strUserID` VARCHAR(45) NOT NULL COMMENT '',
  `strPassword` VARCHAR(45) NOT NULL COMMENT '',
  `dtmCreatedOn` DATETIME NOT NULL COMMENT '',
  `strCreatedBy` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`intUserID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gallery`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gallery`.`images` (
  `intImageID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `intUserID` INT NOT NULL COMMENT '',
  `dtmCreatedOn` DATETIME NOT NULL COMMENT '',
  `strCreatedBy` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`intImageID`)  COMMENT '',
  INDEX `fk_intUserID_idx` (`intUserID` ASC)  COMMENT '',
  CONSTRAINT `fk_intUserID`
    FOREIGN KEY (`intUserID`)
    REFERENCES `gallery`.`users` (`intUserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gallery`.`likedphotos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gallery`.`likedphotos` (
  `intImageID` INT NOT NULL COMMENT '',
  `intUserID` INT NOT NULL COMMENT '',
  `dtmLikedOn` DATETIME NULL COMMENT '',
  INDEX `fk_intImageID_likedphotos_idx` (`intImageID` ASC)  COMMENT '',
  INDEX `fk_intUserID_likedphotos_idx` (`intUserID` ASC)  COMMENT '',
  CONSTRAINT `fk_intImageID_likedphotos`
    FOREIGN KEY (`intImageID`)
    REFERENCES `gallery`.`images` (`intImageID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_intUserID_likedphotos`
    FOREIGN KEY (`intUserID`)
    REFERENCES `gallery`.`users` (`intUserID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
