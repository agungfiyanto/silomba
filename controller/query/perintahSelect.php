<?php
require_once "kelolahData.php";
class PerintahSelect extends KelolahData
{
    var String $query;

    function ambilData($kolom, $tabel)
    {
        $this->query = "SELECT $kolom FROM $tabel";
        return mysqli_query(dbKoneksi(), $this->query);
    }

    function ambilDataTertentu($kolom, $tabel, $kondisi)
    {
        $this->query = "SELECT $kolom FROM $tabel WHERE $kondisi";
        return mysqli_query(dbKoneksi(), $this->query);
    }
}
