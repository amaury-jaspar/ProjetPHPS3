<form method=<?php echo $method ?> action="index.php?">

    <h5>Confirm delete account by giving information</h1>

    <legend>
    <?php
            if (Session::is_admin()) {
                echo "fill the user's login to delete";
            }
        ?>
        <br>
        <label for="login_id">Login</label>
        <input type="text" name="login" id="login_id" value="" required>
        <br>
        <?php
            if (Session::is_admin()) {
                echo "fill with your admin password";
            }
        ?>
        <br>
        <label for="mdp_id">Password</label>
        <input type="password" name="password" id="mdp_id" value="" required>    

        <input type='hidden' name='action' value="deleted">
        <input type='hidden' name='controller' value='user'>
        <input type="submit" value="Confirm delete">

    </legend>

</form>