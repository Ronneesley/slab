-- MySQL Script generated by MySQL Workbench
-- Tue Sep 19 20:20:09 2023
-- Model: Der Quiz Estatístico    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema slab
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema slab
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `slab` DEFAULT CHARACTER SET utf8 ;
USE `slab` ;

-- -----------------------------------------------------
-- Table `slab`.`niveis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`niveis` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL COMMENT 'Representa o nível de dificuldade que vai ter na pergunta',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`cursos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`temas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`temas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`questoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`questoes` (
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
    REFERENCES `slab`.`niveis` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pergunta_curso1`
    FOREIGN KEY (`curso`)
    REFERENCES `slab`.`cursos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questoes_temas1`
    FOREIGN KEY (`tema`)
    REFERENCES `slab`.`temas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `login` VARCHAR(20) NOT NULL,
  `curso` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuarios_cursos1_idx` (`curso` ASC) VISIBLE,
  CONSTRAINT `fk_usuarios_cursos1`
    FOREIGN KEY (`curso`)
    REFERENCES `slab`.`cursos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`quizzes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`quizzes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`ranks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`ranks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pontuacao` INT NOT NULL,
  `acerto` INT NOT NULL,
  `erro` INT NOT NULL,
  `usuario` INT NOT NULL,
  `quiz` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ranks_usuarios1_idx` (`usuario` ASC) VISIBLE,
  INDEX `fk_ranks_quizzes1_idx` (`quiz` ASC) VISIBLE,
  CONSTRAINT `fk_ranks_usuarios1`
    FOREIGN KEY (`usuario`)
    REFERENCES `slab`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ranks_quizzes1`
    FOREIGN KEY (`quiz`)
    REFERENCES `slab`.`quizzes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`questoes_quiz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`questoes_quiz` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `questao` INT NOT NULL,
  `quiz` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_quiz_questao1_idx` (`questao` ASC) VISIBLE,
  INDEX `fk_quiz_nomequiz1_idx` (`quiz` ASC) VISIBLE,
  CONSTRAINT `fk_quiz_questao1`
    FOREIGN KEY (`questao`)
    REFERENCES `slab`.`questoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quiz_nomequiz1`
    FOREIGN KEY (`quiz`)
    REFERENCES `slab`.`quizzes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`administradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`administradores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `login` VARCHAR(20) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `slab`.`imagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slab`.`imagens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `arquivo` BLOB NOT NULL,
  `identificador` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
