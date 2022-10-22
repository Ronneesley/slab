-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema quizestatistico
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema quizestatistico
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quizestatistico` DEFAULT CHARACTER SET utf8 ;
USE `quizestatistico` ;

-- -----------------------------------------------------
-- Table `quizestatistico`.`niveis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`niveis` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nivel` VARCHAR(45) NOT NULL COMMENT 'Representa o nível de dificuldade que vai ter na pergunta',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`cursos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`temas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`temas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tema` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`questoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`questoes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nivel` INT NOT NULL COMMENT 'Representa o nível de dificuldade que vai ter na pergunta',
  `curso` INT NOT NULL,
  `tema` INT NOT NULL,
  `pergunta` TEXT NOT NULL,
  `resposta_certa` TEXT NOT NULL,
  `resposta_errada1` TEXT NOT NULL,
  `resposta_errada2` TEXT NOT NULL,
  `resposta_errada3` TEXT NOT NULL,
  `explicacao` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pergunta_nivel1_idx` (`nivel` ASC) VISIBLE,
  INDEX `fk_pergunta_curso1_idx` (`curso` ASC) VISIBLE,
  INDEX `fk_questoes_temas1_idx` (`tema` ASC) VISIBLE,
  CONSTRAINT `fk_pergunta_nivel1`
    FOREIGN KEY (`nivel`)
    REFERENCES `quizestatistico`.`niveis` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pergunta_curso1`
    FOREIGN KEY (`curso`)
    REFERENCES `quizestatistico`.`cursos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questoes_temas1`
    FOREIGN KEY (`tema`)
    REFERENCES `quizestatistico`.`temas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`ranks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`ranks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `pontuacao` INT NOT NULL,
  `acerto` INT NOT NULL,
  `erro` INT NOT NULL,
  `curso` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_hanking_curso1_idx` (`curso` ASC) VISIBLE,
  CONSTRAINT `fk_hanking_curso1`
    FOREIGN KEY (`curso`)
    REFERENCES `quizestatistico`.`cursos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`quizzes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`quizzes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_quiz` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`perguntas_quiz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`perguntas_quiz` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `questao` INT NOT NULL,
  `quiz` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_quiz_questao1_idx` (`questao` ASC) VISIBLE,
  INDEX `fk_quiz_nomequiz1_idx` (`quiz` ASC) VISIBLE,
  CONSTRAINT `fk_quiz_questao1`
    FOREIGN KEY (`questao`)
    REFERENCES `quizestatistico`.`questoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quiz_nomequiz1`
    FOREIGN KEY (`quiz`)
    REFERENCES `quizestatistico`.`quizzes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`administradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`administradores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quizestatistico`.`imagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizestatistico`.`imagens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `imagem` BLOB NOT NULL,
  `identificador` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
