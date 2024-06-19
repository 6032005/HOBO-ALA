<?php

function runSql($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

function runSqlreturnConn($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $conn;
}


function fetchSql($sql, $params = []) {
    return runSql($sql, $params)->fetch(PDO::FETCH_ASSOC);
}

function fetchSqlAll($sql, $params = []) {
    return runSql($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
}



