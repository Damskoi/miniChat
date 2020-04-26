<?php


	function afficheMessageBis($mod, $page=0){
		$msg= $mod->getMessageBis($page);
		foreach ($msg as $value) {
		 	echo '<p class="'. $value['pseudo'] .'">'. $value['date'] .', From <b>'. $value['pseudo'] .'</b> : <br/>' . $value['msg'] .'</p>';
		 } 
	}




	function afficheMessage($mod){
		$msg= $mod->getMessage();
		foreach ($msg as $value) {
		 	echo '<p class="'. $value['pseudo'] .'">'. $value['date'] .', From <b>'. $value['pseudo'] .'</b> : <br/>' . $value['msg'] .'</p>';
		 } 
	}

	function emailValide($email){
		$pregEmail= '#^([a-zA-Z0-9]+)@([a-zA-Z0-9]+)\.([a-z]{2,3})$#';
		if(preg_match($pregEmail, $email))
			return true;
		else return false;
				
	}
	function chaineConforme($c1, $c2){
		if($c1 === $c2)
			return true;
		else return false;
	}

	function getIp() {
		// IP si internet partagé
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		// IP derrière un proxy
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		// Sinon : IP normale
		else {
			return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
	}
	
	
?>