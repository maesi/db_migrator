CREATE TABLE IF NOT EXISTS _migration (
	id int(4) unsigned NOT NULL AUTO_INCREMENT,
	version varchar(10) NOT NULL,
	name varchar(255) DEFAULT NULL,
	checksum varchar(40) NOT NULL,	
	PRIMARY KEY(id),
	UNIQUE KEY(version)
);
