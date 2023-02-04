
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <!-- Generic page styles -->
<link rel="stylesheet" href="vendor/upload/css/style.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="vendor/upload/css/jquery.fileupload.css">
</head>

<body>

<?php include("header.php"); ?>
<div class="container">
 
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>
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
    
    <script src="jq.js"></script>
<script src="vendor/upload/js/vendor/jquery.ui.widget.js"></script>
<script src="vendor/upload/js/jquery.iframe-transport.js"></script>
<script src="vendor/upload/js/jquery.fileupload.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'upload_file.php';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
</html>