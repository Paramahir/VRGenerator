
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/style.css">
    <link rel="stylesheet" href="vendor/dropzone.css">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" />
    <script src="vendor/dropzone.js"></script>
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
<div class="container">
  <div id="dropzone" style="width:100%;height:auto;position:relative;float:left;margin-top:10%;">
		<form action="upload_file.php" class="dropzone" id="dropzone" enctype="multipart/form-data"></form>
	</div>
    
	<div class="panoContainer" style="width:100%;height:auto;background:#efefef;position:relative;margin-bottom:15px;padding-bottom:15px;border-bottom:1px solid #ccc;border-top:1px solid #ccc;box-shadow:0px 2px 2px rgba(0,0,0,0.25);float:left;">
		<br><h4 style="margin-left:15px;">Panoramas Uploaded</h4>
		<?php
			 include("database_suppliment.php"); 
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
			$sql = "SELECT * FROM main_panaroma_master";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					?><div style="width:150px;height:150px;background:url(./images/panos/<?=$row["panaroma_url"]?>.tiles/thumb.jpg) center no-repeat;background-size:conver;float:left;margin:15px 0px 0px 15px;border-radius:5px;box-shadow:2px 2px 5px rgba(0,0,0,0.5);"></div><?php
				}
			} else { }
			$conn->close();
		?>   
	</div>
    
        <div style="padding: 0px 0px;">
            
        </div>
    </div>
		
    </body>
</html>