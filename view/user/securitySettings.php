<?php

echo <<< EOT

<form class="container" method="get" action="index.php?">
    <fieldset>
        <p>
        <legend>Modificate your password</legend>

        <label for="password_id1">Ancient password</label>
        <input type="password" name="password1" id="password_id1" value="$password1" required/>

        <label for="password_id2">Repeat your ancient password</label>
        <input type="password" name="password2" id="password_id2" value="$password2" required/>

        <label for="password_id3">New Password</label>
        <input type="password" name="password3" id="password_id3" value="$password3" required/>

        <input type='hidden' name='login' value=$login>
        <input type='hidden' name='action' value=$action>
        <input type='hidden' name='controller' value='user'>

        <input type="submit" name='fromForm' value="Send">
        </p>

    </fieldset>
</form>

EOT;

?>