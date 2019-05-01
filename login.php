<?php
session_start();

$name = '';

if(count($_POST) > 0) {
    $name = htmlentities(trim($_POST['name']));
    $password = htmlentities($_POST['password']);
    
    if(isset($_POST['name'])&&!empty($_POST['name'])&&isset($_POST['password'])&&!empty($_POST['password'])){
        
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['auth_timestamp'] = time();
            header('Location: NFA017_ex_1-2.php');
      
    } else {
        $msg = 'Tous les champs doivent etre remplis.';
    }
}
else {
    $msg = '';
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<main>
			<h1>Authentification</h1>
    		<form method="post">
    			<label for="name">Username :</label>
    				<input id="name" name="name" type="text" value= "<?php echo $name; ?>" autofocus /> <br/><br/>
    			<label for="password">Mot de passe:</label>
    				<input id="password" name="password" type="password" value= ""/><br/><br/>
    			<button class="button" type="submit">Login</button>
    		</form>
    		<div>
            	<?=$msg; ?>
            </div>
		</main>
	</body>
</html>
