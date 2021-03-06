<?php

	function online($model, $pseudo){
		$enligne= $model->get_listeOnlineSauf($pseudo);
		$affiche= '';
		if($enligne){
			$affiche .= '<p> Sont en Ligne <p>
				<ul>';
			foreach ($enligne as $value) {
				$affiche .=  '<li> '. $value['pseudo'] .' il ya '. $value['ya'] .'</li>';
			}
			$affiche .= '</ul>';
		}
		else {
			$affiche = '<p> Personne n\'est connecter actuellement </p>';
		}
		return $affiche;
	}

	function enLigne($model, $pseudo){
		$enligne= $model->get_listeOnlineSauf($pseudo);
		if($enligne){
			echo '<p> Sont en Ligne <p>';
			echo '<ul>';
			foreach ($enligne as $value) {
				echo '<li> '. $value['pseudo'] .', derrière action il y\'a '. $value['ya'] .'</li>';
			}
			echo '</ul>';
		}
		else {
			echo '<p> Personne n\'est connecter actuellement </p>';
		}
	}

	function tabPseudoDiff($tab1, $tab2){
		$tab=array();
		$temp1=array();
		$temp2= array();
		foreach ($tab1 as $value) {
			$temp1[] = $value['pseudo'];
		}
		foreach ($tab2 as $value) {
			$temp2[] = $value['dest'];
		}
		$tab= array_diff($temp1, $temp2);
		return $tab;
	}

	function listeAmi($model, $pseudo){
		$ami= $model->get_listeConvoDe($pseudo);
		$tab= array();
		foreach ($ami as $key => $value) {
			$tab[]= $value['dest'];
		}
		return $tab;
	}

	function get_listConvo($model, $pseudo){
		$membres= $model->getMembresSauf($pseudo);
		$convo= $model->get_listeConvoDe($pseudo);
		$other= tabPseudoDiff($membres, $convo);

		if($convo){
			echo '<p> Conversation </p>';
			echo '<ul>';
			foreach ($convo as $value) {
				echo '<li> <a href="miniChat.php?pseudo='.$value['dest'].'">'.$value['dest'].'</a> </li>';
			}
			echo '</ul>';
		}
		else echo '<p> Vous n\'avez pas encore de comversation en cours </p>';

		if($other){
			echo '<p> Demarer une Conversation avec <p>';
			echo '<ul>';
			foreach ($other as $value) {
				echo '<li> <a href="miniChat.php?pseudo='.$value.'&convo=new">'. $value .'<a> </li>';
			}
			echo '</ul>';
		}
	}

	function afficheMessageBis($mod, $page=0){
		$msg= $mod->getMessageBis($page);
		foreach ($msg as $value) {
		 	echo '<p class="'. $value['pseudo'] .'">'. $value['date'] .', From <b>'. $value['pseudo'] .'</b> : <br/>' . $value['msg'] .'</p>';
		 } 
	}




	function afficheMessage($mod, $pers1, $pers2){
		$msg= $mod->getMessage($pers1, $pers2);
		foreach ($msg as $value) {
		 	echo '<p class="'. $value['expe'] .'"'; if($_SESSION['pseudo']== $value['expe']) echo 'id="moi" '; echo '>'. $value['date'] .', From <b>'. $value['expe'] .'</b> : <br/>' . $value['msg'] .'</p>';
		 } 
	}
/*
echo '<p class="'. $value['expe'] .'"'; if($_SESSION['pseudo']== $value['expe']) echo 'title="c moi!" style="background-color: #54CA33; text-align: right;"'; echo '>'. $value['date'] .', From <b>'. $value['expe'] .'</b> : <br/>' . $value['msg'] .'</p>';
*/



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