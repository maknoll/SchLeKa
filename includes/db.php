<?php

function connect() {
	$db = pg_connect("dbname=schleka");
	return $db;
}

function disconnect($db) {
	pg_close($db);
}

?>
