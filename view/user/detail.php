<?php

$userLogin = htmlspecialchars($user->get('login'));
$userLastname = htmlspecialchars($user->get('lastName'));
$userName = htmlspecialchars($user->get('surname'));
$wallet = htmlspecialchars($user->get('wallet'));
$level = htmlspecialchars($user->get('level'));
$spend = htmlspecialchars($user->get('spend'));
$billingaddress = htmlspecialchars($user->get('billingaddress'));
$shippingaddress = htmlspecialchars($user->get('shippingaddress'));
$userMail = htmlspecialchars($user->get('mail'));
$userAdmin = htmlspecialchars($user->get('admin'));

$userIdURL = rawurlencode($user->get('login'));

    echo "<div>login : " . $userLogin."</div>";
    echo "<div>last name : " . $userLastname."</div>";
    echo "<div>surname : " . $userName."</div>";
    echo "<div>mail : " . $userMail."</div>";
    echo "<div>is admin ? : " . $userAdmin."</div>";
    echo "<div>In your wallet right now : " . $wallet ."</div>";
    echo "<div>And you already have spended : " . $spend ."</div>";
    echo "<div>Your adventurer's level is : " . $level ."</div>";
    echo "<div>Your buy will be send to : " . $shippingaddress ."</div>";
    echo "<div>Your bill will be send to : " . $billingaddress ."</div>";
    
    if (Session::is_user($user->get('login'))  || Session::is_admin()) {
        echo '<div><a href="index.php?controller=user&action=update&login=' . $userIdURL . ' ">Modificate the data of this user</a></div>';
        echo '<div><a href="index.php?controller=user&action=delete&login=' . $userIdURL . ' ">Delete this user from DataBase</a></div>';
    }

?>
