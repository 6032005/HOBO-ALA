<?php

include_once '../php/sql_connect.php';
include_once '../php/sql_utils.php';

$test = fetchSqlAll("SELECT * FROM serie ");


echo json_encode($test);