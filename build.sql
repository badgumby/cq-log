CREATE DATABASE cqlogs;

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
