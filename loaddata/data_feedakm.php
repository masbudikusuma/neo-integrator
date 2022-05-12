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
      $limit = $_POST['length'];
      $start = $_POST['start'];
    
      $order = $line[$_POST['order']['0']['column']];
      $dir = $_POST['order']['0']['dir'];
      if(empty($_POST['search']['value']))
      {$query = $db->query("SELECT * FROM $table order by $order $dir LIMIT $limit OFFSET $start");
      }
      else {
          $search = $_POST['search']['value'];
          $query = $db->query("SELECT * FROM $table WHERE CONCAT(".$tablecoloms.") LIKE '%$search%' order by $order $dir LIMIT $limit OFFSET $start");
         $querycount = $db->query("SELECT count(*) as jumlah FROM $table WHERE CONCAT(".$tablecoloms.") LIKE '%$search%'");
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