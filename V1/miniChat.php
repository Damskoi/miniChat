<?php
	session_start();
//	if(isset($_SESSION['stayco']) and $_SESSION['stayco']== true)
	include 'setCookie.php';
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="miniChat.css">
	<meta http-equiv="refresh" content="35">
	<meta charset="utf-8">
	<title> Mini Chat </title>
</head>
<body>

	<h1> Mini Chat Privé </h1>

	<?php 
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
			if($_SESSION['id']===1 && $_SESSION['id']=== 'dams')
		    echo '<p id="slt"> Salut <span class="pseudo">' . $_SESSION['pseudo']. '</span> </p>';	
	?>
			<p id="deconnexion"> <a href="detruitSession.php">Se Deconnecter</a> </p>

			<div>
				<form method="post" action="post/miniChat_POST.php">
					<fieldset>
						<legend>Chat</legend>
						<p> <label for="msg"> Message </label> <input type="text" name="msg" id="msg" placeholder="hello world" size="100" autofocus> </p>
						<p> <input type="submit" value="Envoyer"> </p>
					</fieldset>
				</form>

		<?php

			require_once 'admin/Model.php';
			require_once 'admin/functions.inc.php';
			$model= Model::get_model();

			if(isset($_GET['msg']) and $_GET['msg']=='vide') echo '<p> Message Vide!! </p>';

			echo '<div class="chat">	';
				afficheMessage($model);
			echo '</div>';
		
		?>
		
			</div>
	<?php 
		}
		else header('location: index.php');
	?>	
	
	
</body>
</html>