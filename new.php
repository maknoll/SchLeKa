<?php
if(isset($_POST)) {
	include('includes/db.php');
	
	
	//form validation vars
    $formok = true;
    $errors = array();
	
    //form data
    $question = pg_escape_string(nl2br($_POST['question']));
    $solution = pg_escape_string(nl2br($_POST['solution']));
    $lecture = pg_escape_string($_POST['lecture']);
    $slide = pg_escape_string($_POST['slide']);
	
	if(empty($question)) {
		$formok = false;
		$error[] = "Du musst eine Frage angeben!";
	} elseif(strlen($question) < 11) {
		$formok = false;
		$error[] = "Deine Frage sollte mindestens 10 Zeichen lang sein.";
	}
	
	if(empty($solution)) {
		$formok = false;
		$error[] = "Du musst eine Antwort angeben!";
	} elseif(strlen($solution) < 11) {
		$formok = false;
		$error[] = "Deine Antwort sollte mindestens 10 Zeichen lang sein.";
	}
	
	if($formok) {
      $db = connect();
	  
      // insert into db
      pg_query("INSERT INTO questions (question, solution, lecture, slide) VALUES ('{$question}', '{$solution}', '{$lecture}', {$slide})");

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
    
    
    //set session variables
    session_start();
    $_SESSION['returndata'] = $returndata;

    //redirect back to form
    header('location: ' . $_SERVER['HTTP_REFERER']);
}