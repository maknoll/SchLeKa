<?php
include('includes/db.php');

$db = connect();

if (isset($_GET['question']))
	$id = $_GET['question'];
else
	$id = 1;

$result = pg_query($db, "SELECT * FROM questions WHERE ID=$id");

$values = pg_fetch_assoc($result);

disconnect($db);

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
  <p><?php echo(nl2br($values['question'])); ?></p>
  <nav>
   <ul>
    <li><a href="?question=<?php echo($id-1); ?>">vorherige Frage</a></li>
    <li><a href="#" onclick="showSolution()">Antwort</a></li>
	<li><a href="change_form.php?question=<?php echo($id); ?>">ändern</a></li>
    <li><a href="new_form.php">neu</a></li>
    <li><a href="?question=<?php echo($id+1); ?>">nächste Frage</a></li>
   </ul>
  </nav>
  <div class="solution" id="solution"><?php echo(nl2br($values['solution'])); ?></div>
  </div>
 </body>
</html>
