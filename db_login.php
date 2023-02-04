<?php
   include("database_suppliment.php");

   session_start();
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $password=null;
      $myemail = $_POST['email'];
      $mypass = $_POST['pass'];
      $sql = "SELECT * FROM user_master WHERE email = '$myemail'"; 
      $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                       $key = $row["salt_id"];
                       $password = md5($mypass.$key);                          
                    }
                }
      $sql = "SELECT * FROM user_master WHERE email = '$myemail' and password='$password' and enabled=1";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      
      
		
      if($count == 1) {
        
         $_SESSION['login_user'] = $row["id"];
         $_SESSION['login_user_level'] = $row["user_level_id"];
          
         header('location: index.php');
      }else {
         echo "Your Login Name or Password is invalid";
      }
   }
?>