<?php

$query = "SELECT * from insertmatkulkurikulum where err_no is null or err_no != '0' order by id ASC";
$hasil = mysqli_query($db, $query);
if($hasil && mysqli_num_rows($hasil) > 0 ){
    while($x = mysqli_fetch_array($hasil)){
        $id = intval($x['id']);
        $data = array(
            'id_kurikulum'          => $x['id_kurikulum'],
            'id_matkul'             => $x['id_matkul'],
            'semester'              => $x['semester'],
            'sks_mata_kuliah'       => $x['sks_mata_kuliah'],
            'sks_tatap_muka'        => $x['sks_tatap_muka'],
            'sks_praktek'           => $x['sks_praktek'],
            'sks_praktek_lapangan'  => $x['sks_praktek_lapangan'],
            'sks_simulasi'          => $x['sks_simulasi'],
            'apakah_wajib'          => $x['apakah_wajib'],
        );
        print_r($data);
        $request = $ws->prep_insert("InsertMatkulKurikulum", $data);
        $ws_result = $ws->run($request);
        $ws->view($ws_result);

        $err_code = isset($ws_result[1]["error_code"]) ? $ws_result[1]["error_code"] : (isset($ws_result[1]["code"]) ? $ws_result[1]["code"] : '999');
        $err_desc = isset($ws_result[1]["error_desc"]) ? $ws_result[1]["error_desc"] : (isset($ws_result[1]["message"]) ? $ws_result[1]["message"] : 'Unknown error');

        $up_stmt = mysqli_prepare($db, "UPDATE insertmatkulkurikulum SET err_no = ?, err_desc = ? WHERE id = ?");
        if ($up_stmt) {
            $err_code_str = (string)$err_code;
            $err_desc_str = (string)$err_desc;
            mysqli_stmt_bind_param($up_stmt, "ssi", $err_code_str, $err_desc_str, $id);
            mysqli_stmt_execute($up_stmt);
            mysqli_stmt_close($up_stmt);
        }

        log_insert("InsertMatkulKurikulum", $data, $err_code, $err_desc);
    }
} else {
    echo "\ndata tidak ditemukan";
}
?>