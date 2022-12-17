CREATE DATABASE budget_calculator;

USE budget_calculator;

CREATE TABLE purchase (
                         id INT NOT NULL AUTO_INCREMENT,
                         description VARCHAR(128) NOT NULL,
                         price INT NOT NULL DEFAULT 0,
                         buyer SMALLINT NOT NULL DEFAULT 0,
                         owner SMALLINT NOT NULL DEFAULT 0,
                         date_create TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (id)
);