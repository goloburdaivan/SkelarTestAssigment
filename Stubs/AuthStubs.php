<?php
use Stub\Auth;
require_once './Models/Auth.php';

global $auths;
$auths = [new Auth("admin", password_hash("123123", PASSWORD_DEFAULT)),
    new Auth("root", password_hash('123123', PASSWORD_DEFAULT))];