<?php
include_once 'sql_connect.php';
include_once 'sql_utils.php';

function getUserHistory($userId) {
    $sql = "SELECT * FROM stream 
    INNER JOIN aflevering 
    ON stream.AflID = aflevering.afleveringID 
    INNER JOIN seizoen 
    ON aflevering.SeizID = seizoen.SeizoenID 
    INNER JOIN serie
    ON seizoen.SerieID = serie.SerieID
    WHERE KlantID = ?
    ORDER BY serie.SerieID DESC LIMIT 10;";

    $params = [$userId];
    $result = fetchSqlAll($sql, $params);

    return $result;
}

function getImgPathFromID($id) {
    $len = strlen((string)$id);
    return "/img/seriesCards/" . str_repeat("0", 5 - $len) . $id . ".jpg";
}

try {
    // SQL query to select the first 10 data
    $sqlFirstTen = "SELECT * FROM serie LIMIT 10";
    $stmtFirstTen = $conn->query($sqlFirstTen);

    // Fetch first 10 results
    $firstTenSeries = [];
    if ($stmtFirstTen !== false && $stmtFirstTen->rowCount() > 0) {
        while ($row = $stmtFirstTen->fetch(PDO::FETCH_ASSOC)) {
            $firstTenSeries[] = $row;
        }
    } else {
        $firstTenSeries = null;
    }

    // SQL query to select random data
    $sqlRandomTen = "SELECT * FROM serie ORDER BY RAND() LIMIT 10";
    $stmtRandomTen = $conn->query($sqlRandomTen);

    // Fetch random 10 results
    $randomSeries = [];
    if ($stmtRandomTen !== false && $stmtRandomTen->rowCount() > 0) {
        while ($row = $stmtRandomTen->fetch(PDO::FETCH_ASSOC)) {
            $randomSeries[] = $row;
        }
    } else {
        $randomSeries = null;
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>