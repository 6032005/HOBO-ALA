<body>
<?php include_once '../php/navTop.php'; ?>
<?php include_once '../php/navLeft.php'; ?>

<?php
$head = [
    "title" => "HoBo - Home",
    "description" => "Home page van HoBo",
    "stylesheets" => ["/style.css"],
    "scripts" => []
];
include_once '../php/head.php';


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
    $stmt = $conn->prepare("SELECT seizoen.SeizoenID, aflevering.AflTitel 
                            FROM seizoen 
                            INNER JOIN aflevering ON seizoen.SeizoenID = aflevering.SeizID 
                            INNER JOIN serie ON seizoen.SerieID = serie.SerieID
                            WHERE serie.SerieID = :serieid");
    $stmt->bindValue(':serieid', $serieid, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

if(isset($_GET['serieid'])) {
    $serieid = $_GET['serieid'];

    $seriesData = fetchSeriesData($serieid, $conn);

    if($seriesData) {
        $imgPath = getImgPathFromID($serieid);

        // Display video
   ?>


<div class="video-container">
    <video class="video-player" width="640" height="480" autoplay muted controls>
        <source src="../img/vid/test.mov" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<div class="series-body">
    <h2 class="series-title"><?php echo htmlspecialchars($seriesData); ?></h2>
</div>
</div>
</div>

   <?php
        // Display seasons and episodes
        $seasonsAndEpisodes = fetchSeasonsAndEpisodes($serieid, $conn);

        if($seasonsAndEpisodes) {
            echo "<div class='seasons-episodes'>";
            echo "<h2 class='seasons-episodes-title'>Seasons and Episodes:</h2>";
            echo "<ul class='seasons-episodes-list'>";
            foreach ($seasonsAndEpisodes as $row) {
                echo "<li class='seasons-episodes-item'>Season " . htmlspecialchars($row['SeizoenID']) . ": " . htmlspecialchars($row['AflTitel']) . "</li>";
            }
            echo "</ul>";
            echo "</div>";
        } else {
            echo "<p class='no-seasons-episodes'>No seasons and episodes found.</p>";
        }
    } 
} 
?>
