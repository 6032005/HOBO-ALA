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
?>

<body>
<?php include_once '../php/navTop.php'; ?>
<?php include_once '../php/navLeft.php'; ?>

<section class="search-body">
    <div class="search-container">
        <form id="searchForm" method="post">
            <input type="text" class="search-box-search" name="search" id="searchInput" placeholder="search">
            <input type="submit" class="search-btn" name="submit" value="Search">
        </form>
    </div>

    <?php
    try {
        $con = new PDO("mysql:host=localhost;dbname=HoBo", 'root', 'root');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    if (isset($_POST["submit"]) && !empty($_POST["search"])) {
        $search = htmlspecialchars($_POST["search"]);

        $stmt = $con->prepare("SELECT * FROM serie WHERE SerieTitel LIKE :search AND actief = 1");

        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
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
        if (searchInput === '') {
            alert('Geen letters zijn ingevuld');
            event.preventDefault(); 
        }
    });
</script>

</body>
</html>
