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
    ORDER BY stream.StreamID DESC;";


    $params = [$userId];
    $result = fetchSqlAll($sql, $params);

    return $result;
}


function getImgPathFromID($id) {
    $len = strlen((string)$id);

    return "/img/seriesCards/" . str_repeat("0", 5 - $len) . $id . ".jpg";
}