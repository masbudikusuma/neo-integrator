<?php

if (isset($_GET['module']))	{$module = $_GET['module'];}		else {$module = "default";}

if (isset($_GET["exec"]))	{$exec = $_GET["exec"];}			else {$exec = "-";}

$sql = "SELECT * from sys_modul where module = '$module' AND exec = '$exec'";
$result = mysqli_query($db,$sql) or die(mysqli_error($db));
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$ModuleName = $row["nama"];
			include $row["url"];
			// echo $sql;
			
	}
} else if ($module = 'cekAKM') {$ModuleName = "CEK Aktifitas Kuliah Mahasiswa";	include "content/tool/cekAKM.php";}
else {
	// echo 'gagal';
	// include('content/h2h/tagihanuploadtemp.php');
	// echo $sql;
	// echo $result->num_rows;
}

?>
