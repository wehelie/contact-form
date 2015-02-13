<?php
session_start();

require_once 'libs/phpmailer/PHPMAILERAutoload.php'; 

$errors = [];

if (isset($_POST['name'],$_POST['email'], $_POST['message'])) {
	$fields = [
		'name' => $_POST['name'],
		'email'=> $_POST['email'],
		'message'=> $_POST['message']
	 ];
	 foreach( $fields as $field => $data) {
	 	if(empty($data)) {
	 		$errors[] = 'The ' . $field . 'field is required';
	 	}
	 }

	 if (empty($errors)) {
	 	$mail = new PHPMailer;
	 	$mail ->isSMTP();
	 	$mail -> SMTPAuth = true; 

	 	// $mail -> SMTPDebug = 1; 
	 	$mail -> Host = 'smtp.gmail.com';
	 	$mail -> Username = 'fakeemail1@gmail.com';
	 	$mail -> Password = 'password';
	 	$mail ->SMTPSecure = 'ssl'; 
	 	$mail ->Port=465;
	 	$mail -> isHTML(); 
	 	$mail ->Subject = 'Contact Form Submitted'; 

	 	$mail -> Body = 'FROM: '. $fields['name'] .' ('.$fields['email'].') <p>'.$fields['message'].'</p>';

	 	$mail->FromName =  'Contact';
	 	$mail ->AddAddress('fakeemail@gmail.com',  'John DOe'); 

	 	if ( $mail ->send()) {
	 		header('Location: complete.php'); 
	 		die();
	 	} else {
	 		$errors[] = 'Could not send email. TRY AGAIN LATER'; 
	 	}
	 }

}else {
	$errors[] = 'Something went wrong';
}

// stores sessions errors of any field
$_SESSION['errors'] = $errors; 

// stores data after submission so it is not lost
$_SESSION['fields'] = $fields; 

header('Location: index.php'); 