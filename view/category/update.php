<?php

echo <<< EOT
    <form class="container" method="post" action="index.php" enctype="multipart/form-data">
    <legend> Update Category
        <fieldset>
                <p>

                <label for="name_id">Wich category is it</label><br/>
                <select name="name" id="name_id" value="$name" required/>
                    <option value="black-smith">blacksmith</option>
                    <option value="alchimist">alchimist</option>
                    <option value="tavern">tavern</option>
                    <option value="Bookstore">bookstore</option>
                    <option value="temple">temple</option>
                    <option value="armory">armory</option>
                </select>

                    <br>
                    <label for="description_id">Description</label>
                    <input type="text" placeholder="" name="description" id="description_id" value="$description"/>
                    <br>

                    <br>
                    <input type='hidden' name='id' value=$id>
                    <input type='hidden' name='controller' value='category'>
                    <input type='hidden' name='action' value=$action>
                </p>
                <input type="submit" value="Send" name="submit">
            </legend>
    </fieldset>

EOT;
echo "</div>";

?>