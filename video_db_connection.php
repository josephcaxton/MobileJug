<?php
/**
This is used to connect to the Video Database 
Code written by Joseph April 15th 2014
*/
function OpenDataBaseConnection() 
{ 
  $mysqli = new mysqli('54.72.34.84','root','letmein2','Videos','3306');
  
  		if ($mysqli->connect_errno > 0)
			{
    			die('Could not connect: [' . $mysqli->connect_errno . ']');
    			return 0;
			}
	else
			{
   				 
   				 return $mysqli;
	}
} 
?> 

