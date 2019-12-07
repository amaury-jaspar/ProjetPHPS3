<?php

echo <<< EOT

<h1>Your Wallet</h1>

<p>Exceptionnaly, and because it is nearlly Christmas, The market put at your disposal the Santa Button</p>
<p>Get 50 000 added to your wallet right now</p>
<p>Can only be used on <strong>MYSTIC MARKET EVERYWHERE</strong></p>

<form method="get" action="index.php">
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

EOT;

?>