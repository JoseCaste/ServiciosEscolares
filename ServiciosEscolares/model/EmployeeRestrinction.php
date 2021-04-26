<?php


class EmployeeRestrinction{
    public $name;
    public $lastName;
    public $tarjet_number;
    public $date;
    public $restriction;
    
    public function __construct(){

    }

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name=$name;
    }

    
    public function getLastName(){
        return $this->lastName;
    }
    public function setLastName($lastName){
        $this->lastName=$lastName;
    }

    public function getTarjetNumber(){
        return $this->tarjet_number;
    }
    public function setTarjetNumber($tarjet_numbel){
        $this->tarjet_number=$tarjet_numbel;
    }
    public function setDate($_date){
        $this->date=$_date;
    }
    public function getDate(){
        return $this->date;
    }
    public function setRestrinction($restriction)
    {
        $this->restriction=$restriction;
    }
    public function getRestrinction()
    {
        return $this->restriction;
    }
}
?>