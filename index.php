<?php
include('includes/db.php');
$db = connect();

$result = pg_query($db, "SELECT * FROM questions");

$values = pg_fetch_assoc($result);

?>

<!doctype html> 
<html>
 <head>
  <meta charset="utf-8" /> 
  <title>Schlüko Lernkarten</title>
  <link rel="stylesheet" href="style/typoframework.css" type="text/css" /> 
  <link rel="stylesheet" href="style/main.css" type="text/css" />
  <script type="text/javascript" src="script/ajax.js"></script>	
 </head>
 <body>
  <div>
  <p><?php echo($values['question']); ?></p>
	<nav>
  <ul>
	<li><a href="?question=1">vorherige Frage</a></li>
	<li><a href="#" onclick="showSolution()">Antwort</a></li>
  <li><a href="?question=2&change">ändern</a></li>
	<li><a href="?new">neu</a></li>
	<li><a href="?question=3">nächste Frage</a></li>
	<ul>
	</nav>
  <p class="solution" id="solution"><?php echo($values['solution']); ?><br>
  Ein Perspektivwechsel überwindet Denkblokaden</p>
  <div>
 </body>
</html>
