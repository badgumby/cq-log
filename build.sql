/*  */
CREATE DATABASE cqlogs;

/* Create 'users' table */
CREATE TABLE users (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(255) DEFAULT NULL UNIQUE KEY,
  pswd varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
);

/* Create a new user */
INSERT INTO users (username, pswd) VALUES ('username', SHA1('password'));

/* Create a table for each user */
CREATE TABLE username (
  callsign TEXT,
  sequence int(11),
  band TEXT NULL,
  date datetime,
  frequency TEXT NULL,
  state TEXT NULL,
  country TEXT NULL,
  notes TEXT NULL,
  rstr TEXT NULL,
  rsts TEXT NULL,
  ident int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (ident)
);


/* Reset AUTO_INCREMENT on table
ALTER TABLE username AUTO_INCREMENT = 3;
*/
