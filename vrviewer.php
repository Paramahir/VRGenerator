<!DOCTYPE html>
<html>
<head>
	<title>krpano Javascript API Examples</title>
	<meta name="viewport" content="width=500, initial-scale=0.64, minimum-scale=0.64" />
	
</head>
<body style="margin:0px;padding:0px;">
<div id="pano" style="width:100%; height:100%; position:absolute;">
        </div>
<script src="krpano.js"></script>

<script>
	var krpano = null;
	embedpano({
		swf : "krpano.swf",
		id : "krpanoSWFObject", 
		target : "pano", 
		consolelog : true,					
		passQueryParameters : true,
		onready : krpano_onready_callback
	});

	function krpano_onready_callback(krpano_interface)
	{
		krpano = krpano_interface;
        setTimeout(loadxmlstring,2000);
        
	}
	function loadxmlstring()
	{
        
		if (krpano)
		{
			xmlstring = 
				'<krpano version="1.19">'+
                '<include url="krpano/templates/xml/skin/vtourskin.xml"/>'+
                '<action name="startup" autorun="onstart">'+
                'if(startscene === null OR !scene[get(startscene)], copy(startscene,scene[0].name); );'+
                'loadscene(get(startscene), null, MERGE);'+
                'if(startactions !== null, startactions() );'+
                '</action>';
            
                <?php 
                include("database_suppliment.php");
            
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                $sql1 = "select * from property_master where id = ".$_GET["property_id"];
                $result1 = $conn->query($sql1);

                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        //property here
                        $sql2 = "select * from group_master where property_id = ".$row1["id"];
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_assoc()) {
                                //all groups here
                                $sql3 = "select * from panaroma_master where group_id = ".$row2["id"];
                                $result3 = $conn->query($sql3);
                                if ($result3->num_rows > 0) {
                                    while($row3 = $result3->fetch_assoc()) {
                                        //all panoramas here
                                        $sql4 = "select * from hotspot_master where panaroma_id = ".$row3["id"];
                                        $result4 = $conn->query($sql4);

                                        if ($result4->num_rows > 0) {
                                             ?>
                window.xmlstring +=
                    '<scene name="pano_<?= $row3["id"] ?>" pano_id="<?= $row3["id"] ?>" description="<?= $row3["short_description"] ?>" title="<?= $row3["panaroma_title"] ?>" onstart="" havevrimage="true" thumburl="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/thumb.jpg" group_id="<?= $row2["id"] ?>" group_title="<?= $row2["group_name"] ?>">' +
                    '<view hlookat="<?= $row3["default_h"] ?>" vlookat="<?= $row3["default_v"] ?>" fovtype="MFOV" fov="<?= $row3["default_fov"] ?>" maxpixelzoom="2.0" fovmin="80" fovmax="120" limitview="auto"/>' +
                    '<preview url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/preview.jpg"/>' +
                    '<image type="CUBE" multires="true" tilesize="512" if="!webvr.isenabled">' +
                    '<level tiledimagewidth="1024" tiledimageheight="1024">' +
                    '<cube url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/%s/l1/%v/l1_%s_%v_%h.jpg"/>' +
                    '</level>' +
                    '</image>' +
                    '<image if="webvr.isenabled"><cube url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/vr/pano_%s.jpg"/></image>' +
                    '<events name="sceneevents" onloadcomplete="js(sceneLoaded())" />';
                <?php
                                            while($row4 = $result4->fetch_assoc()) {
                                                //all hotspots here
                                                ?>

                window.xmlstring += '<hotspot name="hotspot_<?= $row4["id"] ?>" type="image" url="krpano/templates/xml/skin/vtourskin_hotspot.png" visible="true" scale="0.7" zorder="1" ath="<?= $row4["default_h"] ?>" atv="<?= $row4["default_v"] ?>" alpha="1" onclick="loadscene(pano_<?=$row4["target_panaroma_id"]?>)" />';

                <?php
                                            }
                                           ?>
                window.xmlstring += '</scene>';
                <?php
                                        }
                                        else {
                                            ?>
                                            //panorama without hotspot
                                            window.xmlstring +=
                                                '<scene name="pano_<?= $row3["id"] ?>" title="<?= $row3["panaroma_title"] ?>" onstart="" havevrimage="true" thumburl="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/thumb.jpg">'+
                                                '<view hlookat="0.0" vlookat="0.0" fovtype="MFOV" fov="75.00" maxpixelzoom="1.0" fovmin="80" fovmax="120" limitview="auto"/>'+
                                                '<preview url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/preview.jpg"/>'+
                                                '<image type="CUBE" multires="true" tilesize="512" if="!webvr.isenabled">'+
                                                '<level tiledimagewidth="1024" tiledimageheight="1024">'+
                                                '<cube url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/%s/l1/%v/l1_%s_%v_%h.jpg" />'+
                                                '</level>'+
                                                '</image>'+
                                                '<image if="webvr.isenabled"><cube url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/vr/pano_%s.jpg"/></image>'+ 
                                                '</scene>';
                                            <?php
                                        }
                                    }
                                }
                                else {
                                    //locho
                                }
                            }
                        }
                        else {
                            //Locho
                        }
                    }
                }
                else {
                    //Locho
                }
                ?>
            
				window.xmlstring += '</krpano>';
			
			krpano.call("loadxml(" + escape(window.xmlstring) + ", null, MERGE, BLEND(0.5));");
		}
	}
</script>


</body>
</html>

