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

echo <<< EOT
<div>
<p>login : $userLogin</p>
<p>last name : $userLastname</p>
<p>surname : $userName</p>
<p>mail : $userMail</p>
<p>is admin ? : $userAdmin</p>
<p>In your wallet right now : $wallet</p>
<p>And you already have spended : $spend</p>
<p>Your adventurer's level is : $level</p>
<p>Your buy will be send to : $shippingaddress</p>
<p>Your bill will be send to : $billingaddress</p>
</div>
EOT;
if (Session::is_user($userLogin)  || Session::is_admin()) {
    echo '<p><a href="index.php?controller=user&action=update&login=' . $userIdURL . ' ">Modificate the data of this user</a></p>';
    echo '<p><a href="index.php?controller=user&action=delete&login=' . $userIdURL . ' ">Delete this user from DataBase</a></p>';
}

?>