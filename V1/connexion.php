<?php
//	session_start();

	if(isset($_GET['membre']) and $_GET['membre']=='new'){
		if(isset($_SESSION['pseudo']))
			echo '<h2> Bienvenu '. htmlspecialchars($_SESSION['pseudo']) .'</h2>';
	}
?>

<form method="post" action="post/connexion_POST.php">
		<h3> Se Connecter </h3>

	<p> <label for="pseudo"> Pseudo </label> : <input type="text" name="pseudo" id="pseudo" placeholder="dams" value="<?php if(isset($_COOKIE['pseudo'])) echo $_COOKIE['pseudo']; else if(isset($_SESSION['pseudo'])) echo $_SESSION['pseudo'] ?>" required= /> </p>
	<p><label for="mdp"> Mot de Passe </label> : <input type="password" name="mdp" id="mdp" value="<?php if(isset($_COOKIE['mdp'])) echo $_COOKIE['mdp']; else if(isset($_SESSION['mdp'])) echo $_SESSION['mdp'] ?>" required> </p>
	<p> <input type="checkbox" name="stayco" value="oui" id="stayco"> <label for="stayco"> Rester connecter </label> </p>
	<p> <input type="submit" value="Se Connecter"> </p>
	<p> <a href="recuperationMdp.php"> récuperer son mot de passe</a> </p>


</form>


<?php
	if(isset($_GET['co']) and $_GET['co']=='null'){
		echo '<p> Identifient ou Mot de Passe <b> incorrect <b> </p>';
		echo '<p> Pour S\'inscrire  <a href="inscription.php"> Inscription </a></p>';
	} 
	if(isset($_GET['ins']) and $_GET['ins']=='no')
		echo '<p> <a href="index.php"> Acceuil </a> </p>';

?>