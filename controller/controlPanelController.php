<?php
require_once("../model/Connection.php");
class ControlPanelController{
    public $conn;
    public $employee_array;
    public function __construct()    
     {    
          $this->conn= new Connection();
            $this->getEmployee();
     }   
    
 function getEmployee(){
    $this->employee_array=$this->conn->getAllEmployee();
    $db=$this->employee_array;
    }
    function getEmployeeArray(){
        return $this->employee_array;
    }

}
