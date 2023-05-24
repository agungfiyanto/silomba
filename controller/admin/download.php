<?php

    $file = $_GET["file"];
    $filepath = "../../dokumen/".$file;
    
    header("Content-Disposition: attachment; filename=$file");
    readfile($filepath);

?>