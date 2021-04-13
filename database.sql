#step 0
create database asistent;
#step 0.1
use asistent;

#step 1
create table user_administrator (id mediumint auto_increment, name text, lastname text, password varchar(10), tarjet_number varchar(10),
primary key(id));

#step 2

create table employee (id_employee mediumint auto_increment, name text, lastname text, mail text, tarjet_number varchar(10),
primary key(id_employee));

#step 3

CREATE USER 'php2'@'localhost' IDENTIFIED 	WITH mysql_native_password BY 'password';
#step 3.1
GRANT ALL PRIVILEGES ON *.* TO 'php2'@'localhost';

#step 4
insert into user_administrator (name,lastname, password,tarjet_number) values('jose','castellanos','12345','555555');

#step 5
insert into employee(name, lastname, mail, tarjet_number)values('Olegario','castellanos','abc@gmail.com','00002'),
('Gary','castellanos','abc@gmail.com','00003'),
('Jose','castellanos','abc@gmail.com','00004'),
('Juan','castellanos','abc@gmail.com','00005'),
('UNISTMO','IXTEPEC','abc@gmail.com','00006');