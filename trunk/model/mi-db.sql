SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `MI-DB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `MI-DB` ;

-- -----------------------------------------------------
-- Table `MI-DB`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MI-DB`.`usuario` ;

CREATE  TABLE IF NOT EXISTS `MI-DB`.`usuario` (
  `idUsuario` INT(5) NOT NULL ,
  `nome` VARCHAR(200) NOT NULL ,
  `titulo` VARCHAR(50) NOT NULL ,
  `cargo` VARCHAR(50) NOT NULL ,
  `permissaoSistema` VARCHAR(30) NULL ,
  `emailInstitucional` VARCHAR(50) NULL ,
  `senha` VARCHAR(50) NULL ,
  PRIMARY KEY (`idUsuario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MI-DB`.`unidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MI-DB`.`unidade` ;

CREATE  TABLE IF NOT EXISTS `MI-DB`.`unidade` (
  `idUnidade` INT(2) NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`idUnidade`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MI-DB`.`destinatario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MI-DB`.`destinatario` ;

CREATE  TABLE IF NOT EXISTS `MI-DB`.`destinatario` (
  `idDestinatario` INT(5) NOT NULL ,
  `nome` VARCHAR(200) NOT NULL ,
  `titulo` VARCHAR(50) NULL ,
  `cargo` VARCHAR(50) NULL ,
  PRIMARY KEY (`idDestinatario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MI-DB`.`memorando`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MI-DB`.`memorando` ;

CREATE  TABLE IF NOT EXISTS `MI-DB`.`memorando` (
  `idMemorando` INT(5) NOT NULL AUTO_INCREMENT ,
  `data` DATE NOT NULL ,
  `remetente` INT(5) NOT NULL ,
  `destinatario` INT(5) NOT NULL ,
  `titulo` VARCHAR(50) NOT NULL ,
  `corpo` LONGTEXT NOT NULL ,
  PRIMARY KEY (`idMemorando`) ,
  INDEX `FK_REMETENTE` (`remetente` ASC) ,
  INDEX `FK_DESTINATARIO` (`destinatario` ASC) ,
  CONSTRAINT `FK_REMETENTE`
    FOREIGN KEY (`remetente` )
    REFERENCES `MI-DB`.`usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_DESTINATARIO`
    FOREIGN KEY (`destinatario` )
    REFERENCES `MI-DB`.`destinatario` (`idDestinatario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MI-DB`.`usuario_has_unidade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MI-DB`.`usuario_has_unidade` ;

CREATE  TABLE IF NOT EXISTS `MI-DB`.`usuario_has_unidade` (
  `idUsuario` INT(5) NOT NULL ,
  `idUnidade` INT(2) NOT NULL ,
  PRIMARY KEY (`idUsuario`, `idUnidade`) ,
  INDEX `fk_usuario_has_unidade_unidade1` (`idUnidade` ASC) ,
  INDEX `fk_usuario_has_unidade_usuario1` (`idUsuario` ASC) ,
  CONSTRAINT `fk_usuario_has_unidade_usuario1`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `MI-DB`.`usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_unidade_unidade1`
    FOREIGN KEY (`idUnidade` )
    REFERENCES `MI-DB`.`unidade` (`idUnidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MI-DB`.`chave`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MI-DB`.`chave` ;

CREATE  TABLE IF NOT EXISTS `MI-DB`.`chave` (
  `idUsuario` INT(5) NOT NULL ,
  `chave` VARCHAR(8) NOT NULL ,
  PRIMARY KEY (`idUsuario`, `chave`) ,
  INDEX `FK_CHAVE` (`idUsuario` ASC) ,
  CONSTRAINT `FK_CHAVE`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `MI-DB`.`usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
