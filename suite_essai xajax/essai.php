<?php
	require 'admin/Model.php';
	require_once 'admin/functions.inc.php';

	$mod= Model::get_Model();


	function afficher(){
        $reponse = new xajaxResponse();
        $chat='';
        $msg= $mod->getMessage('dams', 'Yendou2220');

		foreach ($msg as $value) {
		 	$chat.= '<p class="'. $value['expe'] .'">'. $value['date'] .', From <b>'. $value['expe'] .'</b> : <br/>' . $value['msg'] .'</p>';
		 } 

		 $reponse->assign('black', 'innerHTML', $chat);
        return $reponse;

    }


require_once('xajax_core/xajax.inc.php');
$xajax = new xajax(); // On initialise l'objet xajax.
//$xajax->configure('javascript URI', './');
$xajax->register(XAJAX_FUNCTION, 'afficher');// On enregistre nos fonctions.
//$xajax->register(XAJAX_FUNCTION, 'envoyer');
$xajax->processRequest();// Fonction qui va se charger de générer le Javascript, à partir des données que l'on a fournies à xAjax APRÈS AVOIR DÉCLARÉ NOS FONCTIONS.

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
	<title> tst</title>
	<meta charset="utf-8">
	<?php $xajax->printJavascript(); /* Affiche le Javascript */?>
    <script type="text/javascript">
	    function refresh()// Code javascript qui va appeler la fonction afficher toutes les 5 secondes.
	    {
	            xajax_afficher();
	            setTimeout(refresh, 5000);
	    }
    </script>
</head>
<body>
	<div id="block"></div>

	<script type="text/javascript">
        refresh();//On appelle la fonction refresh() pour lancer le script.
    </script>
</body>
</html>