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


// Define function to get image path from SerieID
function getImgPathFromID($id) {
    $len = strlen((string)$id);
    $imagePath = "/img/seriesCards/" . str_repeat("0", 5 - $len) . $id . ".jpg";
    
    // Check if the image file exists
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
        return $imagePath;
    } else {
        // Return path to error image if no image found
        return "/img/seriesCards/error.png";
    }
}





try {

    $sqlTopSeries = "SELECT * FROM serie LIMIT 10";
    $stmtTopSeries = $conn->query($sqlTopSeries);


    $TopSeries = [];
    if ($stmtTopSeries !== false && $stmtTopSeries->rowCount() > 0) {
        while ($row = $stmtTopSeries->fetch(PDO::FETCH_ASSOC)) {
            $TopSeries[] = $row;
        }
    } else {
        $TopSeries = null;
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

