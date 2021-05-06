#step 0
create database control_escolar;
#step 0.1
use control_escolar;


#step 1
create table user_administrator (id mediumint auto_increment, username text,password varchar(200), name text, lastname text,
primary key(id));

#step 2

create table employee (id_employee mediumint auto_increment, name text, lastname text, mail text, tarjet_number varchar(10),
primary key(id_employee));

#step 3

CREATE USER 'php'@'localhost' IDENTIFIED 	WITH mysql_native_password BY 'password';
#step 3.1
GRANT ALL PRIVILEGES ON *.* TO 'php'@'localhost';

#step 4
insert into user_administrator (username,password,name,lastname) values('jj',md5('12345'),'jose','castellanos');
#step 5
insert into employee(name, lastname, mail, tarjet_number)values('Olegario','castellanos','abc@gmail.com','00002'),
('Gary','castellanos','abc@gmail.com','00003'),
('Jose','castellanos','abc@gmail.com','00004'),
('Juan','castellanos','abc@gmail.com','00005'),
('UNISTMO','IXTEPEC','abc@gmail.com','00006');

select * from employee;

select MD5(password) from user_administrator;


select *,md5('12345') from user_administrator;
select * from user_administrator;

/**creating a new table IO_employee*/

create table IO_employee (id_IO mediumint auto_increment, employee_id mediumint, in_job time,out_eat time,back_eat time, out_job time,_date date,
primary key(id_IO), foreign key(employee_id)references employee(id_employee));

/*creating a restriction_food*/
create table restriction_food(tarjet_number varchar(10), name text, lastname text, _date date, restriction boolean);
ALTER TABLE restriction_food ADD PRIMARY KEY(tarjet_number, _date);
select * from IO_employee where out_job is not null;
alter table IO_employee add column comments text;
SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_._date, io_.comments FROM IO_employee io_ CROSS JOIN employee e WHERE e.tarjet_number = '00005';
SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_._date, io_.comments FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id and io_.out_job is null and io_._date!=curdate();
SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_._date, io_.comments FROM IO_employee io_ CROSS JOIN employee e WHERE e.tarjet_number = '00008' and io_.out_job is null;
update io_employee set out_job= null, comments=null where  employee_id=8 and _date='2021-04-19';
SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_._date, io_.comments FROM IO_employee io_ CROSS JOIN employee e WHERE e.tarjet_number = '00006' and io_.out_job is null and io_._date!=curdate();
SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id;