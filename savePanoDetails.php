<?php
include("database_suppliment.php");
            
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = $_POST["type"];

if($type=="set_pano_title"){
    if(isset($_POST["panaroma_title"]) && isset($_POST["panaroma_id"])){
        $sql = "update panaroma_master set panaroma_title = '".$_POST["panaroma_title"]."' where id = ".$_POST["panaroma_id"]; 
        if ($conn->query($sql) === TRUE) {
    echo "done";
} else {
    echo "error";
    echo $sql;
}

$conn->close();
    } else {
        echo "locho 1";
    }
} else if($type=="set_pano_description"){
    if(isset($_POST["panaroma_description"]) && isset($_POST["panaroma_id"])){
        $sql = "update panaroma_master set short_description = '".$_POST["panaroma_description"]."' where id = ".$_POST["panaroma_id"];
        if ($conn->query($sql) === TRUE) {
    echo "done";
} else {
    echo "error";
    echo $sql;
}

$conn->close();
    }else {
        echo "locho 2";
    }
} else if($type=="set_default_view"){
    if(isset($_POST["default_fov"]) &&isset($_POST["default_fov"]) &&isset($_POST["default_h"])&&isset($_POST["default_v"]) && isset($_POST["panaroma_id"])){
        $sql = "update panaroma_master set default_fov = ".$_POST["default_fov"].", default_h = ".$_POST["default_h"].", default_v = ".$_POST["default_v"]." where id = ".$_POST["panaroma_id"];
        if ($conn->query($sql) === TRUE) {
    echo "done";
} else {
    echo "error";
    echo $sql;
}

$conn->close();
    }else {
        echo "locho 3";
    }
} else if($type=="save_hotspot"){
    if(isset($_POST["hotspot_title"]) && isset($_POST["panaroma_id"]) && isset($_POST["hotspot_default_h"]) && isset($_POST["hotspot_default_v"]) && isset($_POST["target_panaroma_id"])){
        $sql = "insert into hotspot_master (hotspot_title,panaroma_id,default_h,default_v,target_panaroma_id) values ('".$_POST["hotspot_title"]."',".$_POST["panaroma_id"].",".$_POST["hotspot_default_h"].",".$_POST["hotspot_default_v"].",".$_POST["target_panaroma_id"].")";
        if ($conn->query($sql) === TRUE) {
    echo "done";
}  else {
    echo "error";
    echo $sql;
}

$conn->close();
    }
    else {
        echo "locho 4";
    }
} else if($type=="clear_all_hotspot"){
    if(isset($_POST["panaroma_id"])){
        $sql = "delete from hotspot_master where panaroma_id = ".$_POST["panaroma_id"];
        if ($conn->query($sql) === TRUE) {
    echo "done";
}  else {
    echo "error";
    echo $sql;
}

$conn->close();
    }
    else {
        echo "locho 5";
    }
} else if($type=="clear_current_hotspot"){
    if(isset($_POST["panaroma_id"]) && isset($_POST["hotspot_default_h"]) && isset($_POST["hotspot_default_v"]) && isset($_POST["target_panaroma_id"])){
        $sql = "delete from hotspot_master where panaroma_id=".$_POST["panaroma_id"]." and default_h=".$_POST["hotspot_default_h"]." and default_v=".$_POST["hotspot_default_v"]." and target_panaroma_id=".$_POST["target_panaroma_id"] ;
        if ($conn->query($sql) === TRUE) {
    echo "done";
}  else {
    echo "error";
    echo $sql;
}

$conn->close();
    }
    else {
        echo "locho 6";
    }
}
?>
