<?php

echo <<< EOT
    <form method="post" action="index.php" enctype="multipart/form-data">
    <legend> Create Category
        <fieldset>
                <p>

                    <br>
                    <label for="name_id">Name</label>
                    <input type="text" placeholder="" name="name" id="name_id" value="$name"/>
                    <br>

                    <br>
                    <label for="description_id">Description</label>
                    <input type="text" placeholder="" name="description" id="description_id" value="$description"/>
                    <br>

                    <label for="fileToUpload">Select image to upload :</label>
                    <input type="file" value="Upload Image" name="img" accept="image/png, image/jpeg" id="fileToUpload"/>

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