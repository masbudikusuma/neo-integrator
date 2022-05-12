<?php
	require_once "ws_pddikti.php";
	require_once "config.php";
	require_once "function.php";
ob_end_flush();
ob_implicit_flush();


get_token($token);
print_r($token);
?>
