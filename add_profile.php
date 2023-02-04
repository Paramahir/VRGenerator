<?php

session_start();

?>
<html>
<head>    
    <title>User Profile</title>
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../vendor/style.css">
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">VRGenerator</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
       
        </button>
    </div>
</nav>
    <div style="margin-top:5%;">
    <form class = "form-horizontal" role = "form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      
   <label  class = "col-sm-2 control-label">Please Enter Your Details</label>
   <div class = "form-group">
      <label for = "firstname" class = "col-sm-2 control-label">First Name</label>
		
      <div class = "col-sm-10">
         <input type = "text" class = "form-control" id = "firstname" placeholder = "Enter First Name" name = "firstname" value="">
      </div>
   </div>
   
   <div class = "form-group">
      <label for = "middlename" class = "col-sm-2 control-label">Middle Name</label>
		
      <div class = "col-sm-10">
         <input type = "text" class = "form-control" id = "middlename" placeholder = "Enter Middle Name" name = "middlename" value="">
      </div>
   </div>
        
   <div class = "form-group">
      <label for = "lastname" class = "col-sm-2 control-label">Last Name</label>
		
      <div class = "col-sm-10">
         <input type = "text" class = "form-control" id = "lastname" placeholder = "Enter Last Name" name = "lastname" value="">
      </div>
   </div>
   <div class = "form-group">
      <label for = "Country" class = "col-sm-2 control-label">Country</label>
		
      <div class = "col-sm-10">
         <input type = "text" class = "form-control" id = "Country" placeholder = "Enter Country" name = "country" value="">
      </div>
   </div>
   <div class = "form-group">
      <label for = "State" class = "col-sm-2 control-label">State</label>
		
      <div class = "col-sm-10">
         <input type = "text" class = "form-control" id = "State" placeholder = "Enter State" name = "state" value="">
      </div>
   </div>
   <div class = "form-group">
      <label for = "City" class = "col-sm-2 control-label">City</label>
		
      <div class = "col-sm-10">
         <input type = "text" class = "form-control" id = "City" placeholder = "Enter City" name = "city" value="">
      </div>
   </div>
   <div class = "form-group">
      <label for = "Pincode" class = "col-sm-2 control-label">Pincode</label>
		
      <div class = "col-sm-10">
         <input type = "number" class = "form-control" id = "Pincode" placeholder = "Enter Pincode" name = "pincode" value="">
      </div>
   </div>  
   <div class = "form-group">
      <label for = "Contact Number" class = "col-sm-2 control-label">Contact No</label>
		
      <div class = "col-sm-10">
         <input type = "number" class = "form-control" id = "Contact_no" placeholder = "Enter Contact Number" name = "contactno" value="">
      </div>
   </div>         
   
   <div class = "form-group">
      <div class = "col-sm-offset-2 col-sm-10">
         <button type = "submit" class = "btn btn-default">Submit</button>
      </div>
   </div>
	
</form>  
    </div>   
</body>    
</html>
<?php
   include("database_suppliment.php");

  
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     
      
      $firstname = null;
      $middlename = null;   
      $lastname = null;
      $country = null;
      $city = null;
      $state=null;
      $pincode = null;
      $contactno=null; 
      $enabled = 1;
if (isset($_POST['firstname']))    
{    
         $firstname=$_POST["firstname"];  
}
if (isset($_POST['middlename']))    
{    
        $middlename=$_POST["middlename"]; 
}       
if (isset($_POST['lastname']))    
{    
        $lastname=$_POST["lastname"]; 
}
if (isset($_POST['country']))    
{    
        $country=$_POST["country"]; 
}        
if (isset($_POST['state']))    
{    
        $state=$_POST["state"]; 
} 
if (isset($_POST['city']))    
{    
        $city=$_POST["city"]; 
}     
if (isset($_POST['pincode']))    
{    
        $pincode=$_POST["pincode"]; 
} 
if (isset($_POST['contactno']))    
{    
        $contactno=$_POST["contactno"]; 
}        
       if(isset($_SESSION['login_user'])){
            if($_SESSION['login_user'] != ""){
                $sql = "select * from user_profile_master where enabled=1 and user_master_id=".$_SESSION['login_user'];
                $result = $conn->query($sql);
                if ($result->num_rows == 0) {    
                    $sql = "insert into user_profile_master(user_master_id,first_name,middle_name,last_name,city,state,country,pincode,contact_no,enabled) values(".$_SESSION['login_user'].",'$firstname','$middlename','$lastname','$city','$state','$country','$pincode','$contactno','$enabled')";
		            if ($conn->query($sql) === TRUE) {
                        header("location:user_profile.php");			
                    } else {
                        echo $conn->error;
		            }
                } else {
                    $sql = "update user_profile_master set user_master_id=".$_SESSION['login_user'].",first_name='$firstname',middle_name = '$middlename',last_name='$lastname',city='$city',state='$state',country='$country',pincode='$pincode',contact_no='$contactno', enabled=1"; 
		              if ($conn->query($sql) === TRUE) {
                        header("location:user_profile.php");			
		              } else {
			             echo $conn->error;
		              }
                }
            } else {
                header("location:login.php");
            }
         } else {
            header("location:login.php");
        }
   }
?>