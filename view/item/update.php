<?php

echo <<< EOT
    <form class="container" method="$method"  action="index.php" enctype="multipart/form-data">
        <legend> $view form
            <fieldset>
                <p>
                    <label for="name_id">Name</label>
                    <input type="text" placeholder="" name="name" id="name_id" value="$name" required/>

                    <label for="price_id">Price</label>
                    <input type="number" placeholder="" name="price" id="price_id" value="$price" required/>

                    <label for="description_id">Description</label>
                    <input type="text" placeholder="" name="description" id="description_id" value="$description"/>

                    <label for="levelAccess_id">Level Acces</label>
                    <input type="number" placeholder="" name="levelaccess" id="levelAccess_id" value="$levelaccess" required/>

                    <label for="id_categorisation">Add this item to a category</label><br/>
                        <select name="category" id="id_categorisation">
                        <option value="lastCat" disabled selected>Choose a category</option>
EOT;
                    foreach($tab_category as $category) {
                        $selected = NULL;
                        $tabName = htmlspecialchars($category->get('name'));
                        if ($action == "updated" && $item->get('category') == $tabName) {$selected = "selected";} else { $selected = NULL;}
                        echo " <option value=".$tabName." $selected>".ucfirst($tabName)."</option>  ";
                    }
echo <<< EOT
                    </select>
                     <p>
                     <label for="catalog_id">
                         <input type="checkbox" value="on" $checked name="catalog" id="catalog_id" />
                         <span>Does this item have to be in front sale ?</span>
                     </label>
                     </p>

                     <label for="fileToUpload">Select image to upload :</label>
                     <input type="file" value="Upload Image" name="img" accept="image/png, image/jpeg" id="fileToUpload"/>
                     <p>Veuillez renommer l'image du même nom que le produit et avec un extention .jpeg</p>

                    <input type='hidden' name='id' value=$id>
                    <input type='hidden' name='controller' value='item'>
                    <input type='hidden' name='action' value=$action>
                </p>
                <input type="submit" value="Send" name="submit">
        </fieldset>
    </legend>
</div>
EOT;
?>