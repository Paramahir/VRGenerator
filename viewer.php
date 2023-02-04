
<!DOCTYPE html>
<html>
<head>
	<title>krpano Javascript API Examples</title>
	<meta name="viewport" content="width=500, initial-scale=0.64, minimum-scale=0.64" />
	<style>
		body{ margin:0px;padding:0px;}
	</style>
</head>
<body onload="loadxmlstring()" st>
<div id="pano" style="width:100%; height:100%;position:absolute; "></div>



<script src="./krpano/viewer/krpano.js"></script>

<script>

	// global krpano interface (will be set in the onready callback)
	var krpano = null;

	// embed the krpano viewer into the 'pano' div element
	embedpano({
		swf : "null", 		// path to flash viewer (use null if no flash fallback will be requiered)
		id : "krpanoSWFObject", 
		xml : "", 
		target : "pano", 
		consolelog : true,					// trace krpano messages also to the browser console
		passQueryParameters : true, 		// pass query parameters of the url to krpano
		onready : krpano_onready_callback
	});

	// callback function that will be called when krpano is embedded and ready for using
	function krpano_onready_callback(krpano_interface)
	{
		krpano = krpano_interface;
	}

	
	function loadxmlstring()
	{
        console.log("hello");
		if (krpano)
		{
            
            
           
            
             <?php
require_once("./admin/database_config.php");

// Create connection
$conn = new mysqli($host, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM panaroma_master where id=".$_GET["panorama_id"]." limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        ?>
          var xmlstring = 
                        
	                   '<krpano version="1.19" title="Virtual Tour"><action name="startup" autorun="onstart">if(startscene === null OR !scene[get(startscene)], copy(startscene,scene[0].name); );loadscene(get(startscene), null, MERGE);if(startactions !== null, startactions() );</action>'+

                        '<scene name="<?= str_replace(" ","_",$row["panaroma_title"]) ?>" title="<?= $row["panaroma_title"] ?>" onstart="" havevrimage="true" thumburl="<?= $row["panaroma_url"]?>/thumb.jpg" lat="" lng="" heading="">'+

                            '<view hlookat="0.0" vlookat="0.0" fovtype="MFOV" fov="120" maxpixelzoom="2.0" fovmin="70" fovmax="140" limitview="auto" />'+

                            '<preview url="<?= $row["panaroma_url"]?>/preview.jpg" />'+

                            '<image type="CUBE" multires="true" tilesize="512" if="!webvr.isenabled">'+
                                '<level tiledimagewidth="512" tiledimageheight="512">'+
                                    '<cube url="<?= $row["panaroma_url"]?>/%s/l1/%v/l1_%s_%v_%h.jpg" />'+
                                '</level>'+
                            '</image>'+

                            '<image if="webvr.isenabled">'+
                                '<cube url="<?= $row["panaroma_url"]?>/vr/pano_%s.jpg" />'+
                            '</image>'+

                        '</scene>'+
            '</krpano>';  
        <?php
    }
     
} else {
    echo "0 results";
}
$conn->close();
?>     
           
			

			
			krpano.call("loadxml(" + escape(xmlstring) + ", null, MERGE, BLEND(0.5));");
		}
	}

</script>


</body>
</html>

