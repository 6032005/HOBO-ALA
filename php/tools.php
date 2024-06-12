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
    WHERE KlantID = ? AND serie.actief = 1
    ORDER BY serie.SerieID DESC LIMIT 10;";

    $params = [$userId];
    $result = fetchSqlAll($sql, $params);

    return $result;
}

function getImgPathFromID($id) {
    $len = strlen((string)$id);
    $imagePath = "/img/seriesCards/" . str_repeat("0", 5 - $len) . $id . ".jpg";
    
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
        return $imagePath;
    } else {
        return "/img/seriesCards/error.png";
    }
}

try {
    $sqlTopSeries = "SELECT * FROM serie WHERE actief = 1 LIMIT 10";
    $stmtTopSeries = $conn->query($sqlTopSeries);

    $TopSeries = [];
    if ($stmtTopSeries !== false && $stmtTopSeries->rowCount() > 0) {
        while ($row = $stmtTopSeries->fetch(PDO::FETCH_ASSOC)) {
            $TopSeries[] = $row;
        }
    } else {
        $TopSeries = null;
    }

    $sqlRandomTen = "SELECT * FROM serie WHERE actief = 1 ORDER BY RAND() LIMIT 10";
    $stmtRandomTen = $conn->query($sqlRandomTen);

    $randomSeries = [];
    if ($stmtRandomTen !== false && $stmtRandomTen->rowCount() > 0) {
        while ($row = $stmtRandomTen->fetch(PDO::FETCH_ASSOC)) {
            $randomSeries[] = $row;
        }
    } else {
        $randomSeries = null;
    }

    $sqlCarouselFive = "SELECT * FROM serie WHERE actief = 1 LIMIT 5";
    $stmtCarouselFive = $conn->query($sqlCarouselFive);

    $CarouselFive = [];
    if ($stmtCarouselFive !== false && $stmtCarouselFive->rowCount() > 0) {
        while ($row = $stmtCarouselFive->fetch(PDO::FETCH_ASSOC)) {
            $CarouselFive[] = $row;
        }
    } else {
        $CarouselFive = null;
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
