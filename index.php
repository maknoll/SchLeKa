<?php
include('includes/db.php');

$db = connect();

if (isset($_GET['lecture']))
	$filter = "AND lecture = '". pg_escape_string($_GET['lecture']) . "'";

if (isset($_GET['question']))
	$id = pg_escape_string($_GET['question']);
else
	$id = pg_fetch_result(pg_query($db, "SELECT min(ID) FROM questions WHERE true $filter"),0);

$previous = pg_fetch_result(pg_query($db, "SELECT max(ID) FROM questions WHERE ID < $id $filter"),0);
$next = pg_fetch_result(pg_query($db, "SELECT min(ID) FROM questions WHERE ID > $id $filter"),0);

if (empty($previous))
	$previous = pg_fetch_result(pg_query($db, "SELECT max(ID) FROM questions WHERE true $filter"),0);

if (empty($next))
	$next = pg_fetch_result(pg_query($db, "SELECT min(ID) FROM questions WHERE true $filter"),0);

$result = pg_query($db, "SELECT * FROM questions WHERE ID=$id");

$values = pg_fetch_assoc($result);



disconnect($db);

// Selected Lecture

$lecture = array( "WS 01 - Einführung",
"WS 02 - Perspektivwechsel I",
"WS 03 - Perspektivwechsel II",
"WS 04 - Perspektivwechsel III",
"WS 05 - Clustering und Ausbau",
"WS 06 - Bewertung und Selektion",
"WS 07 - Vertiefung Perspektivwechsel",
"WS 08 - Klass. Kreativistätstechnik",
"WS 09 - Ideenbewertungsprozess",
"WS 10 - Werbeideen");

?>

<!doctype html> 
<html>
 <head>
  <meta charset="utf-8" /> 
  <title>Idea Engineering Lernkarten</title>
  <link rel="stylesheet" href="style/jquery-ui.css" type="text/css" />
  <link rel="stylesheet" href="style/typoframework.css" type="text/css" /> 
  <link rel="stylesheet" href="style/main.css" type="text/css" />
  <script type="text/javascript" src="script/jquery.js"></script>
  <script type="text/javascript" src="script/jquery-ui.js"></script>
  <script>
      $(document).ready(function(){

        $('#searchbar a.lectureset').click(function() {
          $('#lectureset').toggle();
        });

        $('#search').autocomplete({ 
          source: "search.php",
          minLength: 1,
          select: function( event, ui ) {
            window.location.href = '/?question=' + ui.item.id;
          }
        })
        .data( "autocomplete" )._renderItem = function( ul, item ) {
          return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a>" + highlight(item.question,$('#search').val()) + "</a>" )
            .appendTo( ul );
        };

        $('#searchbar a.search').click(function() {
          $('#search').toggle();
          $('input#search').focus();
        });

        function highlight(s, t) {
          var matcher = new RegExp("("+$.ui.autocomplete.escapeRegex(t)+")", "ig" );
          return s.replace(matcher, "<strong>$1</strong>");
        }
        
        /*Tastatur-Events*/

        $(document).keydown(function(e){
          

          switch(e.keyCode)
          {
            // user presses the left arrow
            case 37:  window.location = $('#prev').attr('href');
                  break;

            // user presses the right arrow
            case 39:  window.location = $('#next').attr('href');
                  break;
                  
            // user presses the down arrow
            case 40:  $('#solution').show();
                  break;
                  
            // user presses the up arrow
            case 38:  $('#solution').hide();
                  break;
          }
        });

      });
  </script>
 </head>
 <body>
   <div id="wrapper">
    <div id="searchbar">
      <a href="#" class="menu lectureset">Foliensatz suchen</a>
      <div id="lectureset">
      	<b>Foliensatz-Filter aktivieren</b>
      	<ul>
        	<li><a href="?lecture=1" >WS 01 - Einführung</a></li>
  	  	  <li><a href="?lecture=2" >WS 02 - Perspektivwechsel I</a></li>
  	  	  <li><a href="?lecture=3" >WS 03 - Perspektivwechsel II</a></li>
  	  	  <li><a href="?lecture=4" >WS 04 - Perspektivwechsel III</a></li>
  	  	  <li><a href="?lecture=5" >WS 05 - Clustering und Ausbau</a></li>
  	      <li><a href="?lecture=6" >WS 06 - Bewertung und Selektion</a></li>
  	  	  <li><a href="?lecture=7" >WS 07 - Vertiefung Perspektivwechsel</a></li>
  	  	  <li><a href="?lecture=8" >WS 08 - Klass. Kreativistätstechnik</a></li>
  	  	  <li><a href="?lecture=9" >WS 09 - Ideenbewertungsprozess</a></li>
  	  	  <li><a href="?lecture=10">WS 10 - Werbeideen</a></li>
      	</ul>
      </div>
      <a href="#" class="menu search">Suche</a>
      <br>
      	<input id="search" placeholder="Suchtext...">
      <br>
      <?php
      if(isset($_GET['lecture']))
         echo "Filter: " . $lecture[$_GET['lecture']-1] . "<a href='/?question=$id'><img src='img/cross.png' id='remove'></a>";
      ?>
    </div>
    <div id="question">
     <p><?php echo(nl2br($values['question'])); ?></p>
     <nav>
      <ul>
       <li><a id="prev" href="?question=<?php echo(isset($_GET['lecture']) ? $previous . "&lecture={$_GET['lecture']}" : $previous); ?>">vorherige Frage</a></li>
       <li><a id="ant" href="#" onclick="$('#solution').show();">Antwort</a></li>
     	<li><a href="change_form.php?question=<?php echo($id); ?>">ändern</a></li>
       <li><a href="new_form.php">neu</a></li>
       <li><a id="next"href="?question=<?php echo(isset($_GET['lecture']) ? $next . "&lecture={$_GET['lecture']}" : $next); ?>">nächste Frage</a></li>
      </ul>
     </nav>
     <div class="solution" id="solution"><?php echo(nl2br($values['solution'])); ?></div>
   </div>
   </div>
 </body>

<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://statistik.ludwig-jahn.com/" : "http://statistik.ludwig-jahn.com/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 18);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://statistik.ludwig-jahn.com/piwik.php?idsite=18" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->

</html>
