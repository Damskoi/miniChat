<?php


	function afficher(){
        $reponse = new xajaxResponse();
        $chat='';
        $msg= $mod->getMessage('dams', 'unePers');

		foreach ($msg as $value) {
		 	$chat.= '<p class="'. $value['expe'] .'">'. $value['date'] .', From <b>'. $value['expe'] .'</b> : <br/>' . $value['msg'] .'</p>';
		 } 

		 $reponse->assign('message', 'innerHTML', $chat);
        return $reponse;

    }

    function envoyer($donnees_formulaire){
        $reponse = new xajaxResponse();

        if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && trim($_SESSION['pseudo'])!='' ){
			if(isset($donnees_formulaire['msg']) && trim($donnees_formulaire['msg'])!=''){
				$ins= $model->insertMessage($_SESSION['pseudo'], $_SESSION['destinateur'], $donnees_formulaire['msg']);
			}
			else {
			 header('Location: ../miniChat.php?pseudo='.$_SESSION['destinateur'].'&msg=vide');
			 exit; 
			}
		}
		else echo '<p> Vous n\'etes pas connecté!! <p>';

		header('Location: ../miniChat.php?pseudo='.$_SESSION['destinateur'].'');

		$reponse->clear('msg', 'value');
        $reponse->call('xajax_afficher');
        return $reponse;
	}



//Ouverture de la librairie xajax, instanciation d'un objet de la classe xajax, puis déclaration de nos fonctions PHP.
//
require_once('xajax_core/xajax.inc.php');
$xajax = new xajax(); // On initialise l'objet xajax.
//$xajax->configure('javascript URI', './');
$xajax->register(XAJAX_FUNCTION, 'afficher');// On enregistre nos fonctions.
$xajax->register(XAJAX_FUNCTION, 'envoyer');
$xajax->processRequest();// Fonction qui va se charger de générer le Javascript, à partir des données que l'on a fournies à xAjax APRÈS AVOIR DÉCLARÉ NOS FONCTIONS.

?>