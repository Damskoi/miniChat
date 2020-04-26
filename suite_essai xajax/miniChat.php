<?php
	session_start();
	require_once 'admin/Model.php';
	require_once 'admin/functions.inc.php';
	$model= Model::get_model();
	include 'setCookie.php';

	require_once 'xajax_functions.inc.php';

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="miniChat.css">
	<meta charset="utf-8">
	<title> Mini Chat </title>
	<?php $xajax->printJavascript(); /* Affiche le Javascript */?>
    <script type="text/javascript">
        function refresh(){
        // Code Javascript qui va appeler la fonction afficher toutes les 5 secondes.
            xajax_afficher();
            setTimeout(refresh, 5000);
        }
    </script>
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
				 	$list= listeAmi($model, $_SESSION['pseudo']);
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

				get_listConvo($model, $_SESSION['pseudo']);
				include 'connectee.php';
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