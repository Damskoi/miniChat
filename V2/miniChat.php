<?php
	session_start();
	require_once 'admin/Model.php';
	require_once 'admin/functions.inc.php';
	$model= Model::get_model();
	include 'setCookie.php';

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="miniChat.css">
	<meta http-equiv="refresh" content="35">
	<meta charset="utf-8">
	<title> Mini Chat </title>
</head>
<body>

	<h1> Mini Chat Privé </h1>

	<?php 
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
		    echo '<p id="slt"> Salut <span class="pseudo">' . $_SESSION['pseudo']. '</span> </p>';	
	?>
			<p id="deconnexion"> <a href="detruitSession.php">Se Deconnecter</a> </p>


	<?php
			if(isset($_GET['pseudo']) and trim($_GET['pseudo'])!=''){
				$_SESSION['destinateur']= $_GET['pseudo'];
				if(isset($_GET['convo']) and trim($_GET['convo'])=='new'){
					include 'chat.inc.php';
				}
				else {
				 	$list= listeConvo($model, $_SESSION['pseudo']);
				 	if(in_array($_GET['pseudo'], $list)== false){
				 		header('Location: miniChat.php');
				 		exit();
					}
					else{
						include 'chat.inc.php';
					}
				}
			}
			else{
				echo '<div class="listConvo">';
					get_listConvo($model, $_SESSION['pseudo']);
					include 'connectee.php';
				echo '</div>';
			}
	?>

	<?php
		}
		else {
		 header('location: index.php');
		 exit();
		}
	?>	
	
	
</body>
</html>