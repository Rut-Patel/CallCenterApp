	--Name: Rut Patel
--Date: 22-10-2020
--Course Code: WEBD3201 - 02

DROP SEQUENCE IF EXISTS clients_id_seq CASCADE;
CREATE SEQUENCE clients_id_seq START 1000;

DROP TABLE IF EXISTS clients;
CREATE TABLE clients(
	Id INT PRIMARY KEY DEFAULT nextval('clients_id_seq'),
	EmailAddress VARCHAR(255) UNIQUE,
	FirstName VARCHAR(128) NOT NULL,
	LastName VARCHAR(128) NOT NULL,
	Phone VARCHAR(10) NOT NULL,
	logo_path VARCHAR(255) NOT NULL
);

INSERT INTO clients(EmailAddress,FirstName,LastName,Phone,logo_path) VALUES ('client@dcmail.ca','clientFirst','clientLast','9009009999','file_uploaded/new_file.png');

SELECT * From clients; 