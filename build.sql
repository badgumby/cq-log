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
INSERT INTO users (username, pswd) VALUES ('badgumby', SHA1('password'));
INSERT INTO users (username, pswd) VALUES ('user2', SHA1('mypass'));

/* Create a table for each user */
CREATE TABLE badgumby (
  callsign TEXT,
  sequence int(11),
  band TEXT NULL,
  date datetime,
  frequency TEXT NULL,
  location TEXT,
  notes TEXT NULL,
  ident int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (ident)
);

/*
CREATE TABLE logs (
  callsign TEXT,
  sequence int(11),
  band TEXT NULL,
  date datetime,
  frequency TEXT NULL,
  location TEXT,
  notes TEXT NULL,
  ident int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (ident)
);

/* Reset AUTO_INCREMENT on table
ALTER TABLE badgumby AUTO_INCREMENT = 3;
*/
