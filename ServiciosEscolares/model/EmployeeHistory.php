<?php
class EmployeeHistory extends Employee
{
    public $inJob;
    public $outEat;
    public $outJob;
    public $backJob;
    public $comments;
    public $date;

    public function __construct()
    {
    }

    public function getInJob()
    {
        return $this->inJob;
    }
    public function setInJob($InJob)
    {
        $this->InJob = $InJob;
    }

    public function getOutEat()
    {
        return $this->outEat;
    }

    public function setOutEat($out_eat)
    {
        return $this->OutEat = $out_eat;
    }
    public function getOutJob()
    {
        return $this->outJob;
    }
    public function setBackEat($back_eat)
    {
        return $this->BackEat = $back_eat;
    }
    public function getBackJob()
    {
        return $this->backJob;
    }

    public function setOutJob($out_job)
    {
        return $this->OutJob = $out_job;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }


    public function getLastName()
    {
        return $this->lastName;
    }
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getTarjetNumber()
    {
        return $this->tarjet_number;
    }
    public function setTarjetNumber($tarjet_numbel)
    {
        $this->tarjet_number = $tarjet_numbel;
    }

    public function setComments($comments){
        $this->comments=$comments;
    }
    public function getComments(){
        return $this->comments;
    }
    public function setDate($date)
    {
        $this->Date=$date;
    }
    public function getDate()
    {
        return $this->date;
    }
}
