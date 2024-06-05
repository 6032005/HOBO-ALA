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
    // Establishing database connection
    try {
        $con = new PDO("mysql:host=localhost;dbname=HoBo", 'root', 'root');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }


    if (isset($_POST["submit"]) && !empty($_POST["search"])) {

        $search = htmlspecialchars($_POST["search"]);


        $stmt = $con->prepare("SELECT * FROM serie WHERE SerieTitel LIKE :search");
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            echo '<div class="card-container-2">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $imgPath = getImgPathFromID($row['SerieID']);
                echo '<div class="card-2">';
                echo '<img src="' . $imgPath . '" class="card-img-2" alt="">';
                echo '<div class="card-body-2">';
                echo '<h2 class="name-2">' . htmlspecialchars($row['SerieTitel']) . '</h2>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p class="no-results">No series found</p>';
        }
    } elseif (!isset($_POST["submit"])) {
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
