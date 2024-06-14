<?php
include_once 'sql_connect.php';
include_once 'sql_utils.php';

function getUserHistory($userId) {
    global $conn; // Assuming $conn is your database connection object from sql_connect.php

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
    // Fetch top series
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

    // Fetch random ten series
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

    // Fetch carousel five series
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


    $sqlGenres = "SELECT * FROM genre";
    $stmtGenres = $conn->query($sqlGenres);

    $genres = [];
    if ($stmtGenres !== false && $stmtGenres->rowCount() > 0) {
        while ($row = $stmtGenres->fetch(PDO::FETCH_ASSOC)) {
            $genres[] = $row;
        }
    } else {
        $genres = null;
    }

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


function getSeriesBySpecificGenre($genreNaam) {
    global $conn;

    $sql = "SELECT serie.SerieID, serie.SerieTitel, genre.GenreNaam
            FROM serie
            INNER JOIN serie_genre ON serie.SerieID = serie_genre.SerieID
            INNER JOIN genre ON serie_genre.GenreID = genre.GenreID
            WHERE serie.actief = 1 AND genre.GenreNaam = ?
            ORDER BY serie.SerieTitel";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$genreNaam]);

    $seriesByGenre = [];
    if ($stmt !== false && $stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $seriesByGenre[] = ['SerieID' => $row['SerieID'], 'SerieTitel' => $row['SerieTitel']];
        }
    }

    return $seriesByGenre;
}



?>
