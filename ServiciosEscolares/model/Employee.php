<?php


class Employee{
    public $id;
    public $name;
    public $lastName;
    public $mail;
    public $tarjet_number;

    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
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
    
    public function getMail(){
        return $this->mail;
    }
    public function setMail($mail){
        $this->mail=$mail;
    }

    public function getTarjetNumber(){
        return $this->tarjet_number;
    }
    public function setTarjetNumber($tarjet_numbel){
        $this->tarjet_number=$tarjet_numbel;
    }

}
?>