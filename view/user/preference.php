<?php
echo <<< EOT
<form method="$method" action="index.php">
        <legend> Home page preference :
        <fieldset>
                <p>
                <div>
                    <label>
                        <input type="radio" name="preference" value="item">
                        <span>Catalog</span>
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="preference" value="home">                
                        <span>Marketplace</span>
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="preference" value="profil">                
                        <span>Profil</span>
                    </label>
                </div>
            <input type='hidden' name='action' value=$action>
            <input type='hidden' name='controller' value='user'>
            <input type="submit" value="Envoyer">
            </p>
            </fieldset>
        </legend>
</form>
EOT;
?>