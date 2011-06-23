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
   <form action="new.php" method="POST">
    
	<p>Frage</p>
    <p><textarea name="question" cols="64" rows="8"> </textarea></p>

	<p>Lösung</p>
	<p><textarea name="solution" cols="64" rows="8"> </textarea></p>
	
	<p>
	Vorlesung <input name="lecture" type="text" size="32" maxlength="32">
	Foliennummer <input name="slide" type="text" size="4" maxlength="4">
	</p>

	<p><input type="submit" value="Senden"><p>

   </form>
   
  <div>
 </body>
</html>
