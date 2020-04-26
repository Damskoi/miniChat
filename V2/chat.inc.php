<div class="conteneur">

	<div class="listConvo">
	<?php
		get_listConvo($model, $_SESSION['pseudo']);
		echo '<br>';
		include 'connectee.php';
	?>
	</div>

	<div class="chat">
		<form method="post" action="post/miniChat_POST.php">
			<fieldset>
				<legend>Chat</legend>
				<p> <label for="msg"> Message </label> <input type="text" name="msg" id="msg" placeholder="hello world" size="100" required autofocus> </p>
				<p> <input type="submit" value="Envoyer"> </p>
			</fieldset>
		</form>

	<?php

		if(isset($_GET['msg']) and $_GET['msg']=='vide') echo '<p> Message Vide!! </p>';
		echo '<div id="message">	';
			afficheMessage($model, $_SESSION['pseudo'], $_SESSION['destinateur']);
		echo '</div>';

	?>	
	</div>

	<div>
	<?php
	//	include 'connectee.php';
	?>
	</div>

</div>