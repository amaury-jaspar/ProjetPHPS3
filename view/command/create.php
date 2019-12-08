<?php

echo <<< EOT
    <form class="container" method=$method action="index.php">
		<fieldset>
			<p>
				<label for="login_id">Login</label>
				<input type="text" placeholder="" name="login" id="login_id" value="$login" required/>		
				<input type='hidden' name='action' value=$action>
				<input type='hidden' name='controller' value='command'>
				<input type="submit" value="Send">        
			</p>
		<fieldset>
    </form>
EOT;

?>