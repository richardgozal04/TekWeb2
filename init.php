<?php

session_start();

$db = new PDO("mysql:host=localhost;dbname=u541015334_poll","u541015334_poll","admin123");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>