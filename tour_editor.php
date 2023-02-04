<!DOCTYPE html>
<html>

<head>
    <title>krpano Javascript API Examples</title>
    <meta name="viewport" content="width=500, initial-scale=0.64, minimum-scale=0.64" />
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" />
</head>

<body style="margin:0px;padding:0px;">
    <div class="vericleLine" style="width:1px;height:100%;background:rgba(0,0,0,0.25);position:absolute;left:calc((100% - 500px)/2);z-index:3;"></div>
    <div class="horizontalLine" style="height:1px;width:calc(100% - 500px);background:rgba(0,0,0,0.25);position:absolute;top:calc(100%/2);z-index:3;"></div>
    <div class="loadingIcon" style="width:50px;height:50px;background:white url('loading.gif') center no-repeat;border-radius:5px;top:10px;left:10px;position:absolute;z-index:10;background-size:contain;box-shadow:2px 2px 2px rgba(0,0,0,0.25);"></div>
    <div id="pano" style="width:calc(100% - 500px); height:100%; position:absolute;box-shadow:5px 0px 10px rgba(0,0,0,0.25);z-index:2;"></div>
    <div class="editorPanel" style="width:500px;height:100%;background:#efefef;position:absolute;right:0px;z-index:1;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form>
                        <br>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="panorama_title" placeholder="Panorama Title">
                            </div>
                            <div class="col-sm-2">
                                <div onclick="set_panorama_title()" style="width:100%;" class="btn btn-success set_panorama_title">Set</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Desc.</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="panorama_description" placeholder="Short Description">
                            </div>
                            <div class="col-sm-2">
                                <div onclick="set_short_description()" style="width:100%;" class="btn btn-success set_short_description">Set</div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">FOV</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="default_fov" placeholder="Default FOV">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Horizontal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="default_h" placeholder="Default H">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="inputEmail3" class="col-sm-2 col-form-label">Verticle</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="default_v" placeholder="Default V">
                            </div>
                            <div class="col-sm-6">
                                <div onclick="set_default_view()" style="width:100%;" class="btn btn-success set_default_view">Set Default View</div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div onclick="add_hotspot();" style="width:100%;" class="btn btn-info">+ Add Hotspot</div>
                            </div>
                            <div class="col-sm-6">
                                <div onclick="remove_all_hotspots()" style="width:100%;" class="btn btn-danger">Clear Hotspots</div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="hotspot_title" placeholder="Hotspot Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Horizontal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="hotspot_default_h" placeholder="Default H">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Verticle</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="hotspot_default_v" placeholder="Default V">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Target</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="targetPanorama">
                                    <option value="null">Please select target panorama</option>
                                    <?php include("database_suppliment.php"); ?>

                                        <?php

                                        // Create connection
                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        // Check connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }
                                        $sql ="select * from panaroma_master where group_id in(select id from group_master where property_id = ".$_GET["property_id"].")";
                                        $result = $conn->query($sql); 
                                        if ($result->num_rows > 0) { 
                                            while($row = $result->fetch_assoc()) {
                                                ?>
                                            <option value="<?= $row['id'] ?>">
                                                <?php if($row["panaroma_title"] == ""){
                                                    echo "Title Not Set, Pano id : ".$row['id'];
                                                } else {
                                                    echo $row["panaroma_title"];
                                                }
                                                ?>
                                            </option>
                                            <?php
                                            }
                                        }else{
                                            echo "locho";
                                        }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <div onclick="save_hotspot()" style="width:100%;" class="btn btn-success">Save Hotspot</div>
                            </div>
                            <div class="col-sm-6">
                                <div onclick="remove_current_hotspot()" style="width:100%;" class="btn btn-warning">Cancel</div>
                            </div>
                        </div>
                        <hr/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="jq.js"></script>
    <script src="krpano.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script>
        var krpano = null;
        embedpano({
            swf: "krpano.swf",
            id: "krpanoSWFObject",
            target: "pano",
            consolelog: true,
            passQueryParameters: true,
            onready: krpano_onready_callback
        });
        fadeInterval = 500;
        function krpano_onready_callback(krpano_interface) {
            krpano = krpano_interface;
            setTimeout(loadxmlstring, 500);
        }

        function loadxmlstring() {
            
            if (krpano) {
                xmlstring =
                    '<krpano version="1.19">' +
                    '<include url="krpano/templates/xml/skin/vtourskin.xml"/>' +
                    '<action name="startup" autorun="onstart">' +
                    'if(startscene === null OR !scene[get(startscene)], copy(startscene,scene[0].name); );' +
                    'loadscene(get(startscene), null, MERGE);' +
                    'if(startactions !== null, startactions() );' +
                    '</action>';

                <?php 
                include("database_suppliment.php");
            
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
                $sql1 = "select * from property_master where id = ".$_GET["property_id"]." limit 1";
                $result1 = $conn->query($sql1);

                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                        //property here
                        $sql2 = "select * from group_master where property_id = ".$row1["id"];
                        $result2 = $conn->query($sql2);

                        if ($result2->num_rows > 0) {
                            while($row2 = $result2->fetch_assoc()) {
                                //all groups here
                                $sql3 = "select * from panaroma_master where group_id = ".$row2["id"]." order by sequence_id asc";
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
                    '<scene name="pano_<?= $row3["id"] ?>" pano_id="<?= $row3["id"] ?>" description="<?= $row3["short_description"] ?>" title="<?= $row3["panaroma_title"] ?>" onstart="" havevrimage="true" thumburl="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/thumb.jpg" group_id="<?= $row2["id"] ?>" group_title="<?= $row2["group_name"] ?>">' +
                    '<view hlookat="<?= $row3["default_h"] ?>" vlookat="<?= $row3["default_v"] ?>" fovtype="MFOV" fov="<?= $row3["default_fov"] ?>" maxpixelzoom="2.0" fovmin="80" fovmax="120" limitview="auto"/>' +
                    '<preview url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/preview.jpg"/>' +
                    '<image type="CUBE" multires="true" tilesize="512" if="!webvr.isenabled">' +
                    '<level tiledimagewidth="1024" tiledimageheight="1024">' +
                    '<cube url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/%s/l1/%v/l1_%s_%v_%h.jpg"/>' +
                    '</level>' +
                    '</image>' +
                    '<image if="webvr.isenabled"><cube url="images/panos/<?= str_replace("_","-",$row3["panaroma_url"]) ?>.tiles/vr/pano_%s.jpg"/></image>' +
                    '<events name="sceneevents" onloadcomplete="js(sceneLoaded())" />' +
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
                $(".loadingIcon").fadeOut(fadeInterval);
            }
        }
        
        function sceneLoaded() {
            $("#panorama_title").val("");
            $("#panorama_description").val("");
            $("#default_h").val("");
            $("#default_v").val("");
            $("#default_fov").val("");

            $("#hotspot_title").val("");
            $("#hotspot_default_h").val("");
            $("#hotspot_default_v").val("");
            $("#targetPanorama").val($("#targetPanorama option:first").val());

            $("#panorama_title").val(krpano.get("scene[get(xml.scene)].title"));
            $("#panorama_description").val(krpano.get("scene[get(xml.scene)].description"));
            $("#default_h").val(krpano.get("view.hlookat"));
            $("#default_v").val(krpano.get("view.vlookat"));
            $("#default_fov").val(krpano.get("view.fov"));
        }

        $("#default_fov").on("change", function() {
            krpano.call("lookto(" + krpano.get("view.hlookat") + "," + krpano.get("view.vlookat") + "," + $(this).val() + ")");
        });

        $("#default_h").on("change", function() {
            krpano.call("lookto(" + $(this).val() + "," + krpano.get("view.vlookat") + "," + krpano.get("view.fov") + ")");
            $("#hotspot_default_h").val($(this).val());
        });

        $("#default_v").on("change", function() {
            krpano.call("lookto(" + krpano.get("view.hlookat") + "," + $(this).val() + "," + krpano.get("view.fov") + ")");
            $("#hotspot_default_v").val($(this).val());
        });

        $("#hotspot_default_h").on("change", function() {
            krpano.set("hotspot[" + currentHotspot + "].ath", $(this).val());
        });

        $("#hotspot_default_v").on("change", function() {
            krpano.set("hotspot[" + currentHotspot + "].atv", $(this).val());
        });



        $("#pano").on("mouseup", function() {
            $("#default_h").val(krpano.get("view.hlookat"));
            $("#default_v").val(krpano.get("view.vlookat"));
            $("#default_fov").val(krpano.get("view.fov"));

            $("#hotspot_default_h").val(krpano.get("view.hlookat"));
            $("#hotspot_default_v").val(krpano.get("view.vlookat"));
        });
        currentHotspot = "";

        function remove_all_hotspots() {
            $(".loadingIcon").fadeIn(fadeInterval);
            $.post("savePanoDetails.php", {
                    type: "clear_all_hotspot",
                    panaroma_id: krpano.get("scene[get(xml.scene)].pano_id"),
                    
                })
                .done(function(data) {
                    if (data == "done") {
                        $(".loadingIcon").fadeOut(fadeInterval);
                        if (krpano) {
                krpano.call("loop(hotspot.count GT 0, removehotspot(0) );");
            }
                    } else {
                        console.log("error in update");
                    }
                });
        }

        function remove_current_hotspot() {
            if (krpano) {
                //krpano.call("loop(hotspot.count GT 0, if(hotspot.name == " + currentHotspot + ") removehotspot(0) );");
                krpano.call("removehotspot(" + currentHotspot + ");");

                $("#hotspot_title").val("");
                $("#hotspot_default_h").val("");
                $("#hotspot_default_v").val("");

                $("#targetPanorama").val($("#targetPanorama option:first").val());
            }
        }

        $('#targetPanorama').on("change", function() {
            krpano.set("hotspot[" + currentHotspot + "].onclick", function(hs) {
                krpano.call("loadscene(pano_" + $('#targetPanorama').find(":selected").val() + ")");
            }.bind(null, hs_name));
        });


        function add_hotspot() {
            if (krpano) {
                var h = krpano.get("view.hlookat");
                var v = krpano.get("view.vlookat");
                currentHotspot = "hs" + ((Date.now() + Math.random()) | 0); // create unique/randome name
                hs_name = currentHotspot;
                krpano.call("addhotspot(" + hs_name + ")");
                krpano.set("hotspot[" + hs_name + "].url", "krpano/templates/xml/skin/vtourskin_hotspot.png");
                krpano.set("hotspot[" + hs_name + "].ath", h);
                krpano.set("hotspot[" + hs_name + "].atv", v);
                krpano.set("hotspot[" + hs_name + "].scale", "0.7");
                krpano.set("hotspot[" + hs_name + "].distorted", true);

                if (krpano.get("device.html5")) {
                    krpano.set("hotspot[" + hs_name + "].onclick", function(hs) {
                        krpano.call("loadscene(pano_" + $('#targetPanorama').find(":selected").val() + ")");
                    }.bind(null, hs_name));
                } else {
                    //flash is not supported
                }
            }
        }

        function set_panorama_title() {
            $(".loadingIcon").fadeIn(fadeInterval);
            $.post("savePanoDetails.php", {
                    type: "set_pano_title",
                    panaroma_title: $("#panorama_title").val(),
                    panaroma_id: krpano.get("scene[get(xml.scene)].pano_id")
                })
                .done(function(data) {
                    $(".loadingIcon").fadeOut(fadeInterval);
                    if (data == "done") {
                        console.log("success");
                    } else {
                        console.log("error in update");
                    }
                });
        }

        function set_short_description() {
            $(".loadingIcon").fadeIn(fadeInterval);
            $.post("savePanoDetails.php", {
                    type: "set_pano_description",
                    panaroma_description: $("#panorama_description").val(),
                    panaroma_id: krpano.get("scene[get(xml.scene)].pano_id")
                })
                .done(function(data) {
                    $(".loadingIcon").fadeOut(fadeInterval);
                    if (data == "done") {
                        console.log("success");
                    } else {
                        console.log("error in update");
                    }
                });
        }
        function set_default_view() {
            $(".loadingIcon").fadeIn(fadeInterval);
            $.post("savePanoDetails.php", {
                    type:"set_default_view",
                    default_fov: $("#default_fov").val(),
                    default_h: $("#default_h").val(),
                    default_v: $("#default_v").val(),
                    panaroma_id: krpano.get("scene[get(xml.scene)].pano_id")
                })
                .done(function(data) {
                    $(".loadingIcon").fadeOut(fadeInterval);
                    if (data == "done") {
                        console.log("success");
                    } else {
                        console.log("error in update");
                    }
                });
        }    
        function save_hotspot() {
            $(".loadingIcon").fadeIn(fadeInterval);
            $.post("savePanoDetails.php", {
                    type: "save_hotspot",
                    hotspot_title: $("#hotspot_title").val(),
                    panaroma_id: krpano.get("scene[get(xml.scene)].pano_id"),
                    hotspot_default_h: $("#hotspot_default_h").val(),
                    hotspot_default_v: $("#hotspot_default_v").val(),
                    target_panaroma_id: $('#targetPanorama').find(":selected").val()
                })
                .done(function(data) {
                    $(".loadingIcon").fadeOut(fadeInterval);
                    if (data == "done") {
                        console.log("success");
                    } else {
                        console.log("error in update");
                    }
                });
        }
    </script>

</body>

</html>
