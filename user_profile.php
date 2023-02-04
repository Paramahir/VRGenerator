<?php
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" />

    <title>Home | VRGenerator</title>
    <style>
        html {
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        .card {
            font-size: 1em;
            overflow: hidden;
            padding: 0;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
        }

        .card-block {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;
        }

        .card-title {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
        }

        .card-text {
            clear: both;
            margin-top: .5em;
            color: rgba(0, 0, 0, .68);
        }

    </style>
</head>

<body>

    <?php include("header.php"); ?>

    <!-- Page Content -->
    <div class="container" style="height:100px;margin-top:70px;">
        <div class="row">

            <?php include("database_suppliment.php"); ?>

            <?php
               
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if(isset($_SESSION['login_user'])){
                    if($_SESSION['login_user'] != ""){
                                   
                        
                $sql = "select * from user_profile_master where enabled=1 and user_master_id = ".$_SESSION['login_user'];
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <p class="card-text">First Name : <?= $row["first_name"] ?></p>
                                    <p class="card-text">Last Name : <?= $row["last_name"] ?></p>
                                    <p class="card-text">Middle Name : <?= $row["middle_name"] ?></p>
                                    <p class="card-text">Country : <?= $row["country"] ?></p>
                                    <p class="card-text">State : <?= $row["state"] ?></p>
                                    <p class="card-text">City : <?= $row["city"] ?></p>
                                    <p class="card-text">pincode : <?= $row["pincode"] ?></p>
                                    <p class="card-text">contact No. : <?= $row["contact_no"] ?></p>
                                    <a href="add_profile.php" class="card-link btn btn-primary btn-md">Change</a>
                                </div>
                            </div>
                        </div>
                <?php
                                                            
                    }
                } else {
                    
                   header("location:add_profile.php");
                }
                $conn->close();
                }   
                else {
                    header("location:login.php");
                }
                }
                else {
                    header("location:login.php");
                }
            ?>
        </div>
    </div>

    <script src="admin/js/jquery-3.2.1.slim.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
</body>

</html>
