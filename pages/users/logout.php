<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['login_type']);
unset($_SESSION['id']);
Redirect::to('index?!=wel|');
?>