<?php

echo <<< EOT
    <form class="container" method="$method" action="index.php">
            <legend>$view form :
                <fieldset>
                    <p>
                    <label for="login_id">Login</label>
                    <input type="text" placeholder="" name="login" id="login_id" value="$login" $required/>

                    <label for="lastName_id">Last Name</label>
                    <input type="text" placeholder="" name="lastName" id="lastName_id" value="$lastName" required/>

                    <label for="surname_id">Surname</label>
                    <input type="text" placeholder="" name="surname" id="surname_id" value="$surname" required/>

EOT;
if ($action == "updated" && Session::is_admin() && !Session::is_user($login)) { 
    echo '<p>As an administrator updating the account of a member :</p>';
    echo '<p>please, fill the form with your own password :</p>';
}
echo <<< EOT
                    <label for="password_id1">Password</label>
                    <input type="password" name="password1" id="password_id1" value="$password1" required/>

                    <label for="password_id2">Repeat the password</label>
                    <input type="password" name="password2" id="password_id2" value="$password2" required/>

                    <label for="mail_id">Mail</label>
                    <input type="text" placeholder="bob@yopmail.com" name="mail" id="mail_id" value="$mail" required/>

                    <label for="shippingaddress_id">Shipping Address</label>
                    <input type="text" placeholder="" name="shippingaddress" id="shippingaddress_id" value="$shippingaddress">

                    <label for="billingaddress_id">Billing Address</label>
                    <input type="text" placeholder="" name="billingaddress" id="billingaddress_id" value="$billingaddress">

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
                    <input type="submit" value="Send">        
                </p>
            <fieldset>
        </legend>
    </form>
EOT;

?>