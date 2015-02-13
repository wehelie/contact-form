<?php 

session_start(); 
require_once 'helpers/secure.php';
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
	<title>Document</title>
</head>
<body>
	<div class="wrapper">
		<div class="content">
			<div class="contact">
					
					<?php if(!empty($errors)):  ?>
						<div class="panel">
							<ul>
								<li> <?php echo implode('</li><li>',$errors); ?></li>
							</ul>
						</div>
					<?php endif; ?>
					
					<form action="contact.php" method="post">
						<label for="name">
							Your Name: 
							<input type="text" name="name" autocomplete="off" <?php echo isset($fields['name'])? 'value="'. escape($fields['name']) .' "' : '' ?>>
						</label>
						<label for="email">
							Your email address:
							<input type="text" name="email" autocomplete="off" <?php echo isset($fields['email'])? 'value="'. escape($fields['email']) .' "' : '' ?>>
						</label>
						<label for="message">
							<textarea name="message" rows="8"></textarea <?php echo isset($fields['message']) ? escape($fields['message']): '' ?>>
						</label>
						<input type="submit" value="Send">

						<p class="muted"></p>
					</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php 
session_destroy(); 
 ?>