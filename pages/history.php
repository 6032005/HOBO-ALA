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
    <title>Geschiedenis</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a CSS file for styling -->
    <?php include_once '../php/navTop.php'; ?>
    <?php include_once '../php/navLeft.php'; ?>
</head>
<body>
    <div class="container">
        <h1 class="heading">Geschiedenis</h1>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Date</th>
                    <th>Episode - Stream</th>
                    <th>Duration</th> <!-- Changed column name to Duration -->
                </tr>
            </thead>
            <tbody class="around-history">
                <?php
                if (!empty($history)) {
                    foreach ($history as $item) {
                        echo "<tr class=\"wrapper-history\">";
                        echo "<td><img src='" . getImgPathFromID($item['SerieID']) . "' class='card-img-history' alt=''></td>";
                        
                        // Extract and format date
                        $watch_date = date('Y-m-d', strtotime($item['d_start']));
                        
                        // Calculate duration in minutes
                        $start_timestamp = strtotime($item['d_start']);
                        $end_timestamp = strtotime($item['d_eind']);
                        $duration_minutes = round(($end_timestamp - $start_timestamp) / 60); // Convert seconds to minutes

                        echo "<td>" . $watch_date . "</td>";
                        echo "<td>" . $duration_minutes . " minutes</td>"; // Display duration in minutes
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
