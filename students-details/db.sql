Create database project1;

use project1;

CREATE TABLE student(
	roll int(5) PRIMARY KEY auto_increment,
	name varchar(30) NOT null,
	dob date,
	mobile bigint(10) NOT NULL unique
);

INSERT INTO student(roll, name, dob, mobile) VALUES($roll, '$name','$dob','$mobile');