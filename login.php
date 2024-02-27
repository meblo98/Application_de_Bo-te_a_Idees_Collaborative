<?php

$query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$query->execute([$_POST['email']]);
$user = $query->fetch();

if ($user && password_verify($_POST['pass'], $user['pass']))
{
    echo "Identifiant valid!";
} else {
    echo "Identifiant invalid!";
}
?>
