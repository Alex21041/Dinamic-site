<?php
// logout.php — выход
session_start();
session_destroy();
header('Location: login.php');
exit;
