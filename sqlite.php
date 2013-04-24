<?php

include_once('header.php');

$dbhandle = sqlite_open("test.db",0666,$error);



if (!$dbhandle)
{
    die($error);
}

$createTable = "CREATE TABLE books(ID INTEGER PRIMARY KEY ASC,TITLE VARCHAR(50),AUTHOR VARCHAR(50))";

$createTableRun = sqlite_exec($createTable,$error);

if (!$createTableRun)
{
    die("Cannot Execute Query. $error");
}

$insertRow = "INSERT INTO books VALUES(1,'Node JS','McGarrett, Brendan')";

$insertRowRun = sqlite_exec($insertRow,$error);

if (!$insertRowRuns)
{
    die("Cannot Insert. $error");
}



include_once('footer.php');

