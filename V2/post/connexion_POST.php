<?php
	session_start();

	require_once '../admin/Model.php';

	$model= Model::get_model();


	if(isset($_POST['pseudo']) && trim($_POST['pseudo']) !='' && isset($_POST['mdp']) && trim($_POST['mdp']) !=''){
		$res = $model->existe($_POST['pseudo']);

		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['mdp'], $res['passwd']);

		if(!$res){
			header('location: ../connexion.php?co=null');
			exit();
		}
		
		else {
			if($isPasswordCorrect) {
				$_SESSION['id'] = $res['id'];
        		$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
        		$_SESSION['mdp']= htmlspecialchars($_POST['mdp']);
        		$_SESSION['stayco']= true;

/*        		// Ameiloration?
        		if($_SESSION['id']==1 && $_SESSION['pseudo']== 'dams'){
        			header('Location: ../listConversation.php');
        			exit();
        		}
*/
        		header('Location: ../miniChat.php');
        		exit();

			}
			else {
				header('location: ../connexion.php?co=null');
				exit();
			}
		}

	//	echo '<p> Souhaitez vous vous inscrire? <a href="inscription.php"> Ouii </a> </p>';

	}
	else{
		header('Location: ../index.php');
		exit();
	}
	
?>