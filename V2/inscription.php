<?php
	session_start();

	if(isset($_GET['membre']) and $_GET['membre']=='pb')
		echo '<p> Probleme à l\'inscription du membre <b>'. $_SESSION['pseudo'] .'</b> </p>';

?>

<form method="post" action="post/inscription_POST.php">
		<h3> S'Inscrire </h3>

	<p> <label for=""> Pseudo </label> : <input type="pseudo" name="pseudo" id="pseudo" placeholder="dams" value="<?php if(isset($_SESSION['pseudo'])) echo $_SESSION['pseudo'] ?>" required> <?php if(isset($_GET['pseudo']) and $_GET['pseudo']== 'prise') echo 'Pseudo non Disponible' ?> </p>
	<p> <label for="nom"> Nom </label> : <input type="text" name="nom" id="nom" placeholder="Doums" value="<?php if(isset($_SESSION['nom'])) echo $_SESSION['nom'] ?>" required> </p>
	<p> <label for="prenom"> Prenom </label> : <input type="text" name="prenom" id="prenom" placeholder="Curtis" value="<?php if(isset($_SESSION['prenom'])) echo $_SESSION['prenom'] ?>" required> </p>
	<p> <label for="mdp1"> Mot de Passe </label> : <input type="password" name="mdp" id="mdp1" placeholder="fg1/5!14;" value="<?php if(isset($_SESSION['mdp'])) echo $_SESSION['mdp'] ?>" required> </p>
	<p> <label for="mdp2"> Confirme le Mot de Passe </label> : <input type="password" name="mdp2" id="mdp2" required> <?php if(isset($_GET['mdp']) and $_GET['mdp']== 'diff') echo 'Mot de passe non Conforme!' ?> </p>
	<p> <label for="email1"> Email </label> : <input type="email" name="email" id="email1" placeholder="curtis25@hotmail.fr" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'] ?>" required> </p>
	<p> <label for="email2"> Confirmer l'Email </label> : <input type="email" name="email2" id="email2" required> <?php if(isset($_GET['email']) and $_GET['email']== 'diff') echo 'Email non Conforme!' ?> </p>

	<p>  <input type="submit" value="S'inscrire"/></p>
</form>

<?php 
	if(isset($_GET['pseudo']) and $_GET['pseudo']== 'prise')
		echo '<p> Souhaitez vous vous Connecter <a href="connexion.php?ins=no"> Oui </a> </p>'
?>
