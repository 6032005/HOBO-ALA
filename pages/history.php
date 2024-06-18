<?php
include_once '../php/sql_connect.php'; 
include_once '../php/tools.php'; 

$klantID = 10003;
$history = getUserHistory($klantID, $conn);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>geschiedenis</title>
    <?php include_once '../php/navTop.php'; ?>
<?php include_once '../php/navLeft.php'; ?>
</head>
<body>
<div class="container">
    <h1 class="heading">Geschiedenis</h1>
    <table class="history-table">
        <tbody class="around-history">
            <?php
            if (!empty($history)) {
                foreach ($history as $item) {
                    echo "<tr class=\"wrapper-history\">";
                    echo "<td><img src='" . getImgPathFromID($item['SerieID']) . "' class='card-img-history' alt=''></td>";
                    echo "<td>" . $item["d_start"] . "</td>";
                    echo "<td>" . $item["AfleveringID"] . " - " . $item["StreamID"] . "</td>";
                    echo "<td>" . $item["d_eind"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='no-data'>Geen gegevens beschikbaar</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>