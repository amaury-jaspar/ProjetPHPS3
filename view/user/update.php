<?php

echo <<< EOT
    <form method="get" action="index.php?">
        <fieldset>
            <legend>Mon formulaire :
                <p>
                    <label for="immat_id">Login</label>
                    <input type="text" placeholder="" name="login" id="immat_id" $required value="$login"/>
                    <br>
                    <label for="couleur_id">Last Name</label>
                    <input type="text" placeholder="" name="lastname" id="couleur_id" value="$lastName" required/>
                    <br>
                    <label for="marque_id">Surname</label>
                    <input type="text" placeholder="" name="surname" id="fonction_id" value="$surname" required/>
                    <br>
                    <label for="password_id1">Password</label>
                    <input type="password" name="password1" id="password_id1" value="$password1"/>
                    <br>
                    <label for="password_id2">Repeat the password</label>
                    <input type="password" name="password2" id="password_id2" value="$password2"/>
                    <br>
                    <label for="mail_id">Mail</label>
                    <input type="text" placeholder="" name="mail" id="mail_id" value="$mail" required>
                    <br>
                    <input type='hidden' name='action' value=$action>
                    <input type='hidden' name='controller' value='user'>
                </p>
                <input type="submit" value="Send">
            </legend>
    </fieldset>
   </form>
EOT;

?>