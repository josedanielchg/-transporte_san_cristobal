<?php

//Database configuration variables
$DOMAIN = "localhost";
$USER = "root";
$PASSWORD = "";
$DB = "zmsdb";

//Databese connection
$con = mysqli_connect($DOMAIN, $USER, $PASSWORD, $DB);

if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error();
}
