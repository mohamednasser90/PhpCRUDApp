<?php


$dsn='mysql:host=localhost;port=3307;dbname=profile';
$user='root';
$pass='root';
$port=3307;
$option=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try{
    $con=new PDO($dsn,$user,$pass,$option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   // echo 'You Are Connected';
}
catch (PDOException $e){
    echo 'Faild To Connect'.$e->getMessage();

}