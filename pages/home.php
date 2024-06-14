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

<section class="boxxed">
<div class="carousel-container">
    <div class="carousel">
        <div class="slider">
            <div class="slide" style="background-image: url('../img/Marco-Polo-1280x720.jpg'); background-size: cover; background-position: center;">
                <div class="slide-content">
                    <div class="gradient-overlay"></div>
                </div>
            </div>
            <div class="slide" style="background-image: url('../img/p19516344_b_h8_aa.jpg'); background-size: cover; background-position: center;">
                <div class="slide-content">
                    <div class="gradient-overlay"></div>
                    <div class="text-container">
                        <div class="movie-title"></div>
                        <div class="movie-des"></div>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('../img/ERpJ62MXsAYYKLa.jpg'); background-size: cover; background-position: center;">
                <div class="slide-content">
                    <div class="gradient-overlay"></div>
                </div>
            </div>
            <div class="slide" style="background-image: url('../img/p16748119_b_h8_af.jpg'); background-size: cover; background-position: center;">
                <div class="slide-content">
                    <div class="gradient-overlay"></div>
                    <div class="text-container">
                        <div class="movie-title">1</div>
                        <div class="movie-des">1</div>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('../img/tvreview-jessicajones2-banner2.jpg'); background-size: cover; background-position: center;">
                <div class="slide-content">
                    <div class="gradient-overlay"></div>
                    <div class="text-container">
                    </div>
                </div>
            </div>
        </div>
        <button class="prev-btn">&#9664;</button>
        <button class="next-btn">&#9654;</button>
    </div>
</div>
</section>




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
        <p class="recommend">Populaire series</p>
        <div class="movies-list">
        <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
        <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
        <div class="card-container">
            <?php if ($TopSeries): ?>
                <?php foreach ($TopSeries as $serie): ?>
                    <a href="serie.php?serieid=<?php echo $serie['SerieID']; ?>" class="serie-link">
                    <div class="card">
                        <img src="<?php echo getImgPathFromID($serie['SerieID']); ?>" class="card-img" alt="">
                        <div class="card-body">
                        </div>
                    </div>
                    </a>
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
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No series available.</p>
        <?php endif; ?>
    </div>
</div>
<div class="genre-container">
        <?php
        $genres = ['Comedy', 'Drama', 'Crime'];

        foreach ($genres as $genre):
            $seriesByGenres = getSeriesBySpecificGenre($genre);
        ?>
            <h2 class="recommend"> <?php echo htmlspecialchars($genre); ?></h2>
            <div class="movies-list">
                <button class="pre-btn"><img src="/img/pre.png" alt="Previous"></button>
                <button class="nxt-btn"><img src="/img/nxt.png" alt="Next"></button>
                <div class="card-container">
                    <?php if (!empty($seriesByGenres)): ?>
                        <?php foreach ($seriesByGenres as $series): ?>
                            <a href="serie.php?serieid=<?php echo $series['SerieID']; ?>" class="serie-link">
                                <div class="card">
                                    <img src="<?php echo getImgPathFromID($series['SerieID']); ?>" class="card-img" alt="<?php echo htmlspecialchars($series['SerieTitel']); ?>">
                                    <div class="card-body">
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-series">No series found in this genre.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</main>

</body>




</html>



<script>

const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

let currentIndex = 0;

function updateSlidePosition() {
    const slideWidth = slides[currentIndex].clientWidth;
    slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

nextBtn.addEventListener('click', () => {
    if (currentIndex < slides.length - 1) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }
    updateSlidePosition();
});

prevBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = slides.length - 1;
    }
    updateSlidePosition();
});

window.addEventListener('resize', updateSlidePosition);


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
<script src="scripts/app.js"></script>
