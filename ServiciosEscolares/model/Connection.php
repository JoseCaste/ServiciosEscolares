<?php
require_once("../model/Employee.php");
require_once("../model/EmployeeHistory.php");
require_once("../model/EmployeeRestrinction.php");
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
            return $row['name'] . " " . $row['lastname'];
        } else {
            return null;
        }
    }
    public function getSpecificEmployee($tarjet_number)
    {

        $query = mysqli_query($this->db, "SELECT * FROM employee WHERE tarjet_number='$tarjet_number'");

        $row = $query->fetch_array();
        return $row['id_employee'];
    }
    public function getAllEmployee()
    {
        $employee_array = array();
        $query = mysqli_query($this->db, "SELECT * FROM employee");


        while ($row = $query->fetch_array()) {
            $aux = $row;
            $employee = new Employee();
            $employee->setId($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
            $employee->setMail($row[3]);
            $employee->setTarjetNumber($row[4]);
            array_push($employee_array, $employee);
        }
        return $employee_array;
    }
    public function addEmployee($name, $lastName, $mail, $tarjet_number)
    {
        $query = "INSERT INTO employee(name,lastname,mail,tarjet_number) VALUES(
            '$name','$lastName','$mail','$tarjet_number')";
        if (mysqli_query($this->db, $query)) {
            return true;
        } else {
            return false;
        }
    }
    public function verifyTarjetNumber($tarjet_number)
    {


        $query = mysqli_query($this->db, "SELECT * FROM employee where tarjet_number like '$tarjet_number'", MYSQLI_STORE_RESULT);
        if (mysqli_num_rows($query) > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function setIOEmployee($tarjet_number, $date_time)
    {
        $employee_id = $this->getSpecificEmployee($tarjet_number);
        $query = mysqli_query($this->db, "SELECT * FROM IO_employee WHERE employee_id= ${employee_id} and _date=curdate()");
        if ($row = $query->fetch_array()) {

            if ($row['in_job'] != null) {
                if ($row['out_eat'] != null) {
                    if ($row['back_eat'] != null) {
                        $query = mysqli_query($this->db, "UPDATE IO_employee SET out_job='$date_time' where employee_id=${employee_id} and _date=curdate()");
                        if ($query) return "Salida del trabajo registrada";
                        else return null;
                    } else {
                        $query = mysqli_query($this->db, "UPDATE IO_employee SET back_eat='$date_time' where employee_id=${employee_id} and _date=curdate()");
                        if ($query) return "Regreso de comer registrada";
                        else return null;
                    }
                } else {
                    $query = mysqli_query($this->db, "UPDATE IO_employee SET out_eat='$date_time' where employee_id=${employee_id} and _date=curdate()");
                    if ($query) return "Salida a comer registrada";
                    else return null;
                }
            }
        } else {
            $query = mysqli_query($this->db, "INSERT INTO IO_employee (employee_id , in_job,_date) values ($employee_id,'$date_time',curdate())");
            if ($query) {
                return "Entrada registrada";
            } else {
                return null;
            }
        }
    }
    public function getEmployeedNotChecked($tarjet_number)
    {
        $id = $this->getSpecificEmployee($tarjet_number);
        $query = mysqli_query($this->db, "SELECT * FROM IO_employee WHERE employee_id = '$id' and out_job is null and _date!=curdate()");
        if (mysqli_num_rows($query) > 0) {

            $query = mysqli_query($this->db, "UPDATE IO_employee set out_job ='00:00:00', comments='Descuento por falta de verificación' WHERE employee_id='$id' and  out_job is null and _date != curdate()");
            return "Se le descontará por no registrar su horario de salida";
        } else {
            return null;
        }
    }
    public function getInJob($tarjet_number, $date_time)
    {
        $id = $this->getSpecificEmployee($tarjet_number);
        $query = mysqli_query($this->db, "SELECT in_job FROM IO_employee WHERE employee_id=$id and _date=curdate() ");
        if (!($row = $query->fetch_array())) {
            $query = mysqli_query($this->db, "INSERT INTO IO_employee (employee_id , in_job,_date) values ($id,'$date_time',curdate())");
            return true;
        } else {
            return false;
        }
    }
    public function insertOutJob($tarjet_number, $date_time)
    {
        $id = $this->getSpecificEmployee($tarjet_number);
        $query = mysqli_query($this->db, "UPDATE IO_employee SET out_job='$date_time' where employee_id='$id'and _date=curdate()");
        if ($query) {
            return true;
        } else return false;
    }
    public function employeesHistory()
    {
        $history_array = array();
        $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id order by io_._date");


        while ($row = $query->fetch_array()) {

            $employee = new EmployeeHistory();
            $employee->setTarjetNumber($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
            $employee->setMail($row[3]);
            $employee->setInJob($row[4] != null ? $row[4] : "Sin registro");
            $employee->setOutEat($row[5] != null ? $row[5] : "Sin registro");
            $employee->setBackEat($row[6] != null ? $row[6] : "Sin registro");
            $employee->setOutJob($row[7] != null ? $row[7] : "Sin registro");
            $employee->setComments($row[8] != null ? $row[8] : "S/C");
            $employee->setDate($row[9]);
            array_push($history_array, $employee);
        }
        return $history_array;
    }
    public function getEmployeeReport($dateInit, $dateEnd)
    {
        $employee_array = array();
        if ($dateEnd != null) {
            $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id and io_._date>='$dateInit' and io_._date<='$dateEnd' order by io_._date");
        } else {
            $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id and io_._date='$dateInit' order by io_._date");
        }
        while ($row = $query->fetch_array()) {
            $employee = new EmployeeHistory();
            $employee->setTarjetNumber($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
            $employee->setMail($row[3]);

            $employee->setInJob($row[4] != null ? $row[4] : "Sin registro");
            $employee->setOutEat($row[5] != null ? $row[5] : "Sin registro");
            $employee->setBackEat($row[6] != null ? $row[6] : "Sin registro");
            $employee->setOutJob($row[7] != null ? $row[7] : "Sin registro");
            $employee->setComments($row[8] != null ? $row[8] : "S/C");
            $employee->setDate($row[9]);
            array_push($employee_array, $employee);
        }
        return $employee_array;
    }
    public function getAllEmployeeReport($tarjet_number)
    {
        $history_array = array();
        $id=$this->getSpecificEmployee($tarjet_number);
        $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE io_.employee_id = e.id_employee and io_.employee_id='$id' order by io_._date");


        while ($row = $query->fetch_array()) {

            $employee = new EmployeeHistory();
            $employee->setTarjetNumber($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
            $employee->setMail($row[3]);

            $employee->setInJob($row[4] != null ? $row[4] : "Sin registro");
            $employee->setOutEat($row[5] != null ? $row[5] : "Sin registro");
            $employee->setBackEat($row[6] != null ? $row[6] : "Sin registro");
            $employee->setOutJob($row[7] != null ? $row[7] : "Sin registro");
            $employee->setComments($row[8] != null ? $row[8] : "S/C");
            $employee->setDate($row[9]);
            array_push($history_array, $employee);
        }
        return $history_array;
    }

    public function getEmployeeReportWithTarjetNumber($tarjet_number, $dateInit, $dateEnd)
    {
        $employee_array = array();
        if ($dateEnd != null) {
            $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id and e.tarjet_number='$tarjet_number' and io_._date>='$dateInit' and io_._date<='$dateEnd' order by io_._date");
        } else {
            $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE e.id_employee = io_.employee_id and e.tarjet_number='$tarjet_number' and io_._date='$dateInit' order by io_._date");
        }
        while ($row = $query->fetch_array()) {
            $employee = new EmployeeHistory();
            $employee->setTarjetNumber($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
            $employee->setMail($row[3]);

            $employee->setInJob($row[4] != null ? $row[4] : "Sin registro");
            $employee->setOutEat($row[5] != null ? $row[5] : "Sin registro");
            $employee->setBackEat($row[6] != null ? $row[6] : "Sin registro");
            $employee->setOutJob($row[7] != null ? $row[7] : "Sin registro");
            $employee->setComments($row[8] != null ? $row[8] : "S/C");
            $employee->setDate($row[9]);
            array_push($employee_array, $employee);
        }
        return $employee_array;
    }
    public function employeeRestriction($tarjet_number)
    {
        $query = mysqli_query($this->db, "SELECT * FROM restriction_food WHERE tarjet_number='$tarjet_number' AND _date=curdate()");
        if ($query != null) {
            if ($row = $query->fetch_array()) {
                $employee = new EmployeeRestrinction();
                $employee->setName($row[1]);
                $employee->setLastName($row[2]);
                $employee->setTarjetNumber($tarjet_number);
                $employee->setDate($row[3]);
                $employee->setRestrinction($row[4]);
                return $employee;
            } else {
                return null;
            }
        } else return null;
    }
    public function getIncidents($tarjet_number){
        $employee= new Employee();
        $id=$this->getSpecificEmployee($tarjet_number);
        $query = mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE io_.employee_id = e.id_employee and io_.employee_id='$id'");
        if ($row = $query->fetch_array()) {
            $employee->setTarjetNumber($row[0]);
            $employee->setName($row[1]);
            $employee->setLastName($row[2]);
        }else $employee=null;

        return $employee;
    }
    public function checkIncident($tarjet_number,$date){
        $id=$this->getSpecificEmployee($tarjet_number);
        $query=mysqli_query($this->db, "SELECT e.tarjet_number,e.name,e.lastname,e.mail,io_.in_job,io_.out_eat,io_.back_eat,io_.out_job,io_.comments,io_._date FROM IO_employee io_ CROSS JOIN employee e WHERE io_.employee_id = e.id_employee and io_.employee_id='$id' and _date='$date'");
        if ($row = $query->fetch_array()) {
        return true;
        }else{
            return false;
        }
    }
    public function registerIncident($tarjet_number,$explainIncidents,$date){
        $id=$this->getSpecificEmployee($tarjet_number);
        $query= mysqli_query($this->db,"INSERT INTO IO_employee (employee_id,in_job,out_eat,back_eat,out_job,_date,comments) VALUES($id,'00:00:00','00:00:00','00:00:00','00:00:00','$date','$explainIncidents')");
        if($query)
            return true;
        else 
            return false;
    }
    public function getEmployeeRestriction($tarjet_number)
    {
        $query = mysqli_query($this->db, "SELECT * FROM restriction_food WHERE tarjet_number='$tarjet_number' AND _date=curdate()");
        if ($query != null) {
            if ($row = $query->fetch_array()) {
                $employee = new EmployeeRestrinction();
                $employee->setName($row[1]);
                $employee->setLastName($row[2]);
                $employee->setTarjetNumber($tarjet_number);
                $employee->setDate($row[3]);
                $employee->setRestrinction($row[4]);
                return $employee;
            } else {
                $query = mysqli_query($this->db, "SELECT * FROM employee WHERE tarjet_number='$tarjet_number' ");

                $row = $query->fetch_array();
                if ($query != null && $row['4'] == $tarjet_number) {

                    date_default_timezone_set('America/Mexico_city');
                    $timestamp = time();
                    $date_time = date("Y-m-d", $timestamp);

                    $employee = new EmployeeRestrinction();
                    $employee->setName($row[1]);
                    $employee->setLastName($row[2]);
                    $employee->setTarjetNumber($tarjet_number);
                    $employee->setDate($date_time);
                    $employee->setRestrinction(false);
                    return $employee;
                } else {
                    return null;
                }
            }
        } else {
            return null;
        }
    }
    public function updateEmployeeRestriction($tarjet_number, $flag)
    {
        $_query = "UPDATE restriction_food SET restriction=%g WHERE tarjet_number='$tarjet_number' AND _date=curdate()";
        $_query = sprintf($_query, $flag);
        $query = mysqli_query($this->db, $_query);

        if ($query) return true;
        else return false;
    }
    public function deleteEmployeeRestriction($tarjet_number)
    {
        $_query = "DELETE FROM restriction_food WHERE tarjet_number='$tarjet_number' AND _date=curdate()";
        $query = mysqli_query($this->db, $_query);

        if ($query) return true;
        else return false;
    }
    public function setEmployeeRestriction($tarjet_number, $name, $lastName, $date, $restriction)
    {
        $query = mysqli_query($this->db, "INSERT INTO restriction_food VALUES('$tarjet_number','$name','$lastName','$date','$restriction')");

        if ($query) return true;
        else return false;
    }
}
class Connect_to_database
{
    public static function conexion()
    {
        if (version_compare(PHP_VERSION, '8.0.10') >= 0) 
            $conexion = new mysqli("127.0.0.1", "php", "password", "control_escolar");   
        else 
        $conexion = new mysqli("localhost", "php", "password", "control_escolar", "3306");
        if($conexion->connect_errno)
            throw new Exception("No se pudo conectar a la base de datos");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
