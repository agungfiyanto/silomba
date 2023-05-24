<?php
require_once 'config.php';
require_once 'query/perintahSelect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = koreksiInput($_POST["username"]);
	$password = koreksiInput(md5($_POST["password"]));
	$query = new PerintahSelect;
	$kondisi = "username='" . $username . "' and password='" . $password . "' limit 1";

	cekLogin($query->ambilDataTertentu('*', 'users', $kondisi));
}

function koreksiInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function cekLogin($data)
{
	$jumlah = mysqli_num_rows($data);
	$indexSession = ["id_user", "username", "email", "level"];

	if ($jumlah > 0) {
		$row = mysqli_fetch_assoc($data);
		session_start();
		for ($i = 0; $i < count($indexSession); $i++) {
			$_SESSION[$indexSession[$i]] = $row[$indexSession[$i]];
		}

		if ($_SESSION["level"] == 1) {
			header("Location:view/admin");
			exit;
		} else {
			header("Location: index.php");
			exit;
		}
	} else {
		echo "<script>
				alert('nama dan sandi anda salah');
			</script>";
	}
}
