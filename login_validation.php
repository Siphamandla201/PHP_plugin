<?php

$email = $_POST["email"];
$password = $_POST["password"];
$submit = $_POST["login"];

if (isset($submit)) {
 echo "logged in";
 require_once "db_config.php";
}


?>