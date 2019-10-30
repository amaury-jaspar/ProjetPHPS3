<form method="get" action="index.php">
	<fieldset>
		<legend>Mon formulaire :</legend>
		<input type='hidden' name='action' value='created'>
		<p>
			<label for="marque_id">Marque</label> :
			<input type="text" placeholder="Ex : Renault" name="marque" id="marque_id" required/>
		</p>
		<p>
			<label for="couleur_id">Couleur</label> :
			<input type="text" placeholder="Ex : bleu" name="couleur" id="couleur_id" required/>
		</p>
		<p>
			<label for="immat_id">Immatriculation</label> :
			<input type="text" placeholder="Ex : 256AB34" name="immatriculation" id="immat_id" required/>
		</p>
		<p>
			<input type="submit" value="Envoyer" />
		</p>
	</fieldset> 
</form>