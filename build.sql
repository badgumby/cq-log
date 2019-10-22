/*  */
CREATE DATABASE cqlogs;

/* Create 'users' table */
CREATE TABLE 'users' (
  'id' int(10) unsigned NOT NULL AUTO_INCREMENT,
  'username' varchar(255) DEFAULT NULL,
  'pswd' varchar(255) DEFAULT NULL,
  PRIMARY KEY ('id'),
  UNIQUE KEY 'username' ('username')
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Create a new user */
INSERT INTO 'users' ('username', 'pswd') VALUES ('badgumby', SHA1('password'));

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
ALTER TABLE logs AUTO_INCREMENT = 10;
*/
