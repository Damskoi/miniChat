<?php
//	include '';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="index.css">
		<title>Mini chat</title>
	</head>
	<body>
		
		<h1> Bienvenue sur le site Mini Chat </h1>
		<p>
			Je t'invite à créer un compte. si c'est deja fait eh bah connecter toi mdrrr. <br>
			n'oubli pas de me dire quand t'a creer un compte comme sa je bloque les inscriptions.
		</p>

		<div>
			<?php

				require_once 'connexion.php'; ?>

			<?php
				require_once 'inscription.php';
				// <div class="img"> <img src="img/ou.jpg" alt="ou"></div>
			?>

		</div>

	</body>
</html>