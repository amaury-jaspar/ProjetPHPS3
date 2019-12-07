<?php

echo <<< EOT
    <form class="container" method=$method action="index.php">
		<fieldset>
			<p>
				<label for="command_id">Command n°</label>
				<input type="text" placeholder="" name="id_command" id="command_id" value="$id_command" readonly/>
				<label for="login_id">Login</label>
				<input type="text" placeholder="" name="login" id="login_id" value="$login" required/>
				<label for="date_id">Date</label>
				<input type="text" placeholder="" name="date" id="date_id" value="$date_buy" readonly/>				
				<input type='hidden' name='action' value=$action>
				<input type='hidden' name='controller' value='command'>
				<input type="submit" value="Send">        
			</p>
		<fieldset>
    </form>
EOT;

?>