<?php
require_once("../model/Employee.php");
require_once("../model/EmployeeHistory.php");
class Connection
{
    public  $db;

    public function __construct()
    {
        $db = Connect_to_database::conexion();
        $this->db = $db;
        if ($db == null) {
        } else {
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
            return $row['name']." ".$row['lastname'];
        } else {
            return null;
        }
    }
    public function getSpecificEmployee($tarjet_number)
    {
        
        $query = mysqli_query($this->db, "SELECT * FROM employee WHERE tarjet_number='$tarjet_number'");

        $row = $query->fetch_array();
            return $row['id_employee'] ;
        
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
    public function insertInputOutput($time,$tarjet_number,$whatTime){

        $employee_id= $this->getSpecificEmployee($tarjet_number);
        $query=mysqli_query($this->db,"INSERT INTO IO_employee (employee_id , in_job,_date) values($employee_id,'$time',curdate())");
        if($query){
            return true;
        }else{
            return false;
        }
        

    }
    public function updateInputOutput($time,$tarjet_number,$whatTime){
        $employee_id= $this->getSpecificEmployee($tarjet_number);
        $_query="UPDATE IO_employee SET ".$whatTime."='$time' WHERE employee_id=$employee_id and _date=curdate()";
        $query=mysqli_query($this->db,$_query);
        if($query){
            return true;
        }else{
            return false;
        }
    }
    public function employeesHistory()
    {
        $history_array = array();
        $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.out_job,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id");


        while ($row = $query->fetch_array()) {
            
            $employee= new EmployeeHistory();
            $employee->setTarjetNumber($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
            $employee->setMail($row[3]);
            $employee->setInJob($row[4]);
            
            if($row[5]!=null){
                $employee->setOutEat($row[5]);
            }else{
                $employee->setOutEat("Sin registro");
            }
            if($row[6]!=null){
                $employee->setoutJob($row[6]);
            }else{
                $employee->setOutJob("Sin registro");
            }
            $employee->setDate($row[7]);
            
            
           
            
            array_push($history_array,$employee);
        }
        return $history_array;
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
