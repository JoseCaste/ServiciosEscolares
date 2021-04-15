<?php
require_once("../model/Employee.php");
class Connection
{
    public  $db;

    public function __construct()
    {
        $db = Connect_to_database::conexion();
        $this->db = $db;
        if ($db == null) {
            echo 'no conectada </br>';
        } else {
            echo 'conectado </br>';
        }
    }
    public function getdb()
    {
        return $this->db;
    }
    public function getAdmin($username, $password)
    {
        
        $query = mysqli_query($this->db, "SELECT * FROM user_administrator WHERE username='$username' and password='$password'");

        $row = $query->fetch_array();
        if ($query != null && $row['username'] == $username && $row['password'] == $password) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllEmployee()
    {
        $employee_array = array();
        $query = mysqli_query($this->db, "SELECT * FROM employee");


        while ($row = $query->fetch_array()) {
            $aux = $row;
            $employee= new Employee();
            $employee->setId($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
            $employee->setMail($row[3]);
            $employee->setTarjetNumber($row[4]);
            array_push($employee_array,$employee);
        }
        return $employee_array;
    }
    public function addEmployee($name,$lastName,$mail,$tarjet_number){
        $query="INSERT INTO employee(name,lastname,mail,tarjet_number) VALUES(
            '$name','$lastName','$mail','$tarjet_number')";
        if(mysqli_query($this->db,$query)){
            return true;
        }else{
            return false;
        }

    }
    public function verifyTarjetNumber($tarjet_number){


        $query= mysqli_query($this->db,"SELECT * FROM employee where tarjet_number like '$tarjet_number'",MYSQLI_STORE_RESULT);
        if(mysqli_num_rows($query)>0){
            return false;
        }else{
            return true;
        }
    }
}
class Connect_to_database
{
    public static function conexion()
    {
        $conexion = new mysqli("localhost", "php", "password", "control_escolar", "3306");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
