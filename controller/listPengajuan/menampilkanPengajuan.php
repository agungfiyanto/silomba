<?php
session_start();

function dataPengajuan()
{
    $id = $_SESSION["id_user"];
    $query = new PerintahSelect;
    $isiData = $query->IsiData($query->ambilDataTertentu("*", "aplikasi", "id_user = $id"));
    return $isiData;
}
