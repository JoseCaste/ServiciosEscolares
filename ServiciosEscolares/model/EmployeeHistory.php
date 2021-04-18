<?php
class EmployeeHistory extends Employee
{
    private $in_job;
    private $out_eat;
    private $out_job;


    public function __construct()
    {
    }

    public function getIn_job()
    {
        return $this->in_job;
    }
    public function setIn_job($in_job)
    {
        $this->in_job = $in_job;
    }

    public function getOut_eat()
    {
        return $this->out_eat;
    }

    public function setOut_eat($out_eat)
    {
        return $this->out_eat = $out_eat;
    }
    public function getOut_job()
    {
        return $this->out_job;
    }

    public function setOut_job($out_job)
    {
        return $this->out_job = $out_job;
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
}
