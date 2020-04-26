<div class="conteneur">

	<div>
	<?php
		get_listConvo($model, $_SESSION['pseudo']);
		echo '<br>';
		include 'connectee.php';
	?>
	</div>

	<div class="chat">
		<form method="" action="">
			<fieldset>
				<legend>Chat</legend>
				<p> <label for="msg"> Message </label> <input type="text" name="msg" id="msg" placeholder="hello world" size="100" required autofocus> </p>
				<p> <input type="submit" value="Envoyer" onclick="xajax_envoyer(xajax.getFormValues(this.form)); return false;"> </p>
			</fieldset>
		</form>

	<?php

		if(isset($_GET['msg']) and $_GET['msg']=='vide') echo '<p> Message Vide!! </p>';
		echo '<div id="message">	';
		//	afficheMessage($model, $_SESSION['pseudo'], $_SESSION['destinateur']);
		echo '</div>';

	?>	

	<script type="text/javascript">
        refresh();// On appelle la fonction refresh() pour lancer le script.
    </script>

	</div>

	<div>
	<?php
	//	include 'connectee.php';
	?>
	</div>

</div>