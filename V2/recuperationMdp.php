<?php
	require 'admin/Model.php';
	require 'admin/functions.inc.php';
	$model= Model::get_model();
?>

	<form method="POST" action="">
		<fieldset>
			<legend> Récuperation de Mot de Passe </legend>
			<p> <label for="email"> Adresse email </label> <input type="text" name="email" id="email" required autofocus> </p>
			<p> <label for="lastmdp"> Dernier mot de passe <input type="text" name="lastmdp" id="lastmdp" required> </label> </p>
			<p> <input type="submit" name="Récupérer le mot de passe"> </p>
		</fieldset>
	</form>

<?php


	if(isset($_POST['email']) and trim($_POST['email']) and emailValide($_POST['email'])){
		$emailExist= $model->emailExiste(htmlspecialchars($_POST['email']));
		if($emailExist){
			$res= $model->requeteClient($emailExist['id'], $emailExist['pseudo'], 'Recuperation de mot de passe');
			echo '<p> Votre <b> mot de passe </b> vous a été <b> envoyée par email </b> <p>';
		}
		else
			echo '<p> Cette adresse email n\'existe pas. </p>';
	}
	else
		echo '<p> Veillez renseigner une adresse email Valide. </p>';


?>

<p>
	Retour à l'
	<a href="index.php"> Accueil </a>
</p>