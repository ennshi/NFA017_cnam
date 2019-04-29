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
		button {
    		    background-color: white;
    			width: 150px;
    			height: 30px;
    			margin-left: 130px;
    	}
		div {
			margin-top: 20px;
		}
		</style>
	</head>
	<body>
			<?php 
			require_once 'ContactFormulaire.php';
			
			session_start();
		
			
			if(isset($_SESSION['name'])){
			    //  stocker dans un cookies le nombre de visites client:
			    function counter() {
			        if(isset($_COOKIE['count'])){
			            $_COOKIE['count']++;
			        } else {
			            $_COOKIE['count'] = 1;
			        }
			        return $_COOKIE['count'];
			    }
			    setcookie('count', counter(), time()+86400);
			    // deconnecter et supprimer la session:
			    if(time() - $_SESSION['auth_timestamp'] > 600) {
			        header('Location: logout.php');
			    }
			    
			    /*stocker dans un fichier contact.log, les informations:
			     - La date et l’heure de visite client;
			     - L'username du client;
			     - Son adresse IP */
			    $currentTime = date('Y-m-d H:i:s');
			    $fp = fopen('contact_log.txt', 'a');
			    fwrite($fp, "/Date: {$currentTime}\t Username: {$_SESSION['name']}\t IP: {$_SERVER['REMOTE_ADDR']}/\t \n");
			    fclose($fp);
			    //display of formulaire and post check
    			$showForm = true;
    			$name = "";
    			$sujet = "";
    			$message = "";
    			$email = "";
    			
    			
    			if(count($_POST) > 0){
    			    
        			    $form = new ContactFormulaire();
        			    
        				$email = trim($_POST['email']);
        				$name = trim($_POST['name']);
        				$sujet = trim($_POST['sujet']);
        				$message = trim($_POST['message']);
                        $cap = $_POST['captcha'];
        				
        				
        				$form->recupForm($name, $email, $sujet, $message, $cap);
        				
        				if($form->testForm()){
        				    $showForm = false;
        				    $form->envoiMail();
        				    $msg = "Votre message:<br>\"{$form->afficheMessage()}\"<br> a ete envoye avec succes. Merci de nous avoir contacte.";
        				} else {
        				    $msg="<br>";
        				    foreach($form->afficheErreur() as $erreur){
        				        $msg .="{$erreur}<br>";
        				    }
        				}

    			}
    			else {
    				$msg = "";
    			}
			} else {
			    header('Location: login.php');
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
			<img src="captcha.php" /><br/><br/>
			<input type="text" name="captcha" /><br/><br/>
			
			<button id="envoyer" type="submit">Envoyer</button>
		</form>
		<?php } ?>
		<div>
			<?php echo $msg; ?>
			
		</div>
		<br>
		<a href="logout.php"><button>Se d&eacute;connecter</button></a>
	</body>
</html>