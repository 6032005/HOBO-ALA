<?php
include_once '../php/sql_connect.php';
include_once '../php/sql_utils.php';
include_once '../php/tools.php';

$head = [
    "title" => "HoBo - Search",
    "description" => "Search for series",
    "stylesheets" => ["/style.css"],
    "scripts" => []
];
include_once '../php/head.php';

try {
    $con = new PDO("mysql:host=localhost;dbname=HoBo", 'root', 'root');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $genresStmt = $con->prepare("SELECT GenreID, GenreNaam FROM genre");
    $genresStmt->execute();
    $genres = $genresStmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<body>
<?php include_once '../php/navTop.php'; ?>
<?php include_once '../php/navLeft.php'; ?>

<section class="search-body">
    <div class="search-container">
        <form id="searchForm" method="post">
            <input type="text" class="search-box-search" name="search" id="searchInput" placeholder="Search for series">
            <select name="genre" id="genreSelect">
                <option value="">Select Genre</option>
                <?php
                foreach ($genres as $genre) {
                    echo '<option value="' . htmlspecialchars($genre['GenreID']) . '">' . htmlspecialchars($genre['GenreNaam']) . '</option>';
                }
                ?>
            </select>
            <input type="submit" class="search-btn" name="submit" value="Search">
        </form>
    </div>

    <?php
    if (isset($_POST["submit"]) && (!empty($_POST["search"]) || !empty($_POST["genre"]))) {
        $search = !empty($_POST["search"]) ? htmlspecialchars($_POST["search"]) : '';
        $genre = !empty($_POST["genre"]) ? htmlspecialchars($_POST["genre"]) : '';

        $sql = "SELECT s.* FROM serie s LEFT JOIN serie_genre sg ON s.SerieID = sg.SerieID WHERE s.actief = 1";

        if (!empty($search)) {
            $sql .= " AND s.SerieTitel LIKE :search";
        }
        if (!empty($genre)) {
            $sql .= " AND sg.GenreID = :genre";
        }

        $stmt = $con->prepare($sql);

        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        }
        if (!empty($genre)) {
            $stmt->bindValue(':genre', $genre, PDO::PARAM_INT);
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<div class="card-container-2">';
            while ($serie = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $imgPath = getImgPathFromID($serie['SerieID']);
                $seriePageUrl = 'serie.php?serieid=' . htmlspecialchars($serie['SerieID']);

                echo '<a href="' . $seriePageUrl . '" class="serie-link">';
                echo '<div class="card">';
                echo '<img src="' . $imgPath . '" class="card-img" alt="">';
                echo '<div class="card-body">';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }
            echo '</div>';
        } else {
            echo '<p class="no-results">No series found</p>';
        }
    }
    ?>

</section>

<script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        var searchInput = document.getElementById('searchInput').value.trim();
        var genreSelect = document.getElementById('genreSelect').value.trim();
        if (searchInput === '' && genreSelect === '') {
            alert('Please enter a search term or select a genre');
            event.preventDefault(); 
        }
    });
</script>

</body>
</html>
