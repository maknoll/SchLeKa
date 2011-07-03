<?php
include('includes/db.php');

$db = connect();

if (isset($_GET['question']))
	$id = pg_escape_string($_GET['question']);
else
	$id = 1;

$previous = pg_fetch_result(pg_query($db, "SELECT max(ID) FROM questions WHERE ID < $id"),0);
$next = pg_fetch_result(pg_query($db, "SELECT min(ID) FROM questions WHERE ID > $id"),0);

if (empty($previous))
	$previous = pg_fetch_result(pg_query($db, "SELECT max(ID) FROM questions"),0);

if (empty($next))
	$next = pg_fetch_result(pg_query($db, "SELECT min(ID) FROM questions"),0);

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
    <li><a href="?question=<?php echo($previous); ?>">vorherige Frage</a></li>
    <li><a href="#" onclick="showSolution()">Antwort</a></li>
	<li><a href="change_form.php?question=<?php echo($id); ?>">ändern</a></li>
    <li><a href="new_form.php">neu</a></li>
    <li><a href="?question=<?php echo($next); ?>">nächste Frage</a></li>
   </ul>
  </nav>
  <div class="solution" id="solution"><?php echo(nl2br($values['solution'])); ?></div>
 </body>

<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.martinknoll.org/" : "http://piwik.martinknoll.org/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 3);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://piwik.martinknoll.org/piwik.php?idsite=3" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->

</html>
