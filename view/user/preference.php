
<form method=<?php echo $method ?>  action="personalisation.php">
    <fieldset>
        <legend> Preference :
            <p>
                <label for="preference_id">Produit</label>
                <input type="radio" placeholder="" name="preference" id="preference_id" value="produit">
                <br>
                <label for="preference_id">Categorie</label>
                <input type="radio" placeholder="" name="preference" id="preference_id" value="categorie">                
            </p>
            <input type="submit" value="Envoyer">
        </legend>
    </fieldset>
</form>