<?php
	require_once("./database_suppliment.php");
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
	$sql = "delete from panaroma_master where group_id = ".$_GET["group_id"]." and panaroma_id = ".$_GET["panaroma_id"];
		if ($conn->query($sql) === TRUE) {
			echo "done";
            header('Location:view_panos.php?group_id='.$_GET["group_id"].'&property_id='.$_GET["property_id"]); 
		} else {
			echo "error";
		}
	  
	$conn->close();
?>
