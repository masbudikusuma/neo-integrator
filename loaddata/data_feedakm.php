<?php
// Controller For DataTable ServerSide
// include "component/config.php";
    $tablecoloms = "nim,nama_mahasiswa,nama_program_studi,id_semester,nama_status_mahasiswa,biaya_kuliah_smt,ipk,sks_total";
    $table = 'getakm';
    $line = explode(",", $tablecoloms);
    // $columns = array($line);

    $querycount = $db->query("SELECT count(*) as jumlah FROM $table");
    $datacount = $querycount->fetch_array();
      $totalData = $datacount['jumlah'];
      $totalFiltered = $totalData;
      $limit = isset($_POST['length']) ? intval($_POST['length']) : 10;
      $start = isset($_POST['start']) ? intval($_POST['start']) : 0;
      if ($limit <= 0) $limit = 10;
      if ($start < 0) $start = 0;

      $order_col_idx = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
      $order = isset($line[$order_col_idx]) ? $line[$order_col_idx] : $line[0];
      // Pastikan nama kolom hanya alphanumeric dan underscore
      $order = preg_replace('/[^a-zA-Z0-9_]/', '', $order);
      $dir = (isset($_POST['order'][0]['dir']) && strtolower($_POST['order'][0]['dir']) === 'desc') ? 'DESC' : 'ASC';

      if(empty($_POST['search']['value'])) {
          $query = $db->query("SELECT * FROM `$table` ORDER BY `$order` $dir LIMIT $limit OFFSET $start");
      } else {
          $search = $db->real_escape_string($_POST['search']['value']);
          $query = $db->query("SELECT * FROM `$table` WHERE CONCAT(".$tablecoloms.") LIKE '%$search%' ORDER BY `$order` $dir LIMIT $limit OFFSET $start");
          $querycount = $db->query("SELECT count(*) as jumlah FROM `$table` WHERE CONCAT(".$tablecoloms.") LIKE '%$search%'");
          $datacount = $querycount->fetch_array();
          $totalFiltered = $datacount['jumlah'];
      }

      $data = array();
      if(!empty($query))
      {
          $no = $start + 1;
          while ($r = $query->fetch_array())
          {
              $nestedData['no'] = $no;
              $nestedData['nim'] = "<pre>".$r['nim'];
              $nestedData['nama_mahasiswa'] = "<pre>".$r['nama_mahasiswa'];
              $nestedData['nama_program_studi'] = "<pre>".$r['nama_program_studi'];
              $nestedData['id_semester'] = "<pre>".$r['id_semester'];
              $nestedData['nama_status_mahasiswa'] = "<pre>".$r['nama_status_mahasiswa'];
              $nestedData['biaya_kuliah_smt'] = "<pre>".$r['biaya_kuliah_smt'];
              $nestedData['sks_total'] = "<pre>".$r['sks_total'];
              $nestedData['ipk'] = "<pre>".$r['ipk'];
              $data[] = $nestedData;
              $no++;
          }
      }

      $json_data = array(
                  "draw"            => intval($_POST['draw']),
                  "recordsTotal"    => intval($totalData),
                  "recordsFiltered" => intval($totalFiltered),
                  "data"            => $data
                  );
      echo json_encode($json_data);


?>