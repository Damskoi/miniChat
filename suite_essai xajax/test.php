<?php

//		<meta http-equiv="refresh" content="10">

	require 'admin/Model.php';
	require_once 'admin/functions.inc.php';

	$mod= Model::get_Model();

//	echo realpath('test.php');

/*
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			echo '1)'. $_SERVER['HTTP_CLIENT_IP'];
		}
		// IP derrière un proxy
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			echo '2)'. $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		// Sinon : IP normale
	else {
			echo '3)'. (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
*/

/*
	$sql= 'SELECT COUNT(msg) AS nbMsg from chat';
	$req= $mod->query($sql);
	$res= $req->fecth(PDO::FETCH_ASSOC).
*/

/*
	$nbMsg= $mod->get_nbMsg();
	echo 'il ya '. $nbMsg . ' message';

	afficheMessageBis($mod,$_GET['page']);

	for($i=1; $i <= $nbMsg/10; $i++){
		echo '<a href="test.php?page='.$i.'"> <div class="page"> '. $i .' </div> </a>';
	}
*/
/*
	$membres= $mod->getMembres();
	print_r($membres);
	echo '<p> Conversation </p>';
	echo '<ul>';
	foreach ($membres as $value) {
		echo '<li> <a href="miniChat.php?pseudo='.$value['pseudo'].'">'.$value['pseudo'].'</a> </li>';
	}
	echo '</ul>';
*/
	$pers1= 'damskoi';
	$pers2= 'pers1';
	print_r($mod->getMessageTest($pers1, $pers2));

	$msg= $mod->getMessage($pers1, $pers2);
	print_r($msg);
	$chat='';
		foreach ($msg as $value) {
		 	$chat.= '<p class="'. $value['expe'] .'">'. $value['date'] .', From <b>'. $value['expe'] .'</b> : <br/>' . $value['msg'] .'</p>';
		 } 
		 echo $chat;

//	print_r($msg);

//	afficheMessage($mod, $pers1, $pers2);

/*
	$list =listeAmi($mod, $pers1);
	print_r($list);
	$test= 'unePers';
	if(in_array($test, $list))
		echo '<br> present ';
	else echo '<br> absent';
*/

/*
	$membres= $mod->getMembresSauf($pers1);
	$convo= $mod->get_listeConvode($pers1);
	print_r($membres); echo '<br>';
	print_r($convo); echo '<br>';
	$diff= tabPseudoDiff($membres, $convo);
	print_r($diff); echo '<br>';

	get_listConvo($mod, $pers1);

	echo ($pers1 != $pers2)?  '<p title="test"> different </p>': 'pareil';

	echo '<h1> Test </h1>';

/*
	$req= $mod->query('SELECT pseudo from membres');
	$res= $req->fetch(PDO::FETCH_ASSOC);
	print_r($res);
*/

/*	
	if($mod->estConnecter($pers1)) echo 'dams est co <br>';
	echo ($mod->estConnecter($pers2))? 'conecter': 'pas connecter'; echo '<br>';
	print_r($mod->get_listeOnlineSauf($pers2)); echo '<br>';
	$act= $mod->action($pers1);
	print_r($mod->get_listeOnlineSauf($pers2)); echo '<br>';
*/
	/*
	$list= online($mod, $pers2);
	echo $list;
*/


?>







