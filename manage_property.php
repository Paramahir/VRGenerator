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
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="manage_properties.php">Manage Properties</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Property</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mb-4">
                <a href="http://localhost/vrgenerator/admin/home.php?source=group_master&property_id=<?= $_GET["property_id"] ?>"></a>
                <div class="btn btn-lg btn-info" style="width:100%;">
                    Manage
                </div>
            </div>
        </div>
        <div class="row">

             <?php include("database_suppliment.php"); ?>

            <?php
            
                if(isset($_SESSION['login_user_level'])){
                    if($_SESSION['login_user_level'] != ""){
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM group_master where property_id = ".$_GET["property_id"];
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row["group_name"]; ?></h5>
                                    
                                    <p class="card-text"><?= $row["short_description"] ?></p>
                                    <a href="view_panos.php?group_id=<?= $row["id"] ?>&property_id=<?= $_GET["property_id"] ?>" class="card-link btn btn-primary btn-md">Manage Group</a>
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
            }
            else {
                header("location:login.php");
            }
            } 
            else {
            header("location:login.php");
           }    
                $conn->close();
            ?>
            

            </div>
    </div>

    <script src="admin/js/jquery-3.2.1.slim.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
</body>
</html>
