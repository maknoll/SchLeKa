<?php

function connect() {
	$db = pg_connect("dbname=ieleka");
	return $db;
}

function disconnect($db) {
	pg_close($db);
}

?>
