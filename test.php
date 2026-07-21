<?php
require_once 'functions.php';
$data = getAll('users'); // подставь своё название таблицы
print_r($data);