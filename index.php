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
                if(isset($_SESSION['login_user_level'])){
                    if($_SESSION['login_user_level'] != ""){
                        //$sql = "SELECT * FROM module_master where id = Any (select module_id from module_user_level_master where user_level_id= ".$_SESSION['login_user_level'].") order by sequence asc";
                        
                        
                        $sql = "select * from module_master inner join module_user_level_master on module_master.id = module_user_level_master.module_id and user_level_id = ".$_SESSION['login_user_level']." and enable = 1 order by module_master.sequence asc";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                          
                        ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card card-inverse card-info">
                        <img class="card-img-top" src="<?= $row['module_image'] ?>">
                        <div class="card-block">
                            <h4 class="card-title">
                                <?= $row["module_name"] ?>
                            </h4>
                            <div class="card-text">
                                <?= $row["module_description"] ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?= $row['module_url'] ?>"><button class="btn btn-info float-right btn-sm">Launch</button></a>
                        </div>
                    </div>
                </div>
                <?php
                    
                    }
                } else {
                    ?>
                    <div class="col-lg-12">
                        <div class="alert alert-warning" role="alert">
                            No modules registered in the system.
                        </div>
                    </div>
                    <?php
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
