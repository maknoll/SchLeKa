<?php
if(isset($_POST)) {
	
	include('includes/db.php');
	
	//form validation vars
    $formok = true;
    $errors = array();
	
    //form data
    $id = pg_escape_string($_POST['id']);
    $question = pg_escape_string($_POST['question']);
    $solution = pg_escape_string($_POST['solution']);
    $lecture = pg_escape_string($_POST['lecture']);
    $slide = pg_escape_string($_POST['slide']);
	
	if(empty($question)) {
		$formok = false;
		$errors[] = "Gib bitte eine Frage ein!";
	} elseif(strlen($question) < 11) {
		$formok = false;
		$errors[] = "Gib bitte mindestens 10 Zeichen für die Frage ein.";
	}
	
	if(empty($solution)) {
		$formok = false;
		$errors[] = "Gib bitte eine Antwort ein!";
	} elseif(strlen($solution) < 11) {
		$formok = false;
		$errors[] = "Gib bitte mindestens 10 Zeichen für die Antwort ein.";
	}
	
	if(empty($slide)) {
		$slide = 0;
	}
	
	if($formok) {
      $db = connect();
	  
      // insert into db
      pg_query($db, "UPDATE questions SET question = '{$question}', solution = '{$solution}', lecture = '{$lecture}', slide = {$slide} WHERE id = {$id}");

	  disconnect($db);
	}
	
	//what we need to return back to our form
    $returndata = array(
        'posted_form_data' => array(
            'question' => $question,
            'solution' => $solution,
            'lecture' => $lecture,
            'slide' => $slide,
        ),
        'form_ok' => $formok,
        'errors' => $errors
    );
    
    if(!$formok) {
    	//set session variables
    	session_start();
    	$_SESSION['returndata'] = $returndata;
		
    	//redirect back to form
    	header('location: ' . $_SERVER['HTTP_REFERER']);
    } else {
    	//redirect back to the output
    	header('location: http://martinknoll.org/schleka/?question=' . $id );
    }
    
}