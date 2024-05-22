<?php


include_once '../php/sql_connect.php';
include_once '../php/sql_utils.php';
include_once '../php/tools.php';

$test = getUserHistory(10003);

echo json_encode($test);