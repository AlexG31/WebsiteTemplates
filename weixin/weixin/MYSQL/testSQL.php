<?php
$con = mysql_connect("localhost","root","123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

// Create table in my_db database
mysql_select_db("mydb_gpf", $con);
$sql = "CREATE TABLE Persons 
(
FirstName varchar(15),
LastName varchar(15),
Age int
)";

mysql_query("INSERT INTO Persons (FirstName, LastName, Age) 
VALUES ('高鹏飞', 'Griffin', '22')");

mysql_query("INSERT INTO Persons (FirstName, LastName, Age) 
VALUES ('Glenn', 'Quagmire', '33')");;

mysql_close($con);
?>
