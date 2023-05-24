<?php

    $file = $_GET["file"];
    $filepath = "../../dokumen/".$file;
    
    // Header
    header("Content-type: application/pdf");
    // Membaca file di browser
    readfile($filepath);

?>