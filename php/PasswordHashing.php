<?php
$password = "tacotruck";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
