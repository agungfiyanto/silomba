<?php
class KelolahData
{
    function isiData($data)
    {
        $isiData = [];
        while ($pemindahanIsi = mysqli_fetch_assoc($data)) {
            $isiData[] = $pemindahanIsi;
        }
        return $isiData;
    }

    function jumlahData($data)
    {
        $jumlahData = 0;
        while (mysqli_fetch_assoc($data)) {
            $jumlahData++;
        }
        return $jumlahData;
    }
}
