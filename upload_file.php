<?php

session_start();

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$file_name = basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$newFileName = GUID();
$newFileName_Backup = $newFileName;

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["file"]["size"] > 100000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "tif" ) {
    echo "Sorry, only JPG, JPEG, PNG & TIFF files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
}  else {
    $temp = explode(".", $file_name);
    $newfilename = $newFileName . '.' . end($temp);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $newfilename)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        processPanorama($newfilename);
    
      include("database_suppliment.php"); 

            
         // Create connection
         $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "insert into main_panaroma_master(panaroma_url,enabled) values('".$newFileName_Backup."',1)";
        if ($conn->query($sql) === TRUE) {
            header("Location:index.php?source=panaroma_master");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function processPanorama($name){
	
    $output =  shell_exec('.\krpano\krpanotools64.exe makepano -config="templates/vtour-vr-new.config" .\images\\'.$name);
        //shell_exec(".\\krpano\\krpanotools64.exe makepano -config='templates/vtour-vr-new.config' .\\images\\".$name);
    $index = strlen($output);
    echo substr($output,$index - 7,4);
}





?>
