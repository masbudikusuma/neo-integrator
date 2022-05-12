<?php

$query = "SELECT * from insertmatkulkurikulum where  err_no is null or err_no != '0' order by id ASC";
// echo $query;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$data = array(
				'id_kurikulum'  => $x['id_kurikulum'],
				'id_matkul'  => $x['id_matkul'],
				'semester'  => $x['semester'],
				'sks_mata_kuliah'  => $x['sks_mata_kuliah'],
				'sks_tatap_muka'  => $x['sks_tatap_muka'],
				'sks_praktek'  => $x['sks_praktek'],
				'sks_praktek_lapangan'  => $x['sks_praktek_lapangan'],
				'sks_simulasi'  => $x['sks_simulasi'],
				'apakah_wajib'  => $x['apakah_wajib'],

			);
			print_r($data);
			$request = $ws->prep_insert("InsertMatkulKurikulum",$data);
			$ws_result = $ws->run($request);
			$ws->view($ws_result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_code == 0){
	$id_kurikulum = $ws_result[1]['data']["id_kurikulum"];
	$id_mk = $ws_result[1]['data']["id_matkul"];
	// print_r("\n".$id." - ID Kurikulum : ".$id_kurikulum." - ID MK : ". $id_mk);


}else {
	// print_r("\n".$id." - : ".$err_code." - ".$err_desc);
}
$update = "UPDATE insertmatkulkurikulum 
SET err='".$err_code."', desc='".$err_desc."' WHERE  
id_kurikulum='".$x['id_kurikulum']."' AND id=".$id.";";
mysqli_query($db, $update);

// print_r($data);

}
}else {
	echo "\ndata tidak ditemukan";
}





?>
