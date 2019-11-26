<p>Compte admin: login = admin, password = p</p>
<p>Compte visiteur: login = visiteur, password = p</p>
<form method=<?php echo $method ?> action="index.php?">
    <legend>
        <label for="login_id">Login</label>
        <input type="text" name="login" id="login_id" value="" required>
        <br>
        <label for="mdp_id">Password</label>
        <input type="password" name="password" id="mdp_id" value="" required>
        <br>
        <input type='hidden' name='action' value="connected">
        <input type='hidden' name='controller' value='user'>
        <input type="submit" value="Connection">
    </legend>
</form>