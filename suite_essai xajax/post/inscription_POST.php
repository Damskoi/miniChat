<?php
	session_start();
	require_once '../admin/Model.php';
	require_once '../admin/functions.inc.php';

	$model = Model::get_model();


	if(isset($_POST['pseudo']) && trim($_POST['pseudo'])!='' && isset($_POST['nom']) && trim($_POST['nom'])!='' && isset($_POST['prenom']) && trim($_POST['prenom'])!='' && isset($_POST['mdp']) && 
		trim($_POST['mdp'])!='' && isset($_POST['email']) && trim($_POST['email'])!=''){

		$_SESSION['pseudo'] = $_POST['pseudo'];
		$_SESSION['nom'] = $_POST['nom'];
		$_SESSION['prenom'] = $_POST['prenom'];
		$_SESSION['mdp'] = $_POST['mdp'];
		$_SESSION['email'] = $_POST['email'];

		$res = $model->existe($_POST['pseudo']);
			if($res){
				header('Location: ../inscription.php?pseudo=prise');
				exit();
			}

		if(isset($_POST['mdp2']) and trim($_POST['mdp2'])!='' and isset($_POST['email2']) and trim($_POST['email2'])){
			if(!chaineConforme($_POST['mdp'], $_POST['mdp2']) && !chaineConforme($_POST['email'], $_POST['email2'])){
				header('Location: ../inscription.php?mdp=diff&email=diff');
				exit();
			}
			else if(!chaineConforme($_POST['mdp'], $_POST['mdp2'])){
				header('Location: ../inscription.php?mdp=diff');
				exit();
			}
			else if(!chaineConforme($_POST['email'], $_POST['email2'])){
				header('Location: ../inscription.php?email=diff');
				exit();
			}
		}

			// Hachage du mot de passe
		$pass_hache = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
		//if(isset($pass_hache)) echo $pass_hache;

			//	Ajout du membre
		$add = $model->ajoutMembre($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $pass_hache, $_POST['email']);

		if($add){
			header('Location: ../connexion.php?membre=new');
		}
		else
			header('Location: ../connexion.php?membre=pb');
	}
	else header('Location: ../index.php')

?>