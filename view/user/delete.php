<?php
    echo "Do you really want to delete that user ?";
    // ici un bouton pour valider la suppression ou l'annuler.

    <form GET action="do">
        <input type="submit" value="Yes">
    </form>

    <form GET action="undo">
        <input type="submit" value="No">
    </form>


?>