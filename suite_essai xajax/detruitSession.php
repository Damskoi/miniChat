<?php
	require 'admin/Model.php';
	$model = Model::get_model();
	
	session_start();
	$deconnection= $model->deconnection($_SESSION['pseudo']);
	session_unset();
	

	//	suppresion connexion auto
	if(isset($_COOKIE['pseudo'])){
		setcookie('pseudo', null,time()-3600);
		unset($_COOKIE[$_GET['pseudo']]);
	}

	if(isset($_COOKIE['mdp'])){
		setcookie('mdp', null,time()-3600);
		unset($_COOKIE[$_GET['mdp']]);
	}

	session_destroy();



	echo '<a href="index.php" title="acceuil"> Retourné à l\'Acceuil </a>';
	header("Location: index.php");
	exit();
?>