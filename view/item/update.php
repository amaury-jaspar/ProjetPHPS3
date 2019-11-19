<?php

echo <<< EOT
    <form method="POST" action="index.php" enctype="multipart/form-data">
    <legend> Create / Update
        <fieldset>
                <p>
                    <label for="name_id">Name</label>
                    <input type="text" placeholder="" name="name" id="name_id" value="$name" required/>
                    <br>
                    <label for="price_id">Price</label>
                    <input type="text" placeholder="" name="price" id="price_id" value="$price"/>
                    <br>
                    <label for="description_id">Description</label>
                    <input type="text" placeholder="" name="description" id="description_id" value="$description"/>
                    <br>


                <label for="id_categorisation">Add this item to a category</label><br/>
                    <select name="category" id="id_categorisation">
                        <option value="black-smith">blacksmith</option>
                        <option value="alchimist">alchimist</option>
                        <option value="tavern">tavern</option>
                        <option value="Bookstore">bookstore</option>
                        <option value="temple">temple</option>
                        <option value="armory">armory</option>
                    </select>
                <br>

                     <p>
                     <label for="catalog_id">
                         <input type="checkbox" name="catalog" id="catalog_id" value="1"/>
                         <span>Does this item have to be in front sale ?</span>
                     </label>
                     </p>

                     <!-- <label for="fileToUpload">Select image to upload :</label> -->
                     <!-- <input type="file" value="Upload Image" name="fileToUpload" accept="image/png, image/jpeg" id="fileToUpload"/> -->

                     <input type="file" name="img"/>

                     <br>
                    <input type='hidden' name='id' value=$id>
                    <input type='hidden' name='controller' value='item'>
                    <input type='hidden' name='action' value=$action>
                </p>
                <input type="submit" value="Send" name="submit">
            </legend>
    </fieldset>

EOT;
echo "</div>";

?>

<!--
20190721_075539.jpg
-->
