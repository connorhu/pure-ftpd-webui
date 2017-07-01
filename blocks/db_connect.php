<?php
require ("config.php");
$link = FALSE;
$link = mysqli_connect ("$mysql_host", "$mysql_webui_user", "$mysql_webui_passwd");
if (!$link) {
	$info = "<p align=\"center\" class=\"table_error\">Could not connect:" . mysqli_error($link) . "</p>";
	die (mysqli_error($link));
}
$table = FALSE;
$table = mysqli_select_db ($link, "$mysql_database");
if (!$table) {
	$info = "<p align=\"center\" class=\"table_error\">Could not connect:" . mysqli_error($link) . "</p>";
	die (mysqli_error($link));
}
?>
