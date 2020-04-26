<?php

	session_start();

//	require_once 'setCookie.php';


	require_once '../admin/Model.php';
//	require_once 'functions.inc.php';

	$model= Model::get_model();

	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && trim($_SESSION['pseudo'])!='' ){
		if(isset($_POST['msg']) && trim($_POST['msg'])!=''){
			$ins= $model->insertMessage($_SESSION['pseudo'], $_SESSION['destinateur'], $_POST['msg']);
		}
		else {
		 header('Location: ../miniChat.php?pseudo='.$_SESSION['destinateur'].'&msg=vide');
		 exit; 
		}
	}
	else echo '<p> Vous n\'etes pas connecté!! <p>';


	header('Location: ../miniChat.php?pseudo='.$_SESSION['destinateur'].'');

	

?>