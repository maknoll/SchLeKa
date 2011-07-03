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
  <script type="text/javascript" src="script/jquery.js"></script>
  <script>
  	$(document).ready(function(){
  		
  		$('#lectureset').hide();
  		
     	$('#searchbar a.lectureset').click(function() {
  			$('#lectureset').toggle();
		});
		
		$('#searchbar a.search').click(function() {
  			alert('So schnell bin ich nun auch wieder nicht...');
		});
    });
  </script>
 </head>
 <body>
   <div id="wrapper">
    <div id="searchbar">
      <a href="#" class="menu lectureset">Foliensatz suchen</a>
      <div id="lectureset">
      	Foliensatz-Filter aktivieren
      	<ul>
      	  <li><a href="?lecture=1" >WS 01 - Einführung</a></li>
	  		<li><a href="?lecture=2" >WS 02 - Erfolg im Studium</a></li>
	  		<li><a href="?lecture=3" >WS 03 - Lerntechniken</a></li>
	  		<li><a href="?lecture=4" >WS 04 - Ziele 1</a></li>
	  		<li><a href="?lecture=5" >WS 05 - Ziele 2</a></li>
	  		<li><a href="?lecture=6" >WS 06 - Zeitmanagement 1</a></li>
	  		<li><a href="?lecture=7" >WS 07 - Zeitmanagement 2</a></li>
	  		<li><a href="?lecture=8" >WS 08 - Präsentationen 1</a></li>
	  		<li><a href="?lecture=9" >WS 09 - Präsentationen 2 (Visualisierung)</a></li>
	  		<li><a href="?lecture=10">WS 10 - Präsentationen 3 (Auftritt)</a></li>
	  		<li><a href="?lecture=11">WS 11 - Ideen generieren</a></li>
	  		<li><a href="?lecture=12">SS 01 - Projektmanagement</a></li>
	  		<li><a href="?lecture=13">SS 02 - Teamwork</a></li>
	  		<li><a href="?lecture=14">SS 03 - Diskussionen leiten</a></li>
	  		<li><a href="?lecture=15">SS 04 - Temperamente</a></li>
	  		<li><a href="?lecture=16">SS 05 - Die vier Seiten einer Nachricht</a></li>
	  		<li><a href="?lecture=17">SS 06 - Innovation and Entrepreneurship</a></li>
	  		<li><a href="?lecture=18">SS 07 - Erfolg 1</a></li>
	  		<li><a href="?lecture=19">SS 08 - Erfolg 2</a></li>
	  		<li><a href="?lecture=20">SS 09 - Wissenschaftliches Arbeiten 1</a></li>
	  		<li><a href="?lecture=21">SS 10 - Wissenschaftliches Arbeiten 2</a></li>
	  		<li><a href="?lecture=22">SS 11 - Informatik-Ethik</a></li>
      	</ul>
      </div>
      <a href="#" class="menu search">Suche</a>
      <span id="search"></span>
    </div>
    <div id="question">
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
   </div>
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
