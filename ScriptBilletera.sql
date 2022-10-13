-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema billetera
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema billetera
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `billetera` DEFAULT CHARACTER SET utf8 ;
USE `billetera` ;

-- -----------------------------------------------------
-- Table `billetera`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `billetera`.`clientes` (
  `dniCliente` INT UNSIGNED NOT NULL,
  `nombreCliente` VARCHAR(45) NOT NULL,
  `claveCliente` VARCHAR(255) NOT NULL,
  `saldoCliente` DECIMAL(10,2) UNSIGNED NOT NULL,
  PRIMARY KEY (`dniCliente`),
  UNIQUE INDEX `claveCliente_UNIQUE` (`claveCliente` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `billetera`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `billetera`.`empresas` (
  `cuitEmpresa` INT NOT NULL,
  `nombreEmpresa` VARCHAR(45) NOT NULL,
  `domicilioEmpresa` VARCHAR(45) NOT NULL,
  `saldoEmpresa` DECIMAL(10,2) NOT NULL,
  `claveEmpresa` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`cuitEmpresa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `billetera`.`transacciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `billetera`.`transacciones` (
  `idTransaccion` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaTransaccion` DATETIME NOT NULL,
  `montoTransaccion` DECIMAL(10,2) UNSIGNED NOT NULL,
  `clientes_idCliente` INT UNSIGNED NOT NULL,
  `empresas_idEmpresa` INT NOT NULL,
  PRIMARY KEY (`idTransaccion`, `clientes_idCliente`, `empresas_idEmpresa`),
  INDEX `fk_transacciones_clientes_idx` (`clientes_idCliente` ASC) VISIBLE,
  INDEX `fk_transacciones_empresas1_idx` (`empresas_idEmpresa` ASC) VISIBLE,
  CONSTRAINT `fk_transacciones_clientes`
    FOREIGN KEY (`clientes_idCliente`)
    REFERENCES `billetera`.`clientes` (`dniCliente`),
  CONSTRAINT `fk_transacciones_empresas1`
    FOREIGN KEY (`empresas_idEmpresa`)
    REFERENCES `billetera`.`empresas` (`cuitEmpresa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
