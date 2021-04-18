#step 0
create database control_escolar;
#step 0.1
use control_escolar;


#step 1
create table user_administrator (id mediumint auto_increment, username text,password varchar(10), name text, lastname text,
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
create table IO_employee (id_IO mediumint auto_increment, employee_id mediumint, in_job time,out_eat time, out_job time,
primary key(id_IO), foreign key(employee_id)references employee(id_employee));
select * from IO_employee;

select io_.id_IO,e.tarjet_number,e.id_employee,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.out_job from IO_employee io_ cross join employee e where e.id_employee = io_.employee_id;


INSERT INTO IO_employee (employee_id , in_job) values('00002','13:59:59');
alter table IO_employee add _date date;
update IO_employee set out_job='20:51:00' where id_IO=9;
