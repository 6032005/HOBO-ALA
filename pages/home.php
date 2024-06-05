<?php
include_once '../php/sql_connect.php';
include_once '../php/sql_utils.php';
include_once '../php/tools.php';


$head = [
    "title" => "HoBo - Home",
    "description" => "Home page van HoBo",
    "stylesheets" => ["/style.css"],
    "scripts" => []
];
include_once '../php/head.php';



$history = getUserHistory(10003); //TODO: change to actual user id

?>

<body>

<?php include_once '../php/navTop.php'; ?>
<?php include_once '../php/navLeft.php'; ?>



<main>

    <div class="carousel-container">
        <div class="carousel">
            <div class="slider">
                <div class="slide-content">
                    <h1 class="movie-title"></h1>
                    <p class="movie-des"></p>
                </div>
                <img src="<?php echo $imgPath; ?>" alt="">
            </div>
        </div>
    </div>



    <div class="movies-list">
        <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
        <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
        <div class="card-container">

        <?php
foreach ($history as $item) {
    $imgPath = getImgPathFromID($item["SerieID"]);

    $SerieTitel = $item["SerieTitel"];
    $AflTitel = $item["AflTitel"];
    $description = "description";

    ?>
    <div class="card">
        <img src="<?php echo $imgPath; ?>" class="card-img" alt="<?php echo $SerieTitel . ' titel'; ?>">
        <div class="card-body">
            <h7 class="name"><?php echo $SerieTitel; ?></h7>

        </div>
    </div>
    <?php
}
?>


        </div>
    </div>
    


 



            </div>

        </div>
        <p class="recommend">Top 10 Series</p>
        <div class="movies-list">
        <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
        <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
        <div class="card-container">
            <?php if ($TopSeries): ?>
                <?php foreach ($TopSeries as $serie): ?>
                    <div class="card">
                        <img src="<?php echo getImgPathFromID($serie['SerieID']); ?>" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name"><?php echo htmlspecialchars($serie['SerieTitel']); ?></h2>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No series available.</p>
            <?php endif; ?>
        </div>
    </div>
    <p class="recommend">Misschien vind je dit leuk</p>
    <div class="movies-list">
    <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
    <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
    <div class="card-container">
        <?php if ($randomSeries): ?>
            <?php foreach ($randomSeries as $serie): ?>
                <a href="serie.php?serieid=<?php echo $serie['SerieID']; ?>" class="serie-link">
                    <div class="card">
                        <img src="<?php echo getImgPathFromID($serie['SerieID']); ?>" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name"><?php echo htmlspecialchars($serie['SerieTitel']); ?></h2>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No series available.</p>
        <?php endif; ?>
    </div>
</div>


</main>

</body>




</html>



<script>

    let cardContainers = [...document.querySelectorAll('.card-container')];
    let preBtns = [...document.querySelectorAll('.pre-btn')];
    let nxtBtns = [...document.querySelectorAll('.nxt-btn')];

    cardContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtns[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth - 200;
        })

        preBtns[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth + 200;
        })
    })
</script>