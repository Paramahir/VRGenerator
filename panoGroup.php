<?php
	require_once("./database_suppliment.php");
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
	if($_GET["type"]=="add"){
		$sql = "insert into panaroma_master(group_id,panaroma_id,panaroma_url,default_fov) values(".$_GET["group_id"].",".$_GET["panaroma_id"].",'".$_GET["pano_url"]."','95.000')";
		if ($conn->query($sql) === TRUE) {
			echo "done";
		} else {
			echo $conn->error;
		}
	} else if($_GET["type"]=="del"){
		$sql = "delete from panaroma_master where group_id = ".$_GET["group_id"]." and panaroma_id = ".$_GET["panaroma_id"];
		if ($conn->query($sql) === TRUE) {
			echo "done";
		} else {
			echo "error";
		}
	}  
	$conn->close();
?>