<?php  /* db-tilkobling */
/*
/*  Programmet foretar tilkobling til database-server og valg av database
*/

$host="localhost";
$user="233618";
$password="zC4VkcYW";
$database="233618";

$db=mysqli_connect($host, $user, $password, $database) or die("Ikke kontakt me database");
 
?>