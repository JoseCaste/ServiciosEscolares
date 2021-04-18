<?php
require_once("../model/Connection.php");

$conn= new Connection();

$historyArray=$conn->employeesHistory();

print_r(json_encode($historyArray));


?>