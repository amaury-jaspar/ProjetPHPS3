<?php

echo <<< EOT

<form class="container" method="get" action="index.php?">
    <fieldset>
        <legend>Modificate your password</legend>

        <label for="password_id1">Ancient password</label>
        <input type="password" name="password1" id="password_id1" value="$password1" required/>
        <br>

        <label for="password_id2">Repeat your ancient password</label>
        <input type="password" name="password2" id="password_id2" value="$password2" required/>
        <br>

        <label for="password_id3">New Password</label>
        <input type="password" name="password3" id="password_id3" value="$password3" required/>

        <br>

        <input type='hidden' name='login' value=$login>
        <input type='hidden' name='action' value=$action>
        <input type='hidden' name='controller' value='user'>

        </p>

        <input type="submit" name='fromForm' value="Send">
    </fieldset>
</form>

EOT;

?>