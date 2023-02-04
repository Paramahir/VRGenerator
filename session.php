<?php
   include('database_suppliment.php'); // Create connection 
   $conn = new mysqli($servername, $username, $password, $dbname); // Check connection 
   if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
   session_start();
   
   $user_check = $_SESSION['login_user'];
   $user_level_check = $_SESSION['login_use_level'];
   $ses_sql = mysqli_query($conn,"select id,user_level_id from user_master where id = '$user_check' and user_level_id = '$user_level_ckeck'");
   
   $row = mysqli_fetch_array($ses_sql);
   
   $login_session = $row['id'];
    $login_session = $row['id'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>