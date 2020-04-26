<?php
//	session_start();
//	require_once 'admin/Model.php';
//	require_once 'admin/functions.inc.php';
//	$model= Model::get_model();


	/*
	SELECT * FROM chat WHERE date_time > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR)
	*/

	$connecte= $model->estConnecter($_SESSION['pseudo']);
	if(!$connecte){
		$model->action($_SESSION['pseudo']);
	}
	else {
		$model->reaction($_SESSION['pseudo']);
	}
	
	$cleanup = $model->cleanupOnline();

		// affichage de la liste des personne en ligne
	enLigne($model, $_SESSION['pseudo']);

?>