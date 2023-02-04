<?php  session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../vendor/style.css">
   
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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="manage_properties.php">Manage Properties</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="manage_property.php?property_id=<?=$_GET["property_id"]?>">Manage Property</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Select Panorama</li>
                    </ol>
                </nav>
            </div>
            
        </div>
    </div>
        
               
       <div class="container" style="overflow:hidden;">
	  	<div class="row">
		<?php
            
            if(isset($_SESSION['login_user_level'])){
                    if($_SESSION['login_user_level'] != ""){                                                                     
			require_once("database_suppliment.php");
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 
			$sql = "SELECT * FROM main_panaroma_master where id not in(select panaroma_id from panaroma_master)";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					?>
           <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 mb-4">
            <div class="panos" data-url="<?= str_replace("-","_",$row["panaroma_url"]) ?>" data-selected="0" data-panoid="<?= $row["id"] ?>" style="cursor:pointer;width:100%;height:150px;background:url(images/panos/<?=$row["panaroma_url"]?>.tiles/thumb.jpg) center no-repeat;background-size:cover;border-radius:5px;"></div>
           </div>
           
           <?php
				}
			} else { 
                echo "All Panoramas Have Been Allocated to Groups.";
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
         <a href="view_panos.php?group_id=<?= $_GET['group_id'] ?>&property_id=<?= $_GET['property_id'] ?>"><div style="width:calc(100%);height:40px;background:royalblue;color:white;line-height:40px;text-align:center;position:relative;float:left;margin-top:20px;border-radius:5px;margin-bottom:20px;">
            Done
             </div></a>
    </div>
        
   
</body>
<script src="admin/js/jquery-3.2.1.slim.min.js"></script>
<script src="admin/js/popper.min.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="jq.js"></script>
	<script>
		$(".panos").on("click",function(){
			var thisElement = $(this);
			if($(this).attr("data-selected") == 0){
				$.get( "panoGroup.php?type=add&pano_url="+$(this).data("url")+"&group_id="+<?= $_GET["group_id"] ?>+"&panaroma_id="+$(this).data("panoid"), function( data ) {
					thisElement.attr("data-selected","1");
					thisElement.css({"boxShadow":"5px 5px 5px rgba(0,0,255,0.5)","border":"3px dashed rgba(0,0,0,0.25)"});
				});
			} else {
				$.get( "panoGroup.php?type=del&pano_url="+$(this).data("url")+"&group_id="+<?= $_GET["group_id"] ?>+"&panaroma_id="+$(this).data("panoid"), function( data ) {
					thisElement.attr("data-selected","0");
					thisElement.css({"boxShadow":"none","border":"none"});
				});
			}
			
		});
	</script>
</html>
