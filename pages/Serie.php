<?php

include_once '../php/sql_connect.php';
include_once '../php/sql_utils.php';
include_once '../php/tools.php';


function fetchSeriesData($serieid, $conn) {

    $stmt = $conn->prepare("SELECT SerieTitel FROM serie WHERE SerieID = :serieid");
    $stmt->bindValue(':serieid', $serieid, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    return $result ? $result['SerieTitel'] : null;
}


function fetchSeasonsAndEpisodes($serieid, $conn) {
    $stmt = $conn->prepare("SELECT seizoen.SeizoenID, seizoen.SeizoenTitel, aflevering.AflTitel 
                            FROM seizoen 
                            JOIN aflevering ON seizoen.SeizoenID = aflevering.SeizoenID 
                            WHERE seizoen.SerieID = :serieid");
    $stmt->bindValue(':serieid', $serieid, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    return $result;
}


if(isset($_GET['serieid'])) {

    $serieid = $_GET['serieid'];
    

    $seriesData = fetchSeriesData($serieid, $conn);


    if($seriesData) {

        echo "<h1>" . htmlspecialchars($seriesData) . "</h1>";


        $seasonsAndEpisodes = fetchSeasonsAndEpisodes($serieid, $conn);


        if($seasonsAndEpisodes) {

            echo "<h2>Seasons and Episodes:</h2>";
            echo "<ul>";
            foreach ($seasonsAndEpisodes as $row) {
                echo "<li>Season " . htmlspecialchars($row['SeizoenTitel']) . ": " . htmlspecialchars($row['AflTitel']) . "</li>";
            }
            echo "</ul>";
        } else {

            echo "<p>No seasons and episodes found.</p>";
        }
    } else {

        echo "<p>Debug: SerieID = $serieid</p>";

        echo "<p>Series not found.</p>";
    }
} else {

    echo "<p>No SerieID provided.</p>";
}
?>
