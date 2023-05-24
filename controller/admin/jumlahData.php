<?php

function jumlahPengajuan()
{
    $data = new PerintahSelect;
    $jumlahPengajuan = [0, 0, 0];
    for ($i = 0; $i < count($jumlahPengajuan); $i++) {
        $jumlahPengajuan[$i] = $data->jumlahData($data->ambilDataTertentu("id_aplikasi", "aplikasi", "notif = $i"));
    }
    return $jumlahPengajuan;
}

function jumlahAkun()
{
    $data = new PerintahSelect;
    $jumlahAkun = [0, 0];
    for ($i = 0; $i < count($jumlahAkun); $i++) {
        $level = $i + 1;
        $jumlahAkun[$i] = $data->jumlahData($data->ambilDataTertentu("id_user", "users", "level = $level"));
    }
    return $jumlahAkun;
}
