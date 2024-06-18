<?php
include_once '/php/sql_connect.php';
include_once '/php/sql_utils.php';

function getUserHistory($klantID, $conn) {
    $sql = "SELECT s.StreamID, s.KlantID, s.AflID, s.d_start, s.d_eind, 
                   a.AfleveringID, a.SerieID,
                   se.Seizoen, se.SerieNaam, se.SerieImage
            FROM stream s
            LEFT JOIN aflevering a ON s.AflID = a.AfleveringID
            LEFT JOIN seizoen se ON a.Seizoen = se.Seizoen
            WHERE s.KlantID = " . $klantID;

    $result = $conn->query($sql);

    $history = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    }

    return $history;
}
?>

