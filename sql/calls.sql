--Name: Rut Patel
--Date: 22-10-2020
--Course Code: WEBD3201 - 02

DROP SEQUENCE IF EXISTS calls_id_seq CASCADE;
CREATE SEQUENCE calls_id_seq START 3000;

DROP TABLE IF EXISTS calls;
CREATE TABLE calls(
	Id INT PRIMARY KEY DEFAULT nextval('calls_id_seq'),
	ClientName VARCHAR(255)  NOT NULL,
	Reg_Date Date NOT NULL
);

INSERT INTO calls(ClientName,Reg_Date) VALUES ('Rut','2020/10/10');

SELECT * From calls; 