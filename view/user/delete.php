<?php

echo "Do you really want to delete that user ?";
// ici un bouton pour valider la suppression ou l'annuler.

echo <<< EOT
    <form method="GET" action="do">
        <input type="button" value="Yes">
    </form>

    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
    </button>

    <form method="GET" action="undo">
        <input type="submit" value="No">
    </form>
EOT;

?>