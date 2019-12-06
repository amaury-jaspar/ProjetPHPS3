<?php

echo <<< EOT

<form class="container" method="$method" action="index.php">
    <legend>
        <fieldset>
            <p>
                <label for="lastName">Lastname</label>
                <input type="text" id="name" placeholder="" name="lastName" value="$lastName" required/>

                <label for="surname">Surname</label>
                <input type="text" id="surname" placeholder="" name="surname" value="$surname" required/>

                <label for="mail">Mail</label>
                <input type="email" id="mail" placeholder="bob@yopmail.com" name="mail" value="$mail" required/>

                <label for="object">Object of your message</label>
                <input type="text" id="object" placeholder="" name="object" value="$object" required/>

                <label for="texte">Your Message</label>
                <textarea name="message" style="width: 400px; height: 200px" id="texte" cols="30" rows="10" value="$message" required/></textarea>

                <input type='hidden' name='controller' value='home'>
                <input type='hidden' name='action' value='post_contact'>
                
                <button type="submit">Send</button>
            </p>
        </fieldset>
        </legend>
    </form>

EOT;

?>