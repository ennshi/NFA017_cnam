<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Formulaire de contact</title>
		<style>
		body{
			padding-left: 10px;
			font-family: Arial, sans-serif;
		}
			label {
				width: 130px;
				display: inline-block;
			}
			button{
				margin-left: 130px;
				width: 80px;
				height: 30px;
			}
			div {
				margin-top: 20px;
			}
		</style>
		<script>
			document.addEventListener('keyup', function() {
				let nameInput = document.getElementById('name').value;
				let emailInput = document.getElementById('email').value;
				let sujetInput = document.getElementById('sujet').value;
				let messInput = document.getElementById('message').value;
				if (nameInput != "" && emailInput != "" && messInput != "" && sujetInput != "") {
				document.getElementById('envoyer').removeAttribute('disabled');
				} 
				else {
				document.getElementById('envoyer').setAttribute('disabled', null); 
				}
			}); 
		</script>
	</head>
	<body>
			<?php 
			$showForm = true;
			$name = "";
			$sujet = "";
			$message = "";
			$email = "";
			if(count($_POST) > 0){
				function valEmail($mail){
					$ref = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
					return preg_match($ref, $mail);
				}
				$email = trim($_POST['email']);
				$name = trim($_POST['name']);
				$sujet = trim($_POST['sujet']);
				$message = trim($_POST['message']);
				if(valEmail($email)) {
					mail('admin@gmail.com', 'New message', "$name $email $sujet $message");
					$msg = "Merci de nous avoir contacter.";
					$showForm = false;
				}
				else {
					$msg = "L'adresse email n'est pas valide.";
				}
			}
			else {
				$msg = "";
			}
		?>
		<h1>Formulaire de contact</h1>
		<hr>
		<?php if($showForm){ ?>
		<form method="post">
			<label for="name">Nom :</label>
				<input id="name" name="name" type="text" value= "<?php echo $name; ?>" autofocus /> <br/><br/>
			<label for="email">Adresse email :</label>
				<input id="email" name="email" type="text" value= "<?php echo $email; ?>"/><br/><br/>
			<label for="sujet">Sujet :</label>
				<input id="sujet" name="sujet" type="text" value= "<?php echo $sujet; ?>" /> <br/><br/>
			<label for="message">Message :</label>
				<textarea id= "message" name= "message" cols="20" rows="5"><?php echo $message; ?></textarea><br/><br/>
			<button id="envoyer" type="submit" disabled>Envoyer</button>
		</form>
		<?php } ?>
		<div>
			<?php echo $msg; ?>
		</div>
	</body>
</html>