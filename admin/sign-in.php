<?php
require("start.php");
$phone = post('username', 100);
$password = post('password', 100);

$errors = [];

_selectRow(
    "select id, username from userdata where username=? and password=?",
    'ss',
    [$phone, $password],
    $id, $username
);

if (!empty($id)) {
    $_SESSION['userid'] = $id;
    $_SESSION['username'] = $username;
    redirect('index.php');
} else {
    $_SESSION['errors'] = ["Таны утас юмуу нууц үг буруу байна"];
    redirect('login.php');
}