<?php

function connect() {
	$db = pg_connect("host=localhost dbname=schleka user=www-data");
	return $db;
}

function disconnect($db) {
	pg_close($db);
}

?>
