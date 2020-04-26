<?php

	if(!isset($_COOKIE['pseudo'])){
		if(isset($_SESSION['pseudo']))
			setcookie('pseudo', $_SESSION['pseudo'], time()+7*24*3600 /* , null, null, false, true */);
	}

	if(!isset($_COOKIE['mdp'])){
		if(isset($_SESSION['mdp']))
			setcookie('mdp', $_SESSION['mdp'], time()+7*24*3600 /* , null, null, false, true */);
	}

	if(isset($_COOKIE['nbVisites'])){
		$_COOKIE['nbVisites'] += 1;
		setcookie("nbVisites", $_COOKIE['nbVisites'], time()+7*24*3600, null, null, false, true);
	}
	else setcookie("nbVisites", 0, time()+7*24*3600, null, null, false, true);

?>