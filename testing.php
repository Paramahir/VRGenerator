<?php

    $output =  shell_exec('.\krpano\krpanotools64.exe makepano -config="templates/vtour-vr-new.config" .\images\54757584-36D6-4AE0-AB28-DA1A92427B94.jpg');
    $index = strlen($output);
echo $output;
    //echo substr($output,$index - 7,4);

?>