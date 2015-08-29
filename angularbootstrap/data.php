<?php

sleep(3);

$user = new stdclass();
$user->name = "Joe";
$user->email = "joe@gmail.com";

echo json_encode($user);