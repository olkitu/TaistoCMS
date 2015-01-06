<?php
function sql($sql){
  //Connect MySQL Server and database. 
	$con=mysqli_connect("127.0.0.1","mysql","passwod","database") or die ('ERROR! Cannot Connect Database');
	mysqli_query($con, "SET NAMES utf8");
	$result = mysqli_query($con, $sql);
	mysqli_close($con);
	
	return $result;
}

function sqlGetContent($site){
//Selecting table
	$result = sql("SELECT content FROM table WHERE name='" . $site . "'");
	
	$row = mysqli_fetch_array($result);
	return $row['content'];
}

?>
