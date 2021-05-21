
--Name: Rut Patel
--Date: 16-09-2020
--Course Code: WEBD3201 - 02


CREATE EXTENSION IF NOT EXISTS pgcrypto;

DROP SEQUENCE IF EXISTS users_id_seq CASCADE;
CREATE SEQUENCE users_id_seq START 1000;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
	Id INT PRIMARY KEY DEFAULT nextval('users_id_seq'),
	EmailAddress VARCHAR(255) UNIQUE,
	Password VARCHAR(255) NOT NULL,
	FirstName VARCHAR(128),
	LastName VARCHAR(128),
	LastAccess TIMESTAMP,
	EnrolDate TIMESTAMP,
	Enable BOOLEAN,
	Type VARCHAR(2)
);

INSERT INTO users(EmailAddress, Password, FirstName, LastName, LastAccess, EnrolDate, Enable, Type)
VALUES('jdoe@dcmail.ca',crypt('some_password', gen_salt('bf')), 'John', 'Doe', '2020-06-22 19:10:25', '2020-08-22 11:11:11', false, 's');

INSERT INTO users(EmailAddress, Password, FirstName, LastName, LastAccess, EnrolDate, Enable, Type)
VALUES('smacdonald@dcmail.ca',crypt('testpass', gen_salt('bf')), 'Sara', 'Macdonald', '2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 's');

INSERT INTO users(EmailAddress, Password, FirstName, LastName, LastAccess, EnrolDate, Enable, Type)
VALUES('jsmith@dcmail.ca',crypt('testpass', gen_salt('bf')), 'John', 'Smith', '2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 's');

INSERT INTO users(EmailAddress, Password, FirstName, LastName, LastAccess, EnrolDate, Enable, Type)
VALUES('rut@dcmail.ca',crypt('testpass', gen_salt('bf')), 'Rut', 'Patel', '2020-06-22 19:10:25', '2020-08-22 11:11:11', true, 'a');

SELECT * FROM users;