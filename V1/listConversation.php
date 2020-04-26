<?php
	session_start();
	require 'admin/Model.php';

	$model= Model::get_model();

	$membres= $model->getMembres();
	echo '<p> Conversation </p>';
	echo '<ul>';
	foreach ($membres as $value) {
		echo '<li> <a href="miniChat.php?pseudo='.$value['pseudo'].'">'.$value['pseudo'].'</a> </li>';
	}
	echo '</ul>';

?>