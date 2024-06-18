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

function fetchIMDBLink($serieid, $conn) {
    $stmt = $conn->prepare("SELECT IMDBLink FROM serie WHERE SerieID = :serieid");
    $stmt->bindValue(':serieid', $serieid, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['IMDBLink'] : null;
}

function fetchSeasonsAndEpisodes($serieid, $conn) {
    $stmt = $conn->prepare("SELECT seizoen.SeizoenID, aflevering.AflTitel, aflevering.Duur
                            FROM seizoen 
                            INNER JOIN aflevering ON seizoen.SeizoenID = aflevering.SeizID 
                            INNER JOIN serie ON seizoen.SerieID = serie.SerieID
                            WHERE serie.SerieID = :serieid");
    $stmt->bindValue(':serieid', $serieid, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $seasons = [];
    foreach ($result as $row) {
        $seasonID = $row['SeizoenID'];
        $seasons[$seasonID][] = [
            'AflTitel' => $row['AflTitel'],
            'Duur' => $row['Duur']
        ];
    }

    return $seasons;
}

if(isset($_GET['serieid'])) {
    $serieid = $_GET['serieid'];

    $seriesData = fetchSeriesData($serieid, $conn);
    $imdbLink = fetchIMDBLink($serieid, $conn);

    if($seriesData) {
        $imgPath = getImgPathFromID($serieid);
?>

<div class="series-content-container">
    <div class="series-container">
        <div class="video-column">
            <div class="video-wrapper">
                <video class="video-player" width="800" height="450" autoplay muted controls>
                    <source src="../img/vid/test.mov" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        
        <div class="info-column">
            <div class="series-body">
                <h2 class="series-title"><?php echo htmlspecialchars($seriesData); ?></h2>
                <?php if ($imdbLink) : ?>
                    <p><a href="<?php echo htmlspecialchars($imdbLink); ?>" target="_blank">IMDb Page</a></p>
                <?php else : ?>
                    <p>No IMDb link available.</p>
                <?php endif; ?>

                <?php
                $seasonsAndEpisodes = fetchSeasonsAndEpisodes($serieid, $conn);

                if ($seasonsAndEpisodes) {
                    echo "<div class='seasons-episodes'>";
                    echo "    <h2 class='seasons-episodes-title'>Seasons and Episodes:</h2>";
                    echo "    <div class='seasons-dropdown'>";
                    echo "        <select id='season-select' onchange='showEpisodes(this.value)'>";
                    echo "            <option value='' selected disabled>Select a Season</option>";
                    foreach ($seasonsAndEpisodes as $seasonID => $episodes) {
                        echo "            <option value='" . htmlspecialchars($seasonID) . "'>Season " . htmlspecialchars($seasonID) . "</option>";
                    }
                    echo "        </select>";
                    echo "    </div>";
                    echo "    <div id='episodes-container'></div>"; 
                    echo "</div>";
                } else {
                    echo "<p class='no-seasons-episodes'>No seasons and episodes found.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
function showEpisodes(seasonID) {
    var episodesContainer = document.getElementById('episodes-container');
    episodesContainer.innerHTML = '';

    <?php foreach ($seasonsAndEpisodes as $seasonID => $episodes) : ?>
        if (seasonID == '<?php echo $seasonID; ?>') {
            <?php foreach ($episodes as $episode) : ?>
                episodesContainer.innerHTML += '<div class="seasons-episodes-item">' +
                                               '    <span class="episode-title"><?php echo htmlspecialchars($episode['AflTitel']); ?></span>' +
                                               '    <span class="episode-length"><?php echo htmlspecialchars($episode['Duur']); ?></span>' +
                                               '</div>';
            <?php endforeach; ?>
        }
    <?php endforeach; ?>
}
</script>

<?php
    }
}
?>
</body>
</html>