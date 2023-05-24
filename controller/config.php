<?php
function dbKoneksi()
{
	$koneksi = mysqli_connect("localhost", "root", "", "silomba");

	if ($koneksi) return $koneksi;

	die("Koneksi gagal:" . mysqli_connect_error());
	return mysqli_connect_error();
}
