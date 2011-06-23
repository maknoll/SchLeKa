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
   
   <form action="new.php" method="POST">
    
	<p>Frage</p>
    <p><textarea name="question" cols="64" rows="8"><?php echo ($sr && !$rd['form_ok']) ? $rd['posted_form_data']['question'] : '' ?></textarea></p>

	<p>Lösung</p>
	<p><textarea name="solution" cols="64" rows="8"><?php echo ($sr && !$rd['form_ok']) ? $rd['posted_form_data']['solution'] : '' ?></textarea></p>
	
	<p>
	Vorlesung
	<select name="lecture" id="lecture">
		<option value="1" selected="<?php echo ($sr &&$rd['posted_form_data']['lecture'] == '1') ? "selected='selected'" : '' ?>">WS 01 - Einführung</select>
		<option value="2" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '2') ? "selected='selected'" : '' ?>">WS 02 - Erfolg im Studium</select>
		<option value="3" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '3') ? "selected='selected'" : '' ?>">WS 03 - Lerntechniken</select>
		<option value="4" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '4') ? "selected='selected'" : '' ?>">WS 04 - Ziele 1</select>
		<option value="5" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '5') ? "selected='selected'" : '' ?>">WS 05 - Ziele 2</select>
		<option value="6" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '6') ? "selected='selected'" : '' ?>">WS 06 - Zeitmanagement 1</select>
		<option value="7" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '7') ? "selected='selected'" : '' ?>">WS 07 - Zeitmanagement 2</select>
		<option value="8" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '8') ? "selected='selected'" : '' ?>">WS 08 - Präsentationen 1</select>
		<option value="9" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '9') ? "selected='selected'" : '' ?>">WS 09 - Präsentationen 2 (Visualisierung)</select>
		<option value="10" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '10') ? "selected='selected'" : '' ?>">WS 10 - Präsentationen 3 (Auftritt)</select>
		<option value="11" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '11') ? "selected='selected'" : '' ?>">WS 11 - Ideen generieren</select>
		<option value="12" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '12') ? "selected='selected'" : '' ?>">SS 01 - Projektmanagement</select>
		<option value="13" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '13') ? "selected='selected'" : '' ?>">SS 02 - Teamwork</select>
		<option value="14" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '14') ? "selected='selected'" : '' ?>">SS 03 - Diskussionen leiten</select>
		<option value="15" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '15') ? "selected='selected'" : '' ?>">SS 04 - Temperamente</select>
		<option value="16" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '16') ? "selected='selected'" : '' ?>">SS 05 - Die vier Seiten einer Nachricht</select>
		<option value="17" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '17') ? "selected='selected'" : '' ?>">SS 06 - Innovation and Entrepreneurship</select>
		<option value="18" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '18') ? "selected='selected'" : '' ?>">SS 07 - Erfolg 1</select>
		<option value="19" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '19') ? "selected='selected'" : '' ?>">SS 08 - Erfolg 2</select>
		<option value="20" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '20') ? "selected='selected'" : '' ?>">SS 09 - Wissenschaftliches Arbeiten 1</select>
		<option value="21" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '21') ? "selected='selected'" : '' ?>">SS 10 - Wissenschaftliches Arbeiten 2</select>
		<option value="22" selected="<?php echo ($sr && $rd['posted_form_data']['lecture'] == '22') ? "selected='selected'" : '' ?>">SS 11 - Informatik-Ethik</select>
	</select>
	
	Foliennummer <input name="slide" type="text" size="4" maxlength="4" value="<?php echo $sr ? $rd['posted_form_data']['slide'] : '' ?>">
	</p>

	<p><input type="submit" value="Senden"><p>

   </form>
   
  <div>
 </body>
</html>