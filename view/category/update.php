<?php
echo <<< EOT
<div>
    <form class="container" method="$method" action="index.php" enctype="multipart/form-data">
        <legend>
            <fieldset>
                <p>
                    <label for="name_id">Name</label>
                    <input type="text" placeholder="" name="name" id="name_id" value="$name" $required/>
                    <label for="description_id">Description</label>
                    <input type="text" placeholder="" name="description" id="description_id" value="$description"/>
                    <label for="fileToUpload">Select image to upload :</label>
                    <input type="file" value="Upload Image" name="img" accept="image/png, image/jpeg" id="fileToUpload"/>
                    <p>Veuillez nommer l'image du même nom que la category et avec une extention .jpeg</p>
                    <input type='hidden' name='controller' value='category'>
                    <input type='hidden' name='action' value=$action>
                </p>
                <input type="submit" value="Send" name="submit">
            </fieldset>
        </legend>
    </div>
</div>
EOT;
?>