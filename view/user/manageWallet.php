<?php

echo <<< EOT

<h1>Your Wallet</h1>

<p>
    Chirstmas is coming, and to celebrate this wonderful holiday we wanted to give back to our customers.
    Under the box displaying your balance, you will be greeted with a <em>santa button</em>. Give it a try and enjoy.
</p>
<p>Can only be used on <strong>MYSTIC MARKET EVERYWHERE</strong></p>

<form method="$method" action="index.php">
    <legend>
    <fieldset>
            <label for="id_wallet">Your Wallet</label>
            <input type="number" id="id_wallet" value=$wallet readonly>

            <input type='hidden' name='action' value="walletManaged">
            <input type='hidden' name='controller' value='user'>

        <button type="submit">SANTA GIFT</button>
    </fieldset>
    </legend>
</form>

<p>
    By adding money to your account you agree to our "no refund" policy. If you have questions, please redirect them to our customer service.
</p>

EOT;

?>
