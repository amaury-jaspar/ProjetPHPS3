<?php

echo <<< EOT

    <p>Compte admin: login = admin, password = p</p>
    <p>Compte visiteur: login = visiteur, password = p</p>
    
    <form method=$method action="index.php?">
        <legend>
            <fieldset>
            <label for="login_id">Login</label>
            <input type="text" name="login" id="login_id" value="" required>

            <label for="mdp_id">Password</label>
            <input type="password" name="password" id="mdp_id" value="" required>

            <input type='hidden' name='action' value="connected">
            <input type='hidden' name='controller' value='user'>
            <input type="submit" value="Connection">
            </fieldset>
        </legend>
    </form>
EOT;
?>