-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema survey
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema survey
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `survey` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `survey` ;

-- -----------------------------------------------------
-- Table `survey`.`question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `survey`.`question` (
  `intQuestionID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `strQuestion` VARCHAR(100) NOT NULL COMMENT '',
  PRIMARY KEY (`intQuestionID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `survey`.`survey`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `survey`.`survey` (
  `intSurveyID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `strName` VARCHAR(45) NOT NULL COMMENT '',
  `strMajor` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`intSurveyID`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `survey`.`answer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `survey`.`answer` (
  `intAnswerID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `intQuestionID` INT NULL COMMENT '',
  `strAnswer` VARCHAR(100) NULL COMMENT '',
  `intSurveyID` INT NULL COMMENT '',
  PRIMARY KEY (`intAnswerID`)  COMMENT '',
  INDEX `fk_intQuestionID_idx` (`intQuestionID` ASC)  COMMENT '',
  INDEX `fk_intSurveyID_idx` (`intSurveyID` ASC)  COMMENT '',
  CONSTRAINT `fk_intQuestionID`
    FOREIGN KEY (`intQuestionID`)
    REFERENCES `survey`.`question` (`intQuestionID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_intSurveyID`
    FOREIGN KEY (`intSurveyID`)
    REFERENCES `survey`.`survey` (`intSurveyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO question (strQuestion) VALUES
("How many hours a day do you spend on the computer?"),
("What activity do you prefer to engage in on a computer?"),
("What is your preferred social media website?"),
("Any additional feedback for the survey?");

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
