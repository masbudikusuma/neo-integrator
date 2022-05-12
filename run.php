<?php
$output = shell_exec('curl "http://neo-in/neo-in/app/exec.php?act=getKelasKuliah"');
  
// Display the list of all file
// and directory
echo "<pre>$output</pre>";
?>