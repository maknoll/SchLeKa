<?php
	session_start();
	//init variables  
	$rd = array();  
	$sr = false;  
  
	if(isset($_SESSION['returndata'])) {  
		$rd = $_SESSION['returndata'];  
		$sr = true;
	}
	session_destroy();

	if(!$sr) {
		include('includes/db.php');
		
		$db = connect();
		
		$id = isset($_GET['question']) ? pg_escape_string($_GET['question']) : 1;
		
		$result = pg_query($db, "SELECT * FROM questions WHERE ID=$id");
		
		$values = pg_fetch_assoc($result);
		
		disconnect($db);
	}

?>
<!doctype html> 
<html>
 <head>
  <meta charset="utf-8" /> 
  <title>Schlüko Lernkarten</title>
  <link rel="stylesheet" href="style/typoframework.css" type="text/css" /> 
  <link rel="stylesheet" href="style/main.css" type="text/css" />
 </head>
 <body>
  <div id="form">
   <ul id="errors" style="display:<?php echo ($sr && !$rd['form_ok']) ? 'block' : 'none'; ?>">  
	<li id="info">Folgende Fehler sind aufgetreten:</li>
	<?php
	    if(isset($rd['errors']) && count($rd['errors']) > 0) :
	    	foreach($rd['errors'] as $error) : ?>
	    		<li><?php echo $error ?></li>  
	<?php  
	    	endforeach;  
	    endif;  
	?>
   </ul>
   
   <p id="success"  style="display:<?php echo ($sr && $rd['form_ok']) ? 'block' : 'none'; ?>">Vielen Dank! SchLeKa erfolgreich gespeichert.</p> 
   
   <form action="change.php" method="POST">
   	<input type="hidden" name="id" value="<?php echo($values['id']) ?>">
	<p>Frage</p>
    <p><textarea name="question" cols="64" rows="8"><?php echo ($sr && !$rd['form_ok']) ? $rd['posted_form_data']['question'] : $values['question'] ?></textarea></p>

	<p>Lösung</p>
	<p><textarea name="solution" cols="64" rows="8"><?php echo ($sr && !$rd['form_ok']) ? $rd['posted_form_data']['solution'] : $values['solution'] ?></textarea></p>
	
	<p>
	Vorlesung
	<select name="lecture" id="lecture">
		<option value="1"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '1' ) || $values['lecture'] == '1' ) ? "selected='selected'" : '' ?>>WS 01 - Einführung</option>
		<option value="2"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '2' ) || $values['lecture'] == '2' ) ? "selected='selected'" : '' ?>>WS 02 - Perspektivwechsel I</option>
		<option value="3"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '3' ) || $values['lecture'] == '3' ) ? "selected='selected'" : '' ?>>WS 03 - Perspektivwechsel II</option>
		<option value="4"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '4' ) || $values['lecture'] == '4' ) ? "selected='selected'" : '' ?>>WS 04 - Perspektivwechsel III</option>
		<option value="5"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '5' ) || $values['lecture'] == '5' ) ? "selected='selected'" : '' ?>>WS 05 - Clustering und Ausbau</option>
		<option value="6"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '6' ) || $values['lecture'] == '6' ) ? "selected='selected'" : '' ?>>WS 06 - Bewertung und Selektion</option>
		<option value="7"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '7' ) || $values['lecture'] == '7' ) ? "selected='selected'" : '' ?>>WS 07 - Vertiefung Perspektivwechsel</option>
		<option value="8"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '8' ) || $values['lecture'] == '8' ) ? "selected='selected'" : '' ?>>WS 08 - Klass. Kreativistätstechnik</option>
		<option value="9"  <?php echo (($sr && $rd['posted_form_data']['lecture'] == '9' ) || $values['lecture'] == '9' ) ? "selected='selected'" : '' ?>>WS 09 - Ideenbewertungsprozess</option>
		<option value="10" <?php echo (($sr && $rd['posted_form_data']['lecture'] == '10') || $values['lecture'] == '10') ? "selected='selected'" : '' ?>>WS 10 - Werbeideen</option>
	</select>

	Foliennummer
	<input name="slide" type="text" size="4" maxlength="4" value="<?php echo $sr ? $rd['posted_form_data']['slide'] : $values['slide'] ?>">
	</p>

	<p><input type="submit" value="Senden"><p>

   </form>
   
  <div>
 </body>
</html>