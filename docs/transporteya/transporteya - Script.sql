-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema transporteya
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `transporteya` ;

-- -----------------------------------------------------
-- Schema transporteya
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `transporteya` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema transporteya
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `transporteya` ;

-- -----------------------------------------------------
-- Schema transporteya
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `transporteya` DEFAULT CHARACTER SET latin1 ;
USE `transporteya` ;

-- -----------------------------------------------------
-- Table `transporteya`.`region`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transporteya`.`region` ;

CREATE TABLE IF NOT EXISTS `transporteya`.`region` (
  `id` INT(12) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(60) NOT NULL,
  `romano` VARCHAR(5) NOT NULL,
  `num_provincias` INT(11) NOT NULL,
  `num_comunas` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `transporteya`.`provincia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transporteya`.`provincia` ;

CREATE TABLE IF NOT EXISTS `transporteya`.`provincia` (
  `id` INT(12) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `num_comunas` INT(11) NOT NULL,
  `region_id` INT(12) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_provincia_region_idx` (`region_id` ASC),
  CONSTRAINT `fk_provincia_region`
    FOREIGN KEY (`region_id`)
    REFERENCES `transporteya`.`region` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `transporteya` ;

-- -----------------------------------------------------
-- Table `transporteya`.`comuna`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transporteya`.`comuna` ;

CREATE TABLE IF NOT EXISTS `transporteya`.`comuna` (
  `id` INT(12) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) NOT NULL,
  `provincia_id` INT(12) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comuna_provincia_idx` (`provincia_id` ASC),
  CONSTRAINT `fk_comuna_provincia`
    FOREIGN KEY (`provincia_id`)
    REFERENCES `transporteya`.`provincia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `transporteya`.`cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transporteya`.`cliente` ;

CREATE TABLE IF NOT EXISTS `transporteya`.`cliente` (
  `id` INT(12) NOT NULL AUTO_INCREMENT,
  `rut` INT(12) NOT NULL,
  `rut_add` INT(4) NOT NULL,
  `nombre` VARCHAR(120) NOT NULL,
  `apellidop` VARCHAR(50) NOT NULL,
  `apellidom` VARCHAR(50) NOT NULL,
  `direccion` VARCHAR(250) NOT NULL,
  `fono` VARCHAR(20) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `reglas_condiciones` TINYINT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `comuna_id` INT(12) NOT NULL,
  `activo` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_cliente_comuna1_idx` (`comuna_id` ASC),
  CONSTRAINT `fk_cliente_comuna1`
    FOREIGN KEY (`comuna_id`)
    REFERENCES `transporteya`.`comuna` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'Clientes contratantes';


-- -----------------------------------------------------
-- Table `transporteya`.`pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transporteya`.`pedido` ;

CREATE TABLE IF NOT EXISTS `transporteya`.`pedido` (
  `id` INT(12) NOT NULL AUTO_INCREMENT,
  `origen` VARCHAR(150) NOT NULL,
  `destino` VARCHAR(150) NOT NULL,
  `tiempo` DATE NOT NULL,
  `fecha` DATE NOT NULL,
  `comentarios` TEXT NULL,
  `status` TINYINT NULL,
  `coords_origen` VARCHAR(150) NULL,
  `coords_destino` VARCHAR(150) NULL,
  `cliente_id` INT(12) NOT NULL,
  `comuna_origen_id` INT(12) NOT NULL,
  `comuna_destino_id` INT(12) NOT NULL,
  INDEX `fk_pedido_cliente1_idx` (`cliente_id` ASC),
  PRIMARY KEY (`id`),
  INDEX `fk_pedido_comuna1_idx` (`comuna_origen_id` ASC),
  INDEX `fk_pedido_comuna2_idx` (`comuna_destino_id` ASC),
  CONSTRAINT `fk_pedido_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `transporteya`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_comuna1`
    FOREIGN KEY (`comuna_origen_id`)
    REFERENCES `transporteya`.`comuna` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_comuna2`
    FOREIGN KEY (`comuna_destino_id`)
    REFERENCES `transporteya`.`comuna` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = 'Pedidos';


-- -----------------------------------------------------
-- Table `transporteya`.`oferta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transporteya`.`oferta` ;

CREATE TABLE IF NOT EXISTS `transporteya`.`oferta` (
  `id` INT(12) NOT NULL AUTO_INCREMENT,
  `oferta_serv` FLOAT(20,2) NOT NULL,
  `comentarios` VARCHAR(250) NOT NULL,
  `aprobada` TINYINT NULL,
  `empresas_id` INT(12) NOT NULL,
  `pedido_id` INT(11) NOT NULL,
  `cliente_id` INT(12) NOT NULL,
  `coordenadas_actuales` VARCHAR(150) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ofertas_pedido1_idx` (`pedido_id` ASC),
  INDEX `fk_ofertas_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_ofertas_pedido1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `transporteya`.`pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ofertas_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `transporteya`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
