<?php

echo <<< EOT
    <form class="container" method=$method action="index.php?">
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
                    <input type="password" name="password1" id="password_id1" value="$password1" required/>
                    <br>
                    <label for="password_id2">Repeat the password</label>
                    <input type="password" name="password2" id="password_id2" value="$password2" required/>
                    <br>
                    <label for="mail_id">Mail</label>
                    <input type="text" placeholder="" name="mail" id="mail_id" value="$mail" required>
                    <br>
                    <label for="shippingaddress_id">Shipping Address</label>
                    <input type="text" placeholder="" name="shippingaddress" id="shippingaddress_id" value="$shippingaddress" required>
                    <br>
                    <label for="billingaddress_id">Billing Address</label>
                    <input type="text" placeholder="" name="billingaddress" id="billingaddress_id" value="$billingaddress" required>
                    <br>
EOT;
                    if (Session::is_admin() && $action == 'updated') {
echo <<< EOT
                    <p>
                    <label for="admin_id">
                        <input type="checkbox" value="on" $checked name="admin" id="admin_id"/>
                        <span>Administrator ?</span>
                    </label>
                    </p>
EOT;
                    }
echo <<< EOT
                    <input type='hidden' name='action' value=$action>
                    <input type='hidden' name='controller' value='user'>
                </p>
                <input type="submit" value="Send">
            </legend>
        </fieldset>
   </form>
EOT;

?>